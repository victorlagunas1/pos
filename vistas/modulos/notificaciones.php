<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Notificaciones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="crear-venta2"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Notificaciones</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">



      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-12 col-xs-12">
        
        <div class="box box-info">
          

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
            
      <!--=====================================
      PESTAÑAS NOMINA
      ======================================-->

       <?php

            $item = null;
            $valor = null;
            $status = 1;
            $usuario = $_SESSION["id"];
            $sucursal = $_SESSION["sucursal"];

            $notificaciones = ControladorUsuarios::ctrMostrarNotificaciones($item, $valor, $status, $usuario, $sucursal);
       
                
             
                foreach ($notificaciones as $key => $value) {


                   switch($value["tipo"]) {
                
                //PRODUCTO AGOTADO
                case 1:
                echo '

                  <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close btnBorrarNotificacion" idNotificacion="'.$value["id"].'"  data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> '.$value["titulo"].'</h4>
                '.$value["descripcion"].'
              </div> ';
                  break;

                  //PRODUCTO CERCA DE AGOTARSE 
                  case 2:
                  echo '
                     <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close btnBorrarNotificacion" idNotificacion="'.$value["id"].'" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-shopping-cart"></i> '.$value["titulo"].'</h4>
                '.$value["descripcion"].'
              </div>
                  ';
                  break;

                  //META ALCANZADA 
                   case 3:
                  echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close btnBorrarNotificacion" idNotificacion="'.$value["id"].'" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-star"></i> '.$value["titulo"].'</h4>
                '.$value["descripcion"].'
              </div>';
                  break;

                   //CUMPLEAÑOS CERCANO
                   case 4:
                  echo '<div class="alert alert-info alert-dismissible">
                <button type="button" class="close btnBorrarNotificacion" idNotificacion="'.$value["id"].'" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-birthday-cake"></i> '.$value["titulo"].'</h4>
                '.$value["descripcion"].'
              </div>';
                  break;

                   //OBJETIVO ALCANZADO
                   case 5:
                  echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close btnBorrarNotificacion" idNotificacion="'.$value["id"].'" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-star"></i> '.$value["titulo"].'</h4>
                '.$value["descripcion"].'
              </div>';
                  break;

                }



        


          }

?>


           
          </div>

        

        </form>

        

        </div>
            
      </div>


    </div>
   
  </section>

</div>