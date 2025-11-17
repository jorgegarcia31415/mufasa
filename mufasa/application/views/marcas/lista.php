<?php
// Asegúrate de que el helper 'url' esté cargado en autoload.php
// $autoload['helper'] = array('url');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Marcas - Lista</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body, html {
      height: 100%;
      margin: 0;
      background-color: #f9f9f9;
      position: relative;
    }

    .logo {
      position: absolute;
      top: 15px;
      right: 25px;
      width: 120px;
      height: auto;
      object-fit: contain;
      box-shadow: 0 2px 8px rgba(0,0,0,0.25);
      background-color: transparent;
      z-index: 1000;
    }

    .main-container {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .sidebar {
      width: 220px;
      background-color: #fff;
      border-right: 1px solid #ddd;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }

    .sidebar a {
      padding: 10px 15px;
      margin-bottom: 8px;
      color: #333;
      font-weight: 600;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #007bff;
      color: white;
    }

    .sidebar a.logout {
      color: #dc3545;
      margin-top: auto;
    }

    .sidebar a.logout:hover {
      background-color: #dc3545;
      color: white;
    }

    .content {
      flex-grow: 1;
      overflow-y: auto;
      padding: 20px 30px;
    }

    .card-marca {
      border: 1px solid #ddd;
      border-radius: 8px;
      background: white;
      padding: 15px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
      transition: box-shadow 0.3s ease, transform 0.2s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      cursor: pointer;
    }

    .card-marca:hover {
      box-shadow: 0 5px 15px rgba(0,0,0,0.15);
      transform: scale(1.03);
    }

    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: contain;
      margin-bottom: 15px;
    }

    .card-title {
      font-weight: 700;
      font-size: 1.4rem;
      color: #222;
      margin-bottom: 8px;
      text-align: center;
    }

    .search-container {
      display: flex;
      margin-bottom: 20px;
      gap: 10px;
    }

    /* Pantalla de carga */
    .loading-modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: white;
      z-index: 9999;
      justify-content: center;
      align-items: center;
    }

    .loading-content {
      text-align: center;
    }

    .loading-gif {
      width: 200px;
      height: auto;
    }

  </style>
