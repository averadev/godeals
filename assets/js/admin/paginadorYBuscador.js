// JavaScript Document

var dato = "";
var order ="ASC";
var column = "id";

$(document).on('click','.btnPaginador',function(){ paginador(this); });

$('.arrowUp').click(function() { OrdenarPorFechas("ASC",this); });
$('.arrowDown').click(function() { OrdenarPorFechas("DESC",this); });

$('.btnSearch').click(function() { buscador(this); });

$('.txtSearch').keyup(function(e){
    if(e.keyCode ==13){
	buscador(this);	
    }
});


//funcion que cambia la paginacion
	function paginador(selecionado){
          
            var tipo = $(selecionado).attr('id').substring(12,selecionado.length).toLowerCase();
            var url = "";
                switch(tipo){
                    case "coupon":
                        url = "../admin/cupones/paginadorArray";
						$('ul #btnPaginadorCoupon').removeClass('current');
                    break;
                    case "partner":
                        url = "../admin/partners/paginadorArray";
						$('ul #btnPaginadorPartner').removeClass('current');
                    break;
                    case "event":
                        url = "../admin/eventos/paginadorArray";
                        $('ul #btnPaginadorEvent').removeClass('current');
					break;
					case "sporttv":
						url = "../admin/sporttv/paginadorArray";
						$('ul #btnPaginadorSporttv').removeClass('current');
					break;
					case "publicity":
						url = "../admin/publicity/paginadorArray";
						$('ul #btnPaginadorPublicity').removeClass('current');
					break;

                }
                    
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
                
		muestraNuevaTabla(url,cantidad,tipo);
		
	}
	
	function muestraNuevaTabla(url,cantidad,tipo){
            $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: { 
                dato:dato,
                cantidad:cantidad,
				order:order,
				column:column
            },
            success: function(data){
                total = data.length;
                
                switch(tipo){
                    case "coupon":     
                        $('#tableCoupon tbody').empty();
                        for(var i = 0;i<total;i++){
                            num = parseInt(cantidad) + parseInt((i+1));
                            $('#tableCoupon tbody').append("<tr>" + 
                            "<td>"+ num +"</td>"+
                            "<td><a id='showCoupon'>"+data[i].description+"<input type='hidden' id='idCoupon' value='" + data[i].id + "' >" +
                            "</a></td>"+
                            "<td>"+data[i].partnerName+"</td>"+
                            "<td>"+data[i].cityName+"</td>"+
                            "<td>"+data[i].iniDate+"</td>"+
                            "<td>"+data[i].endDate+"</td>"+
                            "<td><a id='imageDelete' value='" + data[i].id +"'><img id='imgDelete' "+
                            "src='../assets/img/web/deleteRed.png'/></a></td>" +
                            "</tr>");
                        }
                    break;
                                    
                    case "partner":
                       $('#tablePartners tbody').empty();
                        for(var i = 0;i<total;i++){
                            num = parseInt(cantidad) + parseInt((i+1));
                            $('#tablePartners tbody').append("<tr>" + 
                            "<td>"+ num +"</td>"+
                            "<td><a class='showPartner'>"+data[i].name+"<input type='hidden' id='idPartner' value='" + data[i].id + "' >" +
                            "</a></td>"+
                            "<td>"+data[i].categoryName+"</td>"+
                            "<td>"+data[i].phone+"</td>"+
                            "<td><a class='imageDelete' value='" + data[i].id +"'><img id='imgDelete' "+
								"src='../assets/img/web/deleteRed.png'/></a></td>" +
								"</tr>");
                        }
                    break;
                    
                     case "event":
					 
                       $('#tableEvents tbody').empty();
                        for(var i = 0;i<total;i++){
                            num = parseInt(cantidad) + parseInt((i+1));
                            $('#tableEvents tbody').append("<tr>" +
								"<td>"+ (num) +"</td>"+
								"<td><a id='showEvent'>"+data[i].name+"<input type='hidden' id='idEvent' value='" + 
								data[i].id + "' ></a></td>"+
								"<td>"+data[i].place+"</td>"+
								"<td>"+data[i].city+"</td>"+
								"<td>"+data[i].date+"</td>"+
								"<td><a id='imageDelete' value='" + data[i].id +"'><img id='imgDelete' "+
								"src='../assets/img/web/deleteRed.png'/></a></td>" +
								"</tr>");
                        }
                    break;
					
					case "sporttv":
                       $('#tableSporttv tbody').empty();
					   		for(var i = 0;i<total;i++){
                            num = parseInt(cantidad) + parseInt((i+1));
                            $('#tableSporttv tbody').append("<tr>" +
								"<td>"+ (num) +"</td>"+
								"<td><a id='showSporttv'>"+data[i].name+"<input type='hidden' id='idSporttv' value='" + 
								data[i].id + "' ></a></td>"+
								"<td>"+data[i].torneo+"</td>"+
								"<td>"+data[i].date+"</td>"+
								"<td><a id='imageDelete' value='" + data[i].id +"'><img class='imgDelete' "+
								"src='../assets/img/web/deleteRed.png'/></a></td>" +
								"</tr>");
					}
					break;
					
					case "publicity":
					
                       $('#tablePublicity tbody').empty();
					   		for(var i = 0;i<total;i++){
								
							switch(data[i].category){
								case '1':
									category = "Banner";
									break;
								case '2':
									category = "Medio Banner";
									break;
								case '3':
									category = "Lateral";
									break;
								case '4':
									category = "Cintillo";
									break;
								case '5':
									category = "Movil";
									break;
							}
								
                            num = parseInt(cantidad) + parseInt((i+1));
                            $('#tablePublicity tbody').append("<tr>" +
								"<td>"+ (num) +"</td>"+
								"<td><a id='showPublicity'>"+data[i].namePartner+
								"<input type='hidden' id='idPublicity' value='" + data[i].id + "' ></a></td>"+
								"<td>"+category+"</td>"+
								"<td>"+data[i].iniDate+"</td>"+
								"<td>"+data[i].endDate+"</td>"+
								"<td><a id='imageDelete' value='" + data[i].id +"'><img class='imgDelete' "+
								"src='../assets/img/web/deleteRed.png'/></a></td>" +
								"</tr>");
                        }
						break;
                }            	
            }
        });	
    }
	
	var category;
	
	//funcion que muestra los resultados ordenados por fecha
	function OrdenarPorFechas(typeOrder,typeTable){
		tableOrder = $(typeTable).attr('id');
		column = tableOrder;
		order = typeOrder;
		typeTable = $(typeTable).attr('value');
		if(typeTable == "coupon"){
			
		}
		switch(typeTable){
			case "coupon":
			url = "../admin/cupones/getallSearch";
			break;
			case "event":
			url = "../admin/eventos/getallSearch";
			break;
			case "sporttv":
			url = "../admin/sporttv/getallSearch";
            break;
			case "publicity":
			url = "../admin/publicity/getallSearch";
            break;
		}
		
		//llama a la funcion "ajax" que se encarga de mostrar los datos en la tabla
		ajaxMostrarTabla(tableOrder,typeOrder,url,0,typeTable);
	}
	
	//funcion que muestra los datos de cupones en la tabla
	function ajaxMostrarTabla(tipo,order,url,cantidadEmpezar,tipoTabla){
		pagActual = cantidadEmpezar + 1;
		cantidadEmpezar = cantidadEmpezar *10;
		var btnPaginador;
		$.ajax({
            type: "POST",
            url:url,
            dataType:'json',
            data: { 
				dato:dato,
				column:tipo,
				order:order,
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
				if(tipoTabla == "coupon"){
					$('#tableCoupon tbody').empty();
				} else if(tipoTabla == "event"){
					$('#tableEvents tbody').empty();
				}else if(tipoTabla == "partner"){
					$('#tablePartners tbody').empty();
				} else if(tipoTabla == "sporttv"){
					$('#tableSporttv tbody').empty();
				} else if(tipoTabla == "publicity"){
					$('#tablePublicity tbody').empty();
				}
                                
				$('.pagination').empty();
				for(var i = 0;i<10;i++){
					num = cantidadEmpezar + i;
					//rompe el ciclo si la cantidad de registros devueltos es menor a 10
					if(data[num] == undefined){
						break;	
					}
                                        
                    switch(tipoTabla)
					{
						case "coupon":
						$('#tableCoupon tbody').append("<tr>" + 
							"<td>"+(num+1)+"</td>"+
							"<td><a id='showCoupon'>"+data[num].description+"<input type='hidden' " + 
							"id='idCoupon' value='" + data[num].id + "' >" +
							"</a></td>"+
							"<td>"+data[num].partnerName+"</td>"+
							"<td>"+data[num].cityName+"</td>"+
							"<td>"+data[num].iniDate+"</td>"+
							"<td>"+data[num].endDate+"</td>"+
							"<td><a id='imageDelete' value='" + data[num].id +"'><img id='imgDelete' "+
							"src='../assets/img/web/deleteRed.png'/></a></td>" +
							"</tr>");
						btnPaginador = "btnPaginadorCoupon";
                        break;
						
						case "partner":
							$('#tablePartners tbody').append("<tr>" + 
								"<td>"+(num+1)+"</td>"+
								"<td><a class='showPartner'>"+data[num].name+"<input type='hidden' " + 
								"id='idPartner' value='" + data[num].id + "' >" +
								"</a></td>"+
								"<td>"+data[num].categoryName+"</td>"+
								"<td>"+data[num].phone+"</td>"+
								"<td><a class='imageDelete' value='" + data[num].id +"'><img id='imgDelete' "+
							"src='../assets/img/web/deleteRed.png'/></a></td>" +
							"</tr>");
                            btnPaginador = "btnPaginadorPartner"
							break;
                                        
                            case "event":
								
								$('#tableEvents tbody').append("<tr>" +
									"<td>"+ (num+1) +"</td>"+
									"<td><a id='showEvent'>"+data[num].name+"<input type='hidden' id='idEvent' value='" + 
									data[num].id + "' ></a></td>"+
									"<td>"+data[num].place+"</td>"+
									"<td>"+data[num].city+"</td>"+
									"<td>"+data[num].date+"</td>"+
									"<td><a id='imageDelete' value='" + data[num].id +"'><img id='imgDelete' "+
									"src='../assets/img/web/deleteRed.png'/></a></td>" +
									"</tr>");
								btnPaginador = "btnPaginadorEvent";
								break;
								
							case "sporttv":
							$('#tableSporttv tbody').append("<tr>" +
								"<td>"+ (num+1) +"</td>"+
								"<td><a id='showSporttv'>"+data[num].name+"<input type='hidden'" +
								"id='idSporttv' value='" + 
								data[num].id + "' ></a></td>"+
								"<td>"+data[num].torneo+"</td>"+
								"<td>"+data[num].date+"</td>"+
								"<td><a id='imageDelete' value='" + data[num].id +"'><img class='imgDelete' "+
								"src='../assets/img/web/deleteRed.png'/></a></td>" +
								"</tr>");
							btnPaginador = "btnPaginadorSporttv";
							break;
							case "publicity":
							var category;
							switch(data[num].category){
								case '1':
									category = "Banner";
									break;
								case '2':
									category = "Medio Banner";
									break;
								case '3':
									category = "Lateral";
									break;
								case '4':
									category = "Cintillo";
									break;
								case '5':
									category = "Movil";
									break;
							}
							$('#tablePublicity tbody').append("<tr>" +
								"<td>"+ (num+1) +"</td>"+
								"<td><a id='showPublicity'>"+data[num].namePartner+"<input type='hidden'" +
								"id='idPublicity' value='" + data[num].id + "' ></a></td>"+
								"<td>"+category+"</td>"+
								"<td>"+data[num].iniDate+"</td>"+
								"<td>"+data[num].endDate+"</td>"+
								"<td><a id='imageDelete' value='" + data[num].id +"'><img class='imgDelete' "+
								"src='../assets/img/web/deleteRed.png'/></a></td>" +
								"</tr>");
							btnPaginador = "btnPaginadorPublicity";
							break;
					}
                }
							
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
			}
		});	
	} 
	
	function buscador(typeTable){
            var type = $(typeTable).attr('id').substring(9,typeTable.length).toLowerCase();
		var palabra;
		var url;
		//muestra los datos en cupones
                switch(type){
                    case "coupon":
                        palabra = $('#txtSearchCoupon').val();
						url = "../admin/cupones/getallSearch";
                    break;
                    case "event":
                        palabra = $('#txtSearchEvent').val();
						url = "../admin/eventos/getallSearch";
                    break;
                
                    case "partner":
                        palabra = $('#txtSearchPartner').val();
						url = "../admin/partners/getallSearch";
                    break;
					
					case "sporttv":
                        palabra = $('#txtSearchSporttv').val();
						url = "../admin/sporttv/getallSearch";
                    break;
					case "publicity":
                        palabra = $('#txtSearchPublicity').val();
						palabra2 = palabra.toLowerCase();
						switch(palabra2){
							case "banner":
								palabra = 1;
							break;
							case "medio banner":
								palabra = 2;
							break;
							case "lateral":
								palabra = 3;
							break;
							case "cintillo":
								palabra = 4;
							break;
							case "movil":
								palabra = 5;
							break;
						}
						url = "../admin/publicity/getallSearch";
                    break;
                }
		
		column = "id";
		dato = palabra;
		//llama a la funcion "ajax" que se encarga de mostrar los datos en la tabla
		ajaxMostrarTabla(column,order,url,0,type);
	}