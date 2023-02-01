<?php



//$fechaInicial = date("Y-m-d");
//$fechaFinal = date("Y-m-d");


//$ingreso = ControladorFinanzas::ctrSumaTotalIngresos($fechaInicial, $fechaFinal);


//$gasto = ControladorFinanzas::ctrSumaTotalGastoParciales($fechaInicial, $fechaFinal);

    
          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          



$gasto = ControladorFinanzas::ctrSumaTotalGastoParciales($fechaInicial, $fechaFinal);
  

  /*=============================================
  FOREACH INGRESA EN EL STRING DE FECHAS Y MUESTRA EL VALOR EN CAJAS (NECESARIO PARA MOSTRAR VALOR)
  =============================================*/
  foreach($gasto as $respuesta4)



?>



<div class="col-lg-3 col-md-5 col-xs-12">

  <div class="small-box bg-red">
    
    <div class="inner">
    
      <h3>- $<?php echo number_format($respuesta4["gasto"],2); ?></h3>

      <p>Gastos en pagos parciales</p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>


  </div>
  
</div>













