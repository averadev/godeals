var mapLoaded = false;
$(function() {
	
    // Tabs
    $(document).foundation({
    tab: {
        callback : function (tab) {
            console.log($('#gMap'));
            if($(tab).attr('id') == 'tabMapa'){
                initialize();
            }
        }
    }
    });
    
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
    
    // Mapa
    //initialize();
    
    // Triger galery
    $(".thumb").click(function() {
        src = $(this).attr('src').replace('thumb_', '');
        
        $(".master").fadeOut( "slow", function() {
            $(this).remove();
            var img = $('<img class="master hide" src="'+src+'" />');
            img.load(function(){
                $(".master").fadeIn("slow");
            });
            $( ".masterContainer" ).append(img);
        });
    });
    
});


function initialize() {
    // Mapa
    if (!mapLoaded){
        var latCenter = new google.maps.LatLng(21.060775, -86.779533);
        var mapOptions = {
            scrollwheel: false,
            center: latCenter,
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.HYBRID
        };
        var map = new google.maps.Map(document.getElementById("gMap"), mapOptions);

        var marker = new google.maps.Marker({
            position: latCenter,
            map: map,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            animation: google.maps.Animation.DROP
        });
        mapLoaded = true;
    }
}