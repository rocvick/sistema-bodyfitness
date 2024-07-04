<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
include('../roles/listado_permisos.php');
?>

<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../layout/admin/head.php');?>
    <?php include('../layout/admin/footer_link.php');?>
</head>

<body class="hold-transition sidebar-mini">
 <div class="wrapper">
    <?php include('../layout/admin/menu.php');?>

    <div class="content-wrapper">

        <div class="card col-md-12" style= "border: 1px solid #606060" >
            <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                 <h4>Listado de Permisos</h4>
            </div>
        </div>
       
    
<div class="row">
<div class="col-md-12">
<div class="card card-outline card-primary">
<div class="card-header">
        <h3 class="card-title">Permisos Registrados </h3>
        <div class="card-tools">
             <a href="create_permiso.php" class="btn btn-primary"><i class= "bi bi-plus-square"></i>Crear Nuevo Permiso</a>
          </div>
        </div>
                   <table id="table_id" class="display table table-bordered" style="width:100%">
                     <thead>
                      <tr>
                        <th><center>Nro</center></th>
                        <th>Permiso</th>
                        <th>URL</th>
                        <th><center>Acción</center></th>
                      </tr>
                     </thead>
                     <tbody>
                     <?php
                         $contador_permisos = 0; 
                         foreach($permisos as $permiso){
                         $id_permiso = $permiso['id_permiso'];
                         $nombre_url = $permiso['nombre_url'];
                         $url_url = $permiso['url_url'];
                         $contador_permisos = $contador_permisos + 1;
                        
                       ?> 

                <tr>
                   <td><center><?php echo $contador_permisos; ?></center></td>
                   <td><?php echo $permiso['nombre_url']; ?></td>
                   <td><?php echo $permiso['url_url']; ?></td>
                <td>             
                    <center>
                       <a href="editar_per.php?id=<?php echo $id_permiso;?>" class= "btn btn-success btn-sm">Editar</a>
                       <a href="delete_per.php?id=<?php echo $id_permiso;?>" class= "btn btn-danger btn-sm">Borrar</a>
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
</div>

<?php include('../layout/admin/footer_link.php');?>

</body>
</html>
<script>
            $(document).ready( function () {
                $('#table_id').DataTable();

                                  
               } );
        </script>
