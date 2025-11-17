<?php
class marcas_model extends CI_Model
{
  public function guardar($marcas)
  {
    //Insertamos datos en la tabla marcas.
    $this->db->insert('marcas', $marcas);
  }
  public function obtener_marcas_1()
  {
    //Obtenemos los datos de la tabla marcas a traves de esta linea de código.
    return $this->db->get('marcas')->result(); 
  }
  public function obtener_marcas($id)
  {
    $this->db->where('id_marca', $id);
    return $this->db->get('marcas')->row();
  }
  public function actualizar()
  {
    $datos = array(
      'id_marca'=>$_POST['id_marca'],
      'nombre'=>$_POST['nombre']
    );
    $this->db->set($datos);
    $this->db->where('id_marca', $datos['id_marca']);
    $this->db->update('marcas');
  }

  public function eliminar($pkid)
  {
    $this->db->where('id_marca', $pkid);
    $this->db->delete('marcas');
  }
}
