<?php

$servidor = Ruta::ctrRutaServidor();
?>

<!--===============================================
BANNER
===================================================-->

<figure class="banner">
	
	<img src="http://localhost/Comanda/backend/vistas/img/banner/casaPalapaDefault.jpg" class="img-responsive" width="100%" >

	<div class="textoBanner textoDer">	

		<h1 style="color:#fff">OFERTAS ESPECIALES</h1>

		<h2 style="color:#fff"><strong>50% Off</strong></h2>

		<h3 style="color:#fff">Termina el 2 de Febrero</h3>


	</div>

</figure>

<?php

$titulosModulos = array("ARTÍCULOS CON DESCUENTO", "LO MÁS VENDIDO", "LO MÁS VISTO");
$rutaModulos = array("articulos-con-descuento","lo-mas-vendido","lo-mas-visto");

if ($titulosModulos[0] == "ARTÍCULOS CON DESCUENTO"){

$ordenar = "id"; //En este campo puedo solicitar por que columna quiero que se organicen las filas de la tabla productos
$item="precio";
$valor=0;

$descuento = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor);

}

if ($titulosModulos[1] == "LO MÁS VENDIDO"){

$ordenar = "ventas"; //En este campo puedo solicitar por que columna quiero que se organicen las filas de la tabla productos
$item=null;
$valor=null;

$ventas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor);

}

if ($titulosModulos[2] == "LO MÁS VISTO"){

$ordenar = "vistas"; //En este campo puedo solicitar por que columna quiero que se organicen las filas de la tabla productos
$item=null;
$valor=null;

$vistas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor);

}

$modulos = array($descuento,$ventas,$vistas);

