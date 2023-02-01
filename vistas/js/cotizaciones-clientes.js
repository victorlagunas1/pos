/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })// 


if(localStorage.getItem("capturarRango") != null){

$("#daterange-btn span").html(localStorage.getItem("capturarRango"));

} else {
	$("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha')
}


$('.tablaCotizacionCliente').DataTable( {
    "ajax": "ajax/datatable-cotizacionesclientes.ajax.php",
     "autoWidth": true,
    "deferRender": true,
    "pageLength" : 50,
    "order": [[ 0, "desc" ]],
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
AGREGANDO Cotizaciones A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaCotizacionCliente tbody").on("click", "button.agregarCotizacion", function(){

	var idCotizacion = $(this).attr("idCotizacion");

	$(this).removeClass("btn-primary agregarCotizacion");

	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idCotizacion", idCotizacion);

     $.ajax({

     	url:"ajax/cotizaciones.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	    var descripcion = respuesta["reparacion"];
      	    var modelo = respuesta["modelo"];
      	    //var codigo = respuesta["modelo"];

      	    
          	var stock = respuesta["stock"];
          	var precio = respuesta["costo"];



          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idCotizacion='"+idCotizacion+"']").addClass("btn-primary agregarCotizacion");

			    return;

          	}

          	$(".nuevoCotizacion").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del Cotizacion -->'+
	          
	          '<div class="col-xs-9" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarCotizacion" idCotizacion="'+idCotizacion+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionCotizacion" idCotizacion="'+idCotizacion+'" name="agregarCotizacion" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          // '<!-- Cantidad del Cotizacion -->'+

	          // '<div class="col-xs-3 hidden">'+
	            
	          //    '<input type="number" class="form-control nuevaCantidadCotizacion" name="nuevaCantidadCotizacion" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

	          // '</div>' +

	          '<!-- Precio del Cotizacion -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioCotizacion" precioReal="'+precio+'" name="nuevoPrecioCotizacion" value="'+precio+'" required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPreciosCotizacion()

	        // AGREGAR IMPUESTO

	        agregarImpuestoCotizacion()

	        // AGRUPAR Cotizaciones EN FORMATO JSON

	        listarCotizaciones()

	        // PONER FORMATO AL PRECIO DE LOS Cotizaciones

	        $(".nuevoPrecioCotizacion").number(true, 2);


			localStorage.removeItem("quitarCotizacion");

      	}

     })

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaCotizacionCliente").on("draw.dt", function(){

	if(localStorage.getItem("quitarCotizacion") != null){

		var listaIdCotizaciones = JSON.parse(localStorage.getItem("quitarCotizacion"));

		for(var i = 0; i < listaIdCotizaciones.length; i++){

			$("button.recuperarBoton[idCotizacion='"+listaIdCotizaciones[i]["idCotizacion"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idCotizacion='"+listaIdCotizaciones[i]["idCotizacion"]+"']").addClass('btn-primary agregarCotizacion');

		}


	}


})


/*=============================================
QUITAR Cotizaciones DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarCotizacion = [];

localStorage.removeItem("quitarCotizacion");

$(".formularioVenta").on("click", "button.quitarCotizacion", function(){

	$(this).parent().parent().parent().parent().remove();

	var idCotizacion = $(this).attr("idCotizacion");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL Cotizacion A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarCotizacion") == null){

		idQuitarCotizacion = [];
	
	}else{

		idQuitarCotizacion.concat(localStorage.getItem("quitarCotizacion"))

	}

	idQuitarCotizacion.push({"idCotizacion":idCotizacion});

	localStorage.setItem("quitarCotizacion", JSON.stringify(idQuitarCotizacion));

	$("button.recuperarBoton[idCotizacion='"+idCotizacion+"']").removeClass('btn-default');

	$("button.recuperarBoton[idCotizacion='"+idCotizacion+"']").addClass('btn-primary agregarCotizacion');

	if($(".nuevoCotizacion").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPreciosCotizacion()

    	// AGREGAR IMPUESTO
	        
        agregarImpuestoCotizacion()

        // AGRUPAR Cotizaciones EN FORMATO JSON

        listarCotizaciones()

	}

})

// /*=============================================
// AGREGANDO Cotizaciones DESDE EL BOTÓN PARA DISPOSITIVOS
// =============================================*/

// var numCotizacion = 0;

// $(".btnAgregarCotizacion").click(function(){

// 	numCotizacion ++;

// 	var datos = new FormData();
// 	datos.append("traerCotizaciones", "ok");


// 	$.ajax({

// 		url:"ajax/cotizaciones.ajax.php",
//       	method: "POST",
//       	data: datos,
//       	cache: false,
//       	contentType: false,
//       	processData: false,
//       	dataType:"json",
//       	success:function(respuesta){
      	    
//       	    	$(".nuevoCotizacion").append(

