<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Registrar Perfume</title>
</head>
<body>
  <div class="container">
    <form action="<?php echo base_url('perfumes/perfumes/guardar') ?>" method="post">
      <h4 class="text-center">REGISTRAR PERFUME</h4>
      <div class="row">
        <div class="col">
          <label>ID Perfume</label>
          <input type="text" class="form-control" name="id_perfume" required>
        </div>
        <div class="col">
          <label>Nombre</label>
          <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="col">
          <label>Marca ID</label>
          <input type="text" class="form-control" name="marca_id" required>
        </div>
        <div class="col">
          <label>Precio</label>
          <input type="number" step="0.01" class="form-control" name="precio" required>
        </div>
        <div class="col">
          <label>Stock</label>
          <input type="number" class="form-control" name="stock" required>
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-outline-success w-100">Registrar</button>
    </form>
  </div>
</body>
</html>
