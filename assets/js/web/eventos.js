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
    
    // Get Month postions
    var posMonth = new Array();
    for (i=0; i<$(".titleMonth").length; i++){
        posMonth.push($($(".titleMonth")[i]).offset().top - middle);
    }
    // Postion listener
    var topMenu = $("#menuMonth").offset().top - 220;
    var bottomMenu = $(".mainFooter").offset().top - 350;
    $(window).scroll(function () {
        // Add fis to menu
        var height = $(window).scrollTop();
        if(height >= topMenu){
            if(height >= bottomMenu)
                $("#menuMonth").css('position', 'absolute');
            else
                $("#menuMonth").css('position', 'fixed');
        }else{
            $("#menuMonth").css('position', 'absolute');
        }
        
        // Add style to submenu
        if (posMonth.length > 1){
            if (height <= posMonth[0]){
               $(".circleBase").removeClass("circleBaseSel");
            }else if(height >= posMonth[posMonth.length - 1]){
                console.log("bottom");
                if (! $($(".circleBase")[posMonth.length - 1]).hasClass("circleBaseSel")){
                        $(".circleBase").removeClass("circleBaseSel");
                        $($(".circleBase")[posMonth.length - 1]).addClass("circleBaseSel");
                }
            }else{
                 for (i=0; i<(posMonth.length - 1); i++){
                     if (height >= (posMonth[i]) && height <= (posMonth[i + 1])){
                         if (! $($(".circleBase")[i]).hasClass("circleBaseSel")){
                            $(".circleBase").removeClass("circleBaseSel");
                            $($(".circleBase")[i]).addClass("circleBaseSel");
                        }
                     }
                }        
            }
        }
        
    });
    
    
});