<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}



	/*=============================================
	ACTIVAR PROMOCIONAL
	=============================================*/	

	public $estadoPromocional;
	public $idPromocion;


	public function ajaxActivarPromocional(){

		$tabla = "ventas_promocionales";

		$item1 = "status";
		$valor1 = $this->estadoPromocional;

		$item2 = "idPromocion";
		$valor2 = $this->idPromocion;


		$respuesta = ModeloVentas::mdlActualizarPromocional($tabla, $item1, $valor1, $item2, $valor2);

	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}


/*=============================================
EDITAR PROMOCIONAL
=============================================*/	

if(isset($_POST["idPromocion"])){

	$promocional = new AjaxClientes();
	$promocional -> idPromocion = $_POST["idPromocion"];
	$promocional -> ajaxActivarPromocional();

}
