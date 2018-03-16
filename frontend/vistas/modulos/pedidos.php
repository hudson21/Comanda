<!--===============================================
   VALIDAR SESIÓN
===================================================-->
<?php



$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

if(!isset($_SESSION["validarSesion"])){

	echo '<script>
			swal({
					title: "¡NO TIENE ACCESO!",
					text: "¡Necesita estar logeado para poder ver su lista de Pedidos!",
					type:"warning",
					confirmButtonText:"Ok",
					closeOnConfirm: false,
					icon: "warning"
				 },

				 function(isConfirm){

					 if(isConfirm){
						// history.back();
					     window.location = "'.$url.'";
					 }
				});
			

	</script>';

	exit();//Esto es para cancelar cualquier acción que se hada dentro de PHP
}

?>
<style>

	.menuDesplegable{display:none;}

	.cesta{display:none;}
</style>
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

		

	<?php

		 $item = $_SESSION["id"];
		 $item1 = 1;
		 $usuario = $_SESSION["nombre"];

		 $pedidos = ControladorUsuarios::ctrMostrarPedidosByIdUsuario($item);

		 //var_dump($pedidos);
		 $mostrar = ControladorUsuarios::ctrMostrarPedidosByMostrar($item, $item1);

		 if(!$pedidos){//Si no hay nada en la lista de pedidos

			 echo '<style> .cabeceraPedidos {display:none;} </style>
			 <div class="col-xs-12 text-center error404">
				               
				     <h1><small>¡Oops!</small></h1>
				    
				     <h2>Aún no tiene productos en su lista de pedidos</h2>

				   </div>';

		 }else{ 

		 	echo'<div class="panel-group" id="accordion">';
			  $i=1;

		     foreach($pedidos as $key => $value1){

				  	if($value1["cabecera"] == 1){

				     	echo'<div class="panel panel-default">';

						   echo'<div class="panel-heading">
						        	<h4 class="panel-title">
								      <a data-toggle="collapse" data-parent="#accordion" href="#pedido'.$i.'">Pedido '.$i.'</a>
						        		</h4>
						      	</div>
	
						      	<div id="pedido'.$i.'" class="panel-collapse collapse ">';

						         echo'  <div class="panel-body">';
						   

                    			echo' <div class="panel panel-default"> 

										<div class="panel-heading cabeceraPedidos">

										<div class="col-md-2 col-sm-3 col-xs-12 text-center">

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

						        <!--ESTE ES EL DIV DE PANEL PANEL-DEFAULT -->';

						        echo'<div class="" cuerpoPedidos">';
						    }

						        	$ordenar = "id";
									$valor = $value1["id_producto"];
									$item = "id";

									$productos = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);


									foreach($productos as $key => $value2){

				     if($value2["tipo"] == "fisico" && $value1["cabecera"]==1 || $value2["tipo"] == "fisico" && $value1["cabecera"]== 0 ){

									  echo '<div class="row itemCarrito">

										<div class="col-sm-1 col-xs-12">

											<br>

											<center>
									
												<button class="btn btn-default backColor quitarItemPedido " idProducto="'.$value1["id"].'">
												<i class="fa fa-times"></i>
												</button>

											</center>
								
										</div>

										<div style="margin-top:30px;" class="col-sm-1 col-xs-12">
								
											<br>

											<p  class="tituloCarritoPedidos text-left">'.$value1["palapa"].'</p>

										</div>

										<div style="margin-top:15px" class="col-sm-1 col-xs-12">
								
											<figure >

											<img src="'.$servidor.$value2["portada"].'" class="img-thumbnail">

											</figure>

										</div>

										<div style="margin-left:5px; " class="col-sm-1 col-xs-12">

											<br>

											<p class="tituloCarritoCompra text-left">'.$value2["titulo"].'</p>
								
										</div>

										<div class="col-md-2 col-sm-1 col-xs-12">

											<br>

										 	<p class="precioCarritoPedidos text-center">USD $<span>'.$value2["precio"].'</span></p>
								
										</div>

										<div  class="col-md-2 col-sm-3 col-xs-8 ">

											<br>

											<div style="margin-left:5px" class="col-xs-8">

												<center>
										
												  <input type="number" class="form-control text-center" min="1" value="'.$value1["cantidad"].'" readonly> 

												</center>
										
											</div>

										</div>

										<div style="margin-top:20px; " class="col-md-3 col-sm-1 col-xs-4 ">

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

							<hr>';

							}//=================FIN DEL TIPO FISICO===================================

					if($value2["tipo"] == "virtual" && $value1["cabecera"]==1 || $value2["tipo"] == "virtual" && $value1["cabecera"]==0 ){

					echo '<div class="row itemCarrito">

								<div class="col-sm-1 col-xs-12">

									<br>

									<center>
							
										<button class="btn btn-default backColor quitarItemPedido " idProducto="'.$value1["id"].'">
										<i class="fa fa-times"></i>
										</button>

									</center>
						
								</div>

								<div  class="col-sm-1 col-xs-12">
						
									<br>

									<p  class="tituloCarritoPedidos text-left">'.$value1["palapa"].'</p>

								</div>

								<div style="margin-top:15px" class="col-sm-1 col-xs-12">
						
									<figure >

									<img src="'.$servidor.$value2["portada"].'" class="img-thumbnail">

									</figure>

								</div>

								<div style="margin-left:5px; " class="col-sm-1 col-xs-12">

									<br>

									<p class="tituloCarritoCompra text-left">'.$value2["titulo"].'</p>
						
								</div>

								<div class="col-md-2 col-sm-1 col-xs-12">

									<br>

								 	<p class="precioCarritoPedidos text-center">USD $<span>'.$value2["precio"].'</span></p>
						
								</div>

								<div  class="col-md-2 col-sm-3 col-xs-8 ">

									<br>

									<div style="margin-left:5px" class="col-xs-8">

										<center>
								
										  <input type="number" class="form-control text-center" min="1" value="'.$value1["cantidad"].'" readonly> 

										</center>
								
									</div>

								</div>

								<div style="margin-top:20px; " class="col-md-3 col-sm-1 col-xs-4 ">

									<div class="progress">

										<div class="progress-bar progress-bar-success" role="progressbar" style="width:100%">
											<i class="fa fa-check"></i> Entregado
										</div>

									</div>

								</div>

						</div>

					<div class="clearfix"></div>

					<hr>';

					


				                  }//======================FIN DEL ELSE TIPO VIRTUAL===============================


				              }//=================FIN DEL FOREACH CON VALUE 2===================================

				              if($value1["ultimo"] == 1){

				              	echo'</div>';

				             echo'</div> <!--FIN DEL PANEL BODY QUE HAY DENTRO DEL SEGUNDO IF DE CABECERA=1-->';
				          
				        echo'</div> <!--FIN DEL PANEL_COLLAPSE QUE HAY DENTRO DEL PRIMER IF DE CABECERA=1-->';

		             echo '</div> </div> <!--FIN DEL PANEL DEFAULT QUE HAY DENTRO DEL PRIMER IF DE CABECERA=1-->';
		         }


                  	$i++;
				}//=================FIN DEL FOREACH CON VALUE 1===================================


		 echo'</div> <!--Div del id accordion-->';
				

		 }//=================================FIN DEL ELSE PEDIDOS (El PRIMERITO)====================================

		




			/*foreach($pedidos as $key => $value1){

					   echo '<style>br{display:none;}</style>';

						echo'<div class="panel-body sumaPedidos">

								<div class="col-md-12 col-sm-6 col-xs-12 pull-left well">

									<div class="col-xs-2">

										<h6><strong>EXCEPCIONES:</strong></h6>
								
							       </div>


								<div class="col-xs-10">';
							
							echo'<textarea class="form-control" rows="7" id="comentario" name="comentario" maxlength="300">';
								
								foreach($pedidos as $key => $value1){

									if($value1["mostrar"] == 0){
									echo "";
									}else if($value1["mostrar"]==1 && $value1["palapa"] != ""){
									echo $value1["palapa"]." a cargo de ".$usuario." tiene los siguientes comentarios: ".$value1["comentarios"]." \n";
									}	
								}
							
							echo'</textarea>';
							}*/



					
 
?>




<br><br><br>

<h2>Este es el de ejemplo no te confundas</h2>
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Collapsible Group 1</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse ">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Collapsible Group 2</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.

      asffafadfasfdsafdsafsadfasfdsafsafsafdsafdsafdsafdsafdsaf

      <div>sadñ{sldkf{ñalskfd{ñsalkfñ{askfdñ{salkfd</div>
   </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Collapsible Group 3</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.

      asffafadfasfdsafdsafsadfasfdsafsafsafdsafdsafdsafdsafdsaf

      <div>sadñ{sldkf{ñalskfd{ñsalkfñ{askfdñ{salkfd</div>
   </div>
    </div>
  </div>

  
</div>


					

			



			

			



