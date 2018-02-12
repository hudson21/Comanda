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




