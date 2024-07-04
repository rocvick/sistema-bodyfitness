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
            <?php

            $id_get=$_GET['id'];
            $query_factura = $pdo->prepare("SELECT * FROM tb_facturas WHERE ci = '$id_get' ");
            $query_factura->execute();
            $facturas = $query_factura-> fetchALL(PDO::FETCH_ASSOC);
            foreach($facturas as $factura){
                $ci = $factura['ci'];
                $num_fact = $factura['num_fact'];
                $nombres = $factura['nombres'];
                $apellidos = $factura['apellidos'];
                $email = $factura['email'];
                $telefono = $factura['telefono'];
                $direccion = $factura['direccion'];
                $nombre_memb = $factura['nombre_memb'];
                $precio_div = $factura['precio_div'];
                $precio_bs = $factura['precio_bs'];
                $monto_de_cancelacion = $factura['monto_de_cancelacion'];
                $iva_calc = $factura['iva_calc'];
                $subtotal = $factura['subtotal'];
                $fecha_fac= $factura['fecha_fac'];
                $estado = $factura['estado'];

            }
            ?>

            <form action="controller_create_impre.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="card col-md-12" style= "border: 1px solid #606060" >
                        <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                            <h4>Procesar Pago</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="num_fact" class="form-label">N° Control:</label>
                                <?php
                                $query_factura = $pdo->prepare("SELECT * FROM tb_facturas");
                                $query_factura->execute();
                                $facturas = $query_factura-> fetchALL(PDO::FETCH_ASSOC);
                                foreach($facturas as $factura){$num_fact = $factura['num_fact']+1;}?>
                                <input readonly type="number" class="form-control" name="num_fact" value="<?php echo $num_fact;?>">
                            </div>
                            <?php
                            $originalDate = date("Y-m-d");
                            $DateTime = DateTime::createFromFormat('Y-m-d', $originalDate);
                            $fecha_fac = $DateTime->format('d-m-Y');
                            ?>
                            <div class="col-md-2">
                                <label for="fecha_fac" class="form-label">Fecha/Pago:</label>
                                <input readonly type="datetime" class="form-control" id="fecha_reg" name="fecha_fac" value="<?php echo $fecha_fac;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="ci" class="form-label">CI:</label>
                                <input readonly type="text" class="form-control" name="ci" id="ci" value="<?php echo $ci;?>">
                            </div>
                            <div class="col-md-3">
                                <label for="nombre_memb">Membrecia a Cancelar:</label>
                                <input readonly type="text" class="form-control" name="nombre_memb"  value="<?php echo $nombre_memb;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="estado" class="form-label">Estado/Afiliado:</label>
                                <input readonly type="text" class="form-control" id="estado" name="estado" value="<?php echo $estado;?>">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="nombres">Nombres:</label>
                                <input readonly type="text" class="form-control" name="nombres" value="<?php echo $nombres;?>">
                            </div>
                            <div class="col-md-4">
                                <label for="apellidos" >Apellidos:</label>
                                <input  readonly type="text" class="form-control" name="apellidos" value="<?php echo $apellidos;?>">
                            </div>
                            <div class="col-md-4">
                                <label for="email" >Email:</label>
                                <input readonly type="email" class="form-control" name="email" value="<?php echo $email;?>">
                            </div>
                            <div class="col-md-4">
                                <label for="direccion" >Direccion:</label>
                                <input readonly type="text" class="form-control" name="direccion" value="<?php echo $direccion;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="telefonos">Teléfono(s):</label>
                                <input readonly type="text" class="form-control" name="telefono" value="<?php echo $telefono;?>">
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="precio_div">Precio en Divisas (USD):</label>
                                <?php
                                $query_membrecia = $pdo->prepare("SELECT * FROM tb_membrecias");
                                $query_membrecia->execute();
                                $membrecias = $query_membrecia-> fetchALL(PDO::FETCH_ASSOC);
                                ?>
                                <?php foreach($membrecias as $membrecia){
                                    $memb_compara = $membrecia['id']."-".$membrecia['nombre'];

                                    if ($nombre_memb == $memb_compara){
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
                            $iva_calc = $total_cancelar - $subtotal;
                            $subtotal = $total_cancelar/(1.159);
                            ?>
                            <div class="col-md-3">
                                <label for="subtotal">Subtotal:</label>
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

                        </div>
                        <br>

                        <div class="form-group">
                            <br>
                            <center>
                                <input  type="submit" class="btn btn-primary " value="Imprimir" </input>
                                <a href="../facturas/"" class= "btn btn-default">Cancelar</a>
                            </center>
                            <div id= "respuesta"></div>

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


