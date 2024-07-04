<?php

include('../app/config.php');

$ci_afil = $_POST['ci_afil'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$fyh_nacimiento = $_POST['fyh_nacimiento'];
$sexo = $_POST['sexo'];
$enfermedad = $_POST['enfermedad'];
$tel_emergencia = $_POST['tel_emergencia'];


date_default_timezone_set("America/Caracas");
$fyh_actualizacion= date("y/m/d H:i");


//move_uploaded_file($_FILES['file']['tmp_name'],$FILES['file']['name']);
$sentencia = $pdo->prepare("UPDATE tb_afiliados SET
nombres = :nombres,
apellidos = :apellidos,
email = :email,
telefono = :telefono,
direccion = :direccion,
fyh_nacimiento = :fyh_nacimiento,
sexo = :sexo,
enfermedad = :enfermedad,
tel_emergencia = :tel_emergencia,
fyh_actualizacion = :fyh_actualizacion
WHERE ci = :ci");

$sentencia->bindParam('ci', $ci_afil);
$sentencia->bindParam('nombres', $nombres);
$sentencia->bindParam('apellidos', $apellidos);
$sentencia->bindParam('email', $email);
$sentencia->bindParam('telefono', $telefono);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('fyh_nacimiento', $fyh_nacimiento);
$sentencia->bindParam('sexo', $sexo);
$sentencia->bindParam('enfermedad', $enfermedad);
$sentencia->bindParam('tel_emergencia', $tel_emergencia);
$sentencia->bindParam('fyh_actualizacion', $fyh_actualizacion);


if ($sentencia->execute()){
    ?>
    <script>location.href = "../afiliados/"</script>
    <script>alert('Actualización Exitosa')</script>
    <?php

}else{
    echo"No se pudo registrar el afiliado  a la base de datos";
}


