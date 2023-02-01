<?php

require_once "../../../controladores/reparaciones.controlador.php";
require_once "../../../modelos/reparaciones.modelo.php";

require_once "../../../controladores/configuracion-reparaciones.controlador.php";
require_once "../../../modelos/configuracion-reparaciones.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/cotizaciones.controlador.php";
require_once "../../../modelos/cotizaciones.modelo.php";

require_once('tcpdf_include.php');

class imprimirNota{

public $codigo;

public function traerImpresionNota(){

$itemReparacion = "id";
$valorReparacion = $this->codigo;

$respuestaReparacion = ControladorReparaciones::ctrMostrarReparaciones($itemReparacion, $valorReparacion);

 			
 						$item = "id";
            $valor = $respuestaReparacion["id_sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);


           



//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');


//$pdf = new TCPDF($orientation, 'pt', $paperSize);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);


$pdf->SetMargins(10, 5, 10, 5);
$pdf->SetAutoPageBreak(TRUE, 0);
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
    'module_height' => 1,
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4 // height of a single module in points
);

$pdf->AddPage();



ob_start ();




$pdf->SetDrawColor(233, 233, 233);
$pdf->SetFillColor(203, 203, 203);
//$pdf->Rect(5, 110, 150, 30, 'DF', '');
$pdf->Rect(150, 0, 70, 300, 'DF', '');


$bloque1 = <<<EOF

	<table>
		
		<tr>

		<td style="background-color:white; width:10px"> </td>


			<td style="width:120px"><img src="images/logo.png"></td>

					
			<td style="background-color:white; width:250px">
				
			<br>
			<div style="font-size:8px; text-align:center; line-height:10px;">$sucursal[direccion]</div>
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



$bloque2 = <<<EOF

	<table>
		
		<tr>
		
		<td style="background-color:white; width:1px"> </td>
		
			<td style="background-color:white; width:400px">
				
			<div style="font-size:15px; text-align:left; line-height:7px;"><b>$respuestaReparacion[nombre]</b></div> 
			<div style="font-size:10px; text-align:left; line-height:0px;"><b>______________________________________________________________________</b></div> 
			


			
			</td>
			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');



// ---------------------------------------------------------
// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table>

		<table border="0"  cellpadding="3" cellspacing="0">

		


		
		
		
		<tr>
		

		
		
		
			<td style="background-color:white; width:150px">

		

	
				
			<div style="font-size:10px; text-align:left; line-height:5px;"><br><b>Marca: </b>$respuestaReparacion[marca]</div> 
			<div style="font-size:10px; text-align:left; line-height:5px;"><b>Modelo: </b>$respuestaReparacion[modelo]</div>
			 

			<div style="font-size:10px; text-align:left; line-height:5px;"><b>Color: </b>$respuestaReparacion[color]</div> 
			

			</td>

		
			<td style="background-color:white; width:220px">
				
			

			<div style="font-size:10px; text-align:left; line-height:5px;"><br><b>Tel: </b>$respuestaReparacion[telefono]</div> 
			<div style="font-size:10px; text-align:left; line-height:5px;"><b>Contraseña: </b>$respuestaReparacion[pass]</div> 
			<div style="font-size:10px; text-align:left; line-height:5px;"><b>Serie/IMEI: </b>$respuestaReparacion[serie_imei]</div> 

			</td>




			</tr>
			</table>

			


	</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');



// ---------------------------------------------------------
// ---------------------------------------------------------

$bloque4 = <<<EOF

	<table>
		
		<tr>
	<br>

		
		
			<td style="background-color:white; width:370px">
				
			<div style="font-size:10px; text-align:left; line-height:0px;"><b>Estado previo y características del dispositivo: </b></div> 

			<div style="font-size:10px; text-align:left; line-height:10px;">$respuestaReparacion[comentarios]</div> 
	
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');



$bloque13 = <<<EOF

	<table>
		<tr>
		<td style="background-color:white; width:10px"> </td>
			<td style="width:150px"><img src="images/firmas2.png"></td>		
			</tr>
	</table>



EOF;
$pdf->SetXY(150, 43);
$pdf->writeHTML($bloque13, false, false, false, false, '');


$bloque14 = <<<EOF

	<table>
		<tr>
		<td style="background-color:white; width:10px"> </td>
			<td style="width:150px"><img src="images/redes.png"></td>		
			</tr>
	</table>



EOF;
$pdf->SetXY(150, 105);
$pdf->writeHTML($bloque14, false, false, false, false, '');


// ---------------------------------------------------------



$precioReparacion = number_format($respuestaReparacion["precio"],2);

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table>
		
		<tr>
		
		<br>

		<td style="background-color:white; width:1px"> </td>
		
			<td style="background-color:white; width:270px">
					
		<div style="font-size:10px; text-align:left; line-height:5px;"><b>Reparación: </b>$respuestaReparacion[servicio]</div> 
		</td>


		<td style="background-color:white; width:140px">
		
		<div style="font-size:10px; text-align:left; line-height:5px;"><b>Precio: </b>$ $precioReparacion</div> 





			</td>

				<div style="font-size:7px; text-align:left; line-height:0px;"><b>____________________________________________________________________________________________________</b></div> 
			

			

			</tr>


	</table>

EOF;
$pdf->SetY(90);

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

//$pdf->writeHTML($bloque6, false, false, false, false, '');



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

//$pdf->writeHTML($bloque7, false, false, false, false, '');




//$bloque11 .= '<table>
		
		
//			<tr>
//				<td><tcpdf method="write2DBarcode" params="'.$codigo2.'"/></td>
			
//			</tr>

//	</table>';

//$pdf->writeHTML($bloque11, true, 0, true, 0);



if ($respuestaReparacion["riesgos"] !== ""){

	$bloque10 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:400px">
					<div style="font-size:7px; text-align:left; line-height:7px;"><b>Riesgos</b></div> 
	
		</td>

			</tr>
	</table>


EOF;

$pdf->writeHTML($bloque10, false, false, false, false, '');
// ---------------------------------------------------------
 


 $listaRiesgos = json_decode($respuestaReparacion["riesgos"], true); 


foreach ($listaRiesgos as $key => $value) {

            $tabla = "reparaciones_riesgo";
            
            $item = "id";
            $valor = $value;

            $riesgo = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);




$bloque11 = 

<<<EOF

	<table>


		<tr>
		
			
			<td style="background-color:white; width:400px">

			<div style="font-size:6.5px; text-align:left; line-height:7px;"><b>$riesgo[riesgo] :</b> $riesgo[descripcion]</div> 
			


			</td>


			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque11, false, false, false, false, '');

}


}



