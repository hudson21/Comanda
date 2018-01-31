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

<!--===============================================
BARRA DE PRODUCTOS GRATIS
===================================================-->

<div class="container-fluid well well-sm barraProductos">

	<div class="container">

		<div class="row">

				<div class="col-xs-12 organizarProductos"> <!--Con solo colocar la clase mas pequeña de tamaño estamos diciento que esta clase 
					va abarcar toda la pantalla de nuestro sitio web-->

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
VITRINA DE PRODUCTOS GRATIS
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

		 <hr>

	 </div>

	 <!--===============================================
	 VITRINA PRODUCTOS EN CUADRÍCULA
	 ===================================================-->

	 <ul class="grid0">

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
	 				
                      Mojito al estilo cubano<br>
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
	 				
                      Martini de sandía<br>
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
	 				
                      Bebida de piña, menta y canela<br>
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
	 				
                      Margarita roja<br>
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
VITRINA DE PRODUCTOS GRATIS
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

		 <hr>

	 </div>

	 <!--===============================================
	 VITRINA PRODUCTOS EN CUADRÍCULA
	 ===================================================-->

	 <ul class="grid1">

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
	 				
                      Alitas de pollo con tequila y limón<br>

                      <span class="label label-warning fontSize">Nuevo</span>

            

	 			</a>

	 		</small>

	 	</h4>
	 	<!--========================================================================-->
	 	<div class="col-xs-6 precio">
	 		
	 		 <h2>
	 		 
	 		 	<small>$ 25 USD</small>
	 		 
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

                      <span class="label label-warning fontSize">20% Off</span>

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

 </div>
	

</div>







