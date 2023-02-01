<?php

class ControladorFacturacion{
	
	/*=============================================
	MOSTRAR FACTURACION
	=============================================*/

	static public function ctrMostrarFacturacion($item, $valor){

		$tabla = "facturacion";

		$respuesta = ModeloFacturacion::mdlMostrarFacturacion($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
				REGISTRO DE USUARIO
	=============================================*/
 static public function ctrCrearFacturacion(){

		if(isset($_POST["nuevoNoVenta"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNoVenta"])){



			$tabla = "facturacion";


 			$datos = array("id_cliente" => $_POST["seleccionarCliente"],
					           "id_venta" => $_POST["nuevoNoVenta"],
					           "id_sucursal" => $_POST["idSucursal"],
					           "cfdi" => $_POST["nuevoUsoCFDI"]);

				$respuesta = ModeloFacturacion::mdlIngresarFacturacion($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡Facturacion creada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "facturacion";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "facturacion";

						}

					});
				

				</script>';

			}


		}


	}



	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarFacturacion(){

		if(isset($_POST["nuevoNoVentaEditar"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNoVentaEditar"])){

			
				$tabla = "facturacion";

				$datos = array("id_venta" => $_POST["nuevoNoVentaEditar"],
							   "id_cliente" => $_POST["seleccionarClienteEditar"],
							    "cfdi" => $_POST["nuevoUsoCFDIEditar"],
							   "id" => $_POST["idFacturacionEditar"],);

				$respuesta = ModeloFacturacion::mdlEditarFacturacion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Facturación editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "facturacion";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Error!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "facturacion";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR FACTURACION
	=============================================*/

	static public function ctrBorrarFacturacion(){

		if(isset($_GET["idFacturacion"])){

			$tabla ="facturacion";
			$datos = $_GET["idFacturacion"];

		

			$respuesta = ModeloFacturacion::mdlBorrarFacturacion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Facturación borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "facturacion";

								}
							})

				</script>';

			}		

		}

	}


		




}
	


