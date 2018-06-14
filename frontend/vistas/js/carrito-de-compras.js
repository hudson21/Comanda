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

					'<div class="col-sm-1 col-xs-2">'+

						'<br>'+

						'<div class="col-log-12 col-xs-6 carritoCenter">'+
							
							'<button style="z-index:100;"class="btn btn-default backColor quitarItemCarrito" idProducto="'+item.idProducto+'" tipo="'+item.tipo+'" peso="'+item.peso+'">'+
								'<i class="fa fa-times"></i>'+
							'</button>'+

						'</div>'+
						
					'</div>'+

					'<div class=" tituloCarrito col-sm-4 col-xs-8">'+

						'<br>'+

						'<p class="tituloCarritoCompra text-left">'+item.titulo+'</p>'+
						
					'</div>'+

					'<div class="col-md-2 col-sm-3 col-xs-7 ">'+

						'<br>'+

							'<div class="col-xs-8">'+

								'<center>'+
								
								'<input style="margin-bottom:3px" type="number" class="form-control text-center cantidadItem" min="1" value="'+item.cantidad+'"'+
								'  idProducto="'+item.idProducto+'">'+

								//'<input  style="margin-right:5px; font-weight:bold; font-size:16px" type="button" class="btn btn-default btn-success sumar" value="+" >'+

								//'<input  style="font-weight:bold; font-size:16px" type="button" class="btn btn-default btn-danger restar" value="-">'+  

								'</center>'+

							'</div>'+

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

											'<div class="col-lg-4 col-xs-6">'+

												'<h6><strong>EXCEPCIONES:</strong></h6>'+
												
											'</div>'+

											'<div class="col-lg-8 col-sm-12 col-xs-12 ">'+
						
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
  AGREGAR AL CARRITO GRID       
