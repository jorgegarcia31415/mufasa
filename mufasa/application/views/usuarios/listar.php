<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"></h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de usuarios.</h6>
    </div>
    <div class="col-md-12">
      <br>
    <a href="<?php echo base_url();?>usuarios/usuario/add" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Nuevo Usuario</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">

        <table id="#" class="table table-hover" width="100%" cellspacing="0">
         <thead>
          <tr>
            <th>USUARIO</th>
            <th>NOMBRES</th>
            <th>APELLIDOS</th>
            <th>DOCUMENTO</th>
            <th>MAIL</th>
            <th>ROL</th>
            <th>FOTO</th>
            <th class="text-center">ACCIONES</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $a): ?>
            <tr>
              <td><?php echo $a->usuario; ?></td>
              <td><?php echo $a->nombres; ?></td>
              <td><?php echo $a->apellidos; ?></td>
              <td><?php echo $a->documento; ?></td>
              <td><?php echo $a->mail; ?></td>
              <td><?php echo $a->rol; ?></td>
             <td><img src="<?php echo base_url($a->foto)?>" alt="" style="border-radius: 50%; width: 50px; height: 50px;"></td>
              <td class="text-center">
               <a href="<?php echo base_url('usuarios/usuario/edit/' .$a->usuario) ?>" <i class="fas fa-edit fa-sm"></i></a>
               <a href="<?php echo base_url('usuarios/usuario/eliminar/' .$a->usuario) ?>" class=" btn-remove "><i class="fas fa-window-close fa-sm"></i></a>
             </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>

