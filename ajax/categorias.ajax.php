<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class AjaxCategorias{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idCategoria;

	public function ajaxEditarCategoria(){

		$item = "id";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}


	public function ajaxEditarMarca(){

		$item = "id";
		$valor = $this->idMarcaEditar;

		$respuesta = ControladorCategorias::ctrMostrarMarcas($item, $valor);

		echo json_encode($respuesta);

	}

		public function ajaxEditarModelo(){

		$item = "id";
		$valor = $this->idModeloEditar;

		$respuesta = ControladorCategorias::ctrMostrarModelos($item, $valor);

		echo json_encode($respuesta);

	}



  public function ajaxCrearCodigoMarca(){

    $item = "id_marca";
    $valor = $this->idMarca;
    $orden = "id";


$respuesta = ControladorCategorias::ctrMostrarModelos($item, $valor, $orden);

    echo json_encode($respuesta);

  }




public function ajaxCrearCodigoProducto(){

    $item = "id_categoria";
    $valor = $this->idCategoria2;
    $orden = "id";


$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

    echo json_encode($respuesta);

  }


  	public function ajaxEditarCategoriaRefacciones(){

		$item = "id";
		$valor = $this->idCategoriaRefacciones;

		$respuesta = ControladorCategorias::ctrMostrarCategoriasRefacciones($item, $valor);

		echo json_encode($respuesta);

	}



	public $idMarcaModelo;
  	public function ajaxMarcaModelo(){

		$item = null;
		$valor = $this->idMarcaModelo;
		//$orden = "id"

		$respuesta = ControladorCategorias::ctrMostrarModelosEspecifico($item, $valor);

		$html = "";
		foreach ($respuesta as $value) 
		
	
		$html.= "<option value='".$value['codigo']."'>".$value['modelo']."</option>";
		echo $html;

	}

	public $idDiseño;
  	public function ajaxEditarColor(){

		$item = "id";
		$valor = $this->idDiseño;

		$respuesta = ControladorCategorias::ctrMostrarDiseño($item, $valor);

		echo json_encode($respuesta);

	}

	public $idModeloVentasJS;
  	public function ajaxModeloVentasJS(){

		$item = "codigo";
		$valor = $this->idModeloVentasJS;

		$respuesta = ControladorCategorias::ctrMostrarModelos($item, $valor);

		echo json_encode($respuesta);

	}



	/*=============================================
	ACTIVAR ETIQUETA
	=============================================*/	

	public $activarEtiqueta;
	public $activarIdSucursal;


	public function ajaxactivarEtiqueta(){

		$tabla = "id_sucursal";

		$item1 = "precio_producto";
		$valor1 = $this->activarEtiqueta;

		$item2 = "id";
		$valor2 = $this->activarIdSucursal;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

	}
	

}




/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idCategoria"])){

	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}

if(isset($_POST["idMarcaEditar"])){

	$categoria = new AjaxCategorias();
	$categoria -> idMarcaEditar = $_POST["idMarcaEditar"];
	$categoria -> ajaxEditarMarca();
}


if(isset($_POST["idMarca"])){

  $codigoProducto = new AjaxCategorias();
  $codigoProducto -> idMarca = $_POST["idMarca"];
  $codigoProducto -> ajaxCrearCodigoMarca();

}

if(isset($_POST["idModeloEditar"])){

	$categoria = new AjaxCategorias();
	$categoria -> idModeloEditar = $_POST["idModeloEditar"];
	$categoria -> ajaxEditarModelo();
}


if(isset($_POST["idMarcaModelo"])){

	$categoria = new AjaxCategorias();
	$categoria -> idMarcaModelo = $_POST["idMarcaModelo"];
	$categoria -> ajaxMarcaModelo();
}


if(isset($_POST["idCategoria2"])){

	$categoria = new AjaxCategorias();
	$categoria -> idCategoria2 = $_POST["idCategoria2"];
	$categoria -> ajaxCrearCodigoProducto();
}

if(isset($_POST["idCategoriaRefacciones"])){

	$categoria = new AjaxCategorias();
	$categoria -> idCategoriaRefacciones = $_POST["idCategoriaRefacciones"];
	$categoria -> ajaxEditarCategoriaRefacciones();
}

if(isset($_POST["idDiseño"])){

	$categoria = new AjaxCategorias();
	$categoria -> idDiseño = $_POST["idDiseño"];
	$categoria -> ajaxEditarColor();
}

if(isset($_POST["idModeloVentasJS"])){

	$categoria = new AjaxCategorias();
	$categoria -> idModeloVentasJS = $_POST["idModeloVentasJS"];
	$categoria -> ajaxModeloVentasJS();
}


if(isset($_POST["activarIdSucursal"])){

	$categoria = new AjaxCategorias();
	$categoria -> activarIdSucursal = $_POST["activarIdSucursal"];
	$categoria -> activarEtiqueta = $_POST["activarEtiqueta"];
	$categoria -> ajaxactivarEtiqueta();
}


// if(isset($_POST["traerProductos"])){

//   $traerProductos = new AjaxProductos();
//   $traerProductos -> traerProductos = $_POST["traerProductos"];
//   $traerProductos -> ajaxEditarProducto();

// }





