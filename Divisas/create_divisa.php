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
            <h2></h2>
            <div class="container">
                <div class="row">
                    <div class="col md-6*2">
                        <div class="card" style= "border: 1px solid #606060" >
                            <div class="card-header" style= "background-color: #007bff; color: #ffffff">
                                <h4>Actualizar Valor de la Divisa (USD)</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group" >

                                    <?php
                                    date_default_timezone_set("America/Caracas");
                                    $fyh_actualizacion  = date("d-m-Y H:i");
                                    ?>
                                    <label for="fyh_actualizacion" >Fecha y Hora Actual:</label>
                                    <input readonly type="datetime" class="form-control" id="fyh_actualizacion"  value="<?php echo $fyh_actualizacion;?>">

                                </div>
                                <div class="formgroup">
                                    <label for="">Tipo  de Divisa:</label>
                                    <div class="form-group">
                                        <select class="form-control form-control-sm" id="tipo_div" disabled>
                                            <option value="USD">DOLAR (USD)</option>
                                            <option value="EUR">Euro</option >
                                            <option value="CNY">Yen</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="formgroup">
                                    <label for="">Valor de la Divisa (BCV):</label>
                                    <input type='number' step='00.00' value='0.00' placeholder='0.00' id="valor_div_bcv"/>
                                 </div>

                                <br>
                                <div class="formgroup">
                                    <button class= "btn btn-primary" id= "btn_guardar">Guardar</button>
                                    <a href="../Divisas/index.php" class= "btn btn-default">Salir</a>
                                </div>
                                <div   id= "respuesta">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col md-6*2"></div>
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
    alert('Consulte el valor de la divisa a la fecha de hoy en: BANCO CENTRAL DE VENEZUELA  https://www.bcv.org.ve/');

   $('#btn_guardar').click(function(){

        var tipo_div = $('#tipo_div').val();
        var valor_div_bcv= $('#valor_div_bcv').val();
        var fyh_actualizacion = $('#fyh_actualizacion').val();


            if(tipo_div == ""){
                alert('Debe seleccionar un Tipo de Divisa');
                $('#tipo_div').focus();
            }else if(valor_div_bcv == ""){
                alert('Debe colocar el valor de la divisa al precio del BCV');
                $('#valor_div_bcv').focus();

            }else{
                var url = 'controller_create_divisa.php';
                $.post(url , {fyh_actualizacion:fyh_actualizacion , tipo_div:tipo_div , valor_div_bcv:valor_div_bcv} , function(datos){
                    $('#respuesta').html(datos);
                });
            }

    });
</script>