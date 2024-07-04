<?php

include('../app/config.php');

$id_rol = $_POST['id_rol'];
$estado_inact = '0';

date_default_timezone_set("America/Caracas");
$fyh_eliminacion = date("Y-m-d H:i");

$sentencia = $pdo->prepare("UPDATE tb_roles SET
estado = :estado,
fyh_eliminacion = :fyh_eliminacion
WHERE id_rol = :id_rol");

$sentencia-> bindParam(":id_rol", $id_rol);
$sentencia-> bindParam(":estado", $estado_inact);
$sentencia-> bindParam(":fyh_eliminacion", $fyh_eliminacion);


if ($sentencia->execute()){

    ?>
    <script>location.href = "../roles/"</script>
    <script>alert('Se ha eliminado el registro satisfactoriamente')</script>
    <?php

}else{
    echo "error al intentar eliminar el registro";
}
?>