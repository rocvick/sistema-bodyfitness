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
        <div class="container">
            <h2>Agregar Membrecia</h2>
            <div class="container">
                <div class="row">
                    <div class="col md-6*2">
                        <div class="card" style= "border: 1px solid #606060" >
                            <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                                <h4>Nueva Membrecía</h4>
                            </div>
                            <div class="card-body">
                                <div class="formgroup">
                                    <label for="">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre">
                                </div>
                                <div class="formgroup">
                                    <label for="">Precio en Divisas:</label>
                                    <input type="email" class="form-control"  id="precio_div">
                                </div>

                                <br>
                                <div class="formgroup">
                                    <button class= "btn btn-primary" id= "btn_guardar">Guardar</button>
                                    <a href="../membrecias/"" class= "btn btn-default">Cancelar</a>
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
    <?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_link.php');?>
</body>
</html>

<script>
    $('#btn_guardar').click(function(){

        var nombre = $('#nombre').val();
        var precio_div = $('#precio_div').val();
       // var password_user = $('#password_user').val();

        if(nombre == ""){
            alert('Debe de  llenar el  campo NOMBRE');
            $('#nombre').focus();
        }else if(precio_div == ""){
            alert('Debe de  llenar el campo  de PRECIO EN DIVISAS');
            $('#precio_div').focus();

        }else{
            var url = 'controller_create.php';
            $.post(url , {nombre:nombre , precio_div:precio_div} , function(datos){
                $('#respuesta').html(datos);
            });
        }
    });

</script>