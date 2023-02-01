<?php

require_once "conexion.php";

class ModeloRefacciones{

	/*=============================================
	MOSTRAR REFACCIONES TOTAL
	=============================================*/

	static public function mdlMostrarRefacciones($tabla, $item, $valor, $sucursal){

		if ($sucursal != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_sucursal like $sucursal ORDER BY codigo DESC");

			//$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			//return $stmt -> fetch();
			return $stmt -> fetchAll();


		} else if($item != null){

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
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarCategoriasRefacciones($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY categoria ASC" );

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY categoria ASC ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	REGISTRO DE REFACCION
	=============================================*/
	static public function mdlIngresarRefaccion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(id_categoria, codigo, descripcion, id_modelo, id_sucursal, estado, stock, id_variante) VALUES (:id_categoria, :codigo, :descripcion, :id_modelo, :id_sucursal, :estado, :stock, :id_variante)");


		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_variante", $datos["id_variante"], PDO::PARAM_STR);
		//$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
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
	ACTUALIZAR REFACCION
	=============================================*/
	static public function mdlActualizarRefaccion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, descripcion = :descripcion, stock = :stock WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
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
	ACTUALIZAR REFACCION
	=============================================*/
	static public function mdlActualizarStockRefaccion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
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
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarCategoriaRefaccion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria, seccion) VALUES (:categoria, :seccion)");

		$stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

 	}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	// /*=============================================
	// REGISTRO DE STOCK SUCURSAL
	// =============================================*/
	// static public function mdlIngresarRefaccionSucursal($tabla, $datos){

	// 	$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(id_sucursal, codigo, stock) VALUES (:id_sucursal, :codigo, :stock)");

	// 	$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_STR);
	// 	$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
	// 	$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
	

	// 	if($stmt->execute()){

	// 		return "ok";

	// 	}else{

	// 		return "error";
		
	// 	}

	// 	$stmt->close();
	// 	$stmt = null;

	// }


	// /*=============================================
	// MOSTRAR STOCK REFACCIONES POR SUCURSAL
	// =============================================*/

	// static public function mdlMostrarRefaccionesSucursal($tabla, $item, $valor, $sucursal){

	

	// 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_sucursal like $sucursal");

	// 		$stmt -> execute();

	// 		return $stmt -> fetchAll();

		

	// 	$stmt -> close();

	// 	$stmt = null;

	// }

	// 	/*=============================================
	// MOSTRAR STOCK REFACCIONES POR SUCURSAL
	// =============================================*/

	// static public function mdlMostrarStockRefacciones($tabla, $item, $valor){

	// 	if($item != null){

	// 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY codigo DESC");

	// 		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	// 		$stmt -> execute();

	// 		return $stmt -> fetch();

	// 	}else{

	// 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

	// 		$stmt -> execute();

	// 		return $stmt -> fetchAll();

	// 	}

	// 	$stmt -> close();

	// 	$stmt = null;


	// }


	// /*=============================================
	// REGISTRO DE STOCK SUCURSAL
	// =============================================*/
	// static public function mdlIngresarStockRefaccionSucursal($tabla, $datos){

	// 	$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(id_sucursal, codigo, stock) VALUES (:id_sucursal, :codigo, :stock)");

	// 	$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
	// 	$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
	// 	$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
	

	// 	if($stmt->execute()){

	// 		return "ok";

	// 	}else{

	// 		return "error";
		
	// 	}

	// 	$stmt->close();
	// 	$stmt = null;

	// }


	/*=============================================
	BORRAR REFACCIONES
	=============================================*/

	static public function mdlEliminarRefaccion($tabla, $datos){

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
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarVariantesRefacciones($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY variante ASC" );

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY variante ASC ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	CREAR VARIANTE
	=============================================*/

	static public function mdlIngresarVarianteRefaccion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(variante) VALUES (:variante)");

		$stmt->bindParam(":variante", $datos["variante"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

 	}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}






}