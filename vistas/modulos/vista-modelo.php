<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Precio reparaciones
    
    </h1>

    
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Precio reparaciones
</li>
    
     </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCotizacionModelo">
          
          Agregar cotización

        </button>

         <button class="btn btn-danger pull-right " onClick="history.go(-1)">
          
          Atrás

        
        </button>

      </div>



        <div class="row">



         


    <div class="col-md-12 col-xs-12">

      <div class="box-body">

       
      
      <?php 


      $item = "id";
      $valor = $_GET["idModelo"];

      $modelo = ControladorCategorias::ctrMostrarModelos($item, $valor); 

      $item = "id";
      $valor = $modelo["id_marca"];

      $marca = ControladorCategorias::ctrMostrarMarcas($item, $valor); 

      //$codigoModelo = $modelo["codigo"];

      $tabla = "reparaciones_cotizacion";
      $item = "id_modelo";
      $valor = $modelo["codigo"];

      $reparaciones = ModeloCotizaciones::mdlMostrarCotizacionesReparacionesModelo($tabla, $item, $valor); 

      
      
    

        

        echo '

             <div class="col-md-4">
             <div class="box box-widget widget-user-2">
             
             <div class="widget-user-header bg-navy">
             <h1><b>'.$marca["marca"]." ".$modelo["modelo"].'</b></h1>

             </div>

              <img src="'.$modelo["imagen"].'" width="300px" class="img-responsive center-block"></img> 
         </div>
         </div>



           <div class="col-md-6">
         
          <div class="box box-widget widget-user-2">
            
            <div class="widget-user-header bg-blue">
              
              
              <h1><b>Reparaciones</b></h1>
           
            </div>
            


            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">';

               foreach ($reparaciones as $key => $value) {


      $tabla = "reparaciones_id";
      $item = "id";
      $valor = $value["id_reparacion"];

      $reparacionCategoria = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor); 

                


                echo '<li><a data-toggle="modal" class="btnReparacionSelecc" idReparacionSelecc='.$value["id"].' data-target="#modalInfoReparacion"><b>'.$reparacionCategoria["reparacion"].'</b>';

              if ($value["riesgos"] != null){

                echo' <span class="badge bg-red fa fa-warning"> </span> ';   
                }

               

                if ($value["id_dispo"] == 1 ){

                  
                } else {
                  
                   echo' <span class="badge bg-yellow fa fa-truck"> </span> ';

                }



               echo' <span class="pull-right badge bg-blue">'."$ ".number_format($value["precio"],2).'</span></a></li>

                ';




              }


              echo '</ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        


        ';

      

      
        ?>

<!--         <div class="col-md-4">
         
          <div class="box box-widget widget-user-2">
            
            <div class="widget-user-header bg-blue">
              
              
              <h1><b>Información</b></h1>
           
            </div>

      </div>
    </div> -->





    </div>

  </section>

</div>


<!--=====================================
MODAL COTIZACIÓN
======================================-->

