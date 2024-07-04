<?php
include('../app/config.php');

$nombre_emp = $_POST['nombre_emp'];
$rif_emp = $_POST['rif_emp'];
$direccion_emp = $_POST['direccion_emp'];
$telefono_emp = $_POST['telefono_emp'];
$id_inf = $_POST['id_inf'];
date_default_timezone_set("America/Caracas");
$fechahora = date("y/m/d H:i");

$sentencia = $pdo->prepare("UPDATE tb_informaciones SET
nombre_emp = :nombre_emp,
rif_emp = :rif_emp,
direccion_emp = :direccion_emp,
telefono_emp = :telefono_emp
WHERE id_inf = :id_inf");

$sentencia-> bindParam(":nombre_emp", $nombre_emp);
$sentencia-> bindParam(":rif_emp", $rif_emp);
$sentencia-> bindParam(":direccion_emp", $direccion_emp);
$sentencia-> bindParam(":telefono_emp", $telefono_emp);
$sentencia-> bindParam(":id_inf", $id_inf);

if ($sentencia->execute()){

    ?>
    <script>location.href = "informaciones.php"</script>
    <script>alert('Datos Actualizados Exitosamente')</script>
    <?php

}else{
    echo"No se pudo actualizar a la base de datos";
}

