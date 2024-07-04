<?php

include('../app/config.php');

$tipo_div = $_POST['tipo_div'];
$valor_div_bcv = $_POST['valor_div_bcv'];
$fyh_actualizacion = $_POST['fyh_actualizacion'];
$estado = '1';

date_default_timezone_set("America/Caracas");
$fyh_actualizacion  = date("Y-m-d H:i");

$sentencia = $pdo->prepare("INSERT INTO  tb_divisas (tipo_div, valor_div_bcv, fyh_actualizacion, estado) 
     VALUES (:tipo_div, :valor_div_bcv, :fyh_actualizacion, :estado)");
$sentencia->bindParam('tipo_div', $tipo_div);
$sentencia->bindParam('valor_div_bcv', $valor_div_bcv);
$sentencia->bindParam('fyh_actualizacion', $fyh_actualizacion);
$sentencia->bindParam('estado', $estado);

if ($sentencia->execute()){

    ?>
    <script>location.href = "index.php"</script>
    <script>alert('Registro Satisfactorio')</script>
    <?php

}else{
    echo"No se pudo registrar a la base de datos";
}

