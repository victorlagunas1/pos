/*=============================================
ACTIVAR USUARIO
=============================================*/
$(document).on("click", ".btnActivarEtiqueta", function(){

	var idScursalEtiqueta = $(this).attr("idScursalEtiqueta");
	var estadoEtiqueta = $(this).attr("estadoEtiqueta");
	
	console.log(estadoEtiqueta);
	console.log(idScursalEtiqueta);

	var datos = new FormData();
 		datos.append("activarIdSucursal", idScursalEtiqueta);
  	datos.append("activarEtiqueta", estadoEtiqueta);

  	$.ajax({

	  url:"ajax/categorias.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      
      }

  	})

  	if(estadoEtiqueta == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoEtiqueta',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoEtiqueta',0);

  	}

})
