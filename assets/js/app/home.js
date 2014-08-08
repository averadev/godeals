/**
 * GeekBucket 2014
 * Author: Alberto Vera Espitia
 * Define funcionalidad en el home del app
 *
 */

$(function() {

    // Definicion de funcionalidad una ves que se cargo jquery
    consultaGenericaAjax();
    
});


/**
 * Ejemplo de una consulta al backend
 */
function consultaGenericaAjax(){
    $.ajax({
		type: "POST",
		url: "admin/home/getHello",
		dataType:'json',
		data: { 
			id: 1
		},
		success: function(data){
            $("#message").html("Say: "+data.mensaje);
		}
	});
}