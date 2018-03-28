<?php

session_start();


include "conexion.php";
include "usuarios.controlador.php";
include "usuarios.modelo.php";
include "rutas.php";

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

	$item = $_SESSION["id"];
	$item1 = 0;
	$notificaciones = ControladorUsuarios::ctrMostrarMensajesByUsuario($item, $item1);

		  

						foreach ($notificaciones as $key => $value1) {

									$resultado1 = substr($value1["fecha"],10);

						echo'<div class="chat friend">
								<div class="user-photo"><img src="'.$servidor.'vistas/img/usuarios/admin/admin.png" ></div>
									    <p style="color:black"class="chat-message">El pedido número <span style="color:red">'.$value1["no_pedido"]. '</span>  ya se encuentra listo<br><span style="color:red; float:right; font-weight:bold; font-size:20px">'.$resultado1.'</span></p>';

							   echo'</div>';
	
			                      }		

			              

	?>

								

		