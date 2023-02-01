<?php

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";


require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";


require_once('tcpdf_include.php');

class imprimirNota{

public $codigo;
public $suc;

public function traerImpresionNota(){

	//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS

$itemReparacion = "id";
$valorReparacion = $this->codigo;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemReparacion, $valorReparacion);



//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS CATEGORIAS

$itemReparacion = "id";
$valorReparacion = $respuestaProducto["id_categoria"];

$respuestaCategoria = ControladorCategorias::ctrMostrarCategorias($itemReparacion, $valorReparacion);




$item = "id";
$valor = $this->suc;

$respuestaSucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
//$sucursal2 = ControladorUsuarios::ctrMostrarSucursal($item, $valor);




//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF($orientation='P',$unit='mm', array(30,37));



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

if ($respuestaProducto["id_color"] != null){
	//$color = $respuestaProducto["id_diseño"];

$item = "id";
$valor = $respuestaProducto["id_color"];

$respuestaColor = ControladorCategorias::ctrMostrarDiseño($item, $valor);
$color = $respuestaColor["diseño"];

}else {
	$color = "";
}







if ($respuestaProducto["id_modelo"] != 0){

//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS MODELOS

$itemReparacion = "codigo";
$valorReparacion = $respuestaProducto["id_modelo"];

$respuestaModelo = ControladorCategorias::ctrMostrarModelos($itemReparacion, $valorReparacion);


//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS CATEGORIAS

$itemReparacion = "id";
$valorReparacion = $respuestaModelo["id_marca"];

$respuestaMarca = ControladorCategorias::ctrMostrarMarcas($itemReparacion, $valorReparacion);






$bloque1 = <<<EOF

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
$pdf->writeHTML($bloque1, false, false, false, false, '');


if (strlen($respuestaModelo["modelo"]) <= 15){
	$modelo = $respuestaModelo["modelo"];
	$size = 9.5;

} else {
	$modelo = $respuestaModelo["modelo"];
	$size = 6;
};

$bloque2 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:10px"> </td>	
			<td style="background-color:white; width:80">
				

			<div style="font-size:$size; text-align:left; line-height:0px;"><br><b>$modelo</b></div>

		


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(0, 7.8);
$pdf->writeHTML($bloque2, false, false, false, false, '');




$precioVenta = number_format($respuestaProducto["precio_venta"],2);


if ($respuestaSucursal["precio_producto"] == 0 ){

	$precioVentaMostrar = " ";
} else {

	$precioVentaMostrar = "$ ".$precioVenta;

}

$bloque3 = <<<EOF

<table border="0"  cellpadding="1" cellspacing="0">
		<tr>
			<td style="background-color:white; width:75">

						<div style="font-size:5.5px; text-align:center; line-height:6px;"><b>$respuestaCategoria[categoria] $respuestaProducto[descripcion] $color </b></div> </td>




			</tr>


	</table>



EOF;
$pdf->SetXY(2, 10);
$pdf->writeHTML($bloque3, false, false, false, false, '');

}else{




$bloque6 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:7px"> </td>	
			<td style="background-color:white; width:200">
				

			<div style="font-size:9.5px; text-align:left; line-height:0px;"><br>$respuestaCategoria[categoria]</div>


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(1, 5);
$pdf->writeHTML($bloque6, false, false, false, false, '');

$bloque7 = <<<EOF

	<table>

	

		
		<tr>
			<td style="background-color:white; width:7px"> </td>	
			<td style="background-color:white; width:70">
				

			<div style="font-size:9.5px; text-align:left; line-height:10px;"><br><b>$respuestaProducto[descripcion] $color</b></div>


			</td>

			</tr>


	</table>



EOF;
$pdf->SetXY(1, 3);
$pdf->writeHTML($bloque7, false, false, false, false, '');


	


$precioVenta = number_format($respuestaProducto["precio_venta"],2);


if ($respuestaSucursal["precio_producto"] == 0 ){

	$precioVentaMostrar = " ";
} else {

	$precioVentaMostrar = "$ ".$precioVenta;

}

$bloque9 = <<<EOF

<table border="0"  cellpadding="1" cellspacing="0">
		<tr>
			<td style="background-color:white; width:50">

						<div style="font-size:5.5px; text-align:left; line-height:6px;"></div> </td>




			</tr>


	</table>



EOF;
$pdf->SetXY(0, 2);
$pdf->writeHTML($bloque9, false, false, false, false, '');



}


$bloque10 = <<<EOF

<table border="0"  cellpadding="1" cellspacing="0">
		<tr>
			<td style="background-color:black; width:75">

				<div style="font-size:10px; color:#FFFFFF; text-align:center; line-height:10px;"><b>$precioVentaMostrar</b></div> 


				



			</td>




			</tr>


	</table>



EOF;
$pdf->SetXY(2, 30);
$pdf->writeHTML($bloque10, false, false, false, false, '');



$pdf->write1DBarcode("$respuestaProducto[codigo]", 'C128', '1', '14', '', 16, 0.5, $style2, 'l');



$pdf->IncludeJS("print();");
$pdf->Output('etiquetaProductoBarcode.pdf', 'I');


}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> suc = $_GET["suc"];

$nota -> traerImpresionNota();

?>