<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>devoluciones</title>
</head>
<body>
  <div class="container">
  <form action="<?php echo base_url('devoluciones/devoluciones/guardar') ?>" method="post">
      <center>
        <h4>Registrar Devolucion</h4>
      </center>
      <div class="row">
        <div class="col">
          <label for="">Identidad de la Devolución</label>
          <input type="int" class="form-control" name="id_devolucion" id="id_devolucion" required>
        </div>
        <div class="col">
          <label for="">Identidad de la Venta</label>
          <input type="int" class="form-control" name="id_venta" id="id_venta" required>
        </div>
        <div class="col">
          <label for="">Identidad del Perfume</label>
          <input type="int" class="form-control" name="id_perfume" id="id_perfume" required>
        </div>
        <div class="col">
          <label for="">Fecha</label>
          <input type="date" class="form-control" name="fecha" id="fecha" required>
        </div>
        <div class="col">
          <label for="">Motivo</label>
          <input type="text" class="form-control" name="motivo" id="motivo" required>
        </div>
        <div class="col">
          <label for="">Cantidad</label>
          <input type="int" class="form-control" name="cantidad" id="cantidad" required>
        </div>
      </div>
      <br>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-outline-success">Enviar Solicitud</button>
      </div>
    </form>  
  </div>    
</body>
