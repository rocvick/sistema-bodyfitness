<?php

include('../app/config.php');
$nombres = $_POST['nombres'];
$email = $_POST['email'];
$password_user = $_POST['password_user'];
$repeat_password_user = $_POST['repeat_password_user'];

date_default_timezone_set("America/Caracas");
$fechahora = date("y-m-d H:i");

if ($password_user == $repeat_password_user){
    $password_user = password_hash($password_user, PASSWORD_DEFAULT);

    $sentencia = $pdo->prepare("INSERT INTO  tb_usuarios (nombres, email, password_user, fyh_cracion, estado) 
     VALUES (:nombres, :email, :password_user, :fyh_cracion, :estado)");
    $sentencia->bindParam('nombres', $nombres);
    $sentencia->bindParam('email', $email);
    $sentencia->bindParam('password_user', $password_user);
    $sentencia->bindParam('fyh_cracion', $fechahora);
    $sentencia->bindParam('estado', $estado_del_registro);
    $sentencia->execute();
    ?>
        <script>location.href = "../roles/asignar.php"</script>
        <script>alert('Registro Satisfactorio')</script>
    <?php
}else{
?>
    <script>alert('Las Contraseñas no Coinciden')</script>
    <?php
}






