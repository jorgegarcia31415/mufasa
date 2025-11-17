<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>marcas</title>
</head>
<body>
  <div class="container">
  <form action="<?php echo base_url('marcas/marcas/guardar') ?>" method="post">
      <center>
        <h4>REGISTRAR MARCAS</h4>
      </center>
      <div class="row">
        <div class="col">
          <label for="">Identidad de la Marca</label>
          <input type="text" class="form-control" name="id_marca" id="id_marca" required>
        </div>
        <div class="col">
          <label for="">Nombre</label>
          <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>
       
      </div>
      <br>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-outline-success">Registrar</button>
      </div>
    </form>  
  </div>    
</body>