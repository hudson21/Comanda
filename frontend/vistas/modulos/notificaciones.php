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

		  	<div class="panel-group">

		  	<h2>Mensajes de Pedidos</h2>

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




