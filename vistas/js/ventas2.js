

 

 $("#nuevoCodigoVenta2").focus();
 



/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

console.log("cambia cantidad");

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);


	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(0);

		$(this).attr("nuevoStock", $(this).attr("stock"));

		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO
	        
    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})

/*=============================================
CUANDO CAMBIA EL PRECIO
=============================================*/
$(".formularioVenta").on("change", "input.nuevoPrecioProducto", function(){

	console.log("cambia");

	var precioReal = $(this).val()
	console.log("precioModicado", precioReal);

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	//var nuevoPrecioProductoModificado = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	
	//console.log("NuevoPRecio", nuevoPrecioProducto.val());
	//console.log("Modificado Precio", nuevoPrecioProductoModificado.val());

	$(nuevoPrecioProducto).val(precioReal);
	$(nuevoPrecioProducto).attr("precioReal", precioReal);
   
   // $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
   // $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);
      	    
	console.log("cambia");
	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO
	        
    agregarImpuesto()

    // LISTAR PRODUCTO
    listarProductos()

});

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
//	console.log("PrecioProducto", precioItem);
	
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		
		// console.log("precioItem", precioItem);
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
		


		$("#nuevoSubtotalVenta").html(sumaTotalPrecio);
		$("#nuevoSubtotalVenta").number(true, 2);

		$("#nuevoTotalVenta2").html(sumaTotalPrecio);
		$("#nuevoTotalVenta2").number(true, 2);


	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);
	console.log("se ejedcutos");


}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto(){

	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	
	$("#nuevoTotalVenta").val(totalConImpuesto);

	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);



		

		$("#nuevoImpuestos").html(precioImpuesto);
		$("#nuevoImpuestos").number(true, 2);


		$("#nuevoTotalVenta2").html(totalConImpuesto);
		$("#nuevoTotalVenta2").number(true, 2);


}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function(){

	agregarImpuesto();

});



/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 2);



/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);
	$("#diferenciaCambio").val(cambio);

}) 
 
/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){

     listarMetodos()


})



/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos2(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");
	//console.log("Precio", precio);

	
	for(var i = 0; i < descripcion.length; i++){

	var buscar = $(descripcion[i]).attr("idProducto");
	let indice = listaProductos.findIndex(id => id.id === buscar);

	if (indice === -1) {
		//console.log("CODIGO NO EXISTE");

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal")/$(cantidad[i]).val(),
							  "total" : $(precio[i]).val()})
	} else {
		//console.log("CODIGO EXISTE");
		listaProductos[indice].cantidad = Number(listaProductos[indice].cantidad) + 1;
		
		listaProductos[indice].stock = Number(listaProductos[indice].stock) - 1;
		}
	}

	$("#listaProductos").val(JSON.stringify(listaProductos)); 
		//console.log(listaProductos); 

}

/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos(){

	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo"){

		$("#listaMetodoPago").val("Efectivo");

	}else{

		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());

	}

}











/*=============================================
CREAR VENTA 2 SIN TABLA 
=============================================*/

