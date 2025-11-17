<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo para manejar operaciones CRUD en la tabla 'inventario'.
 * Incluye inserciones automáticas de movimientos (ej: desde compras), búsquedas, y consultas específicas para auto-relleno de precios/nombres.
 * Estructura asumida: id_movimiento (AUTO_INCREMENT PK), nombre (varchar requerido), fecha (date), id_perfume (int), tipo (enum 'entrada'/'salida'), cantidad (int), descripcion (text), precio (decimal).
 * Se integra con controlador de 'compras': al guardar compra, inserta movimiento de 'entrada' aquí y extrae precios para auto-relleno.
 */
class Inventario_model extends CI_Model {

    /**
     * Constructor: Inicializa el modelo y carga la base de datos si no está en autoload.
     * (Recomendado: Pon 'database' en autoload.php para que no sea necesario aquí).
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();  // Carga la BD si no está en autoload (opcional si ya lo está)
    }

    /**
     * Método guardar: Inserta un nuevo movimiento en la tabla 'inventario'.
     * @param array $inventario - Datos del movimiento (sin 'id_movimiento', se genera AUTO_INCREMENT en BD).
     * Incluye soporte para 'precio' si se pasa en el array.
     * @return bool - True si se insertó exitosamente.
     * Nota: Este método se usa automáticamente desde el controlador de 'compras' para crear movimientos de 'entrada'.
     */
    public function guardar($inventario) {
        // Insertamos datos en la tabla inventario (BD genera id_movimiento automáticamente)
        // Si se pasa 'precio' en $inventario, se guarda (para movimientos de compra)
        return $this->db->insert('inventario', $inventario);  // Retorna true/false según éxito
    }

    /**
     * Método obtener_inventario_1: Obtiene todos los movimientos de la tabla 'inventario'.
     * @return array - Arreglo de objetos con todos los registros (incluye 'precio').
     * Usado para mostrar la lista en vistas como inventario/lista.php.
     */
    public function obtener_inventario_1() {
        // Obtenemos los datos de la tabla inventario (SELECT * incluye 'precio')
        return $this->db->get('inventario')->result();  // result() devuelve array de objetos
    }

    /**
     * Método obtener_inventario: Obtiene un movimiento específico por ID.
     * @param int $id - ID del movimiento (id_movimiento).
     * @return object|null - Objeto con los datos o null si no existe.
     * Usado para vistas de edición.
     */
    public function obtener_inventario($id) {
        $this->db->where('id_movimiento', $id);  // Filtro por ID
        return $this->db->get('inventario')->row();  // row() devuelve un solo objeto o null
    }

    /**
     * Método actualizar: Actualiza un movimiento existente en la tabla 'inventario'.
     * Usa datos de POST para seguridad (escapa automáticamente).
     * @return bool - True si se actualizó (afecta al menos 1 fila).
     * Nota: Incluye 'nombre' y 'precio' para completitud (tu tabla los requiere).
     */
    public function actualizar() {
        // NUEVO/MEJORA: Incluye 'precio' y 'nombre' en los datos a actualizar (tu tabla los requiere)
        $datos = array(
            'id_movimiento' => $this->input->post('id_movimiento', TRUE),  // PK para WHERE (usar input->post para seguridad)
            'nombre' => $this->input->post('nombre', TRUE),  // MEJORA: Agregado (requerido en tabla, faltaba en tu versión)
            'fecha' => $this->input->post('fecha', TRUE),
            'id_perfume' => $this->input->post('id_perfume', TRUE),
            'tipo' => $this->input->post('tipo', TRUE),
            'cantidad' => $this->input->post('cantidad', TRUE),
            'precio' => $this->input->post('precio', TRUE),  // Soporte para actualizar precio
            'descripcion' => $this->input->post('descripcion', TRUE)
        );

        $this->db->set($datos);  // Establece los campos a actualizar (excluye PK)
        $this->db->where('id_movimiento', $datos['id_movimiento']);  // Filtro por PK
        return $this->db->update('inventario');  // update() retorna true si afecta filas
    }

    /**
     * Método eliminar: Elimina un movimiento por ID.
     * @param int $pkid - ID del movimiento a eliminar (id_movimiento).
     * @return bool - True si se eliminó.
     * Nota: No elimina movimientos relacionados (ej: ventas/compras) por seguridad.
     */
    public function eliminar($pkid) {
        $this->db->where('id_movimiento', $pkid);  // Filtro por ID
        return $this->db->delete('inventario');  // delete() retorna true si éxito
    }

    /**
     * Método buscar_inventario: Busca movimientos por términos (descripción, tipo, ID, precio).
     * @param string $busqueda - Término de búsqueda.
     * @return array - Arreglo de resultados coincidentes.
     * Usado en vistas con barra de búsqueda (ej: inventario/lista.php).
     * MEJORA: Agregado or_like para 'nombre' para completitud (busca por nombre del perfume).
     */
    public function buscar_inventario($busqueda) {
        // MEJORA: Agregado or_like para 'nombre' (completitud, busca por nombre del perfume)
        $this->db->group_start();  // Iniciar grupo OR para múltiples condiciones
        $this->db->like('nombre', $busqueda);  // MEJORA: Buscar por nombre (ej: "Invictus")
        $this->db->or_like('descripcion', $busqueda);
        $this->db->or_like('tipo', $busqueda);
        $this->db->or_like('id_perfume', $busqueda);
        $this->db->or_like('precio', $busqueda);  // Buscar por precio (ej. "150" o "50.00")
        $this->db->group_end();  // Fin del grupo OR
        $query = $this->db->get('inventario');  // Ejecutar consulta
        return $query->result();  // Retorna array de objetos
    }

