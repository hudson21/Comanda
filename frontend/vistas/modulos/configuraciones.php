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

		</ul>

		<div class="tab-content">

			<!--===============================================
			   PESTAÑA ALTAS Y BAJAS DE PRODUCTOS
			===================================================-->
		  <div id="altasBajas" class="tab-pane fade in active">

		  	<?php

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
                        echo'<h3 style="text-align:center; font-weight:bold;margin-bottom:20px;">'.$value1["subcategoria"].'</h3>';

                        $item1 = "id_subcategoria";
                        $valor1 = $value1["id"];

                        $productoSubcategoria = ControladorProductos::ctrMostrarProductosSinBaseYTope($item1, $valor1);

                        	foreach($productoSubcategoria as $key => $value2){

                        	echo '<div style="margin-bottom:20px" class="row">';	


                        	echo'<div class="col-xs-3">
                        			<button noProducto="'.$value2["id"].'" id="deshabilitarProducto" repeticion="'.$i.'" class="btn btn-default btn-danger deshabilitarProducto pull-right " ><i class="fa fa-times"></i>
					  				</button>
					  			 </div>';

                        	echo'<div class="col-xs-6">
                        			<h5 style="text-align:center; 
                        					font-weight:bold;">'.$value2["id"].'. '.$value2["titulo"].'
                        			</h5>
                        		 </div>';

                        	echo'<div class="col-xs-2">
                        			<button  noProducto="'.$value2["id"].'" id="habilitarProducto" repeticion="'.$i.'" class="btn btn-default btn-success habilitarProducto " ><i class="fa fa-check"></i>
					  				</button>
					  			</div>';

                        	echo'</div>';

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

		  	?>

		 </div>


		  <!--===============================================
			   PESTAÑA DE AGREGAR UN NUEVO PRODUCTO
			===================================================-->
		  <div id="nuevoProducto" class="tab-pane fade ">

			<h2>Nuevo Producto</h2>
			
		  </div>



		    
		</div>

	 </div>

   </div>
		
		

