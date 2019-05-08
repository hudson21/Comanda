/*===================================================
    PLANTILLA
=====================================================*/

var rutaOculta = $("#rutaOculta").val();

//Herramienta TOOLTIP

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

 

$.ajax({

	url:rutaOculta+"ajax/plantilla.ajax.php",
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

(function(){

	 $.scrollUp({

 		scrollText:"",
 		scrollSpeed: 2000,
 		easingType: "easeOutQuint"
 	});

});


/*======================================
  EFECTOS CON EL SCROLL        
========================================*/

$(window).scroll(function(){

	var scrollY = window.pageYOffset;//Con esto yo puedo calcular la posición del scroll

	//console.log("scrollY",scrollY);

	if(window.matchMedia("(min-width:768px)").matches){

		if($(".banner").html() !=  null){

			if(scrollY < ($(".banner").offset().top)-140){ //Mientras que la posición del banner sea mejor que la del top
				//console.log("El valor es menor");
			 $(".banner img").css({"margin-top":-scrollY/3+"px"});
	
		}else{
				scrollY=0;
			 }
		}		
	}
})




/*======================================
  MIGAS DE PAN        
========================================*/

var pagActiva = $(".pagActiva").html();

if(pagActiva != null){

	var regPagActiva = pagActiva.replace(/-/g, " ");

	$(".pagActiva").html(regPagActiva);
}

/*======================================
  ENLACES PAGINACIÓN        
========================================*/

var url = window.location.href;

var indice = url.split("/");

//console.log("indice",indice);

$("#item"+indice.pop()).addClass("active");












