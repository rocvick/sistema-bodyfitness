<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
?>

<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../layout/admin/head.php');?>
    <?php include('../layout/admin/footer_link.php');?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include('../layout/admin/menu.php');?>

    <div class="content-wrapper">

            <?php

            $id_get=$_GET['id'];
            $query_asistencia = $pdo->prepare("SELECT * FROM tb_asistencias WHERE ci = '$id_get' ");
            $query_asistencia->execute();
            $asistencias = $query_asistencia-> fetchALL(PDO::FETCH_ASSOC);
            foreach($asistencias as $asistencia){
                $ci = $asistencia['ci'];
                $num_asist = $asistencia['id'];
                $nombres = $asistencia['nombres'];
                $apellidos = $asistencia['apellidos'];
                $membrecia_registro = $asistencia['membrecia_registro'];
                $fecha_ultimo_pago = $asistencia['fecha_ultimo_pago'];
                $fecha_prox_pago = $asistencia['fecha_prox_pago'];
                $estado = $asistencia['estado'];
            }
            
            $fe_ult_pago = date("d/m/Y H:i", strtotime($fecha_ultimo_pago));
            $fe_prox_pago = date("d/m/Y H:i", strtotime($fecha_prox_pago));

            ?>

            <form >
                <div class="row">
                    <div class="card col-md-12" style= "border: 1px solid #606060" >
                        <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                            <h4>Registro de Asistencias del Afiliado</h4>
                        </div>
                        <div class="container">
                            <div class="card col-md-12" style= "border: 1px solid #606060" >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="ci" >CI:</label>
                                            <input readonly type="" class="form-control" name="ci" id="ci" value="<?php echo $ci;?>">
                                        </div>
                                        <div class="col-md-2">
                                           <label for="fe_prox_pago" class="form-label">Fecha Próximo Pago:</label>
                                           <input readonly type="datatime" class="form-control" name="fe_prox_pago" value="<?php echo $fe_prox_pago;?>">
                                       </div>
                                    </div>

                                   <div class="row">
                                        <div class="col-md-2">
                                            <label for="nombres">Nombres:</label>
                                            <input readonly type="text" class="form-control" name="nombres" value="<?php echo $nombres;?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="apellidos" >Apellidos:</label>
                                            <input  readonly type="text" class="form-control" name="apellidos" value="<?php echo $apellidos;?>">
                                        </div>
                                       <div class="col-md-2">
                                           <label for="fecha_ultimo_pago" class="form-label">Fecha Ultimo Pago:</label>
                                           <input readonly type="datatime" class="form-control" name="fecha_ultimo_pago" value="<?php echo $fe_ult_pago;?>">
                                       </div>
                                       <div class="col-md-3">
                                           <label for="membrecia_registro">Suscrito a la Membrecía de:</label>
                                           <input readonly type="" class="form-control" id="membrecia_registro" name="membrecia_registro"  value="<?php echo $membrecia_registro;?>">
                                       </div>
                                       <div class="col-md-2">
                                           <label for="estado" class="form-label">Estado/Afiliado:</label>
                                           <input readonly  type="text" class="form-control" id="estado" name="estado"  style="font-weight:bold" value="<?php echo $estado;?>">
                                       </div>
                                    </div>

                                    <div class="row">

                                    </div>

                                    <script>
                                        $(document).ready( function () {
                                            $('#table_id').DataTable();

                                        } );
                                    </script>
                                    <div class="container">
                                        <div class="card border-primary mb-12">
                                            <div class="card-body">
                                                <table id="table_id" class="display table table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th><center>Asistencia</center></th>
                                                        <th><center>Fecha y Hora de Asistencia</center></th>
                                                        <th><center>Estado</center></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $id_get=$_GET['id'];
                                                    $query_asistencia = $pdo->prepare("SELECT * FROM tb_asistencias WHERE ci = '$id_get' ORDER BY id DESC");
                                                    $query_asistencia->execute();
                                                    $asistencias = $query_asistencia-> fetchALL(PDO::FETCH_ASSOC);
                                                    foreach($asistencias as $asistencia){
                                                        $id = $asistencia['id'];
                                                        $fecha_actual = $asistencia['fecha_actual'];
                                                        $estado = $asistencia['estado'];

                                                        $fe_actual = date("d/m/Y H:i", strtotime($fecha_actual));
                                                        ?>

                                                        <tr>

                                                            <td><center><?php echo $id; ?><center></td>
                                                            <td><center><?php echo $fe_actual; ?><center></td>
                                                            <td><center><?php echo $estado; ?><center></td>

                                                        </tr>

                                                        <?php
                                                    }
                                                    ?>
                                                </table>
                                                <?php
                                                if ($estado == "INACTIVO"){
                                                ?>
                                                   <script>   alert('ALERTA: USUARIO INACTIVO');</script>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <br>
                                    <center>
                                        <a href="../asistencias/" class= "btn btn-success">Salir</a>
                                    </center>
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


