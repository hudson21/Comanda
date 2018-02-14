/*======================================
CARRUSEL          
========================================*/

$(".flexslider").flexslider({

	animation: "slide",
	controlNav:true,
	animationLoop: false,
	slideshow: false,
	itemWidth: 100,
	itemMargin: 5	
});

$(".flexslider ul li img").click(function(){

    var capturaIndice = $(this).attr("value");
    //console.log("capturaIndice",capturaIndice);

   $(".infoproducto figure.visor img").hide();

   $("#lupa"+capturaIndice).show();

})

/*======================================
  EFECTO LUPA        
========================================*/

/* $(".infoproducto figure.visor img").mouseover(function(event){

 	var capturaImg = $(this).attr("src");

 	$(".lupa img").attr("src", capturaImg);

 	$(".lupa").fadeIn("fast");

 	$(".lupa").css({

 		"height":$(".visorImg").height()+"px",
 		"background":"#eee",
 		"width":"100%"
 	})

 });

 $(".infoproducto figure.visor img").mouseout(function(event){

 	$(".lupa").fadeOut("fast");


 });

 $(".infoproducto figure.visor img").mousemove(function(event){

 	var posX = event.offsetX;
 	console.log("posX",posX);
 	var posY = event.offsetY;
 	console.log("posY",posY);

 	$(".lupa img").css({

 		"margin-left":-posX+"px",
 		"margin-top":-posY+"px"
 	})
 })*/

 /*======================================
  CONTADOR DE VISTAS        
========================================*/

var contador = 0;

$(window).on("load",function(){

  var vistas = $("span.vistas").html(); //De esta manera estoy tomando el valor de las vistas
  var precio = $("span.vistas").attr("tipo");//Estoy capturando el atributo tipo
 // console.log("tipo",tipo);

  contador = Number(vistas) + 1; //Con el number podemos convertir en un valor numérico lo que está dentro del paréntesis
 // console.log("contador",contador);

 $("span.vistas").html(contador);

 //EVALUAMOS EL PRECIO PARA DEFINIR CAMPO A ACTUALIZAR

 if(precio == 0){

 	var item = "vistasGratis";

 }else{

 	var item = "vistas";

 }

 //EVALUAMOS LA RUTA PARA DEFINIR EL PRODUCTO A ACTUALIZAR

 var urlActual = location.pathname;//Este método es para capturar la URL actual que está en la barra URL del navegador
 var ruta = urlActual.split("/");
 //console.log("ruta", ruta.pop());

 var datos = new FormData();

 datos.append("valor", contador);
 datos.append("item", item);
 datos.append("ruta", ruta.pop());
})




