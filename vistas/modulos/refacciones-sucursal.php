<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar refacciones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar refacciones</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

  
        <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#modalAgregarRefaccion">
          
           Agregar refacción

        </button>

        
        
           
        <button class="btn btn-primary pull-right btnConfigurarNota fa fa-users" style="margin-left:5px" onclick="location.href='refacciones'"></button>


        <button class="btn btn-warning pull-right" style="margin-left:5px" onclick="location.href='categorias-refacciones'">
          
          Categorías
       
        </button>

        
<!-- 
     <button class="btn btn-primary pull-right" style="margin-left:5px" onclick="location.href='refacciones'">
          
          Refacciones General
       
        </button>
 -->

      </div>

    


      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaRefaccionesSucursal" width="100%">
         
        <thead>

            <tr>
              <th>Sección</th>
              <th>Código</th>
              <th>Refacción</th>
              <th>Modelo</th>
              <th>Descripción</th>
              <th>Estado</th>
              <th>Stock</th>
              <th>Acciones</th>
            </tr> 

        </thead>


       </table>

      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL AGREGAR REFACCIONES
======================================-->

<div id="modalAgregarRefaccion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">



    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar refaccion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaCategoriaRefaccion" name="nuevaCategoriaRefaccion" required>
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorRefacciones::ctrMostrarCategoriasRefacciones($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group row ">
            
             <div class="input-group">

                <input type="hidden" class="form-control input-lg" id="nuevoCodigoRefaccion" name="nuevoCodigoRefaccion" >

              
            </div>
            </div>

        


            <!-- ENTRADA PARA LA MARCA MODELO -->

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
              <br>
              

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

            <div class="col-xs-12 col-sm-6">
             <div class="input-group">

               

             <span class="input-group-addon"><i class="fa fa-repeat"></i></span>

              <select class="form-control input-lg" name="nuevoModeloSelecionado" id="nuevoModeloSelecionado" >
                
                <option value="">Modelo</option>


                
     
              </select>

              
            </div>
            </div>
          </div>

            
 <!-- ENTRADA PARA EL ESTADO -->

             <div class="form-group row">

              <div class="col-xs-12 col-sm-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span>

              <select class="form-control input-lg" name="nuevoCondicionRefaccion" id="nuevoCondicionRefaccion">
                
                <option value="">Condicion</option>
                <option value="Nuevo">Nuevo</option>
                <option value="Nuevo Genérico">Nuevo Genérico</option>
                <option value="Nuevo Original">Nuevo Original</option>
                <option value="Uso">Uso</option>
                <option value="Uso Genérico">Uso Genérico</option>
                <option value="Uso Original">Uso Original</option>

              </select>

              </div>

            </div>


              <div class="col-xs-12 col-sm-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span>

              <select class="form-control input-lg" id="nuevaVariante" name="nuevaVariante">
                  
                  <option value="">Variante</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorRefacciones::ctrMostrarVariantesRefacciones($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["variante"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

          </div>



           

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             

               <div class="form-group row">
             <div class="col-xs-12 col-sm-12">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcionRefaccion" id="nuevaDescripcionRefaccion" placeholder="Ingresar descripción" autocomplete="off">

              
                <input type="hidden" value="<?php echo $_SESSION['sucursal']; ?>" id="idSucursal" name="idSucursal">

                 <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilId" name="perfilId">



              </div>



            </div>
          </div>


          


             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoStockRefaccion" min="0" placeholder="Stock" required>

              </div>

            </div>

            
            <!-- ENTRADA PARA SUBIR FOTO -->

             <!-- <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="150px">

            </div> -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>

        <?php

          $crearRefaccion = new ControladorRefacciones();
          $crearRefaccion -> ctrCrearRefaccion();

        ?>  

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR REFACCIONES
======================================-->

<div id="modalEditarRefaccion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar refaccion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group row ">
            
             <div class="input-group">

                <input type="hidden" class="form-control input-lg" id="idEditarRefaccion" name="idEditarRefaccion" >
              
              </div>
            </div>

      
        <!-- ENTRADA PARA EL ESTADO -->

             <div class="form-group row">

              <div class="col-xs-12 col-sm-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span>

              <select class="form-control input-lg" name="editarEstadoRefaccion" id="editarEstadoRefaccion">
                
                <option value="">Condicion</option>
                <option value="Nuevo">Nuevo</option>
                <option value="Nuevo Genérico">Nuevo Genérico</option>
                <option value="Nuevo Original">Nuevo Original</option>
                <option value="Uso">Uso</option>
                <option value="Uso Genérico">Uso Genérico</option>
                <option value="Uso Original">Uso Original</option>

              </select>

              </div>

            </div>

      

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="col-xs-12 col-sm-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDescripcionRefaccion" id="editarDescripcionRefaccion" placeholder="Ingresar descripción" autocomplete="off" required>

              </div>

            </div>
          </div>


             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" name="editarStockRefaccion" id="editarStockRefaccion" min="0" placeholder="Stock" required>

              </div>

            </div>

            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar refaccion</button>

        </div>

      </form>

        <?php

          $editarRefaccion = new ControladorRefacciones();
          $editarRefaccion -> ctrActualizarRefaccion();

        ?>  

    </div>

  </div>

</div>



<!--=====================================
MODAL SUMAR STOCK
======================================-->

<div id="modalSumarStock" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Actualizar stock</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span> 

                <input type="number" class="form-control input-lg" id="stockEditarRefaccion" name="stockEditarRefaccion" placeholder="Ingresar nuevo stock" min="0" autocomplete="off" required>

                <input type="hidden" value="" id="idRefaccionEditar" name="idRefaccionEditar">

            

              </div>

            </div>

          </div>
        </div>
        
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar stock</button>

        </div>

      </form>

        <?php

          $actualizarStock = new ControladorRefacciones();
          $actualizarStock -> ctrActualizarStockRefaccion();

        ?>  

    </div>

  </div>

</div>

<?php

  $eliminarRefaccion = new ControladorRefacciones();
  $eliminarRefaccion -> ctrEliminarRefaccion();

?>    







