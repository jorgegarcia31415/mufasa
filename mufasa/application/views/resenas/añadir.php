<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Añadir Reseña</title>
  <style>
    /* Reset y fondo */
    body {
      font-family: 'Arial', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      padding: 40px;
      width: 100%;
      max-width: 1200px;
      animation: slideUp 0.8s ease-out;
      position: relative;
      overflow: hidden;
    }

    @keyframes slideUp {
      from { transform: translateY(50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .container::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(102, 126, 234, 0.1), transparent);
      animation: rotate 6s linear infinite;
      pointer-events: none;
    }

    @keyframes rotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    h4 {
      text-align: center;
      color: #4a90e2;
      margin-bottom: 30px;
      font-size: 2.5em;
      animation: bounceIn 1s ease-out;
    }

    @keyframes bounceIn {
      0% { transform: scale(0.3); opacity: 0; }
      50% { transform: scale(1.05); }
      70% { transform: scale(0.9); }
      100% { transform: scale(1); opacity: 1; }
    }

    .row {
      margin-bottom: 20px;
    }

    .col {
      margin-bottom: 15px;
      animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    label {
      color: #34495e;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-control {
      border: 2px solid #bdc3c7;
      border-radius: 10px;
      padding: 12px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #4a90e2;
      box-shadow: 0 0 10px rgba(74, 144, 226, 0.5);
      transform: scale(1.02);
    }

    .btn-outline-success {
      background: linear-gradient(45deg, #4a90e2, #357abd);
      color: white;
      border: none;
      padding: 15px;
      border-radius: 10px;
      font-size: 1.1em;
      transition: all 0.3s ease;
      animation: fadeInUp 0.6s ease-out;
    }

    .btn-outline-success:hover {
      background: linear-gradient(45deg, #357abd, #2c5aa0);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(74, 144, 226, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 20px;
        margin: 20px;
      }
      h4 {
        font-size: 2em;
      }
      .row {
        flex-direction: column;
      }
      .col {
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <form action="<?php echo base_url('resenas/resenas/guardar'); ?>" method="post">
      <h4>AÑADIR RESEÑA</h4>
      <div class="row">
        <div class="col">
          <label for="id_resena">Identidad de la Reseña</label>
          <input type="text" class="form-control" name="id_resena" id="id_resena" required>
        </div>
        <div class="col">
          <label for="id_perfume">Identidad del Perfume</label>
          <input type="text" class="form-control" name="id_perfume" id="id_perfume" required>
        </div>
        <div class="col">
          <label for="cliente">Cliente</label>
          <input type="text" class="form-control" name="cliente" id="cliente" required>
        </div>
        <div class="col">
          <label for="calificacion">Calificación</label>
          <input type="text" class="form-control" name="calificacion" id="calificacion" required>
        </div>
        <div class="col">
          <label for="comentario">Comentario</label>
          <input type="text" class="form-control" name="comentario" id="comentario" required>
        </div>
        <div class="col">
          <label for="fecha">Fecha</label>
          <input type="date" class="form-control" name="fecha" id="fecha" required>
        </div>
      </div>
      <br>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-outline-success">Guardar</button>
      </div>
    </form>
  </div>
</body>
</html>