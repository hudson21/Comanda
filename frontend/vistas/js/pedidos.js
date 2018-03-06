if(localStorage.getItem("listaProductos") != null){

	var listaCarrito = JSON.parse(localStorage.getItem("listaProductos")); 
	//Aquí estamos volviendo a convertir el string guardado dentro de la variable de localStorage listaProductos

	listaCarrito.forEach(funcionForEach);
	//Dentro de Javascript se le hace el foreach a una función no a un objeto en específico como en PHP

	function funcionForEach(item, index){
		
		$(".cuerpoPedidos").append(
				
				'<div class="row itemPedidos">'+

					'<div class="col-sm-1 col-xs-12">'+

						'<br>'+

						'<center>'+
							
							'<button class="btn btn-default backColor quitarItemPedidos" idProducto="'+item.idProducto+'" tipo="'+item.tipo+'" peso="'+item.peso+'">'+
								'<i class="fa fa-times"></i>'+
							'</button>'+

						'</center>'+
						
					'</div>'+

					'<div class="col-sm-1 col-xs-12">'+
						
						'<figure>'+
							
							'<img src="'+item.imagen+'" class="img-thumbnail">'+

						'</figure>'+

					'</div>'+

					'<div class="col-sm-4 col-xs-12">'+

						'<br>'+

						'<p class="tituloCarritoCompra text-left">'+item.titulo+'</p>'+
						
					'</div>'+

					'<div class="col-md-2 col-sm-1 col-xs-12">'+

						'<br>'+

						'<p class="precioCarritoCompra text-center">USD $<span>'+item.precio+'</span></p>'+
						

					'</div>'+

					'<div class="col-md-2 col-sm-3 col-xs-8 ">'+

						'<br>'+

							'<div class="col-xs-8">'+

								'<center>'+
								
								'<input style="margin-bottom:3px" type="number" class="form-control text-center cantidadItem" min="1" value="'+item.cantidad+'" tipo="'+item.tipo+
								'" precio="'+item.precio+'" idProducto="'+item.idProducto+'">'+

								//'<input  style="margin-right:5px; font-weight:bold; font-size:16px" type="button" class="btn btn-default btn-success sumar" value="+" >'+

								//'<input  style="font-weight:bold; font-size:16px" type="button" class="btn btn-default btn-danger restar" value="-">'+  

								'</center>'+

							'</div>'+

					'</div>'+

					'<div class="col-md-2 col-sm-1 col-xs-4 subtotal">'+

						'<br>'+

						'<p class="subTotal'+item.idProducto+' subtotales">'+
							
							'<strong>USD $<span>'+item.precio+'</span></strong>'+

						'</p>'+
						
					'</div>'+
					
				'</div>'+


				'<div class="clearfix"></div>'+

				'<hr>');

		/*====================================================================
  			EVITAR MANIPULAR LA CANTIDAD EN PRODUCTOS VIRTUALES        
		======================================================================*/
		$(".cantidadItem[tipo='virtual']").attr("readonly", "true");

	}

	$(".sumaPedidos .excepciones").append('<div class="col-md-5 col-sm-6 col-xs-12 pull-left well">'+

											'<div class="col-xs-4">'+

												'<h6><strong>EXCEPCIONES:</strong></h6>'+
												
											'</div>'+

											'<div class="col-xs-8 ">'+
						
						'<textarea class="form-control excepcionesVal" rows="5" id="comentario" excepciones="'+item.excepciones+'" name="comentario" maxlength="300" required></textarea>'+

					'</div'+		
					
				'</div>');	
	  
}else{ //Si el localStorage está vacío

	$(".cuerpoPedidos").html('<div style="font-size:16px"class="well text-center"><strong>Aún no hay productos en la lista de pedidos.</strong></div>');
	$(".sumaPedidos").hide();
	


}

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
 	QUITAR PRODUCTOS DEL CARRITO    
================================================*/
$(".quitarItemPedidos").click(function(){

	$(this).parent().parent().parent().remove();

	var idProducto = $(".cuerpoCarrito button");
	var imagen = $(".cuerpoCarrito img");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra"); //De esta manera estamos generando un array de todos los elementos que tenemos dentro de cada una de las variables
	var precio = $(".cuerpoCarrito .precioCarritoCompra span");
	var cantidad = $(".cuerpoCarrito .cantidadItem");
	var excepciones = $(".sumaCarrito excepcionesVal");

	/*====================================================================
  		SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO (LOCALSTORAGE)        
	======================================================================*/
	listaCarrito = [];//Estoy vaciando el array de listaCarrito

	if(idProducto.length != 0){

		for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var imagenArray = $(imagen[i]).attr("src");
			var tituloArray = $(titulo[i]).html();
			var precioArray = $(precio[i]).html();
			var pesoArray = $(idProducto[i]).attr("peso");
			var tipoArray = $(cantidad[i]).attr("tipo");
			var cantidadArray = $(cantidad[i]).val();
			var excepcionesValor = $(excepciones).val();

			//De esta manera estoy actualizando de nuevo las variables del localStorage
			listaCarrito.push({"idProducto":idProductoArray,
						   "imagen":imagenArray,
						   "titulo":tituloArray,
						   "precio":precioArray,
					       "tipo":tipoArray,
				           "peso":pesoArray,
				           "excepciones":excepcionesValor,
				           "cantidad":cantidadArray});
					  
				
			}

			localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

			sumaSubtotales();
			cestaCarrito(listaCarrito.length); 
	
	}else{

		/*====================================================================
  			SI YA NO QUEDAN PRODUCTOS, HAY QUE REMOVER TODO        
		======================================================================*/
		localStorage.removeItem("listaProductos");

		localStorage.setItem("cantidadCesta","0");

		localStorage.setItem("sumaCesta","0");

		$(".cantidadCesta").html("0");
		$(".sumaCesta").html("0");

		$(".cuerpoCarrito").html('<div style="font-size:16px"class="well text-center"><strong>Aún no hay productos en el carrito de compras.</strong></div>');
		$(".sumaCarrito").hide();
		$(".cabeceraCheckout").hide();

	}

})