<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorReparaciones{

	/*=============================================
	MOSTRAR REPARACIONES
	=============================================*/

	static public function ctrMostrarReparaciones($item, $valor){

		$tabla = "reparaciones";

		$respuesta = ModeloReparaciones::mdlMostrarReparaciones($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR REPARACIONES POR SUCURSAL
	=============================================*/

	static public function ctrMostrarReparacionesSucursal($item, $valor, $sucursal){

		$tabla = "reparaciones";

		$respuesta = ModeloReparaciones::mdlMostrarReparacionesSucursal($tabla, $item, $valor, $sucursal);

		return $respuesta;

	}



	static public function ctrMostrarReparacionesDia($item, $valor, $fechaInicial, $fechaFinal){

		$tabla = "reparaciones";

		$respuesta = ModeloReparaciones::mdlMostrarReparacionesDia($tabla, $item, $valor, $fechaInicial, $fechaFinal);

		return $respuesta;

	}


	

	/*=============================================
	CREAR REPARACIONES
	=============================================*/

	static public function ctrCrearReparacion(){

		if(isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])){
				
					
					$usuario = $_SESSION["nombre"];

					date_default_timezone_set('America/Mexico_City');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

					$concatenar = $fechaActual." ".$usuario." : "."Recibido";

					$riesgos = json_encode($_POST['riesgosSelectRecibirEquipo']);
					
					if ($_POST['riesgosSelectRecibirEquipo'] === null){
						
						$riesgos = "";
					
					}
					

				$tabla = "reparaciones";


				$datos = array(
							   "nombre" => ucwords($_POST["nuevoNombre"]),
							   "telefono" => $_POST["nuevoTelefono"],
							   "historial" => $concatenar,
							   "modelo" => $_POST["nuevoModelo"],
							   "marca" => ucfirst($_POST["nuevoMarca"]),
							   "servicio" => ucfirst($_POST["nuevoServicio"]),
							   "color" => ucfirst($_POST["nuevoColor"]),
							   "serie_imei" => $_POST["nuevoSerie"],
							   "pass" => $_POST["nuevoPass"],
							   "comentarios" => ucfirst($_POST["nuevoComentario"]),
							   "id_sucursal" => $_SESSION["sucursal"],
							   "precio" => $_POST["nuevoPrecio"],
							   "id_reparacion" => $_POST["idReparacion"],
							   "id_modelo" => $_POST["idModeloReparacion"],
							    "fecha" => $fechaActual,
								"riesgos" => $riesgos);

				$respuesta = ModeloReparaciones::mdlIngresarReparacion($tabla, $datos);

					$item = null;
                    $valor = null;
                   

                    $reparacion2 = ControladorReparaciones::ctrMostrarReparaciones($item, $valor);
                     
                     foreach ($reparacion2 as $key => $reparacionId) {
                        
                      } 

                    $idReparacionTicket = $reparacionId["id"];



				if($respuesta == "ok"){

					echo'<script>

						swal({

							  type: "success",
							  title: "Reparación agregada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  
							  }).then(function(result){
							  	
										if (result.value) {

							
							window.open("extensiones/tcpdf/pdf/notaReparacion.php?codigo='.$idReparacionTicket.'","_blank");

							window.open("extensiones/tcpdf/pdf/etiqueta.php?codigo='.$idReparacionTicket.'","_blank");

							

							window.location = "reparaciones-sucursal";



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

							window.location = "reparaciones-sucursal";

							}
						})

			  	</script>';
			}

		}
	}


	

	/*=============================================
	EDITAR REPARACION
	=============================================*/

	static public function ctrEditarReparacion(){

		if(isset($_POST["editarNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){
			
				$tabla = "reparaciones";

				$riesgos = json_encode($_POST['riesgosSelectEditarReparacion']);
					
					if ($_POST['riesgosSelectEditarReparacion'] === null){
						
						$riesgos = "";
					
					}

				$datos = array(
							   "nombre" => $_POST["editarNombre"],
							   "telefono" => $_POST["editarTelefono"],
							   "modelo" => $_POST["editarModelo"],
							   "marca" => $_POST["editarMarca"],
							   "servicio" => $_POST["editarServicio"],
							   "color" => $_POST["editarColor"],
							   "serie_imei" => $_POST["editarSerie"],
							   "pass" => $_POST["editarPass"],
							   "comentarios" => $_POST["editarComentario"],
							   "riesgos" => $riesgos,
							   "id" => $_POST["editarIdReparacion"],
							   "precio" => $_POST["editarPrecio"]);



				$respuesta = ModeloReparaciones::mdlEditarReparacion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Reparación editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "reparaciones-sucursal";

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

							window.location = "reparaciones-sucursal";

							}
						})

			  	</script>';
			}
		}
	

	}




	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarReparacion(){

		if(isset($_GET["idReparacion"])){

			$tabla ="reparaciones";
			$datos = $_GET["idReparacion"];

			
			$respuesta = ModeloReparaciones::mdlEliminarReparacion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "reparaciones-sucursal";

								}
							})

				</script>';

			}		
		}


	}



