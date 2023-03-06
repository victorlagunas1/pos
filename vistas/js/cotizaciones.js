/*=============================================
CARGAR LA TABLA DINÁMICA DE Reparaciones
=============================================*/

// $.ajax({

//  url: "ajax/datatable-Reparaciones.ajax.php",
//  success:function(respuesta){
    
//    console.log("respuesta", respuesta);



// })

$('.tablaCotizaciones').DataTable( {
    "ajax": "ajax/datatable-cotizaciones.ajax.php",
    "autoWidth": false,
    "pageLength" : 50,
     "columnDefs": [
    { "width": "10%", "targets": 7 },
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



$(".tablaCotizaciones tbody").on("click", "button.btnEditarCotizacion", function(){

  var idCotizacion = $(this).attr("idCotizacion");
  
  var datos = new FormData();
    datos.append("idCotizacion", idCotizacion);
    console.log("idCotizacion", idCotizacion);

     $.ajax({

      url:"ajax/cotizaciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          

            $("#editarMarca").val(respuesta["marca"]);
            $("#editarModelo").val(respuesta["modelo"]);
            $("#editarReparacion").val(respuesta["reparacion"]);
            $("#editarCosto").val(respuesta["costo"]);
            $("#editarComentario").val(respuesta["comentario"]);
            $("#editarID").val(respuesta["id"]);
  
      }

  })

})  


$(".tablaCotizaciones tbody").on("click", "button.btnExportarVistaModelo", function(){

  var idCotizacion = $(this).attr("idCotizacion");
  
  var datos = new FormData();
    datos.append("idCotizacion", idCotizacion);
    console.log("idCotizacion", idCotizacion);

     $.ajax({

      url:"ajax/cotizaciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        console.log(respuesta["marca"]);
          
            var marcaModelo = respuesta["marca"]+" "+respuesta["modelo"];
            //var comentarioPrecio = respuesta["comentario"]+" "+respuesta["costo"]; 
            
            $("#modeloExportar").html(marcaModelo);
            $("#reparacionExportarVM").html(respuesta["reparacion"]);

            
            $("#idCotizacionAnterior").val(respuesta["id"]);
            
            $("#nuevoPrecioCotizacion").val(respuesta["costo"]);
            $("#nuevoComentarioCotizacion").val(respuesta["comentario"]);
            //$("#marcaSeleccionada").val(respuesta["marca"]);
            

            
            
    
  
      }

  })

})  



$(document).on("click", ".btnEliminarCotizacion", function(){
  
  var idCotizacion = $(this).attr("idCotizacion");
  console.log("idCotizacionBorras", idCotizacion)

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

          window.location = "index.php?ruta=cotizaciones&idCotizacion="+idCotizacion;


        }


  })

})




/*=============================================
ACTUALIZAR REPARACION COTIZACION
=============================================*/
$(document).on("click", ".btnAceptarCotizacion", function(){

  var idCotizacionAceptar = $(this).attr("idCotizacion");
  console.log("idCotizacionAceptar", idCotizacionAceptar)


  var datos = new FormData();
  datos.append("idCotizacionAceptar", idCotizacionAceptar);

    
    $.ajax({

    url:"ajax/cotizaciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

    })

      //$(this).removeClass('btn-danger');
    //  $(this).addClass('btn-success');
      $(this).addClass('hidden');

     // $("button.btnEditarStock[idProducto='"+idCotizacionAceptar+"']").removeClass('btn-danger');
     //$("button.btnEditarStock[idProducto='"+idCotizacionAceptar+"']").addClass('btn-success');
     
  

})


$(document).on("click", ".btnCotizacionModelo", function(){

  var idModelo = $(this).attr("idModelo");
  
  window.location = "index.php?ruta=vista-modelo&idModelo="+idModelo;
  

}) 

