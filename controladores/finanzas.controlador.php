<?php

class ControladorFinanzas{

	/*=============================================
	MOSTRAR GASTOS E INGRESOS
	=============================================*/

	static public function ctrMostrarFinanzas($item, $valor){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlMostrarFinanzas($tabla, $item, $valor);

		return $respuesta;

	}

		/*=============================================
	MOSTRAR GASTOS E INGRESOS
	=============================================*/

	static public function ctrMostrarFinanzasGastos($item, $valor, $meses){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlMostrarFinanzasGasto($tabla, $item, $valor, $meses);

		return $respuesta;

	}

	/*=============================================
	CREAR INGRESO
	=============================================*/

	static public function ctrCrearIngreso(){

		if(isset($_POST["sucursalSeleccionadaIngreso"])){

				
				$hoy = date("Y-m-d");
				$tabla = "ingresosgastos";


		
				$datos = array(
					"usuario" => $_SESSION["nombre"],
					"id_sucursal" => $_POST["sucursalSeleccionadaIngreso"],
					"concepto" => $_POST["nuevoConceptoIngreso"],
					"ingreso" => $_POST["nuevoCantidadIngreso"],
				"fecha" => $_POST['nuevoFechaIngreso']);

				$respuesta = ModeloFinanzas::mdlIngresarIngreso($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Actividad agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "index.php?ruta=finanzas&fechaInicial='.$hoy.'&fechaFinal='.$hoy.'";


										}
									})

						</script>';

				
}
		
	}
}

	/*=============================================
	CREAR GASDTO
	=============================================*/

	static public function ctrCrearGasto(){

		if(isset($_POST["sucursalSeleccionadaGasto"])){

				
				$hoy = date("Y-m-d");
				$tabla = "ingresosgastos";


		
				$datos = array(
					"usuario" => $_SESSION["nombre"],
					"id_sucursal" => $_POST["sucursalSeleccionadaGasto"],
					"concepto" => $_POST["nuevoConceptoGasto"],
					"gasto" => $_POST["nuevoCantidadGasto"],
				"fecha" => $_POST['nuevoFechaGasto']);

				$respuesta = ModeloFinanzas::mdlIngresarGasto($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Actividad agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "index.php?ruta=finanzas&fechaInicial='.$hoy.'&fechaFinal='.$hoy.'";


										}
									})

						</script>';

				
}
		
	}
}



	/*=============================================
	CREAR INGRESO RECUURENTE
	=============================================*/

	static public function ctrCrearFinanza(){

		if(isset($_POST["nuevoUsuarioIngreso"])){


				
				$hoy = date("Y-m-d");
				$tabla = "ingresosgastos";


				
				if ($_POST["nuevoRecurrenciaIngreso"] ==! "0") {
				$pago_mensual1 = $_POST["nuevoCantidadIngreso"];

				$meses1 = $_POST["nuevoMesesIngreso"];
				$recurrencia = $_POST["nuevoRecurrenciaIngreso"];
				$dia_pago = $_POST["nuevoFechaPagoIngreso"];

				} else {
				$pago_mensual1 = null;
				$meses1 = null;
				$recurrencia = null;
				$dia_pago = null;

				}


				$datos = array(
					"usuario" => $_POST["nuevoUsuarioIngreso"],
					"concepto" => $_POST["nuevoConceptoIngreso"],
					"ingreso" => $_POST["nuevoCantidadIngreso"],
					"pagos_restantes" => $meses1,
					"recurrencia" => $recurrencia,
				"dia_pago" => $dia_pago,
				"pagos_totales" => $meses1,
				"gasto_restante" => $pago_mensual1);

				$respuesta = ModeloFinanzas::mdlIngresarFinanza($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Actividad agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "index.php?ruta=finanzas&fechaInicial='.$hoy.'&fechaFinal='.$hoy.'";


										}
									})

						</script>';

				


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Los datos de la actividad no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index.php?ruta=finanzas&fechaInicial='.$hoy.'&fechaFinal='.$hoy.'";


							}
						})

			  	</script>';
			}
}
		
	}


		/*=============================================
	CREAR GASTO
	=============================================*/

	static public function ctrCrearFinanzaGasto(){

		if(isset($_POST["nuevoUsuarioGasto"])){

				
				$hoy = date("Y-m-d");
				$tabla = "ingresosgastos";



				if ($_POST["nuevoRecurrenciaGasto"] ==! "0") {
				$pago_mensual1 = $_POST["nuevoCantidadGasto"];

				$meses1 = $_POST["nuevoMesesGasto"];
				$recurrencia = $_POST["nuevoRecurrenciaGasto"];
				$dia_pago = $_POST["nuevoFechaPagoGasto"];

				} else {

				$pago_mensual1 = null;
				$meses1 = null;
				$recurrencia = null;
				$dia_pago = null;

				}


				$datos = array(
					"usuario" => $_POST["nuevoUsuarioGasto"],
					"concepto" => $_POST["nuevoConceptoGasto"],
					"gasto" => $_POST["nuevoCantidadGasto"],
					"forma_pago" => $_POST["nuevoFormaPagoGasto"],
					"pagos_restantes" => $meses1,
					"pagos_totales" => $meses1,
					"recurrencia" => $recurrencia,
				"dia_pago" => $dia_pago,
				"gasto_restante" => $pago_mensual1);

				$respuesta = ModeloFinanzas::mdlIngresarFinanzaGasto($tabla, $datos);


				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Reparación agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "index.php?ruta=finanzas&fechaInicial='.$hoy.'&fechaFinal='.$hoy.'";


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

							window.location = "index.php?ruta=finanzas&fechaInicial='.$hoy.'&fechaFinal='.$hoy.'";


							}
						})

			  	</script>';
			}
}
		
	}


