<?php

include('../app/config.php');

$nombre_apellido = $_POST['nombre_apellido'];
$email = $_POST['email'];
$id_cd = $_POST['id_cd'];

//echo  $nombres."-".$email."-".$password_user;

date_default_timezone_set("America/Caracas");
$fechahora = date("y/m/d H:i");

$sentencia = $pdo->prepare("UPDATE tb_clasesdiarias SET
nombre_apellido = :nombre_apellido,
email = :email
WHERE id_cd = :id_cd");

$sentencia-> bindParam(":nombre_apellido", $nombre_apellido);
$sentencia-> bindParam(":email", $email);
$sentencia-> bindParam(":id_cd", $id_cd);

if ($sentencia->execute()){

    ?>
    <script>location.href = "../clasesdiarias/"</script>
    <script>alert('Actualización Exitosa')</script>
    <?php

}else{
    echo "error al actualizar el registro";
}
