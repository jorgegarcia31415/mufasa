<?php
//defined('BASEPATH') or exit('No direct script access allowed');
class ventas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("ventas_model");
	}
	public function index()
	{
		$this->load->view('encabezado/menu');
		$list = array('compras'=>$this->ventas_model->obtener_compras_1());
		$this->load->view('ventas/lista', $list);	
	}
	public function edit($pk_id)
	{
		$datos = array('compras' =>$this->ventas_model->obtener_compras($pk_id));
		$this->load->view('compras/edit', $datos);
	}
	

	
	public function actualizar()
	{
		$data = array(
			'id_compra' => $_POST['id_compra'],
			'fecha' => $_POST['fecha'],
			'id_perfume' => $_POST['id_perfume'],
			'cantidad' => $_POST['cantidad'],
			'costo_unitario' => $_POST['costo_unitario'],
			'total' => $_POST['total']
		);
		$this->ventas_model->actualizar($data);
		echo "Actualizado exitosamente";
	}

	public function eliminar($pkid)
	{
		$this->ventas_model->eliminar($pkid);
		$this->index();
	}
	
}
