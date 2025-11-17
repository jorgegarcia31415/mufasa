<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Editar Perfume</title>
</head>
<body>
  <div class="container">
    <form action="<?php echo base_url('perfumes/perfumes/actualizar') ?>" method="post">
      <h4 class="text-center">EDITAR PERFUME</h4>
      <div class="row">
        <div class="col">
          <label>ID Perfume</label>
          <input type="text" class="form-control" name="id_perfume" value="<?php echo $perfumes->id_perfume ?>" readonly>
        </div>
        <div class="col">
          <label>Nombre</label>
          <input type="text" class="form-control" name="nombre" value="<?php echo $perfumes->nombre ?>">
        </div>
        <div class="col">
          <label>Marca ID</label>
          <input type="text" class="form-control" name="marca_id" value="<?php echo $perfumes->marca_id ?>">
        </div>
        <div class="col">
          <label>Precio</label>
          <input type="number" step="0.01" class="form-control" name="precio" value="<?php echo $perfumes->precio ?>">
        </div>
        <div class="col">
          <label>Stock</label>
          <input type="number" class="form-control" name="stock" value="<?php echo $perfumes->stock ?>">
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-outline-primary w-100">Actualizar</button>
    </form>
  </div>
</body>
</html>
