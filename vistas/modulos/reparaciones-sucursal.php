<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Reparaciones
    
    </h1>

    
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar reparaciones</li>
    
     </ol>

 

    <?php 

    $fechaInicial = date("Y-m-d");
    $fechaFinal = date("Y-m-d");



      $tabla = "reparaciones";
      $item1 = "id_sucursal";
      $valor1 = $_SESSION["sucursal"];
      $item2 = "status";
      $valor2 = "2";
      //$sucursal = ;


      $porEntregar = ModeloCotizaciones::mdlMostrarFetchAllDoble($tabla, $item1, $valor1, $item2, $valor2); 

      $item2 = "status";
      $valor2 = "0";
      //$sucursal = ;

      $pendientes = ModeloCotizaciones::mdlMostrarFetchAllDoble($tabla, $item1, $valor1, $item2, $valor2);  

      $item2 = "status";
      $valor2 = "1";
      //$sucursal = ;

      $revision = ModeloCotizaciones::mdlMostrarFetchAllDoble($tabla, $item1, $valor1, $item2, $valor2);  

      $item2 = "status";
      $valor2 = "6";
      //$sucursal = ;

      $contactar = ModeloCotizaciones::mdlMostrarFetchAllDoble($tabla, $item1, $valor1, $item2, $valor2);  

    echo'<div class="row">

       <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">POR ENTREGAR</span>

                <h2 class="pull-right"><b>'.count($porEntregar).'</b></h2>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-wrench"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENDIENTES</span>
             
              <h2 class="pull-right"><b>'.count($pendientes).'</b></h2>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-edit"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">REVISIÓN</span>
               <h2 class="pull-right"><b>'.count($revision).'</b></h2>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

       
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-phone-square"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">POR CONTACTAR</span>
                <h2 class="pull-right"><b>'.count($contactar).'</b></h2>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>';

      ?>


  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary btnAgregarReparacion" data-toggle="modal" data-target="#modalAgregarReparacion">
          
          Agregar reparación 

        </button>


        
        <button class="btn btn-primary pull-right fa fa-users" style="margin-left:5px" onclick="location.href='reparaciones'"> </button>

        <button class="btn btn-primary pull-right fa fa-wrench" style="margin-left:5px" onclick="location.href='listado-reparaciones'"> </button>
         
    


        <button class="btn btn-warning pull-right " onclick="location.href='refacciones-sucursal'">
          
          Refacciones
        </button>
        




        

        

        

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaReparacionesSucursal" width="100%">
         
        <thead>
         
          <tr>

              <th style="width:10px">#</th>
              <th>Codigo</th>
              <th>Status</th>
              <th>Nombre</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Servicio</th>
              <th>Precio</th>
              <th>Garantía</th>
              <th>Fecha Recepción</th>
              <th>Detalles</th>

            </tr> 

        </thead>

       </table>

      </div>

    </div>

  </section>

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

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Telefono" autocomplete="off">

                  </div>
                  </div>
                  </div>

                                           
              <!-- ENTRADA PARA MARCA-->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-id-badge"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoMarca" placeholder="Marca" autocomplete="off">

                  </div>


              </div>



               <!-- ENTRADA PARA MODELO -->


                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-id-badge"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoModelo" placeholder="Modelo" autocomplete="off">

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

                <input type="text" class="form-control input-lg" name="nuevoServicio" placeholder="Servicio" autocomplete="off" >
               
               </div>
             </div> 
<!-- ENTRADA PARA COMENTARIOS -->

               <div class="form-group">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevoComentario" placeholder="Comentarios del equipo" autocomplete="off" ></textarea>
               </div>
             </div>

             
              <input type="hidden" value="<?php echo $_SESSION['sucursal']; ?>" id="idSucursal" name="idSucursal">

              <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilId" name="perfilId">


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

<!--=====================================
MODAL EDITAR REPARACION
======================================-->

