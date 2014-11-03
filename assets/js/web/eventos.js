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
    
    // On load window modal
    $( ".viewEvent, .viewEventMin" ).click(function() {
        
        $.prompt("<div class='loadC'></div>", 
        {title: $(this).attr('attr-description')});
        
        $.ajax({
            type: "POST",
            url: URL_BASE + "eventos/getID",
            dataType:'json',
            data: { 
                id: $(this).attr('attr-id')
            },
            success: function(data){
                var template = "<p class='detailComercio'>"+data[0].place+"<br/> " + data[0].cityName+"</p>";
                template += "<p class='detailValidity'>"+data[0].fecha+"</p>";
                template += "<p class='detailDesc'><b>Detalle:</b><br/>"+data[0].info+"</p>";
                
                
                
                template = "<div class='descCupon'>" + template + "</div>";
                
                var imgCupon = "<div class='leftEvent'><image src='"+URL_IMG+"app/event/fullweb/"+data[0].image+"' /></div>";
                
                $("div.jqi .jqimessage").html(imgCupon + template);
            }
        });
        
        
    });
    
    var posId = window.location.href.lastIndexOf('eventos/c/');
    if (posId > -1){
        posId = window.location.href.lastIndexOf('/');
        var posIdInt = window.location.href.substring(posId + 1);
         $.prompt("<div class='loadC'></div>", 
        {title: '_'});
        $.ajax({
            type: "POST",
            url: URL_BASE + "eventos/getID",
            dataType:'json',
            data: { 
                id: posIdInt
            },
            success: function(data){
                var template = "<p class='detailComercio'>"+data[0].place+"<br/> " + data[0].cityName+"</p>";
                template += "<p class='detailValidity'>"+data[0].fecha+"</p>";
                template += "<p class='detailDesc'><b>Detalle:</b><br/>"+data[0].info+"</p>";
                template = "<div class='descCupon'>" + template + "</div>";
                
                var imgCupon = "<div class='leftEvent'><image src='"+URL_IMG+"app/event/fullweb/"+data[0].image+"' /></div>";
                
                $("div.jqi .jqimessage").html(imgCupon + template);
                $(".jqititle").html(data[0].name);
            }
        });
    }
    
    // Stik menu
    $('.mainMenu').hachiko();
    
    
});