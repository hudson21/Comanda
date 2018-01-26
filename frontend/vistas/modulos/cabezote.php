<!--=====================================
=            TOP            =
======================================-->

 <!--=====================================
     	=            CSS            =
     ======================================-->     
	<link rel="stylesheet" href="vistas/css/plugins/bootstrap.min.css">
	<link rel="stylesheet" href="vistas/css/plugins/font-awesome.css">

	<!--=====================================
		=            JS            =
	======================================-->
	<script src="vistas/js/plugins/bootstrap.min.js"></script>
	<script src="vistas/js/plugins/jquery.min.js"></script>

<div class="container-fluid barraSuperior" id="top">

	<div class="container">
		

		<div class="row">

			<!--=====================================
				=          SOCIAL            =
			======================================-->
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">

                <ul>

                    <?php

                    $social = ControladorPlantilla::ctrEstiloPlantilla();

                    $jsonRedesSociales = json_decode($social["redesSociales"],true);


                   //Estamos haciendo un forEach al JSON 
                    foreach($jsonRedesSociales as $key =>$value){

                     echo '<li>
                              <a href="'.$value["url"].'" target="_blank">
                               <i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"> </i>
                              </a>    
                          </li>';

                   }
                    ?>

                </ul>

			</div>

			<!--=====================================
				=            REGISTRO            =
			======================================-->
			
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">	

				<ul>
					<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
					<li></li>
					<li><a href="modalRegistro" data-toggle="modal">Crear una cuenta</a></li>
				</ul>


			</div>
			
			
			
		</div>
	</div>
	
</div>

<!--=====================================
	=            HEADER            =
======================================-->

<header class="container-fluid">
	
    <div class="container">

    	 <div class="row" id="cabezote">

    	 	<!--=====================================
				=            LOGOTIPO            =
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
              
              <a href="">
              	<img src="http://localhost/Comanda/backend/<?php echo $social["logo"];?>" >
              </a>

			</div>

			<!--=====================================
	            =   CATEGORIAS Y BUSCADOR      =
			======================================-->	
    	 	<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" >

    	 		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">

    	 			<p>CATEGORIAS

    	 				<span class="pull-right">
    	 					<i class="fa fa-bars" aria-hidden="true"></i>
    	 				</span>
    	 			</p>
    	 			
    	 		</div>

    	 		<!--=====================================
	            		=    BUSCADOR      =
			       ======================================-->
			       <div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12 backColor" id="buscador">	
                     
                     <input type="search" name="buscar" class="form-control" placeholder="Buscar...">

                     <span class="input-group-btn ">
                     	
                     	<a href="">
                     
                        <button class="btn btn-default backColor" type="submit" style="background:#C1CA2C;color:white;">
                        	
                        	<i class="fa fa-search"></i>

                        </button>	

                     	</a>

                     </span>

			       </div>
                  
    	 	</div>

    	 	 <!--=====================================
	            		=    CARRITO DE COMPRAS     =
			  ======================================-->
			 <div class="input-group col-lg-3 col-md-3 col-sm-2 col-xs-12 " id="carrito">

			      <a href="#">

			      	<button class="btn backColor btn-default pull-left " style="background:#C1CA2C;color:white;">
                        	
                        	<i class="fa fa-shopping-cart "></i>

                        </button>
			      	
			      </a>

			      <p>TU CESTA <span class="cantidadCesta"></span> <br> USD $ <span class="sumaCesta"></span></p>

			 </div>

    	 </div>

    	 <!--=====================================
    	    =            CATEGORIAS            =
    	 ======================================-->   
    	 <div class="col-xs-12 backColor" id="categorias">

            <?php

                $categorias = ControladorProductos::ctrMostrarCategorias();

                forEach($categorias as $key => $value){

                    echo '<div class=" col-lg-2 col-md-3 col-sm-4 col-xs-12 ">

                             <h4>
                                 <a href="#" class="pixelCategorias">'.$value["categoria"].'</a>
                             </h4>

                            <hr>

                          <ul>';

                         //De esta manera se va a llevar el id de la subcategoría que se esté mostrando
                         $subcategorias = ControladorProductos::ctrMostrarSubCategorias($value["id"]);

                         foreach($subcategorias as $key => $value){

                             echo '<li><a href="#" class="pixelSubCategorias tamañoFuenteSubCategorias">'.$value["subcategoria"].'</a></li>';

                         }

                     echo '</ul>
                
                        </div>';

                       
                }

            ?>
    	 	
    	 </div> 	 


    </div>

</header>



