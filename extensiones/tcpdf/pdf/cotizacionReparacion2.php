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


            $tabla = "reparaciones_garantia";
      
      		$item = "id";
      		$valor = $respuestaCotizacion["id_garantia"];
      			//$valor = "1";
            $respuestaGarantia = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);





//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF($orientation='L',$unit='mm', array(130,200));



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
	
			<td style="background-color:white; width:0.1px"> </td>
			<td style="width:300px" ><img src="images/cotizacionDiseno.png"></td>

			</tr>

	</table>


EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');
$pdf->SetXY(0, 0);




$hoy = date('d-m-Y');


$bloque11 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:600px">
	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque11, false, false, false, false, '');



$bloque2 = <<<EOF

		<table border="0"  cellpadding="0" cellspacing="1">

		
		<tr>

	<br>
	
			<td style="background-color:white; width:750px">

			<div style="font-size:30px; text-align:center; line-height:15px; color:black;"><b>Cotización</b></div> 	

	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');
//$pdf->writeHTML($bloque11, false, false, false, false, '');
//$pdf->writeHTML($bloque11, false, false, false, false, '');
$precioFormato = number_format($respuestaCotizacion["precio"],2); 


$bloque3 = <<<EOF

	<table>
		
		<tr>
					

			<td style="background-color:white; width:130px">
			<div style="font-size:8px; text-align:left; line-height:6px; color:#56616c;"><b>MODELO:</b></div> 
			<div style="font-size:9px; text-align:left; line-height:3px;">$respuestaMarca[marca] $respuestaModelo[modelo]</div> 
			
			<div style="font-size:8px; text-align:left; line-height:6px; color:#505050;"><b>SERVICIO SOLICITADO:</b></div> 
			<div style="font-size:9px; text-align:left; line-height:3px;">$respuestaReparacion[reparacion]</div> 


			<div style="font-size:8px; text-align:left; line-height:6px; color:#505050;"><b>INSTALACIÓN:</b></div> 
			<div style="font-size:9px; text-align:left; line-height:3px;">$respuestaTiempo[tiempo]</div> 

			<div style="font-size:8px; text-align:left; line-height:6px; color:#505050;"><b>GARANTÍA:</b></div> 
			<div style="font-size:9px; text-align:left; line-height:8px;">$respuestaGarantia[condiciones]</div> 

			 
<br>
			<div style="font-size:9px; text-align:left; line-height:3px;"><b>PRECIO: $ $precioFormato</b> </div> 
			<br>	
			<br>


			</td>


			</tr>

	</table>

EOF;
$pdf->SetXY(150, 30);
$pdf->writeHTML($bloque3, false, false, false, false, '');
$pdf->SetXY(0, 0);


$bloque10 = <<<EOF

	<table>
		
		<tr>
		<br>
					
			<td style="background-color:white; width:300px"> </td>
			<td style="width:110px" ><img src="../../../$respuestaModelo[imagen]"></td>

			</tr>

	</table>


EOF;
$pdf->SetXY(20, 20);
$pdf->writeHTML($bloque10, false, false, false, false, '');
//$pdf->writeHTML($bloque11, false, false, false, false, '');


//$pdf->SetXY(700, 30);
//$pdf->write1DBarcode("$respuestaCotizacion[id]", 'C128', '', '', '', 15, 0.8, $style2, 'l');

$bloque6 = <<<EOF

	<table>
		<tr>
		
		<td style="background-color:white; width:280px"> </td>

			<td style="background-color:white; width:270px">
			<div style="font-size:7px; text-align:center; line-height:8px;"> <b>NOTA:</b> Cotización informativa, precio del servicio solicitado sujeto a cambio y disponibilidad sin previo aviso.</div> <br>		

				
			 
			
			
	
			</td>

			
			</tr>

	</table>

EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');



$bloque14 = <<<EOF
<br>

	<table>
		<tr>

		<td style="background-color:white; width:350px"> </td>
			<td style="width:140px"><img src="images/redes.png"></td>		
			</tr>
	</table>



EOF;
//$pdf->SetXY(150, 105);
$pdf->writeHTML($bloque14, false, false, false, false, '');
//$pdf->SetXY(700, 0);




//SALIDA DEL ARCHIVO 

$pdf->Output('Cotizacion Reparacion.pdf'); 
    
    // auto imprimir el pdf, esto para abrir en automatico la pestaña de impresion
    
    echo '<script>window.print();</script>';

}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();


?>
