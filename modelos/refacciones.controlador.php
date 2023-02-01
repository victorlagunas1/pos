<?php

class ControladorRefacciones{

	/*=============================================
	MOSTRAR REFACCIONES
	=============================================*/

	static public function ctrMostrarRefacciones($item, $valor, $sucursal){

		$tabla = "refacciones";

		$respuesta = ModeloRefacciones::mdlMostrarRefacciones($tabla, $item, $valor, $sucursal);

		return $respuesta;
	}



	/*=============================================
	MOSTRAR CATEGORIAS REFACCION
	=============================================*/

	static public function ctrMostrarCategoriasRefacciones($item, $valor){

		$tabla = "categorias_refacciones";

		$respuesta = ModeloRefacciones::mdlMostrarCategoriasRefacciones($tabla, $item, $valor);

		return $respuesta;
	
	}



	/*=============================================
	CREAR REFACCION
	=============================================*/

	static public function ctrCrearRefaccion(){


		if(isset($_POST["nuevoCodigoRefaccion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCodigoRefaccion"])){



				$codigo = $_POST["nuevaCategoriaRefaccion"].$_POST["nuevoModeloSelecionado"].$_POST["nuevaVariante"];

				$item = "codigo";
                $valor = $codigo;
                $sucursal = null;
               

               $buscarRefaccion = ControladorRefacciones::ctrMostrarRefacciones($item, $valor, $sucursal);



				if ($codigo != $buscarRefaccion["codigo"] && $_POST["idSucursal"] != $buscarRefaccion["id_sucursal"]) {

				$tabla = "refacciones";

				$datos = array("id_categoria" => $_POST["nuevaCategoriaRefaccion"],
							   "codigo" => $codigo,
							   "descripcion" => $_POST["nuevaDescripcionRefaccion"],
							   "id_modelo" => $_POST["nuevoModeloSelecionado"],
							   "id_sucursal" => $_POST["idSucursal"],
							   "estado" => $_POST["nuevoCondicionRefaccion"],
							   "id_variante" => $_POST["nuevaVariante"],
							  "stock" => $_POST["nuevoStockRefaccion"]);

				$respuesta = ModeloRefacciones::mdlIngresarRefaccion($tabla, $datos);


					$item = null;
                    $valor = null;
                    $sucursal = null;

                    $refacciones = ControladorRefacciones::ctrMostrarRefacciones($item, $valor, $sucursal);
                     
                     foreach ($refacciones as $key => $refaccionesId) {
                        
                      } 

                    $idRefaccioneTicket = $refaccionesId["id"];



				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Refaccion guardada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.open("extensiones/tcpdf/pdf/etiquetaRefaccion.php?codigo='.$idRefaccioneTicket.'","_blank");

										}
									})

						</script>';

				}

				}else if ($codigo == $buscarRefaccion["codigo"] && $_POST["idSucursal"] != $buscarRefaccion["id_sucursal"] ){


				$tabla = "refacciones";

				$datos = array("id_categoria" => $_POST["nuevaCategoriaRefaccion"],
							   "codigo" => $codigo,
							   "descripcion" => $_POST["nuevaDescripcionRefaccion"],
							   "id_modelo" => $_POST["nuevoModeloSelecionado"],
							   "id_sucursal" => $_POST["idSucursal"],
							   "estado" => $_POST["nuevoCondicionRefaccion"],
							   "id_variante" => $_POST["nuevaVariante"],
							  "stock" => $_POST["nuevoStockRefaccion"]);

				$respuesta = ModeloRefacciones::mdlIngresarRefaccion($tabla, $datos);


					$item = null;
                    $valor = null;
                    $sucursal = null;

                    $refacciones = ControladorRefacciones::ctrMostrarRefacciones($item, $valor, $sucursal);
                     
                     foreach ($refacciones as $key => $refaccionesId) {
                        
                      } 

                    $idRefaccioneTicket = $refaccionesId["id"];


				echo'<script>

						swal({

							  type: "warning",
							  title: "Producto actualizado correctamente.",
							  text: "El producto ya existe en otra sucursal, revisar y corregir datos.",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.open("extensiones/tcpdf/pdf/etiquetaRefaccion.php?codigo='.$idRefaccioneTicket.'","_blank");


										}
									})

						</script>';




			//}
			
			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Producto ya registrado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "#";

							}
						})

			  	</script>';


			}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "#";

							}
						})

			  	</script>';
			}
		}

	}



	/*=============================================
	ACTUALIZAR REFACCION
	=============================================*/

		static public function ctrActualizarRefaccion(){

		if(isset($_POST["idEditarRefaccion"])){
				
				$tabla = "refacciones";

				$datos = array(
							   "id" => $_POST["idEditarRefaccion"],
							   "estado" => $_POST["editarEstadoRefaccion"],
							   "descripcion" => $_POST["editarDescripcionRefaccion"],
							   "stock" => $_POST["editarStockRefaccion"]);


				$respuesta = ModeloRefacciones::mdlActualizarRefaccion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Refaccion Actualizada",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {


										window.location = "#";

										}
									})

						</script>';

				}
		
	
}
	}

	/*=============================================
	ACTUALIZAR STOCK REFACCION
	=============================================*/

		static public function ctrActualizarStockRefaccion(){

		if(isset($_POST["idRefaccionEditar"])){
				
				$tabla = "refacciones";

				$datos = array(
							   "id" => $_POST["idRefaccionEditar"],
							   "stock" => $_POST["stockEditarRefaccion"]);


				$respuesta = ModeloRefacciones::mdlActualizarStockRefaccion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Stock Actualizado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {


										window.location = "#";

										}
									})

						</script>';

				}
		
	
}
	}



	
	/*=============================================
	MOSTRAR STOCK REFACCIONES POR SUCURSAL
	=============================================*/

	static public function ctrMostrarStockRefacciones($item, $valor){

		$tabla = "stock_refacciones";

		$respuesta = ModeloRefacciones::mdlMostrarStockRefacciones($tabla, $item, $valor);

		return $respuesta;
	}


