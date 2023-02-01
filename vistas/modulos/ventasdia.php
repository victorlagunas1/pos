<?php

if($_SESSION["perfil"] != "Administrador" && $_SESSION["perfil"] != "Administrador de Sucursal"){

  echo '<script>

    window.location = "crear-venta2";

  </script>';

  return;

}

?>


<div class="content-wrapper"> 


  <section class="content-header">


<?php 
date_default_timezone_set('America/Mexico_City');
$fecha = date("d-m-Y");




                   if(isset($_GET["sucursal"])){

                  $item = "id";
                  $valor = $_GET['sucursal'];

                 $sucursal2 = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

                 echo '<h1><b>Ventas del día '.$sucursal2["nombre"].'</b></h1>'.$fecha;
                 //echo  '<option value="1">'.$sucursal2["nombre"].'</option>';

                      }else {

                  //echo  '<option value="">Todas las sucursales</option>';
                  echo '<h1><b>Ventas del día General</b></h1>'.$fecha;
                  }




?>


    <ol class="breadcrumb">

      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Ventas General</li>
    
    </ol>



  

  </section>



  <section class="content">



    <div class="box ">
      <div class="box-header with-border ">

    

      <div class="box-header with-border">
         <?php include "inicio/cajas-cortedia.php"; ?>

    
<button class="btn btn-primary pull-right" style="margin-left: 10px" onclick="window.open('extensiones/tcpdf/pdf/reportesucursal.php');" >

    Generar Reporte </button>

           
             

            <div class="col-xs-12 col-md-2 pull-right">
              <select class="form-control input" name="sucursalSeleccionada" id="sucursalSeleccionada" required="">
                
                
                <?php 
               
                    

                  
                  $item = null;
                  $valor = null;

                 $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

                   if(isset($_GET["sucursal"])){

                  $item = "id";
                  $valor = $_GET['sucursal'];

                 $sucursal2 = ControladorUsuarios::ctrMostrarSucursal($item, $valor);

                 echo  '<option value="1">'.$sucursal2["nombre"].'</option>';

                      }else {

                  echo  '<option value="">Todas las sucursales</option>';
                  }

                  foreach ($sucursal as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>



                


              </select>

            </div>
              

           

      


         


           <button type="button" class="btn btn-default pull-right" id="daterangeVentasDia-btn" style="margin-left: 10px">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>



      
  
       

     

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Sucursal</th>
           <th>Código</th>
      
           <th>Categoría</th>
           <th>Modelo</th>
           <th>Descripción</th>
           <th>Cantidad</th>
           <th>Total</th>
           <th>Fecha</th>



         </tr> 

        </thead>

        <tbody>

        <?php

        
      //  $fechaInicial = date("Y-m-d");
        //$fechaFinal = date("Y-m-d");
        //$sucursal = null; 


       
        if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];
            //$sucursal = null; 

             if(isset($_GET["sucursal"])){
              $sucursal = $_GET["sucursal"];
             }else{
                 $sucursal = null; 
             }


          }else{

            $fechaInicial = date("Y-m-d");
            $fechaFinal = date("Y-m-d");
            //$sucursal = null; 

             if(isset($_GET["sucursal"])){
              $sucursal = $_GET["sucursal"];
             }else{
                 $sucursal = null; 
             }

          }



       
          $respuesta = ControladorVentas::ctrRangoFechasVentasStock($fechaInicial, $fechaFinal, $sucursal);

          

                 foreach ($respuesta as $key => $value) {

          $item = "id";
          $valor = $value["sucursal"];

          $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
           
           echo '<tr>

                  <td>'.($key+1).'</td>

                   <td>'.$sucursal["nombre"].'</td>

                  <td>'.$value["codigo"].'</td>';
          
        if ($value["tipo"] == 0){


          $item = "codigo";
          $valor = $value["codigo"];

        $infoproducto = ControladorProductos::ctrMostrarProductos($item, $valor);

/*=============================================
      TRAEMOS LA CATEGORÍA
        =============================================*/ 

        $item = "id";
        $valor = $infoproducto["id_categoria"];

        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);


      /*=============================================
      TRAEMOS EL MODELO
        =============================================*/ 
        if ($infoproducto["id_modelo"] != "0") {
        $item = "codigo";
        $valor = $infoproducto["id_modelo"];

        $modelo = ControladorCategorias::ctrMostrarModelos($item, $valor);

        $modelo1 = $modelo["modelo"];
      } else {
        $modelo1 = " ";
      }


        $numero = random_int(0, 9);
        $calculo = $value["total"] - $infoproducto["precio_compra"];

        //$imagen1 = $imagen = "<img src='".$infoproducto["imagen"]."' width='60px'>";
        $categoria1 = $categorias["categoria"];
       

        
        $descripcion1 = $infoproducto["descripcion"];
        $cantidad1 = $value["cantidad"];
        $total1 = "<b style=color:Green>"."$ ".number_format($value["total"]*$value["cantidad"],2)."</b>";
       // $referencia1 = $infoproducto["id_modelo"]." ".$numero.$calculo." ".$infoproducto["ventas"];
        $fecha1 = $value["fecha"];




    } else if ($value["tipo"] == 1) {

      $numero = random_int(0, 9);
      $numero1 = random_int(0, 9);
     $calculo = $value["total"];

      //$imagen1 = "<img src='vistas/img/productos/default/anonymous.png' width='60px'>";
      $categoria1 = " ";
        $modelo1 = " ";
        $descripcion1 = " ";
        $cantidad1 = $value["cantidad"];
        //$total1 = $value["total"];
        $total1 = "<b style=color:Green>"."$ ".number_format($value["total"],2)."</b>";
        //$referencia1 = $numero.$numero1." ".$numero.$calculo;
       
        $fecha1 = $value["fecha"];



    } else {

      $numero = random_int(0, 9);
      $numero1 = random_int(0, 9);
     $calculo = $value["total"];

     // $imagen1 = "<img src='vistas/img/productos/default/anonymous.png' width='60px'>";
      $categoria1 = " ";
        $modelo1 = " ";
        $descripcion1 = " ";
        $cantidad1 = " ";
        //$total1 = "<b>".$value["total"]."</b>";
        $total1 = "<b style=color:Red>"."$ ".number_format($value["total"],2)."</b>";
        //$referencia1 = $numero.$numero1." ".$numero.$calculo;
       
        $fecha1 = $value["fecha"];



    }

                
                  echo '

                  <td>'.$categoria1.'</td>

                  <td>'.$modelo1.'</td>

                  <td>'.$descripcion1.'</td>

                  <td>'.$cantidad1.'</td>

                  <td>'.$total1.'</td>

                 


                  <td>'.$fecha1.'</td>

    

                </tr>';
            }

        ?>
               
        </tbody>

       </table>

       <?php

      $eliminarVenta = new ControladorVentas();
      $eliminarVenta -> ctrEliminarVenta();

      ?>
       

      </div>

    </div>

  </section>

</div>




