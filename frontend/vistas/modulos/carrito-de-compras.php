<!--===============================================
     BREADCRUMB CARRITO DE COMPRAS
===================================================-->
<div class="container-fluid well well-sm">

	<div class="container">

		<div class="row">

			<ul class="breadcrumb  fondoBreadcrumb text-uppercase" style="margin-bottom:0px; background:rgba(0,0,0,0);">

				<li><a style="text-decoration:none;" href="<?php echo $url; ?>">CARRITO DE COMPRAS</a></li>
			    <li class="active pagActiva"><?php echo $rutas[0]; ?></li>
				
			</ul>
			
		</div>
		
	</div>
	
</div>

<!--===============================================
     TABLA CARRITO DE COMPRAS
===================================================-->
<div class="container-fluid">
	
	<div class="container">

		<div class="panel panel-default">

			<!--===============================================
     			CABECERA CARRITO DE COMPRAS
			===================================================-->
			<div class="panel-heading cabeceraCarrito">

				<div class="col-md-6 col-sm-7 col-xs-12 text-center">

					<h3>
						<small>PRODUCTO</small>
					</h3>
					
				</div>

				<div class="col-md-2 col-sm-7 col-xs-0 text-center">

					<h3>
						<small>PRECIO</small>
					</h3>
					
				</div>

				<div class="col-sm-2 col-xs-0 text-center">

					<h3>
						<small>CANTIDAD</small>
					</h3>
					
				</div>

				<div class="col-sm-2 col-xs-0 text-center">

					<h3>
						<small>SUBTOTAL</small>
					</h3>
					
				</div>
				
			</div>

			<!--===============================================
     			CUERPO CARRITO DE COMPRAS
			===================================================-->
			<div class="panel-body cuerpoCarrito">

			</div>

			<!--===============================================
     			SUMA DEL TOTAL DE PRODUCTOS
			===================================================-->
			<div class="panel-body sumaCarrito">

				<div class="col-md-4 col-sm-6 col-xs-12 pull-right well total">

					<div class="col-xs-6">
						
						<h4>TOTAL:</h4>

					</div>

					<div class="col-xs-6">

						<h4>
							
							<strong>USD $<span>21</span></strong>

						</h4>
						
					</div>
					
				</div>

				<div class="col-md-5 col-sm-6 col-xs-12 pull-left well">

					<div class="col-xs-4">

						<h6><strong>EXCEPCIONES:</strong></h6>
						
					</div>

					<div class="col-xs-8">
						
						<textarea class="form-control" rows="5" id="comentario" name="comentario" maxlength="300" required></textarea>

					</div>

					
					
				</div>

				

			</div>


			<!--===============================================
     			BOTÓN CHECKOUT	
			===================================================-->
			<div class="panel-heading cabeceraCheckout">

				<button class="btn btn-default backColor btn-lg pull-right">REALIZAR PAGO</button>
				
			</div>

			

		</div>
		

	</div>

</div>