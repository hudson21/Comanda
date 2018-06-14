/*======================================
CAPTURA DE RUTA         
========================================*/

var rutaActual = location.href; //Aquí estamos tomando la ruta actual con la propiedad de location.href

$(".btnIngreso, .facebook, .google ").click(function(){

localStorage.setItem("rutaActual", rutaActual);/*De esta manera estamos alamacenando en el localStorage del navegador la ruta actual
											    de donde se encuentra el usuario actualmente*/
})


/*======================================
FORMATEAR LOS INPUTS         
========================================*/

$("input").focus(function(){

	$(".alert").remove();//Cuando se esté arriba de cualquier input y se esté escribiendo se removerán las alertas que estén en la pantalla
	$(".errores").remove();
})

$("#seleccionarBar").change(function(){ 

   $(".alert").remove();
})


/*======================================
VALIDAR EMAIL REPETIDO          
========================================*/

var validarUsuarioRepetido = false;

$("#regNickname").change(function(){

	var usuario = $("#regNickname").val();
	var datos = new FormData();

	datos.append("validarUsuario", usuario);

	$.ajax({
		
		url:rutaOculta+"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success:function(respuesta){

			//console.log("respuesta",respuesta);

			if(respuesta == "false"){ //Si respuesta es false

				$(".alert").remove();
				validarUsuarioRepetido = false;

			}else{//Si es verdadero
		
				$("#regNickname").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> El nombre de usuario ya existe en la base de datos, por favor ingrese otro diferente</div>');	
			
				validarUsuarioRepetido = true;
			}
			
		}

	 })

})


/*=============================================================================================================
VALIDAR EL REGISTRO DEL USUARIO          
===============================================================================================================*/
function registroUsuario(){
	/*============================================================
	VALIDAR EL NOMBRE        
	==============================================================*/
	var nombre = $("#regUsuario").val();

	if(nombre != ""){

		var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

		if(!expresion.test(nombre)){ //Sino cumple con la edxpresión regular

			$("#regUsuario").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten número ni caracteres especiales</div>');
			
			return false;
		}

	}else{

		$("#regUsuario").parent().after('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');
		
		return false;

	}

	/*============================================================
	VALIDAR EL NOMBRE DE USUARIO        
	==============================================================*/

	var nickname = $("#regNickname").val();

	if(nickname != ""){

		var expresion = /^[a-zA-Z0-9]*$/;

		if(!expresion.test(nickname)){ //Sino cumple con la edxpresión regular

			$("#regNickname").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales en el nombre de usuario</div>');
			
			return false;
		}

		if(validarUsuarioRepetido){ //Si validarUsuarioRepetido es igual a true o verdadero

			$("#regNickname").parent().after('<div class="alert alert-danger"><strong>ERROR:</strong> El nombre de usuario ya existe en la base de datos, por favor ingrese otro diferente</div>');

			return false;
		}

	}else{

		$("#regNickname").parent().after('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');
		
		return false;

	}

	/*============================================================
	VALIDAR CONTRASEÑA      
	==============================================================*/

	var password = $("#regPassword").val();

	if(password != ""){

		var expresion = /^[a-zA-Z0-9]*$/;

		if(!expresion.test(password)){ //Sino cumple con la edxpresión regular

			$("#regPassword").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>');
			
			return false;
		}

	}else{

		$("#regPassword").parent().after('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');
		
		return false;

	}

	/*============================================================
	VALIDAR EL SELECT DEL BAR         
	==============================================================*/

	if($("#seleccionarBar").val() == ""){

		$("#seleccionarBar").after('<div class="alert alert-warning">No ha seleccionado el Bar</div>');

		return false;

	}
	
	/*============================================================
	VALIDAR POLÍTICAS DE PRIVACIDAD         
	==============================================================*/
	/*var politicas = $("#regPoliticas:checked").val();

	if(politicas != "on"){

		$("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Debe aceptar nuestras condiciones de uso y políticas de privacidad</div>');
		
		return false;
	}

	return true;*/
}



/*=============================================
CAMBIAR FOTO DE UN PRODUCTO EN ESPECÍFICO
=============================================*/
$(".btnCambiarFotoProducto").click(function(){

	var id = $(this).attr("identificacion");
	//console.log("id", id);

	$(".imgProductoCambiar"+id).toggle();
	$(".cambiarImagenProducto"+id).toggle();

})

