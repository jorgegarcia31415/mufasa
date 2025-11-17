<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Lista de Ventas</title>
</head>
<body>
  <div class="container">
    
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Identificación de la Venta</th>
          <th scope="col">Fecha</th>
          <th scope="col">Identificación del Perfume</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Costo Unitario</th>
          <th scope="col">Total</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($compras as $m): ?>
        <tr>
          <td><?php echo $m->id_compra ?></td>
          <td><?php echo $m->fecha ?></td>
          <td><?php echo $m->id_perfume ?></td>
          <td><?php echo $m->cantidad ?></td>
          <td><?php echo $m->costo_unitario ?></td>
          <td><?php echo $m->total ?></td>
          <td class="text-center">
           
            <a href="<?php echo base_url('ventas/ventas/eliminar/' . $m->id_compra); ?>" onclick="return confirm('¿Seguro que deseas eliminar esta Venta?');" class="btn btn-outline-danger">Eliminar</a>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>    
  </div>
</body>
</html>
