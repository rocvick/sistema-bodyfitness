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
            <form action="controller_create.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="card col-md-12" style= "border: 1px solid #606060" >
                        <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                            <h4>Nueva Clase Diaria</h4>
                        </div>
                    </div>
                    <div class="card col-md-12" style= "border: 1px solid #606060" >
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php
                                    $originalDate = date("Y-m-d");
                                    $DateTime = DateTime::createFromFormat('Y-m-d', $originalDate);
                                    $fyh_registro = $DateTime->format('Y-m-d');
                                    ?>
                                <div class="col-md-2" >
                                    <label for="fyh_registro" >Fecha de Registro:</label>
                                    <input  readonly type="date" class="form-control" id="fyh_registro" name="fyh_registro" value="<?php echo $fyh_registro;?>">
                                </div>
                                <div class="col-md-2">
                                   <label for="id_cd">ID-CD:</label>
                                    <?php
                                    $query_clasediaria = $pdo->prepare("SELECT * FROM tb_clasesdiarias");
                                    $query_clasediaria->execute();
                                    $clasesdiarias = $query_clasediaria-> fetchALL(PDO::FETCH_ASSOC);
                                    foreach($clasesdiarias as $clasediaria){$id_cd = $clasediaria['id_cd']+1;}?>
                                    <input readonly type="number" class="form-control" name="id_cd" value="<?php echo $id_cd;?>">

                                </div>
                                <div class="col-md-4">
                                    <label for="nombre_apellido">Nombre y Apellido:</label>
                                    <input type="text" class="form-control" name="nombre_apellido">
                                </div>
                                <div class="col-md-4">
                                    <label for="email" >Email:</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <br>
                                </div>
                            </div>
                            <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="precio_div">Precio (USD):</label>
                                        <?php
                                        $query_membrecia = $pdo->prepare("SELECT * FROM tb_membrecias");
                                        $query_membrecia->execute();
                                        $membrecias = $query_membrecia-> fetchALL(PDO::FETCH_ASSOC);
                                        ?>
                                        <?php foreach($membrecias as $membrecia){
                                            $nombre_membrecia = $membrecia['nombre'];
                                            if ($nombre_membrecia == "CLASE DIARIA"){
                                                $precio_div = $membrecia['precio_div'];
                                            };
                                        }?>
                                        <input readonly type='number' step='00.00' class="form-control" name="precio_div"  value="<?php echo $precio_div;?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="precio_bs">Tasa de Calculo (Bs.):</label>
                                        <?php
                                        $query_divisa = $pdo->prepare("SELECT * FROM tb_divisas");
                                        $query_divisa->execute();
                                        $divisas = $query_divisa-> fetchALL(PDO::FETCH_ASSOC);
                                        foreach($divisas as $divisa){$precio_bs = $divisa['valor_div_bcv'];}?>
                                        <input readonly type='number' step='00.00' class="form-control" name="precio_bs" id="precio_bs" value="<?php echo $precio_bs;?>">
                                    </div>
                                    <?php
                                    $total_cancelar  = $precio_div * $precio_bs;
                                    $iva_calc = $total_cancelar * 16/100;
                                    $subtotal = $total_cancelar - $iva_calc;
                                    ?>
                                    <div class="col-md-3">
                                        <label for="subtotal">Subtotal (Bs):</label>
                                        <input readonly type='number' step='00.00' class="form-control" name="subtotal" id="subtotal" value="<?php echo $subtotal;?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="iva_calc">IVA(16%):</label>
                                        <input readonly type='number' step='00.00' class="form-control" name="iva_calc" id="iva_calc" value="<?php echo $iva_calc;?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="monto_de_cancelacion">Total a  Cancelar (Bs.):</label>
                                        <input readonly type='number' step='00.00' class="form-control" name="monto_de_cancelacion" id="monto_de_cancelacion" value="<?php echo $total_cancelar;?>">
                                    </div>
                                    <br>
                                    <br>
                                    <div class="card-body">
                                        <br>
                                        <br>
                                        <center>
                                            <input  type="submit" class="btn btn-primary" value="Aceptar" </input>
                                            <a href="../clasesdiarias/" class= "btn btn-default">Cancelar</a>
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



