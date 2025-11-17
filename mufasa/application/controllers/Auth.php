<?php
// Esta línea es obligatoria en CodeIgniter para prevenir acceso directo a archivos del controlador.
// Si alguien intenta acceder directamente al archivo, muestra un error y detiene la ejecución.
defined('BASEPATH') OR exit('No direct script access allowed');

// Definimos la clase Auth, que extiende de CI_Controller (la clase base de CodeIgniter para controladores).
// Esta clase maneja toda la lógica de autenticación (login, registro, logout).
class Auth extends CI_Controller {

    // El constructor se ejecuta automáticamente cuando se crea una instancia de este controlador.
    // Aquí cargamos dependencias que se usan en todos los métodos de la clase.
    public function __construct()
    {
        // Llama al constructor padre (CI_Controller) para inicializar CodeIgniter correctamente.
        parent::__construct();
        
        // Carga el modelo 'usuario_model' para interactuar con la base de datos de usuarios.
        // Este modelo tiene métodos como get_by_email() para consultar usuarios.
        $this->load->model('usuario_model');
        
        // Carga la librería de sesiones de CodeIgniter, que maneja el almacenamiento de datos del usuario logueado
        // (como user_id y user_email) en cookies o archivos de sesión.
        $this->load->library('session');
        
        // Carga helpers (funciones auxiliares) para formularios (form) y URLs (url).
        // 'form' ayuda con validaciones y generación de formularios.
        // 'url' ayuda con la creación de enlaces seguros como site_url().
        $this->load->helper(array('form', 'url'));
    }

    // Método index(): Se ejecuta cuando accedes a /auth (por defecto en CodeIgniter).
    // Propósito: Mostrar el formulario de login al usuario.
    // No hace validaciones aquí; solo carga la vista.
    public function index()
    {
        // Carga y muestra la vista 'auth/login.php' (el formulario de login).
        // No pasa datos adicionales porque no hay errores iniciales.
        $this->load->view('auth/login');
    }

    // Método login(): Se ejecuta cuando se envía el formulario de login (POST a /auth/login).
    // Propósito: Procesar las credenciales del usuario y autenticarlo.
    public function login()
    {
        // Obtiene el email del formulario POST. Si no existe, será NULL.
        // Nota: Deberías agregar validación básica aquí para evitar inyecciones, pero form_validation lo maneja mejor.
        $email = $this->input->post('email');
        
        // Obtiene la contraseña del formulario POST (en texto plano).
        $password = $this->input->post('password');

        // Llama al modelo para buscar un usuario por email en la base de datos.
        // Retorna un objeto con los datos del usuario si existe, o NULL si no.
        $user = $this->usuario_model->get_by_email($email);

        // Verifica si el usuario existe Y si la contraseña coincide usando password_verify().
        // password_verify() compara el hash almacenado con la contraseña ingresada (seguro contra ataques).
        if ($user && password_verify($password, $user->password)) {
            // Si es válido, guarda datos en la sesión para mantener al usuario logueado.
            // 'user_id': ID único del usuario (para identificar en otras partes del sitio).
            // 'user_email': Email para mostrar en vistas (ej. "Bienvenido, email").
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('user_email', $user->email);

            // Redirige al controlador 'inventario' (método index() por defecto).
            // Esto genera la URL http://localhost/mufasa/inventario.
            // Si quieres cambiar a /inventario/inventario, usa: redirect('inventario/inventario');
            redirect('inventario/inventario');
        } else {
            // Si falla la autenticación, prepara un mensaje de error.
            // $data es un array que se pasa a la vista para mostrar el error.
            $data['error'] = "Email o contraseña incorrectos";
            
            // Recarga la vista de login, pero ahora con el mensaje de error disponible.
            // La vista usará <?php if (!empty($error)):
            $this->load->view('auth/login', $data);
        }
    }

    // Método register(): Se ejecuta cuando accedes a /auth/register.
    // Propósito: Mostrar el formulario de registro al usuario.
    // Similar a index(), pero para registro.
    public function register()
    {
        // Carga y muestra la vista 'auth/register.php' (formulario de registro).
        // No pasa datos iniciales.
        $this->load->view('auth/register');
    }

    // Método register_post(): Se ejecuta cuando se envía el formulario de registro (POST a /auth/register_post).
    // Propósito: Validar y procesar el nuevo usuario, guardarlo en BD, iniciar sesión y redirigir.
    public function register_post()
    {
        // Carga la librería de validación de formularios de CodeIgniter.
        // Esta librería verifica reglas automáticas y muestra errores.
        $this->load->library('form_validation');

        // Define reglas de validación para cada campo del formulario:
        // - 'email': Obligatorio, debe ser un email válido, y único en la tabla 'usuarios' (evita duplicados).
        // - 'password': Obligatorio, mínimo 6 caracteres (para seguridad).
        // - 'password_confirm': Obligatorio y debe coincidir con 'password' (verifica que no haya errores de tipeo).
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'required|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirmar Contraseña', 'required|matches[password]');

        // Ejecuta las validaciones. Si fallan (FALSE), muestra errores en la vista.
        // Si pasan (TRUE), continúa con el registro.
        if ($this->form_validation->run() == FALSE) {
            // Recarga la vista de registro con los errores automáticos (validation_errors() en la vista los muestra).
            $this->load->view('auth/register');
        } else {
            // Si validaciones OK, obtiene los datos limpios del formulario.
            $email = $this->input->post('email');
            
            // Encripta la contraseña usando password_hash() con algoritmo por defecto (BCRYPT).
            // Esto es seguro: no se guarda en texto plano, solo un hash irreversible.
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            // Prepara los datos para insertar en la base de datos (tabla 'usuarios').
            // Asume que tu tabla tiene columnas 'email' y 'password'.
            $data = [
                'email' => $email,
                'password' => $password
            ];

            // Inserta el nuevo usuario en la base de datos usando el objeto DB de CodeIgniter.
            // Si falla (ej. error de BD), CodeIgniter lo maneja, pero podrías agregar try-catch para más robustez.
            $this->db->insert('usuarios', $data);

            // Obtiene el ID del usuario recién insertado (útil para referencias futuras).
            // insert_id() es un método de CodeIgniter que devuelve el último ID auto-incremental.
            $user_id = $this->db->insert_id();

            // Inicia sesión automáticamente al nuevo usuario guardando en sesión.
            // Esto evita que tenga que loguearse manualmente después de registrarse.
            $this->session->set_userdata('user_id', $user_id);
            $this->session->set_userdata('user_email', $email);

            // Redirige a la ruta específica 'inventario/inventario'.
            // En CodeIgniter, esto genera http://localhost/mufasa/inventario/inventario.
            // Requiere que exista un método público 'inventario()' en el controlador Inventario.php.
            // Si no existe, CodeIgniter mostrará un error 404.
            redirect('inventario/inventario');
        }
    }

    // Método logout(): Se ejecuta cuando accedes a /auth/logout.
    // Propósito: Cerrar la sesión del usuario y redirigirlo al login.
    public function logout()
    {
        // Destruye completamente la sesión: elimina todos los datos (user_id, user_email, etc.).
        // Esto "desloguea" al usuario de forma segura.
        $this->session->sess_destroy();
        
        // Redirige de vuelta al formulario de login para que pueda iniciar sesión de nuevo.
        redirect('auth');
    }
}