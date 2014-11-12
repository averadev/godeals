// JavaScript Document

//funcio que se llama cada vez que se teclea en el 'imput' city
$("#txtEventCity").keyup(function() { autocomplete(); });
$("#txtEventType").keyup(function() { autocompleteType(); });

//botones que muestran los diferentes formularios
$('#btnAddEvent').click(function(){showFormAdd()});
$(document).on('click','#showEvent',function(){ ShowFormEdit(this); });
$(document).on('click','#imageDelete',function(){ ShowFormDelete(this); });

//botones que registras,modifican o eliminan eventos 
$('#btnRegisterEvent').click(function() {eventAdd()});
$('#btnSaveEvent').click(function() {eventEdit()});
$('#btnCancel').click(function() {eventCancel()});

//botones para el formulario de eliminar eventos
$('.btnAcceptE').click(function() {eventDelete()});
$('.btnCancelE').click(function() {eventCancelDelete()});

//llama a la funcion cada vez que se quiere cambiar la imagen
//$("#imgImagen").click(function() { $('#fileImagen').click(); });
$("#imgImagenMin").click(function() { $('#fileImagenMin').click(); });
$("#imgImagenApp").click(function() { $('#fileImagenApp').click(); });
$("#imgImagenFull").click(function() { $('#fileImagenFull').click(); });
$("#imgImagenFullApp").click(function() { $('#fileImagenFullApp').click(); });
$("#imgImagenDestacado").click(function() { $('#fileImagenDestacado').click(); });
//$("#imgImagen2").click(function() {changeImage2()});

