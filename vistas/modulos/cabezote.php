<header class="main-header">

<?php
  
            $item = "id";
            $valor = $_SESSION["id"];

            $usuarioPerfil = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

?>

	<!--=======================================
		LOGOTIPO
		======================================-->
		<a href="inicio" class="logo">

			<!-- logo mini -->
			<span class="logo-mini">
				<img src="vistas/img/plantilla/SmartPhone2.png" class="img-responsive" style="padding:10px">

			</span>


			<!-- logo normal -->

				 <span class="logo-lg"><b>Mix</b>Store</span>

			</span>
		</a>

<!--=======================================
		BARRA DE NAVEGACIÓN
		======================================-->

		<nav class="navbar navbar-static-top" role="navigation">

		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

			

			<span class ="sr-only">Toggle navigation</span>


	</a>

	



	<div class="navbar-custom-menu">



		<ul class="nav navbar-nav">

			<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell"></i>
              
            
					<?php

					 	$item = null;
            $valor = null;
            $status = 1;
            $usuario = $_SESSION["id"];
            $sucursal = $_SESSION["sucursal"];

            $notificaciones = ControladorUsuarios::ctrMostrarNotificaciones($item, $valor, $status, $usuario, $sucursal);
            
            if (count($notificaciones) != 0) {
					echo'<span class="label label-warning">'.count($notificaciones).'</span>';
            
        }
        
            echo '</a>
            <ul class="dropdown-menu">

            <li class="header">Tienes '.count($notificaciones).' notificaciones</li>

              <li>
 
                <ul class="menu"> ';


                foreach ($notificaciones as $key => $value){

              switch($value["tipo"]) {
              	
              	//PRODUCTO AGOTADO
              	case 1:
              	echo '<li>
                    <a href="#">
                      <i class="fa fa-ban text-red"></i>'.$value["titulo"].'
                      <p>'.$value["descripcion"].'</p>
                    </a>
                  </li>';
                  break;

                  //PRODUCTO CERCA DE AGOTARSE 
                  case 2:
                  echo '<li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-yellow"></i>'.$value["titulo"].'
                       <p>'.$value["descripcion"].'</p>
                    </a>
                  </li>';
                  break;

                  //META ALCANZADA 
                   case 3:
                  echo '<li>
                    <a href="#">
                      <i class="fa fa-star text-yellow"></i>'.$value["titulo"].'
                       <p>'.$value["descripcion"].'</p>
                    </a>
                  </li>';
                  break;

                   //CUMPLEAÑOS CERCANO
                   case 4:
                  echo '<li>
                    <a href="#">
                      <i class="fa fa-birthday-cake text-red"></i>'.$value["titulo"].'
                       <p>'.$value["descripcion"].'</p>
                    </a>
                  </li>';
                  break;

                   //OBJETIVO ALCANZADO
                   case 5:
                  echo '<li>
                    <a href="#">
                      <i class="fa fa-check-square text-green"></i>'.$value["titulo"].'
                       <p>'.$value["descripcion"].'</p>
                    </a>
                  </li>';
                  break;



              }

            }

              ?>
              <li class="footer"><a href="notificaciones">Ver todas las notificaciones</a></li>
            </ul>
          </li>
        </ul>





			<li class="dropdown user user-menu">

				<a href="#" class="dropdown-toggle" data-toggle="dropdown">

					<?php

					if($usuarioPerfil["foto"] != ""){

						echo '<img src="'.$usuarioPerfil["foto"].'" class="user-image">';

					}else{


						echo '<img src="vistas/img/usuarios/default/perfil.png" class="user-image">';

					}


					?>
						
						<span class="hidden-xs"><?php  echo $usuarioPerfil["nombre"]; ?></span>


					</a>







						<!-- Dropdown toggle-->
	<ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

 				<?php
              	

            if($usuarioPerfil["foto"] != ""){

						echo '<img src="'.$usuarioPerfil["foto"].'" class="img-circle" alt="User Image">';

					}else{


						echo '<img src="vistas/img/usuarios/default/perfil.png" class="img-circle" alt="User Image"">';

					}
					?>


              



                <p>

                	<?php  echo $usuarioPerfil["nombre"]; ?>


                  <small><?php  echo $usuarioPerfil["perfil"]; ?></small>
                </p>
              </li> 

              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">

              	<div class="pull-left">
                  <a href="perfil" class="btn btn-warning btn-flat">Editar Perfil</a>
                </div> 
                
                <div class="pull-right">
                  <a href="salir" class="btn btn-danger btn-flat">Cerrar Sesión</a>
                </div>

                
              </li>


            </ul>
			
			</li>

		</ul>

	</div>



	

	<nav>

</header>



