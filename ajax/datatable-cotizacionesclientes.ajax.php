<?php

require_once "../controladores/cotizaciones.controlador.php";
require_once "../modelos/cotizaciones.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaCotizacionesVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE cotizaciones
  	=============================================*/ 

	public function mostrarTablaCotizacionesVentas(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		
  		$cotizaciones = ControladorCotizaciones::ctrMostrarCotizaciones($item, $valor, $orden);

  		if(count($cotizaciones) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		

  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($cotizaciones); $i++){

 
		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarCotizacion recuperarBoton' idCotizacion='".$cotizaciones[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			      "'.$cotizaciones[$i]["id"].'",
			        "'.$cotizaciones[$i]["modelo"].'",
			          "'.$cotizaciones[$i]["reparacion"].'",
			            "'.$cotizaciones[$i]["comentario"].'",
			              "'.$cotizaciones[$i]["costo"].'",
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
ACTIVAR TABLA DE cotizaciones
=============================================*/ 
$activarCotizacionesVentas = new TablaCotizacionesVentas();
$activarCotizacionesVentas -> mostrarTablaCotizacionesVentas();

