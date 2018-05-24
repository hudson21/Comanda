<!--===============================================
   VALIDAR SESIÓN
===================================================-->
<style>

@media (min-width:1200px){

.menuDesplegable{display:none;}

	
}
/*------------------------------------------------
   ESCRITORIO MEDIANO O TABLET HORIZONTAL  (MD revisamos en 1024px)
------------------------------------------------*/
@media (max-width:1199px) and (min-width:992px){

.menuDesplegable{display:none;}   

}
/*------------------------------------------------
   ESCRITORIO PEQUEÑO O TABLET VERTICAL (SM revisamos  en 768px)
------------------------------------------------*/
@media (max-width:991px) and (min-width:768px){

.menuDesplegable{display:none;}   

}
/*------------------------------------------------
  MOVIL (XS revisamos en 320px)
------------------------------------------------*/
@media (max-width:767px){

    
}

</style>
<?php

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

if(!isset($_SESSION["validarSesion"])){

	echo '<script>
	
			window.location = "'.$url.'"

	</script>';

	exit();//Esto es para cancelar cualquier acción que se hada dentro de PHP

}else{

	if($_SESSION["tipo_usuario"]==1){

		echo '<script>
	
			window.location = "'.$url.'"

	</script>';

	exit();//Esto es para cancelar cualquier acción que se hada dentro de PHP

	}
}

?>

<!--===============================================
     BREADCRUMB PERFIL
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
     SECCIÓN DE PERFIL
