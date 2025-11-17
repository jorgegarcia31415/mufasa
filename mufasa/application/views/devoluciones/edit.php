<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>devoluciones</title>
</head>
<body>
  <div class="container">
  <form action="<?php echo base_url('devoluciones/devoluciones/actualizar') ?>" method="post">
      <center>
        <h4>ACTUALIZAR DEVOLUCIÓN</h4>
      </center>
      <div class="row">
        <div class="col">
          <label for="">Identidad de la Devolución</label>
          <input type="text" class="form-control" name="id_devolucion" id="id_devolucion" readonly value="<?php echo $devoluciones->id_devolucion?>">
        </div>
        <div class="col">
          <label for="">Identidad de la Venta</label>
          <input type="text" class="form-control" name="id_venta" id="id_venta" value="<?php echo $devoluciones->id_venta?>">
        </div>
        <div class="col">
          <label for="">Identidad del Perfume</label>
          <input type="text" class="form-control" name="id_perfume" id="id_perfume" value="<?php echo $devoluciones->id_perfume?>">
        </div>
        <div class="col">
          <label for="">Fecha</label>
          <input type="text" class="form-control" name="fecha" id="fecha" value="<?php echo $devoluciones->fecha?>">
        </div>
        <div class="col">
          <label for="">Motivo</label>
          <input type="text" class="form-control" name="motivo" id="motivo" value="<?php echo $devoluciones->motivo?>">
        </div>
        <div class="col">
          <label for="">Cantidad</label>
          <input type="text" class="form-control" name="cantidad" id="cantidad" value="<?php echo $devoluciones->cantidad?>">
        </div>
      </div>
      <br>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-outline-success">Actualizar</button>
      </div>
    </form>  
  </div>    
</body>
