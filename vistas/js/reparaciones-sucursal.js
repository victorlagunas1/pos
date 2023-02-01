/*=============================================
CARGAR LA TABLA DINÁMICA DE Reparaciones
=============================================*/

// $.ajax({

//url: "ajax/datatable-reparaciones.ajax.php",
//success:function(respuesta){
    
//console.log("respuesta", respuesta);

//}

//})

$('.tablaReparacionesSucursal').DataTable( {
    "ajax": "ajax/datatable-reparaciones-sucursal.ajax.php",
    "ajax": "ajax/datatable-reparaciones-sucursal.ajax.php?idSucursal="+$(idSucursal).val(),
    "deferRender": true,
    "pageLength" : 50,
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
EDITAR REPARACION
=============================================*/


$(".tablaReparacionesSucursal tbody").on("click", "button.btnInfoReparacion", function(){

  var idReparacion = $(this).attr("idReparacion");
  console.log("id",idReparacion);

  
  var datos = new FormData();
    datos.append("idReparacion", idReparacion);

     $.ajax({

      url:"ajax/reparaciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          

            $("#infoNombre").html(respuesta["nombre"]);
           // $("#infoCodigo").html(respuesta["id_mix"]);
            $("#infoModelo").html(respuesta["modelo"]);
            $("#infoFecha").html(respuesta["fecha"]);
            $("#infoTelefono").html(respuesta["telefono"]);
            $("#infoMarca").html(respuesta["marca"]);
            $("#infoColor").html(respuesta["color"]);
            $("#infoSerie").html(respuesta["serie_imei"]);
            $("#infoPass").html(respuesta["pass"]);
            $("#infoComentarios").html(respuesta["comentarios"]);
            $("#infoServicio").html(respuesta["servicio"]);
            $("#infoPrecio").html(respuesta["precio"]);
            $("#infoVigencia").html(respuesta["vigencia_garantia"]);
            $("#infoNotaReparacion").html(respuesta["nota_reparacion"]);
            $("#infoRecibido").html(respuesta["recibido_usuario"]);
            $("#infoEntregado").html(respuesta["entregado_usuario"]);
            $("#infoHistorial").html(respuesta["historial"]);
            $("#infoRespuestaCliente").html(respuesta["respuesta_cliente"]);
            $("#infoNotaGarantia").html(respuesta["nota_garantia"]);
          


            
            $("#idReparacion").html(respuesta["id"]);
             $("#idReparacion2").html(respuesta["id"]);

           $("#editarNombre").val(respuesta["nombre"]);

           $("#editarTelefono").val(respuesta["telefono"]);

            $("#editarMarca").val(respuesta["marca"]);

           

            
            $("#editarModelo").val(respuesta["modelo"]);

           
            $("#editarServicio").val(respuesta["servicio"]);

           $("#editarColor").val(respuesta["color"]);

           $("#editarPass").val(respuesta["pass"]);

           $("#editarColor").val(respuesta["color"]);

           $("#editarSerie").val(respuesta["serie_imei"]);

           $("#editarPrecio").val(respuesta["precio"]);

            $("#editarComentario").val(respuesta["comentarios"]);

            $("#editarIdReparacion").val(respuesta["id"]);


            if (respuesta["riesgos"] !== "" ){


                var riesgosSeleccionados = JSON.parse(respuesta["riesgos"]);
                $(".riesgosSelectEditarReparacion").val(riesgosSeleccionados).trigger('change');


                  } else {

                       $(".riesgosSelectEditarReparacion").val(0).trigger('change');


                    }

          

            $("#anctipoDescripcion").html(respuesta["servicio"]);

            $precio1 = Number(respuesta["precio"]);
            $anticipo = Number(respuesta["anticipo"]);
            $precio2 = ("Total: $ "+($precio1-$anticipo).toFixed(2));

            $("#anticipoIncial").html($precio2);

           
            $descripcion = ("MIX0" + respuesta["id"] + " " + respuesta["nombre"]);
            $("#anticipoId").html($descripcion);

             $("#idReparacionAnticipo").val(respuesta["id"]);
            $("#historialAnticipo").val(respuesta["historial"]);

            



      }

  })

})  


$(".tablaReparacionesSucursal tbody").on("click", "button.btnEntregar", function(){

  var idReparacion = $(this).attr("idReparacion");

  
  var datos = new FormData();
    datos.append("idReparacion", idReparacion);

     $.ajax({

      url:"ajax/reparaciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){



  $precio1 = Number(respuesta["precio"]);
   $anticipo = Number(respuesta["anticipo"]);

   $total = Number($precio1-$anticipo);
 
console.log("precio1", $precio1);
$precio2 = ("$ "+($precio1-$anticipo).toFixed(2));
$anticipo2 = ("Anticipo: $ "+($anticipo).toFixed(2));
console.log("precio1", $precio2);


          $("#importeTotal").html($precio2);
          $("#anticipoTotal").html($anticipo2);
          $("#importeTotal2").val($total);
         

          $("#servicioRealizado").html(respuesta["servicio"]);
          



            }

  })

})  