/*============================================================================
	ESTE ES PARA VALIDAR EN LA PESTAÑA DE CAMBIAR FOTO DE UN PRODUCTO EN ESPECÍFICO          
==============================================================================*/
$(".datoscambiarImagenProducto").change(function(){

	var id = $(this).attr("i");

	var imagen = this.files[0];
	//console.log("imagen", imagen);

	/*===================================================
	     VALIDAMOS EL FORMATO DE LA IMAGEN     
	=====================================================*/

	if(imagen["type"] != "image/jpeg"){

		$("#datoscambiarImagenProducto"+id).val("");

		swal({
				title: "Error al subir la imagen",
				text: "¡La imagen debe de estar en formato JPG!",
				type:"error",
				confirmButtonText:"Cerrar",
				closeOnConfirm: false,
				icon: "error"
		    },

		function(isConfirm){

			if(isConfirm){
				 window.location = rutaOculta+"configuraciones";
			}
		})
	}

	else if(Number(imagen["size"]) > 2000000){

		$("#datoscambiarImagenProducto"+id).val("");

		swal({
				title: "Error al subir la imagen",
				text: "¡La imagen la imagen no debe de pesar mas de 2 MB!",
				type:"error",
				confirmButtonText:"Cerrar",
				closeOnConfirm: false,
				icon: "error"
		    },

		function(isConfirm){

			if(isConfirm){
				 window.location = rutaOculta+"configuraciones";
			}
		})

	}else{

		var datosImagen = new FileReader;//Hacer lectura del nuevo archivo
		datosImagen.readAsDataURL(imagen); 
		//Convierte el archivo que está dentro de imagen en una cadena de código que se pueda visualizar

		$(datosImagen).on("load",function(event){

			var rutaImagen = event.target.result;//El resultado de la cadena de código que nos trae el 
												 //evento de readAsDataURL

			$(".previsualizar"+id).attr("src", rutaImagen);
		})
	}
})



/*============================================================================
	ESTE ES PARA VALIDAR EN LA PESTAÑA DE AGREGAR UN PRODUCTO EN ESPECÍFICO          
==============================================================================*/
$("#datosImagenProducto").change(function(){

	var imagen = this.files[0];
	//console.log("imagen", imagen);

	/*===================================================
	     VALIDAMOS EL FORMATO DE LA IMAGEN     
	=====================================================*/

	if(imagen["type"] != "image/jpeg"){

		$("#datosImagen").val("");

		swal({
				title: "Error al subir la imagen",
				text: "¡La imagen debe de estar en formato JPG!",
				type:"error",
				confirmButtonText:"Cerrar",
				closeOnConfirm: false,
				icon: "error"
		    },

		function(isConfirm){

			if(isConfirm){
				 window.location = rutaOculta+"configuraciones";
			}
		})
	}

	else if(Number(imagen["size"]) > 2000000){

		$("#datosImagen").val("");

		swal({
				title: "Error al subir la imagen",
				text: "¡La imagen la imagen no debe de pesar mas de 2 MB!",
				type:"error",
				confirmButtonText:"Cerrar",
				closeOnConfirm: false,
				icon: "error"
		    },

		function(isConfirm){

			if(isConfirm){
				 window.location = rutaOculta+"configuraciones";
			}
		})

	}else{

		var datosImagen = new FileReader;//Hacer lectura del nuevo archivo
		datosImagen.readAsDataURL(imagen); 
		//Convierte el archivo que está dentro de imagen en una cadena de código que se pueda visualizar

		$(datosImagen).on("load",function(event){

			var rutaImagen = event.target.result;//El resultado de la cadena de código que nos trae el 
												 //evento de readAsDataURL

			$(".previsualizar").attr("src", rutaImagen);
		})
	}
})

/*============================================================
	COMENTARIOS  ID      
==============================================================*/
$(".calificarProducto").click(function(){

	var idComentario = $(this).attr("idComentario");//Estmaos almacenando el valor que hay dentro del objeto con el atributo idComentario

	$("#idComentario").val(idComentario);

})

/*============================================================
	COMENTARIOS CAMBIO DE ESTRELLAS       
==============================================================*/
$("input[name='puntaje']").change(function(){

	var puntaje = $(this).val();
	
	switch(puntaje){

		case "0.5":
		$("#estrellas").html('<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "1.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "1.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "2.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "2.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "3.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "3.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "4.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "4.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>');
		break;

		case "5.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							 '<i class="fa fa-star text-success" aria-hidden="true"></i>');
		break;

	}
})

