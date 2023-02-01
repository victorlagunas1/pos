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
      
      Nomina Usuarios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Nomina</li>
    
    </ol>



  </section>

  <section class="content">

    <div class="row">



      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-12 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border">
            <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarNomina">

            Agregar nomina

          </button>

          <a class="btn btn-app bg-yellow pull-right" href="comisiones" style="margin:0px 5px 0px 0px">
                <i class="fa fa-money"></i> Comisiones
              </a>


          </div>



          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
            
      <!--=====================================
      PESTAÑAS NOMINA
      ======================================-->

       <?php

                    $itemUsuario = null;
                    $valorUsuario = null;

                    $nomina = ControladorUsuarios::ctrMostrarNomina($itemUsuario, $valorUsuario);
       
                
                foreach ($nomina as $key => $value) {


                    $item = "id";
                    $valor = $value["id_usuario"];

                    $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            $item = "id";
            $valor = $value["id_sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
                  
        
        echo '<div class="box box-success">

            <div class="box-header with-border">

              <i class="fa fa-user "></i>

              <h3 class="box-title">'.$usuario["nombre"]." - ".$usuario["perfil"].'</h3>
              <h3 class="box-title pull-right">'.$sucursal["nombre"].'</h3>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
             
             

             <dl class="dl-horizontal col-xs-12 col-sm-3">

           
          <p class="lead">PERCEPCIONES</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>

               <tr>
                <th>Días laborados:</th>
                <td>'.$value["dias_laborados"].' días'.'</td>
              </tr>

              <tr>
                <th>Horas laboradas:</th>
                <td>'.$value["horas_laboradas"].' horas'.'</td>
              </tr>


                <th style="width:50%">Salario por hora:</th>
                <td>'.'$ '.number_format($value["salario_hora"],2).'</td>
              </tr>
              

              
              <tr>
                <th>Salario Diario:</th>
                <td>'.'$ '.number_format($value["salario_hora"]*$value["horas_laboradas"],2).'</td>
              </tr>
              
              <tr>
                <th>Bono de puntualidad:</th>
                <td>'.'$ '.number_format($value["salario_hora"]*$value["horas_laboradas"]*$value["dias_laborados"]*.15,2).'</td>
              </tr>

              <tr>
                <th>Bono de productividad:</th>
                <td>'.'$ '.number_format($value["salario_hora"]*$value["horas_laboradas"]*$value["dias_laborados"]*.05,2).'</td>
              </tr>

              <tr>
                <th>Metas alcanzadas:</th>
                <td>'.'$ '.number_format($value["salario_hora"]*$value["horas_laboradas"],2).'</td>
              </tr>

              <tr>
                <th>Total:</th>
                <td>'.'$ '.number_format($value["salario_hora"]*$value["horas_laboradas"]*$value["dias_laborados"],2).'</td>
              </tr>

            </tbody></table>
          </div>
        


        </dl>


                

                <dl class="dl-horizontal col-xs-12 col-sm-3">

             <p class="lead">DEDUCCIONES</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Adelantos:</th>
                <td>'.'$ '.number_format($value["salario_hora"],2).'</td>
              </tr>
              <tr>
                <th>Retardos</th>
                <td>'.$value["horas_laboradas"].'</td>
              </tr>
              <tr>
                <th>Descuentos:</th>
                <td>'.'$ '.number_format($value["salario_hora"]*$value["horas_laboradas"],2).'</td>
              </tr>
              <tr>
                <th>Bono de productividad:</th>
                <td>'.'$ '.number_format($value["salario_hora"]*$value["horas_laboradas"],2).'</td>
              </tr>

              <tr>
                <th>Metas:</th>
                <td>'.'$ '.number_format($value["salario_hora"]*$value["horas_laboradas"],2).'</td>
              </tr>

              <tr>
                <th>Total:</th>
                <td>'.'$ '.number_format($value["salario_hora"]*$value["horas_laboradas"],2).'</td>
              </tr>

            </tbody></table>
          </div>
        
                </dl>



              
              <dl class="dl-horizontal col-xs-12 col-sm-3">

              <div class="input-group input-group-sm">
                <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">Go!</button>
                    </span>
              </div>

            <!-- /.box-header -->
            <div class="box-body text-center">
              <p>Rendimiento semanal</p>

              <div class="progress vertical">
                <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="height: 40%">
                  <span class="sr-only">40%</span>
                </div>
              </div>
              <div class="progress vertical">
                <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="height: 10%">
                  <span class="sr-only">20%</span>
                </div>
              </div>
              <div class="progress vertical">
                <div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: 60%">
                  <span class="sr-only">60%</span>
                </div>
              </div>
              <div class="progress vertical">
                <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="height: 80%">
                  <span class="sr-only">80%</span>
                </div>
              </div>
            
            </dl>
            <!-- /.box-body -->





             <dl class="dl-horizontal col-xs-12 col-sm-3">

                <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-arrow-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">TOTAL PERCEPCIONES</span>
              <span class="info-box-number">$ 41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>


          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-arrow-down"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">total deducciones</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>


          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-usd"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">total neto</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>

            </dl>





            <dl class="dl-horizontal col-xs-12 col-sm-12">

          
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>

          </div>
          </dl>

          
              

           
            <!-- /.box-body -->
          </div>';

          }

?>


           
          </div>

        

        </form>

        

        </div>
            
      </div>


    </div>

    <!-- ===================
        AGREGAR USUARIO
    ============================ -->

    <!-- Modal -->
<div id="modalAgregarNomina" class="modal fade" role="dialog">
    
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

              
           <div class="form-group">
              
              <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-users"></i></span>

               <select class="form-control input-lg" name="nuevoPerfil" required="">

                <option value="">Selecionar usuario</option>


          <?php 
           
            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            
              foreach ($usuarios as $key => $value) {

            echo '
            
                <option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  
                   }
              ?>       

                </select>
              </div>

            </div>


               

          <!-- ENTRADA NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Dias laborados" autocomplete="off" required>
              



            </div>

          </div>


           <!-- ENTRADA NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Dias retardos" autocomplete="off" required>
              



            </div>

          </div>

                 <!-- ENTRADA NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Objetivos alcanzados" autocomplete="off" required>

            </div>

          </div>


          <!-- ENTRADA USUARIO -->

          <div class="form-group">
            
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Descuentos" id="nuevoUsuario" autocomplete="off" required>
              

            </div>

          </div>



           

          


        


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

   
  </section>

</div>