===================================================-->
<div class="container-fluid">

	<div class="container">

		<ul class="nav nav-tabs">

		  <li class="active">
		  	<a data-toggle="tab" href="#altasBajas">
		  	<i class="fa fa-thumbs-up"></i>
		  	<i class="fa fa-thumbs-down"></i> ALTAS Y BAJAS DE PRODUCTOS</a>
		  </li>

		  <li>
		  	<a data-toggle="tab" href="#nuevoProducto">
		  	<i class="fa fa-plus"></i> AGREGAR NUEVO PRODUCTO</a>
		  </li>

		  <li>
		  	<a data-toggle="tab" href="#editarEliminarProducto">
		  	<i class="fa fa-pencil"></i>
		  	<i class="fa fa-times"></i> EDITAR O ELIMINAR UN PRODUCTO</a>
		  </li>

		  <li>
		  	<a data-toggle="tab" href="#todosLosProductos">
		  	<i class="fa fa-eye"></i> AGREGAR O QUITAR TODOS LOS PRODUCTOS EN ALMACEN</a>
		  </li>

		</ul>

		<div class="tab-content">

			

			<!--===============================================
			   PESTAÑA ALTAS Y BAJAS DE PRODUCTOS
			===================================================-->
		  <div id="altasBajas" class="tab-pane fade in active">

			<div class="container">
				
				<?php

		  	echo'<div style="margin-top: 20px" class="btn-group">

					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						
						<span style="font-weight:bold; font-size:15px;">Filtrar por bares</span> <span class="caret"></span></button>

					<ul class="dropdown-menu" role="menu">';

		  	$bares = ControladorProductos::ctrVerificarCantidadProductosTabla("almacenes");

				foreach($bares as $key => $value){

                     echo'<li><a href="'.$url.$rutas[0].'/'.$value["id"].'"><span style="font-weight:bold;">'.$value["bares"].'</span></a></li>';
				}	

			echo'</ul>

			  </div>';


		if(!isset($rutas[1])){

			echo'<div class="col-xs-12 text-center error404">
				               
				     <h1><small>¡Oops!</small></h1>
				    
				     <h2>No ha seleccionado un bar para filtrar</h2>

				   </div>';


		}else{

			echo'<br><h3 style="text-align:center; 
                        font-weight:bold;">';

                  $nombreBar = ControladorUsuarios::ctrMostrarFilaBarById($rutas[1]);

                  echo $nombreBar["bares"];
                        
               echo'</h3>';

			echo'<script>

				localStorage.setItem("rutaBares","'.$url.$rutas[0]."/".$rutas[1].'");

   				</script>';

			$item=null;
            $valor=null;
            $i = 0;

                $categorias = ControladorProductos::ctrMostrarCategorias($item,$valor);

		  		echo'<div style="margin-top:30px" class="panel-group" id="accordion">';

		  		foreach($categorias as $key => $value){

		  		echo'<div class="panel panel-default">
			   	      <div class="panel-heading">
			   	      
					  <h4 class="panel-title">
			           <a style="font-weight:bold" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'">
			           '.$value["categoria"].'</a>
			          </h4>
			   	      
			           
			        </div>

			        <div id="collapse'.$i.'" class="panel-collapse collapse">
			         <div class="panel-body">';

			         $item = "id_categoria";
                     $valor = $value["id"];
                         //De esta manera se va a llevar el id de la subcategoría que se esté mostrando
                     $subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

                     foreach($subcategorias as $key => $value1){
                        echo'<h4 style="text-align:center; font-weight:bold;margin-bottom:20px;">'.$value1["subcategoria"].'</h4>';

                        $item1 = "id_subcategoria";
                        $valor1 = $value1["id"];
                        $bar = $rutas[1];
                        $_SESSION["barFiltro"]=$rutas[1];

                        echo '<script>

			    		localStorage.setItem("barFiltro","'.$rutas[1].'");

			    		</script>';

                      $productoSubcategoria = ControladorProductos::ctrMostrarProductosSinBaseYTope($item1, $valor1, $bar);

                       //var_dump($productoSubcategoria);

                       if($productoSubcategoria){

                       	 foreach($productoSubcategoria as $key => $value2){

                        	echo '<div style="margin-bottom:20px" class="row">';	


                        	echo'<div class=" col-xs-3">
                        			<button noProductoDes="'.$value2["id"].'" id="deshabilitarProducto'.$value2["id"].'"  class=" btn btn-default btn-danger deshabilitarProducto pull-right " ><i class="fa fa-times"></i>
					  				</button>
					  			 </div>';

                        	echo'<div class="col-xs-6">
                        			<h5 style="text-align:center; 
                        					font-weight:bold;">'.$value2["id"].'. '.$value2["titulo"].'
                        			</h5>
                        		 </div>';



                        	echo'<div class="col-xs-2">
                        			<button  noProductoHa="'.$value2["id"].'" id="habilitarProducto'.$value2["id"].'"  class="btn btn-default btn-success habilitarProducto " ><i class="fa fa-check"></i>
					  				</button>
					  			</div>';

					  		if($value2["disponible"] == 1){
					  			echo'<script>
					  				document.getElementById("habilitarProducto'.$value2["id"].'").disabled=true;
			  						</script>';
			  				}

			  				if($value2["disponible"] == 0){

			  					echo'<script>
									document.getElementById("deshabilitarProducto'.$value2["id"].'").disabled=true;
					  	
			  						</script>';
			  				}

                        	echo'</div>';

                        		

                        	}


                       }else{

                       		echo'<h5 style="text-align:center; font-weight:bold;">No hay productos en esta sección</h5>';
                       }

                        	


                        echo'<div class="clearfix"></div>

							<hr>';
                     }

			     echo'</div><!--FIN DEL DIV DEL BODY-->
			         </div><!--FIN DEL DIV DEL COLLAPSE-->
			        </div><!--FIN DEL PANEL DEFAULT -->';

			        $i++;
		  		}


		  		echo'</div> <!--Div del id accordion-->';

		}
			?>

			</div>

		 </div>


		  <!--===============================================
			   PESTAÑA DE AGREGAR UN NUEVO PRODUCTO
			===================================================-->
		  <div id="nuevoProducto" class="tab-pane fade ">

			<div class="container">

				<?php

					echo'<div style="margin-top: 20px" class="btn-group">

					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						
						<span style="font-weight:bold; font-size:15px;">Filtrar por bares</span> <span class="caret"></span></button>

					<ul class="dropdown-menu" role="menu">';

				  	$bares = ControladorProductos::ctrVerificarCantidadProductosTabla("almacenes");

						foreach($bares as $key => $value){

		                     echo'<li><a href="'.$url.$rutas[0].'/'.$value["id"].'"><span style="font-weight:bold;">'.$value["bares"].'</span></a></li>';
						}	

					echo'</ul>

					  </div>';

					  if(!isset($rutas[1])){

					  	echo'<div class="col-xs-12 text-center error404">
				               
						     <h1><small>¡Oops!</small></h1>
						    
						     <h2>No ha seleccionado un bar para filtrar</h2>

				   		</div>';


					}else{

				$_SESSION["nuevoProductoBar"] = $rutas[1]; 

				echo'<br><h3 style="text-align:center; 
                        font-weight:bold;">';

                  $nombreBar = ControladorUsuarios::ctrMostrarFilaBarById($rutas[1]);

                  echo $nombreBar["bares"];
                        
               echo'</h3>';

				//onsubmit="return registroProducto()"
				echo'<form method="POST" onsubmit="return registroProducto()" enctype="multipart/form-data"> <!--El enctype es para poder cambiar luego las fotos-->
		    			
				<div class="col-md-3 col-sm-4 col-xs-12 text-center ">
							<br>

					<figure id="imgProducto">';
							
					//echo'<input type="hidden" value="'.$_SESSION.'">';

				/*echo'<img src="'.$servidor.'vistas/img/productos/subirProductos/subirImagen.png" class="img-thumbnail">*/

				echo'</figure>

							<br>

						
					<!--<button type="button" class="btn btn-default" id="btnCambiarFoto">
									
						Subir foto de producto
									
					</button>-->

							

					 <div id="subirImagenProducto">
								
						<input type="file" class="form-control" id="datosImagenProducto" name="datosImagenProducto">

							<img class="previsualizar" src="">

					 </div>

				</div>


				<!--COMIENZO DE LOS CAMPOS DEL FORMULARIO-->
				<div class="col-md-8 col-sm-12 col-xs-12">

					<br>
							
				<label class="control-label text-muted text-uppercase" for="categoria">Categoría:</label>

					<div class="form-group">
						
					<select class="selectpicker form-control" name="categoria" id="categoria">';

					 $item=null;
            		 $valor=null;

					 $categorias = ControladorProductos::ctrMostrarCategorias($item,$valor);
											
					 echo'<option value="">Seleccione una categoría</option>';

						foreach($categorias as $key => $value){

							echo'<option value='.$value["id"].'>'.$value["categoria"].'</option>';
													
						}

					echo'</select>
							
					</div>';

					 echo'<label class="control-label text-muted text-uppercase" for="editarBar">Subcategoría:</label>';

						 echo'<div class="form-group">
						
							  <select class="selectpicker form-control" name="subcategoria" id="subcategoria">';

						echo'</select>
							
							</div>';
							
						echo'<label class="control-label text-muted text-uppercase" for="nombre_producto">Nombre del producto:</label>

							<div class="input-group">
								
									<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
									<input type="text" class="form-control" id="nombre_producto" name="nombre_producto">

								</div>

							<br>

						  <!--<label class="control-label text-muted text-uppercase" for="rutaProducto">Ruta:</label>

							<div class="input-group">
								
									<span class="input-group-addon"><i class="glyphicon glyphicon-pushpin"></i></span>
									<input type="text" class="form-control" id="rutaProducto" name="rutaProducto">

								</div>

							<br>-->

								

							<label class="control-label text-muted text-uppercase" for="codigo_busqueda">Código de búsqueda:</label>

							 <div class="input-group">
								
								<span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
								<input type="text" class="form-control" id="codigo_busqueda" name="codigo_busqueda" value="">

							</div>

								<br>

								<label class="control-label text-muted text-uppercase" for="descripcion">Descripción:</label>

								<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
										<input type="text" class="form-control" id="descripcion" name="descripcion" value="">

									</div>

								<br>

								<label class="control-label text-muted text-uppercase" for="precio">Precio:</label>

								<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-euro"></i></span>
										<input type="number" class="form-control" id="precio" name="precio" value="">

									</div>

								<br>';

					
						 echo'<button style="margin-bottom:10px" type="submit" class="btn btn-success btn-md pull-right" id="agregarProducto">Agregar producto</button>';

						echo'</div>

						<div class="col-md-2 col-sm-0 col-xs-0">

						</div>';

							$insertarProducto = new ControladorProductos();
							$insertarProducto->ctrInsertarProducto();

		    			echo'</form>';

					}

				?>

		    		

		    	</div>
			
		  </div>

		  <!--===============================================
			   PESTAÑA DE EDITAR O ELIMINAR UN PRODUCTO
			===================================================-->
		  <div id="editarEliminarProducto" class="tab-pane fade ">

		  	<div class="container">

		  	<?php

		  	echo'<div style="margin-top: 20px" class="btn-group">

					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						
						<span style="font-weight:bold; font-size:15px;">Filtrar por bares</span> <span class="caret"></span></button>

					<ul class="dropdown-menu" role="menu">';

		  	$bares = ControladorProductos::ctrVerificarCantidadProductosTabla("almacenes");

				foreach($bares as $key => $value){

                     echo'<li><a href="'.$url.$rutas[0].'/'.$value["id"].'"><span style="font-weight:bold;">'.$value["bares"].'</span></a></li>';
				}	

			echo'</ul>

			  </div>';


		if(!isset($rutas[1])){

			echo'<div class="col-xs-12 text-center error404">
				               
				     <h1><small>¡Oops!</small></h1>
				    
				     <h2>No ha seleccionado un bar para filtrar</h2>

				   </div>';


		}else{

			echo'<br><h3 style="text-align:center; 
                        font-weight:bold;">';

                  $nombreBar = ControladorUsuarios::ctrMostrarFilaBarById($rutas[1]);

                  echo $nombreBar["bares"];
                        
               echo'</h3>';

		echo'<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar producto por nombre">

			<div style="overflow-x:auto;">

				<table id="myTable">

				  <tr class="header">
				    <th style="width:10%;">Id</th>
				    <th style="width:10%;">Nombre</th>
				    <th style="width:10%;">Id_Categoria</th>
				    <th style="width:10%;">Id_Subcategoria</th>
				    <th style="width:10%;">Tipo</th>
				    <th style="width:10%;">Ruta</th>
				    <th style="width:10%;">Código_búsqueda</th>
				    <th style="width:60%;">Descripcion</th>
				    <th style="width:10%;">Precio</th>
				    <th style="width:10%;">Imagen</th>
				  </tr>';

		    $item2 = null;
            $valor2 = null;
            $bar2 = $rutas[1];

			$productos = ControladorProductos::ctrMostrarProductosSinBaseYTope($item2, $valor2, $bar2);

			//var_dump($productos);


			foreach($productos as $key => $value3){
			
			echo'<tr>';
					
			echo'<td style="font-size:13px">'.$value3["id"].'</td>';

			if($value3["titulo1"] == ""){
				echo'<td style="font-size:13px">'.$value3["titulo"].'</td>';
			}else{
				echo'<td style="font-size:13px">'.$value3["titulo1"].'</td>';
			}

			
				//echo'<td style="font-size:13px">'.$value3["id_categoria"].'</td>';
				//echo'<td><input  type="text" name="nombre" ></td>';
				//echo'<td style="font-size:13px">'.$value3["id_categoria1"].'</td>';

			echo'<td>';

				echo'<div class="form-group">
						
				  <select class="selectpicker form-control" name="selectCategoriaEdit" id="selectCategoriaEdit">';

					$item="id";

					if($value3["id_categoria1"] == 0){
						
						$valor=$value3["id_categoria"];
					
					}else{

						$valor=$value3["id_categoria1"];
					}

            		 

					  $categorias = ControladorProductos::ctrMostrarCategorias($item,$valor);

                  	    echo'<option value='.$categorias["id"].'>'.$categorias["categoria"].'</option>';

                  	  $categorias2 = ControladorProductos::ctrMostrarCategorias(null,null);
											
						foreach($categorias2 as $key => $value4){

							if($value4["id"] != $categorias["id"]){

								echo'<option value='.$value4["id"].'>'.$value4["categoria"].'</option>';
							}	
						}

				echo'</select>
							
				</div>';

			echo'</td>';

			

			if($value3["id_subcategoria1"] == 0){
				echo'<td style="font-size:13px">'.$value3["id_subcategoria"].'</td>';
			}else{
				echo'<td style="font-size:13px">'.$value3["id_subcategoria1"].'</td>';
			}

			if($value3["tipo1"] == ""){
				echo'<td style="font-size:13px">'.$value3["tipo"].'</td>';
			}else{
				echo'<td style="font-size:13px">'.$value3["tipo1"].'</td>';
			}
			
			if($value3["ruta1"] == ""){
				echo'<td style="font-size:13px">'.$value3["ruta"].'</td>';
			}else{
				echo'<td style="font-size:13px">'.$value3["ruta1"].'</td>';
			}

			if($value3["titular1"] == ""){
				echo'<td style="font-size:13px">'.$value3["titular"].'</td>';
			}else{
				echo'<td style="font-size:13px">'.$value3["titular1"].'</td>';
			}

			if($value3["descripcion1"] == ""){
				echo'<td style="font-size:10.5px">'.$value3["descripcion"].'</td>';
			}else{
				echo'<td style="font-size:10.5px">'.$value3["descripcion1"].'</td>';
			}

			if($value3["precio1"] == 0){
				echo'<td style="font-size:13px">'.$value3["precio"].'</td>';
			}else{
				echo'<td style="font-size:13px">'.$value3["precio1"].'</td>';
			}

			if($value3["portada1"] == ""){
				echo'<td style="font-size:10.5px">'.$value3["portada"].'</td>';
			}else{
				echo'<td style="font-size:10.5px">'.$value3["portada1"].'</td>';
			}	

				echo'</tr>';
			  
			}

			echo'</table>

			</div>';
		}


	?>
		  		
		  	</div>

		  </div>

		  <!--===============================================
			   PESTAÑA DE AGREGAR TODOS LOS PRODUCTOS O ELIMINARLOS TODOS
			===================================================-->
		  <div id="todosLosProductos" class="tab-pane fade ">

			<?php

				$i = 0;

				$bares = ControladorProductos::ctrVerificarCantidadProductosTabla("almacenes");

				foreach($bares as $key => $value){

					$validacionBotonesBares = ControladorProductos::ctrValidacionBotonesBares($value["id"]);

					echo '<div style=" margin-top:20px;" class="row">';	


                      echo'<div class="col-xs-3">
                        <button noBar="'.$value["id"].'" id="eliminarProductos'.$i.'" repeticion="'.$i.'" class="btn btn-default btn-danger eliminarProductos pull-right " ><i class="fa fa-times"></i>
					  	</button>
					  	</div>';

					 if($validacionBotonesBares == null){

					  	echo'<script>
								document.getElementById("eliminarProductos'.$i.'").disabled=true;
			  				</script>';

					  }

                      echo'<div class="col-xs-6">
                        	<h4 style="text-align:center; 
                        		font-weight:bold;">'.$value["id"].'. '.$value["bares"].'
                          </h4>
                         </div>';

                      echo'<div class="col-xs-2">
                        	<button  noBar="'.$value["id"].'" id="agregarProductos'.$i.'" repeticion="'.$i.'" class="btn btn-default btn-success agregarProductos " ><i class="fa fa-check"></i>
					  		</button>
					  	   </div>';

					  if($validacionBotonesBares != null){

					  	echo'<script>
								document.getElementById("agregarProductos'.$i.'").disabled=true;
			  				</script>';

					  }

                    echo'</div>';

                    echo'<div class="clearfix"></div>

						 <hr>';

                    $i++;

				}

			?>


			
		  </div>
		    
		</div>

	 </div>

   </div>



  <!--=============================================================================
  		SCRIPT PARA LA BÚSQUEDA EN TIEMPO REAL DE PRODUCTOS POR NOMBRE CON JQUERY
  =================================================================================-->
  <script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }

  }
}
</script>
		
		

