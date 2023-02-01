<?php

if($_SESSION["perfil"] != "Administrador" && $_SESSION["perfil"] != "Administrador de Sucursal"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Editar Invetario
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear invetario</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="callout callout-warning">
        

        <p><b>¡Advertencia! </b>La creación de un nuevo inventario eliminara todo el stock existente, y lo sustituira por el nuevo inventario. Asegurate de completar el inventario correctamente.</p>
      </div>


    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border">ESCANEAR PRODUCTO</div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group hidden">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>



                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                     <input type="hidden" value="<?php echo $_SESSION['sucursal']; ?>" id="idSucursal" name="idSucursal">



                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>

                   <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" value="" autocomplete="off">
                    
                    
                  </div>
                
                </div>



                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

         

               

      
              </div>

          </div>
  
        </form>

        </div>
       
      </div>


      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 col-xs-12">
        
        <div class="box box-primary">

          
           <div class="box-header with-border">LISTADO DE PRODUCTOS

   
       
        </button>

      </div>





            <form role="form" method="post" class="formularioInvetario">

              <div class="box-body">


            <table class="table table-bordered table-striped dt-responsive" >


            <div class="box">

                <?php

                    $item = "id";
                    $valor = $_GET["idInventario"];

                    $inventario = ControladorInventarios::ctrMostrarInvetario($item, $valor);

                     

                  
                ?>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                <?php

               

//  ESCONDIDO PARA PROBAR
               $stockEnProceso = json_decode($inventario["stock_nuevo"], true);
                //var_dump($stockEnProceso);
               // $stockEnProceso2 = json_encode($inventario["stock_nuevo"], true);


              
                

               // $combinacion = array($inicial=>$stockInicial, $nuevo =>$stockNuevo)

               // $totalProductos = array();

                echo '<ul>';
                foreach ($stockEnProceso as $key => $value) {

                 // array_push($totalProductos, array("codigo" => $value["codigo"], "stock" => $value["stock"]));

                  $item = "codigo";
                  $valor = $value["codigo"];
                  $orden = "id";

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $stockAntiguo = $respuesta["stock"];

                  echo '<button type="button" class="btn btn-primary" style="margin:5px 5px 5px 5px"> <i class="fa fa-barcode "></i> <h3>'.$value["codigo"]." x ".$value["stock"].'</h3> </button>';
                  
                }

                echo '</u>';

               



                ?>

                </div>


      
              </div>



               


      

            </table>


          </div>


           <input type="hidden" id="listaProductosInventarioEditar" name="listaProductosInventarioEditar" value='<?php echo $inventario["stock_nuevo"]; ?>'>

           
           <input type="hidden" id="idInventarioEditar" name="idInventarioEditar" value="<?php echo $_GET["idInventario"]; ?>">
           
           

           <input type="hidden" id="listaProductosInventario" name="listaProductosInventario">
           <input type="hidden" id="listaProductosInventarioActual" name="listaProductosInventarioActual">
           <input type="hidden" id="sucursal" name="sucursal" value="<?php echo $_SESSION['sucursal']; ?>" >

          <div class="box-footer">

            
            
            <button type="submit" class="btn btn-success pull-right">Guardar inventario</button>

  

          </div>

        </form>




        <?php

        $guardarInventario = new ControladorInventarios();
        $guardarInventario -> ctrActualizarInventario();
          
        ?>

              

        </div>

      </div>

    </div>
   
  </section>

</div>


<!--=====================================
MODAL AGREGAR REPARACION
======================================-->

<div id="modalCrearInventario" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Crear nuevo inventario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

<div class="callout callout-warning">
        

        <p><b>¡Advertencia! </b>La creación de un nuevo inventario eliminara todo el stock existente, y lo sustituira por el nuevo inventario. Asegurate de completar el inventario correctamente.</p>
      </div>

      <input type="hidden" class="form-control input-lg" id="crearInventario" name="crearInventario" >
               
               
            


             </div>


                      
        </div>





                  

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-danger"> Crear inventario</button>

        </div>

      </form>

        <?php

          $ctrCrearReparacion = new ControladorInventarios();
          $ctrCrearReparacion -> ctrCrearNuevoInvetario();

        ?>  

    </div>

  </div>

</div>

