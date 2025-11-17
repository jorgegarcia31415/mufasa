<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>


</style>
<body>
  <div class="container">
    <a href="<?php echo base_url("Libros/Libro/agregar")?>"class="btn btn-outline-success">Nuevo Libro</a>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Número Habitacion</th>
      <th scope="col">Número Cama</th>
      <th scope="col">Nombre Médico</th>
      <th scope="col">Cedula Paciente</th>
      <th scope="col">Nombre Paciente</th>
      <th scope="col">Horario</th>
      <th scope="col">Fecha Ingreso</th>
      <th class="text-center">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($ingresos as $m):?>
    <tr>
      <td><?php echo $m->pkcodigo_i?></td>
      <td><?php echo $m->n_habitacion?></td>
      <td><?php echo $m->n_cama?></td>
      <td><?php echo $m->nombres?></td>
      <td><?php echo $m->fkcedula_paciente?></td>
      <td><?php echo $m->nombre_paciente?></td>
      <td><?php echo $m->descripcion?></td>
      <td><?php echo $m->fecha_ingreso?></td>
      <td class="text-center">
      <a href="<?php echo base_url('Ingresos/Ingreso/edit/' .$m->pkcodigo_i);?>" class="btn btn-outline-warning">Editar</a>
      <a href="<?php echo base_url('Ingresos/Ingreso/eliminar/' .$m->pkcodigo_i);?>"onclick="return confirm('¿Seguro que deseas eliminar este Ingreso?');" class="btn btn-outline-danger">Eliminar</a>
      </td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>    
  </div>
</body>
</html>