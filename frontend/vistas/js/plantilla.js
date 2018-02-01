/*===================================================
    PLANTILLA
=====================================================*/

$.ajax({

	url:"ajax/plantilla.ajax.php",
	success:function(respuesta){

		var colorFondo = JSON.parse(respuesta).colorFondo;
		var colorTexto = JSON.parse(respuesta).colorTexto;
		var barraSuperior = JSON.parse(respuesta).barraSuperior;
		var textoSuperior = JSON.parse(respuesta).textoSuperior;

		$(".backColor, .backColor a").css({"background":colorFondo,
	                                        "color":colorTexto})

		$(".barraSuperior , .barraSuperior a").css({"background": barraSuperior,
			                                         "color":textoSuperior})

	}
})

/*======================================
  CUADRÍCULA O LISTA        
========================================*/

var btnList = $(".btnList");
//console.log("btnList",btnList.length);
//Imprimimos la variable para ver cuantos elementos con la clase btnList hay en el archivo de destacados.php


for (var i = 0; i < btnList.length; i++) {
	
$("#btnGrid"+i).click(function(){

	var numero = $(this).attr("id").substr(-1);
	//Estoy tomando el valor de id que sago del elemento btnGrid

	$(".list"+numero).hide();
	$(".grid"+numero).show();

	$("#btnGrid"+numero).addClass("backColor");
	$("#btnList"+numero).removeClass("backColor");	

})

$("#btnList"+i).click(function(){

	var numero = $(this).attr("id").substr(-1);

	$(".list"+numero).show();
	$(".grid"+numero).hide();	

	$("#btnGrid"+numero).removeClass("backColor");
	$("#btnList"+numero).addClass("backColor");

})

}







