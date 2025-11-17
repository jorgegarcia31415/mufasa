<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo para manejar operaciones CRUD en la tabla 'compras'.
 * No maneja lógica de inventario (eso va en Inventario_model).
 */
class compras_model extends CI_Model
{
    /**
     * Método guardar: Inserta una nueva compra en la tabla 'compras'.
     * @param array $compras - Datos de la compra (sin 'id_compra', se genera AUTO_INCREMENT).
     * @return bool - True si se insertó exitosamente.
     */
    public function guardar($compras)
    {
        // Cambio añadido: Ahora $compras incluye 'id_usuario' pasado desde el controller.
        // Por qué: Para asignar automáticamente la compra al usuario logueado.
        // Qué función tiene: Inserta el registro con el ID del usuario en la BD.
        // Para qué sirve: Garantiza que cada compra esté ligada a un usuario, cumpliendo el objetivo de aislamiento de datos.
        return $this->db->insert('compras', $compras);  // Retorna true/false según éxito
    }

    /**
     * Método obtener_compras_por_usuario: Obtiene todas las compras de un usuario específico.
     * @param int $id_usuario - ID del usuario logueado.
     * @return array - Arreglo de objetos con las compras del usuario.
     */
    // Cambio añadido: Renombrado de obtener_compras_1() a obtener_compras_por_usuario() y añadido parámetro $id_usuario.
    // Por qué: El método original obtenía todas las compras sin filtro, exponiendo datos de otros usuarios.
    // Qué función tiene: Filtra la consulta SQL con WHERE id_usuario = ? para devolver solo compras del usuario especificado.
    // Para qué sirve: Implementa el aislamiento de datos, permitiendo que cada usuario vea únicamente sus propias compras.
    public function obtener_compras_por_usuario($id_usuario)
    {
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->get('compras')->result();  // result() devuelve array de objetos
    }

    /**
     * Método obtener_compra: Obtiene una compra específica por ID y usuario.
     * @param int $id - ID de la compra.
     * @param int $id_usuario - ID del usuario logueado.
     * @return object|null - Objeto con los datos o null si no existe o no pertenece al usuario.
     */
    // Cambio añadido: Añadido parámetro $id_usuario y filtro WHERE id_usuario = ?.
    // Por qué: El método original no verificaba propiedad, permitiendo acceso a compras ajenas.
    // Qué función tiene: Agrega una condición adicional en la consulta para asegurar que la compra pertenezca al usuario.
    // Para qué sirve: Previene acceso no autorizado a datos de otros usuarios, reforzando la seguridad.
    public function obtener_compra($id, $id_usuario)
    {
        $this->db->where('id_compra', $id);
        $this->db->where('id_usuario', $id_usuario);  // Filtro por usuario añadido
        return $this->db->get('compras')->row();  // row() devuelve un solo objeto o null
    }

    /**
     * Método actualizar: Actualiza una compra existente en la tabla, solo si pertenece al usuario.
     * @param array $data - Datos actualizados, incluyendo 'id_compra'.
     * @param int $id_usuario - ID del usuario logueado.
     * @return bool - True si se actualizó (afecta al menos 1 fila).
     */
    // Cambio añadido: Añadido parámetro $id_usuario y filtro WHERE id_usuario = ? en el update.
    // Por qué: El método original actualizaba sin verificar propiedad, permitiendo modificar compras ajenas.
    // Qué función tiene: Limita la actualización solo a compras del usuario especificado.
    // Para qué sirve: Evita que un usuario modifique datos de otros, manteniendo integridad y privacidad.
    public function actualizar($data, $id_usuario)
    {
        $this->db->set($data);
        $this->db->where('id_compra', $data['id_compra']);
        $this->db->where('id_usuario', $id_usuario);  // Filtro por usuario añadido
        return $this->db->update('compras');  // update() retorna true si afecta filas
    }

    /**
     * Método eliminar: Elimina una compra por ID, solo si pertenece al usuario.
     * @param int $pkid - ID de la compra a eliminar.
     * @param int $id_usuario - ID del usuario logueado.
     * @return bool - True si se eliminó.
     */
    // Cambio añadido: Añadido parámetro $id_usuario y filtro WHERE id_usuario = ? en el delete.
    // Por qué: El método original eliminaba sin verificar propiedad, permitiendo borrar compras ajenas.
    // Qué función tiene: Restringe la eliminación solo a compras del usuario.
    // Para qué sirve: Protege contra eliminación accidental o maliciosa de datos de otros usuarios.
    public function eliminar($pkid, $id_usuario)
    {
        $this->db->where('id_compra', $pkid);
        $this->db->where('id_usuario', $id_usuario);  // Filtro por usuario añadido
        return $this->db->delete('compras');  // delete() retorna true si éxito
    }

    // Nota: El método obtener_precio_por_id() fue removido y movido a Inventario_model para mejor organización.
    // Si necesitas algo específico aquí, agrégalo.
}