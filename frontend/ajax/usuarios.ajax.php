<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

	/*===============================================
		VALIDAR EMAIL EXISTENTE        
	=================================================*/

	public $validarUsuario;

	public function ajaxValidarUsuario(){

		$datos = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuario($datos);

		echo json_encode($respuesta);

	}

	
	/*===============================================
		REGISTRO CON FACEBOOK       
	=================================================*/

	public $email;
	public $nombre;
	public $foto;

	public function ajaxRegistroFacebook(){

		$datos = array("nombre"=>$this->nombre,
					   "email"=>$this->email,
					   "foto"=>$this->foto,
					   "password"=>"null",
					   "modo"=>"facebook",
					   "verificacion"=>0,
					   "emailEncriptado"=>"null");

		$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

		echo $respuesta;

	}

	/*===============================================
		AGREGAR A LISTA DE DESEOS       
	=================================================*/
	public $idUsuario;
	public $idProducto;

	public function ajaxAgregarDeseo(){

		$datos = array("idUsuario"=>$this->idUsuario,
					   "idProducto"=>$this->idProducto);

		$respuesta = ControladorUsuarios::ctrAgregarDeseo($datos);

		echo $respuesta;
	}


	/*===============================================
		QUITAR PRODUCTO DE LISTA DE DESEOS      
	=================================================*/
	public function ajaxQuitarDeseo(){

		$datos = $this->idDeseo;

		$respuesta = ControladorUsuarios::ctrQuitarDeseo($datos);

		echo $respuesta;
	}

	/*============================================================================================================  
  		INSERTAR LOS REGISTROS EN LA TABLA DE LINEA PEDIDOS DE LOS PRODUCTOS YA CONFIRMADOS A TRAVÉS DE AJAX    
	==============================================================================================================*/
	
	public $idProductoPedidos;
	public $cantidad;
	public $numeroPedido;


	public function ajaxInsertarLineaPedidos(){

   //for ($i=0; $i < ; $i++) { 
   	//	$datosUsuarioPedidos = array("idUsuarioPedidos"=>$this->idUsuarioPedidos[i]);
   //}	
		$datosPedidos = array("idProductoPedidos"=>$this->idProductoPedidos,
							  "cantidad"=>$this->cantidad,
					      	  "numeroPedido"=>$this->numeroPedido);

		$respuesta = ControladorUsuarios::ctrInsertarLineaPedidos($datosPedidos);

		echo $respuesta;

	}

	/*============================================================================================================  
  		INSERTAR LOS REGISTROS EN LA TABLA DE CABECERA PEDIDOS DE LOS PRODUCTOS YA CONFIRMADOS A TRAVÉS DE AJAX    
	==============================================================================================================*/
	public $idUsuarioPedidos ;
	public $nombreUsuario;
	public $origen;
	public $lugarPreparacion;
	public $excepciones;
	public $mostrar;
	public $estado;
	public $disponible;

	public function ajaxInsertarCabeceraPedidos(){

		$datos = array ("idUsuarioPedidos"=>$this->idUsuarioPedidos,
						"nombreUsuario"=>$this->nombreUsuario,
						"origen"=>$this->origen,
						"lugarPreparacion"=>$this->lugarPreparacion,
						"excepciones"=>$this->excepciones,
					    "mostrar"=>$this->mostrar,
						"estado"=>$this->estado,
						"disponible"=>$this->disponible);

		$respuesta = ControladorUsuarios::ctrInsertarCabeceraPedido($datos);
	}

	/*===============================================
		CAMBIAR EL ESTADO DE LA CABECERA DE PEDIDO     
	=================================================*/
	public $estadoPedido;
	public $noPedido;

	public function ajaxCambiarEstadoCabeceraPedidos(){

		$datos = array("estadoPedido"=>$this->estadoPedido,
					   "noPedido"=>$this->noPedido);


		$respuesta = ControladorUsuarios::ctrCambiarEstadoCabeceraPedidos($datos);
	}


	/*===============================================
		QUITAR PRODUCTO DE LISTA DE PEDITOS     
	=================================================*/
	public $idProductoPedidoEliminar;

	public function ajaxEliminarPedidos(){

		$tabla1="cabecera_pedidos";
		
		$datos = array("idProductoPedidoEliminar"=>$this->idProductoPedidoEliminar);

		$respuesta = ControladorUsuarios::ctrEliminarPedidos($tabla1,$datos);
		
		echo $respuesta;
		
	}

	/*===============================================
		AGREGAR PEDIDOS A LA TABLA DE NOTIFICACIONES     
	=================================================*/
	public $noUsuario;
	public $nomUsuario;
	public $numPedido;
	public $tipo;
	public $mensaje;

	public function ajaxAgregarPedidosaNotificaciones(){

		$datos = array("noUsuario"=>$this->noUsuario,
					   "nomUsuario"=>$this->nomUsuario,
					   "noPedido"=>$this->numPedido,
					   "tipo"=>$this->tipo,
					   "mensaje"=>$this->mensaje);

		$respuesta = ControladorUsuarios::ctrAgregarPedidosaNotificaciones($datos);
		
		echo $respuesta;
	}

	/*===============================================
		AGREGAR MENSAJES A LA TABLA DE NOTIFICACIONES     
	=================================================*/
	public $mensajeGeneral;
	public $tipoGeneral;
	public $idUsuarioGenerales;
	public $nombreUsuarioGenerales;

	public function ajaxAgregarMensajesNotificaciones(){

		$datos = array("mensajeGeneral"=>$this->mensajeGeneral,
					   "tipoGeneral"=>$this->tipoGeneral,
						"idUsuarioGenerales"=>$this->idUsuarioGenerales,
						"nombreUsuarioGenerales"=>$this->nombreUsuarioGenerales);

		$respuesta = ControladorUsuarios::ctrAgregarMensajesNotificaciones($datos);

		echo $respuesta;
	}

	/*=================================================================================
		AGREGAR O MODIFICAR LOS PRODUCTOS DESHABILITADOS EN LA TABLA PRODUCTOS_ALMACEN     
	===================================================================================*/
	public $productoDeshabilitar;
	public $bar;
	public $est;

	public function ajaxAgregaroModificarProductosAlmacen(){

		$datos = array("id_producto"=>$this->productoDeshabilitar,
					   "id_bar"=>$this->bar,
					   "est"=>$this->est);

		$respuesta = ControladorUsuarios::ctrVerificarExistenciaProductosAlmacen($datos);

		if($respuesta == null){

		$respuesta = ControladorUsuarios::ctrInsertarProductosAlmacen($datos);

		}else{

		$respueta = ControladorUsuarios::ctrModificarProductosAlmacen($datos);
			
		}

	  
	
	}

	/*======================================
	       ELIMINAR USUARIO   
	========================================*/
	public function ajaxEliminarUsuario(){

		$datos = $this->idUEli;

		$respuesta = ControladorUsuarios::ctrEliminarUsuario($datos);

		echo $respuesta;

	}



	/*==================================================================
		NO MOSTRAR DE NUEVO LOS MENSAJES QUE YA SE MOSTRARON UNA VEZ      
	===================================================================*/
	public $deshabilitarMensaje;

	public function ajaxNoMostrarNotificacionesPush(){

		$datos = $this->deshabilitarMensaje;

        $respuesta = ControladorUsuarios::ctrNoMostrarNotificacionesPush($datos);

		echo $respuesta;
	}

}

