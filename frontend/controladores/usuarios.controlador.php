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

				$encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			//El crypt es un modo para encriptar las contraseñas a través de PHP

				$datos = array("nombre"=>$_POST["regUsuario"],
			                   "password"=>$encriptar,
			                   "email"=>$_POST["regEmail"],
			                   "modo"=>"directo",
			               	   "verificacion"=>1);

			    $tabla = "usuarios";

			    $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

			    //var_dump($respuesta);

			    if($respuesta == "ok"){

			    	echo '<script> 

				swal({

					title: "¡OK!",
					text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["regEmail"].' para verificar la cuenta",
					type:"success",
					confirmButtonText:"Cerrar",
					closeOnConfirm: false,
					icon: "success"
							  
				},

				function(isConfirm){

					if(isConfirm){
					  history.back();
					}
				});

				</script>';

			    }

			}else{

				echo '<script> 

							swal({
							  title: "¡ERROR!",
							  text: "¡Error al registrar el usuario, no se permiten caracteres especiales!",
							  type:"error",
							  confirmButtonText:"Cerrar",
							  closeOnConfirm: false,
							  icon: "error"
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