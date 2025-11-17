<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Inventario</title>
</head>
<body>
  <div class="container">
    <form action="<?php echo base_url('inventario/inventario/guardar') ?>" method="post">
      <center>
        <h4>REGISTRAR INVENTARIO</h4>
      </center>
      <div class="row">
        <div class="col">
          <label for="">ID Movimiento</label>
          <input type="number" class="form-control" name="id_movimiento" id="id_movimiento" required>
        </div>
        <div class="col">
          <label for="">Fecha</label>
          <input type="date" class="form-control" name="fecha" id="fecha" required>
        </div>
        <div class="col">
          <label for="">ID Perfume</label>
          <input type="number" class="form-control" name="id_perfume" id="id_perfume" required>
        </div>
        <div class="col">
          <label for="">Tipo de Movimiento</label>
          <select class="form-control" name="tipo" id="tipo" required>
            <option value="">Seleccione</option>
            <option value="entrada">Entrada</option>
            <option value="salida">Salida</option>
          </select>
        </div>
        <div class="col">
          <label for="">Cantidad</label>
          <input type="number" class="form-control" name="cantidad" id="cantidad" required>
        </div>
      </div>
      <br>
      <label for="">Descripción</label>
      <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
      <br>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-outline-success">Registrar</button>
      </div>
    </form>  
  </div>    
</body>
</html>
