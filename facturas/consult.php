<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
?>

<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
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

            $id_get = $_GET['id'];
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
                $formapago = $factura['formapago'];
                $pago_divisas = $factura['pago_divisas'];
                $igtf = $factura['igtf'];

            }
            $ticket1 = $num_fact;
            ?>

            <form action="controller_create.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="card col-md-12" style= "border: 1px solid #606060" >
                        <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                            <h4>Información del Último Pago</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="num_fact" class="form-label">Nro. Control:</label>
                                <input  readonly type="number" class="form-control" id="num_fact<?php echo $ci;?>" name="num_fact" value="<?php echo $num_fact;?>">
                            </div>
                            <div class="col-md-3">
                                <?php
                                $date = date_create($fecha_fac);
                                $fecha_fac= date_format($date, 'd/m/Y H:i');
                                ?>
                                <label for="fecha_fac" class="form-label">Fecha y Hora/factura:</label>
                                <input readonly type="datetime" class="form-control" id="fecha_fac<?php echo $ci;?>" name="fecha_fac" value="<?php echo $fecha_fac;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="ci" class="form-label">CI:</label>
                                <input readonly type="text" class="form-control" name="ci" id="ci<?php echo $ci;?>" value="<?php echo $ci;?>">
                            </div>
                            <div class="col-md-3">
                                <label for="nombre_memb">Membrecia Cancelada:</label>
                                <input readonly type="text" class="form-control" name="nombre_memb" id="nombre_memb<?php echo $ci;?>"  value="<?php echo $nombre_memb;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="estado" class="form-label">Estado/Afiliado:</label>
                                <input readonly type="text" class="form-control" id="estado<?php echo $ci;?>" name="estado" value="<?php echo $estado;?>"  onchange="cambiarColor(this)">
                            </div>
                            
                        </div>
                        

                        <div class="row">
                            <div class="col-md-4">
                                <label for="nombres">Nombres:</label>
                                <input  readonly type="text" class="form-control" name="nombres" id="nombres<?php echo $ci;?>" value="<?php echo $nombres;?>">
                            </div>
                            <div class="col-md-4">
                                <label for="apellidos" >Apellidos:</label>
                                <input  readonly type="text" class="form-control" name="apellidos" id="apellidos<?php echo $ci;?>" value="<?php echo $apellidos;?>">
                            </div>
                            <div class="col-md-4">
                                <label for="email" >Email:</label>
                                <input readonly type="email" class="form-control" name="email" id="email<?php echo $ci;?>" value="<?php echo $email;?>">
                            </div>
                            <div class="col-md-4">
                                <label for="direccion" >Direccion:</label>
                                <input readonly type="text" class="form-control" name="direccion"  id="direccion<?php echo $ci;?>" value="<?php echo $direccion;?>">
                            </div>
                            <div class="col-md-3">
                                <label for="telefonos">Teléfono(s):</label>
                                <input readonly type="text" class="form-control" name="telefono" id="telefono<?php echo $ci;?>" value="<?php echo $telefono;?>">
                            </div>
                            <div class="col-md-3">
                                <label for="formapago">Forma de Pago:</label>
                                <input readonly type="text" class="form-control" name="formapago" id="formapago<?php echo $ci;?>" value="<?php echo $formapago;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="precio_div">Total Cancelado (USD):</label>
                                <input readonly type='number' step='00.00' class="form-control" name="precio_div" id="precio_div<?php echo $ci;?>" value="<?php echo $precio_div; ?>" >
                            </div>
                        </div>

                        <br>
                        <div class="row">
                        <?php 
                           if ($formapago == "pago_combinado") {
                            ?>
                             
                            <div class="col-md-2">
                                <label for="precio_div">Divisas (USD):</label>
                                <input readonly type='number' step='00.00' class="form-control" name="pago_divisas" id="pago_divisas<?php echo $ci;?>"  value="<?php echo $pago_divisas;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="precio_bs">Tasa(Bs.):</label>
                                <input readonly type='number' step='00.00' class="form-control" name="precio_bs" id="precio_bs<?php echo $ci;?>" value="<?php echo $precio_bs;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="monto_de_cancelacion">Efectivo (Bs.):</label>
                                <input readonly type='number' step='00.00' class="form-control" name="monto_de_cancelacio" id="monto_de_cancelacion<?php echo $ci;?>" value="<?php echo $monto_de_cancelacion;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="subtotal">Subtotal:</label>
                                <input readonly type='number' step='00.00' class="form-control" name="subtotal" id="subtotal<?php echo $ci;?>" value="<?php echo $subtotal;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="iva_calc">IVA (16%):</label>
                                <input readonly type='number' step='00.00' class="form-control" name="iva_calc" id="iva_calc<?php echo $ci;?>" value="<?php echo $iva_calc;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="igtf">IGTF:</label>
                                <input readonly type='number' step='00.00' class="form-control" name="igtf" id="igtf<?php echo $ci;?>" value="<?php echo $igtf;?>">
                            </div>
                            
                            <?php

                        }
                        ?>  
                        </div>

                        <br>  
                        <div class="row">
                        <?php 
                           if ($formapago == "divisas") {
                            ?>
                             <div class="col-md-2">
                                <label for="precio_div">Total Cancelado (USD):</label>
                                <input readonly type='number' step='00.00' class="form-control" name="precio_div" id="precio_div<?php echo $ci;?>"  value="<?php echo $precio_div;?>">
                            </div>
                            <div class="col-md-3">
                                        <label for="precio_div">Monto pagado en Divisas (USD):</label>
                                        <input readonly type='number' step='00.00' class="form-control" name="pago_divisas" id="pago_divisas<?php echo $ci;?>"  value="<?php echo $precio_div;?>"><br>
                                    </div>
                                                              
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="subtotal" class="control-label col-form-label-sm">Subtotal:</label>
                                                <input readonly type='number' step='00.00' class="form-control form-control-sm" name="subtotal" id="subtotal<?php echo $ci;?>" value="<?php echo $subtotal; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="iva_calc" class="control-label col-form-label-sm">IVA(16%):</label>
                                                    <input readonly type='number' step='00.00' class="form-control form-control-sm" name="iva_calc" id="iva_calc<?php echo $ci;?>" value="<?php echo $iva_calc; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="iva_calc" class="control-label col-form-label-sm">IGTF(3%)::</label>
                                                    <input readonly type='number' step='00.00' class="form-control form-control-sm" name="igtf" id="igtf<?php echo $ci;?>" value="<?php echo $igtf; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="monto_de_cancelacion" class="control-label col-form-label-sm">Total Cancelado (Bs.):</label>
                                                    <input readonly type='number' step='00.00' class="form-control form-control-sm" name="monto_de_cancelacion" id="monto_de_cancelacion<?php echo $ci;?>" value="<?php echo $monto_de_cancelacion; ?>">
                                                </div>
                                            </div>
                                    
                          <?php

                        }
                        ?>  
                        </div>
                        <br> 
                        <div class="row">
                        <?php 
                           
                           if ($formapago == "debito_efectivo_pago") {
                            ?>
                            
                            <div class="col-md-2">
                                <label for="precio_bs">Tasa de Calculo (Bs.):</label>
                                <input readonly type='number' step='00.00' class="form-control" name="precio_bs" id="precio_bs<?php echo $ci;?>" value="<?php echo $precio_bs;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="precio_div">Subtotal:</label>
                                <input readonly type='number' step='00.00' class="form-control" name="subtotal" id="subtotal<?php echo $ci;?>"  value="<?php echo $subtotal;?>">
                            </div>
                           
                            <div class="col-md-3">
                                <label for="monto_de_cancelacion">IVA (16%):</label>
                                <input readonly type='number' step='00.00' class="form-control" name="iva_calc" id="iva_calc<?php echo $ci;?>" value="<?php echo $iva_calc;?>">
                            </div>
                            <div class="col-md-3">
                                <label for="monto_de_cancelacion">Monto Cancelado:</label>
                                <input readonly type='number' step='00.00' class="form-control" name="monto_de_cancelacio" id="monto_de_cancelacion<?php echo $ci;?>" value="<?php echo $monto_de_cancelacion;?>">
                            </div>
                            <div class="col-md-3" hidden>
                                <label for="precio_div">Monto pagado en Divisas (USD):</label>
                                <input readonly type='number' step='00.00' class="form-control" name="pago_divisas" id="pago_divisas<?php echo $ci;?>"  value="<?php echo $pago_divisas;?>">
                            </div>
                            <?php

                        }
                        ?> 
                          </div>    

                        <div class="form-group">
                            <br>
                            <center>

                                <?php
                                    $id_get=$_GET['id'];
                                    $query_ticket = $pdo->prepare("SELECT * FROM tb_ticket WHERE ci = '$id_get' ");
                                    $query_ticket->execute();
                                    $ticket = $query_ticket-> fetchALL(PDO::FETCH_ASSOC);
                                    $swich = 0;
                                    ?>
                                <?php foreach($ticket as $tickets){
                                    $ticket2 = $tickets['num_fact'];
                                    if ($ticket2 == $ticket1){
                                       $swich=1;
                                       $ci = $tickets['ci'];                                       
                                       ?>
                                        <a href="../facturas/reimprimir_ticket.php?id=<?php echo $ci; ?>" class="btn btn-success" target="_blank">Re-imprimir</a> 
                                        <!--  <a href="../facturas/IntTFHKA/index2.php?id=<?php echo  $ci;?>" class= "btn btn-warning" target="_blank">Prueba</a>-->
                                       <?php
                                    };
                                }
                               
                                if ($swich==0){
                                        $ci = $_GET['id'];
                                      ?>
                                         <button type="button" class="btn btn-primary" id="btn_imprimir<?php echo $ci; ?>">Procesar Ticket</button>
                                        <?php
                                     
                                };

                                ?>
                                <a href="../facturas/" class= "btn btn-secondary">Regresar</a>
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


