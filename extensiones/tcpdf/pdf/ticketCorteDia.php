<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";



require_once('tcpdf_include.php');

class imprimirTicket{

public $suc;
public $fechaInicial;
public $fechaFinal;

public function traerImpresionNota(){

		$fechaInicial = $this->fechaInicial;
        $fechaFinal = $this->fechaFinal;
        $sucursal = $this->suc;
        $tabla = "ventas_stock";


       

       
       $ventasDelDia = ModeloVentas::mdlRangoFechasVentasSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal);
     
       //$sumaVentas = 0;
       //$sumaVentas += $ventasDelDia["total"];

            

       		$item = "id";
            $valor = $this->suc;

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

$formatoVentas = number_format(0,2);
$formatoRep = number_format(0,2);
$formatoGastos = number_format(0,2);



//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF($orientation='P',$unit='mm', array(58,200));



$pdf->SetMargins(true,0,0,true);
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
			

			<div style="font-size:10px; text-align:center; line-height:5px;"><b>CORTE DEL DÍA</b></div> 
			<div style="font-size:10px; text-align:center; line-height:5px;"><b>$sucursal[nombre]</b></div> 
			<div style="font-size:10px; text-align:center; line-height:5px;">$fechaInicial</div> 
			
			
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$bloque12 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:155px">
				
			<div style="font-size:9px; text-align:center; line-height:7px;"><b>
			=============================
			PRODUCTOS <br>
			=============================
			</b></div> 
			 
						
	
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque12, false, false, false, false, '');



$sumaVentas = 0;
$cant = 0;
$sumaVentasTotales = 0;
foreach ($ventasDelDia as $key => $value) {



	//$precioFormato = number_format($;value["total"],2); 
	$totalFormato = number_format($value["total"]*$value["cantidad"],2); 
	

		  
		  if ($value["tipo"] == 0){
		  	$cant += $value["cantidad"];

		
		$sumaVentas += ($value["total"]*$value["cantidad"]);
		$formatoVentas = number_format($sumaVentas,2);
		


	$ventasTotal = $sumaVentas;



		  $item = "codigo";
          $valor = $value["codigo"];

        $infoproducto = ControladorProductos::ctrMostrarProductos($item, $valor);

         $item = "id";
        $valor = $infoproducto["id_categoria"];

        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        if ($infoproducto["id_modelo"] != "0") {
        $item = "codigo";
        $valor = $infoproducto["id_modelo"];

        $modelo = ControladorCategorias::ctrMostrarModelos($item, $valor);

        $modelo1 = $modelo["modelo"];

      } else {
        $modelo1 = " ";
      }


$bloque3 = <<<EOF

	<table>
		
		<tr>
	
		
		
			<td style="background-color:white; width:150px">
			<div style="font-size:9px; text-align:center; line-height:9px;">$value[codigo] $categorias[categoria] $modelo1</div> 
			<div style="font-size:9px; text-align:right; line-height:3px;">$value[cantidad] uds = <b>$$totalFormato</b> </div> <br>		

	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

}

}

$bloque14 = <<<EOF

	<table>
		
		<tr>
	
		
			<td style="background-color:white; width:150px">
			<div style="font-size:9px; text-align:right; line-height:3px;"><b>CANT: </b>$cant</div>
			
			<div style="font-size:9px; text-align:right; line-height:3px;"><b>SUB TOTAL:</b> $ $formatoVentas</div> <br>		

	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque14, false, false, false, false, '');


$bloque11 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:155px">
				
			<div style="font-size:9px; text-align:center; line-height:7px;"><b>
			=============================
			REPARACIONES<br>
			=============================
			</b></div> 
			 
						
	
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque11, false, false, false, false, '');




$sumaReparaciones = 0;
foreach ($ventasDelDia as $key => $value) {
	//$precioFormato = number_format($value["total"],2); 
	$totalFormato = number_format($value["total"],2); 
	
		  if ($value["tipo"] == 1){


		
		$sumaReparaciones += $value["total"];
		$formatoRep = number_format($sumaReparaciones,2);

	



$bloque10 = <<<EOF

	<table>
		
		<tr>
	
		
			<td style="background-color:white; width:150px">
			<div style="font-size:9px; text-align:center; line-height:9px;">$value[codigo]</div> 
			<div style="font-size:9px; text-align:right; line-height:3px;"><b>$$totalFormato</b></div> <br>		

	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque10, false, false, false, false, '');

}
}

$bloque15 = <<<EOF

	<table>
		
		<tr>
	
		
			<td style="background-color:white; width:150px">
			
			<div style="font-size:9px; text-align:right; line-height:3px;"><b>SUB TOTAL:</b> $ $formatoRep</div> <br>		

	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque15, false, false, false, false, '');


$bloque13 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:155px">
				
			<div style="font-size:9px; text-align:center; line-height:7px;"><b>
			=============================
			GASTOS <br>
			=============================
			</b></div> 
			 
						
	
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque13, false, false, false, false, '');




$sumaGastos = 0;
$gastosTotal = 0;
foreach ($ventasDelDia as $key => $value) {
	//$precioFormato = number_format($value["total"],2); 
	$totalFormato = number_format($value["total"],2); 
	
		 
		  if ($value["tipo"] == 3){

	if ($value){
	$gastosTotal += $value["total"];
	$ventasTotal1 = number_format(($sumaVentasTotales-$gastosTotal),2);
	}

			
		$sumaGastos += $value["total"];
		$formatoGastos = number_format($sumaGastos,2);
		



$bloque10 = <<<EOF

	<table>
		
		<tr>
	
		
		
			<td style="background-color:white; width:150px">
			<div style="font-size:9px; text-align:center; line-height:9px;">$value[codigo]</div> 
			<div style="font-size:9px; text-align:right; line-height:3px;"><b>$$totalFormato</b> </div> <br>		

	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque10, false, false, false, false, '');

}
}

$bloque16 = <<<EOF

	<table>
		
		<tr>
	
		
			<td style="background-color:white; width:150px">
			
			<div style="font-size:9px; text-align:right; line-height:3px;"><b>SUB TOTAL:</b> $ $formatoGastos</div> <br>		

	
			</td>

			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque16, false, false, false, false, '');




$ventasTotal = number_format(($sumaVentas + $sumaReparaciones)-$sumaGastos,2); 
$bloque5 = <<<EOF

	<table>
		
		<tr>
		
			<td style="background-color:white; width:155px">
				
			
			<div style="font-size:11px; text-align:right; line-height:4px;"><b>TOTAL: $ $ventasTotal</b></div> 
			<br>
			
	
			</td>

			
			</tr>

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



//$pdf->SetXY(3, 10);
//$pdf->write1DBarcode("324423", 'C128', '', '', '', 15, 0.8, $style2, 'l');
//$pdf->write2DBarcode("323233", 'QRCODE, H', '', '', 30, 30, $style2, 'N');


//SALIDA DEL ARCHIVO 

$pdf->Output('ticket.pdf');

}

}

$nota = new imprimirTicket();
$nota -> suc = $_GET["suc"];
$nota -> fechaInicial = $_GET["fechaInicial"];
$nota -> fechaFinal = $_GET["fechaFinal"];
$nota -> traerImpresionNota();

?>