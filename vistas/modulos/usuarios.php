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
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

            Agregar Usuario

          </button>


        </div>
        <div class="box-body">
          
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          
          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Sucursal</th>
              <th>Último login</th>
              <th>Acciones</th>

          </thead>

          <tbody>


            <?php

            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

    

        foreach ($usuarios as $key => $value){
        


    echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["usuario"].'</td>';

                  if($value["foto"] != ""){

                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

                  }else{

                    echo '<td><img src="vistas/img/usuarios/default/person.png" class="img-thumbnail" width="40px"></td>';

                  }

                  echo '<td>'.$value["perfil"].'</td>';

                  if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';

                  }  
       
            $item = "id";
            $valor = $value["sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);


            echo '<td><button class="btn btn-primary btnSucursal" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarSucursal">'.$sucursal["nombre"].'</button></td>


               <td>'.$value["ultimo_login"].'</td>

                   <td>  

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>

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
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!-- ===================
        CABEZA DEL MODAL
    ============================ -->

      <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Usuario</h4>
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

              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" autocomplete="off" required>
              



            </div>

          </div>

          <!-- ENTRADA USUARIO -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" autocomplete="off" required>
              

            </div>

          </div>

          <!-- ENTRADA CONTRASEÑA -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-lock"></i></span>

              <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" autocomplete="off" required>
              

            </div>

          </div>

          <!-- TERMINA -->

          <!-- ENTRADA CONTRASEÑA -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-users"></i></span>

              <select class="form-control input-lg" name="nuevoPerfil" required="">
                
                <option value="">Seleccionar perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Administrador de Sucursal">Administrador de Sucursal</option>
                <option value="Técnico Reparador">Técnico Reparador</option>
                <option value="Vendedor">Vendedor</option>


              </select>
              

            </div>

          </div>

          <!-- TERMINA -->

          <!-- ENTRADA SUBIR FOTO -->

          <div class="form-group">
            
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevaFoto" name="nuevaFoto" name="nuevaFoto">

            <p class="help-block">Peso máximo de la foto 2 MB </p>

            <img src="vistas/img/usuarios/default/perfil.png" class="img-thumbnail previsualizar" width="100px">

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

      $crearUsuario = new ControladorUsuarios();
      $crearUsuario -> ctrCrearUsuario();

      ?>

    </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  
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

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarPerfil">
                  
                  <option value="" id="editarPerfil"></option>

                  
              
                <option value="Administrador">Administrador</option>
                <option value="Administrador de Sucursal">Administrador de Sucursal</option>
                <option value="Técnico Reparador">Técnico Reparador</option>
                <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>


  

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/person.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

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

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();

        ?> 

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR SUCURSAL
======================================-->

<div id="modalEditarSucursal" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar sucursal de usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
       <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaSucursal" name="nuevaSucursal" required>
                  
                  <option value="">Selecionar sucursal</option>

                  <?php

                  $item = null;
                  $valor = null;

                 $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

                  foreach ($sucursal as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

              

             

            </div>

                <input type="hidden" id="idUsuarioRecibir" name="idUsuarioRecibir">


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

          $editarSucursalUsuario = new ControladorUsuarios();
          $editarSucursalUsuario -> ctrEditarSucursaldeUsuarios();

        ?> 

      </form>

    </div>

  </div>

</div>



 

<?php

  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();

?> 

 

