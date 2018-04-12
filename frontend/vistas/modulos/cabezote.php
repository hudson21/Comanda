<?php

$servidor = Ruta::ctrRutaServidor();

$url = Ruta::ctrRuta();

/*======================================
    INICIO DE SESIÓN USUARIO    
========================================*/
if(isset($_SESSION["validarSesion"])){

  if($_SESSION["validarSesion"] == "ok"){

    echo '<script>

            localStorage.setItem("usuario","'.$_SESSION["id"].'");
            localStorage.setItem("nombreUsuario","'.$_SESSION["nombre"].'");

          </script>';
  }

}

/*

https://getcomposer.org/download/ -->Para descargar e instalar el composer de PHP

https://github.com/google/google-api-php-client  -->Instrucciones para instalar la API de google en nuestra web

*/

/*======================================
    CREAR EL OBJETO DE LA API DE GOOGLE    
========================================*/
$cliente = new Google_Client(); //Estamos instanciando una clase de google que esta dentro de la API
$cliente->setAuthConfig('modelos/client_secret.json');
$cliente->setAccessType('offline');
$cliente->setScopes(['profile','email']);

/*======================================
    RUTA PARA EL LOGIN DE GOOGLE    
========================================*/
$rutaGoogle = $cliente->createAuthUrl();

/*==================================================================
    RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE  
====================================================================*/
if(isset($_GET["code"])){

  $token = $cliente->authenticate($_GET["code"]);

  $_SESSION['id_token_google'] = $token;

  $cliente->setAccessToken($token);

}

/*==================================================================
    RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY 
====================================================================*/

if($cliente->getAccessToken()){

  $item = $cliente->verifyIdToken();

  //var_dump($item["email"]);

  $datos = array();

  $datos = array("nombre"=>$item["name"],
                         "email"=>$item["email"],
                         "foto"=>$item["picture"],
                         "password"=>"null",
                         "modo"=>"google",
                         "verificacion"=>0,
                         "emailEncriptado"=>"null");

  $respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

    echo '<script>

    //setTimeout(function(){

      window.location = localStorage.getItem("rutaActual");

    //},1000);

    </script>'; 

}


?>

