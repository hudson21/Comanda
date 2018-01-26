<?php

require_once "conexion.php";

class ModeloPlantilla{

	static public function mdlEstiloPlantilla($tabla){

  /*Estamos llamando a la clase conexion y dentro de ella a la función de conectar que estan dentro conexion.php*/
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();//La ejecutamos 

		return $stmt -> fetch(); //Y retornamos el valor con un fetch porque es una sola fila, si fueran mas sería con un forEach

		$stmt -> close();//Cerramos la conexión 

	}

}	