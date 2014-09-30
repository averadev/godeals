// JavaScript Document

var contBar = 0;
var numImage = 1;
var idImagenBarArray = new Array();
var idPartnerImagenBarArray = new Array();
var valueImagenBarArray = new Array();
var deleteImagenBarArray = new Array();

//funcio que se llama cada vez que se teclea en el 'imput' city
$("#txtSporttvPartner").keyup(function() { autocomplete(); });

//botones que muestran los diferentes formularios
$('#btnAddSporttv').click(function(){showFormAdd()});
$(document).on('click','#showSporttv',function(){ ShowFormEdit(this); });
$(document).on('click','#imageDelete',function(){ ShowFormDelete(this); });

//botones que registras,modifican o eliminan Sporttv 

$(document).on('click','#btnRegisterSporttv',function(){ sporttvAdd(); });
$(document).on('click','#btnSaveSporttv',function(){ sporttvEdit(); });
$(document).on('click','#btnCancel',function(){ sporttvCancel(); });
$('#btnaddSporttv_bar').click(function() {sporttv_barAdd()});
$(document).on('click','#imgDeleteBlack',function(){ sporttvBarDelete(this); });
$(document).on('click','#imgDeleteBlack2',function(){ sporttvBarDelete2(this); });

//botones para el formulario de eliminar sporttvos
$('.btnAcceptE').click(function() {sporttvDelete()});
$('.btnCancelE').click(function() {sporttvCancelDelete()});

//llama a la funcion cada vez que se quiere cambiar la imagen
$("#imgImagen").click(function() {changeImage()});
$("#imgImageSporttv").click(function() {changeImageBar()});

