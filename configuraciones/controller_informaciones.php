<?php

include('../app/config.php');
$nombre_emp = $_POST['nombre_emp'];
$rif_emp = $_POST['rif_emp'];
$direccion_emp = $_POST['direccion_emp'];
$telefono_emp = $_POST['telefono_emp'];
$estado = 1;

$sentencia = $pdo->prepare("INSERT INTO  tb_informaciones (nombre_emp, rif_emp, direccion_emp, telefono_emp, estado) 
     VALUES (:nombre_emp, :rif_emp, :direccion_emp, :telefono_emp, :estado)");
$sentencia->bindParam('nombre_emp', $nombre_emp);
$sentencia->bindParam('rif_emp', $rif_emp);
$sentencia->bindParam('direccion_emp', $direccion_emp);
$sentencia->bindParam('telefono_emp', $telefono_emp);
$sentencia->bindParam('estado', $estado);

if ($sentencia->execute()){

    ?>
    <script>location.href = "informaciones.php"</script>
    <script>alert('Registro Satisfactorio')</script>
    <?php

}else{
    echo"No se pudo registrar a la base de datos";
}





