<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="title" content="Comanda Electrónica">
	<meta name="description" content="Esta es una página para un proyecto de residencia bla bla bla">
	<meta name="keyword" content="tienda, vinos, licores,etc">




	<?php
	       $icono = ControladorPlantilla::ctrEstiloPlantilla();

	       echo '<link rel="icon" href="http://localhost/Comanda/backend/'.$icono["icono"].'">';


	       /*==============================================
	        MANTENER  LA RUTA FIJA  DEL PROYECTO 
	         ===============================================*/
	         //Esto me sirve para establecer una ruta uniforme en todo el proyecto

	         $url = Ruta::ctrRuta();
	         
	?>
    
     <!--=====================================
     	=            CSS            =
     ======================================-->     
	<link rel="stylesheet" href="<?php echo $url;?>vistas/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" src="<?php echo $url;?>vistas/css/plugins/font-awesome.min.css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plantilla.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/cabezote.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/slide.css">
    
	<!--=====================================
		=            JS            =
	======================================-->
    <script src="<?php echo $url;?>vistas/js/plugins/jquery.min.js"></script>
	<script src="<?php echo $url;?>vistas/js/plugins/bootstrap.min.js"></script>

	

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
      LISTA BLANCA URL'S AMIGABLES    
  ========================================*/

  		if($ruta != null ){

  			include "modulos/productos.php";
  		}else{

  			include "modulos/error404.php";//Que el slide aparezca solamente en la página de inicio

  		}

  		//var_dump($rutas[0]); //Las rutas que están en la posición 0 son las amigables
  }else{

  	  include "modulos/slide.php";
  }
    
?>

<script src="<?php echo $url;?>vistas/js/cabezote.js"></script>
<script src="<?php echo $url;?>vistas/js/plantilla.js"></script>

</body>
</html>