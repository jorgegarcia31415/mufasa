<?php
//defined('BASEPATH') or exit('No direct script access allowed');
class inventario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("inventario_model");
	}

	public function index()
{
    if (!$this->session->userdata('user_id')) {
        redirect('auth');
    }

    $list = array('inventario' => $this->inventario_model->obtener_inventario_1());
    $this->load->view('inventario/lista', $list);
} 

	public function edit($pk_id)
	{
		$datos = array('inventario' => $this->inventario_model->obtener_inventario($pk_id));
		$this->load->view('inventario/edit', $datos);
	}

	public function agregar()
	{			
		$this->load->view('inventario/añadir');
	}

	public function guardar()
	{
		$id = $_POST['id_movimiento'];
		if($this->inventario_model->obtener_inventario($id))
		{
			echo "Este movimiento ya existe";
		}
		else
		{
			$datos = array(
				'id_movimiento' => $_POST['id_movimiento'],
				'fecha' => $_POST['fecha'],
				'id_perfume' => $_POST['id_perfume'],
				'tipo' => $_POST['tipo'],
				'cantidad' => $_POST['cantidad'],
				'descripcion' => $_POST['descripcion']
			);
			$this->inventario_model->guardar($datos);
			echo "Registro exitosamente";
		}		
	}

	public function actualizar()
	{
		$data = array(
			'id_movimiento' => $_POST['id_movimiento'],
			'fecha' => $_POST['fecha'],
			'id_perfume' => $_POST['id_perfume'],
			'tipo' => $_POST['tipo'],
			'cantidad' => $_POST['cantidad'],
			'descripcion' => $_POST['descripcion']
		);
		$this->inventario_model->actualizar($data);
		echo "Actualizado exitosamente";
	}

	public function eliminar($pkid)
	{
		$this->inventario_model->eliminar($pkid);
		$this->index();
	}
}
