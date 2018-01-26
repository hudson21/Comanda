<?php

require_once "../controladores/plantilla.controlador.php";
require_once "../modelos/plantilla.modelo.php";

class AjaxPlantilla{

	public function ajaxEstiloPlantilla(){

		$respuesta= ControladorPlantilla::ctrEstiloPlantilla();

		echo json_encode($respuesta);

		/*json_decode me convierte un String en un Array
		  json_encode me convierte un Array en un String*/
	}
}

$objeto = new AjaxPlantilla();
$objeto -> ajaxEstiloPlantilla();