<div style="margin-bottom:0px" class="container-fluid barraSuperior" id="top">

	<div class="container">
		

		<div class="row">

			<!--=====================================
				=          SOCIAL            =
			======================================-->
			<div  class="col-lg-7 col-md-7 col-sm-5 col-xs-12 social ">

                <ul>
                    
                    <?php

                    $social = ControladorPlantilla::ctrEstiloPlantilla();

                    echo'<li><a href="'.$url.'configuraciones"><i class="fa fa-wrench"></i>  Configuraciones</a></li>';

                   /* $jsonRedesSociales = json_decode($social["redesSociales"],true);


                   //Estamos haciendo un forEach al JSON 
                    foreach($jsonRedesSociales as $key =>$value){

                     echo '<li>';
                              <a href="'.$value["url"].'" target="_blank">
                               <i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"> </i>
                              </a>    
                      echo'</li>';

                   }*/
                    ?>

                </ul>

			</div>

			<!--=====================================
				=            REGISTRO            =
			======================================-->
			
			<div class="col-lg-4 col-md-5 col-sm-7 col-xs-12 registro pull-right">	

				<ul class="acciones">

          <?php

            if(isset($_SESSION["validarSesion"])){

                if($_SESSION["validarSesion"] == "ok"){

                  if($_SESSION["modo"] == "directo"){ //Si viene en modo directo

                    if($_SESSION["foto"] != ""){

                      echo '<li>

                          <img class="img-circle" src="'.$url.$_SESSION["foto"].'" width="10%">

                         </li>';

                    }else{

                      echo '<li>

                        <img class="img-circle" src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" width="10%">

                      </li>';

                    }

                    echo '<li>|</li>
                     <li><a href="'.$url.'perfil">Ver Perfil</a></li>
                     
                     <li>|</li>
                     <li><a href="'.$url.'pedidos" >Pedidos</a></li>

                     <li>|</li>
                     <li><a href="'.$url.'notificaciones" >Mensajes</a></li>

                     <li>|</li>
                     <li><a href="'.$url.'salir" >Salir</a></li>';

                  } 

                  if($_SESSION["modo"] == "facebook"){

                      echo '<li>

                          <img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">

                         </li>

                         <li>|</li>
                         <li><a href="'.$url.'perfil">Ver Perfil</a></li>
                         
                         <li>|</li>
                         <li><a href="'.$url.'pedidos" >Pedidos</a></li>

                         <li>|</li>
                         <li><a href="'.$url.'notificaciones" >Mensajes</a></li>

                         <li>|</li>
                         <li><a href="'.$url.'salir" class="salir">Salir</a></li>';


                  }//Si viene en modo de facebook o de google

                  if($_SESSION["modo"] == "google"){

                      echo '<li>

                          <img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">

                         </li>

                         <li>|</li>
                         <li><a href="'.$url.'perfil">Ver Perfil</a></li>
                         
                         <li>|</li>
                         <li><a href="'.$url.'pedidos" >Pedidos</a></li>

                         <li>|</li>
                         <li><a href="'.$url.'notificaciones" >Mensajes</a></li>

                         <li>|</li>
                         <li><a href="'.$url.'salir" >Salir</a></li>';

                  }

              }         
            

            }else{

              echo '<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
                    <li>|</li>
                    <li><a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>
                    <li>|</li>
                    <li><a href="'.$url.'pedidos" >Pedidos</a></li>';

            }

          ?>

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
              
              <a href="<?php echo $url; ?>">
              	<img src="<?php echo $servidor.$social["logo"];?>" >
              </a>

			</div>

			<!--=====================================
	            =   CATEGORIAS Y BUSCADOR      =
			======================================-->	
    	 	<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12" >

    	 <!--	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">

    	 			<p>CATEGORIAS

    	 				<span class="pull-right">
    	 					<i class="fa fa-bars" aria-hidden="true"></i>
    	 				</span>
    	 			</p>
    	 			
    	 		</div>-->

    	 		<!--=====================================
	            		=    BUSCADOR      =
			       ======================================-->
			       <div class="input-group col-lg-10 col-md-8 col-sm-8 col-xs-12 backColor" id="buscador">	
                     
                     <input type="search" name="buscar" class="form-control" placeholder="Buscar...">

                     <span class="input-group-btn ">
                     	
                     	<a href="<?php echo $url;?>buscador/1/recientes">
                     
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

			      <a href="<?php echo $url;?>carrito-de-compras">

			      	<button class="btn backColor btn-default pull-left " style="background:#C1CA2C;color:white;">
                        	
                  <i class="fa fa-th-list "></i>

              </button>
			      	
			      </a>
            
            <div style="margin-left:5px" class="cesta">
              
               <p>TU CESTA <span class="cantidadCesta"></span> <br> USD $ <span class="sumaCesta"></span></p>

            </div>


			     

			 </div>

    	 </div>

    	 <!--=====================================
    	    =            CATEGORIAS            =
    	 ======================================-->   
    	 <div class="col-xs-12 backColor" id="categorias">

            <?php

           /* $item=null;
            $valor=null;

                $categorias = ControladorProductos::ctrMostrarCategorias($item,$valor);

                forEach($categorias as $key => $value){

                    echo '<div class=" col-lg-2 col-md-3 col-sm-4 col-xs-12 ">

                             <h4>
                                 <a href="'.$url.$value["ruta"].'" class="pixelCategorias">'.$value["categoria"].'</a>
                             </h4>

                            <hr>

                          <ul>';

                          $item = "id_categoria";

                          $valor = $value["id"];

                         //De esta manera se va a llevar el id de la subcategoría que se esté mostrando
                         $subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

                         foreach($subcategorias as $key => $value){

                             echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias tamañoFuenteSubCategorias">'.$value["subcategoria"].'</a></li>';

                         }

                     echo '</ul>
                
                        </div>';

                       
                }*/

            ?>
    	 	
    	 </div> 	 


    </div>

</header>





<!--===============================================
VENTANA MODAL PARA EL REGISTRO
===================================================-->

