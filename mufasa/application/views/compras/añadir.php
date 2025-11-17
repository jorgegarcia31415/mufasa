<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Añadir Compra - Mufasa Perfumería</title>

  <!-- Bootstrap CSS para responsividad -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Íconos -->

  <style>
    /* Tema azul claro y blanco: Fondo azul suave, elementos blancos */
    body {
      background: #e3f2fd; /* Azul claro sólido */
      color: #1976d2; margin: 0; padding: 20px;
      font-family: 'Arial', sans-serif;
    }

    /* Contenedor: Blanco, borde azul, centrado */
    .form-container {
      max-width: 600px; margin: 0 auto;
      background: white; border-radius: 10px; padding: 30px;
      border: 2px solid #1976d2; box-shadow: 0 4px 10px rgba(25,118,210,0.1);
    }

    /* Header: Azul, centrado */
    .header-title {
      text-align: center; color: #1976d2; margin-bottom: 20px; font-size: 1.5rem;
    }

    /* Campos: En columna, con espacio */
    .field-group {
      margin-bottom: 15px;
    }

    .field-label {
      color: #1976d2; font-weight: bold; margin-bottom: 5px; display: block;
    }

    .form-input {
      width: 100%; padding: 10px; background: white; border: 1px solid #1976d2; border-radius: 5px; color: #1976d2;
      transition: border-color 0.3s; /* Transición suave solo en hover */
    }
    .form-input:focus {
      border-color: #0d47a1; outline: none;
    }

    /* Botones: Centrados abajo */
    .actions-section {
      text-align: center; margin-top: 20px;
    }
    .btn-submit {
      background: #1976d2; color: white; border: none; padding: 10px 20px; border-radius: 5px; margin-right: 10px;
      transition: background-color 0.3s; /* Transición suave */
    }
    .btn-submit:hover {
      background: #0d47a1;
    }
    .btn-back {
      color: #1976d2; text-decoration: none; font-weight: bold;
      transition: color 0.3s; /* Transición suave */
    }
    .btn-back:hover {
      color: #0d47a1;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h4 class="header-title"><i class="fas fa-plus"></i> Añadir Compra</h4>

    <form action="<?php echo site_url('compras/compras/guardar'); ?>" method="post">
      <div class="field-group">
        <label class="field-label"><i class="fas fa-user"></i> ID Usuario</label>
        <input type="number" class="form-input" name="id_usuario" id="id_usuario" placeholder="Ej: 1" required>
      </div>

      <div class="field-group">
        <label class="field-label"><i class="fas fa-calendar"></i> Fecha</label>
        <input type="date" class="form-input" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>" required>
      </div>

      <div class="field-group">
        <label class="field-label"><i class="fas fa-truck"></i> Proveedor</label>
        <input type="text" class="form-input" name="proveedor" id="proveedor" placeholder="Ej: Turbo Antioquia">
      </div>

      <div class="field-group">
        <label class="field-label"><i class="fas fa-spray-can"></i> ID Perfume</label>
        <input type="number" class="form-input" name="id_perfume" id="id_perfume" placeholder="Ej: 123">
      </div>

      <div class="field-group">
        <label class="field-label"><i class="fas fa-boxes"></i> Cantidad</label>
        <input type="number" class="form-input" name="cantidad" id="cantidad" placeholder="Ej: 10">
      </div>

      <div class="field-group">
        <label class="field-label"><i class="fas fa-dollar-sign"></i> Costo Unitario</label>
        <input type="number" step="0.01" class="form-input" name="costo_unitario" id="costo_unitario" placeholder="Ej: 15.50">
      </div>

      <div class="field-group">
        <label class="field-label"><i class="fas fa-calculator"></i> Total</label>
        <input type="number" step="0.01" class="form-input" name="total" id="total" placeholder="Se calcula auto">
      </div>

      <div class="actions-section">
        <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Guardar Compra</button>
        <a href="<?php echo site_url('compras/compras'); ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Volver a la Lista</a>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>