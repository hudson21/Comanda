<?php

session_start();

include "conexion.php";
include "usuarios.controlador.php";
include "usuarios.modelo.php";
include "rutas.php";

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

$item = $_SESSION["id"];

$notificaciones = ControladorUsuarios::ctrMostrarMensajesJoinUsuarios();

if($notificaciones){

	foreach ($notificaciones as $key => $value1) {

   $resultado1 = substr($value1["fecha"],10);
   $resultado2 = substr($value1["fecha"],0, -8);


	if($value1["no_usuario"] == $_SESSION["id"]){

		echo'<div class="chat friend">';
	
	}else{

		echo'<div class="chat self">';
	}   
	

		if($value1["tipo_usuario"]==0){

			echo'<div class="user-photo"><img src="'.$servidor.'vistas/img/usuarios/admin/admin.png" ></div>';
		
		}else{

			echo'<div class="user-photo"><img src="'.$servidor.'vistas/img/usuarios/admin/usuario.png" ></div>';
		}
		
	    echo' <p style="color:black" class="chat-message"><span style="font-weight:bold">'.$value1["nombre_usuario"].'<br></span><span style="width:10px">'.$value1["mensaje"].'</span><br>
	       <span class="horaPedidos">'.$resultado2.'</span><span class="fechaPedidos">'.$resultado1.'</span></p>';

    echo'</div>';
 }

}

  