<?php

if($_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Técnico Reparador"){

  echo '<script>

    window.location = "crear-venta2";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar sucursales
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Tablero</li>
      </ol>
    
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSucursal">

            Agregar Sucursal

          </button>


        </div>
        <div class="box-body">
          
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          
          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Sucursal</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Terminos</th>
              <th>Descripción Garantía</th>
              <th>Precio Etiquetas</th>
              <th>Acciones</th>

          </thead>

          <tbody>


            <?php

            $item = null;
            $valor = null;

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

    

        foreach ($sucursal as $key => $value){
        


    echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td><b>'.$value["nombre"].'</b></td>
                  
                  <td>'.$value["telefono"].'</td>
                  <td>'.$value["direccion"].'</td>
                  <td>'.$value["terminos"].'</td>
                  
                  <td>'.$value["cotizacion_cliente"].'</td>';

                // <td>'.$value["precio_producto"].'</td>

                   if($value["precio_producto"] != 0){

                    echo '<td><button class="btn btn-success btnActivarEtiqueta" idScursalEtiqueta="'.$value["id"].'" estadoEtiqueta="0">Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btnActivarEtiqueta" idScursalEtiqueta="'.$value["id"].'" estadoEtiqueta="1">Desactivado</button></td>';

                  }  




                  echo '<td>  

                    <div class="btn-group">
                        
                      <button class="btn btn-success btnInfoSucursal" idSucursal="'.$value["id"].'" ><i class="fa fa-eye"></i></button>

                      <button class="btn btn-warning btnEditarSucursal" idSucursal="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarSucursal"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarSucursal" idSucursal="'.$value["id"].'" ><i class="fa fa-times"></i></button>

                    </div>  

                  </td>';

            
          
        }

            ?>
              

          </tbody>

        </table>



        </div>

      </div>
      <!-- /.box -->

    </section>
 
  </div>

  <!-- ===================
        AGREGAR SUCURSAL
    ============================ -->

    <!-- Modal -->
<div id="modalAgregarSucursal" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!-- ===================
        CABEZA DEL MODAL
    ============================ -->

      <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Sucursal</h4>
      </div>
      
      <!-- ===================
        CUERPO DE MODAL
    ============================ -->

      <div class="modal-body">
        
        <div class="box-body">

          <!-- ENTRADA NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-map-o"></i></span>

              <input type="text" class="form-control input-lg" name="nuevoSucursal" placeholder="Ingresar nombre" autocomplete="off" required>
              



            </div>

          </div>

          <!-- ENTRADA telefono -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-phone"></i></span>

              <input type="number" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" id="nuevoTelefono" autocomplete="off">
              

            </div>

          </div>

          <!-- ENTRADA DIRECCION -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>

              <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar dirección" autocomplete="off">
              

            </div>

          </div>

            <!-- ENTRADA TERMINOS -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>

              <textarea type="text" class="form-control input-lg" name="nuevoTerminos" placeholder="Ingresar terminos" autocomplete="off"></textarea>
              

            </div>

          </div>

          <!-- TERMINA -->

           <!-- ENTRADA REPARACIONES -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-lock"></i></span>

              <input type="text" class="form-control input-lg" name="nuevoReparacion" placeholder="Ingresar condiciones de reparación" autocomplete="off">

            

            </div>

          </div>


          <!-- ENTRADA IMPRESORA -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-print"></i></span>

              <input type="text" class="form-control input-lg" name="nuevaImpresora" placeholder="Ingresar impresora" autocomplete="off">
              

            </div>

          </div>

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

      $crearSucursal = new ControladorUsuarios();
      $crearSucursal -> ctrCrearSucursal();

      ?>

    </form>

    </div>

  </div>

</div>



<!-- ===================
        EDITAR SUCURSAL
    ============================ -->

    <!-- Modal -->
<div id="modalEditarSucursal" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!-- ===================
        CABEZA DEL MODAL
    ============================ -->

      <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Sucursal</h4>
      </div>
      
      <!-- ===================
        CUERPO DE MODAL
    ============================ -->

      <div class="modal-body">
        
        <div class="box-body">

          <!-- ENTRADA NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-map-o"></i></span>

              <input type="text" class="form-control input-lg" name="editarNombreSucursal" 
              id="editarNombreSucursal" placeholder="Ingresar nombre" autocomplete="off" required>
              

            </div>

          </div>

          <!-- ENTRADA TELEFONO -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-phone"></i></span>

              <input type="text" class="form-control input-lg" name="editarTelefonoSucursal" placeholder="Ingresar teléfono" id="editarTelefonoSucursal" autocomplete="off">
              

            </div>

          </div>

          <!-- ENTRADA DIRECCION -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>

              <input type="text" class="form-control input-lg" name="editarDireccionSucursal" id="editarDireccionSucursal" placeholder="Ingresar dirección" autocomplete="off">
              

            </div>

          </div>

          <!-- ENTRADA TERMINOS -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>

              <textarea type="text" class="form-control input-lg" name="editarTerminos" id="editarTerminos" placeholder="Ingresar terminos" autocomplete="off"></textarea>
              

            </div>

          </div>


          <!-- TERMINA -->

           <!-- ENTRADA CONDICIONES -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-lock"></i></span>

              <input type="text" class="form-control input-lg" name="editarReparacionSucursal" id="editarReparacionSucursal" placeholder="Ingresar condiciones de reparación" autocomplete="off">

               <input type="hidden" class="form-control input-lg" name="idSucursalEditar" id="idSucursalEditar">
              

            </div>

          </div>

                     <!-- ENTRADA IMPRESORA -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-print"></i></span>

              <input type="text" class="form-control input-lg" name="editarReparacionImpresora" id="editarReparacionImpresora" placeholder="Ingresar nombre impresora" autocomplete="off">


            </div>

          </div>

          <!-- TERMINA -->


        </div>

      </div>

      <!-- ===================
        PIE DE MODAL
    ============================ -->
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>

      <?php

      $editarSucursal = new ControladorUsuarios();
      $editarSucursal -> ctrEditarSucursal();

      ?>

    </form>

    </div>

  </div>

</div>


<?php

  $borrarSucursal = new ControladorUsuarios();
  $borrarSucursal -> ctrBorrarSucursal();

?> 

 

