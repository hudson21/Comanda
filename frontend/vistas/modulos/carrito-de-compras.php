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

				<div class="col-md-3 col-sm-7 col-xs-12 text-center">

					<h3>
						<small>PRODUCTO</small>
					</h3>
					
				</div>


				<div class="col-md-5 col-sm-2 col-xs-0 text-center">

					<h3>
						<small>CANTIDAD</small>
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

				

					<div class="excepciones">
						

					</div>

			</div>


			<!--===============================================
     			BOTÓN CHECKOUT	
			===================================================-->
			<div class="panel-heading cabeceraCheckout">

				<?php

					if(isset($_SESSION["validarSesion"])){

						if($_SESSION["validarSesion"] == "ok"){

							echo '<a id="btnCheckout" idUsuario="'.$_SESSION["id"].'" href="#modalCheckout" data-toggle="modal"><button class="btn btn-default backColor btn-lg pull-right">REALIZAR ORDEN</button></a>';

						}

					}else{
							echo '<a href="#modalIngreso" data-toggle="modal"><button class="btn btn-default backColor btn-lg pull-right">REALIZAR ORDEN</button></a>';
					} 

				?>

			</div>

		</div>

	</div>

</div>

<!--===============================================
    VENTANA MODAL PARA CHECKOUT
===================================================-->
<div style="z-index:10000" id="modalCheckout" class="modal fade modalFormulario" role="dialog">

	<div class="modal-content modal-dialog">

		<div class="modal-body modalTitulo">

			<h3 class="backColor">REALIZAR ORDEN</h3>

			<button style="color:black; font-size:35px; font-weight:bold;" type="button" class="close" data-dismiss="modal">&times;</button>

			<div class="contenidoCheckout">

				

				<div class="formEnvio row">

					<h4 class="text-center well text-muted text-uppercase">Información de envío</h4>

					<div class="col-xs-12 seleccioneOrigen">
						
					</div>

					<div class="col-xs-12 seleccioneLugarPreparacion">
						

					</div>

				</div>

				<br>

			

				<br>

				<div class="listaProductos row">

					<h4 class="text-center well text-muted text-uppercase">Productos a confirmar</h4>

					<table class="table table-striped tablaProductos">
						
						<thead>
							
							<tr>
								<th >Producto</th>
								<th >Cantidad</th>
							
							</tr>

						</thead>

						<tbody>
							

						</tbody>

					</table>

					<div class="col-sm-6 col-xs-12 pull-right">
						
						<table class="table table-striped tablaTasas">
							
							<tbody>
								
				


							</tbody>

						</table>
				
						<!--<div class="divisa">
							
							<select class="form-control" id="cambiarDivisa" name="divisa">
								
								

							</select>

							<br>

						</div>-->

					</div>

					<div class="clearfix"></div>
					
					<button type="submit"  id="botonPagar" class=" btn btn-default btn-block btn-lg   backColor btnPagar ">ORDENAR</button>

						
					
				</div>

				
			</div>
			
		</div>

		<div class="modal-footer">
			
		</div>
		
	</div>
	
</div>

<?php
if(isset($_SESSION["validarSesion"])){
$item = $_SESSION["id"];
$tabla = "linea_pedidos";
$tabla1 = "cabecera_pedidos";	



//  LOCALSTORAGE PARA CONTAR EL NÚMERO MÁS GRANDE DENTRO DE LA COLUMNA DE NO_PEDIDO
$no_pedido = ControladorUsuarios::ctrMostrarColumnaNoPedido($item,$tabla);

	if($no_pedido == null){

	$num=1;	

	echo '<script>

	            localStorage.setItem("numeroPedido","'.$num.'");

	      </script>';

	 }else{

			$cantidad=$no_pedido;
			$i=0;
			$mayor=$cantidad[$i];
			$diferente=0;

			while($i<count($no_pedido)){
				if($mayor<$cantidad[$i]){ 
				 $mayor=$cantidad[$i];
				}
				 $i=$i+1;
			}

			//var_dump($mayor);

			$mayorString=implode(",",$mayor);
			$mayorNumero=(int)$mayorString;

			$mayorNumero = $mayorNumero + 1;

			echo '<script>

			            localStorage.setItem("numeroPedido","'.$mayorNumero.'");

			      </script>';


		}
	}

?>

