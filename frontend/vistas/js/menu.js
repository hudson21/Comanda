
 
var contador = 1;
 

	$('.menu_bar').click(function(){
		if (contador == 1) {
			$('nav').animate({
				left: '-100%'
			});
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				left: '0%'
			});
		}
	});
 
	// Mostramos y ocultamos submenus
	$('.submenu').click(function(){
		$(this).children('.children').slideToggle();
	});