<!-- Modal -->
<div style="z-index:10000" class="modal fade modalFormulario" id="modalRegistro"  role="dialog">

  <div class="modal-content modal-dialog ">

      <div class="modal-body modalTitulo">

         <h3 class="backColor">REGISTRARSE</h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <!--===============================================
        REGISTRO FACEBOOK
        ===================================================-->
       <!-- <div class="col-sm-6 col-xs-12 facebook" style="cursor:pointer" id="btnFacebookRegistro">   
            <p>
              <i class="fa fa-facebook"></i>
              Registro con Facebook
            </p>
        </div>-->

        <!--===============================================
        REGISTRO GOOGLE
        ===================================================-->
        <!--<a href="<?php echo $rutaGoogle; ?>">
          <div class="col-sm-6 col-xs-12 google" >   
              <p>
                <i class="fa fa-google"></i>
                Registro con Google
              </p>
          </div>
        </a>-->

        <!--===============================================
        REGISTRO DIRECTO
        ===================================================-->

        <form method="POST"  onsubmit="return registroUsuario()" > <!--    action="formulario.php"    -->

          <!--  <hr> -->

            <!--===============================================
            CAMPO DE NOMBRE
            ===================================================-->

             <div class="form-group">

                <div class="input-group">
                    
                    <span class="input-group-addon">

                        <i class="glyphicon glyphicon-user"></i>

                    </span>

                    <input type="text" class="form-control text-uppercase" id="regUsuario" name="regUsuario" placeholder="Nombre Completo" required>

                </div>
                
             </div>

            <!--===============================================
            CAMPO DE NICKNAME
            ===================================================-->
             <div class="form-group">

                <div class="input-group">
                    
                    <span class="input-group-addon">

                        <i class="glyphicon glyphicon-pencil"></i>

                    </span>

                    <input type="text" class="form-control" id="regNickname" name="regNickname" placeholder="Nombre de Usuario" required>
                </div>
                
             </div>

             <!--===============================================
            CAMPO DE CONTRASEÑA
            ===================================================-->
             <div class="form-group">

                <div class="input-group">
                    
                    <span class="input-group-addon">

                        <i class="glyphicon glyphicon-lock"></i>

                    </span>

                    <input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="Contraseña" required>
                </div>
                
             </div>

            <!--=========================================================================
            https://www.iubenda.com/en     CONDICIONES DE USO Y POLÍTICAS  DE PRIVADIDAD
            =============================================================================-->

            <!--<div class="checkBox">
                
                <label >
                    
                    <input id="regPoliticas" type="checkBox">

                        <small>
                            
                            Al registrarse, usted acepta nuestras condiciones de uso y políticas de privacidad

                            <br>

                            <a  href="//www.iubenda.com/privacy-policy/81720415" class="iubenda-white iubenda-embed" title="Condiciones de uso y Políticas de privacidad">Leer más</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
                           
                        </small>

                </label>

            </div>-->

            <?php

                $registro = new ControladorUsuarios();
                $registro -> ctrRegistroUsuario();

            ?>

            <input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR">
          
        </form>
        
      </div>
      <div class="modal-footer">
        
        ¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>
        <!--Con el href="#modalIngreso estamos abriendo el modal de ingreso de usuarios
            Con el data-dismiss estamos cerrando el modal actual       
            Con el data-toggle modal estamos abriendo el nuevo modal"-->

      </div>
    

  </div>
</div>





<!--===============================================
VENTANA MODAL PARA EL INGRESO
===================================================-->

