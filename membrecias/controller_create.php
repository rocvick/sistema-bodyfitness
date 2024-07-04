<?php

include('../app/config.php');
$nombre = $_POST['nombre'];
$precio_div = $_POST['precio_div'];

date_default_timezone_set("America/Caracas");
$fechahora = date("y-m-d H:i");

$sentencia = $pdo->prepare("INSERT INTO  tb_membrecias (nombre, precio_div, fyh_cracion, estado) 
     VALUES (:nombre, :precio_div, :fyh_cracion, :estado)");
$sentencia->bindParam('nombre', $nombre);
$sentencia->bindParam('precio_div', $precio_div);
$sentencia->bindParam('fyh_cracion', $fechahora);
$sentencia->bindParam('estado', $estado_del_registro);

if ($sentencia->execute()){

    ?>
    <script>location.href = "index.php"</script>
    <script>alert('Registro Satisfactorio, presione el botón SALIR')</script>
    <?php

}else{
    echo"No se pudo registrar a la base de datos";
}

