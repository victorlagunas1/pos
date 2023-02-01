<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY codigo DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	MOSTRAR PRODUCTOS ESCANNER 
	=============================================*/

	static public function mdlMostrarProductosEscaner($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item && escaner like 0 ORDER BY codigo DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		// }else if($valor != null){

		// 	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codigo = :$valor ORDER BY codigo DESC");

		// 	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		// 	$stmt -> execute();

		// 	return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRODUCTOS SUCURSAL
	=============================================*/

	static public function mdlMostrarProductosSucursal($tabla, $item, $valor){

		if($valor == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item && sucursal like $valor ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE sucursal like $valor ");


			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

		/*=============================================
	MOSTRAR PRODUCTOS SUCURSAL POR CATEGORIA
	=============================================*/

	static public function mdlMostrarProductosSucursalCategoriaSucursal($tabla, $categoria){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_categoria like $categoria ");

			//$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();



		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR PRODUCTOS SUCURSAL POR CATEGORIA
	=============================================*/


	static public function mdlMostrarProductosMasVendidos($tabla, $orden, $fechaInicial, $fechaFinal){


		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' ORDER BY $orden DESC ");

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY $orden DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY $orden DESC ");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	MOSTRAR STOCK_PRODUCTOS SUCURSAL
	=============================================*/

	static public function mdlMostrarStockProductosSucursal($tabla, $item, $valor){


			 if($valor == null){

			 $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ");

			 $stmt -> execute();

			 return $stmt -> fetchAll();

			 }else{


			 $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_sucursal like $valor ");

			 $stmt -> execute();

			 return $stmt -> fetchAll();

			}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR STOCK_PRODUCTOS SUCURSAL
	=============================================*/

	static public function mdlMostrarStockProductosSucursalVentas2($tabla, $codigo, $sucursal){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_sucursal like $sucursal && producto like $codigo");


			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(id_categoria, codigo, descripcion, stock, id_color, precio_venta, precio_plaza, id_modelo, sucursal) VALUES (:id_categoria, :codigo, :descripcion, :stock, :nuevoColor, :precio_venta, :precio_plaza, :id_modelo, :sucursal)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);		
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":nuevoColor", $datos["nuevoColor"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_plaza", $datos["precio_plaza"], PDO::PARAM_STR);
		$stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":sucursal", $datos["sucursal"], PDO::PARAM_STR);
	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	REGISTRO DE STOCK SUCURSAL
	=============================================*/
	static public function mdlIngresarProductoSucursal($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(id_sucursal, producto, stock) VALUES (:id_sucursal, :producto, :stock)");

		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, descripcion = :descripcion, imagen = :imagen, precio_compra = :precio_compra, precio_venta = :precio_venta, precio_plaza = :precio_plaza WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		//$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR); 
		$stmt->bindParam(":precio_plaza", $datos["precio_plaza"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

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
	BORRAR PRODUCTO STOCK SUCURSAL
	=============================================*/

	static public function mdlEliminarProductoSucursal($tabla, $datos){

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
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PRODUCTO STOCK_SUCURSAL
	=============================================*/

	static public function mdlActualizarProductoStock($tabla, $item1, $valor1, $valor, $sucursal){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE producto = :id && id_sucursal = $sucursal ");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PRODUCTO STOCK_SUCURSAL
	=============================================*/

static public function mdlActualizarProductoStock2($tabla, $datos){


$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock WHERE id = :id");

		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}



	/*=============================================
	MOSTRAR STOCK SUCURSAL
	=============================================*/

	static public function mdlMostrarStockSucursal($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR STOCK SUCURSAL
	=============================================*/

	static public function mdlVerficicarStockSucursal($tabla, $codigoVerificar, $sucursal){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE producto = $codigoVerificar && id_sucursal = $sucursal ORDER BY id DESC");

			//$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	REGISTRO DE VENTAS_STOCK
	=============================================*/
	static public function mdlIngresarStockVentas($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla (sucursal, codigo, cantidad, total, tipo, fecha) VALUES (:sucursal, :codigo, :cantidad, :total, :tipo, :fecha)");

		$stmt->bindParam(":sucursal", $datos["sucursal"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
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
	FOTO DE PRODUCTO
	=============================================*/
	static public function mdlFotoProducto($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET imagen = :imagen WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PRODUCTO STOCK_SUCURSAL
	=============================================*/

	static public function mdlActualizarProductoStockInventarios($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock WHERE producto = :producto && id_sucursal = :id_sucursal");

		$stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_STR);

		//$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		//$stmt -> bindParam(":producto", $codigo, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



}