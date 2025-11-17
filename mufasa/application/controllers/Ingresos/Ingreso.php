<?php
//defined('BASEPATH') or exit('No direct script access allowed');
class Ingreso extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Ingresos_model");
	}
	public function index()
	{
		$this->load->view('encabezado/menu');
		//obtenemos los datos que vienen del modelo.
		$list = array('ingresos' => $this->Ingresos_model->get_ingresos());
		$this->load->view('ingresos/lista', $list);
		//var_dump($list);
	}
	public function edit($pk_cod)
	{
		$datos ['ingresos'] = $this->Ingresos_model->get_ingreso($pk_cod);
		$datos ['medicos'] =$this->Ingresos_model->get_medico();
		$this->load->view('ingresos/edit', $datos);
	}
	
	public function agregar()
	{
		$data = array('medicos' => $this->Ingresos_model->get_medico());
		$data['horarios'] = $this->Ingresos_model->get_horarios();
		$this->load->view('ingresos/añadir', $data);
	}
	public function guardar()
	{
		$id = $_POST['fkcedula_paciente'];
		$nombre = $this->Ingresos_model->get_nombre_paciente($id);

		if ($nombre != null) {
			$data = array(
				'n_habitacion' => $_POST['n_habitacion'],
				'n_cama' => $_POST['n_cama'],
				'fkcedula_medico' => $_POST['fkcedula_medico'],
				'fkcedula_paciente' => $_POST['fkcedula_paciente'],
				'nombre_paciente' => $nombre,
				'fk_horarios' => $_POST['fk_horarios'],
				'fecha_ingreso' => $_POST['fecha_ingreso']
			);
			$this->Ingresos_model->guardar($data);
			echo '<script type="text/javascript">
				alert("registro exitosamente");
				window.location.href="index";
				</script>';
		} else {
			echo '<script type="text/javascript">
				alert("Este paciente no está registrado en la base de datos");
				window.location.href="agregar";
				</script>';
		}
	}
	public function actualizar()
	{
		$datos = array(
			'pkcodigo_i'=>$_POST['pkcodigo_i'],
			'n_habitacion'=>$_POST['n_habitacion'],
			'n_cama'=>$_POST['n_cama'],
			'fkcedula_medico'=>$_POST['fkcedula_medico'],
			'fk_horarios'=>$_POST['fk_horarios'],
			'fecha_ingreso'=>$_POST['fecha_ingreso']
		  );
		$this->Ingresos_model->actualizar($datos);
		echo '<script type="text/javascript">
				alert("Datos actualizados...");
				window.location.href="index";
				</script>';
	}
	public function eliminar($pkid)
	{
		$this->Ingresos_model->eliminar($pkid);
		$this->index();
	}

}