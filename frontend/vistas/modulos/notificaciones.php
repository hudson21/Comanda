<style>

	.menuDesplegable{display:none;}

	/*.cesta{display:none;*/}
</style>

<script>
	
	/*function ajax(){
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
	setInterval(function(){ajax();}, 1000);*/

</script>

<!--===============================================
   VALIDAR SESIÓN
===================================================-->
<?php

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

if(!isset($_SESSION["validarSesion"])){

	echo '<script>
			swal({
					title: "¡NO TIENE ACCESO!",
					text: "¡Necesita estar logeado para poder ver su lista de Pedidos!",
					type:"warning",
					confirmButtonText:"Ok",
					closeOnConfirm: false,
					icon: "warning"
				 },

				 function(isConfirm){

					 if(isConfirm){
						// history.back();
					     window.location = "'.$url.'";
					 }
				});
			

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
		  	<a data-toggle="tab" href="#mensajesPersonalizados">
		  	<i class="fa fa-phone"></i> Mensajes Personalizados</a>
		  </li>

		  <li>
		  	<a data-toggle="tab" href="#mensajesGenerales">
		  	<i class="fa fa-plane"></i> Mensajes Generales</a>
		  </li>

		</ul>

	<div class="tab-content">

	<!--===============================================
	   PESTAÑA MENSAJES DE PEDIDOS
	===================================================-->
      <div id="mensajesPedidos" class="tab-pane fade in active">

	      <?php

			$item = $_SESSION["id"];
			$item1 = 0;
			$notificaciones = ControladorUsuarios::ctrMostrarMensajesByUsuario($item, $item1);

		   if($notificaciones){

				echo'<div class="chatboxPedidos">
			  		 
			  		     <div class="chatlogs">';

								foreach ($notificaciones as $key => $value1) {

									$resultado1 = substr($value1["fecha"],10);

						echo'<div class="chat friend">
								<div class="user-photo"><img src="'.$servidor.'vistas/img/usuarios/admin/admin.png" ></div>
									    <p style="color:black"class="chat-message">El pedido número <span style="color:red">'.$value1["no_pedido"]. '</span>  ya se encuentra listo<br><span style="color:red; float:right; font-weight:bold; font-size:20px">'.$resultado1.'</span></p>';

							   echo'</div>';
	
			                      }
			                   echo'</div></div>';
			 }else{
				  echo '<div  class="col-xs-12 text-center ">
										               
						  <h1 style="font-size:100px"><small>¡Oops!</small></h1>
										    
						  <h2>Aún no tiene pedidos listos</h2>

					   </div>';
				}

								

		?>

								

		

	   </div>

	   <!--===============================================
	        PESTAÑA MENSAJES GENERALES
		===================================================-->	
		  <div id="mensajesGenerales" class="tab-pane fade">

		  	<?php	

			$item = $_SESSION["id"];
			$item1 = 2;
			$notificaciones = ControladorUsuarios::ctrMostrarMensajesByUsuario($item, $item1);

			if($notificaciones){

				echo'<div class="chatbox">';
				echo' <div class="chatlogsGeneralesyPersonalizados">';
		    foreach ($notificaciones as $key => $value1) {
		    	$resultado1 = substr($value1["fecha"],10);
		    	

		    		echo'<div class="chat friend">
					   <div class="user-photo"><img src="'.$servidor.'vistas/img/usuarios/admin/admin.png" ></div>';
					   
						  

					echo'</div>';

		    	
		    }

		    echo'</div><!--DIV DEL CHATLOGSGENERALESYPERSONALIZADOS-->';
		    echo'<div class="chat-form">
		  			<textarea></textarea>
		  			<button>Enviar</button>
		  		</div>';

		    echo'</div><!--DIV DEL CHATBOX-->'; 

			}else{

				echo'<div class="chatbox">';
		    
		    	echo' <div class="chatlogsGeneralesyPersonalizados">';

		    		echo'<div class="chat friend">
					   
						</div>';

		    	echo'</div><!--DIV DEL CHATLOGSGENERALESYPERSONALIZADOS-->';
		    


		    echo'<div class="chat-form">
		  			<textarea></textarea>
		  			<button>Enviar</button>
		  		</div>';

		    echo'</div><!--DIV DEL CHATBOX-->';
			}
			
			?>
		    
		  </div><!--DIV DEL ID MENSAJES GENERALES-->

		  <!--===============================================
	        PESTAÑA MENSAJES PERSONALIZADOS
		   ===================================================-->

		  <div id="mensajesPersonalizados" class="tab-pane fade">

		    <?php	

			$item = $_SESSION["id"];
			$item1 = 1;
			$notificaciones = ControladorUsuarios::ctrMostrarMensajesByUsuario($item, $item1);

			if($notificaciones){

				echo'<div class="chatbox">';
				echo' <div class="chatlogsGeneralesyPersonalizados">';
		    foreach ($notificaciones as $key => $value1) {
		    	$resultado1 = substr($value1["fecha"],10);
		    	

		    		echo'<div class="chat friend">
					   <div class="user-photo"><img src="'.$servidor.'vistas/img/usuarios/admin/admin.png" ></div>';
					   
						  

					echo'</div>';

		    	
		    }

		    echo'</div><!--DIV DEL CHATLOGSGENERALESYPERSONALIZADOS-->';
		    echo'<div class="chat-form">
		  			<textarea></textarea>
		  			<button>Enviar</button>
		  		</div>';

		    echo'</div><!--DIV DEL CHATBOX-->'; 

			}else{

				echo'<div class="chatbox">';
		    
		    	echo' <div class="chatlogsGeneralesyPersonalizados">';

		    		echo'<div class="chat friend">
					   
						</div>';

		    	echo'</div><!--DIV DEL CHATLOGSGENERALESYPERSONALIZADOS-->';
		    


		    echo'<div class="chat-form">
		  			<textarea></textarea>
		  			<button>Enviar</button>
		  		</div>';

		    echo'</div><!--DIV DEL CHATBOX-->';
			}
			
			?>
		  </div>


   </div><!--DIV DEL TAB CONTENT-->
 </div><!--DIV DEL CONTAINER-->
</div><!--DIV DEL CONTAINER FLUID-->



		

		

			
		  	
  	  
  





