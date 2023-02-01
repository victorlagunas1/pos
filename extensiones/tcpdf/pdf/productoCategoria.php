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

public $sucursal;
public $categoria;

public function traerImpresionNota(){

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->startPageGroup();




$pdf->AddPage('L', 'A4');

    

ob_start ();

        
      date_default_timezone_set('America/Mexico_City');
      $fechaTitulo = date("d-m-Y");
         

      //$sucursal = $_GET["sucursal"];
      $categoria = $_GET["categoria"];
      
      $respuesta = ControladorProductos::ctrMostrarProductosSucursalCategoriaSucursal($categoria);

        $item = "id";
        $valor = $_GET["categoria"];

        $categoriaNombre = ControladorCategorias::ctrMostrarCategorias($item, $valor);
        $contar = count($respuesta);



     


$bloque1 = <<<EOF

  <table>
    
    <tr>

    <td style="background-color:white; width:10px"> </td>


      <td style="width:140px"><img src="images/logo.png"></td>


    <td style="background-color:white; width:600px">
        
      <div style="font-size:30px; text-align:right; line-height:10px;"><b>Reporte de inventario</b></div>
      <div style="font-size:20px; text-align:right; line-height:15px;"><b>$categoriaNombre[categoria] - $contar Códigos existentes </b></div>
      <div style="font-size:12px; text-align:right; line-height:5px;">$fechaTitulo</div>
      
      </td>
  


      </tr>
      



  </table>



EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');






$bloque2 = <<<EOF




<table border="1"  cellpadding="3" cellspacing="0">
  
 <tr>


 <td width="80" style="text-align:center" ><b>CODIGO</b></td> 
  <td width="100" style="text-align:center" ><b>DESCRIPCIÓN</b></td> 
   <td width="60" style="text-align:center"><b>STOCK</b></td>
  
 
  
 </tr>


  </table>


EOF;

//$pdf->writeHTML($bloque2, false, false, false, false, '');

$pdf->resetColumns();
$pdf->setAutoPageBreak(true, 5);
$pdf->setEqualColumns(3, 90);  // KEY PART -  number of cols and width
$pdf->selectColumn();  





foreach ($respuesta as $key => $value) {
      
        $item = "codigo";
        $valor = $value["codigo"];

        $infoProducto = ControladorProductos::ctrMostrarProductos($item, $valor);
   
//  for($i = 0; $i < count($value); $i++){

      if ($infoProducto["id_modelo"] != null ){

        
        $item = "codigo";
        $valor = $infoProducto["id_modelo"];

        $modelo = ControladorCategorias::ctrMostrarModelos($item, $valor);

          $item = "id";
          $valor = $modelo["id_marca"];

          $marcas = ControladorCategorias::ctrMostrarMarcas($item, $valor);

        $item = "id";
        $valor = $infoProducto["id_categoria"];

        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);


        $descripcion = $categorias["categoria"]." ".$marcas["marca"]." ".$modelo["modelo"]." ".$infoProducto["descripcion"];

      }else {

        $item = "id";
        $valor = $infoProducto["id_categoria"];

        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
        
        $descripcion = $categorias["categoria"]." ".$infoProducto["descripcion"];
       //  $descripcion = " ";

      }

//$pdf->resetColumns();


$bloque4 = <<<EOF

 <table border="1"  cellpadding="1" cellspacing="0">
 
 <tr>
  <td width="80" style="text-align:center"><b>$infoProducto[codigo]</b></td>
  <td width="100" style="text-align:left">$descripcion</td>
  <td width="60" style="text-align:center"> </td>
  
 
 
 </tr>


  </table>



EOF;


$pdf->writeHTML($bloque4, false, false, false, false, '');


}

$pdf->resetColumns();




//$codigo2 = $pdf->write2DBarcode("fb://page?id=1864386860465796", 'QRCODE,H', 170, 90, 18, 18, $style, 'N', true);


$pdf->IncludeJS("print();");
$pdf->Output('reporteInvetario2.pdf');


}

}

$nota = new imprimirNota();
//$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>