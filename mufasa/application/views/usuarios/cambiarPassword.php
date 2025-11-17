        

        <!-- Comienza el contenido de la pagina -->
        <div class="container-fluid">

          <!-- Encabezado de la pagina -->

          <form action="<?php echo base_url();?>usuarios/usuario/actualizar" method="POST" class="form-horizontal">

             <?php if($this->session->flashdata("error")):?>

                <div class="">
               <p  class="text-danger" class="text-center ex"><?php echo $this->session->flashdata("error")?></p>
                </div>
                <?php endif;?>

            <div class="form-row align-items-center ">

              
                 <div>
                    <input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario->usuario ?>" >
                </div>
                <div class="col-md-3">
                    <label for=""></label>
                    <input type="text" class="form-control" placeholder="Ingrese la contraseña actual" name="pasActual" id="pasActual" required>
                </div>
                <div class="col-md-3">
                    <label for=""></label>
                    <input type="text" class="form-control" placeholder="Ingrese la nueva contraseña" name="pas1" id="pas1" required>
                </div>
                <div class="col-md-3">
                    <label for=""></label>
                    <input type="text" class="form-control" placeholder="Confirme la nueva contraseña" name="pas2" id="pas2">
                </div>

            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-flat">Cambiar Contraseña</button>
                 <a type="submit" class="btn btn-success btn-flat" href="<?php echo base_url();?>welcome">Cancelar</a>
            </div>
        </form>

    </div>
    

</div>

