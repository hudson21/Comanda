<?php

$servidor = Ruta::ctrRutaServidor();

$url = Ruta::ctrRuta();

?>

<!--===============================================
BREADCRUMB DE INFO PRODUCTOS
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

				//var_dump($multimedia);

				/*======================================
				   VISOR DE IMAGENES       
				========================================*/

				if($infoproducto["tipo"] == "fisico"){

					echo '<div class="col-md-5 col-sm-6 col-xs-12 visorImg"> <!-- -->
		  		
					  		<figure class="visor">';

					  		if($multimedia != null){

					  			for($i = 0; $i < count($multimedia); $i++){

					  			echo'<img id ="lupa'.($i + 1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'" alt="'.$infoproducto["titulo"].'">';

					  		}
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
					
					 </div>  '; 
		}else{

			/*======================================
			  VISOR DE VIDEO
			========================================*/

			//var_dump($infoproducto["multimedia"]);

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
							   visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas
					 		 </span>

		     		   	 </h4>

		     		   	 <h4 class="col-lg-0 col-md-0 col-xs-12">

					 		<hr>

							 <small>

							   <i class="fa fa-clock-o" style="margin-right:5px"></i> Entrega Inmediata<br>
							   <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
							   '.$infoproducto["ventasGratis"].' inscritos<br>
							   <i class="fa fa-eye" style="margin:0px 5px"></i>
							   visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas

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
							   visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas
						   
						   </span>

		     			</h4>

		     			<h4 class="col-lg-0 col-md-0 col-xs-12">

					 		<hr>

					 		<small>

							   <i class="fa fa-clock-o" style="margin-right:5px"></i> Entrega Inmediata<br>
							   <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
							   '.$infoproducto["ventas"].' ventas<br>
							   <i class="fa fa-eye" style="margin:0px 5px"></i>
							   visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas
						   
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
						   visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas
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
						   visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas 

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
					  	 visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas
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
						  	 visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas 

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

						   echo'<button style="margin-bottom:10px" class="btn btn-default btn-block btn-lg backColor">ACCEDER AHORA</button>';
					    
					     }else{

					       echo'<button style="margin-bottom:10px" class="btn btn-default btn-block btn-lg backColor">SOLICITAR AHORA</button>';

					     }
							  echo'</div>';
					     
		     		}else{

		     		    if($infoproducto["tipo"] == "virtual"){

		     		    	echo '<div class="col-md-6 col-xs-12">

								<button class="btn btn-default btn-block btn-lg ">

								<small>COMPRAR AHORA</small></button>
					
							  </div>

		     				  
		     				  <div class="col-md-6 col-xs-12">

					
							<button style="margin-bottom:10px" class="btn btn-default btn-block btn-lg backColor agregarCarrito" idProducto="'.$infoproducto["id"].'" 
									  imagen="'.$servidor.$infoproducto["portada"].'"
									  titulo="'.$infoproducto["titulo"].'"
									  precio="'.$infoproducto["precio"].'" 
									  tipo="'.$infoproducto["tipo"].'" 
									  peso="'.$infoproducto["peso"].'"
									  excepciones="'.$infoproducto["excepciones"].'">

								<small>AGREGAR AL CARRITO</small>

								<i class="fa fa-shopping-cart col-md-0"></i>

								</button>

							 </div>';

		     		    }else{

		     		    	echo '<div class="col-lg-6 col-md-8 col-xs-12">
					
							<button style="margin-bottom:10px" class="btn btn-default btn-block btn-lg backColor agregarCarrito" idProducto="'.$infoproducto["id"].'" 
									  imagen="'.$servidor.$infoproducto["portada"].'"
									  titulo="'.$infoproducto["titulo"].'"
									  precio="'.$infoproducto["precio"].'" 
									  tipo="'.$infoproducto["tipo"].'" 
									  peso="'.$infoproducto["peso"].'"
									  excepciones="'.$infoproducto["excepciones"].'">

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
		 
		 <!--===============================================
		  COMENTARIOS
		  ===================================================-->

		<!--  <br>

		  <div class="row">

		  	<?php 

		  	$datos = array("idUsuario"=>"",
		  					"idProducto"=>$infoproducto["id"]);

		  	$comentarios = ControladorUsuarios::ctrMostrarComentariosPerfil($datos);
		  	$cantidad = 0;

		  	
		  	foreach( $comentarios as $key  => $value){
		  	
		  	  	if($value["comentario"] != ""){

		  	  		$cantidad += count(explode(",",$value["id"]));//Cuantos id vienen con comentario

		  	  		//var_dump($cantidad);

		  	  	}
		  	}

		  	?>
		  	
			<ul class="nav nav-tabs">

				<?php/* 

					if($cantidad == 0){

						echo '<li class="active"><a>ESTE PRODUCTO NO TIENE COMENTARIOS</a></li>
							 	<li></li>';
					
					}else{

						echo '<li class="active"><a> COMENTARIOS '.$cantidad.'</a></li>
							  <li><a id="verMas" href="#">VER MÁS</a></li>';

					     $sumaCalificacion = 0;

						for($i = 0; $i < $cantidad; $i++){

							$sumaCalificacion += $comentarios[$i]["calificacion"]; 

						}

						$promedio = round($sumaCalificacion/$cantidad,1);//El round es para poder redondear un número (valor,"número de lugares después de la coma") 

						//var_dump($promedio);

						echo '<li class="pull-right"><a class="text-muted" href="#">PROMEDIO DE CALIFICACIÓN: '.$promedio.' |';

						if($promedio == 0 ){

						echo '<i class="fa fa-star-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio > 0 && $promedio < 0.5){

						echo '<i class="fa fa-star-half-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>';

						}

						else if ($promedio == 0.5){

						echo '<i class="fa fa-star-half-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>
							  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio > 0.5 && $promedio < 1){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio == 1){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio > 1 && $promedio < 1.5){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-half-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio == 1.5){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-half-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio > 1.5 && $promedio < 2){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio == 2){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio > 2 && $promedio < 2.5){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-half-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio == 2.5){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-half-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio > 2.5 && $promedio < 3){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio == 3){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio > 3 && $promedio < 3.5){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-half-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio == 3.5){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-half-o text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio > 3.5 && $promedio < 4){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio == 4){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-o text-success"></i>';

						}

						else if($promedio > 4 && $promedio < 4.5){

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star-half-o text-success"></i>';

						}else{

							echo '<i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>
								  <i class="fa fa-star text-success"></i>';

						}

					}

				?>
				
				

				</a></li>
			</ul>

			<br>



		  </div>

		  <div class="row comentarios">

		  	<?php 


		  	foreach($comentarios as $key  => $value){

		  		if($value["comentario"] != ""){

		  			$item = "id";
		  			$valor = $value["id_usuario"];

		  			$usuario = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

		  			echo '<div class="panel-group col-md-3 col-sm-6 col-xs-12 alturaComentarios">

		  					<div class="panel panel-default">

		  				<div class="panel-heading text-uppercase">

			  				'.$usuario["nombre"].'
							<span class="text-right">';

							if($usuario["modo"] == "directo"){

								if($usuario["foto"] == ""){

									echo '<img class="img-circle pull-right" src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" width="20%">';

								}else{

									echo '<img class="img-circle pull-right" src="'.$url.$usuario["foto"].'" width="20%">';

								}

								
							
							}else{

								echo '<img class="img-circle pull-right" src="'.$usuario["foto"].'" width="20%">';
							}
								
							
					    echo'</span>

		  			    </div>

		  			    <div class="panel-body"><small>'.$value["comentario"].'</small></div>

			  				<div class="panel-footer">';

			  				switch($value["calificacion"]){

								case 0.5:
								echo '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
								break;

								case 1.0:
								echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
								break;

								case 1.5:
								echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
								break;

							    case 2.0:
							    echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
							    break;

								case 2.5:
								echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
								break;

								case 3.0:
								echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
								break;

								case 3.5:
								echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
								break;

								case 4.0:
								echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
								break;

								case 4.5:
								echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>';
								break;

								case 5.0:
								echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>
									  <i class="fa fa-star text-success" aria-hidden="true"></i>';
								break;

						}	   

						echo'</div>

		  				</div>
		  		
		  			</div>';
		  		}
		  	
		  	  
		  	}

		  	?>

		  	
		  	
		  </div>

		<hr>

	</div>
	

</div>-->

<!--=================================================================================
 ARTÍCULOS RELACIONADOS
====================================================================================-->

	<!--		<div class="container-fluid productos">

					<div class="container">
				
						<div class="row">

							<div class="col-xs-12 tituloDestacado">

								<div class="col-sm-6 col-xs-12">

									<h1><small>PRODUCTOS RELACIONADOS</small></h1>

								</div>

					  <div class="col-sm-6 col-xs-12">

					  	<?php /*

					  	$item = "id";

					  	$valor = $infoproducto["id_subcategoria"]; 

					  	$rutaArticulosDestacados = ControladorProductos::ctrMostrarSubcategorias($item, $valor);

					  //	var_dump($rutaArticulosDestacados[0]["ruta"]);

					  	echo '<a href="'.$url.$rutaArticulosDestacados[0]["ruta"].'">
						 			
						 	  <button class="btn btn-default backColor pull-right">
						 				
								  VER MÁS <span class="fa fa-chevron-right"></span>

						 	  </button>

						   </a>	';

					  	?>	   
						 		
					 </div>

			      </div>

			   <div class="clearfix"></div>

			    <hr>
									
			  </div>

			  <?php

			  $ordenar = "";
			  $item = "id_subcategoria";
			  $valor = $infoproducto["id_subcategoria"];
			  $base = 0;
			  $tope = 4;
			  $modo = "Rand()";//De esta manera estamos haciendo que el modo sea aleatorio

			  $relacionados = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

			 // var_dump($relacionados);

			  if(!$relacionados){

			  	echo '<div class="col-xs-12 error404">

			  			<h1><small>¡Oops!</small></h1>

						<h2>No hay productos relacionados</h2>

			  		</div>';
			  }else{


			  	echo '<ul class="grid0">';

				foreach($relacionados as $key => $value){
			 							
			 	  echo '<li class=" col-md-3 col-sm-6 col-xs-12">

			 		<figure>
			 		
			 			<a href="'.$url.$value["ruta"].'" class="pixelProducto">
			 			
			 			<img src="'.$servidor.$value["portada"].'" class="img-responsive">

			 			</a>

			 		</figure>



			 	<h4>

			 		<small>
			 			
			 			<a href="'.$url.$value["ruta"].'" class="pixelProducto">

			 			'.$value["titulo"].' <br>

			 			<span style="color:rgba(0,0,0,0)">-</span>';

			 			
			 				if($value["nuevo"] != 0){

			 					echo '<span class="label label-warning fontSize">Nuevo</span> ';
			 		    	}

			 				if($value["oferta"] != 0){

			 					echo '<span class="label label-warning fontSize">
			 					'.$value["descuentoOferta"].'% Off</span>';

			 				}

			 	echo'</a> 

			 		</small>

			 	</h4>

			          <div class="col-xs-6 precio">';

							if($value["precio"] == 0){

								echo '<h2><small>GRATIS</small></h2>';

							}else{

							
							if($value["oferta"] != 0){

							    echo ' <h2>

			 		 						<small>
			 		 	
			 		 		                <strong class="oferta" style="font-size:15px;">
			 		 		                USD $'.$value["precio"].'</strong>
			 		 	
			 		 						</small>

			 		 		                <small style="font-size:20px;font-weight:bold;">
			 		 		                $'.$value["precioOferta"].'</small>

			 		 				  </h2>';

							}else{

								echo '<h2>

							                <small style="font-size:20px;font-weight:bold;">
							                USD $'.$value["precio"].'</small></h2>';

								  }

							}
			 	
			 					

			echo '</div>
			 			
			 		<div class="col-xs-6 enlaces">	

			 			<div class="btn-group pull-right">
			 			
							<button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id"].'" 
							data-toggle="tooltip" title="Agregar a mi lista de deseos">
								
								<i class="fa fa-heart" aria-hidden="true"></i>

							</button>';

						  if($value["tipo"] == "virtual" && $value["precio"] != 0){


						    if($value["oferta"] != 0){

								echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" 
									  imagen="'.$servidor.$value["portada"].'"
									  titulo="'.$value["titulo"].'" 
									  precio="'.$value["precioOferta"].'" 
									  tipo="'.$value["tipo"].'" 
									  peso="'.$value["peso"].'"
									  excepciones="'.$value["excepciones"].'" 
									  data-toggle="tooltip" 
							          title="Agregar al carrito de compras">
								
								      <i class="fa fa-shopping-cart" aria-hidden="true"></i>

							          </button>';
							}else{

								echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" 
									  imagen="'.$servidor.$value["portada"].'"
									  titulo="'.$value["titulo"].'" 
									  precio="'.$value["precio"].'" 
									  tipo="'.$value["tipo"].'" 
									  peso="'.$value["peso"].'"
									  excepciones="'.$value["excepciones"].'" 
									  data-toggle="tooltip" 
							          title="Agregar al carrito de compras">
								
								      <i class="fa fa-shopping-cart" aria-hidden="true"></i>

							          </button>';
									}

								
								}

							    
							  echo '<a href="'.$url.$value["ruta"].'" class="pixelProducto">
								
									   <button type="button" class="btn btn-default btn-xs" 
										data-toggle="tooltip" title="Ver producto">
									
										  <i class="fa fa-eye" aria-hidden="true"></i>
																
									    </button>

									</a>

			 				</div>

			 			</div>

			 	
					 </li>';

					}

			echo '</ul>';

				}
				*/
			?> 

		</div>

	</div> -->

<script>

/*=============================================
ALTURA COMENTARIOS
=============================================*/
$(".comentarios").css({"height":$(".comentarios .alturaComentarios").height()+"px",
						"overflow":"hidden",
						"margin-bottom":"20px"})

$("#verMas").click(function(e){

	e.preventDefault();

	if($("#verMas").html() == "VER MÁS"){

		$(".comentarios").css({"overflow":"inherit"});

		$("#verMas").html("VER MENOS");

	}else{

		$(".comentarios").css({"height":$(".comentarios .alturaComentarios").height()+"px",
						"overflow":"hidden",
						"margin-bottom":"20px"})

		$("#verMas").html("VER MÁS");

	}
})
	
</script>


