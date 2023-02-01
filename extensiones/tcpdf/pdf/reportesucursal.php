<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

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


  
        date_default_timezone_set('America/Mexico_City');
        $fechaTitulo = date("d-m-Y");
        $fechaInicial = date("Y-m-d");
        $fechaFinal = date("Y-m-d");
        //$sucursal = $this->codigo;
        $sucursal = null;
       
          $respuesta = ControladorVentas::ctrRangoFechasVentasStock($fechaInicial, $fechaFinal, $sucursal);

          

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

$bloque1 = <<<EOF

  <table>
    
    <tr>

    <td style="background-color:white; width:10px"> </td>


      <td style="width:140px"><img src="images/logo.png"></td>


    <td style="background-color:white; width:600px">
        
      <div style="font-size:30px; text-align:right; line-height:10px;"><b>Reporte General</b></div>
      <div style="font-size:20px; text-align:right; line-height:15px;"><b>$fechaTitulo</b></div>
      
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

  <td width="60" style="text-align:center" ><b>ID</b></td>
  
  <td width="130" style="text-align:center" ><b>FECHA</b></td> 
  <td width="130" style="text-align:center" ><b>SUCURSAL</b></td> 
  <td width="330" style="text-align:center" ><b>DESCRIPCIÓN</b></td> 
   <td width="40" style="text-align:center"><b>CANT</b></td>
  <td width="60" style="text-align:center"><b>PRECIO</b></td>
 

  
 </tr>



  </table>



EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');




$sumaTotal = 0;
$precio_compra = 0;



foreach ($respuesta as $key => $value) {

  if ($value["tipo"] == 0){

	     $item = "codigo";
      $valor = $value["codigo"];

      $infoproducto = ControladorProductos::ctrMostrarProductos($item, $valor);

      $precioCompra = $infoproducto["precio_compra"];
      $precioVenta = $infoproducto["precio_venta"];
      
        $item = "id";
        $valor = $infoproducto["id_categoria"];

        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        if ($infoproducto["id_modelo"] != 0){

        $item = "codigo";
        $valor = $infoproducto["id_modelo"];

        $modelo = ControladorCategorias::ctrMostrarModelos($item, $valor);

         $item = "id";
         $valor = $value["sucursal"];

        $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
        
        $descripcion = "<b>".$value["codigo"]."</b>"." ".$modelo["modelo"]." ".$categorias["categoria"]." ".$infoproducto["descripcion"];
      } else {
        $descripcion = "<b>".$value["codigo"]."</b>"." ".$categorias["categoria"]." ".$infoproducto["descripcion"];
    } 
       $sumaTotal += ($value["total"]*$value["cantidad"]);
       $sumaFormato = number_format($sumaTotal,2);
      
     //COMISIONES, FALTA POR REVISAR SE SUMAN COMISIONES POR REPARACIÓN FALTA SEPARAR REPARACION DE VENTA DE ACCESORIOS PARA CALCULAR COMSIONES. 
      $precio_compra += $infoproducto["precio_compra"]*$value["cantidad"];
      $precio_compraFormato = number_format($precio_compra,2);

      $comisiones = number_format((($sumaTotal - $precio_compra)*0.1),2);

      $neto = number_format(($sumaTotal-$precio_compra-$comisiones),2);

    } else {


        $descripcion = "<b>".$value["codigo"]."</b>";

    }
    $totalFormato = number_format($value["total"],2);


$bloque3 = <<<EOF

<table border="1"  cellpadding="3" cellspacing="0">
		


 <tr>

  <td width="60" style="text-align:center" >$value[id]</td>
  <td width="130" style="text-align:center" >$value[fecha]</td> 
  <td width="130" style="text-align:left" >$sucursal[nombre]</td> 
  <td width="330" style="text-align:left" >$descripcion</td> 
  <td width="40" style="text-align:center" >$value[cantidad]</td> 
  <td width="60" style="text-align:right">$ $totalFormato</td>
  
 </tr>

	</table>

EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');


    } 


$bloque4 = <<<EOF

  <table>
    
    <tr>
  <br>

    <td style="background-color:white; width:15px"> </td>
    
      <td style="background-color:white; width:650px">
        
      <div style="font-size:13px; text-align:right; line-height:0px;"><b>INGRESO TOTAL: </b>$ $sumaFormato</div> 
      <br>
      <div style="font-size:13px; text-align:right; line-height:0px;"><b>REINVERSIÓN: </b>$ $precio_compraFormato</div>
      <br>
      <div style="font-size:13px; text-align:right; line-height:0px;"><b>GASTOS: </b>$ $sumaFormato</div>
      <br>
      <div style="font-size:13px; text-align:right; line-height:0px;"><b>REPARACIONES: </b>$ $comisiones</div>
      <br>
      <div style="font-size:13px; text-align:right; line-height:0px;"><b>COMISIONES: </b>$ $comisiones</div>
       <br>
      <div style="font-size:13px; text-align:right; line-height:0px;"><b> UTILIDAD NETA: </b>$ $neto</div>

  
      </td>

      
      </tr>

  </table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');



//$codigo2 = $pdf->write2DBarcode("fb://page?id=1864386860465796", 'QRCODE,H', 170, 90, 18, 18, $style, 'N', true);


$pdf->IncludeJS("print();");
$pdf->Output('factura.pdf');


}

}

$nota = new imprimirNota();
//$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>