//visualizar imagen

	$(window).load(function(){
 		$(function() {
			//detecta cada vez que hay un cambio en el formulario de imagen
 			$('#fileImagen').change(function(e) {
	  		$('#alertImage').hide();
			$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]");
	  		if($('#imagenName').val() != 0){
		 		$('#imgImagen').attr("src",URL_IMG + "app/sporttv/max/" + $('#imagenName').val())
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
			  	$('#imgImagen').attr("src",URL_IMG + "app/sporttv/max/" + $('#imagenName').val())
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
	 
	 
	 // imagen 2
	 
	 $('#fileImageBar').change(function(e) {
	  		$('#alertImageBar').hide();
			$('#imgImageSporttv').attr("src","http://placehold.it/500x300&text=[ad]");
			if(e.target.files[0] != undefined){
				addImage2(e); 
			}
     	});

	//muestra la nueva imagen de bareas
     function addImage2(e){
      	var file = e.target.files[0],
      	imageType = /image.*/;
	
      	if (!file.type.match(imageType)){
		  	$('#imgImageSporttv').attr("src","http://placehold.it/500x300&text=[ad]");
		 	 document.getElementById('fileImageBar').value ='';
			  	$('#alertImageBar').empty();
			  	$('#alertImageBar').append("Selecione una imagen");
			  	$('#alertImageBar').show();
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
      $('#imgImageSporttv').attr("src",result);
     }
	 
	 
    });
  });
  
 	//abre el explorador de archivos cuando le das click a la imagen de '[ad]'
	function changeImage(){
		$('#fileImagen').click();
	}
	function changeImageBar(){
		$('#fileImageBar').click();
	}

	// fin visualizar imagen
	
	//muestra los partner existentes en la base de datos
	function autocomplete(){
		palabra = $('#txtSporttvPartner').val();
		$.ajax({
			type: "POST",
			url: "../admin/partners/getallSearch",
			dataType:'json',
			data: {
				dato:palabra
			},
			success: function(data){
				$('#partnerList').empty();
				for(var i = 0;i<data.length;i++){
					$('#partnerList').append(
						"<option id='" + data[i].id + "' value='" +  data[i].name + "' />"
					);
				}
			}
		});	
	}

	//muestra el formulario para agregar sporttv
	function showFormAdd(){
		cleanFields();
		hideAlert();
		$('#btnSaveSporttv').hide();
		$('#btnRegisterSporttv').show();
		$('.btnS2').hide();
		$('.btnR2').show();
		$('#viewSporttv').hide();
		$('#FormSporttv').show();
	}
	
	//muestra el formulario para modificar sporttv
	function ShowFormEdit(id){
		cleanFields();
		hideAlert();
		id = $(id).find('input').val();
		$('#btnSaveSporttv').val(id); 
		showsSporttv(id);
		$('#btnRegisterSporttv').hide();
		$('#btnSaveSporttv').show();
		$('.btnR2').hide();
		$('.btnS2').show();
		$('#viewSporttv').hide();
		$('#FormSporttv').show();
	}
	
	//muestra el formulario para eliminar sporttv
	function ShowFormDelete(id){
		id = $(id).attr('value');
		$('.btnAcceptE').val(id);
		$('#divMenssagewarning').hide(500);
		$('#divMenssage').hide();
		$('#divMenssagewarning').show(1000);
	}
	
	//regresa a la tabla de sporttvos
	function sporttvCancel(){
		cleanFields();
		$('#FormSporttv').hide();	
		$('#viewSporttv').show();
	}
	
	//llama a la funcion para agregar un sporttvo
	function sporttvAdd(){
		var result;
		result = validations();
		if(result){
			$('.loading').show();
			$('.loading').html('<img src="../assets/img/web/loading.gif" height="40px" width="40px" />');
			$('.bntSave').attr('disabled',true);
			uploadImage(0);
		}	
	}
	
	//llama a la funcion de eliminar imagen y editar sporttv
	function sporttvEdit(){
		var result;
		result = validations();
		id = $('#btnSaveSporttv').val();
		if(result){
			$('.loading').show();
			$('.loading').html('<img src="../assets/img/web/loading.gif" height="40px" width="40px" />');
			$('.bntSave').attr('disabled',true);
			if(document.getElementById('fileImagen').value == ""){
				var nameImage = $('#imagenName').val();
				
				if(idImagenBarArray.length == 0 || contBar == 0 ){
					ajaxSaveSporttv(id,nameImage,0,0);
				} else {
					uploadImageBar(id,nameImage);
				}
			} else {
				deleteImage(id);
			}
				
		}
	}
	
	
	//añade un sporttv bar
	function sporttv_barAdd(){
		result = validationSportBar(); 
		
		if(result){
			
			var valuePartner = $('#txtSporttvPartner').val();
			var idPartner = $('datalist option[value="' + valuePartner + '"]').attr('id');
			
			var bar = "bar" + numImage;
			$('#gridImages').append(
				"<div id='imageBar' class='small-6 medium-6 large-6 columns "+ bar + "'>"+
            		"<a id='imgDeleteBlack' value='"+ bar + "'><img src='../assets/img/web/deleteBlack.png' /></a>"+
					"<img id='imgImageSportBar' src='" + $('#imgImageSporttv').attr('src')+ "' />"+
					"<input type='text' disabled value='" + $('#txtSporttvPartner').val() + "' id='txtSporrtvBar'>"+
					"<input type='hidden' value='" + idPartner + "' class='idPartner' /'>"+
                "</div>"
			);
			
			idImagenBarArray.push(bar);
			idPartnerImagenBarArray.push(idPartner);
			var archivos = document.getElementById("fileImageBar");
			archivo = archivos.files;
			valueImagenBarArray.push(archivo[0]);
			numImage++;
			contBar++;
			$('datalist').empty();
			$('#txtSporttvPartner').val("");
			$('#imgImageSporttv').attr("src","http://placehold.it/500x300&text=[ad]");
		 	document.getElementById('fileImageBar').value ='';
		}
	}
	
	//elimina la imagen selecionada de sporttv bar
	function sporttvBarDelete(selector){
		
		type = $(selector).attr('value').substring(0,3).toLowerCase();
		valueImage = $(selector).attr('value');
		
		if(type == "bar"){
			for(var i=0;i<idImagenBarArray.length;i++){
				if(idImagenBarArray[i] == valueImage){
					idImagenBarArray[i] = "";	
				}
				contBar--;
			}
		} else {
			classImage = $(selector).attr('class');
			deleteImagenBarArray.push(classImage);
		}
		$('.' + valueImage).remove();
	}
	
	//cancela el formulario de eliminar sporttv
	function sporttvCancelDelete(){
		$('#divMenssagewarning').hide(1000);
	}
	
	//elimina el sporttv selecionado de la base de datos
	function sporttvDelete(){
		id = $('.btnAcceptE').val();
		numPag = $('ul .current').val();
		$.ajax({
            type: "POST",
            url: "../admin/sporttv/deleteSporttv",
            dataType:'json',
            data: { 
				id:id
			},
            success: function(data){
					var aux = 0;
					$('#tableSporttv tbody tr').each(function(index) {
                        aux++;
                    });
					
					//si es uno regarga la tabla con un indice menos
					if(aux == 1){
						numPag = numPag-1;
					}
					ajaxMostrarTabla(column,order,"../admin/sporttv/getallSearch",(numPag-1),"sporttv");
					$('#divMenssagewarning').hide(1000);
					$('#alertMessage').html(data);
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
            	},
			error: function(data){
					ajaxMostrarTabla(column,order,"../admin/sporttv/getallSearch",(numPag-1),"sporttv");
					alert("error en la base de datos");
			}
		});
	}
	
	//elimina la imagen del directorio assets/img/app/sporttv
	function deleteImage(id){
		nameImage = $('#imagenName').val();
		$.ajax({
            type: "POST",
            url: "../admin/sporttvos/deleteImage",
            dataType:'json',
            data: { 
				deleteImage:nameImage
			},
            error: function(){
				uploadImage(id);
			}
		});
	}
	
	//sube la nueva imagen al directorio assets/img/app/sporttv
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
		Req.open("POST", "../admin/sporttv/uploadImage", true);
		//verificamos si se executo correctamente el metodo
		Req.onload = function(Event) {
			//Validamos que el status http sea ok 
			if (Req.status == 200) {
 	 			//Recibimos la respuesta de php
				nameImage = Req.responseText;
				if(idImagenBarArray.length == 0 || contBar == 0 ){
					ajaxSaveSporttv(id,nameImage,0,0);
				} else {
					uploadImageBar(id,nameImage);
				}
			} else { 
  				//console.log(Req.status); //Vemos que paso.
			} 		
		};
		//Enviamos la petición 
 		Req.send(data);			
	}
	
	
	//sube la(s) imagen(es) del sporttv bar
	function uploadImageBar(id,nameImage){
			if(window.XMLHttpRequest) {
 			var Req = new XMLHttpRequest();
 		}else if(window.ActiveXObject) { 
 			var Req = new ActiveXObject("Microsoft.XMLHTTP");
 		}
		
		var data = new FormData();
		
		var idBar = new Array();
		var partnerId = new Array();
		
		for(var i=0;i<idImagenBarArray.length;i++){
			
			if(idImagenBarArray[i] != ""){
				data.append('archivo' + i,valueImagenBarArray[i]);
				partnerId.push(idPartnerImagenBarArray[i]);
			}
		}
		Req.open("POST", "../admin/sporttv/uploadImageBar", true);
		
		Req.onload = function(Event) {
		//Validamos que el status http sea  ok
			if (Req.status == 200) {
				/*Como la info de respuesta vendrá en JSON 
				la parseamos */
				var nameImage2 = Req.responseText;
				ajaxSaveSporttv(id,nameImage,nameImage2,partnerId);
			} else {
		    	console.log(Req.status); //Vemos que paso.
			}
		};	
		Req.send(data);
	}
	
	//agrega o modifica los datos del sporttv y sporttv bar
	function ajaxSaveSporttv(id,nameImage,nameImage2,partnerId){
		
		if(deleteImagenBarArray.length > 0){
			ajaxDeleteImageBar();	
		}
		
		numPag = $('ul .current').val();
		
		if(nameImage2 != 0){
			nameImageBar = nameImage2.split('*-*');
			nameImageBar.pop();
			nameImageBar = JSON.stringify(nameImageBar);
			partnerId2 = JSON.stringify(partnerId);
		} else{
			nameImageBar = partnerId2 = 0;
		}
		
		$.ajax({
            	type: "POST",
            	url: "../admin/sporttv/saveSporttv",
            	dataType:'json',
            	data: { 
					id:id,
					name:$('#txtSporttvName').val(),
					torneo:$('#txtSporttvTournament').val(),
					sporttvTypeId:$('#txtSporttvType').val(),
					date:$('#dtSporttvDate').val(),
					image:nameImage,
					partnerId:partnerId2,
					nameImage:nameImageBar
            	},
				
            	success: function(data){
					console.log(data);
						ajaxMostrarTabla(column,order,"../admin/sporttv/getallSearch",(numPag-1),"sporttv");
						$('#FormSporttv').hide();
						$('#viewSporttv').show();
						$('#alertMessage').html(data);
						$('#divMenssage').show(1000).delay(1500);
						$('#divMenssage').hide(1000);
						$('.loading').hide();
						$('.bntSave').attr('disabled',false);
            },
				error: function(data){
					ajaxMostrarTabla(column,order,"../admin/sporttv/getallSearch",(numPag-1),"sporttv");
					$('#FormSporttv').hide();
					$('#viewSporttv').show();
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
					alert("error al insertar datos")	
				}
        	});
	}
	
	//actualiza el status del sporttv bar eliminado
	function ajaxDeleteImageBar(){
		deleteImage = JSON.stringify(deleteImagenBarArray);
		$.ajax({
            	type: "POST",
            	url: "../admin/sporttv/deleteSporttvBar",
            	dataType:'json',
            	data: { 
					deleteImage:deleteImage
            	},
            	success: function(data){
					deleteImagenBarArray.length = 0;
            	},
				error: function(data){
					alert("error al eliminar imagenes")
				}
        	});	
	}
	
	//muestra los datos del sporttvo a modificar
	function showsSporttv(id){
		$.ajax({
            	type: "POST",
            	url: "../admin/sporttv/getSporttvId",
            	dataType:'json',
            	data: { 
					id:id
            	},
            	success: function(data){
					var dateTime = data[0].date;
					var replaced = dateTime.replace(" ",'T');
					$('#txtSporttvName').val(data[0].name);
					$('#txtSporttvTournament').val(data[0].torneo);
					$('#txtSporttvType option[value="'+data[0].typeId +'"]').attr('selected', 'selected');
					$('#dtSporttvDate').val(replaced);
					$('#imgImagen').attr("src",URL_IMG + "app/sporttv/max/" + data[0].image);
					$('#imagenName').val(data[0].image);
            	}
        	});
			
			$.ajax({
            	type: "POST",
            	url: "../admin/sporttv/getSporttvBarId",
            	dataType:'json',
            	data: { 
					id:id
            	},
            	success: function(data){
					for(i = 0;i<data.length;i++){
						$('#gridImages').append(
						"<div id='imageBar' class='small-6 medium-6 large-6 columns "+ i + "'>"+
            			"<a id='imgDeleteBlack' class='"+ data[i].image + "' value='"+ i + "'><img src='../assets/img/web/deleteBlack.png' /></a>"+
						"<img id='imgImageSportBar' src='../assets/img/app/sporttv/min/" + data[i].image+ "' />"+
						"<input type='text' disabled value='" + data[i].namePartner + "' id='txtSporrtvBar' />"+
						"<input type='hidden' value='" + data[i].partnerId + "' class='idPartner' /'>"+
                		"</div>"
						);
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
		
		if($('#dtSporttvDate').val() < currentDate){
			$('#alertSporttvDate').empty();
			$('#alertSporttvDate').append("Fecha Incorrecta. Ingrese una fecha actual");
			$('#alertSporttvDate').show();
			$('#lblSporttvDate').addClass('error');
			$('#dtSporttvDate').focus();
			result = false;
		}
		
		if($('#dtSporttvDate').val().trim().length == 0){
			$('#alertSporttvDate').empty();
			$('#alertSporttvDate').append("Campo vacio. Ingrese una fecha");
			$('#alertSporttvDate').show();
			$('#lblSporttvDate').addClass('error');
			$('#dtSporttvDate').focus();
			result = false;
		}
		
		if($('#imagenName').val() == 0 && $('#fileImagen').val().length == 0){
			$('#alertImage').empty();
			$('#alertImage').append("Campo vacio. Selecione una imagen");
			$('#alertImage').show();
			result = false;
		}
		
		if($('#txtSporttvTournament').val().trim().length == 0){
			$('#alertTournament').show();
			$('#lblSporttvTournament').addClass('error');
			$('#txtSporttvTournament').focus();
			result = false;
		}
		
		if($('#txtSporttvName').val().trim().length == 0){
			$('#alertName').show();
			$('#lblSporttvName').addClass('error');
			$('#txtSporttvName').focus();
			result = false;
		}
		
		return result;
	}
	
	//valida el formulario para agregar un nuevo sporttv bar
	function validationSportBar(){
		result = true;
		hideAlertBar();
		
		if($('#fileImageBar').val().length == 0){
			$('#alertImageBar').empty();
			$('#alertImageBar').append("Campo vacio. Selecione una imagen");
			$('#alertImageBar').show();
			result = false;
		}
		
		valuePartner = $('#txtSporttvPartner').val();
		idPartner = $('datalist option[value="' + valuePartner + '"]').attr('id');
		if(idPartner == undefined){
			$('#alertPartner').html("Partner incorrecta. Por favor escriba una partner existente");
			$('#alertPartner').show();
			$('#lblSporttvPartner').addClass('error');
			$('#txtSporttvPartner').focus();
			result = false;
		}
		
		$('.idPartner').each(function() {
            if($(this).val() == idPartner){
				$('#alertPartner').html("Partner existente. Por favor seleccione otro partner");
				$('#alertPartner').show();
				$('#lblSporttvPartner').addClass('error');
				$('#txtSporttvPartner').focus();
				result = false;
			}
        });
		
		return result;
			
	}
	
	//oculta las alertas de error
	function hideAlert(){
		$('#alertName').hide()
		$('#alertTournament').hide();
		$('#alertType').hide();
		$('#alertSporttvDate').hide();
		$('#alertImage').hide();
		
		$('#lblSporttvName').removeClass('error');
		$('#lblSporttvTournament').removeClass('error');
		$('#lblSporttvType').removeClass('error');
		$('#lblSporttvDate').removeClass('error');
	}
	
	//oculta las alertas del formulario sporttv bar
	function hideAlertBar(){
		$('#alertImageBar').hide();
		$('#alertPartner').hide();
		
		$('#lblSporttvPartner').removeClass('error');
	}
	
	//limpia los campos del formulario
	function cleanFields(){
		$('#txtSporttvName').val("");
		$('#txtSporttvTournament').val("");
		$('#dtSporttvDate').val("");
		$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]")
		document.getElementById('fileImagen').value ='';
		$('#imagenName').val(0);
		
		$('#txtSporttvPartner').val("");
		$('#imgImageSporttv').attr("src","http://placehold.it/500x300&text=[ad]")
		document.getElementById('fileImageBar').value ='';
		
		$('#gridImages').empty();	
		idImagenBarArray.length = 0;
		idPartnerImagenBarArray.length = 0;
		valueImagenBarArray.length = 0;
		deleteImagenBarArray.length = 0;
		
		$('#divMenssage').hide();
		$('#divMenssagewarning').hide();
	}