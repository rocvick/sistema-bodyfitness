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

        <div class="card col-md-12" style= "border: 1px solid #606060" >
            <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                <h4>Registros Generados del Valor de la Divisa  </h4>
            </div>
        </div>
        <script>

            $(document).ready( function () {
                $('#table_id').DataTable();

            });

        </script>
        <div class="container">
            <div class="card border-primary mb-12">
                <div class="card-body">
                    <table id="table_id" class="display table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th><center>NUM-REG</center></th>
                            <th>FECHA y HORA DE ACTUALIZACIÓN</th>
                            <th>DIVISA</th>
                            <th>TIPO DE CAMBIO (BCV)</th>
                            <th>ESTADO</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador =  0;
                        $query_divisa = $pdo->prepare("SELECT * FROM tb_divisas WHERE estado = '1' ORDER BY fyh_actualizacion DESC");
                        $query_divisa->execute();
                        $divisas = $query_divisa-> fetchALL(PDO::FETCH_ASSOC);
                        foreach($divisas as $divisa){
                            $id = $divisa['id'];
                            $fyh_actualizacion = $divisa['fyh_actualizacion'];
                            $tipo_div = $divisa['tipo_div'];
                            $valor_div_bcv = $divisa['valor_div_bcv'];
                            $estado = $divisa['estado'];
                            $contador = $contador + 1 ;

                        ?>
                            <?php
                            $date = date_create($fyh_actualizacion);
                            $fyh_actualizacion= date_format($date, 'd/m/Y H:i');
                            ?>

                            <tr>
                                <td><center><?php echo $contador; ?></center></td>
                                <td><?php echo $fyh_actualizacion; ?></td>
                                <td><?php echo $tipo_div; ?></td>
                                <td><?php echo $valor_div_bcv; ?></td>
                                <td><?php echo $estado; ?></td>
                                <td>
                                    <center>
                                        <a href="update_divisa.php?id=<?php echo $id;?>" class= "btn btn-success btn-sm">Visualizar</a>
                                        <a href="delete.php?id=<?php echo $id;?>" class= "btn btn-danger btn-sm">Eliminar</a>
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
