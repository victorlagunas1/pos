<?php

require_once "../controladores/cotizaciones.controlador.php";
require_once "../modelos/cotizaciones.modelo.php";



class TablaCotizaciones{

 	/*=============================================
 	 MOSTRAR LA TABLA DE Reparaciones
  	=============================================*/ 

	public function mostrarTablaCotizaciones(){

		$item = null;
    	$valor = null;

  		$cotizaciones = ControladorCotizaciones::ctrMostrarCotizaciones($item, $valor);	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($cotizaciones); $i++){

	/*=============================================
 	 	FECHA
  	=============================================*/ 

  		 
  			$hoy = strtotime(date("d-m-Y"));
  			$hoy2 = date("d-m-Y");
  			
  			$fechaExistente = strtotime($cotizaciones[$i]["fecha"]."+ 0 months");

			//$hoy = strtotime($date."+ 1 months");
			
			$mes = strtotime(date("d-m-Y", strtotime($cotizaciones[$i]["fecha"]."+ 1 months")));
			
			//$tresmeses = strtotime(date("d-m-Y", strtotime($cotizaciones[$i]["fecha"]."- 3 months")));
			
			$tresmesesHoy = strtotime(date("d-m-Y", strtotime($hoy2."- 3 months")));

				//PARECE QUE SOLAMENTE LEE PRIMER DIGITO PARA CONIDICIONAL FALTA REVISAR

  		


  			if($mes > $hoy){
  					$fecha = "<button data-toggle='modal' data-target='#modalSumarStock' class='btn btn-success btnEditarStock'>"."VIGENTE"."</button>";

  					$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCotizacion action='#'' idCotizacion='".$cotizaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCotizacion'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarCotizacion' idCotizacion='".$cotizaciones[$i]["id"]."'><i class='fa fa-trash'></button></i></div>"; 	
					

  					

  			}else if ($fechaExistente  > $tresmesesHoy ) {

  				
  					$fecha = "<button data-toggle='modal' data-target='#modalSumarStock' class='btn btn-warning btnEditarStock'>"."REVISIÓN"."</button> ";

  					$botones =  "<div class='btn-group'><button class='btn btn-primary btnAceptarCotizacion action='#'' idCotizacion='".$cotizaciones[$i]["id"]."'><i class='fa fa-check'></i></button><button class='btn btn-warning btnEditarCotizacion' idCotizacion='".$cotizaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCotizacion'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarCotizacion' idCotizacion='".$cotizaciones[$i]["id"]."'><i class='fa fa-trash'></button></i></div>"; 	
					




  			}else{

  				$fecha = "<button data-toggle='modal' data-target='#modalSumarStock' class='btn btn-danger btnEditarStock'>"."EXPIRADO"."</button>";

  			

  				$botones =  "<div class='btn-group'><button class='btn btn-primary btnAceptarCotizacion' idCotizacion='".$cotizaciones[$i]["id"]."'><i class='fa fa-check'></i></button><button class='btn btn-warning btnEditarCotizacion' idCotizacion='".$cotizaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCotizacion'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarCotizacion' idCotizacion='".$cotizaciones[$i]["id"]."'><i class='fa fa-trash'></button></i></div>"; 	
					

  				
  				
  			}

  				
  				if($cotizaciones[$i]["id_modelo"] == 0){
  				
  				$nuevaVista =  "<div class='btn-group'><button class='btn btn-warning btnExportarVistaModelo' idCotizacion='".$cotizaciones[$i]["id"]."' data-toggle='modal' data-target='#modalAgregarCotizacionModelo'><i class='fa  fa-arrow-circle-right'></i></button></i></div>";



  			}else{
  				$nuevaVista = "";


  			}




		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
			


		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$cotizaciones[$i]["marca"].'",
			      "'.$cotizaciones[$i]["modelo"].'",
			      "'.$cotizaciones[$i]["reparacion"].'",
			      "'.$cotizaciones[$i]["comentario"].'",
			      "<b>$ '.$cotizaciones[$i]["costo"].'</b>",
			      "'.$fecha.'",
			       "'.$nuevaVista.$botones.'"

			     
			      
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
$activarCotizaciones = new TablaCotizaciones();
$activarCotizaciones -> mostrarTablaCotizaciones();



