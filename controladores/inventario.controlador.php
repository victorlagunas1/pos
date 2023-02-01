<?php

class ControladorInventarios{

		/*=============================================
	MOSTRAR INVENTARIO
	=============================================*/

	static public function ctrMostrarInvetario($item, $valor){

		$tabla = "inventario";

		$respuesta = ModeloInventarios::mdlMostrarInvetario($tabla, $item, $valor);

		return $respuesta;
	}

 
// 	/*=============================================
// 	CREAR INVENTARIO
// 	=============================================*/

// 	static public function ctrCrearInvetario(){

// 		if(isset($_POST["listaProductosInventario"])){

// 			/*=============================================
// 			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
// 			=============================================*/

// 			if($_POST["listaProductosInventario"] == ""){

// 					echo'<script>

// 				swal({
// 					  type: "error",
// 					  title: "El inventario no se ha ejecuta si no hay productos",
// 					  showConfirmButton: true,
// 					  confirmButtonText: "Cerrar"
// 					  }).then(function(result){
// 								if (result.value) {

// 								window.location = "inventario";

// 								}
// 							})

// 				</script>';

// 				return;
			

// 			} else {




// 		$item = null;
//     	$valor = $_SESSION["sucursal"];
//     	$orden = "id";

// 			$productos = ControladorProductos::ctrMostrarStockProductosSucursal($item, $valor, $orden);

// 			$totalProductosAnterior = array();

 			
//  			foreach ($productos as $key => $value) {

//  				array_push($totalProductosAnterior, array("codigo" => $value["producto"], "stock" => $value["stock"]));
	
// 		}	
		

// 		$totalProductosAnterior2 = json_encode($totalProductosAnterior);
	

// 		 /*=============================================
// 			GRABAR TIPO, BUSCANDO EL PRODUCTOS EN BASE DE DATOS Y COMPROBANDO QUE TENGA MODELO
// 			=============================================*/	
// 			$tabla = "inventario";

// 			$datos = array(
// 						   "stock_nuevo"=> $_POST["listaProductosInventario"],
// 						    "stock_inicial"=> $totalProductosAnterior2,
// 						   "status"=> "0",
// 						   "usuario"=> $_SESSION["id"],
// 						   "id_sucursal"=>$_SESSION["sucursal"]);

// 			$respuesta = ModeloInventarios::mdlIngresarInventario($tabla, $datos);

			
// 			// $item = "id";
//    //          $valor = $sucursal;

//    //          $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
            


// 			if($respuesta == "ok"){


// 				echo'<script>

// 				localStorage.removeItem("rango");

// 				swal({
// 					  type: "success",
// 					  title: "Inventario guardado correctamente",
// 					  showConfirmButton: true,
// 					  confirmButtonText: "Cerrar"
// 					  }).then(function(result){
// 								if (result.value) {

// 								window.location = "inventario";

// 								}
// 							})

// 				</script>';

// 			}

// 		//}
// 	}

// 	}




// } 



	static public function ctrAplicarInventario2(){

		
			$item = "id";
            $valor = $_POST["idInventario"];

            $inventario = ControladorInventarios::ctrMostrarInvetario($item, $valor);

        foreach ($respuesta["stock_nuevo"] as $key => $value) {

        $tabla2 = "stock_sucursal";

        $datos2 = array("id_sucursal" => "1",
                 "producto" => $value["codigo"],
                 "stock" => $value["stock"]);

        $respuesta2 = ModeloProductos::mdlIngresarProductoSucursal($tabla2, $datos2);
      
         
         }


			if($inventario == "ok"){


				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "Inventario guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "inventario";

								}
							})

				</script>';

			}

		//}
	//}

	// }




}

	/*=============================================
	CREAR INVENTARIO
	=============================================*/

	static public function ctrCrearNuevoInvetario(){

		if(isset($_POST["crearInventario"])){


		$item = null;
    	$valor = $_SESSION["sucursal"];
    	$orden = "id";

			$productos = ControladorProductos::ctrMostrarStockProductosSucursal($item, $valor, $orden);

			$totalProductosAnterior = array();
			$totalProductosNuevos = array();

 			
 			foreach ($productos as $key => $value) {

 				array_push($totalProductosAnterior, array("codigo" => $value["producto"], "stock" => $value["stock"]));

 				array_push($totalProductosNuevos, array("codigo" => $value["producto"], "stock" => 0));
	
		}	

		$totalProductosAnterior2 = json_encode($totalProductosAnterior);
		$totalProductosNuevos2 = json_encode($totalProductosNuevos);
	

		 /*=============================================
			GRABAR TIPO, BUSCANDO EL PRODUCTOS EN BASE DE DATOS Y COMPROBANDO QUE TENGA MODELO
			=============================================*/	
			$tabla = "inventario";

			$datos = array(
						   "stock_nuevo"=> $totalProductosNuevos2,
						    "stock_inicial"=> $totalProductosAnterior2,
						   "status"=> "0",
						   "usuario"=> $_SESSION["id"],
						   "id_sucursal"=>$_SESSION["sucursal"]);

			$respuesta = ModeloInventarios::mdlIngresarInventario($tabla, $datos);


			if($respuesta == "ok"){


				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "Inventario guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "inventario";

								}
							})

				</script>';

			}
	}

} 

/*=============================================
	CREAR INVENTARIO
	=============================================*/

	static public function ctrActualizarInventario(){

		if(isset($_POST["listaProductosInventarioEditar"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			if($_POST["listaProductosInventarioEditar"] == ""){

					echo'<script>

				swal({
					  type: "error",
					  title: "El inventario no se ha ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "inventario";

								}
							})

				</script>';

				return;
			

			} else {


			$tabla = "inventario";

			$datos = array(
						   "stock_nuevo"=> $_POST["listaProductosInventarioEditar"],
						   "status"=> "0",
						   "id"=> $_POST["idInventarioEditar"]);
			

			$respuesta = ModeloInventarios::mdlInventarioEnProceso($tabla, $datos);

			if($respuesta == "ok"){


				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "Inventario guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "inventario";

								}
							})

				</script>';

			}

		//}
	}

	}




} 






}
	


