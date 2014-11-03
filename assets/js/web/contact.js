$(function() {

    $(document).foundation();
    
    // Mapa
    initialize();
    
    $( ".dropDownImg" ).click(function() {
        if ($('#txtField').val() == ''){ 
            $('#txtField').css('border-color', 'red'); 
        }else
        window.location = URL_BASE+"busqueda/s/" + encodeURI($('#txtField').val());
    });
    $("#txtField").keydown(function (e) {
        if ($('#txtField').val() == ''){ 
            $('#txtField').css('border-color', 'red'); 
        }else
        if (e.keyCode == 13) { window.location = URL_BASE+"busqueda/s/" + encodeURI($(this).val()); }
    });
    
    // Stik menu
    $('.mainMenu').hachiko();
    
    $('#btnEnviar').click(function(){
        sendContact();
    });
    
    $('input').focus(function() {
        $(this).removeClass("redLine");
    });

});

function initialize() {
    // Mapa
    var latCenter = new google.maps.LatLng(21.153967, -86.821031);
    var mapOptions = {
        scrollwheel: false,
        center: latCenter,
        zoom: 12
    };
    var map = new google.maps.Map(document.getElementById("gMap"), mapOptions);

    var marker = new google.maps.Marker({
        position: latCenter,
        map: map,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        animation: google.maps.Animation.DROP
    });
}

function sendContact(){
    var isReady = true;
    // Validar empty
    elems = new Array("#name","#email","#subject","#mesage");
    for(i = 0; i < elems.length; i++){
        if ($(elems[i]).val() == ""){
            isReady = false;
            $(elems[i]).addClass("redLine");
        }else{
            $(elems[i]).removeClass("redLine");
        }
    }
    if (!isReady){
        $.msg({ content : 'Todos los campos son requeridos.' });
        return;
    }
    // Validar email format
    if(!isEmail($("#email").val())){
        isReady = false;
        $("#email").addClass("redLine");
        $.msg({ content : 'El email no tiene un formato correcto.' });
        return;
    }
    
    if (isReady){
        
        var request = $.ajax({
            type: "POST",
            url: URL_BASE + "contact/sendEmail",
            dataType:'json',
            data: { 
                name: $("#name").val(),
                email: $("#email").val(),
                subject: $("#subject").val(),
                mesage: $("#mesage").val()
            }
        });
        
        request.done(function( msg ) {
          endSend();
        });

        request.fail(function( jqXHR, textStatus ) {
          endSend();
        });
    }
}

function endSend(){
    $("#name").val('');
    $("#email").val('');
    $("#subject").val('');
    $("#mesage").val('');
    $.msg({ content : 'El mensaje fue enviado, en breve nuestro equipo se comunicara con usted.' });
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}