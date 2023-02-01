<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR VENTAS TABLA ULTIMA VENTA
	=============================================*/

	static public function mdlMostrarUltimaVentaSucursal($tabla, $sucursal){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE sucursal = $sucursal ORDER BY id DESC");

		
			$stmt -> execute();

			return $stmt -> fetch();

		
		
		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(codigo, id_cliente, id_vendedor, productos, impuesto, neto, total, metodo_pago, sucursal, fecha) VALUES (:codigo, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total, :metodo_pago, :sucursal, :fecha)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":sucursal", $datos["sucursal"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	} 

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total= :total, metodo_pago = :metodo_pago WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

		

			if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	

	}


	/*=============================================
	RANGO FECHAS VENTAS POR SUCURSAL 
	=============================================*/	

	static public function mdlRangoFechasVentasSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal){

		if($fechaInicial == $fechaFinal && $sucursal != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' && sucursal like $sucursal ORDER BY id DESC ");

	
			
			}else if ($fechaInicial != $fechaFinal && $sucursal != null){

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial%' AND '$fechaFinalMasUno' && sucursal = $sucursal ");



		
			}else if ($fechaInicial != $fechaFinal && $sucursal == null){

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial%' AND '$fechaFinalMasUno' ");


			}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			
			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

		/*=============================================
	SUMAR VENTAS DEL DIA 
	=============================================*/

	static public function mdlSumaTotalVentasDia($tabla, $fechaInicial, $fechaFinal){	

		//$fechaInicial = date("Y-m-d");
       // $fechaFinal = date("Y-m-d");
	
	$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE fecha like '%$fechaFinal%'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	SUMAR VENTAS DEL DIA 
	=============================================*/

	static public function mdlSumaTotalVentasDiaSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal){	

		//$fechaInicial = date("Y-m-d");
        $fechaFinal = date("Y-m-d");
	
	$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE fecha like '%$fechaFinal%' && sucursal like $sucursal");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	SUMAR REPARACIONES DEL DIA 
	=============================================*/

	static public function mdlSumaTotalReparacionesDia($tabla, $fechaInicial, $fechaFinal, $tipo, $sucursal){	

	if ($sucursal != null ){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE fecha like '%$fechaFinal%' && tipo like $tipo && sucursal like $sucursal");

		$stmt -> execute();
		return $stmt -> fetch();
		
		} else {

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE fecha like '%$fechaFinal%' && tipo like $tipo");

		$stmt -> execute();
		return $stmt -> fetch();
		}
		

		$stmt -> close();

		$stmt = null;

	}

		/*=============================================
	SUMAR REPARACIONES DEL DIA SUCURSAL
	=============================================*/

	static public function mdlSumaTotalReparaciones($tabla, $fechaInicial, $fechaFinal, $tipo, $sucursal){	

		//$fechaInicial = date("Y-m-d");
        $fechaFinal = date("Y-m-d");
	
		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE fecha like '%$fechaFinal%' && tipo like $tipo && sucursal like $sucursal");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
	
	

	/*=============================================
	SUMA ARTICULOS VENDIDOS
	=============================================*/

	static public function mdlSumadeInversionProducto($tabla, $codigo, $orden){	

	
	$stmt = Conexion::conectar()->prepare("SELECT SUM(precio_compra * stock) as precio_compra FROM $tabla WHERE id_modelo like '$codigo'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	SUMA ARTICULOS VENDIDOS
	=============================================*/

	static public function mdlSumadeArticuloVentasTotal($tabla, $codigo, $orden){	

	
	$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE codigo like '$codigo'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	SUMA ARTICULOS EN INVENTARIO POR MODELO
	=============================================*/

	static public function mdlSumadeArticuloInventarioModelo($tabla, $codigo, $orden){	

	
	$stmt = Conexion::conectar()->prepare("SELECT SUM(stock) as stock FROM $tabla WHERE id_modelo like '$codigo'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	SUMA VENTAS POR ARICULO POR MODELO
	=============================================*/

	static public function mdlSumadeVentasArticuloModelo($tabla, $codigo, $orden){	

	
	$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as ventas FROM $tabla WHERE id_modelo like '$codigo'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


		/*=============================================
	MOSTRAR PRODUCTOS POR ID_MODELO
	=============================================*/

	static public function mdlMostrarProductosIdModelo($tabla, $codigo, $orden){	


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_modelo like $codigo ORDER BY codigo DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR PROMOCIONALES
	=============================================*/

	static public function mdlMostrarPromocionales($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}


		/*=============================================
	REGISTRO DE PROMOCIONAL
	=============================================*/

	static public function mdlIngresarPromocional($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(nombre, banner, status ) VALUES (:nombre, :banner, :status)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":banner", $datos["banner"], PDO::PARAM_STR);
		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	} 


	/*=============================================
	ACTUALIZAR STATUS PROMOCIONAL
	=============================================*/

	static public function mdlActualizarPromocional($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET status = :status WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_INT);
		


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



		/*=============================================
	ELIMINAR PROMOCIONAL
	=============================================*/

	static public function mdlEliminarPromocional($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


		/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasReparacionesSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal, $tipo){

	
			if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE sucursal = $sucursal && tipo = $tipo ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' && sucursal = $sucursal && tipo = $tipo ");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' && sucursal = $sucursal && tipo = $tipo ");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' && sucursal = $sucursal && tipo = $tipo ");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	

	}




	
}
