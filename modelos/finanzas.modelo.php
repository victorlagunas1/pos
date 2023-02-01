<?php

require_once "conexion.php";

class ModeloFinanzas{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarFinanzas($tabla, $item, $valor){

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
	MOSTRAR GASTOS FIRLTRADOS POR MES MAYOR QUE 0
	=============================================*/


		static public function mdlMostrarFinanzasGasto($tabla, $item, $valor, $meses){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE pagos_restantes > 0 && gasto != '' ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}


		/*=============================================
	MOSTRAR INGRESO FIRLTRADOS POR MES MAYOR QUE 0
	=============================================*/


		static public function mdlMostrarFinanzasIngreso($tabla, $item, $valor, $meses){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE pagos_restantes > 0 && ingreso != '' ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	REGISTRO DE INGRESOS
	=============================================*/
	static public function mdlIngresarIngreso($tabla, $datos){

			$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(usuario, concepto, ingreso, id_sucursal, fecha) VALUES (:usuario, :concepto, :ingreso, :id_sucursal, :fecha)");

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
		$stmt->bindParam(":ingreso", $datos["ingreso"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_STR);
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
	REGISTRO DE GASTO
	=============================================*/
	static public function mdlIngresarGasto($tabla, $datos){

			$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(usuario, concepto, gasto, id_sucursal, fecha) VALUES (:usuario, :concepto, :gasto, :id_sucursal, :fecha)");

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
		$stmt->bindParam(":gasto", $datos["gasto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_STR);
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
	REGISTRO DE INGRESOS
	=============================================*/
	static public function mdlIngresarFinanza($tabla, $datos){

			$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(usuario, concepto, ingreso, pagos_restantes, recurrencia, gasto_restante, dia_pago, pagos_totales, id_sucursal, fecha) VALUES (:usuario, :concepto, :ingreso, :pagos_restantes, :recurrencia, :gasto_restante, :dia_pago, :pagos_totales, :id_sucursal, :fecha)");

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_STR);
		$stmt->bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
		$stmt->bindParam(":ingreso", $datos["ingreso"], PDO::PARAM_STR);
		$stmt->bindParam(":pagos_restantes", $datos["pagos_restantes"], PDO::PARAM_STR);
		$stmt->bindParam(":dia_pago", $datos["dia_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":pagos_totales", $datos["pagos_totales"], PDO::PARAM_STR);
		$stmt->bindParam(":gasto_restante", $datos["gasto_restante"], PDO::PARAM_STR);
		$stmt->bindParam(":recurrencia", $datos["recurrencia"], PDO::PARAM_STR);
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
	REGISTRO DE GASTOS
	=============================================*/
	static public function mdlIngresarFinanzaGasto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(usuario, concepto, gasto, forma_pago, pagos_restantes, recurrencia, gasto_restante, dia_pago, pagos_totales,  id_sucursal, fecha) VALUES (:usuario, :concepto, :gasto, :forma_pago, :pagos_restantes, :recurrencia, :gasto_restante, :dia_pago, :pagos_totales, :id_sucursal, :fecha)");

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_STR);
		$stmt->bindParam(":gasto", $datos["gasto"], PDO::PARAM_STR);
		$stmt->bindParam(":dia_pago", $datos["dia_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":pagos_restantes", $datos["pagos_restantes"], PDO::PARAM_STR);
		$stmt->bindParam(":pagos_totales", $datos["pagos_totales"], PDO::PARAM_STR);
		$stmt->bindParam(":gasto_restante", $datos["gasto_restante"], PDO::PARAM_STR);
		$stmt->bindParam(":forma_pago", $datos["forma_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":recurrencia", $datos["recurrencia"], PDO::PARAM_STR);
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
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlAgregarPago($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pagos_restantes = :pagos_restantes, gasto_restante = :gasto_restante WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":gasto_restante", $datos["gasto_restante"], PDO::PARAM_INT);
		$stmt->bindParam(":pagos_restantes", $datos["pagos_restantes"], PDO::PARAM_INT);


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

	static public function mdlEliminarFinanza($tabla, $datos){

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
	SUMAR EL TOTAL INGRESOS
	=============================================*/

	static public function mdlSumaTotalIngresos($tabla, $fechaInicial, $fechaFinal){	


		$stmt = Conexion::conectar()->prepare("SELECT SUM(ingreso) as ingreso FROM $tabla WHERE fecha like '%$fechaFinal%'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

		/*=============================================
	SUMAR VENTAS DEL DIA INGRESOS
	=============================================*/

	static public function mdlSumaTotalIngresosDia($tabla, $fechaInicial, $fechaFinal){	

		//$fechaInicial = date("Y-m-d");
        $fechaFinal = date("Y-m-d");
	
	$stmt = Conexion::conectar()->prepare("SELECT SUM(ingreso) as ingreso FROM $tabla WHERE fecha like '%$fechaFinal%'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

			/*=============================================
	SUMAR EL TOTAL GASTOS
	=============================================*/

	static public function mdlSumaTotalGastos($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	SUMAR EL TOTAL GASTOS CON PAGOS PARCIALES
	=============================================*/

	static public function mdlSumaTotalGastosParciales($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla WHERE pagos_restantes > 0 && gasto > 0 ");


		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}



		/*=============================================
	SUMAR VENTAS DEL DIA INGRESOS
	=============================================*/

	static public function mdlSumaTotalGastosDia($tabla, $fechaInicial, $fechaFinal){	

		//$fechaInicial = date("Y-m-d");
        $fechaFinal = date("Y-m-d");
	
	$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla WHERE fecha like '%$fechaFinal%'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

		/*=============================================
	MUESTRA GASTOS TOTALES
	=============================================*/

		static public function mdlRangoFechasFinanzas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

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
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasFinanzasGastos($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE pagos_restantes > 0 && gasto_restante > 0 ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE pagos_restantes > 0 && gasto_restante > 0 && fecha like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE pagos_restantes > 0 && gasto_restante > 0 && fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE pagos_restantes > 0 && gasto_restante > 0 &&  fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGOS DE FECHAS PARA CAJAS INGRESOS
	=============================================*/

		static public function mdlRangoFechasFinanzasIngreso($tabla, $fechaInicial, $fechaFinal){



		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT SUM(ingreso) as ingreso FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){
			
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM(ingreso) as ingreso FROM $tabla WHERE fecha like '%$fechaFinal%'");



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

				$stmt = Conexion::conectar()->prepare("SELECT SUM(ingreso) as ingreso FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");


			}else{


				$stmt = Conexion::conectar()->prepare("SELECT SUM(ingreso) as ingreso FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGOS DE FECHAS PARA CAJAS GASTOS
	=============================================*/

		static public function mdlRangoFechasFinanzasGastosCaja($tabla, $fechaInicial, $fechaFinal){



		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){
			
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla WHERE fecha like '%$fechaFinal%'");



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

				$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");


			}else{


				$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGOS DE FECHAS PARA CAJAS GASTOS
	=============================================*/

		static public function mdlRangoFechasFinanzasGastosCajaSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal){



		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla WHERE sucursal like $sucursal ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){
			
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla WHERE fecha like '%$fechaFinal%' && id_sucursal like $sucursal ");



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

				$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' && id_sucursal like $sucursal");


			}else{


				$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto) as gasto FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' && id_sucursal like $sucursal");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}


	/*=============================================
	RANGOS DE FECHAS PARA CAJAS GASTOS PARCIALES PARA SUMA
	=============================================*/

		static public function mdlRangoFechasFinanzasGastosParciales($tabla, $fechaInicial, $fechaFinal){


		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto_restante) as gasto FROM $tabla WHERE pagos_restantes > 0 && gasto_restante > 0 ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){
			
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto_restante) as gasto FROM $tabla WHERE pagos_restantes > 0 && gasto_restante > 0 && fecha like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto_restante) as gasto FROM $tabla WHERE pagos_restantes > 0 && gasto_restante > 0 && fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");


			}else{


				$stmt = Conexion::conectar()->prepare("SELECT SUM(gasto_restante) as gasto FROM $tabla WHERE pagos_restantes > 0 && gasto_restante > 0 && fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}


	/*=============================================
	REGISTRO DE INGRESOS
	=============================================*/
	static public function mdlIngresarFinanzaGastoParcial($tabla, $datos){

			$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(usuario, concepto, ingreso) VALUES (:usuario, :concepto, :ingreso)");

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
		$stmt->bindParam(":ingreso", $datos["ingreso"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	RANGOS DE FECHAS PARA ESTADISTICOS RENDIMIENTO POR SUCURSAL 
	=============================================*/

		static public function mdlRangoFechasFinanzasRendimientoSucursal($tabla, $fechaInicial, $fechaFinal, $sucursal, $valorSumar, $concepto){


		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT SUM($valorSumar) as total FROM $tabla WHERE id_sucursal like $sucursal && concepto like '%$concepto%'");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){
			
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($valorSumar) as total FROM $tabla WHERE fecha like '%$fechaFinal%' && id_sucursal like $sucursal  && concepto like '%$concepto%'");



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

				$stmt = Conexion::conectar()->prepare("SELECT SUM($valorSumar) as total FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' && id_sucursal like $sucursal && concepto like '%$concepto%'");


			}else{


				$stmt = Conexion::conectar()->prepare("SELECT SUM($valorSumar) as total FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' && id_sucursal like $sucursal && concepto like '%$concepto%'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	COMISIONES FINANZAS GRAFICOS DE COMISIONES
	=============================================*/	

	static public function mdlRangoFechasComisionesGrafico($tabla, $fechaInicial, $fechaFinal, $concepto){

		

			if($fechaInicial == null){

			//$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE concepto like %$concepto% ORDER BY id DESC");

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE concepto like '%$concepto%' ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' && concepto like '%$concepto%'");

			//$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' && concepto like '%$concepto%'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' && concepto like '%$concepto%'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	

	}





}