/*===============================================
	VALIDAR EMAIL EXISTENTE        
=================================================*/
	if(isset($_POST["validarUsuario"])){
		$valEmail = new AjaxUsuarios();
		$valEmail -> validarUsuario = $_POST["validarUsuario"];
		$valEmail -> ajaxValidarUsuario();

	}

/*===============================================
	REGISTRO CON FACEBOOK       
=================================================*/
	if(isset($_POST["email"])){

		$regFacebook = new AjaxUsuarios();
		$regFacebook -> email = $_POST["email"];
		$regFacebook -> nombre = $_POST["nombre"];
		$regFacebook -> foto = $_POST["foto"];
		$regFacebook -> ajaxRegistroFacebook();

	}

/*===============================================
	AGREGAR A LISTA DE DESEOS       
=================================================*/
	if(isset($_POST["idUsuario"])){

		$deseo = new AjaxUsuarios();
		$deseo -> idUsuario = $_POST["idUsuario"];
		$deseo -> idProducto = $_POST["idProducto"];
		$deseo -> ajaxAgregarDeseo();

	}

/*===============================================
	QUITAR PRODUCTO DE LISTA DE DESEOS      
=================================================*/
	if(isset($_POST["idDeseo"])){

		$quitarDeseo = new AjaxUsuarios();
		$quitarDeseo -> idDeseo = $_POST["idDeseo"];
		$quitarDeseo -> ajaxQuitarDeseo();

	}

/*===============================================
	ELIMINAR USUARIO     
=================================================*/
	if(isset($_POST["idUEli"])){

		$quitarDeseo = new AjaxUsuarios();
		$quitarDeseo -> idUEli = $_POST["idUEli"];
		$quitarDeseo -> ajaxEliminarUsuario();

	}

