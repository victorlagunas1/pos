<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Revisión Inventario
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-6 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <?php

                    $item = "id";
                    $valor = $_GET["idInventario"];

                    $inventario = ControladorInventarios::ctrMostrarInvetario($item, $valor);



                    $itemUsuario = "id";
                    $valorUsuario = $inventario["usuario"];

                    $usuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  


                ?>



                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                <?php

                $stockInicial = json_decode($inventario["stock_inicial"], true);
                

               // $combinacion = array($inicial=>$stockInicial, $nuevo =>$stockNuevo)
                echo '<ul>';
                foreach ($stockInicial as $key => $value) {

                  $item = "codigo";
                  $valor = $value["codigo"];
                  $orden = "id";

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $stockAntiguo = $respuesta["stock"];
                  
                  // echo '<div class="row" style="padding:5px 15px">
            
                  //       <div class="col-xs-4" style="padding-right:0px">
            
                  //         <div class="input-group">
                
                          

                  //           <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["codigo"].'" name="agregarProducto" value="'.$value["codigo"].'" readonly required>

                  //         </div>

                  //       </div>

                  //       <div class="col-xs-2">
              
                  //         <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" value="'.$value["stock"].'" required readonly>

                  //       </div>

                        

                  //     </div>';

                      echo '<button type="button" class="btn btn-primary" style="margin:5px 5px 5px 5px"> <i class="fa fa-barcode "></i> <h3>'.$value["codigo"]." x ".$value["stock"].'</h3> </button>';
                }
                echo '</ul>';


                ?>

                </div>


      
              </div>

          </div>

        

        </form>

        

        </div>
            
      </div>

          <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-6 col-xs-12">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
             <div class="box">
            
                          <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                <?php

                
                $stockNuevo = json_decode($inventario["stock_nuevo"], true);

               // $combinacion = array($inicial=>$stockInicial, $nuevo =>$stockNuevo)
                echo '<ul>';
                foreach ($stockNuevo as $key => $value) {

                  $item = "codigo";
                  $valor = $value["codigo"];
                  $orden = "id";

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $stockAntiguo = $respuesta["stock"];
                  
                  // echo '<div class="row" style="padding:5px 15px">
            
                  //       <div class="col-xs-4" style="padding-right:0px">
            
                  //         <div class="input-group">
                
                            

                  //           <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["codigo"].'" name="agregarProducto" value="'.$value["codigo"].'" readonly required>

                  //         </div>

                  //       </div>

                  //       <div class="col-xs-2">
              
                  //         <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" value="'.$value["stock"].'" required readonly>

                  //       </div>

                        

                  //     </div>';

                  echo '<button type="button" class="btn btn-warning" style="margin:5px 5px 5px 5px"> <i class="fa fa-barcode "></i> <h3>'.$value["codigo"]." x ".$value["stock"].'</h3> </button>';
                }
                echo '</ul>';

                ?>

                </div>
</div>
          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>