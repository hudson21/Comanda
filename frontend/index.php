<?php


require_once "controladores/plantilla.controlador.php";//Estamos requiriendo una vez la en controlador para la plantilla de php
require_once "controladores/productos.controlador.php";
require_once "controladores/slide.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/carrito.controlador.php";


require_once "modelos/plantilla.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/slide.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/carrito.modelo.php";


require_once "modelos/rutas.php";

//require_once "extensiones/PHPMailer/PHPMailerAutoload.php";//Esto es para poder utilizar la opción de PHPMailer en nuestor proyecto
//require_once "extensiones/vendor/autoload.php";
require_once "vistas/modulos/ticket/autoload.php";


$plantilla = new ControladorPlantilla();//Digo que la plantilla va a ser instanciada con la clase de ControladorPlantilla
$plantilla -> plantilla(); //Le asigno la función que hay dentro de la clase plantilla
?>