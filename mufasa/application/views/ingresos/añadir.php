<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>pacientes</title>
</head>
<body>
  <div class="container">
  <form action="<?php echo base_url('Ingresos/Ingreso/guardar') ?>" method="post">
      <center>
        <h4>REGISTRAR INGRESOS.</h4>
      </center>
      <div class="row">
        <div class="col">
          <label for="">Numero Habitación</label>
          <input type="text" class="form-control" name="n_habitacion" id="n_habitacion" required>
        </div>
        <div class="col">
          <label for="">Número de Cama</label>
          <input type="text" class="form-control" name="n_cama" id="n_cama" required>
        </div>
        <div class="col">
          <label for="">Medicos</label>
          <select name="fkcedula_medico" id="">
            <?php foreach($medicos as $m):?>
                <option value="<?php echo $m->pkcedula?>"><?php echo $m->nombres?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="row">
        <div class="col">
          <label for="">Paciente</label>
          <input type="text" class="form-control" name="fkcedula_paciente" id="fkcedula_paciente" required>
        </div>
        <div class="col">
          <label for="">Nombre Paciente</label>
          <input type="text" class="form-control" name="nombre_paciente" id="nombre_paciente" value="<?php echo isset($nombres) ? $nombres : ''; ?>" readonly>
        </div>
        <div class="col">
          <label for="">Horario</label>
          <select name="fk_horarios" id="">
            <?php foreach($horarios as $h):?>
                <option value="<?php echo $h->pkcodigo?>"><?php echo $h->descripcion?></option>
            <?php endforeach ?>
          </select>
        </div>        
        <div class="col">
          <label for="">Fecha Ingreso</label>
          <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso" required>
        </div>
      </div>
      <br>
        </div>        
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-outline-success">Registrar</button>
      </div>
    </form>  
  </div>    
</body>