================================================*/
$(".agregarCarrito").click(function(){

	var idProducto = $(this).attr("idProducto");
	var titulo = $(this).attr("titulo");

	var agregarAlCarrito = false;

	/*====================================================================
  		CAPTURAR DETALLES        
	======================================================================*/
		//---------------------------------------------EN GRID

		if($('.cantidadProducto'+idProducto).val() == "" ){

			swal({
						title: "No hay una cantidad",
						text: "",
						type:"warning",
						showCancelButton: false,
						confirmButtonColor:"#DD6B55",
						confirmButtonText:"Aceptar",
						closeOnConfirm: false
					})
		}

		else{

			var valorCantidad = $('.cantidadProducto'+idProducto).val();

			var expresion = /^[0-9]*$/;

			if(!expresion.test(valorCantidad)){

				swal({
						title: "Solo se permiten números",
						text: "",
						type:"warning",
						showCancelButton: false,
						confirmButtonColor:"#DD6B55",
						confirmButtonText:"Aceptar",
						closeOnConfirm: false
						
					})
				document.getElementById('producto'+idProducto).value = "";

			}else{

				agregarAlCarrito = true;

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
					   	   "titulo":titulo,
					   	   "cantidad":valorCantidad});

		

		localStorage.setItem("listaProductos", JSON.stringify(listaCarrito)); 
		//EL JSON.stringgify es para poder convertir a cadena de texto un array

		/*====================================================================
  			ACTUALIZAR CESTA      
		======================================================================*/
		var cantidadCesta = Number($(".cantidadCesta").html()) + 1;
		//var sumaCesta = Number($(".sumaCesta").html()) + Number(precio);

		$(".cantidadCesta").html(cantidadCesta);
		$(".sumaCesta").html("");

		localStorage.setItem("cantidadCesta", cantidadCesta);//Estamos almacenando estas nuevas variables en el localStorage
		//localStorage.setItem("sumaCesta", sumaCesta);//Estamos almacenando estas nuevas variables en el localStorage
	
		/*====================================================================
  			MOSTRAR ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO        
		======================================================================*/
		swal({
				title: "",
				text: "¡Se ha agregado un nuevo producto al carrito de compras",
				type:"success",
				showCancelButton: true,
				confirmButtonColor:"#DD6B55",
				cancelButtonText:"¡Seguir ordenando!",
				confirmButtonText:"¡Ir a mi carrito de compras!",
				closeOnConfirm: false,
				icon: "success"
											  
			},

		function(isConfirm){

			if(isConfirm){
				window.location = rutaOculta+"carrito-de-compras";
			}else{

				document.getElementById('producto'+idProducto).value = "";
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
	
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra"); //De esta manera estamos generando un array de todos los elementos que tenemos dentro de cada una de las variables

	var cantidad = $(".cuerpoCarrito .cantidadItem");

	/*====================================================================
  		SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO (LOCALSTORAGE)        
	======================================================================*/
	listaCarrito = [];//Estoy vaciando el array de listaCarrito

	if(idProducto.length != 0){

		for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			
			var tituloArray = $(titulo[i]).html();
			
			var cantidadArray = $(cantidad[i]).val();
			

			//De esta manera estoy actualizando de nuevo las variables del localStorage
			listaCarrito.push({"idProducto":idProductoArray,
							   "titulo":tituloArray,
					           "cantidad":cantidadArray});
					  
				
			}

			localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

			

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
	var idProducto = $(this).attr("idProducto");

	/*====================================================================
  		ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE        
	======================================================================*/
	var idProducto = $(".cuerpoCarrito button");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var cantidad = $(".cuerpoCarrito .cantidadItem");
	

	listaCarrito = [];//Estoy vaciando el array de listaCarrito

	for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var tituloArray = $(titulo[i]).html();
			var cantidadArray = $(cantidad[i]).val();

			//De esta manera estoy actualizando de nuevo las variables del localStorage
			listaCarrito.push({"idProducto":idProductoArray,
							   "titulo":tituloArray,
					           "cantidad":cantidadArray});
					  
				
			}

			localStorage.setItem("listaProductos", JSON.stringify(listaCarrito)); 

})

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

//==============================================================================================================
$(".seleccioneOrigen").html('<select class="form-control" name="seleccionarOrigen" id="seleccionarOrigen" >'+

							'<option value="">Seleccione el lugar de origen</option>'+
							
						'</select><br>');

$(".seleccioneLugarPreparacion").html('<select class="form-control" name="seleccionarPreparacion" id="seleccionarPreparacion" >'+

							'<option value="">Seleccione el lugar de preparación</option>'+
							
						'</select>');

			


			$(".formEnvio").show();

			$(".btnPagar").attr("tipo","fisico");



			 	/*$.ajax({
						url:rutaOculta+"vistas/js/plugins/origenes.json",
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
						})*/

					


/*==============================================
/*==============================================
/*==============================================       =========> ESTO SIGNIFICA EL INICIO DE UN NUEVO MÓDULO
/*==============================================
/*==============================================
  CHECKOUT       
================================================*/
$("#btnCheckout").click(function(){

	//LUGARES DE ORIGEN
	var datos1 = new FormData();

			datos1.append("lugarOrigen", 1);

			$.ajax({
					
					url:rutaOculta+"ajax/producto.ajax.php",
					method: "POST",
					data: datos1,
					cache: false,
					contentType: false,
					processData: false,
					success:function(respuesta){

					var origen = JSON.parse(respuesta);

					origen.forEach(funcionForEach);

					function funcionForEach(item, index){

				$("#seleccionarOrigen").append('<option value="'+item.id+'">'+item.nombre+'</option>');
					
				  
				}
			}//FIN DE LA RESPUESTA
					
	 		});

	//LUGARES DE PREPARACION
	var datos = new FormData();

			datos.append("lugarPreparacion", 1);

			$.ajax({
					
					url:rutaOculta+"ajax/producto.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success:function(respuesta){

					var preparacion = JSON.parse(respuesta);

					preparacion.forEach(funcionForEach);

					function funcionForEach(item, index){

				$("#seleccionarPreparacion").append('<option value="'+item.id+'">'+item.bares+'</option>');
					
				  
				}
			}//FIN DE LA RESPUESTA
					
	 		});



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
  		VARIABLES ARRAY      
	======================================================================*/

	for (var i = 0; i < titulo.length; i++) {
		
		var tituloArray = $(titulo[i]).html();
		var cantidadArray = $(cantidad[i]).val();


		/*====================================================================  Los td son las columnas
  			MOSTRAR PRODUCTOS DEFINITIVOS A COMPRAR       
		======================================================================*/
		$(".listaProductos table.tablaProductos tbody").append('<tr>'+
															   '<td class="valorTitulo">'+tituloArray+'</td>'+
															   '<td class="valorCantidad">'+cantidadArray+'</td>'+
															   '</tr>');

		

		/*====================================================================  
  			EXISTEN PRODUCTOS FÍSICOS     
		======================================================================*/
		// El find es para poder encontrar un valor deseado dentro de un array ya sea texto o número
		
		
			/*if(tipoArray.find(checkTipo) == "fisico" && a == 0)*/

			

			//$(".seleccioneLugarPreparacion").remove();

			

				
			/*====================================================================  
  				EVALUAR TASAS DE ENVÍO SI EL PRODUCTO ES FÍSICO      
			======================================================================*/
			$("#seleccionarPreparacion").change(function(){
				$(".alert").remove();
			})

			$("#seleccionarOrigen").change(function(){ //Las tasas de las palapas es como si fueran los países

				$(".alert").remove();
			})
} 

})



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

	if($("#seleccionarOrigen").val() == ""){

		$(".btnPagar").after('<div class="alert alert-warning">No ha seleccionado el lugar de origen</div>');
		
		return;
	}

	if($("#seleccionarPreparacion").val() == ""){

		$(".btnPagar").after('<div class="alert alert-warning">No ha seleccionado el lugar de preparación</div>');
		
		return;
	}



	if( $("#seleccionarOrigen").val() != "" && $("#seleccionarPreparacion").val() != ""){


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
		//console.log("listaCarrito", listaCarrito);

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
				datos1.append("disponible",0);

				$.ajax({
					url:rutaOculta+"ajax/usuarios.ajax.php",
					method:"POST",
					data: datos1,
					cache: false,
					contentType: false,
					processData: false,
					success:function(respuesta){
						//console.log("cabecera de pedidos", respuesta);
							
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
	
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra"); //De esta manera estamos generando un array de todos los elementos que tenemos dentro de cada una de las variables
	
	var cantidad = $(".cuerpoCarrito .cantidadItem");
	var excepciones = $(".sumaCarrito excepcionesVal");

	/*====================================================================
  		SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO (LOCALSTORAGE)        
	======================================================================*/
	listaCarrito = [];//Estoy vaciando el array de listaCarrito

	if(idProducto.length != 0){

		for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			
			var tituloArray = $(titulo[i]).html();
			
			
			
			var cantidadArray = $(cantidad[i]).val();
			var excepcionesValor = $(excepciones).val();

			//De esta manera estoy actualizando de nuevo las variables del localStorage
			listaCarrito.push({"idProducto":idProductoArray,
						   
						   "titulo":tituloArray,
						   
					       
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
   }//SI LOCALSTORAGE ES DIFERENTE A NULL

   /*======================================
         IMPRESIÓN DEL TICKET O LOS TICKETS    
   ========================================*/
   var datosImpresion = new FormData();

   datosImpresion.append("pedidoImprimir", localStorage.getItem("numeroPedido"));

   for (var i = 1; i <= localStorage.getItem("numeroCopias"); i++) {

   		$.ajax({

		url: 'vistas/modulos/ticketRespaldo.php',
		method: 'POST',
		data: datosImpresion,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			console.log("respuesta", respuesta);

			/* if(respuesta==1){
			      window.location = rutaOculta;
			 }else{
			      //console.log('response',response);
			  }¨*/
		}

   	 });//FIN DEL AJAX*/
   }
   

		swal({
			title: "¡OK!",
			text: "¡Sus productos se enviaron con éxito!",
			type:"success",
			confirmButtonText:"Ok",
			closeOnConfirm: false,
			icon: "success"
	       },

	function(isConfirm){

	if(isConfirm){
			
		window.location = rutaOculta;
					 
	 	 }//FIN DEL CONFIRM

   	  });//FIN DEL SWALL

    }//SI SELECCIONAR ORIGEN Y PREPARACION SON DIFERENTES DE VACÍO

})//FIN DE LA FUNCIÓN CLICK BTNPAGAR




  