<div id="modalEditarReparacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Información de reparación</h4>

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

                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" autocomplete="off" required>


                  </div>


              </div>



                <!-- ENTRADA PARA TELEFONO -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-phone-square"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" autocomplete="off" required>

                  </div>
                  </div>
                  </div>


                <!-- ENTRADA PARA MARCA -->


                <!-- ENTRADA PARA MARCA-->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-id-badge"></i></span> 

                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca" placeholder="Marca" autocomplete="off">

                  </div>


              </div>



               <!-- ENTRADA PARA MODELO -->


                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" name="editarModelo" id="editarModelo" placeholder="Modelo" autocomplete="off">

                  </div>
                  </div>
                  </div>



             <!-- ENTRADA PARA COLOR -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-tint"></i></span> 

                    <input type="text" class="form-control input-lg" id="editarColor" name="editarColor" min="0" step="any" autocomplete="off" required>

                  </div>




              <!-- ENTRADA PARA Contraseña -->

                  <br>

                   <div class="col-xs-12" style="padding:0">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-unlock"></i></span> 

                    <input type="text" class="form-control input-lg" id="editarPass" name="editarPass" min="0" step="any" autocomplete="off" required>

                  </div>

                  </div>


                </div>

                <!-- ENTRADA PARA SERIE IMEI -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span> 

                    <input type="text" class="form-control input-lg" id="editarSerie" name="editarSerie" step="any" autocomplete="off" required>

                      
                      </div>

                    <br>

                     <!-- ENTRADA PARA COSTO -->

                  <div class="form-group row">

                    <div class="col-xs-12">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                    <input type="text" class="form-control input-lg" id="editarPrecio" name="editarPrecio" step="any" autocomplete="off" required>


                       </div>
                      </div>
                      </div>    
                

                 
                    <!-- Editar COMENTARIO-->
                     
                 </div>

               </div>
               <div class="form-group">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarComentario" id="editarComentario" autocomplete="off" required>
               </div>
             </div>


        <!-- Editar SERVICIO-->

               <div class="form-group">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <input type="text" class="form-control input-lg" name="editarServicio" id="editarServicio" placeholder="Servicio" autocomplete="off" >
               </div>
             </div> 

                                           <div class="col-md-12">
              <div class="form-group">
                <label>Riesgos</label>
                <select multiple class="form-control input-lg riesgosSelectEditarReparacion" id="riesgosSelectEditarReparacion" name="riesgosSelectEditarReparacion[]" data-placeholder="Selecciona los riesgos" style="width: 100%;" tabindex="-1" aria-hidden="true">

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
                $('.riesgosSelectEditarReparacion').select2()


              });

            </script>



          <!-- Editar ID REPARACION-->
                <input type="hidden" class="form-control input-lg" name="editarIdReparacion" id="editarIdReparacion">

             </div>
     
        </div>




        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>


  <?php
         if($_SESSION["perfil"] == "Administrador"){

         echo '<button type="button" class="btn btn-danger btnEliminarReparacion ">Eliminar</button>';
       }
       ?>


          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>


        <?php

          $ctrEditarReparacion = new ControladorReparaciones();
          $ctrEditarReparacion -> ctrEditarReparacion();

        ?>  

    </div>

  </div>

</div>

<!--=====================================
MODAL INFORMACION REPARACION
======================================-->

<div id="modalInformacionReparacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Info reparación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->




  <div class="form-group row">

      

    <br>

    <h1 id="infoNombre" class="text-center">Nombre Completo</h1>
    <h5 id="infoFecha" class="text-center">Fecha: </h5>
  
  

</div>

<div class="form-group row">

      <div class="col-xs-12">

     <dl class="dl-horizontal col-xs-6 col-sm-6">
    <dt>Contacto:</dt>
  <dd id="infoTelefono">...</dd>
</dl>


<dl class="dl-horizontal col-xs-6 col-sm-6">
    <dt>Color:</dt>
  <dd id="infoColor">...</dd>
