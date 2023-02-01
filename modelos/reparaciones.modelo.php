<?php

require_once "conexion.php";

class ModeloReparaciones{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarReparaciones($tabla, $item, $valor){

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
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarReparacionesSucursal($tabla, $item, $valor, $sucursal){

	
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_sucursal like $sucursal ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarReparacion($tabla, $datos){ 

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(nombre, telefono, modelo, servicio, color, serie_imei, pass, precio, comentarios, marca, historial, id_sucursal, fecha, id_reparacion, id_modelo, riesgos) VALUES (:nombre, :telefono, :modelo, :servicio, :color, :serie_imei, :pass, :precio, :comentarios, :marca, :historial, :id_sucursal, :fecha, :id_reparacion, :id_modelo, :riesgos)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":historial", $datos["historial"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":serie_imei", $datos["serie_imei"], PDO::PARAM_STR);
		$stmt->bindParam(":pass", $datos["pass"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		$stmt->bindParam(":riesgos", $datos["riesgos"], PDO::PARAM_STR);
		$stmt->bindParam(":id_reparacion", $datos["id_reparacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);

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
	static public function mdlEditarReparacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, telefono = :telefono, modelo = :modelo, servicio = :servicio, color = :color, serie_imei = :serie_imei, pass = :pass, precio = :precio, comentarios = :comentarios, marca = :marca, riesgos = :riesgos WHERE id = :id");

	$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":serie_imei", $datos["serie_imei"], PDO::PARAM_STR);
		$stmt->bindParam(":pass", $datos["pass"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":riesgos", $datos["riesgos"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);


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

	static public function mdlEliminarReparacion($tabla, $datos){

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
	ACTUALIZAR ESTADO
	=============================================*/
	static public function mdlActualizarEstado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET status = :status, historial = :historial WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_STR);
		$stmt->bindParam(":historial", $datos["historial"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

			/*=============================================
	ACTUALIZAR ESTADO ENTREGADO
	=============================================*/
	static public function mdlActualizarEntrega($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET status = :status, historial = :historial, vigencia_garantia = :vigencia_garantia, fecha_entrega = :fecha_entrega WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_STR);
		$stmt->bindParam(":vigencia_garantia", $datos["vigencia_garantia"], PDO::PARAM_STR);
		$stmt->bindParam(":historial", $datos["historial"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_entrega", $datos["fecha_entrega"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


				/*=============================================
	ACTUALIZAR PRECIO
	=============================================*/
	static public function mdlActualizarPrecio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio = :precio, historial = :historial, servicio = :servicio WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
		$stmt->bindParam(":historial", $datos["historial"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

/*=============================================
	MOSTRAR REPARACIONES DEL DIA
	=============================================*/
		static public function mdlMostrarReparacionesDia($tabla, $item, $valor, $fechaInicial, $fechaFinal){

			 $fechaFinal = date("Y-m-d");
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


		}


	/*=============================================
	AGREGAR ANTICIPO 
	=============================================*/
	static public function mdlAgregarAnticipo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET anticipo = :anticipo, historial = :historial WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_INT);
		$stmt->bindParam(":historial", $datos["historial"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

		/*=============================================
	EDITAR COMISION
	=============================================*/
	static public function mdlEditarReparacionComision($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  comision = :comision, costo_pieza = :costo_pieza WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":comision", $datos["comision"], PDO::PARAM_STR);
		$stmt->bindParam(":costo_pieza", $datos["costo_pieza"], PDO::PARAM_STR);
		
		//$stmt->bindParam(":id_usuariocomision", $datos["id_usuariocomision"], PDO::PARAM_STR);
		
		
	


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}







}