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
    
    // Stik menu
    $('.mainMenu').hachiko();

});



String.prototype.replaceAll = function(target, replacement) {
    return this.split(target).join(replacement);
};