<?php

    
          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          

$ingreso = ControladorFinanzas::ctrSumaTotalRangoIngresos($fechaInicial, $fechaFinal);

$gasto = ControladorFinanzas::ctrRangoFechasFinanzasGastosCaja($fechaInicial, $fechaFinal);
  

  /*=============================================
  FOREACH INGRESA EN EL STRING DE FECHAS Y MUESTRA EL VALOR EN CAJAS (NECESARIO PARA MOSTRAR VALOR)
  =============================================*/
  foreach($ingreso as $respuesta3)
  foreach($gasto as $respuesta4)


?>



<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-green">
    
    <div class="inner">
      
      <h3>+ $<?php echo number_format($respuesta3["ingreso"],2); ?></h3>

      <p>Ingresos</p> <?php date("Y-m-d"); ?>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-arrow-up-a"></i>
    
    </div>
    
    <a class="small-box-footer">
      
      Mas info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>



<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-red">
    
    <div class="inner">
    
      <h3>- $<?php echo number_format($respuesta4["gasto"],2); ?></h3>

      <p>Gastos</p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-arrow-down-a"></i>
    
    </div>
    
    <a class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>





<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-yellow">
    
    <div class="inner">




      <h3>$ <?php echo number_format($respuesta3["ingreso"]-$respuesta4["gasto"],2); ?></h3>

      <p>Diferencia (Ingresos - Gastos)</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-stats-bars"></i>
    
    </div>
    
    <a class="small-box-footer">
      
      Mas info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>







               
<?php 
$ingreso = $respuesta3["ingreso"];
$gasto = $respuesta4["gasto"];
$sumaTotal = $ingreso+$gasto;

if ($sumaTotal != 0){
  $porcentaIngreso = number_format((($ingreso*100)/$sumaTotal),1);
$porcentaGasto = number_format((($gasto*100)/$sumaTotal),1);


} else {
  $porcentaIngreso = 0;
  $porcentaGasto = 0;
}




echo '<div class="col-lg-3 col-xs-12  ">

  <div class="small-box bg-navy">
    
       <div class="inner">  
       <div class="icon">
      
      
    
    </div>
            <h3>Porcentaje</h3>





            

              <div class="progress">

              <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="60000" style="width: '.$porcentaIngreso.'%"><p>Ingresos: '.$porcentaIngreso.'%</p>


              
                  
                
              </div>
              
                <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaGasto.'%">
                  
 <p>Gastos: '.$porcentaGasto.'%<p>


                </div>


                 


              </div>
              <b>Respecto a 100% (Ingresos + Gastos)</b>
               <br>


            </div>

            <!-- /.box-body -->
          </div>



          <!-- /.box -->
        </div>

        ';



?>




               
         





