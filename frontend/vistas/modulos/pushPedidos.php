<?php

session_start();

include "conexion.php";
include "usuarios.controlador.php";
include "usuarios.modelo.php";
include "rutas.php";

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();
$item = $_SESSION["id"];
$cabeceraPedidos = ControladorUsuarios::ctrMostrarCabeceraPedidosByUsuario($item);

foreach($cabeceraPedidos as $key => $value1){

  if($value1["estado"]==2 && $value1["id_usuario"] == $_SESSION["id"] && $value1["mensaje_confirmacion"]==0){

    echo '<script>Push.create("Pedido Listo", {
               body: "El pedido '.$value1["no_pedido"].' se encuentra listo",
               icon: "vistas/js/logo.jpg",
               onClick: function(){

                  window.location = rutaOculta+"notificaciones";
                  this.close();
                  Push.clear();
                }
            });
         </script>';

    $tablaModelo = "cabecera_pedidos";
    $item1 = "mensaje_confirmacion";
    $item2 = "no_pedido";

    $datos = array("no_pedido"=>$value1["no_pedido"],
                "mensaje_confirmacion"=>1);

    ControladorUsuarios::ctrNoMostrarNotificacionesPush($datos, $tablaModelo, $item1, $item2);

 }             
}


?>