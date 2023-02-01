<?php


require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";

require_once "../../../controladores/cotizaciones.controlador.php";
require_once "../../../modelos/cotizaciones.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";



require_once('tcpdf_include.php');

class imprimirNota{

public $codigo;

public function traerImpresionNota(){




 $item = "id";
 $valor = $this->codigo;

  $respuestaCotizacion = ControladorCotizaciones::ctrMostrarCotizacionCliente($item, $valor);


 $item = "codigo";
 $valor = $respuestaCotizacion["modelo"];

  $respuestaModelo = ControladorCategorias::ctrMostrarModelos($item, $valor);

  //$hoy = date("Y-m-d");
  $fechaInicial = $respuestaCotizacion["fecha"];
  $dias = $respuestaCotizacion["dias_vigencia"];

  //$vigencia = $fechaInicial + $dias;

   $fechaGarantia = new DateTime($fechaInicial);
	//$dias = $_POST["editarGarantia"];
   $fechaGarantia -> add(new DateInterval('P'.$dias.'D'));
   $vigencia = $fechaGarantia->format('d-m-Y');


  $item = "id";
 $valor = $respuestaModelo["id_marca"];

  $respuestaMarca = ControladorCategorias::ctrMostrarMarcas($item, $valor);

$listaProducto = json_decode($respuestaCotizacion["cotizacion"], true); 


//INFORMACIÓN SUCURSAL SOBRE GARANTIA
  	$item = "id";
    $valor = "1";

    $respuestaSucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

// DIRECCIONES COMPLETAS SUCURSALES



//FORMATO PRECIO
$precioFormato = number_format($respuestaCotizacion["precio"],2);

//foreach ($listaProducto as $key => $value) {
	//$producto1 = $value[descripcion];

//	}

//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS




//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF($orientation='L',$unit='mm', array(150,200));



$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);

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
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);


$pdf->AddPage();

ob_start ();


$bloque1 = <<<EOF

	<table>
		
		<tr>

		<td style="background-color:white; width:10px"> </td>


			<td style="width:120px"><img src="images/naranja-liso.png"></td>

			

			<td style="background-color:white; width:10px">

			</td>



			<td style="background-color:white; width:350px">
			
			
				
			
			<div style="font-size:20px; text-align:right; line-height:30px; color:#A4A3A3;"><b>$respuestaCotizacion[cliente]</b></div>

			<div style="font-size:10px; text-align:right; line-height:0px; color:#A4A3A3;"><b>_____________________________________________________</b></div>

			



			</td>

		

			</tr>



	</table>



EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');


$bloque2 = <<<EOF

	<table>
	<br>
	<br>
		
		<tr>
			<td style="background-color:white; width:200px"></td>

			<td style="background-color:white; width:350px">
				
			
			<div style="font-size:25px; text-align:left; line-height:5px;"><b>$respuestaMarca[marca]</b></div>
			</td>




			</tr>



	</table>



EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');




$bloque3 = <<<EOF



	<table>
		
		<tr>
			<td style="background-color:white; width:200px"></td>

			<td style="background-color:white; width:350px">
				
			
			<div style="font-size:40px; text-align:left; line-height:30px;"><b>$respuestaModelo[modelo]</b></div>
			</td>




			</tr>



	</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');



$bloque4 = <<<EOF

	<table>
		
		<tr>

					


			<td style="background-color:white; width:450px">
				
			
			<div style="font-size:15px; text-align:right; line-height:20px;">$respuestaCotizacion[cliente]</div>



			</td>

		





			</tr>



	</table>



EOF;

//$pdf->writeHTML($bloque4, false, false, false, false, '');

$bloque12 = <<<EOF

	<table>

		
		<tr>


					
<br>
<br>


			<td style="background-color:white; width:460px">
				
			
			<div style="font-size:8px; text-align:center; line-height:0px; color:#A4A3A3;" ><b>DESCRIPCIÓN:</b></div>

			</td>



			</tr>



	</table>



EOF;

$pdf->writeHTML($bloque12, false, false, false, false, '');



