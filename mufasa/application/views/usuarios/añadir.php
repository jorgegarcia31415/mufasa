
        <style type="text/css">
          form{
            width: 90%;
            padding: 5%;
            margin: 0 auto;
            text-align: left;
            align-items: center;
            border: PowderBlue 1px solid;
            border-radius: 20px;
            background-color: #D4E6F1;
              }
          select{
            appearance: none;
            width: 100%;
            height: 38px;
            cursor: pointer;
            display: block;
            padding: 7px 10px;
            background: #EAEDED;
            font-size: 1em;
            color: #999;
            font-family:'Quicksand', sans-serif;
            border:2px solid rgba(0,0,0,0.2);
            border-radius: 12px;
            position: relative;
            transition: all 0.25s ease;
          }

          body{
            font-family: Arial, Helvetica, Sans-serif;
            color: black;
            font-size: 16px;
          }
          .mss{
          width: 30%;
          margin-left: 55px;
          border-radius: 8px;
        }
        </style>
        <!-- Comienza el contenido de la pagina -->
        <body>
        <div class="container">
        <div class="mss">
            <?php if($this->session->flashdata('muse')) :?>
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $this->session->flashdata('muse');?>
            </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('muse1')) :?>
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $this->session->flashdata('muse1');?>
            </div>
            <?php endif; ?>
       </div>
<!-- Encabezado de la pagina -->
            <form class="form" enctype="multipart/form-data" action="<?php echo base_url('Usuarios/usuario/guardar/')?>" method="post">
            <center><h3>REGISTRAR USUARIOS.</h3></center> 
            <br>         
            <div class="row">
                <div class="form-group col">
                  <label for="">Codigo</label>
                  <input type="text" class="form-control" name="PKIdentidad" id="PKIdentidad">
                </div>
                <div class="form-group col">
                  <label for="">Password</label>
                  <input type="text" class="form-control" name="Password" id="Password" required>
                </div>
                <div class="form-group col">
                  <label for="">Nombres</label>
                  <input type="text" class="form-control" name="Nombres" id="Nombres" required>
                </div>
        </div>
                <div class="row">
                    <div class="form-group col">
                      <label for="">Apellidos</label>
                      <input type="text" class="form-control" name="Apellidos" id="Apellidos" required>
                    </div>
                    <div class="form-group col">
                      <label for="">Email</label>
                      <input type="text" class="form-control" name="Email" id="Email">
                    </div>
                  <div class="col-md-4">
                    <label for="">Roles</label>
                    <br>
                  <select class="form-group col" name="Roles" >
                      <option value=" ">Seleccione una opción</option>
                      <option value="SuperAdmin">SuperAdmin</option>
                      <option value="Administrador">Administrador</option>
                      <option value="Usuario">Usuario</option>
                  </select>
                  </div>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
              </div>
            </form>
            </div>
        </body>
       
      
      