//           	'<div class="row" style="padding:5px 15px">'+

// 			  '<!-- Descripción del Cotizacion -->'+
	          
// 	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
// 	            '<div class="input-group">'+
	              
// 	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarCotizacion" idCotizacion><i class="fa fa-times"></i></button></span>'+

// 	              '<select class="form-control nuevaDescripcionCotizacion" id="cotizacion'+numCotizacion+'" idCotizacion name="nuevaDescripcionCotizacion" required>'+

// 	              '<option>Seleccione el cotizacion</option>'+

// 	              '</select>'+  

// 	            '</div>'+

// 	          '</div>'+

// 	          '<!-- Cantidad del cotizacion -->'+

// 	          '<div class="col-xs-3 ingresoCantidad">'+
	            
// 	             '<input type="number" class="form-control nuevaCantidadCotizacion" name="nuevaCantidadCotizacion" min="1" value="0" stock nuevoStock required>'+

// 	          '</div>' +

// 	          '<!-- Precio del Cotizacion -->'+

// 	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

// 	            '<div class="input-group">'+

// 	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
// 	              '<input type="text" class="form-control nuevoPrecioCotizacion" precioReal="" name="nuevoPrecioCotizacion" required>'+
	 
// 	            '</div>'+
	             
// 	          '</div>'+

// 	        '</div>');


// 	        // AGREGAR LOS Cotizaciones AL SELECT 

// 	         respuesta.forEach(funcionForEach);

// 	         function funcionForEach(item, index){

// 	         	if(item.stock != 0){

// 		         	$("#cotizacion"+numCotizacion).append(

// 						'<option idCotizacion="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
// 		         	)

		         
// 		         }

		         

// 	         }

//         	 // SUMAR TOTAL DE PRECIOS

//     		sumarTotalPreciosCotizacion()

//     		// AGREGAR IMPUESTO
	        
// 	        agregarImpuestoCotizacion()

// 	        // PONER FORMATO AL PRECIO DE LOS Cotizaciones

// 	        $(".nuevoPrecioCotizacion").number(true, 2);


//       	}

// 	})

// })

/*=============================================
SELECCIONAR Cotizacion
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionCotizacion", function(){

	var nombreCotizacion = $(this).val();

	var nuevaDescripcionCotizacion = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionCotizacion");

	var nuevoPrecioCotizacion = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioCotizacion");

	//var nuevaCantidadCotizacion = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadCotizacion");

	var datos = new FormData();
    datos.append("nombreCotizacion", nombreCotizacion);


	  $.ajax({

     	url:"ajax/cotizaciones.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	     $(nuevaDescripcionCotizacion).attr("idCotizacion", respuesta["id"]);
      	    //$(nuevaCantidadCotizacion).attr("stock", respuesta["stock"]);
      	   // $(nuevaCantidadCotizacion).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    $(nuevoPrecioCotizacion).val(respuesta["costo"]);
      	    $(nuevoPrecioCotizacion).attr("precioReal", respuesta["costo"]);

  	      // AGRUPAR Cotizaciones EN FORMATO JSON

	        listarCotizaciones()

      	}

      })
})

// /*=============================================
// MODIFICAR LA CANTIDAD
// =============================================*/

// $(".formularioVenta").on("change", "input.nuevaCantidadCotizacion", function(){

// 	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioCotizacion");

// 	var precioFinal = $(this).val() * precio.attr("precioReal");
	
// 	precio.val(precioFinal);


// 	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

// 	$(this).attr("nuevoStock", nuevoStock);

// 	if(Number($(this).val()) > Number($(this).attr("stock"))){

// 		=============================================
// 		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
// 		=============================================

// 		$(this).val(0);

// 		$(this).attr("nuevoStock", $(this).attr("stock"));

// 		var precioFinal = $(this).val() * precio.attr("precioReal");

// 		precio.val(precioFinal);

// 		sumarTotalPreciosCotizacion();

// 		swal({
// 	      title: "La cantidad supera el Stock",
// 	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
// 	      type: "error",
// 	      confirmButtonText: "¡Cerrar!"
// 	    });

// 	    return;

// 	}

// 	// SUMAR TOTAL DE PRECIOS

// 	sumarTotalPreciosCotizacion()

// 	// AGREGAR IMPUESTO
	        
//     agregarImpuestoCotizacion()

//     // AGRUPAR Cotizaciones EN FORMATO JSON

//     listarCotizaciones()

// })