<!-- Modal -->
<div style="z-index:10000" class="modal fade modalFormulario" id="modalIngreso"  role="dialog">

  <div class="modal-content modal-dialog ">

      <div class="modal-body modalTitulo">

         <h3 class="backColor">INGRESAR</h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <!--===============================================
        INGRESO FACEBOOK
        ===================================================-->
        <!--<div class="col-sm-6 col-xs-12 facebook"  style="cursor:pointer" id="btnFacebookIngreso">   
            <p>
              <i class="fa fa-facebook"></i>
              Ingreso con Facebook
            </p>
        </div>-->

        <!--===============================================
        INGRESO GOOGLE
        ===================================================-->
       <!-- <a href="<?php //echo $rutaGoogle; ?>">
          <div class="col-sm-6 col-xs-12 google" >   
              <p>
                <i class="fa fa-google"></i>
                Ingreso con Google
              </p>
          </div>
       </a>-->

        <!--===============================================
        INGRESO DIRECTO
        ===================================================-->

        <form method="POST"  > <!--    action="formulario.php"    -->

            <!--===============================================
            CAMPO DE CORREO ELECTRÓNICO
            ===================================================-->
             <div class="form-group">

                <div class="input-group">
                    
                    <span class="input-group-addon">

                        <i class="glyphicon glyphicon-pencil"></i>

                    </span>

                    <input type="text" class="form-control" id="ingNickname" name="ingNickname" placeholder="Nombre de Usuario" required>
                </div>
                
             </div>

             <!--===============================================
            CAMPO DE CONTRASEÑA
            ===================================================-->
             <div class="form-group">

                <div class="input-group">
                    
                    <span class="input-group-addon">

                        <i class="glyphicon glyphicon-lock"></i>

                    </span>

                    <input type="password" class="form-control" id="ingPassword" name="ingPassword" placeholder="Contraseña" required>
                </div>
                
             </div>

           

            <?php

                $ingreso = new ControladorUsuarios();
                $ingreso -> ctrIngresoUsuario();

            ?>

            <input type="submit" class="btn btn-default backColor btn-block btnIngreso" value="ENVIAR">

            <br>

            <center> 

                <a href="#modalPassword" data-dismiss="modal" data-toggle="modal">¿Olvidaste tu contraseña?</a>

            </center>          
       
        </form>
        
      </div>
      <div class="modal-footer">
        
        ¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
        <!--Con el href="#modalIngreso estamos abriendo el modal de ingreso de usuarios
            Con el data-dismiss estamos cerrando el modal actual       
            Con el data-toggle modal estamos abriendo el nuevo modal"-->

      </div>
  
  </div>

</div>


<!--===============================================
VENTANA MODAL PARA OLVIDO DE CONTRASEÑA
===================================================-->

<!-- Modal -->
<div style="z-index:10000" class="modal fade modalFormulario" id="modalPassword"  role="dialog">

  <div class="modal-content modal-dialog ">

      <div class="modal-body modalTitulo">

         <h3 class="backColor">SOLICITUD DE NUEVA CONTRASEÑA</h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <!--===============================================
         OLVIDO DE CONTRASEÑA
        ===================================================-->
      
        <form method="POST"  > <!--    action="formulario.php"    -->

           <label class="text-muted" for="passEmail">Escribe el nombre de usuario con el que estás 
            registrado, para verificar que tu cuenta exista y poder reestablecer tu nueva contraseña:</label>

            <!--===============================================
            CAMPO DE NOMBRE DE USUARIO
            ===================================================-->
             <div class="form-group">

                <div class="input-group">
                    
                    <span class="input-group-addon">

                        <i class="glyphicon glyphicon-pencil"></i>

                    </span>

                    <input type="text" class="form-control" id="passNickname" name="passNickname" placeholder="Nombre de Usuario" required>
                </div>
                
             </div>

              <!--===============================================
            CAMPO DE CONTRASEÑA
            ===================================================-->
             <div class="form-group">

                <div class="input-group">
                    
                    <span class="input-group-addon">

                        <i class="glyphicon glyphicon-lock"></i>

                    </span>

                    <input type="password" class="form-control" id="passPassword" name="passPassword" placeholder="Contraseña nueva" required>
                </div>
                
             </div>

            <?php

                $password = new ControladorUsuarios();
                $password -> ctrOlvidoPassword();



            ?>

            <input type="submit" class="btn btn-default backColor btn-block " value="ENVIAR">

        </form>
        
      </div>

      <div class="modal-footer">
        
        ¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
        <!--Con el href="#modalIngreso estamos abriendo el modal de ingreso de usuarios
            Con el data-dismiss estamos cerrando el modal actual       
            Con el data-toggle modal estamos abriendo el nuevo modal"-->

      </div>
  
  </div>

</div>

<?php
include "menudesplegable.php";

?>









