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

if($notificaciones){

foreach ($notificaciones as $key => $value1) {

	$resultado1 = substr($value1["fecha"],10);

	  echo'<div class="chat friend">
			 <div class="user-photo"><img src="'.$servidor.'vistas/img/usuarios/admin/admin.png" ></div>
				<p style="color:black"class="chat-message"><span style="font-weight:bold">Administrador<br></span>El pedido número <span style="color:red">'.$value1["no_pedido"]. '</span>  ya se encuentra listo<br><span style="color:red; float:right; font-weight:bold; font-size:20px">'.$resultado1.'</span></p>';
     echo'</div>';
	
}

}else{

	  echo '<div  class="col-xs-12 text-center ">
										               
			   <h1 style="font-size:100px"><small>¡Oops!</small></h1>
										    
			   <h2>Aún no tiene pedidos listos</h2>

		  </div>';
 }		

?>

								

		