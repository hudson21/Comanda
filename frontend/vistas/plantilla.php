<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<meta name="title" content="Comanda Electrónica">

	<meta name="description" content="Esta es una página para un proyecto de residencia bla bla bla">

	<meta name="keyword" content="tienda, vinos, licores,etc">

  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <title>Comanda Electrónica</title>

	<?php

         $servidor = Ruta::ctrRutaServidor(); 

	       $icono = ControladorPlantilla::ctrEstiloPlantilla();

	       echo '<link rel="icon" href="'.$servidor.$icono["icono"].'">';


	       /*==============================================
	        MANTENER  LA RUTA FIJA  DEL PROYECTO 
	         ===============================================*/
	         //Esto me sirve para establecer una ruta uniforme en todo el proyecto

	         $url = Ruta::ctrRuta();

	        // require $_SERVER['DOCUMENT_ROOT'].'/comanda/frontend/vistas/css/plugins/bootstrap.min.css';
	?>
    
     <!--=====================================
     	      =  PLUGINS DE CSS  =
     ======================================-->     
	  
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plugins/bootstrap.min.css">

     <link rel="stylesheet" href="<?php echo $url;?>vistas/css/font-awesome.css">
  
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plugins/flexslider.css">

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plugins/sweetalert.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" >

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" >

    <link href="https://fonts.googleapis.com/css?family=Mukta+Vaani" rel="stylesheet">

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >-->
  

    <!--===============================================
     (CSS) HOJAS DE ESTILO PERSONALIZADAS
    ===================================================-->

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plantilla.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/cabezote.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/slide.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/productos.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/infoproducto.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/perfil.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/carrito-de-compras.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/fonts.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/pedidos.css">
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/notificaciones.css">

    

    
	<!--=====================================
	    	=  PLUGINS DE JAVASCRIPT    =
	======================================-->
   <script src="<?php echo $url;?>vistas/js/plugins/jquery.min.js"></script>

   <script src="<?php echo $url;?>vistas/js/plugins/bootstrap.min.js"></script>

   <script src="<?php echo $url;?>vistas/js/plugins/jquery.easing.js"></script>

   <script src="<?php echo $url;?>vistas/js/plugins/jquery.scrollUp.js"></script>

   <script src="<?php echo $url;?>vistas/js/plugins/jquery.flexslider.js"></script>

   <script src="<?php echo $url;?>vistas/js/plugins/sweetalert.min.js"></script>

   <script src="<?php echo $url;?>vistas/js/plugins/push.min.js"></script>

   

   

     
</head>




<body > 
	<!--=====================================
	=            Section comment            =
	======================================-->
	
	
	
	<!--====  End of Section comment  ====-->

