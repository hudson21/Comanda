/*======================================
  VARIABLES        
========================================*/

var item=0;
var itemPaginacion = $("#paginacion li"); //Me esta trayendo todos los li que están dentro de paginacion


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

	if(item ==3){

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

		item=3;
	
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

	$("#slide ul").animate({"left":item * -100 + "%"}, 700);

	$("#paginacion li").css({"opacity":0.5});

	$(itemPaginacion[item]).css({"opacity":1});

	console.log("itemPaginacion",itemPaginacion);

}
/*======================================
  INTERVALO     
========================================*/

setInterval(function(){

	avanzar();

},3000)