/*=============================================
ID ACTUALIZAR ESTADO
=============================================*/

$(".tablaReparacionesSucursal tbody").on("click", "button.btnStadoReparacion", function(){

  var idReparacion = $(this).attr("idStatusReparacion");
console.log("idStatusReparacion", idReparacion);

var datos = new FormData();
    datos.append("idReparacion", idReparacion);


     $.ajax({

      url:"ajax/reparaciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          

            $("#editarStatus").val(respuesta["status"]);
            $("#actualizarId").val(respuesta["id"]);
            $("#comentario1").val(respuesta["historial"]);
            
            console.log("datos", respuesta["nombre"]);




      }

  })

}) 

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablaReparacionesSucursal tbody").on("click", "button.btnImprimirPDF", function(){

  var idReparacion = $(this).attr("idReparacion");

  window.open("extensiones/tcpdf/pdf/notaReparacion.php?codigo="+idReparacion, "_blank");

}) 



$(".tablaReparacionesSucursal tbody").on("click", "button.btnImprimirBarcode", function(){

  var idReparacion = $(this).attr("idReparacion");

  window.open("extensiones/tcpdf/pdf/etiqueta.php?codigo="+idReparacion, "_blank");


}) 

$(".tablaReparacionesSucursal tbody").on("click", "button.btnImprimirTicket", function(){

  var idReparacion = $(this).attr("idReparacion");

  window.open("extensiones/tcpdf/pdf/ticketReparacion.php?codigo="+idReparacion, "_blank");


}) 





$(".tablaReparacionesSucursal tbody").on("click", "button.btnEntregar", function(){

  var idReparacion = $(this).attr("idReparacion");

  var datos = new FormData();
    datos.append("idReparacion", idReparacion);
    console.log("idReparacion", idReparacion);

     $.ajax({

      url:"ajax/reparaciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

         
            $("#idReparacionEntrega").val(respuesta["id"]);

            $("#modeloEntregado").val(respuesta["marca"]+" "+respuesta["modelo"]);
            $("#comentario2").val(respuesta["historial"]);




      }

  })

})  


$(".tablaReparacionesSucursal tbody").on("click", "button.btnActualizarPrecio", function(){

  var idReparacionPrecio = $(this).attr("idReparacionPrecio");
  var precioActual = "$" + $(this).attr("precioActual");
  var modeloActual = $(this).attr("marcaActual") +" "+ $(this).attr("modeloActual");
  var servicioActual = $(this).attr("servicioActual");
    

  
  console.log("precioActual", precioActual);
      
   $("#importeActual").html(precioActual);
   $("#modeloActual").html(modeloActual);
   $("#importeActual").html(precioActual);
   $("#servicioActual").html(servicioActual);
   $("#editarServicioPrecio").val(servicioActual);
   $("#idReparacionPrecio").val(idReparacionPrecio);
  $("#importeActual2").val(precioActual);
   


     var datos = new FormData();
    datos.append("idReparacion", idReparacionPrecio);
    console.log("idReparacion", idReparacionPrecio);

     $.ajax({

      url:"ajax/reparaciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        
            $("#historialCompleto").val(respuesta["historial"]);




      }

  })



})  

