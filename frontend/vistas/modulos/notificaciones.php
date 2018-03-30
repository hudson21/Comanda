<style>

	.menuDesplegable{display:none;}

	/*.cesta{display:none;*/}
</style>



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
					text: "¡Necesita estar logeado para poder ver sus notificaciones!",
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
		  	<a data-toggle="tab" href="#mensajesGenerales">
		  	<i class="fa fa-plane"></i> Mensajes Generales</a>
		  </li>

		 <!-- <li>
		  	<a data-toggle="tab" href="#mensajesPersonalizados">
		  	<i class="fa fa-phone"></i> Mensajes Personalizados</a>
		  </li>-->

		  

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
			  		 
			  		     <div id="chatlogsPedidos" onload="ajaxPedidos();">';

			  		     echo'<!--//////////////////////////////////////////////////////////////////////-->';


			  		     echo'<!--//////////////////////////////////////////////////////////////////////-->';

			         echo'</div>
			         </div>';
			 }else{

			 	echo'<div class="chatboxPedidos">
			  		     <div id="chatlogsPedidos" onload="ajaxPedidos();">';


			    echo'    </div>
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
			$item1 = 1;
			$notificaciones = ControladorUsuarios::ctrMostrarMensajesByUsuario($item, $item1);

			if($notificaciones){

				echo'<div class="chatboxGenerales">
			  		 
			  		     <div id="chatlogsGenerales" onload="ajaxGenerales();">';

			  		     
			  //////////////////////////Aquí va a ser el inicio del foreach()///////////////////////////////////


			  //////////////////////////Aquí va a ser el fin del foreach()//////////////////////////////////////	
			  	echo'</div><!--DIV DEL CHATLOGS GENERALES-->';
				echo'<div class="chat-form">
					   <input type="text" name="textareaGeneral" id="textareaGeneral">
					   <button class="enviarGeneral">Enviar</button>
				    </div>

					</div><!--DIV DEL CHATBOX GENERALES-->';	     
			         

			 }else{
			 	echo'<div class="chatboxGenerales">';
	  			 echo' <div id="chatlogsGenerales">';

						echo'<div class="chat friend">	   
						 	</div>';

   				 echo'</div><!--DIV DEL CHATLOGS GENERALES-->';
 
     				echo'<div class="chat-form">
		   					 <input type="text" name="textareaGeneral" id="textareaGeneral">
		  				     <button class="enviarGeneral">Enviar</button>
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
/*
			$item = $_SESSION["id"];
			$item1 = 2;
			$notificaciones = ControladorUsuarios::ctrMostrarMensajesByUsuario($item, $item1);

			if($notificaciones){

				echo'<div class="chatboxPersonalizados">
			  		 
			  		     <div id="chatlogsPersonalizados" onload="ajaxPersonalizados();">';

			  		     
			  //////////////////////////Aquí va a ser el inicio del foreach()///////////////////////////////////


			  //////////////////////////Aquí va a ser el fin del foreach()//////////////////////////////////////	
			  	   echo'</div><!--DIV DEL CHATLOGS PERSONALIZADOS-->';

				echo'<div class="chat-form">
					   <input type="text" id="textareaPersonalizados">
					   <button class="enviarPersonalizados">Enviar</button>
				    </div>

					</div><!--DIV DEL CHATBOX PERSONALIZADOS-->';	     
			         

			 }else{
			 	echo'<div class="chatboxPersonalizados">';
	  			 echo' <div id="chatlogsPersonalizados">';

						echo'<div class="chat friend">	   
						 	</div>';

   				 echo'</div><!--DIV DEL CHATLOGS PERSONALIZADOS-->';
 
     				echo'<div class="chat-form">
		   					 <input type="text" id="textareaPersonalizados">
		  				     <button class="enviarPersonalizados">Enviar</button>
	     				</div>';
	 		 echo'</div><!--DIV DEL CHATBOX-->';
			 }*/
			
			?>

		  </div>


   </div><!--DIV DEL TAB CONTENT-->
 </div><!--DIV DEL CONTAINER-->
</div><!--DIV DEL CONTAINER FLUID-->


<script>

	/*======================================
	   AJAX PARA LA PARTE DE LOS PEDIDOS       
	========================================*/
	function ajaxPedidos(){
    var req = new XMLHttpRequest();

    req.onreadystatechange = function(){
      if(req.readyState == 4 && req.status == 200){

      	document.getElementById("chatlogsPedidos").innerHTML = req.responseText;
         //console.log("req.responseText", req.responseText);
      	}
      }
    
    req.open("GET","vistas/modulos/chatPedidos.php", true);
    req.send();

    
  }
   setInterval(function(){ajaxPedidos();}, 1000);

   /*======================================
	   AJAX PARA LA PARTE DE LOS GENERALES       
	========================================*/
   function ajaxGenerales(){
    var req1 = new XMLHttpRequest();

    req1.onreadystatechange = function(){
      if(req1.readyState == 4 && req1.status == 200){
      		document.getElementById("chatlogsGenerales").innerHTML = req1.responseText;
      	}
    }

    req1.open("GET","vistas/modulos/chatGenerales.php", true);
    req1.send();
  }
   setInterval(function(){ajaxGenerales();}, 1000);

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  ENVIAR MENSAJES GENERALES     
================================================*/

 /*===================================================================
	   USAR LA OPCIÓN DE ENTER EN LOS MENSAJES DE GENERALES      
 ====================================================================*/

   $("#textareaGeneral").focus(function(){

	$(document).keyup(function(event){

		event.preventDefault();

		comentarioGeneral = document.getElementById("textareaGeneral").value;
   	    idUsuarioGenerales = localStorage.getItem("usuario");
   	    nombreUsuarioGenerales = localStorage.getItem("nombreUsuario");

		if(event.keyCode == 13 && $("#textareaGeneral").val() != ""){

			var datos = new FormData();

	   	 	datos.append("mensajeGeneral", comentarioGeneral);
	   	 	datos.append("tipoGeneral", 1);
	   	 	datos.append("idUsuarioGenerales", idUsuarioGenerales);
	   	 	datos.append("nombreUsuarioGenerales",nombreUsuarioGenerales);

   	 	$.ajax({
			 url:rutaOculta+"ajax/usuarios.ajax.php",
			 method:"POST",
			 data: datos,
			 cache: false,
			 contentType: false,
			 processData: false,
			 success:function(respuesta){
			 	//console.log("respuesta", respuesta);
			 	

			 }

			})

   	 	document.getElementById("textareaGeneral").value = "";

		}
	})
})

 /*===================================================================
	   ENVIAR A LA TABLA DE NOTIFICACIONES LO QUE HAY EN EL TEXTAREA DE GENERALES      
	==================================================================*/

   $(".enviarGeneral").click(function(){

   	 comentarioGeneral = document.getElementById("textareaGeneral").value;
   	 idUsuarioGenerales = localStorage.getItem("usuario");
   	 nombreUsuarioGenerales = localStorage.getItem("nombreUsuario");

   	 if(comentarioGeneral != ""){

   	 	document.getElementById("textareaGeneral").value = "";

   	 	var datos = new FormData();

   	 	datos.append("mensajeGeneral", comentarioGeneral);
   	 	datos.append("tipoGeneral", 1);
   	 	datos.append("idUsuarioGenerales", idUsuarioGenerales);
   	 	datos.append("nombreUsuarioGenerales",nombreUsuarioGenerales);

   	 	$.ajax({
			 url:rutaOculta+"ajax/usuarios.ajax.php",
			 method:"POST",
			 data: datos,
			 cache: false,
			 contentType: false,
			 processData: false,
			 success:function(respuesta){
			 	//console.log("respuesta", respuesta);
			 	

			 }

			})


   	 }


   })



</script>





		

		

			
		  	
  	  
  





