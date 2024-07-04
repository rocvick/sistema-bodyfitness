<?php

include('../app/config.php');
$nombre = $_POST['nombre'];

date_default_timezone_set("America/Caracas");
$fechahora = date("y-m-d H:i");


    $sentencia = $pdo->prepare("INSERT INTO  tb_roles (nombre, fyh_cracion, estado) 
     VALUES (:nombre, :fyh_cracion, :estado)");
    $sentencia->bindParam('nombre', $nombre);
    $sentencia->bindParam('fyh_cracion', $fechahora);
    $sentencia->bindParam('estado', $estado_del_registro);
   if ($sentencia->execute()){
    ?>
       <script>alert('Registro Satisfactorio')</script> 
        <script>location.href = "index.php"</script>
        
    <?php

   }else{
    ?>
    <script>alert('No se pudo registrar en la Base de Datos')</script>
    <?php
   }
    


