<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

	/*===============================================
		VALIDAR EMAIL EXISTENTE        
	=================================================*/

	public $validarEmail;

	public function ajaxValidarEmail(){

		$datos = $this->validarEmail;

		$respuesta = ControladorUsuarios::ctrMostrarUsuario("email", $datos);

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

	public function ajaxInsertarCabeceraPedidos(){

		$datos = array ("idUsuarioPedidos"=>$this->idUsuarioPedidos,
						"nombreUsuario"=>$this->nombreUsuario,
						"origen"=>$this->origen,
						"lugarPreparacion"=>$this->lugarPreparacion,
						"excepciones"=>$this->excepciones,
					    "mostrar"=>$this->mostrar,
						"estado"=>$this->estado);

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
		$tabla2="linea_pedidos";
		
		$datos = array("idProductoPedidoEliminar"=>$this->idProductoPedidoEliminar);

		$respuesta = ControladorUsuarios::ctrEliminarPedidos($tabla1,$datos);
		$respuesta1 = ControladorUsuarios::ctrEliminarPedidos($tabla2,$datos);

		echo $respuesta;
		echo $respuesta1;
	}
}

/*===============================================
	VALIDAR EMAIL EXISTENTE        
=================================================*/
	if(isset($_POST["validarEmail"])){
		$valEmail = new AjaxUsuarios();
		$valEmail -> validarEmail = $_POST["validarEmail"];
		$valEmail -> ajaxValidarEmail();

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
