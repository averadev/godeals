$(function() {
    
    $(document).foundation();
    
    // On load window modal
    $( ".viewEvent, .viewEventMin" ).click(function() {
        
        $.prompt("<div class='loadC'></div>", 
        {title: $(this).attr('attr-description')});
        
        $.ajax({
            type: "POST",
            url: "eventos/getID",
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
    
    
    // Stik menu
    $('.mainMenu').hachiko();
    
    
});