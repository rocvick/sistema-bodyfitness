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
<b>  ROCIO AURORA RAMOS UZTARIZ</b><br> 
<b>C.I.:</b>12783782<br> 
<b>Dirección:</b>La Macarena Sur, Sector Vuelta Azúl<br> 
<b>Teléfono:</b>0424-2362012<br> 
---------------------------------------------------------------------------------<br>
<b>  Fecha de Pago:</b>15-03-2024<br> 
<b>N° de Recibo:</b>001<br> 
<b>Membrecía: </b>AFILIADO POR MES<br> 
<b>Precio en Divisas (USD):</b>25,00<br> 
<b>Tasa de Cálculo (Bs):</b>25,00<br> 
<b>Subtotal (Bs):</b>757,26<br> 
<b>IVA (16%):</b>144,24<br> 
<b>Total Cancelado (Bs):</b>901,50<br> 
---------------------------------------------------------------------------------
<b>Usuario:</b>Usuario Logueado
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
