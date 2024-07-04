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
                $id_get = $_GET['id'];
                $query_divisa = $pdo->prepare("SELECT * FROM tb_divisas WHERE  id = '$id_get'  AND estado = '1'");
                $query_divisa->execute();
                $divisas = $query_divisa-> fetchALL(PDO::FETCH_ASSOC);
                foreach($divisas as $divisa){
                    $fyh_actualizacion = $divisa['fyh_actualizacion'];
                    $tipo_div = $divisa['tipo_div'];
                    $valor_div_bcv = $divisa['valor_div_bcv'];

                }

                ?>

                <div class="container">
                    <div class="row">
                        <div class="col md-6*2">

                            <div class="card card-danger" style="border: 1px solid #777777">
                                <div class="card-header">
                                    <h3 class="card-title"><b>Eliminación del Registro</h3></b>

                                </div>
                                <h4 class="card-title"><b><center>¿Seguro de querer Eliminar éste Registro?</center></h4></b>
                                <div class="card-body">

                                    <div class="form-group" >
                                        <?php
                                        $date = date_create($fyh_actualizacion);
                                        $fyh_actualizacion= date_format($date, 'd/m/Y H:i');
                                        ?>
                                        <label for="" >Fecha Última Actualización:</label>
                                        <input readonly type="datetime" class="form-control" id="fyh_actualizacion" value="<?php echo $fyh_actualizacion;?>">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Tipo de  Divisa:</label>
                                        <input readonly type="text" class="form-control" id="tipo_div" value="<?php echo $tipo_div;?>">
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Valor de la Divisa:</label>
                                        <input type='number' step='00.01' class="form-control" placeholder='0.00' id="valor_div_bcv" value="<?php echo $valor_div_bcv;?>"disabled>

                                    </div>
                                    <br>
                                    <div class="formgroup">
                                        <button class= "btn btn-danger" id= "btn_eliminar">Eliminar</button>
                                        <a href="../Divisas/index.php" class= "btn btn-secondary">Salir</a>
                                    </div>
                                    <div   id= "respuesta">
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

    $('#btn_eliminar').click(function(){

        var id_div = '<?php echo $id_get;?>';

       var url = 'controller_delete.php';
            $.post(url , {id_div:id_div} , function(datos){
                $('#respuesta').html(datos);
            });
        });

</script>