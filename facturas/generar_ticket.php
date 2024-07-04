<?php
// Include the main TCPDF library (search for installation path).
require_once('../app/templeates/TCPDF-main/tcpdf.php');
include('../app/config.php');

//cargar el encabezado
$query_informaciones = $pdo->prepare("SELECT * FROM tb_informaciones");
$query_informaciones->execute();
$informaciones = $query_informaciones->fetchALL(PDO::FETCH_ASSOC);
foreach ($informaciones as $informacion) {
    $id_inf = $informacion['id_inf'];
    $nombre_emp = $informacion['nombre_emp'];
    $rif_emp = $informacion['rif_emp'];
    $direccion_emp = $informacion['direccion_emp'];
    $telefono_emp = $informacion['telefono_emp'];
}


//cargar la información del ticket

$query_ticket = $pdo->prepare("SELECT * FROM tb_ticket ");
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
}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79,100), PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 002');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(5, 5, 5);

// set auto page breaks
$pdf->setAutoPageBreak(false, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 6.5);

// add a page
$pdf->AddPage();
// create some HTML content
$html = '
<p style="text-align:center">
<b>SENIAT</b><br>
'.$nombre_emp.' <br>
'.$rif_emp.'<br>
'.$direccion_emp.'<br>
'.$telefono_emp.'<br>
--------------------------------------------------------------------------------
<div style="text-align:left">
<b>DATOS DEL AFILIADO (A)</b><br>
<b>'.$nombres.','.$apellidos.'</b><br> 
<b>C.I.:</b>'.$ci.'<br> 
<b>Dirección:</b>'.$direccion.'<br> 
<b>Teléfono:</b>'.$telefono.'<br> 
---------------------------------------------------------------------------------<br>
<b>  Fecha de Pago:</b>'.$fecha_fac.'<br> 
<b>N° de Recibo:</b>'.$num_fact.'<br> 
<b>Membrecía: </b>'.$nombre_memb.'<br> 
<b>Precio en Divisas (USD):</b>'.$precio_div.'<br> 
<b>Tasa de Cálculo (Bs):</b>'.$precio_bs.'<br> 
<b>Subtotal (Bs):</b>'.$subtotal.'<br> 
<b>IVA (16%):</b>'.$iva_calc.'<br> 
<b>Total Cancelado (Bs):</b>'.$monto_de_cancelacion.'<br> 
---------------------------------------------------------------------------------
<b>**CONTINÚA ENTRENANDO TU CUERPO Y AUMENTA TÚ<br>
<b>SALUD CON BODYFITNESS - GRACIAS POR PREFERIRNOS**</b><br>

</div>
</p>

</div>
<div style="text-align:center"><br />
</div>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

