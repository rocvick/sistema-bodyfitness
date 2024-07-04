<?php
include('../app/config.php');

$id_membrecia = $_POST['id_membrecia'];


    $query_membrecia = $pdo->prepare("SELECT * FROM tb_membrecias WHERE id = '$id_membrecia' ");
    $result = $query_membrecia->execute();
    $membrecias = $query_membrecia-> fetchALL(PDO::FETCH_ASSOC);
?>
<?php
    $cadena = "<label>Valor de la Membrecia:</label>
                <select class = 'form-control' name='valor_memb' id='valor_memb' >";

foreach($membrecias as $ver){
    $cadena =  $cadena .  '<option value=' . $ver['precio_div'] . '>' . ($ver['precio_div']) . '</option>';
}

    echo $cadena . "</select>";



