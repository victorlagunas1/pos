<?php

require_once "../controladores/finanzas.controlador.php";
require_once "../modelos/finanzas.modelo.php";


class AjaxFinanzas{


/*=============================================
  INFORMACIÓN DE FINANZAS
  =============================================*/ 

  public $idFinanza;

  public function ajaxEditarFinanza(){

    $item = "id";
    $valor = $this->idFinanza;


    $respuesta = ControladorFinanzas::ctrMostrarFinanzas($item, $valor);

    echo json_encode($respuesta);

  }


}


  /*=============================================
EDITAR REPARACION
=============================================*/
if(isset($_POST["idFinanza"])){

  $editar = new AjaxFinanzas();
  $editar -> idFinanza = $_POST["idFinanza"];
  $editar -> ajaxEditarFinanza();

}









