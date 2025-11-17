<?php
class Ingresos_model extends CI_Model
{
  public function guardar($ingreso)
  {
    //Insertamos datos en la tabla tblingresos.
    $this->db->insert('tblingresos', $ingreso);
  }
 public function get_nombre_paciente($id)
 {
    $this->db->select('nombres');
    $this->db->where('pkcedula', $id);
    $query = $this->db->get('tblpacientes');
    if($query->num_rows()>0)
    {
        return $query->row()->nombres;
    }else
    {
        return null;
    }
 }
 public function get_ingresos()
  {
     $result = $this->db->query("select * from tblingresos i join tblmedicos m on i.fkcedula_medico = m.pkcedula 
     join tblhorarios h on i.fk_horarios = h.pkcodigo");
     return $result->result();
  }
  public function get_ingreso($id)
  {
     $result = $this->db->query("select * from tblingresos i join tblmedicos m on i.fkcedula_medico = m.pkcedula 
     join tblhorarios h on i.fk_horarios = h.pkcodigo where i.pkcodigo_i = $id");
     return $result->row();
  }
  
  public function get_medico()
  {
     $result = $this->db->query("select pkcedula, nombres from tblmedicos");
     return $result->result();
  }
  public function get_horarios()
  {
     $result = $this->db->query("select pkcodigo, descripcion from tblhorarios");
     return $result->result();
  }
  public function actualizar()
  {
    $datos = array(
      'pkcodigo_i'=>$_POST['pkcodigo_i'],
      'n_habitacion'=>$_POST['n_habitacion'],
      'n_cama'=>$_POST['n_cama'],
      'fkcedula_medico'=>$_POST['fkcedula_medico'],
      'fk_horarios'=>$_POST['fk_horarios'],
      //'direccion'=>$_POST['direccion'],
      'fecha_ingreso'=>$_POST['fecha_ingreso']
    );
    $this->db->set($datos);
    $this->db->where('pkcodigo_i', $datos['pkcodigo_i']);
    $this->db->update('tblingresos');
  }

  public function eliminar($pkid)
  {
    $this->db->where('pkcodigo_i', $pkid);
    $this->db->delete('tblingresos');
  }
}

