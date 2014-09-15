// JavaScript Document

//funcio que se llama cada vez que se teclea en el 'imput' city
$("#txtEventCity").keyup(function() { autocomplete(); });

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

//visualizar imagen

	$(window).load(function(){
 		$(function() {
			//detecta cada vez que hay un cambio en el formulario de imagen
 			$('#fileImagen').change(function(e) {
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
    });
  });
  
 	//abre el explorador de archivos cuando le das click a la imagen de cupones
	function changeImage(){
		$('#fileImagen').click();
	}

// fin visualizar imagen

	//muestra las ciudades existentes en la base de datos
	function autocomplete(){
		palabra = $('#txtEventCity').val();
		$.ajax({
			type: "POST",
			url: "../admin/cities/getallSearch",
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


	//muestra el formulario para agregar eventos
	function showFormAdd(){
		cleanFields();
		$('#btnSaveEvent').hide();
		$('#btnRegisterEvent').show();
		$('#viewEvent').hide();
		$('#FormEvent').show();
	}
	
	//muestra el formulario para modificar eventos
	function ShowFormEdit(id){
		cleanFields();
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
		$('#FormEvent').hide();	
		$('#viewEvent').show();
	}
	
	//llama a la funcion para agregar un evento
	function eventAdd(){
		var result;
		result = validations();
		if(result){
			upImage(0);	
		}	
	}
	
	//llama a la funcion de eliminar imagen y editar evento
	function eventEdit(){
		var result;
		result = validations();
		id = $('#btnSaveEvent').val();
		if(result){
			if(document.getElementById('fileImagen').value == ""){
				var nameImage = $('#imagenName').val();
				ajaxSaveEvent(nameImage,id);
			} else {
				deleteImage(id);
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
	function deleteImage(id){
		nameImage = $('#imagenName').val();
		$.ajax({
            type: "POST",
            url: "../admin/eventos/deleteImage",
            dataType:'json',
            data: { 
				deleteImage:nameImage
			},
            error: function(){
				upImage(id);
			}
		});
	}
	
	//sube la nueva imagen al directorio assets/img/app/event
	function upImage(id){
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
		Req.open("POST", "../admin/eventos/uploadImage", true);
		//verificamos si se executo correctamente el metodo
		Req.onload = function(Event) {
			//Validamos que el status http sea ok 
			if (Req.status == 200) {
 	 			//Recibimos la respuesta de php
				nameImage = Req.responseText;
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
		idCity = $('datalist option[value="' + valueCity + '"]').attr('id');
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
					word:$('#txtEventWord').val(),
					place:$('#txtEventPlace').val(),
					idCity:idCity,
					date:$('#dtEventDate').val(),
					image:nameImage,
					fav:fav
            	},
            	success: function(data){
					
					ajaxMostrarTabla(column,order,"../admin/eventos/getallSearch",(numPag-1),"event");
					$('#FormEvent').hide();
					$('#viewEvent').show();
					$('#alertMessage').empty();
					if(id==0){
						$('#alertMessage').append("Se han agregado un nuevo evento");
					} else {
						$('#alertMessage').append("Se han editado los datos del evento");	
					}
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
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
					$('#cityList').append("<option id='" + data[0].idCity + "' value='" +  data[0].cityName + "' />");
					$('#txtEventWord').val(data[0].word);
					$('#imgImagen').attr("src",URL_IMG + "app/event/max/" + data[0].image);
					$('#imagenName').val(data[0].image);
					$('#dtEventDate').val(data[0].date);
					if(data[0].fav == 1){
						$('#checkEventFav').prop('checked', true);
					}
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
		
		if($('#imagenName').val() == 0 && $('#fileImagen').val().length == 0){
			$('#alertImage').empty();
			$('#alertImage').append("Campo vacio. Selecione una imagen");
			$('#alertImage').show();
			result = false;
		}
		
		if($('#txtEventWord').val().trim().length == 0){
			$('#alertWord').show();
			$('#lblEventWord').addClass('error');
			$('#txtEventWord').focus();
			result = false;
		}
		
		valueCity = $('#txtEventCity').val();
		idCity = $('datalist option[value="' + valueCity + '"]').attr('id');
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
		$('#alertName').hide()
		$('#alertPlace').hide();
		$('#alertCity').hide();
		$('#alertWord').hide();
		$('#alertImage').hide();
		$('#alertEventDate').hide();
		
		$('#lblEventName').removeClass('error');
		$('#lblEventPlace').removeClass('error');
		$('#lblEventCity').removeClass('error');
		$('#lblEventWord').removeClass('error');
		$('#lblEventDate').removeClass('error');
	}
	
	//limpia los campos del formulario
	function cleanFields(){
		$('#txtEventName').val("");
		$('#txtEventPlace').val("");
		$('#txtEventCity').val("");
		$('#txtEventWord').val("");
		$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]")
		document.getElementById('fileImagen').value ='';
		$('#imagenName').val(0);
		$('#dtEventDate').val("");
		$('#checkEventFav').prop('checked', false);
		$('#cityList').empty();
		$('#divMenssage').hide();
		$('#divMenssagewarning').hide();	
	}