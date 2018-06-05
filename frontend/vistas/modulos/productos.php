<!--=====================================
BANNER
======================================-->

<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

$ruta = $rutas[0];


?>

<!--=====================================
BARRA PRODUCTOS
======================================-->

<div class="container-fluid well well-sm barraProductos">

	<div class="container">
		
		<div class="row">

			<div class="col-sm-6 col-xs-12">
				
				<div class="btn-group">
					
					 <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

					  Ordenar Productos <span class="caret"></span></button>

					  <ul class="dropdown-menu" role="menu">

					  <?php
					  	
						echo '<li><a href="'.$url.$rutas[0].'/1/recientes">Más reciente</a></li>
							  <li><a href="'.$url.$rutas[0].'/1/antiguos">Más antiguo</a></li>';

						?>

					  </ul>

				</div>

			</div>
			
			<div class="col-sm-6 col-xs-12 organizarProductos">

				<div class="btn-group pull-right">

					 <button type="button" class="btn btn-default btnGrid" id="btnGrid0">
					 	
						<i class="fa fa-th" aria-hidden="true"></i>  

						<span class="col-xs-0 pull-right"> GRID</span>

					 </button>

					<!-- <button type="button" class="col-xs-0 btn btn-default btnList" id="btnList0">
					 	
						<i class="fa fa-list" aria-hidden="true"></i> 

						<span class="col-xs-0 pull-right"> LIST</span>

					 </button>-->
					
				</div>		

			</div>

		</div>

	</div>

</div>

<!--=====================================
LISTAR PRODUCTOS
======================================-->

