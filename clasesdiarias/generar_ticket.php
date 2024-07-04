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

$id_get = $_GET['id'];
        $query_clasediaria = $pdo->prepare("SELECT * FROM tb_clasesdiarias WHERE id_cd = '$id_get'");
        $query_clasediaria->execute();
        $clasesdiarias = $query_clasediaria-> fetchALL(PDO::FETCH_ASSOC);
        foreach($clasesdiarias as $clasediaria){
            $id_cd = $clasediaria['id_cd'];
            $nombre_apellido = $clasediaria['nombre_apellido'];
            $email = $clasediaria['email'];
            $precio_div = $clasediaria['precio_div'];
            $precio_bs = $clasediaria['precio_bs'];
            $monto_de_cancelacion = $clasediaria['monto_de_cancelacion'];
            $iva_calc = $clasediaria['iva_calc'];
            $subtotal = $clasediaria['subtotal'];
            $fyh_registro = $clasediaria['fyh_registro'];

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
<b>SERVICIO DE: CLASE DIARIA</b><br><br>
<b>Cliente:</b>'.$nombre_apellido.'</b><br>
<b>Email:</b>'.$email.'</b><br> 
---------------------------------------------------------------------------------<br>
<b>  Fecha y Hora: </b>'.$fyh_registro.'<br> 
<b>N° de Recibo: </b>'.$id_cd.'<br> 

<b>Precio en Divisas (USD): </b>'.$precio_div.'<br> 
<b>Tasa de Cálculo (Bs): </b>'.$precio_bs.'<br> 
<b>Subtotal (Bs): </b>'.$subtotal.'<br> 
<b>IVA (16%): </b>'.$iva_calc.'<br> 
<b>Total Cancelado (Bs): </b>'.$monto_de_cancelacion.'<br> 

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


