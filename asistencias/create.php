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

            $id_get_fac=$_GET['id'];
            $query_factura = $pdo->prepare("SELECT * FROM tb_facturas WHERE ci = '$id_get_fac' ");
            $query_factura->execute();
            $facturas = $query_factura-> fetchALL(PDO::FETCH_ASSOC);
            foreach($facturas as $factura){
                $ident = $factura['ci'];
                $nombres = $factura['nombres'];
                $apellidos = $factura['apellidos'];
                $membrecia_registro = $factura['nombre_memb'];
                $fecha_ultimo_pago = $factura['fecha_fac'];
                $estadox = $factura['estado'];


            }
            ?>

            <form action="controller_create.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="card col-md-12" style= "border: 1px solid #606060" >
                        <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                            <h4>Asistencia Diaria</h4>
                        </div>


                        <div class="container">
                            <div class="card col-md-12" style= "border: 1px solid #606060" >
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-2" >
                                            <label for="fecha_actual" >Asiste Hoy:</label>
                                            <?php date_default_timezone_set("America/Caracas");
                                            $fecha_actual = date("d/m/Y H:i");
                                            $fecha_actual2 = date("Y/m/d H:i"); ?>

                                            <input readonly type="datetime" class="form-control"  name="fecha_actual" value="<?php echo $fecha_actual;?>">
                                        </div>
                                        <div class="card col-md-3" style= "border: 1px solid #606060" >
                                            <center class="card-body">
                                                <?php
                                                $query_afiliado = $pdo->prepare("SELECT * FROM tb_afiliados");
                                                $query_afiliado->execute();
                                                $afiliados = $query_afiliado-> fetchALL(PDO::FETCH_ASSOC);
                                                foreach($afiliados as $afiliado){
                                                    if ($ident == $afiliado['ci']){
                                                        $foto = $afiliado['foto'];
                                                        /*$id = $id + 1;*/

                                                    }
                                                    ?>
                                                    <?php
                                                }

                                                ?>
                                                <center><img src="<?php echo $URL;?>/afiliados/fotos/<?php echo $foto;?>" width="150px" alt=""> </center>
                                        </div>

                                   </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="ci" class="form-label">CI:</label>
                                            <input readonly type="text" class="form-control" name="ident" id="ident" value="<?php echo $ident;?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nombres">Nombres:</label>
                                            <input readonly type="text" class="form-control" name="nombres" value="<?php echo $nombres;?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="apellidos" >Apellidos:</label>
                                            <input  readonly type="text" class="form-control" name="apellidos" value="<?php echo $apellidos;?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">

                                            <label for="fecha_ultimo_pago" class="form-label">Fecha Ultimo Pago:</label>
                                            <?php
                                            $date = date_create($fecha_ultimo_pago);
                                            $fecha_ultimo_pago= date_format($date, 'd/m/Y H:i');
                                            $fecha_ultimo_pago2= date_format($date, 'Y-m-d H:i');
                                            ?>
                                            <input readonly type="datetime" class="form-control" name="fecha_ultimo_pago" value="<?php echo $fecha_ultimo_pago;?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="membrecia_registro">Suscrito a la Membrecía de:</label>
                                            <input readonly type="" class="form-control" id="membrecia_registro" name="membrecia_registro"  value="<?php echo $membrecia_registro;?>">
                                        </div>

                                        <div class="col-md-2">
                                            <label for="num_fact" class="form-label">N° Asistencias:</label>
                                            <?php
                                            $id=1;
                                            $ident2 = $ident;
                                             $query_asistencia = $pdo->prepare("SELECT * FROM tb_asistencias");
                                             $query_asistencia->execute();
                                             $asistencias = $query_asistencia-> fetchALL(PDO::FETCH_ASSOC);
                                             foreach($asistencias as $asistencia){
                                               if (($ident2==$asistencia['ci'])){
                                                     $id = $asistencia['id'];
                                                     $id = $id + 1;
                                                    }
                                            }
                                            
                                            ?>
                                            <input readonly type="number" class="form-control" name="id" value="<?php echo $id;?>">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-2" >
                                            <label for="fecha_prox_pago" >Fecha Próximo Pago:</label>
                                            <?php

                                                    // Fecha y hora dada
                                                    $fecha_hora_dada = $fecha_ultimo_pago2;

                                                    // Crear un objeto DateTime con la fecha y hora dada
                                                    $fecha_hora = new DateTime($fecha_hora_dada);

                                                    // Añadir un mes a la fecha y hora dada
                                                   $fecha_hora->modify('+1 month');


                                            ?>
                                            <input  readonly type="datetime" class="form-control"  name="fecha_prox_pago" value="<?php echo $fecha_hora->format('d/m/Y H:i')?>">
                                        </div>

                                        <div class="col-md-2">
                                            <label for="estado" class="form-label">Estado/Afiliado:</label>

                                            <?php

                                            $date1 = new DateTime();
                                            $date2 = new DateTime($fecha_hora->format('Y-m-d'));
                                            $diff = $date2->diff($date1);

                                           // will output 2 days
                                            $abrir_puerta = 0;
                                            $fecha_actual2 = strtotime($fecha_actual2);
                                            $fecha_prox_pago=  strtotime($fecha_hora->format('Y-m-d'));


                                            if($fecha_actual2 < $fecha_prox_pago){
                                                $abrir_puerta = 1;
                                                $estadox ="ACTIVO";
                                                echo '<script>alert ("Su Membrecía vence en: '.$diff->days.' días");</script>';

                                            }else{

                                                $abrir_puerta = 0;
                                                $estadox = "INACTIVO";
                                                echo '<script>alert ("Su Membrecía se encuentra vencida, debe cancelar");</script>';

                                            }
                                             // Aplicar estilos CSS condicionales
                                            $estadox_style = ($estadox == "INACTIVO") ? "color: red; font-weight: bold;" : "color: green; font-weight: bold;";
                                            ?>
                                            <input readonly type="text" class="form-control" id="estadox" name="estadox" style="<?php echo $estadox_style; ?>" value="<?php echo $estadox; ?>">
                                            
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <label for="dias_por_vencer" class="form-label">Días (ACTIVO/INACTIVO):</label>
                                            <input readonly type="" class="form-control" name="dias_memb" value="<?php echo $diff->days . '/'.$estadox;?>""<?php echo $estadox;?>">

                                        </div>
                                    </div>
                                        <div class="row">

                                        </div>
                                    </div>

                                <div class="form-group">
                                    <br>
                                    <center>
                                        <input  type="submit" class="btn btn-primary " value="Guardar" </input>
                                        <a href="../asistencias/" class= "btn btn-default">Salir</a>
                                    </center>

                                    <div id= "respuesta"></div>
                                </div>
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


