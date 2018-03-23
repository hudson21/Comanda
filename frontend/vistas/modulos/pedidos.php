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

<style>

.btnRecibiendo{
	color:#fff; 
	margin-right:2px;
	font-weight: bold;
	float:right;
}
.btnPreparando{
	float:right;
	color:#fff;
	font-weight: bold;
	margin-right:2px;
}
.btnListo{
	float:right;
	color:#fff;
	font-weight: bold;
}

	
</style>
<!--===============================================
     TABLA CARRITO DE COMPRAS
===================================================-->
<div class="container-fluid">
	
	<div class="container">

		

	<?php

		 $item = $_SESSION["id"];
		 $item1 = 1;
		 $usuario = $_SESSION["nombre"];

		 $cabeceraPedidos = ControladorUsuarios::ctrMostrarCabeceraPedidosByUsuario($item);

		 $contarPedidos=count($cabeceraPedidos);

		 $cuenta = 0;

		 echo '<script>

	            localStorage.setItem("contarPedidos","'.$contarPedidos.'");

	      </script>';

		 $i = 1;

		 //var_dump($pedidos);
		 //$mostrar = ControladorUsuarios::ctrMostrarPedidosByMostrar($item, $item1);

		 if(!$cabeceraPedidos){//Si no hay nada en la lista de pedidos

			 echo '<style> .cabeceraPedidos {display:none;} </style>
			 <div class="col-xs-12 text-center error404">
				               
				     <h1><small>¡Oops!</small></h1>
				    
				     <h2>Aún no tiene productos en su lista de pedidos</h2>

				   </div>';

		 }else{ 

		 	echo'<div class="panel-group" id="accordion">';

   foreach($cabeceraPedidos as $key => $value1){

   /*	if($value1["disponible"]==1){

   		echo'<style>
			
			.inicio'.$i.'{
				display:none;
			}

   		</style>';
   	}*/

   	if($value1["disponible"]==0){

   	 $numero_pedido=$value1["no_pedido"];

		 echo'<div class="inicio'.$i.' panel panel-default">';
		 	$resultado1 = substr($value1["fecha"], 0, -15);
		  echo'<div class="panel-heading">
			     <h4 class="panel-title">';
			     echo'<button style="margin-right:15px" class="btn btn-default backColor quitarItemPedido " noPedido="'.$value1["no_pedido"].'"><i class="fa fa-times"></i>
					  </button>';
				  echo'<a style="font-weight:bold;" data-toggle="collapse" data-parent="#accordion" href="#pedido'.$value1["no_pedido"].'">'.$resultado1.' / '.$value1["no_pedido"].' / '.$value1["nombre_usuario"].' / '.$value1["origen"].' / '.$value1["lugar_preparacion"].' /'; 
								     
					  $resultado = substr($value1["fecha"], 10);
								   
					  echo $resultado;

					  
			   echo'</a>';
			   if($value1["estado"]==0){
			   	echo'<button  class="btnListo btn  btn-danger" noPedido="'.$value1["no_pedido"].'" >LISTO <i id="listo'.$i.'" class="fa fa-clock-o"></i></button>';
			  	echo'<button  class="btnPreparando btn-success btn" noPedido="'.$value1["no_pedido"].'" >PREPARANDO <i id="preparando'.$i.'" class="fa fa-clock-o"></i></button>';
			  	echo'<button  class="btnRecibiendo btn-info btn" noPedido="'.$value1["no_pedido"].'">RECIBIENDO <i id="recibiendo'.$i.'"class="fa fa-check"></i></button>';
			  }

			  if($value1["estado"]==1){
			   	echo'<button  class="btnListo btn  btn-danger" noPedido="'.$value1["no_pedido"].'" >LISTO <i id="listo'.$i.'" class="fa fa-clock-o"></i></button>';
			  	echo'<button  class="btnPreparando btn-success btn" noPedido="'.$value1["no_pedido"].'" >PREPARANDO <i id="preparando'.$i.'" class="fa fa-check"></i></button>';
			  	echo'<button  class="btnRecibiendo btn-info btn" noPedido="'.$value1["no_pedido"].'">RECIBIENDO <i id="recibiendo'.$i.'"class="fa fa-check"></i></button>';
			  }

			  if($value1["estado"]==2){
			   	echo'<button  class="btnListo btn  btn-danger" noPedido="'.$value1["no_pedido"].'" >LISTO <i id="listo'.$i.'" class="fa fa-check"></i></button>';
			  	echo'<button  class="btnPreparando btn-success btn" noPedido="'.$value1["no_pedido"].'" >PREPARANDO <i id="preparando'.$i.'" class="fa fa-check"></i></button>';
			  	echo'<button  class="btnRecibiendo btn-info btn" noPedido="'.$value1["no_pedido"].'">RECIBIENDO <i id="recibiendo'.$i.'"class="fa fa-check"></i></button>';
			  }
			   
			  	
			  echo'</h4>';
			 echo'</div>


	
			 <div id="pedido'.$value1["no_pedido"].'" class="panel-collapse collapse ">';

			   echo' <div class="panel-body">';

				 echo' <div class=" panel-default"> 

				        <div class="panel-heading cabeceraPedidos">

						   <div class="col-md-2 col-sm-3 col-xs-12 text-center">
							   <h3>
								   <small>NOMBRE</small>
							   </h3>
						   </div>


							<div class="col-md-3 col-sm-2 col-xs-12 text-center">
								<h3>
									<small>IMAGEN</small>
								</h3>
							</div>


							<div class="col-md-2 col-sm-3 col-xs-0 text-center">
								<h3>
									<small>PRECIO</small>
								</h3>
							</div>


							<div class="col-lg-4 col-md-4 col-sm-2 col-xs-0 text-center">
								<h3>
									<small>CANTIDAD</small>
								</h3>
							</div>

						 </div>

					</div>

		  <!--<div>ESTE ES EL DIV DE PANEL PANEL-DEFAULT -->';

				$numero_pedido= $value1["no_pedido"];

				$lineaPedidos=ControladorUsuarios::ctrMostrarLineaPedidosByNoPedido($numero_pedido);

				echo'<div class="" cuerpoPedidos">';

				  foreach($lineaPedidos as $key => $value2){

				  	$ordenar = "id";
				    $valor = $value2["id_producto"];
				    $item = "id";
				    $productos = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);

						foreach($productos as $key => $value3){

						  if($value3["tipo"] == "fisico" || $value3["tipo"] == "virtual"){

					       echo '<div class="row itemCarrito">';

										 /*<div class="col-sm-1 col-xs-12">

											<br>

											<center>
									
												

											</center>
								
										</div>*/

								echo'<div style="margin-top:30px;" class="col-sm-2 col-xs-12 text-right">
								
											<br>

											<p  class="tituloCarritoPedidos ">'.$value3["titulo"].'</p>

										</div>

										<div style="margin-top:15px" class="col-sm-2 col-xs-12 text-right">
								
											<figure >

											<img style="width:70px" src="'.$servidor.$value3["portada"].'" class="img-thumbnail">

											</figure>

										</div>

									

										<div style="margin-left:100px" class="col-md-2 col-sm-1 col-xs-12">

											<br>

										 	<p class="precioCarritoPedidos text-center">USD $<span>'.$value3["precio"].'</span></p>
								
										</div>

										<div style="margin-left:100px" class="col-md-2 col-sm-3 col-xs-8 ">

											<br>

											<div style="margin-left:5px" class="col-xs-8">

												<center>
										
												  <input type="number" class="form-control text-center" min="1" value="'.$value2["cantidad"].'" readonly> 

												</center>
										
											</div>

										</div>

											
					
									</div>

								<div class="clearfix"></div>

							<hr>';

							}//=================FIN DEL TIPO FISICO Y VIRTUAL===================================

					   
						  }//================= FIN DEL FOREACH VALUE 3

						
					  }//======== FIN DEL FOREACH CON VALUE 2
						   
								  echo'</div><!--Este es el div del cuerpoPedidos-->';
				

						if($value1["mostrar"]==1 && $value1["origen"] != "" && $value1["lugar_preparacion"] != ""){

							echo'<div class="panel-body sumaPedidos">

								<div class="col-md-12 col-sm-6 col-xs-12 pull-left well">
									<div class="col-xs-2">
										<h6><strong>EXCEPCIONES:</strong></h6>
							       </div>


								<div class="col-xs-10">';
							
								echo'<textarea class="form-control" rows="7" id="comentario" name="comentario" maxlength="300">';			
								  
								  echo $value1["origen"]." a cargo de ".$value1["nombre_usuario"]." tiene los siguientes comentarios: ".$value1["comentarios"]." \n";
								  		
								 echo'</textarea>';

						  echo'</div>
						   </div>
						</div>';

						}

						     echo'</div> <!--FIN DEL PANEL BODY-->';
				          
				        echo'</div> <!--FIN DEL PANEL_COLLAPSE -->';

		             echo '</div> <!--FIN DEL PANEL DEFAULT -->';

		         $i++;

		         

   	 }// ========== FIN DEL IF DE (DISPONIBLE = 0)=================================

   	else{
   				$i++;
   	 	$cuenta++;
   	 	if($cuenta == count($cabeceraPedidos)){
   	 		echo '<style> .cabeceraPedidos {display:none;} </style>
			 <div class="col-xs-12 text-center error404">
				               
				     <h1><small>¡Oops!</small></h1>
				    
				     <h2>Aún no tiene productos en su lista de pedidos</h2>

				   </div>';

   	 	}
   	 }
	  
 }//===== FIN DEL FOREACH CON VALUE 1 ========




		 	echo'</div> <!--Div del id accordion-->';
   }//=========FIN DE TODO EL ELSE
			  
		     					
 
?>
