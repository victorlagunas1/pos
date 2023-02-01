<?php

$item = null;
$valor = null;
$orden = "id";

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

 ?>


<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Productos Agregados Recientemente</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

      <button type="button" class="btn btn-box-tool" data-widget="remove">

        <i class="fa fa-times"></i>

      </button>

    </div>

  </div>
  
  <div class="box-body">

    <ul class="products-list product-list-in-box">

    <?php

  
    for($i = 0; $i < 10; $i++){

      echo '<li class="item">
        <div class="product-img"> ';
   
         if($productos[$i]["imagen"] != ""){

            echo '<img src="'.$productos[$i]["imagen"].'" alt="Product Image">';

          }else{


            echo '<img src="vistas/img/productos/default/anonymous.png" alt="Product Image">';

          }

          echo '</div>';

           if ($productos[$i]["id_modelo"] != "0"){

       

      

//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS MODELOS


$itemReparacion = "codigo";
$valorReparacion = $productos[$i]["id_modelo"];

$respuestaModelo = ControladorCategorias::ctrMostrarModelos($itemReparacion, $valorReparacion);


//REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS CATEGORIAS

$itemReparacion = "id";
$valorReparacion = $respuestaModelo[$i]["id_marca"];

$respuestaMarca = ControladorCategorias::ctrMostrarMarcas($itemReparacion, $valorReparacion);



 //REQUERIMOS LA CONFIGURACION DE LOS DATOS, OBTENIENDO LOS VALORES DESDE LA BASE DE DATOS CATEGORIAS

$itemReparacion = "id";
$valorReparacion = $productos[$i]["id_categoria"];

$respuestaCategoria = ControladorCategorias::ctrMostrarCategorias($itemReparacion, $valorReparacion);

                  $item = "id";
                  $valor = $productos[$i]["id_color"];

                  $respuestaDiseño = ControladorCategorias::ctrMostrarDiseño($item, $valor);

    $modelo = $respuestaModelo["modelo"];
    $marca = $respuestaMarca["marca"];
    $categoria = $respuestaCategoria["categoria"];
    $diseño = $respuestaDiseño["diseño"];

    } else {


    }

 
       echo '

      
              <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">'.$categoria." ".$diseño.'
                      <span class="label label-warning pull-right">$'.$productos[$i]["precio_venta"].'</span></a>
                    <span class="product-description">
                          '.$marca." ".$modelo." ".$productos[$i]["descripcion"].'
                        </span>
                  </div>



                  
      </li>';

      

    }

    ?>

    </ul>

  </div>

  <div class="box-footer text-center">

    <a href="productos" class="uppercase">Ver todos los productos</a>
  
  </div>

</div>