/*=============================================
CUANDO CAMBIA EL PRECIO
=============================================*/
$(".formularioVenta").on("change", "input.nuevoPrecioCotizacion", function(){


	var precioReal = $(this).val()

	var nuevoPrecioCotizacion = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioCotizacion");
	$(nuevoPrecioCotizacion).attr("precioReal", precioReal);

	
	// SUMAR TOTAL DE PRECIOS

	sumarTotalPreciosCotizacion()

	// AGREGAR IMPUESTO
	        
    agregarImpuestoCotizacion()

    listarCotizaciones()

});

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosCotizacion(){

	var precioItem = $(".nuevoPrecioCotizacion");
	
	var arraySumaPrecioCotizacion = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecioCotizacion.push(Number($(precioItem[i]).val()));
		
		 
	}

	function sumaArrayPreciosCotizacion(total, numero){

		return total + numero;

	}

	var sumaTotalPrecioCotizacion = arraySumaPrecioCotizacion.reduce(sumaArrayPreciosCotizacion);
	
	$("#nuevoTotalVenta").val(sumaTotalPrecioCotizacion);
	$("#totalVenta").val(sumaTotalPrecioCotizacion);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecioCotizacion);


}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuestoCotizacion(){

	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	
	$("#nuevoTotalVenta").val(totalConImpuesto);

	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);

}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function(){

	agregarImpuestoCotizacion();

});



/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 2);



// /*=============================================
// SELECCIONAR MÉTODO DE PAGO
// =============================================*/

// $("#nuevoMetodoPago").change(function(){

// 	var metodo = $(this).val();

// 	if(metodo == "Efectivo"){

// 		$(this).parent().parent().removeClass("col-xs-6");

// 		$(this).parent().parent().addClass("col-xs-4");

// 		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

// 			 '<div class="col-xs-4">'+ 

// 			 	'<div class="input-group">'+ 

// 			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

// 			 		'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" autocomplete="off" required>'+

// 			 	'</div>'+

// 			 '</div>'+

// 			 '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

// 			 	'<div class="input-group">'+

// 			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

// 			 		'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>'+

// 			 	'</div>'+

// 			 '</div>'

// 		 )

// 		// Agregar formato al precio

// 		$('#nuevoValorEfectivo').number( true, 2);
//       	$('#nuevoCambioEfectivo').number( true, 2);


//       	// Listar método en la entrada
//       	listarMetodos()

// 	}else{

// 		$(this).parent().parent().removeClass('col-xs-4');

// 		$(this).parent().parent().addClass('col-xs-6');

// 		 $(this).parent().parent().parent().children('.cajasMetodoPago').html(

// 		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
//                 '<div class="input-group">'+
                     
//                   '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                       
//                   '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
//                 '</div>'+

//               '</div>')

// 	}

	

// })

// /*=============================================
// CAMBIO EN EFECTIVO
// =============================================*/
// $(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

// 	var efectivo = $(this).val();

// 	var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());

// 	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

// 	nuevoCambioEfectivo.val(cambio);

// })

// /*=============================================
// CAMBIO TRANSACCIÓN
// =============================================*/
// $(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){

// 	// Listar método en la entrada
//      listarMetodos()


// })


/*=============================================
LISTAR TODOS LOS Cotizaciones
=============================================*/

function listarCotizaciones(){

	var listaCotizaciones = [];

	var descripcion = $(".nuevaDescripcionCotizacion");

	//var cantidad = $(".nuevaCantidadCotizacion");

	var precio = $(".nuevoPrecioCotizacion");

	for(var i = 0; i < descripcion.length; i++){

		listaCotizaciones.push({ "id" : $(descripcion[i]).attr("idCotizacion"), 
							  "descripcion" : $(descripcion[i]).val(),
							  //"cantidad" : $(cantidad[i]).val(),
							  //"stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})

	}

	$("#listaCotizaciones").val(JSON.stringify(listaCotizaciones)); 

}

// /*=============================================
// LISTAR MÉTODO DE PAGO
// =============================================*/

// function listarMetodos(){

// 	var listaMetodos = "";

// 	if($("#nuevoMetodoPago").val() == "Efectivo"){

// 		$("#listaMetodoPago").val("Efectivo");

// 	}else{

// 		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());

// 	}

// }


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL Cotizacion YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarCotizacion(){

	//Capturamos todos los id de Cotizaciones que fueron elegidos en la venta
	var idCotizaciones = $(".quitarCotizacion");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarCotizacion");

	//Recorremos en un ciclo para obtener los diferentes idCotizaciones que fueron agregados a la venta
	for(var i = 0; i < idCotizaciones.length; i++){

		//Capturamos los Id de los Cotizaciones agregados a la venta
		var boton = $(idCotizaciones[i]).attr("idCotizacion");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idCotizacion") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarCotizacion");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaVentas').on( 'draw.dt', function(){

	quitarAgregarCotizacion();

})







/*=============================================
GENERAR COTIZACION CLIENTE 
=============================================*/

$(".tablas").on("click", ".btnGenerarCotizacion", function(){

	var idCotizacion = $(this).attr("idCotizacion");

	window.open("extensiones/tcpdf/pdf/cotizacion.php?codigo="+idCotizacion, "_blank");

})


/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }

  })

})





