$("#nuevoCodigoVenta2").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        // Do something
       
       // var codigo = $("#nuevoCodigo").val();

      var idProducto = $("#nuevoCodigoVenta2").val();

       //var idProducto = $("#nuevoCodigo").val();
       var codigoInventario = $("#nuevoCodigoVenta2").val();
       var stockProducto = $(this).attr("stockProducto");
       console.log("hola", codigoInventario);


       if ( codigoInventario != ""){
	
	var datos = new FormData();
    datos.append("codigoInventario", codigoInventario);

     $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      

      			var descripcion = respuesta["descripcion"];
      	    var codigo = respuesta["codigo"];
      	    var id_categoria = respuesta["id_categoria"];

    
      	   
      	   // var id_color = respuesta["id_color"];
      	    var id_modelo = respuesta["id_modelo"];
      	    console.log("aqui2", codigo);
      	    console.log("Descripcion", id_categoria);

      	   // console.log("Preba variable fuera", descripcionCategoria);




      	    
          	var stock = respuesta["stock"];
          	var id = respuesta["id"];
          	var precio = respuesta["precio_venta"];
          	//var stock1 = respuesta["stock"];
          	var id_sucursal = $(idSucursal).val();
      		//console.log("idSucursal", id_sucursal);


      		//console.log("stock", stock);
      		//console.log("PRECIO", precio);



      		if (respuesta["codigo"] != null){

      		
    var datosStock = new FormData();
    datosStock.append("codigoProductoSucursal", respuesta["codigo"]);
    datosStock.append("idSucursalStock", id_sucursal);
    console.log("aqui2SD", datosStock);

     $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datosStock,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta2){
      		console.log("respuesta", respuesta2 );
      		//console.log("respuesta2", respuesta2["0"]["stock"] );

      		var stockSucursal = respuesta2["0"]["stock"];
      		console.log(stockSucursal);



										    var datos3 = new FormData();
										    datos3.append("idCategoria", id_categoria);
										    //console.log("aqui2SDssssss", id_categoria);

										     $.ajax({

										     	url:"ajax/categorias.ajax.php",
										      	method: "POST",
										      	data: datos3,
										      	cache: false,
										      	contentType: false,
										      	processData: false,
										      	dataType:"json",
										      	success:function(respuesta3){
										      		console.log("categoria", respuesta3["categoria"]);

										      		var descripcionCategoria = respuesta3["categoria"];



																		    var datos4 = new FormData();
																		    datos4.append("idModeloVentasJS", id_modelo);
																		    //console.log("modeloID", id_modelo);

																		     $.ajax({

																		     	url:"ajax/categorias.ajax.php",
																		      	method: "POST",
																		      	data: datos4,
																		      	cache: false,
																		      	contentType: false,
																		      	processData: false,
																		      	dataType:"json",
																		      	success:function(respuesta4){
																		      		console.log("modelo", respuesta4["modelo"]);

																		      		if (respuesta4["modelo"] !== undefined){
																		      		var descripcionModelo = respuesta4["modelo"];
      																				}else{
      																					var descripcionModelo = "";
      																				}
      		


 				
          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	FALTA REVISAR EL STOCK DESDE TABLA STOCk
          	=============================================*/
          if (stockSucursal <= 0){

      	 		swal({
			       title: "No hay stock disponible",
			       type: "error",
			       confirmButtonText: "¡Cerrar!"
			     });

			   

			     return;

           	}


          	$(".nuevoProducto2").append(

          	'<div class="row" style="padding:5px 50px">'+

			  '<!-- Descripción del producto -->'+


			  





			  '<div class="col-md-12 col-sm-12 col-xs-12">'+


          '<div class="info-box" style="background-color:#F3F3F3;">'+
           '<span class="info-box-icon bg-aqua"><i class="fa fa-barcode"></i></span>'+

            '<div class="info-box-content">'+
              '<span class="info-box-text">'+codigo+' </span>'+
              '<span class="info-box-number">'+descripcionCategoria+" "+descripcionModelo+" "+descripcion+' </span>'+
               
               '<input type="hidden" class="form-control nuevaDescripcionProducto" codigoInventario="'+codigoInventario+'" idProducto="'+id+'" name="agregarProducto" value="'+codigo+" "+descripcionCategoria+" "+descripcionModelo+" "+descripcion+'">'+
              

              


							

							'<div class="col-md-6 col-xs-12 ingresoPrecio pull-right" style="padding-left:0px" >'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" autocomplete="off" required>'+
	 
	            '</div>'+
	             
	          '</div>'+


	          '<div class="col-md-4 col-xs-10 pull-right">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stockSucursal+'" nuevoStock="'+Number(stockSucursal-1)+'" autocomplete="off" required>'+

	          '</div>' +

	        


            '</div>'+
            '</div>'+
          
        '</div>'+


	        

	        

	        '</div>') 


	      	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO
	        
    agregarImpuesto()

    // LISTAR PRODUCTO
    listarProductos2()





	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);



			}
				})
//termina Ajax 4




			}
				})
//termina Ajax 3




			}
    		 })
     //termina Ajax 1


			

		} else {


			swal({
	      title: "Articulo no encontrado",
	      text: "¡El articulo no se encuentra registrado!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	   // return;


		}




      						}
    				 })

 


       			

        $("#nuevoCodigoVenta2").val("");

			} else {

					 $("#nuevoCodigoVenta2").focus();

		}

    }


});