// ---------------------------------------------------------
$bloque8 = <<<EOF

	<table>
		
		<tr>
		

		
		<div style="font-size:7px; text-align:left; line-height:4px;"><b>Términos y condiciones</b></div> 
		
			<td style="background-color:white; width:400px">
					
		<div style="font-size:6.5px; text-align:left; line-height:6.5px;">$sucursal[terminos]</div> 

		</td>

			</tr>


	</table>

	
	

	

EOF;




$pdf->writeHTML($bloque8, false, false, false, false, '');








$bloque12 = <<<EOF

	<table>
		
		<tr>

					<td style="background-color:white; width:160px">
		
			<div style="font-size:8px; text-align:center; line-height:7px;"><b>FECHA: </b>$respuestaReparacion[fecha]</div>

				

			</td>
			
			</tr>



	</table>



EOF;
$pdf->setXY(153,15);
$pdf->writeHTML($bloque12, false, false, false, false, '');




//$codigo2 = $pdf->write2DBarcode("fb://page?id=1864386860465796", 'QRCODE,H', 170, 90, 18, 18, $style, 'N', true);
//$pdf->Cell(0, 0, 'CODE AUTO', 0, 1);
$valorReparacion2 = $this->codigo;
$codigo3 = $pdf->write1DBarcode('MIX0'.$valorReparacion2,'C128', 161, 20, 40, 16, 0.4, $style, 'N');

$codigo4 = $pdf->write1DBarcode('MIX0'.$valorReparacion2,'C128', 161, 155, 40, 16, 0.4, $style, 'N');




$pdf->SetY(140);
$pdf->writeHTML($bloque1, false, false, false, false, '');
$pdf->writeHTML($bloque2, false, false, false, false, '');
$pdf->writeHTML($bloque3, false, false, false, false, '');
$pdf->writeHTML($bloque4, false, false, false, false, '');

$pdf->SetXY(0,0);
$pdf->SetXY(150,180);
$pdf->writeHTML($bloque13, false, false, false, false, '');
$pdf->SetXY(150, 240);
$pdf->writeHTML($bloque14, false, false, false, false, '');
$pdf->SetXY(153, 150);
$pdf->writeHTML($bloque12, false, false, false, false, '');



$pdf->SetY(225);
$pdf->writeHTML($bloque5, false, false, false, false, '');



//$pdf->writeHTML($bloque7, false, false, false, false, '');



