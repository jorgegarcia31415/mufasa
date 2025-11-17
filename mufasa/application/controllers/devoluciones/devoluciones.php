<?php
//defined('BASEPATH') or exit('No direct script access allowed');
class devoluciones extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("devoluciones_model");
	}
	public function index()
	{

		//obtenemos los datos que vienen del modelo.
		$list = array('devoluciones'=>$this->devoluciones_model->obtener_devoluciones_1());
		$this->load->view('devoluciones/lista', $list);	
	}
	public function edit($pk_id)
	{
		$datos = array('devoluciones' =>$this->devoluciones_model->obtener_devolucion($pk_id));
		$this->load->view('devoluciones/edit', $datos);
	}
	public function anadir()
	{			
		$this->load->view('devoluciones/añadir');
	}
	public function guardar()
	{
		$id = $_POST['id_devolucion'];
		if($this->devoluciones_model->obtener_devolucion($id))
		{
			echo "Esta devolución ya existe";
			//redirect('devoluciones/anadir');
		}
		else
		{
			$datos = array(
				'id_devolucion' => $_POST['id_devolucion'],
				'id_venta' => $_POST['id_venta'],
				'id_perfume' => $_POST['id_perfume'],
				'fecha' => $_POST['fecha'],
				'motivo' => $_POST['motivo'],
				'cantidad' => $_POST['cantidad']
			);
			$this->devoluciones_model->guardar($datos);
			echo "Registro exitosamente";
		}		
	}
	
	public function actualizar()
	{
		$data = array(
			'id_devolucion' => $_POST['id_devolucion'],
			'id_venta' => $_POST['id_venta'],
			'id_perfume' => $_POST['id_perfume'],
			'fecha' => $_POST['fecha'],
			'motivo' => $_POST['motivo'],
			'cantidad' => $_POST['cantidad']
		);
		$this->devoluciones_model->actualizar($data);
		echo "Actualizado exitosamente";
	}

	public function eliminar($pkid)
	{
		$this->devoluciones_model->eliminar($pkid);
		$this->index();
	}
	
}
