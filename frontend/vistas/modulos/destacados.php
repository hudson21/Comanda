<!--=====================================
BANNER
======================================-->

<?php

$servidor = Ruta::ctrRutaServidor();

$ruta = "sin-categoria";

$banner = ControladorProductos::ctrMostrarBanner($ruta);

$titulo1 = json_decode($banner["titulo1"],true);
$titulo2 = json_decode($banner["titulo2"],true);
$titulo3 = json_decode($banner["titulo3"],true);

/*if($banner != null){

echo '<figure class="banner">

		<img src="'.$servidor.$banner["img"].'" class="img-responsive" width="100%">	

		<div class="textoBanner '.$banner["estilo"].'">
			
			<h1 style="color:'.$titulo1["color"].'">'.$titulo1["texto"].'</h1>

			<h2 style="color:'.$titulo2["color"].'"><strong>'.$titulo2["texto"].'</strong></h2>

			<h3 style="color:'.$titulo3["color"].'">'.$titulo3["texto"].'</h3>

		</div>

	</figure>';

}*/


$titulosModulos = array("ARTÍCULOS CON DESCUENTO", "LO MÁS VENDIDO", "LO MÁS VISTO");
$rutaModulos = array("articulos-con-descuento","lo-mas-vendido","lo-mas-visto");

$base = 0;
$tope = 4;

if($titulosModulos[0] == "ARTÍCULOS CON DESCUENTO"){

$ordenar = "id";
$item = "precio";
$valor = 0;
$modo = "DESC";

$gratis = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

if($titulosModulos[1] == "LO MÁS VENDIDO"){

$ordenar = "ventas";
$item = null;
$valor = null;
$modo = "DESC";

$ventas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

if($titulosModulos[2] == "LO MÁS VISTO"){

$ordenar = "vistas";
$item = null;
$valor = null;
$modo = "DESC";

$vistas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

$modulos = array($gratis, $ventas, $vistas);

for($i = 0; $i < count($titulosModulos); $i ++){

	echo '<div class="container-fluid well well-sm barraProductos">

			<div class="container">
				
				<div class="row">
					
					<div class="col-xs-12 organizarProductos">

						<div class="btn-group pull-right">

							 <button type="button" class="btn btn-default btnGrid" id="btnGrid'.$i.'">
							 	
								<i class="fa fa-th" aria-hidden="true"></i>  

								<span class="col-xs-0 pull-right"> GRID</span>

							 </button>

							 <!--<button type="button" class="btn btn-default btnList" id="btnList'.$i.'">
							 	
								<i class="fa fa-list" aria-hidden="true"></i> 

								<span class="col-xs-0 pull-right"> LIST</span>

							 </button>-->
							
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
					
							<h1><small>'.$titulosModulos[$i].' </small></h1>

						</div>

						<div class="col-sm-6 col-xs-12">
					
							<a href="'.$rutaModulos[$i].' ">
								
								<button style="z-index:200;" class="btn btn-default backColor pull-right">
									
									VER MÁS <span class="fa fa-chevron-right"></span>

								</button>

							</a>

						</div>

					</div>

					<div class="clearfix"></div>

					<hr>

				</div>

				<ul class="grid'.$i.'">';

				foreach ($modulos[$i] as $key => $value) {
					
					echo '<li class="col-md-3 col-sm-6 col-xs-12">

							<figure class="productsImg">
								
								<a href="'.$value["ruta"].'" class="pixelProducto">
									
									<img src="'.$servidor.$value["portada"].'" class="img-responsive">

								</a>

							</figure>

							<h4 class="productsH4">
					
								<small>
									
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["titulo"].'<br>

										<span style="color:rgba(0,0,0,0)">-</span>';

									echo '</a>	

								</small>			

							</h4>';

							echo '<div class="tamañoDivEnlaces col-xs-6 enlaces">
								
								<div class=" tamañoDiv  ">
									
									<!--<button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">
										<i class="fa fa-heart" aria-hidden="true"></i>
									</button>-->
									
									<div class="col-lg-2 col-xs-2 posicionBotonMenos" >

										<button class="tamañoBotonesMasyMenos btn btn-danger">-</button>
									</div>
									
									
									<div  class="col-xs-3 txtCantidad">

										<input type="number" class="anchoBotonCantidad form-control cantidadItem" min="1" value="" tipo="" precio="" idProducto="">
									</div>

									<div class="posicionBotonMas col-lg-2 col-xs-2">

										<button class="tamañoBotonesMasyMenos btn btn-success">+</button>
									</div>

									
									<br>
									
									<div class="col-xs-10"></div>

									<div class="botonOrdenar col-xs-2">

								     <button type="button" class="btn btn-default btn-circle btn-lg agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip">

								     <i class="fa fa-shopping-cart"></i>
								     </button>

									

									</div>

								</div>

							</div>

						</li>';
				}

				

		echo'</div>

		</div>';

}

?>

