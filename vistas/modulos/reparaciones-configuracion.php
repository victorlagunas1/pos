



<div class="content-wrapper">



  <section class="content-header">

    
    <h1>
      
      Configuración Reparaciones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Configuración Reparaciones</li>
    
    </ol>

  </section>

  
  <section class="content">
    <div class="row">

        <div class="col-md-6 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <a class="pull-right"><h3>Reparaciones </h3></a>

  
        <button class="btn btn-info" data-toggle="modal" data-target="#modalAgregarReparacion">
          
          Agregar

        </button>


      </div>
      
      <div class="box-body">
        
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
              <th>ID</th>
              <th>Reparación</th>
              <th>Descripción</th>
              <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

            $tabla = "reparaciones_id";
            
            $item = null;
            $valor = null;
            $orden = "reparacion";

            $dispo = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

    

        foreach ($dispo as $key => $value){
        


    echo ' <tr>
                  <td>'.$value["id"].'</td>
                  <td>'.$value["reparacion"].'</td>
                  <td>'.$value["descripcion"].'</td>

                   <td>  

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarReparacionConfig" idReparacion="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarReparacion"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarReparación" idReparacion="'.$value["id"].'"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
            
          
        }

            ?>

        

        </tbody>



       </table>



      </div>

    </div>

  </div>



  <div class="col-md-6 col-xs-12">
    <div class="box box-danger">

      <div class="box-header with-border">

         <a class="pull-right text-red"><h3>Riesgos </h3></a>
  
        <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarRiesgo">
          
          Agregar

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>ID</th>
           <th>Riesgo</th>
           <th>Descripción</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $tabla = "reparaciones_riesgo";
            
            $item = null;
            $valor = null;
            $orden = "riesgo";

            $riesgo = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);


          foreach ($riesgo as $key => $value) {
           
            echo ' <tr>

                    <td>'.$value["id"].'</td>
                     <td>'.$value["riesgo"].'</td>
                      <td>'.$value["descripcion"].'</td>

                    

  

            
                   <td>

                   <div class="btn-group">';
                        
                   if($_SESSION["perfil"] == "Administrador"){

                       echo '
                       

                        <button class="btn btn-warning btnEditarRiesgo" idRiesgo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarRiesgo"><i class="fa fa-pencil"></i></button>



                        <button class="btn btn-danger btnEliminarRiesgo" idRiesgo="'.$value["id"].'"><i class="fa fa-times"></i></button> ';}

                     echo' </div>  

                    </td>

                  </tr>';
          }

        ?>

        

        </tbody>



       </table>

</div>
</div>
</div>

</div>

</section>


<section class="content">
    <div class="row">


  <div class="col-md-6 col-xs-12">
    <div class="box box-warning">

      <div class="box-header with-border">
          <a class="pull-right text-yellow"><h3>Disponibilidad </h3></a>
  
  
        <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarDisponibilidad">
          
          Agregar

        </button>

      </div>
      
      <div class="box-body">
        
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
              <th>ID</th>
              <th>Disponibilidad</th>
              <th>Descripción</th>
              <th>Anticipo</th>
              <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

            $tabla = "reparaciones_disponibilidad";
            
            $item = null;
            $valor = null;
            $orden = "disponibilidad";

            $dispo = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

    

        foreach ($dispo as $key => $value){
        


    echo ' <tr>
                  <td>'.$value["id"].'</td>
                  <td>'.$value["disponibilidad"].'</td>
                  <td>'.$value["descripcion"].'</td>';
                  

                  if($value["anticipo"] == "Si"){

                    echo '<td><button class="btn btn-success btnActivarDispo" idDisponibilidad="'.$value["id"].'" estadoDispo="0">Si</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btnActivarDispo" idDisponibilidad="'.$value["id"].'" estadoDispo="1">No</button></td>';

                  }  
       
           


            echo '

                   <td>  

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarDisponibilidad" idDisponibilidad="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarDisponibilidad"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarDisponibilidad" idDisponibilidad="'.$value["id"].'"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
            
          
        }

            ?>

        

        </tbody>



       </table>



      </div>

    </div>

  </div>


  <div class="col-md-6 col-xs-12">
    <div class="box box-success">

      <div class="box-header with-border">
          <a class="pull-right text-green"><h3>Garantía</h3></a>
  
  
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarGarantia">
          
          Agregar

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>ID</th>
           <th>Garantía</th>
           <th>Condiciones</th>
           <th>Días</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

           $tabla = "reparaciones_garantia";
            
            $item = null;
            $valor = null;
            $orden = "garantia";

            $garantia = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

          foreach ($garantia as $key => $value) {
           
            echo ' <tr>

                    <td>'.$value["id"].'</td>
                     <td>'.$value["garantia"].'</td>
                      <td>'.$value["condiciones"].'</td>
                       <td>'.$value["dias"].'</td>

                  
            
                   <td>

                   <div class="btn-group">';
                        
                   if($_SESSION["perfil"] == "Administrador"){

                       echo '
                     
                        <button class="btn btn-warning btnEditarGarantia" idGarantia="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarGarantia"><i class="fa fa-pencil"></i></button>



                        <button class="btn btn-danger btnEliminarGarantia" idGarantia="'.$value["id"].'"><i class="fa fa-times"></i></button> ';}

                     echo' </div>  

                    </td>

                  </tr>';
          }

        ?>

        

        </tbody>



       </table>

</div>
</div>
</div>



  </section>


<section class="content">
    <div class="row">


  <div class="col-md-6 col-xs-12">
    <div class="box box-primary">

      <div class="box-header with-border">
          <a class="pull-right text-blue"><h3>Tiempo de reparación </h3></a>
  
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTiempo">
          
          Agregar

        </button>

      </div>
      
      <div class="box-body">
        
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
              <th>ID</th>
              <th>Tiempo</th>
              <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

            $tabla = "reparaciones_tiempo";
            
            $item = null;
            $valor = null;
            $orden = "tiempo";

            $tiempo = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

    

        foreach ($tiempo as $key => $value){
        


    echo ' <tr>   <td>'.$value["id"].'</td>
                  <td>'.$value["tiempo"].'</td>

                   <td>  

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarTiempo" idTiempo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarTiempo"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarTiempo" idTiempo="'.$value["id"].'"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
            
          
        }

            ?>

        

        </tbody>



       </table>



      </div>

    </div>

  </div>


  <div class="col-md-6 col-xs-12">
    <div class="box box-danger">

      <div class="box-header with-border">
          <a class="pull-right text-red"><h3>Estado previo del equipo</h3></a>
  
  
        <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarEstado">
          
          Agregar

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>ID</th>
           <th>Estado</th>
           <th>Descripción</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

           $tabla = "reparaciones_estado";
            
            $item = null;
            $valor = null;
            $orden = "estado";

            $garantia = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden);

          foreach ($garantia as $key => $value) {
           
            echo ' <tr>

                    <td>'.$value["id"].'</td>
                     <td>'.$value["estado"].'</td>
                      <td>'.$value["descripcion"].'</td>
                      
                  
            
                   <td>

                   <div class="btn-group">';
                        
                   if($_SESSION["perfil"] == "Administrador"){

                       echo '
                     
                        <button class="btn btn-warning btnEditarEstado" idEstado="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarEstado"><i class="fa fa-pencil"></i></button>



                        <button class="btn btn-danger btnEliminarEstado" idEstado="'.$value["id"].'"><i class="fa fa-times"></i></button> ';}

                     echo' </div>  

                    </td>

                  </tr>';
          }

        ?>

        

        </tbody>



       </table>

</div>
</div>
</div>



  </section>


</div>




<!--=====================================
MODAL AGREGAR REPARACION
======================================-->

<div id="modalAgregarReparacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar reparación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaReparacion" placeholder="Ingresar reparacion" autocomplete="off" required>

              </div>

            </div>


             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevoComentario" placeholder="Comentarios del equipo" autocomplete="off" ></textarea>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>

        <?php

          $crearCategoria = new ControladorCotizaciones();
          $crearCategoria -> ctrCrearReparacionConfiguracion();

        ?>

      </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL EDITAR REPARACION
======================================-->

<div id="modalEditarReparacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar reparación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <input type="text" class="form-control input-lg" name="editarReparacion" id="editarReparacion" placeholder="Ingresar reparacion" autocomplete="off" required>

              </div>

            </div>


             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="editarComentario" id="editarComentario" placeholder="Comentarios del equipo" autocomplete="off" ></textarea>

               
                <input type="hidden"  name="idReparacionEditar" id="idReparacionEditar" required>

              </div>

            </div>


            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      <?php

          $editarReparacion = new ControladorCotizaciones();
          $editarReparacion -> ctrEditarReparacionConfiguracion();

        ?> 

      </form>

    </div>

  </div>

</div>


  <?php

          $borrarReparacion = new ControladorCotizaciones();
          $borrarReparacion -> ctrEliminarReparacionConfiguracion();

  ?>




<!--=====================================
MODAL AGREGAR RIESGOS
======================================-->

<div id="modalAgregarRiesgo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background-color:red; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Riesgo </h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoRiesgo" placeholder="Ingresar riesgo" autocomplete="off" required>

              </div>

            </div>


             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevaDescripcionRiesgo" placeholder="Descripción del riesgos" autocomplete="off" ></textarea>

               
               

              </div>

            </div>


            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-danger">Agregar</button>

        </div>

      <?php

          $agregarRiesgo = new ControladorCotizaciones();
          $agregarRiesgo -> ctrCrearRiesgoConfiguracion();

        ?> 

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR RIESGO 
======================================-->

<div id="modalEditarRiesgo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

       <div class="modal-header" style="background-color:red; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Riesgo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 

                <input type="text" class="form-control input-lg" name="editarRiesgo" id="editarRiesgo" autocomplete="off" required>


              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="editarDescripcionRiesgo" id="editarDescripcionRiesgo"  placeholder="Descripción del riesgos" autocomplete="off" ></textarea>


                <input type="hidden"  name="idRiesgo" id="idRiesgo" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar marca</button>

        </div>

        <?php

          $editarRiesgo = new ControladorCotizaciones();
          $editarRiesgo -> ctrEditarRiesgoConfiguracion();

        ?>

      </form>

    </div>

  </div>

</div>

  <?php

          $borrarRiesgo = new ControladorCotizaciones();
          $borrarRiesgo -> ctrEliminarRiesgoConfiguracion();

  ?>




<!--=====================================
MODAL AGREGAR DISPONIBILIDAD
======================================-->

<div id="modalAgregarDisponibilidad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background-color:orange; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Disponibilidad </h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDisponibilidad" placeholder="Ingresar disponibilidad" autocomplete="off" required>

              </div>

            </div>


             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevoDescripcionDisponibilidad" placeholder="Descripción" autocomplete="off" ></textarea>


              </div>

            </div>


            <div class="form-group">
              <h4>¿Se requiere anticipo?</h4>
                  <div class="radio">
                    <label>
                      <input type="radio" name="opcionAnticipo" id="opcionAnticipo" value="Si" >
                      Si
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="opcionAnticipo" id="opcionAnticipo" value="No" checked="">
                      No
                    </label>
                  </div>
                 
                </div>


            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-warning">Agregar</button>

        </div>

      <?php

          $agregarAnticipo = new ControladorCotizaciones();
          $agregarAnticipo -> ctrCrearDisponibilidadConfiguracion();

        ?> 

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR DISPONIBILIDAD 
======================================-->

<div id="modalEditarDisponibilidad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

       <div class="modal-header" style="background-color:orange; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Disponibilidad</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDisponibilidad" id="editarDisponibilidad"autocomplete="off" required>


              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="editarDescripcionDisponibilidad" id="editarDescripcionDisponibilidad"  placeholder="Descripción" autocomplete="off" ></textarea>


                <input type="hidden"  name="idDisponibilidad" id="idDisponibilidad" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-warning">Guardar</button>

        </div>

        <?php

          $editarDisponibilidad = new ControladorCotizaciones();
          $editarDisponibilidad -> ctrEditarDisponibilidadConfiguracion();

        ?>

      </form>

    </div>

  </div>

</div>

  <?php

          $borrarDisponibilidad = new ControladorCotizaciones();
          $borrarDisponibilidad -> ctrEliminarDisponibilidadConfiguracion();

  ?>




<!--=====================================
MODAL AGREGAR GARANTIA
======================================-->

<div id="modalAgregarGarantia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background-color:green; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Garantía </h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoGarantia" placeholder="Ingresar lapso garantía" autocomplete="off" required>

              </div>

            </div>


             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevoDescripcionGarantia" placeholder="Descripción" autocomplete="off" ></textarea>


              </div>

            </div>

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoDiasGarantia" placeholder="Días de garantía" autocomplete="off" min="0"></input>


              </div>

            </div>


            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Agregar</button>

        </div>

      <?php

          $agregarGarantia = new ControladorCotizaciones();
          $agregarGarantia -> ctrCrearGarantiaConfiguracion();

        ?> 

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR GARANTIA 
======================================-->

<div id="modalEditarGarantia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

       <div class="modal-header" style="background-color:green; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Garantía</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 

                <input type="text" class="form-control input-lg" name="editarGarantia" id="editarGarantia"autocomplete="off" required>


              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="editarGarantiaDescripcion" id="editarGarantiaDescripcion"  placeholder="Descripción" autocomplete="off" ></textarea>


                <input type="hidden"  name="idGarantia" id="idGarantia" required>

              </div>

            </div>



            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 

                <input type="number" class="form-control input-lg" name="editarGarantiaDias" id="editarGarantiaDias"autocomplete="off" min="0" required>


              </div>

            </div>

  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar</button>

        </div>

        <?php

          $editarGarantia = new ControladorCotizaciones();
          $editarGarantia -> ctrEditarGarantiaConfiguracion();

        ?>

      </form>

    </div>

  </div>

</div>


<?php

          $borrarGarantia = new ControladorCotizaciones();
          $borrarGarantia -> ctrEliminarGarantiaConfiguracion();

?>


<!--=====================================
MODAL AGREGAR Tiempo
======================================-->

<div id="modalAgregarTiempo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background-color:navy; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Tiempo </h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTiempo" id="nuevoTiempo"  placeholder="Ingresar Tiempo" autocomplete="off" required>

              </div>

            </div>

            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Agregar</button>

        </div>

      <?php

          $agregarTiempo = new ControladorCotizaciones();
          $agregarTiempo -> ctrCrearTiempoConfiguracion();

        ?> 

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR Tiempo 
======================================-->

<div id="modalEditarTiempo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

       <div class="modal-header" style="background-color:navy; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Tiempo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTiempo" id="editarTiempo" autocomplete="off" required>
                <input type="hidden"  name="idTiempo" id="idTiempo" required>


              </div>

            </div>

  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>

        <?php

          $editarTiempo = new ControladorCotizaciones();
          $editarTiempo -> ctrEditarTiempoConfiguracion();

        ?>

      </form>

    </div>

  </div>

</div>

  <?php

          $borrarTiempo = new ControladorCotizaciones();
          $borrarTiempo -> ctrEliminarTiempoConfiguracion();

  ?>


<!--=====================================
MODAL AGREGAR Estado
======================================-->

<div id="modalAgregarEstado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background-color:red; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Estado </h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoEstado" placeholder="Ingresar Estado" autocomplete="off" required>

              </div>

            </div>


             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevoDescripcionEstado" placeholder="Descripción" autocomplete="off" ></textarea>


              </div>

            </div>


            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-danger">Agregar</button>

        </div>

      <?php

          $agregarEstado = new ControladorCotizaciones();
          $agregarEstado -> ctrCrearEstadoConfiguracion();

        ?> 

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR Estado 
======================================-->

<div id="modalEditarEstado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

       <div class="modal-header" style="background-color:red; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Estado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 

                <input type="text" class="form-control input-lg" name="editarEstado" id="editarEstado"autocomplete="off" required>


              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <textarea type="text" class="form-control input-lg" name="editarDescripcionEstado" id="editarDescripcionEstado"  placeholder="Descripción" autocomplete="off" ></textarea>


                <input type="hidden"  name="idEstado" id="idEstado" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-danger">Guardar</button>

        </div>

        <?php

          $editarEstado = new ControladorCotizaciones();
          $editarEstado -> ctrEditarEstadoConfiguracion();

        ?>

      </form>

    </div>

  </div>

</div>

  <?php

          $borrarEstado = new ControladorCotizaciones();
          $borrarEstado -> ctrEliminarEstadoConfiguracion();

  ?>












