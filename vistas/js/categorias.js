/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarCategoria", function(){

	var idCategoria = $(this).attr("idCategoria");

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);
  console.log("idCategoria", idCategoria);

	$.ajax({
		url: "ajax/categorias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarCategoria").val(respuesta["categoria"]);
     		$("#idCategoria").val(respuesta["id"]);
        $("#editarDiasGarantia").val(respuesta["dias_garantia"]);

        

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarCategoria", function(){

	 var idCategoria = $(this).attr("idCategoria");

	 swal({
	 	title: '¿Está seguro de borrar la categoría?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar categoría!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

	 	}

	 })

})

/*=============================================
EDITAR MARCAS
=============================================*/
$(".tablas").on("click", ".btnEditarMarca", function(){

  var idMarcaEditar = $(this).attr("idMarcaEditar");

  var datos = new FormData();
  datos.append("idMarcaEditar", idMarcaEditar);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){

        $("#editarMarca").val(respuesta["marca"]);
        $("#idMarcaEditar").val(respuesta["id"]);

        console.log("idMarcaEditar", idMarcaEditar);
        console.log(respuesta["marca"]);

      }

  })


})

/*=============================================
ELIMINAR MARCAS
=============================================*/
$(".tablas").on("click", ".btnEliminarMarca", function(){

   var idMarcaEditar = $(this).attr("idMarcaEditar");

   swal({
    title: '¿Está seguro de borrar la marca?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar marca!'
   }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=marca-modelos&idMarcaEditar="+idMarcaEditar;

    }

   })

})


/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
$("#seleccionMarca").change(function(){

  var idMarca = $(this).val();

  var datos = new FormData();
    datos.append("idMarca", idMarca);


    $.ajax({

      url:"ajax/categorias.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        if(!respuesta){

          var nuevoCodigo = idMarca+"001";
          $("#nuevoCodigo").val(nuevoCodigo);
          console.log("datos", idMarca);

        }else{
          console.log("datos", idMarca);
          var nuevoCodigo = Number(respuesta["codigo"]) + 1;
            $("#nuevoCodigo").val(nuevoCodigo);
            

        }
                
      }

    })

})

/*=============================================
CAPTURANDO EL ESTADO DE ESCANER PARA ASIGNAR CÓDIGO
=============================================*/
$("#escanerCodigo2").change(function(){

  var idCategoria = $(this).val();
  var estado = $(this).val();

if (estado == 1){

  console.log("cambio check a 0");
  $("#escanerCodigo2").val(0);
  
  $("#nuevoCodigo2").prop('readonly',true);

} else {
   console.log("cambio check a 1");
  $("#escanerCodigo2").val(1);
  $("#nuevoCodigo2").prop('readonly',false);
  $("#nuevoCodigo2").val("");
  
}
})


/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaImagenModelo").change(function(){

  var imagen = this.files[0];
  
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

      $(".nuevaImagenModelo").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 2000000){

      $(".nuevaImagenModelo").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen no debe pesar más de 2MB!",
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
EDITAR MODELOS
=============================================*/
$(".tablas").on("click", ".btnEditarModelo", function(){

  var idModeloEditar = $(this).attr("idModeloEditar");

  var datos = new FormData();
  datos.append("idModeloEditar", idModeloEditar);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){

        $("#editarMarcaModelo").val(respuesta["id_marca"]);
         $("#editarModelo").val(respuesta["modelo"]);
         $("#editarCodigo").val(respuesta["codigo"]);
        $("#editarImagenModelo").val(respuesta["imagen"]);
        $("#idModeloEditar2").val(respuesta["id"]);


        

        console.log("idModeloEditar", idModeloEditar);
        console.log(respuesta["modelo"]);
         

         if(respuesta["imagen"] != ""){

            $("#imagenActual").val(respuesta["imagen"]);

            $(".previsualizar").attr("src",  respuesta["imagen"]);

           }

      }

  })

})






/*=============================================
ELIMINAR MODELO
=============================================*/
$(".tablas").on("click", ".btnEliminarModelo", function(){

   var idModeloEditar = $(this).attr("idModeloEditar");

   swal({
    title: '¿Está seguro de borrar el modelo?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar modelo!'
   }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=marca-modelos&idModeloEditar="+idModeloEditar;

    }

   })

})


/*=============================================
INFORMACION MODELO
=============================================*/

$(".tablas").on("click", ".btnVerModelo", function(){

  var idModeloEditar = $(this).attr("idModeloEditar");

  var datos = new FormData();
  datos.append("idModeloEditar", idModeloEditar);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){

        var ruta = respuesta["imagen"];
        var preRuta = 'src="';
        var coma = '"';
        var compuesto = preRuta+ruta+coma;

        var compuesto2 = ' <td><img src="'+ruta+'" class="img-thumbnail" width="400px"></td>';

        console.log(compuesto)

        $("#infoModelo").html(respuesta["modelo"]);
         $("#infoCodigo").html(respuesta["codigo"]);
         
         $("#modeloObtener").html(respuesta["codigo"]);
    
          $("#infoImagen").html(compuesto2);
          console.log(compuesto2);
          console.log("imagen", respuesta["imagen"]);


          
          var datosMarca = new FormData();
          datosMarca.append("idMarcaEditar",respuesta["id_marca"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosMarca,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#infoMarca").html(respuesta["marca"]);


                  console.log("infoMarca",respuesta["marca"]);
                  

              }

          })


         

        console.log("idModeloEditar", idModeloEditar);
        console.log(respuesta["modelo"]);

      }

  })


})