</dl>

  <dl class="dl-horizontal col-xs-6 col-sm-6">
    <dt>Marca:</dt>
  <dd id="infoMarca">...</dd>
</dl>


<dl class="dl-horizontal col-xs-6 col-sm-6">
    <dt>Modelo:</dt>
  <dd id="infoModelo">...</dd>
</dl>


  <dl class="dl-horizontal col-xs-6 col-sm-6">
    <dt>Serie/IMEI:</dt>
  <dd id="infoSerie">...</dd>
</dl>


<dl class="dl-horizontal col-xs-6 col-sm-6">
    <dt>Contraseña:</dt>
  <dd id="infoPass">...</dd>
</dl>
    

    <dl class="dl-horizontal col-xs-6 col-sm-6">
    <dt>Servicio:</dt>
  <dd id="infoServicio">...</dd>
</dl>


<dl class="dl-horizontal col-xs-6 col-sm-6">
    <dt>Costo:</dt>
  <dd id="infoPrecio">...</dd>
</dl>

</div>
</div>


<div class="form-group row">

      <div class="col-xs-12">

<dl class="dl-horizontal ">
    <dt>Comentarios:</dt>
  <dd id="infoComentarios">...</dd>
</dl>

 <!--=====================================
      
        
<dl class="dl-horizontal ">
    <dt>Nota de reparación:</dt>
  <dd id="infoNotaReparacion">...</dd>
</dl>

<dl class="dl-horizontal ">
    <dt>Respuesta cliente:</dt>
  <dd id="infoRespuestaCliente">...</dd>
</dl>

<dl class="dl-horizontal ">
    <dt>Nota de garantía:</dt>
  <dd id="infoNotaGarantia">...</dd>
</dl>

======================================-->

<dl class="dl-horizontal ">
    <dt>Vigencia garantía:</dt>
  <dd id="infoVigencia">...</dd>
</dl>

<dl class="dl-horizontal ">
    <dt>Historial:</dt>
  <dd id="infoHistorial">...</dd>
</dl>





</div>
</div>

<div class="form-group row">


<dl class="dl-horizontal col-xs-6 col-sm-6 hidden">
    <dt>ID:</dt>
  <dd id="idReparacion">.1.</dd>
</dl>



</div>




    <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button> 

         <!--  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarFacturacion" data-dismiss="modal" btnFacturacion>Facturar</button> -->

         <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAnticipo" data-dismiss="modal" btnAgregarAnticipo>Anticipo</button>



 
 <?php
         if($_SESSION["perfil"] == "Administrador"){
    
          echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEditarReparacion" data-dismiss="modal" btnInfoReparacion>Configuración</button>';
        }
?>



        </div>

      </form>

      <?php

  $ctrEliminarReparacion = new ControladorReparaciones();
  $ctrEliminarReparacion -> ctrEliminarReparacion();

    ?>      

    </div>
  

  </div>

</div>





<!--=====================================
MODAL STATUS GENERICO
======================================-->

<div id="modalEstado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Actualizar Estado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

          <div class="box-body">


                <!-- ENTRADA PARA TELEFONO -->

                 

            

                <!-- ENTRADA PARA MARCA -->

              <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 
               

               <select class="form-control input-lg" name="editarStatus" id="editarStatus" required>

               <option value="0">Pendiente</option>
               <option value="1">En revisión</option>
               <option value="2">Listo</option>
               <option value="4">Garantía</option>
               <option value="5">No reparado</option>
               <option value="6">Contactar</option>
               <option value="7">Autorizado</option>
               <option value="8">No autorizado</option>
               <option value="9">Refacción</option>
               <option value="10">Por Confirmar</option>
                  

                </select>

              </div>

            </div>



              <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-commenting"   ></i></span> 

               <input type="text" class="form-control input-lg" name="editarEstado" id="editarEstado" autocomplete="off" required minlength="3">



                <!-- CASILLA OCULTA QUE INCLUYE EL ID DE LA REPARACIÓN NECESARIO PARA ACTUALIZAR DATOS, ID Y NAME TIENE EL ID  -->
               <input type="hidden"  name="actualizarId" id="actualizarId" required>

               <input type="hidden"  name="comentario1" id="comentario1" required>




              </div>

            </div>

          </div>
 </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>


          <button type="submit" class="btn btn-success btnActualizarEstado">Aplicar cambios</button>



        </div>

      </form>

      <?php

  $ctrActualizarEstado = new ControladorReparaciones();
  $ctrActualizarEstado -> ctrActualizarEstado();

    ?>      

    </div>


  </div>

