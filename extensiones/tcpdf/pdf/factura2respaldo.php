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

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->startPageGroup();

$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => array(245,245,245),
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

$pdf->AddPage();

ob_start ();


$bloque1 = <<<EOF

	<table>
		
		<tr>

		<td style="background-color:white; width:10px"> </td>


			<td style="width:120px"><img src="images/logo.png"></td>

					
			<td style="background-color:white; width:250px">
				
			<br>
			<div style="font-size:9px; text-align:center; line-height:10px;">$respuestaConfiguracion[direccion]</div>
			</td>
			

			<td style="background-color:white; width:160px">
			<br><br>

			<div  style="font-size:28px; font-weight: bold; text-align:center; line-height:0px;"><br>MIX0$valorReparacion</div>


			<div style="font-size:8px; text-align:center; line-height:7px;"><br><b>FECHA: </b>$respuestaReparacion[fecha]</div>

				



			</td>



			</tr>


	</table>



EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');







// ---------------------------------------------------------


//$bloque2 = <<<EOF

//	<table>
		
//		<tr>

//		<td style="background-color:white; width:120px"> </td>
		
//			<td style="background-color:white; width:280px">
				
//			<div style="font-size:12px; text-align:left; line-height:7px;"><b>Nombre: </b>$respuestaReparacion[nombre]</div> 
//			</td>

			
//			</tr>

//	</table>

//EOF;

//$pdf->writeHTML($bloque2, false, false, false, false, '');

$bloque12 = <<<EOF

	<table>
		
		<tr>
		<br>


		<td style="background-color:white; width:15px"> </td>
		
			<td style="background-color:white; width:550px">
				
			<div style="font-size:25px; text-align:left; line-height:7px;"><b>$respuestaReparacion[nombre]</b></div> 
			<div style="font-size:10px; text-align:left; line-height:7px;"><b>_____________________________________________________________________________________________</b></div> 


			
			</td>
			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque12, false, false, false, false, '');



// ---------------------------------------------------------
// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table>
		
		<tr>
		<br>

		<td style="background-color:white; width:15px"> </td>


		
			<td style="background-color:white; width:150px">

	
				
			<div style="font-size:10px; text-align:left; line-height:5px;"><b>Marca: </b>$respuestaReparacion[marca]</div> 

			<div style="font-size:10px; text-align:left; line-height:5px;"><b>Color: </b>$respuestaReparacion[color]</div> 
			

			</td>

		
			<td style="background-color:white; width:220px">
				
			<div style="font-size:10px; text-align:left; line-height:5px;"><b>Modelo: </b>$respuestaReparacion[modelo]</div> 

			<div style="font-size:10px; text-align:left; line-height:5px;"><b>Contraseña: </b>$respuestaReparacion[pass]</div> 
			

			</td>

			<td style="background-color:white; width:170px">


			<div style="font-size:10px; text-align:left; line-height:5px;"><b>Tel: </b>$respuestaReparacion[telefono]</div> 

			<div style="font-size:10px; text-align:left; line-height:5px;"><b>Serie/IMEI: </b>$respuestaReparacion[serie_imei]</div> 

			

			</td>


			</tr>

			


	</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');


// ---------------------------------------------------------



// ---------------------------------------------------------
// ---------------------------------------------------------

$bloque4 = <<<EOF

	<table>
		
		<tr>
		<br>
		<br>
		

		<td style="background-color:white; width:15px"> </td>
		
			<td style="background-color:white; width:510px">
				
			<div style="font-size:10px; text-align:left; line-height:0px;"><b>Comentarios: </b></div> 

			<div style="font-size:10px; text-align:left; line-height:12px;">$respuestaReparacion[comentarios]</div> 
	
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');





// ---------------------------------------------------------

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table>
		
		<tr>
		
		<br>

		<td style="background-color:white; width:15px"> </td>
		
			<td style="background-color:white; width:400px">
					
		<div style="font-size:10px; text-align:left; line-height:5px;"><b>Reparación: </b>$respuestaReparacion[servicio]</div> 
		</td>


		<td style="background-color:white; width:110px">
		
		<div style="font-size:10px; text-align:left; line-height:5px;"><b>Precio: </b>$ $respuestaReparacion[precio]</div> 



			</td>

			

			</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');




// ---------------------------------------------------------
$bloque6 = <<<EOF

	<table>
		
		<tr>
		<td style="background-color:white; width:15px"> </td>
		<td style="width:400px"><img src="images/firmas.png"></td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');



// ---------------------------------------------------------
$bloque7 = <<<EOF

	<table>
		
		<tr>
		<td style="background-color:white; width:15px"></td>

		
	<td style="background-color:white; width:30px"></td>
		<td>
		<div style="font-size:10px; text-align:center; line-height:5px;">Recepciona</div> 

		</td>

		<td style="background-color:white; width:55px"></td>
		<td>
		<div style="font-size:10px; text-align:center; line-height:5px;">Cliente</div> 

		</td>

		<td style="background-color:white; width:55px"></td>
		<td>
		<div style="font-size:10px; text-align:center; line-height:5px;">Cliente</div> 


		</td>


			</tr>


	</table>

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');




//$bloque11 .= '<table>
		
		
//			<tr>
//				<td><tcpdf method="write2DBarcode" params="'.$codigo2.'"/></td>
			
//			</tr>

//	</table>';

//$pdf->writeHTML($bloque11, true, 0, true, 0);


// ---------------------------------------------------------
$bloque8 = <<<EOF

	<table>
		
		<tr>
		

		<td style="background-color:white; width:15px"> </td>
		
			<td style="background-color:white; width:500px">
					
		<div style="font-size:6px; text-align:left; line-height:7px;">$respuestaConfiguracion[terminos]



		</div> 
		</td>

			</tr>


	</table>
	<br>
	

EOF;


$pdf->writeHTML($bloque8, false, false, false, false, '');

$codigo2 = $pdf->write2DBarcode("fb://page?id=1864386860465796", 'QRCODE,H', 170, 90, 18, 18, $style, 'N', true);

// ---------------------------------------------------------
// --------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->IncludeJS("print();");
$pdf->Output('factura.pdf');


}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>