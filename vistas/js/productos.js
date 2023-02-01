/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

// $.ajax({

//  url: "ajax/datatable-productos.ajax.php",
//  success:function(respuesta){
    
//    console.log("respuesta", respuesta);

//  }

// })

$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php",
    "ajax": "ajax/datatable-productos.ajax.php?idSucursal="+$(idSucursal).val()+"&perfilId="+$(perfilId).val(),
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
$("#nuevaCategoria").change(function(){

  var idCategoria = $(this).val();


  var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        if(!respuesta){   

          var nuevoCodigo = idCategoria+"001";
          $("#nuevoCodigo2").val(nuevoCodigo);


        }else{

          var nuevoCodigo = Number(respuesta["codigo"]) + 1;
            $("#nuevoCodigo2").val(nuevoCodigo);

        }
                
      }

    })

})



/*=============================================
CAPTURANDO EL ESTADO DE ESCANER PARA ASIGNAR CÓDIGO
=============================================*/
$("#escanerCodigo").change(function(){

  var idCategoria = $(this).val();
  var estado = $(this).val();

if (estado == 1){

  console.log("cambio check a 0");
  //$("#escanerCodigo").val(0);
  $("#escanerCodigo").val(0);
  
  $("#nuevoCodigo").prop('readonly',true);

} else {
   console.log("cambio check a 1");
  //$("#escanerCodigo").val(1);
   $("#escanerCodigo").val(1);

  $("#nuevoCodigo").prop('readonly',false);
  $("#nuevoCodigo").val("");
  
}
})





$("#nuevaDescripcion").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        // Do something
        console.log("Enter");
    }
});

/*=============================================
AGREGANDO PRECIO DE VENTA
=============================================*/
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){

  if($(".porcentaje").prop("checked")){

    var valorPorcentaje = $(".nuevoPorcentaje").val();
    
    var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

    var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly",true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly",true);

  }

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".nuevoPorcentaje").change(function(){

  if($(".porcentaje").prop("checked")){

    var valorPorcentaje = $(this).val();
    
    var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

    var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly",true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly",true);

  }

})

$(".porcentaje").on("ifUnchecked",function(){

  $("#nuevoPrecioVenta").prop("readonly",false);
  $("#editarPrecioVenta").prop("readonly",false);

})

$(".porcentaje").on("ifChecked",function(){

  $("#nuevoPrecioVenta").prop("readonly",true);
  $("#editarPrecioVenta").prop("readonly",true);

})

/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaImagen").change(function(){

  var imagen = this.files[0];
  
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

      $(".nuevaImagen").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 20000000){

      $(".nuevaImagen").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen no debe pesar más de 5MB!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else{

      var datosImagen = new FileReader;
      datosImagen.readAsDataURL(imagen);

      $(datosImagen).on("load", function(event){

        var rutaImagen = event.target.result;

        $(".previsualizar").attr("src", rutaImagen);

      })

    }
})

/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

  var idProducto = $(this).attr("idProducto");
  
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
          
          var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",respuesta["id_categoria"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#editarCategoria").val(respuesta["id"]);
                  $("#editarCategoria").html(respuesta["categoria"]);

              }

          })

           $("#editarCodigo").val(respuesta["codigo"]);

           $("#editarDescripcion").val(respuesta["descripcion"]);

           //$("#editarStock").val(respuesta["stock"]);

           $("#editarPrecioCompra").val(respuesta["precio_compra"]);

           $("#editarPrecioVenta").val(respuesta["precio_venta"]);

           $("#editarPrecioPlaza").val(respuesta["precio_plaza"]);

           if(respuesta["imagen"] != ""){

            $("#imagenActual").val(respuesta["imagen"]);

            $(".previsualizar").attr("src",  respuesta["imagen"]);

           }

      }

  })

})




$(".tablaProductos tbody").on("click", "button.btnEtiquetaProducto", function(){

  var idProducto = $(this).attr("idProducto");
    var idSucursal = $(this).attr("idSucursal");

  //var modelo = $(this).attr("modeloRecibido");
  //console.log("modeloRecibido", modelo);

 // if(modelo != "0"){
  window.open("extensiones/tcpdf/pdf/etiquetaProductoBarcode.php?codigo="+idProducto+"&"+"suc="+idSucursal, "_blank");
      

  // } else {

  //   window.open("extensiones/tcpdf/pdf/etiquetaProductoBarcodeSin.php?codigo="+idProducto, "_blank");
  
  // }

  


}) 






/*=============================================
ELIMINAR PRODUCTO STOCK_SUCURSAL
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto2", function(){


 
  var idProductoSucursal = $(this).attr("idProductoSucursal");
  
  console.log("idProductoSucursal", idProductoSucursal);
  
  
  
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

          window.location = "index.php?ruta=productos&idProductoSucursal="+idProductoSucursal;

        }


  })

})





// /*=============================================
// CAPTURANDO MARCA PARA MOSTRAR MODELO
// =============================================*/
// $("#marcaSeleccionada").change(function(){

//   var id_marca = $(this).val();
//   console.log("idMarca", id_marca);
//   console.log("sucursal", idSucursal);

  

//   var id_sucursal = $(idSucursal).val();
//   var perfil_id = $(perfilId).val();
//   console.log("sucursalID", id_sucursal);
// console.log("perfilId", perfil_id);
  



//   var datos = new FormData();
//   datos.append("idSucursal", id_sucursal);

//      $.ajax({


//       url:"ajax/productos.ajax.php",
//       method: "POST",
//       data: datos,
//       cache: false,
//       contentType: false,
//       processData: false,
//       dataType:"json",
//       success:function(respuesta){

// console.log("respuesta",respuesta);
//   var idSucursal = id_marca;
//   window.location = "index.php?ruta=productos&idSucursal="+id_sucursal;


//       }

//     })



          
        
//    //$("#variableSession").val(id_marca);
//     $("#idMarcaModelo").val(id_marca);


    

      

// })


/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarStock", function(){

  var stockActual = $(this).attr("stockActual");
  var sucursal = $(this).attr("sucursal");
  var codigoProducto = $(this).attr("codigoProducto");
  console.log("codigoProducto", codigoProducto);
  
  var id = $(this).attr("id");
  console.log("id", id);
  
  

     $("#stockProductoEditar").val(stockActual);
     $("#stockActual").val(stockActual);
     $("#codigoProductos").val(codigoProducto);
      $("#idStock").val(id);
     

     

    
})
  