</div>


<!--=====================================
MODAL ENTREGA REPARACION
======================================-->

<div id="modalEntregarReparacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Entrega de Reparación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



       

        <div class="modal-body">

          <div class="box-body">

                <!-- ENTRADA GARANTIA -->

               <div class="form-group">


  <div class="small-box bg-green">
    
    <div class="inner">
            
         
       
       <b>IMPORTE A COBRAR</b>
   
      <h3 name="importeTotal" id="importeTotal">...</h3>
       <h4 name="anticipoTotal" id="anticipoTotal">...</h4>
      <h4 id="servicioRealizado">...</h4>


    </div>
    
    <div class="icon">
      
      <i class="ion ion-paper-airplane"></i>
    
    </div>
    
    <a href="ventas" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>


                <b>ASIGNAR DÍAS DE GARANTÍA</b>
           
                <div class="input-group">


              
                <span class="input-group-addon"><i class="fa fa-map-marker"   ></i></span> 

               <input type="number" class="form-control input-lg" name="editarGarantia" id="editarGarantia" placeholder="Días de Garantía" min="0"autocomplete="off" required>


               <input type="hidden" class="form-control input-lg" name="idReparacionEntrega" id="idReparacionEntrega">

               <input type="hidden" class="form-control input-lg" name="modeloEntregado" id="modeloEntregado">

               <input type="hidden"  name="comentario2" id="comentario2" required>

               <input type="hidden"  name="importeTotal2" id="importeTotal2" required>

              </div>

            </div>
          </div>

</div>
         


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>


          <button type="submit" class="btn btn-success btnEntregar">Entregar</button>

        </div>

      </form>

      <?php

  $ctrActualizarEntregado = new ControladorReparaciones();
  $ctrActualizarEntregado -> ctrActualizarEntregado();

    ?>      

    </div>


  </div>

</div>

<!--=====================================
MODAL ACTUALIZAR PRECIO
======================================-->

<div id="modalActualizarPrecio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Actualizar Precio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



       

        <div class="modal-body">

          <div class="box-body">

                <!-- ENTRADA GARANTIA -->

               <div class="form-group">


  <div class="small-box bg-aqua">
    
    <div class="inner">
            
         
       
       <b name="servicioActual" id="servicioActual">Centro de carga</b>
   
      
     
      <h3 id="modeloActual"  >Huawei Y9s</h3>
      
       <h3  name="importeActual" id="importeActual"  >...</h3>
   


    </div>
    
    <div class="icon">
      
      <i class="ion ion-ipad"></i>
    
    </div>
    
    <a href="reparaciones" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

   
           
                <div class="input-group">


              
                <span class="input-group-addon"><i class="fa fa-wrench"   ></i></span> 

               <input type="text" class="form-control input-lg" name="editarServicioPrecio" id="editarServicioPrecio" autocomplete="off" required>
             </div>

              <br>
           
                <div class="input-group">


              
                <span class="input-group-addon"><i class="fa fa-comment"   ></i></span> 

               <input type="text" class="form-control input-lg" name="historialCambioPrecio" id="historialCambioPrecio" placeholder="Motivo de cambio" autocomplete="off" required>
             </div>

             <br>
                <div class="input-group">


              
                <span class="input-group-addon"><i class="fa fa-money"   ></i></span> 

               <input type="number" class="form-control input-lg" name="nuevoPrecioActualizar" id="nuevoPrecioActualizar" placeholder="Ingresar nuevo precio" min="0"autocomplete="off" required>


               <input type="hidden" class="form-control input-lg" name="idReparacionPrecio" id="idReparacionPrecio">

               <input type="hidden"  name="historialCompleto" id="historialCompleto" required>

               <input type="hidden"  name="importeActual2" id="importeActual2" required>

              </div>

            </div>
          </div>

