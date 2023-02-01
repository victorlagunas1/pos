<?php

require_once "../../../controladores/inventario.controlador.php";
require_once "../../../modelos/inventario.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";


require_once('tcpdf_include.php');


class imprimirNota{

public $codigo;

public function traerImpresionNota(){

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

$pdf->AddPage('L', 'A4');

ob_start ();

        

        date_default_timezone_set('America/Mexico_City');
        $fechaTitulo = date("d-m-Y");
         
            $item = "id";
            $valor = $_GET["codigo"];

            $respuesta = ControladorInventarios::ctrMostrarInvetario($item, $valor);



$bloque1 = <<<EOF

  <table>
    
    <tr>

    <td style="background-color:white; width:10px"> </td>


      <td style="width:140px"><img src="images/logo.png"></td>


    <td style="background-color:white; width:600px">
        
      <div style="font-size:30px; text-align:right; line-height:10px;"><b>Reporte de inventario</b></div>
      <div style="font-size:20px; text-align:right; line-height:15px;"><b>$respuesta[fecha]</b></div>
      
      </td>
  


      </tr>



  </table>



EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');


$bloque2 = <<<EOF

 <br>
          <br>
         


<table border="1"  cellpadding="3" cellspacing="0">
    


 <tr>

  <td width="330" style="text-align:center" ><b>DESCRIPCIÓN</b></td> 
   <td width="120" style="text-align:center"><b>STOCK ACTUAL</b></td>
  <td width="120" style="text-align:center"><b>NUEVO STOCK</b></td>
 

  
 </tr>



  </table>



EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


$StockInicial = json_decode($respuesta["stock_inicial"], true); 
$StockNuevo = json_decode($respuesta["stock_nuevo"], true); 





foreach ($StockInicial as $key => $value) {


$bloque4 = <<<EOF

 <table border="1"  cellpadding="3" cellspacing="0">
 
 <tr>
  <td width="330" style="text-align:center" ><b>$value[codigo]</b></td>
  <td width="120" style="text-align:center" ><b>$value[stock]</b></td>
  
 
 
 </tr>


  </table>



EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');
}

foreach ($StockNuevo as $key => $value) {

$bloque5 = <<<EOF

 <table border="1"  cellpadding="3" cellspacing="0">
 
 <tr>
 
  <td width="30" style="text-align:center" ><b>$value[stock]</b></td>
  <td width="30" style="text-align:center" ><b></b></td>
  
 
 </tr>


  </table>



EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');
}







//$codigo2 = $pdf->write2DBarcode("fb://page?id=1864386860465796", 'QRCODE,H', 170, 90, 18, 18, $style, 'N', true);


$pdf->IncludeJS("print();");
$pdf->Output('reporteInvetario.pdf');


}

}

$nota = new imprimirNota();
//$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>