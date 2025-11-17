<?php
// Asegúrate de que el helper 'url' esté cargado en autoload.php
// $autoload['helper'] = array('url');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar Sesión - Perfumes App</title>

  <!-- Bootstrap 5.3.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  
  <!-- Bootstrap Icons para iconos en inputs -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  
  <style>
    /* Fondo con gradiente sutil para estética moderna */
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 20px;
    }

    /* Contenedor principal: Card centrada con sombra */
    .login-container {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      padding: 0;
      width: 100%;
      max-width: 400px;
      overflow: hidden;
    }

    /* Header con logo */
    .login-header {
      background: linear-gradient(45deg, #007bff, #0056b3);
      color: white;
      text-align: center;
      padding: 30px 20px;
    }

    /* Logo: Centrado y con margen */
    .login-logo {
      width: 80px;
      height: 80px;
      object-fit: contain;
      margin-bottom: 15px;
      border-radius: 50%;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Título del header */
    .login-title {
      font-size: 1.5rem;
      font-weight: 600;
      margin: 0;
    }

    /* Formulario: Padding y espaciado */
    .login-form {
      padding: 30px 40px;
    }

    /* Labels: Negrita y espaciado */
    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
    }

    /* Inputs: Bordes redondeados, iconos, transiciones */
    .form-control {
      border-radius: 10px;
      border: 2px solid #e9ecef;
      padding: 12px 15px 12px 45px; /* Espacio para icono */
      font-size: 1rem;
      transition: all 0.3s ease;
      background-color: #f8f9fa;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
      background-color: white;
      transform: translateY(-2px); /* Efecto lift sutil */
    }

    /* Iconos en inputs (position absolute) */
    .input-group-text {
      background: transparent;
      border: none;
      color: #6c757d;
      padding-left: 0;
    }

    /* Checkbox "Recordarme": Estilizado */
    .form-check-input:checked {
      background-color: #007bff;
      border-color: #007bff;
    }

    /* Botón submit: Gradiente, hover, y sombra */
    .btn-login {
      background: linear-gradient(45deg, #007bff, #0056b3);
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 600;
      font-size: 1.1rem;
      width: 100%;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
      background: linear-gradient(45deg, #0056b3, #004085);
    }

    /* Alertas de error: Estilo Bootstrap con margen */
    .alert {
      border-radius: 10px;
      border: none;
      margin-bottom: 20px;
    }

    /* Enlace a registro: Centrado, con hover */
    .register-link {
      text-align: center;
      margin-top: 20px;
      padding-top: 20px;
      border-top: 1px solid #e9ecef;
    }

    .register-link a {
      color: #007bff;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .register-link a:hover {
      color: #0056b3;
      text-decoration: underline;
    }

    /* Footer sutil (opcional) */
    .login-footer {
      text-align: center;
      padding: 15px;
      background: #f8f9fa;
      color: #6c757d;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <!-- Header con logo y título -->
    <div class="login-header">
      <img src="<?php echo base_url('imagenes/leon.jpg'); ?>" alt="Logo Perfumes" class="login-logo" />
      <h1 class="login-title">Bienvenido</h1>
      <p class="mb-0 opacity-75">Inicia sesión en tu cuenta</p>
    </div>

    <!-- Formulario de login -->
    <form action="<?php echo site_url('auth/login'); ?>" method="POST" class="login-form">
      <?php if (isset($error)): ?>
        <!-- Alerta de error personalizada -->
        <div class="alert alert-danger" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <!-- Errores de validación de CodeIgniter -->
      <?php echo validation_errors('<div class="alert alert-danger" role="alert"><i class="bi bi-exclamation-triangle-fill me-2"></i>', '</div>'); ?>

      <!-- Campo Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-envelope"></i></span>
          <input type="email" 
                 class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>" 
                 id="email" 
                 name="email" 
                 value="<?php echo set_value('email'); ?>" 
                 placeholder="tu@email.com" 
                 required 
                 aria-describedby="emailHelp" />
          <?php if (form_error('email')): ?>
            <div class="invalid-feedback"><?php echo form_error('email'); ?></div>
          <?php endif; ?>
        </div>
        <div class="form-text">Usa tu email registrado.</div>
      </div>

      <!-- Campo Password -->
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" 
                 class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" 
                 id="password" 
                 name="password" 
                 placeholder="Tu contraseña" 
                 required />
          <?php if (form_error('password')): ?>
            <div class="invalid-feedback"><?php echo form_error('password'); ?></div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Checkbox "Recordarme" (para sesiones persistentes) -->
      <div class="mb-4">
        <div class="form-check">
          <input class="form-check-input" 
                 type="checkbox" 
                 id="remember_me" 
                 name="remember_me" 
                 value="1" 
                 <?php echo set_checkbox('remember_me', '1'); ?> />
          <label class="form-check-label" for="remember_me">
            <i class="bi bi-check-circle me-2"></i>Recordarme (mantener sesión abierta)
          </label>
        </div>
      </div>

      <!-- Botón Submit -->
      <button type="submit" class="btn btn-primary btn-login mb-3">
        <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
      </button>
    </form>

    <!-- Enlace a registro -->
    <div class="register-link">
      <p>¿No tienes cuenta? <a href="<?php echo site_url('auth/register'); ?>">Regístrate aquí</a></p>
    </div>

    <!-- Footer opcional -->
    <div class="login-footer">
      <small>&copy; 2024 Perfumes App. Todos los derechos reservados.</small>
    </div>
  </div>

  <!-- Bootstrap 5.3.3 JS (para validación y tooltips si es necesario) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
  <script>
    // Opcional: Animación de carga en submit (spinner)
    document.querySelector('form').addEventListener('submit', function() {
      const btn = this.querySelector('.btn-login');
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Iniciando...';
      btn.disabled = true;
    });

    // Opcional: Mostrar/ocultar contraseña (agrega ojo en input password)
    // Si quieres, agrega: <span class="input-group-text cursor-pointer" onclick="togglePassword()"> <i class="bi bi-eye"></i> </span>
    // Y función JS: function togglePassword() { ... }
  </script>
</body>
</html>