/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
$("#nuevaCategoria2").change(function(){

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
          $("#nuevoCodigo").val(nuevoCodigo);

        }else{

          var nuevoCodigo = Number(respuesta["codigo"]) + 1;
            $("#nuevoCodigo").val(nuevoCodigo);

        }
                
      }

    })

})


/*=============================================
CAPTURANDO EL ESTADO DE ESCANER PARA ASIGNAR CÓDIGO
=============================================*/
$("#escanerCodigo2").change(function(){

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




/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnAgregarProductoCat", function(){

  var idCategoria = $(this).attr("idCategoria");

  var datos = new FormData();
  datos.append("idCategoria", idCategoria);
  //console.log("respueata", idCategoria);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){

        //console.log("respueataid", respuesta["categoria"]);
        
        $("#nuevaCategoria1").val(respuesta["id"]);
        $("#nuevaCategoria2").val(respuesta["categoria"]);



      }

  })

  
  var idCategoria2 = $(this).attr("idCategoria2");


  var datos = new FormData();
    datos.append("idCategoria", idCategoria2);

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
          console.log(respuesta);

        }else{

          var nuevoCodigo = Number(respuesta["codigo"]) + 1;
            $("#nuevoCodigo2").val(nuevoCodigo);

        }

        $("#nuevoPrecioCompra2").val(respuesta["precio_compra"]);
        $("#nuevoPrecioPlaza2").val(respuesta["precio_plaza"]);
        $("#nuevoPrecioVenta2").val(respuesta["precio_venta"]);       
      }

    })





})




/*=============================================
EDITAR COLOR
=============================================*/
$(".tablas").on("click", ".btnEditarColor", function(){

  var idDiseño = $(this).attr("idDiseño");

  var datos = new FormData();
  datos.append("idDiseño", idDiseño);
  console.log("idDiseño", idDiseño);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){
        console.log("Funciona", respuesta["diseño"]);

        $("#editarColor").val(respuesta["diseño"]);
        $("#idColorEditar").val(respuesta["id"]);

      }

  })


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarCategoria", function(){

   var idCategoria = $(this).attr("idCategoria");

   swal({
    title: '¿Está seguro de borrar la categoría?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar categoría!'
   }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

    }

   })

})



/*=============================================
ELIMINAR CATEGORIA REFACCIONES
=============================================*/
$(".tablas").on("click", ".btnEliminarColor", function(){

   var idDiseño = $(this).attr("idDiseño");
         console.log("idDiseño", idDiseño);
   
   swal({
    title: '¿Está seguro de borrar el diseño?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar color!'
   }).then(function(result){

    if(result.value){


      window.location = "index.php?ruta=categorias&idDiseño="+idDiseño;

    }

   })

})




/*=============================================
EDITAR CATEGORIA REFACCIONES
=============================================*/
$(".tablas").on("click", ".btnEditarCategoriaRefacciones", function(){

  var idCategoriaRefacciones = $(this).attr("idCategoriaRefacciones");

  var datos = new FormData();
  datos.append("idCategoriaRefacciones", idCategoriaRefacciones);
  console.log("idCategoriaRefacciones", idCategoriaRefacciones);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){

        $("#editarCategoriaRefacciones").val(respuesta["categoria"]);
        $("#editarSeccionRefacciones").val(respuesta["seccion"]);
        $("#idCategoriaRefacciones").val(respuesta["id"]);
        

      }

  })


})

$(".tablas tbody").on("click", "button.btnEtiquetaSeccion", function(){

  var idCategoriaRefacciones = $(this).attr("idCategoriaRefacciones");
  console.log("id", idCategoriaRefacciones);
 
  window.open("extensiones/tcpdf/pdf/etiquetaSeccion.php?codigo="+idCategoriaRefacciones, "_blank");
      
}) 





/*=============================================
SUBIENDO LA FOTO PROMOCIONAL
=============================================*/
$(".nuevoPromocionFoto").change(function(){

  var imagen = this.files[0];
  
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

      $(".nuevoPromocionFoto").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 2000000){

      $(".nuevoPromocionFoto").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen no debe pesar más de 2MB!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else{

      var datosImagen = new FileReader;
      datosImagen.readAsDataURL(imagen);

      $(datosImagen).on("load", function(event){

        var rutaImagen = event.target.result;

        $(".previsualizarPromocional").attr("src", rutaImagen);

      })

    }
})


/*=============================================
ACTIVAR STATUS PROMOCIONAL
=============================================*/
$(document).on("click", ".btnActivarPromocional", function(){

  var idPromocion = $(this).attr("idPromocion");
  var estadoPromocional = $(this).attr("estadoPromocional");
  

  var datos = new FormData();
  datos.append("idPromocion", idPromocion);
  datos.append("estadoPromocional", estadoPromocional);
  
  //console.log(estadoPromocional);
  //console.log(idPromocion);

  $.ajax({

    url:"ajax/promocionales.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

          console.log(respuesta);

      }

    })

    if(estadoPromocional == 0){

      $(this).removeClass('btn-success');
      $(this).addClass('btn-danger');
      $(this).html('Desactivado');
      $(this).attr('estadoPromocional',1);

    }else{

      $(this).addClass('btn-success');
      $(this).removeClass('btn-danger');
      $(this).html('Activado');
      $(this).attr('estadoPromocional',0);

    }

})

/*=============================================
ELIMINAR PROMOCIONAL
=============================================*/
$(document).on("click", ".btnEliminarPromocional", function(){

  var idPromocion = $(this).attr("idPromocion");
  var fotoPromocional = $(this).attr("fotoPromocional");

  swal({
    title: '¿Está seguro de borrar el promocional?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar promocional!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=promocionales&idPromocion="+idPromocion+"&fotoPromocional="+fotoPromocional;

    }

  })

})















