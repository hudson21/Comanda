<?php

$servidor = Ruta::ctrRutaServidor();

$url = Ruta::ctrRuta();

?>

<!--===============================================
BREADCRUMB DE INFO PRODUCTOS
===================================================-->

<div class="container-fluid well well-sm">

	<div class="container">

		<div class="row">

			<ul class="breadcrumb  fondoBreadcrumb text-uppercase" style="margin-bottom:0px; background:rgba(0,0,0,0);">

				<li><a style="text-decoration:none;" href="<?php echo $url; ?>">INICIO</a></li>
			    <li class="active pagActiva"><?php echo $rutas[0]; ?></li>
				
			</ul>
			

		</div>
		

	</div>
	

</div>

<!--===============================================
INFO PRODUCTOS
===================================================-->
<div class="container-fluid infoproducto">

	<div class="container">

		<div class="row">

			<!--===============================================
				VISOR DE PRODUCTOS
			===================================================-->

		  <div class="col-md-5 col-sm-6 col-xs-12 content-all"> <!-- visorImg-->

		  	<div class="content-carrousel">
		  		
		  		<figure >

           		<img class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-01.jpg">			
            	</figure>

            <figure >

           		<img class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-02.jpg">			
            </figure>

            <figure >

           		<img class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-03.jpg">			
            </figure>

            <figure >

           		<img class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-04.jpg">			
            </figure>

            <figure >

           		<img class="img-thumbnail" src="http://localhost/Comanda/backend/vistas/img/multimedia/tennis-verde/img-05.jpg">			
            </figure>

		  	</div>

				
			 

		
		 </div>
		
		</div>

	</div>
	

</div>
