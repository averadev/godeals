// JavaScript Document


//cuando ingresa a ver los datos del partner
$(document).on('click','.showPartner',function(){ showEditForm(this);});
$('#btnAddPartner').click(function(){showAddForm();});
$(document).on('click','.imageDelete',function(){ showDeleteForm(this);});

//botones para el formulario de eliminar partners --barra dinamica que aparece cuando se pulsa el boton de eliminar
$('#btnAcceptP').click(function() {deletePartner();});
$('#btnCancelP').click(function() {cancelDeletePartner();});


$('#btnRegisterPartner').click(function() {addPartner();});
$('#btnSavePartner').click(function() {editPartner();});
$("#btnCancel").click(function() {CancelarForm();});

$("#imgImagen").click(function() {cambiarImagen();});

/* ----------------------------------------*/

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

function cambiarImagen(){
    $('#fileImagen').click();
}

function showAddForm(){
	limpiarCampos();
	$('#btnSavePartner').hide();
	$('#btnRegisterPartner').show();
	$('#vistaPartners').hide();
	$('#FormularioPartners').show();
}

function showEditForm(partner){
    limpiarCampos();
    id = $(partner).find('input').val();//obtiene la id del partner
    $('#btnSavePartner').val(id); 
    showPartner(id);
    $('#btnRegisterPartner').hide();
    $('#btnSavePartner').show();
    $('#vistaPartners').hide();
    $('#FormularioPartners').show();   
}

//muestra el formulario para eliminar eventos
function showDeleteForm(id){
    id = $(id).attr('value');
    $('#btnAcceptP').val(id);
    $('#divMenssagewarning').hide(500);
    $('#divMenssage').hide();
    $('#divMenssagewarning').show(1000);
}

//muestra los datos a modificar
function showPartner(id){
   
    $.ajax({
        type: "POST",
        url: "../admin/partners/getId",
        dataType:'json',
        data: { 
            id:id
        },
        success: function(data){
            console.log(data);
            $('#txtPartnerName').val(data[0].name);
            $('#selMapCat').append("<option selected value='" +  data[0].idCatMap + "'>"+data[0].categoryName + "</option>" );
            $('#txtPartnerAddress').val(data[0].address);
            $('#txtPartnerPhone').val(data[0].phone);
            $('#txtPartnerMail').val(data[0].mail);
            $('#txtPartnerTwitter').val(data[0].twitter);
            $('#txtPartnerFacebook').val(data[0].facebook);
            $('#imgImagen').attr("src",URL_IMG + "app/logo/" + data[0].logo)
            $('#imagenName').val(data[0].logo);
            $('#imgImagen').attr("hidden",data[0].logo)
            $('#txtPartnerLatitude').val(data[0].latitude);
            $('#txtPartnerLongitude').val(data[0].longitude);
            $('#vistaPartners').hide();
            $('#FormularioPartners').show();                
        }
    });   
}

//regresa a la tabla de 
function CancelarForm(){
    limpiarCampos();
    $('#FormularioPartners').hide();	
    $('#vistaPartners').show();
}

//funcion que inicia para la insercion de un partner
function addPartner(){
    var result;
    result = validations();

    if(result){
        uploadImage(0);	
    }	
}

//llama a la funcion de eliminar imagen y editar evento
function editPartner(){
    var result;
    result = validations();
    var id = $('#btnSavePartner').val();
    if(result){
        
        if(document.getElementById('fileImagen').value == ""){
            var nameImage = $('#imagenName').val();
            console.log('a' +  id);
            ajaxSavePartner(nameImage,id);
        } else {
            deleteImage(id);
        }
    }
}

//elimina el evento selecionado de la base de datos
function deletePartner(){
    id = $('#btnAcceptP').val();

    numPag = $('ul .current').val();
    
    $.ajax({
    type: "POST",
    url: "../admin/partners/deletePartner",
    dataType:'json',
        data: { 
            id:id
        },
        success: function(data){
            var aux = 0;
            $('#tablePartners tbody tr').each(function(index) {
                aux++;
            });

            //si es uno regarga la tabla con un indice menos
            if(aux == 1){
                numPag = numPag-1;
            }
            ajaxMostrarTabla(column,order,"../admin/partners/getAllSearch",(numPag-1),"partner");
            $('#divMenssagewarning').hide(1000);
            $('#alertMessage').empty();
            $('#alertMessage').append("se ha eliminado el socio");
            $('#divMenssage').show(1000).delay(1500);
            $('#divMenssage').hide(1000);
        }
    });
}

//cancela el formulario de eliminar partner
function cancelDeletePartner(){
    $('#divMenssagewarning').hide(1000);
}


//sube la nueva imagen
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
        Req.open("POST", "../admin/partners/uploadImage", true);
        //verificamos si se executo correctamente el metodo
        Req.onload = function(Event) {
            //Validamos que el status http sea ok 
            if (Req.status == 200) {
                    //Recibimos la respuesta de php
                    nameImage = Req.responseText;
                    ajaxSavePartner(nameImage,id);
            } else { 
                    //console.log(Req.status); //Vemos que paso.
            } 		
        };
        //Enviamos la petición 
        Req.send(data);			
}

//elimina la imagen del directorio assets/img/app/event
function deleteImage(id){
    nameImage = $('#imagenName').val();
    $.ajax({
        type: "POST",
        url: "../admin/partners/deleteImage",
        dataType:'json',
        data: { 
            deleteImage:nameImage
        },
        error: function(){
            uploadImage(id);
        }
    });
}

