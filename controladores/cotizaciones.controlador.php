<?php

class ControladorCotizaciones{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarCotizaciones($item, $valor){

		$tabla = "cotizacion";

		$respuesta = ModeloCotizaciones::mdlMostrarCotizaciones($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR COTIZACION
	=============================================*/

	static public function ctrCrearCotizacion(){

		if(isset($_POST["nuevoMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoMarca"])){
				

				$tabla = "cotizacion";


				$datos = array(
							   "marca" => $_POST["nuevoMarca"],
							   "modelo" => $_POST["nuevoModelo"],
							   "reparacion" => $_POST["nuevoReparacion"],
							   "costo" => $_POST["nuevoCosto"],
							   "comentario" => $_POST["nuevoComentario"]);

				$respuesta = ModeloCotizaciones::mdlIngresarCotizacion($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Reparación agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "cotizaciones";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Los datos de reparación no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cotizaciones";

							}
						})

			  	</script>';
			}

		}
	}


	

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarCotizacion(){

		if(isset($_POST["editarMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])){
			
				$tabla = "cotizacion";

				$datos = array(
							   "marca" => $_POST["editarMarca"],
							   "modelo" => $_POST["editarModelo"],
							   "reparacion" => $_POST["editarReparacion"],
							   "costo" => $_POST["editarCosto"],
							   "comentario" => $_POST["editarComentario"],
							   "id" => $_POST["editarID"]);



				$respuesta = ModeloCotizaciones::mdlEditarCotizacion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Cotización editada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "cotizaciones";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Los datos de reparación no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cotizaciones";

							}
						})

			  	</script>';
			}
		}
	

	}




	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarCotizacion(){

		if(isset($_GET["idCotizacion"])){

			$tabla ="cotizacion";
			$datos = $_GET["idCotizacion"];

			
			$respuesta = ModeloCotizaciones::mdlEliminarCotizacion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido modificado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "cotizaciones";

								}
							})

				</script>';
			}		
		}

	}


	/*=============================================
	ACEPTAR PRECIO COTIZACION 
	=============================================*/
	static public function ctrAceptarCotizacion(){

		if(isset($_GET["idCotizacionAceptar"])){

			$tabla ="cotizacion";
			$datos = $_GET["idCotizacionAceptar"];
			$fecha = date("Y-m-d H:i:s");

			$datos = array(
							   "id" => $_GET["idCotizacionAceptar"],
							   "fecha" => $fecha);

			
			$respuesta = ModeloCotizaciones::mdlAceptarCotizacion($tabla, $datos);

		
		}

	}


	/*=============================================
	MOSTRAR COTIZACIÓN CLIENTE
	=============================================*/

	static public function ctrMostrarCotizacionCliente($item, $valor){

		$tabla = "cotizacion_cliente";

		$respuesta = ModeloCotizaciones::mdlMostrarCotizacionCliente($tabla, $item, $valor);

		return $respuesta;
	
	}


	/*=============================================
	GENERAR COTIZACIÓN CLIENTE
	=============================================*/

	static public function ctrCrearCotizacionCliente(){

		if(isset($_POST["nuevoCodigo"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			if($_POST["listaCotizaciones"] == ""){

					echo'<script>

				swal({
					  type: "error",
					  title: "La venta no se ha ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "crear-venta";

								}
							})

				</script>';

				return;
			}


			$listaCotizaciones = json_decode($_POST["listaCotizaciones"], true);

			// $totalProductosComprados = array();

			// foreach ($listaCotizaciones as $key => $value) {

			//    array_push($totalProductosComprados, $value["cantidad"]);
				
			 //  $tablaProductos = "productos";

			 //    $item = "id";
			 //    $valor = $value["id"];
			 //    $orden = "id";

			 //    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				// $item1a = "ventas";
				// $valor1a = $value["cantidad"] + $traerProducto["ventas"];

			 //    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				// $item1b = "stock";
				// $valor1b = $value["stock"];
				

				// $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);



   //         /*=============================================
			// DESCONTAR DE STOCK LA VENTA REALIZADA EN LA TABLA STOCK_SUCURSAL
			// =============================================*/

			// 	$tablaStock = "stock_sucursal";

			// 	$itemStock = "stock";
			// 	$valorStock = $value["stock"];

			// 	$valorCodigo = $traerProducto["codigo"];
			// 	$sucursal = $_POST["idSucursal"];

			// 	$nuevoStock = ModeloProductos::mdlActualizarProductoStock($tablaStock, $itemStock, $valorStock, $valorCodigo, $sucursal);


			// /*=============================================
			// GRABAR VENTA EN TABLA VENTAS_STOCK 
			// =============================================*/

			// 	$usuario = $_SESSION["nombre"];
			// 	$tabla = "ventas_stock";

			// 	$datos = array("codigo" => $traerProducto["codigo"],
			// 		"sucursal" => $_POST["idSucursal"],
			// 		"cantidad" => $value["cantidad"],
			// 		"total" => $value["precio"]);

			// 	$respuesta = ModeloProductos::mdlIngresarStockVentas($tabla, $datos);


			// =============================================
			// GRABAR VENTA EN TABLA ACTIVIDADES FINANZAZ 
			// =============================================

			// 	$concepto = "VENTA articulo, codigo: ".$traerProducto["codigo"];
			// 	$tabla = "ingresosgastos";

			// 	$datos = array(
			// 		"usuario" => $_SESSION["nombre"],
			// 		"concepto" => $concepto,
			// 		"ingreso" => $value["precio"]);

			// 	$respuesta = ModeloFinanzas::mdlIngresarFinanza($tabla, $datos);

			// }

			// $tablaClientes = "clientes";

			// $item = "id";
			// $valor = $_POST["seleccionarCliente"];

			// $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			// $item1a = "compras";
			// $valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			// $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			// $item1b = "ultima_compra";

			// date_default_timezone_set('America/Mexico_City');

			// $fecha = date('Y-m-d');
			// $hora = date('H:i:s');
			// $valor1b = $fecha.' '.$hora;

			// $fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			 $sucursal = $_SESSION["sucursal"];
			 $vendedor = $_SESSION["nombre"];

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "cotizacion_cliente";

			$datos = array("modelo"=>$_POST["nuevoModelo2"],
						   "cliente"=>ucwords($_POST["nuevoNombre"]),
						   "precio"=>$_POST["totalVenta"],
						   "cotizacion"=>$_POST["listaCotizaciones"],
						   "codigo"=>$_POST["nuevoCodigo"],
						   "id_vendedor"=>$vendedor,
						   "contacto"=>$_POST["nuevoContacto"],
						   "dias_vigencia"=>$_POST["nuevoVigencia"]);

			$respuesta = ModeloCotizaciones::mdlIngresarCotizacionCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "Cotización generada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "cotizacion-cliente";

								}
							})

				</script>';

			//}

		}

	}
}


