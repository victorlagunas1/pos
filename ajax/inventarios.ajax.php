<?php

require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";


class AjaxInventarios{ 

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idInventario;
   public $idInventarioRechazar;
  public $sucursal;

  public function ajaxAceptarInventario(){


            $item = "id";
            $valor = $this->idInventario;

            $respuesta = ControladorInventarios::ctrMostrarInvetario($item, $valor);

             

             $listaProductos = json_decode($respuesta["stock_nuevo"], true);
             $sucursal = $respuesta["id_sucursal"];


        foreach ($listaProductos as $key => $value) {




        $tabla = "stock_sucursal";
        //NO OBTIENE EL VALOR DE SUCURSAL POR LO CUAL NO GUARDA
        $datos = array("id_sucursal" => $sucursal,
                 "producto" => $value["codigo"],
                 "stock" => $value["stock"]);

        $respuesta = ModeloProductos::mdlActualizarProductoStockInventarios($tabla, $datos);
             
         }

         $tabla = "inventario";

        $datos = array("id" => $_POST["idInventario"],
                 "status" => "1");

        $status = ModeloInventarios::mdlActualizarStatusInventario($tabla, $datos);

         // if($respuestaBuscar["producto"] != $value["codigo"]){
         //   $tabla = "stock_sucursal";
         // $datos = array("id_sucursal" => $sucursal,
         //          "producto" => $value["codigo"],
         //          "stock" => $value["stock"]);

         // $respuesta2 = ModeloProductos::mdlIngresarProductoSucursal($tabla, $datos);

         //   }
         


      echo json_encode($respuesta);



  }



  public function ajaxRechazarInventario(){


        $tabla = "inventario";

        $datos = array("id" => $_POST["idInventarioRechazar"],
                 "status" => "2");

        $respuesta = ModeloInventarios::mdlActualizarStatusInventario($tabla, $datos);

  

      echo json_encode($respuesta);



  }



public $idSucursalInventario;

    public function ajaxCapturarIdSucursal(){    
    
    $item = null;
    $valor = $this->idSucursalInventario;
    $orden = "id";

$respuesta = ControladorProductos::ctrMostrarStockProductosSucursal($item, $valor, $orden);


    echo json_encode($respuesta);

  }

//public $idInventarioGuardado;

//     public function ajaxEditarInvetario(){    
    
//     $item = "id";
//     $valor = $this->idInventarioGuardado;
   
// $respuesta = ControladorInventarios::ctrMostrarInvetario($item, $valor);


//     echo json_encode($respuesta);

//   }

 


 // public $idSucursalInventario;

//     public function ajaxGuardarInventarioEnProceso(){    
    
//     $item = null;
//     $valor = $this->idSucursalInventario;
//     $orden = "id";

// $respuesta = ControladorProductos::ctrMostrarStockProductosSucursal($item, $valor, $orden);


//     echo json_encode($respuesta);

//   }




  public $stockNuevoProceso;

  public function ajaxEnProceso(){

        $tabla = "inventario";

        $datos = array("id" => $_POST["idInventario"],
                 "status" => "2",
                 "stock_nuevo" => $_POST["stockNuevoProceso"]);

        $status = ModeloInventarios::mdlInventarioEnProceso($tabla, $datos);



      echo json_encode($respuesta);



  }



}

  





/*=============================================
ACEPTAR INVENTARIO
=============================================*/ 

if(isset($_POST["idInventario"])){

  $codigoProducto = new AjaxInventarios();
  $codigoProducto -> idInventario = $_POST["idInventario"];
  $codigoProducto -> ajaxAceptarInventario();

}

/*=============================================
RECHAZAR INVENTARIO 
=============================================*/ 

if(isset($_POST["idInventarioRechazar"])){

  $codigoProducto = new AjaxInventarios();
  $codigoProducto -> idInventarioRechazar = $_POST["idInventarioRechazar"];
  $codigoProducto -> ajaxRechazarInventario();

}





/*=============================================
TRAER PRODUCTO
=============================================*/ 

// if(isset($_POST["traerProductos"])){

//   $traerProductos = new AjaxProductos();
//   $traerProductos -> traerProductos = $_POST["traerProductos"];
//   $traerProductos -> ajaxEditarProducto();

// }


/*=============================================
TRAER TODOS LOS PRODUCTOS EN INVETARIO ACTUAL
=============================================*/ 

if(isset($_POST["idSucursalInventario"])){

  $codigoProducto = new AjaxInventarios();
  $codigoProducto -> idSucursalInventario = $_POST["idSucursalInventario"];
  $codigoProducto -> ajaxCapturarIdSucursal();

}

// if(isset($_POST["idInventarioGuardado"])){

//   $codigoProducto = new AjaxInventarios();
//   $codigoProducto -> idInventarioGuardado = $_POST["idInventarioGuardado"];
//   $codigoProducto -> ajaxEditarInvetario();

// }




if(isset($_POST["stockNuevoProceso"])){

  $codigoProducto = new AjaxInventarios();
  $codigoProducto -> stockNuevoProceso = $_POST["stockNuevoProceso"];
  $codigoProducto -> ajaxEnProceso();

}















