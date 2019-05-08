<?php

session_destroy();

$url = Ruta::ctrRuta();

if(!empty($_SESSION['id_token_google'])){ //Si la variable de sesión esta llena o no está vacía

	unset($_SESSION['id_token_google']);

}
echo '<script>
	
		localStorage.removeItem("usuario");
		localStorage.clear();
		window.location = "'.$url.'"; 

	</script>';


