 <?php

require_once "../controladores/cotizaciones.controlador.php";
require_once "../modelos/cotizaciones.modelo.php";


class AjaxReparacionesConfiguracion{


/*=============================================
  EDITAR REPARACION
  =============================================*/ 

  public $idReparacion;

  public function ajaxEditarReparacion(){

    
    $tabla = "reparaciones_id";

    $item = "id";
    $valor = $this->idReparacion;


    $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

    echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR RIESGO
  =============================================*/ 

  public $idRiesgo;

  public function ajaxEditarRiesgo(){

    
    $tabla = "reparaciones_riesgo";

    $item = "id";
    $valor = $this->idRiesgo;


    $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

    echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR DISPONIBILIDAD
  =============================================*/ 

  public $idDisponibilidad;

  public function ajaxEditarDisponibilidad(){

    
    $tabla = "reparaciones_disponibilidad";

    $item = "id";
    $valor = $this->idDisponibilidad;


    $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

    echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR GARANTIA
  =============================================*/ 

  public $idGarantia;

  public function ajaxEditarGarantia(){

    
    $tabla = "reparaciones_garantia";

    $item = "id";
    $valor = $this->idGarantia;


    $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

    echo json_encode($respuesta);

  }

    /*=============================================
  EDITAR TIEMPO
  =============================================*/ 

  public $idTiempo;

  public function ajaxEditarTiempo(){

    
    $tabla = "reparaciones_tiempo";

    $item = "id";
    $valor = $this->idTiempo;


    $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

    echo json_encode($respuesta);

  }


    /*=============================================
  EDITAR ESTADO
  =============================================*/ 

  public $idEstado;

  public function ajaxEditarEstado(){

    
    $tabla = "reparaciones_estado";

    $item = "id";
    $valor = $this->idEstado;


    $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

    echo json_encode($respuesta);

  }

}


/*=============================================
EDITAR REPARACION
=============================================*/
if(isset($_POST["idReparacion"])){

  $editar = new AjaxReparacionesConfiguracion();
  $editar -> idReparacion = $_POST["idReparacion"];
  $editar -> ajaxEditarReparacion();

}


/*=============================================
EDITAR RIESGO
=============================================*/
if(isset($_POST["idRiesgo"])){

  $editar = new AjaxReparacionesConfiguracion();
  $editar -> idRiesgo = $_POST["idRiesgo"];
  $editar -> ajaxEditarRiesgo();

}


/*=============================================
EDITAR DISPONIBILIDAD
=============================================*/
if(isset($_POST["idDisponibilidad"])){

  $editar = new AjaxReparacionesConfiguracion();
  $editar -> idDisponibilidad = $_POST["idDisponibilidad"];
  $editar -> ajaxEditarDisponibilidad();

}


/*=============================================
EDITAR GARANTIA
=============================================*/
if(isset($_POST["idGarantia"])){

  $editar = new AjaxReparacionesConfiguracion();
  $editar -> idGarantia = $_POST["idGarantia"];
  $editar -> ajaxEditarGarantia();

}

/*=============================================
EDITAR TIEMPO
=============================================*/
if(isset($_POST["idTiempo"])){

  $editar = new AjaxReparacionesConfiguracion();
  $editar -> idTiempo = $_POST["idTiempo"];
  $editar -> ajaxEditarTiempo();

}


/*=============================================
EDITAR ESTADO
=============================================*/
if(isset($_POST["idEstado"])){

  $editar = new AjaxReparacionesConfiguracion();
  $editar -> idEstado = $_POST["idEstado"];
  $editar -> ajaxEditarEstado();

}








