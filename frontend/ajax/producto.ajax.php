<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{

	public $valor;
	public $item;
	public $ruta;


	public function ajaxVistaProducto(){

		$datos = array("valor"=>$this->valor,
						"ruta"=>$this->ruta);

		$item = $this->item;

		$respuesta= ControladorProductos::ctrActualizarVistaProducto($datos, $item);

		echo $respuesta;

		/*json_decode me convierte un String en un Array
		  json_encode me convierte un Array en un String*/
	}


	/*====================================================================================================
   		AGREGAR TODOS LOS PRODUCTOS DE LA TABLA PRODUCTOS A LA TABLA DE PRODUCTOS POR ALMACEN     
	======================================================================================================*/
	public $id_barAgregar;
	public $estAgregar;

	public function ajaxAgregarTodosProductosAProductos(){

		$datos = array("id_barAgregar"=>$this->id_barAgregar,
					   "estAgregar"=>$this->estAgregar);

			$respuesta = ControladorProductos::ctrAgregarProductosBares($datos);

	}

	/*====================================================================================================
   		ELIMINAR TODOS LOS PRODUCTOS DE LA TABLA PRODUCTOS A LA TABLA DE PRODUCTOS POR ALMACEN     
	======================================================================================================*/
	public $id_barEliminar;

	public function ajaxEliminarTodosProductosAProductos(){

		$datos = array("id_barEliminar"=>$this->id_barEliminar);

		$respuesta = ControladorProductos::ctrEliminarProductosBares($datos);

	}

	/*===============================================
		VALIDAR SUBCATEGORIAS        
	=================================================*/

	public $validarSubcategorias;

	public function ajaxValidarSubcategorias(){

		$datos = $this->validarSubcategorias;

		$respuesta = ControladorProductos::ctrMostrarSubCategoriasByIdCategoria($datos);

		echo json_encode($respuesta);

	}

}

if(isset($_POST["valor"])){

	$vista = new AjaxProductos();
	$vista -> valor = $_POST["valor"];
	$vista -> item = $_POST["item"];
	$vista -> ruta = $_POST["ruta"];
	$vista -> ajaxVistaProducto();

}

/*====================================================================================================
   		AGREGAR TODOS LOS PRODUCTOS DE LA TABLA PRODUCTOS A LA TABLA DE PRODUCTOS POR ALMACEN     
	======================================================================================================*/
	if(isset($_POST["id_barAgregar"])){
		$agregarProductos = new AjaxProductos();
		$agregarProductos -> id_barAgregar = $_POST["id_barAgregar"];
		$agregarProductos -> estAgregar = $_POST["estAgregar"];
		$agregarProductos -> ajaxAgregarTodosProductosAProductos();
	}

	/*====================================================================================================
   		ELIMINAR TODOS LOS PRODUCTOS DE LA TABLA PRODUCTOS A LA TABLA DE PRODUCTOS POR ALMACEN     
	======================================================================================================*/
	if(isset($_POST["id_barEliminar"])){
		$eliminarProductos = new AjaxProductos();
		$eliminarProductos -> id_barEliminar = $_POST["id_barEliminar"];
		$eliminarProductos -> ajaxEliminarTodosProductosAProductos();
	}


	/*===============================================
		VALIDAR SUBCATEGORIAS        
	=================================================*/
	if(isset($_POST["validarSubcategorias"])){
		$validarSub = new AjaxProductos();
		$validarSub -> validarSubcategorias = $_POST["validarSubcategorias"];
		$validarSub -> ajaxValidarSubcategorias();
	}

