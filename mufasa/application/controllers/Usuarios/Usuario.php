<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct(){
		parent:: __construct();
    $this->load->model("Usuarios_model");

	}

  public function index()
	{
		$this->load->view('template/menu');
		$this->load->view('usuarios/añadir');
		$this->load->view('template/pie');   
	}

	public function add()
	{		
		$this->load->view('template/cabeza');
		$this->load->view('template/menu');
		$this->load->view('usuarios/add');
		$this->load->view('template/pie');
	}
	
	public function edit($usuario){

		$data  = array(
			'usuario' => $this->Usuarios_model->getUsuario($usuario), 
			
		);
		$this->load->view('template/cabeza');
		$this->load->view('template/menu');
		$this->load->view('usuarios/edit',$data);
		$this->load->view('template/pie');
	}
	
	public function guardar(){	
		$Id = $_POST['PKIdentidad'];
		$Us = $this->Usuarios_model->getUsuario($Id);
		if(isset($_POST['PKIdentidad']))
        {
            if($this->Usuarios_model->getUsuario($_POST['PKIdentidad'])){

				$this->session->set_flashdata('muse1', 'Ya existe este usuario.');
				redirect("usuarios/usuario/index");
			}
			else{
				$usuarios['PKIdentidad'] = $_POST['PKIdentidad'];
				$usuarios['Password'] = md5($_POST['Password']);
				$usuarios['Nombres'] = $_POST['Nombres'];
				$usuarios['Apellidos'] = $_POST['Apellidos'];
				$usuarios['Email'] = $_POST['Email'];
				$usuarios['Roles'] = $_POST['Roles'];
				$usuarios['FKCodigo_tblestados'] = 1;                    

				$this->load->model('Usuarios_model');
				$this->Usuarios_model->guardar($usuarios);
				$this->session->set_flashdata('muse', 'Usuario registrado exitosamente.');
				redirect(base_url()."usuarios/usuario/index");	
			}
										
		}                      
	}

public function actualizarUs(){

	$usuarios['PKIdentidad'] = $_POST['PKIdentidad'];
	$usuarios['Password'] = md5($_POST['Password']);
	$usuarios['Nombres'] = $_POST['Nombres'];
	$usuarios['Apellidos'] = $_POST['Apellidos'];
	$usuarios['Email'] = $_POST['Email'];
	$usuarios['Roles'] = $_POST['Roles'];
	$usuarios['FKCodigo_tblestados'] = 1;  
                            //print_r($usuarios);

	$this->load->model('Usuarios_model');
	$this->Usuarios_model->actualizarUsuarios($usuarios);
	redirect(base_url()."usuarios/usuario/index");
	

}

	  public function cambiarPassword($usuario){
	 
		$data  = array(
			'tblusuarios' => $this->Usuarios_model->getUsuario($usuario), 
			
		);
		
		$this->load->view('campass',$data);
		
	}

	 public function recuperarPassword(){	
		
		$this->load->view('repass');
		
	}

	public function restablecerPassword($usuario){

		$data  = array(
			'tblusuarios' => $this->Usuarios_model->getUsuario($usuario), );	
		
		$this->load->view('restPassword',$data);
		
	}

	public function actualizar(){

		$pas1 = md5($_POST['pas1']);
		$pas2 = md5($_POST['pas2']);
		if($pas1==$pas2){		
			$pasActual= md5 ($_POST['pasActual']);
			$usuario=$_POST['usuario'];
			$pass = $this->Usuarios_model->getUsuarioC($usuario);

			if ($pasActual==$pass->password) {
					
					$this->Usuarios_model->actualizar($pas1, $usuario);
					redirect(base_url().'welcome');
				}else{
						
					$this->session->set_flashdata("errorActualizar", "Lo sentimos!  La contraseña que ingresaste es incorrecta.");
			redirect(base_url().'usuarios/usuario/cambiarPassword/'.$_POST['usuario']);
				}
		}else{

			$this->session->set_flashdata("errorActualizar", "Lo sentimos!  Las contraseñas que ingresaste no coíciden.");
			redirect(base_url().'usuarios/usuario/cambiarPassword/'.$_POST['usuario']);
			
		}
	}

	public function actualizarRes(){

		$pas1 = md5($_POST['pas1']);
		$pas2 = md5($_POST['pas2']);
		if($pas1==$pas2){		
			$codigo= ($_POST['codigo']);
			$usuario=$_POST['usuario'];			
			$pass = $this->Usuarios_model->getUsuarioC($usuario, $codigo);

			$fecha = $pass->fecha;
			$fecha_actual = date('y-m-d H:i:s');
			$seconds = strtotime($fecha_actual) - strtotime($fecha);

			$minutos = $seconds /60;

            //print_r($minutos);

            if ($minutos <20) {
            	
            }

            else{
						
					$this->session->set_flashdata("error", "Lo sentimos!  el codigo de seguridad esta vencido
						vuelva enviar su cogigo de nuevo.");
			redirect(base_url().'usuarios/usuario/recuperarPassword/'.$_POST['usuario']);
				}

			if ($codigo==$pass->codigo) {
					
					$this->Usuarios_model->actualizarContraseñaRestablecida($pas1, $usuario);
					redirect(base_url('login'));
				}else{
						
					$this->session->set_flashdata("error", "Lo sentimos!  el codigo es incorrecto.");
			redirect(base_url().'usuarios/usuario/restablecerPassword/'.$_POST['usuario']);
				}
		}else{

			$this->session->set_flashdata("error", "Lo sentimos!  Las contraseñas que ingresaste no coíciden.");
			redirect(base_url().'usuarios/usuario/restablecerPassword/'.$_POST['usuario']);
		
		
		}


	}

	public function actualizarPass(){
       
		$usuario = ($_POST['usuario']);
		$mail = ($_POST['mail']);
		$codigo = $this->codigoRandom();
		
		$de= "soluciones@corparaiso.com";
		$asunto = 'Recuperacion de contraseña';
		$mensaje = 'Hola!' ." ". $usuario."   ".'has recibido éste correo con este codigo de seguridad:'." ".$codigo." ".'para restablecer su contraseña, Este codigo vence en 20 minutos'; 
		$encabezados= "from:"  . $de;

		$pass = $this->Usuarios_model->getUsuarioR($usuario, $mail);


        if ($usuario == $pass->usuario & $mail == $pass->mail ) {


		    $this->Usuarios_model->actualizarRestablecer( $codigo, $usuario );
		    
		     mail($mail, $asunto, $mensaje, $encabezados);
		    redirect(base_url().'usuarios/usuario/restablecerPassword/'.$_POST['usuario']);
	     
			
		 }else{

			$this->session->set_flashdata("error", "Lo sentimos!  Usuario o Correo son Invalidos.");
			redirect(base_url().'usuarios/usuario/recuperarPassword/');
		}

    }

    public function codigoRandom(){

    	$chars = "AB12CDEFG34HIJK56LMNOP78QRSTUV09WXYZ";
    	
    	$passw = "";

    	for ($i=0; $i<6; $i++) {

    	$num = rand(1, strlen($chars));
        
        $passw .=substr($chars, $num-6, 6);

    		return $passw;
    	}

    }



	public function eliminar($usuario)
	{

		$data  = array(
			'estado' => "0", 
		);
		$this->load->model('Usuarios_model');
		$this->Usuarios_model->actualizarEstado($usuario,$data);
		$this->index();
	}

	

}