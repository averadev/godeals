// JavaScript Document

numImage = 0;
idGalleryDelete = new Array();

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

$('#btnAssignTrade').click(function() {assignTrade()});
$('#btnGaleria').click(function() {ShowFormGallery()});

//llama a la funcion cada vez que se quiere cambiar la imagen
$("#imgImagen").click(function() {changeImage()});

//validar que no se increse letras en el campo latitud y longitud
	$(document).on('keydown','#txtPlaceLatitude, #txtPlaceLongitude',function() {
		validarCoordenada();
	});
	
	/****galery*****/
	
$('#btnSaveGallery').click(function() {eventAddGallery()});
$('#btnCancelGallery').click(function() {CancelGallery()});
	
$("#btnAddGallery").click(function() {addGallery()});

$("#imgImageGallery").click(function() {changeImageGallery()});

$(document).on('click','#imgDeleteBlack',function(){ deleteGallery(this); });
	
	/******/
	
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
		$('#btnAssignTrade').hide();
		$('#btnGaleria').hide();
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
		$('#btnAssignTrade').show();
		$('#btnGaleria').show();
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
	
	function assignTrade(){
		//window.location.replace("http://www.pineapplesoft.net?id=1");	
		window.location.href = "../admin/asignarComercio?id=" + $('#btnSavePlace').val();	 
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
				if (event.keyCode < 96 || event.keyCode > 105 && event.keyCode != 109 && event.keyCode != 189 && event.keyCode != 110 && event.keyCode != 190) {
					event.preventDefault();
				}
			}
		}
	}
	
	/****** gallery *******/
	
	//visualizar imagen

	$(window).load(function(){
 		$(function() {
			//detecta cada vez que hay un cambio en el formulario de imagen
 			$('#fileImageGallery').change(function(e) {
				
			$('#lblImageGallery').removeClass('error');
	  		$('#alertImageGallery').hide();
			$('#imgImageGallery').attr("src","http://placehold.it/500x300&text=[ad]");
			if(e.target.files[0] != undefined){
				addImageGallery(e); 
			}
     	});

	//muestra la nueva imagen
     function addImageGallery(e){
		 
      	var file = e.target.files[0],
      	imageType = /image.*/;
	
      	if (!file.type.match(imageType)){
		  	$('#imgImageGallery').attr("src","http://placehold.it/500x300&text=[ad]");
		 	 document.getElementById('fileImagenGallery').value ='';
				$('#lblImageGallery').addClass('error');
			  	$('#alertImageGallery').html("Selecione una imagen");
			  	$('#alertImageGallery').show();
       	return;
	  	}
  		//carga la imagen
      var reader = new FileReader();
      reader.onload = fileOnloadGallery;
      reader.readAsDataURL(file);
     }
	 
  	//muestra el resultado
     function fileOnloadGallery(e) {
      var result=e.target.result;
      $('#imgImageGallery').attr("src",result);
     }
    });
  });
  
 	//abre el explorador de archivos cuando le das click a la imagen de cupones
	function changeImageGallery(){
		$('#fileImageGallery').click();
	}

