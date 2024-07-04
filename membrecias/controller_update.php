<?php

include('../app/config.php');

$nombre = $_POST['nombre'];
$precio_div = $_POST['precio_div'];
$id_memb = $_POST['id_memb'];

//echo  $nombres."-".$email."-".$password_user;

date_default_timezone_set("America/Caracas");
$fechahora = date("y/m/d H:i");

$sentencia = $pdo->prepare("UPDATE tb_membrecias SET
nombre = :nombre,
precio_div = :precio_div,
fyh_actualizacion = :fyh_actualizacion
WHERE id = :id");

$sentencia-> bindParam(":nombre", $nombre);
$sentencia-> bindParam(":precio_div", $precio_div);
$sentencia-> bindParam(":fyh_actualizacion", $fechahora);
$sentencia-> bindParam(":id", $id_memb);

if ($sentencia->execute()){

    ?>
    <script>location.href = "../membrecias/"</script>
    <script>alert('Actualización Exitosa')</script>
    <?php

}else{
    echo "error al actualizar el registro";
}