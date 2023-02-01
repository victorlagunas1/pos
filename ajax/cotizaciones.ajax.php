<?php

require_once "../controladores/cotizaciones.controlador.php";
require_once "../modelos/cotizaciones.modelo.php";


class AjaxCotizaciones{


/*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idCotizacion;

  public function ajaxEditarCotizacion(){

    $item = "id";
    $valor = $this->idCotizacion;


    $respuesta = ControladorCotizaciones::ctrMostrarCotizaciones($item, $valor);

    echo json_encode($respuesta);

  }


    /*=============================================
  ACTIVAR COTIZACION
  =============================================*/ 

  public $idCotizacionAceptar;

  public function ajaxAceptarPrecioCotizacion(){

    $tabla = "cotizacion";

    $valor1 = $this->idCotizacionAceptar;
    $fecha = date("Y-m-d H:i:s");

    $datos = array(
                 "id" => $valor1,
                 "fecha" => $fecha);


    $respuesta = ModeloCotizaciones::mdlAceptarCotizacion($tabla, $datos);

  }



public $idReparacionSelecc;
//public $idModeloReparacion;

    public function ajaxInfoReparacionVistaModelo(){
    
      $tabla = "reparaciones_cotizacion";
      
      $item = "id";
      $valor = $this->idReparacionSelecc;
     
      //$item2 = "id_modelo":
      //$valor2 = $this->idModeloReparacion;
     // $sucursal = "1";

      $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);


      echo json_encode($respuesta);
 
      }


    public $idReparacion;
//public $idModeloReparacion;

    public function ajaxInfoReparacion(){
    
      $tabla = "reparaciones_id";
      
      $item = "id";
      $valor = $this->idReparacion;

      $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);


      echo json_encode($respuesta);
 
      }

    


    public $idGarantia;

    public function ajaxInfoReparacionGarantia(){
    
      $tabla = "reparaciones_garantia";
      
      $item = "id";
      $valor = $this->idGarantia;

      $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

      echo json_encode($respuesta);
 
      }



    public $idDispo;

    public function ajaxInfoReparacionDisponibilidad(){
    
      $tabla = "reparaciones_disponibilidad";
      
      $item = "id";
      $valor = $this->idDispo;

      $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

      echo json_encode($respuesta);
 
      }


    public $idRiesgo;

    public function ajaxInfoReparacionRiesgos(){
    
      $tabla = "reparaciones_riesgo";
      
      $item = "id";
      $valor = $this->idRiesgo;

      $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

      echo json_encode($respuesta);
 
      }

    public $idTiempo;

    public function ajaxInfoReparacionTiempo(){
    
      $tabla = "reparaciones_tiempo";
      
      $item = "id";
      $valor = $this->idTiempo;

      $respuesta = ModeloCotizaciones::mdlMostrarFetch($tabla, $item, $valor);

      echo json_encode($respuesta);
 
      }


  /*=============================================
  VALIDAR NO REPETIR REPARACION VISTA MODELO
  =============================================*/ 

  public $validarReparacion;
  public $id_modelo;

  public function ajaxValidarReparacion(){

    $tabla = "reparaciones_cotizacion";
    
    $item1 = "id_modelo";
    $valor1 = $this->id_modelo;
    $item2 = "id_reparacion";
    $valor2 = $this->validarReparacion;

    $respuesta = ModeloCotizaciones::mdlMostrarFetchDoble($tabla, $item1, $valor1, $valor2, $item2);

    echo json_encode($respuesta);

  }

      
      




}







  /*=============================================
EDITAR REPARACION
=============================================*/
if(isset($_POST["idCotizacion"])){

  $editar = new AjaxCotizaciones();
  $editar -> idCotizacion = $_POST["idCotizacion"];
  $editar -> ajaxEditarCotizacion();

}




//   /*=============================================
// ACEPTAR PRECIO
// =============================================*/
// if(isset($_POST["idCotizacionAceptar"])){

//   $editar = new AjaxCotizaciones();
//   $editar -> idCotizacionAceptar = $_POST["idCotizacionAceptar"];
//   $editar -> ctrAceptarCotizacion();
  

// }




/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerCotizacion"])){

  $traerProductos = new AjaxCotizaciones();
  $traerProductos -> traerCotizacion = $_POST["traerCotizacion"];
  $traerProductos -> ajaxEditarCotizacion();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreCotizacion"])){

  $traerProductos = new AjaxCotizaciones();
  $traerProductos -> nombreCotizacion = $_POST["nombreCotizacion"];
  $traerProductos -> ajaxEditarCotizacion();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/ 

if(isset($_POST["idCotizacionAceptar"])){

  $activarPrecio = new AjaxCotizaciones();
  $activarPrecio -> idCotizacionAceptar = $_POST["idCotizacionAceptar"];
  $activarPrecio -> ajaxAceptarPrecioCotizacion();

}


/*=============================================
REPARACION Y MODELO VISTA-MODELO
=============================================*/ 

if(isset($_POST["idReparacionSelecc"])){

  $reparacionSelecc = new AjaxCotizaciones();
  $reparacionSelecc -> idReparacionSelecc = $_POST["idReparacionSelecc"];
  //$reparacionSelecc -> idModeloReparacion = $_POST["idModeloReparacion"];
  $reparacionSelecc -> ajaxInfoReparacionVistaModelo();

}



/*=============================================
ID REPARACION
=============================================*/ 

if(isset($_POST["idReparacion"])){

  $reparacionSelecc = new AjaxCotizaciones();
  $reparacionSelecc -> idReparacion = $_POST["idReparacion"];
  //$reparacionSelecc -> idModeloReparacion = $_POST["idModeloReparacion"];
  $reparacionSelecc -> ajaxInfoReparacion();

}

/*=============================================
ID REPARACION
=============================================*/ 

if(isset($_POST["idGarantia"])){

  $reparacionSeleccGarantia = new AjaxCotizaciones();
  $reparacionSeleccGarantia -> idGarantia = $_POST["idGarantia"];
  $reparacionSeleccGarantia -> ajaxInfoReparacionGarantia();

}

/*=============================================
ID DISPONIBILIDAD
=============================================*/ 

if(isset($_POST["idDispo"])){

  $reparacionSeleccDispo = new AjaxCotizaciones();
  $reparacionSeleccDispo -> idDispo = $_POST["idDispo"];
  $reparacionSeleccDispo -> ajaxInfoReparacionDisponibilidad();

}



/*=============================================
ID RIESGOS
=============================================*/ 

if(isset($_POST["idRiesgo"])){

  $reparacionRiesgos = new AjaxCotizaciones();
  $reparacionRiesgos -> idRiesgo = $_POST["idRiesgo"];
  $reparacionRiesgos -> ajaxInfoReparacionRiesgos();

}


/*=============================================
ID TIEMPO
=============================================*/ 

if(isset($_POST["idTiempo"])){

  $reparacionRiesgos = new AjaxCotizaciones();
  $reparacionRiesgos -> idTiempo = $_POST["idTiempo"];
  $reparacionRiesgos -> ajaxInfoReparacionTiempo();

}



 /*=============================================
VALIDAR SI EXISTE REPARACION
=============================================*/
if(isset($_POST["validarReparacion"])){

  $validarReparacion = new AjaxCotizaciones();
  $validarReparacion -> validarReparacion = $_POST["validarReparacion"];
  $validarReparacion -> id_modelo = $_POST["id_modelo"];
  $validarReparacion -> ajaxValidarReparacion();

}