/*============================================================
	VALIDAR EL COMENTARIO       
==============================================================*/
function validarComentario(){

	var comentario = $("#comentario").val();

	if(comentario != ""){

		var expresion = /^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

		if(!expresion.test(comentario)){//Si el comentario no cumple con la estructura de la expresión regular

			$("#comentario").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong> No se permiten'+
				                              ' caracteres especiales como por ejemplo !$%&/?¡¿[]*</div>');

			return false;

		}
	
	}else{//Si el comentario viene vacío

			$("#comentario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Campo obligatorio</div>');

			return false;
	}

	return true;

}



/*============================================================
	ELIMINAR USUARIO       
==============================================================*/
$("#eliminarUsuario").click(function(){

	var id = $("#idUsuario").val();
	//console.log("id", id);

	swal({
				title: "¿Desea eliminar su cuenta?",
				text: "¡Si borra esta cuenta ya no se pueden recuperar los datos!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor:"#DD6B55",
				confirmButtonText: "¡Si, borrar cuenta!",
				closeOnConfirm: false
			},

		function(isConfirm){

			  if (isConfirm) {

			  	//localStorage.removeItem("usuario");
				//localStorage.clear();

			  	var datos = new FormData();
				datos.append("idUEli", id);

				$.ajax({
					url:rutaOculta+"ajax/usuarios.ajax.php",
					method:"POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success:function(respuesta){
						//console.log("respuesta", respuesta);

					}
				})
		   
				window.location = rutaOculta+"salir";	 
				//window.location = "index.php?ruta=perfil&id="+id+"&foto="+foto;
				//window.location = "index.php?ruta=perfil";
			}

			 
		});
})



/*=========================================================================
   DESHABILITAR PRODUCTOS DEL INVENTARIO EN CONFIGURACIONES      
===========================================================================*/
$(".deshabilitarProducto").click(function(){

	var productoDeshabilitar = $(this).attr("noProductoDes");
	//console.log("productoDeshabilitar", productoDeshabilitar);
	var bar = localStorage.getItem("barFiltro");
	//console.log("bar", bar);

   swal({
		 title: "¿Desea deshabilitar este producto?",
		 type: "warning",
		 showCancelButton: true,
		 confirmButtonColor:"#DD6B55",
		 confirmButtonText: "Aceptar",
		 closeOnConfirm: false
	  },

   function(isConfirm){
	  
	  if (isConfirm) {	   
				
	   var datos = new FormData();
	   datos.append("id_producto", productoDeshabilitar);
	   datos.append("id_bar",bar);
	   datos.append("est",0);

		$.ajax({
				 url:rutaOculta+"ajax/usuarios.ajax.php",
				 method:"POST",
				 data: datos,
				 cache: false,
				 contentType: false,
				 processData: false,
				 success:function(respuesta){
							//console.log("respuesta",respuesta);
			   }
			})

		window.location = localStorage.getItem("rutaBares");

	   } 

	})
})


/*=========================================================================
   HABILITAR PRODUCTOS DEL INVENTARIO EN CONFIGURACIONES      
===========================================================================*/
$(".habilitarProducto").click(function(){

	var productoDeshabilitar = $(this).attr("noProductoHa");
	//console.log("productoDeshabilitar", productoDeshabilitar);
	var bar = localStorage.getItem("barFiltro");
	//console.log("bar", bar);

   swal({
		 title: "¿Desea habilitar este producto?",
		 type: "warning",
		 showCancelButton: true,
		 confirmButtonColor:"#DD6B55",
		 confirmButtonText: "Aceptar",
		 closeOnConfirm: false
	  },

   function(isConfirm){
	  
	  if (isConfirm) {	   
				
	   var datos = new FormData();
	   datos.append("id_producto", productoDeshabilitar);
	   datos.append("id_bar",bar);
	   datos.append("est",1);

		$.ajax({
				 url:rutaOculta+"ajax/usuarios.ajax.php",
				 method:"POST",
				 data: datos,
				 cache: false,
				 contentType: false,
				 processData: false,
				 success:function(respuesta){
							//console.log("respuesta",respuesta);
			   }
			})

		window.location = localStorage.getItem("rutaBares");

	   } 

	})
	
})

