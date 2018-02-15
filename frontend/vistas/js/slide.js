/*======================================
  VARIABLES        
========================================*/

var item=0;
var itemPaginacion = $("#paginacion li"); //Me esta trayendo todos los li que están dentro de paginacion
var interrumpirCiclo=false;
var imgProducto = $(".imgProducto");
var titulos1 = $("#slide h1");
var titulos2 = $("#slide h2");
var titulos3 = $("#slide h3");
var btnVerProducto = $("#slide button");
var detenerIntervalo = false;
var toggle = false;

$("#slide ul li ").css({"width":100/$("#slide ul li").length + "%"});
$("#slide ul ").css({"width":$("#slide ul li").length * 100 + "%"});

/*======================================
  ANIMACIÓN INICIAL        
========================================*/
$(imgProducto[item]).animate({"top":-15+"%", "opacity":0},100);
$(imgProducto[item]).animate({"top":30+"px", "opacity":1},600);

$(titulos1[item]).animate({"top":-15+"%", "opacity":0},100);
$(titulos1[item]).animate({"top":30+"px", "opacity":1},600);

$(titulos2[item]).animate({"top":-15+"%", "opacity":0},100);
$(titulos2[item]).animate({"top":30+"px", "opacity":1},600);

$(titulos3[item]).animate({"top":-15+"%", "opacity":0},100);
$(titulos3[item]).animate({"top":30+"px", "opacity":1},600);

$(btnVerProducto[item]).animate({"top":-15+"%", "opacity":0},100);
$(btnVerProducto[item]).animate({"top":30+"px", "opacity":1},600);

/*======================================
  PAGINACIÓN        
========================================*/

$("#paginacion li").click(function(){

	item=$(this).attr("item")-1;

	movimientoSlide(item);

})

/*======================================
  AVANZAR        
========================================*/

function avanzar(){

	if(item == $("#slide ul li").length -1){

		item=0;//Estamos tomando la variable de item que creamos al principio para nuestras variables globales
	
	}else{

			item++;//Incrementamos el item mientras que no sea igual a 3
	}

	movimientoSlide(item);//De esta manera podemos reutilizar la función de movimientoSlide

}

$("#slide #avanzar").click(function(){

	avanzar();
	
})

/*======================================
  RETROCEDER        
========================================*/

function retroceder(){

	if(item ==0){

		item = $("#slide ul li").length -1;
	
	}else{

			item--;
	}

	movimientoSlide(item);//De esta manera podemos reutilizar la función de movimientoSlide

}

$("#slide #retroceder").click(function(){

	retroceder();
})

/*======================================
  MOVIMIENTO DEL SLIDE        
========================================*/

function movimientoSlide(item){

	//http://easings.net/es

	$("#slide ul").animate({"left":item * -100 + "%"}, 700, "easeOutBounce");

	$("#paginacion li").css({"opacity":0.5});

	$(itemPaginacion[item]).css({"opacity":1});

	interrumpirCiclo=true;

	//console.log("itemPaginacion",itemPaginacion);

	$(imgProducto[item]).animate({"top":-15+"%", "opacity":0},100);
    $(imgProducto[item]).animate({"top":30+"px", "opacity":1},700);

	$(titulos1[item]).animate({"top":-15+"%", "opacity":0},100);
	$(titulos1[item]).animate({"top":30+"px", "opacity":1},700);
	
	$(titulos2[item]).animate({"top":-15+"%", "opacity":0},100);
	$(titulos2[item]).animate({"top":30+"px", "opacity":1},700);
	
	$(titulos3[item]).animate({"top":-15+"%", "opacity":0},100);
	$(titulos3[item]).animate({"top":30+"px", "opacity":1},700);

	$(btnVerProducto[item]).animate({"top":-15+"%", "opacity":0},100);
	$(btnVerProducto[item]).animate({"top":30+"px", "opacity":1},700);

}
/*======================================
  INTERVALO     
========================================*/

setInterval(function(){

	if(interrumpirCiclo){

		interrumpirCiclo = false;
	
	}else{

		if (detenerIntervalo==false){
			avanzar();
		}

	}

},3000)


/*======================================
  APARECER FLECHAS     
========================================*/

$("#slide").mouseover(function(){

	$("#slide #retroceder").css({"opacity":1});
	$("#slide #avanzar").css({"opacity":1});

    detenerIntervalo = true;


});

/*======================================
  DESAPARECER FLECHAS     
========================================*/

$("#slide").mouseout(function(){

	$("#slide #retroceder").css({"opacity":0});
	$("#slide #avanzar").css({"opacity":0});

   detenerIntervalo = false;
});

/*======================================
  ESCONDER SLIDE    
========================================*/

$("#btnSlide").click(function(){

	if(toggle==false){

		toggle=true;
		
		$("#slide").slideUp("fast");

		$("#btnSlide").html('<i class="fa fa-angle-down"></i>');
	
	}else{

		toggle=false;

		$("#slide").slideDown("fast");

		$("#btnSlide").html('<i class="fa fa-angle-up"></i>');
	}

	
})

