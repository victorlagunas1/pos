

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar usuarios
    
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
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarFacturacion">

            Agregar Factura

          </button>

           <button class="btn btn-warning pull-right " style="margin-left: 10px" onclick="location.href='clientes'">
          
          Clientes
          </button>


        </div>
        <div class="box-body">
          
        <table class="table table-bordered table-striped dt-responsive tablasFacturacion" width="100%">
          
          <thead>

            <tr>

              <th>Venta</th>
              <th>Cliente</th>
              <th>RFC</th>
              <th>Correo</th>
              <th>Dirección</th>
              <th>Teléfono</th>
              <th>Uso CFDI</th>
              <th>Sucursal</th>
              <th>Fecha</th>
              <th>Acciones</th>

          </thead>

          <tbody>


            <?php

            $item = null;
            $valor = null;

            $facturacion = ControladorFacturacion::ctrMostrarFacturacion($item, $valor);

    

        foreach ($facturacion as $key => $value){
          

          $item = "id";
          $valor = $value["id_cliente"];

          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);


            $item = "id";
            $valor = $value["id_sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

    echo ' <tr>
                   <td>'.$value["id_venta"].'</td>
                  <td>'.$clientes["nombre"].'</td>
                  <td>'.$clientes["documento"].'</td>
                  <td>'.$clientes["email"].'</td>
                  <td>'.$clientes["direccion"].'</td>
                  <td>'.$clientes["telefono"].'</td>
                  <td>'.$value["cfdi"].'</td>
                  <td>'.$sucursal["nombre"].'</td>
                  <td>'.$value["fecha"].'</td>';

            echo '

                   <td>  

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarFacturacion" idFacturacion="'.$value["id"].'" idCliente="'.$value["id_cliente"].'" cfdi="'.$value["cfdi"].'" idVenta="'.$value["id_venta"].'" data-toggle="modal" data-target="#modalEditarFacturacion"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                      echo '<button class="btn btn-danger btnEliminarFacturacion" idFacturacion="'.$value["id"].'"><i class="fa fa-times"></i></button>';}


                    echo '</div>  

                  </td>

                </tr>';
            
          
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
MODAL EDITAR FACTURACION
======================================-->

<div id="modalEditarFacturacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

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

              <input type="number" class="form-control input-lg" name="nuevoNoVentaEditar" placeholder="No. de venta" id="nuevoNoVentaEditar" autocomplete="off" required>

              <input type="hidden" class="form-control input-lg" name="idFacturacionEditar" id="idFacturacionEditar" >
              

            </div>

          </div>

        
          <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarClienteEditar" name="seleccionarClienteEditar">


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

              <select class="form-control input-lg" name="nuevoUsoCFDIEditar" id="nuevoUsoCFDIEditar">
                
               
                <option value="Gastos Generales">Gastos Generales</option>
                <option value="Por definir">Por definir</option>
                <option value="Aquisición de mercancia">Aquisición de mercancia</option>
                <option value="Equipo de computo y accesorios">Equipo de computo y accesorios</option>
                <option value="Comunicaciones telefonicas">Comunicaciones telefonicas</option>


              </select>
              

            </div>

          </div>

          
         

          <!-- TERMINA -->


          <!-- TERMINA -->


        </div>

      </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

     <?php

          $EditarFacturacion = new ControladorFacturacion();
          $EditarFacturacion -> ctrEditarFacturacion();

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

                <input type="text" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar RFC" autocomplete="off" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" autocomplete="off" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" autocomplete="off" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" autocomplete="off" required>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask autocomplete="off" required>

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


 

<?php

  $borrarFacturacion = new ControladorFacturacion();
  $borrarFacturacion -> ctrBorrarFacturacion();

?> 

 

