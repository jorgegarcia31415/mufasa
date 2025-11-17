<?php
class ventas_model extends CI_Model
{

  public function obtener_compras_1()
  {
    //Obtenemos los datos de la tabla ventas a traves de esta linea de código.
    return $this->db->get('compras')->result(); 
  }
  public function obtener_venta($id)
  {                                     
    $this->db->where('id_compra', $id);
    return $this->db->get('compras')->row();
  }
  public function actualizar()  
  {
    $datos = array(
      'id_compra' => $_POST['id_compra'],
      'fecha' => $_POST['fecha'],
      'id_perfume' => $_POST['id_perfume'],
      'cantidad' => $_POST['cantidad'],
      'costo_unitario' => $_POST['costo_unitario'],
      'total' => $_POST['total']
    );
    $this->db->set($datos);
    $this->db->where('id_compra', $datos['id_compra']);
    $this->db->update('compras');
  }

  public function eliminar($pkid)
  {
    $this->db->where('id_compra', $pkid);
    $this->db->delete('compras');
  }
}
