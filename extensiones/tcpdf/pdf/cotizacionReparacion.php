<?php

require_once "../../../controladores/cotizaciones.controlador.php";
require_once "../../../modelos/cotizaciones.modelo.php";

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";



require_once('tcpdf_include.php');

class imprimirNota{

public $codigo;

public function traerImpresionNota(){

			




            $tabla = "reparaciones_cotizacion";
      
      		$item = "id";
      		$valor = $this->codigo;
      			//$valor = "1";
            $respuestaCotizacion = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);



           

             $tabla = "modelos";
      
      		$item = "codigo";
      		$valor = $respuestaCotizacion["id_modelo"];
      			//$valor = "1";
            $respuestaModelo = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

             $tabla = "marcas";
      
      		$item = "id";
      		$valor = $respuestaModelo["id_marca"];
      			//$valor = "1";
            $respuestaMarca = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);





            $tabla = "reparaciones_id";
      
      		$item = "id";
      		$valor = $respuestaCotizacion["id_reparacion"];
      			//$valor = "1";
            $respuestaReparacion = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);



            $tabla = "reparaciones_tiempo";
      
      		$item = "id";
      		$valor = $respuestaCotizacion["tiempo"];
      			//$valor = "1";
            $respuestaTiempo = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);





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

$hoy = date('d-m-Y');


$bloque11 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:160px">
			<div style="font-size:8px; text-align:center; line-height:4px;"> <b>| Reparaciones | Accesorios |</b></div> 
			<div style="font-size:8px; text-align:center; line-height:4px;">Fecha: $hoy</div> 
						<div style="font-size:8px; text-align:center; line-height:4px;"> </div> 
			
			


				
			 
			
			
	
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque11, false, false, false, false, '');








$bloque2 = <<<EOF

		<table border="0"  cellpadding="0" cellspacing="1">

		
		<tr>

	
	
			<td style="background-color:white; width:162px">

			<div style="font-size:13px; text-align:center; line-height:15px; color:black;"><b>COTIZACIÓN</b></div> 	

	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$bloque10 = <<<EOF

	<table>
		
		<tr>
	
				
			<td style="background-color:white; width:40px"> </td>
			<td style="width:80px" ><img src="../../../$respuestaModelo[imagen]"></td>



			</tr>

	</table>


EOF;

$pdf->writeHTML($bloque10, false, false, false, false, '');



	$precioFormato = number_format($respuestaCotizacion["precio"],2); 


$bloque3 = <<<EOF

	<table>
		
		<tr>
					

	
		
					<td style="background-color:white; width:5px"> </td>

			<td style="background-color:white; width:155px">
			<div style="font-size:9px; text-align:center; line-height:6px;"><b>$respuestaMarca[marca] $respuestaModelo[modelo]</b></div> 

			<div style="font-size:9px; text-align:left; line-height:7px;"><b>Servicio:</b> $respuestaReparacion[reparacion]</div> 
			<div style="font-size:9px; text-align:left; line-height:5px;"><b>Instalación:</b> $respuestaTiempo[tiempo]</div> 

			



			<br>

	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');




//$totalFormato2 = number_format($traerVenta["total"],2); 





$bloque6 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:160px">
			<div style="font-size:9px; text-align:right; line-height:3px;"><b>PRECIO: $ $precioFormato</b> </div> <br>		

				
			 
			
			
	
			</td>

			
			</tr>

	</table>

EOF;




$pdf->writeHTML($bloque6, false, false, false, false, '');

//$pdf->SetXY(3, 10);
//$pdf->write1DBarcode("$respuestaCotizacion[id]", 'C128', '', '', '', 15, 0.8, $style2, 'l');

$bloque6 = <<<EOF

	<table>
		
		<tr>
		
		<td style="background-color:white; width:5px"> </td>

			<td style="background-color:white; width:160px">
			<div style="font-size:7px; text-align:left; line-height:8px;"> <b>NOTA:</b> Cotización informativa, precio del servicio sujeto a cambio y disponibilidad sin previo aviso.</div> <br>		

				
			 
			
			
	
			</td>

			
			</tr>

	</table>

EOF;




$pdf->writeHTML($bloque6, false, false, false, false, '');



$bloque14 = <<<EOF
<br>

	<table>
		<tr>
		<td style="background-color:white; width:10px"> </td>
			<td style="width:140px"><img src="images/redes.png"></td>		
			</tr>
	</table>



EOF;
//$pdf->SetXY(150, 105);
$pdf->writeHTML($bloque14, false, false, false, false, '');




//SALIDA DEL ARCHIVO 

$pdf->Output('ticket.pdf');

}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>