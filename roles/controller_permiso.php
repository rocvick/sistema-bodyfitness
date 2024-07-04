<?php

include('../app/config.php');
$nombre_url = $_POST['nombre_url'];
$url_url = $_POST['url_url'];

date_default_timezone_set("America/Caracas");
$fechahora = date("y-m-d H:i");

$sentencia = $pdo->prepare("INSERT INTO  tb_permisos (nombre_url, url_url, fyh_cracion, estado) 
     VALUES (:nombre_url, :url_url, :fyh_cracion, :estado)");
$sentencia->bindParam('nombre_url', $nombre_url);
$sentencia->bindParam('url_url', $url_url);
$sentencia->bindParam('fyh_cracion', $fechahora);
$sentencia->bindParam('estado', $estado_del_registro);

if ($sentencia->execute()){

    ?>
     <script>alert('Permiso creado con éxito')</script>
    <script>location.href = "permisos.php"</script>
   
    <?php

}else{
    echo"No se pudo registrar el permiso";
}
