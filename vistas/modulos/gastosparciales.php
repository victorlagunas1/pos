<?php

if($_SESSION["perfil"] != "Administrador" && $_SESSION["perfil"] != "Administrador de Sucursal"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Gastos parciales
    
    </h1>

    
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Gastos parciales</li>
    
     </ol>

  </section>

  <section class="content">

    
    <div class="box">

      
      <div class="box-header with-border">
         <?php include "inicio/cajas-gastosparciales.php"; ?>
       </div>



<div class="box-header with-border">

  <button type="button" class="btn btn-default pull-right" id="daterangeGastos-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

         

</div>


      
  

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
          <tr>

              <th style="width:10px">#</th>
              <th>Usuario</th>
              <th>Concepto</th>
              <th>Gasto Original</th> 
               <th>Pagos Restantes</th>
               <th>Importe Parcial</th> 
               <th>Siguiente pago</th>
              <th>Botones</th>
              
            </tr> 

        </thead>

        <tbody>

        <?php

      //  $fechaInicial = "2020/05/05";
       // $fechaFinal = date("Y-m-d");


          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

       
          $respuesta = ControladorFinanzas::ctrRangoFechasFinanzasGastos($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>



                  <td>'.($key+1).'</td>';
      
                  echo '<td>'.$value["usuario"].'</td>

                  <td>'.$value["concepto"].'</td>

                  

                  <td><b style=color:Red>'.$value["gasto"].'</b></td>

                  <td>'.$value["pagos_restantes"].' de '.$value["pagos_totales"].'</td>

                  

                  
                <td>'."$ ".number_format($value["gasto_restante"]/$value["pagos_restantes"],1).'</td>



                  <td>'.$value["dia_pago"].'</td>


                  <td>

                    <div class="btn-group">';

                      if($_SESSION["perfil"] == "Administrador"){

                      echo '<button class="btn btn-success btnAgregarPago" data-toggle="modal" data-target="#modalAgregarPago" idFinanza="'.$value["id"].'"><i class="fa fa-money"></i></button>


                      <button class="btn btn-primary btnAgregarPago" data-toggle="modal" data-target="#modalAgregarPago" idFinanza="'.$value["id"].'"><i class="fa fa-info-circle"></i></button>


                      <button class="btn btn-danger btnEliminarActividad" idFinanza="'.$value["id"].'"><i class="fa fa-trash"></i></button>';

                    }

                    echo '</div>  

                  </td>

                </tr>';
            }

        ?>
               
        </tbody>


       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL INGRESO
======================================-->

<div id="modalAgregarPago" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#5cb85c; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalles de credito</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

          <div class="box-body">




                <!-- ENTRADA PARA MARCA -->

              <div class="form-group">
              

            <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-check"></i></span>

            <div class="info-box-content">

              
             <span class="info-box-text" id="infoPorcentaje">Pagado 87%</span>
              <span class="info-box-number pull-right"></span>

               <h2 class="pull-right" id="infoPago">87%</h2>
        
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


          <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-remove"></i></span>

            <div class="info-box-content">
             
              <span class="info-box-text" id="infoPorcentajePendiente">Pendiente</span>
              

              <h2 class="pull-right" id="infoDeuda">87%</h2>
            
            </div>
            <!-- /.info-box-content -->
          </div>

            </div>

         
          </div>

       

          <div class="col-xs-12">
         <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-link"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"></span>
              <span class="info-box-number" id="infoMeses">10 de 12</span>

          
              <span id="formaPago">Forma de pago</span>
                  <span class="progress-description" id="infoSiguientePago">
                    Fecha inicial 20/03/2020, Ultimo pago 10/05/202
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

      

           

            <h3 class="pull-right" id="infoPagoSolicitado"><b>Pago solicitado: $500</b></h3>
            



           <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
              
            

            <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                        Otra cantidad
                      </a>
                    </h4>
                  </div>
                  
                  <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                          
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoIngresoGasto" placeholder="Ingresar Cantidad" autocomplete="off"> </input>


                 <input id="pagoMensual" class="hidden" name="pagoMensual"></input>
                 <input id="pagosRestantes" class="hidden" name="pagosRestantes" ></input>
                 <input id="idPago" class="hidden" name="idPago" >

                   <input id="gastoRestante" class="hidden" name="gastoRestante" >
                 </input>


                 <input id="usuarioId" class="hidden" name="usuarioId" >
                 <input id="conceptoId" class="hidden" name="conceptoId" >




                  </div>


<br>
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-money"></i></span> 
              <input type="number" class="form-control input-lg" name="nuevosMeses" placeholder="¿Modificar pagos parciales?" autocomplete="off"> </input>
   
</div>

</div>


              
            </div>




</div>




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


          <button type="submit" class="btn btn-success btnAgregarPago">Agregar pago </button>



        </div>

      </form>

      <?php

  $ctrCrearPagoGasto = new ControladorFinanzas();
  $ctrCrearPagoGasto -> ctrAgregarPagoGasto();

  $ctrCrearIngresoPagoGasto = new ControladorFinanzas();
  $ctrCrearIngresoPagoGasto -> ctrCrearIngresoGastoParcial();




    ?>      

    </div>
  

  </div>






    



</div>

<?php

  $borrarFinanza = new ControladorFinanzas();
  $borrarFinanza -> ctrEliminarFinanzaGasto();

?>


