<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class TablaProductosTotal{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductosTotal(){

  		  

  		$item = null;
    	$valor = null;
    	$orden = "id";

  		$productos = ControladorProductos::ctrMostrarStockProductosSucursal($item, $valor, $orden);

  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	

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



          if ($infoproducto["id_modelo"] == "0"){
			
			$modelo1 = " ";
			$marca1 = " ";


			} else {
			/*=============================================
 	 		TRAEMOS EL MODELO
  			=============================================*/ 

		  	$item = "codigo";
		  	$valor = $infoproducto["id_modelo"];

		  	$modelo = ControladorCategorias::ctrMostrarModelos($item, $valor);


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
    		if($productos[$i]["stock"] <= 0){

  				$stock = "<button data-toggle='modal' data-target='#modalSumarStock' class='btn btn-danger btnEditarStock' stockActual='".$productos[$i]["stock"]."' codigoProducto='".$productos[$i]["producto"]."' id='".$productos[$i]["id"]."' >".$productos[$i]["stock"]."</button>";

  			}else if($productos[$i]["stock"] >= 1 && $productos[$i]["stock"] <= 5){

  				$stock = "<button data-toggle='modal' data-target='#modalSumarStock' class='btn btn-warning btnEditarStock' stockActual='".$productos[$i]["stock"]."' codigoProducto='".$productos[$i]["producto"]."' id='".$productos[$i]["id"]."'  >".$productos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button data-toggle='modal' data-target='#modalSumarStock' class='btn btn-success btnEditarStock' stockActual='".$productos[$i]["stock"]."' codigoProducto='".$productos[$i]["producto"]."' id='".$productos[$i]["id"]."'  >".$productos[$i]["stock"]."</button>";

  			}

  				

	if ($infoproducto["id_color"] != null) {

		  $item = "id";
          $valor = $infoproducto["id_color"];

          $color1 = ControladorCategorias::ctrMostrarDiseño($item, $valor);
          $color = $color1["diseño"];


	}else {

		$color = " ";


	}

	/*=============================================
 	 		TRAEMOS LA SUCURSAL SUCURSAL
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $productos[$i]["id_sucursal"];

		  	$sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);




// $agregarSucursal = "<div class='btn-group'><button class='btn btn-warning btnEtiquetaProducto' idProducto='".$productos[$i]["id"]."' modelo='".$productos[$i]["id_modelo"]."' ><i class='fa fa-plus'></i></button></div>";

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/


			$botones = "<div class='btn-group'><button class='btn btn-primary btnEtiquetaProducto' idProducto='".$infoproducto["id"]."' idSucursal='".$productos[$i]['id_sucursal']."' ><i class='fa fa-barcode'></i></button><button class='btn btn-success btnSucursalProducto' idProducto='".$productos[$i]["id"]."' codigoProductoTotal='".$productos[$i]["producto"]."' data-toggle='modal' data-target='#modalAgregarStockSucursal' ><i class='fa fa-plus'></i></button><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["producto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["producto"]."' imagen='".$infoproducto["imagen"]."'><i class='fa fa-times'></i></button></div>";


			// ELIMINAR PRODUCTO DESDE PRODUCTOS CON IMAGEN
			//<button class='btn btn-danger btnEliminarProducto' idProducto='".$infoproducto["id"]."' codigo='".$infoproducto["codigo"]."' imagen='".$infoproducto["imagen"]."'><i class='fa fa-times'></i></button>



		  	$datosJson .='[
			      
			      "<b ><h3>'.$productos[$i]["producto"].'</b></h3>",
			      "'.$sucursal["nombre"].'",
			      "'.$stock.'",
			      "'.$categorias["categoria"].'",
			      "'.$marca1." ".$modelo1.'",
			     "'.$color." ".$infoproducto["descripcion"].'",
			      "<b>'."$ ".number_format($infoproducto["precio_venta"],2).'</b>",
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
$activarProductos = new TablaProductosTotal();
$activarProductos -> mostrarTablaProductosTotal();

