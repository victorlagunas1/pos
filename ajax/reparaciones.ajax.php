 <?php

require_once "../controladores/reparaciones.controlador.php";
require_once "../modelos/reparaciones.modelo.php";


class AjaxReparaciones{


/*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idReparacion;

  public function ajaxEditarReparacion(){

    $item = "id";
    $valor = $this->idReparacion;


    $respuesta = ControladorReparaciones::ctrMostrarReparaciones($item, $valor);

    echo json_encode($respuesta);

  }

}


  /*=============================================
EDITAR REPARACION
=============================================*/
if(isset($_POST["idReparacion"])){

  $editar = new AjaxReparaciones();
  $editar -> idReparacion = $_POST["idReparacion"];
  $editar -> ajaxEditarReparacion();

}

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/ 












