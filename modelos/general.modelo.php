<?php

require_once "conexion.php";

class ModeloGeneral{

		/*=============================================
	GENERAL ITEM POR FECHA
	=============================================*/

	static public function mdlGeneralItemFecha($tabla, $fechaInicial, $fechaFinal, $item, $valor){	

		
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor");

			

		}else if($fechaInicial == $fechaFinal){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor && fecha like '%$fechaFinal%'");


		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor && fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor && fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}


	}

	$stmt -> execute();

return $stmt -> fetchAll();
	

	
}


		/*=============================================
	 GENERAL DOBLE ITEM POR FECHA
	=============================================*/

	static public function mdlGeneralDobleItemFecha($tabla, $fechaInicial, $fechaFinal, $item1, $valor1, $item2, $valor2){	

		
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2");

			



		}else if($fechaInicial == $fechaFinal){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2 && fecha like '%$fechaFinal%'");


		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2  && fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2  && fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}


	}

	$stmt -> execute();

return $stmt -> fetchAll();
	

	
}


	/*=============================================
	SUMAR FECH POR FECHA 
	=============================================*/

	static public function mdlSumaPorFecha($tabla, $fechaInicial, $fechaFinal, $item1, $valor1, $item2, $valor2){	

		//$fechaInicial = date("Y-m-d");
       // $fechaFinal = date("Y-m-d");

		if ($valor2 !== null){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT SUM(total * cantidad) as total FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2");

			
		}else if($fechaInicial == $fechaFinal){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total * cantidad) as total FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2 && fecha like '%$fechaFinal%'");


		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT SUM(total * cantidad) as total FROM $tabla WHERE $item1 = $valor1 && $item2 == $valor2  && fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT SUM(total * cantidad) as total FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2  && fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}


	}

} else {

	if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT SUM(total * cantidad) as total FROM $tabla WHERE $item1 = $valor1");

			
		}else if($fechaInicial == $fechaFinal){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total * cantidad) as total FROM $tabla WHERE $item1 = $valor1 && fecha like '%$fechaFinal%'");


		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT SUM(total * cantidad) as total FROM $tabla WHERE $item1 = $valor1 && fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT SUM(total * cantidad) as total FROM $tabla WHERE $item1 = $valor1 && fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}


	}



}

	$stmt -> execute();

return $stmt -> fetch();





	}




	/*=============================================
	SUMAR FECH POR FECHA 
	=============================================*/

	static public function mdlFecthDosValores($tabla, $fechaInicial, $fechaFinal, $item1, $valor1, $item2, $valor2){	

		if ($valor2 == null){ 
	if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1");

			
		}else if($fechaInicial == $fechaFinal){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla WHERE $item1 = $valor1 && fecha like '%$fechaFinal%'");


		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}


	}
}else {
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2");

			
		}else if($fechaInicial == $fechaFinal){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla WHERE $item1 = $valor1 && $item2 = $valor2 && fecha like '%$fechaFinal%'");


		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2 && fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = $valor1 && $item2 = $valor2 && fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}


	}

}





	$stmt -> execute();

return $stmt -> fetchAll();





	}


			/*=============================================
	GENERAL ITEM POR FECHA
	=============================================*/

	static public function mdlGeneralItemFechaEntrega($tabla, $fechaInicial, $fechaFinal, $item, $valor){	

		
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor");

			

		}else if($fechaInicial == $fechaFinal){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor && fecha_entrega like '%$fechaFinal%'");


		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor && fecha_entrega BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor && fecha_entrega BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}


	}

	$stmt -> execute();

return $stmt -> fetchAll();
	

	
}




}
