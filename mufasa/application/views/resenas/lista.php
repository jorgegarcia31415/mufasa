<?php
// Asegúrate de que el helper 'url' esté cargado en autoload.php
// $autoload['helper'] = array('url');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reseñas - Lista</title>

  <!-- Bootstrap 5.3.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  
  <!-- Bootstrap Icons para estrellas y lupa -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  
  <style>
    body, html {
      height: 100%;
      margin: 0;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      position: relative;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
      border-radius: 8px;
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
      box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    }

    .sidebar a {
      padding: 10px 15px;
      margin-bottom: 8px;
      color: #333;
      font-weight: 600;
      text-decoration: none;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #007bff;
      color: white;
      transform: translateX(5px);
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

    /* Cards de reseñas: Horizontales, modernas */
    .card-reseña {
      border: none;
      border-radius: 15px;
      background: white;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      overflow: hidden;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      height: 120px; /* Altura fija para uniformidad */
    }

    .card-reseña:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .card-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 10px 0 0 10px;
      background: #f8f9fa;
    }

    .card-body {
      padding: 15px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .reseña-title {
      font-weight: 700;
      font-size: 1.2rem;
      color: #222;
      margin-bottom: 5px;
    }

    .reseña-meta {
      font-size: 0.9rem;
      color: #6c757d;
      margin-bottom: 8px;
    }

    /* Estrellas de calificación: Dinámicas */
    .stars {
      color: #ffc107; /* Dorado */
      font-size: 1.1rem;
    }

    .stars .bi-star-fill {
      color: #ffc107;
    }

    .stars .bi-star {
      color: #dee2e6; /* Gris para vacías */
    }

    .comentario {
      font-style: italic;
      color: #495057;
      font-size: 0.95rem;
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 2; /* Truncar a 2 líneas */
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .fecha {
      font-size: 0.85rem;
      color: #6c757d;
      text-align: right;
    }

    /* Barra de búsqueda y botón nueva */
    .header-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .btn-nueva {
      background: linear-gradient(45deg, #28a745, #20c997);
      border: none;
      color: white;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
    }

    .btn-nueva:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(40, 167, 69, 0.4);
      color: white;
    }

    .search-bar {
      position: relative;
      max-width: 400px;
    }

    .search-bar input {
      border-radius: 25px;
      padding: 10px 15px 10px 40px;
      border: 2px solid #e9ecef;
      transition: border-color 0.3s ease;
    }

    .search-bar input:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }

    .search-bar i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
    }

    /* No reseñas */
    .no-reseñas {
      text-align: center;
      padding: 50px;
      color: #6c757d;
    }

    .no-reseñas i {
      font-size: 4rem;
      margin-bottom: 20px;
      opacity: 0.5;
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

  <!-- Logo en esquina superior derecha -->
  <img src="<?php echo base_url('imagenes/leon.jpg'); ?>" alt="Logo" class="logo" />

  <div class="main-container">
    <!-- Menú lateral (igual que en inventario, active en Reseñas) -->
    <nav class="sidebar">
      <a href="<?php echo base_url('index.php/menu'); ?>">Menú</a>
      <a href="<?php echo base_url('marcas/marcas'); ?>">Marcas</a>
      <a href="<?php echo base_url('resenas/resenas'); ?>" class="active">Reseñas</a>
      <a href="<?php echo base_url('inventario/inventario'); ?>">Inventario</a>
      <a href="<?php echo base_url('devoluciones/devoluciones'); ?>">Devoluciones</a>

      <a href="<?php echo base_url('compras/compras'); ?>">Compras</a>

      <?php if ($this->session->userdata('user_id')): ?>
        <?php $display_name = $this->session->userdata('user_name') ?: $this->session->userdata('user_email'); ?>
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
      <h2 class="mb-4 fw-bold text-primary">Lista de Reseñas</h2>

      <!-- Header: Botón nueva + búsqueda -->
      <div class="header-actions">
        <a href="<?php echo base_url('resenas/resenas/agregar'); ?>" class="btn btn-nueva">
          <i class="bi bi-plus-circle me-2"></i>Nueva Reseña
        </a>
        <div class="search-bar">
          <i class="bi bi-search"></i>
          <input type="text" id="buscar" class="form-control" placeholder="Buscar por cliente, perfume o comentario...">
        </div>
      </div>

      <!-- Grid de cards -->
      <div class="row g-4" id="lista-reseñas">
        <?php if (isset($resenas) && !empty($resenas)): ?>
          <?php foreach ($resenas as $m): ?>
            <?php 
              // Imagen por defecto o por id_perfume (expande como en inventario)
              $imagen = 'leon.jpg';
              if ($m->id_perfume == 1) $imagen = 'Invictus.jpg';
              elseif ($m->id_perfume == 2) $imagen = 'Sauvage.jpg';

              // Formatear fecha (ej. "15 Oct 2024")
              $fecha = date('d M Y', strtotime($m->fecha));

              // Generar estrellas (calificacion 1-5)
              $estrellas = '';
              for ($i = 1; $i <= 5; $i++) {
                $estrellas .= ($i <= $m->calificacion) ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
              }
            ?>
            <div class="col-12 col-md-6 col-lg-6 reseña-item">
              <div class="card-reseña">
                <img src="<?php echo base_url('imagenes/' . $imagen); ?>" alt="Perfume" class="card-img" />
                <div class="card-body">
                  <div>
                    <h5 class="reseña-title">Reseña #<?php echo $m->id_resena ?> - Perfume ID: <?php echo $m->id_perfume ?></h5>
                    <p class="reseña-meta"><strong>Cliente:</strong> <?php echo htmlspecialchars($m->cliente); ?></p>
                    <div class="stars mb-2"><?php echo $estrellas; ?> (<?php echo $m->calificacion ?>/5)</div>
                    <p class="comentario"><?php echo htmlspecialchars(substr($m->comentario, 0, 100)) . (strlen($m->comentario) > 100 ? '...' : ''); ?></p>
                  </div>
                  <p class="fecha"><?php echo $fecha; ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <!-- No hay reseñas -->
          <div class="col-12">
            <div class="no-reseñas">
              <i class="bi bi-chat-quote"></i>
              <h4>No hay reseñas disponibles</h4>
              <p>¡Sé el primero en compartir tu opinión!</p>
              <a href="<?php echo base_url('resenas/resenas/agregar'); ?>" class="btn btn-nueva">Agregar Reseña</a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Modal de pantalla de carga -->
  <div class="loading-modal" id="loadingModal">
    <div class="loading-content">
      <img src="https://www.gifsanimados.org/data/media/1322/leon-imagen-animada-0026.gif" alt="Cargando..." class="loading-gif">
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
    // Búsqueda en tiempo real (igual que en inventario)
    document.addEventListener('DOMContentLoaded', function() {
      const input = document.getElementById('buscar');
      const items = document.querySelectorAll('.reseña-item');

      // Pre-filtrar si hay ?buscar= en URL
      const params = new URLSearchParams(window.location.search);
      const buscarParam = params.get('buscar');
      if (buscarParam) {
        input.value = buscarParam;
        filtrar();
      }

      input.addEventListener('input', filtrar);

      function filtrar() {
        const valor = input.value.toLowerCase().trim();
        items.forEach(item => {
          const texto = item.textContent.toLowerCase();
          item.style.display = texto.includes(valor) ? '' : 'none';
        });
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
