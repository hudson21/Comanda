<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();



?>

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
			<div class="panel-body cuerpoPedidos">

			</div>

			<!--===============================================
     			SUMA DEL TOTAL DE PRODUCTOS
			===================================================-->
			<div class="panel-body sumaPedidos">

				<div class="col-md-4 col-sm-6 col-xs-12 pull-right well total">

								<div class="col-xs-6">
						
									<h4>TOTAL:</h4>

							   </div>

								<div class="col-xs-6">

									<h4 class="sumaSubTotal">
							

									</h4>
						
							  </div>
					
					</div>

					<div class="excepciones">
						

					</div>

			</div>

	   </div>

	</div>

</div>