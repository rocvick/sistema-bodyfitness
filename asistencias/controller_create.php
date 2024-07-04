<?php

include('../app/config.php');

$ident = $_POST['ident'];
$id = $_POST['id'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$membrecia_registro = $_POST['membrecia_registro'];
$fecha_ultimo_pago = $_POST['fecha_ultimo_pago'];
$fecha_actual = $_POST['fecha_actual'];
$fecha_prox_pago = $_POST['fecha_prox_pago'];
$estadox = $_POST['estadox'];

/*Cambio formato de fecha para guardr en BD*/

$fecha_input_obj = date_create_from_format('d/m/Y H:i', $fecha_ultimo_pago);
$fe_ult_pago = date_format($fecha_input_obj, 'Y-m-d H:i');

$fecha_input_obj2 = date_create_from_format('d/m/Y H:i', $fecha_actual);
$fe_actual = date_format($fecha_input_obj2, 'Y-m-d H:i');

$fecha_input_obj3 = date_create_from_format('d/m/Y H:i', $fecha_prox_pago);
$fe_prox_pago = date_format($fecha_input_obj3, 'Y-m-d H:i');



$sentencia1 = $pdo->prepare("UPDATE tb_afiliados SET
nombres = :nombres,
apellidos = :apellidos,
membrecia_registro = :membrecia_registro,
estado = :estado
WHERE ci = :ci");

$sentencia1->bindParam('ci', $ident);
$sentencia1->bindParam('nombres', $nombres);
$sentencia1->bindParam('apellidos', $apellidos);
$sentencia1->bindParam('membrecia_registro', $membrecia_registro);
$sentencia1->bindParam('estado', $estadox);



$sentencia = $pdo->prepare("INSERT INTO  tb_asistencias (ci, id, nombres, apellidos, membrecia_registro,
                                   fecha_ultimo_pago, fecha_actual, fecha_prox_pago, estado)
     VALUES (:ci, :id, :nombres, :apellidos, :membrecia_registro, :fecha_ultimo_pago, :fecha_actual, :fecha_prox_pago, :estado)");

$sentencia->bindParam('ci', $ident);
$sentencia->bindParam('id', $id);
$sentencia->bindParam('nombres', $nombres);
$sentencia->bindParam('apellidos', $apellidos);
$sentencia->bindParam('membrecia_registro', $membrecia_registro);
$sentencia->bindParam('fecha_ultimo_pago', $fe_ult_pago);
$sentencia->bindParam('fecha_actual', $fe_actual);
$sentencia->bindParam('fecha_prox_pago', $fe_prox_pago);
$sentencia->bindParam('estado', $estadox);

$sentencia2 = $pdo->prepare("UPDATE  tb_facturas  SET
nombres = :nombres,
apellidos = :apellidos,
nombre_memb = :nombre_memb,
estado = :estado
WHERE ci = :ci");

$sentencia2->bindParam('ci', $ident);
$sentencia2->bindParam('nombres', $nombres);
$sentencia2->bindParam('apellidos', $apellidos);
$sentencia2->bindParam('nombre_memb', $membrecia_registro);
$sentencia2->bindParam('estado', $estadox);

echo"Registro Exitoso";


if ($sentencia2->execute()){
    $sentencia->execute();
    $sentencia1->execute();
    echo"Registro Exitoso";
    header('location:  '.$URL.'/asistencias');

}else{
    echo"No se pudo registrar el afiliado  a la base de datos";
}



