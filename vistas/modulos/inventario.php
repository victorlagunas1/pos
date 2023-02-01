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
      
      Crear Invetario
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear invetario</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="callout callout-warning">
        

        <p><b>¡Advertencia! </b>La creación de un nuevo inventario eliminara todo el stock existente, y lo sustituira por el nuevo inventario. Asegurate de completar el inventario correctamente.</p>
      </div>


    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <!--  -->

      <!--=====================================
      LA TABLA DE INVENTARIO
      ======================================-->

      <div class="col-lg-12 col-xs-12">
        
        <div class="box box-warning">

          <div class="box-header with-border"><b>TABLA DE INVENTARIOS</b>
            
           


          </div>


          <div class="box-body">
           <button class="btn btn-primary btnCrearInvetario" data-toggle="modal" data-target="#modalCrearInventario">
          
          Crear Inventario 

        </button>


            
            <table class="table table-bordered table-striped dt-responsive tablasInvetario" width="100%">
              

              <div class="form-group row">
                

                </div>
               <thead>

                 <tr>
                  <th>ID</th>
                  <th>Sucursal</th>
                  <th>Usuario</th>
                  <th>Revisión</th>
                  <th>Status</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
                </tr>

              </thead>


              <tbody>


            <?php

            $item = null;
            $valor = null;

            $inventario = ControladorInventarios::ctrMostrarInvetario($item, $valor);

    

        foreach ($inventario as $key => $value){
        
            $item = "id";
            $valor = $value["id_sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

            $item = "id";
            $valor = $value["usuario"];

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);


    echo ' <tr>
                  
                  <td>'.$value["id"].'</td>
                  <td>'.$sucursal["nombre"].'</td>
                  <td>'.$usuarios["usuario"].'</td>

                   <td><button class="btn btn-primary btnRevisionInvetario" idInventario="'.$value["id"].'"><i class="fa fa-search"></i> REVISAR</button></td>
                  

                  <td>  

                    <div class="btn-group">';
                        
                      
                    if ($value["status"] == 0) {

                      echo '<button class="btn btn-warning">PENDIENTE</button>';

                     } else if ($value["status"] == 1) {
                     echo '<button class="btn btn-success">APLICADO</button>';
                      
                      } else {
                        echo '<button class="btn btn-danger">RECHAZADO</button>';
                      }

              echo ' </div>  

                  </td>


                 
                 
                  <td>'.$value["fecha"].'</td>


            

                   <td>  

                    <div class="btn-group">';

                    if ($value["status"] == 0) {

                     echo' <button class="btn btn-warning btnEditarInventario" idInventario="'.$value["id"].'"><i class="fa fa-pencil"></i></button><button class="btn btn-danger btnRechazarInventario" idInventario="'.$value["id"].'"><i class="fa fa-times"></i></button><button class="btn btn-success btnAceptarInventario" idInventario="'.$value["id"].'" stockNuevo="'.$value["stock_nuevo"].'"><i class="fa fa-check"></i></button>';

                   }else{

                   }

                    '</div>  

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
MODAL AGREGAR REPARACION
======================================-->

<div id="modalCrearInventario" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Crear nuevo inventario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

<div class="callout callout-warning">
        

        <p><b>¡Advertencia! </b>La creación de un nuevo inventario eliminara todo el stock existente, y lo sustituira por el nuevo inventario. Asegurate de completar el inventario correctamente.</p>
      </div>

      <input type="hidden" class="form-control input-lg" id="crearInventario" name="crearInventario" >
               
               
            


             </div>


                      
        </div>





                  

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-danger">Crear inventario</button>

        </div>

      </form>

        <?php

          $ctrCrearReparacion = new ControladorInventarios();
          $ctrCrearReparacion -> ctrCrearNuevoInvetario();

        ?>  

    </div>

  </div>

</div>

