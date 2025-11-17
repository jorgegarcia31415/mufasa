<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Inventario</title>
</head>
<body>
  <div class="container">
    <form action="<?php echo base_url('inventario/inventario/actualizar') ?>" method="post">
      <center>
        <h4>ACTUALIZAR INVENTARIO</h4>
      </center>
      <div class="row">
        <div class="col">
          <label for="">ID Movimiento</label>
          <input type="text" class="form-control" name="id_movimiento" id="id_movimiento" readonly value="<?php echo $inventario->id_movimiento ?>">
        </div>
        <div class="col">
          <label for="">Fecha</label>
          <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $inventario->fecha ?>">
        </div>
        <div class="col">
          <label for="">ID Perfume</label>
          <input type="text" class="form-control" name="id_perfume" id="id_perfume" value="<?php echo $inventario->id_perfume ?>">
        </div>
        <div class="col">
          <label for="">Tipo de Movimiento</label>
          <select class="form-control" name="tipo" id="tipo">
            <option value="entrada" <?php if ($inventario->tipo == 'entrada') echo 'selected'; ?>>Entrada</option>
            <option value="salida" <?php if ($inventario->tipo == 'salida') echo 'selected'; ?>>Salida</option>
          </select>
        </div>
        <div class="col">
          <label for="">Cantidad</label>
          <input type="number" class="form-control" name="cantidad" id="cantidad" value="<?php echo $inventario->cantidad ?>">
        </div>
        <div class="col">
          <label for="">Descripción</label>
          <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $inventario->descripcion ?>">
        </div>
      </div>
      <br>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-outline-success">Actualizar</button>
      </div>
    </form>  
  </div>    
</body>
</html>
