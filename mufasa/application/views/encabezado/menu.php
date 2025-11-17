<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Añadir Compra</title>
</head>
<body>
  <center>
    <h3>REGISTRAR COMPRA</h3>
  </center>

  <form action="<?php echo base_url('compras/compras/guardar') ?>" method="post">
    <label for="">Identidad de la Compra</label>
    <input type="number" class="form-control" name="id_compra" id="id_compra" placeholder="Se genera automáticamente" readonly><br>

    <label for="">Identidad del Usuario</label>
    <input type="number" class="form-control" name="id_usuario" id="id_usuario" required><br>

    <label for="">Fecha</label>
    <input type="date" class="form-control" name="fecha" id="fecha" required><br>

    <label for="">Proveedor</label>
    <input type="text" class="form-control" name="proveedor" id="proveedor"><br>

    <label for="">Identidad del Perfume</label>
    <input type="number" class="form-control" name="id_perfume" id="id_perfume"><br>

    <label for="">Cantidad</label>
    <input type="number" class="form-control" name="cantidad" id="cantidad"><br>

    <label for="">Costo Unitario</label>
    <input type="number" step="0.01" class="form-control" name="costo_unitario" id="costo_unitario"><br>

    <label for="">Total</label>
    <input type="number" step="0.01" class="form-control" name="total" id="total"><br>

    <button type="submit">Registrar</button>
  </form>
</body>
</html>