/*=============================================
ACTUALIZAR REPARACION COTIZACION
=============================================*/
$(document).on("click", ".btnReparacionSelecc", function(){

  var idReparacionSelecc = $(this).attr("idReparacionSelecc");

   $("#idCotizacionVistaModelo").val(idReparacionSelecc);



  //var idModeloReparacion = $(this).attr("idModeloReparacion");
  

    var datos = new FormData();
    datos.append("idReparacionSelecc", idReparacionSelecc);
   //datos.append("idModeloReparacion", idModeloReparacion);
    
   // console.log("idModeloReparacion", idModeloReparacion);
    //console.log("idReparacionSelecc", idReparacionSelecc);

     $.ajax({

      url:"ajax/cotizaciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        // console.log("Sin", respuesta);
        
        
            var precio = "$ "+Number(respuesta["precio"]).toFixed(2);
            
            //$("#tituloReparaciones").html(respuesta["id_reparacion"]);
            $("#precioReparacion").html(precio);
           // $("#tiempoReparacion").html(respuesta["tiempo"]);
            $("#comentariosCotizacion").html(respuesta["comentario"]);
             


            //$("#resultsInput").val($("#resultsInput").val() + temp_string);

              // $("#nuevoModelo").val(respuesta["id_modelo"]);
              // $("#nuevoModelo").val(respuesta["id_reparacion"]);
               $("#nuevoPrecio").val(respuesta["precio"]);
               

               $("#idModeloReparacion").val(respuesta["id_modelo"]);
               $("#idReparacion").val(respuesta["id_reparacion"]);


               //EDITAR REPARACION MODAL
               $("#idReparacionEditarVM").val(respuesta["id"]);
                $("#reparacionCotizacionEditar").val(respuesta["id_reparacion"]);
               $("#editarTiempoCotizacion").val(respuesta["tiempo"]);
                $("#editarDisponibilidadCotizaciones").val(respuesta["id_dispo"]);
               $("#editarGarantiaCotizaciones").val(respuesta["id_garantia"]);
                $("#editarComentarioCotizacion").val(respuesta["comentario"]);
               //$("#editarSelectRiesgos").val(respuesta["riesgos"]);
                $("#editarPrecioCotizacion").val(respuesta["precio"]);

                
                if (respuesta["riesgos"] !== "" ){


                var riesgosSeleccionados = JSON.parse(respuesta["riesgos"]);
                $(".riesgosSelectEditar").val(riesgosSeleccionados).trigger('change');
                $(".riesgosSelectRecibirEquipo").val(riesgosSeleccionados).trigger('change');


                       } else {

                       $(".riesgosSelectEditar").val(0).trigger('change');  
                       $(".riesgosSelectRecibirEquipo").val(0).trigger('change');



                    }



  

              /*===== DATOS REPARACIONES_ID ===*/

               var datos2 = new FormData();
               datos2.append("idReparacion", respuesta["id_reparacion"]);


                $.ajax({

                  url:"ajax/cotizaciones.ajax.php",
                  method: "POST",
                  data: datos2,
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType:"json",
                  success:function(respuesta){
                     //console.log("Sin2", respuesta);
                    
                       // var precio = "$ "+Number(respuesta["precio"]);
                        
                        $("#tituloReparaciones").html(respuesta["reparacion"]);
                        $("#comentariosReparaciones").html(respuesta["descripcion"]);
                        $("#nuevoServicio").val(respuesta["reparacion"]);
                       
                        $("#editarNombreReparacion").html(respuesta["reparacion"]);
                      
                       
                       // $("#tiempoReparacion").html(respuesta["tiempo"]);
                        
                        //$("#precioReparacion").html(precio)
  
                          }

                      })

                /*===== DATOS REPARACIONES_GARANTIA ===*/

               var datos3 = new FormData();
               datos3.append("idGarantia", respuesta["id_garantia"]);
                console.log("garantia", respuesta["id_garantia"]);

                $.ajax({

                  url:"ajax/cotizaciones.ajax.php",
                  method: "POST",
                  data: datos3,
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType:"json",
                  success:function(respuesta){
                    //console.log("Sin3", respuesta);
                    
                       var garantia = respuesta["dias"] + " días de garantía. " + respuesta["condiciones"];
                        
                        $("#tituloGarantia").html(respuesta["garantia"]);
                        $("#condicionGarantia").html(garantia);
                        
                       
            
                          }

                      })

                
                /*===== DATOS REPARACIONES_DISPONIBILIDAD ===*/

               var datos4 = new FormData();
               datos4.append("idDispo", respuesta["id_dispo"]);
               // console.log("idDispo", respuesta["id_dispo"]);

                $.ajax({

                  url:"ajax/cotizaciones.ajax.php",
                  method: "POST",
                  data: datos4,
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType:"json",
                  success:function(respuesta){
                   
                    
                       if (respuesta["anticipo"] === "Si"){
                      var anticipo = "Se requiere anticipo.";
                     } else {
                      var anticipo = "";

                     }   
                        $("#tituloDispo").html(respuesta["disponibilidad"]);
                        $("#descripcionDispo").html(respuesta["descripcion"] +" <b>"+ anticipo) + "</b>";
                        
            
                          }


                      })


                /*===== DATOS REPARACIONES_RIESGOS ===*/

               // var riesgos1 = JSON.parse(respuesta["riesgos"]);
               //var riesgos1 = ('"foo";"faa"');

               if (respuesta["riesgos"] !== ""){

               var riesgos = JSON.parse(respuesta["riesgos"]);

              
               //let riesgos = ["1","2","3"];
               //var riesgos = JSON.stringify(respuesta["riesgos"]);
               
               //console.log(riesgos[0]);
                //console.log("Respuesta riesgos", riesgos);

               // const riesgos = respuesta["riesgos"];
                 // var miArray = ["2", "4", "6"];
                  //var miArray = respuesta["riesgos"];
                //miArray.forEach( function(valor, indice, array){
                  //console.log(indice, valor);

                //});

                $(".nuevoRiesgo").html(

                        ' <span class="lead"><b></b></span>' +
                        '<ul><dd></dd></ul>'
                        
                        
                            )

                for(var i = 0; i < riesgos.length; i++){


               var datos5 = new FormData();
               datos5.append("idRiesgo", riesgos[i]);

                $.ajax({

                  url:"ajax/cotizaciones.ajax.php",
                  method: "POST",
                  data: datos5,
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType:"json",
                  success:function(respuesta){
                   
                        //$("#tituloRiesgo").html(respuesta["riesgo"]);
                        //$("#descripcionRiesgo").html(respuesta["descripcion"]);

                        $(".nuevoRiesgo").append(

                        

                        ' <span class="lead"><b>'+respuesta["riesgo"]+'</b></span>' +
                        '<ul><dd>'+respuesta["descripcion"]+'</dd></ul>'
                        
                        
                            )




                          }






                      })



               }



             } else {
              $(".nuevoRiesgo").html(

                        ' <span class="lead"><b></b></span>' +
                        '<ul><dd></dd></ul>'
                        
                        
                            )
             }


                /*===== DATOS REPARACIONES_DISPONIBILIDAD ===*/

               var datos5 = new FormData();
               datos5.append("idTiempo", respuesta["tiempo"]);
               // console.log("idDispo", respuesta["id_dispo"]);

                $.ajax({

                  url:"ajax/cotizaciones.ajax.php",
                  method: "POST",
                  data: datos5,
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType:"json",
                  success:function(respuesta){
                   
                  
                        $("#tiempoReparacion").html(respuesta["tiempo"]);
            
                        
            
                          }


                      })


               // console.log("idDispo", respuesta["id_dispo"]);
             //}
             //console.log("Datos", datos5);

            // console.log("idRiesgos", datos5[1]);

                // $.ajax({

                //   url:"ajax/cotizaciones.ajax.php",
                //   method: "POST",
                //   data: datos5,
                //   cache: false,
                //   contentType: false,
                //   processData: false,
                //   dataType:"json",
                //   success:function(respuesta){
                   
                    
                //       })
            
      
      }

  })



})



