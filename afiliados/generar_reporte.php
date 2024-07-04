<?php
//============================================================+
// File name   : example_004.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 004 for TCPDF class
//               Cell stretching
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Cell stretching
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group cell
 * @group pdf
 */

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
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 004');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

$PDF_HEADER_TITLE= $nombre_emp.'  RIF:'.$rif_emp;
$PDF_HEADER_STRING= $direccion_emp.'  Tlf:  '.$telefono_emp;

$PDF_HEADER_LOGO= 'logopruebabf.jpg';
define('PDF_HEADER_LOGO_WIDTH', 20); // Establece el ancho del logotipo en 30 píxeles
// set default header data
ob_end_clean();
$pdf->setHeaderData($PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 10);

// add a page
$pdf->AddPage();
// create some HTML content
$html = '
<br>
<p><b>Listado de Afiliados</b></p>
<table border="1" cellpadding:"4">
<tr>
   <td style="background-color: #c0c0c0; text-align:center">Nro</td>
   <td style="background-color: #c0c0c0; text-align:center">Fecha de Registro</td>
   <td style="background-color: #c0c0c0; text-align:center">CI</td>
   <td style="background-color: #c0c0c0; text-align:center">Nombre y Apellido</td>
   <td style="background-color: #c0c0c0; text-align:center">Membrecía</td>
   <td style="background-color: #c0c0c0; text-align:center">Estado</td>
 </tr>
 ';
 
 $contador = 0;
 $query_afiliado = $pdo->prepare("SELECT * FROM tb_afiliados");
 $query_afiliado->execute();
 $afiliados = $query_afiliado-> fetchALL(PDO::FETCH_ASSOC);
 foreach($afiliados as $afiliado){
     $contador = $contador + 1;
     $fecha_reg = $afiliado['fecha_reg'];
     $ci = $afiliado['ci'];
     $nombres = $afiliado['nombres'];
     $apellidos = $afiliado['apellidos'];
     $membrecia = $afiliado['nombre_memb'];
     $estado = $afiliado['estado'];
     $html .= '
<tr>
   <td style= "text-align: center">'.$contador.'</td>
   <td>'.$fecha_reg.'</td>
   <td>'.$ci.'</td>
   <td>'.$nombres." ".$apellidos.'</td>
   <td>'.$membrecia.'</td>
   <td style= "text-align: center">'.$estado.'</td>
 </tr>
 ';
 }

 $html .= '
</table>       
  ';
 

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//Close and output PDF document
$pdf->Output('example_004.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
