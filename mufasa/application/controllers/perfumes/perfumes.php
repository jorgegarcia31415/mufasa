<?php
class perfumes extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("perfumes_model");
  }

  public function index()
  {
    $this->load->view('encabezado/menu');
    $data = array('perfumes' => $this->perfumes_model->obtener_perfumes());
    $this->load->view('perfumes/lista', $data);
  }

  public function agregar()
  {
    $this->load->view('perfumes/añadir');
  }

  public function guardar()
  {
    $id = $_POST['id_perfume'];
    if ($this->perfumes_model->obtener_perfume($id)) {
      echo "Este perfume ya existe";
    } else {
      $data = array(
        'id_perfume' => $_POST['id_perfume'],
        'nombre' => $_POST['nombre'],
        'marca_id' => $_POST['marca_id'],
        'precio' => $_POST['precio'],
        'stock' => $_POST['stock']
      );
      $this->perfumes_model->guardar($data);
      echo "Registrado exitosamente";
    }
  }

  public function edit($id)
  {
    $data = array('perfumes' => $this->perfumes_model->obtener_perfume($id));
    $this->load->view('perfumes/edit', $data);
  }

  public function actualizar()
  {
    $this->perfumes_model->actualizar();
    echo "Actualizado exitosamente";
  }

  public function eliminar($id)
  {
    $this->perfumes_model->eliminar($id);
    $this->index();
  }

  // Función añadida para obtener precio por id_perfume
  public function obtener_precio($id_perfume)
  {
    $perfume = $this->perfumes_model->obtener_perfume($id_perfume);
    if ($perfume) {
      echo json_encode(['precio' => $perfume->precio]);
    } else {
      echo json_encode([]);
    }
  }
}
