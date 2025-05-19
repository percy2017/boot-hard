(function( $ ) {
    'use strict';

    // Previsualización para el Color de Fondo del Body
    wp.customize( 'boots2025_body_bg_color', function( value ) {
        value.bind( function( newval ) {
            // Actualizar la variable CSS de Bootstrap para el fondo del body
            // También se puede aplicar directamente a body si no se usan variables CSS extensivamente
            if (newval) {
                document.documentElement.style.setProperty('--bs-body-bg', newval);
            } else {
                // Si el valor es vacío, remover la propiedad para que tome el default de Bootstrap o del tema
                document.documentElement.style.removeProperty('--bs-body-bg');
            }
            // $('body').css('background-color', newval ? newval : ''); // Fallback o alternativa
        } );
    } );

    // Previsualización para el Color de Texto Principal del Body
    wp.customize( 'boots2025_body_text_color', function( value ) {
        value.bind( function( newval ) {
            // Actualizar la variable CSS de Bootstrap para el color del texto del body
            if (newval) {
                document.documentElement.style.setProperty('--bs-body-color', newval);
            } else {
                document.documentElement.style.removeProperty('--bs-body-color');
            }
            // $('body').css('color', newval ? newval : ''); // Fallback o alternativa
        } );
    } );

    // Previsualización para el Color de Fondo del Header
    wp.customize( 'boots2025_header_bg_color', function( value ) {
        value.bind( function( newval ) {
            console.log('Header BG Color Change:', newval);
            var $header = $( 'nav.navbar.fixed-top' );
            console.log('Header elements found:', $header.length);
            if ($header.length) {
                $header[0].style.setProperty('background-color', newval ? newval : '', 'important');
            }
            // $header.css( 'background-color', newval ? newval : '' ); // Old way
        } );
    } );

    // Previsualización para el Color de Texto del Header
    wp.customize( 'boots2025_header_nav_text_color_debug', function( value ) { // ID CAMBIADO
        value.bind( function( newval ) {
            console.log('Header Text Color Change (Debug ID):', newval); // Log modificado
            var $navLinks = $('nav.navbar.fixed-top .navbar-nav .nav-link');
            var $navBrand = $('nav.navbar.fixed-top .navbar-brand');
            console.log('Header Nav Links found:', $navLinks.length);
            console.log('Header Nav Brand found:', $navBrand.length);

            if (newval) {
                document.documentElement.style.setProperty('--bs-navbar-color', newval, 'important');
                document.documentElement.style.setProperty('--bs-navbar-brand-color', newval, 'important');
                $navLinks.css('color', newval);
                $navBrand.css('color', newval);
            } else {
                document.documentElement.style.removeProperty('--bs-navbar-color');
                document.documentElement.style.removeProperty('--bs-navbar-brand-color');
                $navLinks.css('color', '');
                $navBrand.css('color', '');
            }
        } );
    } );

    // Previsualización para el Color de Fondo del Footer
    wp.customize( 'boots2025_footer_bg_color', function( value ) {
        value.bind( function( newval ) {
            console.log('Footer BG Color Change:', newval);
            var $footer = $( 'footer.footer.fixed-bottom' );
            console.log('Footer elements found:', $footer.length);
            if ($footer.length) {
                $footer[0].style.setProperty('background-color', newval ? newval : '', 'important');
            }
            // $footer.css( 'background-color', newval ? newval : '' ); // Old way
        } );
    } );

    // Previsualización para el Color de Texto del Footer
    wp.customize( 'boots2025_footer_text_color', function( value ) {
        value.bind( function( newval ) {
            console.log('Footer Text Color Change:', newval);
            var $footerTextElements = $( 'footer.footer.fixed-bottom, footer.footer.fixed-bottom p' );
            console.log('Footer text elements found:', $footerTextElements.length);
            $footerTextElements.css( 'color', newval ? newval : '' );
        } );
    } );

    // --- Previsualización para Tipografía ---
	var fontMap = {
		'system-sans-serif': 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
		'georgia': 'Georgia, serif',
		'verdana': 'Verdana, Geneva, sans-serif',
		'courier-new': '"Courier New", Courier, monospace',
		'times-new-roman': '"Times New Roman", Times, serif',
		'arial': 'Arial, Helvetica, sans-serif'
	};

    // Previsualización para la Fuente del Cuerpo - ELIMINADO
    // wp.customize( 'boots2025_body_font_family', ... );

    // Previsualización para la Fuente de los Encabezados - ELIMINADO
    // wp.customize( 'boots2025_headings_font_family', ... );

    // Previsualización para la Fuente Principal del Sitio (Global)
    wp.customize( 'boots2025_global_font_family', function( value ) {
        value.bind( function( newvalKey ) {
            var fontFamily = fontMap[newvalKey] || fontMap['system-sans-serif'];
            var globalSelector = 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6'; // Aplicar a todo
            
            console.log('Global Font Change:', newvalKey, fontFamily);

            if (newvalKey && newvalKey !== 'system-sans-serif') {
                document.documentElement.style.setProperty('--bs-body-font-family', fontFamily, 'important');
                $(globalSelector).each(function() {
                    this.style.setProperty('font-family', fontFamily, 'important');
                });
            } else {
                // Volver al default de Bootstrap/navegador
                document.documentElement.style.removeProperty('--bs-body-font-family');
                 $(globalSelector).each(function() {
                    this.style.removeProperty('font-family');
                });
            }
        } );
    } );

    // --- Previsualización para Tamaños de Fuente ---

    // Previsualización para el Tamaño de Fuente del Cuerpo
    wp.customize( 'boots2025_body_font_size', function( value ) {
        value.bind( function( newval ) {
            console.log('Body Font Size Change:', newval);
            if (newval) {
                // $('body').css('font-size', newval + 'px !important'); // jQuery .css() no maneja bien !important
                document.body.style.setProperty('font-size', newval + 'px', 'important');
                // Considerar actualizar --bs-body-font-size si se usa rem y se quiere mantener consistencia
                // document.documentElement.style.setProperty('--bs-body-font-size', (newval / 16) + 'rem', 'important');
            } else {
                document.body.style.removeProperty('font-size');
                // document.documentElement.style.removeProperty('--bs-body-font-size');
            }
        } );
    } );

    // Previsualización para el Tamaño de Fuente H1
    wp.customize( 'boots2025_h1_font_size', function( value ) {
        value.bind( function( newval ) {
            console.log('H1 Font Size Change:', newval);
            var h1Selector = 'h1, .h1';
            if (newval) {
                $(h1Selector).each(function() {
                    this.style.setProperty('font-size', newval + 'px', 'important');
                });
            } else {
                $(h1Selector).each(function() {
                    this.style.removeProperty('font-size');
                });
            }
        } );
    } );

    // Aquí añadiremos más bindings para futuras opciones del personalizador

    // Nota: La previsualización para el orden y visibilidad de las secciones de la página de inicio
    // (boots2025_home_sections_order, boots2025_home_sections_visibility)
    // se maneja mediante transport='refresh' en sus respectivos settings del Personalizador.
    // Por lo tanto, no se requiere lógica de postMessage aquí para esas funcionalidades.

})( jQuery );
