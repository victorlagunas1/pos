/*=============================================
CARGAR LA TABLA DINÁMICA DE Reparaciones
=============================================*/

// $.ajax({

//  url: "ajax/datatable-Reparaciones.ajax.php",
//  success:function(respuesta){
    
//    console.log("respuesta", respuesta);



// })

// $('.tablaFinanzas').DataTable( {
//     "ajax": "ajax/datatable-finanzas.ajax.php",
//       "deferRender": true,
//     "order": [[ 0, "desc" ]],
//   "retrieve": true,
//   "processing": true,
//    "language": {

//       "sProcessing":     "Procesando...",
//       "sLengthMenu":     "Mostrar _MENU_ registros",
//       "sZeroRecords":    "No se encontraron resultados",
//       "sEmptyTable":     "Ningún dato disponible en esta tabla",
//       "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
//       "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
//       "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//       "sInfoPostFix":    "",
//       "sSearch":         "Buscar:",
//       "sUrl":            "",
//       "sInfoThousands":  ",",
//       "sLoadingRecords": "Cargando...",
//       "oPaginate": {
//       "sFirst":    "Primero",
//       "sLast":     "Último",
//       "sNext":     "Siguiente",
//       "sPrevious": "Anterior"
//       },
//       "oAria": {
//         "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//         "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//       }

//   }

// } );

//localStorage.removeItem("capturarRango");

/*=============================================
MANTENER MARGEN DE FECHAS EN BOTON
=============================================*/

if(localStorage.getItem("capturarRango") != null){

$("#daterangeGastos-btn span").html(localStorage.getItem("capturarRango"));

} else {
  $("#daterangeGastos-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha')
}


$(document).on("click", ".btnEliminarActividad", function(){
  
  var idFinanza = $(this).attr("idFinanza");
  console.log("idFinanza", idFinanza)

  swal({

    title: '¿Está seguro de borrar el producto?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=finanzas&idFinanza="+idFinanza;

        }


  })

})


$('#daterangeGastos-btn').daterangepicker(
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
    $('#daterangeGastos-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');


    var capturarRango = $("#daterangeGastos-btn span").html();
   
    localStorage.setItem("capturarRango", capturarRango);

    window.location = "index.php?ruta=gastosparciales&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)




$('#daterangeFinanzas-btn').daterangepicker(
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
    $('#daterangeFinanzas-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');


    var capturarRango = $("#daterangeFinanzas-btn span").html();
   
    localStorage.setItem("capturarRango", capturarRango);

    window.location = "index.php?ruta=finanzas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;


  }

)




$('#datarangeComisiones-btn').daterangepicker(
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
    $('#datarangeComisiones-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');


    var capturarRangoComisiones = $("#datarangeComisiones-btn span").html();
   
    localStorage.setItem("capturarRangoComisiones", capturarRangoComisiones);

    window.location = "index.php?ruta=comisiones&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;


  }


)





/*=============================================
VENTAS DIA  GENERAL
=============================================*/

if(localStorage.getItem("capturarRangoVentasDia") != null){

$("#daterangeVentasDia-btn span").html(localStorage.getItem("capturarRangoVentasDia"));

} else {

  $("#daterangeVentasDia-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}



$('#daterangeVentasDia-btn').daterangepicker(
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
    $('#daterangeVentasDia-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');


    var capturarRangoVentasDia = $("#daterangeVentasDia-btn span").html();
   
    localStorage.setItem("capturarRangoVentasDia", capturarRangoVentasDia);

    window.location = "index.php?ruta=ventasdia&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;


  }

)


/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/
$('button[name="daterangeVentasDia-btn"]').on('cancel.daterangepicker', function(ev, picker) {

  localStorage.removeItem("capturarRangoVentasDia");
  localStorage.clear();
  window.location = "ventasdia";

})




/**
 * @param String name
 * @return String
 */
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}



/*=============================================
VENTAS DIA GENERAL SELECCIONAR SUCURSAL
=============================================*/


  $("#sucursalSeleccionada").change(function(){

  var sucursal = $(this).val();
  //console.log(valor);

  var fechaInicial = getParameterByName('fechaInicial');
  var fechaFinal = getParameterByName('fechaFinal');


  window.location = "index.php?ruta=ventasdia&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&sucursal="+sucursal;
   


});





























  

