<?php

class ControladorCategorias{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearCategoria(){

		if(isset($_POST["nuevaCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])){


				$item = "categoria";
				$valor = $_POST["nuevaCategoria"];

				$existeCategoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);



				if ($existeCategoria["categoria"] != $_POST["nuevaCategoria"]){


				$tabla = "categorias";

				$datos = $_POST["nuevaCategoria"];

				$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';


				}

			} else {

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría ya existe!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';


			}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;
	
	} 

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarCategoria(){

		if(isset($_POST["editarCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

				$tabla = "categorias";

				$datos = array("categoria"=>$_POST["editarCategoria"],
								"dias_garantia"=>$_POST["editarDiasGarantia"],
							   "id"=>$_POST["idCategoria"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarCategoria(){

		if(isset($_GET["idCategoria"])){

			$item ="id_categoria";
			$valor = $_GET["idCategoria"];

			$categoriaVinculada = ControladorProductos::ctrMostrarProductos($item, $valor);

			if ($categoriaVinculada["id_categoria"] != $_GET["idCategoria"]){

			$tabla ="categorias";
			$datos = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}

		}else{

			echo'<script>

					swal({
						  type: "error",
						  title: "Categoria vinculada a productos",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';



		}
		}
		
	}


	/*=============================================
	MOSTRAR MARCAS
	=============================================*/

	static public function ctrMostrarMarcas($item, $valor){

		$tabla = "marcas";

		$respuesta = ModeloCategorias::mdlMostrarMarcas($tabla, $item, $valor);

		return $respuesta;
	
	}




	/*=============================================
	CREAR MARCA
	=============================================*/

	static public function ctrCrearMarca(){

		if(isset($_POST["nuevaMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"])){

				$marca1 = $_POST["nuevaMarca"];

				$item = "marca";
				$valor = $marca1;

				$existeMarca = ControladorCategorias::ctrMostrarMarcas($item, $valor);
				
				//echo '<script language="javascript">alert("'.$existeMarca["marca"]." ".$_POST["nuevaMarca"]. '");</script>';


				if ($_POST["nuevaMarca"] != null && $existeMarca["marca"] != $_POST["nuevaMarca"]){


				$tabla = "marcas";

				$datos = $_POST["nuevaMarca"];

				$respuesta = ModeloCategorias::mdlIngresarMarca($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Nueva marca guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "marca-modelos";

									}
								})

					</script>';

				}

							}else {

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría ya existe!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "marca-modelos";

									}
								})

					</script>';


			}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "marca-modelos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	EDITAR MARCA
	=============================================*/

	static public function ctrEditarMarca(){

		if(isset($_POST["editarMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])){

				$tabla = "marcas";

				$datos = array("marca"=>$_POST["editarMarca"],
							   "id"=>$_POST["idMarcaEditar"]);

				$respuesta = ModeloCategorias::mdlEditarMarca($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "marca-modelos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "marca-modelos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR MARCA
	=============================================*/

	static public function ctrBorrarMarca(){

		if(isset($_GET["idMarcaEditar"])){

			$item ="id_marca";
			$valor = $_GET["idMarcaEditar"];

			$modeloVinculado = ControladorCategorias::ctrMostrarModelos($item, $valor);

			if ($modeloVinculado["id_marca"] != $_GET["idMarcaEditar"]){

			$tabla ="marcas";
			$datos = $_GET["idMarcaEditar"];

			$respuesta = ModeloCategorias::mdlBorrarMarca($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La marca ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "marca-modelos";

									}
								})

					</script>';
			}
		}else {
			echo'<script>

					swal({
						  type: "error",
						  title: "La marca contiene modelos vinculados",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "marca-modelos";

									}
								})

					</script>';



		}
		}
		
	}



		/*=============================================
	MOSTRAR MODELOS
	=============================================*/

	static public function ctrMostrarModelos($item, $valor){

		$tabla = "modelos";

		$respuesta = ModeloCategorias::mdlMostrarModelos($tabla, $item, $valor);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR MODELOS VINCULADOS A MARCA
	=============================================*/

	static public function ctrMostrarModelosMarca($item, $valor){

		$tabla = "modelos";

		$respuesta = ModeloCategorias::mdlMostrarModelosEnMarcas($tabla, $item, $valor);

		return $respuesta;
	
	}







		/*=============================================
	MOSTRAR ESPECIFICO
	=============================================*/

	static public function ctrMostrarModelosEspecifico($item, $valor){

		$tabla = "modelos";

		$respuesta = ModeloCategorias::mdlMostrarModelosEspecifico($tabla, $item, $valor);

		return $respuesta;
	
	}


		/*=============================================
	CREAR MODELOS
	=============================================*/

	static public function ctrCrearModelo(){

		if(isset($_POST["nuevoModelo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoModelo"])){

					

				$ruta = "vistas/img/productos/default/anonymous.png";
				

			   	if(isset($_FILES["nuevaImagenModelo"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImagenModelo"]["tmp_name"]);
					var_dump("se ejecuta 1");

					$nuevoAncho = 960;
					$nuevoAlto = 1340;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/modelos/".$_POST["nuevoCodigo"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaImagenModelo"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/modelos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagenModelo"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImagenModelo"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/modelos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagenModelo"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}



				$tabla = "modelos";

					$datos = array("id_marca" => $_POST["seleccionMarca"],
							   "codigo" => $_POST["nuevoCodigo"],
							   "modelo" => $_POST["nuevoModelo"],
							   "imagen" => $ruta);

				$respuesta = ModeloCategorias::mdlIngresarModelos($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "marca-modelos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "marca-modelos";

							}
						})

			  	</script>';

			}

		}

	}


	/*=============================================
	EDITAR MODELO
	=============================================*/

	static public function ctrEditarModelo(){

		if(isset($_POST["editarModelo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarModelo"])){



				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = $_POST["imagenActual"];

			   	if(isset($_FILES["editarImagenModelo"]["tmp_name"]) && !empty($_FILES["editarImagenModelo"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagenModelo"]["tmp_name"]);

					$nuevoAncho = 960;
					$nuevoAlto = 1340;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/modelos/".$_POST["editarCodigo"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png"){

						unlink($_POST["imagenActual"]);

					}else{

						mkdir($directorio, 0755);	
					
					}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagenModelo"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/modelos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagenModelo"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagenModelo"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/modelos/".$_POST["editarCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagenModelo"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}



				$tabla = "modelos";

				$datos = array("id_marca"=>$_POST["editarMarcaModelo"],
					"codigo"=>$_POST["editarCodigo"],
					"modelo"=>$_POST["editarModelo"],
					"imagen"=>$ruta,
					"id"=>$_POST["idModeloEditar2"]);



				$respuesta = ModeloCategorias::mdlEditarModelos($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Modelo modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "marca-modelos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "marca-modelos";

							}
						})

			  	</script>';

			}

		}

	}


		/*=============================================
	BORRAR MODELO
	=============================================*/

	static public function ctrBorrarModelo(){

		if(isset($_GET["idModeloEditar"])){

			$item ="id";
			$valor = $_GET["idModeloEditar"];

			$mostrarModelo = ControladorCategorias::ctrMostrarModelos($item, $valor);

			$item ="id_modelo";
			$valor = $mostrarModelo["codigo"];

			$modeloVinculado = ControladorProductos::ctrMostrarProductos($item, $valor);

			if ($modeloVinculado["id_modelo"] != $mostrarModelo["codigo"]){

			$tabla ="modelos";
			$datos = $_GET["idModeloEditar"];

			$respuesta = ModeloCategorias::mdlBorrarModelo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "Modelo borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "marca-modelos";

									}
								})

					</script>';
			}
		}else {

			echo'<script>

					swal({
						  type: "error",
						  title: "Modelo vinculado a productos",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "marca-modelos";

									}
								})

					</script>';



		}
		}
		
	}





