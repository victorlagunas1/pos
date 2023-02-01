<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductos(){


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

  				$stock = "<button data-toggle='modal' data-target='#modalSumarStock' class='btn btn-danger btnEditarStock' stockActual='".$productos[$i]["stock"]."' codigoProducto='".$productos[$i]["producto"]."' id='".$productos[$i]["id"]."'sucursal='".$_GET["idSucursal"]."' >".$productos[$i]["stock"]."</button>";

  			}else if($productos[$i]["stock"] >= 1 && $productos[$i]["stock"] <= 5){

  				$stock = "<button data-toggle='modal' data-target='#modalSumarStock' class='btn btn-warning btnEditarStock' stockActual='".$productos[$i]["stock"]."' codigoProducto='".$productos[$i]["producto"]."' id='".$productos[$i]["id"]."' sucursal='".$_GET["idSucursal"]."' >".$productos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button data-toggle='modal' data-target='#modalSumarStock' class='btn btn-success btnEditarStock' stockActual='".$productos[$i]["stock"]."' codigoProducto='".$productos[$i]["producto"]."' id='".$productos[$i]["id"]."' sucursal='".$_GET["idSucursal"]."' >".$productos[$i]["stock"]."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/

 
  		$perfil_id = $_GET["perfilId"];	

		if($perfil_id == "Administrador"){


			$botones = "<div class='btn-group'><button class='btn btn-primary btnEtiquetaProducto' idProducto='".$infoproducto["id"]."' idSucursal='".$_GET['idSucursal']."' modeloRecibido='".$infoproducto["id_modelo"]."' ><i class='fa fa-barcode'></i></button><button class='btn btn-warning btnEditarProducto' idProducto='".$infoproducto["id"]."' codigo='".$infoproducto["codigo"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto2' idProductoSucursal='".$productos[$i]["id"]."'><i class='fa fa-times'></i></button></div>";



		} else { 


		  	$botones = "<div class='btn-group'><button class='btn btn-primary btnEtiquetaProducto' idProducto='".$infoproducto["id"]."' modeloRecibido='".$infoproducto["id_modelo"]."' ><i class='fa fa-barcode'></i></button></div>";
		  
}


	if ($infoproducto["id_color"] != null) {

		  $item = "id";
          $valor = $infoproducto["id_color"];

          $color1 = ControladorCategorias::ctrMostrarDiseño($item, $valor);
          $color = $color1["diseño"];


	}else {

		$color = " ";


	}

//$nuevoCodigo = $infoproducto["id_modelo"].$infoproducto["id_categoria"].$infoproducto["id_color"];

		


		  	$datosJson .='[
			      
			      "<b ><h3>'.$productos[$i]["producto"].'</b></h3>",
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
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

