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
      
      Comisiones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="crear-venta2"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Comisiones</li>
    
    </ol>

      <button type="button" class="btn btn-default pull-right" id="datarangeComisiones-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>



  </section>

  <section class="content">

    <div class="row">



      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-12 col-xs-12">
    
       



          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
            
      <!--=====================================
      PESTAÑAS NOMINA
      ======================================-->

       <?php
                    $tabla = "usuarios";
                     $item = "estado";
                     $valor = 1;
                     $orden = null;

                    $usuarios = ModeloCotizaciones::mdlMostrarFetchAll($tabla, $item, $valor,$orden);

                 //   $nomina = ControladorUsuarios::ctrMostrarNomina($itemUsuario, $valorUsuario);
       
                
                foreach ($usuarios as $key => $value) {


            if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];
            //$sucursal = $value["sucursal"];
            $valorSumar = "gasto";
             $concepto = "%COMISIÓN%".$value["nombre"]."%";

          }else{

            $fechaInicial = null;
            $fechaFinal = null;
             $valorSumar = "gasto";
            $concepto = "COMISIÓN%".$value["nombre"];
           
            

          }

        
            


                   

            $item = null;
            $valor = null;

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
                  
        
        echo '<div class="box box-primary">

            <div class="box-header with-border">

              <i class="fa fa-user "></i>

              <h3 class="box-title">'.$value["nombre"]." - ".$value["perfil"].'</h3>
              
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
             
             

             <dl class="dl-horizontal col-xs-12 col-sm-3">

           
          <p class="lead">COMISIONES</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>';

               $sumaTotalComisiones = 0;

               foreach ($sucursal as $key => $valueSucursal) {




            $sucursal = $valueSucursal["id"];

           

       $comision = ControladorFinanzas::ctrRangoFechasRendimientoSucursal($fechaInicial, $fechaFinal, $sucursal, $valorSumar, $concepto);


        $sumaTotalComisiones += $comision[0]["total"];

                   //ejempli idea
        
//var_dump($noRepetirFechas);
// termina idea
              

              echo '<tr>
                <th>'.$valueSucursal["nombre"].'</th>
                <td>'."$ ".number_format($comision[0]["total"],2).'</td>
              </tr>';
            }




        echo '<tr>
                <th>'."TOTAL:".'</th>
                <td><b>'."$ ".number_format($sumaTotalComisiones,2).'</b></td>
              </tr>


              </tbody></table>
          </div>
        


        </dl>


                
        <dl class="dl-horizontal col-xs-12 col-sm-5">';

        $tabla = "ingresosgastos";

        //$fechaInicial = "2021-05-26";
        //$fechaFinal = "2021-11-26";
         //$concepto = "COMISIÓN%".$value["nombre"];
        $comisionMes = ModeloFinanzas::mdlRangoFechasComisionesGrafico($tabla, $fechaInicial, $fechaFinal, $concepto);
       // var_dump($value["id"]);

$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMes = array();
//var_dump($respuesta);
  //var_dump($comisionMes);

foreach ($comisionMes as $key => $valueComision) {
  //var_dump($valueComision);

  #Capturamos sólo el año y el mes
  $fecha = substr($valueComision["fecha"],0,7);
  // var_dump($valueComision["fecha"]);

  #Introducir las fechas en arrayFechas
  array_push($arrayFechas, $fecha);

  #Capturamos las ventas
  $arrayVentas = array($fecha => $valueComision["gasto"]);


  #Sumamos los pagos que ocurrieron el mismo mes
  foreach ($arrayVentas as $key => $valueComision) {
    
    $sumaPagosMes[$key] += $valueComision;

  }
  //var_dump($valueComision);
  //var_dump($sumaPagosMes);

}


$noRepetirFechas = array_unique($arrayFechas);
var_dump($noRepetirFechas);

echo '<div class="box box-solid bg-blue-gradient">
  
  <div class="box-header">
    
    <i class="fa fa-th"></i>

      <h3 class="box-title">Gráfico de Comisiones</h3>

  </div>

  <div class="box-body border-radius-none nuevoGraficoVentas'.$value["id"].'>

    <div class="chart" id="line-chart-ventas'.$value["id"].'" style="height: 250px;"></div>

  </div>

</div>';
?>

<script>
  
 var line = new Morris.Line({
    element          : "line-chart-ventas<?php echo $value["id"]?>",
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

      foreach($noRepetirFechas as $key){

        echo "{ y: '".$key."', comisiones: ".$sumaPagosMes[$key]." },";


      }

      echo "{y: '".$key."', comisiones: ".$sumaPagosMes[$key]." }";

    }else{

       echo "{ y: '0', comisiones: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['comisiones'],
    labels           : ['comisiones'],
    lineColors       : ['#fff'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 15
  });

</script>



           
            
<?php

            echo '</dl>
            <!-- /.box-body -->
                <dl class="dl-horizontal col-xs-12 col-sm-6">';

            
            
             
                echo' </dl>



              
              
              

           
            <!-- /.box-body -->
          </div>';

          }




?>


           
          </div>

        

        </form>

        

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