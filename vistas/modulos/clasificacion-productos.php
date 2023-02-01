
<div class="content-wrapper">


  <section class="content-header">


<?php 


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

         

<a class="btn btn-app" style="width:300px; height:300px">
                <span class="badge bg-green">300</span>
                <i class="fa fa-barcode"></i> Productos por Categorias
              </a>


<a class="btn btn-app" style="width:300px; height:300px">
                <span class="badge bg-green">300</span>
                <i class="fa fa-barcode"></i> Productos por Modelo
              </a>

<a class="btn btn-app" style="width:300px; height:300px">
                <span class="badge bg-green">300</span>
                <i class="fa fa-barcode"></i> Productos General
              </a>

      



    </div>

  </section>

</div>




