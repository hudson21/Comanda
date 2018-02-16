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

				$encriptarEmail = md5($_POST["regEmail"]);

				$datos = array("nombre"=>$_POST["regUsuario"],
			                   "password"=>$encriptar,
			                   "email"=>$_POST["regEmail"],
			                   "modo"=>"directo",
			               	   "verificacion"=>1,
			               	   "emailEncriptado"=>$encriptarEmail);

			    $tabla = "usuarios";

			    $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

			    //var_dump($respuesta);

			    if($respuesta == "ok"){

			    	/*============================================================
			    	     VERIFICACIÓN DE CORREO ELECTRÓNICO     
			    	==============================================================*/

			    	date_default_timezone_set("America/Cancun");

			    	$url = Ruta::ctrRuta();

			    	$mail = new PHPMailer;

			    	$mail->isMail();

			    	$mail->setFrom('carlosmigu27@hotmail.com','Comanda Electrónica');

			    	$mail->addReplyTo('carlosmigu27@hotmail.com','Comanda Electrónica');

			    	$mail->Subject = "Por favor verifique su dirección de correo electrónico";

			    	$mail->addAddress($_POST["regEmail"]);

			    	$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

									<center>
										
										<img style="padding:20px; width:17%" src="http://localhost/Comanda/backend/vistas/img/plantilla/logotipo.png" alt="" >
								        
									</center>

									<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

										<center>

										<img style="padding:20px; width:15%" src="http://localhost/Comanda/backend/vistas/img/plantilla/icon-email.png" alt="">

										<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

										<hr style="border: 1px solid #ccc; width:80%">

										<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta de Tienda Virtual, debe  confirmar su dirección de correo electrónico</h4>

										<a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration:none">
											<div style="line-height:60px; background:#0aa; width:60%; color:white; ">Verifique su dirección de correo electrónico </div>
										</a>

										<br>

										<hr style="border: 1px solid #ccc; width:80%">

										<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
									
								        </center>
									
									</div>

									</div>');

			    	$envio = $mail->Send();

			    	if(!$envio){ //Si el mensaje no se envió

			    				echo '<script> 

										swal({
										  title: "¡ERROR!",
										  text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["regEmail"].$mail->ErrorInfo.'!",
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



			    	}else{

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
}