foreach ($listaProducto as $key => $value) {

$bloque6 = <<<EOF



	<table>
		
		<tr>

			
			<td style="background-color:white; width:200px"></td>

			<td style="background-color:white; width:450px">

			
			<div style="font-size:8px; text-align:left; line-height:10px;"></div>


			</td>

			<br>
			<td style="background-color:white; width:200px"></td>


<table border="0"  cellpadding="1" cellspacing="0">

 <tr>
 
  <td width="200">$value[descripcion]</td>
  <td width="50" style="text-align:right; color:#757474;">$ $value[precio]</td>



 </tr>

 </table>



			</tr>



	</table>


EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');
}





$bloque5 = <<<EOF

	<table>

		
		<tr>


					
<br>
<br>


			<td style="background-color:white; width:450px">
				
			
			<div style="font-size:15px; text-align:right; line-height:0px;; "><b>Total: $ $precioFormato</b></div>

			</td>



			</tr>



	</table>



EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');


$bloque7 = <<<EOF

	<table>
		
		<tr>

					
<br>

			<td style="background-color:white; width:450px">
				
			
			<div style="font-size:13px; text-align:right; line-height:10px;"><b>Código: $respuestaCotizacion[codigo]</b></div>
	


			</td>

			


			</tr>



	</table>



EOF;

//$pdf->writeHTML($bloque7, false, false, false, false, '');


$bloque8 = <<<EOF

	<table>
		
		<tr>

	<br>
	<br>
		<td style="background-color:white; width:200px"></td>
 
 
  <td width="250" style="background-color:#ed8426; color: #fff; text-align:center; "><b> Cotización valida hasta el $vigencia </b>
</td>

			


			</tr>



	</table>



EOF;
$pdf->SetXY(0, 100);
$pdf->writeHTML($bloque8, false, false, false, false, '');


$bloque9 = <<<EOF

	<table>
		
		<tr>

	
	
		<td style="background-color:white; width:200px"></td>
 
 
  <td width="280" style="text-align:left; font-size:6.5px;">$respuestaSucursal[cotizacion_cliente]
</td>

			


			</tr>



	</table>



EOF;

$pdf->writeHTML($bloque9, false, false, false, false, '');




$bloque10 = <<<EOF

	<table>
		
		<tr>


  <td width="380" style="text-align:center; font-size:7px;">"$respuestaSucursal[direccion]"
</td>

			


			</tr>



	</table>



EOF;
$pdf->SetXY(10, 135);
$pdf->writeHTML($bloque10, false, false, false, false, '');


$bloque11 = <<<EOF

	<table>
		
		<tr>

		<td style="background-color:white; width:10px"> </td>


			<td style="width:20px"><img src="images/gps.jpg"></td>

			
			

			<td style="background-color:white; width:160px">
	


			</td>



			</tr>



	</table>



EOF;
$pdf->SetXY(4, 134);
$pdf->writeHTML($bloque11, false, false, false, false, '');




//$img = file_get_contents("http://".$respuestaModelo["imagen"]);
//$pdf->Image('@' . $img);



//$codigo2 = $pdf->write2DBarcode("fb://page?id=1864386860465796", 'QRCODE,H', 190, 100, 18, 18, $style, 'N', true);


//$html = '<img src="../../../vistas/img/modelos/2003/831.png" alt="test alt attribute" width="0" height="250" border="0" /></div>';


$html = '<img src="../../../'.$respuestaModelo['imagen'].'" alt="test alt attribute" width="0" height="250" border="0" /></div>';

// output the HTML content
$pdf->SetXY(0, 33);
$pdf->writeHTML($html, true, false, true, false, '');


$bloque12 = <<<EOF

	<table>
		
		<tr>


			<td style="width:100px"><img src="images/garantia2.png"></td>


			</tr>



	</table>



EOF;
$pdf->SetXY(40, 90);
$pdf->writeHTML($bloque12, false, false, false, false, '');


// EAN 13

$pdf->SetXY(150, 125);
$pdf->write1DBarcode("$respuestaCotizacion[codigo]", 'C128', '', '', '', 18, 0.4, $style2, 'N');



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