//visualizar imagen

	$(document).on('keydown','#txtEventLatitude, #txtEventLongitude',function() {
		validarCoordenada();
	});
	
	$(document).on('keydown','#txtEventName',function() {
		validarCadena();
	});

	$(window).load(function(){
 		$(function() {
            // Imagen App
            $('#fileImagenApp').change(function(e) {
                $('#labelImageApp').removeClass('error');
                $('#alertImageApp').hide();
                $('#imgImagenApp').attr("src","http://placehold.it/440x330&text=[440x330]");
                if($('#imagenName').val() != 0){
                    $('#imgImagenApp').attr("src",URL_IMG + "app/event/app/" + $('#imagenName').val())
                }
                if(e.target.files[0] != undefined){
                    addImage3(e); 
                }
            });
            function addImage3(e){
                var file = e.target.files[0],
                imageType = /image.*/;
                if (!file.type.match(imageType)){
                    $('#imgImagenApp').attr("src","http://placehold.it/440x330&text=[440x330]");
                    document.getElementById('fileImagenApp').value ='';
                    if($('#imagenNameApp').val() != 0){
                        $('#imgImagenApp').attr("src",URL_IMG + "app/event/app/" + $('#imagenName').val())
                    } else {
                        $('#labelImageApp').addClass('error');
                        $('#alertImageApp').empty();
                        $('#alertImageApp').append("Selecione una imagen");
                        $('#alertImageApp').show();
                    }
                    return;
                }
                var reader = new FileReader();
                reader.onload = fileOnload3;
                reader.readAsDataURL(file);
            }
            function fileOnload3(e) {
                var result=e.target.result;
                $('#imgImagenApp').attr("src",result);
            }
            
            // Imagen Full
            $('#fileImagenFull').change(function(e) {
                $('#labelImageFull').removeClass('error');
                $('#alertImageFull').hide();
                $('#imgImagenFull').attr("src","http://placehold.it/700x525&text=[700x_]");
                if($('#imagenName').val() != 0){
                    $('#imgImagenFull').attr("src",URL_IMG + "app/event/fullweb/" + $('#imagenName').val())
                }
                if(e.target.files[0] != undefined){
                    addImage4(e); 
                }
            });
            function addImage4(e){
                var file = e.target.files[0],
                imageType = /image.*/;
                if (!file.type.match(imageType)){
                    $('#imgImagenFull').attr("src","http://placehold.it/700x525&text=[700x_]");
                    document.getElementById('fileImagenFull').value ='';
                    if($('#imagenNameFull').val() != 0){
                        $('#imgImagenFull').attr("src",URL_IMG + "app/event/fullweb/" + $('#imagenName').val())
                    } else {
                        $('#labelImageFull').addClass('error');
                        $('#alertImageFull').empty();
                        $('#alertImageFull').append("Selecione una imagen");
                        $('#alertImageFull').show();
                    }
                    return;
                }
                var reader = new FileReader();
                reader.onload = fileOnload4;
                reader.readAsDataURL(file);
            }
            function fileOnload4(e) {
                var result=e.target.result;
                $('#imgImagenFull').attr("src",result);
            }
            
            // Imagen Full App
            $('#fileImagenFullApp').change(function(e) {
                $('#labelImageFullApp').removeClass('error');
                $('#alertImageFullApp').hide();
                $('#imgImagenFullApp').attr("src","http://placehold.it/440x330&text=[440x_]");
                if($('#imagenName').val() != 0){
                    $('#imgImagenFullApp').attr("src",URL_IMG + "app/event/fullapp/" + $('#imagenName').val())
                }
                if(e.target.files[0] != undefined){
                    addImage5(e); 
                }
            });
            function addImage5(e){
                var file = e.target.files[0],
                imageType = /image.*/;
                if (!file.type.match(imageType)){
                    $('#imgImagenFullApp').attr("src","http://placehold.it/440x330&text=[440x_]");
                    document.getElementById('fileImagenFullApp').value ='';
                    if($('#imagenNameFullApp').val() != 0){
                        $('#imgImagenFullApp').attr("src",URL_IMG + "app/event/fullapp/" + $('#imagenName').val())
                    } else {
                        $('#labelImageFullApp').addClass('error');
                        $('#alertImageFullApp').empty();
                        $('#alertImageFullApp').append("Selecione una imagen");
                        $('#alertImageFullApp').show();
                    }
                    return;
                }
                var reader = new FileReader();
                reader.onload = fileOnload5;
                reader.readAsDataURL(file);
            }
            function fileOnload5(e) {
                var result=e.target.result;
                $('#imgImagenFullApp').attr("src",result);
            }
            
            // Destacado
            $('#fileImagenDestacado').change(function(e) {
                $('#labelImageDestacado').removeClass('error');
                $('#alertImageDestacado').hide();
                $('#imgImagenDestacado').attr("src","http://placehold.it/278x437&text=[278x437]");
                if($('#imagenName').val() != 0){
                    $('#imgImagenDestacado').attr("src",URL_IMG + "app/event/med/" + $('#imagenName').val())
                }
                if(e.target.files[0] != undefined){
                    addImage6(e); 
                }
            });
            function addImage6(e){
                var file = e.target.files[0],
                imageType = /image.*/;
                if (!file.type.match(imageType)){
                    $('#imgImagenDestacado').attr("src","http://placehold.it/278x437&text=[278x437]");
                    document.getElementById('fileImagenDestacado').value ='';
                    if($('#imagenNameDestacado').val() != 0){
                        $('#imgImagenDestacado').attr("src",URL_IMG + "app/event/med/" + $('#imagenName').val())
                    } else {
                        $('#labelImageDestacado').addClass('error');
                        $('#alertImageDestacado').empty();
                        $('#alertImageDestacado').append("Selecione una imagen");
                        $('#alertImageDestacado').show();
                    }
                    return;
                }
                var reader = new FileReader();
                reader.onload = fileOnload6;
                reader.readAsDataURL(file);
            }
            function fileOnload6(e) {
                var result=e.target.result;
                $('#imgImagenDestacado').attr("src",result);
            }
	 
        });
    });
  
 	//abre el explorador de archivos cuando le das click a la imagen de cupones
	
	function changeImage2(){
		$('#fileImagen2').click();
	}

