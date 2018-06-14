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
	  	MOSTRAR SUBCATEGORÍA COMPLETAS
	  ===============================================*/

	  static public function mdlMostrarSubCategoriasByIdCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_categoria = $datos");

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

	  			$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item = :$item ORDER BY titulo $modo LIMIT $base, $tope");

	  			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	  			$stmt-> execute();

				return $stmt -> fetchAll();


	  	}else{

			  	$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla ORDER BY titulo $modo LIMIT $base, $tope");

	  			$stmt-> execute();

				return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma
	  }

	  /*==============================================
	  	 MOSTRAR PRODUCTOS POR BAR Y DISPONIBILIDAD
	  ===============================================*/
	  static public function mdlMostrarProductosPorBar($bar, $base, $tope, $item, $valor){

	  	if($item != null){

	  		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos inner join productos_almacen on productos.id = productos_almacen.id_producto WHERE productos_almacen.disponible = 1 and id_bar = $bar and productos.$item = :$item ORDER BY titulo LIMIT $base, $tope");

	  		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	  		$stmt-> execute();

			return $stmt -> fetchAll();

	  	}else{

	  		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos inner join productos_almacen on productos.id = productos_almacen.id_producto WHERE productos_almacen.disponible = 1 and id_bar = $bar ORDER BY titulo LIMIT $base, $tope");

	  		$stmt-> execute();

			return $stmt -> fetchAll();
	  	}
		
		

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma
	  }

	  /*==============================================
	  	MOSTRAR PRODUCTOS SIN BASE Y TOPE
	  ===============================================*/
	  static public function mdlMostrarProductosSinBaseYTope($item, $valor, $bar){

	  	/*$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE $item = :valor");*/

	  	if($item == null and $valor == null){

	  		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos inner join productos_almacen on productos.id = productos_almacen.id_producto WHERE  id_bar = :id_bar");
	  		$stmt -> bindParam(":id_bar", $bar, PDO::PARAM_INT);
	  	
	  	}else{

	  		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos inner join productos_almacen on productos.id = productos_almacen.id_producto WHERE $item = :valor and id_bar = :id_bar");

       		//EL bindParam me sirve para hacerle la asignación a una variable que esté utilizando
			$stmt -> bindParam(":valor", $valor, PDO::PARAM_INT);
			$stmt -> bindParam(":id_bar", $bar, PDO::PARAM_INT);
	  	}

	  	

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
	  	MOSTRAR INFO PRODUCTO JOIN
	  ===============================================*/

	  static public function mdlMostrarInfoProductoJoin( $item,$valor, $bar){

	  	$stmt = Conexion::conectar()->prepare("SELECT * FROM productos inner join productos_almacen on productos.id = productos_almacen.id_producto WHERE productos_almacen.disponible = 1 and $item = :$item  and productos_almacen.id_bar = $bar");

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
	  		LISTAR PRODUCTOS EN PRODUCTOS_ALMACEN
		===============================================*/
	   static public function mdlListarProductosJoinProductosAlmacen($numeroProducto, $bar){

	   	$stmt = Conexion::conectar()->prepare("SELECT * FROM productos inner join productos_almacen on productos.id = productos_almacen.id_producto WHERE productos_almacen.disponible = 1 and productos_almacen.id_bar = $bar and productos_almacen.id_producto = $numeroProducto");

	  	/*$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = $id_producto and id_bar = $bar");*/

	  	$stmt-> execute();

	  	return $stmt -> fetch();

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

	  	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id like '%$busqueda%' OR titulo like '%$busqueda%' OR titular like '%$busqueda%' ORDER BY $ordenar $modo LIMIT $base, $tope");

	  	$stmt-> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma


	  }

	  /*==============================================
	  	LISTAR PRODUCTOS BUSCADOR
	  ===============================================*/

	  static public function mdlListarProductosBusqueda($tabla, $busqueda){

	  	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id like '%$busqueda%' OR titulo like '%$busqueda%' OR titular like '%$busqueda%' ");

	  	$stmt-> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma


	  }

	  /*==============================================
	  	BUSCADOR POR BAR EN TABLA PRODUCTOS_ALMACEN
	  ===============================================*/

	  static public function mdlBuscarProductosPorBar( $busqueda, $ordenar, $modo, $base, $tope, $bar){

	  	$stmt = Conexion::conectar()->prepare("SELECT * FROM productos inner join productos_almacen on productos.id = productos_almacen.id_producto WHERE (productos_almacen.disponible = 1 and productos_almacen.id_bar = $bar) and (id like '%$busqueda%' OR titulo like '%$busqueda%' OR ruta like '%$busqueda%' OR ruta1 like '%$busqueda%' OR titulo1 like '%$busqueda%'  OR titular like '%$busqueda%' OR titular1 like '%$busqueda%') ORDER BY $ordenar $modo LIMIT $base, $tope");


	  /*$stmt = Conexion::conectar()->prepare("SELECT * FROM productos inner join productos_almacen on productos.id = productos_almacen.id_producto WHERE productos_almacen.disponible = 1 and productos_almacen.id_bar = $bar and id like '%$busqueda%' OR ruta like '%$busqueda%' OR productos_almacen.titulo1 like '%$busqueda%' OR productos_almacen.titular1 like '%$busqueda%'OR titular like '%$busqueda%' OR productos_almacen.descripcion1 like '%$busqueda%' OR descripcion like '%$busqueda%' ORDER BY $ordenar $modo LIMIT $base, $tope");*/

	  	$stmt-> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma


	  }

	  /*==============================================
	  	BUSCADOR POR BAR EN TABLA PRODUCTOS_ALMACEN
	  ===============================================*/

	  static public function mdlListarProductosBusquedaPorBar( $busqueda, $bar){

	  	$stmt = Conexion::conectar()->prepare("SELECT * FROM productos inner join productos_almacen on productos.id = productos_almacen.id_producto WHERE (productos_almacen.disponible = 1 and productos_almacen.id_bar = $bar) and (id like '%$busqueda%' OR titulo like '%$busqueda%' OR ruta like '%$busqueda%' OR ruta1 like '%$busqueda%' OR titulo1 like '%$busqueda%'  OR titular like '%$busqueda%' OR titular1 like '%$busqueda%')");


	  	/*$stmt = Conexion::conectar()->prepare("SELECT * FROM productos inner join productos_almacen on productos.id = productos_almacen.id_producto WHERE productos_almacen.disponible = 1 and productos_almacen.id_bar = $bar or id like '%$busqueda%' OR ruta like '%$busqueda%' OR productos_almacen.titulo1 like '%$busqueda%' OR titulo like '%$busqueda%'OR productos_almacen.titular1 like '%$busqueda%'OR titular like '%$busqueda%' OR productos_almacen.descripcion1 like '%$busqueda%' OR descripcion like '%$busqueda%'");*/

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

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_bar, id_producto, disponible) SELECT :id_bar,id,:est FROM productos ");

		$stmt -> bindParam(":id_bar", $datos["id_barAgregar"], PDO::PARAM_INT);
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


	/*=========================================================
	  AGREGAR UN PRODUCTO A LA TABLA DE PRODUCTOS
	===========================================================*/
	static public function mdlInsertarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, id_categoria, id_subcategoria, ruta, titulo, titular, descripcion)
			VALUES (:id, :id_categoria, :id_subcategoria, :ruta, :titulo, :titular, :descripcion)");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_categoria", $datos["categoria"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_subcategoria", $datos["subcategoria"], PDO::PARAM_INT);
		$stmt -> bindParam(":ruta", $datos["rutaProducto"], PDO::PARAM_STR);
		$stmt -> bindParam(":titulo", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt -> bindParam(":titular", $datos["codigo_busqueda"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;
	}

	static public function mldContrarProductos(){

		$stmt = Conexion::conectar()->prepare("SELECT * from productos");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;
	}

	static public function mdlInsertarProductosAlmacen($id_producto, $id_bar){

		$stmt = Conexion::conectar()->prepare("INSERT INTO productos_almacen(id_bar, id_producto, disponible)
			VALUES (:id_bar, :id_producto, 1)");

		$stmt -> bindParam(":id_bar", $id_bar, PDO::PARAM_INT);
		$stmt -> bindParam(":id_producto", $id_producto, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;
	}


	static public function mdlMostrarNotificacionesPushByUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = 2 and id_usuario = $datos and mensaje_confirmacion = 0");

		$stmt-> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null; 
	}

	static public function mdlEliminarProductoEspecificoByIdAndBar($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_bar = :id_bar and id_producto = :id_producto");

		$stmt -> bindParam(":id_bar", $datos["noBarEliminar"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_producto", $datos["noProductoEliminar"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;
	}


	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/
	static public function mdlActualizarProducto($tabla, $datos){

		$rutaReplaceÑ = str_replace("ñ", "n", $datos["nombreActualizar"]);
		$rutaReplaceÑ = str_replace("Ñ", "n", $datos["nombreActualizar"]);
		$rutaReplaceÑ = str_replace("ñ", "N", $datos["nombreActualizar"]);
		$rutaReplaceÑ = str_replace("Ñ", "N", $datos["nombreActualizar"]);
		$result = str_replace(" ", "-", $rutaReplaceÑ);

	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ruta1 = :ruta1, titulo1 = :titulo1, titular1 = :titular1, descripcion1 = :descripcion1  WHERE id_producto = :id_producto and id_bar = :id_bar");

		$stmt -> bindParam(":ruta1", $result, PDO::PARAM_STR);
		$stmt -> bindParam(":titulo1", $datos["nombreActualizar"], PDO::PARAM_STR);
		$stmt -> bindParam(":titular1", $datos["codigoActualizar"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion1", $datos["descripcionActualizar"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_producto", $datos["noProductoActualizar"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_bar", $datos["noBarActualizar"], PDO::PARAM_INT);
		
	
		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*===============================================
		MOSTRAR LUGARES DE PREPARACION       
	=================================================*/
	static public function mdlMostrarLugaresPreparacion(){

	  	$stmt = Conexion::conectar()->prepare("SELECT * FROM almacenes");

	  	$stmt-> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma
	  }

	/*===============================================
		MOSTRAR LUGARES DE ORIGEN       
	=================================================*/
	static public function mdlMostrarLugaresOrigen(){

	  	$stmt = Conexion::conectar()->prepare("SELECT * FROM origenes");

	  	$stmt-> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null; //Podemos cerrar la conexión de la BD ´con mayor seguridad de esta forma
	  }


}