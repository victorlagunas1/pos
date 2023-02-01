<?php

require_once "../controladores/refacciones.controlador.php";
require_once "../modelos/refacciones.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaRefaccionesSucursal{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaRefacciones(){
 

  		// $item = null;
  		// $valor = null;
  		// $sucursal = $_GET["idSucursal"];
 
  		// $refaccionesSucursal = ControladorRefacciones::ctrMostrarRefaccionesSucursal($item, $valor, $sucursal);


  		$item = null;
  		$valor = null;
  		$sucursal = $_GET["idSucursal"];
 
  		$refacciones = ControladorRefacciones::ctrMostrarRefacciones($item, $valor, $sucursal);

  		//var_dump($refacciones);

  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($refacciones); $i++){

		// $item = "codigo";
  // 		$valor = $refaccionesSucursal[$i]["codigo"];
  // 		$sucursal = $_GET["idSucursal"];
 
  // 		$refacciones = ControladorRefacciones::ctrMostrarRefacciones($item, $valor);

		  	
          if ($refacciones[$i]["id_modelo"] == "0"){
			
			$modelo1 = " ";
			$marca1 = " ";

			} else {
			/*=============================================
 	 		TRAEMOS EL MODELO
  			=============================================*/ 
		  	$item = "codigo";
		  	$valor = $refacciones[$i]["id_modelo"];

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
 	 		TRAEMOS LA CATEGORIA
  			=============================================*/ 
		  	$item = "id";
		  	$valor = $refacciones[$i]["id_categoria"];

		  	$categoria = ControladorRefacciones::ctrMostrarCategoriasRefacciones($item, $valor);

		  	/*=============================================
 	 		TRAEMOS STOCK POR SUCURSAL
  			=============================================*/ 
		  	
		$perfil_id = $_GET["perfilId"];	

		if($perfil_id == "Administrador"){


		  	if ($refacciones[$i]["stock"] != null && $refacciones[$i]["stock"] >= 1  && $refacciones[$i]["stock"] <= 9) {

		  		$stockSucursal1 =  "<div class='btn-group'><button class='btn btn-warning btnStockRefaccion' idRefaccion='".$refacciones[$i]["id"]."' data-toggle='modal' data-target='#modalSumarStock'><b>".$refacciones[$i]["stock"]."</b></button></div>"; 
		  	
		  	} else if ($refacciones[$i]["stock"] != null && $refacciones[$i]["stock"] >= 10) {

		  		$stockSucursal1 =  "<div class='btn-group'><button class='btn btn-success btnStockRefaccion' idRefaccion='".$refacciones[$i]["id"]."' data-toggle='modal' data-target='#modalSumarStock'><b>".$refacciones[$i]["stock"]."</b></button></div>"; 
		  	
		  	} else if ($refacciones[$i]["stock"] != null && $refacciones[$i]["stock"] == 0) {

		  		$stockSucursal1 =  "<div class='btn-group'><button class='btn btn-danger btnStockRefaccion' idRefaccion='".$refacciones[$i]["id"]."' data-toggle='modal' data-target='#modalSumarStock'><b>".$refacciones[$i]["stock"]."</b></button></div>"; 
		  	
		  	} else {
		  		$stockSucursal1 = "0";
		  		

		  	}
		  	
		  	}else{

		  		if ($refacciones[$i]["stock"] != null && $refacciones[$i]["stock"] >= 1  && $refacciones[$i]["stock"] <= 9) {

		  		$stockSucursal1 =  "<div class='btn-group'><button class='btn btn-warning btnStockRefaccion'><b>".$refacciones[$i]["stock"]."</b></button></div>"; 
		  	
		  	} else if ($refacciones[$i]["stock"] != null && $refacciones[$i]["stock"] >= 10) {

		  		$stockSucursal1 =  "<div class='btn-group'><button class='btn btn-success btnStockRefaccion'><b>".$refacciones[$i]["stock"]."</b></button></div>"; 
		  	
		  	} else if ($refacciones[$i]["stock"] != null && $refacciones[$i]["stock"] == 0) {

		  		$stockSucursal1 =  "<div class='btn-group'><button class='btn btn-danger btnStockRefaccion'><b>".$refacciones[$i]["stock"]."</b></button></div>"; 
		  	
		  	} else {
		  		$stockSucursal1 = "0";
		  		

		  	}



		  	}
		  	
		  	/*=============================================
 	 		SECCION DE REFACCION
  			=============================================*/ 

		  	if ($categoria["seccion"] != null){
		  

		  		$seccion =  "<div class='btn-group'><button class='btn btn-info btnSeccionRefaccion' idRefaccion='".$categoria["id"]."' seccionSeleccionada='".$categoria["seccion"]."' data-toggle='modal' data-target='#modalSeccionRefaccion' ><b>".$categoria["seccion"]."</b></button></div>"; 
		  	} else {
		  			$seccion =  "<div class='btn-group'><button class='btn btn-danger btnSeccionRefaccion' idRefaccion='".$categoria["id"]."' seccionSeleccionada='".$categoria["seccion"]."'data-toggle='modal' data-target='#modalSeccionRefaccion'><b>N/A</b></button></div>"; 
		  	}

		  	/*=============================================
 	 		BOTONES
  			=============================================*/ 


		if($perfil_id == "Administrador"){

		  		$botones =  "<div class='btn-group'><button class='btn btn-primary btnEtiquetaRefaccion' idRefaccion='".$refacciones[$i]["id"]."'><i class='fa fa-barcode'></i><button class='btn btn-warning btnEditarRefaccion' idRefaccion='".$refacciones[$i]["id"]."' data-toggle='modal' data-target='#modalEditarRefaccion'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarRefaccion' idRefaccion='".$refacciones[$i]["id"]."'><i class='fa fa-trash'></i></button></div>";  

				}else {
				$botones =  "<div class='btn-group'><button class='btn btn-primary btnEtiquetaRefaccion' idRefaccion='".$refacciones[$i]["id"]."'><i class='fa fa-barcode'></i></div>"; 

					}

			if ( $refacciones[$i]["id_variante"] != null){
				  $item = "id";
                  $valor = $refacciones[$i]["id_variante"];

                  $buscarVariante = ControladorRefacciones::ctrMostrarVariantesRefacciones($item, $valor);

                  $variante = $buscarVariante["variante"];

			} else {
				$variante = " ";
			}
			

		  	$datosJson .='[
			      "'.$seccion.'",
			      "'.$refacciones[$i]["codigo"].'",
			      "'.$categoria["categoria"].'",
			      "'.$marca1." ".$modelo1.'",
			      "'.$variante." ".$refacciones[$i]["descripcion"].'",
			      "'.$refacciones[$i]["estado"].'",
			      "'.$stockSucursal1.'",
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
$activarRefacciones = new TablaRefaccionesSucursal();
$activarRefacciones -> mostrarTablaRefacciones();

