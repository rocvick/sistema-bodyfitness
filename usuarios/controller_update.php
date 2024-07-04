<?php

include('../app/config.php');

$nombres = $_POST['nombres'];
$email = $_POST['email'];
$password_user = $_POST['password_user'];
$id_user = $_POST['id_user'];

//echo  $nombres."-".$email."-".$password_user;

date_default_timezone_set("America/Caracas");
$fechahora = date("y/m/d H:i");

$password_user = password_hash($password_user, PASSWORD_DEFAULT);

$sentencia = $pdo->prepare("UPDATE tb_usuarios SET
nombres = :nombres,
email = :email,
password_user = :password_user,
fyh_actualizacion = :fyh_actualizacion
WHERE id = :id");

$sentencia-> bindParam(":nombres", $nombres);
$sentencia-> bindParam(":email", $email);
$sentencia-> bindParam(":password_user", $password_user);
$sentencia-> bindParam(":fyh_actualizacion", $fechahora);
$sentencia-> bindParam(":id", $id_user);

if ($sentencia->execute()){

    ?>
    <script>location.href = "../usuarios/"</script>
    <script>alert('Actualización Exitosa')</script>
    <?php

    }else{
    echo "error al actualizar el registro";
}