<div class="content-wrapper">

  <section class="content-header">
    
   <button class="btn btn-primary pull-right " style="margin-left: 10px" onclick="location.href='crear-venta'">
          
          Venta desde tabla
        </button>

        <button class="btn btn-warning pull-right " onclick="location.href='facturacion'">
          
          Facturación
        </button>
    
    <h1>
      
     <?php 

            $item = "id";
            $valor = $_SESSION["sucursal"];

            $sucursal = ControladorUsuarios::ctrMostrarSucursal($item, $valor);
            ?>
      
      <b> Crear venta </b><?php echo $sucursal['nombre']; ?>
    
    </h1>

  

  </section>

  <section class="content">

    <div class="row">

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

                   <input type="text" class="form-control input-lg" id="nuevoCodigoVenta" name="nuevoCodigoVenta" value="" autocomplete="off">

                    
                  </div>
                
                </div>

                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                        Promocionales
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                    <div class="box-body">
                      <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
             
                <div class="carousel-inner">
                 <?php 

            $item = null;
            $valor = null;

            $promocion = ControladorVentas::ctrMostrarPromocionales($item, $valor);
            
                $contar = 0;

                foreach ($promocion as $key => $value) {
                 
                  if ($value["status"] == 1 ){
                  if ($contar == 0){

                  echo ' 
                  <div class="item active">
                    <img src="'.$value['banner'].'"> 
                    
                </div>';

                    $contar = 1;

                  } else {

                     echo ' 
                  <div class="item">
                    <img src="'.$value['banner'].'"> 
                  
                </div>';


                  }
                }

}
           

            ?>

              


               

                
</div>
                   
                  
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
                    </div>
                  </div>
                </div>




               <!--=====================================
                ENTRADA PARA VISTA ULTIMA VENTA SUCURSAL
                ======================================--> 

                <?php 

            $tabla = "ventas";

           
            $sucursal = $_SESSION["sucursal"];

            $ultimaVenta = ModeloVentas::mdlMostrarUltimaVentaSucursal($tabla, $sucursal);

            $hoy = date("Y-m-d");
            //$fechaUltimaVenta = $ultimaVenta["fecha"];

            //$hoy = ("2021-10-11");

           // if ($hoy = $ultimaVenta["fecha"]){
           echo '<div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ultima venta ID: <b>'.$ultimaVenta["codigo"].'</b></span>
              <span class="info-box-number">'.$ultimaVenta["metodo_pago"].' $ '.number_format($ultimaVenta["total"],2).' Cambio: $ '.number_format($ultimaVenta["cambio"],2).'</span>


              
                  <span class="progress-description">
                   FECHA: '.$ultimaVenta["fecha"].'
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>';

       // } 



       ?>



    
       


      
              </div>

          </div>
  
        </form>

        </div>
       
      </div>



<!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-7 col-xs-12">
        
        <div class="box box-info">
          
          <div class="box-header with-border"></div>

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
                    

                    <?php

                    $item = null;
                    $valor = null;

                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                    if(!$ventas){

                      echo '<input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                  

                    }else{

                      foreach ($ventas as $key => $value) {
                        
                        
                      
                      }

                      $codigo = $value["codigo"] + 1;



                      echo '<input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                  

                    }

                    ?>
                    
                    
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 
                <input type="hidden" class="form-control" id="seleccionarCliente" name="seleccionarCliente" value="1" readonly>


                <div class="form-group row nuevoProducto">

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

               <!-- <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button> -->

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-md-8 col-xs-12 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0">

                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>                  
                      </select> 


                    

                    </div>



                  </div>

                  

                  <div class="cajasMetodoPago"></div>

           

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                   <input type="hidden" id="diferenciaCambio" name="diferenciaCambio">


                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

          </div>

        </form>

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
          
        ?>

        </div>
            
      </div>



    </div>
   
  </section>

</div>



