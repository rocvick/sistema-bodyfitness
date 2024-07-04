<?php
include('../app/config.php');
include('../layout/admin/footer_link.php');

    $num_fact = $_POST['num_fact'];
    $fecha_fac = $_POST['fecha_fac'];
    $ci = $_POST['ci'];
    $estado_actual = $_POST['estado'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $nombre_memb = $_POST['nombre_memb'];
    $formapago = $_POST['formapago'];   
    
    $fecha_input_obj = date_create_from_format('d/m/Y H:i', $fecha_fac);
    $fecha_fac = date_format($fecha_input_obj, 'Y-m-d H:i');

    if ($estado_actual = "INACTIVO"){
        $estado_actual = "ACTIVO";
    }
    if ($formapago=="debito_efectivo_pagomovil"){   
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $precio_div = number_format($_POST["precio_div"], 2, '.', '');
            $precio_bs = number_format($_POST["precio_bs"], 2, '.', '');
            $monto_de_cancelacion = number_format($precio_div * $precio_bs, 2, '.', '');
            $subtotal = number_format($monto_de_cancelacion / (1.159), 2, '.', '');
            $iva_calc = number_format($monto_de_cancelacion - $subtotal, 2, '.', '');
        }
    }

     if ($formapago=="divisas"){  
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $precio_div = number_format($_POST["precio_div"], 2, '.', '');
            $pago_divisas = number_format($_POST["precio_div"], 2, '.', '');
            $precio_bs = number_format($_POST["precio_bs"], 2, '.', '');
            
            $monto_de_cancelacion2 = number_format($precio_div * $precio_bs, 2, '.', '');
            $subtotal2 = number_format($monto_de_cancelacion2 / (1.159), 2, '.', '');
            $iva_calc = number_format($monto_de_cancelacion2 - $subtotal2, 2, '.', '');
            $igtf = number_format($monto_de_cancelacion2 * 0.03, 2, '.', '');
            $subtotal = number_format($subtotal2 - $igtf, 2, '.', '');
            $monto_de_cancelacion = number_format($subtotal + $igtf + $iva_calc, 2, '.', '');
           
        }
    }
    
     
    If ($formapago=="pago_combinado"){   
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
             $precio_div = $_POST["precio_div"];
             $pago_en_divisa = $_POST["pago_en_divisa"];
             $precio_bs = $_POST["precio_bs"];
             $subtotal_efect_pm = $_POST["subtotal_efect_pm"];
             $iva_efectivo_pagomovil = $_POST["iva_efectivo_pagomovil"];
             $efectivo_pagomovil = $_POST["efectivo_pagomovil"];

             $pago_divisas = $pago_en_divisa;
             
             $monto_de_cancelacion2 = number_format($pago_divisas * $precio_bs, 2, '.', '');
             $subtotal2 = number_format($monto_de_cancelacion2 / (1.159), 2, '.', '');
             $iva_calc = number_format($monto_de_cancelacion2 - $subtotal2, 2, '.', '');
             $igtf = number_format($monto_de_cancelacion2 * 0.03, 2, '.', '');
             $subtotal = number_format($subtotal2 - $igtf, 2, '.', '');
             $monto_de_cancelacion = number_format($subtotal + $igtf + $iva_calc, 2, '.', '');

            
        }
     }

     $sentencia1 = $pdo->prepare("UPDATE tb_afiliados SET
     nombres = :nombres,
     apellidos = :apellidos,
     email = :email,
     telefono = :telefono,
     direccion = :direccion,
     estado = :estado
     WHERE ci = :ci");
     
         $sentencia1->bindParam('ci', $ci);
         $sentencia1->bindParam('nombres', $nombres);
         $sentencia1->bindParam('apellidos', $apellidos);
         $sentencia1->bindParam('email', $email);
         $sentencia1->bindParam('telefono', $telefono);
         $sentencia1->bindParam('direccion', $direccion);
         $sentencia1->bindParam('estado', $estado_actual);
     
     $sentencia1->execute();

$sentencia = $pdo->prepare("INSERT INTO  tb_facturas (num_fact, fecha_fac, ci, nombres, apellidos, email, direccion, 
     telefono, nombre_memb, formapago, precio_div, precio_bs, iva_calc, subtotal, monto_de_cancelacion, estado,
     pago_divisas, igtf)
VALUES (:num_fact, :fecha_fac, :ci, :nombres, :apellidos, :email, :direccion, :telefono,  :nombre_memb, :formapago,  
       :precio_div, :precio_bs, :iva_calc, :subtotal, :monto_de_cancelacion, :estado, :pago_divisas, :igtf)");


$sentencia->bindParam('num_fact', $num_fact);
$sentencia->bindParam('fecha_fac', $fecha_fac);
$sentencia->bindParam('ci', $ci);
$sentencia->bindParam('nombres', $nombres);
$sentencia->bindParam('apellidos', $apellidos);
$sentencia->bindParam('email', $email);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('telefono', $telefono);
$sentencia->bindParam('nombre_memb', $nombre_memb);
$sentencia->bindParam('formapago', $formapago);
$sentencia->bindParam('precio_div', $precio_div);
$sentencia->bindParam('precio_bs', $precio_bs);
$sentencia->bindParam('iva_calc', $iva_calc);
$sentencia->bindParam('subtotal', $subtotal);
$sentencia->bindParam('monto_de_cancelacion', $monto_de_cancelacion);
$sentencia->bindParam('pago_divisas', $pago_divisas);
$sentencia->bindParam('estado', $estado_actual);
$sentencia->bindParam('igtf', $igtf);

if ($sentencia->execute()){

?>

<script>   alert('Pago Registrado con éxito');</script>
<script>location.href = "../facturas/"</script>
<?php
}
?>

