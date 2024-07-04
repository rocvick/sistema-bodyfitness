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
        <div class="container">
                <h2>Membrecias Activas</h2>
        </div>
        <br>
        <table class= "table table-bordered  table-sm table-striped">
            <th><center>Nro</center></th>
            <th>Nombre de la Membrecia</th>
            <th>Precio Referencial en Divisas</th>
            <th><center>Acción</center></th>

            <?php
            $contador = 0;
            $query_membrecia = $pdo->prepare("SELECT * FROM tb_membrecias WHERE estado = '1' ");
            $query_membrecia->execute();
            $membrecias = $query_membrecia-> fetchALL(PDO::FETCH_ASSOC);
            foreach($membrecias as $membrecia){
                $id = $membrecia['id'];
                $nombre = $membrecia['nombre'];
                $precio_div = $membrecia['precio_div'];
                $contador = $contador + 1;

                ?>

                <tr>
                    <td><center><?php echo $contador; ?></center></td>
                    <td><?php echo $nombre; ?></td>
                    <td><?php echo $precio_div; ?></td>
                    <td>
                        <center>
                            <a href="update.php?id=<?php echo $id;?>" class= "btn btn-success">Editar</a>
                            <a href="delete.php?id=<?php echo $id;?>" class= "btn btn-danger">Borrar</a>
                        </center>
                    </td>
                </tr>
                <?php
            }
            ?>

        </table>
    </div>
    <?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_link.php');?>
</body>
</html>