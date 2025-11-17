<?php
if (!$this->session->userdata('user_id')) {
    redirect('auth');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Compras - Lista - Mufasa Perfumería</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    body, html {
      height: 100%;
      margin: 0;
      background: #e3f2fd;
      font-family: 'Arial', sans-serif;
    }

    .logo {
      position: absolute;
      top: 15px;  
      right: 25px;
      width: 120px;
      z-index: 1000;
    }

    .main-container {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .sidebar {
      width: 220px;
      background: white;
      border-right: 2px solid #1976d2;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }

    .sidebar a {
      padding: 10px 15px;
      margin-bottom: 8px;
      color: #1976d2;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .sidebar a:hover, .sidebar a.active {
      background: #1976d2;
      color: white;
    }

    .sidebar a.logout {
      color: #dc3545;
      margin-top: auto;
    }

    .sidebar a.logout:hover {
      background: #dc3545;
      color: white;
    }

    .content {
      flex-grow: 1;
      overflow-y: auto;
      padding: 20px 30px;
    }

    .card-compra {
      border: none;
      border-radius: 15px;
      background: white;
      box-shadow: 0 4px 15px rgba(25,118,210,0.1);
      overflow: hidden;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      height: 120px;
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

    .compra-title {
      font-weight: 700;
      font-size: 1.2rem;
      color: #1976d2;
      margin-bottom: 5px;
    }

    .compra-meta {
      font-size: 0.9rem;
      color: #6c757d;
      margin-bottom: 8px;
    }

    .compra-detalles {
      font-size: 0.95rem;
      color: #495057;
      line-height: 1.4;
    }

    .fecha {
      font-size: 0.85rem;
      color: #6c757d;
      text-align: right;
    }

    .header-section {
      margin-bottom: 20px;
    }

    .no-compras {
      text-align: center;
      padding: 50px;
      color: #6c757d;
    }

    .no-compras i {
      font-size: 4rem;
      margin-bottom: 20px;
      opacity: 0.5;
    }
  </style>
</head>
<body>

  <img src="<?php echo base_url('imagenes/leon.jpg'); ?>" alt="Logo Mufasa" class="logo" />

  <div class="main-container">
    <nav class="sidebar">
      <a href="<?php echo base_url('index.php/menu'); ?>">Menú</a>
      <a href="<?php echo base_url('marcas/marcas'); ?>">Marcas</a>
      <a href="<?php echo base_url('resenas/resenas'); ?>">Reseñas</a>
      <a href="<?php echo base_url('inventario/inventario'); ?>">Inventario</a>
      <a href="<?php echo base_url('devoluciones/devoluciones'); ?>">Devoluciones</a>
      <a href="<?php echo base_url('compras/compras'); ?>" class="active">Compras</a>

      <?php if ($this->session->userdata('user_id')): ?>
        <?php $display_name = $this->session->userdata('user_name') ?: $this->session->userdata('user_email'); ?>
        <div style="margin-top: 20px; padding: 10px; background: #e3f2fd; border-radius: 5px; font-size: 0.9em;">
          <strong>Usuario:</strong> <?php echo htmlspecialchars($display_name); ?>
        </div>
        <a href="<?php echo base_url('auth/logout'); ?>" class="logout" onclick="return confirm('¿Estás seguro?');">Cerrar Sesión</a>
      <?php else: ?>
        <a href="<?php echo base_url('auth'); ?>" class="logout">Iniciar Sesión</a>
      <?php endif; ?>
    </nav>

    <div class="content">
      <div class="header-section">
        <h2 style="color: #1976d2;"><i class="fas fa-shopping-cart"></i> Compras - Recibos</h2>
      </div>

      <div class="row g-4">
        <?php if (isset($compras) && !empty($compras)): ?>
          <?php foreach ($compras as $m): ?>
            <div class="col-12">
              <div class="card-compra">
                <img src="<?php echo base_url('imagenes/leon.jpg'); ?>" alt="Recibo" class="card-img" />
                <div class="card-body">
                  <div>
                    <h5 class="compra-title">Recibo #<?php echo $m->id_compra; ?></h5>
                    <p class="compra-meta"><strong>Proveedor:</strong> <?php echo htmlspecialchars($m->proveedor); ?> | <strong>Perfume ID:</strong> <?php echo $m->id_perfume; ?></p>
                    <p class="compra-detalles">
                      Cantidad: <?php echo $m->cantidad; ?> | Costo Unit.: $<?php echo $m->costo_unitario; ?> | Total: $<?php echo $m->total; ?>
                    </p>
                  </div>
                  <p class="fecha"><?php echo date('d M Y', strtotime($m->fecha)); ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-12">
            <div class="no-compras">
              <i class="fas fa-shopping-cart"></i>
              <h4>No hay recibos disponibles</h4>
              <p>¡No hay compras registradas!</p>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
