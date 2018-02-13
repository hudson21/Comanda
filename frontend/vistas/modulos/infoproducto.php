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

				$multimedia = json_decode($infoproducto["multimedia"], true);

				//var_dump($multimedia[0]["foto"]);

				/*======================================
				   VISOR DE IMAGENES       
				========================================*/

				if($infoproducto["tipo"] == "fisico"){

					echo '<div class="col-md-5 col-sm-6 col-xs-12 visorImg"> <!-- -->
		  		
					  		<figure class="visor">';

					  		for($i = 0; $i < count($multimedia); $i++){

					  			echo'<img id ="lupa'.($i + 1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'" alt="'.$infoproducto["titulo"].'">';

					  		}
			
			            	
			              echo'</figure>

			           <!-- 	<div class="flexslider">

							  <ul class="slides"> (punto y coma del echo)

							  for($i = 0; $i < count($multimedia); $i++){

							  	<li>
							      <img value="".($i + 1)." class="img-thumbnail" src="".$servidor.$multimedia[$i]["foto"]."">
							    </li>

							  }
							    
							(Inicio del otro echo)  </ul>

							</div> -->
					
					 </div>  (Final del otro echo)'; 
		}else{

			/*======================================
			  VISOR DE VIDEO
			========================================*/

			var_dump($infoproducto["multimedia"]);

			echo '<div class="col-sm-6 col-xs-12">

			<iframe class="videoPresentacion" src="https://www.youtube.com/embed/'.$infoproducto["multimedia"].'?rel=0&autoplay=0" width="100%" frameborder="0" allowfullscreen></iframe>


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

			 /*======================================
			    TITULO DEL PRODUCTO       
			 ========================================*/
			 		
			 		if($infoproducto["oferta"] == 0){

			 			if($infoproducto["nuevo"] == 0){

			 				echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'</h1>';

			 			}else{

			 				echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'
			 			
			 				<br>

							<small>
						
								<span class="label label-warning">Nuevo</span>
			 			    
			 			    </small>

			 				</h1>';	
			 			}

			 			

			 		}else{

			 			if($infoproducto["nuevo"] == 0){

			 			   echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'

			 			     <br>

			 			    <small>
						
								<span class="label label-warning">'.$infoproducto["descuentoOferta"].'% Off</span>
			 			   
			 			   </small>

			 			   </h1>';

			 			}else{

			 				echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'

			 			     <br>

			 			    <small>

			 			    	<span class="label label-warning">Nuevo</span>
						
								<span class="label label-warning">'.$infoproducto["descuentoOferta"].'% Off</span>

			 			   </small>

			 			   </h1>';


			 			}

			 			
			 		}


			 /*======================================
			    PRECIO DEL PRODUCTO       
			 ========================================*/

			 if($infoproducto["precio"] == 0){

			 	echo '<h2 class="text-muted">GRATIS</h2>';

			 }else{

			 	if($infoproducto["oferta"] == 0){

			 		echo '<h2 class="text-muted">USD $'.$infoproducto["precio"].'</h2>';

			 	}else{

			 		echo '<h2 class="text-muted">

						<span>

							<strong class="oferta">USD $'.$infoproducto["precio"].'</strong>

						</span>

						<span>

							$'.$infoproducto["precioOferta"].'

						</span>

			 		

			 		</h2>';
			 	}

			 	
			 }

			 /*======================================
			    DESCRIPCION DEL PRODUCTO       
			 ========================================*/

			 echo '<p>'.$infoproducto["descripcion"].'</p>'

			 ?>

			 <!--===============================================
		     CARACTERÍSTICAS DEL PRODUCTO
		     ===================================================-->

		     <hr>

		     <div class="form-group row">
		     	
		     	<?php

		     	if($infoproducto["detalles"] != null){

		     		$detalles = json_decode($infoproducto["detalles"],true);

		     		if($infoproducto["tipo"] == "fisico"){

		     			if($detalles["Talla"] != null){

		     				echo '<div class="col-md-3 col-xs-12">

		     				<select class="form-control seleccionarDetalle" id="seleccionarTalla">
						
								<option value="">Talla</option>';

								for($i = 0; $i <= count($detalles["Talla"]); $i++){

									echo '<option value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</option>';


								}
	
		     				echo'</select>

		     				</div>';
		     			}

		     			if($detalles["Color"] != null){

		     				echo '<div class="col-md-3 col-xs-12">

		     				<select class="form-control seleccionarDetalle" id="seleccionarTalla">
						
								<option value="">Color</option>';

								for($i = 0; $i <= count($detalles["Color"]); $i++){

									echo '<option value="'.$detalles["Color"][$i].'">'.$detalles["Color"][$i].'</option>';


								}
	
		     				echo'</select>

		     				</div>';
		     			}


		     			if($detalles["Marca"] != null){

		     				echo '<div class="col-md-3 col-xs-12">

		     				<select class="form-control seleccionarDetalle" id="seleccionarTalla">
						
								<option value="">Marca</option>';

								for($i = 0; $i <= count($detalles["Marca"]); $i++){

									echo '<option value="'.$detalles["Marca"][$i].'">'.$detalles["Marca"][$i].'</option>';


								}
	
		     				echo'</select>

		     				</div>';
		     			}



		     		}else{

		     			echo '<div class="col-xs-12">

		     			<li>
							<i style="margin-right:10px;" class="fa fa-play-circle"></i>'.$detalles["Clases"].'
		     			</li>

		     			<li>
							<i style="margin-right:10px;" class="fa fa-clock-o"></i>'.$detalles["Tiempo"].'
		     			</li> 

		     			<li>
							<i style="margin-right:10px;" class="fa fa-check-circle"></i>'.$detalles["Nivel"].'
		     			</li> 

		     			<li>
							<i style="margin-right:10px;" class="fa fa-info-circle"></i>'.$detalles["Acceso"].'
		     			</li> 

		     			<li>
							<i style="margin-right:10px;" class="fa fa-desktop"></i>'.$detalles["Dispositivo"].'
		     			</li>

		     			<li>
							<i style="margin-right:10px;" class="fa fa-trophy"></i>'.$detalles["Certificado"].'
		     			</li>  

		     			</div>';


		     		}
		     	}


		     /*--===============================================
		     ENTREGA
		     ===================================================*/

		     if($infoproducto["entrega"] == 0){

		     	if($infoproducto["precio"] == 0){ //Significa que es gratis

		     		echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

					 		<hr>

							 <span class="label label-default" style="font-weight:100">

							   <i class="fa fa-clock-o" style="margin-right:5px"></i> Entrega Inmediata |
							   <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
							   '.$infoproducto["ventasGratis"].' inscritos |
							   <i class="fa fa-eye" style="margin:0px 5px"></i>
							   visto por '.$infoproducto["vistasGratis"].' personas
					 		 </span>

		     		   	 </h4>

		     		   	 <h4 class="col-lg-0 col-md-0 col-xs-12">

					 		<hr>

							 <small>

							   <i class="fa fa-clock-o" style="margin-right:5px"></i> Entrega Inmediata<br>
							   <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
							   '.$infoproducto["ventasGratis"].' inscritos<br>
							   <i class="fa fa-eye" style="margin:0px 5px"></i>
							   visto por '.$infoproducto["vistasGratis"].' personas

					 		 </small>

		     		   	 </h4>';

		     	
		     	}else{

		     		echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

					 		<hr>

					 		<span class="label label-default" style="font-weight:100">

							   <i class="fa fa-clock-o" style="margin-right:5px"></i> Entrega Inmediata |
							   <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
							   '.$infoproducto["ventas"].' ventas |
							   <i class="fa fa-eye" style="margin:0px 5px"></i>
							   visto por '.$infoproducto["vistas"].' personas
						   
						   </span>

		     			</h4>

		     			<h4 class="col-lg-0 col-md-0 col-xs-12">

					 		<hr>

					 		<small>

							   <i class="fa fa-clock-o" style="margin-right:5px"></i> Entrega Inmediata<br>
							   <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
							   '.$infoproducto["ventas"].' ventas<br>
							   <i class="fa fa-eye" style="margin:0px 5px"></i>
							   visto por '.$infoproducto["vistas"].' personas
						   
						   </small>

		     			</h4>';

		     	}

		     	

		     }else{

		     	if($infoproducto["precio"] == 0){

		     	echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

					 	<hr>

					 	<span class="label label-default" style="font-weight:100">

						   <i class="fa fa-clock-o" style="margin:0px 5px"></i>
						   '.$infoproducto["entrega"].' días hábiles para la entrega |
						   <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
						   '.$infoproducto["ventasGratis"].' solicitudes |
						   <i class="fa fa-eye" style="margin:0px 5px"></i>
						   visto por '.$infoproducto["vistasGratis"].' personas
					 	</span>

		     		</h4>

		     		<h4 class="col-lg-0 col-md-0 col-xs-12">

					 	<hr>

					 	<small>

						   <i class="fa fa-clock-o" style="margin:0px 5px"></i>
						   '.$infoproducto["entrega"].' días hábiles para la entrega<br>
						   <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
						   '.$infoproducto["ventasGratis"].' solicitudes<br>
						   <i class="fa fa-eye" style="margin:0px 5px"></i>
						   visto por '.$infoproducto["vistasGratis"].' personas 

					 	</small>

		     		</h4>';


		     }else{

		     	echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

					 	<hr>

					 	<span class="label label-default" style="font-weight:100">

					   	<i class="fa fa-clock-o" style="margin:0px 5px"></i>
					   	'.$infoproducto["entrega"].' días hábiles para la entrega |
					   	<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
					   	'.$infoproducto["ventas"].' ventas |
					   	<i class="fa fa-eye" style="margin:0px 5px"></i>
					  	 visto por '.$infoproducto["vistas"].' personas
					 	</span>

		     	     </h4>

		     	     <h4 class="col-lg-0 col-md-0 col-xs-12">

					 	<hr>

					 	<small>

						   	<i class="fa fa-clock-o" style="margin:0px 5px"></i>
						   	'.$infoproducto["entrega"].' días hábiles para la entrega<br>
						   	<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
						   	'.$infoproducto["ventas"].' ventas<br>
						   	<i class="fa fa-eye" style="margin:0px 5px"></i>
						  	 visto por '.$infoproducto["vistas"].' personas 

					 	</small>

		     	     </h4>';



		     }
		  }

		     	?>

		     </div>

		     <!--===============================================
		     BOTONES DE COMPRA
		     ===================================================-->

		     <div class="row botonesCompra">

		     	<?php

		     		if($infoproducto["precio"] == 0){

		     			echo '<div class="col-md-6 col-xs-12">';

		     			if($infoproducto["tipo"] == "virtual"){

						   echo'<button class="btn btn-default btn-block btn-lg backColor">ACCEDER AHORA</button>';
					    
					     }else{

					       echo'<button class="btn btn-default btn-block btn-lg backColor">SOLICITAR AHORA</button>';

					     }
							  echo'</div>';
					     
		     		}else{

		     		    if($infoproducto["tipo"] == "virtual"){

		     		    	echo '<div class="col-md-6 col-xs-12">

								<button class="btn btn-default btn-block btn-lg ">

								<small>COMPRAR AHORA</small></button>
					
							  </div>

		     				  
		     				  <div class="col-md-6 col-xs-12">
					
								<button class="btn btn-default btn-block btn-lg backColor">

								<small>AGREGAR AL CARRITO</small>

								<i class="fa fa-shopping-cart col-md-0"></i>

								</button>

							 </div>';

		     		    }else{

		     		    	echo '<div class="col-lg-6 col-md-8 col-xs-12">
					
									<button class="btn btn-default btn-block btn-lg backColor">

									AGREGAR AL CARRITO

									<i class="fa fa-shopping-cart col-xs-0"></i>

									</button>

								  </div>';


		     		    }

		     			
		     		}
		     	?>
		     	
				

				


		     </div>


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

