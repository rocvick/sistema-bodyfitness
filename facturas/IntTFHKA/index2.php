<?php
include('../../app/config.php');
include_once ("TfhkaPHP.php");
?> 
<HTML>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<head>
<title>Impreción de Ticket Fiscal</title>
</head>
<BODY>
<div align = "center"><br>
<B>Su Ticket se está imprimiendo, espere un momento por favor</B><br><br>

<a href="../index.php" class="btn btn-primary">REGRESAR</a>
	
	
</div>
<?php
	
/* trae una variable de otra vista con GET y Define el arreglo $factura*/
$itObj = new Tfhka();
if (isset($_GET['id'])) {
    $id_get = $_GET['id'];
	
} else {
    $id_get = ''; // O asigna un valor predeterminado
	
}

$factura = array(); 

$query_ticket = $pdo->prepare("SELECT * FROM tb_ticket");
			$query_ticket->execute();
			$tickets = $query_ticket-> fetchALL(PDO::FETCH_ASSOC);
			foreach($tickets as $ticket){
				$ci = $ticket['ci'];
				$num_fact = $ticket['num_fact'];
				$fecha_fac = $ticket['fecha_fac'];
				$nombres = $ticket['nombres'];
				$apellidos = $ticket['apellidos'];
				$telefono = $ticket['telefono'];
				$direccion = $ticket['direccion'];
				$nombre_memb = $ticket['nombre_memb'];
				$precio_div = $ticket['precio_div'];
				$precio_bs = $ticket['precio_bs'];
				$monto_de_cancelacion = $ticket['monto_de_cancelacion'];
				$iva_calc = $ticket['iva_calc'];
				$subtotal = $ticket['subtotal'];
				$pago_divisas =$ticket['pago_divisas'];
				$formapago =$ticket['formapago'];
				$igtf =$ticket['igtf'];

				
		  if ($ci==$id_get){ 
		  
				if ($formapago=="debito_efectivo_pago"){
					$cantidad = 1000;
					$subtotal_formateado = str_pad(str_replace('.', '', number_format($subtotal, 2, '.', '')), 10, '0', STR_PAD_LEFT);
					$cantidad_formateada = str_pad($cantidad, 8, '0', STR_PAD_LEFT);
					$iva_formateado = "IVA G16,00% Bs " . number_format($iva_calc, 2);
						$factura= array( 4 =>"\n",
							5 =>"i04AFILIADO:$nombres $apellidos\n",
							6 =>"i05CI:$ci\n",
							7 =>"i06DIRECCION:$direccion\n",
							8 =>"i07TELEFONO:$telefono\n",
							9 =>"!$subtotal_formateado$cantidad_formateada$nombre_memb\n",
							10 => "3$subtotal_formateado\n", // Presentar el subtotal de la factura
							11 =>"101");
				};

				if ($formapago=="divisas"){
					$cantidad = 1000;
					$proceso_calcular1 = $monto_de_cancelacion/1.159;
					$proceso_calcular2 = $proceso_calcular1 * 3/100;
					$subtotal1 = $proceso_calcular1 - $proceso_calcular2;
					
					$subtotal_formateado = str_pad(str_replace('.', '', number_format($subtotal1, 2, '.', '')), 10, '0', STR_PAD_LEFT);
					$cantidad_formateada = str_pad($cantidad, 8, '0', STR_PAD_LEFT);
					$iva_formateado = "IVA G16,00% Bs " . number_format($iva_calc, 2);
					$factura= array( 4 =>"\n",
						5 =>"i04AFILIADO:$nombres $apellidos\n",
						6 =>"i05CI:$ci\n",
						7 =>"i06DIRECCION:$direccion\n",
						8 =>"i07TELEFONO:$telefono\n",
						9 =>"!$subtotal_formateado$cantidad_formateada$nombre_memb\n",
						10 => "3$subtotal_formateado\n", // Presentar el subtotal de la factura
						11 =>"122",
						12 =>"101");
			    };

				if ($formapago=="pago_combinado"){
					$pago_total = $precio_div * $precio_bs;
					$subtotal = $pago_total/1.159;
					$cantidad = 1000;
					$subtotal_formateado = str_pad(str_replace('.', '', number_format($subtotal, 2, '.', '')), 10, '0', STR_PAD_LEFT);
					$cantidad_formateada = str_pad($cantidad, 8, '0', STR_PAD_LEFT);
					$iva_formateado = "IVA G16,00% Bs " . number_format($iva_calc, 2);
										
		            $factura= array( 4 =>"\n",
			                5 =>"i04AFILIADO:$nombres $apellidos\n",
			                6 =>"i05CI:$ci\n",
							7 =>"i06DIRECCION:$direccion\n",
							8 =>"i07TELEFONO:$telefono\n",
							9 =>"!$subtotal_formateado$cantidad_formateada$nombre_memb\n",
							10 => "3$subtotal_formateado\n", // Presentar el subtotal de la factura
							11 =>"101");
				};			
			};     

	      }				                            
		$file = "Factura.txt";	
        $fp = fopen($file, "w+");
       	foreach($factura as $campo => $cmd){
		     	   $write = fputs($fp, $cmd);
			}
		fwrite($fp, "199"); // Enviar el comando 199 para completar la impresión
		// Desactivar el cálculo de IVA por defecto
        
        fclose($fp); 
        $out =  $itObj->SendFileCmd($file);
		$out .= $itObj->SendCmd("199"); // Enviar el comando 199 después de enviar el archivo  

 
		if($out == "ASK")
		{
			echo "<div align = 'center'><B><font color = 'green' size = '9'>TRUE</font></B></div>";
		}elseif($out == "NAK")
		{
			echo "<div align = 'center'><B><font color = 'red' size = '9'>FALSE</font></B></div>";
		}else
		{
		   echo "<div align = 'center'>".$out."</div>";
		}
			  
		 //echo "<br><br><div align = 'center'>".$itObj->Log."</div>";
	 
		 
	 ?>
	  </div>
	 
	 </BODY>
	 </HTML>
	 


 