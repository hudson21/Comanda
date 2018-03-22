/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
 	VISUALIZAR LA CESTA DEL CARRITO DE COMPRAS     
================================================*/
if(localStorage.getItem("cantidadCesta") != null){

	$(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));
	$(".sumaCesta").html(localStorage.getItem("sumaCesta"));

}else{

	$(".cantidadCesta").html("0");
	$(".sumaCesta").html("0");
}


/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
 	VISUALIZAR LOS PRODUCTOS EN LA PÁGINA CARRITO DE COMPRAS     
================================================*/

//De esta manera estamos verificando que si la variable del localStorage no viene nula o vacía, le concatenemos lo que está dentro 
//de la variable de listaCarrito
if(localStorage.getItem("listaProductos") != null){

	var listaCarrito = JSON.parse(localStorage.getItem("listaProductos")); 
	//Aquí estamos volviendo a convertir el string guardado dentro de la variable de localStorage listaProductos

	listaCarrito.forEach(funcionForEach);
	//Dentro de Javascript se le hace el foreach a una función no a un objeto en específico como en PHP

	function funcionForEach(item, index){
		
		$(".cuerpoCarrito").append(
				
				'<div class="row itemCarrito">'+

					'<div class="col-sm-1 col-xs-12">'+

						'<br>'+

						'<center>'+
							
							'<button class="btn btn-default backColor quitarItemCarrito" idProducto="'+item.idProducto+'" tipo="'+item.tipo+'" peso="'+item.peso+'">'+
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

	$(".sumaCarrito .excepciones").append('<div class="col-md-5 col-sm-6 col-xs-12 pull-left well">'+

											'<div class="col-xs-4">'+

												'<h6><strong>EXCEPCIONES:</strong></h6>'+
												
											'</div>'+

											'<div class="col-xs-8 ">'+
						
						'<textarea class="form-control excepcionesVal" rows="5" id="comentario" excepciones="'+item.excepciones+'" value="" name="comentario" maxlength="300"></textarea>'+

					'</div'+		
					
				'</div>');	
	  
}else{ //Si el localStorage está vacío

	$(".cuerpoCarrito").html('<div style="font-size:16px"class="well text-center"><strong>Aún no hay productos en el carrito de compras.</strong></div>');
	$(".sumaCarrito").hide();
	$(".cabeceraCheckout").hide();


}

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  AGREGAR AL CARRITO        
================================================*/
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
  		ALMACENAR EN EL LOCALSTORAGE LOS PRODUCTOS AGREGADOS AL CARRITO        
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

		/*====================================================================
  			ACTUALIZAR CESTA      
		======================================================================*/
		var cantidadCesta = Number($(".cantidadCesta").html()) + 1;
		var sumaCesta = Number($(".sumaCesta").html()) + Number(precio);

		$(".cantidadCesta").html(cantidadCesta);
		$(".sumaCesta").html(sumaCesta);

		localStorage.setItem("cantidadCesta", cantidadCesta);//Estamos almacenando estas nuevas variables en el localStorage
		localStorage.setItem("sumaCesta", sumaCesta);//Estamos almacenando estas nuevas variables en el localStorage
	
		/*====================================================================
  			MOSTRAR ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO        
		======================================================================*/
		swal({
				title: "",
				text: "¡Se ha agregado un nuevo producto al carrito de compras",
				type:"success",
				showCancelButton: true,
				confirmButtonColor:"#DD6B55",
				cancelButtonText:"¡Continuar comprando!",
				confirmButtonText:"¡Ir a mi carrito de compras!",
				closeOnConfirm: false,
				icon: "success"
											  
			},

		function(isConfirm){

			if(isConfirm){
				window.location = rutaOculta+"carrito-de-compras";
			}
		});

    }


})


/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
 	QUITAR PRODUCTOS DEL CARRITO    
