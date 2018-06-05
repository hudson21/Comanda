<?php

$servidor = Ruta::ctrRutaServidor();

$url = Ruta::ctrRuta();

$_SESSION["mostrarPaginacionBuscador"] = false;
?>

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

					<ul class="breadcrumb fondoBreadcrumb text-uppercase"
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

						if(isset($rutas[2])){

							if($rutas[2] == "antiguos"){

								$modo = "ASC";
								$_SESSION["ordenar"] = "ASC";

							}else{

								$modo = "DESC";
								$_SESSION["ordenar"] = "DESC";

								}

						}else{

							$modo = $_SESSION["ordenar"];

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

						if(isset($_SESSION["validarSesion"])){

						  if($_SESSION["validarSesion"] == "ok"){

						  	if($_SESSION["tipo_usuario"] == 0){

						  		$productos = ControladorProductos::ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope);
					   
					   			$listaProductos = ControladorProductos::ctrListarProductosBusqueda($busqueda);
						  		
						  	}else{

						  		$productos = ControladorProductos::ctrBuscarProductosPorBar($busqueda, $ordenar, $modo, $base, $tope, $_SESSION["bar"]);

						  		
					   
					   			$listaProductos = ControladorProductos::ctrListarProductosBusquedaPorBar($busqueda, $_SESSION["bar"]);
						  	}

						 }

					}else{

						$productos = ControladorProductos::ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope);


					   
					   $listaProductos = ControladorProductos::ctrListarProductosBusqueda($busqueda);
					}

					   //var_dump($productos);
					}

					if(!$productos){

						echo '<div class="col-xs-12 error404 text-center">

								<h1><small>¡Oops!</small></h1>

								<h2>Aún no hay productos en esta sección</h2>

						 </div>';
					
					}else{


						echo ' <ul class="grid0">';

				foreach ($productos as $key => $value) {
					
					if(!isset($_SESSION["validarSesion"])){

						$_SESSION["mostrarPaginacionBuscador"] = true;

						echo '<li style="margin-bottom:30px" class="margenAbajo col-md-3 col-sm-6 col-xs-12">';

						echo'<h4 class="productsH4Productos productsH4">
					
								<small>
									
									<a href="'.$url.$value["ruta"].'" class="pixelProducto">
										
										'.$value["id"].". ".$value["titulo"].'<br>

										<span style="color:rgba(0,0,0,0)">-</span>';

									echo '</a>	

								</small>			

							</h4>';

					}else{

						if($_SESSION["validarSesion"] == "ok"){

						  	if($_SESSION["tipo_usuario"] == 0){

						  		$_SESSION["mostrarPaginacionBuscador"] = true;

						  		echo '<li  class="margenAbajo col-md-3 col-sm-6 col-xs-12">';

						echo'<h4 class="productsH4Productos productsH4">
					
								<small>
									
									<a href="'.$url.$value["ruta"].'" class="pixelProducto">
										
										'.$value["id"].". ".$value["titulo"].'<br>

										<span style="color:rgba(0,0,0,0)">-</span>';

									echo '</a>	

								</small>			

							</h4>';

					  	echo '<div class=" col-xs-6 enlaces">
								
								
								<div  class="col-lg-12 col-xs-3 txtCantidad" name="txtCantidad">

										<input type="number" class="anchoBotonCantidad form-control cantidadProducto'.$value["id"].'" min="1" id="producto'.$value["id"].'" tipo="" precio="" >
									</div>

									<div class="col-xs-10"></div>

									<div class="botonOrdenar col-lg-1 col-xs-2">

								     <button type="button" class="btn  btn-circle btn-lg agregarCarrito" idProducto="'.$value["id"].'"  titulo="'.$value["titulo"].'"  data-toggle="tooltip">

								     <i style="color:white" class="fa fa-check"></i>
								     </button>

									</div>

							</div>';

						  	}else{

						  		if($value["id_bar"] == $_SESSION["bar"]){

						  			if($value["disponible"] == 1){

						  			$_SESSION["mostrarPaginacionBuscador"] = true;

						  			echo '<li  class="margenAbajo col-md-3 col-sm-6 col-xs-12">';

						echo'<h4 class="productsH4Productos productsH4">
					
								<small>';

								if($value["titulo1"] == null){
									$titulo = $value["titulo"];
								}else{
									$titulo = $value["titulo1"];
								}
	
								echo'<a href="'.$url.$value["ruta"].'" class="pixelProducto">
										
										'.$value["id"].". ".$value["titulo"].'<br>

										<span style="color:rgba(0,0,0,0)">-</span>';

									echo '</a>	

								</small>			

							</h4>';

					  	echo '<div class="tamañoDivEnlaces col-xs-6 enlaces">
								
								
								<div  class="col-lg-12 col-xs-3 txtCantidad" name="txtCantidad">

										<input type="number" class="anchoBotonCantidad form-control cantidadProducto'.$value["id"].'" min="1" id="producto'.$value["id"].'" tipo="" precio="" >
									</div>

									<div class="col-xs-10"></div>

									<div class="botonOrdenar col-lg-1 col-xs-2">

								     <button type="button" class="btn  btn-circle btn-lg agregarCarrito" idProducto="'.$value["id"].'"  titulo="'.$titulo.'" data-toggle="tooltip">

								     <i style="color:white" class="fa fa-check"></i>
								     </button>

									</div>

							</div>';

						  }

					}else{

						$_SESSION["mostrarPaginacionBuscador"] = false;

						echo '<div class="col-xs-12 error404 text-center">

								<h1><small>¡Oops!</small></h1>

								<h2>Aún no hay productos en esta sección</h2>

						 </div>';

						 break;

					}

						  		
					}
			}

	}
	

		echo'</li>';
		
	}echo'<!--FIN DEL FOREACH DEL GRID-->';

	echo '</ul>

	<!--===============================================
	VITRINA DE PRODUCTOS EN LISTA
	===================================================-->

		<ul class="list0" style="display:none;" >';

		foreach($productos as $key => $value){


		 if(!isset($_SESSION["validarSesion"])){

		 	echo '<li class="col-xs-12">
					  
				  		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							   
							<figure>
						
								<a href="'.$url.$value["ruta"].'" class="pixelProducto">
									
									<img src="'.$servidor.$value["portada"].'" class="img-responsive">
								</a>
							</figure>

							<span class="productsNumero pull-left">'.$value["id"].'</span>

					  	</div>
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>
								<small>
								
									<a href="'.$url.$value["ruta"].'" class="pixelProducto">
										
										'.$value["titulo"].'<br>';
	
									echo '</a>

								</small>

							</h1>

						</div>';

					echo'<div class="col-xs-12">

           			<hr>
                     	
          		</div>';
			
		 }else{

		 	if($value["disponible"] == 1){

		 		echo '<li class="col-xs-12">
					  
				  		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							   
							<figure>
						
								<a href="'.$url.$value["ruta"].'" class="pixelProducto">';

								if($value["portada1"] == null){
								$portada=$value["portada"];		
								}else{
									$portada=$value["portada1"];
								}

								if($value["titulo1"] == null){
									$titulo = $value["titulo"];
								}else{
									$titulo = $value["titulo1"];
								}

								if($value["precio1"] == null){
									$precio=$value["precio"];		
								}else{
									$precio=$value["precio1"];
								}

								if($value["tipo1"] == null){
									$tipo=$value["tipo"];		
								}else{
									$tipo=$value["tipo1"];
								}
									
								echo'<img src="'.$servidor.$portada.'" class="img-responsive">
								</a>
							</figure>

							<span class="productsNumero pull-left">'.$value["id"].'</span>

					  	</div>
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>
								<small>
								
									<a href="'.$url.$value["ruta"].'" class="pixelProducto">
										
										'.$titulo.'<br>';
	
									echo '</a>

								</small>

							</h1>';

						echo '<div class="btn-group pull-left enlaces">';


					 echo'<div class=" tamañoDiv  ">
										
							<div  class="col-lg-12 col-xs-3 txtCantidad" name="txtCantidad">

								<input type="number" class="anchoBotonCantidad form-control cantidadProductoLista'.$value["id"].'" min="1" id="productoLista'.$value["id"].'" tipo="" precio="" >
							</div>

							 <div class="col-xs-10">
							 </div>

							<div class="botonOrdenar col-lg-1 col-xs-2">

								 <button type="button" class="btn  btn-circle btn-lg agregarCarritoLista" idProducto="'.$value["id"].'" imagen="'.$servidor.$portada.'" titulo="'.$titulo.'" precio="'.$precio.'" tipo="'.$tipo.'"  data-toggle="tooltip">

								 <i style="color:white" class="fa fa-check"></i>
								 </button>

							</div>


							</div>';

					echo '</div>';

				
			echo'</div>

		             <div class="col-xs-12">

		            <hr>
		                     	
		          </div>';
		 	
		 	}else{

		 		echo '<li class="col-xs-12">
					  
				  		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							   
							<figure>
						
								<a href="'.$url.$value["ruta"].'" class="pixelProducto">
									
									<img src="'.$servidor.$value["portada"].'" class="img-responsive">
								</a>
							</figure>

							<span class="productsNumero pull-left">'.$value["id"].'</span>

					  	</div>
							  
		<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
				<h1>
					<small>
								
						<a href="'.$url.$value["ruta"].'" class="pixelProducto">
										
							'.$value["titulo"].'<br>';
	
						echo '</a>

					</small>

				</h1>';

			echo '<div class="btn-group pull-left enlaces">';


				 echo'<div class=" tamañoDiv  ">
									
						<div  class="col-lg-12 col-xs-3 txtCantidad" name="txtCantidad">

							<input type="number" class="anchoBotonCantidad form-control cantidadProductoLista'.$value["id"].'" min="1" id="productoLista'.$value["id"].'" tipo="" precio="" >
						</div>

						 <div class="col-xs-10">
						 </div>

						<div class="botonOrdenar col-lg-1 col-xs-2">

							 <button type="button" class="btn  btn-circle btn-lg agregarCarritoLista" idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'"  data-toggle="tooltip">

							 <i style="color:white" class="fa fa-check"></i>
							 </button>

						</div>


					</div>';

			echo '</div>';

				
	echo'</div>

             <div class="col-xs-12">

            <hr>
                     	
          </div>';

		 	}


		 }

				

	 echo'</li>';

	}echo'<!--FIN DEL FOREACH DE LISTA-->';

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

					if($_SESSION["mostrarPaginacionBuscador"] == true){


						if(count($listaProductos) != 0){

						$pagProductos = ceil(count($listaProductos)/12);
						//El método ceil redondea los decimales al número entero mayor
						//El floor redondea los decimalos al número entero menor

					    if($pagProductos > 4){

					    	/*==========================================================
					    	  LOS BOTONES DE LAS PRIMERAS 4 PÁGINAS Y LA ÚLTIMA PÁGINA      
					    	============================================================*/
					    	if($rutas[1] == 1){

							echo '<ul class="pagination">';
							
							for($i = 1; $i <= 4; $i ++){

								echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

							}

							echo ' <li class="disabled"><a>...</a></li>
								   <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>
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

								echo '<ul class="pagination">
									  <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> ';
							
								for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){

									echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

								}

								echo ' <li class="disabled"><a>...</a></li>
									   <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>
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
							
								echo '<ul class="pagination">
								   <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 
								   <li id="item1"><a href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
								   <li class="disabled"><a>...</a></li>
								';
							
								for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){

									echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

								}


								echo '  <li><a href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
									</ul>';

					    	  	}


					    	  /*==========================================================
					    	  LOS BOTONES DE LAS ÚLTIMAS 4 PÁGINAS Y LA PRIMERA PÁGINA 
					    	  ============================================================*/
					    	else{

					    		$numPagActual = $rutas[1];

							echo '<ul class="pagination">
								   <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 
								   <li id="item1"><a href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
								   <li class="disabled"><a>...</a></li>
								';
							
							for($i = ($pagProductos-3); $i <= $pagProductos; $i ++){

								echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

							}

							echo ' </ul>';
					    	}

					    }else{

					    	echo '<ul class="pagination">';
						
						for($i = 1; $i <= $pagProductos; $i ++){

							echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

						}

						echo '</ul>';
					    }
					}
			}

					

					?>
				</center>

			  </div>
		</div>
</div>


