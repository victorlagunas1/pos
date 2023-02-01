<?php

require_once "conexion.php";

class ModeloCategorias{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(categoria) VALUES (:categoria)");

		$stmt->bindParam(":categoria", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

 	}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarCategorias($tabla, $item, $valor){

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
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria, dias_garantia = :dias_garantia WHERE id = :id");

		$stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":dias_garantia", $datos["dias_garantia"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarCategoria($tabla, $datos){

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
	MOSTRAR MARCAS
	=============================================*/

	static public function mdlMostrarMarcas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor ORDER BY marca ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY marca ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}





		/*=============================================
	CREAR MARCA
	=============================================*/

	static public function mdlIngresarMarca($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(marca) VALUES (:marca)");

		$stmt->bindParam(":marca", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	EDITAR MARCA
	=============================================*/

	static public function mdlEditarMarca($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET marca = :marca WHERE id = :id");

		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR MARCA
	=============================================*/

	static public function mdlBorrarMarca($tabla, $datos){

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
	MOSTRAR MODELOS
	=============================================*/

	static public function mdlMostrarModelos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor ORDER BY codigo DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY modelo ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();

		$stmt = null;

	}

		/*=============================================
	MOSTRAR MODELOS
	=============================================*/

	static public function mdlMostrarModelosEnMarcas($tabla, $item, $valor){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor ORDER BY codigo DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		


		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarModelosEspecifico($tabla, $item, $valor){

		if($valor != null){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_marca like $valor ORDER BY modelo ASC ");

			$stmt -> execute();

			return $stmt -> fetchAll();

			}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY modelo ASC ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}



		/*=============================================
	REGISTRO DE MODELOS
	=============================================*/
	static public function mdlIngresarModelos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(id_marca, codigo, modelo, imagen) VALUES (:id_marca, :codigo, :modelo, :imagen)");

		$stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
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
	EDITAR MODELOS
	=============================================*/

	static public function mdlEditarModelos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_marca = :id_marca, modelo = :modelo, codigo = :codigo, imagen = :imagen WHERE id = :id");

		$stmt -> bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);



		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


		/*=============================================
	BORRAR MODELO
	=============================================*/

	static public function mdlBorrarModelo($tabla, $datos){

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
	MOSTRAR DISEÑOS
	=============================================*/

	static public function mdlMostrarDiseño($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY diseño DESC" );

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY diseño ASC ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR CATEGORIAS REFACCIONES
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
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarCategoriaRefacciones($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria, seccion = :seccion WHERE id = :id");

		$stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarCategoriaRefacciones($tabla, $datos){

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


	// /*=============================================
	// MOSTRAR SECCION REFACCIONES
	// =============================================*/

	// static public function mdlMostrarSeccionRefacciones($tabla, $item, $valor){

	// 	if($item != null){

	// 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY seccion ASC" );

	// 		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	// 		$stmt -> execute();

	// 		return $stmt -> fetch();

	// 	}else{

	// 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY seccion ASC ");

	// 		$stmt -> execute();

	// 		return $stmt -> fetchAll();

	// 	}

	// 	$stmt -> close();

	// 	$stmt = null;

	// }

	// 	/*=============================================
	// CREAR SECCION
	// =============================================*/

	// static public function mdlIngresarSeccion($tabla, $datos){

	// 	$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(seccion, id_categoria) VALUES (:seccion, :id_categoria)");

	// 	$stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);
	// 	$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
		

	// 	if($stmt->execute()){

	// 		return "ok";

 // 	}else{

	// 		return "error";
		
	// 	}

	// 	$stmt->close();
	// 	$stmt = null;

	// }

	// 	/*=============================================
	// EDITAR SECCION
	// =============================================*/

	// static public function mdlEditarSeccionRefacciones($tabla, $datos){

	// 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET seccion = :seccion, id_categoria = :id_categoria WHERE id = :id");

	// 	$stmt -> bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);
	// 	$stmt -> bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
	// 	$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

	// 	if($stmt->execute()){

	// 		return "ok";

	// 	}else{

	// 		return "error";
		
	// 	}

	// 	$stmt->close();
	// 	$stmt = null;

	// }

	// /*=============================================
	// BORRAR SECCION
	// =============================================*/

	// static public function mdlBorrarSeccionRefacciones($tabla, $datos){

	// 	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

	// 	$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

	// 	if($stmt -> execute()){

	// 		return "ok";
		
	// 	}else{

	// 		return "error";	

	// 	}

	// 	$stmt -> close();

	// 	$stmt = null;

	// }

			/*=============================================
	ACTUALIZAR SECCION REFACCION
	=============================================*/
	// static public function mdlActualizarSeccionRefaccion($tabla, $datos){

	// 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_seccion = :id_seccion WHERE id = :id");

	// 	$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
	// 	$stmt->bindParam(":id_seccion", $datos["id_seccion"], PDO::PARAM_STR);
		


	// 	if($stmt->execute()){

	// 		return "ok";

	// 	}else{

	// 		return "error";
		
	// 	}

	// 	$stmt->close();
	// 	$stmt = null;

	// }



	/*=============================================
	REGISTRO DE REFACCION
	=============================================*/
	static public function mdlIngresarColor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(diseño) VALUES (:color)");


		$stmt->bindParam(":color", $datos, PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	EDITAR DISEÑO
	=============================================*/

	static public function mdlEditarColor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET diseño = :color WHERE id = :id");

		$stmt -> bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR DISEÑO
	=============================================*/

	static public function mdlBorrarColor($tabla, $datos){

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




}