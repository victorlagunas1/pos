<?php

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";



require_once('tcpdf_include.php');

class imprimirNota{

public $codigo;

public function traerImpresionNota(){

	//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS

$itemReparacion = "id";
$valorReparacion = $this->codigo;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemReparacion, $valorReparacion);


//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS MODELOS


$itemReparacion = "codigo";
$valorReparacion = $respuestaProducto[id_modelo];

$respuestaModelo = ControladorCategorias::ctrMostrarModelos($itemReparacion, $valorReparacion);


//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS CATEGORIAS

$itemReparacion = "id";
$valorReparacion = $respuestaProducto[id_categoria];

$respuestaCategoria = ControladorCategorias::ctrMostrarCategorias($itemReparacion, $valorReparacion);


//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS CATEGORIAS

$itemReparacion = "id";
$valorReparacion = "$respuestaModelo[id_marca]";

$respuestaMarca = ControladorCategorias::ctrMostrarMarcas($itemReparacion, $valorReparacion);



//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF($orientation='L',$unit='mm', array(29,15));



$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(FALSE);
$pdf->SetFooterMargin(FALSE);

$pdf->SetAutoPageBreak(TRUE, 0);


$pdf->startPageGroup();

$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

$pdf->AddPage();




ob_start ();





$bloque1 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:10px"> </td>	
			<td style="background-color:white; width:50">
				
			<div style="font-size:5.5px; text-align:left; line-height:0px;"><br><b>Mix Store</b></div>


			</td>

			</tr>


	</table>



EOF;
//$pdf->StartTransform();
//$pdf->Rotate(90);
//$pdf->SetXY(14.7, 13.4);
$pdf->SetXY(10, 3.6);
//$pdf->MultiCell(5, 5, '', 1, 'C', 0, 1, '', '', true);
$pdf->writeHTML($bloque1, false, false, false, false, '');
//$pdf->StopTransform();



$bloque6 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:13px"> </td>	
			<td style="background-color:white; width:100">
				

			<div style="font-size:5.5px; text-align:left; line-height:0px;"><br><b>$respuestaCategoria[categoria]</b></div>


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(9, 5.3);
$pdf->writeHTML($bloque6, false, false, false, false, '');



$bloque2 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:13px"> </td>	
			<td style="background-color:white; width:100">
				

			<div style="font-size:4px; text-align:left; line-height:0px;"><br>$respuestaMarca[marca]</div>

		


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(9, 7);
$pdf->writeHTML($bloque2, false, false, false, false, '');


$bloque9 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:13px"> </td>	
			<td style="background-color:white; width:100">
				

			<div style="font-size:5.5px; text-align:left; line-height:0px;"><br>$respuestaModelo[modelo]</div>

		


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(9, 8.5);
$pdf->writeHTML($bloque9, false, false, false, false, '');




$bloque3 = <<<EOF

	<table>
		<tr>
			<td style="background-color:white; width:13px"> </td>	
			<td style="background-color:white; width:60">
				
			<div style="font-size:9px; text-align:left; line-height:-0px;"><b>$respuestaProducto[codigo]</b></div>

			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(9, 10.8);
$pdf->writeHTML($bloque3, false, false, false, false, '');




$codigo2 = $pdf->write2DBarcode("$respuestaProducto[codigo]", 'QRCODE,H', 1.5, 1.2, 12.7, 12.7, $style, 'N', true);


// ---------------------------------------------------------
// ---------------------------------------------------------

$pdf->lastPage();
//SALIDA DEL ARCHIVO 
$pdf->IncludeJS("print();");
$pdf->Output('barcode.pdf', 'I');


}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>