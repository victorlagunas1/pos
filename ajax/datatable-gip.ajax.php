<?php

require_once "../controladores/finanzas.controlador.php";
require_once "../modelos/finanzas.modelo.php";



class TablaFinanzas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE Reparaciones
  	=============================================*/ 

	public function mostrarTablaFinanzas(){

		$item = null;
    	$valor = null;


          $meses = null;

  		$finanzas = ControladorFinanzas::ctrMostrarFinanzasGastos($item, $valor, $meses);
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($finanzas); $i++){

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
			$botones =  "<div class='btn-group'><button class='btn btn-success btnAgregarPago' data-toggle='modal' data-target='#modalAgregarPago' idFinanza='".$finanzas[$i]["id"]."' ><i class='fa fa-money'></button></i><button class='btn btn-primary btnAgregarPago' data-toggle='modal' data-target='#modalAgregarPago' idFinanza='".$finanzas[$i]["id"]."' ><i class='fa fa-info-circle'></button></i><button class='btn btn-danger btnEliminarActividad' idFinanza='".$finanzas[$i]["id"]."'><i class='fa fa-trash'></button></i></div>"; 	
					


		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$finanzas[$i]["usuario"].'",
			      "'.$finanzas[$i]["concepto"].'",
			"<b style=color:Red>'.$finanzas[$i]["gasto"].'</b>",
			"'.$finanzas[$i]["meses"].'",
			"'.$finanzas[$i]["dia_pago"].'",
			"'.$finanzas[$i]["pago_mensual"].'",
			"<b>'.$finanzas[$i]["meses"].'</b>",
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



