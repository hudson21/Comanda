/*======================================
 BOTON DE FACEBOOK      
========================================*/
$("#btnFacebookRegistro").click(function(){

	FB.login(function(response){

		validarUsuario();
	}, {scope: 'public_profile, email'})
})

/*======================================
 VALIDAR EL INGRESO      
========================================*/
function validarUsuario(){

	FB.getLoginStatus(function(response){

		statusChangeCallback(response);
	})
}

/*==========================================
 VALIDAR EL CAMBIO DE ESTADO EN FACEBOOk    
============================================*/
function statusChangeCallback(response){

	if(response.status === 'connected'){

		textApi();
	
	}else{

		swal({
				title: "¡ERROR!",
				text: "¡Ocurrió un error al ingresar con Facebook, vuelve a intentarlo!",
				type:"error",
				confirmButtonText:"Cerrar",
				closeOnConfirm: false,
				icon: "error"
			},

		function(isConfirm){
			if(isConfirm){
				window.location = localStorage.getItem("rutaActual");
			}
		});
	}
}


/*==========================================
 INGRESAMOS A LA API DE FACEBOOK    
============================================*/ 
function testApi(){

	FB.api('/me?fields=id,name,email,picture', function(response){

		if(response.email == "undefined"){

			swal({
				title: "¡ERROR!",
				text: "¡Para poder ingresar al sistema debe proporcionar la información del correo electrónico!",
				type:"error",
				confirmButtonText:"Cerrar",
				closeOnConfirm: false,
				icon: "error"
				},

			function(isConfirm){
			if(isConfirm){
				window.location = localStorage.getItem("rutaActual");
			}
		});

		}else{

			var email = response.email;
			console.log("email",email);

			var nombre = response.nombre;
			console.log("nombre",nombre);

			var foto = "http://graph.facebook.com/"+response.id+"/picture?type=large";
			console.log("foto",foto);

			var datos = new FormData();
			datos.append("email",email);
			datos.append("nombre",nombre);
			datos.append("foto",foto);

			$.ajax({



			})
		}
	})
}