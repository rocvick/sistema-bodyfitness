<?php
//Conexión a la base de datos
define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
define('BD','bodyfitnessgym'); 

$servidor = "mysql:dbname=".BD."; host=".SERVIDOR;

try{
    $pdo = new PDO($servidor,USUARIO,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    //echo "La Conexion a la Base de Datos es Exitosa";
    //echo "<script>alert('La Conexion a la Base de Datos es Exitosa');</script>";
}catch(PDOException $e){
    //echo "error a la Base de Datos";
    //Alert: paraenviar mensajes de error desde el localhost;
    echo "<script>alert('Error en la conexión a la Base de Datos');</script>";
}

$URL = "http://localhost/bodyfitness";
$num_fact = "1";
$id_cd = "1";
$estado_del_registro = "1";
$id = 0;
$swich=0;
$estado_afiliado = "INACTIVO";
?>
