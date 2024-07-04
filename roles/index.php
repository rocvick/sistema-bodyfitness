<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
include('../roles/listado_permisos.php');
include('../roles/listado_roles_permisos.php');
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('../layout/admin/head.php');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include('../layout/admin/menu.php');?>
 
<div class="content-wrapper">
   <br>
   <div class="content">
     
        <h2>Listado de Roles</h2>
        <br>
        <div class="row">
           <div class="col-md-6">
              <table class= "table table-bordered  table-sm table-striped">
          
            <th><center>Nro</center></th>
            <th>Nombres</th>            
            <th><center>Acción</center></th>
          
            <?php
            $contador = 0; 
            $query_roles = $pdo->prepare("SELECT * FROM tb_roles WHERE estado = '1' ");
            $query_roles->execute();
            $roles = $query_roles-> fetchALL(PDO::FETCH_ASSOC);
            foreach($roles as $rol){
                $id = $rol['id_rol'];
                $nombre = $rol['nombre'];
                $contador = $contador + 1;
            
            ?> 
            
             <tr>
                <td><center><?php echo $contador; ?></center></td>
                <td><?php echo $nombre; ?></td>
                 <td>
                    <center>
                       <a href="delete.php?id=<?php echo $id;?>" class= "btn btn-danger btn-sm">Eliminar</a>  
                       
                       
                             <!-- Button trigger modal -->
        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_asignacion<?php echo $id; ?>">
          Asignar Permiso
        </button>

<!-- Modal -->
<div class="modal fade" id="modal_asignacion<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style= "background-color: #dbcd59">
        <h5 class="modal-title" id="exampleModalLabel">Asignación de Permiso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="form-group mb-2">
             <input type="text" name="rol_id" id="rol_id<?=$id;?>" value="<?=$id;?>" hidden>
             <input type="text" name="nombre_rol" id="nombre_rol<?=$id;?>" value="<?=$nombre;?>" hidden>
             <label>ROL: <?=$rol['nombre'];?></label>
         </div>
         <div class="form-group mx-sm-4 mb-2">
            <select name="permiso_id" id="permiso_id<?=$id;?>" class="form-control">
                 <?php
                    foreach($permisos as $permiso){
                        $id_permiso = $permiso['id_permiso']; ?>
                  <option value="<?=$id_permiso;?>"><?=$permiso['nombre_url'];?></option> 
                  <?php
                     }
                  ?> 
             </select>
          </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary mb-2" id="btn_reg<?=$id;?>">Asignar</button>
              <script>
                $('#btn_reg<?=$id;?>').click( function () {
                var a = $('#rol_id<?=$id;?>').val();
                var b = $('#permiso_id<?=$id;?>').val();
                var c = $('#nombre_rol<?=$id;?>').val();
                var url = "../roles/create_roles_permisos.php";
                $.get(url,{rol_id:a, permiso_id:b, nombre_rol:c}, function (datos){
                $('#respuesta<?=$id;?>').html(datos);
                $('#tabla<?=$id;?>').css('display','none');                
                });
                });
              </script>
         </div>
    
    <div id="respuesta<?=$id;?>"></div>
    <div class="row" id="tabla<?=$id;?>">
        <div class="col-md-12">
        <table class="table table-bordered tale-sm table-striped table-hover">
        <tr>
           <th styles="background-color: #dbcd59">Nro</th>
           <th styles="background-color: #dbcd59">Rol</th> 
           <th styles="background-color: #dbcd59">Permiso</th>
           <th styles="background-color: #dbcd59">Acción</th>
         
        </tr>
        <?php
           $contador = 0;
           foreach($roles_permisos as $rol_permiso){
                if ($id == $rol_permiso['rol_id'] ){
                $id_rol_permiso = $rol_permiso['id_rol_permiso']; 
                $contador = $contador + 1; ?>
           <tr>
           <td><center><?=$contador;?></center></td>
           <td><center><?=$rol_permiso['nombre'];?></center></td>
           <td><center><?=$rol_permiso['nombre_url'];?></center></td>
           <td>
              <button type="submit" class="btn btn-danger mb-2" id="btn_borrar<?=$id_rol_permiso;?>">Borrar</button>
              <script>
                
                $('#btn_borrar<?=$id_rol_permiso;?>').click( function () {
                var id_rol_permiso = $('#id_rol_permiso<?=$id_rol_permiso;?>').val();
                var url = "../roles/controller_delete_roles_permisos.php";
                $.get(url,{id_rol_permiso:id_rol_permiso}, function (datos){
                $('#respuesta<?=$id_rol_permiso;?>').html(datos);
                $('#tabla<?=$id_rol_permiso;?>').css('display','none');            
                });
                });
              </script>
                  <div id="respuesta<?=$id_rol_permiso;?>"></div>
            </td>
          </tr>
              <?php
                     }
                    }
                  ?> 
          </table>
        
          </div>
          </div>
      </div>
  </div>
  </div>
</div>
  


                     </center>
    
                  </td>
              </tr>
              <?php 
                  }     
                  ?>
         </table>
         </div>
        </div>
        </div> 

   
    </div>
    <?php include('../layout/admin/footer.php');?> 
</div>
<?php include('../layout/admin/footer_link.php');?> 
</body>
</html>