/*========================================================================================
   AGREGAR TODOS LOS PRODUCTOS DE LA TABLA PRODUCTOS A LA TABLA DE PRODUCTOS POR ALMACEN     
==========================================================================================*/
$(".agregarProductos").click(function(){

	var bar = $(this).attr("noBar");
	//console.log("bar", bar);

	swal({
		 title: "¿Desea agregar todos los productos?",
		 type: "warning",
		 showCancelButton: true,
		 confirmButtonColor:"#DD6B55",
		 confirmButtonText: "Aceptar",
		 closeOnConfirm: false
	  },

   function(isConfirm){
	  
	  if (isConfirm) {

	  	var datos = new FormData();
	   	datos.append("id_barAgregar",bar);
	   	datos.append("estAgregar",1);

		$.ajax({
				 url:rutaOculta+"ajax/producto.ajax.php",
				 method:"POST",
				 data: datos,
				 cache: false,
				 contentType: false,
				 processData: false,
				 success:function(respuesta){
							console.log("respuesta",respuesta);
			   }
			})

			window.location = rutaOculta+"configuraciones";	   
				
	  //setTimeout("window.location = rutaOculta+'configuraciones'", 7000);
		
	 } 

  })
})


/*===================================================================
  ELIMINAR TODOS LOS PRODUCTOS DE LA TABLA DE PRODUCTOS_ALMACEN        
=====================================================================*/

$(".eliminarProductos").click(function(){

	var bar = $(this).attr("noBar");
	//console.log("bar", bar);

	swal({
		 title: "¿Desea eliminar todos los productos?",
		 type: "warning",
		 showCancelButton: true,
		 confirmButtonColor:"#DD6B55",
		 confirmButtonText: "Aceptar",
		 closeOnConfirm: false
	  },

   function(isConfirm){
	  
	  if (isConfirm) {

	  	var datos = new FormData();
	   	datos.append("id_barEliminar",bar);

		$.ajax({
				 url:rutaOculta+"ajax/producto.ajax.php",
				 method:"POST",
				 data: datos,
				 cache: false,
				 contentType: false,
				 processData: false,
				 success:function(respuesta){
							console.log("respuesta",respuesta);
			   }
			})
	   
				
	  window.location = rutaOculta+"configuraciones";

	 } 

	})
})

if($("#categoria").val() == ""){

	$('#subcategoria').prop('disabled', 'disabled');

}

$('#rutaProducto').prop('disabled', 'disabled');

/*======================================
	   VALIDAR CATEGORÍA  y SUBCATEGORIA     
========================================*/
	$("#categoria").change(function(){ 

	   		if($("#categoria").val() == ""){

					$('#subcategoria').prop('disabled', 'disabled');
					$("#subcategoria").children("option").remove();

			}else{
				$("#subcategoria").children("option").remove();
				$('#subcategoria').prop('disabled', false);

				/*============================================================
					MOSTRAR LAS SUBCATEGORIAS   EN BASE A LA CATEGORIA      
				  ============================================================*/
				var validarSubcategorias = false;
				var categoria = $("#categoria").val();
				//console.log("categoria", categoria);
				var datos = new FormData();

				datos.append("validarSubcategorias", categoria);

				$.ajax({
					
					url:rutaOculta+"ajax/producto.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success:function(respuesta){

					var sub = JSON.parse(respuesta);

					sub.forEach(funcionForEach);

					function funcionForEach(item, index){

						$("#subcategoria").append('<option value="'+item.id+'">'+item.subcategoria+'</option>');
					}
				}
					
	 		})

		}

})// FIN DEL CHANGE DE CATEGORIA

/*===================================================
		LIMPIAR TODOS LOS CAMPOS
=====================================================*/
$("#categoria").change(function(){ 

   		$(".alert").remove();
})

//$("#rutaProducto").val() == localStorage.getItem("productoURL");
/*====================================================================
    VALIDAR EL FORMULARIO DE REGISTRO DE AGREGAR UN PRODUCTO       
======================================================================*/
//$("#agregarProducto").click(function(){

