<?php

include('../app/config.php');

$id_permiso = $_POST['id_permiso'];
$sentencia = $pdo->prepare("DELETE FROM tb_permisos where id_permiso = '$id_permiso' ");
$sentencia->bindParam('id_permiso', $id_permiso);

if ($sentencia->execute()){

    ?>
    <script>alert('Se ha eliminado el registro correctamente')</script>
    <script>location.href = "permisos.php"</script>
    <?php

}else{
    echo "error al intentar eliminar el registro";
}
?>



