<?php
          
      $servidor = Ruta::ctrRutaServidor(); 

	  $url = Ruta::ctrRuta();

	?>

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

			</div>


			<!--===============================================
     			BOTÓN CHECKOUT	
			===================================================-->
			<div class="panel-heading cabeceraCheckout">

				<?php

					if(isset($_SESSION["validarSesion"])){

						if($_SESSION["validarSesion"] == "ok"){

							echo '<a id="btnCheckout" idUsuario="'.$_SESSION["id"].'" href="#modalCheckout" data-toggle="modal"><button class="btn btn-default backColor btn-lg pull-right">REALIZAR PAGO</button></a>';

						}

					}else{
							echo '<a href="#modalIngreso" data-toggle="modal"><button class="btn btn-default backColor btn-lg pull-right">REALIZAR PAGO</button></a>';
					} 

				?>

			</div>

		</div>

	</div>

</div>

<!--===============================================
    VENTANA MODAL PARA CHECKOUT
===================================================-->
<div id="modalCheckout" class="modal fade modalFormulario" role="dialog">

	<div class="modal-content modal-dialog">

		<div class="modal-body modalTitulo">

			<h3 class="backColor">REALIZAR PAGO</h3>

			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<div class="contenidoCheckout">

				<div class="formEnvio row">

					<h4 class="text-center well text-muted text-uppercase">Información de envío</h4>

					<div class="col-xs-12 seleccionePalapa">

						<select class="form-control" id="seleccionePalapa" required>
							
							<option value="">Seleccione la Palapa</option>

						</select>
						
					</div>

				</div>

				<br>

				<div class="formaPago row">

					<h4 class="text-center well text-muted text-uppercase">Elige la forma de pago</h4>

					<figure class="col-xs-6">

						<center>

							<input id="checkPaypal" type="radio" name="pago" value="paypal" checked>

						</center>

							<img src="<?php echo $url; ?>vistas/img/plantilla/paypal.jpg" class="img-thumbnail" alt="">		
						
					</figure>


					<figure class="col-xs-6">

						<center>

							<input id="checkPayu" type="radio" name="pago" value="payu">

						</center>

							<img src="<?php echo $url; ?>vistas/img/plantilla/payu.jpg" class="img-thumbnail" alt="">

					</figure>
					
				</div>

				<br>

				<div class="listaProductos row">

					<h4 class="text-center well text-muted text-uppercase">Productos a comprar</h4>

					<table class="table table-striped tablaProductos">
						
						<thead>
							
							<tr>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</tr>

						</thead>

						<tbody>
							

						</tbody>

					</table>

					<div class="col-sm-6 col-xs-12 pull-right">
						
						<table class="table table-striped tablaTasas">
							
							<tbody>
								
								<tr>
									<td>Subtotal</td>
									<td>USD $20</td>
								</tr>

								<tr>
									<td>Tiempo de Pedido</td>
									<td>30 Min</td>
								</tr>

								<tr>
									<td>Impuesto</td>
									<td>USD $30</td>
								</tr>

								<tr>
									<td><strong>Total</strong></td>
									<td><strong>USD $30</strong></td>
								</tr>


							</tbody>

						</table>
				
						<div class="divisa">
							
							<select class="form-control" id="cambiarDivisa" name="divisa">
								
								<option value="USD">USD</option>

							</select>

							<br>

						</div>

					</div>

					<div class="clearfix"></div>

					<button class="btn btn-block btn-lg btn-default backColor btnPagar">PAGAR</button>
					
				</div>

				
			</div>
			
		</div>

		<div class="modal-footer">
			
		</div>
		
	</div>
	
</div>