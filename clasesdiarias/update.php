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
        <?php
        $id_get = $_GET['id'];
        $query_clasediaria = $pdo->prepare("SELECT * FROM tb_clasesdiarias WHERE id_cd = '$id_get' AND estado = 1 ");
        $query_clasediaria->execute();
        $clasesdiarias = $query_clasediaria-> fetchALL(PDO::FETCH_ASSOC);
        foreach($clasesdiarias as $clasediaria){
            $fyh_registro = $clasediaria['fyh_registro'];
            $id_cd = $clasediaria['id_cd'];
            $nombre_apellido = $clasediaria['nombre_apellido'];
            $email = $clasediaria['email'];
            $precio_div = $clasediaria['precio_div'];
            $precio_bs = $clasediaria['precio_bs'];
            $monto_de_cancelacion = $clasediaria['monto_de_cancelacion'];
            $iva_calc = $clasediaria['iva_calc'];
            $subtotal = $clasediaria['subtotal'];
            $estado = $clasediaria['estado'];
        }
        ?>

        <div class="card col-md-12" style= "border: 1px solid #606060" >
            <div class="card card-success" style="border: 1px solid #777777">
                <div class="card-header">
                    <h4>Editar Clase Diaria</h4>
                </div>
            </div>
            <div class="card col-md-12" style= "border: 1px solid #606060" >
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2" >
                                <label for="fyh_registro" >Fecha y Hora:</label>
                                <?php
                                $date = date_create($fyh_registro);
                                $fyh_registro= date_format($date, 'd/m/Y H:i');
                                ?>
                                <input readonly type="datetime"  class="form-control" id="fyh_registro<?php echo $id_cd;?>" value="<?php echo $fyh_registro;?>">
                            </div>
                            <div class="col-md-2">
                                <label for="id_cd">ID-CD:</label>
                                <input readonly type="number" class="form-control" id="id_cd<?php echo $id_cd;?>" value="<?php echo $id_cd;?>" >
                            </div>
                            <div class="col-md-4">
                                <label for="nombre_apellido">Nombre y Apellido:</label>
                                <input type="text" class="form-control" id="nombre_apellido" value="<?php echo $nombre_apellido;?>">
                            </div>
                            <div class="col-md-4">
                                <label for="email" >Email:</label>
                                <input type="email" class="form-control" id="email" value="<?php echo $email;?>">
                            </div>
                            <br>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="precio_div">Precio (USD):</label>
                            <input readonly type='number' step='00.00' class="form-control" name="precio_div"  value="<?php echo $precio_div;?>">
                        </div>
                        <div class="col-md-2">
                            <label for="precio_bs">Tasa de Calculo (Bs.):</label>
                            <input readonly type='number' step='00.00' class="form-control" name="precio_bs" id="precio_bs" value="<?php echo $precio_bs;?>">
                        </div>
                        <div class="col-md-3">
                            <label for="subtotal">Subtotal (Bs):</label>
                            <input readonly type='number' step='00.00' class="form-control" name="subtotal" id="subtotal" value="<?php echo $subtotal;?>">
                        </div>
                        <div class="col-md-2">
                            <label for="iva_calc">IVA(16%):</label>
                            <input readonly type='number' step='00.00' class="form-control" name="iva_calc" id="iva_calc" value="<?php echo $iva_calc;?>">
                        </div>
                        <div class="col-md-3">
                            <label for="monto_de_cancelacion">Total a  Cancelar (Bs.):</label>
                            <input readonly type='number' step='00.00' class="form-control" name="monto_de_cancelacion" id="monto_de_cancelacion" value="<?php echo $monto_de_cancelacion;?>">
                        </div>
                        <br>
                        <br>
                        <div class="card-body">
                            <br>
                            <br>
                            <center>
                                <button class= "btn btn-success" id= "btn_actualizar">Actualizar</button>
                                <a href="../clasesdiarias/index.php" class= "btn btn-default">Salir</a>
                            </center>
                            <div id= "respuesta"></div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

</div>

</div>
<?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_link.php');?>
</body>
</html>

<script>
    $('#btn_actualizar').click(function(){

        var nombre_apellido = $('#nombre_apellido').val();
        var email = $('#email').val();
        var id_cd = '<?php echo $id_get= $_GET['id'];?>';
        if(nombre_apellido == ""){
            alert('Debe de  llenar el  campo NOMBRE y APELLIDO');
            $('#nombre_apellido').focus();
        }else if(email == ""){
            alert('Debe de  llenar el campo  EMAIL');
            $('#email').focus();
        }else{
            var url = 'controller_update.php';
            $.post(url , {nombre_apellido:nombre_apellido , email:email, id_cd:id_cd} , function(datos){
                $('#respuesta').html(datos);
            });
        }

    });

</script>