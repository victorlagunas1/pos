<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxPromocionales{


	/*=============================================
	ACTIVAR PROMOCIONAL
	=============================================*/	

	public $idPromocion;
	public $estadoPromocional;
	
	public function ajaxActivarPromocional(){

		$tabla = "ventas_promocionales";

		 $datos = array(
                 "id" => $this->idPromocion,
                 "status" => $this->estadoPromocional);

		$respuesta = ModeloVentas::mdlActualizarPromocional($tabla, $datos);

	}

}




/*=============================================
EDITAR PROMOCIONAL
=============================================*/	

if(isset($_POST["idPromocion"])){

	$promocional = new AjaxPromocionales();
	$promocional -> idPromocion = $_POST["idPromocion"];
	$promocional -> estadoPromocional = $_POST["estadoPromocional"];
	$promocional -> ajaxActivarPromocional();

}
