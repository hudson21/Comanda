/*------------------------------------------------
   CABEZOTE
------------------------------------------------*/
$("#btnCategorias").click(function(){

  /*Examinamos la resolución de pantalla del dispositivo, 
    y  si es de un teléfono que tiene hasta un máximo de 767 píxeles
    hacemos un matches para que la caja de categorías se ejecute después del
    botón de btnCategorias*/
	if(window.matchMedia("(max-width:767px)").matches){

		$("#btnCategorias").after($("#categorias").slideToggle("fast"))
	
	}else{

   /*En este caso estamos le decimos que se abra después del cabezote*/
		$("#cabezote").after($("#categorias").slideToggle("fast"))

	}

		
})