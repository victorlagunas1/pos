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
      
      Finanzas
    
    </h1>

    
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar cotización</li>
    
     </ol>

  </section>

  <section class="content">


    
    <div class="box">

      
      <div class="box-header with-border">
         <?php include "inicio/cajas-actividadesfinanzas.php"; ?>
       </div>

       



      
      <div class="box-header with-border">
 


  <button class="btn btn-success" data-toggle="modal" data-target="#modalIngreso">
          
          Agregar ingreso

        </button>

        <button class="btn btn-danger" data-toggle="modal" data-target="#modalGasto">
          
          Agregar gasto

        </button>



  
        <button class="btn btn-warning" data-toggle="modal" data-target="#modalIngresoRecurrente">
          
          Ingreso recurrente

        </button>

        <button class="btn btn-warning" data-toggle="modal" data-target="#modalGastoRecurrente">
          
          Gasto recurrente

        </button>

        

        
           <button type="button" class="btn btn-default pull-right" id="daterangeFinanzas-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

         <button class="btn btn-warning pull-right" style="margin-right:5px" data-toggle="modal" data-target="#modalAgregarRenta">
          
          Pago renta

        </button>

         <button class="btn btn-danger pull-right" style="margin-right:5px" data-toggle="modal" data-target="#modalAgregarNomina">
          
          Pago nomina

        </button>


        

         
  
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
          <tr>

              <th style="width:10px">#</th>
              <th>Usuario</th>
              <th>Concepto</th>
              <th>Ingreso</th>
              <th>Gasto</th>
              <th>Fecha</th>
              <th>Botones</th>
              
            </tr> 

        </thead>

        <tbody>

        <?php

        
          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

       
          $respuesta = ControladorFinanzas::ctrRangoFechasFinanzas($fechaInicial, $fechaFinal);




          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>';
      
                  echo '<td>'.$value["usuario"].'</td>

                  <td>'.$value["concepto"].'</td>

                  <td><b style=color:Green>'."$ ".number_format($value["ingreso"],2).'</b></td>

                  <td><b style=color:Red>'."$ ".number_format($value["gasto"],2).'</b></td>

                  <td>'.$value["fecha"].'</td>


                  <td>

                    <div class="btn-group">';

                      if($_SESSION["perfil"] == "Administrador"){

                      echo ' <button class="btn btn-danger btnEliminarActividad" idFinanza="'.$value["id"].'"><i class="fa fa-trash"></i></button>';

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

<div id="modalIngresoRecurrente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#5cb85c; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar ingreso recurrente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

          <div class="box-body">


                <!-- ENTRADA PARA MARCA -->

              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span> 

                <select class="form-control input-lg" id="nuevoUsuarioIngreso" name="nuevoUsuarioIngreso" required>
                  
                  <option value="">Selecionar usuario</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

                 <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">


                  
                  
                    <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoConceptoIngreso" placeholder="Ingresar Concepto" autocomplete="off" required>

                  </div>


              </div>

            </div>
          

          


             


            <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoCantidadIngreso" placeholder="Ingresar Cantidad" autocomplete="off" required>

                  </div>


              </div>

            </div>

 <!-- 
         <div class="input-group input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">¿Retorno de ingreso?
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#">Si</a></li>
                    <li><a href="#">No</a></li>
                  </ul>
                </div>
                 /btn-group 
                <input type="text" class="form-control">
              </div>
              -->




            <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                        ¿Retorno de ingreso?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                            <div class="form-group row">

                          <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoMesesIngreso" placeholder="Cantidad de pagos" autocomplete="off">


                  </div>

              </div>
              
            </div>

           

            <div class="input-group">

               

              <span class="input-group-addon"><i class="fa fa-repeat"></i></span>

              <select class="form-control input-lg" name="nuevoRecurrenciaIngreso">
                
                <option value="0">Recurrencia de pago</option>
                <option value="7">Semanal</option>
                 <option value="15">Quincenal</option>
                <option value="30">Mensual</option>
                <option value="60">Bimestral</option>
                <option value="180">Semestral</option>
                <option value="365">Anual</option>


              </select>
              

            </div>


                Fecha de primer pago
            <br>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoFechaPagoIngreso" placeholder="Fecha primer pago" autocomplete="off">


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


          <button type="submit" class="btn btn-success btnCrearFinanza">Agregar </button>



        </div>

      </form>

      <?php

  $ctrCrearFinanza = new ControladorFinanzas();
  $ctrCrearFinanza -> ctrCrearFinanza();

    ?>      

    </div>
  

  </div>

</div>



        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->


<div id="modalGastoRecurrente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#f0ad4e; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar gasto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

          <div class="box-body">


                <!-- ENTRADA PARA MARCA -->

              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span> 

                <select class="form-control input-lg" id="nuevoUsuarioGasto" name="nuevoUsuarioGasto" required>
                  
                  <option value="">Selecionar usuario</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

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


            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>


                <select class="form-control input-lg" id="nuevoFormaPagoGasto" name="nuevoFormaPagoGasto">
                  
                  <option value="">Forma de pago</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorFormaPagos::ctrMostrarFormaPagos($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["forma_pago"].'">'.$value["forma_pago"].'</option>';
                  }

                  ?>

  
                </select>

                    <a class="input-group-addon" data-toggle="modal" data-target="#modalIngreso" >
                          <i class="fa fa-plus"></i>
                        </a>
                </div>

              </div>


            

              


                     <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                <div class="panel box box-warning">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree1" class="collapsed" aria-expanded="false">
                        ¿Retorno de gasto?
                      </a>
                    </h4>
                  </div>

                  
                  <div id="collapseThree1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                            <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoMesesGasto" placeholder="Cantidad de pagos" autocomplete="off">


                  </div>

              </div>
              
            </div>



           

            <div class="input-group">

               

              <span class="input-group-addon"><i class="fa fa-repeat"></i></span>

              <select class="form-control input-lg" name="nuevoRecurrenciaGasto">
                
                <option value="0">Recurrencia de pago</option>
                <option value="7">Semanal</option>
                 <option value="15">Quincenal</option>
                <option value="30">Mensual</option>
                <option value="60">Bimestral</option>
                <option value="180">Semestral</option>
                <option value="365">Anual</option>


              </select>
              

            </div>


                Fecha de primer pago
            <br>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoFechaPagoGasto" placeholder="Fecha primer pago" autocomplete="off">


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


          <button type="submit" class="btn btn-success btnCrearFinanzaGasto">Agregar </button>



        </div>

      </form>

      <?php

  $ctrCrearFinanzaGasto = new ControladorFinanzas();
  $ctrCrearFinanzaGasto -> ctrCrearFinanzaGasto();

    ?>      

    </div>
  

  </div>

</div>

</div>

<?php

  $borrarFinanza = new ControladorFinanzas();
  $borrarFinanza -> ctrEliminarFinanza();

?>

   <!-- ===================
        PAGO NOMINA
    ============================ -->

    <!-- Modal -->
<div id="modalAgregarNomina" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!-- ===================
        CABEZA DEL MODAL
    ============================ -->

      <div class="modal-header" style="background:red; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Pago de nomina</h4>
      </div>
      
      <!-- ===================
        CUERPO DE MODAL
    ============================ -->

      <div class="modal-body">
        
        <div class="box-body">

           <div class="form-group">
            
            <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-red">
              <h3 id="usuarioNomina">Selecionar usuario</h3>
              <h5 id="perfilNomina"></h5>
              <h5 id="sucursalNominaHTML"></h5>
             <!-- <h3 class="pull-right" id="pagoNomina"></h3> -->
            </div>
           
     
          </div>
          <!-- /.widget-user -->
        </div>

      </div>

              
           <div class="form-group">
              
              <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-users"></i></span>

               <select class="form-control input-lg" name="usuarioSeleccionadoNomina" id="usuarioSeleccionadoNomina" required="">

                <option value="">Selecionar usuario</option>


          <?php 
           
            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            
              foreach ($usuarios as $key => $value) {

            echo '
            
                <option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  
                   }
              ?>       

                </select>
              </div>

            </div>

           

              <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input type="number" class="form-control input-lg" name="pagoNominaUsuario" id="pagoNominaUsuario" placeholder="Pago total" autocomplete="off" required>

              <input type="hidden" class="form-control input-lg" name="nombreUsuario" id="nombreUsuario">

               <input type="hidden" class="form-control input-lg" name="sucursalNomina" id="sucursalNomina">
              



            </div>

          </div>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="fechaPagoNomina" placeholder="Fecha pago nomina" autocomplete="off" required>


                  </div>
              



               

          <!-- DESACTIVADOS PROVISONALMENTE 
          
          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input type="text" class="form-control input-lg" name="diasNomina" id="diasNomina" placeholder="Dias laborados" autocomplete="off" required>
              



            </div>

          </div>


           ENTRADA NOMBRE 
          
       <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input type="text" class="form-control input-lg" name="retardoNomina" id="retardoNomina" placeholder="Dias retardos" autocomplete="off" required>
              



            </div>

          </div>

                 ENTRADA NOMBRE
          
          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input type="text" class="form-control input-lg" name="objNomina" id="objNomina" placeholder="Objetivos alcanzados" autocomplete="off" required>

            </div>

          </div>


           ENTRADA USUARIO

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <input type="text" class="form-control input-lg" name="descNomina"  id="descNomina" placeholder="Descuentos" id="nuevoUsuario" autocomplete="off" required>
              

            </div>

          </div> -->


        </div>

      </div>

      <!-- ===================
        PIE DE MODAL
    ============================ -->
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-danger">Aplicar</button>
      </div>

      <?php

      $agregarPagoNomina = new ControladorFinanzas();
      $agregarPagoNomina -> ctrCrearPagoNomina();

      ?>

    </form>

    </div>

  </div>

</div>


   <!-- ===================
  RENTA SUCURSAL

      ============================ -->

    <!-- Modal -->
<div id="modalAgregarRenta" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!-- ===================
        CABEZA DEL MODAL
    ============================ -->

      <div class="modal-header" style="background:orange; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Pago de renta</h4>
      </div>
      
      <!-- ===================
        CUERPO DE MODAL
    ============================ -->

      <div class="modal-body">
        
        <div class="box-body">



              
           <div class="form-group">
              
              <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-users"></i></span>

               <select class="form-control input-lg" name="sucursalSeleccionadaRenta" id="sucursalSeleccionadaRenta" required="">

                <option value="">Selecionar sucursal</option>


          <?php 
           
            $item = null;
            $valor = null;

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

            
              foreach ($sucursal as $key => $value) {

            echo '
            
                <option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  
                   }
              ?>       

                </select>
              </div>

            </div>

           

              <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input type="number" class="form-control input-lg" name="pagoRenta" id="pagoRenta" placeholder="Pago total" autocomplete="off" required>


               <input type="hidden" class="form-control input-lg" name="sucursalNomina" id="sucursalNomina">
              



            </div>

          </div>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="fechaPagoAlquiler" placeholder="Fecha pago nomina" autocomplete="off" required>


                  </div>

                  <input type="hidden" class="form-control input-lg" name="nombreUsuario" id="nombreUsuario" value="<?php echo $_SESSION['nombre']; ?>" >
              


              


        </div>

      </div>

      <!-- ===================
        PIE DE MODAL
    ============================ -->
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-danger">Aplicar</button>
      </div>

      <?php

      $agregarRenta = new ControladorFinanzas();
      $agregarRenta -> ctrCrearPagoRenta();

      ?>

    </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL INGRESO 
======================================-->

<div id="modalIngreso" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#5cb85c; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar ingreso</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

          <div class="box-body">


                <!-- ENTRADA PARA MARCA -->

           
                           <div class="form-group">
              
              <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-users"></i></span>

               <select class="form-control input-lg" name="sucursalSeleccionadaIngreso" id="sucursalSeleccionadaIngreso" required>

                <option value="">Selecionar sucursal</option>


          <?php 
           
            $item = null;
            $valor = null;

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

            
              foreach ($sucursal as $key => $value) {

            echo '
            
                <option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  
                   }
              ?>       

                </select>
              </div>

            </div>



                 <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">


                  
                  
                    <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoConceptoIngreso" placeholder="Ingresar Concepto" autocomplete="off" required>

                  </div>


              </div>

            </div>
          

          

            <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoCantidadIngreso" placeholder="Ingresar Cantidad" autocomplete="off" required>

                  </div>


              </div>

            </div>

             <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoFechaIngreso" placeholder="Fecha primer pago" autocomplete="off" required>


                  </div>
              



        </div>

</div>


             
            

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>


          <button type="submit" class="btn btn-success">Agregar </button>



        </div>
              <?php

  $ctrNuevoIngreso = new ControladorFinanzas();
  $ctrNuevoIngreso -> ctrCrearIngreso();

    ?>  

      </form>

    

    </div>
  

  </div>

</div>





<!--=====================================
MODAL GASTO 
======================================-->

<div id="modalGasto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:red; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar gasto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

          <div class="box-body">


                <!-- ENTRADA PARA MARCA -->

           
                           <div class="form-group">
              
              <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-users"></i></span>

               <select class="form-control input-lg" name="sucursalSeleccionadaGasto" id="sucursalSeleccionadaGasto" required>

                <option value="">Selecionar sucursal</option>


          <?php 
           
            $item = null;
            $valor = null;

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

            
              foreach ($sucursal as $key => $value) {

            echo '
            
                <option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  
                   }
              ?>       

                </select>
              </div>

            </div>



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

             <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoFechaGasto" placeholder="Fecha primer pago" autocomplete="off" required>


                  </div>
              



        </div>

</div>


             
            

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>


          <button type="submit" class="btn btn-danger">Agregar </button>



        </div>
              <?php

  $ctrNuevoGasto = new ControladorFinanzas();
  $ctrNuevoGasto -> ctrCrearGasto();

    ?>  

      </form>

    

    </div>
  

  </div>

</div>


