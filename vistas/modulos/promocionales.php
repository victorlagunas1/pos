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
      
      Administrar promociones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Promociones</li>
      </ol>
    
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPromocion">

            Agregar Promoción

          </button>


        </div>
        <div class="box-body">
          
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          
          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Banner</th>
              <th>Estado</th>
              <th>Fecha</th>
              <th>Acciones</th>

          </thead>

          <tbody>


            <?php

            $item = null;
            $valor = null;

            $promocion = ControladorVentas::ctrMostrarPromocionales($item, $valor);

    

        foreach ($promocion as $key => $value){
        


    echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombre"].'</td>
                  

                  <td><img src="'.$value["banner"].'" class="img-thumbnail" width="250px"></td>';

                
                  if($value["status"] != 0){

                    echo '<td><button class="btn btn-success btnActivarPromocional" idPromocion="'.$value["id"].'" estadoPromocional="0">Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btnActivarPromocional" idPromocion="'.$value["id"].'" estadoPromocional="1">Desactivado</button></td>';

                  }  
       
         


               echo '<td>'.$value["fecha"].'</td>

                   <td>  

                    <div class="btn-group">
                        

                      <button class="btn btn-danger btnEliminarPromocional" idPromocion="'.$value["id"].'" fotoPromocional="'.$value["banner"].'"><i class="fa fa-times"></i></button>

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
        AGREGAR USUARIO
    ============================ -->

    <!-- Modal -->
<div id="modalAgregarPromocion" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!-- ===================
        CABEZA DEL MODAL
    ============================ -->

      <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Promoción</h4>
      </div>
      
      <!-- ===================
        CUERPO DE MODAL
    ============================ -->

      <div class="modal-body">
        
        <div class="box-body">


          <!-- ENTRADA NOMBRE -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input type="text" class="form-control input-lg" name="nuevoPromocionNombre" placeholder="Ingresar nombre" id="nuevoPromocionNombre" autocomplete="off" required>
              

            </div>

          </div>




          <!-- ENTRADA SUBIR BANNER -->

          <div class="form-group">
            
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevoPromocionFoto" name="nuevoPromocionFoto" id="nuevoPromocionFoto">

            <p class="help-block">Peso máximo de la foto 2 MB 900x500px </p>

            <img src="vistas/img/promocionales/default.png" class="img-thumbnail previsualizarPromocional" width="550px">

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

      $crearBanner = new ControladorVentas();
      $crearBanner -> ctrCrearPromocionales();

      ?>

    </form>

    </div>

  </div>

</div>




<?php

  $borrarPromocional = new ControladorVentas();
  $borrarPromocional -> ctrBorrarPromocional();

?> 

 

