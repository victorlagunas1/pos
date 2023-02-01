<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;



class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

					
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

			date_default_timezone_set('America/Mexico_City');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;


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



           /*=============================================
			DESCONTAR DE STOCK LA VENTA REALIZADA EN LA TABLA STOCK_SUCURSAL
			=============================================*/

				$tablaStock = "stock_sucursal";

				$itemStock = "stock";
				$valorStock = $value["stock"];

				$valorCodigo = $traerProducto["codigo"];
				$sucursal = $_POST["idSucursal"];

				$nuevoStock = ModeloProductos::mdlActualizarProductoStock($tablaStock, $itemStock, $valorStock, $valorCodigo, $sucursal);

			
			/*=============================================
			NOTIFICACION DE PRODUCTO BAJO O AGOTADO EN USUARIOS_NOTIFICACIONES
			=============================================*/

			$item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            foreach ($usuarios as $key => $usuarioValue) {

            
            switch($usuarioValue["perfil"]) {

            	case "Administrador":

            	if ($value["stock"] <= 0){ 

				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $usuarioValue["id"],
					"id_sucursal" => $usuarioValue["sucursal"],
					"titulo" => "Producto agotado",
					"descripcion" => $value["descripcion"]." Suc: ".$_SESSION["sucursal"],
					"tipo" => "1",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

				
				}else if ($value["stock"] <= 3){
				
				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $usuarioValue["id"],
					"id_sucursal" => $usuarioValue["sucursal"],
					"titulo" => "Producto con bajo stock",
					"descripcion" => $value["descripcion"]." Suc: ".$_SESSION["sucursal"],
					"tipo" => "2",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

			}


            	 break;


            	case "Administrador de Sucursal":

            	if ($value["stock"] <= 0){ 

				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $usuarioValue["id"],
					"id_sucursal" => $usuarioValue["sucursal"],
					"titulo" => "Producto agotado",
					"descripcion" => $value["descripcion"],
					"tipo" => "1",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

				
				}else if ($value["stock"] <= 3){
				
				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $usuarioValue["id"],
					"id_sucursal" => $usuarioValue["sucursal"],
					"titulo" => "Producto con bajo stock",
					"descripcion" => $value["descripcion"],
					"tipo" => "2",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

			}


            	 break;
            	 

            	case "Vendedor":

            	 break;

            	case "Técnico Reparador":

            	 break;

            }

        }


				if ($value["stock"] <= 0){ 

				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $_SESSION["id"],
					"id_sucursal" => $_SESSION["sucursal"],
					"titulo" => "Producto agotado",
					"descripcion" => $value["descripcion"],
					"tipo" => "1",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

				
				}else if ($value["stock"] <= 3){
				
				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $_SESSION["id"],
					"id_sucursal" => $_SESSION["sucursal"],
					"titulo" => "Producto con bajo stock",
					"descripcion" => $value["descripcion"],
					"tipo" => "2",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

			}

			


			/*=============================================
			GRABAR VENTA EN TABLA VENTAS_STOCK 
			=============================================*/

				$usuario = $_SESSION["nombre"];
				$tabla = "ventas_stock";

				$datos = array("codigo" => $traerProducto["codigo"],
					"sucursal" => $_POST["idSucursal"],
					"cantidad" => $value["cantidad"],
					"total" => $value["precio"],
					"fecha" => $fechaActual);

				$respuesta = ModeloProductos::mdlIngresarStockVentas($tabla, $datos);


			/*=============================================
			GRABAR VENTA EN TABLA ACTIVIDADES FINANZAS 
			=============================================*/

				$concepto = "VENTA articulo, codigo: ".$traerProducto["codigo"];
				$tabla = "ingresosgastos";

				$datos = array(
					"usuario" => $_SESSION["nombre"],
					"concepto" => $concepto,
					"id_sucursal" => $_SESSION["sucursal"],
					"ingreso" => $value["precio"],
					"fecha" => $fechaActual);

				$respuesta = ModeloFinanzas::mdlIngresarFinanza($tabla, $datos);

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

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

					$item = null;
                    $valor = null;

                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                     foreach ($ventas as $key => $valueVentas) {
                        
                      } 

                    $idVenta = $valueVentas["codigo"]+1;


			$tabla = "ventas";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=> $idVenta,
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "sucursal"=>$sucursal,
						   "total"=>$_POST["totalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "fecha" => $fechaActual);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			$item = "id";
            $valor = $sucursal;

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
            


 	//		if($respuesta == "ok"){



// 				try {
// 				$item = "id";
//             	$valor = $_POST["idSucursal"];


//             $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

// 				$impresora = $sucursal["impresora"];
// 				$conector = new WindowsPrintConnector($impresora);

// 				$imprimir = new Printer($conector);
				
// 				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				

// 				try {

// 				$logo = EscposImage::load("logo.png", false);
//    				$imprimir->bitImage($logo); 

//    				}catch(Exception $e){

//    				//$imprimir->text($e->getMessage() . "\n");


//    				}

// 				//$imprimir->bitImage($tux);
// 				$imprimir -> feed();
// 				$imprimir -> text($sucursal["nombre"]."\n");
// 				$imprimir -> text(date("Y-m-d H:i:s")."\n");
// 				$imprimir -> feed();
// 				$imprimir -> text("No. Venta: ".$idVenta."\n");

// 				$imprimir -> feed(1);

// 				foreach ($listaProductos as $key => $value) {
// 					$imprimir -> setJustification(Printer::JUSTIFY_LEFT);
// 					$imprimir -> text($value["descripcion"]."\n");
// 					$imprimir -> setJustification(Printer::JUSTIFY_RIGHT);
// 					$imprimir -> text("$ ".number_format($value["precio"],2)." x".$value["cantidad"]." $ ".number_format($value["total"],2)."\n");

// 					# code...
// 				}

// 				$imprimir -> feed(2);
				
// 				$imprimir -> text($_POST["listaMetodoPago"]."\n");
// 				$imprimir -> text("TOTAL: $ ".number_format($_POST["totalVenta"],2)."\n");

				
// 				//IMPRIMIR CAMBIO DE VENTA, COMPROBAR AUN ""

// 				if ($_POST["diferenciaCambio"] != null){
// 				$imprimir -> text("CAMBIO: $ ".number_format($_POST["diferenciaCambio"],2)."\n");
// 			} else {

// 			}

				

// 				$imprimir -> feed(2);
// 				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				
// 				$imprimir->setBarcodeHeight(100);
// 				$imprimir->barcode($idVenta);
// 				$imprimir -> feed();

// 				$imprimir -> text("#LuceAlMáximo");
// 				$imprimir -> feed();
// 				$imprimir -> text("GRACIAS POR SU PREFERENCIA");
// 				$imprimir -> feed(4);
// 				$imprimir -> close();

// 				}catch(Exception $e){

//    				//$imprimir->text($e->getMessage() . "\n");


//    				}

// //PROBAR SI FUNCIONA VENDIDENDO DOS TICKETS CON TARJETA
//    				if ($_POST["listaMetodoPago"] != "Efectivo"){



           
//    				try {

//    			$item = "id";
//             $valor = $_POST["idSucursal"];

//             $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);



// 				$impresora = $sucursal["impresora"];
// 				$conector = new WindowsPrintConnector($impresora);

// 				$imprimir = new Printer($conector);
				
// 				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				

// 				try {

// 				$logo = EscposImage::load("logo.png", false);
//    				$imprimir->bitImage($logo); 

//    				}catch(Exception $e){

//    				//$imprimir->text($e->getMessage() . "\n");


//    				}

// 				//$imprimir->bitImage($tux);
// 				$imprimir -> feed();
// 				$imprimir -> text("SUC. ".$sucursal["nombre"]."\n");
// 				$imprimir -> text(date("Y-m-d H:i:s")."\n");
// 				$imprimir -> feed();
// 				$imprimir -> text("No. Venta: ".$idVenta."\n");

// 				$imprimir -> feed(1);

// 				foreach ($listaProductos as $key => $value) {
// 					$imprimir -> setJustification(Printer::JUSTIFY_LEFT);
// 					$imprimir -> text($value["descripcion"]."\n");
// 					$imprimir -> setJustification(Printer::JUSTIFY_RIGHT);
// 					$imprimir -> text("$ ".number_format($value["precio"],2)." x".$value["cantidad"]." $ ".number_format($value["total"],2)."\n");

// 					# code...
// 				}

// 				$imprimir -> feed(2);
				
// 				$imprimir -> text($_POST["listaMetodoPago"]."\n");
// 				$imprimir -> text("TOTAL: $ ".number_format($_POST["totalVenta"],2)."\n");


// 				//COMPROBAR AUN CAMBIO
// 				// $imprimir -> text("CAMBIO: $ ".number_format($_POST["diferenciaCambio"],2)."\n");


				

// 				$imprimir -> feed(2);
// 				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				
// 				$imprimir->setBarcodeHeight(100);
// 				$imprimir->barcode($idVenta);
// 				$imprimir -> feed();

// 				$imprimir -> text("#LuceAlMáximo");
// 				$imprimir -> feed();
// 				$imprimir -> text("GRACIAS POR SU PREFERENCIA");
// 				$imprimir -> feed(4);
// 				$imprimir -> close();


// 				}catch(Exception $e){

//    				//$imprimir->text($e->getMessage() . "\n");


//    				}

//}


   				


				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

					

					window.open("extensiones/tcpdf/pdf/ticket.php?codigo='.$idVenta.'","_blank");
					window.location = "crear-venta2";




								}
							})



				</script>';

			//}

		}

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaClientes = "clientes";

				$itemCliente = "id";
				$valorCliente = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id";
					$valor_2 = $value["id"];
					$orden = "id";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Mexico_City');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarVenta"],
						   "productos"=>$listaProductos,
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"]);


			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}

		}

	}


	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}		
		}

	}

	/*=============================================
	RANGO FECHAS CORTE DIA
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	RANGO FECHAS CORTE DIA POR SUCURSAL SOLO MUESTRA VENTAS POR CADA USUARIO DE ESE MISMO DIA 
	=============================================*/	

	static public function ctrRangoFechasVentasSucursal($fechaInicial, $fechaFinal, $sucursal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentasSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal);

		return $respuesta;
		
	}



		/*=============================================
	RANGO FECHAS VENTAS DIAS SUCURSAL
	=============================================*/	

	static public function ctrRangoFechasVentasStock($fechaInicial, $fechaFinal, $sucursal){

		$tabla = "ventas_stock";

		$respuesta = ModeloVentas::mdlRangoFechasVentasSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal);

		return $respuesta;
		
	}



	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["productos"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";

		}

	}


	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}


	/*=============================================
	SUMA TOTAL VENTAS DIA
	=============================================*/

	static public function ctrSumaTotalVentasDia($fechaInicial, $fechaFinal){

		$tabla = "ventas";
		$fechaFinal = date("Y-m-d");

		$respuesta = ModeloVentas::mdlSumaTotalVentasDia($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	

	}


	/*=============================================
	SUMA TOTAL VENTAS DIA
	=============================================*/

	static public function ctrSumaTotalVentasDiaSucursal($fechaInicial, $fechaFinal, $sucursal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentasDiaSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal);

		return $respuesta;
		
	

	}


	/*=============================================
	SUMA TOTAL REPARACIONES DEL DÍA 
	=============================================*/

	static public function ctrSumaTotalReparacionesDia($fechaInicial, $fechaFinal, $tipo, $sucursal){

		$tabla = "ventas_stock";

		$respuesta = ModeloVentas::mdlSumaTotalReparacionesDia($tabla, $fechaInicial, $fechaFinal, $tipo, $sucursal);

		return $respuesta;
		
	

	}

	/*=============================================
	SUMA TOTAL REPARACIONES DEL DÍA SUCURSAL
	=============================================*/

	static public function ctrSumaTotalReparacionesDiaSucursal($fechaInicial, $fechaFinal, $tipo, $sucursal){

		$tabla = "ventas_stock";

		$respuesta = ModeloVentas::mdlSumaTotalReparaciones($tabla, $fechaInicial, $fechaFinal, $tipo, $sucursal);

		return $respuesta;
		
	

	}



	/*=============================================
	REPORTE POR MARCA MODELO BOX
	=============================================*/	

	static public function ctrReporteMarcaModeloBoxInversion($codigo, $orden){

		$tabla = "productos";

		$respuesta = ModeloVentas::mdlSumadeInversionProducto($tabla, $codigo, $orden);

		return $respuesta;
		
	}

	/*=============================================
	REPORTE POR MARCA MODELO BOX 2
	=============================================*/	

	static public function ctrReporteMarcaModeloBoxTotal($codigo, $orden){

		$tabla = "ventas_stock";

		$respuesta = ModeloVentas::mdlSumadeArticuloVentasTotal($tabla, $codigo, $orden);

		return $respuesta;
		
	}


		/*=============================================
	REPORTE POR MARCA MODELO BOX 3 PRODUCTOS EN INVETARIO
	=============================================*/	

	static public function ctrReporteMarcaModeloBox3InventarioStock($codigo, $orden){

		$tabla = "productos";

		$respuesta = ModeloVentas::mdlSumadeArticuloInventarioModelo($tabla, $codigo, $orden);

		return $respuesta;
		
	}



	/*=============================================
	REPORTE POR MARCA MODELO BOX 3 PRODUCTOS EN INVETARIO
	=============================================*/	

	static public function ctrReporteMarcaModeloBox4Ventas($codigo, $orden){

		$tabla = "productos";

		$respuesta = ModeloVentas::mdlSumadeVentasArticuloModelo($tabla, $codigo, $orden);

		return $respuesta;
		
	}
	

	static public function ctrMostrarProductosxId($codigo, $orden){

		$tabla = "productos";

		$respuesta = ModeloVentas::mdlMostrarProductosIdModelo($tabla, $codigo, $orden);

		return $respuesta;
		
	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrImprimirTicketReporte(){

		
			

			

				echo'<script>

				swal({
					  type: "success",
					  title: "Reporte impreso correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventasdia-sucursal";

								}
							})

				</script>';

				
		


	}

	/*=============================================
	MOSTRAR PROMOCIONALES
	=============================================*/

	static public function ctrMostrarPromocionales($item, $valor){

		$tabla = "ventas_promocionales";

		$respuesta = ModeloVentas::mdlMostrarPromocionales($tabla, $item, $valor);

		return $respuesta;

	}


		/*=============================================
				REGISTRO DE PROMOCIONAL
	=============================================*/
 static public function ctrCrearPromocionales(){

		if(isset($_POST["nuevoPromocionNombre"])){



			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoPromocionNombre"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevoPromocionFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevoPromocionFoto"]["tmp_name"]);

					$nuevoAncho = 900;
					$nuevoAlto = 500;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevoPromocionFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/promocionales/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevoPromocionFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevoPromocionFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/promocionales/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevoPromocionFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}


			$tabla = "ventas_promocionales";


 			$datos = array("nombre" => $_POST["nuevoPromocionNombre"],
					           "status" => 1,
					           "banner" => $ruta);

				$respuesta = ModeloVentas::mdlIngresarPromocional($tabla, $datos);
			
				

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡Promocional guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "promocionales";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El Promocional no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "promocionales";

						}

					});
				

				</script>';

			}


		}


	}


	/*=============================================
	BORRAR PROMOCIONALES
	=============================================*/

	static public function ctrBorrarPromocional(){

		if(isset($_GET["idPromocion"])){

			$tabla ="ventas_promocionales";
			$datos = $_GET["idPromocion"];

			if($_GET["fotoPromocional"] != ""){

				unlink($_GET["fotoPromocional"]);
				rmdir($_GET["fotoPromocional"]);

			}

			$respuesta = ModeloVentas::mdlEliminarPromocional($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Promoción borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "promocionales";

								}
							})

				</script>';

			}		

		}

	}




	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVentaNV2(){


if(isset($_POST["idSucursal"])){

		   echo '<script>
		  


		   swal({
            type: "info",
            title: "Efectivo ",
            text: "Ingresa la cantidad en efectivo recibida",
            showConfirmButton: true,
            input: "number",
            confirmButtonText: "Aceptar"

            }).then(function(result){
                if (result.value) {
                  window.location = "index.php?ruta=sucursales-estadistico";


               

                  swal({
            type: "success",
            title: "Cambio es:",
            showConfirmButton: true,
            confirmButtonText: "Aceptar"

          })



                }



              })
              </script>';
          }

					
		if(isset($_POST["idSucursal2"])){

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

								window.location = "crear-venta3";

								}
							})

				</script>';

				return;
			}

			date_default_timezone_set('America/Mexico_City');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;


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



           /*=============================================
			DESCONTAR DE STOCK LA VENTA REALIZADA EN LA TABLA STOCK_SUCURSAL
			=============================================*/

				$tablaStock = "stock_sucursal";

				$itemStock = "stock";
				$valorStock = $value["stock"];

				$valorCodigo = $traerProducto["codigo"];
				$sucursal = $_POST["idSucursal"];

				$nuevoStock = ModeloProductos::mdlActualizarProductoStock($tablaStock, $itemStock, $valorStock, $valorCodigo, $sucursal);

			
			/*=============================================
			NOTIFICACION DE PRODUCTO BAJO O AGOTADO EN USUARIOS_NOTIFICACIONES
			=============================================*/

			$item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            foreach ($usuarios as $key => $usuarioValue) {

            
            switch($usuarioValue["perfil"]) {

            	case "Administrador":

            	if ($value["stock"] <= 0){ 

				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $usuarioValue["id"],
					"id_sucursal" => $usuarioValue["sucursal"],
					"titulo" => "Producto agotado",
					"descripcion" => $value["descripcion"]." Suc: ".$_SESSION["sucursal"],
					"tipo" => "1",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

				
				}else if ($value["stock"] <= 3){
				
				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $usuarioValue["id"],
					"id_sucursal" => $usuarioValue["sucursal"],
					"titulo" => "Producto con bajo stock",
					"descripcion" => $value["descripcion"]." Suc: ".$_SESSION["sucursal"],
					"tipo" => "2",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

			}


            	 break;


            	case "Administrador de Sucursal":

            	if ($value["stock"] <= 0){ 

				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $usuarioValue["id"],
					"id_sucursal" => $usuarioValue["sucursal"],
					"titulo" => "Producto agotado",
					"descripcion" => $value["descripcion"],
					"tipo" => "1",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

				
				}else if ($value["stock"] <= 3){
				
				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $usuarioValue["id"],
					"id_sucursal" => $usuarioValue["sucursal"],
					"titulo" => "Producto con bajo stock",
					"descripcion" => $value["descripcion"],
					"tipo" => "2",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

			}


            	 break;
            	 

            	case "Vendedor":

            	 break;

            	case "Técnico Reparador":

            	 break;

            }

        }


				if ($value["stock"] <= 0){ 

				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $_SESSION["id"],
					"id_sucursal" => $_SESSION["sucursal"],
					"titulo" => "Producto agotado",
					"descripcion" => $value["descripcion"],
					"tipo" => "1",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

				
				}else if ($value["stock"] <= 3){
				
				$tabla = "usuarios_notificaciones";

				$datos = array("id_usuario" => $_SESSION["id"],
					"id_sucursal" => $_SESSION["sucursal"],
					"titulo" => "Producto con bajo stock",
					"descripcion" => $value["descripcion"],
					"tipo" => "2",
					"status" => 1);

				$notificacion = ModeloUsuarios::mdlIngresarNotificacion($tabla, $datos);

			}

			


			/*=============================================
			GRABAR VENTA EN TABLA VENTAS_STOCK 
			=============================================*/

				$usuario = $_SESSION["nombre"];
				$tabla = "ventas_stock";

				$datos = array("codigo" => $traerProducto["codigo"],
					"sucursal" => $_POST["idSucursal"],
					"cantidad" => $value["cantidad"],
					"total" => $value["precio"],
					"fecha" => $fechaActual);

				$respuesta = ModeloProductos::mdlIngresarStockVentas($tabla, $datos);


			/*=============================================
			GRABAR VENTA EN TABLA ACTIVIDADES FINANZAS 
			=============================================*/

				$concepto = "VENTA articulo, codigo: ".$traerProducto["codigo"];
				$tabla = "ingresosgastos";

				$datos = array(
					"usuario" => $_SESSION["nombre"],
					"concepto" => $concepto,
					"id_sucursal" => $_SESSION["sucursal"],
					"ingreso" => $value["precio"],
					"fecha" => $fechaActual);

				$respuesta = ModeloFinanzas::mdlIngresarFinanza($tabla, $datos);

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

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

					$item = null;
                    $valor = null;

                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                     foreach ($ventas as $key => $valueVentas) {
                        
                      } 

                    $idVenta = $valueVentas["codigo"]+1;


			$tabla = "ventas";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=> $idVenta,
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "sucursal"=>$sucursal,
						   "total"=>$_POST["totalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "fecha" => $fechaActual);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			$item = "id";
            $valor = $sucursal;

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
            


				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

					

					window.open("extensiones/tcpdf/pdf/ticket.php?codigo='.$idVenta.'","_blank");
					window.location = "crear-venta2";




								}
							})



				</script>';

			//}

		}

	}



	

}