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
$("#imgImagen2").click(function() {changeImage2()});
$("#imgImagenApp").click(function() {changeImageApp()});

//validar que no se increse letras en el campo latitud y longitud
	$(document).on('keydown','#txtPlaceLatitude, #txtPlaceLongitude',function() {
		validarCoordenada();
	});
	
	/****galery*****/
	
$('#btnSaveGallery').click(function() {eventAddGallery()});
$('#btnCancelGallery').click(function() {CancelGallery()});
	
$("#btnAddGallery").click(function() {addGallery()});

$("#imgImageGallery").click(function() {changeImageGallery()});
$("#imgImageThumb").click(function() {changeImageThumb()});

$(document).on('click','#imgDeleteBlack',function(){ deleteGallery(this); });
	
	/******/
	
	//visualizar imagen

	$(window).load(function(){
 		$(function() {
			//detecta cada vez que hay un cambio en el formulario de imagen
 			$('#fileImagen').change(function(e) {
			$('#lblEventImage').removeClass('error');
	  		$('#alertImage').hide();
			$('#imgImagen').attr("src","http://placehold.it/1000x300&text=[1000x300]");
	  		if($('#imagenName').val() != 0){
		 		$('#imgImagen').attr("src",URL_IMG + "app/visita/banner/" + $('#imagenName').val())
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
		  	$('#imgImagen').attr("src","http://placehold.it/1000x300&text=[1000x300]");
		 	 document.getElementById('fileImagen').value ='';
		  	if($('#imagenName').val() != 0){
			  	$('#imgImagen').attr("src",URL_IMG + "app/visita/banner/" + $('#imagenName').val())
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
	 
	 /////////imagen 2 ///////////////
	 
	 //detecta cada vez que hay un cambio en el formulario de imagen
 			$('#fileImagen2').change(function(e) {
			$('#lblEventImage2').removeClass('error');
	  		$('#alertImage2').hide();
			$('#imgImagen2').attr("src","http://placehold.it/1000x300&text=[1000x300]");
	  		if($('#imagenName2').val() != 0){
		 		$('#imgImagen2').attr("src",URL_IMG + "app/visita/banner/" + $('#imagenName2').val())
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
		  	$('#imgImagen2').attr("src","http://placehold.it/1000x300&text=[1000x300]");
		 	 document.getElementById('fileImagen2').value ='';
		  	if($('#imagenName2').val() != 0){
			  	$('#imgImagen2').attr("src",URL_IMG + "app/visita/banner/" + $('#imagenName2').val())
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
	 
	  /////////imagen App ///////////////
	 
	 //detecta cada vez que hay un cambio en el formulario de imagen
 			$('#fileImagenApp').change(function(e) {
			$('#lblEventImageApp').removeClass('error');
	  		$('#alertImageApp').hide();
			$('#imgImagenApp').attr("src","http://placehold.it/440x330&text=[440x330]");
	  		if($('#imagenNameApp').val() != 0){
		 		$('#imgImagenApp').attr("src",URL_IMG + "app/visita/app/" + $('#imagenNameApp').val())
	  		}
			if(e.target.files[0] != undefined){
				addImage3(e); 
			}
     	});

	//muestra la nueva imagen
     function addImage3(e){
      	var file = e.target.files[0],
      	imageType = /image.*/;
	
      	if (!file.type.match(imageType)){
		  	$('#imgImagenApp').attr("src","http://placehold.it/440x330&text=[440x330]");
		 	 document.getElementById('fileImagenApp').value ='';
		  	if($('#imagenNameApp').val() != 0){
			  	$('#imgImagenApp').attr("src",URL_IMG + "app/app/app/" + $('#imagenNameApp').val())
		  	} else {
				$('#lblEventImageApp').addClass('error');
			  	$('#alertImageApp').empty();
			  	$('#alertImageApp').append("Selecione una imagen");
			  	$('#alertImageApp').show();
		  	}
       	return;
	  	}
  		//carga la imagen
      var reader = new FileReader();
      reader.onload = fileOnload3;
      reader.readAsDataURL(file);
     }
	 
  	//muestra el resultado
     function fileOnload3(e) {
      var result=e.target.result;
      $('#imgImagenApp').attr("src",result);
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
	
	function changeImageApp(){
		$('#fileImagenApp').click();
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
			if(document.getElementById('fileImagen').value == "" && document.getElementById('fileImagen2').value == "" && document.getElementById('fileImagenApp').value == ""){
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
		
		if(window.XMLHttpRequest) {
 			var Req = new XMLHttpRequest();
 		}else if(window.ActiveXObject) { 
 			var Req = new ActiveXObject("Microsoft.XMLHTTP");
 		}
		
		var data = new FormData();
		
		var ruta = new Array();
		var imageNameArray = new Array();
		
		if(document.getElementById('fileImagenApp').value != ""){
			var archivos = document.getElementById("fileImagenApp");//Damos el valor del input tipo file
 			var archivo = archivos.files;
			data.append('bannerApp',archivo[0]);
			ruta.push("assets/img/app/visita/app/");
			imageNameArray.push($('#imagenNameApp').val());
		}
		
		if(document.getElementById('fileImagen').value != ""){
			var archivos = document.getElementById("fileImagen");//Damos el valor del input tipo file
 			var archivo = archivos.files;
			data.append('banner1',archivo[0]);
			ruta.push("assets/img/app/visita/banner/");
			imageNameArray.push($('#imagenName').val());
		}
		
		if(document.getElementById('fileImagen2').value != ""){
			var archivos = document.getElementById("fileImagen2");//Damos el valor del input tipo file
 			var archivo = archivos.files;
			data.append('banner2',archivo[0]);
			ruta.push("assets/img/app/visita/banner/");
			imageNameArray.push($('#imagenName2').val());
		}
		
		rutaJson = JSON.stringify(ruta);
		data.append('ruta',ruta);
		
		rutaJson = JSON.stringify(imageNameArray);
		data.append('imageName',imageNameArray);
		
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
		
			var image = nameImage.split("*-*");
			var jsonImage = JSON.stringify(image);
		
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
					image:jsonImage,
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
				$('#imgImagenApp').attr("src",URL_IMG + "app/visita/app/" + data[0].image);
				$('#imagenNameApp').val(data[0].image);
            }
        });
		
		$.ajax({
			type: "POST",
            url: "../admin/place/getBannerId",
            dataType:'json',
            data: { 
				id:id
            },
            success: function(data){
				$('#imgImagen').attr("src",URL_IMG + "app/visita/banner/" + data[0].image);
				$('#imagenName').val(data[0].image);
				$('#imgImagen2').attr("src",URL_IMG + "app/visita/banner/" + data[1].image);
				$('#imagenName2').val(data[1].image);
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
			$('#alertImage').html("Campo vacio. Selecione una imagen");
			$('#alertImage').show();
			$('#lblPlaceImage').addClass('error');
			result = false;
		}
		
		if($('#imagenName2').val() == 0 && $('#fileImagen2').val().length == 0){
			$('#alertImage2').html("Campo vacio. Selecione una imagen");
			$('#alertImage2').show();
			$('#lblPlaceImage2').addClass('error');
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
		$('#alertImage2').hide();
		$('#alertTxtMin').hide();
		$('#alertWeatherKey').hide();
		$('#alertTitle').hide();
		$('#alertCity').hide();
		$('#alertName').hide();
		
		$('#lblPlaceLongitude').removeClass('error');
		$('#lblPlaceLatitude').removeClass('error');
		$('#lblPlaceTxtMax').removeClass('error');
		$('#lblPlaceImage').removeClass('error');
		$('#lblPlaceImage2').removeClass('error');
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
		$('#imgImagen').attr("src","http://placehold.it/1000x300&text=[1000x300]");
		$('#imgImagen2').attr("src","http://placehold.it/1000x300&text=[1000x300]");
		$('#imgImagenApp').attr("src","http://placehold.it/440x330&text=[440x330]");
		document.getElementById('fileImagen').value ='';
		document.getElementById('fileImagen2').value ='';
		document.getElementById('fileImagenApp').value ='';
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
			$('#imgImageGallery').attr("src","http://placehold.it/630x420&text=[630x420]");
			if(e.target.files[0] != undefined){
				addImageGallery(e); 
			}
     	});

	//muestra la nueva imagen
     function addImageGallery(e){
		 
      	var file = e.target.files[0],
      	imageType = /image.*/;
	
      	if (!file.type.match(imageType)){
		  	$('#imgImageGallery').attr("src","http://placehold.it/630x420&text=[630x420]");
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
	 
	 //---Thumb-------//
	 
	 $('#fileImageThumb').change(function(e) {
				
			$('#lblImageThumb').removeClass('error');
	  		$('#alertImageThumb').hide();
			$('#imgImageThumb').attr("src","http://placehold.it/150x100&text=[150x100]");
			if(e.target.files[0] != undefined){
				addImageThumb(e); 
			}
     	});

	//muestra la nueva imagen
     function addImageThumb(e){
		 
      	var file = e.target.files[0],
      	imageType = /image.*/;
	
      	if (!file.type.match(imageType)){
		  	$('#imgImageThumb').attr("src","http://placehold.it/150x100&text=[150x100]");
		 	 document.getElementById('fileImagenGallery').value ='';
				$('#lblImageThumb').addClass('error');
			  	$('#alertImageThumb').html("Selecione una imagen");
			  	$('#alertImageThumb').show();
       	return;
	  	}
  		//carga la imagen
      var reader = new FileReader();
      reader.onload = fileOnloadThumb;
      reader.readAsDataURL(file);
     }
	 
  	//muestra el resultado
     function fileOnloadThumb(e) {
      var result=e.target.result;
      $('#imgImageThumb').attr("src",result);
     }
	 
    });
  });
  
 	//abre el explorador de archivos cuando le das click a la imagen de cupones
	function changeImageGallery(){
		$('#fileImageGallery').click();
	}
	
	function changeImageThumb(){
		$('#fileImageThumb').click();
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
			var thumb = "thumb" + numImage;
			$('#gridImages').append(
				"<div id='imgPlacegallery' class='small-6 medium-6 large-4 columns "+ gallery + "'>"+
            		"<a id='imgDeleteBlack' value='"+ gallery + "'><img src='../assets/img/web/deleteBlack.png' /></a>"+
					"<img id='imgImageMiniGallery' src='" + $('#imgImageGallery').attr('src')+ "' />"+
					"<input type='file' id='"+ gallery +"' class='fileGallery' name='gallery[]' multiple style='display:none' />" +
					"<input type='file' id='"+ thumb +"' class='fileThumb' name='Thumb[]' multiple style='display:none' />" +
					"<div id='imgPlacegallery' class='small-12 medium-12 large-12 columns' style='height:25px;'>" +
                "</div>"
			);
			
			var archivos = document.getElementById("fileImageGallery");
			archivo = archivos.files;
			document.getElementById(gallery).files = archivo;
			
			var archivos = document.getElementById("fileImageThumb");
			archivo = archivos.files;
			document.getElementById(thumb).files = archivo;
			
			numImage++;
			$('#imgImageGallery').attr("src","http://placehold.it/630x420&text=[630x420]");
			$('#imgImageThumb').attr("src","http://placehold.it/150x100&text=[150x100]");
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
		if($('#imgImageGallery').attr("src") == "http://placehold.it/630x420&text=[630x420]"){
			$('#alertImageGallery').html("Campo vacio. Selecione una imagen");
			$('#alertImageGallery').show();
			$('#lblImageGallery').addClass('error');
			result = false;
		}
		
		if($('#imgImageThumb').attr("src") == "http://placehold.it/150x100&text=[150x100]"){
			$('#alertImageThumb').html("Campo vacio. Selecione una imagen");
			$('#alertImageThumb').show();
			$('#lblImageThumb').addClass('error');
			result = false;
		}
		
		return result;	
	}
	
	function hideAlertGallery(){
		$('#alertImageGallery').hide();
		$('#alertImageThumb').hide();
		
		$('#lblImageGallery').removeClass('error');
		$('#lblImageThumb').removeClass('error');
	}
	
	function cleanGallery(){
		document.getElementById('fileImageGallery').value ='';
		$('#imgImageGallery').attr("src","http://placehold.it/630x420&text=[630x420]");
		$('#imgImageThumb').attr("src","http://placehold.it/150x100&text=[150x100]");
		$('#gridImages').empty();
		idGalleryDelete.length = 0;
	}
	