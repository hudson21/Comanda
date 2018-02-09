<!--===============================================
BARRA DE PRODUCTOS
===================================================-->

<div class="container-fluid well well-sm barraProductos">

   	<div class="container">

	  	<div class="row">

	  		<div class="col-sm-6 col-xs-12">
	  			
				<div class="btn-group">

					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						
						Ordenar Productos <span class="caret"></span></button>

					<ul class="dropdown-menu" role="menu">

                    <?php

						echo'<li><a href="'.$url.$rutas[0].'/1/recientes/'.$rutas[3].'">Más reciente</a></li>
						     <li><a href="'.$url.$rutas[0].'/1/antiguos/'.$rutas[3].'">Más antiguo</a></li>';
					?>						
					</ul>

				</div>

	  		</div>

	    	<div class="col-sm-6 col-xs-12 organizarProductos"> 
		
			<!--Con solo colocar la clase mas pequeña de tamaño
		 	estamos diciento que esta clase va abarcar toda la 
		 	pantalla de nuestro sitio web-->

				<div class="btn-group pull-right">

					<button type="button" class="btn btn-default btnGrid" id="btnGrid0">

						<i class="fa fa-th" aria-hidden="true"></i>

						<span class="visible-lg visible-md visible-sm pull-right">GRID</span>
											
					</button>


					<button type="button" class="btn btn-default btnList" id="btnList0">

						<i class="fa fa-list" aria-hidden="true"></i>

						<span class="visible-lg visible-md visible-sm pull-right">LIST</span>
											
					</button>
										
				</div>
									

			</div>
							

   		</div>
						

 	</div>
					

</div>

<!--===============================================
LISTAR PRODUCTOS
===================================================-->