</div>
         


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>


          <button type="submit" class="btn btn-success btnEntregar">Actualizar</button>

        </div>

      </form>

      <?php

  $ctrActualizarPrecio = new ControladorReparaciones();
  $ctrActualizarPrecio -> ctrActualizarPrecio();

    ?>      

    </div>


  </div>

</div>

 <!-- ===================
        AGREGAR FACTURACION
    ============================ -->

    <!-- Modal -->
<div id="modalAgregarFacturacion" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!-- ===================
        CABEZA DEL MODAL
    ============================ -->

      <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Factura</h4>
      </div>
      
      <!-- ===================
        CUERPO DE MODAL
    ============================ -->

      <div class="modal-body">
        
        <div class="box-body">

          <!-- ENTRADA VENTA -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <input type="number" class="form-control input-lg" name="nuevoNoVenta" placeholder="No. de venta" id="nuevoNoVenta" autocomplete="off" required>
              

            </div>

          </div>

        
          <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente">


                    <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div>

        
   

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-users"></i></span>

              <select class="form-control input-lg" name="nuevoUsoCFDI">
                
               
                <option value="Gastos Generales">Gastos Generales</option>
                <option value="Por definir">Por definir</option>
                <option value="Aquisición de mercancia">Aquisición de mercancia</option>
                <option value="Equipo de computo y accesorios">Equipo de computo y accesorios</option>
                <option value="Comunicaciones telefonicas">Comunicaciones telefonicas</option>


              </select>
              

            </div>

          </div>

          <input type="hidden" value="<?php echo $_SESSION['sucursal']; ?>" id="idSucursal" name="idSucursal">

         

          <!-- TERMINA -->


          <!-- TERMINA -->


        </div>

      </div>

      <!-- ===================
        PIE DE MODAL
    ============================ -->
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Registar</button>
      </div>

      <?php

      $crearFacturacion = new ControladorFacturacion();
      $crearFacturacion -> ctrCrearFacturacion();

      ?>

    </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" autocomplete="off" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar RFC" autocomplete="off" >

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" autocomplete="off" >

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" autocomplete="off" data-mask >

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" autocomplete="off" >

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask autocomplete="off">

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL ANTICIPO
======================================-->

<div id="modalAnticipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Anticipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">

          <div class="box-body">

                 <div class="info-box bg-aqua">
            <span class="info-box-icon bg-blue"><i class="ion ion-social-usd"></i></span>

            <div class="info-box-content">
                <span class="info-box-text" id="anticipoId"></span>
              <span class="info-box-text" id="anctipoDescripcion">Descripción</span>
              <span class="info-box-number" id="anticipoIncial">Total:</span>
            </div>
            <!-- /.info-box-content -->
          </div>



                <!-- ENTRADA PARA MARCA -->


              <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-money"   ></i></span> 

               <input type="number" class="form-control input-lg" name="ingresarAnticipo" id="ingresarAnticipo" autocomplete="off" placeholder="Ingresar cantidad"required>

               <input type="hidden" class="form-control input-lg" name="idReparacionAnticipo" id="idReparacionAnticipo">

               <input type="hidden" class="form-control input-lg" name="historialAnticipo" id="historialAnticipo">

              </div>

            </div>

          </div>
 </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Agregar anticipo</button>

        </div>

      </form>

      <?php

  $ctrAgregarAnticipo = new ControladorReparaciones();
  $ctrAgregarAnticipo -> ctrAgregarAnticipo();

    ?>      

    </div>


  </div>

</div>




