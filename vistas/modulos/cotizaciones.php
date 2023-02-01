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

         <button class="btn btn-warning pull-right " onclick="location.href='cotizacion-cliente'">
          
          Generar cotización
        </button>

    <button class="btn btn-primary pull-right" style="margin-right:5px" onclick="location.href='cotizaciones-vistas'">Nuevo Diseño</button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaCotizaciones" width="100%">
         
        <thead>
         
          <tr>

              <th style="width:10px">#</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Reparación</th>
              <th>Comentario</th>
              <th>Precio</th>
              <th>Estado</th>

              <th>Botones</th>
              
            </tr> 

        </thead>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL COTIZACIÓN
======================================-->

<div id="modalCotizacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cotización</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

          <div class="box-body">


                <!-- ENTRADA PARA MARCA -->

              <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoMarca" id="nuevoMarca" placeholder="Ingresar marca" autocomplete="off" required>

                  </div>

</div>

              </div>

                 <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                  
                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoModelo" placeholder="Ingresar modelo" autocomplete="off" required>

                  </div>


              </div>

            </div>
          

          


             


            <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoReparacion" placeholder="Ingresar reparacion" autocomplete="off" required>

                  </div>


              </div>

            </div>
           
            <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoCosto" placeholder="Ingresar precio" autocomplete="off" required>

                  </div>


              </div>

            </div>

            <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-comment"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoComentario" placeholder="Ingresar comentario" autocomplete="off">

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


          <button type="submit" class="btn btn-success btnCrearCotizacion">Agregar </button>



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
MODAL COTIZACIÓN
======================================-->

<div id="modalEditarCotizacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cotización</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

          <div class="box-body">


                <!-- ENTRADA PARA MARCA -->

              <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon">ID<i></i></span> 

                <input type="text" class="form-control input-lg" name="editarID" id="editarID" placeholder="Ingresar marca" autocomplete="off" readonly>

                  </div>

</div>

              </div>
      
      <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca" placeholder="Ingresar marca" autocomplete="off">

                  </div>

      </div>

              </div>


                 <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                  
                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span> 

                <input type="text" class="form-control input-lg" name="editarModelo"id="editarModelo" placeholder="Ingresar modelo" autocomplete="off">

                  </div>


              </div>

            </div>
            


            <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <input type="text" class="form-control input-lg" name="editarReparacion"id="editarReparacion" placeholder="Ingresar reparacion" autocomplete="off">

                  </div>


              </div>

            </div>
           
            <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCosto" id="editarCosto" placeholder="Ingresar precio" autocomplete="off">

                  </div>


              </div>

            </div>

            <div class="form-group row">

                <div class="col-xs-12 col-sm-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-comment"></i></span> 

                <input type="text" class="form-control input-lg" name="editarComentario" id="editarComentario" placeholder="Ingresar comentario" autocomplete="off">

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


          <button type="submit" class="btn btn-primary btnCrearCotizacion">Guardar</button>



        </div>

      </form>

      <?php

  $ctrEditarCotizacion = new ControladorCotizaciones();
  $ctrEditarCotizacion -> ctrEditarCotizacion();

    ?>      

    </div>
  

  </div>

</div>



<?php

  $aceptarCotizacion = new ControladorCotizaciones();
  $aceptarCotizacion -> ctrAceptarCotizacion();


  $borrarCotizacion = new ControladorCotizaciones();
  $borrarCotizacion -> ctrEliminarCotizacion();

?>






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
         
           

          <!-- /.info-box -->
       
        <div class="form-group row ">
          <div class="col-xs-12 col-sm-6">
             <div class="input-group">

               

              <span class="input-group-addon"><i class="fa fa-repeat"></i></span>

              <select class="form-control input-lg" name="marcaSeleccionada" id="marcaSeleccionada">



                
                <option value="">Marca</option>

                 <?php

                      $item = null;
                      

                      $valor = null;

                  

                      $categorias = ControladorCategorias::ctrMostrarMarcas($item, $valor);

                       foreach ($categorias as $key => $value)

                        {

                         echo '<option value="'.$value["id"].'">'.$value["marca"].'</option>';

                       };

                    ?>
     
              </select>
            </div>
            </div>



           

      <div class="form-group">
            <div class="col-xs-12 col-sm-6">
             <div class="input-group">

               

              <span class="input-group-addon"><i class="fa fa-repeat"></i></span>

              <select class="form-control input-lg" name="nuevoModeloSelecionado" id="nuevoModeloSelecionado" >
                
                <option value="">Modelo</option>
     
              </select>

               <script>
  $(document).ready(function(e){

  $("#marcaSeleccionada").change(function(){
    var idMarcaModelo = "idMarcaModelo="+$("#marcaSeleccionada").val();

    $.ajax({
     data: idMarcaModelo,
    url: 'ajax/categorias.ajax.php',
    type: 'post',
   
    beforeSend: function () {
      $("#nuevoModeloSelecionado").html("Cargando...");
    },
    success: function(response){
        
        $("#nuevoModeloSelecionado").html(response);

      },
      error:function(){
        alert("error")
      }
              });
              })
            })
                </script>

            </div>
            </div>
          </div>
          </div>

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

                <textarea type="text" class="form-control input-lg" name="nuevoComentarioCotizacion" id="nuevoComentarioCotizacion" placeholder="Comentarios de la reparación" autocomplete="off" ></textarea>

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

              <input type="number" class="form-control input-lg" name="nuevoPrecioCotizacion" id="nuevoPrecioCotizacion" placeholder="Precio" autocomplete="off" min="0" required>

              <input type="hidden" name="idCotizacionAnterior" id="idCotizacionAnterior">
              


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
  $ctrCrearCotizacion -> ctrCrearCotizacionVistaModelosExportar();

  //$ctrCrearCotizacion2 = new ControladorCotizaciones();
  $ctrCrearCotizacion -> ctrCrearCotizacionLista();

    ?>      

    </div>
  

  </div>

</div>

