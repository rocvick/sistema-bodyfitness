<?php
include('../app/config.php');
include('../layout/admin/footer_link.php');

$id_cd = $_POST['id_cd'];
$nombre_apellido = $_POST['nombre_apellido'];
$email = $_POST['email'];
$precio_div = $_POST['precio_div'];
$precio_bs = $_POST['precio_bs'];
$iva_calc = $_POST['iva_calc'];
$subtotal = $_POST['subtotal'];
$monto_de_cancelacion = $_POST['monto_de_cancelacion'];


$estado = "1";
date_default_timezone_set("America/Caracas");
$fyh_registro = date("y-m-d H:i");

$sentencia = $pdo->prepare("INSERT INTO  tb_clasesdiarias (id_cd, fyh_registro, nombre_apellido, email, precio_div, precio_bs, 
                                  iva_calc, subtotal, monto_de_cancelacion, estado)
     VALUES (:id_cd, :fyh_registro, :nombre_apellido, :email, :precio_div, :precio_bs, :iva_calc, :subtotal, :monto_de_cancelacion, :estado)");

$sentencia->bindParam('id_cd', $id_cd);
$sentencia->bindParam('nombre_apellido', $nombre_apellido);
$sentencia->bindParam('email', $email);
$sentencia->bindParam('precio_div', $precio_div);
$sentencia->bindParam('precio_bs', $precio_bs);
$sentencia->bindParam('iva_calc', $iva_calc);
$sentencia->bindParam('subtotal', $subtotal);
$sentencia->bindParam('monto_de_cancelacion', $monto_de_cancelacion);
$sentencia->bindParam('fyh_registro', $fyh_registro);
$sentencia->bindParam('estado', $estado);

if ($sentencia->execute()){
    echo '<script>alert ("Registro realizado con Éxito");</script>';
    header('location:  '.$URL.'/clasesdiarias');
}else{
    echo"No se pudo registrar la Clase en la base de datos";
}


