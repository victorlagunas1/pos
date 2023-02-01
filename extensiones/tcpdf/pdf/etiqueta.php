<?php

require_once "../../../controladores/reparaciones.controlador.php";
require_once "../../../modelos/reparaciones.modelo.php";



require_once('tcpdf_include.php');

class imprimirNota{

public $codigo;

public function traerImpresionNota(){

$itemReparacion = "id";
$valorReparacion = $this->codigo;

$respuestaReparacion = ControladorReparaciones::ctrMostrarReparaciones($itemReparacion, $valorReparacion);


//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS



//REQUERIMOS LA CLASE TCPDF 

require_once('tcpdf_include.php');

$pdf = new TCPDF($orientation='L',$unit='mm', array(29,29));


$pdf->SetMargins(0,0,0,true);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetAutoPageBreak(TRUE, 0); 


$pdf->startPageGroup();

$style = array(
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
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 6,
    'stretchtext' => 4
);
$pdf->AddPage();




ob_start ();

$formatoFecha = date($respuestaReparacion["fecha"]);
$modelo = strtoupper($respuestaReparacion["marca"]." ".$respuestaReparacion["modelo"]);
$servicio = strtoupper($respuestaReparacion["servicio"]);

$bloque4 = <<<EOF

    <table>
        
        <tr>
    
                
            <td style="background-color:white; width:25px"> </td>
            <td style="width:40px" ><img src="images/logo.png"></td>



            </tr>

    </table>


EOF;
$pdf->SetXY(0, 2);
$pdf->writeHTML($bloque4, false, false, false, false, '');

$bloque1 = <<<EOF

    <table>

    
        <tr>
                
            <td style="background-color:white; width:70">
                

            <div style="font-size:5px; text-align:center; line-height:5px;"><b>$modelo</b></div>

           


            </td>

            </tr>


    </table>



EOF;
$pdf->SetXY(2, 4.5);
$pdf->writeHTML($bloque1, false, false, false, false, '');

$bloque2 = <<<EOF

    <table>

    
        <tr>
                
            <td style="background-color:white; width:70">
                

            <div style="font-size:6px; text-align:center; line-height:5.5px;"><b>$servicio</b></div>


            </td>

            </tr>


    </table>



EOF;
$pdf->SetXY(2, 7);
$pdf->writeHTML($bloque2, false, false, false, false, '');








// $codigo2 = $pdf->write2DBarcode("MIX0$respuestaReparacion[id]", 'QRCODE,H', 1.5, 1.2, 12.7, 12.7, $style, 'N', true);

$pdf->write1DBarcode("MIX0$respuestaReparacion[id]", 'C128', '0', '14', '', 11, 0.9, $style, 'l');


$bloque3 = <<<EOF

    <table>

    
        <tr>
                
            <td style="background-color:white; width:83">
                

            <div style="font-size:5px; text-align:center; line-height:2px;">$formatoFecha</div>

    


            </td>

            </tr>


    </table>



EOF;
$pdf->SetXY(0, 23);
$pdf->writeHTML($bloque3, false, false, false, false, '');




// ---------------------------------------------------------
// ---------------------------------------------------------

$pdf->lastPage();
//SALIDA DEL ARCHIVO 

$pdf->IncludeJS("print();");



$pdf->Output('barcode.pdf', 'I');


}

}

$nota = new imprimirNota();
$nota -> codigo = $_GET["codigo"];
$nota -> traerImpresionNota();

?>