<div class="container-fluid productos">

		<div class="container">
		
				<div class="row">

					<!--===============================================
					BREADCRUMB O MIGAS DE PAN
					===================================================-->

					<ul class="breadcrumb fondoBreadcrumb lead text-uppercase"
					style="margin-bottom:0px; background:rgba(0,0,0,0);"> 

					  <!--La clase lead es para colocar el texto más grande-->
						
						<li><a style="text-decoration:none;" 
							   href="<?php echo $url; ?>">INICIO</a></li>
						<li class="active pagActiva"><?php echo $rutas[0]; ?></li>

					</ul>


					<?php

					/*===============================================================
									LLAMADO DE PAGINACIÓN         
					=================================================================*/

					if(isset($rutas[1])){

						$_SESSION["ordenar"] = "DESC";

						if(isset($rutas[2])){

							if($rutas[2] == "antiguos"){

								$modo = "ASC";
								$_SESSION["ordenar"] == $modo;
								//var_dump($_SESSION["ordenar"]);
								
							}else{

								$modo = "DESC";
								$_SESSION["ordenar"] == $modo;
								//var_dump($_SESSION["ordenar"]);

							}

						}else{
								$modo = $_SESSION["ordenar"];
								//var_dump($_SESSION["ordenar"]);
						     }

						$base = ($rutas[1] - 1)*12;
						$tope = 12;
					}else{

						$rutas[1] = 1;
						$base = 0;
						$tope = 12;
						$modo = "DESC";
						
					}

					/*======================================
					   LLAMADO DE PRODUCTOS POR BÚSQUEDA	       
					========================================*/

					$productos = null;
					$listaProductos = null;

					$ordenar="id";

					if(isset($rutas[3])){

						$busqueda = $rutas[3];

					   $productos = ControladorProductos::ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope);
					   $listaProductos = ControladorProductos::ctrListarProductosBusqueda($busqueda);
					}

					


					if(!$productos){

						echo '<div class="col-xs-12 error404 text-center">

								<h1><small>¡Oops!</small></h1>

								<h2>Aún no hay productos en esta sección</h2>

						 </div>';
					
					}else{

						echo ' <ul class="grid0">';

						foreach($productos as $key => $value){
	 							
			 	echo '<li class=" col-md-3 col-sm-6 col-xs-12">

			 		<figure>
			 		
			 			<a href="'.$value["ruta"].'" class="pixelProducto">
			 			
			 			<img src="'.$servidor.$value["portada"].'" class="img-responsive">

			 			</a>

			 		</figure>

					'.$value["id"].'

			 	<h4>

			 		<small>
			 			
			 			<a href="'.$value["ruta"].'" class="pixelProducto">

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

										echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" 
											  idProducto="'.$value["id"].'" 
											  imagen="'.$servidor.$value["portada"].'"
											  titulo="'.$value["titulo"].'" 
											  precio="'.$value["precioOferta"].'" 
											  tipo="'.$value["tipo"].'" 
											  peso="'.$value["peso"].'" 
											  data-toggle="tooltip" 
									          title="Agregar al carrito de compras">
										
										      <i class="fa fa-shopping-cart" aria-hidden="true"></i>

									          </button>';
									}else{

										echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" 
											  idProducto="'.$value["id"].'" 
											  imagen="'.$servidor.$value["portada"].'"
											  titulo="'.$value["titulo"].'" 
											  precio="'.$value["precio"].'" 
											  tipo="'.$value["tipo"].'" 
											  peso="'.$value["peso"].'" 
											  data-toggle="tooltip" 
									          title="Agregar al carrito de compras">
										
										      <i class="fa fa-shopping-cart" aria-hidden="true"></i>

									          </button>';
											}

										
										}

									    
									  echo '<a href="'.$value["ruta"].'" class="pixelProducto">
										
											   <button type="button" class="btn btn-default btn-xs" 
												data-toggle="tooltip" title="Ver producto">
											
												  <i class="fa fa-eye" aria-hidden="true"></i>
																		
											    </button>

											</a>

					 			</div>

					 	</div>

					 	
					 </li>';

				}

				echo '</ul>

				<!--===============================================
				VITRINA DE PRODUCTOS EN LISTA
				===================================================-->

		<ul class="list0" style="display:none;" >';

		foreach($productos as $key => $value){


			echo'<li class="col-sx-12">
					
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">

				   <figure>
							
					 <a href="'.$value["ruta"].'" class="pixelProducto">
					 <img src="'.$servidor.$value["portada"].'" class="img-responsive"></a>

				   </figure>
						
				</div>

			
				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">

				<h1>
							
					<small>

					 <a href="'.$value["ruta"].'" class="pixelProducto">'.$value["titulo"].' <br>';

					 if($value["nuevo"] != 0){

	 					echo '<span class="label label-warning">
	 					Nuevo</span> ';
	 				 }

	 				 if($value["oferta"] != 0){

	 					echo '<span class="label label-warning ">
	 					'.$value["descuentoOferta"].'% Off</span>';
	 			     }

                   

                echo'</a>

					</small>

				</h1>

				  <p class="text-muted">'.$value["titular"].'</p>';


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

				echo'<div class="btn-group pull-left enlaces">
							
					 <button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" 
					 title="Agregar a mi lista de deseos">

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
							  data-toggle="tooltip" 
					          title="Agregar al carrito de compras">
						
						      <i class="fa fa-shopping-cart" aria-hidden="true"></i>

					          </button>';
							}

						
						}

			    echo'<a href="'.$value["ruta"].'" class="pixelProducto">
								
						  <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

							  <i class="fa fa-eye" ara-hidden="true"></i>
									
						  </button>							

					  </a>

				 </div>
						

			   </div>

             <div class="col-xs-12">

            <hr>
                     	
          </div>

	 </li>';

		}

	echo'</ul>';
					}

					//var_dump(count($listaProductos));

					?>

					<div class="clearfix"></div>

				<center>

					<!--===============================================
						PAGINACIÓN
					 ===================================================-->	

					<?php

					if(count($listaProductos) != 0){

						$pagProductos = ceil(count($listaProductos)/12);
						//El método ceil redondea los decimales al número entero mayor
						//El floor redondea los decimalos al número entero menor

					    if($pagProductos > 4){

					    	/*==========================================================
					    	  LOS BOTONES DE LAS PRIMERAS 4 PÁGINAS Y LA ÚLTIMA PÁGINA      
					    	============================================================*/
					    	if($rutas[1] == 1){

							    	echo ' <ul class="pagination">'; 

							    	for ($i = 1; $i <= 4; $i++){

							  					echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
							    	} 

							  echo' <li class="disabled"><a>...</a></li>
									<li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a> </li>
									<li><a href="'.$url.$rutas[0].'/2/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

							    	</ul>';
  						 }

							  

					    	  /*==========================================================
					    	  LOS BOTONES DE LA PRIMERA MITAD DE PÁGINAS HACIA ABAJO   
					    	  ============================================================*/

					    	  else if($rutas[1] != $pagProductos && 
					    	  		  $rutas[1] != 1 &&
					    	  		  $rutas[1] < ($pagProductos/2) &&
					    	  		  $rutas[1] < ($pagProductos-3)	){
/*La primera condición es para saber si es diferente al total de páginas (en este caso 24)

  La segunda condición es para saber si es diferente a 1 (para no estar al principio)

  La tercera condición es para saber si es menor a la mitad de $pagProductos 

  La cuarta condición es para saber si menor a pagProductos-3*/

  									$numPagActual = $rutas[1];

  								echo ' <ul class="pagination">
										<li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
  									'; 

							    	for ($i = $numPagActual; $i <= ($numPagActual+3); $i++){

							    		echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
							    	} 

							  echo' <li class="disabled"><a>...</a></li>
									<li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a> </li>
									<li><a href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

							    	</ul>';
					    	  }


					    	  /*==========================================================
					    	  LOS BOTONES DE LA PRIMERA MITAD DE PÁGINAS HACIA ARRIBA   
					    	  ============================================================*/

					    	  else if($rutas[1] != $pagProductos && 
					    	  		  $rutas[1] != 1 &&
					    	  		  $rutas[1] >= ($pagProductos/2) &&
					    	  		  $rutas[1] < ($pagProductos-3)){

					    	  		$numPagActual = $rutas[1];

									echo ' <ul class="pagination">
										     <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
										     <li id="item1"><a href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
										     <li class="disabled"><a>...</a></li>
					    			'; 

							    	for ($i = $numPagActual; $i <= ($numPagActual+3); $i++){

							    		//El for lo hago para que me muestre los botones de 21 22 23 y 24 

							    		echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
							    	} 

							  			echo' <li><a href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
							  				</ul>';

					    	  	}


					    	  /*==========================================================
					    	  LOS BOTONES DE LAS ÚLTIMAS 4 PÁGINAS Y LA PRIMERA PÁGINA 
					    	  ============================================================*/
					    	else{

					    		$numPagActual = $rutas[1];

					    		echo ' <ul class="pagination">
										 <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
										 <li id="item1"><a href="'.$url.$rutas[0].'/1'.$rutas[2].'/'.$rutas[3].'">1</a></li>
										 <li class="disabled"><a>...</a></li>
					    			'; 

							    	for ($i = ($pagProductos-3); $i <= $pagProductos; $i++){

							    		echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
							    	} 

							  echo' </ul>';
					    	}

					    }else{

					    	echo '  <ul class="pagination">'; 

					    	for ($i = 1; $i <= $pagProductos; $i++){

					    	echo '<li  id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
					    	} 

					    	echo'</ul>';
					    }
					}

					?>
				</center>

				</div>
		</div>
</div>