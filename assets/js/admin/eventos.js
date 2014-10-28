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
$("#imgImagen").click(function() {changeImage()});
$("#imgImagen2").click(function() {changeImage2()});

//visualizar imagen

	$(document).on('keydown','#txtEventLatitude, #txtEventLongitude',function() {
		validarCoordenada();
	});

	$(window).load(function(){
 		$(function() {
			//detecta cada vez que hay un cambio en el formulario de imagen
 			$('#fileImagen').change(function(e) {
			$('#lblEventImage').removeClass('error');
	  		$('#alertImage').hide();
			$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]");
	  		if($('#imagenName').val() != 0){
		 		$('#imgImagen').attr("src",URL_IMG + "app/event/max/" + $('#imagenName').val())
	  		}
			if(e.target.files[0] != undefined){
				addImage(e); 
			}
     	});

	//muestra la nueva imagen
     function addImage(e){
		 
      	var file = e.target.files[0],
      	imageType = /image.*/;
	
      	if (!file.type.match(imageType)){
		  	$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]");
		 	 document.getElementById('fileImagen').value ='';
		  	if($('#imagenName').val() != 0){
			  	$('#imgImagen').attr("src",URL_IMG + "app/event/max/" + $('#imagenName').val())
		  	} else {
				$('#lblEventImage').addClass('error');
			  	$('#alertImage').empty();
			  	$('#alertImage').append("Selecione una imagen");
			  	$('#alertImage').show();
		  	}
       	return;
	  	}
  		//carga la imagen
      var reader = new FileReader();
      reader.onload = fileOnload;
      reader.readAsDataURL(file);
     }
	 
  	//muestra el resultado
     function fileOnload(e) {
      var result=e.target.result;
      $('#imgImagen').attr("src",result);
     }
	 
	 
	 //detecta cada vez que hay un cambio en el formulario de imagen2
 			$('#fileImagen2').change(function(e) {
			$('#lblEventImage2').removeClass('error');
	  		$('#alertImage2').hide();
			$('#imgImagen2').attr("src","http://placehold.it/500x300&text=[ad]");
	  		if($('#imagenName2').val() != 0){
		 		$('#imgImagen2').attr("src",URL_IMG + "app/event/fullweb/" + $('#imagenName').val())
	  		}
			if(e.target.files[0] != undefined){
				addImage2(e); 
			}
     	});

	//muestra la nueva imagen
     function addImage2(e){
		 
      	var file = e.target.files[0],
      	imageType = /image.*/;
	
      	if (!file.type.match(imageType)){
		  	$('#imgImagen2').attr("src","http://placehold.it/500x300&text=[ad]");
		 	 document.getElementById('fileImagen2').value ='';
		  	if($('#imagenName').val() != 0){
			  	$('#imgImagen2').attr("src",URL_IMG + "app/event/max/" + $('#imagenName').val())
		  	} else {
				$('#lblEventImage2').addClass('error');
			  	$('#alertImage2').empty();
			  	$('#alertImage2').append("Selecione una imagen");
			  	$('#alertImage2').show();
		  	}
       	return;
	  	}
  		//carga la imagen
      var reader = new FileReader();
      reader.onload = fileOnload2;
      reader.readAsDataURL(file);
     }
	 
  	//muestra el resultado
     function fileOnload2(e) {
      var result=e.target.result;
      $('#imgImagen2').attr("src",result);
     }
	 
    });
  });
  
 	//abre el explorador de archivos cuando le das click a la imagen de cupones
	function changeImage(){
		$('#fileImagen').click();
	}
	
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
			upImage(0,"");	
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
			if(document.getElementById('fileImagen').value == "" && document.getElementById('fileImagen2').value == ""){
				var nameImage = $('#imagenName').val();
				ajaxSaveEvent(nameImage,id);
			} else if(document.getElementById('fileImagen').value == "" && document.getElementById('fileImagen2').value != ""){
				deleteImage(id,1);
			} else if(document.getElementById('fileImagen').value != "" && document.getElementById('fileImagen2').value == ""){
				deleteImage(id,2);
			} else {
				deleteImage(id,3);
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
	
	//elimina la imagen del directorio assets/img/app/event
	function deleteImage(id,type){
		nameImage = $('#imagenName').val();
		$.ajax({
            type: "POST",
            url: "../admin/eventos/deleteImage",
            dataType:'json',
            data: { 
				deleteImage:nameImage,
				type:type
			},
            error: function(){
				
				if(document.getElementById('fileImagen').value == "" && document.getElementById('fileImagen2').value != ""){
					upImage2(id,nameImage);
				} else if(document.getElementById('fileImagen').value != "" && document.getElementById('fileImagen2').value == ""){
					upImage(id,nameImage);
				} else {
					upImage(id,"");
				}
			}
		});
	}
	
	//sube la nueva imagen al directorio assets/img/app/event
	function upImage(id,nameImage){
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
		data.append('image',nameImage);
		
		//abrimos la conexion para subir una imagen
		Req.open("POST", "../admin/eventos/uploadImage", true);
		//verificamos si se executo correctamente el metodo
		Req.onload = function(Event) {
			//Validamos que el status http sea ok 
			if (Req.status == 200) {
 	 			//Recibimos la respuesta de php
				nameImage = Req.responseText;
				
				if(document.getElementById('fileImagen2').value != ""){
					upImage2(id,nameImage);
				} else {
					 ajaxSaveEvent(nameImage,id);	
				}
				
			} else { 
  				//console.log(Req.status); //Vemos que paso.
			} 		
		};
		//Enviamos la petición 
 		Req.send(data);			
	}
	
	function upImage2(id,nameImage){
		var archivos = document.getElementById("fileImagen2");//Damos el valor del input tipo file
 		var archivo = archivos.files;
		
		if(window.XMLHttpRequest) {
 			var Req = new XMLHttpRequest();
 		}else if(window.ActiveXObject) { 
 			var Req = new ActiveXObject("Microsoft.XMLHTTP");
 		}
		
		var data = new FormData();
	
		//cargamos los atributos de la imagen
		data.append('archivo',archivo[0]);
		data.append('nameImage',nameImage);
		
		//abrimos la conexion para subir una imagen
		Req.open("POST", "../admin/eventos/uploadImage2", true);
		//verificamos si se executo correctamente el metodo
		Req.onload = function(Event) {
			//Validamos que el status http sea ok 
			if (Req.status == 200) {
 	 			//Recibimos la respuesta de php
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
					image:nameImage,
					fav:fav,
					latitude:$('#txtEventLatitude').val(),
					longitude:$('#txtEventLongitude').val(),
					tags:$('#txtEventTags').val()
            	},
            	success: function(data){
					ajaxMostrarTabla(column,order,"../admin/eventos/getallSearch",(numPag-1),"event");
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
					ajaxMostrarTabla(column,order,"../admin/eventos/getallSearch",(numPag-1),"event");
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
					$('#txtEventTags').val(data[0].tags);
					$('#txtEventLatitude').val(data[0].latitude);
					$('#txtEventLongitude').val(data[0].longitude);
					if(data[0].fav == 1){
						$('#checkEventFav').prop('checked', true);
					}
					$('#imgImagen').attr("src",URL_IMG + "app/event/max/" + data[0].image);
					$('#imagenName').val(data[0].image);
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
		
		if( $('#txtEventLatitude').val().trim().length == 0){
			$('#alertLatitude').show();
			$('#lblEventLatitude').addClass('error');
			$('#txtEventLatitude').focus();
			result = false;
		}
		
		if( $('#txtEventLongitude').val().trim().length == 0){
			$('#alertLongitude').show();
			$('#lblEventLongitude').addClass('error');
			$('#txtEventLongitude').focus();
			result = false;
		}
		
		if($('#imagenName').val() == 0 && $('#fileImagen2').val().length == 0){
			$('#alertImage2').html("Campo vacio. Selecione una imagen");
			$('#alertImage2').show();
			$('#lblEventImage2').addClass('error');
			result = false;
		}
		
		if($('#imagenName').val() == 0 && $('#fileImagen').val().length == 0){
			$('#alertImage').html("Campo vacio. Selecione una imagen");
			$('#alertImage').show();
			$('#lblEventImage').addClass('error');
			result = false;
		}
		
		if($('#dtEventEndDate').val().trim().length > 0 && $('#dtEventEndDate').val().trim() <= $('#dtEventDate').val().trim()){
			$('#alertEndDate').show();
			$('#lblEventEndDate').addClass('error');
			$('#dtEventEndDate').focus();
			result = false;
		}
		
		if($('#txtEventWord').val().trim().length == 0){
			$('#alertWord').show();
			$('#lblEventWord').addClass('error');
			$('#txtEventWord').focus();
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
        
        valueType = $('#txtEventType').val();
		idType = $('#typeList option[value="' + valueType + '"]').attr('id');
		if(idType == undefined){
			$('#alertType').show();
			$('#lblEventType').addClass('error');
			$('#txtEventType').focus();
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
			$('#alertName').show();
			$('#lblEventName').addClass('error');
			$('#txtEventName').focus();
			result = false;
		}
		
		return result;
	}
	
	//oculta las alertas de error
	function hideAlert(){
		$('#alertName').hide();
		$('#alertInfo').hide();
		$('#alertPlace').hide();
		$('#alertCity').hide();
		$('#alertType').hide();
		$('#alertWord').hide();
		$('#alertImage').hide();
		$('#alertImage2').hide();
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
		$('#lblEventImage').removeClass('error');
		$('#lblEventImage2').removeClass('error');
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
		$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]")
		document.getElementById('fileImagen').value ='';
		$('#imgImagen2').attr("src","http://placehold.it/500x300&text=[ad]")
		document.getElementById('fileImagen2').value ='';
		$('#imagenName').val(0);
		$('#dtEventDate').val("");
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