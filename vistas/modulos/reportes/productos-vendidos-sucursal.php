<?php

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}



$orden = "ventas";
//$sucursal = "";
$tabla = "productos";

$productos = ModeloProductos::mdlMostrarProductosMasVendidos($tabla, $orden, $fechaInicial, $fechaFinal);

$colores = array("red","green","yellow","aqua","purple","blue","navy","yellow","black","gray");

$totalVentas = ControladorProductos::ctrMostrarSumaVentas();


?>

<!--=====================================
PRODUCTOS MÁS VENDIDOS
======================================-->



	<div class="box-body">
    
      	<div class="row">

	        <div class="col-md-12">

	 			<div class="chart-responsive">
	            
	            	<canvas id="productosVendidos" height="200"></canvas>
	          
	          	</div>

	        </div>

		</div>

    </div>



<script>
	
  var pieChartCanvas = $('#productosVendidos').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [

  <?php

  for($i = 0; $i < 10; $i++){

                  $itemReparacion = "id";
                  $valorReparacion = $productos[$i]["id_categoria"];

                  $respuestaCategoria = ControladorCategorias::ctrMostrarCategorias($itemReparacion, $valorReparacion);

                  $item = "id";
                  $valor = $productos[$i]["id_color"];

                  $respuestaDiseño = ControladorCategorias::ctrMostrarDiseño($item, $valor);

    echo "{
      value    : ".$productos[$i]["ventas"].",
      color    : '".$colores[$i]."',
      highlight: '".$colores[$i]."',
      label    : '".$respuestaCategoria["categoria"]." ".$respuestaDiseño["diseño"]." ".$productos[$i]["descripcion"]."'
    },";

  }
    
   ?>
  ];

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

</script>