</head>
<body>
  

  <!-- 🔹 Logo original sin tocar -->
  <img src="<?php echo base_url('imagenes/leon.jpg'); ?>" alt="Logo" class="logo" />

  <div class="main-container">
    <!-- Menú lateral -->
    <nav class="sidebar">
      <a href="<?php echo base_url('index.php/menu'); ?>">Menú</a>
      <a href="<?php echo base_url('marcas/marcas'); ?>" class="active">Marcas</a>
      <a href="<?php echo base_url('resenas/resenas'); ?>">Reseñas</a>
      <a href="<?php echo base_url('inventario/inventario'); ?>">Inventario</a>

      <a href="<?php echo base_url('devoluciones/devoluciones'); ?>">Devoluciones</a>

      <a href="<?php echo base_url('compras/compras'); ?>">Compras</a>

      <?php if ($this->session->userdata('user_id')): ?>
        <?php 
          $display_name = $this->session->userdata('user_name') ?: $this->session->userdata('user_email');
        ?>
        <div style="margin-top: 20px; padding: 10px; background-color: #f8f9fa; border-radius: 5px; font-size: 0.9em;">
          <strong>Usuario:</strong> <?php echo htmlspecialchars($display_name); ?>
        </div>
        <a href="<?php echo base_url('auth/logout'); ?>" class="logout" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?');">
          Cerrar Sesión
        </a>
      <?php else: ?>
        <a href="<?php echo base_url('auth'); ?>" class="logout">Iniciar Sesión</a>
      <?php endif; ?>
    </nav>

    <!-- Contenido principal -->
    <div class="content">
      <h2 class="mb-4 fw-bold text-primary">Lista de Marcas</h2>

      <!-- Barra de búsqueda -->
      <div class="search-container">
        <input type="text" id="buscar" class="form-control" placeholder="Buscar marca...">
        <button id="limpiar" class="btn btn-outline-secondary">Limpiar</button>
      </div>

      <div class="row g-4" id="lista-marcas">
        <?php foreach ($marcas as $m): ?>
          <?php 
            $nombre = strtolower(trim($m->nombre));
            $imagen = 'leon.jpg'; // por defecto

            if (strpos($nombre, 'chanel') !== false) {
              $imagen = 'chanel.png';
            } elseif (strpos($nombre, 'dior') !== false) {
              $imagen = 'dior.png';
            } elseif (strpos($nombre, 'dolce') !== false) {
              $imagen = 'dolce.png';
            } elseif (strpos($nombre, 'carolina') !== false) {
              $imagen = 'carolina.png';
            } elseif (strpos($nombre, 'calvin') !== false) {
              $imagen = 'calvin.png';
            } elseif (strpos($nombre, 'boss') !== false) {
              $imagen = 'boss.png';
            }
          ?>
          <div class="col-6 col-md-4 col-lg-3 marca-item">
            <div class="card-marca" onclick="redirigirInventario('<?php echo urlencode($m->nombre); ?>')">
                <img src="<?php echo base_url('imagenes/' . $imagen); ?>" alt="Imagen Marca" class="card-img-top">
                <div>
                <h3 class="card-title"><?php echo ucfirst($m->nombre); ?></h3>
                <p class="text-center text-muted">ID: <?php echo $m->id_marca; ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Modal de pantalla de carga -->
  <div class="loading-modal" id="loadingModal">
    <div class="loading-content">
      <img src="https://www.gifsanimados.org/data/media/1322/leon-imagen-animada-0026.gif" alt="Cargando..." class="loading-gif">
    </div>
  </div>

  <script>
    // Búsqueda en tiempo real
    document.getElementById("buscar").addEventListener("keyup", function() {
      const filtro = this.value.toLowerCase();
      const items = document.querySelectorAll(".marca-item");
      items.forEach(item => {
        const texto = item.textContent.toLowerCase();
        item.style.display = texto.includes(filtro) ? "" : "none";
      });
    });

    // Botón limpiar
    document.getElementById("limpiar").addEventListener("click", function() {
      document.getElementById("buscar").value = "";
      const items = document.querySelectorAll(".marca-item");
      items.forEach(item => item.style.display = "");
    });

    // 🔹 Redirige a inventario con búsqueda automática
    function redirigirInventario(nombreMarca) {
      window.location.href = "<?php echo base_url('inventario/inventario?buscar='); ?>" + nombreMarca;
    }

    // Pantalla de carga para navegación
    const sidebarLinks = document.querySelectorAll('.sidebar a:not(.logout)');
    const loadingModal = document.getElementById('loadingModal');

    sidebarLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');

        // Mostrar modal de carga
        loadingModal.style.display = 'flex';

        // Redirigir después de 2 segundos
        setTimeout(() => {
          window.location.href = href;
        }, 2000);
      });
    });
  </script>
  <!-- Modal de pantalla de carga (actualizado: texto simplificado) -->
<div class="loading-modal" id="loadingModalVista">
    <div class="loading-content">
        <!-- Para producción: src="<?php echo base_url('imagenes/leon-loading.gif'); ?>" -->
        <img src="https://www.gifsanimados.org/data/media/1322/leon-imagen-animada-0026.gif" alt="Cargando... 🦁" class="loading-gif">
        <p class="loading-text">Cargando</p>
    </div>
</div>

<style>
    /* Estilos para el modal en esta vista (o muévelos a un CSS global como styles.css) */
    .loading-modal {
        display: none; /* Inicialmente oculto */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(210, 180, 140, 0.9); /* Fondo "sabana" temático */
        z-index: 9999;
        justify-content: center;
        align-items: center;
        transition: opacity 0.5s ease; /* Fade suave */
        opacity: 1;
    }

    .loading-modal.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .loading-content {
        text-align: center;
    }

    .loading-gif {
        width: 200px;
        height: auto;
        border-radius: 10px; /* Opcional: bordes redondeados */
    }

    .loading-text {
        color: #8B4513; /* Marrón safari */
        margin-top: 10px;
        font-size: 1.2rem;
        font-weight: bold;
    }
</style>

<script>
    // JS para mostrar/ocultar el modal al cargar esta vista
    function initLoadingModal() {
        const loadingModal = document.getElementById('loadingModalVista');
        if (!loadingModal) return; // Si no existe, no hace nada

        // Mostrar modal al cargar la página
        loadingModal.style.display = 'flex';

        // Ocultar después de 1.5 segundos (ajusta si quieres más tiempo)
        setTimeout(() => {
            loadingModal.classList.add('hidden');
            setTimeout(() => {
                loadingModal.style.display = 'none';
            }, 500); // Tiempo del fade-out
        }, 1500);
    }

    // Ejecutar cuando el DOM esté listo (más rápido que 'load')
    document.addEventListener('DOMContentLoaded', initLoadingModal);

    // Opcional: Si la página tiene contenido dinámico (AJAX), llama initLoadingModal() cuando termines de cargar
</script>
</body>

</html>
