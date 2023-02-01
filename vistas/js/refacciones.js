/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

// $.ajax({

//  url: "ajax/datatable-productos.ajax.php",
//  success:function(respuesta){
    
//    console.log("respuesta", respuesta);

//  }

// })

$('.tablaRefacciones').DataTable( {
    "ajax": "ajax/datatable-refacciones.ajax.php",
    "ajax": "ajax/datatable-refacciones.ajax.php?idSucursal="+$(idSucursal).val()+"&perfilId="+$(perfilId).val(),
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
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
$("#nuevaCategoriaRefaccion").change(function(){ 

  var idCategoria = $(this).val();
  console.log("idCategoria", idCategoria);

  var numero = Math.floor(Math.random()*101);
  var numero2 = Math.floor(Math.random()*100);
  var numero3 = Math.floor(Math.random()*101);


  var nuevoCodigoRefaccion = idCategoria+numero+numero2+numero3;
  $("#nuevoCodigoRefaccion").val(nuevoCodigoRefaccion);


})



/*=============================================
IMPRIMIR ETIQUETA CODIGO
=============================================*/

$(".tablaRefacciones tbody").on("click", "button.btnEtiquetaRefaccion", function(){

  var idRefaccion = $(this).attr("idRefaccion");

  window.open("extensiones/tcpdf/pdf/etiquetaRefaccion.php?codigo="+idRefaccion, "_blank");

}) 



/*=============================================
EDITAR SECCION REFACCIONES
=============================================*/
$(".tablaRefacciones tbody").on("click", "button.btnSeccionRefaccion", function(){

  var idRefaccion = $(this).attr("idRefaccion");
  var seccionSeleccionada = $(this).attr("seccionSeleccionada");

  
  console.log("idRefaccion", idRefaccion);
  
    $("#idRefaccion").val(idRefaccion);
      $("#nuevaSeccion").val(seccionSeleccionada);
    

})

/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaRefacciones tbody").on("click", "button.btnEditarRefaccion", function(){

  var idRefaccionEditar = $(this).attr("idRefaccion");
  console.log("idRefaccion", idRefaccionEditar);
  
  var datos = new FormData();
    datos.append("idRefaccionEditar", idRefaccionEditar);

     $.ajax({

      url:"ajax/refacciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          console.log("idRefaccion", respuesta["codigo"]);
        

          // $("#editarCodigoRefaccion").val(respuesta["codigo"]);
           $("#editarEstadoRefaccion").val(respuesta["estado"]);
           $("#editarDescripcionRefaccion").val(respuesta["descripcion"]);
           $("#editarStockRefaccion").val(respuesta["stock"]);
           $("#idEditarRefaccion").val(respuesta["id"]);
           

      }

  })

})


/*=============================================
STOCK SUMAR
=============================================*/

$(".tablaRefacciones tbody").on("click", "button.btnStockRefaccion", function(){

  var idRefaccionEditar = $(this).attr("idRefaccion");
  console.log("idRefaccion", idRefaccionEditar);
  
  var datos = new FormData();
    datos.append("idRefaccionEditar", idRefaccionEditar);

     $.ajax({

      url:"ajax/refacciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          console.log("idRefaccion", respuesta["codigo"]);
           $("#stockEditarRefaccion").val(respuesta["stock"]);
           $("#idRefaccionEditar").val(respuesta["id"]);
           

      }

  })

})






/*=============================================
ELIMINAR PRODUCTO STOCK_SUCURSAL
=============================================*/

$(".tablaRefacciones tbody").on("click", "button.btnEliminarRefaccion", function(){

  var idRefaccionEliminar = $(this).attr("idRefaccion");
  
  console.log("idRefaccion", idRefaccionEliminar);
  
  
  
  swal({

    title: '¿Está seguro de borrar el producto?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar refaccion!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=refacciones&idRefaccionEliminar="+idRefaccionEliminar;

        }


  })

})







/*=============================================
EDITAR SECCION REFACCIONES
=============================================*/
$(".tablas").on("click", ".btnEditarSeccionRefacciones", function(){

  var idCategoria = $(this).attr("idCategoria");
  var editarSeccion = $(this).attr("editarSeccion");
  var editarCategoriaSeccion = $(this).attr("editarCategoriaSeccion");
  console.log("idCategoria", idCategoria);
  
    $("#editarSeccion").val(editarSeccion);
    $("#editarCategoriaSeccion").val(editarCategoriaSeccion);
    $("#idCategoria").val(idCategoria);

})

/*=============================================
ELIMINAR SECCION REFACCIONES
=============================================*/
// $(".tablas").on("click", ".btnEliminarSeccionRefacciones", function(){

//   var idSeccion = $(this).attr("idSeccion");
         
//    swal({
//     title: '¿Está seguro de borrar la seccion?',
//     text: "¡Si no lo está puede cancelar la acción!",
//     type: 'warning',
//     showCancelButton: true,
//     confirmButtonColor: '#3085d6',
//     cancelButtonColor: '#d33',
//     cancelButtonText: 'Cancelar',
//     confirmButtonText: 'Si, borrar seccion!'
//    }).then(function(result){

//     if(result.value){


//       window.location = "index.php?ruta=categorias-refacciones&idSeccion="+idSeccion;

//     }

//    })

// })