if ($respuestaReparacion["riesgos"] !== ""){

	$bloque20 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:400px">
					<div style="font-size:7px; text-align:left; line-height:7px;"><b>Riesgos</b></div> 
	
		</td>

			</tr>
	</table>


EOF;

$pdf->writeHTML($bloque20, false, false, false, false, '');
// ---------------------------------------------------------
 


 $listaRiesgos = json_decode($respuestaReparacion["riesgos"], true); 


foreach ($listaRiesgos as $key => $value) {

            $tabla = "reparaciones_riesgo";
            
            $item = "id";
            $valor = $value;

            $riesgo = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);




$bloque21 = 

<<<EOF

	<table>


		<tr>
		
			
			<td style="background-color:white; width:400px">

			<div style="font-size:6.5px; text-align:left; line-height:7px;"><b>$riesgo[riesgo] :</b> $riesgo[descripcion]</div> 
			


			</td>


			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque21, false, false, false, false, '');

}


}


$pdf->writeHTML($bloque8, false, false, false, false, '');




// Table with rowspans and THEAD
$tbl = <<<EOD




<table border="0"  cellpadding="0" cellspacing="0">

 <tr>
 
  <td width="15" style="background-color:#BDBDBD;"></td>
  <td width="85"> TouchScreen</td>
  <td width="15" style="background-color:#BDBDBD;"></td>
  <td width="85"> WIFI</td>
  <td width="15" style="background-color:#BDBDBD;" ></td>
 <td width="85"> Cámara frontal</td>
  <td width="15" style="background-color:#BDBDBD;" ></td>
  <td width="85"> Tornillos Especiales</td>
 </tr>

  <tr>
  
  <td width="15"  style="background-color:#9E9E9E;" ></td>
  <td width="85"> Display/LCD</td>
  <td width="15" style="background-color:#9E9E9E;" ></td>
  <td width="85"> Bluetooth</td>
  <td width="15" style="background-color:#9E9E9E;" ></td>
 <td width="85"> Cámara trasera</td>
  <td width="15" style="background-color:#9E9E9E;" ></td>
  <td width="85"> Placa batería</td>
 </tr>
 <tr>
 
 <td width="15" style="background-color:#BDBDBD;" ></td>
  <td width="85"> Botón +</td>
  <td width="15" style="background-color:#BDBDBD;" > </td>
  <td width="85"> Face/Home ID</td>
 <td width="15" style="background-color:#BDBDBD;" > </td>
 <td width="85"> Flash</td>
 <td width="15" style="background-color:#BDBDBD;" > </td>
  <td width="85"> Placa pantalla</td>
 </tr>
  <tr>
 
 <td width="15" style="background-color:#9E9E9E;" > </td>
  <td width="85" > Botón -</td>
 <td width="15" style="background-color:#9E9E9E;" > </td>
  <td width="85"> Sensor de proximidad</td>
  <td width="15" style="background-color:#9E9E9E;" > </td>
 <td width="85"> Detección de carga</td>
  <td width="15" style="background-color:#9E9E9E;" > </td>
  <td width="85"> Placa de cámaras</td>
 </tr>
   <tr>
   
  <td width="15" style="background-color:#BDBDBD;" > </td>
  <td width="85"> Botón inicio</td>
  <td width="15" style="background-color:#BDBDBD;" > </td>
  <td width="85"> Vibrador</td>
  <td width="15" style="background-color:#BDBDBD;" > </td>
 <td width="85"> Bocina Altavoz</td>
<td width="15" style="background-color:#BDBDBD;" > </td>
  <td width="85"> Placa de boton</td>
 </tr>
   <tr>
  
 <td width="15" style="background-color:#9E9E9E;" > </td>
  <td width="85"> Microfono</td>
  <td width="15" style="background-color:#9E9E9E;" > </td>
  <td width="85"> IMEI *#06#</td>
  <td width="15" style="background-color:#9E9E9E;" > </td>
 <td width="85"> Bocina Auricular</td>
  <td width="15" style="background-color:#9E9E9E;" > </td>
  <td width="85"> Tapa estrellada</td>
 </tr>
   <tr>
   
  <td width="15" style="background-color:#BDBDBD;" > </td>
  <td width="85"> Jack Audio</td>
  <td width="15" style="background-color:#BDBDBD;" > </td>
  <td width="85"> Señal GSM</td>
  <td width="15" style="background-color:#BDBDBD;" > </td>
 <td width="85"> Condición de batería</td>
  <td width="15" style="background-color:#BDBDBD;" > </td>
  <td width="85"> </td>
 </tr>
</table>
EOD;
$pdf->SetXY(10,205);
$pdf->SetFont('helvetica', 'B', 7);
$pdf->writeHTML($tbl, true, false, false, false, '');



//$pdf->Button('', 30, 10, 'Imprimir', 'print()', array('lineWidth'=>2, 'borderStyle'=>'beveled', 'fillColor'=>array(128, 196, 255), 'strokeColor'=>array(64, 64, 64)));





// ---------------------------------------------------------

//Close and output PDF document

$pdf->Output('notaReparacion.pdf');


//============================================================+
// END OF FILE
//============================================================+


}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>