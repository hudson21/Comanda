<style>

	.menuDesplegable{display:none;}

	/*.cesta{display:none;*/}
</style>

<script>
	
	function ajax(){
		var req = new XMLHttpRequest();

		req.onreadystatechange = function(){
			if(req.readyState == 4 && req.status == 200){
				document.getElementById("chat").innerHTML = req.responseText;
			}
		}

		req.open("GET","chat.php", true);
		req.send();
	}

	//Linea que hace que se refresque la página cada segundo
	setInterval(function(){ajax();}, 1000);

</script>

<!--===============================================
   VALIDAR SESIÓN
===================================================-->
<?php

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

if(!isset($_SESSION["validarSesion"])){

	echo '<script>
	
			window.location = "'.$url.'"

	</script>';

	exit();//Esto es para cancelar cualquier acción que se hada dentro de PHP
}

?>
<style>.menuDesplegable{display:none;}</style>
<!--===============================================
     BREADCRUMB DE MENSAJES
===================================================-->
<div class="container-fluid well well-sm">

	<div class="container">

		<div class="row">

			<ul class="breadcrumb  fondoBreadcrumb text-uppercase" style="margin-bottom:0px; background:rgba(0,0,0,0);">

				<li><a style="text-decoration:none;" href="<?php echo $url; ?>">MENSAJES</a></li>
			    <li class="active pagActiva"><?php echo $rutas[0]; ?></li>
				
			</ul>
			
		</div>
		
	</div>
	
</div>

<!--===============================================
     SECCIÓN DE MENSAJE
===================================================-->
<div class="container-fluid">

	<div class="container">

		<ul class="nav nav-tabs">

		  <li class="active">
		  	<a data-toggle="tab" href="#mensajesPedidos" >
		  	<i class="fa fa-paper-plane"></i> Mensajes de Pedidos</a>
		  </li>

		  <li>
		  	<a data-toggle="tab" href="#mensajesGenerales">
		  	<i class="fa fa-plane"></i> Mensajes Generales</a>
		  </li>

		  <li>
		  	<a data-toggle="tab" href="#mensajesPersonalizados">
		  	<i class="fa fa-phone"></i> Mensajes Personalizados</a>
		  </li>

		</ul>

		<div class="tab-content">

			<!--===============================================
			   PESTAÑA MENSAJES DE PEDIDOS
			===================================================-->
		  <div id="mensajesPedidos" class="tab-pane fade in active">
			
			<div  id="contenedor">

				<div id="caja-chat">

					<div id="chat">

						<?php 
						//Aquí lo harás con el foreach

						?>

						<div id="datos-chat">
							
							<span style="color:#0101DF">Hudson: </span>
							<span style="color:#848484">Hola como estas</span>
							<span style="float:right">10:04 am</span>

						</div>
						
					</div>
					
				</div>

				<form method="POST" action="notificaciones.php">

					<input type="text" name="nombre" placeholder="Ingresa tu nombre">

					<textarea name="mensaje" id="" placeholder="Ingresa tu mensaje"></textarea>

					<input type="submit" name="enviar" value="ENVIAR">
					
				</form>

				<?php
					if(isset($_POST["enviar"])){
						$nombre = $_POST["nombre"];
						$mensaje = $_POST["mensaje"];

						$consulta = "INSERT INTO notificaciones "
						$ejecutar = 

					}
				 if(Si se ejecuta la consulta)
					echo'<embed loop="false" src="beep.mp3" hidden="true" autoplay="true">';
				?>
				
			</div>


			
		    
		  </div>

		  <!--===============================================
			   PESTAÑA MENSAJES GENERALES
			===================================================-->
		  <div id="mensajesGenerales" class="tab-pane fade">

		  	<h2>Mensajes Generales</h2>
		    

  		  </div>

  		    <!--===============================================
			   PESTAÑA MENSAJES PERSONALIZADOS
			===================================================-->
  		  <div id="mensajesPersonalizados" class="tab-pane fade ">
		     
		     <h2>Mensajes Personalizados</h2>   	

          </div>

     </div>




