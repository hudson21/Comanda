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

		 echo'<div marginDiv class="inicio'.$i.' panel panel-default">';
		 	$resultado1 = substr($value1["fecha"], 0, -15);
		  echo'<div class="panel-heading">
		  		
			     <h4 class="panel-title">';
			     echo'<button style="margin-right:15px" class="btn btn-default backColor quitarItemPedido " noPedido="'.$value1["no_pedido"].'"><i class="fa fa-times"></i>
					  </button>';

				  echo'<a class="tamañoA" style="font-weight:bold;" data-toggle="collapse" data-parent="#accordion" href="#pedido'.$value1["no_pedido"].'">'.$resultado1.' / '.$value1["no_pedido"].' / '.$value1["nombre_usuario"].' / '.$value1["origen"].' / '.$value1["lugar_preparacion"].' /'; 
								     
					  $resultado = substr($value1["fecha"], 10);
								   
					  echo $resultado;

					  
			   echo'</a>'; 
			   if($value1["estado"]==0){
			   	echo'<button  onClick="this.disabled=true"id="botonListo'.$i.'" repeticion="'.$i.'"class=" posicionListo btnListo btn  btn-danger" nombreUsuario="'.$value1["nombre_usuario"].'" noUsuario="'.$value1["id_usuario"].'" repeticion="'.$i.'" noPedido="'.$value1["no_pedido"].'" ><span class="col-xs-0 tamañoA">LISTO</span> <i id="listo'.$i.'" repeticion="'.$i.'"class="tamañoA fa fa-clock-o"></i></button>';
			  	echo'<button onClick="this.disabled=true" id="botonPreparando'.$i.'" class="posicionPreparando btnPreparando btn-success btn" repeticion="'.$i.'" noPedido="'.$value1["no_pedido"].'" ><span class="col-xs-0 tamañoA">PREPARANDO</span> <i id="preparando'.$i.'" class="tamañoA fa fa-clock-o"></i></button>';
			  	echo'<button onClick="this.disabled=true"id="botonRecibiendo'.$i.'" repeticion="'.$i.'"class="posicionRecibiendo btnRecibiendo btn-info btn" repeticion="'.$i.'" noPedido="'.$value1["no_pedido"].'"><span class="col-xs-0 tamañoA">RECIBIENDO</span> <i id="recibiendo'.$i.'"class="tamañoA fa fa-check"></i></button>';
			  	echo'<script>
				document.getElementById("botonRecibiendo'.$i.'").disabled=true;
			  	</script>';
			  }

			  if($value1["estado"]==1){
			   	echo'<button onClick="this.disabled=true"id="botonListo'.$i.'" class="btnListo btn  btn-danger" nombreUsuario="'.$value1["nombre_usuario"].'" noUsuario="'.$value1["id_usuario"].'" repeticion="'.$i.'" noPedido="'.$value1["no_pedido"].'" >LISTO <i id="listo'.$i.'" class="fa fa-clock-o"></i></button>';
			  	echo'<button onClick="this.disabled=true" id="botonPreparando'.$i.'"  class=" btnPreparando btn-success btn" repeticion="'.$i.'" noPedido="'.$value1["no_pedido"].'" >PREPARANDO <i id="preparando'.$i.'" class="fa fa-check"></i></button>';
			  	echo'<button id="botonRecibiendo'.$i.'" class=" btnRecibiendo btn-info btn" repeticion="'.$i.'" noPedido="'.$value1["no_pedido"].'">RECIBIENDO <i id="recibiendo'.$i.'"class="fa fa-check"></i></button>';

			  	echo'<script>
				document.getElementById("botonRecibiendo'.$i.'").disabled=true;
				document.getElementById("botonPreparando'.$i.'").disabled=true;
			  	</script>';
			  }

			  if($value1["estado"]==2){
			   	echo'<button  id="botonListo'.$i.'" class=" btnListo btn  btn-danger" nombreUsuario="'.$value1["nombre_usuario"].'" noUsuario="'.$value1["id_usuario"].'" repeticion="'.$i.'" noPedido="'.$value1["no_pedido"].'" >LISTO <i id="listo'.$i.'" class="fa fa-check"></i></button>';
			  	echo'<button id="botonPreparando'.$i.'" class=" btnPreparando btn-success btn" repeticion="'.$i.'" noPedido="'.$value1["no_pedido"].'" >PREPARANDO <i id="preparando'.$i.'" class="fa fa-check"></i></button>';
			  	echo'<button  id="botonRecibiendo'.$i.'"  class=" btnRecibiendo btn-info btn" repeticion="'.$i.'" noPedido="'.$value1["no_pedido"].'">RECIBIENDO <i id="recibiendo'.$i.'"class="fa fa-check"></i></button>';

			  	echo'<script>
			  	document.getElementById("botonListo'.$i.'").disabled=true;
				document.getElementById("botonRecibiendo'.$i.'").disabled=true;
				document.getElementById("botonPreparando'.$i.'").disabled=true;
			  	</script>';

			  }


			  	
			  echo'</h4>';
			 echo'</div>


	
			 <div id="pedido'.$value1["no_pedido"].'" class="panel-collapse collapse ">';

			   echo' <div class="panel-body">';

				 echo' <div class=" panel-default"> 

				        <div class="panel-heading cabeceraPedidos">

						   <div class="col-xs-0 col-md-2 col-sm-3 col-xs-12 text-center">
							   <h3>
								   <small style="font-weight:bold">IMAGEN</small>
							   </h3>
						   </div>


							<div class="col-xs-0 col-md-3 col-sm-2 col-xs-12 text-center">
								<h3>
									<small style="font-weight:bold" >NOMBRE</small>
								</h3>
							</div>


							<div class="col-xs-0 col-md-2 col-sm-3 col-xs-0 text-center">
								<h3>
									<small style="font-weight:bold" >PRECIO</small>
								</h3>
							</div>


							<div class="col-xs-0 col-lg-4 col-md-4 col-sm-2 col-xs-0 text-center">
								<h3 >
									<small style="font-weight:bold">CANTIDAD</small>
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

								echo'<div class="margenLeft col-lg-2 col-sm-2 col-xs-5 ">
								
											<figure >

											<img style="width:70px" src="'.$servidor.$value3["portada"].'" class="img-thumbnail">

											</figure>

									 </div>

									 <div class="textoAlign col-sm-2 col-xs-6">
								
										<br>

										<p style="font-weight:bold" class="tituloCarritoPedidos ">'.$value3["titulo"].'</p>

									 </div>

										
										<div class="margenLeftPrecio  col-lg-2 col-md-2 col-sm-1 col-xs-4">

											<br>

										 	<p style="font-weight:bold" class=" textoAlignPrecio ">USD $<span>'.$value3["precio"].'</span></p>
								
										</div>

										<div class="cantidadMargen col-lg-2 col-md-2 col-sm-3 col-xs-7 ">

											<br>

											<div  class="col-xs-8">

												<center>
										
												  <input style="font-weight:bold" type="number" class="form-control text-center" min="1" value="'.$value2["cantidad"].'" readonly> 

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


								<div class="col-xs-12">';
							
								echo'<textarea class="form-control" rows="7" id="comentario" name="comentario" maxlength="300">';			
								  
								  echo $value1["origen"]." a cargo de ".$value1["nombre_usuario"].": ".$value1["comentarios"]." \n";
								  		
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