function registroProducto(){

	/*======================================
	   VALIDAR CATEGORÍA       
	========================================*/
	
	if($("#categoria").val() == ""){

		$("#categoria").after('<div class="alert alert-warning">No ha seleccionado la categoría</div>');

		return false;

	}

	/*======================================
	   VALIDAR SUBCATEGORIA       
	========================================*/
	
	if($("#subcategoria").val() == ""){

		$("#subcategoria").after('<div class="alert alert-warning">No ha seleccionado una subcategoría</div>');

		return false;

	}


	/*============================================================
	VALIDAR EL NOMBRE        
	==============================================================*/
	var nombreProducto = $("#nombre_producto").val();

	if(nombreProducto != ""){

		var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

		if(!expresion.test(nombreProducto)){ //Sino cumple con la edxpresión regular

			$("#nombre_producto").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten número ni caracteres especiales</div>');
			
			return false;
		}

	}else{

		$("#nombre_producto").parent().after('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');
		
		return false;

	}

	/*============================================================
		VALIDAR CÓDIGO DE BÚSQUEDA        
	==============================================================*/
	var codigo = $("#codigo_busqueda").val();
	//console.log("codigo", codigo);

	if(codigo != ""){

		var expresion = /^[a-zA-Z0-9]*$/;

		if(!expresion.test(codigo)){ //Sino cumple con la edxpresión regular

			$("#codigo_busqueda").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>');
			
			return false;
		}

	}else{

		$("#codigo_busqueda").parent().after('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');
		
		return false;

	}

	/*============================================================
		VALIDAR DESCRIPCIÓN         
	==============================================================*/
	var descripcion = $("#descripcion").val();

	if(descripcion != ""){

		var expresion = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

		if(!expresion.test(descripcion)){ //Sino cumple con la edxpresión regular

			$("#descripcion").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten  caracteres especiales</div>');
			
			return false;
		}

	}else{

		$("#descripcion").parent().after('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');
		
		return false;
	}

}


function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