<div id="modalInfoReparacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Información</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        

        <div class="modal-body">

          <div class="box-body">


         
           
            <?php echo' <input type="hidden" id="idCotizacionVistaModelo" name="idCotizacionVistaModelo"</input>' ?>



          <!-- Widget: user widget style 1 -->
          <div class="row">
            <div class="col-md-6">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-wrench"></i></span>

            <div class="info-box-content">
              <b class="box-title" id="tituloReparaciones" name="tituloReparaciones" style="line-height:100%" >Centro de carga</b>
              
              <?php
              echo '<h5 style="line-height:0%" >'.$marca["marca"]." ".$modelo["modelo"].'</h5>';
              ?>
              
              <span class="info-box-number pull-right" id="precioReparacion" name="precioReparacion" ></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

         <div class="col-md-6">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>

            <div class="info-box-content">
              <h3 class="box-title">Tiempo de instalación</h3>
              
              <span class="info-box-number pull-right" id="tiempoReparacion" name="tiempoReparacion"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
      
      </div>
          <!-- /.info-box -->
       
      


           




          <div class="row">
            <div class="col-md-6">
           <div class="box box-success">
            <div class="box-header with-border">
              <i class="fa fa-truck"></i>

              <h3 class="box-title">Disponibilidad</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
               <dl>
                 <span class="lead"><b id="tituloDispo" name="tituloDispo"></b></span>
                <ul><dd id="descripcionDispo" name="descripcionDispo" ><dd></ul>
                 

                 

                
              </dl>

             

            </div>
            <!-- /.box-body -->
          </div>
        </div>

          

            <div class="col-md-6">
          <div class="box box-warning">
            <div class="box-header with-border">
              <i class="fa fa-star"></i>

              <h3 class="box-title">Garantía</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
              <dl>
                 <span class="lead"><b id="tituloGarantia" name="tituloGarantia"></b></span>
                <ul><dd id="condicionGarantia" name="condicionGarantia" ><dd></ul>
                
              </dl>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>


          <div class="row">
            <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <i class="fa fa-comments"></i>

              <h3 class="box-title">Comentarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
               <dl>
                <ul><dd id="comentariosReparaciones" name="comentariosReparaciones" ></dd></ul>
                <br>
                <ul><dd id="comentariosCotizacion" name="comentariosCotizacion" ></dd></ul>

                  
                 

                 

                
              </dl>

              <!-- <p class="text-green">Text green to emphasize success</p> -->

            </div>
            <!-- /.box-body -->
          </div>
        </div>


          
          <!-- /.box -->
        
          <div class="col-md-6">
           <div class="box box-danger">
            <div class="box-header with-border">
              <i class="fa fa-warning"></i>

              <h3 class="box-title">Riesgos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
             

              <dl>

                <div class="form-group row nuevoRiesgo">

                 

                        
                            

                </div>

               


                
              </dl>

             

            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <input type="hidden" name="cotizacionCopiar" id="cotizacionCopiar" ></input>

          </div>

          
          
        </div>

</div>


             
             
            

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>


          

         
          
          <button type="button" class="btn btn-warning btnEditarCotizacion pull-left" data-toggle="modal" data-target="#modalEditarCotizacionModelo" data-dismiss="modal" >Editar</button>

  


          <button type="button" class="btn btn-info btnTicketCotizacion fa fa-print" onclick="ticketCotizacion()"></button>

         <!-- <button type="button" class="btn btn-warning btnCopiarInfo fa fa-clipboard" onclick="copiarCotizacion()"></button> -->

          <button type="button" class="btn btn-primary btnRecibirEquipo" data-toggle="modal" data-target="#modalAgregarReparacion" data-dismiss="modal" >Recibir Equipo</button>



        </div>

      </form>

      <?php

  $ctrCrearCotizacion = new ControladorCotizaciones();
  $ctrCrearCotizacion -> ctrCrearCotizacion();

    ?>      

    </div>
  

  </div>

</div>





<!--=====================================
MODAL AGREGAR COTIZACION
======================================-->

