        

<!-- Comienza el contenido de la pagina -->
<div class="container-fluid">

  <!-- Encabezado de la pagina -->

  <form class="form" enctype="multipart/form-data" action="<?php echo base_url('usuarios/usuario/actualizarUs/')?>" method="post">

      <div class="form-row align-items-center ">
          <div>
            <input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario->usuario ?>" >
        </div>
        <div class="col-md-3">
            <label for="">Nombres</label>
            <input type="text" class="form-control" readonly name="nombres" id="nombres" value="<?php echo $usuario->nombres ?>" >
        </div>
        <div class="col-md-3">
            <label for="">Apellidos</label>
            <input type="text" class="form-control" readonly  name="apellidos" id="apellidos" value="<?php echo $usuario->apellidos ?>" >
        </div>
    </div>
    <div class="form-row align-items-center ">
        <div class="col-md-3">
            <label for="">Documento</label>
            <input type="text" class="form-control" readonly  name="documento" id="documento" value="<?php echo $usuario->documento ?>" >
        </div>
        <div class="col-md-3">
            <label for="">Correo</label>
            <input type="mail" class="form-control" name="mail" id="mail" value="<?php echo $usuario->mail ?>" >
        </div>
    </div>
    <div class="form-row align-items-center ">
       <div class="col-md-4">
         <label for="">Rol</label>
         <br>
        <select name="rol" >
            <option value="<?php echo $usuario->rol ?>"><?php echo $usuario->rol ?> </option>
            <option value="SuperAdmin">SuperAdmin</option>
            <option value="Administrador">Administrador</option>
            <option value="Usuario">Usuario</option>
        </select>
         </div>
    <div class="col-md-3">
        <label for="">Foto</label>
        <input type="file" class="form-control" name="foto" >
    </div>
</div>
<br>
<div class="form-group">
    <button type="submit" class="btn btn-success btn-flat">Actualizar</button>
</div>
</form>

</div>


</div>
