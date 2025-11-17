<?php
//defined('BASEPATH') or exit('No direct script access allowed');
class marcas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("marcas_model");
	}
	public function index()
	{
		
		//obtenemos los datos que vienen del modelo.
		$list = array('marcas'=>$this->marcas_model->obtener_marcas_1());
		$this->load->view('marcas/lista', $list);	
	}
	public function edit($pk_id)
	{
		$datos = array('marcas' =>$this->marcas_model->obtener_marcas($pk_id));
		$this->load->view('marcas/edit', $datos);
	}
	public function agregar()
	{			
		$this->load->view('marcas/añadir');
	}
	public function guardar()
	{
		$id = $_POST['id_marca'];
		if($this->marcas_model->obtener_marcas($id))
		{
			echo "Esta marca ya existe";
			//redirect('marcas/agregar');
		}
		else
		{
			$datos = array(
				'id_marca' => $_POST['id_marca'],
				'nombre' => $_POST['nombre']
			);
			$this->marcas_model->guardar($datos);
			echo "Registro exitosamente";
		}		
	}
	
	public function actualizar()
	{
		$data = array(
			'id_marca' => $_POST['id_marca'],
				'nombre' => $_POST['nombre']
		);
		$this->marcas_model->actualizar($data);
		echo "Actualizado exitosamente";
	}

	public function eliminar($pkid)
	{
		$this->marcas_model->eliminar($pkid);
		$this->index();
	}
	
}