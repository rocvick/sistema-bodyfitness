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
        <div class="content">

            <h2>Listado de Informaciones</h2>
            <br>
            <a href="create_informaciones.php" class= "btn btn-primary">Registrar Nuevo</a><br><br>
            <table class= "table table-bordered  table-sm table-striped">
                <th><center>Nro</center></th>
                <th>Nombre Empresa</th>
                <th>RIF</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th><center>Acción</center></th>


                <?php
                $contador = 0;
                $query_informaciones = $pdo->prepare("SELECT * FROM tb_informaciones");
                $query_informaciones->execute();
                $informaciones = $query_informaciones-> fetchALL(PDO::FETCH_ASSOC);
                foreach($informaciones as $informacion){
                    $id = $informacion['id_inf'];
                    $nombre_emp = $informacion['nombre_emp'];
                    $rif_emp = $informacion['rif_emp'];
                    $direccion_emp = $informacion['direccion_emp'];
                    $telefono_emp = $informacion['telefono_emp'];
                    $contador = $contador + 1;

                    ?>

                    <tr>
                        <td><center><?php echo $contador; ?></center></td>
                        <td><?php echo $nombre_emp; ?></td>
                        <td><?php echo $rif_emp; ?></td>
                        <td><?php echo $direccion_emp; ?></td>
                        <td><?php echo $telefono_emp; ?></td>
                        <td>
                            <center>
                                <a href="update_configuraciones.php?id=<?php echo $id;?>" class= "btn btn-success">Editar</a>
                                <a href="delete_configuraciones.php?id=<?php echo $id;?>" class= "btn btn-danger">Borrar</a>
                            </center>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </table>

        </div>

    </div>
    <?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_link.php');?>
</body>
</html>