	/*=============================================
	MOSTRAR CATEGORIAS DE REFACCIONES
	=============================================*/

	 static public function ctrMostrarCategoriasRefacciones($item, $valor){

	 	$tabla = "categorias_refacciones";

	 	$respuesta = ModeloCategorias::mdlMostrarCategoriasRefacciones($tabla, $item, $valor);

	 	return $respuesta;
	
	} 

	/*=============================================
	CREAR CATEGORIAS REFACCIONES
	=============================================*/

	static public function ctrCrearCategoriaRefacciones(){

		if(isset($_POST["nuevaCategoriaRefaccion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoriaRefaccion"])){

				$tabla = "categorias_refacciones";

				$datos = array("categoria"=>$_POST["nuevaCategoriaRefaccion"],
							   "seccion"=>$_POST["nuevaSeccionRefaccion"]);

				$respuesta = ModeloRefacciones::mdlIngresarCategoriaRefaccion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
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
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias-refacciones";

							}
						})

			  	</script>';

			}

		}

	}


		/*=============================================
	EDITAR CATEGORIA REFACCIONES
	=============================================*/

	static public function ctrEditarCategoriaRefacciones(){

		if(isset($_POST["editarCategoriaRefacciones"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoriaRefacciones"])){

				$tabla = "categorias_refacciones";

				$datos = array("categoria"=>$_POST["editarCategoriaRefacciones"],
							"seccion"=>$_POST["editarSeccionRefacciones"],
							   "id"=>$_POST["idCategoriaRefacciones"]);

				$respuesta = ModeloCategorias::mdlEditarCategoriaRefacciones($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
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
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias-refacciones";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarCategoriaRefacciones(){

		if(isset($_GET["idCategoriaRefacciones"])){



			$tabla ="categorias_refacciones";
			$datos = $_GET["idCategoriaRefacciones"];

			$respuesta = ModeloCategorias::mdlBorrarCategoriaRefacciones($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias-refacciones";

									}
								})

					</script>';
			}
		}
		
	}



	/*=============================================
	MOSTRAR SECCION DE REFACCIONES
	=============================================*/

	// static public function ctrMostrarSeccionRefacciones($item, $valor){

	// 	$tabla = "seccion_refacciones";

	// 	$respuesta = ModeloCategorias::mdlMostrarSeccionRefacciones($tabla, $item, $valor);

	// 	return $respuesta;
	
	// } 

	// /*=============================================
	// CREAR SECCION REFACCIONES
	// =============================================*/

	// static public function ctrCrearSeccionRefacciones(){

	// 	if(isset($_POST["nuevaSeccion"])){

	// 		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaSeccion"])){

	// 			$tabla = "seccion_refacciones";

	// 			$datos = array("seccion"=>$_POST["nuevaSeccion"],
	// 						   "id_categoria"=>$_POST["nuevaCategoriaSeccion"]);

	// 			$respuesta = ModeloCategorias::mdlIngresarSeccion($tabla, $datos);

	// 			if($respuesta == "ok"){

	// 				echo'<script>

	// 				swal({
	// 					  type: "success",
	// 					  title: "La sección ha sido guardada correctamente",
	// 					  showConfirmButton: true,
	// 					  confirmButtonText: "Cerrar"
	// 					  }).then(function(result){
	// 								if (result.value) {

	// 								window.location = "categorias-refacciones";

	// 								}
	// 							})

	// 				</script>';

	// 			}


	// 		}else{

	// 			echo'<script>

	// 				swal({
	// 					  type: "error",
	// 					  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
	// 					  showConfirmButton: true,
	// 					  confirmButtonText: "Cerrar"
	// 					  }).then(function(result){
	// 						if (result.value) {

	// 						window.location = "categorias-refacciones";

	// 						}
	// 					})

	// 		  	</script>';

	// 		}

	// 	}

	// }


	// /*=============================================
	// EDITAR SECCION REFACCIONES
	// =============================================*/

	// static public function ctrEditarSeccionRefacciones(){

	// 	if(isset($_POST["editarSeccion"])){

	// 		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoriaSeccion"])){

	// 			$tabla = "seccion_refacciones";

	// 			$datos = array("id_categoria"=>$_POST["editarCategoriaSeccion"],
	// 				"seccion"=>$_POST["editarSeccion"],
	// 						   "id"=>$_POST["idSeccion"]);

	// 			$respuesta = ModeloCategorias::mdlEditarSeccionRefacciones($tabla, $datos);

	// 			if($respuesta == "ok"){

	// 				echo'<script>

	// 				swal({
	// 					  type: "success",
	// 					  title: "La categoría ha sido cambiada correctamente",
	// 					  showConfirmButton: true,
	// 					  confirmButtonText: "Cerrar"
	// 					  }).then(function(result){
	// 								if (result.value) {

	// 								window.location = "categorias-refacciones";

	// 								}
	// 							})

	// 				</script>';

	// 			}


	// 		}else{

	// 			echo'<script>

	// 				swal({
	// 					  type: "error",
	// 					  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
	// 					  showConfirmButton: true,
	// 					  confirmButtonText: "Cerrar"
	// 					  }).then(function(result){
	// 						if (result.value) {

	// 						window.location = "categorias-refacciones";

	// 						}
	// 					})

	// 		  	</script>';

	// 		}

	// 	}

	// }

	// /*=============================================
	// BORRAR CATEGORIA
	// =============================================*/

	// static public function ctrBorrarSeccionRefacciones(){

	// 	if(isset($_GET["idSeccion"])){

	// 		$tabla ="seccion_refacciones";
	// 		$datos = $_GET["idSeccion"];

	// 		$respuesta = ModeloCategorias::mdlBorrarSeccionRefacciones($tabla, $datos);

	// 		if($respuesta == "ok"){

	// 			echo'<script>

	// 				swal({
	// 					  type: "success",
	// 					  title: "La categoría ha sido borrada correctamente",
	// 					  showConfirmButton: true,
	// 					  confirmButtonText: "Cerrar"
	// 					  }).then(function(result){
	// 								if (result.value) {

	// 								window.location = "categorias-refacciones";

	// 								}
	// 							})

	// 				</script>';
	// 		}
	// 	}
		
	// }


			/*=============================================
	MOSTRAR DISEÑO
	=============================================*/

	static public function ctrMostrarDiseño($item, $valor){

		$tabla = "diseños";

		$respuesta = ModeloCategorias::mdlMostrarDiseño($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	CREAR DISEÑO COLOR
	=============================================*/

	static public function ctrCrearColor(){

		if(isset($_POST["nuevoColor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoColor"])){

				$tabla = "diseños";

				//$datos = $_POST["nuevoDiseño"];

				$datos = $_POST["nuevoColor"];
				//$diseño = $_POST["nuevoDiseño"];

				$respuesta = ModeloCategorias::mdlIngresarColor($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	EDITAR COLOR
	=============================================*/

	static public function ctrEditarColor(){

		if(isset($_POST["editarColor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarColor"])){

				$tabla = "diseños";

				$datos = array("color"=>$_POST["editarColor"],
							   "id"=>$_POST["idColorEditar"]);

				$respuesta = ModeloCategorias::mdlEditarColor($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El color ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El color no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarColor(){

		if(isset($_GET["idDiseño"])){

			$item ="id_color";
			$valor = $_GET["idDiseño"];

			$diseñoVinculado = ControladorProductos::ctrMostrarProductos($item, $valor);

			if ($diseñoVinculado["id_color"] != $_GET["idDiseño"]){


			$tabla ="diseños";
			$datos = $_GET["idDiseño"];

			$respuesta = ModeloCategorias::mdlBorrarColor($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}

		}else{
			

				echo'<script>

					swal({
						  type: "error",
						  title: "Diseño vinculado a productos",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';



		}
		}
		
	}

	







}
