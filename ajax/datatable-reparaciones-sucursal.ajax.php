<?php

require_once "../controladores/reparaciones.controlador.php";
require_once "../modelos/reparaciones.modelo.php";

require_once "../controladores/refacciones.controlador.php";
require_once "../modelos/refacciones.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaReparacionesSucursal{

 	/*=============================================
 	 MOSTRAR LA TABLA DE Reparaciones
  	=============================================*/ 

	public function mostrarTablaReparaciones(){



  		$item = null;
    	$valor = null;
    	$sucursal = $_GET["idSucursal"];


  		$reparaciones = ControladorReparaciones::ctrMostrarReparacionesSucursal($item, $valor, $sucursal);	

		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($reparaciones); $i++){


		  	/*=============================================
 	 		TRAEMOS EL STATUS
  			=============================================*/ 
		  			   switch($reparaciones[$i]["status"]) {
                
                //PRODUCTO AGOTADO
                case 0:

                 $status = "<div class='btn-group '><button class='btn btn-warning btnStadoReparacion' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>Pendiente</button>";

                  break;

                  case 1:

                 $status = "<div class='btn-group'><button class='btn btn-primary btnStadoReparacion' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>En revisión</button>";

                  break;

                   case 2:

                 $status = "<div class='btn-group'><button class='btn btn-success btnStadoReparacion' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>Listo</button>";

                  break;

                   case 3:

                 $status = "<div class='btn-group'><button class='btn btn-success btnStadoReparacion' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>Entregado</button>";

                  break;

                   case 4:

                 $status = "<div class='btn-group'><button class='btn btn-warning btnStadoReparacion' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>Garantía</button>";

                  break;

                   case 5:

                 $status = "<div class='btn-group'><button class='btn btn-danger btnStadoReparacion' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>No reparado</button>";

                  break;

                   case 6:

                 $status = "<div class='btn-group'><button class='btn btn-primary btnStadoReparacion' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>Contactar</button>";

                  break;

                   case 7:

                 $status = "<div class='btn-group'><button class='btn btn-info btnStadoReparacion' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>Autorizado</button>";


                  break;

                   case 8:

                 $status = "<div class='btn-group'><button class='btn btn-danger btnStadoReparacion' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>No autorizado</button>";


                  break;

                   case 9:

                 $status = "<div class='btn-group'><button class='btn btn-warning btnStadoReparacion' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>Refacción</button>";

                  break;

                   case 10:

                 $status = "<div class='btn-group'><button class='btn btnStadoReparacion' style='background-color:#FF8300; color:white' idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>Por Confirmar</button>";

                  break;

                  case 11:

                 $status = "<div class='btn-group'><button class='btn btn-danger btnStadoReparacion'  idStatusReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEstado'>No reparado<br>Entregado</button>";

                  break;

              }

			
			$hoy = date("Y-m-d");


			if($reparaciones[$i]["vigencia_garantia"] >= $hoy){
			$vigencia = "<b>VIGENTE</b>";
				
				}else if ($reparaciones[$i]["vigencia_garantia"] <= null){
					$vigencia = "";
					
				} else {
					$vigencia = "<b>EXPIRADA</b>";
				}
  			  
		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
				 

if ($reparaciones[$i]["status"] == 2) {

		 $botones =  "<div class='btn-group'><button class='btn btn-primary btnInfoReparacion' idReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalInformacionReparacion'><i class='fa fa-address-card'></i></button><button class='btn btn-success btnEntregar' idReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEntregarReparacion'><i class='fa fa fa-send'></i></div>";  


} else if ($reparaciones[$i]["status"] == 3 || $reparaciones[$i]["status"] == 11) {

		 $botones =  "<div class='btn-group'><button class='btn btn-primary btnInfoReparacion' idReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalInformacionReparacion'><i class='fa fa-address-card'></i></button><button class='btn btn-info btnImprimirTicket' idReparacion='".$reparaciones[$i]["id"]."'><i class='fa fa-print'></i></button></div>"; 


} else if ($reparaciones[$i]["status"] == 5) {

		 $botones =  "<div class='btn-group'><button class='btn btn-primary btnInfoReparacion' idReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalInformacionReparacion'><i class='fa fa-address-card'></i></button><button class='btn btn-success btnEntregar' idReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEntregarReparacion'><i class='fa fa fa-send'></i></div>";  

} else if ($reparaciones[$i]["status"] == 8) {

		$botones =  "<div class='btn-group'><button class='btn btn-primary btnInfoReparacion' idReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalInformacionReparacion'><i class='fa fa-address-card'></i></button><button class='btn btn-success btnEntregar' idReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEntregarReparacion'><i class='fa fa fa-send'></i></div>";  


} else {

	$botones =  "<div class='btn-group'><button class='btn btn-primary btnInfoReparacion' idReparacion='".$reparaciones[$i]["id"]."' data-toggle='modal' data-target='#modalInformacionReparacion'><i class='fa fa-address-card'></i></button><button class='btn btn-warning btnImprimirPDF' idReparacion='".$reparaciones[$i]["id"]."'><i class='fa fa-file'></i></button><button class='btn btn-info btnImprimirBarcode' idReparacion='".$reparaciones[$i]["id"]."'><i class='fa fa-qrcode'></i></button></div>"; 




}

$precio = "<div class='btn-group '><button class='btn btnActualizarPrecio' idReparacionPrecio='".$reparaciones[$i]["id"]."' modeloActual='".$reparaciones[$i]["modelo"]."' servicioActual='".$reparaciones[$i]["servicio"]."' marcaActual='".$reparaciones[$i]["marca"]."' precioActual='".number_format($reparaciones[$i]["precio"])."' data-toggle='modal' data-target='#modalActualizarPrecio'><b>$ ".number_format($reparaciones[$i]["precio"])."</b></button>";


		  	$datosJson .='[
			      "'.($i+1).'",
			      "MIX0'.$reparaciones[$i]["id"].'",
			      "'.$status.'",
			      "'.$reparaciones[$i]["nombre"].'",
			      "'.$reparaciones[$i]["marca"].'",
			      "'.$reparaciones[$i]["modelo"].'",
			      "'.$reparaciones[$i]["servicio"].'",
			     "'.$precio.'",
			      "'.$vigencia.'",
			      "'.$reparaciones[$i]["fecha"].'",
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
$activarReparaciones = new TablaReparacionesSucursal();
$activarReparaciones -> mostrarTablaReparaciones();