/*=============================================
	ACTUALIZAR ESTATUS REPARACION
	=============================================*/

		static public function ctrActualizarEstado(){

		if(isset($_POST["editarStatus"])){

				/*=============================================
			 ACTUALIZAR HISTORIAL SOLO SI HAY TEXTO QUE INGRESAR
			 <br> sirve como salto de guión
				=============================================*/

				$usuario = $_SESSION["nombre"];

					date_default_timezone_set('America/Mexico_City');
					
					$historial1 =  $_POST["editarEstado"];

					if(!$historial1){
				
					$concatenar =  $_POST["comentario1"];

					}else{
				
					$historial2 =  $_POST["comentario1"];


					$fecha = date("Y-m-d H:i:s");
					$concatenar = $fecha." ".$usuario." : ".$historial1."<br>".$historial2;

					}
				
				

				$tabla = "reparaciones";

				$datos = array(
							   "id" => $_POST["actualizarId"],
							   "status" => $_POST["editarStatus"],
							   "historial" => $concatenar);

				$respuesta = ModeloReparaciones::mdlActualizarEstado($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Estado Actualizado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {


									window.location = "reparaciones-sucursal";

										}
									})

						</script>';

				}
		
	
}
	}




/*=============================================
	ACTUALIZAR ENTREGADO
	=============================================*/

		static public function ctrActualizarEntregado(){

				/*=============================================
			 ACTUALIZAR HISTORIAL SOLO SI HAY TEXTO QUE INGRESAR
			 <br> sirve como salto de guión
				=============================================*/

					if(isset($_POST["editarGarantia"])){

					$usuario = $_SESSION["nombre"];
					date_default_timezone_set('America/Mexico_City');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

					$historial3 =  $_POST["comentario2"];

					$fecha = date("Y-m-d H:i:s");
					$concatenar = $fecha." ".$usuario." : "."Entregado"."<br>".$historial3;
					$status = 3;

					$tabla = "reparaciones";
					$item = "id";
					$valor = $_POST["idReparacionEntrega"];
					$respuestaReparaciones = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);


					if ($respuestaReparaciones['status'] == 5){

						$status = 11;

					}

					 
					 /*=============================================
			 SUMAR FECHA DE GARANTIA
				=============================================*/ 
					  $fechaGarantia1 = date("Y-m-d");
					  $fechaGarantia = new DateTime($fechaGarantia1);
					  $dias = $_POST["editarGarantia"];
               		  $fechaGarantia -> add(new DateInterval('P'.$dias.'D'));
               		  $fechaGarantia2 = $fechaGarantia->format('Y-m-d');
               		  $fechaGarantia3 = $fechaGarantia->format('d-m-Y');
               		  $tipo = 1;
               		
               		//echo date('Y-m-d', strtotime($fechaGarantia.'+'.$dias.' days'));
				
			

				$tabla = "reparaciones";

				$datos = array(
							   "id" => $_POST["idReparacionEntrega"],
							   "fecha_entrega" => date("Y-m-d"),
							   "status" => $status,
							   "vigencia_garantia" => $fechaGarantia2,
							   "historial" => $concatenar);

				$respuesta = ModeloReparaciones::mdlActualizarEntrega($tabla, $datos);

			/*=============================================
			GRABAR VENTA EN TABLA VENTAS_STOCK 
			=============================================*/

				$usuario = $_SESSION["nombre"];
				$tabla = "ventas_stock";

				$datos = array("codigo" => "REPARACIÓN, CÓDIGO: "."MIX0".$_POST["idReparacionEntrega"]." ".$_POST["modeloEntregado"],
					"sucursal" => $_SESSION["sucursal"],
					"cantidad" => "1",
					"tipo" => "1",
					"total" => $_POST["importeTotal2"],
					"fecha" => $fechaActual);

				$respuesta = ModeloProductos::mdlIngresarStockVentas($tabla, $datos);


			/*=============================================
			GRABAR VENTA EN TABLA ACTIVIDADES FINANZAS 
			=============================================*/

				$concepto = "REPARACIÓN, CÓDIGO: "."MIX0".$_POST["idReparacionEntrega"];

				$tabla = "ingresosgastos";

				$datos = array(
					"usuario" => $_SESSION["nombre"],
					"concepto" => $concepto,
					"id_sucursal" => $_SESSION["sucursal"],
					"ingreso" => $_POST["importeTotal2"],
					"fecha" => $fechaActual);

				$respuesta = ModeloFinanzas::mdlIngresarFinanza($tabla, $datos);

			$item = "id";
            $valor = $_SESSION["sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

            $hoy = date("d-m-Y");

				if($respuesta == "ok"){

				try{


				$item = "id";
            	$valor = $_POST["idSucursal"];


            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

				$impresora = $sucursal["impresora"];
				$conector = new WindowsPrintConnector($impresora);

				
				$imprimir = new Printer($conector);
				
				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				

				try {

				//$logo = EscposImage::load("logo2.png", false);
   				$logo = EscposImage::load("logo.png", false);
				$imprimir -> bitImage($logo);

   				}catch(Exception $e){

   				//$imprimir->text($e->getMessage() . "\n");


   				}

				//$imprimir->bitImage($tux);
				// $imprimir -> setTextSize(2, 2);
				// $imprimir -> text("Mix Store"."\n");
				// $imprimir -> setTextSize(1,1);
				$imprimir -> feed();
				$imprimir -> text("SUC. ".$sucursal["nombre"]."\n");
				$imprimir -> text(date("d-m-Y H:i:s")."\n");
				$imprimir -> feed();

				$imprimir -> text("MIX0".$_POST["idReparacionEntrega"]."\n");
					
				$imprimir -> feed(1);

				$imprimir -> text("TOTAL: $".number_format($_POST["importeTotal2"],2)."\n");
				
				$imprimir -> feed();
				$imprimir -> text("EQUIPO ENTREGADO");
				$imprimir -> feed();

				if ($fechaGarantia3 != $hoy) {

					$imprimir -> text("Garantía hasta: ".$fechaGarantia3."\n");

				} else {
					$imprimir -> text("Sin Garatía"."\n");
				}

				
				$imprimir -> feed(1);
				$imprimir->setBarcodeHeight(100);

				$imprimir->barcode($_POST["idReparacionEntrega"]);

				//$imprimir -> barcode($item, Printer::BARCODE_CODE128);
    			

    			$imprimir -> feed();
				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				$imprimir -> text("#LuceAlMáximo");
				$imprimir -> feed();
				$imprimir -> text("GRACIAS POR SU PREFERENCIA");
				$imprimir -> feed(4);
				$imprimir -> close();

				}catch(Exception $e){



   				}




					echo'<script>

						swal({
							  type: "success",
							  title: "Estado Actualizado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {


										window.open("extensiones/tcpdf/pdf/ticketReparacion.php?codigo='.$_POST["idReparacionEntrega"].'","_blank");

											window.location = "reparaciones-sucursal";
										}
									})

						</script>';

				}
		
	

	}

}




