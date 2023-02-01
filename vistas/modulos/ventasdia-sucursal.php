
<div class="content-wrapper">


  <section class="content-header">


<?php 

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

date_default_timezone_set('America/Mexico_City');

$fecha = date("d-m-Y");
$fechaInicial = date("Y-m-d");
$fechaFinal = date("Y-m-d");

            $item = "id";
            $valor = $_SESSION["sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);





echo '<h1><b>Ventas del Día '.$sucursal["nombre"].'</b></h1>'.$fecha;
?>


    <ol class="breadcrumb">

      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Ventas del Día</li>
    
    </ol>
    <button class="btn btn-info pull-right btnImprimirCorte" ><i class="fa fa-print" onclick="window.open('extensiones/tcpdf/pdf/ticketCorteDia.php?suc=<?php echo $_SESSION["sucursal"];?>&fechaInicial=<?php echo $fechaInicial?>&fechaFinal=<?php echo $fechaFinal?>');"></i></button>


    <button class="btn btn-primary pull-right btnImprimirCorte" style="margin-right:5px"><i class="fa fa-users" onclick="location.href='ventasdia?suc=<?php echo $_SESSION["sucursal"];?>&fechaInicial=<?php echo $fechaInicial?>&fechaFinal=<?php echo $fechaFinal?>';"></i></button>


  

  </section>



  <section class="content">



    <div class="box">

         

      <div class="box-header with-border">
         <?php include "inicio/cajas-cortediasucursal.php"; 

        
         $sucursal = $_SESSION["sucursal"];

?>
       
         
   <!---
   <button class="btn btn-primary btnGenerarReporte" onclick="window.open('extensiones/tcpdf/pdf/reportesucursal.php?codigo=<?php echo $_SESSION["sucursal"]; ?>');" >



    Generar Reporte </button> -->
          
          
          
            
    



      </div>
       

      

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Categoría</th>
           <th>Descripción</th>
           <th>Cantidad</th>
           <th>Total</th>
          
           <th>Fecha</th>


         </tr> 

        </thead>

        <tbody>

        <?php
        date_default_timezone_set('America/Mexico_City');
        
        $fechaInicial = date("Y-m-d");
        $fechaFinal = date("Y-m-d");
        $sucursal = $_SESSION["sucursal"];

       
          $respuesta = ControladorVentas::ctrRangoFechasVentasStock($fechaInicial, $fechaFinal, $sucursal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>'.$value["codigo"].'</td>';
          
        if ($value["tipo"] == 0){


          $item = "codigo";
          $valor = $value["codigo"];

        $infoproducto = ControladorProductos::ctrMostrarProductos($item, $valor);

/*=============================================
      TRAEMOS LA CATEGORÍA
        =============================================*/ 

        $item = "id";
        $valor = $infoproducto["id_categoria"];

        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);


      /*=============================================
      TRAEMOS EL MODELO
        =============================================*/ 
        if ($infoproducto["id_modelo"] != "0") {
        $item = "codigo";
        $valor = $infoproducto["id_modelo"];

        $modelo = ControladorCategorias::ctrMostrarModelos($item, $valor);

        $modelo1 = $modelo["modelo"];
      } else {
        $modelo1 = " ";
      }


        //$numero = random_int(0, 9);
        $calculo = $value["total"] - $infoproducto["precio_compra"];

        //$imagen1 = $imagen = "<img src='".$infoproducto["imagen"]."' width='60px'>";
        $categoria1 = $categorias["categoria"];
       

        
        $descripcion1 = $infoproducto["descripcion"];
        $cantidad1 = $value["cantidad"];
        $total1 = "<b style=color:Green>"."$ ".number_format($value["total"]*$value["cantidad"],2)."</b>";
       // $referencia1 = $infoproducto["id_modelo"]." ".$numero.$calculo." ".$infoproducto["ventas"];
        $fecha1 = $value["fecha"];




    } else if ($value["tipo"] == 1) {

    	//$numero = random_int(0, 9);
      //$numero1 = random_int(0, 9);
     $calculo = $value["total"];

    	//$imagen1 = "<img src='vistas/img/productos/default/anonymous.png' width='60px'>";
    	$categoria1 = " ";
        $modelo1 = " ";
        $descripcion1 = " ";
        $cantidad1 = $value["cantidad"];
        //$total1 = $value["total"];
        $total1 = "<b style=color:Green>"."$ ".number_format($value["total"],2)."</b>";
        //$referencia1 = $numero.$numero1." ".$numero.$calculo;
       
        $fecha1 = $value["fecha"];



    } else {

      //$numero = random_int(0, 9);
      //$numero1 = random_int(0, 9);
     $calculo = $value["total"];

     // $imagen1 = "<img src='vistas/img/productos/default/anonymous.png' width='60px'>";
      $categoria1 = " ";
        $modelo1 = " ";
        $descripcion1 = " ";
        $cantidad1 = " ";
        //$total1 = "<b>".$value["total"]."</b>";
        $total1 = "<b style=color:Red>"."$ ".number_format($value["total"],2)."</b>";
        //$referencia1 = $numero.$numero1." ".$numero.$calculo;
       
        $fecha1 = $value["fecha"];



    }

                
                  echo '

                  <td>'.$categoria1.'</td>

                  <td>'.$modelo1." ".$descripcion1.'</td>

                  <td>'.$cantidad1.'</td>

                  <td>'.$total1.'</td>
                 
                  <td>'.$fecha1.'</td>

    

                </tr>';
            }

        ?>
               
        </tbody>

       </table>

       <?php

      $eliminarVenta = new ControladorVentas();
      $eliminarVenta -> ctrEliminarVenta();

      ?>
       

      </div>

    </div>

  </section>

</div>




