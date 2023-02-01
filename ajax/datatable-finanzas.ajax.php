<?php

require_once "../controladores/finanzas.controlador.php";
require_once "../modelos/finanzas.modelo.php";



class TablaFinanzas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE Reparaciones
  	=============================================*/ 

	public function mostrarTablaFinanzas(){

		//$item = null;
    	//$valor = null;

    	   if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

  		$finanzas = ControladorFinanzas::ctrMostrarFinanzas($fechaInicial, $fechaFinal);
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($finanzas); $i++){

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
			$botones =  "<div class='btn-group'><button class='btn btn-danger btnEliminarActividad' idFinanza='".$finanzas[$i]["id"]."'><i class='fa fa-trash'></button></i></div>"; 	
					


		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$finanzas[$i]["usuario"].'",
			      "'.$finanzas[$i]["concepto"].'",
			"<b style=color:Green>'.$finanzas[$i]["ingreso"].'</b>",
			"<b style=color:Red>'.$finanzas[$i]["gasto"].'</b>",
			      "'.$finanzas[$i]["fecha"].'",
			       "'.$botones.'"

			     
			      
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';

		
		echo $datosJson;



	}



}



/*=============================================
ACTIVAR TABLA DE Reparaciones
=============================================*/ 
$activarFinanzas = new TablaFinanzas();
$activarFinanzas -> mostrarTablaFinanzas();



