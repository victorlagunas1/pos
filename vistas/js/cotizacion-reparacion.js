

/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablas tbody").on("click", "button.btnEditarReparacionConfig", function(){

  var idReparacion = $(this).attr("idReparacion");
  console.log(idReparacion);

  
  var datos = new FormData();
    datos.append("idReparacion", idReparacion);

     $.ajax({

      url:"ajax/reparaciones-configuracion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
            console.log(respuesta);

            $("#editarReparacion").val(respuesta["reparacion"]);
            $("#idReparacionEditar").val(respuesta["id"]);
            $("#editarComentario").val(respuesta["descripcion"]);

      }

  })

})  

/*=============================================
BORRAR REPARACION CONFIGURACION 
=============================================*/

$(document).on("click", ".btnEliminarReparación", function(){
  
  var idReparacion = $(this).attr("idReparacion");
  console.log("idReparacionBorras", idReparacion)

  swal({

    title: '¿Está seguro de borrar la reparación?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar reparación!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=reparaciones-configuracion&idReparacion="+idReparacion;


        }


  })

})


/*=============================================
EDITAR RIESGOS
=============================================*/

$(".tablas tbody").on("click", "button.btnEditarRiesgo", function(){

  var idRiesgo = $(this).attr("idRiesgo");

  //console.log(idRiesgo);

  
  var datos = new FormData();
    datos.append("idRiesgo", idRiesgo);

     $.ajax({

      url:"ajax/reparaciones-configuracion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
            //console.log(respuesta);

            $("#editarRiesgo").val(respuesta["riesgo"]);
            $("#editarDescripcionRiesgo").val(respuesta["descripcion"]);
            $("#idRiesgo").val(respuesta["id"]);

      }

  })

})  


/*=============================================
BORRAR RIESGO CONFIGURACION 
=============================================*/

$(document).on("click", ".btnEliminarRiesgo", function(){
  
  var idRiesgo = $(this).attr("idRiesgo");
  console.log("idRiesgoBorras", idRiesgo)

  swal({

    title: '¿Está seguro de borrar el riesgo?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar riesgo!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=reparaciones-configuracion&idRiesgo="+idRiesgo;


        }


  })

})



/*=============================================
EDITAR DISPONIBILIDAD
=============================================*/

$(".tablas tbody").on("click", "button.btnEditarDisponibilidad", function(){

  var idDisponibilidad = $(this).attr("idDisponibilidad");
 // console.log(idDisponibilidad);

  
  var datos = new FormData();
    datos.append("idDisponibilidad", idDisponibilidad);

     $.ajax({

      url:"ajax/reparaciones-configuracion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
            //console.log(respuesta);

            $("#editarDisponibilidad").val(respuesta["disponibilidad"]);
            $("#editarDescripcionDisponibilidad").val(respuesta["descripcion"]);
            $("#idDisponibilidad").val(respuesta["id"]);

      }

  })

})  

/*=============================================
BORRAR REPARACION CONFIGURACION 
=============================================*/

$(document).on("click", ".btnEliminarDisponibilidad", function(){
  
  var idDisponibilidad = $(this).attr("idDisponibilidad");
  console.log("idDisponibilidadBorras", idDisponibilidad)

  swal({

    title: '¿Está seguro de borrar la disponibilidad?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar disponibilidad!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=reparaciones-configuracion&idDisponibilidad="+idDisponibilidad;


        }


  })

})



/*=============================================
EDITAR GARANTIA
=============================================*/

$(".tablas tbody").on("click", "button.btnEditarGarantia", function(){

  var idGarantia = $(this).attr("idGarantia");
  console.log(idGarantia);

  
  var datos = new FormData();
    datos.append("idGarantia", idGarantia);

     $.ajax({

      url:"ajax/reparaciones-configuracion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
            console.log(respuesta);

            $("#editarGarantia").val(respuesta["garantia"]);
            $("#editarGarantiaDescripcion").val(respuesta["condiciones"]);
            $("#editarGarantiaDias").val(respuesta["dias"]);
            $("#idGarantia").val(respuesta["id"]);

      }

  })

}) 

/*=============================================
BORRAR REPARACION CONFIGURACION 
=============================================*/

$(document).on("click", ".btnEliminarGarantia", function(){
  
  var idGarantia = $(this).attr("idGarantia");
  

  swal({

    title: '¿Está seguro de borrar la garantía?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar garantía!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=reparaciones-configuracion&idGarantia="+idGarantia;


        }


  })

})



/*=============================================
EDITAR TIEMPO
=============================================*/

$(".tablas tbody").on("click", "button.btnEditarTiempo", function(){

  var idTiempo = $(this).attr("idTiempo");
  console.log(idTiempo);

  
  var datos = new FormData();
    datos.append("idTiempo", idTiempo);

     $.ajax({

      url:"ajax/reparaciones-configuracion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
            console.log(respuesta);

            
            $("#editarTiempo").val(respuesta["tiempo"]);
            $("#idTiempo").val(respuesta["id"]);

      }

  })

}) 

/*=============================================
BORRAR tiempo CONFIGURACION 
=============================================*/

$(document).on("click", ".btnEliminarTiempo", function(){
  
  var idTiempo = $(this).attr("idTiempo");
  

  swal({

    title: '¿Está seguro de borrar el tiempo?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar tiempo!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=reparaciones-configuracion&idTiempo="+idTiempo;


        }


  })

})





/*=============================================
EDITAR ESTADO
=============================================*/

$(".tablas tbody").on("click", "button.btnEditarEstado", function(){

  var idEstado = $(this).attr("idEstado");
  console.log(idEstado);

  
  var datos = new FormData();
    datos.append("idEstado", idEstado);

     $.ajax({

      url:"ajax/reparaciones-configuracion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
            console.log(respuesta);

            $("#editarEstado").val(respuesta["estado"]);
            $("#editarDescripcionEstado").val(respuesta["descripcion"]);
            $("#idEstado").val(respuesta["id"]);

      }

  })

}) 

/*=============================================
BORRAR ESTADO CONFIGURACION 
=============================================*/

$(document).on("click", ".btnEliminarEstado", function(){
  
  var idEstado = $(this).attr("idEstado");
  

  swal({

    title: '¿Está seguro de borrar el estado?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar estado!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=reparaciones-configuracion&idEstado="+idEstado;


        }


  })

})



/*=============================================
REVISAR SI REPARACION YA EXISTE REGISTRADO
=============================================*/

$("#reparacionCotizacion").change(function(){

  $(".alert").remove();

  var idreparacion = $(this).val();
  
  var idModelo=document.getElementById("idModeloCotizacion").value;
  //console.log("IDMODELO", idModelo);


  var datos = new FormData();
  datos.append("validarReparacion", idreparacion);
  datos.append("id_modelo", idModelo);

   $.ajax({
      url:"ajax/cotizaciones.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){
        
        if(respuesta){

          $("#reparacionCotizacion").parent().after('<div class="alert alert-warning">Esta reparación ya existe en la base de datos</div>');

          $("#reparacionCotizacion").val("");

        }

      }

  })
})




