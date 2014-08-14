$(function() {

    $(document).foundation();
    
    // Stik menu
    $('.mainMenu').hachiko();

});



String.prototype.replaceAll = function(target, replacement) {
    return this.split(target).join(replacement);
};