<?php

session_start();

require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

include "conexion.php";
include "usuarios.controlador.php";
include "usuarios.modelo.php";
include "productos.controlador.php";
include "productos.modelo.php";
include "rutas.php";

/*
	Este ejemplo imprime un
	ticket de venta desde una impresora térmica
*/


/*
    Aquí, en lugar de "POS" (que es el nombre de mi impresora)
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
*/

$nombre_impresora=$_SESSION["nombreImpresora"];


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
#Mando un numero de respuesta para saber que se conecto correctamente.

/*
	Vamos a imprimir un logotipo
	opcional. Recuerda que esto
	no funcionará en todas las
	impresoras

	Pequeña nota: Es recomendable que la imagen no sea
	transparente (aunque sea png hay que quitar el canal alfa)
	y que tenga una resolución baja. En mi caso
	la imagen que uso es de 250 x 250
*/

# Vamos a alinear al centro lo próximo que imprimamos
$printer->setJustification(Printer::JUSTIFY_CENTER);

/*
	Intentaremos cargar e imprimir
	el logo
*/
	
//try{
//	$logo = EscposImage::load("beloved_logo.png", false);
//    $printer->bitImage($logo);
//}catch(Exception $e){/*No hacemos nada si hay error*/}

/*
	Ahora vamos a imprimir un encabezado
*/

$numero_pedido = $_POST["pedidoImprimir"];

$cabeceraPedidos=ControladorUsuarios::ctrMostrarCabeceraPedidosByNoPedido($numero_pedido);

$printer->text("\n"."No.Pedido: ".$cabeceraPedidos["no_pedido"] . "\n");
$printer->text("Mesero: ".$cabeceraPedidos["nombre_usuario"] . "\n");
$printer->text("Lugar de Origen: " .$cabeceraPedidos["origen"]. "\n");
$printer->text("Lugar de Preparación: " .$cabeceraPedidos["lugar_preparacion"]. "\n");
$printer->text("Fecha: " . "");
#La fecha también
date_default_timezone_set("America/Cancun");
$printer->text(date("Y-m-d H:i:s") . "\n");
$printer->text("-----------------------------" . "\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("NOMBRE           CANTIDAD    .\n");
$printer->text("-----------------------------"."\n");
/*
	Ahora vamos a imprimir los
	productos
*/
	/*Alinear a la izquierda para la cantidad y el nombre*/

$lineaPedidos=ControladorUsuarios::ctrMostrarLineaPedidosByNoPedido($numero_pedido);

$printer->setJustification(Printer::JUSTIFY_LEFT);

foreach ($lineaPedidos as $key => $value) {

$productos = ControladorProductos::ctrListarProductosJoinProductosAlmacen($value["id_producto"],$_SESSION["bar"]);

	if($productos["titulo1"] == null){
		$titulo = $productos["titulo"];
	}else{
		$titulo = $productos["titulo1"];
	}

		$printer->text($titulo."         ");
		$printer->text($value["cantidad"]."\n");

echo json_encode($productos);
}

/*
	Terminamos de imprimir
	los productos, ahora va el total
*/
$printer->text( "\n\n");
$printer->text("-----------------------------"."\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);

if($cabeceraPedidos["comentarios"] != null){

$printer->text("COMENTARIOS: \n");
$printer->text($cabeceraPedidos["comentarios"]."\n\n");

}

/*
	Podemos poner también un pie de página
*/
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("Muchas gracias por su compra\n");



/*Alimentamos el papel 3 veces*/
$printer->feed(3);

/*
	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->cut();

/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/
$printer->pulse();

/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printer->close();


?>