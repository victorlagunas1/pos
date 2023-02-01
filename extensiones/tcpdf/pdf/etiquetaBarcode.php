<?php

require_once "../../../controladores/reparaciones.controlador.php";
require_once "../../../modelos/reparaciones.modelo.php";

require_once "../../../controladores/configuracion-reparaciones.controlador.php";
require_once "../../../modelos/configuracion-reparaciones.modelo.php";


require_once('tcpdf_include.php');

class imprimirNota{

public $codigo;

public function traerImpresionNota(){

$itemReparacion = "id";
$valorReparacion = $this->codigo;

$respuestaReparacion = ControladorReparaciones::ctrMostrarReparaciones($itemReparacion, $valorReparacion);


//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS

$valorConfiguracion = 1;
$respuestaConfiguracion = ControladorConfiguradorReparaciones::ctrMostrarConfiguracionReparaciones($itemReparacion, $valorConfiguracion);


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF($orientation='P',$unit='mm', array(42,29));

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->startPageGroup();

$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => array(255,255,255),
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

$pdf->AddPage();


ob_start ();


// ---------------------------------------------------------
// ---------------------------------------------------------

$bloque3 = <<<EOF



	<table>
		
		<tr>

			<td style="background-color:white; width:30px">
				
			<div style="font-size:6px; text-align:left; line-height:7px;"><b>Nombre: </b>$respuestaReparacion[nombre]</div> 
			
			</td>
			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');


$codigo2 = $pdf->write2DBarcode("1234", 'QRCODE,H', 2, 2, 13, 13, $style, 'N', true);





//SALIDA DEL ARCHIVO 

$pdf->Output('barcode.pdf');

}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>