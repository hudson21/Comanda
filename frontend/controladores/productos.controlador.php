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

	/*===============================================================
	  AGREGAR UN PRODUCTO A LA TABLA PRODUCTOS Y PRODUCTOS_ALMACEN
	=================================================================*/
	static public function ctrInsertarProducto(){

		if(isset($_POST["categoria"])){

			/*===================================================
			    VALIDAR IMAGEN
			=====================================================*/
			$ruta = "";

			if(isset($_FILES["datosImagenProducto"]["tmp_name"])){

				/*===================================================
			    	PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
				=====================================================*/

				$directorio = "vistas/img/subirProductos"; 
				/*
				//PARA ELIMINAR LA FOTO DEL PRODUCTO

				if(!empty($_POST[])){

					unlink($_POST["portada"]);
				}*/

				//Creamos el directorio de la carpeta de la imagen con permisos de lectura y escritura
				//mkdir($directorio, 0755);


				/*===================================================
			    	GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=====================================================*/
				$aleatorio = mt_rand(100, 999);

				$imagen = "vistas/img/subirProductos/".$aleatorio.".jpeg";

				/*===================================================
			    	MODIFICAMOS TAMAÑO DE LA FOTO
				=====================================================*/
				list($ancho, $alto) = getimagesize($_FILES["datosImagenProducto"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				$origen = imagecreatefromjpeg($_FILES["datosImagenProducto"]["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $imagen);


			}

			//echo'<script> var ruta = localStorage.getItem("productoURL"); </script>';

			//$ruta = echo"<script> document.write(ruta) </script>";
			
			$datos = array("categoria" => $_POST["categoria"],
						   "subcategoria" => $_POST["subcategoria"],
						   "nombre_producto" => $_POST["nombre_producto"],
						   "rutaProducto" => $_POST["rutaProducto"],
						   "codigo_busqueda" => $_POST["codigo_busqueda"],
						   "descripcion" => $_POST["descripcion"],
						   "precio" => $_POST["precio"],
						   "portada" => $imagen);

			$tabla = "productos";

			$respuesta = ModeloProductos::mdlInsertarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script> 

						swal({

							title: "¡OK!",
							text: "¡Se ha insertado un nuevo producto",
							type:"success",
							confirmButtonText:"Cerrar",
							closeOnConfirm: false,
							icon: "success"
												  
						},

						function(isConfirm){

							if(isConfirm){
									
										  history.back();

							}
						});

					</script>';
			}

		}
	}


}