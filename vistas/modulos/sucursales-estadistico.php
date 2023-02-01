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
      
      Sucursales
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Sucursales</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">





      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-12 col-xs-12">
        
        <div class="box box-info">
          
          <div class="box-header with-border">


           
          <button type="button" class="btn btn-default pull-right" id="daterangeRendimientoSucursal-btn" name="daterangeRendimientoSucursal-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

          


          </div>



          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
            
      <!--=====================================
      PESTAÑAS NOMINA
      ======================================-->

       <?php



                    $item = null;
                    $valor = null;

                    $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

                
                foreach ($sucursal as $key => $value) {


         

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];
            $sucursal = $value["id"];
            $valorSumar = "ingreso";
            $concepto = "VENTA";

          }else{

            $fechaInicial = null;
            $fechaFinal = null;
            $sucursal = $value["id"];
            

          }

       
         




        
        echo '<div class="box box-warning">

            <div class="box-header with-border">

              <i class="fa fa-building-o"></i>

              <h3 class="box-title">'.$value["nombre"].'</h3>
          
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
             
             
             <dl class="dl-horizontal col-xs-12 col-sm-3">
       <p class="lead">INGRESOS</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>';

           $valorSumar = "ingreso";
            $concepto = "VENTA";

            $ventas = ControladorFinanzas::ctrRangoFechasRendimientoSucursal($fechaInicial, $fechaFinal, $sucursal, $valorSumar, $concepto);

             echo'  <tr>
                <th>VENTAS:</th>
                <td>$ '.number_format($ventas[0]["total"],2).'</td>
              </tr>';

            $valorSumar = "ingreso";
            $concepto = "REPARACIÓN";

            $reparaciones = ControladorFinanzas::ctrRangoFechasRendimientoSucursal($fechaInicial, $fechaFinal, $sucursal, $valorSumar, $concepto);

              echo' <tr>
                <th>REPARACIONES:</th>
                <td>$ '.number_format($reparaciones[0]["total"],2).'</td>
              </tr>

                <tr>
                <th>OTROS:</th>
                <td>$ '.$value["id"].'</td>
              </tr>



              

            </tbody></table>
          </div>
        


        </dl>




                

                <dl class="dl-horizontal col-xs-12 col-sm-3">

             <p class="lead">GASTOS</p>

          <div class="table-responsive">
            <table class="table">
              <tbody>';

            $valorSumar = "gasto";
            $concepto = "NOMINA";

            $nomina = ControladorFinanzas::ctrRangoFechasRendimientoSucursal($fechaInicial, $fechaFinal, $sucursal, $valorSumar, $concepto);
                
              echo '<tr>
                <th>NOMINA:</th>
                 <td>$ '.number_format($nomina[0]["total"],2).'</td>
              </tr>';

            $valorSumar = "gasto";
            $concepto = "RENTA";

            $renta = ControladorFinanzas::ctrRangoFechasRendimientoSucursal($fechaInicial, $fechaFinal, $sucursal, $valorSumar, $concepto);
              
              echo '<tr>
                <th>RENTA:</th>
                <td>$ '.number_format($renta[0]["total"],2).'</td>
              </tr>';
              
             
            $valorSumar = "gasto";
            $concepto = "GASTO";

            $gasto = ControladorFinanzas::ctrRangoFechasRendimientoSucursal($fechaInicial, $fechaFinal, $sucursal, $valorSumar, $concepto);


               echo'<tr>
                <th>OTROS:</th>
                 <td>$ '.number_format($gasto[0]["total"],2).'</td>
              </tr>
             

             

            </tbody></table>
          </div>
        
                </dl>

            


            <dl class="dl-horizontal col-xs-12 col-sm-3">




             
          <div class="col-md-12 col-xs-12">


            <p class="lead">CATEGORIAS MÁS VENDIDAS</p>

              <div class="box-body">
    
        <div class="row">

          <div class="col-md-12">

        <div class="chart-responsive">
              
                <canvas id="productosVendidos'.$sucursal.'" height="200"></canvas>
            
              </div>

          </div>

    </div>

    </div>';

$tabla = "ventas_stock";
$tipo = 0;

$productos = ModeloVentas::mdlRangoFechasReparacionesSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal, $tipo);

$colores = array("red","green","yellow","aqua","purple","blue","navy","yellow","black","gray");



