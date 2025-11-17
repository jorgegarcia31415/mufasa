<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador para manejar las compras.
 * Maneja vistas, inserciones, actualizaciones, eliminaciones y AJAX para auto-relleno de precios.
 * Integra con inventario: al guardar una compra, crea automáticamente un movimiento de 'entrada' en inventario.
 */
class compras extends CI_Controller
{
    /**
     * Constructor: Carga modelos necesarios y verifica sesión si es requerido.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("compras_model");  // Modelo para operaciones en tabla 'compras'
        $this->load->model("Inventario_model");  // Nuevo modelo para operaciones en tabla 'inventario'
        $this->load->library(array('form_validation', 'session'));  // Librerías para validación y sesiones
        $this->load->helper('url');  // Helper para generar URLs base

        // Cambio añadido: Verificación de sesión en el constructor.
        // Por qué: Asegura que solo usuarios logueados accedan al controller, previniendo accesos no autorizados.
        // Qué función tiene: Redirige a login si no hay sesión activa.
        // Para qué sirve: Implementa una capa de seguridad global para todas las acciones del controller, cumpliendo el objetivo de aislamiento.
        if (!$this->session->userdata('user_id')) {
            redirect('auth');  // Redirige a login si no logueado
        }
    }

    /**
     * Método index: Muestra la lista de compras.
     * Carga la vista del menú y la lista de compras desde el modelo.
     */
    public function index()
    {
        // Cambio añadido: Obtener id_usuario de la sesión y pasarlo al modelo.
        // Por qué: El método original obtenía todas las compras sin filtro.
        // Qué función tiene: Filtra las compras por el usuario logueado antes de pasar a la vista.
        // Para qué sirve: Garantiza que la lista muestre solo compras del usuario actual, aislando datos.
        $id_usuario = $this->session->userdata('user_id');  // Obtener ID del usuario logueado
        $list = array('compras' => $this->compras_model->obtener_compras_por_usuario($id_usuario));  // Filtrar por usuario
        $this->load->view('compras/lista', $list);  // Carga la vista de lista de compras con los datos
    }

    /**
     * Método edit: Muestra el formulario de edición para una compra específica.
     * @param int $pk_id - ID de la compra a editar (pasado por URL).
     */
    public function edit($pk_id)
    {
        // Cambio añadido: Obtener id_usuario y pasarlo al modelo, con verificación de propiedad.
        // Por qué: El método original no verificaba si la compra pertenecía al usuario.
        // Qué función tiene: Filtra la compra por usuario y redirige si no existe o no pertenece.
        // Para qué sirve: Previene edición de compras ajenas, reforzando seguridad y privacidad.
        $id_usuario = $this->session->userdata('user_id');
        $datos = array('compras' => $this->compras_model->obtener_compra($pk_id, $id_usuario));  // Filtrar por usuario
        if (!$datos['compras']) {
            $this->session->set_flashdata('error', 'Compra no encontrada o no autorizada.');
            redirect('compras/compras');
        }
        $this->load->view('compras/edit', $datos);  // Carga la vista de edición con los datos
    }

    /**
     * Método anadir: Muestra el formulario para añadir una nueva compra.
     * No recibe parámetros; la vista maneja prefill de id_perfume vía GET (?id_perfume=X).
     * El JS en la vista cargará el precio automáticamente vía AJAX.
     */
    public function anadir()
    {
        // Sin cambios: La sesión ya se verifica en __construct, y el id_usuario se asigna en guardar().
        $data['title'] = 'Añadir Compra';  // Título opcional para la vista
        $this->load->view('compras/añadir', $data);  // Carga la vista de añadir compra
    }

    /**
     * Método guardar: Procesa el formulario de nueva compra.
     * Valida los datos, inserta en tabla 'compras', y automáticamente crea un movimiento en 'inventario' (tipo 'entrada').
     * id_compra e id_movimiento se generan AUTO_INCREMENT en BD (no se insertan manualmente).
     * Usa flashdata para mensajes de éxito/error y redirige a la lista.
     */
 public function guardar()
{
    $datos = array(
        'id_usuario'     => $this->input->post('id_usuario'),
        'fecha'          => $this->input->post('fecha'),
        'proveedor'      => $this->input->post('proveedor'),
        'id_perfume'     => $this->input->post('id_perfume'),
        'cantidad'       => $this->input->post('cantidad'),
        'costo_unitario' => $this->input->post('costo_unitario'),
        'total'          => $this->input->post('total')
    );

    $this->compras_model->guardar($datos);
    redirect('compras/compras');
}


