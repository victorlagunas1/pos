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




 <div class="box-body">

  <div class="row">



        



                


                 <!-- ENTRADA PARA LA MARCA MODELO -->

          
          <div class="col-xs-12 col-sm-3" >
            <h3>Seleccionar marca</h3>
             <div class="input-group" >

               

              <span class="input-group-addon"><i class="fa fa-repeat" ></i></span>

              <select class="form-control input-lg" name="marcaSeleccionadaCotizacion" id="marcaSeleccionadaCotizacion">


                 <?php

                      
                           echo '<option value="">Marca</option>';

                   
                      $item = null;
                      $valor = null;

                      $marca = ControladorCategorias::ctrMostrarMarcas($item, $valor);


                       foreach ($marca as $key => $value)

                        {


                         echo '<option value="'.$value["id"].'">'.$value["marca"].'</option>';



                       };

                    ?>
     
              </select>
            </div>
            </div>


                <div class="col-xs-12 col-sm-5" >
      <h3>Buscar modelo</h3>
      <form role="form" method="post" enctype="multipart/form-data">
       

        <div class="input-group">
          <input class="input-lg" type="text" class="form-control" placeholder="Buscar modelo..." autocomplete="off" list="listaModelos" name="buscarModelo" id="buscarModelo" size="35" autofocus>
             
        </div>


      </form>

      <datalist id="listaModelos">

       <?php 

       $tabla = "modelos";
       $item = null;
       $valor = null;

        $respuesta = ModeloCategorias::mdlMostrarModelos($tabla, $item, $valor);

        foreach ($respuesta as $key => $value) {

    $tabla = "marcas";
    $item = "id";
    $valor = $value["id_marca"];

    $respuesta = ModeloCategorias::mdlMostrarMarcas($tabla, $item, $valor);


        

          //echo '<option value="'.$value["codigo"].'">'.$respuesta["marca"]." ".$value["modelo"].'</option>';   
       

        echo '<option data-value="'.$value["id"].'" value="'.$respuesta["marca"]." ".$value["modelo"].'"></option>';

      
   }

        ?> 

    


      </datalist>


                
            
          </div>
      
        

           

               <script>
  $(document).ready(function(e){

  $("#marcaSeleccionadaCotizacion").change(function(){
    //var idMarcaModelo = "idMarcaModelo="+$("#marcaSeleccionadaCotizacion").val();

     window.location = "index.php?ruta=cotizaciones-vistas&idMarca="+$("#marcaSeleccionadaCotizacion").val();

              })

  $("#buscarModelo").change(function(){

    var value = $('#buscarModelo').val();
  
    var valor = $('#listaModelos [value="' + value + '"]').data('value');

    if (valor !== undefined ){
     
     window.location = "index.php?ruta=vista-modelo&idModelo="+valor;

      }
              })

            })
                </script>





   




<?php if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Administrador de Sucursal"){


                 echo' <div class="box-body pull-right">
              
              <a class="btn btn-app bg-aqua" href="reparaciones-configuracion" style="margin:0px 5px 0px 0px">
                <i class="fa fa-gear"></i> Configuración
              </a>
              
            
            </div>';

          }
?>

          </div>
       

     




                 <!-- FIN PARA LA MARCA MODELO -->




      </div>


        <div class="row">



         


    <div class="col-md-12 col-xs-12">

      <div class="box-body">

      

      
      


      <?php 




      if(isset($_GET["idMarca"])){

      $item = "id_marca";
      $valor = $_GET["idMarca"];

      $modelo1 = ControladorCategorias::ctrMostrarModelosEspecifico($item, $valor);

      $item = "id";
      $valor = $_GET["idMarca"];

      $marca = ControladorCategorias::ctrMostrarMarcas($item, $valor);  

      echo '<h3>Modelos <b>'.$marca["marca"].'</b></h3>';

     
      } else {


      $item = null;
      $valor = null;

      $modelo1 = ControladorCategorias::ctrMostrarModelosEspecifico($item, $valor); 

      echo '<h3>Todos los Modelos</h3>';

    }

     
         foreach ($modelo1 as $key => $modelo) {

      $item = "id";
      $valor = $modelo["id_marca"];

      $marca = ControladorCategorias::ctrMostrarMarcas($item, $valor); 

      
      $tabla = "reparaciones_cotizacion";
      $item = "id_modelo";
      $valor = $modelo["codigo"];
      $orden = null;

      $reparacionesModelos = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor, $orden); 


        

        echo '
        

         <button type="button" class="btn btn-default btnCotizacionModelo" idModelo="'.$modelo["id"].'" style="margin:5px 5px 5px 5px; width:200px;" ><i> <span class="pull-right badge bg-red">'.count($reparacionesModelos).'</span> 

            <img async src="'.$modelo["imagen"].'" class="img-thumbnail" alt="user" width="120px"></i> 

            <h3 style="text-align:center; line-height:30px;"><b >'.$marca["marca"]."<br>".$modelo["modelo"].'</b></h3>

            <br>


            </button>


        ';

      }

      
        ?>

      </div>
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





