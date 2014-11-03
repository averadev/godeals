$(function() {
    
    $(document).foundation();
    
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
    $( ".linkPartner" ).click(function() {
        window.location = URL_BASE + "busqueda/c/" + $(this).attr("attr-id") + "/" + $(this).html().replaceAll(" ", "-");
    });
    
    // Menu
    $( ".minMenu p" ).click(function() {
        if (location.href.lastIndexOf('/busqueda') == -1){
            var pagina = (location.href.lastIndexOf('/productos')>0)?"productos":"entretenimiento";

            if ($(this).attr("attr-id") == "0" ){
                window.location = URL_BASE + pagina;
            }else{
                var titulo = $($(this).children()[0]).html().replaceAll(" ", "-");
                window.location = URL_BASE + pagina +"/c/"+$(this).attr("attr-id")+"/"+titulo;
            }
        }
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