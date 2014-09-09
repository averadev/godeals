// JavaScript Document
var originalDate = "";

$("#btnagregarCupon").click(function() { agregarCupon(); });
$(document).on('click','#modificarDescription',function(){ muestraDatos(this); });
$('#btnguardarCupon').click(function() { GuardarCupon(); });
$('#btnRegistrarCupon').click(function() { registrarCupon(); });
$("#btnCancelar").click(function() {CancelarForm()});
$(document).on('click','#imageDelete',function(){ eliminarCoupon(this); });
$("#btnAceptarE").click(function() {AceptarEliminar(this)});
$("#btnCancelarE").click(function() {CancelarEliminar()});
$("#imgImagen").click(function() {cambiarImagen()});

$("#txtPartner").keyup(function() { autocompletar("partner"); });
$("#txtCity").keyup(function() { autocompletar("city"); });

//visualizar imagen

	$(window).load(function(){
 $(function() {
  $('#fileImagen').change(function(e) {
	  $('#alertImage').hide();
	  $('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]");
	  if($('#imagenName').val() != 0){
		 $('#imgImagen').attr("src",URL_IMG + "app/coupon/max/" + $('#imagenName').val())
	  }
      addImage(e); 
     });

     function addImage(e){
      var file = e.target.files[0],
      imageType = /image.*/;
    
      if (!file.type.match(imageType)){
		  $('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]");
		  document.getElementById('fileImagen').value ='';
		  if($('#imagenName').val() != 0){
			  $('#imgImagen').attr("src",URL_IMG + "app/coupon/max/" + $('#imagenName').val())
		  } else {
			  $('#alertImage').empty();
			  $('#alertImage').append("Selecione una imagen");
			  $('#alertImage').show();
		  }
       return;
	  }
  
      var reader = new FileReader();
      reader.onload = fileOnload;
      reader.readAsDataURL(file);
     }
  
     function fileOnload(e) {
      var result=e.target.result;
      $('#imgImagen').attr("src",result);
     }
    });
  });

// fin visualizar imagen

 //polanco

function autocompletar(elemento){
    url = '';
    palabra = '';
    datalist = '';
     
    switch(elemento){
		case 'partner':            
			palabra = $("#txtPartner").val();
			url = "../admin/partners/getallSearch";
			datalist = "partnerList";
			break;
        case 'city':
			palabra = $("#txtCity").val();
			url = "../admin/cities/getallSearch";
			datalist = "cityList";
    }
	buscadorAutocomplete(palabra, url, datalist);//busca las palabras que tengan la palabra
}

function buscadorAutocomplete( palabra, url, datalist){
	$.ajax({
		type: "POST",
		url: url,
		dataType:'json',
		data: {
			dato:palabra
		},
		success: function(data){
			console.log(data);
			datosObtenidos = '';
			switch(datalist){
				case 'partnerList':
					$('#partnerList').empty();
					for(var i = 0;i<data.length;i++){
						$('#partnerList').append(
							"<option id='" + data[i].id + "' value='" +  data[i].name + "' />"
						);
					}
					break;
				case 'cityList':
					
					$('#cityList').empty();
					for(var i = 0;i<data.length;i++){
						$('#cityList').append(
							"<option id='" + data[i].id + "' value='" +  data[i].name + "' />"
						);
					}
					break;
				}                             	
            }
        });
	}
	
	//muestra los datos a modificar
	function muestraDatos(id){
		limpiarCampos();
		$('#btnRegistrarCupon').hide();
		$('#btnguardarCupon').show();
		id = $(id).find('input').val();
		$('#btnguardarCupon').val(id);
		
		$.ajax({
            type: "POST",
            url: "../admin/cupones/getID",
            dataType:'json',
            data: { 
				id:id
            },
            success: function(data){
				$('#txtDescription').val(data[0].description);
				$('#txtPartner').val(data[0].partnerName);
				$('#partnerList').append("<option id='" + data[0].partnerId + "' value='" +  data[0].partnerName + "' />" );
				$('#txtCity').val(data[0].cityName);
				$('#cityList').append("<option id='" + data[0].cityId + "' value='" +  data[0].cityName + "' />" );
				$('#txtDetail').val(data[0].detail);
				$('#imgImagen').attr("src",URL_IMG + "app/coupon/max/" + data[0].image)
				$('#imagenName').val(data[0].image);
				$('#imgImagen').attr("hidden",data[0].image)
				$('#dateIniDate').val(data[0].iniDate);
				$('#dateEndDate').val(data[0].endDate);
				originalDate = $('#dateIniDate').val();
				$('#vistaCupones').hide();
				$('#FormularioCupones').show();
				if(data[0].timer == 1){
					$('input[name=tiempoLimitado]').prop('checked', true);	
				}
				
            }
        });
		
		$.ajax({
            type: "POST",
            url: "../admin/cupones/getCatalogOfCoupon",
            dataType:'json',
            data: { 
				couponId:id
            },
            success: function(data){

				$('input[name=catalog]').each(function(index, element) {
                    for(var i=0;i<data.length;i++){
						if($(this).val() == data[i].catalogId){
							$(this).prop('checked', true);
						}
					}
                });
				
            }
        });
	}
	
	
	//imagen
	
	//abre el explorador de archivos cuando le das click a la imagen de cupones
	function cambiarImagen(){
		$('#fileImagen').click();
	}

function agregarCupon(){
	limpiarCampos();
	$('#btnguardarCupon').hide();
	$('#btnRegistrarCupon').show();
	$('#vistaCupones').hide();
	$('#FormularioCupones').show();
	$('#imagenName').val(0);
	originalDate = "";
}

//registra nuevos cupones en la base de datos

function registrarCupon(){
	
	var result;
	result = validacion();
	
	if(result == true){
		var description = $('#txtDescription').val();
		valorPartner = $('#txtPartner').val();
		var idPartner = $('datalist option[value="' + valorPartner + '"]').attr('id')
		valorCity = $('#txtCity').val();
		var idCity = $('datalist option[value="' + valorCity + '"]').attr('id')
		var detail = $('#txtDetail').val();
		var iniDate = $('#dateIniDate').val();
		var endDate = $('#dateEndDate').val();
		var idCatalog = new Array();
		$('input[name=catalog]:checked').each(function() {
			idCatalog.push($(this).val());
        });
		var timer = 0;
		$('input[name=tiempoLimitado]:checked').each(function() {
			timer = 1;
        });
		var jsonIdCatalog = JSON.stringify(idCatalog);
		
		var archivos = document.getElementById("fileImagen");//Damos el valor del input tipo file
 		var archivo = archivos.files; //obtenemos los valores de la imagen
		
		//creamos la variable Request 
		if(window.XMLHttpRequest) {
 			var Req = new XMLHttpRequest(); 
 		}else if(window.ActiveXObject) { 
 			var Req = new ActiveXObject("Microsoft.XMLHTTP"); 
 		}
		
		var data = new FormData();
	
		data.append('archivo',archivo[0]);
		
		//cargamos los parametros para enviar la imagen
		Req.open("POST", "../admin/cupones/subirImagen", true);
		
		//nos devuelve los resultados
		Req.onload = function(Event) {
			//Validamos que el status http sea ok 
		if (Req.status == 200) {
 	 		//Recibimos la respuesta de php
  			var nombreImagen = Req.responseText;
			numPag = $('ul .current').val();
				$.ajax({
            		type: "POST",
            		url: "../admin/cupones/insertCoupon",
            		dataType:'json',
            		data: { 
                		partnerId:idPartner,
						cityId:idCity,
						timer:timer,
						image:nombreImagen,
						description:description,
						detail:detail,
						iniDate:iniDate,
						endDate:endDate,
						idCatalog:jsonIdCatalog
						
            		},
            		success: function(){
						ajaxMostrarTabla(column,order,"../admin/cupones/getallSearch",(numPag-1),"coupon");
						$('#FormularioCupones').hide();
						$('#vistaCupones').show();
						$('#alertMessage').empty();
						$('#alertMessage').append("Se ha agregado un nuevo Cupon");
						$('#divMenssage').show(1000).delay(4000);
						$('#divMenssage').toggle(2000);
            		},
					error: function(){
						alert("error al insertar datos");
					}
        		});
				
			} else { 
  			//console.log(Req.status); //Vemos que paso.
			} 	
		};
		
		//Enviamos la petición 
 		Req.send(data);
	} 
 }
	
	//modifica los datos de cupones
	function GuardarCupon(){
		
		var result = validacion()
		
		if(result == true){
		
			var nameImage = $('#imagenName').val();
			if(document.getElementById('fileImagen').value == ""){
				ajaxGuardar(nameImage);
			} else {
		
				upImage(nameImage);
			}
		}
		
	}
	
	//sube las imagenes al servidor
	function upImage(deleteImage){
		$.ajax({
            type: "POST",
            url: "../admin/cupones/deleteImage",
            dataType:'json',
            data: { 
				deleteImage:deleteImage
			},
            error: function(){
				//subimos la nueva imagen
				var archivos = document.getElementById("fileImagen");//Damos el valor del input tipo file
 				var archivo = archivos.files;
		
				if(window.XMLHttpRequest) {
 					var Req = new XMLHttpRequest();
 				}else if(window.ActiveXObject) { 
 					var Req = new ActiveXObject("Microsoft.XMLHTTP");
 				}
		
				var data = new FormData();
	
				//cargamos los atributos de la imagen
				data.append('archivo',archivo[0]);
		
				//abrimos la conexion para subir una imagen
				Req.open("POST", "../admin/cupones/subirImagen", true);
				//verificamos si se executo correctamente el metodo
				Req.onload = function(Event) {
				//Validamos que el status http sea ok 
				if (Req.status == 200) {
 	 				//Recibimos la respuesta de php
					nombreImage = Req.responseText;
					ajaxGuardar(nombreImage);
				} else { 
  					//console.log(Req.status); //Vemos que paso.
				} 		
			};
			//Enviamos la petición 
 			Req.send(data);		
            }
        });
	}
	
	function ajaxGuardar(nameImage){
		
		var description = $('#txtDescription').val();
		var detail = $('#txtDetail').val();
		var iniDate = $('#dateIniDate').val();
		var endDate = $('#dateEndDate').val();
		//regresa la id del partner
		valorPartner = $('#txtPartner').val();
		idPartner = $('datalist option[value="' + valorPartner + '"]').attr('id')
		//regresa la id de la ciudad
		valorCity = $('#txtCity').val();
		idCity = $('datalist option[value="' + valorCity + '"]').attr('id')
		var idCatalog = new Array();
		$('input[name=catalog]:checked').each(function() {
			idCatalog.push($(this).val());
        });
		var timer = 0;
		$('input[name=tiempoLimitado]:checked').each(function() {
			timer = 1;
        });
		var jsonIdCatalog = JSON.stringify(idCatalog);
		numPag = $('ul .current').val();
		$.ajax({
            	type: "POST",
            	url: "../admin/cupones/updateCoupon",
            	dataType:'json',
            	data: { 
					id:$('#btnguardarCupon').val(),
					partnerId:idPartner,
					cityId:idCity,
					timer:timer,
					image:nameImage,
					description:description,
					detail:detail,
					iniDate:iniDate,
					endDate:endDate,
					idCatalog:jsonIdCatalog
            	},
            	success: function(data){
					
					ajaxMostrarTabla(column,order,"../admin/cupones/getallSearch",(numPag-1),"coupon");
					$('#FormularioCupones').hide();
					$('#vistaCupones').show();
					$('#alertMessage').empty();
					$('#alertMessage').append("Se han editado los datos de coupon");
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
            	}
        	});
	}
	
	//muestra la opcion de eliminar coupon
	function eliminarCoupon(idCoupon){
		$('#btnAceptarE').val($(idCoupon).attr("value"));
		$("#divMenssagewarning").hide();
		$('#divMenssagewarning').show(1000);
	}
	
	//oculta la opcion de eliminar
	function CancelarEliminar(){
		$('#divMenssagewarning').hide(1000);
	}
	
	//funcion que elimina el cupon(cambia el status a 0)
	function AceptarEliminar(idCoupon){
		numPag = $('ul .current').val();
		$.ajax({
            	type: "POST",
            	url: "../admin/cupones/deleteCoupon",
            	dataType:'json',
            	data: { 
					id:$(idCoupon).val()
            	},
            	success: function(data){
					$("#divMenssagewarning").hide(1000);
					$('#alertMessage').empty();
					$('#alertMessage').append("Se han eliminado el coupon");
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
					
					//verifica si se elimino la ultima fila de la tabla
					var aux = 0;
					$('#tableCupones tbody tr').each(function(index) {
                        aux++;
                    });
					
					//si es uno regarga la tabla con un numero menos
					if(aux == 1){
						numPag = numPag-1;
					}
					ajaxMostrarTabla(column,order,"../admin/cupones/getallSearch",(numPag-1),"coupon");
            	}
        	});
	}
	
	
	
	//regresa a la tabla de 
	function CancelarForm(){
		$('#FormularioCupones').hide();	
		$('#vistaCupones').show();
		ocultarAlertas();
	}
	
	//funcion para validar los campos
	function validacion(){
		var result = true;
		
		ocultarAlertas();
		
		var f = new Date();
		var dia = f.getDate();
		var mes = f.getMonth() + 1;
		if(dia<10){
			dia = "0" + dia;	
		}
		if(mes < 10){
			mes = "0" + mes;	
		}
		var anio = f.getFullYear();
		var fechaActual =(anio + "-" + mes + "-" + dia);
		//valida que la fecha de inicio sea mayor o igual a la fecha actual
		
		if(originalDate != "" && $('#dateIniDate').val() < fechaActual){
			$('#alertIniDate').empty();
			$('#alertIniDate').append("Fecha Incorrecta. Ingrese una fecha actual o la fecha default");
			$('#alertIniDate').show();
			$('#labelIniDate').addClass('error');
			result = false;
			if(originalDate != "" && $('#dateIniDate').val() == originalDate){
				$('#alertIniDate').hide();
				$('#labelIniDate').removeClass('error');
				result = true;
			}
		} 
		
		if($('#dateIniDate').val() < fechaActual && originalDate == ""){
			$('#alertIniDate').empty();
			$('#alertIniDate').append("Fecha Incorrecta. Ingrese una fecha actual");
			$('#alertIniDate').show();
			$('#labelIniDate').addClass('error');
			$('#dateIniDate').focus();
			result = false;
		}
		
		//valida que se haya selecionado al menos un checkbox
		var checkboxSelecionados = 0;
		$('input[name=catalog]:checked').each(function() {
			checkboxSelecionados++;
        });
		
		if(checkboxSelecionados == 0){
			$('#labelEntretenimiento').addClass('error');
			$('#labelProductos').addClass('error');
			$('input[name=catalog]').focus();
			$('#alertCatalogo').show();
			result = false;
		}
		
		//valida el formato de la imagen
		/*if($('#fileImagen').val().length != 0){
			if($('#fileImagen').get(0).files[0].type != "image/png" 
			|| $('#fileImagen').get(0).files[0].type != "image/gif"
			|| $('#fileImagen').get(0).files[0].type != "image/jpeg"
			|| $('#fileImagen').get(0).files[0].type != "image/jpg")
			{
				$('#alertImage').empty();
				$('#alertImage').append("Formato de imagen incorrecto. Selecione una imagen con el formato jpg , png o gif");
				$('#alertImage').show();
				result = false;
			}	
		}*/
		
		//valida que se haya selecionado una imagen
		if($('#imagenName').val() == 0 && $('#fileImagen').val().length == 0){
			$('#alertImage').empty();
			$('#alertImage').append("Campo vacio. Selecione una imagen");
			$('#alertImage').show();
			result = false;
		}
		
		//valida que la fecha final sea mayor o igual a la de inicio
		if($('#dateEndDate').val() < $('#dateIniDate').val()){
			$('#alertEndDate').empty();
			$('#alertEndDate').append("Fecha Incorrecta. Ingrese una fecha mayor a fecha inicio");
			$('#alertEndDate').show();
			$('#labelEndDate').addClass('error');
			$('#dateEndDate').focus();
			result = false;
		}
		
		//valida que se haya selecionado una fecha final
		if($('#dateEndDate').val().length == 0){
			$('#alertEndDate').empty();
			$('#alertEndDate').append("Campo vacio. Ingrese una fecha");
			$('#alertEndDate').show();
			$('#labelEndDate').addClass('error');
			$('#dateEndDate').focus();
			result = false;
		}
		
		//valida que la fecha de inicio no esta vacia
		if($('#dateIniDate').val().length == 0){
			$('#alertIniDate').empty();
			$('#alertIniDate').append("Campo vacio. Ingrese una fecha");
			$('#alertIniDate').show();
			$('#labelIniDate').addClass('error');
			$('#dateIniDate').focus();
			result = false;
		}
		
		//valida que el campo detail no este vacio
		if($('#txtDetail').val().length == 0){
			$('#alertDetail').show();
			$('#labelDetail').addClass('error');
			$('#txtDetail').focus();
			result = false;
		}
		
		valorCity = $('#txtCity').val();
		idCity = $('datalist option[value="' + valorCity + '"]').attr('id');
		//valida que la ciudad selecionada no este vacia y que exista
		if(idCity == undefined){
			$('#alertCity').show();
			$('#labelCity').addClass('error');
			$('#txtCity').focus();
			result = false;
		}
		
		valorPartner = $('#txtPartner').val();
		idPartner = $('datalist option[value="' + valorPartner + '"]').attr('id');
		//valida que el partner selecionado no este vacio y que exista
		if(idPartner == undefined){
			$('#alertPartner').show();
			$('#labelPartner').addClass('error');
			$('#txtPartner').focus();
			result = false;
		}
		
		//valida que la description no este vacia
		if($('#txtDescription').val().length == 0){
			$('#alertDescription').show();
			$('#labelDescription').addClass('error');
			$('#txtDescription').focus();
			result = false;
		}
		
		return result;
	}
	
	function ocultarAlertas(){
		$('#alertDescription').hide()
		$('#alertPartner').hide();
		$('#alertCity').hide();
		$('#alertDetail').hide();
		$('#alertIniDate').hide();
		$('#alertEndDate').hide();
		$('#alertImage').hide();
		$('#alertCatalogo').hide();
		
		$('#labelDescription').removeClass('error');
		$('#labelPartner').removeClass('error');
		$('#labelCity').removeClass('error');
		$('#labelDetail').removeClass('error');
		$('#labelIniDate').removeClass('error');
		$('#labelEndDate').removeClass('error');
		$('#labelEntretenimiento').removeClass('error');
		$('#labelProductos').removeClass('error');
	}
	
	function limpiarCampos(){
		$('#txtDescription').val("");
		$('#txtPartner').val("");
		$('#txtCity').val("");
		$('#txtDetail').val("");
		$('#dateIniDate').val("");
		$('#dateEndDate').val("");
		$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]")
		document.getElementById('fileImagen').value ='';
		$('input[type=checkbox]:checked').each(function() {
			$(this).prop('checked', false);
        });
		$('#partnerList').empty();
		$('#cityList').empty();
		$('#divMenssage').hide();
		$('#divMenssagewarning').hide();
	}