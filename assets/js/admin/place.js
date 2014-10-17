// JavaScript Document

//funcio que se llama cada vez que se teclea en el 'imput' city
$("#txtPlaceCity").keyup(function() { autocomplete(); });

//botones que muestran los diferentes formularios
$('#btnAddPlace').click(function(){showFormAdd()});
$(document).on('click','#showPlace',function(){ ShowFormEdit(this); });
$(document).on('click','#imageDelete',function(){ ShowFormDelete(this); });

//botones que registras,modifican o eliminan eventos 
$('#btnRegisterPlace').click(function() {eventAdd()});
$('#btnSavePlace').click(function() {eventEdit()});
$('#btnCancel').click(function() {eventCancel()});

//botones para el formulario de eliminar eventos
$('.btnAcceptE').click(function() {eventDelete()});
$('.btnCancelE').click(function() {eventCancelDelete()});

//llama a la funcion cada vez que se quiere cambiar la imagen
$("#imgImagen").click(function() {changeImage()});

//validar que no se increse letras en el campo latitud y longitud
	$(document).on('keydown','#txtPlaceLatitude, #txtPlaceLongitude',function() {
		validarCoordenada();
	});
	
	//visualizar imagen

	$(window).load(function(){
 		$(function() {
			//detecta cada vez que hay un cambio en el formulario de imagen
 			$('#fileImagen').change(function(e) {
			$('#lblEventImage').removeClass('error');
	  		$('#alertImage').hide();
			$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]");
	  		if($('#imagenName').val() != 0){
		 		$('#imgImagen').attr("src",URL_IMG + "app/visita/" + $('#imagenName').val())
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
			  	$('#imgImagen').attr("src",URL_IMG + "app/visita/" + $('#imagenName').val())
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
    });
  });
  
 	//abre el explorador de archivos cuando le das click a la imagen de cupones
	function changeImage(){
		$('#fileImagen').click();
	}

// fin visualizar imagen

	//muestra las ciudades existentes en la base de datos
	function autocomplete(){
		palabra = $('#txtPlaceCity').val();
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

	function showFormAdd(){
		cleanFields();
		hideAlert();
		$('#btnSavePlace').hide();
		$('#btnRegisterPlace').show();
		$('#viewPlace').hide();
		$('#FormPlace').show();	
	}
	
	function ShowFormEdit(id){
		cleanFields();
		hideAlert();
		id = $(id).find('input').val();
		$('#btnSavePlace').val(id); 
		showsEvent(id);
		$('#btnRegisterPlace').hide();
		$('#btnSavePlace').show();
		$('#viewPlace').hide();
		$('#FormPlace').show();
	}
	
	function ShowFormDelete(id){
		id = $(id).attr('value');
		$('.btnAcceptE').val(id);
		$('#divMenssagewarning').hide(500);
		$('#divMenssage').hide();
		$('#divMenssagewarning').show(1000);
	}
	
	function eventCancel(){
		cleanFields();
		hideAlert();
		$('#FormPlace').hide();	
		$('#viewPlace').show();
	}
	
	function eventAdd(){
		var result;
		result = validations();
		if(result){
			$('.loading').show();
			$('.loading').html('<img src="../assets/img/web/loading.gif" height="40px" width="40px" />');
			$('.bntSave').attr('disabled',true);
			uploadImage(0);
		}	
	}
	
	function eventEdit(){
		var result;
		result = validations();
		id = $('#btnSavePlace').val();
		if(result){
			$('.loading').show();
			$('.loading').html('<img src="../assets/img/web/loading.gif" height="40px" width="40px" />');
			$('.bntSave').attr('disabled',true);
			if(document.getElementById('fileImagen').value == ""){
				var nameImage = $('#imagenName').val();
				ajaxSaveEvent(id,nameImage);
			} else {
				uploadImage(id);
			}
				
		}
	}
	
	//cancela el formulario de eliminar un lugar
	function eventCancelDelete(){
		$('#divMenssagewarning').hide(1000);
	}
	
	//elimina el evento selecionado de la base de datos
	function eventDelete(){
		id = $('.btnAcceptE').val();
		numPag = $('ul .current').val();
		$.ajax({
            type: "POST",
            url: "../admin/place/deletePlace",
            dataType:'json',
            data: { 
				id:id
			},
            success: function(data){
					var aux = 0;
					$('#tablePlace tbody tr').each(function(index) {
                        aux++;
                    });
					
					//si es uno regarga la tabla con un indice menos
					if(aux == 1){
						numPag = numPag-1;
					}
					ajaxMostrarTabla(column,order,"../admin/place/getallSearch",(numPag-1),"place");
					$('#divMenssagewarning').hide(1000);
					$('#alertMessage').html(data);
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
            	}
		});
	}
	
	//sube la nueva imagen al directorio assets/img/app/event
	function uploadImage(id){
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
		Req.open("POST", "../admin/place/uploadImage", true);
		//verificamos si se executo correctamente el metodo
		Req.onload = function(Event) {
			//Validamos que el status http sea ok 
			if (Req.status == 200) {
 	 			//Recibimos la respuesta de php
				nameImage = Req.responseText;
				ajaxSaveEvent(id,nameImage);
			} else { 
  				//console.log(Req.status); //Vemos que paso.
			} 		
		};
		//Enviamos la petición 
 		Req.send(data);			
	}
	
	//agrega o modifica los datos del evento
	function ajaxSaveEvent(id,nameImage){
		
		//regresa la id de la ciudad
		valueCity = $('#txtPlaceCity').val();
		idCity = $('datalist option[value="' + valueCity + '"]').attr('id');
		numPag = $('ul .current').val();
		$.ajax({
            	type: "POST",
            	url: "../admin/place/saveEvent",
            	dataType:'json',
            	data: { 
					id:id,
					name:$('#txtPlaceName').val(),
					cityId:idCity,
					image:nameImage,
					title:$('#txtPlaceTitle').val(),
					txtMin:$('#txtPlaceTxtMin').val(),
					txtMan:$('#txtPlaceTxtMax').val(),
					weatherKey:$('#txtPlaceWeatherKey').val(),
					latitude:$('#txtPlaceLatitude').val(),
					longitude:$('#txtPlaceLongitude').val()
            	},
            	success: function(data){
					ajaxMostrarTabla(column,order,"../admin/place/getallSearch",(numPag-1),"place");
					$('#FormPlace').hide();
					$('#viewPlace').show();
					$('#alertMessage').html(data);
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
            	},
				error: function(){
					ajaxMostrarTabla(column,order,"../admin/place/getallSearch",(numPag-1),"place");
					$('#FormPlace').hide();
					$('#viewPlace').show();
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
					alert("error al insertar datos")
				}
        	});
	}
	
	function showsEvent(id){
		$.ajax({
			type: "POST",
            url: "../admin/place/getID",
            dataType:'json',
            data: { 
				id:id
            },
            success: function(data){
				$('#txtPlaceName').val(data[0].name);
				$('#txtPlaceCity').val(data[0].nameCity);
				$('#cityList').append("<option id='" + data[0].cityId + "' value='" +  data[0].nameCity + "' />");
				$('#txtPlaceTitle').val(data[0].title);
				$('#txtPlaceTxtMin').val(data[0].txtMin);
				$('#txtPlaceTxtMax').val(data[0].txtMax);
				$('#txtPlaceWeatherKey').val(data[0].weatherKey);
				$('#txtPlaceLatitude').val(data[0].latitude);
				$('#txtPlaceLongitude').val(data[0].longitude);
				$('#imgImagen').attr("src",URL_IMG + "app/visita/" + data[0].image);
				$('#imagenName').val(data[0].image);
            }
        });
	}
	
	function validations(){
		var result = true;
		
		hideAlert();
		
		if($('#imagenName').val() == 0 && $('#fileImagen').val().length == 0){
			$('#alertImage').empty();
			$('#alertImage').append("Campo vacio. Selecione una imagen");
			$('#alertImage').show();
			$('#lblEventImage').addClass('error');
			result = false;
		}
		
		if($('#txtPlaceLongitude').val().trim().length == 0){
			$('#alertLongitude').show();
			$('#lblPlaceLongitude').addClass('error');
			$('#txtPlaceLongitude').focus();
			result = false;
		}
		
		if($('#txtPlaceLatitude').val().trim().length == 0){
			$('#alertLatitude').show();
			$('#lblPlaceLatitude').addClass('error');
			$('#txtPlaceLatitude').focus();
			result = false;
		}
		
		if($('#txtPlaceWeatherKey').val().trim().length == 0){
			$('#alertWeatherKey').show();
			$('#lblPlaceWeatherKey').addClass('error');
			$('#txtPlaceWeatherKey').focus();
			result = false;
		}
		
		if($('#txtPlaceTxtMax').val().trim().length == 0){
			$('#alertTxtMax').show();
			$('#lblPlaceTxtMax').addClass('error');
			$('#txtPlaceTxtMax').focus();
			result = false;
		}
		
		if($('#txtPlaceTxtMin').val().trim().length == 0){
			$('#alertTxtMin').show();
			$('#lblPlaceTxtMin').addClass('error');
			$('#txtPlaceTxtMin').focus();
			result = false;
		}
		
		if($('#txtPlaceTitle').val().trim().length == 0){
			$('#alertTitle').show();
			$('#lblPlaceTitle').addClass('error');
			$('#txtPlaceTitle').focus();
			result = false;
		}
		
		valueCity = $('#txtPlaceCity').val();
		idCity = $('datalist option[value="' + valueCity + '"]').attr('id');
		if(idCity == undefined){
			$('#alertCity').show();
			$('#lblPlaceCity').addClass('error');
			$('#txtPlaceCity').focus();
			result = false;
		}
		
		if($('#txtPlaceName').val().trim().length == 0){
			$('#alertName').show();
			$('#lblPlaceName').addClass('error');
			$('#txtPlaceName').focus();
			result = false;
		}
		
		return result;	
	}
	
	function hideAlert(){
		$('#alertLongitude').hide();
		$('#alertLatitude').hide();
		$('#alertTxtMax').hide();
		$('#alertImage').hide();
		$('#alertTxtMin').hide();
		$('#alertWeatherKey').hide();
		$('#alertTitle').hide();
		$('#alertCity').hide();
		$('#alertName').hide();
		
		$('#lblPlaceLongitude').removeClass('error');
		$('#lblPlaceLatitude').removeClass('error');
		$('#lblPlaceTxtMax').removeClass('error');
		$('#lblEventImage').removeClass('error');
		$('#lblPlaceTxtMin').removeClass('error');
		$('#lblPlaceWeatherKey').removeClass('error');
		$('#lblPlaceTitle').removeClass('error');
		$('#lblPlaceCity').removeClass('error');
		$('#lblPlaceName').removeClass('error');
	}
	
	function cleanFields(){
		$('#txtPlaceName').val("");
		$('#txtPlaceCity').val("");
		$('#cityList').empty();
		$('#txtPlaceTitle').val("");
		$('#txtPlaceWeatherKey').val("");
		$('#txtPlaceTxtMin').val("");
		$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]")
		document.getElementById('fileImagen').value ='';
		$('#imagenName').val(0);
		$('#txtPlaceTxtMax').val("");
		$('#txtPlaceLatitude').val("");
		$('#txtPlaceLongitude').val("");
	}
	
	//valida los campos de coordenadas
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
				if (event.keyCode < 96 || event.keyCode > 105 && event.keyCode != 109 && event.keyCode != 189 && event.keyCode != 110) {
					event.preventDefault();
				}
			}
		}
	}