<?php

session_start();

include "conexion.php";
include "usuarios.controlador.php";
include "usuarios.modelo.php";
include "rutas.php";

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

$item = $_SESSION["id"];
$item1 = 1;
$notificaciones = ControladorUsuarios::ctrMostrarMensajesByUsuario($item, $item1);


if($notificaciones){

	foreach ($notificaciones as $key => $value1) {

  $resultado1 = substr($value1["fecha"],10);
		    
	echo'<div class="chat friend">
		  <div class="user-photo"><img src="'.$servidor.'vistas/img/usuarios/admin/admin.png" ></div>
	       <p style="color:black"class="chat-message"><span style="font-weight:bold">'.$value1["nombre_usuario"].'<br></span>'.$value1["mensaje"].'<br><span style="color:red; float:right; font-weight:bold; font-size:20px">'.$resultado1.'</span></p>';

    echo'</div>';
 }

}

  