<div id="modalAgregarCotizacionModelo" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Cotización</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        

        <div class="modal-body">

          <div class="box-body">
         
           
          <!-- Widget: user widget style 1 -->
         
            <div class="col-md-12">
          <div class="info-box bg-navy">
            <span class="info-box-icon bg-navy"><i class="fa fa-mobile-phone"></i></span>


            <div class="info-box-content">

              <?php 

              echo '<h2 class="box-title"><b>'.$marca["marca"]." ".$modelo["modelo"].'</b></h2>';

              //echo '<h1><b>'.$marca["marca"]." ".$modelo["modelo"].'</b></h1>';
              ?>
            </div>
            <!-- /.info-box-content -->
          </div>
      
      </div>
          <!-- /.info-box -->
       
      

        <div class="row">

            <div class="col-md-6">
              <div class="form-group">
            
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <select class="form-control input-lg" id="reparacionCotizacion" name="reparacionCotizacion" required>
                  
                  <option value="">Selecionar reparación</option>

                  <?php

                  $tabla = "reparaciones_id";
                  $item = null;
                  $valor = null;
                  $orden = "reparacion";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["reparacion"].'</option>

                            ';
                  
                       }

                  ?>
  
                </select>

              </div>
            </div>
          </div>




           <div class="col-md-6">
              <div class="form-group">
            
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <select class="form-control input-lg" id="nuevoTiempoCotizacion" name="nuevoTiempoCotizacion" required>
                  
                  <option value="">Selecionar tiempo instalación</option>

                  <?php

                  $tabla = "reparaciones_tiempo";
                  $item = null;
                  $valor = null;
                  $orden = "id";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["tiempo"].'</option>

                            ';
                  
                       }

                  ?>
  
                </select>

                 <?php echo'

               <input type="hidden" id="idModeloCotizacion" name="idModeloCotizacion" value="'.$modelo["codigo"].'"></input>

               <input type="hidden" id="idModelo" name="idModelo" value="'.$_GET["idModelo"].'"></input>
               '; ?>
              

              </div>
            </div>
          </div>



            

          </div>




            <div class="row">

            <div class="col-md-6">
              
              <div class="form-group">


              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-truck"></i></span> 

                <select class="form-control input-lg" id="disponibilidadCotizaciones" name="disponibilidadCotizaciones" required>
                  
                  <option value="">Selecionar disponibilidad</option>

                  <?php

                  $tabla = "reparaciones_disponibilidad";
                  $item = null;
                  $valor = null;
                  $orden = "disponibilidad";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["disponibilidad"].'</option>';
                  
                  }

                  ?>
  
                </select>

              </div>
            </div>
          </div>


            <div class="col-md-6">

              <div class="form-group">
  
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-star"></i></span> 

                <select class="form-control input-lg" id="garantiaCotizaciones" name="garantiaCotizaciones" required>
                  
                  <option value="">Selecionar garantía</option>

                  <?php

                  $tabla = "reparaciones_garantia";
                  $item = null;
                  $valor = null;
                  $orden = "garantia";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["garantia"].'</option>';
                  
                       }

                  ?>
  
                </select>

              </div>
            </div>
          </div>
            
          </div>



          <!-- ENTRADA PARA COMENTARIOS -->
          

               <div class="form-group">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevoComentarioCotizacion" placeholder="Comentarios de la reparación" autocomplete="off" ></textarea>

               </div>
             </div>



            <div class="row">

               <div class="col-md-7">
              <div class="form-group">
                <label>Riesgos</label>
                <select multiple class="form-control input-lg riesgosSelect" id="selectRiesgos" name="selectRiesgos[]" data-placeholder="Selecciona los riesgos" style="width: 100%;" tabindex="-1" aria-hidden="true">

                  <?php

                  $tabla = "reparaciones_riesgo";
                  $item = null;
                  $valor = null;
                  $orden = "riesgo";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["riesgo"].'</option>';
                  
                  }

                  ?>


                </select>

              </div>

            </div>

             
              <div class="col-md-5">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-usd"></i></span>

              <input type="number" class="form-control input-lg" name="nuevoPrecioCotizacion" placeholder="Precio" autocomplete="off" min="0" required>
              


                </div>
            </div>

       
      </div>

              <!-- /.form-group -->
         
              <!-- /.form-group -->
           
            <script type="text/javascript">
              
              $(document).ready(function(){
                $('.riesgosSelect').select2()


              });

            </script>




        </div>

</div>


             
             
            

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



          <button type="submit" class="btn btn-primary btnCrearCotizacion">Agregar </button>



        </div>

      </form>

      <?php

  $ctrCrearCotizacion = new ControladorCotizaciones();
  $ctrCrearCotizacion -> ctrCrearCotizacionVistaModelos();

    ?>      

    </div>
  

  </div>

</div>

   <?php

  $ctrEliminarCotizacion = new ControladorCotizaciones();
  $ctrEliminarCotizacion -> ctrEliminarCotizacionVistaModelo();

    ?>  




<!--=====================================
MODAL EDITAR COTIZACION
======================================-->