<?php

  /*=============================================
  		=            CABEZOTE            =
  =============================================*/
  include "modulos/cabezote.php";

  /*=============================================
      =        MENU DESPLEGABLE          =
  =============================================*/
  //include "modulos/menudesplegable.php";

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

      }else if($rutas[0] == "buscador" ||  $rutas[0] == "verificar" ||  $rutas[0] == "salir" ||  $rutas[0] == "perfil" 
        ||  $rutas[0] == "carrito-de-compras" ||  $rutas[0] == "pedidos" || $rutas[0]== "notificaciones" || $rutas[0]== "configuraciones"){

        include "modulos/".$rutas[0].".php";
      
      }

      else{

  			include "modulos/error404.php";//Que el slide aparezca solamente en la página de inicio

  		}

  		//var_dump($rutas[0]); //Las rutas que están en la posición 0 son las amigables
  }else{

  	// include "modulos/slide.php";

     include "modulos/destacados.php";
  }

  /*======================================================================================
                  AUTOREINICIAR LOS ID DE LAS TABLAS CUANDO ESTÉN VACÍOS
  ========================================================================================*/

  /*======================================
           TABLA BANNER  
  ========================================*/
  $tabla = "banner";

  $tablaBanner = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla);

  if($tablaBanner == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla);
  }

  /*======================================
           TABLA CATEGORIAS  
  ========================================*/
  $tabla1 = "categorias";

  $tablaCategorias = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla1);

  if($tablaCategorias == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla1);
  }


  /*======================================
           TABLA PLANTILLA   
  ========================================*/
  $tabla7 = "plantilla";

  $tablaPlantilla = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla7);

  if($tablaPlantilla == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla7);
  }

  /*======================================
           TABLA PRODUCTOS  
  ========================================*/
  $tabla8 = "productos";

  $tablaProductos = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla8);

  if($tablaProductos == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla8);
  }

  /*======================================
           TABLA SLIDE 
  ========================================*/
  $tabla9 = "slide";

  $tablaSlide = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla9);

  if($tablaSlide == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla9);
  }

   /*======================================
           TABLA SUBCATEGORIAS
  ========================================*/
  $tabla10 = "subcategorias";

  $tablaSubcategorias = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla10);

  if($tablaSubcategorias == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla10);
  }

  /*======================================
           TABLA USUARIOS  
  ========================================*/
  $tabla11 = "usuarios";

  $tablaUsuarios = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla11);

  if($tablaUsuarios == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla11);
  }

    /*======================================
           TABLA CABECERA PEDIDOS   
  ========================================*/
  $tabla6 = "cabecera_pedidos";

  $tablaCabeceraPedidos = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla6);

  if($tablaCabeceraPedidos == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla6);
     $columna="no_pedido";
    // ControladorUsuarios::ctrPonerCerosIzquierda($tabla6, $columna);
  }

  /*======================================
           TABLA LINEA DE PEDIDOS   
  ========================================*/
  $tabla12 = "linea_pedidos";

  $tablaLineaPedidos = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla12);

  if($tablaLineaPedidos == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla12);
    // ControladorUsuarios::ctrPonerCerosIzquierda($tabla12, $columna);
  }

  /*======================================
           TABLA LINEA DE NOTIFICACIONES  
  ========================================*/
  $tabla13 = "notificaciones";

  $tablaNotificaciones = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla13);

  if($tablaNotificaciones == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla13);
    // ControladorUsuarios::ctrPonerCerosIzquierda($tabla12, $columna);
  }


  /*======================================
           TABLA PRODUCTOS_ALMACEN  
  ========================================*/
  $tabla14 = "productos_almacen";

  $tablaProductosAlmacen = ControladorUsuarios::ctrMostrarRegistrosTablas($tabla14);

  if($tablaProductosAlmacen == null){

     ControladorUsuarios::ctrAutoreiniciarValoresIdTablas($tabla14);
    // ControladorUsuarios::ctrPonerCerosIzquierda($tabla12, $columna);
  }


 
        if(isset($_SESSION["validarSesion"])){

          $item = $_SESSION["id"];

          $cabeceraPedidos = ControladorUsuarios::ctrMostrarCabeceraPedidosByUsuario($item);

          foreach($cabeceraPedidos as $key => $value1){

            if($value1["estado"]==2 && $value1["id_usuario"] == $_SESSION["id"] && $value1["mensaje_confirmacion"]==0){

                echo '<script>

                 //localStorage.setItem("pushPedidos","'.$value1["no_pedido"].'");

                Push.create("Pedido Listo", {
                     body: "El pedido '.$value1["no_pedido"].' se encuentra listo",
                     onClick: function(){

                        window.location = rutaOculta+"notificaciones";
                        this.close();
                      }
                  });
              </script>';

              $tablaModelo = "cabecera_pedidos";
              $item1 = "mensaje_confirmacion";
              $item2 = "no_pedido";

              $datos = array("no_pedido"=>$value1["no_pedido"],
                             "mensaje_confirmacion"=>1);

              ControladorUsuarios::ctrNoMostrarNotificacionesPush($datos, $tablaModelo, $item1, $item2);

              }
             
            }

         }
    
?>

<input type="hidden" value="<?php echo $url;?>" id="rutaOculta">

<!--===============================================
     (JS) JAVASCRIPT PERSONALIZADAS
===================================================-->

<script src="<?php echo $url;?>vistas/js/cabezote.js"></script>
<script src="<?php echo $url;?>vistas/js/plantilla.js"></script>
<script src="<?php echo $url;?>vistas/js/slide.js"></script>
<script src="<?php echo $url;?>vistas/js/buscador.js"></script>
<script src="<?php echo $url;?>vistas/js/infoproducto.js"></script>
<script src="<?php echo $url;?>vistas/js/usuarios.js"></script>
<script src="<?php echo $url;?>vistas/js/registroFacebook.js"></script>
<script src="<?php echo $url;?>vistas/js/carrito-de-compras.js"></script>
<script src="<?php echo $url;?>vistas/js/menu.js"></script>

</body>
</html>