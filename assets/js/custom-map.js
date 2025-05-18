jQuery(document).ready(function($) {
    if ($('#map').length) {
        var contactDetailsColumn = $('#contact-details-column');
        var mapDiv = $('#map');

        if (contactDetailsColumn.length) {
            mapDiv.height(contactDetailsColumn.outerHeight());
        }

        var map = L.map('map').setView([-13.274197901232656, -63.70572563645624], 13); // Ajusta el nivel de zoom (13) según tus necesidades

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([-13.274197901232656, -63.70572563645624]).addTo(map)
            .bindPopup('Rio Blanco Aserradero')
            .openPopup();
        
        // Recalculate map size on window resize
        $(window).on('resize', function() {
            if (contactDetailsColumn.length) {
                mapDiv.height(contactDetailsColumn.outerHeight());
                map.invalidateSize(); // Important to update map size
            }
        }).trigger('resize'); // Trigger resize on load
    }
});
