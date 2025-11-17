<?php
class devoluciones_model extends CI_Model
{
  public function guardar($devoluciones)
  {
    //Insertamos datos en la tabla devoluciones.
    $this->db->insert('devoluciones', $devoluciones);
  }
  public function obtener_devoluciones_1()
  {
    //Obtenemos los datos de la tabla devoluciones a traves de esta linea de código.
    return $this->db->get('devoluciones')->result(); 
  }
  public function obtener_devolucion($id)
  {
    $this->db->where('id_devolucion', $id);
    return $this->db->get('devoluciones')->row();
  }
  public function actualizar()
  {
    $datos = array(
      'id_devolucion' => $_POST['id_devolucion'],
      'id_venta' => $_POST['id_venta'],
      'id_perfume' => $_POST['id_perfume'],
      'fecha' => $_POST['fecha'],
      'motivo' => $_POST['motivo'],
      'cantidad' => $_POST['cantidad']
    );
    $this->db->set($datos);
    $this->db->where('id_devolucion', $datos['id_devolucion']);
    $this->db->update('devoluciones');
  }

  public function eliminar($pkid)
  {
    $this->db->where('id_devolucion', $pkid);
    $this->db->delete('devoluciones');
  }
}