================================================*/
$(".quitarItemCarrito").click(function(){

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

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
 GENERAR SUBTOTAL DESPUÉS DE CAMBIAR CANTIDAD      
================================================*/
$(".cantidadItem").change(function(){ //Dentro de cantidad item vamos a capturar todos los atributos personalizados que creamos dentro de este elemento

	var cantidad = $(this).val();
	var precio = $(this).attr("precio");
	var idProducto = $(this).attr("idProducto");

	$(".subTotal"+idProducto).html('<strong>USD $<span>'+(cantidad*precio)+'</span></strong>');

	/*====================================================================
  		ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE        
	======================================================================*/
	var idProducto = $(".cuerpoCarrito button");
	var imagen = $(".cuerpoCarrito img");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var precio = $(".cuerpoCarrito .precioCarritoCompra span");
	var cantidad = $(".cuerpoCarrito .cantidadItem");
	var excepciones = $(".sumaCarrito excepcionesVal");

	listaCarrito = [];//Estoy vaciando el array de listaCarrito

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
})

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
 ACTUALIZAR SUBTOTAL     
================================================*/
var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");
var cantidadItem = $(".cuerpoCarrito .cantidadItem");

for(var i = 0; i < precioCarritoCompra.length; i++){

	var precioCarritoCompraArray = $(precioCarritoCompra[i]).html();
	var cantidadItemArray = $(cantidadItem[i]).val();
	var idProductoArray = $(cantidadItem[i]).attr("idProducto");

	$(".subTotal"+idProductoArray).html('<strong>USD $<span>'+(precioCarritoCompraArray*cantidadItemArray)+'</span></strong>');

	sumaSubtotales();
	cestaCarrito(precioCarritoCompra.length);

}


/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
 SUMA DE TODOS LOS SUBTOTALES     
================================================*/
function sumaSubtotales(){

	var subtotales = $(".subtotales span");
	var arraySumaSubtotales = [];
	
	for(var i = 0; i < subtotales.length; i++){

		var subtotalesArray = $(subtotales[i]).html();
		arraySumaSubtotales.push(Number(subtotalesArray));
		
	}

	
	function sumaArraySubtotales(total, numero){

		return total + numero;

	}

	//El método de reduce sirve para reducir todos los valores de un array a uno solo a través de una suma total en todas sus posiciones
	var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales);
	
	$(".sumaSubTotal").html('<strong>USD $<span>'+sumaTotal+'</span></strong>');

	$(".sumaCesta").html(sumaTotal);

	localStorage.setItem("sumaCesta", sumaTotal); 

}

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
 ACTUALIZAR CESTA AL CAMBIAR CANTIDAD     
================================================*/
function cestaCarrito(cantidadProductos){

	/*=============================================
	SI HAY PRODUCTOS EN EL CARRITO
	=============================================*/
	if(cantidadProductos != 0){
		
		var cantidadItem = $(".cuerpoCarrito .cantidadItem");

		var arraySumaCantidades = [];
	
		for(var i = 0; i < cantidadItem .length; i++){

			var cantidadItemArray = $(cantidadItem[i]).val();
			arraySumaCantidades.push(Number(cantidadItemArray));
			
		}
	
		function sumaArrayCantidades(total, numero){

			return total + numero;

		}

		var sumaTotalCantidades = arraySumaCantidades.reduce(sumaArrayCantidades);
		
		$(".cantidadCesta").html(sumaTotalCantidades );
		localStorage.setItem("cantidadCesta", sumaTotalCantidades);

	}

}


/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  CHECKOUT       
================================================*/
$("#btnCheckout").click(function(){

	$(".listaProductos table.tablaProductos tbody").html("");//Esto es para que no se repitan los productos nuevamente en la 
															 //ventana modal del checkout

	var idUsuario = $(this).attr("idUsuario");
	var peso = $(".cuerpoCarrito button");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");//Todas estas variables son arrays
	var cantidad = $(".cuerpoCarrito .cantidadItem");
	var subtotal = $(".cuerpoCarrito .subtotales span");
	var tipoArray = [];
	var cantidadPeso = [];


	/*====================================================================  
  		SUMA SUBTOTAL     
	======================================================================*/
	var sumaSubTotal = $(".sumaSubTotal span");
	
	$(".valorSubTotal").html($(sumaSubTotal).html());
	$(".valorSubTotal").attr("valor",$(sumaSubTotal).html());

	/*====================================================================  
  		TASAS DE IMPUESTO     
	======================================================================*/
	var impuestoTotal = ($(".valorSubTotal").html() * $("#tasaImpuesto").val())/100;

	$(".valorTotalImpuesto").html(impuestoTotal.toFixed(2));
	$(".valorTotalImpuesto").attr("valor",impuestoTotal.toFixed(2));

	sumaTotalCompra();

	/*====================================================================  
  		VARIABLES ARRAY      
	======================================================================*/

	for (var i = 0; i < titulo.length; i++) {
		
		var pesoArray = $(peso[i]).attr("peso");
		var tituloArray = $(titulo[i]).html();
		var cantidadArray = $(cantidad[i]).val();
		var subtotalArray = $(subtotal[i]).html();


		/*====================================================================  
  			EVALUAR EL PESO DE ACUERDO A LA CANTIDAD DE PRODUCTOS      
		======================================================================*/
		cantidadPeso[i] = pesoArray * cantidadArray;
		
		function sumaArrayPeso(total, numero){

			return total + numero;

		}

		var sumaTotalPeso = cantidadPeso.reduce(sumaArrayPeso);
		//console.log("sumaTotalPeso", sumaTotalPeso);

		/*====================================================================  Los td son las columnas
  			MOSTRAR PRODUCTOS DEFINITIVOS A COMPRAR       
		======================================================================*/
		$(".listaProductos table.tablaProductos tbody").append('<tr>'+
															   '<td class="valorTitulo">'+tituloArray+'</td>'+
															   '<td class="valorCantidad">'+cantidadArray+'</td>'+
															   '<td>$<span class="valorItem" valor="'+subtotalArray+'">'+subtotalArray+'</span></td>'+
															   '</tr>');

		/*====================================================================  
  			SELECCIONAR PALAPA DE ENVÍO SI HAY PRODUCTOS FÍSICOS       
		======================================================================*/
		tipoArray.push($(cantidad[i]).attr("tipo"));
		
		function checkTipo(tipo){

			return tipo == "fisico";
		}

		/*====================================================================  
  			EXISTEN PRODUCTOS FÍSICOS     
		======================================================================*/
		// El find es para poder encontrar un valor deseado dentro de un array ya sea texto o número
		if(tipoArray.find(checkTipo) == "fisico"){

			$(".seleccioneOrigen").html('<select class="form-control" name="seleccionarOrigen" id="seleccionarOrigen" >'+

							'<option value="">Seleccione el lugar de origen</option>'+
							
						'</select><br>');

			$(".seleccioneLugarPreparacion").html('<select class="form-control" name="seleccionarPreparacion" id="seleccionarPreparacion" >'+

							'<option value="">Seleccione el lugar de preparación</option>'+
							
						'</select>');

			$(".formEnvio").show();

			$(".btnPagar").attr("tipo","fisico");

			
			
					$.ajax({
						url:rutaOculta+"vistas/js/plugins/origenes.json",/*De esta manera estoy llamando a un archivo json a través
		                    												de esta petición Ajax*/
						type: "GET",
						cache: false,
						contentType: false,
						processData:false,
						dataType:"json",
						success: function(respuesta){
							
							respuesta.forEach(seleccionarPalapa);

							function seleccionarPalapa(item, index){

								var pais = item.name;
								var codPais = item.code;
								$("#seleccionarOrigen").append('<option value="'+codPais+'">'+pais+'</option>');
							  }

						    }
					})

					$.ajax({
						url:rutaOculta+"vistas/js/plugins/preparacion.json",/*De esta manera estoy llamando a un archivo json a través
		                    												de esta petición Ajax*/
						type: "GET",
						cache: false,
						contentType: false,
						processData:false,
						dataType:"json",
						success: function(respuesta){
							
							respuesta.forEach(seleccionarPalapa);

							function seleccionarPalapa(item, index){

								var bar = item.name;
								var codigo = item.code;
								$("#seleccionarPreparacion").append('<option value="'+codigo+'">'+bar+'</option>');
							  }

						    }
					})
			/*====================================================================  
  				EVALUAR TASAS DE ENVÍO SI EL PRODUCTO ES FÍSICO      
			======================================================================*/
			$("#seleccionarPreparacion").change(function(){
				$(".alert").remove();
			})

			$("#seleccionarOrigen").change(function(){ //Las tasas de las palapas es como si fueran los países

				$(".alert").remove();

				var pais = $(this).val();
				var tasaPais = $("#tasaPais").val();

				if(pais == tasaPais){ //Si país es igual a tasaPais significa que estará en el mismo país

					var resultadoPeso = sumaTotalPeso * $("#envioNacional").val();

					if(resultadoPeso < $("#tasaMinimaNacional").val()){

						$(".valorTotalEnvio").html($("#tasaMinimaNacional").val());
						$(".valorTotalEnvio").attr("valor",$("#tasaMinimaNacional").val());

					}else{

						$(".valorTotalEnvio").html(resultadoPeso);
						$(".valorTotalEnvio").attr("valor",resultadoPeso);

					}

				}else{ //Si país es diferente a tasa país (que es el país local que donde se establecen los impuestos mínimos)

					var resultadoPeso = sumaTotalPeso * $("#envioInternacional").val();

					if(resultadoPeso < $("#tasaMinimaInternacional").val()){

						$(".valorTotalEnvio").html($("#tasaMinimaInternacional").val());
						$(".valorTotalEnvio").attr("valor",$("#tasaMinimaInternacional").val());

					}else{

						$(".valorTotalEnvio").html(resultadoPeso);
						$(".valorTotalEnvio").attr("valor",resultadoPeso);

					}

				}

				/*====================================================================  
  					RETORNAR EL CAMBIO DE DIVISA A USD    
				======================================================================*/

				$("#cambiarDivisa").val("USD");

				$(".cambioDivisa").html("USD");

				$(".valorSubtotal").html((1 * Number($(".valorSubtotal").attr("valor"))).toFixed(2))
		    	$(".valorTotalEnvio").html((1 * Number($(".valorTotalEnvio").attr("valor"))).toFixed(2))
		    	$(".valorTotalImpuesto").html((1 * Number($(".valorTotalImpuesto").attr("valor"))).toFixed(2))
		    	$(".valorTotalCompra").html((1 * Number($(".valorTotalCompra").attr("valor"))).toFixed(2))

		    	var valorItem = $(".valorItem");

		    	for(var i = 0; i < valorItem.length; i++){

		    		$(valorItem[i]).html((1 * Number($(valorItem[i]).attr("valor"))).toFixed(2))
		    	 }

				sumaTotalCompra();

			})

		}else{

				$(".btnPagar").attr("tipo","virtual");
				
		}
	}
})

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  SUMA TOTAL DE LA COMPRA       
================================================*/
function sumaTotalCompra(){

	var sumaTotalTasas = Number($(".valorSubTotal").html())+
						  Number($(".valorTotalEnvio").html())+
						  Number($(".valorTotalImpuesto").html());

	$(".valorTotalCompra").html(sumaTotalTasas.toFixed(2));
	$(".valorTotalCompra").attr("valor",sumaTotalTasas.toFixed(2));

}

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  MÉTODO DE PAGO PARA CAMBIO DE DIVISA      
================================================*/

var metodoPago = "paypal";
divisas(metodoPago);

$("input[name='pago']").change(function(){

	var metodoPago = $(this).val();

	divisas(metodoPago);


})

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  FUNCIÓN PARA EL CAMBIO DE DIVISA      
================================================*/
function divisas(metodoPago){

	$("#cambiarDivisa").html("");

	if(metodoPago == "paypal"){

		$("#cambiarDivisa").append('<option value="USD">USD</option>'+
								   '<option value="EUR">EUR</option>'+
								   '<option value="GBP">GBP</option>'+
								   '<option value="MXN">MXN</option>'+
								   '<option value="JPY">JPY</option>'+
								   '<option value="CAD">CAD</option>'+
								   '<option value="BRL">BRL</option>');

	}else{

		$("#cambiarDivisa").append('<option value="USD">USD</option>'+
								   '<option value="PEN">PEN</option>'+
								   '<option value="COP">COP</option>'+
								   '<option value="MXN">MXN</option>'+
								   '<option value="CLP">CLP</option>'+
								   '<option value="ARS">ARS</option>'+
								   '<option value="BRL">BRL</option>');
	}
}

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  CAMBIO DE DIVISA       
================================================*/
var divisaBase = "USD";

$("#cambiarDivisa").change(function(){

	$(".alert").remove();

	if($("#seleccionarOrigen").val() == ""){

		$("#cambiarDivisa").after('<div class="alert alert-warning">No ha seleccionado el lugar de origen</div>');

		return;

	}

	if($("#seleccionarPreparacion").val() == ""){

		$("#cambiarDivisa").after('<div class="alert alert-warning">No ha seleccionado el lugar de preparación</div>');

		return;

	}

	var divisa = $(this).val();

	$.ajax({
		url:"http://free.currencyconverterapi.com/api/v3/convert?q="+divisaBase+"_"+divisa+"&compact=y",
		type:"GET",
		cache: false,
		contentType: false,
		processData: false,
		dataType:"jsonp",//Es la opción para poder traer información de otro servidor que está almacenado en otra URL
		success:function(respuesta){
			
			var divisaString = JSON.stringify(respuesta);
			var conversion = divisaString.substr(18,4);//Quitamos 18 caracteres y luego requerimos 4

			if(divisa == "USD"){

				conversion = 1;
			}
			
			$(".cambioDivisa").html(divisa);

			$(".valorSubtotal").html((Number(conversion) * Number($(".valorSubtotal").attr("valor"))).toFixed(2))
	    	$(".valorTotalEnvio").html((Number(conversion) * Number($(".valorTotalEnvio").attr("valor"))).toFixed(2))
	    	$(".valorTotalImpuesto").html((Number(conversion) * Number($(".valorTotalImpuesto").attr("valor"))).toFixed(2))
	    	$(".valorTotalCompra").html((Number(conversion) * Number($(".valorTotalCompra").attr("valor"))).toFixed(2))

	    	var valorItem = $(".valorItem");

	    	for(var i = 0; i < valorItem.length; i++){

	    		$(valorItem[i]).html((Number(conversion) * Number($(valorItem[i]).attr("valor"))).toFixed(2))
	    	 }

		}

	})
})


/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  BOTÓN PAGAR       
================================================*/
$(".btnPagar ").click(function(){

	var tipo = $(this).attr("tipo");

	if(tipo == "fisico" && $("#seleccionarOrigen").val() == ""){

		$(".btnPagar").after('<div class="alert alert-warning">No ha seleccionado el lugar de origen</div>');

		return;
	}

	if(tipo == "fisico" && $("#seleccionarPreparacion").val() == ""){

		$(".btnPagar").after('<div class="alert alert-warning">No ha seleccionado el lugar de preparación</div>');

		return;
	}

	var divisa = $("#cambiarDivisa").val();
	var total = $(".valorTotalCompra").html();
	var impuesto = $(".valorTotalImpuesto").html();
	var envio = $(".valorTotalEnvio").html();
	var subtotal = $(".valorSubtotal").html();
	var titulo = $(".valorTitulo").html();
	var cantidad = $(".valorCantidad").html();
	var valorItem = $(".valorItem").html();


})

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  CAMBIARLE ESTILOS AL BOTÓN DE PAGAR       
================================================*/

if(window.matchMedia("(max-width:767px)").matches){
	$(".btnPagar").removeClass("btn-block");
	$(".btnPagar").addClass("btnPagarCelular");
}


/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  AGREGAR A LA LISTA DE PEDIDOS       
================================================*/
$(".btnPagar ").click(function(){

	$(".alert").remove();

	var combo = document.getElementById("seleccionarOrigen");
	var combo1 = document.getElementById("seleccionarPreparacion");


	var tipo = $(this).attr("tipo");

	if(tipo == "fisico" && $("#seleccionarOrigen").val() == ""){

		$(".btnPagar").after('<div class="alert alert-warning">No ha seleccionado el lugar de origen</div>');
		
		return;
	}

	if(tipo == "fisico" && $("#seleccionarPreparacion").val() == ""){

		$(".btnPagar").after('<div class="alert alert-warning">No ha seleccionado el lugar de preparación</div>');
		
		return;
	}

	if(tipo == "virtual" && combo == null || tipo == "fisico" && $("seleccionarOrigen").val() != "" 
	|| tipo == "fisico" && $("seleccionarPreparacion").val() != ""){

			swal({
			title: "¡OK!",
			text: "¡Sus productos ya se encuentran en la lista de pedidos!",
			type:"success",
			confirmButtonText:"Ok",
			closeOnConfirm: false,
			icon: "success"
	             },

	function(isConfirm){

		if(isConfirm){
					 window.location = rutaOculta+"pedidos";
					 }
				});

	if(localStorage.getItem("listaProductos") != null){

	var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));
	//console.log("listaCarrito", listaCarrito[1]);


	/*============================================================================================================  
  		INSERTAR LOS REGISTROS EN LA TABLA DE PEDIDOS DE LOS PRODUCTOS YA CONFIRMADOS A TRAVÉS DE AJAX    
	==============================================================================================================*/	
		var datos = new FormData();
		var datos1 = new FormData();
		
    		

    		if(combo == null){
    			var origen = "";
    		}
    		else{
    			 origen = combo.options[combo.selectedIndex].text;
    		}

    		if(combo1 == null){
    			var preparacion = "";
    		}
    		else{
    			 preparacion = combo1.options[combo.selectedIndex].text;
    		}
		
			comentario = document.getElementById("comentario").value;

		//console.log(comentario);


		var idUsuarioPedido = localStorage.getItem("usuario");
		console.log("listaCarrito", listaCarrito);

		var nombreUsuario = localStorage.getItem("nombreUsuario");

		var numeroPedido = localStorage.getItem("numeroPedido"); 
		//console.log("Tipos de producto", listaCarrito["tipo"]);

		for (var i = 0; i < listaCarrito.length; i++) {

			if(i==0){ //Esta opción funciona bien :)
				datos.append("idProductoPedidos", listaCarrito[i]["idProducto"]);
				datos.append("cantidad", listaCarrito[i]["cantidad"]);
				datos.append("numeroPedido", numeroPedido);



				// ====== ESTA ES LA PETICION AJAX PARA LA TABLA DE CABECERA DE PEDIDOS======
				datos1.append("idUsuarioPedidos", idUsuarioPedido);
				datos1.append("nombreUsuario", nombreUsuario);
				datos1.append("origen", origen);
				datos1.append("lugarPreparacion", preparacion);
				datos1.append("excepciones", comentario)
				if(comentario == ""){
					datos1.append("mostrar", 0);
				}else{
					datos1.append("mostrar", 1);
				}
				datos1.append("estado",0);

				$.ajax({
					url:rutaOculta+"ajax/usuarios.ajax.php",
					method:"POST",
					data: datos1,
					cache: false,
					contentType: false,
					processData: false,
					success:function(respuesta){
						console.log("cabecera de pedidos", respuesta);
							
					}

			   })
			    // ====== FSTE ES EL FINAL DE LA TABLA DE CABECERA DE PEDIDOS======

			}else{

				datos.append("idProductoPedidos", listaCarrito[i]["idProducto"]);
				datos.append("cantidad", listaCarrito[i]["cantidad"]);
				datos.append("numeroPedido", numeroPedido);
				
			   }

			$.ajax({
					url:rutaOculta+"ajax/usuarios.ajax.php",
					method:"POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success:function(respuesta){
						//console.log("linea de pedidos", respuesta);
							
					}

			   })  
					
	}

	$(".quitarItemCarrito").parent().parent().parent().remove();

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
}

}

})

