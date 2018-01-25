<?php

class ControladorPlantilla{//Aquí tenemos la clase ControladorPlantilla

	/*-------------------------------------
	LLAMAMOS A LA PLANTILLA
	---------------------------------------*/

	public function plantilla(){//Creamos una función pública para poder hacer uso de esta en otras clases

		include "vistas/plantilla.php"; //Estamos incluyendo la plantilla que creamos en vistas
	}

	/*----------------------------------------------
	  TRAEMOS LOS ESTILOS DINÁMICOS DE LA PLANTILLA
	  ----------------------------------------------*/

	  public function ctrEstiloPlantillaI(){

	  	$tabla = "plantilla";

	  	$respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla);
	  }
}