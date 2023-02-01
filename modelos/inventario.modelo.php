<?php

require_once "conexion.php";

class ModeloInventarios{

	/*=============================================
	MOSTRAR INVETARIO
	=============================================*/

	static public function mdlMostrarInvetario($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarInventario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(stock_nuevo, stock_inicial, status, usuario, id_sucursal) VALUES (:stock_nuevo, :stock_inicial, :status, :usuario, :id_sucursal)");

		$stmt->bindParam(":stock_nuevo", $datos["stock_nuevo"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_inicial", $datos["stock_inicial"], PDO::PARAM_STR);
		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR INVENTARIO EN PROCESO  
	=============================================*/

	static public function mdlInventarioEnProceso($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock_nuevo = :stock_nuevo, status = :status WHERE id = :id");

		$stmt->bindParam(":stock_nuevo", $datos["stock_nuevo"], PDO::PARAM_STR);
		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_STR);
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
	ACTUALIZAR STATUS INVENTARIO 
	=============================================*/

	static public function mdlActualizarStatusInventario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET status = :status WHERE id = :id");

		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}




}