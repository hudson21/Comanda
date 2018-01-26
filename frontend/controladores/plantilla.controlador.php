<?php

class ControladorPlantilla{//Aquí tenemos la clase ControladorPlantilla

	/*-------------------------------------
	LLAMAMOS A LA PLANTILLA
	---------------------------------------*/

	public function plantilla(){//Creamos una función pública para poder hacer uso de esta en otras clases

		include "vistas/plantilla.php"; //Estamos incluyendo la plantilla que creamos en vistas
	}

	/*----------------------------------------------
	  TRAEMOS LOS ESTILOS DINÁMICOS DE LA PLANTILLA (platilla.modelo.php)
	  ----------------------------------------------*/

	  public function ctrEstiloPlantilla(){

	  	$tabla="plantilla";

     /*Llamamos a la clase de ModeloPlantilla y dentro de ella a la función de mdlEstiloPlantilla()*/
	  	$respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla); //Necesitamos el parámetro de la tabla para poder usar esta función

	  	return $respuesta;
	  }
}