// 		/*=============================================
// 	AGREGAR PRODUCTO STOCK POR SUCURSAL ID STOCK 
// 	=============================================*/



// 		static public function ctrAgregarStockRefaccionSucursal(){

// 			if(isset($_POST["codigoRefaccion"])){

// 			$tabla = "stock_refacciones";

// 			$datos = array("id_sucursal" => $_SESSION['sucursal'],
// 							   "codigo" => $_POST["codigoRefaccion"],
// 							   "stock" => $_POST["stockRefaccion"]);


// 		$respuesta = ModeloRefacciones::mdlIngresarStockRefaccionSucursal($tabla, $datos);



// 		if($respuesta == "ok"){

// 					echo'<script>

// 						swal({

// 							  type: "success",
// 							  title: "El producto ha sido grabado correctamente",
// 							  showConfirmButton: true,
// 							  confirmButtonText: "Cerrar"
							  
// 							  }).then(function(result){
							  	
// 										if (result.value) {

// 										window.location = "#";

// 										}
// 									})

// 						</script>';

				


// 			}else{

// 				echo'<script>

// 					swal({
// 						  type: "error",
// 						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
// 						  showConfirmButton: true,
// 						  confirmButtonText: "Cerrar"
// 						  }).then(function(result){
// 							if (result.value) {

// 							window.location = "#";

// 							}
// 						})

// 			  	</script>';
// 			}

		

// 		return $respuesta;

// 	}

// }

	/*=============================================
	ACTUALIZAR SECCION REFACCION
	=============================================*/

// 		static public function ctrActualizarSeccionRefaccion(){

// 		if(isset($_POST["nuevaSeccion"])){
				
				
// 				$tabla = "refacciones";

// 				$datos = array(
// 							   "id" => $_POST["idRefaccion"],
// 							   "id_seccion" => $_POST["nuevaSeccion"]);

// 				$respuesta = ModeloCategorias::mdlActualizarSeccionRefaccion($tabla, $datos);

// 				if($respuesta == "ok"){

// 					echo'<script>

// 						swal({
// 							  type: "success",
// 							  title: "Seccion Actualizada",
// 							  showConfirmButton: true,
// 							  confirmButtonText: "Cerrar"
// 							  }).then(function(result){
// 										if (result.value) {


// 										window.location = "#";

// 										}
// 									})

// 						</script>';

// 				}
		
	
// }
// 	}


	/*=============================================
	BORRAR REFACCION
	=============================================*/
	static public function ctrEliminarRefaccion(){

		if(isset($_GET["idRefaccionEliminar"])){

			$tabla ="refacciones";
			
			$datos = $_GET["idRefaccionEliminar"];


			$respuesta = ModeloRefacciones::mdlEliminarRefaccion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								// window.location = "#";

								}
							})

				</script>';

			}		
		}


	}


	/*=============================================
	MOSTRAR VARIANTES REFACCION
	=============================================*/

	static public function ctrMostrarVariantesRefacciones($item, $valor){

		$tabla = "refacciones_variantes";

		$respuesta = ModeloRefacciones::mdlMostrarVariantesRefacciones($tabla, $item, $valor);

		return $respuesta;
	
	}


		/*=============================================
	CREAR VARIANTE
	=============================================*/

	static public function ctrCrearVarianteRefaccion(){


		if(isset($_POST["nuevaVariante"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaVariante"])){


				$tabla = "refacciones_variantes";

				$datos = array("variante" => $_POST["nuevaVariante"]);

				$respuesta = ModeloRefacciones::mdlIngresarVarianteRefaccion($tabla, $datos);




				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Variante guardada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "categorias-refacciones";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "#";

							}
						})

			  	</script>';
			}
		}

	}



	

}