// fin visualizar imagen

	//muestra las ciudades existentes en la base de datos
	function autocomplete(){
		palabra = $('#txtEventCity').val();
		$.ajax({
			type: "POST",
			url: "../admin/catalogos/getCities",
			dataType:'json',
			data: {
				dato:palabra
			},
			success: function(data){
				$('#cityList').empty();
				for(var i = 0;i<data.length;i++){
					$('#cityList').append(
						"<option id='" + data[i].id + "' value='" +  data[i].name + "' />"
					);
				}
			}
		});	
	}

    // muestra las ciudades existentes en la base de datos
	function autocompleteType(){
		palabra = $('#txtEventType').val();
		$.ajax({
			type: "POST",
			url: "../admin/catalogos/getEventType",
			dataType:'json',
			data: {
				dato:palabra
			},
			success: function(data){
				$('#typeList').empty();
				for(var i = 0;i<data.length;i++){
					$('#typeList').append(
						"<option id='" + data[i].id + "' value='" +  data[i].name + "' />"
					);
				}
			}
		});	
	}
	
	///cambia el contenido del fecha final
	
	$('#dtEventDate').change(function() {
		$('#dtEventEndDate').val($('#dtEventDate').val());
	});


	//muestra el formulario para agregar eventos
	function showFormAdd(){
		cleanFields();
		hideAlert();
		$('#btnSaveEvent').hide();
		$('#btnRegisterEvent').show();
		$('#viewEvent').hide();
		$('#FormEvent').show();
	}
	
	//muestra el formulario para modificar eventos
	function ShowFormEdit(id){
		cleanFields();
		hideAlert();
		id = $(id).find('input').val();
		$('#btnSaveEvent').val(id); 
		showsEvent(id);
		$('#btnRegisterEvent').hide();
		$('#btnSaveEvent').show();
		$('#viewEvent').hide();
		$('#FormEvent').show();
	}
	
	//muestra el formulario para eliminar eventos
	function ShowFormDelete(id){
		id = $(id).attr('value');
		$('.btnAcceptE').val(id);
		$('#divMenssagewarning').hide(500);
		$('#divMenssage').hide();
		$('#divMenssagewarning').show(1000);
	}
	
	//regresa a la tabla de eventos
	function eventCancel(){
		cleanFields();
		hideAlert();
		$('#FormEvent').hide();	
		$('#viewEvent').show();
	}
	
	//llama a la funcion para agregar un evento
	function eventAdd(){
		var result;
		result = validations();
		if(result){
			$('.loading').show();
			$('.loading').html('<img src="../assets/img/web/loading.gif" height="40px" width="40px" />');
			$('.bntSave').attr('disabled',true);
			uploadImage(0,"");	
		}
	}
	
	//llama a la funcion de eliminar imagen y editar evento
	function eventEdit(){
		var result;
		result = validations();
		id = $('#btnSaveEvent').val();
		if(result){
			$('.loading').show();
			$('.loading').html('<img src="../assets/img/web/loading.gif" height="40px" width="40px" />');
			$('.bntSave').attr('disabled',true);
            var nameImage = $('#imagenName').val();
			if(document.getElementById('fileImagenApp').value == ""
               && document.getElementById('fileImagenFull').value == "" 
               && document.getElementById('fileImagenFullApp').value == ""
               && document.getElementById('fileImagenDestacado').value == "" ){
				ajaxSaveEvent(nameImage,id);
			} else {
				uploadImage(id);
			}
		}
	}
	
	//cancela el formulario de eliminar evento
	function eventCancelDelete(){
		$('#divMenssagewarning').hide(1000);
	}
	
	//elimina el evento selecionado de la base de datos
	function eventDelete(){
		id = $('.btnAcceptE').val();
		numPag = $('ul .current').val();
		$.ajax({
            type: "POST",
            url: "../admin/eventos/deleteEvent",
            dataType:'json',
            data: { 
				id:id
			},
            success: function(data){
					var aux = 0;
					$('#tableEvents tbody tr').each(function(index) {
                        aux++;
                    });
					
					//si es uno regarga la tabla con un indice menos
					if(aux == 1){
						numPag = numPag-1;
					}
					ajaxMostrarTabla(column,order,"../admin/eventos/getallSearch",(numPag-1),"event");
					$('#divMenssagewarning').hide(1000);
					$('#alertMessage').empty();
					$('#alertMessage').append("se ha eliminado el evento");
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
            	}
		});
	}
	
	//sube las imagen al directorio assets/img/app/coupon
	function uploadImage(id){
		
		//creamos la variable Request 
		if(window.XMLHttpRequest) {
 			var Req = new XMLHttpRequest(); 
 		}else if(window.ActiveXObject) { 
 			var Req = new ActiveXObject("Microsoft.XMLHTTP"); 
 		}
		
		var data = new FormData(); 
		
		var ruta = new Array();
		
		if(document.getElementById('fileImagenApp').value != ""){
			var archivos = document.getElementById("fileImagenApp");//Damos el valor del input tipo file
 			var archivo = archivos.files; //obtenemos los valores de la imagen
			data.append('ImageApp',archivo[0]);
			ruta.push("assets/img/app/event/app/");
		}
		
		if(document.getElementById('fileImagenFull').value != ""){
			var archivos = document.getElementById("fileImagenFull");//Damos el valor del input tipo file
 			var archivo = archivos.files; //obtenemos los valores de la imagen
			data.append('ImageFull',archivo[0]);
			ruta.push("assets/img/app/event/fullweb/");
		}
		
		if(document.getElementById('fileImagenFullApp').value != ""){
			var archivos = document.getElementById("fileImagenFullApp");//Damos el valor del input tipo file
 			var archivo = archivos.files; //obtenemos los valores de la imagen
			data.append('ImageFullApp',archivo[0]);
			ruta.push("assets/img/app/event/fullapp/");
		}
		
		if(document.getElementById('fileImagenDestacado').value != ""){
			var archivos = document.getElementById("fileImagenDestacado");//Damos el valor del input tipo file
 			var archivo = archivos.files; //obtenemos los valores de la imagen
			data.append('ImageDestacado',archivo[0]);
			ruta.push("assets/img/app/event/med/");
		}
		
		rutaJson = JSON.stringify(ruta);
		data.append('ruta',ruta);
		
		data.append('nameImage',$('#imagenName').val());
		
		//cargamos los parametros para enviar la imagen
		Req.open("POST", "../admin/eventos/subirImagen", true);
		
		//nos devuelve los resultados
		Req.onload = function(Event) {
			//Validamos que el status http sea ok 
		if (Req.status == 200) {
 	 		//Recibimos la respuesta de php
  			var nameImage = Req.responseText;
			ajaxSaveEvent(nameImage,id);
			} else { 
  			//console.log(Req.status); //Vemos que paso.
			} 	
		};
		
		//Enviamos la petición 
 		Req.send(data);
	}
	
	//agrega o modifica los datos del evento
	function ajaxSaveEvent(nameImage,id){
		
		//regresa la id de la ciudad
		valueCity = $('#txtEventCity').val();
		idCity = $('#cityList option[value="' + valueCity + '"]').attr('id');
        //regresa la id de la categoria
		valueType = $('#txtEventType').val();
		idType = $('#typeList option[value="' + valueType + '"]').attr('id');
		var fav = 0;
		$('input[name=destacado]:checked').each(function() {
			fav = 1;
        });
		numPag = $('ul .current').val();
		$.ajax({
            	type: "POST",
            	url: "../admin/eventos/saveEvent",
            	dataType:'json',
            	data: { 
					id:id,
					name:$('#txtEventName').val(),
					type:idType,
					word:$('#txtEventWord').val(),
					info:$('#txtEventInfo').val(),
					place:$('#txtEventPlace').val(),
					idCity:idCity,
					date:$('#dtEventDate').val(),
					endDate:$('#dtEventEndDate').val(),
					image:nameImage,
					fav:fav,
					latitude:$('#txtEventLatitude').val(),
					longitude:$('#txtEventLongitude').val(),
					tags:$('#txtEventTags').val()
            	},
            	success: function(data){
					if(numPag == undefined){
						ajaxMostrarTabla(column,order,"../admin/eventos/getallSearch",0,"event");
					} else {
						ajaxMostrarTabla(column,order,"../admin/eventos/getallSearch",(numPag-1),"event");
					}
					$('#FormEvent').hide();
					$('#viewEvent').show();
					$('#alertMessage').empty();
					$('#alertMessage').html(data);
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
            	},
				error: function(){
					if(numPag == undefined){
						ajaxMostrarTabla(column,order,"../admin/eventos/getallSearch",0,"event");
					} else {
						ajaxMostrarTabla(column,order,"../admin/eventos/getallSearch",(numPag-1),"event");
					}
					$('#FormEvent').hide();
					$('#viewEvent').show();
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
					alert("error al insertar datos")
				}
        	});
	}
	
	//muestra los datos del evento a modificar
	function showsEvent(id){
		$.ajax({
            	type: "POST",
            	url: "../admin/eventos/getID",
            	dataType:'json',
            	data: { 
					id:id
            	},
            	success: function(data){
					$('#txtEventName').val(data[0].name);
					$('#txtEventPlace').val(data[0].place);
					$('#txtEventCity').val(data[0].cityName);
                    $('#txtEventType').val(data[0].typeName);
					$('#cityList').append("<option id='" + data[0].idCity + "' value='" +  data[0].cityName + "' />");
					$('#typeList').append("<option id='" + data[0].eventTypeId + "' value='" +  data[0].typeName + "' />");
					$('#txtEventWord').val(data[0].word);
					$('#txtEventInfo').val(data[0].info);
					var dateTime = data[0].date;
					var replaced = dateTime.replace(" ",'T');
					$('#dtEventDate').val(replaced);
					var dateTime = data[0].endDate;
					var replaced = dateTime.replace(" ",'T');
					$('#dtEventEndDate').val(replaced);
					$('#txtEventTags').val(data[0].tags);
					$('#txtEventLatitude').val(data[0].latitude);
					$('#txtEventLongitude').val(data[0].longitude);
					if(data[0].fav == 1){
						$('#checkEventFav').prop('checked', true);
					}
                    /*$('#imgImagen').attr("src",URL_IMG + "app/event/max/" + data[0].image + "?version=" + (new Date().getTime()))
                    $('#imgImagenMin').attr("src",URL_IMG + "app/event/min/" + data[0].image + "?version=" + (new Date().getTime()))*/
                    $('#imgImagenApp').attr("src",URL_IMG + "app/event/app/" + data[0].image + "?version=" + (new Date().getTime()))
                    $('#imgImagenFull').attr("src",URL_IMG + "app/event/fullweb/" + data[0].image + "?version=" + (new Date().getTime()))
                    $('#imgImagenFullApp').attr("src",URL_IMG + "app/event/fullapp/" + data[0].image + "?version=" + (new Date().getTime()))
                    $('#imgImagenDestacado').attr("src",URL_IMG + "app/event/med/" + data[0].image + "?version=" + (new Date().getTime()))
                    $('#imagenName').val(data[0].image);
                    $('#imgImagen').attr("hidden",data[0].image);
                    
					$('#imgImagen2').attr("src",URL_IMG + "app/event/fullweb/" + data[0].image);
            	}
        	});
	}
	
	//valida que los campos sean correctos
	function validations(){
		var result = true;	
		
		hideAlert();
		
		var date = new Date();
		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();
		if(day<10){
			day = "0" + day;	
		}
		if(month < 10){
			month = "0" + month;	
		}
		var currentDate =(year + "-" + month + "-" + day);
		
        // Obtenemos dimensiones
        sizeImageApp = imgRealSize($("#imgImagenApp"));
        sizeImageFull = imgRealSize($("#imgImagenFull"));
        sizeImageFullApp = imgRealSize($("#imgImagenFullApp"));
        sizeImageDestacado = imgRealSize($("#imgImagenDestacado"));
        
		// Valida que se haya selecionado una imagen
		if($('#imagenName').val() == 0 && $('#fileImagenApp').val().length == 0){
			$('#alertImageApp').html("Campo vacio. Selecione una imagen");
			$('#alertImageApp').show();
			$('#labelImageApp').addClass('error');
			result = false;
		}else if(sizeImageApp.width != 440 || sizeImageApp.height != 330){
            $('#alertImageApp').html("El tamaño no corresponde: 440x330");
			$('#alertImageApp').show();
			$('#labelImageApp').addClass('error');
			result = false;
        }
		
		if($('#imagenName').val() == 0 && $('#fileImagenFull').val().length == 0){
			$('#alertImageFull').html("Campo vacio. Selecione una imagen");
			$('#alertImageFull').show();
			$('#labelImageFull').addClass('error');
			result = false;
		}else if(sizeImageFull.width != 700){
            $('#alertImageFull').html("El ancho no corresponde: 700");
			$('#alertImageFull').show();
			$('#labelImageFull').addClass('error');
			result = false;
        }
		
		if($('#imagenName').val() == 0 && $('#fileImagenFullApp').val().length == 0){
			$('#alertImageFullApp').html("Campo vacio. Selecione una imagen");
			$('#alertImageFullApp').show();
			$('#labelImageFullApp').addClass('error');
			result = false;
		}else if(sizeImageFullApp.width != 440){
            $('#alertImageFullApp').html("El ancho no corresponde: 440");
			$('#alertImageFullApp').show();
			$('#labelImageFullApp').addClass('error');
			result = false;
        }
		
		if($('#imagenName').val() == 0 && $('#fileImagenDestacado').val().length == 0){
			$('#alertImageDestacado').html("Campo vacio. Selecione una imagen");
			$('#alertImageDestacado').show();
			$('#labelImageDestacado').addClass('error');
			result = false;
		}else if((sizeImageDestacado.width != 278 || sizeImageDestacado.height != 437)){
            $('#alertImageDestacado').html("El tamaño no corresponde: 278x437");
			$('#alertImageDestacado').show();
			$('#labelImageDestacado').addClass('error');
			result = false;
        }
		
		if($('#checkEventFav').prop('checked') && $('#txtEventWord').val().trim().length == 0){
			$('#alertWord').show();
			$('#lblEventWord').addClass('error');
			$('#txtEventWord').focus();
			result = false;
		}
		
		if( $('#txtEventLongitude').val().trim().length == 0){
			$('#alertLongitude').show();
			$('#lblEventLongitude').addClass('error');
			$('#txtEventLongitude').focus();
			result = false;
		}
		
		if( $('#txtEventLatitude').val().trim().length == 0){
			$('#alertLatitude').show();
			$('#lblEventLatitude').addClass('error');
			$('#txtEventLatitude').focus();
			result = false;
		}
        
        valueType = $('#txtEventType').val();
		idType = $('#typeList option[value="' + valueType + '"]').attr('id');
		if(idType == undefined){
			$('#alertType').show();
			$('#lblEventType').addClass('error');
			$('#txtEventType').focus();
			result = false;
		}
		
		valueCity = $('#txtEventCity').val();
		idCity = $('#cityList option[value="' + valueCity + '"]').attr('id');
        if(idCity == undefined){
			$('#alertCity').show();
			$('#lblEventCity').addClass('error');
			$('#txtEventCity').focus();
			result = false;
		}
		
		if($('#txtEventPlace').val().trim().length == 0){
			$('#alertPlace').show();
			$('#lblEventPlace').addClass('error');
			$('#txtEventPlace').focus();
			result = false;
		}
		
		if($('#txtEventInfo').val().trim().length == 0){
			$('#alertInfo').show();
			$('#lblEventInfo').addClass('error');
			$('#txtEventInfo').focus();
			result = false;
		}
		
		if($('#txtEventName').val().trim().length == 0){
			$('#alertName').html("Campo vacio. Por favor escriba un nombre");
			$('#alertName').show();
			$('#lblEventName').addClass('error');
			$('#txtEventName').focus();
			result = false;
		}
		
		if($('#txtEventName').val().trim().length > 23){
			$('#alertName').html("Maximo de palabras alcanzadas. Solo 23 palabras o menos");
			$('#alertName').show();
			$('#lblEventName').addClass('error');
			$('#txtEventName').focus();
			result = false;
		}
		
		// dtEventEndDate
		if($('#dtEventEndDate').val() < currentDate){
			$('#alertEndDate').html("Fecha Incorrecta. Ingrese una fecha actual");
			$('#alertEndDate').show();
			$('#lblEventEndDate').addClass('error');
			$('#dtEventDate').focus();
			result = false;
		}
		
		if($('#dtEventEndDate').val().trim().length == 0){
			$('#alertEndDate').html("Campo vacio. Ingrese una fecha");
			$('#alertEndDate').show();
			$('#lblEventEndDate').addClass('error');
			$('#dtEventDate').focus();
			result = false;
		} 
		if($('#dtEventEndDate').val() < $('#dtEventDate').val()){
			alert("hola");
			$('#alertEndDate').html("Fecha incorrecta. Ingrese una fecha mayor a la fecha inicio");
			$('#alertEndDate').show();
			$('#lblEventEndDate').addClass('error');
			$('#dtEventDate').focus();
			result = false;
		}
		
		// dtEventDate
		if($('#dtEventDate').val() < currentDate){
			$('#alertEventDate').empty();
			$('#alertEventDate').append("Fecha Incorrecta. Ingrese una fecha actual");
			$('#alertEventDate').show();
			$('#lblEventDate').addClass('error');
			$('#dtEventDate').focus();
			result = false;
		}
		
		if($('#dtEventDate').val().trim().length == 0){
			$('#alertEventDate').empty();
			$('#alertEventDate').append("Campo vacio. Ingrese una fecha");
			$('#alertEventDate').show();
			$('#lblEventDate').addClass('error');
			$('#dtEventDate').focus();
			result = false;
		}
		
		return result;
	}

    function imgRealSize(img) {
        var image = new Image();
        image.src = $(img).attr("src");
        return { 'width': image.naturalWidth, 'height': image.naturalHeight }
    }
	
	//oculta las alertas de error
	function hideAlert(){
		$('#alertName').hide();
		$('#alertInfo').hide();
		$('#alertPlace').hide();
		$('#alertCity').hide();
		$('#alertType').hide();
		$('#alertWord').hide();
		$('#alertImageApp').hide();
        $('#alertImageFull').hide();
		$('#alertImageFullApp').hide();
		$('#alertImageDestacado').hide();
		$('#alertEventDate').hide();
		$('#alertLatitude').hide();
		$('#alertLongitude').hide()
		$('#alertEndDate').hide()
		
		$('#lblEventName').removeClass('error');
		$('#lblEventInfo').removeClass('error');
		$('#lblEventPlace').removeClass('error');
		$('#lblEventCity').removeClass('error');
		$('#lblEventType').removeClass('error');
		$('#lblEventWord').removeClass('error');
		$('#lblEventDate').removeClass('error');
        $('#labelImageApp').removeClass('error');
        $('#labelImageFull').removeClass('error');
        $('#labelImageFullApp').removeClass('error');
        $('#labelImageDestacado').removeClass('error');
		$('#lblEventLatitude').removeClass('error');
		$('#lblEventLongitude').removeClass('error');
		$('#lblEventEndDate').removeClass('error');
	}
	
	//limpia los campos del formulario
	function cleanFields(){
		$('#txtEventName').val("");
		$('#txtEventPlace').val("");
		$('#txtEventCity').val("");
		$('#txtEventType').val("");
		$('#txtEventWord').val("");
		$('#txtEventInfo').val("");
		$('#imgImagenApp').attr("src","http://placehold.it/440x330&text=[440x330]");
		document.getElementById('fileImagenApp').value ='';
		$('#imgImagenFull').attr("src","http://placehold.it/700x525&text=[700x_]");
		document.getElementById('fileImagenFull').value ='';
		$('#imgImagenFullApp').attr("src","http://placehold.it/440x330&text=[440x_]");
		document.getElementById('fileImagenFullApp').value ='';
		$('#imgImagenDestacado').attr("src","http://placehold.it/278x437&text=[278x437]");
		document.getElementById('fileImagenDestacado').value ='';
        
		$('#imagenName').val(0);
		$('#dtEventDate').val("");
		$('#dtEventEndDate').val("");
		$('#checkEventFav').prop('checked', false);
		$('#cityList').empty();
		$('#typeList').empty();
		$('#divMenssage').hide();
		$('#divMenssagewarning').hide();	
	}
	
	function validarCoordenada(){
   		if(event.shiftKey)
   		{
        	event.preventDefault();
   		}
 
   		if (event.keyCode == 46 || event.keyCode == 8)    {
	   		
   		}
   		else {
	   		if (event.keyCode < 95) {
		   		if (event.keyCode < 48 && event.keyCode != 9 || event.keyCode > 57) {
			   		event.preventDefault();
				}
			} 
       		 else {
				if (event.keyCode < 96 || event.keyCode > 105 && event.keyCode != 109 && event.keyCode != 189 && event.keyCode != 110 && event.keyCode != 190) {
					event.preventDefault();
				}
			}
		}
	}
	
	//valida que la cadena escrita no sobrepase a 23 caracteres
	function validarCadena(){
		if($('#txtEventName').val().length > 23 && event.keyCode != 8 && event.keyCode != 9){
			event.preventDefault();
		}
	}