/*=============================================
	ACTUALIZAR PRECIO
	=============================================*/

		static public function ctrActualizarPrecio(){

				/*=============================================
			 ACTUALIZAR HISTORIAL SOLO SI HAY TEXTO QUE INGRESAR
			 <br> sirve como salto de guión
				=============================================*/

if(isset($_POST["nuevoPrecioActualizar"])){

				$usuario = $_SESSION["nombre"];
					date_default_timezone_set('America/Mexico_City');

				$precioActual = $_POST["importeActual2"];
				$nuevoPrecio =  $_POST["nuevoPrecioActualizar"];
				$historial3 =  $_POST["historialCompleto"];
				$servicioNuevo =  $_POST["editarServicioPrecio"];
				$motivo =  $_POST["historialCambioPrecio"];
				$fecha = date("Y-m-d H:i:s");
					

				$concatenar = $fecha." ".$usuario." : "."Cambio de Precio ".$precioActual." -> $".$nuevoPrecio." ".$motivo."<br>".$historial3;

		
				$tabla = "reparaciones";

				$datos = array(
							   "id" => $_POST["idReparacionPrecio"],
							   "precio" => $nuevoPrecio,
							   "servicio" => $servicioNuevo,
							   "historial" => $concatenar);

				$respuesta = ModeloReparaciones::mdlActualizarPrecio($tabla, $datos);

				

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Estado Actualizado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {


											window.location = "reparaciones-sucursal";

										}
									})

						</script>';

				}
		
	

	}

}




