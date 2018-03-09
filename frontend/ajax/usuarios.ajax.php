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
  		INSERTAR LOS REGISTROS EN LA TABLA DE PEDIDOS DE LOS PRODUCTOS YA CONFIRMADOS A TRAVÉS DE AJAX    
	==============================================================================================================*/
	public $idUsuarioPedidos ;
	public $idProductoPedidos;
	public $palapa;
	public $imagen ;
	public $titulo;
	public $precio;
	public $cantidad;
	public $estado;
	public $excepciones;
	public $mostrar;
	public $nombreUsuario;

	public function ajaxInsertarPedidos(){

   //for ($i=0; $i < ; $i++) { 
   	//	$datosUsuarioPedidos = array("idUsuarioPedidos"=>$this->idUsuarioPedidos[i]);
   //}	
		$datosPedidos = array("idUsuarioPedidos"=>$this->idUsuarioPedidos,
					   		  "idProductoPedidos"=>$this->idProductoPedidos,
					   		  "palapa"=>$this->palapa,
							  "imagen"=>$this->imagen,
							  "titulo"=>$this->titulo,
							  "precio"=>$this->precio,
							  "cantidad"=>$this->cantidad,
						      "estado"=>$this->estado,
					          "excepciones"=>$this->excepciones,
					          "mostrar"=>$this->mostrar,
					      	  "nombreUsuario"=>$this->nombreUsuario);

		$respuesta = ControladorUsuarios::ctrInsertarPedidos($datosPedidos);

		echo $respuesta;

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
  	INSERTAR LOS REGISTROS EN LA TABLA DE PEDIDOS DE LOS PRODUCTOS YA CONFIRMADOS A TRAVÉS DE AJAX    
==============================================================================================================*/
	if(isset($_POST["idUsuarioPedidos"])){

		$pedidos = new AjaxUsuarios();
		$pedidos -> idUsuarioPedidos = $_POST["idUsuarioPedidos"];
		$pedidos -> idProductoPedidos = $_POST["idProductoPedidos"];
		$pedidos -> palapa = $_POST["palapa"];
		$pedidos -> imagen = $_POST["imagen"];
		$pedidos -> titulo = $_POST["titulo"];
		$pedidos -> precio = $_POST["precio"];
		$pedidos -> cantidad = $_POST["cantidad"];
		$pedidos -> estado = $_POST["estado"];
		$pedidos -> excepciones = $_POST["excepciones"];
		$pedidos -> mostrar = $_POST["mostrar"];
		$pedidos -> nombreUsuario = $_POST["nombreUsuario"];
		$pedidos -> ajaxInsertarPedidos();

	}