for ($i=0; $i < count($titulosModulos); $i ++){

					echo '<div class="container-fluid well well-sm barraProductos">

					<div class="container">

						<div class="row">

								<div class="col-xs-12 organizarProductos"> <!--Con solo colocar la clase mas pequeña de tamaño estamos diciento que esta clase 
									va abarcar toda la pantalla de nuestro sitio web-->

									<div class="btn-group pull-right">

										<button type="button" class="btn btn-default btnGrid0" id="btnGrid'.$i.'">

											<i class="fa fa-th" aria-hidden="true"></i>

											<span class="visible-lg visible-md visible-sm pull-right">GRID</span>
											
										</button>

										<button type="button" class="btn btn-default btnList" id="btnList'.$i.'">

											<i class="fa fa-list" aria-hidden="true"></i>

											<span class="visible-lg visible-md visible-sm pull-right">LIST</span>
											
										</button>
										
									</div>
									

								</div>
							

						</div>
						

					</div>
					

				</div>


				<div class="container-fluid productos">

					<div class="container">
		
						<div class="row">

							<div class="col-xs-12 tituloDestacado">

								<div class="col-sm-6 col-xs-12">

									<h1><small>'.$titulosModulos[$i].'</small></h1>

								</div>

								<div class="col-sm-6 col-xs-12">

				 					<a href="'.$rutaModulos[$i].'">
				 			
				 						<button class="btn btn-default backColor pull-right">
				 				
											VER MÁS <span class="fa fa-chevron-right"></span>

				 						</button>

				 					</a>	
				 		
				 				</div>



				 				</div>

								 <div class="clearfix"></div>

									<hr>
							
	 							</div>


	 							<ul class="grid'.$i.'">';


	 							foreach($modulos[$i] as $key => $value){
	 							
	 							  echo '<li class=" col-md-3 col-sm-6 col-xs-12">

	 										  <figure>
	 		
	 											<a href="'.$value["ruta"].'" class="pixelProducto">
	 			
	 											<img src="'.$servidor.$value["portada"].'" class="img-responsive">

	 											</a>

	 										 </figure>



	 								<h4>

	 								 	<small>
	 			
	 										<a href="'.$value["ruta"].'" class="pixelProducto">

	 										'.$value["titulo"].' <br>

	 										<span style="color:rgba(0,0,0,0)">-</span>';

	 										if($value["nuevo"] != 0){

	 											echo '<span class="label label-warning fontSize">Nuevo</span> ';
	 										}

	 										if($value["oferta"] != 0){

	 								echo '<span class="label label-warning fontSize">'.$value["descuentoOferta"].'% Off</span>';

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
	 		 	
	 		 		<strong class="oferta" style="font-size:15px;">USD $'.$value["precio"].'</strong>
	 		 	
	 		 										</small>

	 		 		<small style="font-size:20px;font-weight:bold;">$'.$value["precioOferta"].'</small>

	 		 									  </h2>';

										   }else{

										  	echo '<h2>
					<small style="font-size:20px;font-weight:bold;">USD $'.$value["precio"].'</small></h2>';

										  	}

										  }
	 	
	 								echo '</div>
	 										

	 									  
	 									  <div class="col-xs-6 enlaces">	

	 											<div class="btn-group pull-right">
	 			
													<button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id"].'" 
													 data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
													<i class="fa fa-heart" aria-hidden="true"></i>

													</button>';

											if($value["tipo"] == "virtual"){


												if($value["oferta"] != 0){

						echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" 
							  imagen="'.$servidor.$value["portada"].'"
							  titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" tipo="'.$value["tipo"].'" 
							  peso="'.$value["peso"].'" data-toggle="tooltip" 
					          title="Agregar al carrito de compras">
						
						      <i class="fa fa-shopping-cart" aria-hidden="true"></i>

					          </button>';


												}else{

						echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" 
							  imagen="'.$servidor.$value["portada"].'"
							  titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" 
							  peso="'.$value["peso"].'" data-toggle="tooltip" 
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

							</div>

						</div>';

}





?>

<!--===============================================
BARRA DE PRODUCTOS GRATIS
===================================================-->

<div class="container-fluid well well-sm barraProductos">

	<div class="container">

		<div class="row">

				<div class="col-xs-12 organizarProductos"> <!--Con solo colocar la clase mas pequeña de tamaño estamos diciento que esta clase 
					va abarcar toda la pantalla de nuestro sitio web-->

					<div class="btn-group pull-right">

						<button type="button" class="btn btn-default btnGrid0" id="btnGrid0">

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
VITRINA DE PRODUCTOS CON DESCUENTO
===================================================-->

<div class="container-fluid productos">

	<div class="container">
		
		<div class="row">

			<!--===============================================
			BARRA TITULO
			===================================================-->

			<div class="col-xs-12 tituloDestacado" >

				<!--========================================================================-->

				 	<div class="col-sm-6 col-xs-12"> <!--Si lo pongo de esta manera estoy haciendo entender que col-lg y col-md van a tener la misma medida que col-sm que es de 6-->

				 		<h1><small>ARTÍCULOS CON DESCUENTO</small></h1>
				 		

				 	</div>

				 	<!--========================================================================-->

				 	<div class="col-sm-6 col-xs-12">

				 		<a href="articulos-gratis">
				 			
				 			<button class="btn btn-default backColor pull-right">
				 				
								VER MÁS <span class="fa fa-chevron-right"></span>

				 			</button>

				 		</a>
				 		
				 	</div>

				 	<!--========================================================================-->

			 </div>

			 <div class="clearfix"></div>


		 <hr>

	 </div>

	 <!--===============================================
	 VITRINA PRODUCTOS EN CUADRÍCULA
	 ===================================================-->

	 <ul class="grid0" >

	 	<!--===============================================
	 	   PRODUCTO 1
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/accesorios/mojito.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Mojito al estilo cubano<br> <span class="label label-warning fontSize">Nuevo</span>

	 			</a> 

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2><small>$2.99 USD</small></h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>

	 	<!--===============================================
	 	   PRODUCTO 2
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/accesorios/martini.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Martini de sandía<br><br>
	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2><small>$3.99 USD</small></h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>

	 	<!--===============================================
	 	   PRODUCTO 3
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/accesorios/bebida.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Bebida de piña, menta y canela<br><br>
	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2><small>$5.99 USD</small></h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>

	 	<!--===============================================
	 	   PRODUCTO 4
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/accesorios/margarita.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Margarita roja<br><br>
	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2><small>$1.99 USD</small></h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>


</ul>

		<!--===============================================
		VITRINA DE PRODUCTOS EN LISTA
		===================================================-->

		<ul class="list0" style="display:none;">
			
			<!--===============================================
			     PRODUCTO 1
			===================================================-->

			<li class="col-sx-12">
				
					<!--========================================================================-->
					
					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">

						<figure>
							
							<a href="#" class="pixelProducto"><img src="http://localhost/Comanda/backend/vistas/img/productos/accesorios/mojito.jpg" class="img-responsive"></a>

						</figure>
						

					</div>

					<!--========================================================================-->

					<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">

						<h1>
							
							<small>
								
									<a href="#" class="pixelProducto">Mojito al estilo cubano</a>

							</small>

						</h1>

						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis est ipsum soluta 
							ducimus enim, perferendis rem sint similique amet, aspernatur quod repellendus dolor
							quas eveniet. Nisi odio inventore at ipsa.
						</p>

						<h2><small>GRATIS</small></h2>

						<div class="btn-group pull-left enlaces">
							
							<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" 
							title="Agregar a mi lista de deseos">

							<i class="fa fa-heart" aria-hidden="true"></i>
							
							</button>

							<a href="#" class="pixelProducto">
								
								<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

									<i class="fa fa-eye" ara-hidden="true"></i>
									
								</button>							

							</a>

						</div>
						

					</div>

                     <!--========================================================================-->

                     <div class="col-xs-12">

                     	<hr>
                     	
                     </div>

                     <!--========================================================================-->


			</li>


			<!--===============================================
			     PRODUCTO 2
			===================================================-->

			<li class="col-sx-12">
				
					<!--========================================================================-->
					
					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">

						<figure>
							
							<a href="#" class="pixelProducto"><img src="http://localhost/Comanda/backend/vistas/img/productos/accesorios/martini.jpg" class="img-responsive"></a>

						</figure>
						

					</div>

					<!--========================================================================-->

					<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">

						<h1>
							
							<small>
								
									<a href="#" class="pixelProducto">Martini de sandía</a>

							</small>

						</h1>

						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis est ipsum soluta 
							ducimus enim, perferendis rem sint similique amet, aspernatur quod repellendus dolor
							quas eveniet. Nisi odio inventore at ipsa.
						</p>

						<h2><small>GRATIS</small></h2>

						<div class="btn-group pull-left enlaces">
							
							<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" 
							title="Agregar a mi lista de deseos">

							<i class="fa fa-heart" aria-hidden="true"></i>
							
							</button>

							<a href="#" class="pixelProducto">
								
								<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

									<i class="fa fa-eye" ara-hidden="true"></i>
									
								</button>							

							</a>

						</div>
						

					</div>

                     <!--========================================================================-->

                     <div class="col-xs-12">

                     	<hr>
                     	
                     </div>

                     <!--========================================================================-->
                     

			</li>


			<!--===============================================
			     PRODUCTO 3
			===================================================-->

			<li class="col-sx-12">
				
					<!--========================================================================-->
					
					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">

						<figure>
							
							<a href="#" class="pixelProducto"><img src="http://localhost/Comanda/backend/vistas/img/productos/accesorios/bebida.jpg" 
								class="img-responsive"></a>

						</figure>
						

					</div>

					<!--========================================================================-->

					<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">

						<h1>
							
							<small>
								
									<a href="#" class="pixelProducto">Bebida de piña, menta y canela</a>

							</small>

						</h1>

						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis est ipsum soluta 
							ducimus enim, perferendis rem sint similique amet, aspernatur quod repellendus dolor
							quas eveniet. Nisi odio inventore at ipsa.
						</p>

						<h2><small>GRATIS</small></h2>

						<div class="btn-group pull-left enlaces">
							
							<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" 
							title="Agregar a mi lista de deseos">

							<i class="fa fa-heart" aria-hidden="true"></i>
							
							</button>

							<a href="#" class="pixelProducto">
								
								<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

									<i class="fa fa-eye" ara-hidden="true"></i>
									
								</button>							

							</a>

						</div>
						

					</div>

                     <!--========================================================================-->

                     <div class="col-xs-12">

                     	<hr>
                     	
                     </div>

                     <!--========================================================================-->
                     

			</li>


			<!--===============================================
			     PRODUCTO 4
			===================================================-->

			<li class="col-sx-12">
				
					<!--========================================================================-->
					
					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">

						<figure>
							
							<a href="#" class="pixelProducto"><img src="http://localhost/Comanda/backend/vistas/img/productos/accesorios/margarita.jpg" 
								class="img-responsive"></a>

						</figure>
						

					</div>

					<!--========================================================================-->

					<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">

						<h1>
							
							<small>
								
									<a href="#" class="pixelProducto">Margarita roja</a>

							</small>

						</h1>

						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis est ipsum soluta 
							ducimus enim, perferendis rem sint similique amet, aspernatur quod repellendus dolor
							quas eveniet. Nisi odio inventore at ipsa.
						</p>

						<h2><small>GRATIS</small></h2>

						<div class="btn-group pull-left enlaces">
							
							<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" 
							title="Agregar a mi lista de deseos">

							<i class="fa fa-heart" aria-hidden="true"></i>
							
							</button>

							<a href="#" class="pixelProducto">
								
								<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

									<i class="fa fa-eye" ara-hidden="true"></i>
									
								</button>							

							</a>

						</div>
						

					</div>

                     <!--========================================================================-->

                     <div class="col-xs-12">

                     	<hr>
                     	
                     </div>

                     <!--========================================================================-->
                     

			</li>



		</ul>

 </div>
	

</div>




<!--===============================================
BARRA DE PRODUCTOS MÁS VENDIDOS
===================================================-->

<div class="container-fluid well well-sm barraProductos">

	<div class="container">

		<div class="row">

				<div class="col-xs-12 organizarProductos"> <!--Con solo colocar la clase mas pequeña de tamaño estamos diciento que esta clase 
					va abarcar toda la pantalla de nuestro sitio web-->

					<div class="btn-group pull-right">

						<button type="button" class="btn btn-default btnGrid" id="btnGrid1">

							<i class="fa fa-th" aria-hidden="true"></i>

							<span class="visible-lg visible-md visible-sm pull-right">GRID</span>
							
						</button>

						<button type="button" class="btn btn-default btnList" id="btnList1">

							<i class="fa fa-list" aria-hidden="true"></i>

							<span class="visible-lg visible-md visible-sm pull-right">LIST</span>
							
						</button>
						
					</div>
					

				</div>
			

		</div>
		

	</div>
	

</div>

<!--===============================================
VITRINA DE PRODUCTOS MAS VENDIDOS
===================================================-->

<div class="container-fluid productos">

	<div class="container">
		
		<div class="row">

			<!--===============================================
			BARRA TITULO
			===================================================-->

			<div class="col-xs-12 tituloDestacado" >

				<!--========================================================================-->

				 	<div class="col-sm-6 col-xs-12"> <!--Si lo pongo de esta manera estoy haciendo entender que col-lg y col-md van a tener la misma medida que col-sm que es de 6-->

				 		<h1><small>LO MÁS VENDIDO</small></h1>
				 		

				 	</div>

				 	<!--========================================================================-->

				 	<div class="col-sm-6 col-xs-12">

				 		<a href="lo-mas-vendido">
				 			
				 			<button class="btn btn-default backColor pull-right">
				 				
								VER MÁS <span class="fa fa-chevron-right"></span>

				 			</button>

				 		</a>
				 		
				 	</div>

				 	<!--========================================================================-->

			 </div>

			 <div class="clearfix"></div>

		 <hr>

	 </div>

	 <!--===============================================
	 VITRINA PRODUCTOS EN CUADRÍCULA
	 ===================================================-->

	 <ul class="grid1" >

	 	<!--===============================================
	 	   PRODUCTO 1
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/platillos/botana.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Botana de camarón y elote<br>

                      <span class="label label-warning fontSize">Nuevo</span>

                      <span class="label label-warning fontSize">40% Off</span>

	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2>
	 		 
	 		 	<small>
	 		 	
	 		 		<strong class="oferta">$29 USD</strong>
	 		 	
	 		 	</small>

	 		 	<small>$11</small>
	 		 
	 		 </h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>


	 	<!--===============================================
	 	   PRODUCTO 2
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/platillos/fajitasCarne.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Fajitas de Sirloin con tequila y limón<br>

                      <span class="label label-warning fontSize">Nuevo</span>

                      <span class="label label-warning fontSize">30% Off</span>

	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2>
	 		 
	 		 	<small>
	 		 	
	 		 		<strong class="oferta">$12 USD</strong>
	 		 	
	 		 	</small>

	 		 	<small>$5</small>
	 		 
	 		 </h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>


	 	<!--===============================================
	 	   PRODUCTO 3
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/platillos/alitasPollo.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Alitas de pollo con tequila y limón

                     <br>
					 <br>

	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2>
	 		 
	 		 	<small><strong>$ 25 USD</strong></small>
	 		 
	 		 </h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>


	 	<!--===============================================
	 	   PRODUCTO 4
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/platillos/papas.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Costras de papas botaneras<br>

                      <span class="label label-warning fontSize" >20% Off</span>

	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2>
	 		 
	 		 	<small>
	 		 	
	 		 		<strong class="oferta">$30 USD</strong>
	 		 	
	 		 	</small>

	 		 	<small>$15</small>
	 		 
	 		 </h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>

	 
</ul>

		<!--===============================================
			VITRINA DE PRODUCTOS EN LISTA
		===================================================-->

		<ul class="list1" style="display:none;">

			<!--===============================================
			     PRODUCTO 1
			===================================================-->

			<li class="col-sx-12">
				
					<!--========================================================================-->
					
					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">

						<figure>
							
							<a href="#" class="pixelProducto"><img src="http://localhost/Comanda/backend/vistas/img/productos/platillos/botana.jpg" class="img-responsive"></a>

						</figure>
						

					</div>

					<!--========================================================================-->

					<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">

						<h1>
							
							<small>
								
									<a href="#" class="pixelProducto">Botana de camarón y elote</a>

									<span class="label label-warning fontSize">Nuevo</span>

                     				<span class="label label-warning fontSize">30% Off</span>

							</small>

						</h1>

						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis est ipsum soluta 
							ducimus enim, perferendis rem sint similique amet, aspernatur quod repellendus dolor
							quas eveniet. Nisi odio inventore at ipsa.
						</p>

						<h2>
							<small>
							
									<strong class="oferta">$29 USD</strong>
							
							</small>

							<small>$11 USD</small>

						</h2>

						<div class="btn-group pull-left enlaces">
							
							<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" 
							title="Agregar a mi lista de deseos">

							<i class="fa fa-heart" aria-hidden="true"></i>
							
							</button>

							<a href="#" class="pixelProducto">
								
								<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

									<i class="fa fa-eye" ara-hidden="true"></i>
									
								</button>							

							</a>

						</div>
						

					</div>

                     <!--========================================================================-->

                     <div class="col-xs-12">

                     	<hr>
                     	
                     </div>

                     <!--========================================================================-->


			</li>

		
			
		</ul>

 </div>
	

</div>




<!--===============================================
BARRA DE PRODUCTOS MÁS VISTOS
===================================================-->

<div class="container-fluid well well-sm barraProductos">

	<div class="container">

		<div class="row">

				<div class="col-xs-12 organizarProductos"> <!--Con solo colocar la clase mas pequeña de tamaño estamos diciento que esta clase 
					va abarcar toda la pantalla de nuestro sitio web-->

					<div class="btn-group pull-right">

						<button type="button" class="btn btn-default btnGrid" id="btnGrid2">

							<i class="fa fa-th" aria-hidden="true"></i>

							<span class="visible-lg visible-md visible-sm pull-right">GRID</span>
							
						</button>

						<button type="button" class="btn btn-default btnList" id="btnList2">

							<i class="fa fa-list" aria-hidden="true"></i>

							<span class="visible-lg visible-md visible-sm pull-right">LIST</span>
							
						</button>
						
					</div>
					

				</div>
			

		</div>
		

	</div>
	

</div>

<!--===============================================
VITRINA DE PRODUCTOS MÁS VISTOS
===================================================-->

<div class="container-fluid productos">

	<div class="container">
		
		<div class="row">

			<!--===============================================
			BARRA TITULO
			===================================================-->

			<div class="col-xs-12 tituloDestacado" >

				<!--========================================================================-->

				 	<div class="col-sm-6 col-xs-12"> <!--Si lo pongo de esta manera estoy haciendo entender que col-lg y col-md van a tener la misma medida que col-sm que es de 6-->

				 		<h1><small>LO MÁS VISTO</small></h1>
				 		

				 	</div>

				 	<!--========================================================================-->

				 	<div class="col-sm-6 col-xs-12">

				 		<a href="lo-mas-visto">
				 			
				 			<button class="btn btn-default backColor pull-right">
				 				
								VER MÁS <span class="fa fa-chevron-right"></span>

				 			</button>

				 		</a>
				 		
				 	</div>

				 	<!--========================================================================-->

			 </div>

			 <div class="clearfix"></div>

		 <hr>

	 </div>

	 <!--===============================================
	 VITRINA PRODUCTOS EN CUADRÍCULA
	 ===================================================-->

	 <ul class="grid2">

	 	<!--===============================================
	 	   PRODUCTO 1
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/platillos/hamburguesa.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Hamburguesa de res con piña<br>

                      <span class="label label-warning fontSize">90% Off</span>

	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2>
	 		 
	 		 	<small>
	 		 	
	 		 		<strong class="oferta">$100 USD</strong>
	 		 	
	 		 	</small>

	 		 	<small>$10</small>
	 		 
	 		 </h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="404" 
					imagen="http://localhost/Comanda/backend/vistas/img/productos/platillos/hamburguesa.jpg"
					titulo="Hamburguesa de res con piña" precio="10" tipo="fisico" peso="13" data-toggle="tooltip" title="Agregar al carrito de compras">
						
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>



	 	<!--===============================================
	 	   PRODUCTO 2
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/platillos/tacos.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Tacos de camarones<br>

                      <span class="label label-warning fontSize">90% Off</span>

	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2>
	 		 
	 		 	<small>
	 		 	
	 		 		<strong class="oferta">$100 USD</strong>
	 		 	
	 		 	</small>

	 		 	<small>$10</small>
	 		 
	 		 </h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="404" 
					imagen="http://localhost/Comanda/backend/vistas/img/productos/platillos/tacos.jpg"
					titulo="Tacos de camarones" precio="10" tipo="fisico" peso="5" data-toggle="tooltip" title="Agregar al carrito de compras">
						
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>



		<!--===============================================
	 	   PRODUCTO 3
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/platillos/bife.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Bife argentino con chimichurri<br>

                      <span class="label label-warning fontSize">90% Off</span>

	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2>
	 		 
	 		 	<small>
	 		 	
	 		 		<strong class="oferta">$100 USD</strong>
	 		 	
	 		 	</small>

	 		 	<small>$10</small>
	 		 
	 		 </h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="404" 
					imagen="http://localhost/Comanda/backend/vistas/img/productos/platillos/bife.jpg"
					titulo="Bife argentino con chimichurri" precio="10" tipo="fisico" peso="5" data-toggle="tooltip" title="Agregar al carrito de compras">
						
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>


		<!--===============================================
	 	   PRODUCTO 4
	 	===================================================-->
	 	<li class=" col-md-3 col-sm-6 col-xs-12">

	 	<!--========================================================================-->
	 	<figure>
	 		
	 		<a href="#" class="pixelProducto">
	 			
	 			<img src="http://localhost/Comanda/backend/vistas/img/productos/platillos/langostino.jpg" class="img-responsive">

	 		</a>

	 	</figure>

	 	<!--========================================================================-->
	 	<h4>

	 		<small>
	 			
	 			<a href="#" class="pixelProducto">
	 				
                      Langostinos al chile<br>

                      <span class="label label-warning fontSize">90% Off</span>

	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2>
	 		 
	 		 	<small>
	 		 	
	 		 		<strong class="oferta">$100 USD</strong>
	 		 	
	 		 	</small>

	 		 	<small>$10</small>
	 		 
	 		 </h2>

	 	</div>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 enlaces">	

	 		<div class="btn-group pull-right">
	 			
					<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" 
					data-toggle="tooltip" title="Agregar a mi lista de deseos">
						
						<i class="fa fa-heart" aria-hidden="true"></i>

					</button>

					<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="404" 
					imagen="http://localhost/Comanda/backend/vistas/img/productos/platillos/langostino.jpg"
					titulo="Langostinos al chile" precio="10" tipo="fisico" peso="5" data-toggle="tooltip" title="Agregar al carrito de compras">
						
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>

					</button>

					<a href="#" class="pixelProducto">
						
						<button type="button" class="btn btn-default btn-xs" 
						data-toggle="tooltip" title="Ver producto">
							
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

					</a>

	 		</div>

	 	</div>

	 	
	 	</li>
	 
</ul>

     <!--===============================================
			VITRINA DE PRODUCTOS EN LISTA
		===================================================-->

		<ul class="list2" style="display:none;" >

			<!--===============================================
			     PRODUCTO 1
			===================================================-->

			<li class="col-sx-12">
				
					<!--========================================================================-->
					
					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">

						<figure>
							
							<a href="#" class="pixelProducto"><img src="http://localhost/Comanda/backend/vistas/img/productos/platillos/hamburguesa.jpg" class="img-responsive"></a>

						</figure>
						

					</div>

					<!--========================================================================-->

					<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">

						<h1>
							
							<small>
								
									<a href="#" class="pixelProducto">Hamburguesa de res con piña</a>

                     				<span class="label label-warning fontSize">90% Off</span>

							</small>

						</h1>

						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis est ipsum soluta 
							ducimus enim, perferendis rem sint similique amet, aspernatur quod repellendus dolor
							quas eveniet. Nisi odio inventore at ipsa.
						</p>

						<h2>
							<small>
							
									<strong class="oferta">$100 USD</strong>
							
							</small>

							<small>$10 USD</small>

						</h2>

						<div class="btn-group pull-left enlaces">
							
							<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" 
							title="Agregar a mi lista de deseos">

							<i class="fa fa-heart" aria-hidden="true"></i>
							
							</button>

							<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="404" 
									imagen="http://localhost/Comanda/backend/vistas/img/productos/platillos/hamburguesa.jpg"
									titulo="Hamburguesa de res con piña" precio="10" tipo="fisico" peso="13" data-toggle="tooltip" title="Agregar al carrito de compras">
						
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>

							</button>

							<a href="#" class="pixelProducto">
								
								<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

									<i class="fa fa-eye" ara-hidden="true"></i>
									
								</button>							

							</a>

						</div>
						

					</div>

                     <!--========================================================================-->

                     <div class="col-xs-12">

                     	<hr>
                     	
                     </div>

                     <!--========================================================================-->


			</li>

		
			
		</ul>

 </div>
	

</div>















