var map;
var marker = new Array();
var infoMin = new Array();

$(function() {
    // Events
    $( ".toggleB" ).click(function() {
        if ($(this).hasClass("clima")){
            $($($( this ).parent().children()[1]).children()[1]).removeClass("toggleSelect");
            $($($( this ).parent().children()[0]).children()[1]).addClass("toggleSelect");
            $(this).parent().find( ".info2" ).hide();
            $(this).parent().find( ".info1" ).show();
        }else{
            $($($( this ).parent().children()[0]).children()[1]).removeClass("toggleSelect");
            $($($( this ).parent().children()[1]).children()[1]).addClass("toggleSelect");
            $(this).parent().find( ".info1" ).hide();
            $(this).parent().find( ".info2" ).show();
        }
    });
    
    // Menu
    $( ".menu" ).click(function() {
        var titulo = $($(this).children()[0]).html().replaceAll(" ", "-").toLowerCase();
        window.location = URL_BASE + "adondeir/c/"+$(this).attr("attr-id")+"/"+titulo;
    });
    // View Detail
    $( ".btnView" ).click(function() {
        var titulo = $(this).attr("attr-name").replaceAll(" ", "-").toLowerCase();
        window.location = URL_BASE + "adondeir/destino/"+$(this).attr("attr-id")+"/"+titulo;
    });
    
    // Clima
    $.simpleWeather({
        location: 'Cancun, QR',
        woeid: '',
        unit: 'c',
        success: function(weather) {
            html = '<h1><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'</h1>';
            $(".weather").html(html);
        },
        error: function(error) {
            $(".weather").html('<p>'+error+'</p>');
        }
    });
	
    // Slider
    $(document).foundation('orbit', {
        timer: false,
        bullets: false
    });
    
    // Stik menu
    $('.mainMenu').hachiko();
    
    // Mapa
    initialize();
    
    $(".mapSub")
    .mouseenter(function() {
        marker[$(this).attr('marker')].setAnimation(google.maps.Animation.BOUNCE);
        infoMin[$(this).attr('marker')].open(map, marker[$(this).attr('marker')]);
    })
    .mouseleave(function() {
        marker[$(this).attr('marker')].setAnimation(null);
        infoMin[$(this).attr('marker')].close();
    });
});


function initialize() {
    // Mapa
    var latCenter = new google.maps.LatLng(20.931233, -88.185186);
    var mapOptions = {
        scrollwheel: false,
        center: latCenter,
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("gMap"), mapOptions);
    
    // Marcadores
    marker['latCancun'] = new google.maps.Marker({
        position: new google.maps.LatLng(21.156875, -86.825312),
        map: map,
        title:"Cancun",
        animation: google.maps.Animation.DROP
    });
    marker['latPlaya'] = new google.maps.Marker({
        position: new google.maps.LatLng(20.621627, -87.075206),
        map: map,
        title:"Cancun",
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latCozumel'] = new google.maps.Marker({
        position: new google.maps.LatLng(20.511125, -86.949767),
        map: map,
        title:"Cancun",
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latMerida'] = new google.maps.Marker({
        position: new google.maps.LatLng(20.967324, -89.623454),
        map: map,
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latValladolid'] = new google.maps.Marker({
        position: new google.maps.LatLng(20.690559, -88.201251),
        map: map,
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latPueroM'] = new google.maps.Marker({
        position: new google.maps.LatLng(20.848054, -86.876068),
        map: map,
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latIsla'] = new google.maps.Marker({
        position: new google.maps.LatLng(21.256150, -86.748442),
        map: map,
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latHolbox'] = new google.maps.Marker({
        position: new google.maps.LatLng(21.524109, -87.380165),
        map: map,
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latChichen'] = new google.maps.Marker({
        position: new google.maps.LatLng(20.684275, -88.567791),
        map: map,
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latCoba'] = new google.maps.Marker({
        position: new google.maps.LatLng(20.489577, -87.734783),
        map: map,
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latTulum'] = new google.maps.Marker({
        position: new google.maps.LatLng(20.210635, -87.464690),
        map: map,
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latXelha'] = new google.maps.Marker({
        position: new google.maps.LatLng(20.319016, -87.357636),
        map: map,
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    marker['latXcaret'] = new google.maps.Marker({
        position: new google.maps.LatLng(20.580727, -87.119424),
        map: map,
        animation: google.maps.Animation.DROP,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    });
    
    infoMin['latCancun'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Cancun</h5>'});
    infoMin['latPlaya'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Playa del Carmen</h5>'});
    infoMin['latCozumel'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Cozumel</h5>'});
    infoMin['latMerida'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Merida</h5>'});
    infoMin['latValladolid'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Valladolid</h5>'});
    infoMin['latPueroM'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Puerto Morelos</h5>'});
    infoMin['latIsla'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Isla Mujeres</h5>'});
    infoMin['latHolbox'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Isla Holbox</h5>'});
    infoMin['latChichen'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Chichén-Itza</h5>'});
    infoMin['latCoba'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Coba</h5>'});
    infoMin['latTulum'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Tulum</h5>'});
    infoMin['latXelha'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Xelha</h5>'});
    infoMin['latXcaret'] = new google.maps.InfoWindow({content: '<h5 class="firstHeading">Xcaret</h5>'});
    
}

String.prototype.replaceAll = function(target, replacement) {
  return this.split(target).join(replacement);
};