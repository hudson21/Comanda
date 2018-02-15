<?php


require_once "controladores/plantilla.controlador.php";//Estamos requiriendo una vez la en controlador para la plantilla de php
require_once "controladores/productos.controlador.php";
require_once "controladores/slide.controlador.php";
require_once "controladores/usuarios.controlador.php";


require_once "modelos/plantilla.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/slide.modelo.php";
require_once "modelos/usuarios.modelo.php";


require_once "modelos/rutas.php";


$plantilla = new ControladorPlantilla();//Digo que la plantilla va a ser instanciada con la clase de ControladorPlantilla
$plantilla -> plantilla(); //Le asigno la función que hay dentro de la clase plantilla
?>