/*============================================================================================================  
  	INSERTAR LOS REGISTROS EN LA TABLA LINEA DE PEDIDOS LOS PRODUCTOS YA CONFIRMADOS A TRAVÉS DE AJAX    
==============================================================================================================*/
	if(isset($_POST["idProductoPedidos"])){

		$pedidos = new AjaxUsuarios();
		$pedidos -> idProductoPedidos = $_POST["idProductoPedidos"];
		$pedidos -> cantidad = $_POST["cantidad"];
		$pedidos -> numeroPedido = $_POST["numeroPedido"];
		$pedidos -> ajaxInsertarLineaPedidos();

	}

/*============================================================================================================  
  	INSERTAR LOS REGISTROS EN LA TABLA CABECERA DE PEDIDOS LOS PRODUCTOS YA CONFIRMADOS A TRAVÉS DE AJAX    
==============================================================================================================*/
	if(isset($_POST["nombreUsuario"])){

		$cabecera = new AjaxUsuarios();
		$cabecera -> idUsuarioPedidos = $_POST["idUsuarioPedidos"];
		$cabecera -> nombreUsuario = $_POST["nombreUsuario"];
		$cabecera -> origen = $_POST["origen"];
		$cabecera -> lugarPreparacion = $_POST["lugarPreparacion"];
		$cabecera -> excepciones = $_POST["excepciones"];
		$cabecera -> mostrar = $_POST["mostrar"];
		$cabecera -> estado = $_POST["estado"];
		$cabecera -> disponible = $_POST["disponible"];
		$cabecera -> ajaxInsertarCabeceraPedidos();
	}

	/*===============================================
		QUITAR PRODUCTO DE LISTA DE PEDITOS     
	=================================================*/
	if(isset($_POST["idProductoPedidoEliminar"])){
		$pedidosEliminar = new AjaxUsuarios();
		$pedidosEliminar -> idProductoPedidoEliminar = $_POST["idProductoPedidoEliminar"];
		$pedidosEliminar -> ajaxEliminarPedidos();
	}

	/*===============================================
		CAMBIAR EL ESTADO DE LA CABECERA DE PEDIDO     
	=================================================*/
	if(isset($_POST["estadoPedido"])){
		$cabeceraEstado = new AjaxUsuarios();
		$cabeceraEstado -> estadoPedido = $_POST["estadoPedido"];
		$cabeceraEstado -> noPedido = $_POST["numeroPedido"];
		$cabeceraEstado -> ajaxCambiarEstadoCabeceraPedidos();
	}

	/*===============================================
		AGREGAR PEDIDOS A LA TABLA DE NOTIFICACIONES     
	=================================================*/
	if(isset($_POST["tipo"])){
		$notificaciones = new AjaxUsuarios();
		$notificaciones -> noUsuario = $_POST["noUsuario"];
		$notificaciones -> nomUsuario = $_POST["nomUsuario"];
		$notificaciones -> numPedido = $_POST["noPedido"];
		$notificaciones -> tipo = $_POST["tipo"];
		$notificaciones -> mensaje = $_POST["mensaje"];
		$notificaciones -> ajaxAgregarPedidosaNotificaciones();
		
	}

	/*===============================================
		AGREGAR MENSAJES A LA TABLA DE NOTIFICACIONES     
	=================================================*/
	if(isset($_POST["mensajeGeneral"])){
		$mensajesGenerales = new AjaxUsuarios();
		$mensajesGenerales -> mensajeGeneral = $_POST["mensajeGeneral"];
		$mensajesGenerales -> tipoGeneral = $_POST["tipoGeneral"];
		$mensajesGenerales -> idUsuarioGenerales = $_POST["idUsuarioGenerales"];
		$mensajesGenerales -> nombreUsuarioGenerales = $_POST["nombreUsuarioGenerales"];
		$mensajesGenerales -> ajaxAgregarMensajesNotificaciones();
	}

	/*=================================================================================
		AGREGAR O MODIFICAR LOS PRODUCTOS DESHABILITADOS EN LA TABLA PRODUCTOS_ALMACEN     
	===================================================================================*/
	if(isset($_POST["id_bar"])){
		$deshabilitarProducto = new AjaxUsuarios();
		$deshabilitarProducto -> productoDeshabilitar = $_POST["id_producto"];
		$deshabilitarProducto -> bar = $_POST["id_bar"];
		$deshabilitarProducto -> est = $_POST["est"];
		$deshabilitarProducto -> ajaxAgregaroModificarProductosAlmacen();
	}

	/*=================================================================================
		AGREGAR O MODIFICAR LOS PRODUCTOS DESHABILITADOS EN LA TABLA PRODUCTOS_ALMACEN     
	===================================================================================*/
	if(isset($_POST["deshabilitarMensaje"])){
		$deshabilitarMen = new AjaxUsuarios();
		$deshabilitarMen -> deshabilitarMensaje = $_POST["deshabilitarMensaje"];
		$deshabilitarMen -> ajaxNoMostrarNotificacionesPush();
	}

	




	