/*======================================
	   VALIDAR CATEGORÍA  y SUBCATEGORIA     
========================================*/
	$(".selectCategoriaEdit").change(function(){ 

	   			var identity = $(this).attr("identity");

				$(".selectSubCategoriaEdit"+identity).children("option").remove();

				/*============================================================
				  MOSTRAR LAS SUBCATEGORIAS   EN BASE A LA CATEGORIA      
				 ============================================================*/
				var categoria = $("#selectCategoriaEdit"+identity).val();
				//console.log("categoria", categoria);
				var datos = new FormData();

				datos.append("validarSubcategorias", categoria);

				$.ajax({
					
					url:rutaOculta+"ajax/producto.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success:function(respuesta){

					var sub = JSON.parse(respuesta);

					sub.forEach(funcionForEach);

					function funcionForEach(item, index){

						$(".selectSubCategoriaEdit"+identity).append('<option value="'+item.id+'">'+item.subcategoria+'</option>');
					}
				}
					
	 		})

		

})// FIN DEL CHANGE DE CATEGORIA

	/*===============================================
     ELIMINAR PRODUCTO ESPECÍFICO POR ID     
=================================================*/
$(".eliminarProducto").click(function(){

	noProducto = $(this).attr("noProducto");
	noBar = $(this).attr("id_bar");
	portada = $(this).attr("dirImage");
	console.log("noProducto", noProducto);
	
	swal({
		 title: "¿Desea eliminar este producto?",
		 type: "warning",
		 showCancelButton: true,
		 confirmButtonColor:"#DD6B55",
		 confirmButtonText: "Aceptar",
		 closeOnConfirm: false
	  },

   function(isConfirm){
	  
	  if (isConfirm) {
	
	  	var datosEliminar = new FormData();

	  	if(portada != null){
		   	datosEliminar.append("noProductoEliminar",noProducto);
		   	datosEliminar.append("noBarEliminar",noBar);
		   	datosEliminar.append("eliminarImagen",portada);

	   	}else{
		   	datosEliminar.append("noProductoEliminarSinImagen",noProducto);
		   	datosEliminar.append("noBarEliminarSinImagen",noBar);
	   	}
	   	

		$.ajax({
				 url:rutaOculta+"ajax/producto.ajax.php",
				 method:"POST",
				 data: datosEliminar,
				 cache: false,
				 contentType: false,
				 processData: false,
				 success:function(respuesta){
							
						if(respuesta == "ok"){

							swal({
							 title: "El producto se ha eliminado satisfactoriamente",
							 type: "success",
							 showCancelButton: false,
							 confirmButtonColor:"#DD6B55",
							 confirmButtonText: "Aceptar",
							 closeOnConfirm: false
						  },

						   function(isConfirm){
							  
							  if (isConfirm) {

							 	//window.location = localStorage.getItem("rutaBares");
							 	window.location = rutaOculta+"configuraciones";			
							  } 
						  })

					}//FIN DEL IF OK
			    }
			})			
	  //window.location = localStorage.getItem("rutaBares");

	  } 

   })

})


 $(".actualizarProducto").click(function(){

 	var identity = $(this).attr("noProducto");
 	var noBar = $(this).attr("id_bar");

 	/*============================================================
				VALIDAR EL NOMBRE        
	==============================================================*/
			var nombreProducto = $("#productoName"+identity).val();
			validarNombre = true;

				if(nombreProducto != ""){

					var expresion = /^[a-zA-Z0-9ñÑ ]*$/;

					if(!expresion.test(nombreProducto)){ //Sino cumple con la edxpresión regular

						$("#productoName"+identity).after('<p class="errores" style="font-size:12px; color:red"><strong>ERROR:</strong> No se permiten caracteres especiales en el Nombre</p>');
						
					  return ;

					  validarNombre = false;
					}

				}else{

					$("#productoName"+identity).after('<p class="errores" style="font-size:12px; color:red"><strong>ATENCIÓN:</strong> Este campo es obligatorio</p>');
					
					return ;

					validarNombre = false;

				}


			/*============================================================
				VALIDAR CÓDIGO DE BÚSQUEDA        
			==============================================================*/
			var codigo = $("#codigoEdit"+identity).val();
			validarCodigo = true;

				if(codigo != ""){

					var expresion = /^[a-zA-Z0-9]*$/;

					if(!expresion.test(codigo)){ //Sino cumple con la edxpresión regular

						$("#codigoEdit"+identity).after('<p class="errores" style="font-size:12px; color:red"><strong>ERROR:</strong> No se permiten caracteres especiales en el Código</p>');
						
						return;

						validarCodigo = false;
					}

				}else{

					$("#codigoEdit"+identity).after('<p class="errores" style="font-size:12px; color:red"><strong>ATENCIÓN:</strong> Este campo es obligatorio</p>');
					
					return;

					validarCodigo = false;

				}



			/*============================================================
				VALIDAR DESCRIPCIÓN         
			==============================================================*/
			var descripcion = $("#descripcionEdit"+identity).val();
			validarDescripcion = true;

				if(descripcion != ""){

					var expresion = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ,:!"#$%&/()=?¡*´<>,-@.+ ]*$/;

					if(!expresion.test(descripcion)){ //Sino cumple con la edxpresión regular

						$("#descripcionEdit"+identity).after('<p class="errores" style="font-size:12px; color:red"><strong>ERROR:</strong> No se permiten caracteres especiales en la Descripción</p>');
						
						return ;

						validarDescripcion = false;
					}

				}else{

					$("#descripcionEdit"+identity).after('<p class="errores" style="font-size:12px; color:red"><strong>ATENCIÓN:</strong> Este campo es obligatorio</p>');
					
					return ;

					validarDescripcion = false;
				}


 	swal({
		 title: "¿Desea actualizar este producto?",
		 type: "warning",
		 showCancelButton: true,
		 confirmButtonColor:"#DD6B55",
		 confirmButtonText: "Aceptar",
		 closeOnConfirm: false
	  },

	   function(isConfirm){
		  
		  if (isConfirm) {
		 
		   var datosActualizar = new FormData();
	  
		   datosActualizar.append("noProductoActualizar",identity);
		   datosActualizar.append("noBarActualizar",noBar);
		   datosActualizar.append("nombreActualizar",nombreProducto);
		   datosActualizar.append("codigoActualizar",codigo);
		   datosActualizar.append("descripcionActualizar",descripcion);

				   	
					$.ajax({
							 url:rutaOculta+"ajax/producto.ajax.php",
							 method:"POST",
							 data: datosActualizar,
							 cache: false,
							 contentType: false,
							 processData: false,
							 success:function(respuesta){
							 	console.log("respuesta", respuesta);
										
									if(respuesta == "ok"){

										swal({
										 title: "El producto se ha actualizado satisfactoriamente",
										 type: "success",
										 showCancelButton: false,
										 confirmButtonColor:"#DD6B55",
										 confirmButtonText: "Aceptar",
										 closeOnConfirm: false
									  },

									   function(isConfirm){
										  
										  if (isConfirm) {

										 	//window.location = localStorage.getItem("rutaBares");
										 	window.location = rutaOculta+"configuraciones";			
										  } 
									  })

								}//FIN DEL IF OK

						    }// FIN DE LA RESPUESTA

						})//FIN DEL AJAX

					

	 			}//FIN DEL IF CONFIRM 

   		})

 })

	


	


	

	










