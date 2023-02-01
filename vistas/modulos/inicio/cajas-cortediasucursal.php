<?php

$item = null;
$valor = null;
$orden = "id";

date_default_timezone_set('America/Mexico_City');




            $fechaInicial = date("Y-m-d");
            $fechaFinal = date("Y-m-d");
            
            $sucursal = $_SESSION["sucursal"];
  


$tabla = "ventas_stock";
$item1 = "tipo";
$valor1 = "0";
$item2 = "sucursal";
$valor2 = $sucursal;

$ventas = ModeloGeneral::mdlFecthDosValores($tabla, $fechaInicial, $fechaFinal, $item1, $valor1, $item2, $valor2);

$sumaVentas = 0;
foreach ($ventas as $key => $value) {
$sumaVentas += ($value["total"]*$value["cantidad"]);
}



//$sumaVentas =+ $ventas["suma"];
//var_dump($ventas["total"]);


$tabla = "ventas_stock";
$item1 = "tipo";
$valor1 = "1";
$item2 = "sucursal";
$valor2 = $sucursal;

$reparaciones = ModeloGeneral::mdlFecthDosValores($tabla, $fechaInicial, $fechaFinal, $item1, $valor1, $item2, $valor2);

$sumaReparaciones = 0;
foreach ($reparaciones as $key => $value) {
$sumaReparaciones += ($value["total"]);
}



$tabla = "ventas_stock";
$item1 = "tipo";
$valor1 = "3";
$item2 = "sucursal";
$valor2 = $sucursal;

$gastos = ModeloGeneral::mdlFecthDosValores($tabla, $fechaInicial, $fechaFinal, $item1, $valor1, $item2, $valor2);

$sumaGastos = 0;
foreach ($gastos as $key => $value) {
$sumaGastos += ($value["total"]);
}


?>



<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-yellow">
    
    <div class="inner">
      
      <h3>$<?php echo number_format($sumaVentas,2); ?></h3>

      <p>Ventas</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-cash"></i>
    
    </div>
    
    <a href="crear-venta" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>


<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3>$<?php echo number_format($sumaReparaciones,2); ?></h3>

      <p> Reparaciones entregadas</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-wrench"></i>
    
    </div>
    
    <a href="reparaciones-sucursal" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-red">
    
    <div class="inner">
      
      <h3>-$<?php echo number_format($sumaGastos,2); ?></h3>

      <p>Gastos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-arrow-down-a"></i>
    
    </div>
    
    <a data-target="#modalGasto" data-toggle="modal" class="small-box-footer"
       href="#modalGasto">
      
      Crear gasto <i class="fa fa-arrow-circle-down"></i>
    
    </a>

  </div>

</div>




<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-green">
    
    <div class="inner">
      
      <h3>$<?php echo number_format(($sumaVentas+$sumaReparaciones)-$sumaGastos,2); ?></h3>

      <p>Total</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-arrow-up-a"></i>
    
    </div>
    
    <a href="cortedia" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>



  <!--=====================================
        CABEZA DEL MODAL
        ======================================-->


<div id="modalGasto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#D54324; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar gasto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

  <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoConceptoGasto" placeholder="Ingresar Concepto" autocomplete="off" required>

                  </div>


              </div>

            </div>
          

        

            <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoCantidadGasto" placeholder="Ingresar Cantidad" autocomplete="off" required>

                  </div>


              </div>

            </div>
            
         </div>
        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-danger btnCrearFinanzaGasto">Agregar </button>

        </div>

      </form>

</div>
    </div> 
    </div>
    
      <?php

  $ctrCrearFinanzaGasto = new ControladorFinanzas();
  $ctrCrearFinanzaGasto -> ctrCrearFinanzaGastoVentasDiaSucursal();

    ?>     
