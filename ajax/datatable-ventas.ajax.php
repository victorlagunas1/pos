<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductosVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductosVentas(){

		
  		if(isset($_GET["idSucursal"]) != null){


  		$item = null;
	
    	$valor = $_GET["idSucursal"];

    	$orden = "id";


  		} else {

  		$item = null;
	
    	$valor = null;

    	$orden = "id";


  		}


  		$productos = ControladorProductos::ctrMostrarStockProductosSucursal($item, $valor, $orden);


  		



  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	

		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	//$item = "codigo";
		  	//$valor = $productos[$i]["producto"];

		  	//$categorias = ControladorCategorias::mdlMostrarProductos($item, $valor);


			
			/*=============================================
 	 		TRAEMOS EL PRODUCTO
  			=============================================*/ 

		  	$item = "codigo";
		  	$valor = $productos[$i]["producto"];

		  	$infoproducto = ControladorProductos::ctrMostrarProductos($item, $valor);



	  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $infoproducto["id_categoria"];

		  	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);



          if ($infoproducto["id_modelo"] === "0"){
			
			$modelo1 = " ";
			//$modelo = " ";
			$marca1 = " ";


			} else {
			/*=============================================
 	 		TRAEMOS EL MODELO
  			=============================================*/ 

		  	$item = "codigo";
		  	$valor = $infoproducto["id_modelo"];

		  	$modelo = ControladorCategorias::ctrMostrarModelos($item, $valor);

		  	//$modelo = $modelo["modelo"];


			/*=============================================
 	 		TRAEMOS EL MARCA
  			=============================================*/

		  $item = "id";
          $valor = $modelo["id_marca"];

          $marcas = ControladorCategorias::ctrMostrarMarcas($item, $valor);


			$modelo1 = $modelo["modelo"];
			$marca1 = $marcas["marca"];


			}



	
		  	/*=============================================
 	 		STOCK
  			=============================================*/ 


    			if($productos[$i]["stock"] <= 3){


  				$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

  			}else if($productos[$i]["stock"] > 3 && $productos[$i]["stock"] <= 10){

  				$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";

  			}



  			if ($infoproducto["id_color"] != null) {

		  $item = "id";
          $valor = $infoproducto["id_color"];

          $color1 = ControladorCategorias::ctrMostrarDiseño($item, $valor);
          $color = $color1["diseño"];
			
			}else {
			
			$color = " ";
	}



		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$infoproducto["id"]."' stockProducto='".$productos[$i]["stock"]."' modeloProducto='".$modelo1."' categoriaProducto='".$categorias["categoria"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			      "<b><h3>'.$productos[$i]["producto"].'</b></h3>",
			      "<b>'.$categorias["categoria"]."</b> ".$marca1." ".$modelo1.'",
			      "'.$color." ".$infoproducto["descripcion"].'",
			      "'.$stock.'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();

