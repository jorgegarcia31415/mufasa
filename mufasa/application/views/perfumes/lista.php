<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Lista de Perfumes</title>
</head>
<body>
  <div class="container">
    <a href="<?php echo base_url('perfumes/perfumes/agregar') ?>" class="btn btn-outline-success">Nuevo Perfume</a>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Marca ID</th>
          <th>Precio</th>
          <th>Stock</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($perfumes as $p): ?>
          <tr>
            <td><?php echo $p->id_perfume ?></td>
            <td><?php echo $p->nombre ?></td>
            <td><?php echo $p->marca_id ?></td>
            <td><?php echo $p->precio ?></td>
            <td><?php echo $p->stock ?></td>
            <td class="text-center">
              <a href="<?php echo base_url('perfumes/perfumes/edit/' . $p->id_perfume); ?>" class="btn btn-outline-warning">Editar</a>
              <a href="<?php echo base_url('perfumes/perfumes/eliminar/' . $p->id_perfume); ?>" onclick="return confirm('¿Eliminar este perfume?');" class="btn btn-outline-danger">Eliminar</a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</body>
</html>
