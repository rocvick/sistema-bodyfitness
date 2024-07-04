<?php

include('../app/config.php');

$id_inf = $_POST['id_inf'];
$sentencia = $pdo->prepare("DELETE FROM tb_informaciones where id_inf = '$id_inf' ");

if ($sentencia->execute()){

    ?>

    <script>location.href = "informaciones.php";</script>
    <script>alert('Se ha eliminado el registro satisfactoriamente')</script>
<?php

}else{
    echo "error al intentar eliminar el registro";
}
?>