<div class="container-fluid productos">

	<div class="container">
		
		<div class="row">

			<!--=====================================
			BREADCRUMB O MIGAS DE PAN
			======================================-->

			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>

			</ul>

			<?php

			/*=============================================
			LLAMADO DE PAGINACIÓN
			=============================================*/

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

					if(isset($_SESSION["ordenar"])){

						$modo = $_SESSION["ordenar"];

					}else{

						$modo = "DESC";

					}		

				}

				$base = ($rutas[1] - 1)*12;
				$tope = 12;

			}else{

				$rutas[1] = 1;
				$base = 0;
				$tope = 12;
				$modo = "DESC";

			}

			/*=============================================
			LLAMADO DE PRODUCTOS DE CATEGORÍAS, SUBCATEGORÍAS Y DESTACADOS
			=============================================*/

			if($rutas[0] == "articulos-con-descuento"){

				$item2 = null;
				$valor2 = 0;
				$ordenar = "id";

			}else if($rutas[0] == "lo-mas-vendido"){

				$item2 = null;
				$valor2 = null;
				$ordenar = "id";

			}else if($rutas[0] == "lo-mas-visto"){

				$item2 = null;
				$valor2 = null;
				$ordenar = "id";

			}else{

				$ordenar = "id";
				$item1 = "ruta";
				$valor1 = $rutas[0];

				$categoria = ControladorProductos::ctrMostrarCategorias($item1, $valor1);

				if(!$categoria){

					$subCategoria = ControladorProductos::ctrMostrarSubCategorias($item1, $valor1);

					$item2 = "id_subcategoria";
					$valor2 = $subCategoria[0]["id"];

				}else{

					$item2 = "id_categoria";
					$valor2 = $categoria["id"];

				}
			}

			if(isset($_SESSION["validarSesion"])){

				if($_SESSION["validarSesion"] == "ok"){

					if($_SESSION["tipo_usuario"] == 0){

						$productos = ControladorProductos::ctrMostrarProductos($ordenar, $item2, $valor2, $base, $tope, $modo);
						$listaProductos = ControladorProductos::ctrListarProductos($ordenar, $item2, $valor2);

					}else{

						$productos = ControladorProductos::ctrMostrarProductosPorBar($_SESSION["bar"], $ordenar, $modo, $base, $tope, $item2, $valor2);

						
						$listaProductos = ControladorProductos::ctrListarProductos($ordenar, $item2, $valor2);
					}

				}

			}else{

				$productos = ControladorProductos::ctrMostrarProductos($ordenar, $item2, $valor2, $base, $tope, $modo);
				$listaProductos = ControladorProductos::ctrListarProductos($ordenar, $item2, $valor2);
			}

			
			if(!$productos){

				echo '<div class="col-xs-12 error404 text-center">

						 <h1><small>¡Oops!</small></h1>

						 <h2>Aún no hay productos en esta sección</h2>

					</div>';

			}else{

				echo '<ul class="grid0">';

					foreach ($productos as $key => $value) {

				if(!isset($_SESSION["validarSesion"])){

					$_SESSION["mostrarPaginacionProductos"] = true;

					echo '<li style="margin-bottom:30px" class="margenAbajo col-md-3 col-sm-6 col-xs-12">';

					echo'<h4 class="productsH4Productos productsH4">
					
								<small>
									
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["id"].". ".$value["titulo"].'<br>

										<span style="color:rgba(0,0,0,0)">-</span>';

									echo '</a>	

								</small>			

							</h4>';

				}else{

					echo '<li  class="margenAbajo col-md-3 col-sm-6 col-xs-12">';

					if($_SESSION["tipo_usuario"] == 0){

						$_SESSION["mostrarPaginacionProductos"] = true;

						echo'<h4 class="productsH4Productos productsH4">
					
								<small>
									
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["id"].". ".$value["titulo"].'<br>

										<span style="color:rgba(0,0,0,0)">-</span>';

									echo '</a>	

								</small>			

							</h4>';

					}else{

						if($value["id_bar"] == $_SESSION["bar"]){

							$_SESSION["mostrarPaginacionProductos"] = true;

							if($value["titulo1"] == null){
								$titulo = $value["titulo"];
							}else{
								$titulo = $value["titulo1"];
							}

						
						echo'<h4 class="productsH4Productos ">
					
								<small>
									
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["id"].". ".$value["titulo"].'<br>

										<span style="color:rgba(0,0,0,0)">-</span>';

									echo '</a>	

								</small>			

							</h4>';

						}else{

							$_SESSION["mostrarPaginacionProductos"] = false;
						}

							
					}
				}
					
				if(isset($_SESSION["validarSesion"])){

				  if($_SESSION["validarSesion"] == "ok"){

				  	echo '<div class="tamañoDivEnlaces col-xs-6 enlaces">
										
							 <div  class="col-lg-12 col-xs-3 txtCantidad" name="txtCantidad">

								 <input type="number" class="anchoBotonCantidad form-control cantidadProducto'.$value["id"].'" min="1" id="producto'.$value["id"].'" tipo="" precio="" >
							 </div>

							 <div class="col-xs-10"></div>

							 <div class="botonOrdenar col-lg-1 col-xs-2">';

						   if($_SESSION["tipo_usuario"] == 1){

								echo'<button type="button" class="btn  btn-circle btn-lg agregarCarrito" idProducto="'.$value["id"].'"  titulo="'.$titulo.'"  data-toggle="tooltip">';
							}else{

								echo'<button type="button" class="btn  btn-circle btn-lg agregarCarrito" idProducto="'.$value["id"].'"  titulo="'.$value["titulo"].'"  data-toggle="tooltip">';
							}

								    echo' <i style="color:white" class="fa fa-check"></i>
								     </button>

									</div>

							</div>';
				  }
			}

			echo'</li>';
		
					}

				echo '</ul>

				<ul class="list0" style="display:none">';

				foreach ($productos as $key => $value) {

					if(isset($_SESSION["validarSesion"])){

						if($_SESSION["tipo_usuario"] == 0){

				echo '<li class="col-xs-12">
					  
				  	
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>
								<small>
								
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["id"].". ".$value["titulo"].'<br>';
	
									echo '</a>

								</small>
							</h1>';

						}else{


							if($value["titulo1"] == null){
								$titulo = $value["titulo"];
							}else{
								$titulo = $value["titulo1"];
							}

							echo '<li class="col-xs-12">
					 
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>
								<small>
								
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["id"].". ".$value["titulo"].'<br>';
	
									echo '</a>

								</small>
							</h1>';

						}


					}else{

						echo '<li class="col-xs-12">
					  
				  		
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>
								<small>
								
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["id"].". ".$value["titulo"].'<br>';
	
									echo '</a>

								</small>
							</h1>';
					}

					
			if(isset($_SESSION["validarSesion"])){

				if($_SESSION["validarSesion"] == "ok"){

					echo '<div class="btn-group pull-left enlaces">';


				 echo'<div class=" tamañoDiv  ">
									
						<div  class="col-lg-12 col-xs-3 txtCantidad" name="txtCantidad">

							<input type="number" class="anchoBotonCantidad form-control cantidadProductoLista'.$value["id"].'" min="1" id="productoLista'.$value["id"].'" tipo="" precio="" >
						</div>

						 <div class="col-xs-10"></div>

						<div class="botonOrdenar col-lg-1 col-xs-2">';

							 if($_SESSION["tipo_usuario"] == 1){

								echo'<button type="button" class="btn  btn-circle btn-lg agregarCarrito" idProducto="'.$value["id"].'"  titulo="'.$titulo.'"  data-toggle="tooltip">';
							}else{

								echo'<button type="button" class="btn  btn-circle btn-lg agregarCarrito" idProducto="'.$value["id"].'"  titulo="'.$value["titulo"].'" data-toggle="tooltip">';
							}

						echo'<i style="color:white" class="fa fa-check"></i>
							 </button>

						</div>


					</div>';

			echo '</div>';
				}
			}
			
		    echo'</div>

			    <div class="col-xs-12"><hr></div>

		    </li>';

				}

				echo '</ul>';
			}

			?>

			<div class="clearfix"></div>

			<center>

			<!--=====================================
			PAGINACIÓN
			======================================-->
			
			<?php

			if($_SESSION["mostrarPaginacionProductos"] == true){

				if(count($listaProductos) != 0){

					$pagProductos = ceil(count($listaProductos)/12);

					if($pagProductos > 4){

						/*=============================================
						LOS BOTONES DE LAS PRIMERAS 4 PÁGINAS Y LA ÚLTIMA PÁG
						=============================================*/

						if($rutas[1] == 1){

							echo '<ul class="pagination">';
							
							for($i = 1; $i <= 4; $i ++){

								echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

							}

							echo ' <li class="disabled"><a>...</a></li>
								   <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'">'.$pagProductos.'</a></li>
								   <li><a href="'.$url.$rutas[0].'/2"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

							</ul>';

						}

						/*=============================================
						LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ABAJO
						=============================================*/

						else if($rutas[1] != $pagProductos && 
							    $rutas[1] != 1 &&
							    $rutas[1] <  ($pagProductos/2) &&
							    $rutas[1] < ($pagProductos-3)
							    ){

								$numPagActual = $rutas[1];

								echo '<ul class="pagination">
									  <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> ';
							
								for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){

									echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

								}

								echo ' <li class="disabled"><a>...</a></li>
									   <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'">'.$pagProductos.'</a></li>
									   <li><a href="'.$url.$rutas[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

								</ul>';

						}

						/*=============================================
						LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ARRIBA
						=============================================*/

						else if($rutas[1] != $pagProductos && 
							    $rutas[1] != 1 &&
							    $rutas[1] >=  ($pagProductos/2) &&
							    $rutas[1] < ($pagProductos-3)
							    ){

								$numPagActual = $rutas[1];
							
								echo '<ul class="pagination">
								   <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 
								   <li id="item1"><a href="'.$url.$rutas[0].'/1">1</a></li>
								   <li class="disabled"><a>...</a></li>
								';
							
								for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){

									echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

								}


								echo '  <li><a href="'.$url.$rutas[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
									</ul>';
						}

						/*=============================================
						LOS BOTONES DE LAS ÚLTIMAS 4 PÁGINAS Y LA PRIMERA PÁG
						=============================================*/

						else{

							$numPagActual = $rutas[1];

							echo '<ul class="pagination">
								   <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 
								   <li id="item1"><a href="'.$url.$rutas[0].'/1">1</a></li>
								   <li class="disabled"><a>...</a></li>
								';
							
							for($i = ($pagProductos-3); $i <= $pagProductos; $i ++){

								echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

							}

							echo ' </ul>';

						}

					}else{

						echo '<ul class="pagination">';
						
						for($i = 1; $i <= $pagProductos; $i ++){

							echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

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