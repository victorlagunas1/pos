<?php

class ControladorProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

		return $respuesta; 

	}


	/*=============================================
	MOSTRAR PRODUCTOS ESCANER PARA CODIGO 0=CODIGO AUTOMATICO, NULL = CODIGO ESCANEADO
	=============================================*/

	static public function ctrMostrarProductosEscaner($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductosEscaner($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PRODUCTOS ESPECIFICO
	=============================================*/

	static public function ctrMostrarProductosSucursal($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductosSucursal($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PRODUCTOS ESPECIFICO POR CATEGORIA
	=============================================*/

	static public function ctrMostrarProductosSucursalCategoriaSucursal($categoria){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductosSucursalCategoriaSucursal($tabla, $categoria);

		return $respuesta;

	}



	/*=============================================
	MOSTRAR STOCK_PRODUCTOS ESPECIFICO
	=============================================*/

	static public function ctrMostrarStockProductosSucursal($item, $valor){

		$tabla = "stock_sucursal";

		$respuesta = ModeloProductos::mdlMostrarStockProductosSucursal($tabla, $item, $valor);

		return $respuesta; 

	}

	/*=============================================
	MOSTRAR STOCK_PRODUCTOS ESPECIFICO DESDE VENTAS 2
	=============================================*/

	static public function ctrMostrarStockProductosSucursalVentas2($codigo, $sucursal){

		$tabla = "stock_sucursal";
	

		$respuesta = ModeloProductos::mdlMostrarStockProductosSucursalVentas2($tabla, $codigo, $sucursal);

		return $respuesta;

	}








	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearProducto(){


		if(isset($_POST["nuevaCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])){

			//	}
		if ($_POST["nuevoModeloSelecionado"] != null && $_POST["nuevoColor"] != null ){
			
			$codigo = $_POST["nuevoModeloSelecionado"].$_POST["nuevaCategoria"].$_POST["nuevoColor"];
				
				} else if ($_POST["nuevoModeloSelecionado"] != null ){

			$codigo = $_POST["nuevoModeloSelecionado"].$_POST["nuevaCategoria"];

				}else {

				
			$codigo = $_POST["nuevaCategoria"].$_POST["nuevoColor"];

			}

				$item = "codigo";
                $valor = $codigo;
               

               $buscarProducto = ControladorProductos::ctrMostrarProductos($item, $valor);


               $codigoVerificar = $codigo;
                $sucursal = $_SESSION["sucursal"];
               // $tabla = "stock_sucursal";
               
               $verificarCodigoStock = ControladorProductos::ctrMostrarVerificarCodigoStockSucursal($codigoVerificar, $sucursal);

		//echo '<script language="javascript">alert("'.$verificarCodigoStock["producto"].'");</script>';
               


			if ($codigo != $buscarProducto["codigo"] ){


				$tabla = "productos";

				$datos = array("id_categoria" => $_POST["nuevaCategoria"],
							   "codigo" => $codigo,
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "stock" => $_POST["nuevoStock"],
							  // "precio_compra" => $_POST["nuevoPrecioCompra"],
							   "precio_venta" => $_POST["nuevoPrecioVenta"],
							   "precio_plaza" => $_POST["nuevoPrecioPlaza"],
							   "id_modelo" => $_POST["nuevoModeloSelecionado"],
							   "nuevoColor" => $_POST["nuevoColor"],
							   "sucursal" => $_POST["idSucursal"]);
							   //"escaner" => $_POST["escanerCodigo"]);
							  // "imagen" => $ruta);

				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);




				$tabla2 = "stock_sucursal";

				$datos2 = array("id_sucursal" => $_POST["idSucursal"],
							   "producto" => $codigo,
							   "stock" => $_POST["nuevoStock"]);

				$respuesta2 = ModeloProductos::mdlIngresarProductoSucursal($tabla2, $datos2);



					$item = "codigo";
                    $valor = $codigo;
                    $sucursal = null;

                    $productos2 = ControladorProductos::ctrMostrarProductos($item, $valor, $sucursal);
                

                    $idProductoTicket = $productos2["id"];





				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.open("extensiones/tcpdf/pdf/etiquetaProductoBarcode.php?codigo='.$idProductoTicket.'&suc='.$_POST['idSucursal'].'","_blank");
										window.location = "productos";


										}
									})

						</script>';

				}

			}else if ($verificarCodigoStock["producto"] != $codigo && $codigo == $buscarProducto["codigo"] ){


				//echo '<script language="javascript">alert("'.$verificarCodigoStock["producto"]." ".$codigo." ".$buscarProducto["codigo"]. '");</script>';

				$tabla2 = "stock_sucursal";

				$datos2 = array("id_sucursal" => $_POST["idSucursal"],
							   "producto" => $codigo,
							   "stock" => $_POST["nuevoStock"]);

				$respuesta2 = ModeloProductos::mdlIngresarProductoSucursal($tabla2, $datos2);

					$item = "codigo";
                    $valor = $codigo;
                    $sucursal = null;

                    $productos2 = ControladorProductos::ctrMostrarProductos($item, $valor, $sucursal);
                

                    $idProductoTicket = $productos2["id"];


				echo'<script>

						swal({

							  type: "warning",
							  title: "Producto actualizado correctamente.",
							  text: "El producto ya estaba registrado anteriormente, revisar y corregir datos.",
							  showConfirmButton: true,
							  timer: 3000,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.open("extensiones/tcpdf/pdf/etiquetaProductoBarcode.php?codigo='.$idProductoTicket.'","_blank");


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

							window.location = "productos";

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

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = $_POST["imagenActual"];

			   	if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["editarCodigo"];

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

					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "productos";

				$datos = array("id_categoria" => $_POST["editarCategoria"],
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   //"stock" => $_POST["editarStock"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_plaza" => $_POST["editarPrecioPlaza"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   "imagen" => $ruta);

				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  timer: 3000,
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

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

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto(){

		if(isset($_GET["idProducto"])){

			$tabla ="productos";
			
			$datos = $_GET["idProducto"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png"){

				unlink($_GET["imagen"]);
				rmdir('vistas/img/productos/'.$_GET["codigo"]);

			}

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "productos-total";

								}
							})

				</script>';

			}		
		}


	}


	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProductoSucursal(){

		if(isset($_GET["idProductoSucursal"])){

			$tabla ="stock_sucursal";
			
			$datos = $_GET["idProductoSucursal"];


			$respuesta = ModeloProductos::mdlEliminarProductoSucursal($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								 window.location = "productos";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}




	/*=============================================
	MOSTRAR ID STOCK 
	=============================================*/

	static public function ctrMostrarStockSucursal($item, $valor){

		$tabla = "stock_sucursal";

		$respuesta = ModeloProductos::mdlMostrarStockSucursal($tabla, $item, $valor);

		return $respuesta;

	}



	/*=============================================
	MOSTRAR ID STOCK 
	=============================================*/

	static public function ctrMostrarVerificarCodigoStockSucursal($sucursal, $codigoVerificar){

		$tabla = "stock_sucursal";

		$respuesta = ModeloProductos::mdlVerficicarStockSucursal($tabla, $sucursal, $codigoVerificar);

		return $respuesta;

	}

	/*=============================================
	AGREGAR PRODUCTO STOCK POR SUCURSAL ID STOCK 
	=============================================*/



		static public function ctrAgregarStockSucursal(){

			if(isset($_POST["codigoProducto"])){

			$tabla2 = "stock_sucursal";

			$datos2 = array("id_sucursal" => $_SESSION['sucursal'],
							   "producto" => $_POST["codigoProducto"],
							   "stock" => $_POST["stockProducto"]);


		$respuesta = ModeloProductos::mdlIngresarProductoSucursal($tabla2, $datos2);



		if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

				


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}

		

		return $respuesta;

	}

}


   /*=============================================
	AGREGAR PRODUCTO STOCK POR SUCURSAL ID STOCK 
	=============================================*/
		static public function ctrActualizarStockSucursal(){

			if(isset($_POST["stockProductoEditar"])){


		

			if($_POST["stockProductoEditar"] > $_POST["stockActual"] || $_SESSION["perfil"] == "Administrador"){


			$tabla = "stock_sucursal";

			$datos = array("id_sucursal" => $_POST["idSucursal"],
				"id" => $_POST["idStock"],
				"producto" => $_POST["codigoProductos"],
				"stock" => $_POST["stockProductoEditar"]);

		$respuesta = ModeloProductos::mdlActualizarProductoStock2($tabla, $datos);



		if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Stock actualizado correctamente",
							  timer: 2000,
							  })

						</script>';

				


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}

		

		return $respuesta;

	} else {

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nuevo stock no puede ser menor al actual!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';




	}
}

}



/*=============================================
	AGREGAR PRODUCTO STOCK POR SUCURSAL ID STOCK DESDE PRODUCTOS TOTAL 
	=============================================*/



		static public function ctrAgregarStockSucursalTotal(){

			if(isset($_POST["codigoProductoTotal"])){

			$tabla2 = "stock_sucursal";

			$datos2 = array("id_sucursal" => $_SESSION['sucursal'],
							   "producto" => $_POST["codigoProductoTotal"],
							   "stock" => $_POST["stockProductoTotal"]);


		$respuesta = ModeloProductos::mdlIngresarProductoSucursal($tabla2, $datos2);



		if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "productos-total";

										}
									})

						</script>';

				


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos-total";

							}
						})

			  	</script>';
			}

		

		return $respuesta;

	}

}

	/*=============================================
	CREAR PRODUCTO DESDE CATEGORIA
	=============================================*/

	static public function ctrCrearProductoCategoria(){

		if(isset($_POST["nuevaDescripcion2"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion2"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoStock2"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra2"]) && 
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioPlaza2"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta2"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = "vistas/img/productos/default/anonymous.png";

			   	if(isset($_FILES["nuevaImagen2"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen2"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["nuevoCodigo2"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaImagen2"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo2"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen2"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImagen2"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo2"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen2"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				//if ($_POST["nuevoModeloSelecionado"] != null) {

				//	$modelo = $_POST["nuevoModeloSelecionado"];
			//	}else{
			//		$modelo = "0";

			//	}

				$tabla = "productos";

				$datos = array("id_categoria" => $_POST["nuevaCategoria1"],
							   "codigo" => $_POST["nuevoCodigo2"],
							   "descripcion" => $_POST["nuevaDescripcion2"],
							   "stock" => $_POST["nuevoStock2"],
							   "precio_compra" => $_POST["nuevoPrecioCompra2"],
							   "precio_venta" => $_POST["nuevoPrecioVenta2"],
							   "precio_plaza" => $_POST["nuevoPrecioPlaza2"],
							   "id_modelo" => $_POST["nuevoModeloSelecionado2"],
							   "sucursal" => $_POST["idSucursal2"], 
							    "escaner" => $_POST["escanerCodigo2"],
							   "imagen" => $ruta);

				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);




		$tabla2 = "stock_sucursal";

				$datos2 = array("id_sucursal" => $_POST["idSucursal2"],
							   "producto" => $_POST["nuevoCodigo2"],
							   "stock" => $_POST["nuevoStock2"]);

				$respuesta2 = ModeloProductos::mdlIngresarProductoSucursal($tabla2, $datos2);



				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "El producto ha sido guardado correctamente",
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
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
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
	SUBIR FOTO DE PRODUCTO
	=============================================*/

	static public function ctrCrearFotoProducto(){


		if(isset($_POST["codigoProductoFoto"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["codigoProductoFoto"])){


			   	$ruta = "vistas/img/productos/default/anonymous.png";

			   	if(isset($_FILES["nuevaImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = $ancho;
					$nuevoAlto = $alto;


					$directorio = "vistas/img/productos/".$_POST["codigoProductoFoto"];

					mkdir($directorio, 0755);


					if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){


						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["codigoProductoFoto"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImagen"]["type"] == "image/png"){


						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["codigoProductoFoto"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}



				$tabla = "productos";

				$datos = array("codigo" => $_POST["codigoProductoFoto"],
							   "imagen" => $ruta);

				$respuesta = ModeloProductos::mdlFotoProducto($tabla, $datos);




				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "productos";

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

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}

	}


	/*=============================================
	EXPORTAR PDF CATEGORIA PRODUCTO  
	=============================================*/



		static public function ctrExportarArchivoPdf(){

			if(isset($_POST["categoriaPdf"])){

			
			$id_sucursal = $_SESSION['sucursal'];
			$categoria = $_POST["categoriaPdf"];

			echo '<script>

			window.open("extensiones/tcpdf/pdf/productoCategoria.php?categoria='.$categoria.'&sucursal='.$id_sucursal.'","_blank");

			</script>';


	}

}


	/*=============================================
	CREAR CODIGOS MASIVOS PARA TODOS LOS MODELOS 
	=============================================*/

	static public function ctrCrearProductoMasivoCategoriaDiseño(){


		if(isset($_POST["idCategoriaEnviar"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["idCategoriaEnviar"])){


                     $item = null;
                     $valor = null;

                     $modelos = ControladorCategorias::ctrMostrarModelos($item, $valor);
	
			
			foreach ($modelos as $key => $value) {

			$codigo = $value["codigo"].$_POST["idCategoriaEnviar"].$_POST["idColorEnviar"];

			
			//$codigo = $_POST["nuevoModeloSelecionado"].$_POST["idCategoriaEnviar"].$_POST["idColorEnviar"];
				

				$tabla = "productos";

				$datos = array("id_categoria" => $_POST["idCategoriaEnviar"],
							   "codigo" => $codigo,
							   "stock" => 0,
							   "precio_venta" => $_POST["precioVentaEnviar"],
							   "id_modelo" => $value["codigo"],
							   "nuevoColor" => $_POST["idColorEnviar"],
							   "sucursal" => $_SESSION["sucursal"]);
							   //"escaner" => $_POST["escanerCodigo"]);
							  // "imagen" => $ruta);

				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);




				$tabla2 = "stock_sucursal";

				$datos2 = array("id_sucursal" => $_SESSION["sucursal"],
							   "producto" => $codigo,
							   "stock" => 0);

				$respuesta2 = ModeloProductos::mdlIngresarProductoSucursal($tabla2, $datos2);

				}


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "productos-total";


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

							window.location = "productos-total";

							}
						})

			  	</script>';
			}
		}

	}




}