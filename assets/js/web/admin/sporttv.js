// JavaScript Document

//funcio que se llama cada vez que se teclea en el 'imput' city
$("#txtSporttvCity").keyup(function() { autocomplete(); });

//botones que muestran los diferentes formularios
$('#btnAddSporttv').click(function(){showFormAdd()});
$(document).on('click','#showSporttv',function(){ ShowFormEdit(this); });
$(document).on('click','#imageDelete',function(){ ShowFormDelete(this); });

//botones que registras,modifican o eliminan Sporttv 
$('#btnRegisterSporttv').click(function() {sporttvAdd()});
$('#btnSaveSporttv').click(function() {sporttvEdit()});
$('#btnCancel').click(function() {sporttvCancel()});

//botones para el formulario de eliminar sporttvos
$('.btnAcceptE').click(function() {sporttvDelete()});
$('.btnCancelE').click(function() {sporttvCancelDelete()});

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
    });
  });
  
 	//abre el explorador de archivos cuando le das click a la imagen de cupones
	function changeImage(){
		$('#fileImagen').click();
	}

	// fin visualizar imagen

	//muestra el formulario para agregar sporttvos
	function showFormAdd(){
		cleanFields();
		hideAlert();
		$('#btnSaveSporttv').hide();
		$('#btnRegisterSporttv').show();
		$('#viewSporttv').hide();
		$('#FormSporttv').show();
	}
	
	//muestra el formulario para modificar sporttvos
	function ShowFormEdit(id){
		cleanFields();
		hideAlert();
		id = $(id).find('input').val();
		$('#btnSaveSporttv').val(id); 
		showsSporttv(id);
		$('#btnRegisterSporttv').hide();
		$('#btnSaveSporttv').show();
		$('#viewSporttv').hide();
		$('#FormSporttv').show();
	}
	
	//muestra el formulario para eliminar sporttvos
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
			uploadImage(0);
		}	
	}
	
	//llama a la funcion de eliminar imagen y editar sporttvo
	function sporttvEdit(){
		var result;
		result = validations();
		id = $('#btnSaveSporttv').val();
		if(result){
			if(document.getElementById('fileImagen').value == ""){
				var nameImage = $('#imagenName').val();
				ajaxSaveSporttv(nameImage,id);
			} else {
				deleteImage(id);
			}
				
		}
	}
	
	//cancela el formulario de eliminar sporttvo
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
					$('#alertMessage').empty();
					$('#alertMessage').append("se ha eliminado el sporttvo");
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
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
		Req.onload = function(Sporttv) {
			//Validamos que el status http sea ok 
			if (Req.status == 200) {
 	 			//Recibimos la respuesta de php
				nameImage = Req.responseText;
				ajaxSaveSporttv(nameImage,id);
			} else { 
  				//console.log(Req.status); //Vemos que paso.
			} 		
		};
		//Enviamos la petición 
 		Req.send(data);			
	}
	
	//agrega o modifica los datos del sporttvo
	function ajaxSaveSporttv(nameImage,id){
		numPag = $('ul .current').val();
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
					image:nameImage
            	},
            	success: function(data){
					ajaxMostrarTabla(column,order,"../admin/sporttv/getallSearch",(numPag-1),"sporttv");
					$('#FormSporttv').hide();
					$('#viewSporttv').show();
					$('#alertMessage').empty();
					if(id==0){
						$('#alertMessage').append("Se han agregado un nuevo sporttv");
					} else {
						$('#alertMessage').append("Se han editado los datos del sporttv");	
					}
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
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
	
	//limpia los campos del formulario
	function cleanFields(){
		$('#txtSporttvName').val("");
		$('#txtSporttvTournament').val("");
		$('#dtSporttvDate').val("");
		$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]")
		document.getElementById('fileImagen').value ='';
		$('#imagenName').val(0);
		$('#divMenssage').hide();
		$('#divMenssagewarning').hide();	
	}