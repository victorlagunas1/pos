<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar productos 
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

         <button class="btn btn-primary pull-right btnConfigurarNota fa fa-users"  onclick="location.href='productos-total'"></button>
  
        <button class="btn btn-primary " data-toggle="modal" data-target="#modalAgregarProducto">
          
          Agregar producto

        </button>



         <button class="btn btn-warning " data-toggle="modal" data-target="#modalAgregarStock">
          
          Agregar stock

        </button>

        <button class="btn btn-info pull-right btnConfigurarNota fa fa-image"  data-toggle="modal" data-target="#modalFotoProducto"></button>



        <button class="btn btn-danger pull-right btnConfigurarNota fa fa-file-pdf-o"  data-toggle="modal" data-target="#modalPdfCategorias"></button>

        

        

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
         
        <thead>

            <tr>

              
              <th>Codigo</th>
            
              <th>Stock</th> 
              <th>Categoría</th>
              <th>Modelo</th>
              <th>Descripción</th>
              <th>Precio Venta</th>
              <th>Acciones</th>
            </tr> 

        </thead>


       </table>

      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
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
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->
            
         <!--    <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                <span class="input-group-addon" >
                          <input type="checkbox" id="escanerCodigo" name="escanerCodigo" value="0" checked=""> Generar código
                        </span>

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" required autocomplete="off" readonly>

              </div>

            </div> -->

        


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
            </div>
            </div>

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

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group row">

                    <div class="col-xs-12 col-sm-6">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevoColor" name="nuevoColor" required>
                  
                  <option value="">Diseño</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarDiseño($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["diseño"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

       
            </div>
              <div class="col-xs-12 col-sm-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" id="nuevaDescripcion" placeholder="Ingresar descripción" autocomplete="off">

                <input type="hidden" value="<?php echo $_SESSION['sucursal']; ?>" id="idSucursal" name="idSucursal">

                 <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilId" name="perfilId">



              </div>
            </div>


        

            </div>




             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

               <!--  <div class="col-xs-12 col-sm-6"> -->
                
                  <!-- <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>

                  </div> -->

              <!-- ENTRADA PARA PRECIO PLAZA -->

                  

                  <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-handshake-o"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioPlaza" name="nuevoPrecioPlaza" min="0" step="any" placeholder="Precio de plaza" required>

                  </div>

                  </div>


                

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>

                  </div>

                </div>


                
                </div>



        

            <!-- ENTRADA PARA SUBIR FOTO -->

  <!--            <div class="form-group">
              
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

          $crearProducto = new ControladorProductos();
          $crearProducto -> ctrCrearProducto();

        ?>  

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

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

                <select class="form-control input-lg"  name="editarCategoria" readonly required>
                  
                  <option id="editarCategoria"></option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion">

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

           <!--  <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

              </div>

            </div> -->

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>

                  </div>

              <!-- ENTRADA PARA PRECIO PLAZA -->

                  <br>

                   <div class="col-xs-12" style="padding:0">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-handshake-o"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioPlaza" name="editarPrecioPlaza" min="0" step="any" placeholder="Precio de plaza" required>

                  </div>

                  </div>


                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="50">

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>


                  </div>

                </div>

            </div>



            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen">



              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="250px">

              <input type="hidden" name="imagenActual" id="imagenActual">

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

      </form>

        <?php

          $editarProducto = new ControladorProductos();
          $editarProducto -> ctrEditarProducto();

        ?>      

    </div>

  </div>

</div>


<!--=====================================
MODAL AGREGAR STOCK
======================================-->

<div id="modalAgregarStock" class="modal fade" role="dialog">
  
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


            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="number" class="form-control input-lg" id="codigoProducto" name="codigoProducto" placeholder="Ingresar código" autocomplete="off" required>

              </div>

            </div>

                        <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span> 

                <input type="number" class="form-control input-lg" id="stockProducto" name="stockProducto" placeholder="Ingresar stock" autocomplete="off" required>

                

              </div>

            </div>

          </div>
        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-warning">Agregar stock</button>

        </div>

      </form>

        <?php

          $crearProducto = new ControladorProductos();
          $crearProducto -> ctrAgregarStockSucursal();

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

          <h4 class="modal-title">Sumar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span> 

                <input type="number" class="form-control input-lg" id="stockProductoEditar" name="stockProductoEditar" placeholder="Ingresar nuevo stock" autocomplete="off" required>

                <input type="hidden" value="" id="codigoProductos" name="codigoProductos">

                <input type="hidden" value="" id="stockActual" name="stockActual">

                <input type="hidden" value="" id="idStock" name="idStock">

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

          $actualizarProductoStock = new ControladorProductos();
          $actualizarProductoStock -> ctrActualizarStockSucursal();

        ?>  

    </div>

  </div>

</div>



<!--=====================================
MODAL SUMAR STOCK
======================================-->

<div id="modalAgregarStockSucursal" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Sumar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">





            



            <!--  SUCURSAL -->

                <div class="form-group">

                <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

               <?php


            $item = "id";
            $valor = $_SESSION['sucursal'];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);


                     

                         echo '<input type="text" value="'.$sucursal["nombre"].'" class="form-control input-lg" readonly>';

                     
                    ?>
              
                 </div>

                </div>

                      <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span> 

                <input type="number" class="form-control input-lg" id="codigoProductoTotal" name="codigoProductoTotal" readonly>

</div>
</div>

        

            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span> 

                <input type="number" class="form-control input-lg" id="stockProductoTotal" name="stockProductoTotal" placeholder="Ingresar nuevo stock" autocomplete="off" required>

</div>
</div>

   


               <!--  <input type="hidden" value="" id="idStock" name="idStock"> -->





              </div>

            </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-warning">Agregar stock</button>

        </div>

      </form>

        <?php

          $actualizarProductoStockTotal = new ControladorProductos();
          $actualizarProductoStockTotal -> ctrAgregarStockSucursalTotal();

        ?>  

    </div>

  </div>

</div>


<!--=====================================
MODAL FOTO PRODUCTO
======================================-->

<div id="modalFotoProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">



    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar foto producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
          <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="number" class="form-control input-lg" id="codigoProductoFoto" name="codigoProductoFoto" placeholder="Ingresar código" autocomplete="off" required>

              </div>

            </div>

          

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

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

      </form>

        <?php

          $crearFotoProducto = new ControladorProductos();
          $crearFotoProducto -> ctrCrearFotoProducto();

        ?>  

    </div>

  </div>

</div>



<!--=====================================
MODAL REPORTE PDF POR CATEGORIAS 
======================================-->

<div id="modalPdfCategorias" class="modal fade" role="dialog">
  
  <div class="modal-dialog">



    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:red; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"> Exportar archivo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA EL CÓDIGO -->
            
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="categoriaPdf" name="categoriaPdf" required>
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>



          

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-danger">Crear</button>

        </div>

      </form>

        <?php

          $archivoCategoria = new ControladorProductos();
          $archivoCategoria -> ctrExportarArchivoPdf();

        ?>  

    </div>

  </div>

</div>


<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProductoSucursal();

?>      



