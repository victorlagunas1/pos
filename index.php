<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/reparaciones.controlador.php";
require_once "controladores/cotizaciones.controlador.php";
require_once "controladores/finanzas.controlador.php";
require_once "controladores/forma_pago.controlador.php";
require_once "controladores/inventario.controlador.php";
require_once "controladores/refacciones.controlador.php";
require_once "controladores/facturacion.controlador.php";


require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/reparaciones.modelo.php";
require_once "modelos/cotizaciones.modelo.php";
require_once "modelos/finanzas.modelo.php";
require_once "modelos/forma_pago.modelo.php";
require_once "modelos/inventario.modelo.php";
require_once "modelos/refacciones.modelo.php";
require_once "modelos/facturacion.modelo.php";
require_once "modelos/general.modelo.php";
require_once "extensiones/vendor/autoload.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();