<script>

    $("#btn_imprimir<?php echo $ci;?>").click(function(){

        var nombres = $('#nombres<?php echo $ci;?>').val();
        var apellidos = $('#apellidos<?php echo $ci;?>').val();
        var ci = $('#ci<?php echo $ci;?>').val();
        var direccion = $('#direccion<?php echo $ci;?>').val();
        var telefono = $('#telefono<?php echo $ci;?>').val();
        var fecha_fac = $('#fecha_fac<?php echo $ci;?>').val();
        var num_fact= $('#num_fact<?php echo $ci;?>').val();
        var nombre_memb= $('#nombre_memb<?php echo $ci;?>').val();
        var precio_div = $('#precio_div<?php echo $ci;?>').val();
        var precio_bs = $('#precio_bs<?php echo $ci;?>').val();
        var subtotal = $('#subtotal<?php echo $ci;?>').val();
        var iva_calc = $('#iva_calc<?php echo $ci;?>').val();
        var igtf = $('#igtf<?php echo $ci;?>').val();
        var monto_de_cancelacion = $('#monto_de_cancelacion<?php echo $ci;?>').val();
        var formapago = $('#formapago<?php echo $ci;?>').val();
        var pago_divisas = $('#pago_divisas<?php echo $ci;?>').val();
        var estado = $('#estado<?php echo $ci;?>').val();
    

        var url = 'controller_create_impre.php';
        $.post(url , {nombres:nombres , apellidos:apellidos , ci:ci , direccion:direccion , telefono:telefono ,
            fecha_fac:fecha_fac , num_fact:num_fact , nombre_memb:nombre_memb , precio_div:precio_div ,
            precio_bs:precio_bs , subtotal:subtotal , iva_calc:iva_calc , monto_de_cancelacion:monto_de_cancelacion ,
            formapago:formapago , pago_divisas:pago_divisas , igtf:igtf , estado:estado} , function(datos){
            $('#respuesta').html(datos);
        });

      });
    
</script>