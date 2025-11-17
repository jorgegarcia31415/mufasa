<?php 
// Asegúrate de que el helper 'url' esté cargado en autoload.php
// $autoload['helper'] = array('url');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inventario - Layout con Menú Lateral</title>

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

    .card-inventario {
      border: 1px solid #ddd;
      border-radius: 8px;
      background: white;
      padding: 15px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
      transition: box-shadow 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card-inventario:hover {
      box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: contain;
      margin-bottom: 15px;
    }

    .card-title {
      font-weight: 700;
      font-size: 1.5rem;
      color: #222;
      margin-bottom: 8px;
    }

    .stock {
      font-weight: 600;
      margin-bottom: 10px;
    }

    .stock.out {
      color: red;
    }

    .precio {
      font-weight: 600;
      margin-bottom: 10px;
    }

    .precio.has-value {
      color: #28a745;
    }

    .precio.na {
      color: #6c757d;
      font-style: italic;
    }

    .search-bar {
      margin-bottom: 20px;
      display: flex;
      gap: 10px;
      align-items: center;
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

  <!-- Logo -->
  <img src="<?php echo base_url('imagenes/leon.jpg'); ?>" alt="Logo" class="logo" />

  <div class="main-container">
    <nav class="sidebar">
      <a href="<?php echo base_url('index.php/menu'); ?>">Menu</a>
      <a href="<?php echo base_url('marcas/marcas'); ?>">Marcas</a>
      <a href="<?php echo base_url('resenas/resenas'); ?>">Reseñas</a>
      <a href="<?php echo base_url('inventario/inventario'); ?>" class="active">Inventario</a>
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

    <div class="content">
      <h2 class="mb-4 fw-bold text-primary">Movimientos de Inventario</h2>

      <div class="search-bar">
        <input type="text" id="buscar" class="form-control" placeholder="Buscar perfume, tipo, fecha, descripción o precio...">
        <button class="btn btn-secondary" id="limpiar">Limpiar</button>
      </div>

      <div class="row g-4" id="inventario-lista">
        <?php foreach ($inventario as $m): ?>
          <div class="col-6 col-md-4 col-lg-3 inventario-item">
            <div class="card-inventario">
              <?php 
                $imagen = 'leon.jpg';
                if ($m->id_perfume == 1) {
                  $imagen = 'Invictus.jpg';
                } elseif ($m->id_perfume == 2) {
                  $imagen = 'Sauvage.jpg';
                } elseif (property_exists($m, 'imagen') && !empty($m->imagen)) {
                  $imagen = $m->imagen;
                }

                $stock = isset($m->cantidad) ? (int)$m->cantidad : 0;
                $precio = isset($m->precio) ? (float)$m->precio : 0;
                $precioTexto = ($precio > 0) ? '$' . number_format($precio, 2) : 'N/A';
                $precioClase = ($precio > 0) ? 'precio has-value' : 'precio na';
              ?>
              <img src="<?php echo base_url('imagenes/' . $imagen); ?>" alt="Imagen Perfume" class="card-img-top" />

              <div>
                <h3 class="card-title"><?php echo ucfirst($m->nombre ?? 'Perfume ' . $m->id_perfume); ?></h3>
                <p class="mb-1">ID Perfume: <?php echo $m->id_perfume ?></p>
                <p class="<?php echo $precioClase; ?>">Precio: <?php echo $precioTexto; ?></p>

                <?php if ($stock > 0): ?>
                  <p class="stock text-success">Stock disponible: <?php echo $stock ?></p>
                <?php else: ?>
                  <p class="stock out">¡Fuera de stock!</p>
                <?php endif; ?>
              </div>

              <?php if ($stock > 0): ?>
                <?php if ($m->id_perfume == 1): ?>
                  <!-- 🔗 Redirige a Mercado Pago para perfume 1 -->
                  <a href="https://mpago.li/1onzSRB" target="_blank" class="btn btn-success btn-sm mt-2 w-100">Comprar</a>
                <?php else: ?>
                  <a href="<?php echo base_url('compras/compras/anadir?id_perfume=' . $m->id_perfume); ?>" class="btn btn-success btn-sm mt-2 w-100">Comprar</a>
                <?php endif; ?>
              <?php else: ?>
                <button class="btn btn-secondary btn-sm mt-2 w-100" disabled>No disponible</button>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="loading-modal" id="loadingModal">
    <div class="loading-content">
      <img src="https://www.gifsanimados.org/data/media/1322/leon-imagen-animada-0026.gif" alt="Cargando..." class="loading-gif">
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const input = document.getElementById('buscar');
      const limpiar = document.getElementById('limpiar');
      const items = document.querySelectorAll('.inventario-item');
      const params = new URLSearchParams(window.location.search);
      const buscarParam = params.get('buscar');
      if (buscarParam) {
        input.value = buscarParam;
        input.dispatchEvent(new Event('input'));
      }

      input.addEventListener('input', function() {
        const valor = input.value.toLowerCase().trim();
        items.forEach(item => {
          const texto = item.textContent.toLowerCase();
          item.style.display = texto.includes(valor) ? '' : 'none';
        });
      });

      limpiar.addEventListener('click', function() {
        input.value = '';
        items.forEach(item => item.style.display = '');
      });

      const sidebarLinks = document.querySelectorAll('.sidebar a:not(.logout)');
      const loadingModal = document.getElementById('loadingModal');
      sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const href = this.getAttribute('href');
          loadingModal.style.display = 'flex';
          setTimeout(() => {
            window.location.href = href;
          }, 2000);
        });
      });
    });
  </script>

  <div class="loading-modal" id="loadingModalVista">
    <div class="loading-content">
        <img src="https://www.gifsanimados.org/data/media/1322/leon-imagen-animada-0026.gif" alt="Cargando... 🦁" class="loading-gif">
        <p class="loading-text">Cargando</p>
    </div>
  </div>

  <style>
    .loading-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(210, 180, 140, 0.9);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        transition: opacity 0.5s ease;
        opacity: 1;
    }
    .loading-modal.hidden {
        opacity: 0;
        pointer-events: none;
    }
    .loading-content { text-align: center; }
    .loading-gif { width: 200px; height: auto; border-radius: 10px; }
    .loading-text {
        color: #8B4513;
        margin-top: 10px;
        font-size: 1.2rem;
        font-weight: bold;
    }
  </style>

  <script>
    function initLoadingModal() {
        const loadingModal = document.getElementById('loadingModalVista');
        if (!loadingModal) return;
        loadingModal.style.display = 'flex';
        setTimeout(() => {
            loadingModal.classList.add('hidden');
            setTimeout(() => {
                loadingModal.style.display = 'none';
            }, 500);
        }, 1500);
    }
    document.addEventListener('DOMContentLoaded', initLoadingModal);
  </script>
</body>
</html>
