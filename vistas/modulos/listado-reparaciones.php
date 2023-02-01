<?php

if($_SESSION["perfil"] != "Administrador" && $_SESSION["perfil"] != "Administrador de Sucursal"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Listado reparaciones
    
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




       
        <div class="box-body">
              <button type="button" class="btn btn-default pull-right" id="datarangeListadoReparaciones">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

          
        <table class="table table-bordered table-striped dt-responsive tablaListaReparaciones" width="100%">
          
          <thead>

            <tr>

              <th>Fecha Entrega</th>
              <th>Codigo</th>
              <th>Sucursal</th>
              <th>Nombre</th>
              
              <th>Modelo</th>
              <th>Reparación</th>
             
              <th>Precio</th>
              <th>Comisión</th>
              
              <th>Acciones</th>

          </thead>

          <tbody>


            <?php 

            //$hoy = date("Y-m-d");
           // $fechaFinal = date("Y-m-d");


        if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

           // $mesAtras = date("Y-m-d")-30;

      $mesAtras = new DateTime();
      $mesAtras ->sub(new DateInterval("P60D"));
      $mesAtras = $mesAtras->format("Y-m-d");



            $fechaInicial = $mesAtras;
            $fechaFinal = date("Y-m-d");

          //  var_dump($mesAtras);

          }

            $tabla = "reparaciones";
            $item = "status";
            $valor = 3;
            //$orden = "id";

              $reparaciones = ModeloGeneral::mdlGeneralItemFechaEntrega($tabla, $fechaInicial, $fechaFinal, $item, $valor); 
    
             // var_dump(count($reparaciones));


        foreach ($reparaciones as $key => $value){

          if ($value["id_sucursal"] != 0){
       
            $item = "id";
            $valor = $value["id_sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
            $sucursalNombre = $sucursal["nombre"];

          } else {
            $sucursalNombre = " ";
          }

          if($value["comision"] == 0){

            $comision = '<span class="pull-right badge bg-red">NO</span></td>';
           
             $botones = '<button class="btn btn-success btnAgregarComision" idReparacion='.$value["id"].' data-toggle="modal" data-target="#modalAgregarComision" ><i class="fa fa-plus"></i></button>';
          } else {

            $comision = '<span class="pull-right badge bg-green">'."$ ".number_format($value["comision"],2);'.</span></td>';
             $botones = " ";
            
          }


        


    echo ' <tr>
                  <td>'.$value["fecha_entrega"].'</td>
                  <td>MIX0'.$value["id"].'</td>
                  <td><b>'.$sucursalNombre.'</b></td>
                  <td>'.$value["nombre"].'</td>
                  
                  <td>'.$value["marca"].' '.$value["modelo"].'</td>

                   <td>'.$value["servicio"].'</td>
                  <td>'."$ ".number_format($value["precio"],2).'</td>';

        

            echo '<td>'.$comision.'</td>


                   <td>  

                    <div class="btn-group">
                        
                      '.$botones.'

                     

                    </div>  

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
        AGREGAR COMISION
    ============================ -->

    <!-- Modal -->
<div id="modalAgregarComision" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!-- ===================
        CABEZA DEL MODAL
    ============================ -->

      <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Comisión</h4>
      </div>
      
      <!-- ===================
        CUERPO DE MODAL
    ============================ -->

      <div class="modal-body">
        
        <div class="box-body">


<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">
              <div class="widget-user-image">
                <img class="img-circle" src="vistas/img/default/reparacion.png" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username" id="nombreReparacion">.</h3>
              <h5 class="widget-user-username" id="modeloReparacion">.</h5>
            </div>
         
          </div>


          <!-- ENTRADA NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-wrench"></i></span>

              <input type="text" class="form-control input-lg" id="precioReparacionComision"  name="precioReparacionComision" autocomplete="off" readonly>
              



            </div>

          </div>


         
          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-usd"></i></span>

              <input type="text" class="form-control input-lg" id="costoRefaccionComision"  name="costoRefaccionComision" autocomplete="off" placeholder="Costo de refacción">
              



            </div>

          </div>



          <!-- ENTRADA USUARIO -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <input type="number" class="form-control input-lg" name="porcentajeComision" id="porcentajeComision" autocomplete="off" placeholder="Porcentaje de comisión" required>
              

            </div>

          </div>

          <!-- ENTRADA CONTRASEÑA -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-usd"></i></span>

              <input type="number" class="form-control input-lg"  id="calculoComision" name="calculoComision" autocomplete="off" placeholder="Comisión total" readonly required>

              <input type="hidden" class="form-control input-lg"  id="idReparacionComision" name="idReparacionComision">
               <input type="hidden" class="form-control input-lg"  id="idSucursalComision" name="idSucursalComision">
              

            </div>

          </div>

          <!-- TERMINA -->

          <!-- ENTRADA CONTRASEÑA -->

           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span> 

                <select class="form-control input-lg" id="seleccionarUsuarioComision" name="seleccionarUsuarioComision" required>
                  
                  <option value="">Selecionar usuario</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

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

      $crearComision = new ControladorReparaciones();
      $crearComision -> ctrEditarReparacionComision();

      ?>

    </form>

    </div>

  </div>

</div>
