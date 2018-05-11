<?php

class ControladorProductos{


	    
	/*==============================================
	  MOSTRAR CATEGORIAS
	===============================================*/

	static public function ctrMostrarCategorias($item,$valor){

		$tabla="categorias";

		$respuesta = ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;
	}

   
   /*==============================================
     MOSTRAR SUBCATEGORIAS
     ===============================================*/

    //Recuerda que es static porque estamos trayendo valores
	static public function ctrMostrarSubCategorias($item,$valor){

		$tabla="subcategorias";

		$respuesta = ModeloProductos::mdlMostrarSubCategorias($tabla,$item, $valor);

		return $respuesta;
	}

	/*==============================================
     MOSTRAR SUBCATEGORIAS COMPLETAS
     ===============================================*/

    //Recuerda que es static porque estamos trayendo valores
	static public function ctrMostrarSubCategoriasByIdCategoria($datos){

		$tabla="subcategorias";

		$respuesta = ModeloProductos::mdlMostrarSubCategoriasByIdCategoria($tabla, $datos);

		return $respuesta;
	}

	/*==============================================
	  MOSTRAR PRODUCTOS
	===============================================*/

	static public function ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo){

		$tabla="productos";

		$respuesta= ModeloProductos::mdlMostrarProductos($tabla, $ordenar, $item, $valor, $base, $tope, $modo);

		return $respuesta;
	}

	/*==============================================
	  MOSTRAR PRODUCTOS SIN BASE Y TOPE
	===============================================*/

	static public function ctrMostrarProductosSinBaseYTope($item, $valor, $bar){

		$respuesta= ModeloProductos::mdlMostrarProductosSinBaseYTope($item, $valor, $bar);

		return $respuesta;
	}

	/*==============================================
	  MOSTRAR INFO PRODUCTOS
	===============================================*/

	static public function ctrMostrarInfoProducto($item, $valor){

		$tabla = "productos";

		$respuesta= ModeloProductos::mdlMostrarInfoProducto($tabla, $item, $valor);

		return $respuesta;

	}

	/*==============================================
	  LISTAR PRODUCTOS
	===============================================*/

	static public function ctrListarProductos($ordenar, $item, $valor){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlListarProductos($tabla, $ordenar, $item, $valor);

		return $respuesta;

	}

	/*==============================================
	  MOSTRAR BANNER
	===============================================*/

	static public function ctrMostrarBanner($ruta){

		$tabla="banner";

		$respuesta = ModeloProductos::mdlMostrarBanner($tabla, $ruta);

		return $respuesta;
	}

	/*==============================================
	  BUSCADOR
	===============================================*/

	static public function ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlBuscarProductos($tabla, $busqueda, $ordenar, $modo, $base, $tope);

		return $respuesta;

	}

	/*==============================================
	  LISTAR PRODUCTOS BUSQUEDA
	===============================================*/

	static public function ctrListarProductosBusqueda($busqueda){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlListarProductosBusqueda($tabla, $busqueda);

		return $respuesta;

	}


	/*==============================================
	  ACTUALIZAR VISTA PRODUCTO
	===============================================*/

	static public function ctrActualizarVistaProducto($datos, $item){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlActualizarVistaProducto($tabla, $datos, $item);

		return $respuesta;
	}


	/*=========================================================
	  VERIFICAR LA CANTIDAD DE PRODUCTOS EN LA TABLA PRODUCTOS
	===========================================================*/
	static public function ctrVerificarCantidadProductosTabla($tablaModelo){

		$tabla = $tablaModelo;

		$respuesta = ModeloProductos::mdlVerificarCantidadProductosTabla($tabla);

		return $respuesta;

	}

	/*=========================================================
	  VALIDACION DE LOS BOTONES DE BARES
	===========================================================*/
	static public function ctrValidacionBotonesBares($datos){
		
		$tabla = "productos_almacen";

		$respuesta = ModeloProductos::mdlValidacionBotonesBares($tabla, $datos);

		return $respuesta;
	}


	/*=========================================================
	  AGREGAR PRODUCTOS A LOS BARES
	===========================================================*/
	static public function ctrAgregarProductosBares($datos){
		
		$tabla = "productos_almacen";

		$respuesta = ModeloProductos::mdlAgregarProductosBares($tabla, $datos);

		return $respuesta;
	}

	/*=========================================================
	  AGREGAR PRODUCTOS A LOS BARES
	===========================================================*/
	static public function ctrEliminarProductosBares($datos){
		
		$tabla = "productos_almacen";

		$respuesta = ModeloProductos::mdlEliminarProductosBares($tabla, $datos);

		return $respuesta;
	}
}