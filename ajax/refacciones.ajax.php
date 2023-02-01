<?php

require_once "../controladores/refacciones.controlador.php";
require_once "../modelos/refacciones.modelo.php";



class AjaxRefacciones{


  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idRefaccionEditar;

  public function ajaxEditarRefaccion(){

      
      $item = "id";
      $valor = $this->idRefaccionEditar;
      $sucursal = null;

      $respuesta = ControladorRefacciones::ctrMostrarRefacciones($item, $valor, $sucursal);

      echo json_encode($respuesta);

  }



}

  

/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idRefaccionEditar"])){

  $editarRefaccion = new AjaxRefacciones();
  $editarRefaccion -> idRefaccionEditar = $_POST["idRefaccionEditar"];
  $editarRefaccion -> ajaxEditarRefaccion();

}








