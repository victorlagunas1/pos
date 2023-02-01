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



      <div class="col-lg-4 col-md-8 col-xs-12">
                  

       <form role="form" method="post" class="formularioVenta">

  

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group hidden">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>



                    <input type="text" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                     <input type="hidden" value="<?php echo $_SESSION['sucursal']; ?>" id="idSucursal" name="idSucursal">




                  </div>

                </div> 



                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 


                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>

                   <input type="text" class="form-control input-lg" id="nuevoCodigoVenta2" name="nuevoCodigoVenta2" value="" autocomplete="off" placeholder="Ingresar codigo">

                    
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


       
        </form>

 




 <form role="form" method="post" class="formularioVenta2">





                          <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" class="">
                        Opciones
                      </a>
                    </h4>
                  </div>
                  

                  <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="true" style="">
                    <div class="box-body">
                      <div class="box-body">

                        <div class="col-md-12 col-xs-12 pull-right">

                           

              
                           <th><b>Codigo de descuento</b></th>
                              
                            <div class="form-group has-error">
                            <div class="input-group">
                           
                              <input type="text" class="form-control input-lg" id="nuevoCuponDescuento" name="nuevoCuponDescuento" placeholder="Cupón">

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>
                          </div>

                          

      
                   
                          <th><b>Impuestos</b></th>
                          <td style="width: 50%">
                            
                            <div class="input-group">

                      <span class="input-group-addon">
                          <input type="checkbox">
                        </span>
                           
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

                      

                  </div>





             
             
 
                       </div>
                         </div>
                            </div>
                               </div>
        



        

      </div>




      <div class="col-lg-5 col-md-8 col-xs-12">
        

        

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
                 <input type="hidden" class="form-control" id="seleccionarCliente" name="seleccionarCliente" value="1" readonly></input>


                <div class="form-group row nuevoProducto2"></div>

                
                <input type="hidden" id="listaProductos" name="listaProductos"></input>

              </div>


          </div>
      


       
      </div>



    

   
<!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-3 col-md-3 col-xs-12">
     
          
          <div class="box-body">
  
              <div class="box">
        
       
          

            

              <div class="info-box" style="background-color:#119DA4; color:white;">
            <span class="info-box-icon"><i class="fa fa-chevron-down"></i></span>

            <div class="info-box-content">
              <span><b>SUBTOTAL:</b></span>
              <h2 id="nuevoSubtotalVenta" name="nuevoSubtotalVenta" class="pull-right">0.00</h2>
          
            </div>
          </div>





        <div class="info-box" style="background-color:#FFB703; color:white;">
            <span class="info-box-icon"><i class="fa fa-chevron-down"></i></span>

            <div class="info-box-content">
              <span><b>IMPUESTOS:</b></span>
              <h2 id="nuevoImpuestos" name="nuevoImpuestos" class="pull-right">0.00</h2>
          
            </div>
          </div>



          <div class="info-box" style="background-color:#F95738; color:white;">
            <span class="info-box-icon"><i class="fa fa-sort-amount-asc"></i></span>

            <div class="info-box-content">
              <span><b>DESCUENTOS:</b></span>
              <h2 id="nuevoDescuentos" name="nuevoDescuentos" class="pull-right">0.00</h2>
          
            </div>
          </div>





        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-usd"></i></span>

            <div class="info-box-content">
              <span><b>TOTAL:</b></span>
              <h2 id="nuevoTotalVenta2" name="nuevoTotalVenta2" class="pull-right">0.00</h2>


          
            </div>
            <!-- /.info-box-content -->
          </div>


            <div class="box "></div>


             <td>
                   <button type="submit" class="btn btn-block btn-success btn-lg" name="botonEfectivo"><i class="fa fa-money"></i>  Efectivo</button>
                   <button type="submit" class="btn btn-block btn-primary btn-lg" onClick="pagoTarjeta()"><i class="fa fa-credit-card-alt"></i> Tarjeta</button>

             </td>

                  <script>

         






          function pagoEfectivo(){



        swal({
            type: "info",
            title: "Efectivo ",
            text: "Ingresa la cantidad en efectivo recibida",
            showConfirmButton: true,
            input: 'number',
            confirmButtonText: "Aceptar"

            }).then(function(result){
                if (result.value) {
                  window.location = "index.php?ruta=sucursales-estadistico";


               

                  swal({
            type: "success",
            title: "Cambio es:",
            showConfirmButton: true,
            confirmButtonText: "Aceptar"

          })



                }



              })


}
function pagoTarjeta(){

        swal({
            type: "info",
            title: "Número de transacción: ",
            text: "Ingresa el número de autorización:",
            showConfirmButton: true,
            input: 'text',
            confirmButtonText: "Cerrar"
           
              })


}
        </script>

        </div>
</div>
      </form>
         

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVentaNV2();
          
        ?>



        </div>

          

  </section>



</div>







