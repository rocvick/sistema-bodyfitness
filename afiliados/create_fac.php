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
            $query_afiliado = $pdo->prepare("SELECT * FROM tb_afiliados WHERE ci = '$id_get' ");
            $query_afiliado->execute();
            $afiliados = $query_afiliado-> fetchALL(PDO::FETCH_ASSOC);
            foreach($afiliados as $afiliado){
            $fecha_reg = $afiliado['fecha_reg'];
            $ci = $afiliado['ci'];
            $nombres = $afiliado['nombres'];
            $apellidos = $afiliado['apellidos'];
            $membrecia = $afiliado['membrecia_registro'];
            $estado = $afiliado['estado'];
            $email = $afiliado['email'];
            $telefono = $afiliado['telefono'];
            $direccion = $afiliado['direccion'];
            $membrecia_registro = $afiliado['membrecia_registro'];
            $nombre_memb = $afiliado['nombre_memb'];
            $valor_memb = $afiliado['valor_memb'];

            }
            ?>
             <script>alert('ALERTA: FACTURE AL AFILIADO POR AQUÍ SI ES LA PRIMERA VEZ, DE NO  SER ASÍ DEBE IR AL MENÚ DE FACTURACIÓN PARA GENERAR UNA NUEVA FACTURA A ESTE AFILIADO')</script>

            <form action="../facturas/controller_create.php" method="post" enctype="multipart/form-data">
                          
                <div class="row">
                    <div class="card col-md-12" style= "border: 1px solid #606060" >
                        <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                            <h4>Procesar Nuevo Pago</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="num_fact" class="form-label">Nro:</label>
                                <?php
                                $query_factura = $pdo->prepare("SELECT * FROM tb_facturas");
                                $query_factura->execute();
                                $facturas = $query_factura-> fetchALL(PDO::FETCH_ASSOC);
                                foreach($facturas as $factura){$num_fact = $factura['num_fact']+1;}?>
                                <input readonly type="number" class="form-control" name="num_fact" value="<?php echo $num_fact;?>">
                            </div>
                           
                            <div class="col-md-2">                               
                                <label for="fecha_fac" class="form-label">Fecha/Pago:</label>
                                <?php $fecha_reg = date("d/m/Y H:i", strtotime($fecha_reg)); ?>
                                <input readonly type="datetime" class="form-control" id="fecha_fac" name="fecha_fac" value="<?php echo $fecha_reg;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="ci" class="form-label">CI:</label>
                                <input readonly type="number" class="form-control" name="ci" id="ci" value="<?php echo $ci;?>">
                            </div>
                            <div class="col-md-3">
                                <label for="nombre_memb">Membrecia a Cancelar:</label>
                                <input readonly type="text" class="form-control" name="nombre_memb"  value="<?php echo $nombre_memb;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="estado" class="form-label">Estado/Afiliado:</label>
                                <input readonly type="text" style="background-color: red; color: white; font-weight: bold;;" class="form-control" id="estado" name="estado" value="<?php echo $estado;?>">
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
                       
                            <div class="col-md-3">
                                <label for="forma_pago">Forma de Pago:</label>
                                <div class="form-check">
                                    <input type="radio" name="formapago" value="debito_efectivo_pagomovil"  onchange="calcularCampo_Efectivo_pagomovil()">
                                    <label for="debito_efectivo_pagomovil">Débito / Efectivo / Pago Móvil</label>
                                    <br>
                                    <input type="radio" name="formapago" value="divisas" onchange="calcularCampo_Divisas()">
                                    <label for="divisas">Divisas</label>
                                    <input type="radio" name="formapago" value="pago_combinado" id="pago_combinado" onchange="calcularCampo_Combinado()">
                                    <label for="pago_combinado">Pago Combinado</label>
                                </div>                            
                            </div> 
                            
                            <div class="col-md-2">
                                <label for="precio_div">Precio en Divisas (USD):</label>
                                <input readonly type='number' step='00.00' class="form-control" name="precio_div" value="<?php echo $valor_memb; ?>" >
                            </div>

                  
                              
                            <div id="efectivo_pagomovil_fields" style="display: none;">
                                <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="precio_div">Total en Divisas (USD):</label>
                                        <input readonly type='number' step='00.00' class="form-control" name="precio_div" value="<?php echo $valor_memb; ?>" >
                                    </div>
                                    <div class="col-md-2">
                                        <label for="precio_bs">Tasa de Calculo (Bs.):</label>
                                        <?php
                                        $query_divisa = $pdo->prepare("SELECT * FROM tb_divisas WHERE  estado = '1'  ");
                                        $query_divisa->execute();
                                        $divisas = $query_divisa-> fetchALL(PDO::FETCH_ASSOC);
                                        foreach($divisas as $divisa){$valor_div_bcv = $divisa['valor_div_bcv'];}?>
                                        <input readonly type='number' step='00.00' class="form-control" name="precio_bs" id="precio_bs" value="<?php echo $valor_div_bcv; ?>" >
                                    </div>
                                       
                                        <div class="col-md-3">
                                            <label for="subtotal">Subtotal:</label>
                                            <input readonly type='number' step='00.00' class="form-control" name="subtotal" id="subtotal">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="iva_calc">IVA(16%):</label>
                                            <input readonly type='number' step='00.00' class="form-control" name="iva_calc" id="iva_calc">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="monto_de_cancelacion">Total a  Cancelar (Bs.):</label>
                                            <input readonly type='number' step='00.00' class="form-control" name="monto_de_cancelacion" id="monto_de_cancelacion">
                                        </div>
                                </div>
                            </div>

                                <!-- Aquí mostramos las variables que se ocultaron en  <div id="efectivo_pagomovil_fields" style="display: none;"> -->
                                <div class="row" hidden>
                                    <input readonly type='number' step='00.00' class="form-control" name="precio_div" value="<?php echo $valor_memb; ?>" >
                                    <?php $query_divisa = $pdo->prepare("SELECT * FROM tb_divisas WHERE  estado = '1'  ");
                                            $query_divisa->execute();
                                            $divisas = $query_divisa-> fetchALL(PDO::FETCH_ASSOC);
                                            foreach($divisas as $divisa){$valor_div_bcv = $divisa['valor_div_bcv'];}?>
                                    <input readonly type='number' step='00.00' class="form-control" name="precio_bs" id="precio_bs" value="<?php echo $valor_div_bcv; ?>" >
                                    <input readonly type='number' step='00.00' class="form-control" name="subtotal" id="subtotal" value="">
                                    <input readonly type='number' step='00.00' class="form-control" name="iva_calc" id="iva_calc" value="">
                                    <input readonly type='number' step='00.00' class="form-control" name="monto_de_cancelacion" id="monto_de_cancelacion" value="">
                                </div>
                       
                           
                            <div id="divisas_fields" style="display: none;">
                            <br>
                               <div class="row">
                                    <div class="col-md-6" >
                                        <label for="precio_div">Pago Global (USD):</label>
                                        <input readonly type='number' step='00.00' class="form-control" name="precio_div" value="<?php echo $valor_memb; ?>" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pago_divisas">Total a  Cancelar (USD):</label>
                                        <input readonly type='number' step='00.00' class="form-control" name="pago_divisas"  value="<?php echo $valor_memb; ?>">
                                    </div>
                                   
                                </div>
                            </div>
                                                   
                            </div>
                          <div id="pago_combinado_fields" style="display: none;">
                                   <br>
                                  <div class="row">
                                      <div class="col-md-2">
                                          <label for="divisas_monto">A cancelar (USD):</label>
                                          <input type="number" class="form-control" id="pago_en_divisa" name="pago_en_divisa" oninput="calcularCampo_Divisas2()">
                                          <span id="pago_en_divisa_value"></span>
                                       </div>
                                       <div class="col-md-2">
                                          <label for="restante_divisas">Restante (USD):</label>
                                          <input type="number" class="form-control" id="restante_divisas" name="restante_divisas" readonly>
                                          <span id="restante_divisas_value"></span>
                                       </div>
                                       <div class="col-md-1">
                                            <label for="precio_bs">Tasa (Bs.):</label>
                                            <?php
                                            $query_divisa = $pdo->prepare("SELECT * FROM tb_divisas WHERE  estado = '1'  ");
                                            $query_divisa->execute();
                                            $divisas = $query_divisa-> fetchALL(PDO::FETCH_ASSOC);
                                            foreach($divisas as $divisa){$valor_div_bcv = $divisa['valor_div_bcv'];}?>
                                            <input readonly type='number' step='00.00' class="form-control" name="precio_bs" id="precio_bs" value="<?php echo $valor_div_bcv; ?>" >
                                       </div>
                                       <div class="col-md-2">
                                           <label for="subtotal_efect_pm">Subtotal Efect/PM:</label>
                                           <input type="number" class="form-control" id="subtotal_efect_pm" name="subtotal_efect_pm" readonly>
                                           <span id="subtotal_efect_pm_value"></span>
                                       </div>
                                       <div class="col-md-1">
                                           <label for="iva_efectivo_pagomovil">IVA (16%):</label>
                                           <input type="number" class="form-control" id="iva_efectivo_pagomovil" name="iva_efectivo_pagomovil" readonly>
                                           <span id="iva_efectivo_pagomovil_value"></span>
                                       </div>
                                       <div class="col-md-3">
                                           <label for="efectivo_pagomovil_monto">Total Débito/Efectivo/Pago Móvil:</label>
                                           <input type="number" class="form-control" id="efectivo_pagomovil" name="efectivo_pagomovil" readonly>
                                           <span id="efectivo_pagomovil_value"></span>
                                       </div>
                                  </div>
                            </div>
                           
                                <script>
                                     
                                     var $valor_div_bcv = <?php echo $valor_div_bcv; ?>;
                                     var $valor_memb = <?php echo $valor_memb; ?>;
                                     function calcularCampo_Divisas2() {
                                         var total_cancelar = $valor_memb * $valor_div_bcv;
                                         var pago_en_divisa = document.getElementById("pago_en_divisa").value;
                                         var efectivo_pagomovil = (total_cancelar - (pago_en_divisa * $valor_div_bcv)).toFixed(2);
                                         document.getElementById("efectivo_pagomovil").value = efectivo_pagomovil;
                                         var restante_divisas = ($valor_memb - pago_en_divisa).toFixed(2);
                                         document.getElementById("restante_divisas").value = restante_divisas;
                                         var subtotal_efect_pm = (efectivo_pagomovil/(1.159)).toFixed(2);
                                         document.getElementById("subtotal_efect_pm").value = subtotal_efect_pm;
                                         var iva_efectivo_pagomovil = (efectivo_pagomovil - subtotal_efect_pm).toFixed(2);
                                         document.getElementById("iva_efectivo_pagomovil").value = iva_efectivo_pagomovil;
                                         
                                                                         
                                        }
                                </script>

                                <script>
                                            function calcularCampo_Efectivo_pagomovil() {
                                            var forma_pago = document.querySelector('input[name="formapago"]:checked').value;
                                        if (forma_pago === "debito_efectivo_pagomovil") {
                                            var monto_de_cancelacion = ($valor_memb * $valor_div_bcv).toFixed(2);
                                            document.getElementById("monto_de_cancelacion").value = monto_de_cancelacion;
                                            var subtotal = (monto_de_cancelacion/(1.159)).toFixed(2);
                                            document.getElementById("subtotal").value = subtotal;
                                            var iva_calc = (monto_de_cancelacion - subtotal).toFixed(2);
                                            document.getElementById("iva_calc").value = iva_calc;

                                            // Actualizar los valores de los inputs ocultos
                                                document.querySelector("input[name='monto_de_cancelacion']").value = monto_de_cancelacion;
                                                document.querySelector("input[name='subtotal']").value = subtotal;
                                                document.querySelector("input[name='iva_calc']").value = iva_calc;

                                            document.getElementById("pago_combinado_fields").style.display = "none";
                                            document.getElementById("divisas_fields").style.display = "none";
                                            document.getElementById("efectivo_pagomovil_fields").style.display = "block";
                                        } else {
                                            document.getElementById("efectivo_pagomovil_fields").style.display = "none";
                                        }
                                        }

                                        function calcularCampo_Divisas() {
                                        var forma_pago = document.querySelector('input[name="formapago"]:checked').value;
                                        if (forma_pago === "divisas") {
                                            var monto_de_cancelacion = ($valor_memb * $valor_div_bcv).toFixed(2);
                                            document.getElementById("monto_de_cancelacion").value = monto_de_cancelacion;
                                            var subtotal = (monto_de_cancelacion/(1.159)).toFixed(2);
                                            document.getElementById("subtotal").value = subtotal;
                                            var iva_calc = (monto_de_cancelacion - subtotal).toFixed(2);
                                            document.getElementById("iva_calc").value = iva_calc;

                                            // Actualizar los valores de los inputs ocultos
                                                document.querySelector("input[name='monto_de_cancelacion']").value = monto_de_cancelacion;
                                                document.querySelector("input[name='subtotal']").value = subtotal;
                                                document.querySelector("input[name='iva_calc']").value = iva_calc;

                                            document.getElementById("divisas_fields").style.display = "block";
                                            document.getElementById("pago_combinado_fields").style.display = "none";
                                            document.getElementById("efectivo_pagomovil_fields").style.display = "none";
                                            
                                        } else {
                                            document.getElementById("divisas_fields").style.display = "none";
                                        }
                                        }

                                            function calcularCampo_Combinado() {
                                                var forma_pago = document.querySelector('input[name="formapago"]:checked').value;

                                                if (forma_pago === "pago_combinado") {
                                                    document.getElementById("pago_combinado_fields").style.display = "block";
                                                    document.getElementById("efectivo_pagomovil_fields").style.display = "none";
                                                    document.getElementById("divisas_fields").style.display = "none";
                                                } else {
                                                    document.getElementById("pago_combinado_fields").style.display = "none";
                                                }
                                            }
                                        </script>

                          <br>
                          <div class="form-group">
                                <br>
                                <?php
                                    $ci2 = $ci;
                                    $query_factura = $pdo->prepare("SELECT * FROM tb_facturas WHERE ci = :ci");
                                    $query_factura->bindParam(':ci', $ci2);
                                    $query_factura->execute();
                                    $facturas = $query_factura->fetchAll(PDO::FETCH_ASSOC);

                                    $boton_deshabilitado = false;
                                    foreach ($facturas as $factura) {
                                        if ($ci2 == $factura['ci']) {
                                            // Si el afiliado ya facturó por primera vez, deshabilitar el botón de facturación
                                            $boton_deshabilitado = true;
                                            break;
                                        }
                                    }
                                ?>

                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary" value="Pagar" onclick="return validarFormaPago();" <?php if ($boton_deshabilitado) echo 'disabled'; ?>>
                                    <a href="../afiliados/" class="btn btn-default">Cancelar</a>
                                </div>

                                <script>
                                function validarFormaPago() {
                                    var formaPago = document.querySelector('input[name="formapago"]:checked');
                                    if (!formaPago) {
                                        alert("Debe seleccionar una forma de pago antes de continuar.");
                                        return false; // Evita que se envíe el formulario
                                    }
                                    return true; // Permite que se envíe el formulario
                                }
                                </script>

                            </div>
                            <div id= "respuesta"></div>
                                     
            </form>

        </div>
    </div>
    <?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_link.php');?>
</body>
</html>


