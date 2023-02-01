 <?php

            $item = "id";
            $valor = $_SESSION["id"];

            $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            $item = "id";
            $valor = $usuario["sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
            

    
    ?>
<div class="content-wrapper">

<section class="content-header">
      <h1>
        Perfil de usuario
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Perfil</li>
      </ol>
    </section>
      <!-- Default box -->

<section class="content-header">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
             
            <?php  if ($usuario["foto"] === ""){

              echo '<img class="profile-user-img img-responsive img-circle" src="vistas/img/usuarios/default/perfil.png" alt="User profile picture">';
             
              } else {

                echo '<img class="profile-user-img img-responsive img-circle" src="'.$usuario["foto"].'" alt="User profile picture">';
              }
?>


           

              <h3 class="profile-username text-center"><?php echo ''.$usuario["nombre"].'';?></h3>

              <p class="text-muted text-center"><?php echo ''.$usuario["perfil"].'';?></p>

              <ul class="list-group list-group-unbordered">
                
                 <li class="list-group-item">
                  <b>Usuario</b> <a class="pull-right"><?php echo ''.$usuario["usuario"].'';?></a>
                </li>

                <li class="list-group-item">
                  <b>Sucursal</b> <a class="pull-right"><?php echo ''.$sucursal["nombre"].'';?></a>
                </li>

                <li class="list-group-item">
                  <b>Correo</b> <a class="pull-right"><?php echo ''.$usuario["nombre"].'';?></a>
                </li>

                <li class="list-group-item">
                  <b>Ultimo inicio</b> <a class="pull-right"><?php echo ''.$usuario["ultimo_login"].'';?></a>
                </li>
               
                
              </ul>

              <a class="btn btn-warning btn-block" data-toggle="modal" data-target="#modalEditarUsuarioPerfil" ><b>Editar</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


          

          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
           
          </div>
        
        </div>
        


        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#metasObjetivos" data-toggle="tab" aria-expanded="true">Objetivos y metas</a></li>
            <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Tareas pendientes</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Configuración</a></li> 
            </ul>
            


            <div class="tab-content">
              <div class="tab-pane active" id="metasObjetivos">

                   
                   <h3 class="panel" >Objetivos del 01 al 13 de Octubre</h3>

                   

                   <div class="row">
                <div class="col-lg-4 col-xs-12 text-center">
                    
          <input type="text" value="75" class="dial">

          <h3 class="text-center"><b>Cristal templado</b></h3>

                <p>Vender 10 micas de cristal templado, actualmente llevas 4 vendidas.</p>
                 <h2> $ 137.00 </h2>
                            <span class="label label-info">PENDIENTE</span>

                   
<script>

    $(function() {
        $(".dial").knob();
    });
</script> 

                   </div>


                   <!--- SIGUIENTE KNOB --> 

                      <div class="col-lg-4 col-xs-12 text-center">
                    
                          <input type="text" value="23" class="dial">
                          <h3 class="text-center"><b>Cargadores</b></h3>
                           <p>Vender 10 micas de cristal templado, actualmente llevas 4 vendidas.</p>
                           <h2> $ 137.00 </h2>
                          <span class="label label-info">PENDIENTE</span>


                      </div>

                      <!--- TERMINA KNOB --> 

                      <!--- SIGUIENTE KNOB --> 

                      <div class="col-lg-4 col-xs-12 text-center">
                    
                          <input type="text" value="45" class="dial">
                          <h3 class="text-center"><b>Cables de datos</b></h3>
                           <p>Vender 10 micas de cristal templado, actualmente llevas 4 vendidas.</p>
                           <h2> $ 137.00 </h2>
                          <span class="label label-info">PENDIENTE</span>

                      </div>

                      <!--- TERMINA KNOB -->               
</div>
          
          <br>
          <br>


             



              <h3 class="panel" >Metas Sucursal del 01 al 13 de Octubre</h3>

                   

                   <div class="row">
                <div class="col-lg-4 col-xs-12 text-center">
                    
          <input type="text" value="75" class="dial">

          <h3 class="text-center"><b>Cristal templado</b></h3>

                <p>Vender 10 micas de cristal templado, actualmente llevas 4 vendidas.</p>
                 <h2> $ 137.00 </h2>
                            <span class="label label-info">PENDIENTE</span>

                   
<script>

    $(function() {
        $(".dial").knob();
    });
</script> 

                   </div>


                   <!--- SIGUIENTE KNOB --> 

                      <div class="col-lg-4 col-xs-12 text-center">
                    
                          <input type="text" value="23" class="dial">
                          <h3 class="text-center"><b>Cargadores</b></h3>
                           <p>Vender 10 micas de cristal templado, actualmente llevas 4 vendidas.</p>
                           <h2> $ 137.00 </h2>
                          <span class="label label-info">PENDIENTE</span>


                      </div>

                      <!--- TERMINA KNOB --> 

                      <!--- SIGUIENTE KNOB --> 

                      <div class="col-lg-4 col-xs-12 text-center">
                    
                          <input type="text" value="45" class="dial">
                          <h3 class="text-center"><b>Cables de datos</b></h3>
                           <p>Vender 10 micas de cristal templado, actualmente llevas 4 vendidas.</p>
                           <h2> $ 137.00 </h2>
                          <span class="label label-info">PENDIENTE</span>

                      </div>

                      <!--- TERMINA KNOB -->               
</div>
                     
         
                

               </div>







              
              <div class="tab-pane" id="timeline">
              
                <ul class="timeline timeline-inverse">
                  
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  
                  
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  
                  
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                 
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nueva contraseña</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                 
                
                  
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
             
            </div>
           
          </div>
          
        </div>
        
      </div>
  

    </section>
    </div>


<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuarioPerfil" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background: linear-gradient(to left, #00b4db, #0083b0); color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar perfil</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
             <div class="panel">CAMBIAR CONTRASEÑA</div>

        <!-- ENTRADA PARA LA CONTRASEÑA ANTERIOR -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="anteriorContraseña" placeholder="Escriba la contraseña anterior">


              </div>

            </div>


            <!-- ENTRADA PARA LA NUEVA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">


              </div>

            </div>



  

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <?php 

              if ($usuario["foto"] === ""){

              echo '<img src="vistas/img/usuarios/default/perfil.png" class="img-thumbnail previsualizar" width="300px">';
             
              } else {

                echo '<img src="'.$usuario["foto"].'" class="img-thumbnail previsualizar" width="300px">';
              }



               echo '<input type="hidden" name="fotoActual" id="fotoActual" value="'.$usuario["foto"].'">

               <input type="hidden" name="usuarioEditar" id="usuarioEditar" value="'.$usuario["usuario"].'">
                <input type="hidden" name="contraseñaActual" id="contraseñaActual" value="'.$usuario["password"].'">';
              
              ?>

             

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

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuarioPerfil();

        ?> 

      </form>

    </div>

  </div>

</div>
