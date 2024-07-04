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
                <h2>Actualización de la información</h2>
                <div class="container">
                    <div class="row">
                        <div class="col md-6*2">
                            <div class=" card card-success">
                                <div class="card-header">
                                    <h4>Empresa</h4>
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
                                        <label for="">Nombre de la Empresa: <spam style="color:red"<b>*</b></spam></label>
                                        <input type="text" class="form-control" id="nombre_emp" value = "<?php echo $nombre_emp;?>">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">RIF:<spam style="color:red"<b>*</b></spam></label>
                                        <input type="email" class="form-control"  id="rif_emp" value = "<?php echo $rif_emp;?>">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Dirección:<spam style="color:red"<b>*</b></spam></label>
                                        <input type="text" class="form-control"  id="direccion_emp" value = "<?php echo $direccion_emp;?>">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Teléfono:<spam style="color:red"<b>*</b></spam></label>
                                        <input type="text" class="form-control"  id="telefono_emp" value = "<?php echo $telefono_emp;?>">
                                    </div>
                                    <br>
                                    <div class="formgroup">
                                        <button class= "btn btn-success" id= "btn_actualizar">Actualizar</button>
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
    $('#btn_actualizar').click(function(){

        var nombre_emp = $('#nombre_emp').val();
        var rif_emp = $('#rif_emp').val();
        var direccion_emp = $('#direccion_emp').val();
        var telefono_emp = $('#telefono_emp').val();
        var id_inf =  '<?php echo $id_inf_get;?>';

        if(nombre_emp == ""){
            alert('Debe de  llenar el  campo NOMBRE DE EMPRESA');
            $('#nombre_emp').focus();
        }else if(rif_emp == ""){
            alert('Debe colocar el RIF de la Empresa');
            $('#rif_emp').focus();
        }else if(direccion_emp == ""){
            alert('Debe colocar la DIRECCIÓN de la Empresa');
            $('#direccion_emp').focus();
        }else if(telefono_emp == ""){
            alert('Debe colocarel TELÉFONO de la Empresa');
            $('#telefono_emp').focus();
        }else{
            var url = 'controller_update_config.php';
            $.post(url , {nombre_emp:nombre_emp , rif_emp:rif_emp, direccion_emp:direccion_emp , telefono_emp:telefono_emp, id_inf:id_inf} , function(datos){
                $('#respuesta').html(datos);
            });
        }
    });

</script>

