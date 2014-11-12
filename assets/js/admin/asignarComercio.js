// JavaScript Document

var dato = "";

//funcio que se llama cada vez que se teclea en el 'imput' city
$("#txtAsigComerPartner").keyup(function() { autocomplete(); });

$(document).on('click','#imageDelete',function(){ ShowFormDelete(this); });

//botones que registras,modifican o eliminan eventos 
$('#btnRegisterAsigComer').click(function() {eventAdd()});

//botones para el formulario de eliminar asignacion
$('.btnAcceptE').click(function() {eventDelete()});
$('.btnCancelE').click(function() {eventCancelDelete()});

//paginador//

$(document).on('click','.btnPaginador',function(){ paginador(this); });

// fin visualizar imagen

	//muestra las ciudades existentes en la base de datos
	function autocomplete(){
		palabra = $('#txtAsigComerPartner').val();
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
		});	
	}
	
	function ShowFormDelete(partnerId){
		partnerId = $(partnerId).attr('value');
		$('.btnAcceptE').val(partnerId);
		$('#divMenssagewarning').hide(500);
		$('#divMenssage').hide();
		$('#divMenssagewarning').show(1000);
	}
	
	function eventCancel(){
		cleanFields();
		hideAlert();
		$('#FormAsigComer').hide();	
		$('#viewAsigComer').show();
	}
	
	function eventAdd(){
		var result;
		result = validations();
		if(result){
			$('.loading').show();
			$('.loading').html('<img src="../assets/img/web/loading.gif" height="40px" width="40px" />');
			$('.bntSave').attr('disabled',true);
			ajaxSaveEvent(0);
		}	
	}
	
	//cancela el formulario de eliminar un lugar
	function eventCancelDelete(){
		$('#divMenssagewarning').hide(1000);
	}
	
	//elimina el evento selecionado de la base de datos
	function eventDelete(){
		partnerId = $('.btnAcceptE').val();
		numPag = $('ul .current').val();
		$.ajax({
            type: "POST",
            url: "../admin/asignarComercio/deleteXref",
            dataType:'json',
            data: { 
				idPlace:$('#idPlace').val(),
				idPartner:partnerId,
			},
            success: function(data){
					var aux = 0;
					$('#tableAsigComer tbody tr').each(function(index) {
                        aux++;
                    });
					//si es uno regarga la tabla con un indice menos
					if(aux == 1){
						numPag = numPag-1;
					}
					ajaxMostrarTabla("../admin/asignarComercio/getallSearch",(numPag-1));
					$('#divMenssagewarning').hide(1000);
					$('#alertMessage').html(data);
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
            	}
		});
	}
	
	//agrega o modifica los datos del evento
	function ajaxSaveEvent(typeQuery){
		//regresa la id de la ciudad
		valuePartner = $('#txtAsigComerPartner').val();
		idPartner = $('datalist option[value="' + valuePartner + '"]').attr('id');
		numPag = $('ul .current').val();
		$.ajax({
            	type: "POST",
            	url: "../admin/asignarComercio/saveEvent",
            	dataType:'json',
            	data: {
					typeQuery:typeQuery,
					idPlace:$('#idPlace').val(),
					idPartner:idPartner,
					idPartner2:$('#btnSaveAsigComer').val(),
					type:$('#slAsigComerType').val()
            	},
            	success: function(data){
					if(numPag == undefined){
						ajaxMostrarTabla("../admin/asignarComercio/getallSearch",(0));
					} else {
						ajaxMostrarTabla("../admin/asignarComercio/getallSearch",(numPag-1));	
					}
					
					cleanFields();
					$('#alertMessage').html(data);
					$('#divMenssage').show(1000).delay(1500);
					$('#divMenssage').hide(1000);
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
            	},
				error: function(){
					ajaxMostrarTabla("../admin/asignarComercio/getallSearch",(numPag-1));
					cleanFields();
					$('.loading').hide();
					$('.bntSave').attr('disabled',false);
					alert("error al insertar datos")
				}
        	});
	}
	
	function validations(){
		var result = true;
		
		hideAlert();
		
		valuePartner = $('#txtAsigComerPartner').val();
		idPartner = $('datalist option[value="' + valuePartner + '"]').attr('id');
		if(idPartner == undefined){
			$('#alertPartner').html("Socio incorrecto. Porfavor seleccione un socio existente");
			$('#alertPartner').show();
			$('#lblAsigComerPartner').addClass('error');
			$('#txtAsigComerPartner').focus();
			result = false;
		}
		
		if($('#slAsigComerType').val() == 0){
			$('#alertType').show();
			$('#lblAsigComerType').addClass('error');
			$('#txtAsigComerType').focus();
			result = false;
		}
		
		$.ajax({
			type: "POST",
            url: "../admin/asignarComercio/getXrefByIds",
            dataType:'json',
            data: { 
				placeId:$('#idPlace').val(),
				partnerId:idPartner
            },
			async:false,
            success: function(data){
				if(data.length > 0 && $('#valuePartner').val() == 0){
					$('#alertPartner').html("Socio utilizado. porfavor seleccione otro socio");
					$('#alertPartner').show();
					$('#lblAsigComerPartner').addClass('error');
					$('#txtAsigComerPartner').focus();
					result = false;
				}
				if(data.length > 0 && $('#valuePartner').val() != 0 && $('#valuePartner').val() != data[0].name){
					$('#alertPartner').html("Socio utilizado. porfavor seleccione otro socio");
					$('#alertPartner').show();
					$('#lblAsigComerPartner').addClass('error');
					$('#txtAsigComerPartner').focus();
					result = false;
				}
            }
        });
		
		return result;	
	}
	
	function hideAlert(){
		$('#alertPartner').hide();
		$('#alertType').hide();
		
		$('#lblAsigComerPartner').removeClass('error');
		$('#lblAsigComerType').removeClass('error');
	}
	
	function cleanFields(){
		$('#txtAsigComerPartner').val("");
		$('#partnerList').empty();
		$("#slAsigComerType option[value='0']").attr("selected",true);
		$('#valuePartner').val(0);
	}
	
	/****** paginador ********/
	
	function buscador(){
		var palabra;
		var url;
        palabra = $('#txtSearchAsigComer').val();
		url = "../admin/asignarComercio/getallSearch";
		dato = palabra;
		//llama a la funcion "ajax" que se encarga de mostrar los datos en la tabla
		ajaxMostrarTabla(url,0);	
	}
	
	//funcion que muestra los datos de cupones en la tabla
	function ajaxMostrarTabla(url,cantidadEmpezar){
		pagActual = cantidadEmpezar + 1;
		cantidadEmpezar = cantidadEmpezar *10;
		var btnPaginador;
		$.ajax({
            type: "POST",
            url:url,
            dataType:'json',
            data: {
				idPlace:$('#idPlace').val(),
				dato:dato,
				cantidad:cantidadEmpezar
            },
            success: function(data){
				total = data.length;
				cantidad = total/10;
				cantidad = parseInt(cantidad) + 1;
				if(total%10 == 0){
					cantidad = cantidad -1;
				}
				//elimina el contenido de la tabla selecionada
					$('#tableAsigComer tbody').empty();
                                
				$('.pagination').empty();
				
				conNum = 0;
				
				for(var i = 0;i<10;i++){
					num = cantidadEmpezar + i;
					//rompe el ciclo si la cantidad de registros devueltos es menor a 10
					if(data[num] == undefined){
						break;	
					}
					
						if(data[num].type == 1){
							conNum++;
							conNum2 = conNum + cantidadEmpezar;
							
						$('#tableAsigComer tbody').append("<tr>" + 
							"<td>"+(conNum2)+"</td>"+
							"<td>" +data[num].name + "</td>"+
							"<td>Hospedaje</td>"+
							"<td><a id='imageDelete' value='" + data[num].partnerId +"'><img id='imgDelete' "+
							"src='../assets/img/web/deleteRed.png'/></a></td>" +
							"</tr>");
						}
                }
				
				for(var i = 0;i<10;i++){
					num = cantidadEmpezar + i;
					//rompe el ciclo si la cantidad de registros devueltos es menor a 10
					if(data[num] == undefined){
						break;	
					}
					
						if(data[num].type == 2){
							conNum++;
							conNum2 = conNum + cantidadEmpezar;
						$('#tableAsigComer tbody').append("<tr>" + 
							"<td>"+(conNum2)+"</td>"+
							"<td>"+data[num].name+"</td>"+
							"<td>Restaurante</td>"+
							"<td><a id='imageDelete' value='" + data[num].partnerId +"'><img id='imgDelete' "+
							"src='../assets/img/web/deleteRed.png'/></a></td>" +
							"</tr>");
						}
                }
				
				for(var i = 0;i<10;i++){
					num = cantidadEmpezar + i;
					//rompe el ciclo si la cantidad de registros devueltos es menor a 10
					if(data[num] == undefined){
						break;	
					}
					
						if(data[num].type == 3){
							conNum++;
							conNum2 = conNum + cantidadEmpezar;
						$('#tableAsigComer tbody').append("<tr>" + 
							"<td>"+(conNum2)+"</td>"+
							"<td>"+data[num].name+"</td>"+
							"<td>Antro/Bar</td>"+
							"<td><a id='imageDelete' value='" + data[num].partnerId +"'><img id='imgDelete' "+
							"src='../assets/img/web/deleteRed.png'/></a></td>" +
							"</tr>");
						}
                }
				
				btnPaginador = "btnPaginadorAsigComer";
							
				$('.pagination').append(
					"<li value=" + cantidad + " id='" + btnPaginador + "' class='btnPaginador arrow primero'><a>&laquo;</a></li>"
				);
				
				for(var i = 1;i<=cantidad;i++){
							
					if(pagActual == i){
						$('.pagination').append(
							"<li value=" + i + " id='" + btnPaginador + "' class='btnPaginador current'><a>" + i + "</a></li>"
						);
					} else {
						$('.pagination').append(
							"<li value=" + i + " id='" + btnPaginador + "' class='btnPaginador'><a>" + i + "</a></li>"
						);
					}
				}
				$('.pagination').append(
					"<li value=" + cantidad + " id='" + btnPaginador + "' class='btnPaginador arrow ultimo'><a>&raquo;</a></li>"
				);
			},
		});	
	} 
	
	//funcion que cambia la paginacion
	function paginador(selecionado){
          
        url = "../admin/asignarComercio/paginadorArray";
		$('ul #btnPaginadorAsigComer').removeClass('current');
                    
		$(selecionado).addClass('current');
		var cantidad = $(selecionado).val();
		//compureba si el primer numero del paginador
		if(cantidad == 0 || cantidad ==1){
			$('ul .primero').addClass('unavailable');
			cantidad = 1;
		} else {
			$('ul .primero').removeClass('unavailable');
		}
		//comprueba si el ultimo numero del paginador
		var total = $('ul .ultimo').val();
		if(total == cantidad){
			$('ul .ultimo').addClass('unavailable');
		} else {
			$('ul .ultimo').removeClass('unavailable');
		}
		//obtiene la siguiente lista del paginador
		cantidad = (cantidad-1) *10;
                
		muestraNuevaTabla(url,cantidad);
		
	}
	
	function muestraNuevaTabla(url,cantidad){
            $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: {
				idPlace:$('#idPlace').val(),
                dato:dato,
                cantidad:cantidad
            },
            success: function(data){
                total = data.length;
           		
                $('#tableAsigComer tbody').empty();
				
				$('#tableAsigComer tbody').append("<tr><td colspan='4' style='text-align:center;'>Hospedaje</td></tr>");
				
				conNm = 0;
				
				for(var i = 0;i<total;i++){
                    num = parseInt(cantidad) + parseInt((i+1));
					
					if(data[num].type == 1){
						conNum++;
						conNum2 = conNum + cantidadEmpezar;
                    	$('#tableAsigComer tbody').append("<tr>" +
						"<td>"+ (conNum2) +"</td>"+
						"<td><a id='showAsigComer'>"+data[i].name+"<input type='hidden' id='idAsigComer' value='" + 
						data[i].partnerId + "' ></a></td>"+
						"<td>"+data[i].info+"</td>"+
						"<td><a id='imageDelete' value='" + data[i].partnerId +"'><img class='imgDelete' "+
						"src='../assets/img/web/deleteRed.png'/></a></td>" +
						"</tr>");
					}
                } 
				
				$('#tableAsigComer tbody').append("<tr><td colspan='4' style='text-align:center;'>Restaurante</td></tr>");
				
				for(var i = 0;i<total;i++){
                    num = parseInt(cantidad) + parseInt((i+1));
					
					if(data[num].type == 2){
						conNum++;
						conNum2 = conNum + cantidadEmpezar;
                    	$('#tableAsigComer tbody').append("<tr>" +
						"<td>"+ (conNum2) +"</td>"+
						"<td><a id='showAsigComer'>"+data[i].name+"<input type='hidden' id='idAsigComer' value='" + 
						data[i].partnerId + "' ></a></td>"+
						"<td>"+data[i].info+"</td>"+
						"<td><a id='imageDelete' value='" + data[i].partnerId +"'><img class='imgDelete' "+
						"src='../assets/img/web/deleteRed.png'/></a></td>" +
						"</tr>");
					}
                } 
				
				$('#tableAsigComer tbody').append("<tr><td colspan='4' style='text-align:center;'>Antro/Bar</td></tr>");
				
				for(var i = 0;i<total;i++){
                    num = parseInt(cantidad) + parseInt((i+1));
					
					if(data[num].type == 3){
						conNum++;
						conNum2 = conNum + cantidadEmpezar;
                    	$('#tableAsigComer tbody').append("<tr>" +
						"<td>"+ (conNum2) +"</td>"+
						"<td><a id='showAsigComer'>"+data[i].name+"<input type='hidden' id='idAsigComer' value='" + 
						data[i].partnerId + "' ></a></td>"+
						"<td>"+data[i].info+"</td>"+
						"<td><a id='imageDelete' value='" + data[i].partnerId +"'><img class='imgDelete' "+
						"src='../assets/img/web/deleteRed.png'/></a></td>" +
						"</tr>");
					}
                } 
				           	
            }
        });	
    }