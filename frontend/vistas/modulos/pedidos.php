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

				<li><a style="text-decoration:none;" href="<?php echo $url; ?>">LISTA</a></li>
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
			<div class="panel-heading cabeceraPedidos">

				<div class="col-md-2 col-sm-3 col-xs-12 text-right">

					<h3>
						<small>PALAPA</small>
					</h3>
					
				</div>

				<div class="col-md-1 col-sm-3 col-xs-12 text-center">

					<h3>
						<small>IMAGEN</small>
					</h3>
					
				</div>

				<div class="col-md-1 col-sm-2 col-xs-12 text-center">

					<h3>
						<small>PRODUCTO</small>
					</h3>
					
				</div>

				<div class="col-md-2 col-sm-3 col-xs-0 text-center">

					<h3>
						<small>PRECIO</small>
					</h3>
					
				</div>

				<div class="col-sm-2 col-xs-0 text-center">

					<h3>
						<small>CANTIDAD</small>
					</h3>
					
				</div>

				<div class="col-sm-4 col-xs-0 text-center">

					<h3>
						<small>ESTADO</small>
					</h3>
					
				</div>
				
			</div>

			<!--===============================================
     			CUERPO CARRITO DE COMPRAS
			===================================================-->
			<div class="panel-body cuerpoPedidos">

				<!--Item 1-->
				
				<div class="row itemCarrito">

					<div class="col-sm-1 col-xs-12">

						<br>

						<center>
							
							<button class="btn btn-default backColor">
								<i class="fa fa-times"></i>
							</button>

						</center>
						
					</div>

					<div  class="col-sm-1 col-xs-12">
						
						<br>

						<p style="margin-left:5px" class="tituloCarritoPedidos text-left">Palapa 1</p>

					</div>

					<div style="margin-top:15px" class="col-sm-1 col-xs-12">
						
						<figure >
							
							<img  src="http://localhost/comanda/backend/vistas/img/productos/cursos/curso02.jpg" class="img-thumbnail">

						</figure>

					</div>

					<div style="margin-left:5px; " class="col-sm-1 col-xs-12">

						<br>

						<p class="tituloCarritoCompra text-left">Aprende Javascript desde Cero</p>
						
					</div>

					<div class="col-md-2 col-sm-1 col-xs-12">

						<br>

						<p class="precioCarritoPedidos text-center">USD $<span>10</span></p>
						

					</div>
					

					<div  class="col-md-2 col-sm-3 col-xs-8 ">

						<br>

							<div style="margin-left:5px" class="col-xs-8">

								<center>
								
								<input type="number" class="form-control text-center" min="1" value="1" readonly> 

								</center>
								
							</div>

					</div>

					<div style="margin-top:20px" class="col-md-3 col-sm-1 col-xs-4 subtotal">

						<div class="progress">

							<div class="progress-bar progress-bar-info" role="progressbar" style="width:33.33%">
								<i class="fa fa-check"></i> Despachado
							</div>

							<div class="progress-bar progress-bar-default" role="progressbar" style="width:33.33%">
								<i class="fa fa-clock-o"></i> Enviando
							</div>

							<div class="progress-bar progress-bar-success" role="progressbar" style="width:33.33%">
								<i class="fa fa-clock-o"></i> Entregado
							</div>

						</div>
						

					</div>
						
					
					
				</div>


				<div class="clearfix"></div>

				<hr>		
			<!--===============================================
     			SUMA DEL TOTAL DE PRODUCTOS
			===================================================-->
			<div class="panel-body sumaPedidos">

				<div class="col-md-5 col-sm-6 col-xs-12 pull-left well">

					<div class="col-xs-4">

						<h6><strong>EXCEPCIONES:</strong></h6>
						
					</div>

					<div class="col-xs-8">
						
						<textarea class="form-control" rows="5" id="comentario" name="comentario" maxlength="300" required></textarea>

					</div>

					
					
				</div>

				

			</div>


			

			

		</div>
		

	</div>

</div>

