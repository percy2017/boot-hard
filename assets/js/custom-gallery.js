jQuery(document).ready(function($) {
    if ($('#gallery-instalaciones').length) {
        $('#gallery-instalaciones').justifiedGallery({
            rowHeight: 180, // Altura preferida de las filas
            maxRowHeight: 220, // Altura máxima de las filas
            margins: 5, // Márgenes entre imágenes
            lastRow: 'justify', // Justificar la última fila
            captions: false // Ocultar leyendas por defecto
        });
    }

    if ($('#gallery-maderas').length) {
        $('#gallery-maderas').justifiedGallery({
            rowHeight: 180,
            maxRowHeight: 220,
            margins: 5,
            lastRow: 'justify',
            captions: false
        });
    }

    if ($('#gallery-aserrin').length) {
        $('#gallery-aserrin').justifiedGallery({
            rowHeight: 180,
            maxRowHeight: 220,
            margins: 5,
            lastRow: 'justify',
            captions: false
        });
    }
});
