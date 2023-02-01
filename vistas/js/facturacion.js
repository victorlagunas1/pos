$(".tablasFacturacion").DataTable({
	"order": [[ 0, "desc" ]],
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


/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablasFacturacion tbody").on("click", "button.btnEditarFacturacion", function(){

  var idFacturacion = $(this).attr("idFacturacion");
  var idCliente = $(this).attr("idCliente");
  var cfdi = $(this).attr("cfdi");
  var idVenta = $(this).attr("idVenta");
  
  console.log("idFacturacion", idFacturacion);
 
 
  
  

     $("#nuevoNoVentaEditar").val(idVenta);
     $("#seleccionarClienteEditar").val(idCliente);
     $("#nuevoUsoCFDIEditar").val(cfdi);
     $("#idFacturacionEditar").val(idFacturacion);

     
     
     


})


/*=============================================
ELIMINAR PRODUCTO STOCK_SUCURSAL
=============================================*/

$(".tablasFacturacion tbody").on("click", "button.btnEliminarFacturacion", function(){
 
  var idFacturacion = $(this).attr("idFacturacion");
  
  console.log("idFacturacion", idFacturacion);
  
 
  swal({

    title: '¿Está seguro de borrar los datos de facturación?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar facturación!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=facturacion&idFacturacion="+idFacturacion;

        }


  })

})

