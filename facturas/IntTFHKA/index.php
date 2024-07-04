<?php
include('../../app/config.php');
include_once ("TfhkaPHP.php");
?> 
<HTML>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<head>
<title>Demo PHP IntTFHKA</title>
</head>
<BODY>
<div align = "center"><br>
<B>DEMO FISCAL PHP Windows</B><br><br>
	
	<form id="form1" name="form1" method="post" action = "index.php">
            Configurar Puerto Serial:
		
			<select name="PortName">
				<option value="COM1">COM1
				<option value="COM2">COM2
				<option value="COM3">COM3
				<option value="COM4">COM4
				<option value="COM5">COM5
			</select>
		
         <input name ="EnviarComando" type = "submit"  value="SetPort" /></br></br>
Comando: <input type = "text" name = "Comando" />
<input name ="EnviarComando" type = "submit" value = "Enviar" /></br></br>
<input name ="EnviarComando" type = "submit"  value="SubirS1" />
<input name ="EnviarComando" type = "submit"  value="SubirS2" />
<input name ="EnviarComando" type = "submit"  value="SubirS3"  />
<input name ="EnviarComando" type = "submit"  value="SubirS4" />
<input name ="EnviarComando" type = "submit"  value="SubirS5" />
<input name ="EnviarComando" type = "submit"  value="SubirS6"  />
<input name ="EnviarComando" type = "submit"  value="SubirU0X" />
<input name ="EnviarComando" type = "submit"  value="SubirU0Z" />
</br>
</br>
<input name ="EnviarComando" type = "submit"  value="Facturar" />
<input name ="EnviarComando" type = "submit"  value="Devolucion" />
</br>
</br>
<input name ="EnviarComando" type = "submit"  value="ReporteX" />
<input name ="EnviarComando" type = "submit"  value="ReporteZ" />
</form>
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
				$fecha_fac= $ticket['fecha_fac'];
		   	
		  if ($ci==$id_get){ 
		   $cantidad = 1000;
		   $subtotal_formateado = str_pad(str_replace('.', '', number_format($subtotal, 2, '.', '')), 10, '0', STR_PAD_LEFT);
           $cantidad_formateada = str_pad($cantidad, 8, '0', STR_PAD_LEFT);
		   $factura= array( 4 =>"\n",
			                5 =>"i04AFILIADO:$nombres $apellidos\n",
			                6 =>"i05CI:$ci\n",
							7 =>"i06DIRECCION:$direccion\n",
							8 =>"i07TELEFONO:$telefono\n",
							9 =>"!$subtotal_formateado$cantidad_formateada$nombre_memb\n", 
							10 =>"101");
						};     

							}				                            
		$file = "Factura.txt";	
        $fp = fopen($file, "w+");
       	foreach($factura as $campo => $cmd){
		     	   $write = fputs($fp, $cmd);
			}
		fwrite($fp, "199"); // Enviar el comando 199 para completar la impresión
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
	 


 