    /**
     * Método actualizar: Procesa la actualización de una compra existente.
     * Valida y actualiza en tabla 'compras'. (No integra con inventario, ya que es actualización).
     * Usa flashdata para mensaje y redirige.
     */
    public function actualizar()
    {
        // Configuración de reglas de validación (similar a guardar, pero requiere id_compra)
        $this->form_validation->set_rules('id_compra', 'ID Compra', 'required|integer|greater_than[0]');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required|valid_date');
        $this->form_validation->set_rules('proveedor', 'Proveedor', 'required|max_length[100]');
        $this->form_validation->set_rules('id_perfume', 'ID Perfume', 'required|integer|greater_than[0]');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'required|integer|greater_than[0]');
        $this->form_validation->set_rules('costo_unitario', 'Costo Unitario', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('total', 'Total', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('compras/compras');
        } else {
            // Cambio añadido: Obtener id_usuario y pasarlo al modelo.
            // Por qué: El método original actualizaba sin verificar propiedad.
            // Qué función tiene: Limita la actualización al usuario logueado.
            // Para qué sirve: Evita modificaciones no autorizadas, manteniendo privacidad.
            $id_usuario = $this->session->userdata('user_id');
            $data = array(
                'id_compra' => $this->input->post('id_compra', TRUE),
                'fecha' => $this->input->post('fecha', TRUE),
                'proveedor' => $this->input->post('proveedor', TRUE),
                'id_perfume' => $this->input->post('id_perfume', TRUE),
                'cantidad' => $this->input->post('cantidad', TRUE),
                'costo_unitario' => $this->input->post('costo_unitario', TRUE),
                'total' => $this->input->post('total', TRUE)
            );

            // Actualizar en tabla 'compras'
            if ($this->compras_model->actualizar($data, $id_usuario)) {
                $this->session->set_flashdata('success', 'Compra actualizada exitosamente.');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar la compra.');
            }
            redirect('compras/compras');  // Redirigir a la lista
        }
    }

    /**
     * Método eliminar: Elimina una compra por ID.
     * @param int $pkid - ID de la compra a eliminar (pasado por URL).
     * Redirige a la lista después.
     */
    public function eliminar($pkid)
    {
        // Cambio añadido: Obtener id_usuario y pasarlo al modelo.
        // Por qué: El método original eliminaba sin verificar propiedad.
        // Qué función tiene: Restringe la eliminación al usuario logueado.
        // Para qué sirve: Protege contra eliminación de compras ajenas, asegurando integridad de datos.
        $id_usuario = $this->session->userdata('user_id');
        if ($this->compras_model->eliminar($pkid, $id_usuario)) {
            $this->session->set_flashdata('success', 'Compra eliminada exitosamente.');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar la compra.');
        }
        $this->index();  // Recarga la lista
    }

    /**
     * Método obtener_precio: Endpoint AJAX para auto-rellenar el precio en el formulario de añadir.
     * Recibe id_perfume por POST, consulta el precio más reciente en 'inventario' (de movimientos de 'entrada').
     * Responde con JSON: {precio: X.XX} o {error: mensaje}.
     * Usado por el JS en la vista añadir.php.
     */
    public function obtener_precio()
    {
        header('Content-Type: application/json');  // Respuesta en JSON

        if ($this->input->post('id_perfume')) {
            $id_perfume = $this->input->post('id_perfume', TRUE);  // Obtener ID seguro

            // Consultar precio del modelo de inventario
            $precio = $this->Inventario_model->get_precio_by_perfume($id_perfume);

            if ($precio !== NULL) {
                echo json_encode(array('precio' => (float)$precio));  // Éxito: devuelve el precio
            } else {
                echo json_encode(array('error' => 'No se encontró precio registrado para este perfume en inventario. Ingresa manualmente.'));  // Error: no hay precio
            }
        } else {
            echo json_encode(array('error' => 'ID de perfume requerido para cargar el precio.'));  // Error: parámetro faltante
        }
    }
}