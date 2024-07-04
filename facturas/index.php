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

    
    <style>
        .activo {
            background-color: green;
            color: white;
        }
        .inactivo {
            background-color: red;
            color: white;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include('../layout/admin/menu.php');?>

    <div class="content-wrapper">

        <div class="card col-md-12" style= "border: 1px solid #606060" >
            <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                <h4>Gestión de Pagos</h4>
            </div>
        </div>
        <script>
            $(document).ready( function () {
                $('#table_id').DataTable();

            } );
        </script>
        
        <div class="container">
            <div class="card border-primary mb-12">
                <div class="card-body">
                <div class="row">
                        <div class="col-md-6">
                            <label for="fecha_inicio">Fecha Inicio:</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_fin">Fecha Fin:</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-warning" onclick="generarReporte()">Generar Reporte</button>
                        </div>
                    </div>
                    <br>
                    <table id="table_id" class="display table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th><center>N°</center></th>
                            <th>Fecha:</th>
                            <th><center>N°/Control:</center></th>
                            <th><center>Pago (USD):</center></th>
                            <th><center>CI</center></th>
                            <th>Nombres/Apellidos:</th>
                            <th>Estado:</th>

                            <th><center>Acción</center></th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador = 0;
                        $afiliado = 0;
                        $query_factura = $pdo->prepare("SELECT * FROM tb_facturas ORDER BY num_fact DESC");
                        $result = $query_factura->execute();
                        $facturas = $query_factura-> fetchALL(PDO::FETCH_ASSOC);
                        $afiliados_facturas = array();
                        foreach($facturas as $factura){
                            $ci = $factura['ci'];
                            if (!isset($afiliados_facturas[$ci]) || $factura['num_fact'] > $afiliados_facturas[$ci]['num_fact']) {
                                $afiliados_facturas[$ci] = array(
                                    'fecha_fac' => date('d/m/Y', strtotime($factura['fecha_fac'])),
                                    'num_fact' => $factura['num_fact'],
                                    'ci' => $factura['ci'],
                                    'pago_div' => $factura['precio_div'],
                                    'nombres' => $factura['nombres'],
                                    'apellidos' => $factura['apellidos'],
                                    'estado' => $factura['estado']
                                );
                            } elseif ($factura['estado'] == 'cancelada') {
                                $afiliados_facturas[$ci] = array(
                                    'fecha_fac' => $factura['fecha_fac'],
                                    'num_fact' => $factura['num_fact'],
                                    'pago_div' => $factura['precio_div'],
                                    'ci' => $factura['ci'],
                                    'nombres' => $factura['nombres'],
                                    'apellidos' => $factura['apellidos'],
                                    'estado' => $factura['estado']
                                );
                            }
                        }

                        $contador = 1;
                        foreach ($afiliados_facturas as $factura) {
                            ?>
                            <tr>
                                <td><center><?php echo $contador; ?></center></td>
                                <td><?php echo $factura['fecha_fac']; ?></td>
                                <td><center><?php echo $factura['num_fact']; ?></center></td>
                                <td><center><?php echo $factura['pago_div']; ?></center></td>
                                <td><?php echo $factura['ci']; ?></td>
                                <td><?php echo $factura['nombres'] . " " . $factura['apellidos']; ?></td>
                                <td class="<?php if ($factura['estado'] == "INACTIVO"): ?> inactivo <?php else: ?> activo <?php endif; ?>">
                                     <center><?php echo $factura['estado']; ?></center>
                                </td>
                                <td>
                                    <center>
                                        <a href="create.php?id=<?php echo $factura['ci']; ?>" class="btn btn-info btn-sm">Pagar</a>
                                        <a href="consult.php?id=<?php echo $factura['ci']; ?>" class="btn btn-success btn-sm">Consultar</a>
                                    </center>
                                </td>
                            </tr>
                            <?php
                            $contador++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../layout/admin/footer_link.php');?>
<script>
    function generarReporte() {
        var fecha_inicio = document.getElementById("fecha_inicio").value;
        var fecha_fin = document.getElementById("fecha_fin").value;
        window.location.href = "reporte_facturas.php?fecha_inicio=" + fecha_inicio + "&fecha_fin=" + fecha_fin;
    }
</script>

</body>
</html>

                           