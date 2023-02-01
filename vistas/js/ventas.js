/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })// 

 $("#nuevoCodigoVenta").focus();
 
if(localStorage.getItem("capturarRango") != null){

$("#daterange-btn span").html(localStorage.getItem("capturarRango"));

} else {

	$("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}


$('.tablaVentas').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php",
    "ajax": "ajax/datatable-ventas.ajax.php?idSucursal="+$(idSucursal).val(),
     "autoWidth": false,
     "pageLength" : 50,
     "columnDefs": [
    { "width": "10%", "targets": 0 },
    { "width": "30%", "targets": 1 },
    { "width": "20%", "targets": 2 },
    { "width": "10%", "targets": 3 },
    { "width": "10%", "targets": 4 },
  ],
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );



/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var stockProducto = $(this).attr("stockProducto");
	var modeloProducto = $(this).attr("modeloProducto");
	var categoriaProducto = $(this).attr("categoriaProducto");

	
	console.log("Stock por sucursal", stockProducto);
	console.log("modeloProducto", modeloProducto);
	console.log("categoriaProducto", categoriaProducto);

	

	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idProducto", idProducto);

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

      	    
          	var stock = stockProducto;
          	var precio = respuesta["precio_venta"];

          	


          	//var stock1 = respuesta["stock"];
          	var id_sucursal = $(idSucursal).val();
      		console.log("idSucursal", id_sucursal);


      		console.log("stock", stock);


          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock <= 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

			    return;

          	}

          	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+codigo+" "+categoriaProducto+" "+modeloProducto+" "+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPrecios()

	        // AGREGAR IMPUESTO

	        agregarImpuesto()

	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);


			localStorage.removeItem("quitarProducto");

      	}

     })

});



/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}


	}


})


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);


	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO
	        
        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()

	}

})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

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


	var precioReal = $(this).val()
	console.log("precioReal", precioReal);

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	//var nuevoPrecioProductoModificado = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	
	//console.log("NuevoPRecio", nuevoPrecioProducto.val());
	//console.log("Modificado Precio", nuevoPrecioProductoModificado.val());

	$(nuevoPrecioProducto).val(precioReal);
	$(nuevoPrecioProducto).attr("precioReal", precioReal);
   


   // $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
   // $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);
      	    
	
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
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function(){

	var metodo = $(this).val();

	if(metodo == "Efectivo"){

//		$(this).parent().parent().removeData("#nuevoMetodoPago");


		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			 '<div class="col-xs-4">'+ 

			 	'<div class="input-group">'+ 

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

			 		'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" autocomplete="off" required>'+

			 	'</div>'+

			 '</div>'+

			 '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

			 	'<div class="input-group">'+

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

			 		'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>'+

			 	'</div>'+

			 '</div>'

		 )

		// Agregar formato al precio

		$('#nuevoValorEfectivo').number( true, 2);
      	$('#nuevoCambioEfectivo').number( true, 2);


      	// Listar método en la entrada
      	listarMetodos()

	}else{

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPago').html(

		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>')

	}

	

})

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

	// Listar método en la entrada
     listarMetodos()


})


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");

		



		



	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).val()/$(cantidad[i]).val(),
							  "total" : $(precio[i]).val()})


	}

	$("#listaProductos").val(JSON.stringify(listaProductos)); 

}


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos2(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoTotalVenta");
	//console.log("Precio", precio);
			var impuestos = $(".nuevoImpuestoVenta");


	
	for(var i = 0; i < descripcion.length; i++){

	var buscar = $(descripcion[i]).attr("idProducto");
	let indice = listaProductos.findIndex(id => id.id === buscar);

	if (indice === -1) {
		//console.log("CODIGO NO EXISTE");

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).val()/$(cantidad[i]).val(),
							  "impuestos" : $(impuestos[i]).val(),
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
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaVentas').on( 'draw.dt', function(){

	quitarAgregarProducto();

})





/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days').endOf('day')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment().endOf('day')],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().startOf('day'),
    endDate  : moment().endOf('day')
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');


    var capturarRango = $("#daterange-btn span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/



$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

/*=============================================
CAPTURAR HOY
=============================================*/
$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		if(mes < 10 && dia < 10){

			var fechaInicial = año+"-0"+mes+"-0"+dia;
			var fechaFinal = año+"-0"+mes+"-0"+dia;

		}else if(dia < 10){

			var fechaInicial = año+"-"+mes+"-0"+dia;
			var fechaFinal = año+"-"+mes+"-0"+dia;

		}else if(mes < 10){

			var fechaInicial = año+"-0"+mes+"-"+dia;
			var fechaFinal = año+"-0"+mes+"-"+dia;

		}else{

			var fechaInicial = año+"-"+mes+"-"+dia;
	    	var fechaFinal = año+"-"+mes+"-"+dia;

		}	

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}
	
	

})







