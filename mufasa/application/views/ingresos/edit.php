<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Ingresos</title>
</head>
<body>
  <div class="container">
  <form action="<?php echo base_url('Ingresos/Ingreso/actualizar') ?>" method="post">
      <center>
        <h4>ACTUALIZAR INGRESOS.</h4>
      </center>
      <div class="row">
        <div class="col">
          <label for="">Codigo</label>
          <input type="text" class="form-control" name="pkcodigo_i" id="" readonly value="<?php echo $ingresos->pkcodigo_i?>">
        </div>
        <div class="col">
          <label for=""># Habitación</label>
          <input type="text" class="form-control" name="n_habitacion" id="" value="<?php echo $ingresos->n_habitacion?>">
        </div>
        <div class="col">
          <label for=""># Cama</label>
          <input type="text" class="form-control" name="n_cama" id="" value="<?php echo $ingresos->n_cama?>">
        </div>
        <div class="col">
          <label for="">Médico</label>
          <select name="fkcedula_medico" id="">
          <option value="<?php echo $ingresos->fkcedula_medico?>"><?php echo $ingresos->nombres?></option>
          <option value="">-------------------</option>
          <?php foreach($medicos as $m):?>
            <option value="<?php echo $m->pkcedula?>"><?php echo $m->nombres?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <br>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-outline-success">Actualizar</button>
      </div>
      
    </form>  
  </div>    
</body>