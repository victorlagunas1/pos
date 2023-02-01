<?php

require_once "conexion.php";

class ModeloCotizaciones{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarCotizaciones($tabla, $item, $valor){

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
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarCotizacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(marca, modelo, reparacion, costo, comentario) VALUES (:marca, :modelo, :reparacion, :costo, :comentario)");

		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":reparacion", $datos["reparacion"], PDO::PARAM_STR);
		$stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);

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
	static public function mdlEditarCotizacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET marca = :marca, modelo = :modelo, reparacion = :reparacion, costo = :costo, comentario = :comentario, id_modelo = :id_modelo WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":reparacion", $datos["reparacion"], PDO::PARAM_STR);
		$stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
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
	EDITAR ID_MODELO
	=============================================*/
	static public function mdlEditarCotizaciondIdModelo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET costo = :costo, comentario = :comentario, id_modelo = :id_modelo WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
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
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarCotizacion($tabla, $datos){

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
	ACEPTAR COTIZACION 
	=============================================*/
	static public function mdlAceptarCotizacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha = :fecha WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
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
	MOSTRAR COTIZACIONES CLIENTE
	=============================================*/

	static public function mdlMostrarCotizacionCliente($tabla, $item, $valor){

	if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

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
	REGISTRO DE COTIZACION CLIENTE
	=============================================*/

	static public function mdlIngresarCotizacionCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(codigo, modelo, cliente, precio, cotizacion, contacto, dias_vigencia, id_vendedor) VALUES (:codigo, :modelo, :cliente, :precio, :cotizacion, :contacto, :dias_vigencia, :id_vendedor)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":cotizacion", $datos["cotizacion"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":dias_vigencia", $datos["dias_vigencia"], PDO::PARAM_STR);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	MOSTRAR COTIZACIONES POR MODELO
	=============================================*/
		
		static public function mdlMostrarCotizacionesReparacionesModelo($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR COTIZACIONES POR MODELO
	=============================================*/
		
		static public function mdlMostrarFetch($tabla, $item, $valor){

		
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;



}


	/*=============================================
	MOSTRAR COTIZACIONES POR MODELO
	=============================================*/
		
		static public function mdlMostrarFetchDoble($tabla, $item1, $valor1, $item2, $valor2){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2 ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;



}

	/*=============================================
	MOSTRAR COTIZACIONES POR MODELO
	=============================================*/
		
		static public function mdlMostrarFetchAll($tabla, $item, $valor, $orden){

			
			if ($item !== null ){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
			
			} else if ($orden !== null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();
			
			} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();


			}
		

		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	MOSTRAR FETCH ALL DOBLE 
	=============================================*/
		
		static public function mdlMostrarFetchAllDoble($tabla, $item1, $valor1, $item2, $valor2){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2 ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;



}



	/*=============================================
	BORRAR COTIZACION VISTA-MODELO
	=============================================*/

	static public function mdlEliminarGeneral($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = $valor");


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		} 

		$stmt -> close();

		$stmt = null;

	}


		/*=============================================
	REGISTRO COTIZACION DE VISTA MODELO
	=============================================*/
	static public function mdlIngresarCotizacionVistaModelo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(id_modelo, id_reparacion, precio, comentario, estado, riesgos, id_dispo, tiempo, id_garantia) VALUES (:id_modelo, :id_reparacion, :precio, :comentario, :estado, :riesgos, :id_dispo, :tiempo, :id_garantia)");

		$stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_reparacion", $datos["id_reparacion"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":riesgos", $datos["riesgos"], PDO::PARAM_STR);
		$stmt->bindParam(":id_dispo", $datos["id_dispo"], PDO::PARAM_STR);
		$stmt->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_garantia", $datos["id_garantia"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR REPARACION VISTA MODELO
	=============================================*/
	static public function mdlEditarReparacionVistaModelo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio = :precio, comentario = :comentario, estado = :estado, riesgos = :riesgos, id_dispo = :id_dispo, tiempo = :tiempo, id_garantia = :id_garantia WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":riesgos", $datos["riesgos"], PDO::PARAM_STR);
		$stmt->bindParam(":id_dispo", $datos["id_dispo"], PDO::PARAM_STR);
		$stmt->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_garantia", $datos["id_garantia"], PDO::PARAM_STR);
		
		if($stmt->execute()){


			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}





	/*=============================================
	REGISTRO REPARACION CONFIGURACION 
	=============================================*/
	static public function mdlIngresarContizacionReparacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(reparacion, descripcion) VALUES (:reparacion, :descripcion)");

		$stmt->bindParam(":reparacion", $datos["reparacion"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR REPARACION CONFIGURACION
	=============================================*/
	static public function mdlEditarReparacionConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET reparacion = :reparacion, descripcion = :descripcion  WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":reparacion", $datos["reparacion"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){


			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


		/*=============================================
	REGISTRO RIESGO CONFIGURACION 
	=============================================*/
	static public function mdlIngresarRiesgoConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(riesgo, descripcion) VALUES (:riesgo, :descripcion)");

		$stmt->bindParam(":riesgo", $datos["riesgo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	EDITAR RIESGO CONFIGURACION
	=============================================*/
	static public function mdlEditarRiesgoConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET riesgo = :riesgo, descripcion = :descripcion  WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":riesgo", $datos["riesgo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){


			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	REGISTRO RIESGO CONFIGURACION 
	=============================================*/
	static public function mdlIngresarDisponibilidadConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla (disponibilidad, descripcion, anticipo) VALUES (:disponibilidad, :descripcion, :anticipo)");

		$stmt->bindParam(":disponibilidad", $datos["disponibilidad"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	EDITAR RIESGO CONFIGURACION
	=============================================*/
	static public function mdlEditarDisponibilidadConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET disponibilidad = :disponibilidad, descripcion = :descripcion  WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":disponibilidad", $datos["disponibilidad"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){


			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	REGISTRO GARANTIA CONFIGURACION 
	=============================================*/
	static public function mdlIngresarGarantiaConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla (garantia, dias, condiciones) VALUES (:garantia, :dias, :condiciones)");

		$stmt->bindParam(":garantia", $datos["garantia"], PDO::PARAM_STR);
		$stmt->bindParam(":dias", $datos["dias"], PDO::PARAM_STR);
		$stmt->bindParam(":condiciones", $datos["condiciones"], PDO::PARAM_STR);
	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	EDITAR GARANTIA CONFIGURACION
	=============================================*/
	static public function mdlEditarGarantiaConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET garantia = :garantia, dias = :dias, condiciones = :condiciones  WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":garantia", $datos["garantia"], PDO::PARAM_STR);
		$stmt->bindParam(":dias", $datos["dias"], PDO::PARAM_STR);
		$stmt->bindParam(":condiciones", $datos["condiciones"], PDO::PARAM_STR);

		if($stmt->execute()){


			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	REGISTRO TIEMPO CONFIGURACION 
	=============================================*/
	static public function mdlIngresarTiempoConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(tiempo) VALUES (:tiempo)");

		$stmt->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);
		
	
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	EDITAR TIEMPO CONFIGURACION
	=============================================*/
	static public function mdlEditarTiempoConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tiempo = :tiempo  WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);

		if($stmt->execute()){


			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	REGISTRO Estado CONFIGURACION 
	=============================================*/
	static public function mdlIngresarEstadoConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla (estado, descripcion) VALUES (:estado, :descripcion)");

		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		
	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	EDITAR estado CONFIGURACION
	=============================================*/
	static public function mdlEditarEstadoConfiguracion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, descripcion = :descripcion WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		

		if($stmt->execute()){


			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}




}