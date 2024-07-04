<?php
$id_permiso = $_GET['id'];
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
include('../roles/datos_permisos.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('../layout/admin/head.php');?>
 </head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include('../layout/admin/menu.php');?>

    <div class="content-wrapper">
        <br>
        <div class="content">
            <form action="controller_delete_per.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="card col-md-6" style= "border: 1px solid #606060" >
                        <div class="card-header" style= "background-color: #DC143C; color: #FFFFFF">
                            <h4>Eliminar Permiso</h4>
                        </div>
                   
                        <div class="card-body">
                            <div class="container-fluid">
                           
                                <br>
                                <div class="row">
                                <div class="col-md-8">
                                    <label for="nombre_URL">Nombre de la URL:</label>
                                    <input type="text" value="<?=$id_permiso;?>" class="form-control" name="id_permiso" hidden>
                                    <input type="text" value="<?=$nombre_url;?>" class="form-control" name="nombre_url" disabled>
                                </div>
                                </div> 
                                <br>
                                <div class="row">
                                <div class="col-md-8">
                                    <label for="URL">URL:</label>
                                    <input type="text" value="<?=$url_url;?>"class="form-control" name="url_url" disabled>
                                </div>
                                </div>                         
                                        <br>
                                        <script>alert('¿Seguro de querer ELIMINAR este Registro?')</script>
                                        <center>
                                            <input  type="submit" class="btn btn-danger" value="Eliminar"></input>
                                            <a href="permisos.php" class= "btn btn-default">Cancelar</a>
                                        </center>
                                        <div id= "respuesta"></div>
                                    </div>
                                </div>

                        </div>
                    </div>


                </div>
        </div>
        </form>
    </div>

</div>
<?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_link.php');?>
</body>
</html>
