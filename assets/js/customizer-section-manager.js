/**
 * Boots2025 Customizer Section Manager Control JS
 *
 * @package Boots2025
 */

( function( $, api ) {
	'use strict';

	// Aquí irá el código JS para el control del gestor de secciones.

	api.bind( 'ready', function() {
		// Este código se ejecuta cuando el Personalizador está listo.

		// Acceder a los datos pasados desde PHP
		const controlData = window.boots2025SectionManagerData;
		if ( ! controlData ) {
			console.error( 'Boots2025 Section Manager: No data received from PHP.' );
			return;
		}

		const orderSetting = api.control( controlData.orderSettingId );
		const visibilitySetting = api.control( controlData.visibilitySettingId.replace('[','_').replace(']','') ); // WP sanitizes IDs for JS

		if ( ! orderSetting ) {
			// console.warn('Order setting not found for controlData.orderSettingId: ' + controlData.orderSettingId);
			// Try to get the setting directly if control is not found (it might be the case if the control is not yet rendered)
			// This is less ideal as we are working directly with settings, but necessary if control isn't ready.
		}
		
		const $list = $( '#boots2025-section-manager-list' );

		// 1. Inicializar jQuery UI Sortable
		$list.sortable( {
			axis: 'y',
			cursor: 'move',
			opacity: 0.7,
			update: function() {
				updateOrderSetting();
			}
		} );

		// 2. Manejar el cambio de visibilidad
		$list.on( 'change', '.visibility-checkbox', function() {
			const $checkbox = $( this );
			const $icon = $checkbox.siblings( '.visibility-toggle' );
			const sectionSlug = $checkbox.closest( '.section-item' ).data( 'section-slug' );
			const isVisible = $checkbox.is( ':checked' );

			// Actualizar el ícono del ojo
			if ( isVisible ) {
				$icon.removeClass( 'dashicons-hidden' ).addClass( 'dashicons-visibility' );
			} else {
				$icon.removeClass( 'dashicons-visibility' ).addClass( 'dashicons-hidden' );
			}

			updateVisibilitySetting( sectionSlug, isVisible );
		} );
		
		// Función para actualizar el setting de orden
		function updateOrderSetting() {
			const newOrder = [];
			$list.find( '.section-item' ).each( function() {
				newOrder.push( $( this ).data( 'section-slug' ) );
			} );
			// Actualizar el input oculto que está vinculado al setting (this.link())
			// Esto es importante para que el cambio se refleje y el botón "Publicar" se active.
			// El this.link() en PHP crea un input que el customizer usa para el binding.
			// El valor del input oculto debe ser una cadena separada por comas si el setting espera eso,
			// o un JSON si el setting lo maneja así. En nuestro caso, el setting es un array,
			// pero el input hidden de this.link() a menudo es más simple.
			// Lo más robusto es usar la API de JS del Customizer:
			api( controlData.orderSettingId ).set( newOrder );

			// Actualizar el valor del input hidden que está directamente vinculado por $this->link()
            // Esto es más para compatibilidad con cómo WP_Customize_Control maneja el this->link()
            const hiddenInput = orderSetting.container.find('input[type="hidden"]');
            if (hiddenInput.length) {
                hiddenInput.val(newOrder.join(',')).trigger('change');
            }
		}

		// Función para actualizar el setting de visibilidad
		function updateVisibilitySetting( slug, isVisible ) {
			console.log('Boots2025 SM: Updating visibility for section "' + slug + '" to: ' + isVisible);
			
			const visibilitySettingApi = api( controlData.visibilitySettingId );
			let currentVisibilityObject = visibilitySettingApi.get() || {};
			
			// Clonar el objeto para asegurar que la referencia cambie, lo que ayuda al Customizer a detectar el cambio.
			currentVisibilityObject = { ...currentVisibilityObject };
			currentVisibilityObject[ slug ] = isVisible;
			
			visibilitySettingApi.set( currentVisibilityObject );
			console.log('Boots2025 SM: New visibility object set in JS:', visibilitySettingApi.get());
			
			// "Tocar" el setting de orden para asegurar que el botón "Publicar" se active
			const orderSettingApi = api( controlData.orderSettingId );
			let currentOrderArray = orderSettingApi.get();
			
			console.log('Boots2025 SM: Current order before touch:', JSON.parse(JSON.stringify(currentOrderArray)));
			
			// Clonar el array de orden para asegurar un cambio de referencia.
			currentOrderArray = Array.isArray(currentOrderArray) ? [...currentOrderArray] : [];
			
			orderSettingApi.set( [] ); // Intenta establecer un valor claramente diferente primero.
			orderSettingApi.set( currentOrderArray ); // Luego restaura (o establece la copia).
			
			console.log('Boots2025 SM: Order after touch:', JSON.parse(JSON.stringify(orderSettingApi.get())));

			// Forzar el estado 'dirty' si es necesario (esto es más un hack, pero puede ser útil para depurar)
			// visibilitySettingApi.transport = 'postMessage'; // Temporalmente para ver si se ensucia
			// visibilitySettingApi.preview(); 
			// orderSettingApi.preview();

			// Verificar estados 'dirty' (para depuración en consola)
			// Nota: ._dirty es una propiedad interna.
			setTimeout(function() {
				console.log('Boots2025 SM: Visibility setting dirty state:', visibilitySettingApi._dirty);
				console.log('Boots2025 SM: Order setting dirty state:', orderSettingApi._dirty);
				if (api.state('saved')) {
					console.log('Boots2025 SM: Customizer state is "saved":', api.state('saved').get());
                }
			}, 100);
		}

		// Inicializar el estado de los checkboxes y el orden visual basado en los settings actuales
		// Esto es importante si el control se renderiza después de que los settings ya tienen valores.
		const initialOrder = api( controlData.orderSettingId ).get();
		const initialVisibility = api( controlData.visibilitySettingId ).get();

		if ( initialOrder && initialOrder.length > 0 ) {
			initialOrder.forEach( function( slug, index ) {
				const $item = $list.find( '.section-item[data-section-slug="' + slug + '"]' );
				if ( $item.length ) {
					$list.append( $item ); // Mueve el ítem a su posición correcta
				}
			} );
		}

		if ( initialVisibility ) {
			for ( const slug in initialVisibility ) {
				if ( initialVisibility.hasOwnProperty( slug ) ) {
					const isVisible = initialVisibility[ slug ];
					const $item = $list.find( '.section-item[data-section-slug="' + slug + '"]' );
					if ( $item.length ) {
						$item.find( '.visibility-checkbox' ).prop( 'checked', isVisible );
						const $icon = $item.find( '.visibility-toggle' );
						if ( isVisible ) {
							$icon.removeClass( 'dashicons-hidden' ).addClass( 'dashicons-visibility' );
						} else {
							$icon.removeClass( 'dashicons-visibility' ).addClass( 'dashicons-hidden' );
						}
					}
				}
			}
		}

	} );

} )( jQuery, wp.customize );
