var stickyNavTop;
$(function() {
	// Top Slider
    $(document).foundation('orbit', {
        bullets_container_class: 'orbit-bullets banner-bullets'
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
    
    $( ".optProductos" ).click(function() {
        window.location = URL_BASE+"productos";
    });
    $( "#logoGo" ).click(function() {
        window.location = URL_BASE;
    });
    $( ".promoLink" ).click(function() {
        window.location = URL_BASE + "busqueda/c/" + $(this).attr("attr-id") + "/" + $(this).attr("attr-name").replaceAll(" ", "-");
    });
    $( ".linkPartner" ).click(function() {
        window.location = URL_BASE + "busqueda/c/" + $(this).attr("attr-id") + "/" + $(this).html().replaceAll(" ", "-");
    });
    
    // On load window modal
    $( ".openModal" ).click(function() {
        $.prompt("<div class='loadC'></div>", 
        {title: $(this).attr('attr-description')});
        
        $.ajax({
            type: "POST",
            url: URL_BASE+"home/getCoupon",
            dataType:'json',
            data: { 
                id: $(this).attr('attr-id')
            },
            success: function(data){
                
                var template = "<image class='logoModal' src='"+URL_IMG+"app/logo/"+data.logo+"' />";
                template += "<p class='detailComercio'><a onclick='searchComercio(\""+data.partnerId+"\", \""+data.partnerName+"\");'>"+data.partnerName+"</a> <br/> ";
                template += "<a onclick='searchCiudad(\""+data.cityId+"\", \""+data.cityName+"\");'>"+data.cityName+"</a></p>";
                template += "<p class='detailValidity'>"+data.validity+"</p>";
                template += "<p class='detailDesc'><b>Detalle:</b><br/>"+data.detail+"</p>";
                template += "<p class='detailTerminos'><b>Términos y Condiciones:</b><br/>"+data.clauses+"</p>";
                
                
                
                template = "<div class='descCupon'>" + template + "</div>";
                
                var imgCupon = "<div class='cuponMaxImg'><image src='"+URL_IMG+"app/coupon/max/"+data.image+"' /></div>";
                
                $("div.jqi .jqimessage").html(imgCupon + template);
            }
        });
    });
    $( "#eventClose" ).click(function() {
        $('#couponModal').foundation('reveal', 'close');
    });
    
   
    // Stik menu
    $('.mainMenu').hachiko();
});

function searchComercio(id, comercio){
    window.location = URL_BASE + "busqueda/c/" + id + "/" + comercio.replaceAll(" ", "-");
}
function searchCiudad(id, comercio){
    window.location = URL_BASE + "busqueda/p/" + id + "/" + comercio.replaceAll(" ", "-");
}


String.prototype.replaceAll = function(target, replacement) {
  return this.split(target).join(replacement);
};

