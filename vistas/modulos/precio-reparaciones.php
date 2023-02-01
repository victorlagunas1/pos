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
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCotizacion">
          
          Agregar cotización

        </button>

         <button class="btn btn-warning pull-right " onclick="location.href='cotizacion-cliente'">
          
          Generar cotización
        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive " width="100%">
         

        <tbody>
          

          <tbody>


            <?php

             $item = null;
            $valor = null;

           // $cotizaciones = ControladorCotizaciones::ctrMostrarCotizaciones($item, $valor); 
               $marcas = ControladorCategorias::ctrMostrarMarcas($item, $valor); 

      

        foreach ($marcas as $key => $value){
          

            $item = "id_marca";
            $valor = $value["id"];
            

           // $cotizaciones = ControladorCotizaciones::ctrMostrarCotizaciones($item, $valor); 
               $modelos = ControladorCategorias::ctrMostrarModelosMarca($item, $valor); 


    echo ' <tr>
    
                  <button type="button" class="btn btn-lg btn-block" style="margin:5px 5px 5px 5px"> <h3>'.$value["marca"].'</h3> <span class="badge pull-right">'.count($modelos).'</span> </button>


                </tr>';
            
          
        }

            ?>
              

          </tbody>



            


        </tbody>

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