<div id="modalEditarCotizacionModelo" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:orange; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Cotización</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        

        <div class="modal-body">

          <div class="box-body">
         
           
          <!-- Widget: user widget style 1 -->
         
            <div class="col-md-12">
          <div class="info-box bg-orange">
            <span class="info-box-icon bg-orange"><i class="fa fa-mobile-phone"></i></span>


            <div class="info-box-content">

              <?php 

              echo ' <h2 style="line-height:70%" >'.$marca["marca"]." ".$modelo["modelo"].'</h2>
              <h3 class="box-title" style="line-height:50%"  id="editarNombreReparacion" name="editarNombreReparacion" ></h3>

        
              
              ';

              //echo '<h1><b>'.$marca["marca"]." ".$modelo["modelo"].'</b></h1>';
              ?>
            </div>
            <!-- /.info-box-content -->
          </div>
      
      </div>
          <!-- /.info-box -->
       
      

        <div class="row">

            <div class="col-md-6">
              <div class="form-group">
            
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <select class="form-control input-lg" id="reparacionCotizacionEditar" name="reparacionCotizacionEditar" required disabled="">
                  
                  <option value="">Selecionar reparación</option>

                  <?php

                  $tabla = "reparaciones_id";
                  $item = null;
                  $valor = null;
                  $orden = "reparacion";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["reparacion"].'</option>

                            ';
                  
                       }

                  ?>
  
                </select>

              </div>
            </div>
          </div>




          <div class="form-group">   
            <div class="col-md-6">
              <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <select class="form-control input-lg" id="editarTiempoCotizacion" name="editarTiempoCotizacion" required>
                  
                  <option value="">Selecionar tiempo instalación</option>

                  <?php

                  $tabla = "reparaciones_tiempo";
                  $item = null;
                  $valor = null;
                  $orden = "id";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["tiempo"].'</option>

                            ';
                  
                       }

                  ?>
  
                </select>


              
                </div>
               </div>

          </div>


            

          </div>




            <div class="row">

            <div class="col-md-6">
              
              <div class="form-group">


              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-truck"></i></span> 

                <select class="form-control input-lg" id="editarDisponibilidadCotizaciones" name="editarDisponibilidadCotizaciones" required>
                  

                  <option value="">Selecionar disponibilidad</option>

                  <?php

                  $tabla = "reparaciones_disponibilidad";
                  $item = null;
                  $valor = null;
                  $orden = "disponibilidad";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["disponibilidad"].'</option>';
                  
                  }

                  ?>
  
                </select>

              </div>
            </div>
          </div>


            <div class="col-md-6">

              <div class="form-group">
  
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-star"></i></span> 

                <select class="form-control input-lg" id="editarGarantiaCotizaciones" name="editarGarantiaCotizaciones" required>
                  
                  <option value="">Selecionar garantía</option>

                  <?php

                  $tabla = "reparaciones_garantia";
                  $item = null;
                  $valor = null;
                  $orden = "garantia";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["garantia"].'</option>';
                  
                       }

                  ?>
  
                </select>

              </div>
            </div>
          </div>
            
          </div>



          <!-- ENTRADA PARA COMENTARIOS -->
          

               <div class="form-group">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="editarComentarioCotizacion"  id="editarComentarioCotizacion"  placeholder="Comentarios de la reparación" autocomplete="off" ></textarea>

               </div>
             </div>



            <div class="row">

               <div class="col-md-7">
              <div class="form-group">
                <label>Riesgos</label>
                <select multiple class="form-control input-lg riesgosSelectEditar" id="editarSelectRiesgos" name="editarSelectRiesgos[]" data-placeholder="Selecciona los riesgos" style="width: 100%;" tabindex="-1" aria-hidden="true">

                  <?php

                  $tabla = "reparaciones_riesgo";
                  $item = null;
                  $valor = null;
                  $orden = "riesgo";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["riesgo"].'</option>';
                  
                  }

                  ?>


                </select>

              </div>

            </div>

             
              <div class="col-md-5">
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-usd"></i></span>

              <input type="number" class="form-control input-lg" name="editarPrecioCotizacion"  id="editarPrecioCotizacion" placeholder="Precio" autocomplete="off" min="0" required>

               <input type="hidden" name="idReparacionEditarVM"  id="idReparacionEditarVM">
               <input type="hidden" name="idModeloEditado"  id="idModeloEditado" <?php echo 'value="'.$_GET["idModelo"].'"'; ?> >
              


                </div>
            </div>

       
      </div>

              <!-- /.form-group -->
         
              <!-- /.form-group -->
           
            <script type="text/javascript">
              
              $(document).ready(function(){
                $('.riesgosSelectEditar').select2()


              });



            </script>

             




        </div>

