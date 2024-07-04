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
                <h2>Creación de nueva información</h2>
                <div class="container">
                    <div class="row">
                        <div class="col md-6*2">
                            <div class="card" style= "border: 1px solid #606060" >
                                <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                                    <h4>Nueva Empresa</h4>
                                </div>
                                <div class="card-body">
                                    <div class="formgroup">
                                        <label for="">Nombre de la Empresa: <spam style="color:red"<b>*</b></spam></label>
                                        <input type="text" class="form-control" id="nombre_emp">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">RIF:<spam style="color:red"<b>*</b></spam></label>
                                        <input type="email" class="form-control"  id="rif_emp">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Dirección:<spam style="color:red"<b>*</b></spam></label>
                                        <input type="text" class="form-control"  id="direccion_emp">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Teléfono:<spam style="color:red"<b>*</b></spam></label>
                                        <input type="text" class="form-control"  id="telefono_emp">
                                    </div>
                                    <br>
                                    <div class="formgroup">
                                        <button class= "btn btn-primary" id= "btn_registrar_informacion">Registrar Información</button>
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
    $('#btn_registrar_informacion').click(function(){

        var nombre_emp = $('#nombre_emp').val();
        var rif_emp = $('#rif_emp').val();
        var direccion_emp = $('#direccion_emp').val();
        var telefono_emp = $('#telefono_emp').val();

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
            var url = 'controller_informaciones.php';
            $.post(url , {nombre_emp:nombre_emp , rif_emp:rif_emp, direccion_emp:direccion_emp , telefono_emp:telefono_emp} , function(datos){
                $('#respuesta').html(datos);
            });
        }
    });

</script>
