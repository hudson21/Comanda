<?php

require_once "conexion.php";


class ModeloUsuarios{

	/*======================================
	  REGISTRO DE USUARIO        
	========================================*/
	static public function mdlRegistroUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, password, email, foto, modo, verificacion,emailEncriptado)
			VALUES (:nombre, :password, :email, :foto, :modo, :verificacion, :emailEncriptado)");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
		$stmt -> bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_INT);
		$stmt -> bindParam(":emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function mdlMostrarUsuario($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $id, $item, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PERFIL
	=============================================*/
	static public function mdlActualizarPerfil($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, password = :password, foto = :foto WHERE id = :id");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR COMPRAS
	=============================================*/
	static public function mdlMostrarCompras($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/*==========================================================
     MOSTRAR COMENTARIOS EN PERFIL       
  	============================================================*/
  	static public function mdlMostrarComentariosPerfil($tabla, $datos){

  		if($datos["idUsuario"] != ""){

  			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario AND id_producto = :id_producto");

			$stmt -> bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
			$stmt -> bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

  		}else{

  			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = :id_producto ORDER BY Rand()");

			$stmt -> bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();
  		}

		

		$stmt-> close();

		$stmt = null;

	}

	/*==========================================================
     ACTUALIZAR COMENTARIOS EN PERFIL       
  	============================================================*/
  	static public function mdlActualizarComentario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET calificacion = :calificacion, comentario = :comentario WHERE id = :id");

		$stmt->bindParam(":calificacion", $datos["calificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*===============================================
		AGREGAR A LISTA DE DESEOS       
	=================================================*/
	static public function mdlAgregarDeseo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, id_producto) VALUES (:id_usuario, :id_producto)");

		$stmt -> bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;


	}

	/*===============================================
		MOSTRAR A LISTA DE DESEOS       
	=================================================*/
	static public function mdlMostrarDeseos($tabla, $item){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla  WHERE id_usuario = :id_usuario ORDER BY id DESC");

		$stmt -> bindParam(":id_usuario", $item, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}


	/*===============================================
		QUITAR PRODUCTO DE LISTA DE DESEOS       
	=================================================*/
	static public function mdlQuitarDeseo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}


	/*===============================================
		ELIMINAR USUARIO       
	=================================================*/
	static public function mdlEliminarUsuario($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}


	/*===============================================
		ELIMINAR COMENTARIOS DE USUARIO       
	=================================================*/
	static public function mdlEliminarComentarios($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":id_usuario", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}


	/*===============================================
		ELIMINAR COMPRAS DE USUARIO       
	=================================================*/
	static public function mdlEliminarCompras($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":id_usuario", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}


	/*===============================================
		ELIMINAR LISTA DE DESEOS DE USUARIO       
	=================================================*/
	static public function mdlEliminarListaDeseos($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":id_usuario", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*============================================================================================================  
  		INSERTAR LOS REGISTROS EN LA TABLA DE LINEA PEDIDOS LOS PRODUCTOS YA CONFIRMADOS    
	==============================================================================================================*/
	static public function mdlInsertarLineaPedidos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_producto, cantidad, no_pedido) VALUES (:id_producto, :cantidad, :no_pedido)");

		$stmt -> bindParam(":id_producto", $datos["idProductoPedidos"], PDO::PARAM_INT);
		$stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":no_pedido", $datos["numeroPedido"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "Inserción de la línea de pedidos correcta";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*============================================================================================================  
  		INSERTAR LOS REGISTROS EN LA TABLA DE CABECERA PEDIDOS LOS PRODUCTOS YA CONFIRMADOS   
	==============================================================================================================*/
	static public function mdlInsertarCabeceraPedido($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, nombre_usuario, origen, lugar_preparacion, comentarios, mostrar, estado, disponible) VALUES (:id_usuario, :nombre_usuario, :origen, :lugar_preparacion, :comentarios, :mostrar, :estado, :disponible)");

		$stmt -> bindParam(":id_usuario", $datos["idUsuarioPedidos"], PDO::PARAM_INT);
		$stmt -> bindParam(":nombre_usuario", $datos["nombreUsuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":origen", $datos["origen"], PDO::PARAM_STR);
		$stmt -> bindParam(":lugar_preparacion", $datos["lugarPreparacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":comentarios", $datos["excepciones"], PDO::PARAM_STR);
		$stmt -> bindParam(":mostrar", $datos["mostrar"], PDO::PARAM_INT);
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt -> bindParam(":disponible", $datos["disponible"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "Inserción de la cabecera de pedidos correcta";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}


	

	/*=========================================================
		MOSTRAR COMENTARIOS DE LA LISTA DE PEDIDOS      
	===========================================================*/
	static public function mdlMostrarPedidosByMostrar($tabla, $item1, $item2){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla  WHERE no_pedido = :no_pedido AND mostrar = :mostrar ORDER BY id ASC");

		$stmt -> bindParam(":no_pedido", $item1, PDO::PARAM_INT);
		$stmt -> bindParam(":mostrar", $item2, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=======================================================
		MOSTRAR COLUMNA DE GRUPO EN LA TABLA DE PEDIDOS     
	=========================================================*/
	static public function mdlMostrarColumnaNoPedido($tabla, $item){

		$stmt = Conexion::conectar()->prepare("SELECT no_pedido FROM $tabla");


		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=======================================================
		MOSTRAR COLUMNA DE FECHA EN LA TABLA DE PEDIDOS     
	=========================================================*/
	static public function mdlMostrarColumnaFecha($tabla, $item){

		$stmt = Conexion::conectar()->prepare("SELECT fecha FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


	/*==================================================================
	 	AUTOREINICIAR LOS ID DE LAS TABLAS CUANDO ESTÉN VACÍOS     
	====================================================================*/
	static public function mdlAutoreiniciarValoresIdTablas($tablaModelo){

		$stmt = Conexion::conectar()->prepare("TRUNCATE $tablaModelo");

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*==================================================================
	 	CONSULTA GENERAL DE TODAS LAS TABLAS     
	====================================================================*/
	static public function mdlMostrarRegistrosTablas($tablaModelo){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tablaModelo");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


	/*==================================================================
	 	MOSTRAR LA TABLA PEDIDOS POR GRUPO CON CABECERA     
	====================================================================*/
	static function mdlMostrarLineaPedidosByNoPedido($tabla, $grupo){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE no_pedido = :no_pedido");

		$stmt -> bindParam(":no_pedido", $grupo, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*===============================================
		MOSTRAR LISTA DE PEDIDOS      
	=================================================*/
	static public function mdlMostrarCabeceraPedidosByUsuario($tabla, $item){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla  WHERE id_usuario = :id_usuario ORDER BY no_pedido ASC");

		$stmt -> bindParam(":id_usuario", $item, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*===============================================
		CAMBIAR EL ESTADO DE LA CABECERA DE PEDIDO     
	=================================================*/
	static public function mdlCambiarEstadoCabeceraPedidos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE no_pedido = :no_pedido");
		
		$stmt -> bindParam(":estado", $datos["estadoPedido"], PDO::PARAM_INT);
		$stmt -> bindParam(":no_pedido", $datos["noPedido"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*===============================================
	 QUITAR PRODUCTO DE LISTA DE PEDITOS     
	=================================================*/
	static public function mdlEliminarPedidos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET disponible = 1 WHERE no_pedido = :no_pedido");

		$stmt -> bindParam(":no_pedido", $datos["idProductoPedidoEliminar"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "eliminado";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*===============================================
		AGREGAR PEDIDOS A LA TABLA DE NOTIFICACIONES     
	=================================================*/
	static public function mdlAgregarPedidosaNotificaciones($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (no_usuario, nombre_usuario, no_pedido, tipo, mensaje) VALUES (:no_usuario, :nombre_usuario, :no_pedido, :tipo, :mensaje)");

		$stmt -> bindParam(":no_usuario", $datos["noUsuario"], PDO::PARAM_INT);
		$stmt -> bindParam(":nombre_usuario", $datos["nomUsuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":no_pedido", $datos["noPedido"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt -> bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*==============================================================
		MOSTRAR LOS MENSAJES DE LA TABLA PEDIDOS POR TIPO DE MENSAJE     
	================================================================*/
	static public function mdlMostrarMensajesByUsuario($tabla, $item, $item1){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla  WHERE no_usuario = :id_usuario AND tipo = :tipo ORDER BY id ASC");

		$stmt -> bindParam(":id_usuario", $item, PDO::PARAM_INT);
		$stmt -> bindParam(":tipo", $item1, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}


}
