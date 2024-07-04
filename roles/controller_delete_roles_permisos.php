<?php

include('../app/config.php');

$id_rol_permiso = $_GET['id_rol_permiso'];
$sentencia = $pdo->prepare("DELETE FROM tb_roles_permisos where id_rol_permiso = '$id_rol_permiso' ");
$sentencia->bindParam('id_rol_permiso', $id_rol_permiso);

if ($sentencia->execute()){

    ?>
    <script>alert('Se ha eliminado el registro correctamente**')</script>
    <script>location.href = ""</script>
    <?php

}else{
    echo "error al intentar eliminar el registro";
}
?>