/*=============================================
	AGREGAR ANTICIPO 
	=============================================*/

		static public function ctrAgregarAnticipo(){


				if(isset($_POST["ingresarAnticipo"])){

			
				date_default_timezone_set('America/Mexico_City');

					$fecha = date('Y-m-d');
					$hora = date('H:i:s');

					$fechaActual = $fecha.' '.$hora;
				

				$anticipo =  $_POST["ingresarAnticipo"];
				
				

			/*=============================================
			GRABAR VENTA EN TABLA VENTAS_STOCK 
			=============================================*/

				$tabla = "ventas_stock";

				$datos = array("codigo" => "ANTICIPO REPARACIÓN, CÓDIGO: "."MIX0".$_POST["idReparacionAnticipo"]." ".$_POST["modeloEntregado"],
					"sucursal" => $_SESSION["sucursal"],
					"cantidad" => "1",
					"tipo" => "1",
					"total" => $anticipo,
					"fecha" => $fechaActual);

				$respuesta = ModeloProductos::mdlIngresarStockVentas($tabla, $datos);

					
					$historial =  $_POST["historialAnticipo"];
						$usuario = $_SESSION["nombre"];

				$concatenar = $fechaActual." ".$usuario." : "."Anticipo de: $ ".$anticipo."<br>".$historial;

		
				$tabla = "reparaciones";

				$datos = array("id" => $_POST["idReparacionAnticipo"],
							   "anticipo" => $anticipo,
							   "historial" => $concatenar);

				$respuesta = ModeloReparaciones::mdlAgregarAnticipo($tabla, $datos);

				

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Anticipo agregado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {


										window.open("extensiones/tcpdf/pdf/ticketAnticipo.php?codigo='.$_POST["idReparacionAnticipo"].'","_blank");

										window.location = "reparaciones-sucursal";

										}
									})

						</script>';

				}
		
	

	}

}



	/*=============================================
	EDITAR REPARACION COMISION
	=============================================*/

	static public function ctrEditarReparacionComision(){

		if(isset($_POST["idReparacionComision"])){

			
			
				$tabla = "reparaciones";

			

				$datos = array(
							   "comision" => $_POST["calculoComision"],
							   "id" => $_POST["idReparacionComision"],
							   "costo_pieza" => $_POST["costoRefaccionComision"]);



				$respuesta = ModeloReparaciones::mdlEditarReparacionComision($tabla, $datos);




			$item = "id";
            $valor = $_POST["idSucursalComision"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);


				$hoy = date("Y-m-d");
				$tabla = "ingresosgastos";


		
				$datos = array(
					"usuario" => $_SESSION["nombre"],
					"id_sucursal" => $_POST["idSucursalComision"],
					"concepto" => "NOMINA, COMISIÓN MIX0".$_POST["idReparacionComision"]." ".$_POST["seleccionarUsuarioComision"].", Sucursal: ".$sucursal["nombre"],
					"gasto" => $_POST["calculoComision"]);

				$respuesta = ModeloFinanzas::mdlIngresarGasto($tabla, $datos);




				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Reparación editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "listado-reparaciones";

										}
									})

						</script>';

				}


			
		}
	

	}





}