    /**
     * MÉTODO AGREGADO: get_precio_by_perfume - Obtiene el precio unitario más reciente para un perfume específico.
     * Busca el último movimiento de tipo 'entrada' ordenado por fecha DESC.
     * @param int $id_perfume - ID del perfume (ej: 1 para Invictus).
     * @return float|null - El precio (decimal) o null si no hay movimientos de 'entrada' para este perfume.
     * Usado por el controlador de 'compras' para auto-rellenar 'costo_unitario' en el formulario de añadir compra.
     * EJEMPLO: Para id_perfume=1, retorna el precio del último 'entrada' (ej: 50.00 de inventario).
     * Esto resuelve el auto-relleno: extrae directamente el valor de 'precio' de la tabla 'inventario'.
     */
    public function get_precio_by_perfume($id_perfume) {
        if (!is_numeric($id_perfume) || $id_perfume <= 0) {
            return NULL;  // Validación: ID inválido, no buscar
        }

        // Consulta SQL optimizada: Solo 'precio' del último 'entrada' por fecha
        $this->db->select('precio');  // Solo necesitamos el campo 'precio' de la tabla 'inventario'
        $this->db->from('inventario');  // Tabla origen
        $this->db->where('id_perfume', $id_perfume);  // Filtrar por ID del perfume
        $this->db->where('tipo', 'entrada');  // Solo movimientos de entrada (compras/agregados al stock)
        $this->db->order_by('fecha', 'DESC');  // El más reciente primero (último movimiento)
        $this->db->limit(1);  // Solo uno (el último)

        $query = $this->db->get();  // Ejecutar consulta
        $result = $query->row();  // Primera fila como objeto

        // Retornar precio si existe (convertir a float para precisión decimal)
        return $result ? (float)$result->precio : NULL;
    }

    /**
     * MÉTODO AGREGADO: obtener_nombre_perfume - Obtiene el nombre del perfume basado en su ID.
     * Asume tabla 'perfumes' con campos 'id' (PK) y 'nombre'. Si no existe, usa fallback con switch (basado en tu vista de inventario).
     * @param int $id_perfume - ID del perfume.
     * @return string - Nombre real o fallback (ej: 'Invictus' para ID=1).
     * Usado al insertar movimiento en 'inventario' desde 'compras' para rellenar campo 'nombre' (requerido en tu tabla).
     * Esto evita errores de inserción si 'nombre' es NOT NULL.
     */
    public function obtener_nombre_perfume($id_perfume) {
        if (!is_numeric($id_perfume) || $id_perfume <= 0) {
            return 'Perfume Desconocido';  // Fallback para ID inválido
        }

        // Intento 1: Consultar en tabla 'perfumes' (ajusta nombre de tabla si es diferente, ej: 'productos')
        // Si no tienes esta tabla, salta directamente al fallback (comenta esta sección)
        $this->db->select('nombre AS perfume_nombre');  // Alias para claridad
        $this->db->from('perfumes');  // Asumiendo tabla 'perfumes' (cámbiala si no existe o se llama diferente)
        $this->db->where('id', $id_perfume);  // Filtrar por PK 'id'
        $query = $this->db->get();
        $result = $query->row();

        // Si encuentra nombre en BD, retórnalo
        if ($result && !empty($result->perfume_nombre)) {
            return trim($result->perfume_nombre);  // Nombre limpio
        }

        // Intento 2: Fallback hardcodeado (basado en tu vista inventario/lista.php: ID1=Invictus, ID2=Sauvage)
        // Expande este switch si tienes más perfumes conocidos. Si no quieres hardcodear, usa solo el fallback genérico.
        switch ($id_perfume) {
            case 1:
                return 'Invictus';
            case 2:
                return 'Sauvage';
            default:
                return 'Perfume ID: ' . $id_perfume;  // Genérico si no coincide
        }

        // Alternativa simple si no quieres switch: return 'Perfume ID: ' . $id_perfume;
    }

    // Nota: Puedes agregar más métodos si necesitas, ej: calcular stock total por perfume (suma de entradas - salidas)
    // public function get_stock_total($id_perfume) {
    //     $this->db->select_sum('cantidad', 'entradas');
    //     $this->db->from('inventario');
    //     $this->db->where('id_perfume', $id_perfume);
    //     $this->db->where('tipo', 'entrada');
    //     $query_entradas = $this->db->get();
    //     $entradas = $query_entradas->row()->entradas ?? 0;
    //     
    //     $this->db->select_sum('cantidad', 'salidas');
    //     $this->db->from('inventario');
    //     $this->db->where('id_perfume', $id_perfume);
    //     $this->db->where('tipo', 'salida');
    //     $query_salidas = $this->db->get();
    //     $salidas = $query_salidas->row()->salidas ?? 0;
    //     
    //     return $entradas - $salidas;
    // }
}
?>