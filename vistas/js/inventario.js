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


$(".tablasInvetario").DataTable({
	"order": [[ 0, "desc" ]],
	"deferRender": true,
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

});


$("#nuevoCodigo").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        // Do something
        console.log("Enter", $("#nuevoCodigo").val());
       // var codigo = $("#nuevoCodigo").val();


       //var idProducto = $("#nuevoCodigo").val();
       var codigoInventario = $("#nuevoCodigo").val();
       
	


	//$(this).removeClass("btn-primary agregarProducto");

	//$(this).addClass("btn-default");

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

      	    
          	var stock = respuesta["stock"];
          //	var categorias = categoria["categoria"];
          	//var precio = respuesta["precio_venta"];

          	//var stock1 = respuesta["stock"];
          	var id_sucursal = $(idSucursal).val();
      	

      		if (respuesta["codigo"] != null){


 
          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	$(".nuevoProducto").append(

          	
			  '<!-- Descripción del producto -->'+


	          '<button type="button" class="btn btn-warning" style="margin:5px 5px 5px 5px"> <i class="fa fa-barcode "></i> <h3>'+codigo+'</h3></button>'+


	          // '<!-- Cantidad del producto -->'+

	          // '<div class="col-xs-3" >'+
	            
	          //    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'+stock+'" stock="'+stock+'" nuevoStock="'+Number(stock)+'" readonly>'+

	          // '</div>' +

	         

	        '</div>') 



	       // listarProductosInventario()
	        EditarInventario()

	        play()


	        $(".nuevoPrecioProducto").number(true, 2);


			localStorage.removeItem("quitarProducto");

		} else {

				
			error()

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








    }
});






/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductosInventario(){
	//todosLosProductos()
	//if (listaProductosInventarioActual.length == 0) {
		//console.log("Actual", listaProductosInventarioActual.length);
var listaProductosInventario = $('#listaProductosInventario').val();

if (listaProductosInventario.length === 0){
	var listaProductosInventario = [];
	var nuevoCodigo = $("#nuevoCodigo").val() ;
		
		console.log("CONTRARIO");

	var idSucursalInventario = $("#sucursal").val();
	var datos = new FormData();
    datos.append("idSucursalInventario", idSucursalInventario);

 			$.ajax({

     	url:"ajax/inventarios.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      		
      		console.log("nuevo codigo", nuevoCodigo);
				
			for(var i = 0; i < respuesta.length; i++){
		//NO PUEDE ESCANEAR UN PRODUCTO QUE NO ESTE REGISTRADO EN LA SUCURSAL DE INICIO, DEBIDO A QUE NO SUMARA POR QUE NO ENCONTRO EL PRODUCTO, DE AHI EN ADELANTE SI SE PUEDE UTURLIZAR.
				
				if (respuesta[i]["producto"] == nuevoCodigo ){
		listaProductosInventario.push({ "codigo" : respuesta[i]["producto"], 
							  "stock" : 1 })
		console.log("nuevo codigo", nuevoCodigo);
		} else {
			listaProductosInventario.push({ "codigo" : respuesta[i]["producto"], 
							  "stock" : 0 })
			console.log("nuevocodigo", nuevoCodigo);

		}

		} 	
		

		$("#listaProductosInventario").val(JSON.stringify(listaProductosInventario));



	}


})	
 		//var listaProductosInventario = JSON.parse($('#listaProductosInventario').val());
		

 		}else{
 	//var listaProductosInventario = json_decode($('#listaProductosInventario').val(), true);

	var listaProductosInventario = JSON.parse($('#listaProductosInventario').val());

	//console.log("2", listaProductosInventario);

	var descripcion = $(".nuevaDescripcionProducto");
	
	//for(var i = 0; i < descripcion.length; i++){
	var buscar = $("#nuevoCodigo").val();
	//console.log("buscar", buscar);
	
	let indice = listaProductosInventario.findIndex(codigo => codigo.codigo === buscar);
	var nuevoCodigo = $("#nuevoCodigo").val();


	if (indice === -1 && nuevoCodigo === buscar ) {

		console.log("Indice", indice);
		console.log("CODIGO NO EXISTE");
		
		listaProductosInventario.push({ "codigo" : nuevoCodigo, 
							  "stock" : 1 })

	} else {
		console.log("Indice", indice);
		console.log("CODIGO EXISTE");

		listaProductosInventario[indice].stock = Number(listaProductosInventario[indice].stock) + 1;
		
	}

	//console.log("listaProductosInventario", listaProductosInventario.length);


	
	//}
	//$(descripcion[i]).attr("codigoInventario").val(""); 
	//$( ".nuevaDescripcionProducto" ).removeAttr( "codigoInventario");


		$("#listaProductosInventario").val(JSON.stringify(listaProductosInventario));
		console.log("Lista", listaProductosInventario);

			//GuardarInventario()
	}


	//TraerValor()

        $("#nuevoCodigo").val(""); 
        $("#nuevoCodigo").focus();

}



