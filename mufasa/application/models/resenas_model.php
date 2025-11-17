<?php
class resenas_model extends CI_Model
{
  public function guardar($resenas)
  {
    //Insertamos datos en la tabla resenas.
    $this->db->insert('resenas', $resenas);
  }
  public function obtener_resenas_1()
  {
    //Obtenemos los datos de la tabla resenas a traves de esta linea de código.
    return $this->db->get('resenas')->result(); 
  }
  public function obtener_resenas($id)
  {
    $this->db->where('id_resena', $id);
    return $this->db->get('resenas')->row();
  }
  public function actualizar()
  {
    $datos = array(
      'id_resena' => $_POST['id_resena'],
				'id_perfume' => $_POST['id_perfume'],
				'cliente' => $_POST['cliente'],
				'calificacion'=>$_POST['calificacion'],
				'comentario'=>$_POST['comentario'],
				'fecha'=>$_POST['fecha']
    );
    $this->db->set($datos);
    $this->db->where('id_resena', $datos['id_resena']);
    $this->db->update('resenas');
  }

  public function eliminar($pkid)
  {
    $this->db->where('id_resena', $pkid);
    $this->db->delete('resenas');
  }
}
