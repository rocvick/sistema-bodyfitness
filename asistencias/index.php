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
        .ACTIVO {
            background-color: green;
            color: white;
        }
        .INACTIVO {
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
                <h4>Asistencia de Afiliados</h4>
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
                    <table id="table_id" class="display table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th><center>Nro</center></th>
                            <th>CI:</th>
                            <th>Nombres y Apellidos:</th>
                            <th>Membrecia:</th>
                            <th>Ultimo_Pago:</th>
                            <th>Estado:</th>


                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador = 0;
                        $query_factura = $pdo->prepare("SELECT * FROM tb_facturas ORDER BY fecha_fac ASC");
                        $query_factura->execute();
                        $facturas = $query_factura-> fetchALL(PDO::FETCH_ASSOC);
                        $afiliados_facturas = array();
                        foreach($facturas as $factura){
                        $ci = $factura['ci'];
                        if (!isset($afiliados_facturas[$ci]) || $factura['fecha_fac'] > $afiliados_facturas[$ci]['fecha_fac']) {
                            $afiliados_facturas[$ci] = array(
                                'ci' => $factura['ci'],
                                'nombres' => $factura['nombres'],
                                'apellidos' => $factura['apellidos'],
                                'nombre_memb' => $factura['nombre_memb'],
                                'fecha_fac' => date('d/m/Y', strtotime($factura['fecha_fac'])),
                                'estado' => $factura['estado']
                            );
                        }
                    }

                      
                        foreach($afiliados_facturas as $factura){
                            $contador = $contador + 1;
                            
                        ?>
                          
                            <tr>
                                <td><center><?php echo $contador; ?></center></td>
                                <td><?php echo $factura['ci']; ?></td>
                                <td><?php echo $factura['nombres']." ".$factura['apellidos']; ?></td>
                                <td><?php echo $factura['nombre_memb']; ?></td>
                                <td><?php echo $factura['fecha_fac']; ?></td>
                                <td class="<?php if ($factura['estado'] == "ACTIVO"): ?> ACTIVO <?php else: ?> INACTIVO <?php endif; ?>">
                                     <center><?php echo $factura['estado']; ?></center>
                                </td>
                                <td>
                                    <center>
                                        <a href="create.php?id=<?php echo $factura['ci'];?>" class= "btn btn-info btn-sm">Marcar</a>
                                        <a href="consulta.php?id=<?php echo $factura['ci'];?>" class= "btn btn-success btn-sm">Consultar</a>

                                    </center>
                                </td>

                            </tr>

                            <?php
                        }
                        ?>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>

<?php include('../layout/admin/footer_link.php');?>

</body>
</html>