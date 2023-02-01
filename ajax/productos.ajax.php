<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class AjaxProductos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idCategoria;

  public function ajaxCrearCodigoProducto(){

    $item = "id_categoria";
    $valor = $this->idCategoria;
    $orden = "id";


$respuesta = ControladorProductos::ctrMostrarProductosEscaner($item, $valor, $orden);

    echo json_encode($respuesta);

  }



public $idSucursal;

    public function ajaxCapturarIdSucursal(){    
    
    $item = null;
    $valor = $this->idSucursal;
    $orden = "id";

$productos = ControladorProductos::ctrMostrarProductosSucursal($item, $valor, $orden);


    echo json_encode($respuesta);

  }



  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;




  public function ajaxEditarProducto(){

    if($this->traerProductos == "ok"){

      $item = null;
      $valor = null;

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

      echo json_encode($respuesta);


    }else if($this->nombreProducto != ""){

      $item = "descripcion";
      $valor = $this->nombreProducto;

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idProducto;

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

      echo json_encode($respuesta);

    }

  }


public $codigoInventario;

    public function ajaxInvetarioProducto(){
    

      $item = "codigo";
      $valor = $this->codigoInventario;

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

      echo json_encode($respuesta);
 
      }



public $codigoProductoSucursal;
public $idSucursalStock;

    public function ajaxStockSucursal(){
    
      $codigo = $this->codigoProductoSucursal;
      $sucursal = $this->idSucursalStock;
     // $sucursal = "1";


      $respuesta = ControladorProductos::ctrMostrarStockProductosSucursalVentas2($codigo, $sucursal);


      echo json_encode($respuesta);
 
      }


      public function ajaxStockTotalSucursal(){
    
      $codigo = $this->codigoProductoSucursal;
      $sucursal = $this->idSucursalStock;
     // $sucursal = "1";


      $respuesta = ControladorProductos::ctrMostrarStockProductosSucursalVentas2($codigo, $sucursal);


      echo json_encode($respuesta);
 
      }

}

  





/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/ 

if(isset($_POST["idCategoria"])){

  $codigoProducto = new AjaxProductos();
  $codigoProducto -> idCategoria = $_POST["idCategoria"];
  $codigoProducto -> ajaxCrearCodigoProducto();

}
/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProducto"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST["idProducto"];
  $editarProducto -> ajaxEditarProducto();

}


/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreProducto"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> nombreProducto = $_POST["nombreProducto"];
  $traerProductos -> ajaxEditarProducto();

}


/*=============================================
ID SUCURSAL PARA MOSTRAR PRODUCTO
=============================================*/ 

if(isset($_POST["idSucursal"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idSucursal = $_POST["idSucursal"];
  $editarProducto -> ajaxCapturarIdSucursal();

}



/*=============================================
TRAER STOCK DE STOCK_SUCURSAL DE PRODUCTO PARA VENTA
=============================================*/ 

if(isset($_POST["codigoProductoSucursal"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> codigoProductoSucursal = $_POST["codigoProductoSucursal"];
   $editarProducto -> idSucursalStock = $_POST["idSucursalStock"];
  $editarProducto -> ajaxStockSucursal();

}

/*=============================================
TRAER STOCK DE STOCK_SUCURSAL DE PRODUCTO PARA VENTA
=============================================*/ 

if(isset($_POST["codigoProductoInventario"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> codigoProductoInventario = $_POST["codigoProductoInventario"];
   $editarProducto -> idSucursalStock = $_POST["idSucursalStock"];
  $editarProducto -> ajaxStockSucursal();

}



/*=============================================
INVENTARIO PRODUCTO
=============================================*/ 

if(isset($_POST["codigoInventario"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> codigoInventario = $_POST["codigoInventario"];
  $editarProducto -> ajaxInvetarioProducto();

}











