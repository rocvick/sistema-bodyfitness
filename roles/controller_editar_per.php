<?php

include('../app/config.php');
$id_permiso = $_POST['id_permiso'];
$nombre_url = $_POST['nombre_url'];
$url_url = $_POST['url_url'];

date_default_timezone_set("America/Caracas");
$fechahora = date("y-m-d H:i");

$sentencia = $pdo->prepare("UPDATE  tb_permisos 
SET nombre_url=:nombre_url, 
    url_url=:url_url, 
    fyh_actualizacion=:fyh_actualizacion 
 WHERE id_permiso=:id_permiso");

$sentencia->bindParam('nombre_url', $nombre_url);
$sentencia->bindParam('url_url', $url_url);
$sentencia->bindParam('fyh_actualizacion', $fechahora);
$sentencia->bindParam('id_permiso', $id_permiso);

if ($sentencia->execute()){

    ?>
     <script>alert('Permiso actualizado con éxito')</script>
    <script>location.href = "permisos.php"</script>
   
    <?php

}else{
    echo"No se pudo registrar el permiso";
}