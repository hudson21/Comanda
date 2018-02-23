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

			<!--===============================================
			   PESTAÑA COMPRAS
			===================================================-->
		  <div id="compras" class="tab-pane fade in active">

		  	<div class="panel-group">

		  		<?php 

		  		$item = "id_usuario";
		  		$valor = $_SESSION["id"];

		  		$compras = ControladorUsuarios::ctrMostrarCompras($item, $valor);

		  		//var_dump($compras);
		  		if(!$compras){

		  			echo '<div class="col-xs-12 text-center" id="error404">

						<h1><small>¡Oops!</small></h1>

						<h2>Aún no tienes compras realizadas en esta tienda</h2>

		  			</div>';

		  		}else {

		  			foreach($compras as $key => $value){

		  				echo '<div class="panel panel-default">
							    <div class="panel-body">Panel Content</div>
							  </div>

							  <div class="panel panel-default">
							    <div class="panel-body">Panel Content</div>
							  </div>';
		  			}
		  		}

		  		?>

			  

			</div>
		    
		  </div>

		  <!--===============================================
			   PESTAÑA DESEOS
			===================================================-->
		  <div id="deseos" class="tab-pane fade">
		    <h3>Menu 1</h3>
		    <p>Some content in menu 1.</p>
  		  </div>

  		    <!--===============================================
			   PESTAÑA PERFIL
			===================================================-->
  		  <div id="perfil" class="tab-pane fade">
		    
		    	<div class="row">

		    		<form method="POST" enctype="multipart/form-data"> <!--El enctype es para poder cambiar luego las fotos-->
		    			
						<div class="col-md-3 col-sm-4 col-xs-12 text-center">
							<br>

							<figure id="imgPerfil">
								
							<?php

								echo '<input type="hidden" value="'.$_SESSION["id"].'" id="idUsuario" name="idUsuario">
							      	  <input type="hidden" value="'.$_SESSION["password"].'" name="passUsuario">
							          <input type="hidden" value="'.$_SESSION["foto"].'" name="fotoUsuario" id="fotoUsuario">
							          <input type="hidden" value="'.$_SESSION["modo"].'" name="modoUsuario" id="modoUsuario">';

								if($_SESSION["modo"] == "directo"){

									if($_SESSION["foto"] != ""){

										echo '<img src="'.$url.$_SESSION["foto"].'" class="img-thumbnail">';

									}else{

										echo '<img src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" class="img-thumbnail">';

									}

								}else{

									echo '<img src="'.$_SESSION["foto"].'" class="img-thumbnail">';
								}


							?>

							</figure>

							<br>

							<?php 
							
							if($_SESSION["modo"] == "directo"){
							
							echo '<button type="button" class="btn btn-default" id="btnCambiarFoto">
									
									Cambiar foto de perfil
									
									</button>';

							}

							?>

							<div id="subirImagen">
								
								<input type="file" class="form-control" id="datosImagen" name="datosImagen">

								<img class="previsualizar">

							</div>

						</div>	

						<div class="col-md-9 col-sm-8 col-xs-12">

						<br>
							
						<?php

						if($_SESSION["modo"] != "directo"){

							echo '<label class="control-label text-muted text-uppercase">Nombre:</label>
									
									<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<input type="text" class="form-control"  value="'.$_SESSION["nombre"].'" readonly>

									</div>

									<br>

									<label class="control-label text-muted text-uppercase">Correo electrónico:</label>
									
									<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<input type="text" class="form-control"  value="'.$_SESSION["email"].'" readonly>

									</div>

									<br>

									<label class="control-label text-muted text-uppercase">Modo de registro en el sistema:</label>
									
									<div class="input-group">
								
										<span class="input-group-addon"><i class="fa fa-'.$_SESSION["modo"].'"></i></span>
										<input type="text" class="form-control text-uppercase"  value="'.$_SESSION["modo"].'" readonly>

									</div>

									<br>';
		

						}else{

							echo '<label class="control-label text-muted text-uppercase" for="editarNombre">Cambiar Nombre:</label>
									
									<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<input type="text" class="form-control" id="editarNombre" name="editarNombre" value="'.$_SESSION["nombre"].'">

									</div>

								<br>

								<label class="control-label text-muted text-uppercase" for="editarEmail">Cambiar Correo Electrónico:</label>

								<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
										<input type="text" class="form-control" id="editarEmail" name="editarEmail" value="'.$_SESSION["email"].'">

									</div>

								<br>

								<label class="control-label text-muted text-uppercase" for="editarPassword">Cambiar Contraseña:</label>

								<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
										<input type="text" class="form-control" id="editarPassword" name="editarPassword" placeholder="Escribe la nueva contraseña">

									</div>

								<br>

								<button type="submit" class="btn btn-default backColor btn-md pull-left">Actualizar Datos</button>';

						}

						?>

						</div>

						<?php

							$actualizarPerfil = new ControladorUsuarios();
							$actualizarPerfil->ctrActualizarPerfil();

						?>					


		    		</form>
		    		
		    		<button class="btn btn-danger btn-md pull-right" id="eliminarUsuario">Eliminar Cuenta</button>

		    	</div>
  		  </div>
		
		</div>
		
	</div>

</div>




