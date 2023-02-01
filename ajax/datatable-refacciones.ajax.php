<?php

require_once "../controladores/refacciones.controlador.php";
require_once "../modelos/refacciones.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";



class TablaRefacciones{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaRefacciones(){


 
  		$item = null;
  		$valor = null;
  		$sucursal = null;
 
  		$refacciones = ControladorRefacciones::ctrMostrarRefacciones($item, $valor, $sucursal);



  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($refacciones); $i++){

		  	
	
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

	

		  	if ($refacciones[$i]["stock"] != null && $refacciones[$i]["stock"] >= 1  && $refacciones[$i]["stock"] <= 9) {

		  		$stockSucursal1 =  "<div class='btn-group'><button class='btn btn-warning btnStockRefaccion' idRefaccion='".$refacciones[$i]["id"]."' data-toggle='modal' data-target='#modalSumarStock'><b>".$refacciones[$i]["stock"]."</b></button></div>"; 
		  	
		  	} else if ($refacciones[$i]["stock"] != null && $refacciones[$i]["stock"] >= 10) {

		  		$stockSucursal1 =  "<div class='btn-group'><button class='btn btn-success btnStockRefaccion' idRefaccion='".$refacciones[$i]["id"]."' data-toggle='modal' data-target='#modalSumarStock'><b>".$refacciones[$i]["stock"]."</b></button></div>"; 
		  	
		  	} else if ($refacciones[$i]["stock"] != null && $refacciones[$i]["stock"] == 0) {

		  		$stockSucursal1 =  "<div class='btn-group'><button class='btn btn-danger btnStockRefaccion' idRefaccion='".$refacciones[$i]["id"]."' data-toggle='modal' data-target='#modalSumarStock'><b>".$refacciones[$i]["stock"]."</b></button></div>"; 
		  	
		  	} else {
		  		$stockSucursal1 = "0";
		  		

		  	}

		  	
		  		/*=============================================
 	 		SECCION DE REFACCION
  			=============================================*/ 

		  	if ($refacciones[$i]["id_seccion"] != 0){
		  	
		  	$item = "id";
          	$valor = $refacciones[$i]["id_seccion"];

          $seccionRefaccion = ControladorCategorias::ctrMostrarSeccionRefacciones($item, $valor);

		  		$seccion =  "<div class='btn-group'><button class='btn btn-info btnSeccionRefaccion' idRefaccion='".$refacciones[$i]["id"]."' seccionSeleccionada='".$refacciones[$i]["id_seccion"]."' data-toggle='modal' data-target='#modalSeccionRefaccion' ><b>".$seccionRefaccion["seccion"]."</b></button></div>"; 
		  	} else {
		  			$seccion =  "<div class='btn-group'><button class='btn btn-danger btnSeccionRefaccion' idRefaccion='".$refacciones[$i]["id"]."' seccionSeleccionada='".$refacciones[$i]["id_seccion"]."'data-toggle='modal' data-target='#modalSeccionRefaccion'><b>N/A</b></button></div>"; 
		  	}


		  	$item = "id";
            $valor = $refacciones[$i]["id_sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);


		  	/*=============================================
 	 		BOTONES
  			=============================================*/ 
		$perfil_id = $_GET["perfilId"];	

		if($perfil_id == "Administrador"){


		  		$botones =  "<div class='btn-group'><button class='btn btn-primary btnEtiquetaRefaccion' idRefaccion='".$refacciones[$i]["id"]."'><i class='fa fa-barcode'></i><button class='btn btn-warning btnEditarRefaccion' idRefaccion='".$refacciones[$i]["id"]."' data-toggle='modal' data-target='#modalEditarRefaccion'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarRefaccion' idRefaccion='".$refacciones[$i]["id"]."'><i class='fa fa-trash'></i></button></div>";  

				}else {
				$botones =  "<div class='btn-group'><button class='btn btn-primary btnEtiquetaRefaccion' idRefaccion='".$refacciones[$i]["id"]."'><i class='fa fa-barcode'></i></div>"; 

					}

		  	$datosJson .='[
			      "'.$seccion.'",
			      "'.$refacciones[$i]["codigo"].'",
			      "'.$categoria["categoria"].'",
			      "'.$marca1." ".$modelo1.'",
			      "'.$refacciones[$i]["descripcion"].'",
			      "'.$refacciones[$i]["estado"].'",
			      "'.$stockSucursal1.'",
			       "'.$sucursal["nombre"].'",
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
$activarRefacciones = new TablaRefacciones();
$activarRefacciones -> mostrarTablaRefacciones();

