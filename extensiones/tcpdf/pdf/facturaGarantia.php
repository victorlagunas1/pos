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

				
<br>
			<br>


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

$bloque2 = <<<EOF

	<table>
		
		<tr>

		<td style="background-color:white; width:15px"> </td>
		
			<td style="background-color:white; width:550px">
				
			<div style="font-size:25px; text-align:left; line-height:7px;"><b>$respuestaReparacion[nombre]</b></div> 
			<div style="font-size:10px; text-align:left; line-height:7px;"><b>_____________________________________________________________________________________________</b></div> 


			
			</td>
			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');



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

		<td style="background-color:white; width:15px"> </td>
		
			<td style="background-color:white; width:510px">
				
			<div style="font-size:10px; text-align:left; line-height:0px;"><b>Descripción del equipo: </b></div> 

			<div style="font-size:10px; text-align:left; line-height:12px;">$respuestaReparacion[comentarios]</div> 
	
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');






// ---------------------------------------------------------



$precioReparacion = number_format($respuestaReparacion["precio"],2);

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
		
		<div style="font-size:10px; text-align:left; line-height:5px;"><b>Precio: </b>$ $precioReparacion</div> 



			</td>

			

			</tr>
			



	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');





$bloque14 = <<<EOF

	
	
	<table>
<br>
<br>
		
		<tr>


		<td style="background-color:white; width:15px"> </td>
		
			<td style="background-color:white; width:510px">
				
			<div style="font-size:10px; text-align:left; line-height:0px;"><b>Nota de revisión: </b></div> 

			<div style="font-size:10px; text-align:left; line-height:12px;">$respuestaReparacion[nota_garantia]</div> 
	
			</td>

			
			</tr>



	</table>

EOF;

$pdf->writeHTML($bloque14, false, false, false, false, '');




// ---------------------------------------------------------
$bloque6 = <<<EOF

	<table>
	<br>

	
	
		
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
					
		<div style="font-size:6px; text-align:left; line-height:7px;">$respuestaConfiguracion[terminos]</div> 

		</td>

			</tr>


	</table>

	
	

	

EOF;


$pdf->writeHTML($bloque8, false, false, false, false, '');

//$codigo2 = $pdf->write2DBarcode("fb://page?id=1864386860465796", 'QRCODE,H', 170, 90, 18, 18, $style, 'N', true);
//$pdf->Cell(0, 0, 'CODE AUTO', 0, 1);
$valorReparacion2 = $this->codigo;
$codigo3 = $pdf->write1DBarcode('MIX0'.$valorReparacion2,'C128', 165, 30, 30, 12, 0.4, $style, 'N');

$codigo4 = $pdf->write1DBarcode('MIX0'.$valorReparacion2,'C128', 165, 150, 30, 12, 0.4, $style, 'N');



$pdf->SetY(130);
$pdf->writeHTML($bloque1, false, false, false, false, '');
$pdf->writeHTML($bloque2, false, false, false, false, '');
$pdf->writeHTML($bloque3, false, false, false, false, '');
$pdf->writeHTML($bloque4, false, false, false, false, '');
$pdf->writeHTML($bloque5, false, false, false, false, '');
$pdf->writeHTML($bloque6, false, false, false, false, '');
$pdf->writeHTML($bloque7, false, false, false, false, '');
$pdf->writeHTML($bloque8, false, false, false, false, '');


// Table with rowspans and THEAD
$tbl = <<<EOD
<br>
<br>


<b style="font-size:10px; text-align:center;" >COMPROBACIÓN DE FUNCIONES</b>
<br>

<table border="0"  cellpadding="0" cellspacing="0">

 <tr>
 <td style="background-color:white; width:20px"> </td>
  <td width="20" style="background-color:#BDBDBD;" ></td>
  <td width="100"> TouchScreen</td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> WIFI</td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
 <td width="100"> Cámara frontal</td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> Tornillos Especiales</td>
 </tr>

  <tr>
  <td style="background-color:white; width:20px"> </td>
  <td width="20"  style="background-color:#9E9E9E;" > </td>
  <td width="100"> Display/LCD</td>
  <td width="20" style="background-color:#9E9E9E;" > </td>
  <td width="100"> Bluetooth</td>
  <td width="20" style="background-color:#9E9E9E;" > </td>
 <td width="100"> Cámara trasera</td>
  <td width="20" style="background-color:#9E9E9E;" > </td>
  <td width="100"> Placa batería</td>
 </tr>
 <tr>
 <td style="background-color:white; width:20px"> </td>
 <td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> Botón +</td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> Face/Home ID</td>
 <td width="20" style="background-color:#BDBDBD;" > </td>
 <td width="100"> Flash</td>
 <td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> Placa pantalla</td>
 </tr>
  <tr>
  <td style="background-color:white; width:20px"> </td>
 <td width="20" style="background-color:#9E9E9E;" > </td>
  <td width="100" > Botón -</td>
 <td width="20" style="background-color:#9E9E9E;" > </td>
  <td style="font-size:9px; text-align:left;" width="100"> Sensor de proximidad</td>
  <td width="20" style="background-color:#9E9E9E;" > </td>
 <td style="font-size:9px; text-align:left;" width="100"> Detección de carga</td>
  <td width="20" style="background-color:#9E9E9E;" > </td>
  <td style="font-size:9px; text-align:left;" width="100"> Placa de cámaras</td>
 </tr>
   <tr>
   <td style="background-color:white; width:20px"> </td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> Botón inicio</td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> Vibrador</td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
 <td width="100"> Bocina Altavoz</td>
<td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> Placa de boton</td>
 </tr>
   <tr>
   <td style="background-color:white; width:20px"> </td>
 <td width="20" style="background-color:#9E9E9E;" > </td>
  <td width="100"> Microfono</td>
  <td width="20" style="background-color:#9E9E9E;" > </td>
  <td width="100"> IMEI *#06#</td>
  <td width="20" style="background-color:#9E9E9E;" > </td>
 <td width="100"> Bocina Auricular</td>
  <td width="20" style="background-color:#9E9E9E;" > </td>
  <td width="100"> Tapa estrellada</td>
 </tr>
   <tr>
   <td style="background-color:white; width:20px"> </td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> Jack Audio</td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> Señal GSM</td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
 <td style="font-size:9px; text-align:left;" width="100"> Condición de batería</td>
  <td width="20" style="background-color:#BDBDBD;" > </td>
  <td width="100"> </td>
 </tr>
</table>
EOD;

$pdf->SetFont('helvetica', 'B', 9);
$pdf->writeHTML($tbl, true, false, false, false, '');




// ---------------------------------------------------------
// --------------------------------------------------------
//SALIDA DEL ARCHIVO 
// force print dialog

$pdf->IncludeJS("print();");
$pdf->Output('factura.pdf');


}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>