/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function EditarInventario(){

	
 	var listaProductosInventario = JSON.parse($('#listaProductosInventarioEditar').val());


    var buscar = $("#nuevoCodigo").val();
	
	
	let indice = listaProductosInventario.findIndex(codigo => codigo.codigo === buscar);
	var nuevoCodigo = $("#nuevoCodigo").val();


	if (indice === -1 && nuevoCodigo === buscar ) {

		console.log("Indice", indice);
		console.log("CODIGO NO EXISTE");
		
		listaProductosInventario.push({ "codigo" : nuevoCodigo, 
							  "stock" : 1 })

	} else {
		console.log("Indice", indice);
		console.log("CODIGO EXISTE");

		listaProductosInventario[indice].stock = Number(listaProductosInventario[indice].stock) + 1;
		
	}


		$("#listaProductosInventarioEditar").val(JSON.stringify(listaProductosInventario));
		//console.log("Lista", listaProductosInventario);

			


        $("#nuevoCodigo").val(""); 
        $("#nuevoCodigo").focus();
      	



}

// function TraerValor (){

// 		var listaProductosInventario = JSON.parse($('#listaProductosInventario').val());
// 		var buscar = $("#nuevoCodigo").val();
// 		let indice = listaProductosInventario.findIndex(codigo => codigo.codigo === buscar);
// 		//var nuevoCodigo = $("#nuevoCodigo").val();
// 		listaProductosInventario[indice].stock = Number(listaProductosInventario[indice].stock) + 1;
//  			console.log("COTRRARIO", listaProductosInventario);
// //console.log("LSSS", listaProductosInventario);
// }

// function CargarStockActual (){
	

// 	var listaProductosInventario = [];

// 	var idSucursalInventario = "1";
// 	var datos = new FormData();
//     datos.append("idSucursalInventario", idSucursalInventario);

//  			$.ajax({

//      	url:"ajax/inventarios.ajax.php",
//       	method: "POST",
//       	data: datos,
//       	cache: false,
//       	contentType: false,
//       	processData: false,
//       	dataType:"json",
//       	success:function(respuesta){
				
// 			for(var i = 0; i < respuesta.length; i++){
				
// 				listaProductosInventario.push({ "codigo" : respuesta[i]["producto"], 
// 							  "stock" : 0 })



// 		} 

 			

		

// 	}
// })	

// //$("#listaProductosInventarioActual").val(JSON.stringify(listaProductosInventario));


// }

// function respaldoCodigo(){
// 		var descripcion = $(".nuevaDescripcionProducto");

	
// 	for(var i = 0; i < descripcion.length; i++){
// 		console.log("descripcion",i);

// 	var buscar = $(descripcion[i]).attr("codigoInventario");
// 	let indice = listaProductosInventario.findIndex(codigo => codigo.codigo === buscar);


// 	if (indice === -1 ) {
// 		console.log("Indice", indice);
// 		console.log("CODIGO NO EXISTE");
		
// 	listaProductosInventario.push({ "codigo" : $(descripcion[i]).attr("codigoInventario"), 
// 							  "stock" : 1 })
		
	
// 	} else {
// console.log("Indice", indice);
// 		console.log("CODIGO EXISTE");

// 		listaProductosInventario[indice].stock = Number(listaProductosInventario[indice].stock) + 1;
		
// 	}

// 	console.log("listaProductosInventarioac", listaProductosInventario);


					 
// 		}

// }

// function todosLosProductos(){

// 	//var listaProductosInventario = [];
// 	var listaProductosInventario = [];

// 	var idSucursalInventario = "1";
	
// 	var datos = new FormData();
//     datos.append("idSucursalInventario", idSucursalInventario);


//  			$.ajax({

//      	url:"ajax/inventarios.ajax.php",
//       	method: "POST",
//       	data: datos,
//       	cache: false,
//       	contentType: false,
//       	processData: false,
//       	dataType:"json",
//       	success:function(respuesta){
				

// 			for(var i = 0; i < respuesta.length; i++){
				
// 				//console.log("producto", respuesta[i]["producto"]);

// 				listaProductosInventario.push({ "codigo" : respuesta[i]["producto"], 
// 							  "stock" : 0 })
// 				//console.log("Lista", listaProductosInventarioActual);
// 				//console.log("Lista2", listaProductosInventario);
			
			
// 		}

			 
// 			 //console.log(listaProductosInventario);

// 			 	}
// })	

//  			//$("#listaProductosInventario").val(JSON.stringify(listaProductosInventario));



// $("#listaProductosInventario").val(JSON.stringify(listaProductosInventario));
	



// }

// function Parte1(){

// 	var listaProductosInventario = [];
		
// 		console.log("CONTRARIO");

// 	var idSucursalInventario = "1";
// 	var datos = new FormData();
//     datos.append("idSucursalInventario", idSucursalInventario);