/*=============================================
	CREAR COTIZACION VISTAS-MODELOS
	=============================================*/

	static public function ctrCrearCotizacionVistaModelos(){

		if(isset($_POST["idModeloCotizacion"])){


				 $tabla = "reparaciones_cotizacion";
                  $item1 = "id_modelo";
                  $valor1 = $_POST["idModeloCotizacion"];
                  $item2 = "id_reparacion";
                  $valor2 = $_POST["reparacionCotizacion"];

                 $reparacionExistente = ModeloCotizaciones::mdlMostrarFetchDoble($tabla, $item1, $valor1, $item2, $valor2);

				
                 if ($reparacionExistente == null){
					

					$tabla = "reparaciones_cotizacion";


					$riesgos = json_encode($_POST['selectRiesgos']);
					
					if ($_POST['selectRiesgos'] === null){
						
						$riesgos = "";
					
					}
					
				

					$datos = array(
							   "id_modelo" => $_POST["idModeloCotizacion"],
							   "id_reparacion" => $_POST["reparacionCotizacion"],
							   "precio" => $_POST["nuevoPrecioCotizacion"],
							    "comentario" => $_POST["nuevoComentarioCotizacion"],
							     "estado" => 1,
							      "riesgos" => $riesgos,
							       "id_dispo" => $_POST["disponibilidadCotizaciones"],
							        "tiempo" => $_POST["nuevoTiempoCotizacion"],
							         "id_garantia" => $_POST["garantiaCotizaciones"]);

				$respuesta = ModeloCotizaciones::mdlIngresarCotizacionVistaModelo($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Reparación agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "index.php?ruta=vista-modelo&idModelo='.$_POST["idModelo"].'";
											

										}
									})

						</script>';

				}


} else{

	echo'<script>

						swal({

							  type: "error",
							  title: "¡Reparación ya existente2!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "index.php?ruta=vista-modelo&idModelo='.$_POST["idModelo"].'";
											

										}
									})

						</script>';



}



		}
	}

	/*=============================================
	EDITAR REPARACION VISTA MODELO
	=============================================*/

	static public function ctrEditarReparacionVistaModelo(){

		if(isset($_POST["idReparacionEditarVM"])){

				
					$riesgos = json_encode($_POST['editarSelectRiesgos']);
					
					if ($_POST['editarSelectRiesgos'] === null){
						
						$riesgos = "";
					
					}
					


			
				$tabla = "reparaciones_cotizacion";

				$datos = array("id" => $_POST["idReparacionEditarVM"],
							   "precio" => $_POST["editarPrecioCotizacion"],
							   "comentario" => $_POST["editarComentarioCotizacion"],
							   "riesgos" => $riesgos,
							    "estado" => 1,
							   "id_dispo" => $_POST["editarDisponibilidadCotizaciones"],
							   "tiempo" => $_POST["editarTiempoCotizacion"],
							   "id_garantia" => $_POST["editarGarantiaCotizaciones"]);



				$respuesta = ModeloCotizaciones::mdlEditarReparacionVistaModelo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Reparación editada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

								window.location = "index.php?ruta=vista-modelo&idModelo='.$_POST["idModeloEditado"].'";


										}
									})

						</script>';

				}


		}
	

	}



	/*=============================================
	BORRAR COTIZACION VISTA-MODELO
	=============================================*/
	static public function ctrEliminarCotizacionVistaModelo(){

		if(isset($_GET["idCotizacionEliminar"])){

			$tabla = "reparaciones_cotizacion";
			
			$item = "id";
			$valor = $_GET["idCotizacionEliminar"];
			

			
			$respuesta = ModeloCotizaciones::mdlEliminarGeneral($tabla, $item, $valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Cotizacion eliminada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								
								window.location = "index.php?ruta=vista-modelo&idModelo='.$_GET["idModelo"].'";


								}
							})

				</script>';
			}		
		}

	}


	/*=============================================
	CREAR REPARACION CONFIGURACION
	=============================================*/

	static public function ctrCrearReparacionConfiguracion(){

		if(isset($_POST["nuevaReparacion"])){


				$tabla = "reparaciones_id";


				$datos = array(
							   "reparacion" => $_POST["nuevaReparacion"],
							   "descripcion" => $_POST["nuevoComentario"]);

				$respuesta = ModeloCotizaciones::mdlIngresarContizacionReparacion($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Reparación agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "reparaciones-configuracion";

										}
									})

						</script>';

				}


			

		}
	}


	

	/*=============================================
	EDITAR REPARACION CONFIGURACION
	=============================================*/

	static public function ctrEditarReparacionConfiguracion(){

		if(isset($_POST["idReparacionEditar"])){

			
			
				$tabla = "reparaciones_id";

				$datos = array( "id" => $_POST["idReparacionEditar"],
							   "reparacion" => $_POST["editarReparacion"],
							   "descripcion" => $_POST["editarComentario"]);



				$respuesta = ModeloCotizaciones::mdlEditarReparacionConfiguracion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Reparación editada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

								window.location = "reparaciones-configuracion";


										}
									})

						</script>';

				}


		}
	

	}

	/*=============================================
	BORRAR REPARACION CONFIGURACION
	=============================================*/
	static public function ctrEliminarReparacionConfiguracion(){

		if(isset($_GET["idReparacion"])){

			$tabla ="reparaciones_id";
			
			$item = "id";
			$valor = $_GET["idReparacion"];

			
			$respuesta = ModeloCotizaciones::mdlEliminarGeneral($tabla, $item, $valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Reparación borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "reparaciones-configuracion";

								}
							})

				</script>';
			}		
		}

	}



		/*=============================================
	CREAR RIESGO CONFIGURACION
	=============================================*/

	static public function ctrCrearRiesgoConfiguracion(){

		if(isset($_POST["nuevoRiesgo"])){


				$tabla = "reparaciones_riesgo";


				$datos = array(
							   "riesgo" => $_POST["nuevoRiesgo"],
							   "descripcion" => $_POST["nuevaDescripcionRiesgo"]);

				$respuesta = ModeloCotizaciones::mdlIngresarRiesgoConfiguracion($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Riesgo agregado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "reparaciones-configuracion";

										}
									})

						</script>';

				}


			

		}
	}


	

	/*=============================================
	EDITAR REPARACION CONFIGURACION
	=============================================*/

	static public function ctrEditarRiesgoConfiguracion(){

		if(isset($_POST["idRiesgo"])){

			
			
				$tabla = "reparaciones_riesgo";

				$datos = array( "id" => $_POST["idRiesgo"],
							   "riesgo" => $_POST["editarRiesgo"],
							   "descripcion" => $_POST["editarDescripcionRiesgo"]);



				$respuesta = ModeloCotizaciones::mdlEditarRiesgoConfiguracion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Riesgo editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

								window.location = "reparaciones-configuracion";


										}
									})

						</script>';

				}


		}
	

	}


	/*=============================================
	BORRAR RIESGO CONFIGURACION
	=============================================*/
	static public function ctrEliminarRiesgoConfiguracion(){

		if(isset($_GET["idRiesgo"])){

			$tabla ="reparaciones_riesgo";
			
			$item = "id";
			$valor = $_GET["idRiesgo"];

			
			$respuesta = ModeloCotizaciones::mdlEliminarGeneral($tabla, $item, $valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Riesgo borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "reparaciones-configuracion";

								}
							})

				</script>';
			}		
		}

	}



	/*=============================================
	CREAR DISPONIBILIDAD CONFIGURACION
	=============================================*/

	static public function ctrCrearDisponibilidadConfiguracion(){

		if(isset($_POST["nuevoDisponibilidad"])){


				$tabla = "reparaciones_disponibilidad";


				$datos = array(
							   "disponibilidad" => $_POST["nuevoDisponibilidad"],
							   "descripcion" => $_POST["nuevoDescripcionDisponibilidad"],
							   "anticipo" => $_POST["opcionAnticipo"]);

				$respuesta = ModeloCotizaciones::mdlIngresarDisponibilidadConfiguracion($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Disponibilidad agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "reparaciones-configuracion";

										}
									})

						</script>';

				}


			

		}
	}


	

	/*=============================================
	EDITAR REPARACION CONFIGURACION
	=============================================*/

	static public function ctrEditarDisponibilidadConfiguracion(){

		if(isset($_POST["idDisponibilidad"])){

			
			
				$tabla = "reparaciones_disponibilidad";

				$datos = array( "id" => $_POST["idDisponibilidad"],
							   "disponibilidad" => $_POST["editarDisponibilidad"],
							   "descripcion" => $_POST["editarDescripcionDisponibilidad"]);



				$respuesta = ModeloCotizaciones::mdlEditarDisponibilidadConfiguracion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Disponibilidad editada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

								window.location = "reparaciones-configuracion";


										}
									})

						</script>';

				}


		}
	

	}


	/*=============================================
	BORRAR RIESGO CONFIGURACION
	=============================================*/
	static public function ctrEliminarDisponibilidadConfiguracion(){

		if(isset($_GET["idDisponibilidad"])){

			$tabla ="reparaciones_disponibilidad";
			
			$item = "id";
			$valor = $_GET["idDisponibilidad"];

			
			$respuesta = ModeloCotizaciones::mdlEliminarGeneral($tabla, $item, $valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Disponibilidad borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "reparaciones-configuracion";

								}
							})

				</script>';
			}		
		}

	}


  /*=============================================
	CREAR GARANTIA CONFIGURACION
	=============================================*/

	static public function ctrCrearGarantiaConfiguracion(){

		if(isset($_POST["nuevoGarantia"])){


				$tabla = "reparaciones_garantia";


				$datos = array(
							   "garantia" => $_POST["nuevoGarantia"],
							   "dias" => $_POST["nuevoDiasGarantia"],
							   "condiciones" => $_POST["nuevoDescripcionGarantia"]);

				$respuesta = ModeloCotizaciones::mdlIngresarGarantiaConfiguracion($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Garantía agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "reparaciones-configuracion";

										}
									})

						</script>';

				}


			

		}
	}


	

	/*=============================================
	EDITAR garantia CONFIGURACION
	=============================================*/

	static public function ctrEditarGarantiaConfiguracion(){

		if(isset($_POST["idGarantia"])){

			
			
				$tabla = "reparaciones_garantia";

				$datos = array( "id" => $_POST["idGarantia"],
							   "garantia" => $_POST["editarGarantia"],
							   "dias" => $_POST["editarGarantiaDias"],
							   "condiciones" => $_POST["editarGarantiaDescripcion"]);



				$respuesta = ModeloCotizaciones::mdlEditarGarantiaConfiguracion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Garantía editada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

								window.location = "reparaciones-configuracion";


										}
									})

						</script>';

				}


		}
	

	}


	/*=============================================
	BORRAR garantia CONFIGURACION
	=============================================*/
	static public function ctrEliminarGarantiaConfiguracion(){

		if(isset($_GET["idGarantia"])){

			$tabla ="reparaciones_garantia";
			
			$item = "id";
			$valor = $_GET["idGarantia"];

			
			$respuesta = ModeloCotizaciones::mdlEliminarGeneral($tabla, $item, $valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Garantia borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "reparaciones-configuracion";

								}
							})

				</script>';
			}		
		}

	}


  /*=============================================
	CREAR TIEMPO CONFIGURACION
	=============================================*/

	static public function ctrCrearTiempoConfiguracion(){

		if(isset($_POST["nuevoTiempo"])){


				$tabla = "reparaciones_tiempo";


				$datos = array("tiempo" => $_POST["nuevoTiempo"]);

				$respuesta = ModeloCotizaciones::mdlIngresarTiempoConfiguracion($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Tiempo agregado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "reparaciones-configuracion";

										}
									})

						</script>';

				}


			

		}
	}


	

	/*=============================================
	EDITAR Tiempo CONFIGURACION
	=============================================*/

	static public function ctrEditarTiempoConfiguracion(){

		if(isset($_POST["idTiempo"])){

			
				$tabla = "reparaciones_tiempo";

				$datos = array( "id" => $_POST["idTiempo"],
							   "tiempo" => $_POST["editarTiempo"]);



				$respuesta = ModeloCotizaciones::mdlEditarTiempoConfiguracion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Tiempo editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

								window.location = "reparaciones-configuracion";


										}
									})

						</script>';

				}


		}
	

	}


	/*=============================================
	BORRAR Tiempo CONFIGURACION 
	=============================================*/
	static public function ctrEliminarTiempoConfiguracion(){

		if(isset($_GET["idTiempo"])){

			$tabla ="reparaciones_tiempo";
			
			$item = "id";
			$valor = $_GET["idTiempo"];

			
			$respuesta = ModeloCotizaciones::mdlEliminarGeneral($tabla, $item, $valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Tiempo borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "reparaciones-configuracion";

								}
							})

				</script>';
			}		
		}

	}


  /*=============================================
	CREAR Estado CONFIGURACION
	=============================================*/

	static public function ctrCrearEstadoConfiguracion(){

		if(isset($_POST["nuevoEstado"])){


				$tabla = "reparaciones_estado";


				$datos = array(
							   "estado" => $_POST["nuevoEstado"],
							   "descripcion" => $_POST["nuevoDescripcionEstado"]);

				$respuesta = ModeloCotizaciones::mdlIngresarEstadoConfiguracion($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Estado agregado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "reparaciones-configuracion";

										}
									})

						</script>';

				}

		}
	}


	

	/*=============================================
	EDITAR Estado CONFIGURACION
	=============================================*/

	static public function ctrEditarEstadoConfiguracion(){

		if(isset($_POST["idEstado"])){

			
			
				$tabla = "reparaciones_estado";

				$datos = array( "id" => $_POST["idEstado"],
							   "estado" => $_POST["editarEstado"],
							   "descripcion" => $_POST["editarDescripcionEstado"]);



				$respuesta = ModeloCotizaciones::mdlEditarEstadoConfiguracion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Estado editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

								window.location = "reparaciones-configuracion";


										}
									})

						</script>';

				}


		}
	

	}


	/*=============================================
	BORRAR Estado CONFIGURACION 
	=============================================*/
	static public function ctrEliminarEstadoConfiguracion(){

		if(isset($_GET["idEstado"])){

			$tabla ="reparaciones_estado";
			
			$item = "id";
			$valor = $_GET["idEstado"];

			
			$respuesta = ModeloCotizaciones::mdlEliminarGeneral($tabla, $item, $valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Estado borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "reparaciones-configuracion";

								}
							})

				</script>';
			}		
		}

	}



		/*=============================================
	CREAR COTIZACION VISTAS-MODELOS DESDE COTIZACION ANTIGUO
	=============================================*/

	static public function ctrCrearCotizacionVistaModelosExportar(){

		if(isset($_POST["nuevoModeloSelecionado"])){


				 $tabla = "reparaciones_cotizacion";
                  $item1 = "id_modelo";
                  $valor1 = $_POST["nuevoModeloSelecionado"];
                  $item2 = "id_reparacion";
                  $valor2 = $_POST["reparacionCotizacion"];

                 $reparacionExistente = ModeloCotizaciones::mdlMostrarFetchDoble($tabla, $item1, $valor1, $item2, $valor2);

				
                 if ($reparacionExistente == null){
					

					$tabla = "reparaciones_cotizacion";


					$riesgos = json_encode($_POST['selectRiesgos']);
					
					if ($_POST['selectRiesgos'] === null){
						
						$riesgos = "";
					
					}
					
				

					$datos = array(
							   "id_modelo" => $_POST["nuevoModeloSelecionado"],
							   "id_reparacion" => $_POST["reparacionCotizacion"],
							   "precio" => $_POST["nuevoPrecioCotizacion"],
							    "comentario" => $_POST["nuevoComentarioCotizacion"],
							     "estado" => 1,
							      "riesgos" => $riesgos,
							       "id_dispo" => $_POST["disponibilidadCotizaciones"],
							        "tiempo" => $_POST["nuevoTiempoCotizacion"],
							         "id_garantia" => $_POST["garantiaCotizaciones"]);

				$respuesta = ModeloCotizaciones::mdlIngresarCotizacionVistaModelo($tabla, $datos);

				

				$tabla = "cotizacion";

				$datos = array(
							   "id_modelo" => $_POST["nuevoModeloSelecionado"],
							   "costo" => $_POST["nuevoPrecioCotizacion"],
							   "comentario" => $_POST["nuevoComentarioCotizacion"],
							   "id" => $_POST["idCotizacionAnterior"]);



				$respuestaAnterior = ModeloCotizaciones::mdlEditarCotizaciondIdModelo($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Reparación agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "index.php?ruta=cotizaciones";
											

										}
									})

						</script>';

				}


} else{

	echo'<script>

						swal({

							  type: "error",
							  title: "¡Reparación ya existente2!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "index.php?ruta=cotizaciones";
											

										}
									})

						</script>';



}



		}
	}


	/*=============================================
	CREAR COTIZACION
	=============================================*/

	static public function ctrCrearCotizacionLista(){

		if(isset($_POST["marcaSeleccionada"])){


				


				

				$item = "id";
				$valor = $_POST["marcaSeleccionada"];

				$marca = ControladorCategorias::ctrMostrarMarcas($item, $valor);

				$item = "codigo";
				$valor = $_POST["nuevoModeloSelecionado"];

				$modelo = ControladorCategorias::ctrMostrarModelos($item, $valor);


				$tabla = "reparaciones_id";
      			$item = "id";
      			$valor = $_POST["reparacionCotizacion"];

     			$reparacionCategoria = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor); 

     			$tabla = "reparaciones_tiempo";
     			$item = "id";
      			$valor = $_POST["nuevoTiempoCotizacion"];

      			$tiempo = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

      			$tabla = "reparaciones_disponibilidad";
     			$item = "id";
      			$valor = $_POST["disponibilidadCotizaciones"];

      			$dispo = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);


     			$tabla = "cotizacion";
				$datos = array(
							   "marca" => $marca["marca"],
							   "modelo" => $modelo["modelo"],
							   "reparacion" => $reparacionCategoria["reparacion"],
							   "costo" => $_POST["nuevoPrecioCotizacion"],
							   "comentario" => $_POST["nuevoComentarioCotizacion"].", Tiempo instalación: ".$tiempo["tiempo"].", Disponibilidad: ".$dispo["disponibilidad"]);

				$respuesta = ModeloCotizaciones::mdlIngresarCotizacion($tabla, $datos);






		}
	}


	




}