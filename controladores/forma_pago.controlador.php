<?php

class ControladorFormaPagos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarFormaPagos($item, $valor){

		$tabla = "forma_pago";

		$respuesta = ModeloFormaPagos::mdlMostrarFormaPagos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearFormaPago(){

		if(isset($_POST["nuevoUsuario"])){


				$tabla = "forma_pago";


				$datos = array(
							   "usuario" => $_POST["nuevoUsuario"],
							   "concepto" => $_POST["nuevoConcepto"],
							   "ingreso" => $_POST["nuevoIngreso"]);

				$respuesta = ModeloFormaPagos::mdlIngresarFormaPago($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Reparación agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "FormaPagos";

										}
									})

						</script>';

				


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Los datos de reparación no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "FormaPagos";

							}
						})

			  	</script>';
			}
}
		
	}


	

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarFormaPago(){

		if(isset($_POST["editarMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])){
			
				$tabla = "forma_pago";

				$datos = array(
							   "marca" => $_POST["editarMarca"],
							   "modelo" => $_POST["editarModelo"],
							   "reparacion" => $_POST["editarReparacion"],
							   "costo" => $_POST["editarCosto"],
							   "comentario" => $_POST["editarComentario"],
							   "id" => $_POST["editarID"]);



				$respuesta = ModeloFormaPagos::mdlEditarFormaPago($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Cotización editada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "FormaPagos";

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

							window.location = "FormaPagos";

							}
						})

			  	</script>';
			}
		}
	

	}




	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarFormaPago(){

		if(isset($_GET["idFormaPago"])){

			$tabla ="forma_pago";
			$datos = $_GET["idFormaPago"];

			
			$respuesta = ModeloFormaPagos::mdlEliminarFormaPago($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "FormaPagos";

								}
							})

				</script>';
			}		
		}

	}
}