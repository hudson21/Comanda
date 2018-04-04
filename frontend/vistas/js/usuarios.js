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

				var modo = JSON.parse(respuesta).modo;//De esta manera podemos accesar a los atributos que hay dentro del JSON que está dentro de la respuesta
				//console.log(modo);

				if(modo == "directo"){

					modo = "esta página";
				}
		
				$("#regNickname").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> El nombre de usuario ya existe en la base de datos, fue resgistrado a través de '+modo+', por favor ingrese otro diferente</div>');	
			
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
CAMBIAR FOTO
=============================================*/
$("#btnCambiarFoto").click(function(){

	$("#imgPerfil").toggle();
	$("#subirImagen").toggle();

})

$("#datosImagen").change(function(){

	var imagen = this.files[0];

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
				 window.location = rutaOculta+"perfil";
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
				 window.location = rutaOculta+"perfil";
			}
		})

	}else{

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen); //Convierte el archivo que está dentro de imagen en una cadena de código que se pueda visualizar

		$(datosImagen).on("load",function(event){

			var rutaImagen = event.target.result;

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
	LISTA DE DESEOS       
==============================================================*/
$(".deseos").click(function(){

	var idProducto = $(this).attr("idProducto");
	//console.log("idProducto",idProducto);
	var idUsuario = localStorage.getItem("usuario");
	//console.log("idUsuario",idUsuario);

	if(idUsuario == null){

		swal({
				title: "¡Debe ingresar al sistema!",
				text: "¡Para agregar un producto a la 'lista de deseos' debe primero ingresar al sistema!",
				type: "warning",
				confirmButtonText: "¡Cerrar!",
				closeOnConfirm: false
			},

		function(isConfirm){
			  if (isConfirm) {	   
				window.location = rutaOculta;
			} 
		});

	}else{

			$(this).addClass("btn-danger");

			var datos = new FormData();
			datos.append("idUsuario", idUsuario);
			datos.append("idProducto", idProducto);

			$.ajax({
					url:rutaOculta+"ajax/usuarios.ajax.php",
					method:"POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success:function(respuesta){
						
						
					}

			})

	}
})


/*============================================================
	QUITAR PRODUCTO DE LISTA DE DESEOS       
==============================================================*/
$(".quitarDeseo").click(function(){

	var idDeseo = $(this).attr("idDeseo");

	$(this).parent().parent().parent().remove();

	var datos = new FormData();
	datos.append("idDeseo", idDeseo);

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

})


/*============================================================
	ELIMINAR USUARIO       
==============================================================*/
$("#eliminarUsuario").click(function(){

	var id = $("#idUsuario").val();
	console.log("id", id);

	if($("#modoUsuario").val() == "directo"){
		if($("#fotoUsuario").val() != ""){
			var foto = $("#fotoUsuario").val();
		}
	}

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
				window.location = "index.php?ruta=perfil&id="+id+"&foto="+foto;
			} 
		});
})

/*============================================================
	ELIMINAR PRODUCTO EN EL CARRITO DE COMPRAS       
==============================================================*/









