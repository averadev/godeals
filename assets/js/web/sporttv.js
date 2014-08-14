$(function() {
    
    $(document).foundation();
    
    // On load window modal
    $( ".viewEvent, .viewEventMin" ).click(function() {
        
        $('#imgFull').attr('src', URL_IMG+"app/event/max/00.png");
        $('#eventModal').foundation('reveal', 'open');
        $('#imgFull').attr('src', $(this).attr('attr'));
        $('.menuModal a').hide();
        
        $.ajax({
            type: "POST",
            url: "eventos/getEventCategories",
            dataType:'json',
            data: { 
                id: $(this).attr('attr-id')
            },
            success: function(data){
                for (i = 0; i < data.length; i++){
                    $('.menuModal .id'+data[i].categorieId).show();
                }
            }
        });
        
        
    });
    
    $( "#eventClose" ).click(function() {
        $('#eventModal').foundation('reveal', 'close');
    });
    
    // Smooth Scrooll
    var middle = $(window).height() / 2;
    $('.circleLink').click(function() {
        // Change style
        $(".circleBase").removeClass("circleBaseSel");
        $(this).addClass("circleBaseSel");
        // Move scroll page
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - middle
                }, 1000);
                return false;
            }
        }
    });
    
    // Stik menu
    $('.mainMenu').hachiko();
    
    
    
});