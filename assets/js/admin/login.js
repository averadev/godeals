/**
 * GeekBucket 2014
 * Author: Alberto Vera Espitia
 * Define funcionalidad en el home del app
 *
 */

$(function() {

    $("#login").click(function() {
		verifyUser();
	});
    
    $("#username,#password").keypress(function(e) {
	    if(e.which == 13) { verifyUser(); }
	});
});

/**
 * Actualizamos el mensaje de alerta
 */
function showMsg(mensaje){
    $('#alertMsg').hide();
    $('#alertMsg').html(mensaje);
    $('#alertMsg').show('slow');
}


/**
 * Ejemplo de una consulta al backend
 */
function verifyUser(){
    if ($('#username').val() == ''
       || $('#password').val() == ''){
        showMsg('El usuario y password son requeridos.');
    }else{
        $.ajax({
            type: "POST",
            url: URL_BASE+"admin/home/login",
            dataType:'json',
            data: { 
                username: $('#username').val(),
                password: $('#password').val()
            },
            success: function(data){
                if (data.success){
                    window.location.href = URL_BASE + "admin/dashboard";
                }else{
                    showMsg(data.message);
                }
            }
        });
    }
}