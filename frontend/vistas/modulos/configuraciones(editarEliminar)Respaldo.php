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

				  <div class="rTable" id="rTable">
					<div class="rTableHeading">
						<div class="rTableHead"><strong>Id</strong></div>
						<div class="rTableHead"><strong>Nombre</strong></div>
						<div class="rTableHead"><strong>Id_Categoría</strong></div>
						<div class="rTableHead"><strong>Id_Subcategoría</strong></div>
						<div class="rTableHead"><strong>Tipo</strong></div>
						<div class="rTableHead"><strong>Ruta</strong></div>
						<div class="rTableHead"><strong>Código_Búsqueda</strong></div>
						<div class="rTableHead"><strong>Descripción</strong></div>
						<div class="rTableHead"><strong>Precio</strong></div>
						<div class="rTableHead"><strong>Imagen</strong></div>
				 	 </div>';

		    $item2 = null;
            $valor2 = null;
            $bar2 = $rutas[1];

			$productos = ControladorProductos::ctrMostrarProductosSinBaseYTope($item2, $valor2, $bar2);

			//var_dump($productos);


			foreach($productos as $key => $value3){

			echo'<div class="rTableRow">';

				echo'<div class="rTableCell">'.$value3["id"].'</div>';

				if($value3["titulo1"] == ""){
					echo'<div class="rTableCell">'.$value3["titulo"].'</div>';
				}else{
					echo'<div class="rTableCell">'.$value3["titulo1"].'</div>';
				}


					echo'<div class="rTableCell">';

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

				 echo'</div>';


				 if($value3["id_subcategoria1"] == 0){
					echo'<div class="rTableCell">'.$value3["id_subcategoria"].'</div>';
				 }else{
					echo'<div class="rTableCell">'.$value3["id_subcategoria1"].'</div>';
				 }

				 if($value3["tipo1"] == 0){
					echo'<div class="rTableCell">'.$value3["tipo"].'</div>';
				 }else{
					echo'<div class="rTableCell">'.$value3["tipo1"].'</div>';
				 }
				
				 if($value3["ruta1"] == 0){
					echo'<div class="rTableCell">'.$value3["ruta"].'</div>';
				 }else{
					echo'<div class="rTableCell">'.$value3["ruta1"].'</div>';
				 }

				 if($value3["titular1"] == 0){
					echo'<div class="rTableCell">'.$value3["titular"].'</div>';
				 }else{
					echo'<div class="rTableCell">'.$value3["titular1"].'</div>';
				 }

				 if($value3["descripcion1"] == 0){
					echo'<div style="font-size:9px" class="rTableCell">'.$value3["descripcion"].'</div>';
				 }else{
					echo'<div style="font-size:9px" class="rTableCell">'.$value3["descripcion1"].'</div>';
				 }

				 if($value3["precio1"] == 0){
					echo'<div class="rTableCell">'.$value3["precio"].'</div>';
				 }else{
					echo'<div class="rTableCell">'.$value3["precio1"].'</div>';
				 }

				 if($value3["portada1"] == 0){
					echo'<div style="font-size:9px" class="rTableCell">'.$value3["portada"].'</div>';
				 }else{
					echo'<div style="font-size:9px" class="rTableCell">'.$value3["portada1"].'</div>';
				 }

			echo'</div>';
		}

	echo'</div>
	</div>
  </div>';
			
			
}  
	?>