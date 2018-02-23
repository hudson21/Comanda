/*======================================
CAPTURA DE RUTA         
========================================*/

var rutaActual = location.href; //Aquí estamos tomando la ruta actual con la propiedad de location.href

$(".btnIngreso, .facebook, .google ").click(function(){

localStorage.setItem("rutaActual", rutaActual);/*De esta manera estamos alamacenando en el localStorage del navegador la ruta actual
											    de donde se encuentra el usuario actualmente*/
})


/*======================================
FORMATEAR LOA INPUTS         
========================================*/

$("input").focus(function(){

	$(".alert").remove();//Cuando se esté arriba de cualquier input y se esté escribiendo se removerán las alertas que estén en la pantalla
})



/*======================================
VALIDAR EMAIL REPETIDO          
========================================*/

var validarEmailRepetido = false;

$("#regEmail").change(function(){

	var email = $("#regEmail").val();
	var datos = new FormData();

	datos.append("validarEmail", email);

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
				validarEmailRepetido = false;

			}else{//Si es verdadero

				var modo = JSON.parse(respuesta).modo;//De esta manera podemos accesar a los atributos que hay dentro del JSON que está dentro de la respuesta
				//console.log(modo);

				if(modo == "directo"){

					modo = "esta página";
				}
		
				$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, fue resgistrado a través de '+modo+', por favor ingrese otro diferente</div>');	
			
					validarEmailRepetido = true;
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

			$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten número ni caracteres especiales</div>');
			
			return false;
		}

	}else{

		$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');
		
		return false;

	}

	/*============================================================
	VALIDAR EL CORREO ELECTRÓNICO        
	==============================================================*/

	var email = $("#regEmail").val();

	if(email != ""){

		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

		if(!expresion.test(email)){ //Sino cumple con la edxpresión regular

			$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten número ni caracteres especiales</div>');
			
			return false;
		}

		if(validarEmailRepetido){ //Si validarEmailRepetido es igual a true o verdadero

			$("#regEmail").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente</div>');

			return false;
		}

	}else{

		$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');
		
		return false;

	}

	/*============================================================
	VALIDAR CONTRASEÑA      
	==============================================================*/

	var password = $("#regPassword").val();

	if(password != ""){

		var expresion = /^[a-zA-Z0-9]*$/;

		if(!expresion.test(password)){ //Sino cumple con la edxpresión regular

			$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>');
			
			return false;
		}

	}else{

		$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');
		
		return false;

	}
	

	/*============================================================
	VALIDAR POLÍTICAS DE PRIVACIDAD         
	==============================================================*/
	var politicas = $("#regPoliticas:checked").val();

	if(politicas != "on"){

		$("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Debe aceptar nuestras condiciones de uso y políticas de privacidad</div>');
		
		return false;
	}

	return true;
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
