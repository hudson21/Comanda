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

		$stmt = null; //Podemos cerrar la conexión de la BD con mayor seguridad de esta forma

		
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

	  static public function mdlMostrarProductos($tabla, $ordenar, $item, $valor, $base, $tope, $modo){

	  	if($item != null){

	  			$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item = :$item ORDER BY $ordenar $modo LIMIT $base, $tope");

	  			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	  			$stmt-> execute();

				return $stmt -> fetchAll();


	  	}else{

			  	$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla ORDER BY $ordenar $modo LIMIT $base, $tope");

	  			$stmt-> execute();

				return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma
	  }

	  /*==============================================
	  	MOSTRAR PRODUCTOS SIN BASE Y TOPE
	  ===============================================*/
	  static public function mdlMostrarProductosSinBaseYTope($tabla, $item, $valor){

	  	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");

       //EL bindParam me sirve para hacerle la asignación a una variable que esté utilizando
		$stmt -> bindParam(":valor", $valor, PDO::PARAM_INT);

		$stmt-> execute();

		return $stmt -> fetchAll();

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

	/*==============================================
	  	LISTAR PRODUCTOS
	  ===============================================*/

	  static public function mdlListarProductos($tabla, $ordenar, $item, $valor){

	  	if($item != null){

	  		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item ORDER BY $ordenar DESC");

	  		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	  		$stmt-> execute();

	  		return $stmt -> fetchAll();


	  	}else{

	  		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $ordenar DESC");

	  		$stmt-> execute();

	  		return $stmt -> fetchAll();

	  	}

	  	$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma

	  }


	  /*==============================================
	  	MOSTRAR BANNER
	  ===============================================*/

	  static public function mdlMostrarBanner($tabla, $ruta){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ruta = :ruta");

       //EL bindParam me sirve para hacerle la asignación a una variable que esté utilizando
		$stmt -> bindParam(":ruta",$ruta, PDO::PARAM_STR);

		$stmt-> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma
	}

	 /*==============================================
	  	BUSCADOR
	  ===============================================*/

	  static public function mdlBuscarProductos($tabla, $busqueda, $ordenar, $modo, $base, $tope){

	  	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id like '%$busqueda%' OR ruta like '%$busqueda%' OR titulo like '%$busqueda%'OR titular like '%$busqueda%' OR descripcion like '%$busqueda%' ORDER BY $ordenar $modo LIMIT $base, $tope");

	  	$stmt-> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma


	  }

	  /*==============================================
	  	LISTAR PRODUCTOS BUSCADOR
	  ===============================================*/

	  static public function mdlListarProductosBusqueda($tabla, $busqueda){

	  	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id like '%$busqueda%' OR ruta like '%$busqueda%' OR titulo like '%$busqueda%' OR titular like '%$busqueda%' OR descripcion like '%$busqueda%' ");

	  	$stmt-> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma


	  }


	/*==============================================
	  ACTUALIZAR VISTA PRODUCTO
	===============================================*/
	static public function mdlActualizarVistaProducto($tabla, $datos, $item){ //Variable $item en producto.ajax.php

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE ruta = :ruta");

		$stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt -> bindParam(":".$item, $datos["valor"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=========================================================
	  VERIFICAR LA CANTIDAD DE PRODUCTOS EN LA TABLA PRODUCTOS
	===========================================================*/
	static public function mdlVerificarCantidadProductosTabla($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;
	}

	/*=========================================================
	  VALIDACION DE LOS BOTONES DE BARES
	===========================================================*/
	static public function mdlValidacionBotonesBares($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_bar = :id_bar");

		$stmt -> bindParam(":id_bar", $datos, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;
	}

	/*=========================================================
	  AGREGAR PRODUCTOS A LOS BARES
	===========================================================*/
	static public function mdlAgregarProductosBares($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_bar, id_producto, disponible) VALUES (:id_bar, :id_producto, :est)");

		$stmt -> bindParam(":id_bar", $datos["id_barAgregar"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_producto",$datos["id_productoAgregar"], PDO::PARAM_INT);
		$stmt -> bindParam(":est",$datos["estAgregar"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;
	}


	/*=========================================================
	  AGREGAR PRODUCTOS A LOS BARES
	===========================================================*/
	static public function mdlEliminarProductosBares($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_bar = :id_bar");

		$stmt -> bindParam(":id_bar", $datos["id_barEliminar"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;
	}
	
		


}