<?php

include('../app/config.php');

$ci_afil = $_POST['ci_afil'];
$estado = $_POST['estado'];

/
$sentencia = $pdo->prepare("UPDATE tb_afiliados SET
estado = :estado

WHERE ci = :ci");

$sentencia->bindParam('estado', $estado);

$sentencia->execute();

