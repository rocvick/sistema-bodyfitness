<?php

include('../app/config.php');

$id_user = $_POST['id_user'];
$sentencia = $pdo->prepare("DELETE FROM tb_usuarios where id = '$id_user' ");

if ($sentencia->execute()){

    ?>
    <script>location.href = "../usuarios/"</script>
    <script>alert('Se ha eliminado el registro satisfactoriamente')</script>
    <?php

}else{
    echo "error al intentar eliminar el registro";
}
?>



