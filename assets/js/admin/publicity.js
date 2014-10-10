// JavaScript Document

var originalDate = "";
var address = "";

//funcio que se llama cada vez que se teclea en el 'imput' partner
$("#txtPublicityPartner").keyup(function() { autocomplete(); });

//botones que muestran los diferentes formularios
$('#btnAddPublicity').click(function(){showFormAdd()});
$(document).on('click','#showPublicity',function(){ ShowFormEdit(this); });
$(document).on('click','#imageDelete',function(){ ShowFormDelete(this); });

//botones que registras,modifican o eliminan publcidad 
$('#btnRegisterPublicity').click(function() {eventAdd()});
$('#btnSavePublicity').click(function() {eventEdit()});
$('#btnCancel').click(function() {eventCancel()});

//botones para el formulario de eliminar la publcidad
$('.btnAcceptE').click(function() {eventDelete()});
$('.btnCancelE').click(function() {eventCancelDelete()});

//llama a la funcion cada vez que se quiere cambiar la imagen
$("#imgImagen").click(function() {changeImage()});

//visualizar imagen

	$(window).load(function(){
 		$(function() {
			//detecta cada vez que hay un cambio en el formulario de imagen
 			$('#fileImagen').change(function(e) {
				$('#lblPublicityImage').removeClass('error');
	  			$('#alertImage').hide();
				$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]");
	  			if($('#imagenName').val() != 0){
		 			$('#imgImagen').attr("src",URL_IMG + address + $('#imagenName').val())
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
					$('#lblPublicityImage').addClass('error');
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

	function autocomplete(){
		palabra = $('#txtPublicityPartner').val();
		$.ajax({
			type: "POST",
			url: "../admin/partners/getPartner",
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
		})	
	}
	
	function showFormAdd(){
		cleanFields();
		hideAlert();
		$('#btnSavePublicity').hide();
		$('#btnRegisterPublicity').show();
		$('#viewPublicity').hide();
		$('#FormPublicity').show();
	}
	
	function ShowFormEdit(id){
		cleanFields();
		hideAlert();
		id = $(id).find('input').val();
		$('#btnSavePublicity').val(id); 
		showsPublicity(id);
		$('#btnRegisterPublicity').hide();
		$('#btnSavePublicity').show();
		$('#viewPublicity').hide();
		$('#FormPublicity').show();
	}
	
	function ShowFormDelete(id){
		id = $(id).attr('value');
		$('.btnAcceptE').val(id);
		$('#divMenssagewarning').hide(500);
		$('#divMenssage').hide();
		$('#divMenssagewarning').show(1000);	
	}
	
	function eventAdd(){
		var result;
		result  = validations();
		if(result){
			$('.loading').show();
			$('.loading').html('<img src="../assets/img/web/loading.gif" height="40px" width="40px" />');
			$('.bntSave').attr('disabled',true);
			uploadImage(0);		
		}
	}
	
	function eventEdit(){
		var result;
		result  = validations();
		if(result){
			id = $('#btnSavePublicity').val();
			$('.loading').show();
			$('.loading').html('<img src="../assets/img/web/loading.gif" height="40px" width="40px" />');
			$('.bntSave').attr('disabled',true);
			
			if(document.getElementById('fileImagen').value == ""){
				var nameImage = $('#imagenName').val();
				ajaxSavePublicity(id,nameImage);
			} else {
				uploadImage(id);
			}		
		}	
	}
	
	function eventCancel(){
		cleanFields();
		hideAlert();
		$('#FormPublicity').hide();
		$('#viewPublicity').show();
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
            url: "../admin/publicity/deletePublicity",
            dataType:'json',
            data: { 
				id:id
			},
            success: function(data){
					var aux = 0;
					$('#tablePublcity tbody tr').each(function(index) {
                        aux++;
                    });
					//si es uno regarga la tabla con un indice menos
					if(aux == 1){
						numPag = numPag-1;
					}
					ajaxMostrarTabla(column,order,"../admin/publicity/getallSearch",(numPag-1),"publicity");
					$('#divMenssagewarning').hide(1000);
					$('#alertMessage').html(data);
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
            	}
		});
	}
	
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
		data.append('category',$('#sltPublicityCategory').val());
		
		//abrimos la conexion para subir una imagen
		Req.open("POST", "../admin/publicity/uploadImage", true);
		//verificamos si se executo correctamente el metodo
		Req.onload = function(Event) {
			//Validamos que el status http sea ok 
			if (Req.status == 200) {
 	 			//Recibimos la respuesta de php
				nameImage = Req.responseText;
				ajaxSavePublicity(id,nameImage);
			} else { 
  				//console.log(Req.status); //Vemos que paso.
			} 		
		};
		//Enviamos la petición 
 		Req.send(data);		
	}
	
	function ajaxSavePublicity(id,nameImage){
		valuePartner = $('#txtPublicityPartner').val();
		idPartner = $('datalist option[value="' + valuePartner + '"]').attr('id');
		numPag = $('ul .current').val();
		
		$.ajax({
            	type: "POST",
            	url: "../admin/publicity/saveEvent",
            	dataType:'json',
            	data: { 
					id:id,
					partnerId:idPartner,
					image:nameImage,
					iniDate:$('#dtPublicityIniDate').val(),
					endDate:$('#dtPublicityEndDate').val(),
					category:$('#sltPublicityCategory').val()
            	},
            	success: function(data){
					ajaxMostrarTabla(column,order,"../admin/publicity/getallSearch",(numPag-1),"publicity");
					$('#FormPublicity').hide();
					$('#viewPublicity').show();
					$('#alertMessage').html(data);
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
            	},
				error: function(){
					ajaxMostrarTabla(column,order,"../admin/publicity/getallSearch",(numPag-1),"publicity");
					$('#FormPublicity').hide();
					$('#viewPublicity').show();
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
					alert("error al insertar datos")
				}
        	});
	}
	
	function showsPublicity(id){
		$.ajax({
            	type: "POST",
            	url: "../admin/publicity/getId",
            	dataType:'json',
            	data: { 
					id:id
            	},
            	success: function(data){
					$('#txtPublicityPartner').val(data[0].namePartner);
					$('#partnerList').append("<option id='" + data[0].partnerId + "' value='" +  data[0].namePartner + "' />" );
					$("#sltPublicityCategory option[value='"+ data[0].category + "']").attr("selected",true);
					$('#dtPublicityIniDate').val(data[0].iniDate);
					$('#dtPublicityEndDate').val(data[0].endDate);
					$('#cityList').append("<option id='" + data[0].idCity + "' value='" +  data[0].cityName + "' />");
					
					$('#imagenName').val(data[0].image);
					originalDate = $('#dtPublicityIniDate').val();
					
					switch(data[0].category ){
						case '1':
							address = "app/publicity/banner/";
							break;
						case '2':
							address = "app/publicity/cintillo/";
							break;
						case '3':
							address = "app/publicity/lateral/";
							break;
						case '4':
							address = "app/publicity/movil/";
							break;
					}
					$('#imgImagen').attr("src",URL_IMG + address + data[0].image);
            	}
        	});
	}
	
	function validations(){
		var result = true;
		
		hideAlert();
		
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
		
		if(originalDate != "" && $('#dtPublicityIniDate').val() < fechaActual){
			$('#alertIniDate').html("Fecha Incorrecta. Ingrese una fecha actual o la fecha default");
			$('#alertIniDate').show();
			$('#lblPublicityIniDate').addClass('error');
			result = false;
			if(originalDate != "" && $('#dtPublicityIniDate').val() == originalDate){
				$('#alertIniDate').hide();
				$('#labelIniDate').removeClass('error');
				result = true;
			}
		} 
		
		//valida que se haya seleccionado una imagen
		if($('#imagenName').val() == 0 && $('#fileImagen').val().length == 0){
			$('#alertImage').html("Campo vacio. Selecione una imagen");
			$('#alertImage').show();
			$('#lblPublicityImage').addClass('error');
			result = false;
		}
		
		//detecta que la fecha de inicio sea mayor o igual a la fecha actual
		if($('#dtPublicityIniDate').val() < fechaActual && originalDate == ""){
			$('#alertIniDate').html("Fecha Incorrecta. Ingrese una fecha actual");
			$('#alertIniDate').show();
			$('#lblPublicityIniDate').addClass('error');
			$('#dtPublicityIniDate').focus();
			result = false;
		}
		
		//valida que la fecha final sea mayor o igual a la de inicio
		if($('#dtPublicityEndDate').val() < $('#dtPublicityIniDate').val()){
			$('#alertEndDate').html("Fecha Incorrecta. Ingrese una fecha mayor a fecha inicio");
			$('#alertEndDate').show();
			$('#lblPublicityEndDate').addClass('error');
			$('#dtPublicityEndDate').focus();
			result = false;
		}
		
		//valida que se haya selecionado una fecha final
		if($('#dtPublicityEndDate').val().trim().length == 0){
			$('#alertEndDate').html("Campo vacio. Ingrese una fecha");
			$('#alertEndDate').show();
			$('#lblPublicityEndDate').addClass('error');
			$('#dtPublicityEndDate').focus();
			result = false;
		}
		
		//valida que se haya selecionado una fecha final
		if($('#dtPublicityEndDate').val().trim() < fechaActual){
			$('#alertEndDate').html("Fecha Incorrecta. selecione una fecha igual o mayor a la de hoy");
			$('#alertEndDate').show();
			$('#lblPublicityEndDate').addClass('error');
			$('#dtPublicityEndDate').focus();
			result = false;
		}
		
		//valida que la fecha de inicio no esta vacia
		if($('#dtPublicityIniDate').val().trim().length == 0){
			$('#alertIniDate').empty();
			$('#alertIniDate').append("Campo vacio. Ingrese una fecha");
			$('#alertIniDate').show();
			$('#lblPublicityIniDate').addClass('error');
			$('#dtPublicityIniDate').focus();
			result = false;
		}
		
		//valida si se seleciona una categoria correcta
		if($('#sltPublicityCategory').val() == 0){
			$('#alertCategory').show();
			$('#lblPublicityCategory').addClass('error');
			result = false;	
		}
		
		//valida si el partner escrito es correcto o si no esta vacio
		valuePartner = $('#txtPublicityPartner').val();
		idPartner = $('datalist option[value="' + valuePartner + '"]').attr('id');
		if(idPartner == undefined){
			$('#alertPartner').html("Partner incorrecta. Por favor escriba una partner existente");
			$('#alertPartner').show();
			$('#lblPublicityPartner').addClass('error');
			$('#txtPublicityPartner').focus();
			result = false;
		}
		
		return result;
	}
	
	function hideAlert(){
		$('#alertPartner').hide();
		$('#alertCategory').hide();
		$('#alertIniDate').hide();
		$('#alertEndDate').hide();
		$('#alertImage').hide();
		
		$('#lblPublicityPartner').removeClass('error');
		$('#lblPublicityCategory').removeClass('error');
		$('#lblPublicityIniDate').removeClass('error');
		$('#lblPublicityEndDate').removeClass('error');
		$('#lblPublicityImage').removeClass('error');
	}
	
	function cleanFields(){
		$('#txtPublicityPartner').val("");
		$('#partnerList').empty();
		$("#sltPublicityCategory option[value='0']").attr("selected",true);
		$('#dtPublicityIniDate').val("");
		$('#dtPublicityEndDate').val("");
		$('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]")
		document.getElementById('fileImagen').value ='';	
		originalDate = "";
	}
	
	