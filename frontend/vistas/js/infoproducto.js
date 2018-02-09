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
    console.log("capturaIndice",capturaIndice);

})


