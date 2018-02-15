<?php

class ControladorUsuarios{

	/*======================================
	  REGISTRO DE USUARIO        
	========================================*/
	public function ctrRegistroUsuario(){

		if(isset($_POST["regUsuario"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){
			//El método de preg_match es lo mismo que se hizo en el javascript de usuarios para validar las expresiones regulares



			}else{

				echo '<script> 

							swal({
							  title: "¡ERROR!",
							  text: "¡Error al registrar el usuario, no se permiten caracteres especiales!",
							  type:"error",
							  confirmButtonText:"Cerrar",
							  closeOnConfirm: false,
							  icon: "error",
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
							});

				</script>';
			}

		}

	}
}