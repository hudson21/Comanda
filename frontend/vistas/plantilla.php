<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="title" content="Comanda Electrónica">
	<meta name="description" content="Esta es una página para un proyecto de residencia bla bla bla">
	<meta name="keyword" content="tienda, vinos, licores,etc">




	<?php

         $servidor = Ruta::ctrRutaServidor(); 

	       $icono = ControladorPlantilla::ctrEstiloPlantilla();

	       echo '<link rel="icon" href="'.$servidor.$icono["icono"].'">';


	       /*==============================================
	        MANTENER  LA RUTA FIJA  DEL PROYECTO 
	         ===============================================*/
	         //Esto me sirve para establecer una ruta uniforme en todo el proyecto

	         $url = Ruta::ctrRuta();
	         
	?>
    
     <!--=====================================
     	      =  PLUGINS DE CSS  =
     ======================================-->     
	  <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" src="<?php echo $url;?>vistas/css/plugins/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" >
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!--===============================================
     (CSS) HOJAS DE ESTILO PERSONALIZADAS
    ===================================================-->

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plantilla.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/cabezote.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/slide.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/productos.css">

    
	<!--=====================================
	    	=  PLUGINS DE JAVASCRIPT    =
	======================================-->
    <script src="<?php echo $url; ?>vistas/js/plugins/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>  
	  <script src="<?php echo $url; ?>vistas/js/plugins/bootstrap.min.js"></script>
    <script src="<?php echo $url; ?>vistas/js/plugins/jquery.easing.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js" rel="text/javascript"></script>
    <script src="<?php echo $url; ?>vistas/js/plugins/jquery.scrollUp.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<title>Comanda Electrónica</title>
	

</head>
<body>


	<!--Para generar comentarios va a ser con 
  
  				comm-html-section
	-->

	<!--=====================================
	=            Section comment            =
	======================================-->
	
	
	
	<!--====  End of Section comment  ====-->

<?php
  /*=============================================
  		=            CABEZOTE            =
  =============================================*/
  include "modulos/cabezote.php";

  /*======================================
      CONTENIDO DINÁMICO      
  ========================================*/

  $rutas = array();
  $ruta = null;
  $infoProducto=null;

  //De esta manera estamos obteniendo las urls amigables del sitio
  if(isset($_GET["ruta"])){

  		$rutas= explode ("/", $_GET["ruta"]);//El explode es para separar las palabras cada que vea un '/'
  		//A través del parámetro GET obtenemos lo que hay en la url

  		$item="ruta";

  		$valor=$rutas[0];


/*======================================
      URL'S AMIGABLES DE CATEGORÍA      
  ========================================*/
  		$rutaCategorias=ControladorProductos::ctrMostrarCategorias($item,$valor);

  		if($rutas[0]== $rutaCategorias["ruta"]){

  			$ruta = $rutas[0];
  		}

  		//var_dump($rutaCategorias["ruta"]);

  		/*======================================
      URL'S AMIGABLES DE SUBCATEGORÍA      
      ========================================*/
  $rutaSubCategorias=ControladorProductos::ctrMostrarSubCategorias($item,$valor);

  foreach($rutaSubCategorias as $key =>$value){

  	if($rutas[0]== $value["ruta"]){

  			$ruta = $rutas[0];
  		}

  }

    /*======================================
      URL'S AMIGABLES DE PRODUCTOS      
      ========================================*/

      $rutaProductos = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

      if($rutas[0]== $rutaProductos["ruta"]){

        $infoProducto = $rutas[0];
      }


  /*======================================
      LISTA BLANCA URL'S AMIGABLES    
  ========================================*/

  		if($ruta != null || $rutas[0] == "articulos-con-descuento" || $rutas[0] == "lo-mas-vendido" || $rutas[0] == "lo-mas-visto"){

  			include "modulos/productos.php";
  		
      }else if($infoProducto != null){

        include "modulos/infoproducto.php";

      }

      else{

  			include "modulos/error404.php";//Que el slide aparezca solamente en la página de inicio

  		}

  		//var_dump($rutas[0]); //Las rutas que están en la posición 0 son las amigables
  }else{

  	  include "modulos/slide.php";

      include "modulos/destacados.php";
  }
    
?>

<!--===============================================
     (JS) JAVASCRIPT PERSONALIZADAS
===================================================-->

<script src="<?php echo $url;?>vistas/js/cabezote.js"></script>
<script src="<?php echo $url;?>vistas/js/plantilla.js"></script>
<script src="<?php echo $url;?>vistas/js/slide.js"></script>

</body>
</html>