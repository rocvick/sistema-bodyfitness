<?php

include('../app/config.php');

$fecha_reg = $_POST['fecha_reg'];
$ci = $_POST['ci'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$fyh_nacimiento = $_POST['fyh_nacimiento'];
$sexo = $_POST['sexo'];
$enfermedad = $_POST['enfermedad'];
$tel_emergencia = $_POST['tel_emergencia'];
$membrecia_registro = $_POST['membrecia_registro'];
$valor_memb = $_POST['valor_memb'];
$estado_afiliado = "INACTIVO";
// Separar el id y el nombre
list($id_memb, $nombre_memb) = explode('-', $membrecia_registro);

//date_default_timezone_set("America/Caracas");
//$fecha_reg  = date("Y-m-d H:i");
$fecha_reg = date("Y-m-d H:i:s", strtotime($fecha_reg));

$nombre_foto_afiliado = $ci;
$nombre_archivo = $ci."_".$_FILES['file']['name'];
$location = "fotos/$nombre_archivo";
$destino = './'.$location;

if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    if (copy($_FILES['file']['tmp_name'], $destino)) {
        // código para insertar en la base de datos
        // y cualquier otro procesamiento
    }
}


//move_uploaded_file($_FILES['file']['tmp_name'],$FILES['file']['name']);

$sentencia = $pdo->prepare("INSERT INTO  tb_afiliados (fecha_reg, ci, nombres, apellidos, email, telefono, direccion,
                                   fyh_nacimiento, sexo, enfermedad, tel_emergencia, membrecia_registro, nombre_memb, valor_memb, estado, foto)
     VALUES (:fecha_reg, :ci, :nombres, :apellidos, :email, :telefono, :direccion, :fyh_nacimiento, :sexo, :enfermedad,
             :tel_emergencia, :membrecia_registro, :nombre_memb, :valor_memb, :estado, :foto)");

$sentencia->bindParam('fecha_reg', $fecha_reg);
$sentencia->bindParam('ci', $ci);
$sentencia->bindParam('nombres', $nombres);
$sentencia->bindParam('apellidos', $apellidos);
$sentencia->bindParam('email', $email);
$sentencia->bindParam('telefono', $telefono);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('fyh_nacimiento', $fyh_nacimiento);
$sentencia->bindParam('sexo', $sexo);
$sentencia->bindParam('enfermedad', $enfermedad);
$sentencia->bindParam('tel_emergencia', $tel_emergencia);
$sentencia->bindParam('membrecia_registro', $id_memb);
$sentencia->bindParam('nombre_memb', $nombre_memb);
$sentencia->bindParam('valor_memb', $valor_memb);
$sentencia->bindParam('foto', $nombre_archivo);
$sentencia->bindParam('estado', $estado_afiliado);


if ($sentencia->execute()){
    ?>
   <script>
        alert('Nuevo afiliado registrado con éxito');
        setTimeout(function() {
          location.href = '<?php echo $URL; ?>/afiliados';
        }, 1000);
      </script>
   <?php
}else{
    ?>
    <script>
         alert('ATENCIÓN: La CI:<?php echo $ci ?> ya existe');      
       </script>
        <script>location.href = "../afiliados/"</script>
    <?php
    
}
       
    








