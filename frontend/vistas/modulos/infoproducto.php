<?php

$servidor = Ruta::ctrRutaServidor();

$url = Ruta::ctrRuta();

?>

<!--===============================================
BREADCRUMB DE INFO PRODUCTOS
===================================================-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" >
<link rel="stylesheet" src="<?php echo $url;?>vistas/css/plugins/flexslider.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >


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
INFO PRODUCTOS
===================================================-->
<div class="container-fluid infoproducto">

	<div class="container">

		<div class="row">

			<?php

			    $item = "ruta";
			    $valor = $rutas[0];

				$infoproducto = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

				/*======================================
				   VISOR DE IMAGENES       
				========================================*/

				if($infoproducto["tipo"] == "fisico"){

					echo '<div class="col-md-5 col-sm-6 col-xs-12 visorImg"> <!-- -->
		  		
					  		<figure class="visor">

				           		<img id ="lupa1" class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-01.jpg" alt="tennis verder 11">

				           		<img id ="lupa2" class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-02.jpg" alt="tennis verder 11">

				           		<img id ="lupa3" class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-03.jpg" alt="tennis verder 11">

				           		<img id ="lupa4" class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-04.jpg" alt="tennis verder 11">

				           		<img id ="lupa5" class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-05.jpg" alt="tennis verder 11">			
			            	</figure>

			           <!-- 	<div class="flexslider">

							  <ul class="slides">

							    <li>
							      <img value="2" class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-02.jpg">
							    </li>

							    <li>
							      <img value="3" class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-03.jpg">
							    </li>

							    <li>
							      <img value="4" class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-04.jpg">
							    </li>

							    <li>
							      <img value="5" class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-05.jpg">
							    </li>
							    
							  </ul>

							</div> -->
					
					 </div>';
		}else{

			/*======================================
			  VISOR DE VIDEO
			========================================*/

			echo '<div class="col-sm-6 col-xs-12">

			<iframe class="videoPresentacion" src="https://www.youtube.com/embed/N4aY6yX-MaM?rel=0&autoplay=0" width="100%" frameborder="0" allowfullscreen></iframe>


			</div>';


		}
			?>


		 <!--===============================================
		   PRODUCTO
		 ===================================================-->

		 <?php

		 	if($infoproducto["tipo"] == "fisico"){

		 		echo '<div class="col-md-7 col-sm-6 col-xs-12">';

		 	}else{

		 		echo '<div class="col-sm-6 col-xs-12">';

		 	}

		 ?>
		 

		 	<!--===============================================
		  	 REGRESAR A LA TIENDA
			 ===================================================-->

		 	<div class="col-xs-6">

		 		<h6>
		 			
		 			<a style="text-decoration:none;" href="javascript:history.back()" class="text-muted">
		 				
		 				<i class="fa fa-reply"></i> Continuar Ordenando
		 			</a>
		 		</h6>
		 		

		 	</div>


		 	<!--===============================================
		  	 COMPARTIR EN REDES SOCIALES
			 ===================================================-->
		 	
		 	<div class="col-xs-6">

		 		<h6>
		 			
		 			<a style="text-decoration:none; " class="dropdown-toggle pull-right text-muted" data-toggle="dropdown" href="" >
		 				
		 				<i class="fa fa-plus"></i> Compartir

		 			</a>

		 			<ul class="dropdown-menu pull-right compartirRedes" 
		 			    style="border:0px;box-shadow:none;margin:0px;">

		 				<li>
		 					<p class="btnFacebook">
		 						<i class="fa fa-facebook"></i>
		 						Facebook
		 					</p>
		 				</li>

		 				<li>
		 					<p class="btnGoogle">
		 						<i class="fa fa-google"></i>
		 						Google
		 					</p>
		 				</li>
		 				

		 			</ul>

		 		</h6>
		 		

		 	</div>

		 	<div class="clearfix"></div>

		 	<!--===============================================
		   	 ESPACIO PARA EL PRODUCTO
			 ===================================================-->

			 <?php
			 		
			 		if($infoproducto["oferta"] == 0){

			 			if($infoproducto["nuevo"] == 0){

			 				echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'</h1>';

			 			}else{

			 				
			 			}

			 			

			 		}else{

			 			echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'

			 			<br>

			 			<small>
						
							<span class="label label-warning">'.$infoproducto["descuentoOferta"].'% Off</span>
			 			</small>
			 			</h1>';
			 		}
			 ?>

			 


		    <!--===============================================
		     ZONA DE LUPA
		     ===================================================-->

			 <figure class="lupa">

			 	<img src="">
			 	
			 </figure>

		 </div>
		
		</div>

	</div>
	

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="<?php echo $url; ?>vistas/js/plugins/jquery.flexslider.js"></script>
<script src="<?php echo $url; ?>../vistas/js/plugins/jquery.min.js"></script>
<script src="<?php echo $url; ?>../vistas/js/plugins/bootstrap.min.js"></script>