/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
 	QUITAR PRODUCTOS DE LA LISTA DE PEDIDOS   
================================================*/
$(".quitarItemPedido").click(function(){

	$(this).parent().parent().parent().remove();

	var idProductoPedidoEliminar = $(this).attr("noPedido");
	//console.log("idProductoPedidoEliminar", idProductoPedidoEliminar);

	var datos = new FormData();
	datos.append("idProductoPedidoEliminar", idProductoPedidoEliminar);

	$.ajax({
			 url:rutaOculta+"ajax/usuarios.ajax.php",
			 method:"POST",
			 data: datos,
			 cache: false,
			 contentType: false,
			 processData: false,
			 success:function(respuesta){
				//console.log("respuesta",respuesta);
			 }

			})


})

/*===================================================
/*===================================================
/*===================================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*===================================================
/*===================================================
 AGREGANDO Y QUITANDO CLASE A LOS BOTONES DE ESTADO   
=====================================================*/

var contarPedidos = localStorage.getItem("contarPedidos");
console.log("contarPedidos", contarPedidos);


	
$(".btnPreparando").click(function(){

	for (var i = 1; i <= contarPedidos; i++) {

	var datos = new FormData();
	var idProductoPedidoEliminar = $(this).attr("noPedido");
	console.log("idPedidoActualizar", idProductoPedidoEliminar);

	datos.append("estadoPedido", 1);
	datos.append("numeroPedido",idProductoPedidoEliminar);

	$.ajax({
			 url:rutaOculta+"ajax/usuarios.ajax.php",
			 method:"POST",
			 data: datos,
			 cache: false,
			 contentType: false,
			 processData: false,
			 success:function(respuesta){

			 }

			})

		if(i==idProductoPedidoEliminar){

			$("#preparando"+i).removeClass("fa-clock-o");
			$("#preparando"+i).addClass("fa-check");

			$("#listo"+i).addClass("fa-clock-o");

		}
	

	}
})


$(".btnListo").click(function(){
	
	for (var i = 1; i <= contarPedidos; i++) {

	var datos = new FormData();
	var idProductoPedidoEliminar = $(this).attr("noPedido");
	console.log("idPedidoActualizar", idProductoPedidoEliminar);

	datos.append("estadoPedido", 2);
	datos.append("numeroPedido",idProductoPedidoEliminar);

	$.ajax({
			 url:rutaOculta+"ajax/usuarios.ajax.php",
			 method:"POST",
			 data: datos,
			 cache: false,
			 contentType: false,
			 processData: false,
			 success:function(respuesta){

			 }

			})

		if(i==idProductoPedidoEliminar){

			$("#listo"+i).removeClass("fa-clock-o");
			$("#listo"+i).addClass("fa-check");

		}
	

	}
})


