

<div class="content-wrapper">



  <section class="content-header">

    
    <h1>
      
      Administrar categorías
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar categorías</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">

  <div class="col-md-6 col-xs-12">
     <h3> Categorías </h3>

    <div class="box box-primary">


      <div class="box-header with-border">

  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          
          Agregar categoría

        </button>

      </div>
      
      <div class="box-body">
        
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Categoria</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

          foreach ($categorias as $key => $value) {
           
        $categoria = $value["id"];
          $sucursal = $_SESSION["sucursal"];

          $categorias2 = ControladorProductos::ctrMostrarProductosSucursalCategoriaSucursal($categoria, $sucursal);
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                  

                    <td class="text">'.$value["categoria"].'<span class="label label-warning pull-right">'.count($categorias2).'</span></td>

            
                   <td>

                   <div class="btn-group">';

                   echo '<button class="btn btn-success btnAgregarProductoCat" idCategoria="'.$value["id"].'" idCategoria2="'.$value["id"].'" data-toggle="modal" data-target="#modalAgregarProductoCat"><i class="fa fa-plus"></i></button>';
                        
                   if($_SESSION["perfil"] == "Administrador"){

                       echo '
                       <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"><i class="fa fa-times"></i></button> ';}

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

  <div class="col-md-6 col-xs-12">
    <h3> Diseño o Color </h3>
    <div class="box box-info">

      <div class="box-header with-border">
  
        <button class="btn btn-info" data-toggle="modal" data-target="#modalNuevoDiseño">
          
          Agregar diseño/color

        </button>



      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Diseño/Color</th>
           <th>Acciones</th>
    
         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $categorias = ControladorCategorias::ctrMostrarDiseño($item, $valor);

          foreach ($categorias as $key => $value) {
           
            echo ' <tr>

             <td>'.$value["id"].'</td>
                    <td>'.$value["diseño"].'</td>

                   
                   <td>

                   <div class="btn-group">';
                        
                   if($_SESSION["perfil"] == "Administrador"){

                       echo '<button class="btn btn-warning btnEditarColor" idDiseño="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarDiseño"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarColor" idDiseño="'.$value["id"].'"><i class="fa fa-times"></i></button> ';}

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

</div>



<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoría" autocomplete="off" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar categoría</button>

        </div>

        <?php

          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();

        ?>

      </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

                 <input type="hidden"  name="idCategoria" id="idCategoria" required>

              </div>

            </div>


              <!-- ENTRADA PARA DIAS DE GARANTIA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDiasGarantia" id="editarDiasGarantia" required>

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

          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();

        ?> 

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR DISEÑO
======================================-->

<div id="modalNuevoDiseño" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar diseño o color</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoColor" placeholder="Ingresar diseño" autocomplete="off" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar diseño</button>

        </div>

        <?php

          $crearColor = new ControladorCategorias();
          $crearColor -> ctrCrearColor();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR DISEÑO
======================================-->

<div id="modalEditarDiseño" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar diseño</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarColor" id="editarColor"autocomplete="off" required>

                <input type="hidden"  name="idColorEditar" id="idColorEditar" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar</button>

        </div>

        <?php

          $editarColor = new ControladorCategorias();
          $editarColor -> ctrEditarColor();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarColor = new ControladorCategorias();
  $borrarColor -> ctrBorrarColor();

?>


<?php

  $borrarMarca = new ControladorCategorias();
  $borrarMarca -> ctrBorrarMarca();

?>



<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProductoCat" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCategoria2" id="nuevaCategoria2" placeholder="Ingresar descripción" readonly>

                <input type="hidden" id="nuevaCategoria1" name="nuevaCategoria1">

            
              </div>



            </div>

       
                    <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <span class="input-group-addon" >
                          <input type="checkbox" id="escanerCodigo2" name="escanerCodigo2" value="0" checked=""> Generar código
                        </span>

                <input type="text" class="form-control input-lg" id="nuevoCodigo2" name="nuevoCodigo2" placeholder="Ingresar código" required autocomplete="off" readonly>

              </div>

            </div>


            <!-- ENTRADA PARA LA MARCA MODELO -->

                    <div class="form-group row ">
          <div class="col-xs-12 col-sm-6">
             <div class="input-group">

               

              <span class="input-group-addon"><i class="fa fa-repeat"></i></span>

              <select class="form-control input-lg" name="marcaSeleccionada2" id="marcaSeleccionada2">



                
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

            <div class="col-xs-12 col-sm-6">
             <div class="input-group">

               

              <span class="input-group-addon"><i class="fa fa-repeat"></i></span>

              <select class="form-control input-lg" name="nuevoModeloSelecionado2" id="nuevoModeloSelecionado2" >
                
                <option value="">Modelo</option>




            <?php

                  $item = null;
                      
                  $valor = null;
                    


               $categorias = ControladorCategorias::ctrMostrarModelosEspecifico($item, $valor);

                       foreach ($categorias as $key => $value)

                        {

                         echo '<option value="'.$value["codigo"].'">'.$value["modelo"].'</option>';

                       };

                    ?>

     
              </select>

              <script>console.log("hola");</script>
            </div>
            </div>
          </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion2" id="nuevaDescripcion2" placeholder="Ingresar descripción" autocomplete="off" required>

                

              
                <input type="hidden" value="<?php echo $_SESSION['sucursal']; ?>" id="idSucursal2" name="idSucursal2">

                 <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilId2" name="perfilId2">



              </div>



            </div>


             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoStock2" min="0" placeholder="Stock" required>

              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6" >
                
                  <div class="input-group" hidden>
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up" hidden></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta2" name="nuevoPrecioVenta2" min="0" step="any" placeholder="Precio de venta" required>

                  </div>

              <!-- ENTRADA PARA PRECIO PLAZA -->

                  <br>

                   <div class="col-xs-12" style="padding:0">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-handshake-o"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioPlaza2" name="nuevoPrecioPlaza2" min="0" step="any" placeholder="Precio de plaza" required>

                  </div>

                  </div>


                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-12 col-sm-6" hidden>
                
                  <div class="input-group" >
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra2" name="nuevoPrecioCompra2" min="0" step="any" placeholder="Precio de compra" >

                  </div>


                
                  <br>



                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje">
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje2" min="0">

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>



            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen2" name="nuevaImagen2">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="150px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

         <?php

          $ctrCrearProductoCategoria = new ControladorProductos();
          $ctrCrearProductoCategoria -> ctrCrearProductoCategoria();

        ?>  

      </form>

       

    </div>

  </div>

</div>


<?php

  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();

?>





