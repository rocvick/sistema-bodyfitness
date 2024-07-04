<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
?>

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

   <div class="container">
     <h2>Eliminación de un Rol</h2>
   <?php
            $id_rol = $_GET['id']; 
            $query_roles = $pdo->prepare("SELECT * FROM tb_roles WHERE id_rol = '$id_rol' AND estado = '1' ");
            $query_roles->execute();
            $roles = $query_roles-> fetchALL(PDO::FETCH_ASSOC);
            foreach($roles as $role){
                $id_rol= $role['id_rol'];
                $nombre = $role['nombre'];
              }
          
            ?> 


        <div class="container">
            <div class="row">
            <div class="col md-6*2">
                <div class="card" style= "border: 1px solid #606060" >
                    <div class="card-header" style= "background-color: #DC143C; color: #ffffff">
                    <h4>¿Seguro de Eliminar éste Rol?</h4>
                     </div>
                <div class="card-body">
                    <div class="formgroup">
                        <label for="">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" value=<?php echo $nombre; ?>>
                        <input type="text" class="form-control" id="id_rol" value=<?php echo $id_rol; ?> hidden>
                    </div>
                    <br>
                    <div class="formgroup">
                    <button class= "btn btn-danger" id= "btn_borrar">Eliminar</button>
                     
                    </div>
                    <div id= "respuesta"></div>
                 </div>
                 </div>
            </div>
                <div class="col md-6*2"></div>
         </div>
        </div>
   </div>   
   </div>
  
    </div>
    <?php include('../layout/admin/footer.php');?> 
</div>
<?php include('../layout/admin/footer_link.php');?> 
</body>
</html>

<script>
     
        $('#btn_borrar').click(function(){
         
        var id_rol = $('#id_rol').val();
         var url = 'controller_delete.php';
            $.post(url , {id_rol:id_rol} , function(datos){
            $('#respuesta').html(datos);
      
      })        
    });

</script>