</div>


             
             
            

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

           <?php 

          if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Administrador de Sucursal"){

          echo '

          <button type="button" class="btn btn-danger pull-left btnEliminarCotizacionVistaModelo" >Eliminar cotización</button>
          '; 
        }
        ?>

          <button type="submit" class="btn btn-warning btnCrearCotizacion">Actualizar</button>



        </div>

      </form>

      <?php

  $ctrEditarCotizacion = new ControladorCotizaciones();
  $ctrEditarCotizacion -> ctrEditarReparacionVistaModelo();

    ?>          

    </div>
  

  </div>

</div>







<!--=====================================
MODAL AGREGAR REPARACION
======================================-->

<div id="modalAgregarReparacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar reparación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">




                         <!-- ENTRADA PARA NOMBRE-->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Nombre" autocomplete="off">

                  </div>


              </div>



                <!-- ENTRADA PARA TELEFONO -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-phone-square"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Telefono" autocomplete="off" >

                  </div>
                  </div>
                  </div>

                                           
              <!-- ENTRADA PARA MARCA-->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-id-badge"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoMarca" id="nuevoMarca" placeholder="Marca" autocomplete="off" <?php echo 'value="'.$marca["marca"].'"';?> >

                  </div>


              </div>



               <!-- ENTRADA PARA MODELO -->


                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoModelo" id="nuevoModelo" placeholder="Modelo" autocomplete="off" <?php echo 'value="'.$modelo["modelo"].'"';?> >

                  </div>
                  </div>
                  </div>


                
                <!-- ENTRADA PARA MODELO -->

         


             <!-- ENTRADA PARA COLOR -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-tint"></i></span> 

                    <input type="text" class="form-control input-lg" id="nuevoColor" name="nuevoColor" min="0" step="any" placeholder="Color" autocomplete="off">

                  </div>




              <!-- ENTRADA PARA Contraseña -->

                  <br>

                   <div class="col-xs-12" style="padding:0">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-unlock"></i></span> 

                    <input type="text" class="form-control input-lg" id="nuevoPass" name="nuevoPass" min="0" step="any" placeholder="Contraseña" autocomplete="off">

                  </div>

                  </div>


                </div>

                <!-- ENTRADA PARA SERIE IMEI -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span> 

                    <input type="text" class="form-control input-lg" id="nuevoSerie" name="nuevoSerie" step="any" placeholder="Serie/IMEI" autocomplete="off">

                      

                      </div>
                    <br>

                     <!-- ENTRADA PARA COSTO -->

                  <div class="form-group row">

                    <div class="col-xs-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecio" name="nuevoPrecio" step="any" placeholder="Precio" autocomplete="off" required>


                       </div>
                      </div>
                      </div>    
                

                 
                   
                     
                 </div>

               </div>

               <!-- ENTRADA PARA SERVICIO -->

     <div class="form-group">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoServicio" id="nuevoServicio" placeholder="Servicio" autocomplete="off" >
               
               </div>
             </div> 
<!-- ENTRADA PARA COMENTARIOS -->

               <div class="form-group">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevoComentario" id="nuevoComentario" placeholder="Comentarios del equipo" autocomplete="off" ></textarea>


                 <input type="hidden" name="idModeloReparacion"  id="idModeloReparacion">
                   <input type="hidden" name="idReparacion"  id="idReparacion">

               </div>
             </div>

              <div class="col-md-12">
              <div class="form-group">
                <label>Riesgos</label>
                <select multiple class="form-control input-lg riesgosSelectRecibirEquipo" id="riesgosSelectRecibirEquipo" name="riesgosSelectRecibirEquipo[]" data-placeholder="Selecciona los riesgos" style="width: 100%;" tabindex="-1" aria-hidden="true">

                  <?php

                  $tabla = "reparaciones_riesgo";
                  $item = null;
                  $valor = null;
                  $orden = "riesgo";

                 $reparaciones = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

                  foreach ($reparaciones as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["riesgo"].'</option>';
                  
                  }

                  ?>


                </select>

              </div>

            </div>

             <script type="text/javascript">
              
              $(document).ready(function(){
                $('.riesgosSelectRecibirEquipo').select2()


              });

            </script>

     

      

              




             </div>


                      
        </div>





                  

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar reparación</button>

        </div>

      </form>

        <?php

          $ctrCrearReparacion = new ControladorReparaciones();
          $ctrCrearReparacion -> ctrCrearReparacion();

        ?>  

    </div>

  </div>

</div>