/*=============================================
	AGREGAR PAGO DE GASTOS PARCIALES
	=============================================*/

			/*=============================================
	CREAR GASTO
	=============================================*/

	static public function ctrAgregarPagoGasto(){

		if(isset($_POST["pagoMensual"])){

				$tabla = "ingresosgastos";


			if ($_POST["nuevoIngresoGasto"] ==! "0") {

			$pagos_restantes = ($_POST["pagosRestantes"]);
			$gastoRestante = ($_POST["gastoRestante"])-($_POST["nuevoIngresoGasto"]);
			
			$nuevosMeses = ($_POST["nuevosMeses"]);

		

				} else if ($_POST["nuevosMeses"] ==! "0") {

			$pagos_restantes = ($_POST["pagosRestantes"]);

			$gastoRestante = ($_POST["gastoRestante"])-($_POST["nuevoIngresoGasto"]);
			$nuevosMeses = ($_POST["nuevosMeses"]);

				} else {
				

			$pagos_restantes = ($_POST["pagosRestantes"])-1;
			//$gastoTotal = $_POST["gastoTotal"];
			$gastoRestante = ($_POST["gastoRestante"])-($_POST["gastoRestante"]/$_POST["pagosRestantes"]);
			$nuevosMeses = ($_POST["nuevosMeses"]);

				}



				$datos = array(
							   "pagos_restantes" => $pagos_restantes,
							   "gasto_restante" => $gastoRestante,
							   "id" => $_POST["idPago"]);


				$respuesta = ModeloFinanzas::mdlAgregarPago($tabla, $datos);



				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Pago realizado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "gastosparciales";

										}
									})

						</script>';
			}
}
		
	}




		/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalRangoIngresos($fechaInicial, $fechaFinal){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlRangoFechasFinanzasIngreso($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;

	}







		/*=============================================
	SUMA TOTAL GASTO
	=============================================*/

	public function ctrSumaTotalGasto(){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlSumaTotalGastos($tabla);

		return $respuesta;

	}


	/*=============================================
	SUMA TOTAL GASTO DIA
	=============================================*/

	static public function ctrSumaTotalGastoDia($fechaInicial, $fechaFinal){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlSumaTotalGastosDia($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	

	}



		/*=============================================
	SUMA GASTOS CON PAGOS PARCIALES
	=============================================*/

	public function ctrSumaTotalGastoParciales($fechaInicial, $fechaFinal){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlRangoFechasFinanzasGastosParciales($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;

	}



		/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasFinanzas($fechaInicial, $fechaFinal){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlRangoFechasFinanzas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	RANGO FECHAS GASTOS
	=============================================*/	

	static public function ctrRangoFechasFinanzasGastos($fechaInicial, $fechaFinal){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlRangoFechasFinanzasGastos($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}



	/*=============================================
	RANGO FECHAS GASTOS RANGO CAJA
	=============================================*/	

	static public function ctrRangoFechasFinanzasGastosCaja($fechaInicial, $fechaFinal){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlRangoFechasFinanzasGastosCaja($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	
	/*=============================================
	RANGO FECHAS GASTOS RANGO CAJA
	=============================================*/	

	static public function ctrRangoFechasFinanzasGastosCajaSucursal($fechaInicial, $fechaFinal, $sucursal){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlRangoFechasFinanzasGastosCajaSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal);

		return $respuesta;
		
	}


	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarFinanza(){

		if(isset($_GET["idFinanza"])){

			$tabla ="ingresosgastos";
			$datos = $_GET["idFinanza"];

			
			$respuesta = ModeloFinanzas::mdlEliminarFinanza($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Actividad borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "finanzas";

								}
							})

				</script>';
			}		
		}

	}


		/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarFinanzaGasto(){

		if(isset($_GET["idFinanza"])){

			$tabla ="ingresosgastos";
			$datos = $_GET["idFinanza"];

			
			$respuesta = ModeloFinanzas::mdlEliminarFinanza($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Actividad borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "gastosparciales";

								}
							})

				</script>';
			}		
		}

	}


		/*=============================================
	CREAR RETORNO DE INGRESO DE GASTOS PARCIALES, PARA CADA VEZ QUE SE HACE UN PAGO, APAREZCA REFLEJADO EN ACTIVIDADES Y SE SUME A LA CANTIDAD DE INGRESOS
	=============================================*/

	static public function ctrCrearIngresoGastoParcial(){

		if(isset($_POST["usuarioId"])){


				$tabla = "ingresosgastos";


				
				if ($_POST["nuevoIngresoGasto"] ==! "0") {


				$ingreso = $_POST["nuevoCantidadIngreso"];
				$concepto = "ABONO gasto parcial, concepto: ".$_POST["conceptoId"];
				$usuario = $_POST["usuarioId"];


				} else {

				$ingreso = $_POST["pagoMensual"]; 
				$concepto = "ABONO GP: ".$_POST["conceptoId"];
				$usuario = $_POST["usuarioId"];
				

				}


				$datos = array(
					"usuario" => $usuario,
					"concepto" => $concepto,
					"ingreso" => $ingreso);

				$respuesta = ModeloFinanzas::mdlIngresarFinanzaGastoParcial($tabla, $datos);


}
		
	}

		/*=============================================
	CREAR GASTO
	=============================================*/

	static public function ctrCrearFinanzaGastoVentasDiaSucursal(){

		if(isset($_POST["nuevoCantidadGasto"])){

				$tabla = "ingresosgastos";

				$datos = array(
					"usuario" => $_SESSION["nombre"],
					"id_sucursal" => $_SESSION["sucursal"],
					"concepto" => "GASTO, CONCEPTO: ".$_POST["nuevoConceptoGasto"],
					"gasto" => $_POST["nuevoCantidadGasto"]);

				$respuesta = ModeloFinanzas::mdlIngresarFinanzaGasto($tabla, $datos);


				$tabla = "ventas_stock";

				$datos = array(
					"codigo" => "GASTO, CONCEPTO: ".$_POST["nuevoConceptoGasto"],
					"sucursal" => $_SESSION["sucursal"],
					"tipo" => "3",
					"total" => $_POST["nuevoCantidadGasto"]);

				$respuesta2 = ModeloProductos::mdlIngresarStockVentas($tabla, $datos);



				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Gasto agregado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "ventasdia-sucursal";

										}
									})

						</script>';

				


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Los datos de gastos no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventasdia-sucursal";

							}
						})

			  	</script>';
			}
}
		
	}


	/*=============================================
	RANGO FECHAS RENDIMIENTO SUCURSAL 
	=============================================*/	

	static public function ctrRangoFechasRendimientoSucursal($fechaInicial, $fechaFinal, $sucursal,  $valorSumar, $concepto){

		$tabla = "ingresosgastos";

		$respuesta = ModeloFinanzas::mdlRangoFechasFinanzasRendimientoSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal, $valorSumar, $concepto);

		return $respuesta;
		
	}


		/*=============================================
	PAGO NOMINA 
	=============================================*/

	static public function ctrCrearPagoNomina(){

		if(isset($_POST["pagoNominaUsuario"])){


			// 	$tabla = "ventas_stock";

				
			// 	$datos = array(
			// 		"codigo" => "NOMINA,"." ".$_POST["nombreUsuario"],
			// 		"sucursal" => $_SESSION["sucursal"],
			// 		"total" => $_POST["pagoNominaUsuario"],
			// 		"tipo" => "4");
			

			// $respuesta2 = ModeloProductos::mdlIngresarStockVentas($tabla, $datos);

			date_default_timezone_set('America/Mexico_City');
		$hoy2 = date("Y-m-d H:i:s");
		$hoy = date("Y-m-d");

			$item = "id";
            $valor = $_POST["sucursalNomina"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);


				$tabla = "ingresosgastos";

				$datos = array(
					"usuario" => $_SESSION["nombre"],
					"id_sucursal" => $_POST["sucursalNomina"],
					"concepto" => "NOMINA:"." ".$_POST["nombreUsuario"].", Sucursal: ".$sucursal["nombre"],
					"fecha" => $_POST["fechaPagoNomina"],
					"gasto" => $_POST["pagoNominaUsuario"]);

				$respuesta = ModeloFinanzas::mdlIngresarFinanzaGasto($tabla, $datos);



				

				if($respuesta == "ok"){

		


					echo'<script>

						swal({

							  type: "success",
							  title: "Pago agregado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "index.php?ruta=finanzas&fechaInicial='.$hoy.'&fechaFinal='.$hoy.'";

										}
									})

						</script>';

				


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Los datos no pueden ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "finanzas";

							}
						})

			  	</script>';
			}
}
		
	}

	/*=============================================
	PAGO NOMINA 
	=============================================*/

	static public function ctrCrearPagoRenta(){

		if(isset($_POST["sucursalSeleccionadaRenta"])){


			// 	$tabla = "ventas_stock";

				
			// 	$datos = array(
			// 		"codigo" => "NOMINA,"." ".$_POST["nombreUsuario"],
			// 		"sucursal" => $_SESSION["sucursal"],
			// 		"total" => $_POST["pagoNominaUsuario"],
			// 		"tipo" => "4");
			

			// $respuesta2 = ModeloProductos::mdlIngresarStockVentas($tabla, $datos);

			//date_default_timezone_set('America/Mexico_City');
			$hoy = date("Y-m-d");

		 	$item = "id";
            $valor = $_POST["sucursalSeleccionadaRenta"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);


				$tabla = "ingresosgastos";

				$datos = array(
					"usuario" => $_POST["nombreUsuario"],
					"id_sucursal" => $_POST["sucursalSeleccionadaRenta"],
					"concepto" => "RENTA, ".$sucursal["nombre"],
					"fecha" => $_POST['fechaPagoAlquiler'],
					"gasto" => $_POST["pagoRenta"]);

				$respuesta = ModeloFinanzas::mdlIngresarFinanzaGasto($tabla, $datos);



				

				if($respuesta == "ok"){

		


					echo'<script>

						swal({

							  type: "success",
							  title: "Pago agregado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

										window.location = "index.php?ruta=finanzas&fechaInicial='.$hoy.'&fechaFinal='.$hoy.'";

										}
									})

						</script>';

				


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Los datos no pueden ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "finanzas";

							}
						})

			  	</script>';
			}
}
		
	}



}