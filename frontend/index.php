<?php


require_once "controladores/plantilla.controlador.php";//Estamos requiriendo una vez la en controlador para la plantilla de php

$plantilla = new ControladorPlantilla();//Digo que la plantilla va a ser instanciada con la clase de ControladorPlantilla
$plantilla -> plantilla(); //Le asigno la función que hay dentro de la clase plantilla
?>