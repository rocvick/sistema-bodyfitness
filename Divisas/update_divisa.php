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

                            <div class="card card-primary" style="border: 1px solid #777777">
                                <div class="card-header">
                                    <h3 class="card-title"><b>Datos Última Actualización</h3></b>

                                </div>

                                    <div class="card-body">
                                    <div class="form-group" >
                                        <?php
                                        $date = date_create($fyh_actualizacion);
                                        $fyh_actualizacion= date_format($date, 'd/m/Y H:i');
                                        ?>
                                        <label for="fyh_actualizacion" >Fecha Última Actualización:</label>
                                        <input type="datetime" id="fyh_actualizacion" value="<?php echo $fyh_actualizacion;?>"disabled>
                                    </div>
                                    <div class="formgroup">
                                        <label for="">Tipo de  Divisa:</label>
                                        <input type="text" class="form-control" id="tipo_div" value="<?php echo $tipo_div;?>"disabled>
                                    </div>
                                    <div class="formgroup">
                                       <label for="">Valor de la Divisa:</label>
                                        <input type='number' step='00.01' class="form-control" placeholder='0.00' id="valor_div_bcv" value="<?php echo $valor_div_bcv;?>"disabled>

                                    </div>
                                    <br>
                                    <div class="formgroup">
                                        <a href="../Divisas/index.php" class= "btn btn-secondary">Salir</a>

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



