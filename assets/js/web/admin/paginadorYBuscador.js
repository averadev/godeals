// JavaScript Document

var dato = "";
var order ="ASC";
var column = "id";

$(document).on('click','#btnPaginadorCoupon',function(){ paginador(this,"coupon"); });
$('#arrowUpFI').click(function() { OrdenarPorFechas("iniDate","ASC","coupon"); });
$('#arrowUpFF').click(function() { OrdenarPorFechas("endDate","ASC","coupon"); });
$('#arrowDownFI').click(function() { OrdenarPorFechas("iniDate","DESC","coupon"); });
$('#arrowDownFF').click(function() { OrdenarPorFechas("endDate","DESC","coupon"); });

$('.btnSearch').click(function() { buscador(this); });

$('.txtSearch').keyup(function(e){
if(e.keyCode ==13){
	buscador(this);	
}
});

//funcion que cambia la paginacion
	function paginador(selecionado,tipo){
		if(tipo == "coupon"){
			var url = "../admin/cupones/paginadorArray";
			$('ul #btnPaginadorCoupon').removeClass('current');
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
				if(tipo == "coupon"){
					$('#tableCupones tbody').empty();
					for(var i = 0;i<total;i++){
						num = parseInt(cantidad) + parseInt((i+1));
						$('#tableCupones tbody').append("<tr>" + 
						"<td>"+ num +"</td>"+
						"<td><a id='modificarDescription'>"+data[i].description+"<input type='hidden' id='idCoupon' value='" + data[i].id + "' >" +
						"</a></td>"+
						"<td>"+data[i].partnerName+"</td>"+
						"<td>"+data[i].cityName+"</td>"+
						"<td>"+data[i].iniDate+"</td>"+
						"<td>"+data[i].endDate+"</td>"+
						"<td><a id='imageDelete' value='" + data[i].id +"'><img id='imgDelete' "+
						"src='../assets/img/web/deleteRed.png'/></a></td>" +
						"</tr>");
					}
				}
            }
        });
		
		
	}
	
	//funcion que muestra los resultados ordenados por fecha
	function OrdenarPorFechas(tableOrder,typeOrder,typeTable){
		column = tableOrder;
		if(typeTable == "coupon"){
			url = "../admin/cupones/getallSearch";
		}
		//llama a la funcion "ajax" que se encarga de mostrar los datos en la tabla
		ajaxMostrarTabla(tableOrder,typeOrder,url,0,"coupon");
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
				$('#tableCupones tbody').empty();
				} else {
					
				}
				$('.pagination').empty();
				for(var i = 0;i<10;i++){
					num = cantidadEmpezar + i;
					//rompe el ciclo si la cantidad de registros devueltos es menor a 10
					if(data[num] == undefined){
						break;	
					}
					//muestra los datos en la tabla cupones
					if(tipoTabla == "coupon"){
						$('#tableCupones tbody').append("<tr>" + 
							"<td>"+(num+1)+"</td>"+
							"<td><a id='modificarDescription'>"+data[num].description+"<input type='hidden' " + 
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
					}
				}
				for(var i = 1;i<=cantidad;i++){
							
					if(pagActual == i){
						$('.pagination').append(
							"<li value=" + i + " id='" + btnPaginador + "' class='current'><a>" + i + "</a></li>"
						);
					} else {
						$('.pagination').append(
							"<li value=" + i + " id='" + btnPaginador + "'><a>" + i + "</a></li>"
						);
					}
				}
				$('.pagination').append(
					"<li value=" + cantidad + " id='" + btnPaginador + "' class='arrow ultimo'><a>&raquo;</a></li>"
				);
			}
		});	
	} 
	
	function buscador(typeTable){
		var palabra;
		var url;
		var tabla;
		type = $(typeTable).attr('id');
		//muestra los datos en cupones
		switch(type){
			case "btnSearchCoupon":
			palabra = $('#txtSearchCoupon').val();
			url = "../admin/cupones/getallSearch";
			tabla = "coupon";
			break;
			case "txtSearchCoupon":
			palabra = $('#txtSearchCoupon').val();
			url = "../admin/cupones/getallSearch";
			tabla = "coupon";
			break;
		}
		//column = "id";
		dato = palabra;
		//llama a la funcion "ajax" que se encarga de mostrar los datos en la tabla
		ajaxMostrarTabla(column,"ASC",url,0,tabla);
	}