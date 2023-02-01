<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;




	/*=============================================
	CREAR VENTA
	=============================================*/

	//function ctrCrearVenta(){


		if(isset($_POST["idSucursal"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

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


			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";

			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

		 /*=============================================
			GRABAR TIPO, BUSCANDO EL PRODUCTOS EN BASE DE DATOS Y COMPROBANDO QUE TENGA MODELO
			=============================================*/
				
				

				if ($traerProducto["id_modelo"] == "0"){
					$tipo = 1;


				} else {
					$tipo = 0;


				}

			
				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

			    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];
				

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);



			}

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			date_default_timezone_set('America/Mexico_City');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			$sucursal = $_SESSION["sucursal"];



			$item = "id";
            $valor = $sucursal;

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
            


				try {
				$item = "id";
            	$valor = $_POST["idSucursal"];


            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

				$impresora = $sucursal["impresora"];
				$conector = new WindowsPrintConnector($impresora);

				$imprimir = new Printer($conector);
				
				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				

				try {

				$logo = EscposImage::load("logo.png", false);
   				$imprimir->bitImage($logo); 

   				}catch(Exception $e){

   				//$imprimir->text($e->getMessage() . "\n");


   				}

				//$imprimir->bitImage($tux);
				$imprimir -> feed();
				$imprimir -> text($sucursal["nombre"]."\n");
				$imprimir -> text(date("Y-m-d H:i:s")."\n");
				$imprimir -> feed();
				$imprimir -> text("No. Venta: ".$idVenta."\n");

				$imprimir -> feed(1);

				foreach ($listaProductos as $key => $value) {
					$imprimir -> setJustification(Printer::JUSTIFY_LEFT);
					$imprimir -> text($value["descripcion"]."\n");
					$imprimir -> setJustification(Printer::JUSTIFY_RIGHT);
					$imprimir -> text("$ ".number_format($value["precio"],2)." x".$value["cantidad"]." $ ".number_format($value["total"],2)."\n");

					# code...
				}

				$imprimir -> feed(2);
				
				$imprimir -> text($_POST["listaMetodoPago"]."\n");
				$imprimir -> text("TOTAL: $ ".number_format($_POST["totalVenta"],2)."\n");

				
				//IMPRIMIR CAMBIO DE VENTA, COMPROBAR AUN ""

				if ($_POST["diferenciaCambio"] != null){
				$imprimir -> text("CAMBIO: $ ".number_format($_POST["diferenciaCambio"],2)."\n");
			} else {

			}

				

				$imprimir -> feed(2);
				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				
				$imprimir->setBarcodeHeight(100);
				$imprimir->barcode($idVenta);
				$imprimir -> feed();

				$imprimir -> text("#LuceAlMáximo");
				$imprimir -> feed();
				$imprimir -> text("GRACIAS POR SU PREFERENCIA");
				$imprimir -> feed(4);
				$imprimir -> close();

				}catch(Exception $e){

   				//$imprimir->text($e->getMessage() . "\n");


   				}

//PROBAR SI FUNCIONA VENDIDENDO DOS TICKETS CON TARJETA
   				if ($_POST["listaMetodoPago"] != "Efectivo"){

   				try {

   			$item = "id";
            $valor = $_POST["idSucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);



				$impresora = $sucursal["impresora"];
				$conector = new WindowsPrintConnector($impresora);

				$imprimir = new Printer($conector);
				
				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				

				try {

				$logo = EscposImage::load("logo.png", false);
   				$imprimir->bitImage($logo); 

   				}catch(Exception $e){

   				//$imprimir->text($e->getMessage() . "\n");


   				}

				//$imprimir->bitImage($tux);
				$imprimir -> feed();
				$imprimir -> text("SUC. ".$sucursal["nombre"]."\n");
				$imprimir -> text(date("Y-m-d H:i:s")."\n");
				$imprimir -> feed();
				$imprimir -> text("No. Venta: ".$idVenta."\n");

				$imprimir -> feed(1);

				foreach ($listaProductos as $key => $value) {
					$imprimir -> setJustification(Printer::JUSTIFY_LEFT);
					$imprimir -> text($value["descripcion"]."\n");
					$imprimir -> setJustification(Printer::JUSTIFY_RIGHT);
					$imprimir -> text("$ ".number_format($value["precio"],2)." x".$value["cantidad"]." $ ".number_format($value["total"],2)."\n");

					# code...
				}

				$imprimir -> feed(2);
				
				$imprimir -> text($_POST["listaMetodoPago"]."\n");
				$imprimir -> text("TOTAL: $ ".number_format($_POST["totalVenta"],2)."\n");


				//COMPROBAR AUN CAMBIO
				// $imprimir -> text("CAMBIO: $ ".number_format($_POST["diferenciaCambio"],2)."\n");


				

				$imprimir -> feed(2);
				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				
				$imprimir->setBarcodeHeight(100);
				$imprimir->barcode($idVenta);
				$imprimir -> feed();

				$imprimir -> text("#LuceAlMáximo");
				$imprimir -> feed();
				$imprimir -> text("GRACIAS POR SU PREFERENCIA");
				$imprimir -> feed(4);
				$imprimir -> close();


				}catch(Exception $e){

   				//$imprimir->text($e->getMessage() . "\n");


   				}

}


   				


				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "Ticket impreso correctamente",
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

	//}

	//ctrCrearVenta();



	