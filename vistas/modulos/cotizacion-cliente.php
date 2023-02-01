
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear cotización cliente
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear cotización</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
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

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group hidden">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    
               

                      $num1 = random_int(0, 9);
                       $num2 = random_int(0, 9);
                        $num3 = random_int(0, 9);
                         $num4 = random_int(0, 9);
                          $num5 = random_int(0, 9);
                      
                      $let1 = chr(rand(ord("A"),ord("Z")));
                      $let2 = chr(rand(ord("A"),ord("Z")));
                      $let3 = chr(rand(ord("A"),ord("Z")));

                      $codigo = $let1.$let2.$let3.$num1.$num2.$num3.$num4.$num5;



                      echo '<input type="text" class="form-control" id="nuevoCodigo" name="nuevoCodigo" value="'.$codigo.'" readonly>';
                  

                    

                    ?>
                    
                    
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group row">
                  
                 
                <div class="col-xs-12 col-sm-6">
             <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <input type="text" class="form-control input-lg" id="nuevoNombre" placeholder="Nombre cliente "name="nuevoNombre" autocomplete="off" required>

                  </div>
                </div>

                 <div class="col-xs-12 col-sm-6">
             <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    
                    <input type="text" class="form-control input-lg" id="nuevoContacto" placeholder="Contacto"name="nuevoContacto" autocomplete="off" required>

                  </div>
                </div>



                
                </div>



 <!-- ENTRADA PARA AJAX DEPEDNEINTE -->

                    <div class="form-group row ">
          <div class="col-xs-12 col-sm-6">
             <div class="input-group">

               

              <span class="input-group-addon"><i class="fa fa-repeat"></i></span>

              <select class="form-control input-lg" name="marcaSeleccionada2" id="marcaSeleccionada2">



                
                <option value="">Marca</option>

                 <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorCategorias::ctrMostrarMarcas($item, $valor);


                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["marca"].'</option>';

                       }

                    ?>
     
              </select>



            </div>
            </div>

            <div class="col-xs-12 col-sm-6">
             <div class="input-group">

               

              <span class="input-group-addon"><i class="fa fa-repeat"></i></span>

              <select class="form-control input-lg" name="nuevoModelo2" id="nuevoModelo2" >
                
                <option value="">Modelo</option>


                
     
              </select>



              <script>
  $(document).ready(function(e){

  $("#marcaSeleccionada2").change(function(){
    var idMarcaModelo = "idMarcaModelo="+$("#marcaSeleccionada2").val();

    $.ajax({
     data: idMarcaModelo,
    url: 'ajax/categorias.ajax.php',
    type: 'post',
   
    beforeSend: function () {
      $("#nuevoModelo2").html("Cargando...");
    },
    success: function(response){
        
        $("#nuevoModelo2").html(response);
      },
      error:function(){
        alert("error")
      }


  });

              })

            })

                  


                </script>
            </div>
            </div>
          </div>


 <!--=====================================
                ENTRADA DIAS DE VIGENCIA
                ======================================--> 

                <div class="form-group row">
                  
                 
                <div class="col-xs-12 col-sm-6">
             <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-star-half-empty"></i></span>
                    
                    <input type="text" class="form-control input-lg" id="nuevoVigencia" placeholder="Días de vigencia "name="nuevoVigencia" autocomplete="off" required>

                  </div>
                </div>

                 
                <!--  <div class="col-xs-12 col-sm-6">
             <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    
                    <input type="text" class="form-control input-lg" id="nuevoContacto" placeholder="Contacto"name="nuevoContacto" autocomplete="off">

                  </div>
                </div> -->



                
                </div>



                

       <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoCotizacion">

                </div>

                <input type="hidden" id="listaCotizaciones" name="listaCotizaciones">

                <!--=====================================
                BOTÓN PARA AGREGAR Cotizacion
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarCotizacion">Agregar producto</button>

                

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">
                    
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
      
              </div>

          </div>



          <div class="box-footer">

            <button type="submit" class="btn btn-warning pull-right">Generar cotización</button>

          </div>

        </form>

        <?php

          $guardarCotizacion = new ControladorCotizaciones();
          $guardarCotizacion -> ctrCrearCotizacionCliente();
          
        ?>

        </div>
            
      </div>




      <!--=====================================
      LA TABLA DE cotizaciones
      ======================================-->

 

          <div class="col-lg-7 col-xs-12">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>



          <div class="box-body">


            
            <table class="table table-bordered table-striped dt-responsive tablaCotizacionCliente">
              
               <thead>

                 <tr>

                  <th>Codigo</th>
                  <th>Modelo</th>
                  <th>Reparación</th>
                  <th>Descripción</th>
                  <th>Precio</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

      </div>
   
  </section>
</div>

      

           <!--=====================================
      LA TABLA DE cotizaciones
      ======================================-->

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Listado de cotizaciones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear cotización</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

 


      <div class="col-lg-12 col-xs-12">
        
        <div class="box box-info">

          <div class="box-header with-border"></div>


          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
          
          <th style="width:10px">#</th>
           <th>Cliente</th>
           <th>Contacto</th>
           <th>Modelo</th>
           <!-- <th>Cotización</th> -->
           <th>Precio</th>
           <th>Código</th>
           <th>Vigencia</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $cotizacion = ControladorCotizaciones::ctrMostrarCotizacionCliente($item, $valor);

          foreach ($cotizacion as $key => $value) {
           
            echo ' <tr>
                    <td>'.($key+1).'</td>
                    <td><b>'.$value["cliente"].'</b></td>
                    <td>'.$value["contacto"].'</td>';
                    

      $item = "codigo";
      $valor = $value["modelo"];

      $respuestaModelo = ControladorCategorias::ctrMostrarModelos($item, $valor);

            

          $hoy = date("Y-m-d");
          //var_dump("HOY",$hoy);

          $fechaInicial = $value["fecha"];
          $dias = $value["dias_vigencia"];

   $fechaGarantia = new DateTime($fechaInicial);
  //$dias = $_POST["editarGarantia"];
   $fechaGarantia -> add(new DateInterval('P'.$dias.'D'));
        
        $vigencia2 = $fechaGarantia->format("Y-m-d");

        //var_dump("VIGENCIA", $vigencia2);



        if($vigencia2 >= $hoy){
      $vigencia = '<b style="color: #229954;" >VIGENTE</b>';
        
        } else {
          $vigencia = '<b style="color: #ff3356;" >EXPIRADA</b>';
        }
          


               echo     '
                    <td>'.$respuestaModelo["modelo"].'</td>
                    <td>$ '.$value["precio"].'</td>
                    <td><b>'.$value["codigo"].'</b></td>
                    
                    <td>'.$vigencia.'</td>

            
                   <td>

                   <div class="btn-group">';
                        
                   //if($_SESSION["perfil"] == "Administrador"){

                       echo '<button class="btn btn-primary btnGenerarCotizacion" idCotizacion="'.$value["id"].'"><i class="fa fa-image"></i></button>

                       <button class="btn btn-warning btnGenerarCotización" idMarcaEditar="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarMarca"><i class="fa fa-info-circle"></i></button>

                         <button class="btn btn-danger btnEditarMarca" idMarcaEditar="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarMarca"><i class="fa fa-repeat"></i></button> 

                         <button class="btn btn-success btnEditarMarca" idMarcaEditar="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarMarca"><i class="fa fa-check-circle"></i></button>';//}

                     echo' </div>  

                    </td>

                  </tr>';
          }

        ?>

        

        </tbody>



       </table>

          </div>

        </div>


      </div>

       </div>
   
  </section>
</div>



    



<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>