//agrega o modifica los datos del evento
function ajaxSavePartner(nameImage,id){

    var name = $('#txtPartnerName').val().trim();
    var idCatMap = $("#selMapCat option:selected").attr("value");
    var address = $('#txtPartnerAddress').val().trim();
    var phone = $('#txtPartnerPhone').val().trim();
    var mail = $('#txtPartnerMail').val().trim();
    var twitter = $('#txtPartnerTwitter').val().trim();
    var facebook = $('#txtPartnerFacebook').val().trim();
    var latitude = $('#txtPartnerLatitude').val().trim();
    var longitude = $('#txtPartnerLongitude').val().trim();
    
    numPag = $('ul .current').val();
    $.ajax({
        type: "POST",
        url: "../admin/partners/savePartner",
        dataType:'json',
        data: { 
            id:id,
            name:name,
            logo:nameImage,
            idCatMap:idCatMap,
            address:address,
            phone:phone,
            mail:mail,
            twitter:twitter,
            facebook:facebook,
            latitude:latitude,
            longitude:longitude		
        },
        success: function(data){
            ajaxMostrarTabla(column,order,"../admin/partners/getAllSearch",(numPag-1),"partner");
            $('#FormularioPartners').hide();
            $('#vistaPartners').show();
            $('#alertMessage').empty();
            if(id==0){
                $('#alertMessage').append("Se han agregado un nuevo partner");
            } else {
                $('#alertMessage').append("Se han editado los datos del partner");	
            }
            $('#divMenssage').show(1000).delay(1500);
            $('#divMenssage').hide(1000);
        },
        error: function(){
            alert("error al insertar datos");   
        }
    });
}


//funcion para validar los campos
function validations(){
    var result = true;

    ocultarAlertas();
		
    //valida que se haya selecionado una imagen
    if($('#imagenName').val() == 0 && $('#fileImagen').val().length == 0){
        $('#alertImage').empty();
        $('#alertImage').append("Campo vacio. Selecione una imagen");
        $('#alertImage').show();
        result = false;
    }
    
    if($('#txtPartnerName').val().trim().length == 0){
        $('#alertPartnerName').show();
        $('#lblPartnerName').addClass('error');
        $('#txtPartnerName').focus();
        result = false;
    }

    //obtener el valor del idMapCat
    
    var idCatMap = $("#selMapCat option:selected").attr("value");
    //valida que la catMap selecionada no este vacia y que exista
    
    if(idCatMap == undefined){
        $('#alertPartnerMapCat').show();
        $('#lblPartnerMapCat').addClass('error');
        $('#txtPartnerMapCat').focus();
        result = false;
    }
		
    if($('#txtPartnerAddress').val().trim().length == 0){
        $('#alertPartnerAddress').show();
        $('#lblPartnerAddress').addClass('error');
        $('#txtPartnerAddress').focus();
        result = false;
    }
    
    /*
    if($('#txtPartnerPhone').val().trim().length == 0){
        $('#alertPartnerPhone').show();
        $('#lblPartnerPhone').addClass('error');
        $('#txtPartnerPhone').focus();
        result = false;
    }
    
    if($('#txtPartnerMail').val().trim().length == 0){
        $('#alertPartnerMail').show();
        $('#lblPartnerMail').addClass('error');
        $('#txtPartnerMail').focus();
        result = false;
    }
    
    if($('#txtPartnerTwitter').val().trim().length == 0){
        $('#alertPartnerTwitter').show();
        $('#lblPartnerTwitter').addClass('error');
        $('#txtPartnerTwitter').focus();
        result = false;
    }
    
    if($('#txtPartnerFacebook').val().trim().length == 0){
        $('#alertPartnerFacebook').show();
        $('#lblPartnerFacebook').addClass('error');
        $('#txtPartnerFacebook').focus();
        result = false;
    }*/
    
    if($('#txtPartnerLatitude').val().trim().length == 0){
        $('#alertPartnerLatitude').show();
        $('#lblPartnerLatitude').addClass('error');
        $('#txtPartnerLatitude').focus();
        result = false;
    }
    
    if($('#txtPartnerLongitude').val().trim().length == 0){
        $('#alertPartnerLongitude').show();
        $('#lblPartnerLongitude').addClass('error');
        $('#txtPartnerLongitude').focus();
        result = false;
    }
    
    return result;
}

function limpiarCampos(){
    $('#txtPartnerName').val("");
    $('#selMapCat').val("");
    $('#txtPartnerAddress').val("");
    $('#txtPartnerPhone').val("");
    $('#txtPartnerMail').val("");
    $('#txtPartnerTwitter').val("");
    $('#txtPartnerFacebook').val("");
    $('#imgImagen').attr("src","http://placehold.it/500x300&text=[ad]");
    document.getElementById('fileImagen').value ='';
    $('#txtPartnerLatitude').val("");
    $('#txtPartnerLongitude').val("");
}
        
function ocultarAlertas(){
    $('#alertPartnerName').hide()
    $('#alertPartnerMapCat').hide();
    $('#alertPartnerAddress').hide();
    $('#alertPartnerPhone').hide();
    $('#alertPartnerMail').hide();
    $('#alertPartnerTwitter').hide();
    $('#alertPartnerFacebook').hide();
    $('#alertPartnerLatitude').hide();
    $('#alertPartnerLongitude').hide();

    $('#lblPartnerName').removeClass('error');
    $('#lblPartnerMapCat').removeClass('error');
    $('#lblPartnerAddress').removeClass('error');
    $('#lblPartnerPhone').removeClass('error');
    $('#lblPartnerMail').removeClass('error');
    $('#lblPartnerTwitter').removeClass('error');
    $('#lblPartnerFacebook').removeClass('error');
    $('#lblPartnerLatitude').removeClass('error');
    $('#lblPartnerLongitude').removeClass('error');
}
	