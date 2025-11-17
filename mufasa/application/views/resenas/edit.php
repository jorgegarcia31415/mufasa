<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>resenas</title>
</head>
<body>
  <div class="container">
  <form action="<?php echo base_url('resenas/resenas/actualizar') ?>" method="post">
      <center>
        <h4>ACTUALIZAR RESEÑAS</h4>
      </center>
      <div class="row">
        <div class="col">
          <label for="">Identidad de la Reseña</label>
          <input type="text" class="form-control" name="id_resena" id="id_resena" readonly value="<?php echo $resenas->id_resena?>">
        </div>
        <div class="col">
          <label for="">Identidad del Perfume</label>
          <input type="text" class="form-control" name="id_perfume" id="id_perfume" value="<?php echo $resenas->id_perfume?>">
        </div>
        <div class="col">
          <label for="">Cliente</label>
          <input type="text" class="form-control" name="cliente" id="cliente" value="<?php echo $resenas->cliente?>">
        </div>
        <div class="col">
          <label for="">Calificacion</label>
          <input type="text" class="form-control" name="calificacion" id="calificacion" value="<?php echo $resenas->calificacion?>">
        </div>
        <div class="col">
          <label for="">Comentario</label>
          <input type="text" class="form-control" name="comentario" id="comentario" value="<?php echo $resenas->comentario?>">
        </div>
        <div class="col">
          <label for="">Fecha</label>
          <input type="text" class="form-control" name="fecha" id="fecha" value="<?php echo $resenas->fecha?>">
        </div>
      </div>
      <br>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-outline-success">Actualizar</button>
      </div>
    </form>  
  </div>    
</body>