<?php
//defined('BASEPATH') or exit('No direct script access allowed');
class resenas extends CI_Controller

{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("resenas_model");
	}
	public function index()
	{
		//obtenemos los datos que vienen del modelo.
		$list = array('resenas'=>$this->resenas_model->obtener_resenas_1());
		$this->load->view('resenas/lista', $list);	
	}
	public function edit($pk_id)
	{
		$datos = array('resenas' =>$this->resenas_model->obtener_resenas($pk_id));
		$this->load->view('resenas/edit', $datos);
	}
	public function agregar()
	{			
		$this->load->view('resenas/añadir');
	}
	public function guardar()
	{
		$id = $_POST['id_resena'];
		if($this->resenas_model->obtener_resenas($id))
		{
			echo "Esta reseña ya existe";
			//redirect('resenas/agregar');
		}
		else
		{
			$datos = array(
				'id_resena' => $_POST['id_resena'],
				'id_perfume' => $_POST['id_perfume'],
				'cliente' => $_POST['cliente'],
				'calificacion'=>$_POST['calificacion'],
				'comentario'=>$_POST['comentario'],
				'fecha'=>$_POST['fecha']
			);
			$this->resenas_model->guardar($datos);
			echo "Registro exitosamente";
		}		
	}
	
	public function actualizar()
	{
		$data = array(
			'id_resena' => $_POST['id_resena'],
				'id_perfume' => $_POST['id_perfume'],
				'cliente' => $_POST['cliente'],
				'calificacion'=>$_POST['calificacion'],
				'comentario'=>$_POST['comentario'],
				'fecha'=>$_POST['fecha']
		);
		$this->resenas_model->actualizar($data);
		echo "Actualizado exitosamente";
	}

	public function eliminar($pkid)
	{
		$this->resenas_model->eliminar($pkid);
		$this->index();
	}
	
}