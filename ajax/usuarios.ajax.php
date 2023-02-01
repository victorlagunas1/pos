<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idUsuario;

	public function ajaxEditarUsuario(){

		$item = "id";
		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/	

	public $activarUsuario;
	public $activarId;


	public function ajaxActivarUsuario(){

		$tabla = "usuarios";

		$item1 = "estado";
		$valor1 = $this->activarUsuario;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarUsuario;

	public function ajaxValidarUsuario(){

		$item = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR SUCURSAL
	=============================================*/	

	public $idSucursal;

	public function ajaxEditarSucursal(){

		$item = "id";
		$valor = $this->idSucursal;

		$respuesta = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

		echo json_encode($respuesta);
		

	}

	/*=============================================
	BORRAR NOTIFICACION
	=============================================*/	

	
	public $idNotificacion;


	public function ajaxDesactivarNotificacion(){

		$tabla = "usuarios_notificaciones";

		$item1 = "status";
		$valor1 = 0;

		$item2 = "id";
		$valor2 = $this->idNotificacion;

		$respuesta = ModeloUsuarios::mdlDesactivarNotificacion($tabla, $item1, $valor1, $item2, $valor2);

	}

}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idUsuario"])){

	$editar = new AjaxUsuarios();
	$editar -> idUsuario = $_POST["idUsuario"];
	$editar -> ajaxEditarUsuario();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}

/*=============================================
EDITAR SUCURSAL
=============================================*/
if(isset($_POST["idSucursal"])){

	$editar = new AjaxUsuarios();
	$editar -> idSucursal = $_POST["idSucursal"];
	$editar -> ajaxEditarSucursal();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["idNotificacion"])){

	$desactivarNotificacion = new AjaxUsuarios();
	$desactivarNotificacion -> idNotificacion = $_POST["idNotificacion"];
	$desactivarNotificacion -> ajaxDesactivarNotificacion();

}


