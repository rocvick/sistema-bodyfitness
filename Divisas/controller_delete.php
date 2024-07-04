<?php

include('../app/config.php');

$id_div = $_POST['id_div'];
$estado_inact = '0';

date_default_timezone_set("America/Caracas");
$fyh_eliminacion = date("Y-m-d H:i");

$sentencia = $pdo->prepare("UPDATE tb_divisas SET
estado = :estado,
fyh_eliminacion = :fyh_eliminacion
WHERE id = :id");

$sentencia-> bindParam(":id", $id_div);
$sentencia-> bindParam(":estado", $estado_inact);
$sentencia-> bindParam(":fyh_eliminacion", $fyh_eliminacion);


if ($sentencia->execute()){

    ?>
    <script>location.href = "../Divisas/"</script>
    <script>alert('Se ha eliminado el registro satisfactoriamente')</script>
    <?php

}else{
    echo "error al intentar eliminar el registro";
}
?>