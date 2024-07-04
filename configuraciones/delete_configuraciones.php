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
                <h2>Eliminación de la información</h2>
                <div class="container">
                    <div class="row">
                        <div class="col md-6*2">
                            <div class=" card card-danger">
                                <div class="card-header">
                                    <h4>¿Estás seguro de querer eliminar este registro?</h4>
                                </div>
                                <?php
                                $id_inf_get = $_GET['id'];
                                $query_informaciones = $pdo->prepare("SELECT * FROM tb_informaciones WHERE id_inf = $id_inf_get");
                                $query_informaciones->execute();
                                $informaciones = $query_informaciones-> fetchALL(PDO::FETCH_ASSOC);
                                foreach($informaciones as $informacion){
                                    $id = $informacion['id_inf'];
                                    $nombre_emp = $informacion['nombre_emp'];
                                    $rif_emp = $informacion['rif_emp'];
                                    $direccion_emp = $informacion['direccion_emp'];
                                    $telefono_emp = $informacion['telefono_emp'];

                                }
                                ?>


                                <div class="card-body">
                                    <div class="formgroup">
                                        <label for="">Nombre de la Empresa: <spam style="color:red"<b></b></spam></label>
                                        <input type="text" class="form-control" id="nombre_emp" value = "<?php echo $nombre_emp;?>" readonly>
                                    </div>
                                    <div class="formgroup">
                                        <label for="">RIF:<spam style="color:red"<b></b></spam></label>
                                        <input type="email" class="form-control"  id="rif_emp" value = "<?php echo $rif_emp;?>" readonly>
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Dirección:<spam style="color:red"<b></b></spam></label>
                                        <input type="text" class="form-control"  id="direccion_emp" value = "<?php echo $direccion_emp;?>" readonly>
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Teléfono:<spam style="color:red"<b></b></spam></label>
                                        <input type="text" class="form-control"  id="telefono_emp" value = "<?php echo $telefono_emp;?>" readonly>
                                    </div>
                                    <br>
                                    <div class="formgroup">
                                        <button class= "btn btn-danger" id= "btn_borrar">Borrar</button>
                                        <a href="informaciones.php" class= "btn btn-default">Cancelar</a>
                                    </div>
                                    <div   id= "respuesta">

                                    </div>
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

        var id_inf =  '<?php echo $id_inf_get;?>';

           var url = 'controller_delete_inf.php';
            $.post(url , {id_inf:id_inf} , function(datos){
                $('#respuesta').html(datos);
            });

    });

</script>
