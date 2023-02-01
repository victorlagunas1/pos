<?php

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";



require_once('tcpdf_include.php');

class imprimirNota{

public $codigo;

public function traerImpresionNota(){




//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS CATEGORIAS


		  $item = "id";
          $valor = $_GET["codigo"];

          $seccion = ControladorCategorias::ctrMostrarSeccionRefacciones($item, $valor);


$itemReparacion = "id";
$valorReparacion = $seccion["id_categoria"];

$respuestaCategoria = ControladorCategorias::ctrMostrarCategoriasRefacciones($itemReparacion, $valorReparacion);




//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF($orientation='L',$unit='mm', array(30,50));


$pdf->SetMargins(0,0,0,true);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

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

// define barcode style
$style2 = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => false,
    'font' => 'helvetica',
    'fontsize' => 6,
    'stretchtext' => 4
);

$pdf->AddPage();

ob_start ();

$bloque1 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:7px"> </td>	
			<td style="background-color:white; width:100">
				

			<div style="font-size:45px; text-align:left; line-height:0px;"><br><b>$seccion[seccion]</b></div>


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(0, 10);
$pdf->writeHTML($bloque1, false, false, false, false, '');

$bloque3 = <<<EOF

	<table>

	

		
		<tr>
				
			<td style="background-color:white; width:70">
				

			<div style="font-size:15px; text-align:left; line-height:12px;"><br><b>$respuestaCategoria[categoria]</b></div>


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(25, 0);

$pdf->writeHTML($bloque3, false, false, false, false, '');


//$pdf->SetXY(3, 10);
$pdf->write1DBarcode("$seccion[seccion]", 'C128', '24', '17', '', 10, 0.3, $style2, 'l');


// ---------------------------------------------------------
// ---------------------------------------------------------

//$pdf->lastPage();

$pdf->IncludeJS("print();");
$pdf->Output('etiquetaSeccion.pdf', 'I');

}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>