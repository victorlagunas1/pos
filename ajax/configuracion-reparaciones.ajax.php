 <?php

require_once "../controladores/configuracion-reparaciones.controlador.php";
require_once "../modelos/configuracion-reparaciones.modelo.php";


class AjaxConfiguracionReparaciones{


/*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idNota;

  public function ajaxEditarConfiguracionReparacion(){

    $item = "id";
    $valor = $this->idNota;


    $respuesta = ControladorConfiguradorReparaciones::ctrMostrarConfiguracionReparaciones($item, $valor);

    echo json_encode($respuesta);

  }

}


  /*=============================================
EDITAR REPARACION
=============================================*/
if(isset($_POST["idNota"])){

  $editar = new AjaxConfiguracionReparaciones();
  $editar -> idNota = $_POST["idNota"];
  $editar -> ajaxEditarConfiguracionReparacion();

}

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/ 












