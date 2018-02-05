<?php

require_once "conexion.php";

class ModeloProductos{
    

      /*==============================================
        MOSTRAR CATEGORIAS
        ===============================================*/

	//El método debe de ser estático porque traemos parámetros
	static public function mdlMostrarCategorias($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");

			//EL bindParam me sirve para hacerle la asignación a una variable que esté utilizando
			$stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

			$stmt-> execute();

			return $stmt -> fetch();	

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt-> execute();

			return $stmt -> fetchAll();	

		}

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma

		
	}


	/*==============================================
	  	MOSTRAR SUBCATEGORÍA
	  ===============================================*/

	  static public function mdlMostrarSubCategorias($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

       //EL bindParam me sirve para hacerle la asignación a una variable que esté utilizando
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt-> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma
	}

	/*==============================================
	  	MOSTRAR PRODUCTOS
	  ===============================================*/

	  static public function mdlMostrarProductos($tabla, $ordenar, $item, $valor){

	  	if($item != null){

	  			$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item = :$item ORDER BY $ordenar DESC LIMIT 4");

	  			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	  			$stmt-> execute();

				return $stmt -> fetchAll();


	  	}else{

			  	$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla ORDER BY $ordenar DESC LIMIT 4");

	  			$stmt-> execute();

				return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma
	  }

	  /*==============================================
	  	MOSTRAR INFO PRODUCTO
	  ===============================================*/

	  static public function mdlMostrarInfoProducto($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

       //EL bindParam me sirve para hacerle la asignación a una variable que esté utilizando
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt-> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma
	}
}