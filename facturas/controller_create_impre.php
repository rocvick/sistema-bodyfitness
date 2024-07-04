<?php
include('../app/config.php');
include('../layout/admin/footer_link.php');

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$ci = $_POST['ci'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$fecha_fac = $_POST['fecha_fac'];
$num_fact = $_POST['num_fact'];
$nombre_memb = $_POST['nombre_memb'];  
$formapago = $_POST['formapago'];   
    
    $fecha_input_obj = date_create_from_format('d/m/Y H:i', $fecha_fac);
    $fecha_fac = date_format($fecha_input_obj, 'Y-m-d H:i');

   
    if ($formapago=="debito_efectivo_pago"){   
        
            $precio_div = number_format($_POST["precio_div"], 2, '.', '');
            $precio_bs = number_format($_POST["precio_bs"], 2, '.', '');
            $monto_de_cancelacion = number_format($_POST["monto_de_cancelacion"], 2, '.', '');
            $subtotal = number_format($_POST["subtotal"], 2, '.', '');
            $iva_calc = number_format($_POST["iva_calc"], 2, '.', '');
        
    }

     if ($formapago=="divisas"){  
       
            $precio_div = number_format($_POST["precio_div"], 2, '.', '');
            $pago_divisas = number_format($_POST["precio_div"], 2, '.', '');
            $precio_bs = number_format($_POST["precio_bs"], 2, '.', '');
            $monto_de_cancelacion = number_format($_POST["monto_de_cancelacion"], 2, '.', '');
            $subtotal = number_format($_POST["subtotal"], 2, '.', '');
            $iva_calc = number_format($_POST["iva_calc"], 2, '.', ''); 
            $igtf = number_format($_POST["igtf"], 2, '.', '');           
        }
    
    If ($formapago=="pago_combinado"){   
       
             $precio_div = $_POST["precio_div"];
             $pago_divisas = $_POST["pago_divisas"];
             $precio_bs = number_format($_POST["precio_bs"], 2, '.', '');
             $monto_de_cancelacion = number_format($_POST["monto_de_cancelacion"], 2, '.', '');
             $subtotal = number_format($_POST["subtotal"], 2, '.', '');
             $iva_calc = number_format($_POST["iva_calc"], 2, '.', '');            
             $igtf = number_format($_POST["igtf"], 2, '.', '');            
       
     }

    

$sentencia = $pdo->prepare("INSERT INTO  tb_ticket (num_fact, fecha_fac, ci, nombres, apellidos, direccion, 
     telefono, nombre_memb, formapago, precio_div, precio_bs, iva_calc, subtotal, monto_de_cancelacion, estado,
     pago_divisas, igtf)
VALUES (:num_fact, :fecha_fac, :ci, :nombres, :apellidos, :direccion, :telefono,  :nombre_memb, :formapago,  
       :precio_div, :precio_bs, :iva_calc, :subtotal, :monto_de_cancelacion, :estado, :pago_divisas, :igtf)");


$sentencia->bindParam('num_fact', $num_fact);
$sentencia->bindParam('fecha_fac', $fecha_fac);
$sentencia->bindParam('ci', $ci);
$sentencia->bindParam('nombres', $nombres);
$sentencia->bindParam('apellidos', $apellidos);
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
$sentencia->bindParam('estado', $estado);
$sentencia->bindParam('igtf', $igtf);

if ($sentencia->execute()){

?>

<script>   alert('Ticket procesado con éxito');</script>
<script>location.href = "../facturas/IntTFHKA/index2.php?id=<?php echo  $ci;?>"</script>
<?php
}
?>  
     
   

