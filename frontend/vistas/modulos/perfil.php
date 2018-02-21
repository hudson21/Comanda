<!--===============================================
   VALIDAR SESIÓN
===================================================-->
<?php

$url = Ruta::ctrRuta();

if(!isset($_SESSION["validarSesion"])){

	echo '<script>
	
			window.location = "'.$url.'"

	</script>';

	exit();//Esto es para cancelar cualquier acción que se hada dentro de PHP
}

?>

<!--===============================================
     BREADCRUMB PERFIL
===================================================-->
<div class="container-fluid well well-sm">

	<div class="container">

		<div class="row">

			<ul class="breadcrumb  fondoBreadcrumb text-uppercase" style="margin-bottom:0px; background:rgba(0,0,0,0);">

				<li><a style="text-decoration:none;" href="<?php echo $url; ?>">INICIO</a></li>
			    <li class="active pagActiva"><?php echo $rutas[0]; ?></li>
				
			</ul>
			
		</div>
		
	</div>
	
</div>

<!--===============================================
     SECCIÓN DE PERFIL
===================================================-->
<div class="container-fluid">

	<div class="container">

		<ul class="nav nav-tabs">

		  <li class="active">
		  	<a data-toggle="tab" href="#compras">
		  	<i class="fa fa-list-ul"></i> MIS COMPRAS</a>
		  </li>

		  <li>
		  	<a data-toggle="tab" href="#deseos">
		  	<i class="fa fa-gift"></i> MI LISTA DE DESEOS</a>
		  </li>

		  <li>
		  	<a data-toggle="tab" href="#perfil">
		  	<i class="fa fa-user"></i> EDITAR PERFIL</a>
		  </li>

		  <li>
		  	<a  href="<?php echo $url; ?>ofertas">
		  	<i class="fa fa-star"></i> VER OFERTAS</a>
		  </li>

		</ul>

		<div class="tab-content">

		  <div id="compras" class="tab-pane fade in active">
		    <h3>HOME</h3>
		    <p>Some content.</p>
		  </div>

		  <div id="deseos" class="tab-pane fade">
		    <h3>Menu 1</h3>
		    <p>Some content in menu 1.</p>
  		  </div>

  		  <div id="perfil" class="tab-pane fade">
		    <h3>Menu 1</h3>
		    <p>Some content in menu 2.</p>
  		  </div>
		
		</div>
		
	</div>

</div>

