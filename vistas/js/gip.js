// /*=============================================
// CARGAR LA TABLA DINÁMICA DE Reparaciones
// =============================================*/

// // $.ajax({

// //  url: "ajax/datatable-Reparaciones.ajax.php",
// //  success:function(respuesta){
    
// //    console.log("respuesta", respuesta);



// // })

// $('.TablaGips').DataTable( {
//     "ajax": "ajax/datatable-gip.ajax.php",
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






// $(document).on("click", ".btnEliminarActividad", function(){
  
//   var idFinanza = $(this).attr("idFinanza");
//   console.log("idFinanza", idFinanza)

//   swal({

//     title: '¿Está seguro de borrar el producto?',
//     text: "¡Si no lo está puede cancelar la accíón!",
//     type: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         cancelButtonText: 'Cancelar',
//         confirmButtonText: 'Si, borrar producto!'
//         }).then(function(result){
//         if (result.value) {

//           window.location = "index.php?ruta=gastosparciales&idFinanza="+idFinanza;

//         }


//   })

// })


// $('#daterangeFinanzas-btn').daterangepicker(
//   {
//     ranges   : {
//       'Hoy'       : [moment(), moment()],
//       'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days').endOf('day')],
//       'Últimos 7 días' : [moment().subtract(6, 'days'), moment().endOf('day')],
//       'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
//       'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
//       'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//     },
//     startDate: moment().startOf('day'),
//     endDate  : moment().endOf('day')
//   },
//   function (start, end) {
//     $('#daterangeFinanzas-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

//     var fechaInicial = start.format('YYYY-MM-DD');

//     var fechaFinal = end.format('YYYY-MM-DD');


//     var capturarRango = $("#daterangeFinanzas-btn span").html();
   
//     localStorage.setItem("capturarRango", capturarRango);

//     window.location = "index.php?ruta=finanzas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

//   }

// )


// /*=============================================
// CANCELAR RANGO DE FECHAS
// =============================================*/

// $(".daterangepicker1.opensleft .range_inputs .cancelBtn").on("click", function(){

//   localStorage.removeItem("capturarRango");
//   localStorage.clear();
//   window.location = "finanzas";
// })

// /*=============================================
// CAPTURAR HOY
// =============================================*/
if(localStorage.getItem("capturarRango") != null){

$("#daterangeFinanzas-btn span").html(localStorage.getItem("capturarRango"));

} else {
  $("#daterangeFinanzas-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha')
}



// /*=============================================
// TRAER VALORES DE PRESTAMO
// =============================================*/
$(".tablas tbody").on("click", "button.btnAgregarPago", function(){

  var idFinanza = $(this).attr("idFinanza");

  var datos = new FormData();
    datos.append("idFinanza", idFinanza);
    console.log("idFinanza", idFinanza);

     $.ajax({

      url:"ajax/finanzas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){


$pagos_totales = (respuesta["pagos_totales"]);
$pago_mensual = (respuesta["gasto_restante"]/respuesta["pagos_restantes"]).toFixed(1);
$pagos_restantes = (respuesta["pagos_restantes"]);
//$ultimoPago = (respuesta["pagos_restantes"]);
$gasto = (respuesta["gasto"]);
$gasto_restante = (respuesta["gasto_restante"]);

$concatenar = ("Pagos restantes "+$pagos_restantes+" de "+$pagos_totales);
console.log("concatenar", $concatenar);

//$monto_restante = ($pago_mensual*$pagos_restantes).toFixed(2);
//$pagado = (($gasto-$pagos_restantes).toFixed(2));
$pagado2 = ($gasto-$gasto_restante);
//$pagado2 = (($gasto/$pagos_restantes)*($pagos_totales-$pagos_restantes)).toFixed(2);

//$pendiente = (($pagos_restantes*$pago_mensual).toFixed(2));

//$montoTotal = ($pago_mensual*$pagos_totales);


$fechaSiguientePago = (respuesta["dia_pago"]);

$porcentajePagado = ("PAGADO " +(($pagado2*100)/$gasto).toFixed(1))+"%";
$porcentajePendiente = ("PENDIENTE " +(($gasto_restante*100)/$gasto).toFixed(1))+"%";


$pagoSolicitado = ("<h3><b>Pago solicitado: $ "+$pago_mensual+"</b></h3>");
//width: 30%


         
            $("#infoPago").html("<b>"+$pagado2+"</b>");
            $("#infoMeses").html($concatenar);
            $("#infoDeuda").html("<b>"+$gasto_restante+"</b>");
            $("#infoSiguientePago").html("Proximo pago el "+$fechaSiguientePago);
            $("#formaPago").html(respuesta["forma_pago"]);
            
            $("#usuarioId").val(respuesta["usuario"]);
            $("#conceptoId").val(respuesta["concepto"]);

            
            

            $("#infoPorcentaje").html($porcentajePagado);
          $("#infoPorcentajePendiente").html($porcentajePendiente);
          $("#infoPagoSolicitado").html($pagoSolicitado);
         
          $("#pagoMensual").val($pago_mensual);
          $("#idPago").val(respuesta["id"]);
			$("#pagosRestantes").val($pagos_restantes);
		
			$("#gastoRestante").val(respuesta["gasto_restante"]);
          

        




      }

  })

})  

  