//  			$.ajax({

//      	url:"ajax/inventarios.ajax.php",
//       	method: "POST",
//       	data: datos,
//       	cache: false,
//       	contentType: false,
//       	processData: false,
//       	dataType:"json",
//       	success:function(respuesta){
				
// 			for(var i = 0; i < respuesta.length; i++){
				
// 				listaProductosInventario.push({ "codigo" : respuesta[i]["producto"], 
// 							  "stock" : 0 })
// 		} 	
// 		$("#listaProductosInventario").val(JSON.stringify(listaProductosInventario));

// 	}


// })	
//  			console.log("COTRRARIO", listaProductosInventario);
//  			Parte2()

// }

// function Parte2(){


// 	var listaProductosInventario = JSON.parse($('#listaProductosInventario').val());

// 	//console.log("2", listaProductosInventario);

// 	var descripcion = $(".nuevaDescripcionProducto");
	
// 	for(var i = 0; i < descripcion.length; i++){
// 	var buscar = $(descripcion[i]).attr("codigoInventario");
// 	let indice = listaProductosInventario.findIndex(codigo => codigo.codigo === buscar);
// 	//console.log("indice", indice);
// 	//console.log("descripcion", descripcion);

// 	if (indice === -1) {
// 		console.log("Indice", indice);
// 		console.log("CODIGO NO EXISTE");
		
// 		listaProductosInventario.push({ "codigo" : $(descripcion[i]).attr("codigoInventario"), 
// 							  "stock" : 1 })

// 	} else {
// 		console.log("Indice", indice);
// 		console.log("CODIGO EXISTE");

// 		listaProductosInventario[indice].stock = Number(listaProductosInventario[indice].stock) + 1;
		
// 	}

// 	//console.log("listaProductosInventario", listaProductosInventario.length);


// 	}

// 		$("#listaProductosInventario").val(JSON.stringify(listaProductosInventario));
// 		//console.log("Lista", listaProductosInventario);
// }

/*=============================================
LISTAR TODOS LOS PRODUCTOS ACTUALES
=============================================*/

// function listarProductosActuales(){

// 	var listaProductosActuales = [];

// 	var descripcion = $(".nuevaDescripcionProducto");

// 	var stock = 1;

	
// 	for(var i = 0; i < descripcion.length; i++){

// 		listaProductosActuales.push({ "codigo" : $(descripcion[i]).attr("codigoInventario"), 
// 							  "stock" : stock })

						 
// 	}

// 	$("#listaProductosActuales").val(JSON.stringify(listaProductosActuales));
// 	console.log("listaProductosActuales Inventario" ,listaProductosActuales); 



// }


/*=============================================
ACEPTAR STOCK NUEVO SUCURSAL
=============================================*/
$(document).on("click", ".btnAceptarInventario", function(){

	

	var idInventario = $(this).attr("idInventario");
	
	var datos = new FormData();
	datos.append("idInventario", idInventario);

	$.ajax({

		url:"ajax/inventarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			//$("#idUsuarioRecibir").val(respuesta["id"]);
				console.log("idInventario", respuesta["stock_nuevo"]);
				console.log("idInventario", idInventario);


			swal({
	      title: "Actualizado",
	      text: "¡Inventario actualizado correctamente!",
	      type: "success",
	      confirmButtonText: "¡Cerrar!"
	    });


		}

	});

	
})

/*=============================================
RECHAZAR STOCK NUEVO SUCURSAL
=============================================*/
$(document).on("click", ".btnRechazarInventario", function(){

	

	var idInventarioRechazar = $(this).attr("idInventario");
	
	var datos = new FormData();
	datos.append("idInventarioRechazar", idInventarioRechazar);

	$.ajax({

		url:"ajax/inventarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			

			swal({
	      title: "Rechazado",
	      text: "¡Inventario actualizado correctamente!",
	      type: "success",
	      confirmButtonText: "¡Cerrar!"
	    });


		}

	});

	
})





$(document).on("click", ".btnRevisionInvetario", function(){

  //var idInventario = $(this).attr("idInventario");

  //window.open("extensiones/tcpdf/pdf/reporteInventar.php?codigo="+idInventario, "_blank");

  var idInventario = $(this).attr("idInventario");
	console.log("idInventario", idInventario);



	window.location = "index.php?ruta=revision-inventario&idInventario="+idInventario;
	

}) 

$(document).on("click", ".btnEditarInventario", function(){


  var idInventario = $(this).attr("idInventario");
	console.log("idInventario", idInventario);

	window.location = "index.php?ruta=inventario-editar&idInventario="+idInventario;
	

}) 




/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

// $('.tablaInvetario').on( 'draw.dt', function(){

// 	quitarAgregarProducto();

// })




function play(){
	var audio = new Audio("vistas/audio/scanner.mp3");
	audio.play();


}

function error(){
	var audio = new Audio("vistas/audio/error.mp3");
	audio.play();


}




















