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
                <h4>Listado de Clases Diarias</h4>
            </div>
            <div style= "text-align: right">
                    <a href="generar_reporte.php"  class= "btn btn-warning" target="_blank">Reporte del Día<i class="fa fa">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                        <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z"/>
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                        </svg>
                        </i>
                        </a>
            </div>
            
        </div>
        
                
        <script>
            $(document).ready( function () {
                $('#table_id').DataTable();

            } );

            new DataTable('#table_id', {
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    }
                }
            });
        </script>
        <div class="container">
            <div class="card border-primary mb-12">
                <div class="card-body">
                    <table id="table_id" class="display table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th><center>N°</center></th>
                            <th>Fecha de Registro:</th>
                            <th>Nombre y Apellido:</th>
                            <th>E-mail:</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador = 0;
                        $query_clasediaria = $pdo->prepare("SELECT * FROM tb_clasesdiarias");
                        $query_clasediaria->execute();
                        $clasesdiarias = $query_clasediaria-> fetchALL(PDO::FETCH_ASSOC);
                        foreach($clasesdiarias as $clasediaria){
                            $contador = $contador + 1;
                            $id_cd = $clasediaria['id_cd'];
                            $fyh_registro = $clasediaria['fyh_registro'];
                            $nombre_apellido = $clasediaria['nombre_apellido'];
                            $email = $clasediaria['email'];
                            ?>

                            <tr>
                                <td><center><?php echo $contador; ?></center></td>
                                <td><?php echo  $fyh_registro; ?></td>
                                <td><?php echo $nombre_apellido; ?></td>
                                <td><?php echo $email; ?></td>

                                <td>
                                    <center>
                                        <a href="update.php?id=<?php echo $id_cd;?>" class= "btn btn-success btn-sm">Editar</a>
                                        <a href="generar_ticket.php?id=<?php echo $id_cd;?>" class= "btn btn-secondary btn-sm" target="_blank">Imprimir</a>
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

