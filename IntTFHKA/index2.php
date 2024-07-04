<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

?>
<HTML>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<head>
<title>Demo PHP IntTFHKA</title>
</head>
<BODY>
<div align = "center"><br>
<B>DEMO FISCAL PHP Windows</B><br><br>
	
	<form id="form1" name="form1" method="post" action = "index2.php">
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
	include_once ("TfhkaPHP.php"); 

         $Foperacion = null;
    if(isset($_POST["EnviarComando"]))
    { $Foperacion = $_POST["EnviarComando"]; }

    $itObj = new Tfhka();

if (isset($Foperacion)){
  $out = "";
   if ($Foperacion == "Enviar") {
                $out =  $itObj->SendCmd($_POST["Comando"]);
	  }elseif ($Foperacion == "SubirS1") {
			$out =  $itObj->UploadStatusCmd("S1", "StatusData.txt");
	  }elseif ($Foperacion == "SubirS2") {
			$out =  $itObj->UploadStatusCmd("S2", "StatusData.txt");
	  }elseif ($Foperacion == "SubirS3") {
			$out =  $itObj->UploadStatusCmd("S3", "StatusData.txt");
	  }elseif ($Foperacion == "SubirS4") {
			$out =  $itObj->UploadStatusCmd("S4", "StatusData.txt");
	  }elseif ($Foperacion == "SubirS5") {
			$out =  $itObj->UploadStatusCmd("S5", "StatusData.txt");
	  }elseif ($Foperacion == "SubirS6") {
			$out =  $itObj->UploadStatusCmd("S6", "StatusData.txt");
	  }elseif ($Foperacion == "SubirU0X") {
			$out =  $itObj->UploadReportCmd("U0X" , "ReportData.txt");
	  }elseif ($Foperacion == "SubirU0Z") {
			$out =  $itObj->UploadReportCmd("U0Z" , "ReportData.txt");
	  }elseif ($Foperacion == "Facturar") {

       
        
            $query_ticket = $pdo->prepare("SELECT * FROM tb_ticket");
            $query_ticket->execute();
            $tickets = $query_ticket-> fetchALL(PDO::FETCH_ASSOC);
            foreach($tickets as $ticket){
                $ci = $ticket['ci'];
                echo $ci;
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
            }
	                    
	  
	}elseif ($Foperacion == "Devolucion") {
	        $devolucion = array(-5 => "iS*Pedro Mendez\n",
							-4 => "iR*12.345.678\n",
							-3 => "iF*0000001\n",
			                -2 => "iI*Z4A1234567\n",
							-1 => "iD*18-01-2014\n",
							 0 => "d0000000100000001000Harina\n",
							 1 => "d1000000150000001500Jamon\n",
							 2 => 'd2000000205000003000Patilla\n',
							 3 => "d3000005000000001000Caja de Wisky\n",
							 4 => "101");
							 

			$file = "NotaCredito.txt";	
                $fp = fopen($file, "w+");
                $write = fputs($fp, "");
                         
			foreach($devolucion as $campo => $cmd)
			{
		     	   $write = fputs($fp, $cmd);
			}
                        
                         fclose($fp); 
                         
                         $out =  $itObj->SendFileCmd($file);
                         
	  }elseif ($Foperacion == "ReporteX") {
			$out =  $itObj->SendCmd("I0X");
	  }elseif ($Foperacion == "ReporteZ") {
			$out =  $itObj->SendCmd("I0Z");
	  }elseif ($Foperacion == "SetPort") {
		       $itObj->SetPort($_POST["PortName"]);
	  }	

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
}
	
?>
 </div>

</BODY>
</HTML>


