<?php
// Asegúrate de que el helper 'url' esté cargado en autoload.php
// $autoload['helper'] = array('url');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Devoluciones - Lista</title>

  <!-- Bootstrap 5.3.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
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
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.25);
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

    .card-devolucion {
      border: none;
      border-radius: 15px;
      background: white;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      overflow: hidden;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      height: 140px;
    }

    .card-devolucion:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .card-img {
      width: 110px;
      height: 110px;
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

    .titulo {
      font-weight: 700;
      font-size: 1.2rem;
      color: #222;
      margin-bottom: 5px;
    }

    .meta {
      font-size: 0.9rem;
      color: #6c757d;
      margin-bottom: 8px;
    }

    .motivo {
      font-style: italic;
      color: #495057;
      font-size: 0.95rem;
      line-height: 1.4;
    }

    .fecha {
      font-size: 0.85rem;
      color: #6c757d;
      text-align: right;
    }

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

    .no-devoluciones {
      text-align: center;
      padding: 50px;
      color: #6c757d;
    }

    .no-devoluciones i {
      font-size: 4rem;
      margin-bottom: 20px;
      opacity: 0.5;
    }

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

    .loading-gif {
      width: 200px;
      height: auto;
    }
  </style>
</head>
<body>

  <img src="<?php echo base_url('imagenes/leon.jpg'); ?>" alt="Logo" class="logo" />

  <div class="main-container">
    <nav class="sidebar">
      <a href="<?php echo base_url('index.php/menu'); ?>">Menú</a>
      <a href="<?php echo base_url('marcas/marcas'); ?>">Marcas</a>
      <a href="<?php echo base_url('resenas/resenas'); ?>">Reseñas</a>
      <a href="<?php echo base_url('inventario/inventario'); ?>">Inventario</a>
      <a href="<?php echo base_url('devoluciones/devoluciones'); ?>" class="active">Devoluciones</a>
      <a href="<?php echo base_url('compras/compras'); ?>">Compras</a>

      <?php if ($this->session->userdata('user_id')): ?>
        <div style="margin-top: 20px; padding: 10px; background-color: #f8f9fa; border-radius: 5px; font-size: 0.9em;">
          <strong>Usuario:</strong> <?php echo htmlspecialchars($this->session->userdata('user_name') ?: $this->session->userdata('user_email')); ?>
        </div>
        <a href="<?php echo base_url('auth/logout'); ?>" class="logout" onclick="return confirm('¿Cerrar sesión?');">Cerrar Sesión</a>
      <?php else: ?>
        <a href="<?php echo base_url('auth'); ?>" class="logout">Iniciar Sesión</a>
      <?php endif; ?>
    </nav>

    <div class="content">
      <h2 class="mb-4 fw-bold text-primary">Lista de Devoluciones</h2>

      <div class="header-actions">
        <a href="<?php echo base_url('devoluciones/devoluciones/anadir'); ?>" class="btn btn-nueva">
          <i class="bi bi-plus-circle me-2"></i> Nueva Devolución
        </a>
      </div>

      <div class="row g-4">
        <?php if (isset($devoluciones) && !empty($devoluciones)): ?>
          <?php foreach ($devoluciones as $d): ?>
            <?php 
              // Imagen según id_perfume
              $imagen = 'leon.jpg';
              if ($d->id_perfume == 1) $imagen = 'Invictus.jpg';
              elseif ($d->id_perfume == 2) $imagen = 'Sauvage.jpg';
              elseif ($d->id_perfume == 3) $imagen = 'Bleu.jpg';
            ?>
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card-devolucion">
                <img src="<?php echo base_url('imagenes/' . $imagen); ?>" alt="Perfume" class="card-img" />
                <div class="card-body">
                  <div>
                    <h5 class="titulo">Devolución #<?php echo $d->id_devolucion; ?> - Perfume ID: <?php echo $d->id_perfume; ?></h5>
                    <p class="meta"><strong>ID Venta:</strong> <?php echo $d->id_venta; ?></p>
                    <p class="motivo"><strong>Motivo:</strong> <?php echo htmlspecialchars($d->motivo); ?></p>
                    <p><strong>Cantidad:</strong> <?php echo $d->cantidad; ?></p>
                  </div>
                  <p class="fecha"><?php echo date('d M Y', strtotime($d->fecha)); ?></p>
                </div>
                <div class="p-3 text-center">
                  <a href="<?php echo base_url('devoluciones/devoluciones/edit/' . $d->id_devolucion); ?>" class="btn btn-outline-warning btn-sm mb-2">Editar</a>
                  <a href="<?php echo base_url('devoluciones/devoluciones/eliminar/' . $d->id_devolucion); ?>" onclick="return confirm('¿Eliminar esta devolución?');" class="btn btn-outline-danger btn-sm">Eliminar</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-12">
            <div class="no-devoluciones">
              <i class="bi bi-arrow-repeat"></i>
              <h4>No hay devoluciones registradas</h4>
              <p>¡Realiza tu primera devolución aquí!</p>
              <a href="<?php echo base_url('devoluciones/devoluciones/anadir'); ?>" class="btn btn-nueva">Añadir Devolución</a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Modal de carga -->
  <div class="loading-modal" id="loadingModal">
    <img src="https://www.gifsanimados.org/data/media/1322/leon-imagen-animada-0026.gif" alt="Cargando..." class="loading-gif">
  </div>

  <script>
    const sidebarLinks = document.querySelectorAll('.sidebar a:not(.logout)');
    const loadingModal = document.getElementById('loadingModal');

    sidebarLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        loadingModal.style.display = 'flex';
        setTimeout(() => { window.location.href = href; }, 1500);
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
