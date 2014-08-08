$(function() {
    
    $(document).foundation();
    
    $( ".optProductos" ).click(function() {
        window.location = URL_BASE+"productos";
    });
    $( "#logoGo" ).click(function() {
        window.location = URL_BASE;
    });
    
    // Menu
    $( ".minMenu p" ).click(function() {
        var pagina = (location.href.lastIndexOf('/productos')>0)?"productos":"entretenimiento";
        
        if ($(this).attr("attr-id") == "0" ){
            window.location = URL_BASE + pagina;
        }else{
            var titulo = $($(this).children()[0]).html().replaceAll(" ", "-");
            window.location = URL_BASE + pagina +"/c/"+$(this).attr("attr-id")+"/"+titulo;
        }
        
    });
    
    // On load window modal
    $( ".openModal" ).click(function() {
        $('#imgFull').attr('src', URL_IMG+"app/coupon/max/00.png");
        $('#modalContent').html('');
        $('#couponModal').foundation('reveal', 'open');
        
        $.ajax({
            type: "POST",
            url: "home/getCoupon",
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
    
    
    // Stik menu
    $('.mainMenu').hachiko();
    
});

String.prototype.replaceAll = function(target, replacement) {
  return this.split(target).join(replacement);
};