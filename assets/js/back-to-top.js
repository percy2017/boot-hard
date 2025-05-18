jQuery(document).ready(function($) {
    var backToTopBtn = $('#backToTopBtn');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 200) { // Muestra el botón después de 200px de scroll
            backToTopBtn.fadeIn();
        } else {
            backToTopBtn.fadeOut();
        }
    });

    backToTopBtn.click(function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop : 0}, 800); // Duración del scroll en milisegundos
        return false;
    });
});
