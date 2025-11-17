<?php
class perfumes_model extends CI_Model
{
  // Guarda un nuevo perfume en la base de datos
  public function guardar($data)
  {
    $this->db->insert('perfumes', $data);
  }

  // Obtiene todos los perfumes
  public function obtener_perfumes()
  {
    return $this->db->get('perfumes')->result();
  }

  // Obtiene un perfume por su id
  public function obtener_perfume($id)
  {
    $this->db->where('id_perfume', $id);
    return $this->db->get('perfumes')->row();
  }

  // Actualiza un perfume con datos del POST
  public function actualizar()
  {
    $data = array(
      'id_perfume' => $_POST['id_perfume'],
      'nombre' => $_POST['nombre'],
      'marca_id' => $_POST['marca_id'],
      'precio' => $_POST['precio'],
      'stock' => $_POST['stock']
    );

    $this->db->where('id_perfume', $data['id_perfume']);
    $this->db->update('perfumes', $data);
  }

  // Elimina un perfume por id
  public function eliminar($id)
  {
    $this->db->where('id_perfume', $id);
    $this->db->delete('perfumes');
  }

  // Nueva función para descontar stock cuando se realiza una compra
  public function descontar_stock($id_perfume, $cantidad)
  {
    // Obtener stock actual
    $this->db->select('stock');
    $this->db->where('id_perfume', $id_perfume);
    $perfume = $this->db->get('perfumes')->row();

    if ($perfume && $perfume->stock >= $cantidad) {
      // Calcular nuevo stock
      $nuevo_stock = $perfume->stock - $cantidad;

      // Actualizar stock en la base de datos
      $this->db->where('id_perfume', $id_perfume);
      $this->db->update('perfumes', ['stock' => $nuevo_stock]);

      return true;  // Éxito
    } else {
      return false; // Stock insuficiente o perfume no encontrado
    }
  }
}
