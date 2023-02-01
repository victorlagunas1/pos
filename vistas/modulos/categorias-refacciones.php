

<div class="content-wrapper">



  <section class="content-header">

    
    <h1>
      
      Administrar categorías de refacciones.
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar categorías</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">

 
      


  <div class="col-md-6 col-xs-12">
    <div class="box box-warning">

      <div class="box-header with-border">
  
        <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarCategoria">
          
          Agregar categoría

        </button>

      </div>
      
      <div class="box-body">
        
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Sección</th>
           <th>Categoría</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $categorias = ControladorRefacciones::ctrMostrarCategoriasRefacciones($item, $valor);

          foreach ($categorias as $key => $value) {
           
            echo ' <tr>

                    
                      <td class="text-uppercase">'.$value["seccion"].'</td>

                    <td class="text-uppercase">'.$value["categoria"].'</td>

            
                   <td>

                   <div class="btn-group">';


                    echo '

                     <button class="btn btn-info btnEtiquetaSeccion" idCategoriaRefacciones="'.$value["id"].'" ><i class="fa fa-barcode"></i></button>';
                        
                   if($_SESSION["perfil"] == "Administrador"){

                       echo '
                       

                       <button class="btn btn-warning btnEditarCategoriaRefacciones" idCategoriaRefacciones="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>

                        ';}

                     echo' </div>  



                    </td>

                  </tr>';

                   //OCULTO PARA EVIAR ELIMINAR SECCION O CATEGORIA Y SE DAÑE LA TABLA, EN ESPERA DE SOLUCION, ESTE CODIGO VA DEBAJO DEL BUTTON Y ANTES DEL APOSTROFE
                     //<button class="btn btn-danger btnEliminarSeccionRefacciones" idSeccion="'.$value["id"].'"><i class="fa fa-times"></i></button> 
          }

        ?>

        

        </tbody>



       </table>



      </div>
    

    </div>


  </div>


    <div class="col-md-4 col-xs-12">
    <div class="box box-primary">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarVariante">
          
          Agregar variante

        </button>

      </div>
      
      <div class="box-body">
        
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
          
           <th>Variante</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $categorias = ControladorRefacciones::ctrMostrarVariantesRefacciones($item, $valor);

          foreach ($categorias as $key => $value) {
           
            echo ' <tr>

                    
                     

                    <td class="text-uppercase">'.$value["variante"].'</td>

            
                   <td>

                   <div class="btn-group">';

                        
                   if($_SESSION["perfil"] == "Administrador"){

                       echo '
                       

                       <button class="btn btn-warning btnEditarVarianteRefacciones" idVariante="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarVariante"><i class="fa fa-pencil"></i></button>

                        ';}

                     echo' </div>  



                    </td>

                  </tr>';

                   //OCULTO PARA EVIAR ELIMINAR SECCION O CATEGORIA Y SE DAÑE LA TABLA, EN ESPERA DE SOLUCION, ESTE CODIGO VA DEBAJO DEL BUTTON Y ANTES DEL APOSTROFE
                     //<button class="btn btn-danger btnEliminarSeccionRefacciones" idSeccion="'.$value["id"].'"><i class="fa fa-times"></i></button> 
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

                <input type="text" class="form-control input-lg" name="nuevaCategoriaRefaccion" placeholder="Ingresar categoría" autocomplete="off" required>

              </div>

            </div>

        
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaSeccionRefaccion" placeholder="Ingresar sección" autocomplete="off" required>

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

          $crearCategoriaRefaccion = new ControladorCategorias();
          $crearCategoriaRefaccion -> ctrCrearCategoriaRefacciones();

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

                <input type="text" class="form-control input-lg" name="editarCategoriaRefacciones" id="editarCategoriaRefacciones" autocomplete="off" required>

                 <input type="hidden"  name="idCategoriaRefacciones" id="idCategoriaRefacciones" required>

              </div>

            </div>


              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarSeccionRefacciones" id="editarSeccionRefacciones" autocomplete="off" required>

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
          $editarCategoria -> ctrEditarCategoriaRefacciones();

        ?> 



      </form>

    </div>

  </div>

</div>



<?php

  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoriaRefacciones();

?>


<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarVariante" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar variante</h4>

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

                <input type="text" class="form-control input-lg" name="nuevaVariante" placeholder="Ingresar variante" autocomplete="off" required>

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

          $crearVariante = new ControladorRefacciones();
          $crearVariante -> ctrCrearVarianteRefaccion();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR VARIANTE
======================================-->

<div id="modalEditarVariante" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar variante</h4>

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

                <input type="text" class="form-control input-lg" name="editarVariante" id="editarVariante" autocomplete="off" required>

                 <input type="hidden"  name="idVariante" id="idVariante" required>

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
          $editarCategoria -> ctrEditarCategoriaRefacciones();

        ?> 



      </form>

    </div>

  </div>

</div>