$(document).on("click", ".btnRecibirEquipo", function(){

  var idReparacionSelecc = $(this).attr("idReparacionSelecc");
  
  //window.location = "index.php?ruta=vista-modelo&idModelo="+idModelo;
  //console.log("Sj se ejecuta", idReparacionSelecc);

}) 



$(document).on("click", ".btnEliminarCotizacionVistaModelo", function(){
  
  //var idBorrarCotizacion = $(this).attr("idModeloEliminar");
  

  var idCotizacionEliminar=document.getElementById("idCotizacionVistaModelo").value;
  var idModelo=document.getElementById("idModelo").value;

  
  console.log("idReparacionSelecc", idCotizacionEliminar);
   console.log("idmodelo", idModelo);
 // var idBorrarCotizacion = document.getElementById("idReparacionSelecc").value;
  //console.log("idmODELOBORRAR", idBorrarCotizacion);


 //console.log("idCoti", idBorrarCotizacion);
  //var idModelo = $(this).attr("idModelo");

  swal({


    title: '¿Está seguro de borrar la cotización?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cotizacion!'
        
        }).then(function(result){
        
        if (result.value) {

          window.location = "index.php?ruta=vista-modelo&idModelo="+idModelo+"&idCotizacionEliminar="+idCotizacionEliminar;


        }


  })


})



function copiarCotizacion() {
  var copyText = document.getElementById('nuevoServicio');
  //var copyText = "1";
  //console.log("copyText", copyText);
  copyText.select();
  //copyText.setSelectionRange(0,99999);
  document.execCommand('copy');
  //navigator.clipboard.writeText(copyText.value);
  alert("Cotizacion copiada al portapapeles "+copyText.value);


}


function copyToClickBoard(){
    var content = document.getElementById('nuevoServicio').innerHTML;

    navigator.clipboard.writeText(content)
        .then(() => {
        console.log("Text copied to clipboard...")
    })
        .catch(err => {
        console.log('Something went wrong', err);
    })
 
}



function ticketCotizacion() {
  var idReparacionCotizacion = document.getElementById("idCotizacionVistaModelo");
 
 window.open("extensiones/tcpdf/pdf/cotizacionReparacion2.php?codigo="+idReparacionCotizacion.value, "_blank");


}




//shortcut.add("F1", function() { alert("F1 pressed"); });





  

