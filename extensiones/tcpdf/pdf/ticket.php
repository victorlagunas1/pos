<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";



require_once('tcpdf_include.php');

class imprimirNota{

public $codigo;

public function traerImpresionNota(){

			$item = "codigo";
			$valor = $this->codigo;
			
			$traerVenta = ControladorVentas::ctrMostrarVentas($item, $valor);

			$item = "id";
            $valor = $traerVenta[sucursal];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);


            $listaProducto = json_decode($traerVenta[productos], true); 
            




//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF($orientation='P',$unit='mm', array(58,150));



$pdf->SetMargins(0,0,0,true);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetAutoPageBreak(TRUE, 0);



$pdf->startPageGroup();

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
	
				
			<td style="background-color:white; width:25px"> </td>
			<td style="width:120px" ><img src="images/logo.png"></td>



			</tr>

	</table>


EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');


$bloque2 = <<<EOF

	<table>
		
		<tr>
		<br>
		
			<td style="background-color:white; width:160px">
				
			<div style="font-size:9px; text-align:center; line-height:5px;"><b>$sucursal[nombre]</b></div> 
			<div style="font-size:9px; text-align:center; line-height:5px;">$traerVenta[fecha]</div> 
			<div style="font-size:9px; text-align:center; line-height:5px;">No. Venta: <b>$traerVenta[codigo]</b></div> 
			<br>
	
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

foreach ($listaProducto as $key => $value) {
	$precioFormato = number_format($value["precio"],2); 
	$totalFormato = number_format($value["total"],2); 


$bloque3 = <<<EOF

	<table>
		
		<tr>
	
		
		
			<td style="background-color:white; width:150px">
			<div style="font-size:9px; text-align:center; line-height:9px;">$value[descripcion]</div> 
			<div style="font-size:9px; text-align:right; line-height:3px;"> $$precioFormato x $value[cantidad] uds = <b>$$totalFormato</b> </div> <br>		

	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
}

$totalFormato2 = number_format($traerVenta["total"],2); 
$bloque5 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:155px">
				
			<div style="font-size:9px; text-align:right; line-height:5px;">$traerVenta[metodo_pago]</div> 
			<div style="font-size:9px; text-align:right; line-height:4px;"><b>TOTAL: $ $totalFormato2</b></div> 
			<br>
			
	
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

$bloque6 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:150px">
				
			<div style="font-size:9px; text-align:center; line-height:5px;">#LuceAlMáximo</div> 
			<div style="font-size:8px; text-align:center; line-height:4px;"><b>GRACIAS POR SU COMPRA</b></div> 
			
			
	
			</td>

			
			</tr>

	</table>

EOF;




$pdf->writeHTML($bloque6, false, false, false, false, '');

//$pdf->SetXY(3, 10);
$pdf->write1DBarcode("$traerVenta[codigo]", 'C128', '', '', '', 15, 0.8, $style2, 'l');


//SALIDA DEL ARCHIVO 

$pdf->Output('ticket.pdf');

}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>