/*=============================================
CREAR VENTA 2 SIN TABLA 
=============================================*/

$("#nuevoCodigoVenta").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        // Do something
       
       // var codigo = $("#nuevoCodigo").val();

      var idProducto = $("#nuevoCodigoVenta").val();

       //var idProducto = $("#nuevoCodigo").val();
       var codigoInventario = $("#nuevoCodigoVenta").val();
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


          	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 50px">'+

			  '<!-- Descripción del producto -->'+


	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+

	            '<span class="input-group-addon"><button type="button" class="btn btn-info btn-xs"><i class="fa fa-barcode "></i></button> <button type="button" class="btn btn btn-xs">'+(stockSucursal-1)+' </button></span>'+
	          

	              '<input type="text" class="form-control nuevaDescripcionProducto" codigoInventario="'+codigoInventario+'" idProducto="'+id+'" name="agregarProducto" value="'+codigo+" "+descripcionCategoria+" "+descripcionModelo+" "+descripcion+'" readonly>'+

	              '</div>'+

	          '</div>'+

	        '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-2">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stockSucursal+'" nuevoStock="'+Number(stockSucursal-1)+'" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" required>'+
	 
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

 


       			

        $("#nuevoCodigoVenta").val("");

			} else {

					 $("#nuevoCodigoVenta").focus();

		}

    }


});


/*=============================================
EDITAR PRODUCTO
=============================================*/


$(".tablas").on("click", ".btnDatosFactura", function(){
  var codigoVenta = $(this).attr("codigoVenta");
  console.log("codigoVenta", codigoVenta);
 


         $("#nuevoNoVenta").addClass('readonly');
          $("#nuevoNoVenta").val(codigoVenta);
           

});



/*=============================================
CAPTURAR HOY
=============================================*/

  $(".daterangepicker.opensright .ranges li").on("click", function(){

  var textoHoy = $(this).attr("data-range-key");

  if(textoHoy == "Hoy"){

    var d = new Date();
    
    var dia = d.getDate();
    var mes = d.getMonth()+1;
    var año = d.getFullYear();

    if(mes < 10){

      var fechaInicial = año+"-0"+mes+"-"+dia;
      var fechaFinal = año+"-0"+mes+"-"+dia;

    }else if(dia < 10){

      var fechaInicial = año+"-"+mes+"-0"+dia;
      var fechaFinal = año+"-"+mes+"-0"+dia;

    }else if(mes < 10 && dia < 10){

      var fechaInicial = año+"-0"+mes+"-0"+dia;
      var fechaFinal = año+"-0"+mes+"-0"+dia;

    }else{

      var fechaInicial = año+"-"+mes+"-"+dia;
        var fechaFinal = año+"-"+mes+"-"+dia;

    } 

      localStorage.setItem("capturarRangoVentasDia", "Hoy");

      window.location = "index.php?ruta=sucursales-estadistico&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

})




/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensright .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

    var d = new Date();
    
    var dia = d.getDate();
    var mes = d.getMonth()+1;
    var año = d.getFullYear();

    if(mes < 10){

      var fechaInicial = año+"-0"+mes+"-"+dia;
      var fechaFinal = año+"-0"+mes+"-"+dia;

    }else if(dia < 10){

      var fechaInicial = año+"-"+mes+"-0"+dia;
      var fechaFinal = año+"-"+mes+"-0"+dia;

    }else if(mes < 10 && dia < 10){

      var fechaInicial = año+"-0"+mes+"-0"+dia;
      var fechaFinal = año+"-0"+mes+"-0"+dia;

    }else{

      var fechaInicial = año+"-"+mes+"-"+dia;
        var fechaFinal = año+"-"+mes+"-"+dia;

    } 

    	localStorage.setItem("capturarRangoVentasDia", "Hoy");

    	window.location = "index.php?ruta=ventasdia&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})





/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");
	console.log("idVenta", idVenta);



	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;


}) 



/*=============================================
IMPRIMIR TICKET
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function(){

	var codigoVenta = $(this).attr("codigoVenta");

	window.open("extensiones/tcpdf/pdf/ticket.php?codigo="+codigoVenta, "_blank");

})


/*=============================================
IMPRIMIR CORTE DEL DIA
=============================================*/

//$(".tablas").on("click", ".btnImprimirCorte", function(){
	$(".btnImprimirCorte").click(function(){
		

	var sucursal = $(this).attr("sucursal");
	var fechaIncial = $(this).attr("fechaIncial");
	var fechaFinal = $(this).attr("fechaFinal");

	window.open("extensiones/tcpdf/pdf/ticketCorteDia.php?suc="+sucursal, "_blank");

})