echo "<script>
  
  var pieChartCanvas = $('#productosVendidos".$sucursal."').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [";



              


                  $listado = array();


                  foreach ($productos as $key => $value) {


                  $tabla = "productos";
                  $item = "codigo";
                  $valor = $value["codigo"];

                  $productosDatos = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);


                  //$valorCategoria = $productosDatos["id_categoria"];

                $itemReparacion = "id";
                $valorReparacion = $productosDatos["id_categoria"];

                $respuestaCategoria = ControladorCategorias::ctrMostrarCategorias($itemReparacion, $valorReparacion);


                  //array_push($listado,["id_categoria" => $productosDatos["id_categoria"], "categoria" => $respuestaCategoria["categoria"]]);
               


                  if (array_search($productosDatos["id_categoria"], array_column($listado, "id_categoria")) === false) {

                     array_push($listado,["id_categoria" => $productosDatos["id_categoria"], "categoria" => $respuestaCategoria["categoria"], "cantidad" => $value["cantidad"]]);

                 //  array_push($listado,[$respuestaCategoria["categoria"] => 1]);

                  } else {
                    
                   // $indice = array_search($productosDatos["id_categoria"], $listado);
                  
                   // for($var = 0; $var < count($listado); $var++) {

                     //$indice = array_search($respuestaCategoria["categoria"], array_column($listado, "cantidad"));
                   //  print_r($indice);
                     
                      $indice = array_search($productosDatos["id_categoria"], array_column($listado, "id_categoria"));

                       $listado[$indice]["cantidad"] = ($listado[$indice]["cantidad"] + $value["cantidad"]);

                      // }


                   //$indice2 = array_search($respuestaCategoria["categoria"], array_column($listado, "cantidad"));
                      
                      //$indice3 = 15;                    
                   // array_walk_recursive($listado, 'replacer');


                    
                

                    //array_replace($listado[$indice], ["cantidad" => 29]);

                     //array_push($listado,["id_categoria" => $productosDatos["id_categoria"], "categoria" => $respuestaCategoria["categoria"], "cantidad" => 3]);

                     

                   // array_push($listado,["id_categoria" => $productosDatos["id_categoria"], "categoria" => $respuestaCategoria["categoria"], "cantidad" => 10]);


                    //
                 // $indice = array_search($productosDatos["id_categoria"], array_column($listado, "id_categoria"));
                  //array_push($listado,["id_categoria" => $productosDatos["id_categoria"], "categoria" => $respuestaCategoria["categoria"], "cantidad" => 3]);
                 // $reemplazo = array($indice => ["id_categoria" => $productosDatos["id_categoria"], "categoria" => $respuestaCategoria["categoria"], "cantidad" => 12]);

 //                 array_replace($listado, $reemplazo);

            

                  }


                  


                  }



                  array_multisort(array_column($listado,"cantidad"), SORT_DESC, $listado);

                  

  
        
        for($i = 0; $i < 5; $i++){
                
        

              


    // echo "{
    //   value    : ".array_count_values(array_column($listado, "id_categoria"))[$listado[$i]["id_categoria"]].",
    //   color    : '".$colores[$i]."',
    //   highlight: '".$colores[$i]."',
    //   label    : '".array_column($listado, "categoria")[$listado[$i]["id_categoria"]]."'
    // },";

      echo "{
      value    : ".$listado[$i]["cantidad"].",
      color    : '".$colores[$i]."',
      highlight: '".$colores[$i]."',
      label    : '".$listado[$i]["categoria"]."'
    },";

  }
    

 
  echo " ];

  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------

</script>";


            

          echo' </div>


            </dl>



                 
              
               <dl class="dl-horizontal col-xs-12 col-sm-3">';

           

        $tabla = "ventas_stock";
        $tipo = 0;


        $ventasSucursal = ModeloVentas::mdlRangoFechasReparacionesSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal, $tipo);

        $ventasSucursal1 = count($ventasSucursal);

         echo '<div class="col-lg-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>'.number_format($ventasSucursal1,0).'</h3>

              <p>Ventas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
           
          </div>
        </div>';


        $tabla = "ventas_stock";
        $tipo = 1;


        $reparacionesSucursal = ModeloVentas::mdlRangoFechasReparacionesSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal, $tipo);

        $totalReparaciones = count($reparacionesSucursal);

        

        echo '<div class="col-lg-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>'.number_format($totalReparaciones,0).'</h3>

              <p>Reparaciones</p>
            </div>
            <div class="icon">
              <i class="ion ion-wrench"></i>
            </div>
         
          </div>
        </div>';

        $tabla = "usuarios";
        
        $item = "sucursal";
        $valor = $sucursal;


        $usuariosContar = ModeloUsuarios::mdlMostrarUsuariosSucursal($tabla, $item, $valor);

        



        echo '<div class="col-lg-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>'.count($usuariosContar).'</h3>

              <p>Empleados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
           
          </div>
        </div>

        
        
                </dl>





        





            <dl class="dl-horizontal col-xs-12 col-sm-12">

          
            <div class="box-footer">
              


        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
               <p>VENTAS</p>
              <h3>$ '.number_format($ventas[0]["total"]+$reparaciones[0]["total"],2).'</h3>

            </div>

            <div class="icon">
              <i class="ion ion-arrow-up-a"></i>
            </div>
           
          </div>
        </div>



        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
             <p>GASTOS</p>
              <h3>$ '.number_format($nomina[0]["total"]+$renta[0]["total"]+$gasto[0]["total"],2).'</h3>
            </div>
            <div class="icon">
              <i class="ion ion-arrow-down-a"></i>
            </div>
           
          </div>
        </div>




        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
             <p>UTILIDAD</p>
              <h3>$ '.number_format(($ventas[0]["total"]+$reparaciones[0]["total"])-($nomina[0]["total"]+$renta[0]["total"]+$gasto[0]["total"]),2).'</h3>
            </div>

            <div class="icon">
              <i class="ion ion-connection-bars"></i>
            </div>
           
          </div>
        </div>



                




          </div>
          </dl>

          
              

           
            <!-- /.box-body -->
          </div>';

         // print_r($listado);

          }



         

?>




           
          </div>

        

        </form>

        

        </div>
            
      </div>


    </div>
   
  </section>

</div>