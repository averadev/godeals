var stickyNavTop;
$(function() {
	// Top Slider
    $(document).foundation('orbit', {
        bullets_container_class: 'orbit-bullets banner-bullets'
    });
    
    $( ".optProductos" ).click(function() {
        window.location = URL_BASE+"productos";
    });
    $( "#logoGo" ).click(function() {
        window.location = URL_BASE;
    });
    
    // On load window modal
    $( ".openModal" ).click(function() {
        $('#imgFull').attr('src', URL_IMG+"app/coupon/max/00.png");
        $('#modalContent').html('');
        $('#couponModal').foundation('reveal', 'open');
        
        $.ajax({
            type: "POST",
            url: URL_BASE+"home/getCoupon",
            dataType:'json',
            data: { 
                id: $(this).attr('attr-id')
            },
            success: function(data){
                var template = "<image class='logoModal' src='"+URL_IMG+"app/logo/"+data.logo+"' />";
                template += "<p><a attr-id='"+data.partnerId+"'>"+data.partnerName+"</a> en ";
                template += "<a attr-id='"+data.cityId+"'>"+data.cityName+"</a></p>";
                template += "<p>"+data.description+"</p>";
                template += "<p class='modalDetail'>"+data.detail+"</p>";
                template += "<a href='#' class='button'>Agregar</a>";
                
                $('#imgFull').attr('src', URL_IMG+"app/coupon/max/"+data.image);
                $('#modalContent').html(template);
            }
        });
    });
    $( "#eventClose" ).click(function() {
        $('#couponModal').foundation('reveal', 'close');
    });
    
    $( "#showApps" ).click(function() {
        $( "#slideout_inner" ).toggle( "slide" );
    });
    
   
    // Stik menu
    $('.mainMenu').hachiko();
});

