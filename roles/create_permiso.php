<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

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
            <form action="controller_permiso.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="card col-md-6" style= "border: 1px solid #606060" >
                        <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                            <h4>Registro de Nuevo Permiso</h4>
                        </div>
                   
                        <div class="card-body">
                            <div class="container-fluid">
                           
                                <br>
                                <div class="row">
                                <div class="col-md-8">
                                    <label for="nombre_URL">Nombre de la URL:</label>
                                    <input type="text" class="form-control" name="nombre_url">
                                </div>
                                </div> 
                                <br>
                                <div class="row">
                                <div class="col-md-8">
                                    <label for="URL">URL:</label>
                                    <input type="text" class="form-control" name="url_url">
                                </div>
                                </div>                         
                                        <br>
                                        <center>
                                            <input  type="submit" class="btn btn-primary" value="Registrar"></input>
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


