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

                <?php
                $id_get= $_GET['id'];
                $query_membrecia = $pdo->prepare("SELECT * FROM tb_membrecias WHERE id = '$id_get' AND estado = '1' ");
                $query_membrecia->execute();
                $membrecias = $query_membrecia-> fetchALL(PDO::FETCH_ASSOC);
                foreach($membrecias as $membrecia){
                    $id = $membrecia['id'];
                    $nombre = $membrecia['nombre'];
                    $precio_div = $membrecia['precio_div'];
                  }
                ?>

                <h2>Actualización de la Membrecia</h2>
                <div class="container">
                    <div class="row">
                        <div class="col md-6*2">

                            <div class="card card-success" style="border: 1px solid #777777">
                                <div class="card-header">
                                    <h3 class="card-title">Edición de la Membrecia</h3>

                                </div>

                                <div class="card-body">
                                    <div class="formgroup">
                                        <label for="">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" value="<?php echo $nombre;?>">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Precio en Divisas:</label>
                                        <input type="precio_div" class="form-control"  id="precio_div" value="<?php echo $precio_div;?>">
                                    </div>
                                    <br>
                                    <div class="formgroup">
                                        <button class= "btn btn-success" id= "btn_editar">Actualizar</button>
                                        <a href="../membrecias/" class= "btn btn-default">Cancelar</a>
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
    $('#btn_editar').click(function(){

        var nombre = $('#nombre').val();
        var precio_div = $('#precio_div').val();
        var id_memb = '<?php echo $id_get= $_GET['id'];?>';
        if(nombre == ""){
            alert('Debe de  llenar el  campo NOMBRE');
            $('#nombre').focus();
        }else if(precio_div == ""){
            alert('Debe de  llenar el campo  de PRECIO EN DIVISAS');
            $('#precio_div').focus();
        }else{
            var url = 'controller_update.php';
            $.post(url , {nombre:nombre , precio_div:precio_div, id_memb:id_memb} , function(datos){
                $('#respuesta').html(datos);
            });
        }

    });

</script>
