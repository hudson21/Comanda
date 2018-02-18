/*======================================
VALIDAR EL REGISTRO DEL USUARIO          
========================================*/
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
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

				console.log("respuesta",respuesta);

		}
	})
})