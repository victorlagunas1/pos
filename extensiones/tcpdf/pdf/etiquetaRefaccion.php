<?php

require_once "../../../controladores/refacciones.controlador.php";
require_once "../../../modelos/refacciones.modelo.php";

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";



require_once('tcpdf_include.php');

class imprimirNota{

public $codigo;

public function traerImpresionNota(){

	//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS

		$item = "id";
  		$valor =  $this->codigo;
  		$sucursal =  null;

  		$respuestaRefacciones = ControladorRefacciones::ctrMostrarRefacciones($item, $valor,$sucursal);

//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS MODELOS


$itemReparacion = "codigo";
$valorReparacion = "$respuestaRefacciones[id_modelo]";

$respuestaModelo = ControladorCategorias::ctrMostrarModelos($itemReparacion, $valorReparacion);


//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS CATEGORIAS

$itemReparacion = "id";
$valorReparacion = "$respuestaRefacciones[id_categoria]";

$respuestaCategoria = ControladorRefacciones::ctrMostrarCategoriasRefacciones($itemReparacion, $valorReparacion);


//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS CATEGORIAS

$itemReparacion = "id";
$valorReparacion = "$respuestaModelo[id_marca]";

$respuestaMarca = ControladorCategorias::ctrMostrarMarcas($itemReparacion, $valorReparacion);



//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF($orientation='L',$unit='mm', array(30,30));


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
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 6,
    'stretchtext' => 4
);

$pdf->AddPage();




ob_start ();







$bloque6 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:10px"> </td>	
			<td style="background-color:white; width:100">
				

			<div style="font-size:5.5px; text-align:left; line-height:4px;"><br><b>$respuestaCategoria[categoria] $respuestaRefacciones[descripcion]</b></div>


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(0, 8.2);
$pdf->writeHTML($bloque6, false, false, false, false, '');



$bloque2 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:10px"> </td>	
			<td style="background-color:white; width:200">
				

			<div style="font-size:9.5px; text-align:left; line-height:0px;"><br>$respuestaMarca[marca]</div>

		


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(0, 5);
$pdf->writeHTML($bloque2, false, false, false, false, '');


//$html = '<h1>HTML Example</h1>
//<div style="text-align:center">IMAGES<br />
//<img src="images/287.png" alt="test alt attribute" width="300" height="500" border="0" />
//</div>';

// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
if (strlen($respuestaModelo["modelo"]) <= 15){
	$modelo = $respuestaModelo["modelo"];
	$size = 9.5;

} else {
	$modelo = $respuestaModelo["modelo"];
	$size = 6;
};

$bloque9 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:10px"> </td>	
			<td style="background-color:white; width:80">
				

			<div style="font-size:$size; text-align:left; line-height:0px;"><br><b>$modelo</b></div>

		


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(0, 8);
$pdf->writeHTML($bloque9, false, false, false, false, '');




//$pdf->SetXY(5, 10);
$pdf->write1DBarcode("$respuestaRefacciones[codigo]", 'C128', '0', '11.5', '', 18, 0.4, $style2, 'l');



//$pdf->SetXY(10, 10);
//$pdf->write2DBarcode("$respuestaProducto[codigo]", 'QRCODE,H', 15, 5, 70, 70, $style2, 'N', true);


//$codigo3 = $pdf->write1DBarcode('CODE 39 +', 'C39+', '', '', '', 10, 100, $style, 'N');

//$pdf->write1DBarcode("$respuestaProducto[codigo]", 'C128', '', '', '', 10, 100, $style, 'l');

//$pdf->SetXY(0, 10);
//$pdf->write1DBarcode("$respuestaProducto[codigo]", 'C128', '', '', '', 18, 0.4, $style2, 'N');

//$pdf->Ln();

// ---------------------------------------------------------
// ---------------------------------------------------------

//$pdf->lastPage();
//SALIDA DEL ARCHIVO 
$pdf->IncludeJS("print();");
$pdf->Output('barcode.pdf', 'I');


}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>