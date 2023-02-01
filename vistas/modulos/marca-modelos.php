



<div class="content-wrapper">



  <section class="content-header">

    
    <h1>
      
      Administrar marcas y modelos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar marcas y modelos</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">

  <div class="col-md-5 col-xs-12">
    <div class="box box-warning">

      <div class="box-header with-border">
  
        <button class="btn btn-warning" data-toggle="modal" data-target="#modalNuevaMarca">
          
          Nueva marca

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

          $categorias = ControladorCategorias::ctrMostrarMarcas($item, $valor);

          foreach ($categorias as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                  

                    <td class="text">'.$value["marca"].'</td>

            
                   <td>

                   <div class="btn-group">';
                        
                   if($_SESSION["perfil"] == "Administrador"){

                       echo '<button class="btn btn-warning btnEditarMarca" idMarcaEditar="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarMarca"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarMarca" idMarcaEditar="'.$value["id"].'"><i class="fa fa-times"></i></button> ';}

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

  <div class="col-md-7 col-xs-12">
    <div class="box box-success">

      <div class="box-header with-border">
  
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgrearModelo">
          
          Agregar modelo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Imagen</th>
           <th>Marca</th>
           <th>Modelo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $categorias = ControladorCategorias::ctrMostrarModelos($item, $valor);

          foreach ($categorias as $key => $value) {
           
            echo ' <tr>

                    <td>'.$value["codigo"].'</td>';

                    

                  if($value["imagen"] != ""){

                    echo '<td><img src="'.$value["imagen"].'" class="img-thumbnail" width="50px"></td>';

                  }else{

                    echo '<td><img src="vistas/img/usuarios/default/person.png" class="img-thumbnail" width="50px"></td>';

                  }

                  $item = "id";
                  $valor = $value["id_marca"];

                  $marca = ControladorCategorias::ctrMostrarMarcas($item, $valor);

                 echo '<td>'.$marca["marca"].'</td>

                   
                    <td class="text-uppercase">'.$value["modelo"].'</td>

            
                   <td>

                   <div class="btn-group">';
                        
                   if($_SESSION["perfil"] == "Administrador"){

                       echo '
                        <button class="btn btn-primary btnVerModelo"  idModeloEditar="'.$value["id"].'" data-toggle="modal" data-target="#modalInformacionModelo"><i class="fa fa-eye"></i></button> 

                        <button class="btn btn-warning btnEditarModelo" idModeloEditar="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarModelo"><i class="fa fa-pencil"></i></button>



                        <button class="btn btn-danger btnEliminarModelo" idModeloEditar="'.$value["id"].'"><i class="fa fa-times"></i></button> ';}

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
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

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

<?php

  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();

?>


<!--=====================================
MODAL AGREGAR NUEVA MARCA
======================================-->

<div id="modalNuevaMarca" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar marca</h4>

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

                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar marca" autocomplete="off" required>

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

          $crearMarca = new ControladorCategorias();
          $crearMarca -> ctrCrearMarca();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR NUEVA MARCA
======================================-->

<div id="modalEditarMarca" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar marca</h4>

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

                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca"autocomplete="off" required>

                <input type="hidden"  name="idMarcaEditar" id="idMarcaEditar" required>

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

          $editarMarca = new ControladorCategorias();
          $editarMarca -> ctrEditarMarca();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarMarca = new ControladorCategorias();
  $borrarMarca -> ctrBorrarMarca();

?>


<!--=====================================
MODAL AGREGAR MODELO
======================================-->

<div id="modalAgrearModelo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar modelo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->



        <div class="modal-body">



          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <b>SELECCIONAR MARCA</b>

            <select class="form-control input-lg" id="seleccionMarca" name="seleccionMarca" required>
                  
                  <option value="">Marca</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarMarcas($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["marca"].'</option>';
                  }

                  ?>

  
                </select>

          <div class="box-body">
  
          </div>

               <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoModelo" id="nuevoModelo" placeholder="Ingresar modelo" autocomplete="off" required>

              </div>

            </div>


            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg"  id="nuevoCodigo" name="nuevoCodigo" placeholder="Codigo" autocomplete="off" required readonly>

              </div>

            </div>

                  <!-- ENTRADA SUBIR FOTO -->

          <div class="form-group">
            
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevaImagenModelo" name="nuevaImagenModelo">

            <p class="help-block">Peso máximo de la foto 2 MB. Tamaño optimo 960 x 1340 px.</p>

            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">

          </div>

        </div>

      </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar modelo</button>

        </div>

        <?php

          $crearModelo = new ControladorCategorias();
          $crearModelo -> ctrCrearModelo();

        ?>

      </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL EDITAR MODELO
======================================-->

<div id="modalEditarModelo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar modelo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <b>SELECCIONAR MARCA</b>

            <select class="form-control input-lg" id="editarMarcaModelo" name="editarMarcaModelo" required>
                  
                  <option value="">Marca</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarMarcas($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["marca"].'</option>';
                  }

                  ?>

  
                </select>

          <div class="box-body">
  
          </div>

               <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarModelo" id="editarModelo" placeholder="Ingresar modelo" autocomplete="off" required>

              </div>

            </div>


            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg"  id="editarCodigo" name="editarCodigo" placeholder="Codigo" autocomplete="off" required readonly>

                <input type="hidden" class="form-control input-lg"  id="idModeloEditar2" name="idModeloEditar2" placeholder="Codigo" autocomplete="off" required readonly>

              </div>

            </div>

                  <!-- ENTRADA SUBIR FOTO -->

          <div class="form-group">
            
            <div class="panel">SUBIR IMAGEN</div>

            <input type="file" class="nuevaImagenModelo" name="editarImagenModelo">

            <p class="help-block">Peso máximo de la foto 2 MB. Tamaño optimo 960 x 1340 px. </p>

            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">
            

            <input type="hidden" name="imagenActual" id="imagenActual">


          </div>

        </div>

      </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar modelo</button>

        </div>

        <?php

          $editarModelo = new ControladorCategorias();
          $editarModelo -> ctrEditarModelo();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarModelo = new ControladorCategorias();
  $borrarModelo -> ctrBorrarModelo();

?>



<!--=====================================
MODAL INFO MODELO
======================================-->

<div id="modalInformacionModelo" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Información</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">


      <div class="form-group row">

        <!-- COLUMNA IZQUIERDA -->
          <div class="box-body">
            <div class="col-xs-12 col-sm-4">

            




           <span class="pull-right badge bg-red" id="infoCodigo" name="infoCodigo">842</span>
              
              <h3  ><b id="infoMarca">Motorola</b></h3>
              <h1  ><b id="infoModelo">G7/G7 PLUS</b></h1>

           

          

        <!--=====================================
          MOSTRAR IMAGEN
        ======================================-->

                <value id="infoImagen"></value>

           




            </div>
            <!-- COLUMNA DERECHA -->

            <?php 


          //  $codigo = "6001";
           // $orden = "codigo";
           //echo $codigo = '<p id="modeloObtener" ></p>';

           // $vendidos = ControladorVentas::ctrReporteMarcaModeloBoxCantidad($codigo, $orden);
       
//            echo '<span>'.count($vendidos).'</span>';

            //var_dump($vendidos);
            //var_dump("hola", $codigo);

            //var_dump(count($vendidos));
      
            
           // foreach($vendidos as $totallista2)
            //$totallista = $vendidos["cantidad"];
          
          //SOLAMENTE FALTA SUSTITUIR EL VALOR DE LA VARUBALES $CODIGO POR EL VALOR DINAMICO DEL ID_MODELO


          ?>

                <?php 


            $codigo = "2001";
            $orden = "codigo";
           //echo $codigo = '$("#modeloObtener").val();';

            $vendidos = ControladorVentas::ctrReporteMarcaModeloBox4Ventas($codigo, $orden);

            $totallista = $vendidos["ventas"];
          
          
          ?>


            <div class="col-xs-12 col-sm-8">

              <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3> <?php echo number_format($totallista); ?></h3>

              <p>Ventas relacionadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


            <?php 


            $codigo = "6001";
            $orden = "codigo";

            $vendidos2 = ControladorVentas::ctrReporteMarcaModeloBoxTotal($codigo, $orden);

            $totallista2 = $vendidos2["total"];
          
          
          ?>



        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>$ <?php echo number_format($totallista2); ?></h3>

              <p>Ingreso de ventas</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


      

            <?php 


            $codigo = "2001";
           
            //echo $codigo = '<value id="modeloObtener"></value>';
            $orden = "codigo";
            
            //var_dump($codigo);

            $vendidos3 = ControladorVentas::ctrReporteMarcaModeloBox3InventarioStock($codigo, $orden);

            $totallista3 = $vendidos3["stock"];
          
          
          ?>


      
              <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo number_format($totallista3); ?></h3>

              <p>Articulos en inventario</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>




            <?php 


            $codigo = "2001";
            $orden = "codigo";

            $vendidos4 = ControladorVentas::ctrReporteMarcaModeloBoxInversion($codigo, $orden);

            $totallista4 = $vendidos4["precio_compra"];
          
          
          ?>


        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>$ <?php echo number_format($totallista4); ?></h3>

              <p>En inversión </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>



             
<br>
              <h3><b>Articulos relacionados: 32</b></h3>

              <br>




 

 <div class="box box-warning">

      <div class="box-header with-border">
  
        <button class="btn btn-warning" data-toggle="modal" data-target="#modalNuevaMarca">


          
          Nueva marca

        </button>

        <b class="pull-right">Valor inventario: $ <?php echo number_format($totallista4); ?></b>

      </div>
      
      <div class="box-body box">
        
        
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Codigo</th>
           <th>Imagen</th>
           <th>Descripción</th>
           <th>Stock</th>
           <th>Sucursal</th>


         </tr> 

        </thead>

        <tbody>



          <?php

         // $codigo = '<p id="modeloObtener">3001</p>';

           //$codigo2 = $_POST['idModeloEditar'];

         

         //var_dump("expression", $codigo);
        $codigo = "2001";
          $orden = "codigo";

          $categorias = ControladorVentas::ctrMostrarProductosxId($codigo, $orden);

          foreach ($categorias as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                  

                    <td>'.$value["codigo"].'</td>

                    <td><img src="'.$value["imagen"].'" class="img-thumbnail" width="50px"></td>
                    
                    <td>'.$value["descripcion"].'</td>
                    <td>'.$value["stock"].'</td>';

            $item = "id";
            $valor = $value["sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);


            echo '<td>'.$sucursal["nombre"].'</td>

            
                 

                  </tr>';
          }

        ?>

        

        </tbody>



       </table>



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

          <button type="submit" class="btn btn-primary">Guardar modelo</button>

        </div>

        <?php

          $editarModelo = new ControladorCategorias();
          $editarModelo -> ctrEditarModelo();

        ?>

      </form>

    </div>

  </div>

</div>






