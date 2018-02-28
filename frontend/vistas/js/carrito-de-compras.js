/*======================================
/*======================================
/*======================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*======================================
/*======================================
  AGREGAR AL CARRITO        
========================================*/

//De esta manera estamos verificando que si la variable del localStorage no viene nula o vacía, le concatenemos lo que está dentro 
//de la variable de listaCarrito
if(localStorage.getItem("listaProductos") != null){

	var listaCarrito = JSON.parse(localStorage.getItem("listaProductos")); 
	//Aquí estamos volviendo a convertir el string guardado dentro de la variable de localStorage listaProductos

}

$(".agregarCarrito").click(function(){

	var idProducto = $(this).attr("idProducto");
	var imagen = $(this).attr("imagen");
	var titulo = $(this).attr("titulo");
	var precio = $(this).attr("precio");
	var tipo = $(this).attr("tipo");
	var peso = $(this).attr("peso");
	var excepciones = $(this).attr("excepciones");

	var agregarAlCarrito = false;

	/*====================================================================
  		CAPTURAR DETALLES        
	======================================================================*/
	if(tipo == "virtual"){

		agregarAlCarrito = true;

	}else{

		var seleccionarDetalle = $(".seleccionarDetalle");//Estoy almacenando varios detalles

		for(var i = 0; i < seleccionarDetalle.length; i++){

			if($(seleccionarDetalle[i]).val() == ""){

				swal({
						title: "Debe seleccionar Talla y Color",
						text: "",
						type:"warning",
						showCancelButton: false,
						confirmButtonColor:"#DD6B55",
						confirmButtonText:"¡Seleccionar!",
						closeOnConfirm: false
					})

			}else{

				titulo = titulo + "-" + $(seleccionarDetalle[i]).val();

				agregarAlCarrito = true;
			}

		}

	}

	/*====================================================================
  		ALMACENAR EN EL LOCALSTORAGE LOS PRODUCTOS 	AGREGADOS AL CARRITO        
	======================================================================*/
	if(agregarAlCarrito){

		/*====================================================================
  			RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE        
		======================================================================*/
		if(localStorage.getItem("listaProductos") == null){ //Si la variable del localStorage está vacía o nula que la deje como está

			listaCarrito = [];

		}else{

			listaCarrito.concat(localStorage.getItem("listaProductos"));
		}

		listaCarrito.push({"idProducto":idProducto, 
					   "imagen":imagen, 
					   "titulo":titulo,
					   "precio":precio,
					   "tipo":tipo, 
					   "peso":peso, 
					   "excepciones":excepciones,
					   "cantidad":"1"});

		

		localStorage.setItem("listaProductos", JSON.stringify(listaCarrito)); 
		//EL JSON.stringgify es para poder convertir a cadena de texto un array
}

	

})