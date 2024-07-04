<?php

include('../app/config.php');

$id_memb = $_POST['id_memb'];
$sentencia = $pdo->prepare("DELETE FROM tb_membrecias where id = '$id_memb' ");

if ($sentencia->execute()){

    ?>
    <script>location.href = "../membrecias/"</script>
    <script>alert('Se ha eliminado el registro satisfactoriamente')</script>
    <?php

}else{
    echo "error al intentar eliminar el registro";
}
?>

script