// fin visualizar imagen
	
	function ShowFormGallery(){
		cleanGallery();
		showGallery();
		$('#FormPlace').hide();
		$('#galleryPlace').show();
	}
	
	function addGallery(){
		result = validateGallery();
		if(result){
			
			var gallery = "gallery" + numImage;
			$('#gridImages').append(
				"<div id='imgPlacegallery' class='small-6 medium-6 large-4 columns "+ gallery + "'>"+
            		"<a id='imgDeleteBlack' value='"+ gallery + "'><img src='../assets/img/web/deleteBlack.png' /></a>"+
					"<img id='imgImageMiniGallery' src='" + $('#imgImageGallery').attr('src')+ "' />"+
					"<input type='file' id='"+ gallery +"' class='fileGallery' name='gallery[]' multiple style='display:none' />" +
					"<div id='imgPlacegallery' class='small-12 medium-12 large-12 columns' style='height:25px;'>" +
                "</div>"
			);
			
			var archivos = document.getElementById("fileImageGallery");
			archivo = archivos.files;
			document.getElementById(gallery).files = archivo;
			numImage++;
			$('#imgImageGallery').attr("src","http://placehold.it/500x300&text=[ad]");
		}
	}
	
	function deleteGallery(selector){
		type = $(selector).attr('value').substring(0,7).toLowerCase();
		valueImage = $(selector).attr('value');
		if(type != "gallery"){
			idGalleryDelete.push(valueImage);
		}
		$('.' + valueImage).remove();
	}
	
	function eventAddGallery(){
		$('.loading').show();
		$('.loading').html('<img src="../assets/img/web/loading.gif" height="40px" width="40px" />');
		$('.bntSave').attr('disabled',true);
		var conTotal = 0;
		$('.fileGallery').each(function() {
			conTotal++;
        });	
		if(conTotal > 0 && idGalleryDelete.length > 0){
			uploadGallery(1,1);
		} else if (conTotal > 0 && idGalleryDelete.length == 0){
			uploadGallery(1,0);
		} else if (conTotal == 0 && idGalleryDelete.length > 0){
			ajaxSaveGallery("",0,1);
		} else {
			ajaxMostrarTabla(column,order,"../admin/place/getallSearch",(numPag-1),"place");
			$('.loading').hide();
			$('.bntSave').attr('disabled',false);
			$('#galleryPlace').hide();
			$('#viewPlace').show();
			$('#alertMessage').html("Se han actualizado la galeria");
			$('#divMenssage').show(1000).delay(1500);
			$('#divMenssage').hide(1000);
			$('.loading').hide();
			$('.bntSave').attr('disabled',false);
			
		}
	}
	
	function CancelGallery(){
		cleanGallery();
		$('#galleryPlace').hide();
		$('#FormPlace').show();
	}
	
	function uploadGallery(add,save){
		
		if(window.XMLHttpRequest) {
 			var Req = new XMLHttpRequest();
 		}else if(window.ActiveXObject) { 
 			var Req = new ActiveXObject("Microsoft.XMLHTTP");
 		}
		
		var data = new FormData();
		
		$('.fileGallery').each(function() {
			var archivos = document.getElementById($(this).attr('id'));
			var archivo = archivos.files;
			data.append($(this).attr('id'),archivo[0]);
        });	
		
		//abrimos la conexion para subir una imagen
		Req.open("POST", "../admin/place/uploadImageGallery", true);
		//verificamos si se executo correctamente el metodo
		Req.onload = function(Event) {
			//Validamos que el status http sea ok 
			if (Req.status == 200) {
 	 			//Recibimos la respuesta de php
				nameImage = Req.responseText;
				ajaxSaveGallery(nameImage,add,save);
			} else { 
  				//console.log(Req.status); //Vemos que paso.
			} 		
		};
		//Enviamos la petición 
 		Req.send(data);
		
	}
	
	function ajaxSaveGallery(nameImage,add,save){
		
		numPag = $('ul .current').val();
		if(add == 1){
			nameImageGallery = nameImage.split('*_*');
			nameImageGallery.pop();
			nameImageGallery = JSON.stringify(nameImageGallery);
		} else {
			nameImageGallery = 0;	
		}
		
		if(save == 1){
			idImage = JSON.stringify(idGalleryDelete);
		} else {
			idImage = 0;	
		}
		
		$.ajax({
            	type: "POST",
            	url: "../admin/place/saveGallery",
            	dataType:'json',
            	data: { 
					add:add,
					save:save,
					placeId:$('#btnSavePlace').val(),
					image:nameImageGallery,
					idImage:idImage
            	},
            	success: function(data){
					ajaxMostrarTabla(column,order,"../admin/place/getallSearch",(numPag-1),"place");
					$('#galleryPlace').hide();
					$('#viewPlace').show();
					$('#alertMessage').html(data);
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
            	},
				error: function(){
					ajaxMostrarTabla(column,order,"../admin/place/getallSearch",(numPag-1),"place");
					$('#galleryPlace').hide();
					$('#viewPlace').show()
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
					alert("error al actualizar la galleria")
				}
        	});
	}
	
	function showGallery(){
		
		numPag = $('ul .current').val();
		
		$.ajax({
            	type: "POST",
            	url: "../admin/place/getAllGalleryById",
            	dataType:'json',
            	data: {
					placeId:$('#btnSavePlace').val()
            	},
            	success: function(data){
					for(var i = 0;i<data.length;i++){
						$('#gridImages').append(
						"<div id='imgPlacegallery' class='small-6 medium-6 large-4 columns "+ data[i].id + "'>"+
            			"<a id='imgDeleteBlack' value='"+ data[i].id + "'><img src='../assets/img/web/deleteBlack.png' /></a>"+
						"<img id='imgImageMiniGallery' src='../assets/img/app/visita/galeria/" + data[i].image+ "' />"+
						"<div id='imgPlacegallery' class='small-12 medium-12 large-12 columns' style='height:25px;'>" +
                		"</div>"
						);
					}
            	},
				error: function(){
					ajaxMostrarTabla(column,order,"../admin/place/getallSearch",(numPag-1),"place");
					$('#galleryPlace').hide();
					$('#viewPlace').show()
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
					alert("error al mostrar la galleria")
				}
        	});	
	}
	
	function validateGallery(){
		result = true;
		if($('#imgImageGallery').attr("src") == "http://placehold.it/500x300&text=[ad]"){
			$('#alertImageGallery').html("Campo vacio. Selecione una imagen");
			$('#alertImageGallery').show();
			$('#lblImageGallery').addClass('error');
			result = false;
		}
		return result;	
	}
	
	function hideAlertGallery(){
		$('#alertImageGallery').hide();
		$('#lblImageGallery').removeClass('error');
	}
	
	function cleanGallery(){
		document.getElementById('fileImageGallery').value ='';
		$('#imgImageGallery').attr("src","http://placehold.it/500x300&text=[ad]");
		$('#gridImages').empty();
		idGalleryDelete.length = 0;
	}
	