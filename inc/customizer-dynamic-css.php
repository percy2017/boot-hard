<?php
/**
 * Boots2025 Theme Customizer Dynamic CSS.
 *
 * @package Boots2025
 */

/**
 * Outputs the CSS generated from Customizer options into the <head> of the site.
 */
function boots2025_customizer_dynamic_css() {
	?>
	<style type="text/css">
		:root {
			<?php
			// Body Background Color
			$body_bg_color = get_theme_mod( 'boots2025_body_bg_color', '#FFFFFF' );
			if ( ! empty( $body_bg_color ) && $body_bg_color !== '#FFFFFF' ) { // Solo imprimir si no es el default o está vacío
				echo '--bs-body-bg: ' . esc_attr( $body_bg_color ) . ';';
			}

			// Body Text Color
			$body_text_color = get_theme_mod( 'boots2025_body_text_color', '#212529' );
			if ( ! empty( $body_text_color ) && $body_text_color !== '#212529' ) { // Solo imprimir si no es el default o está vacío
				echo '--bs-body-color: ' . esc_attr( $body_text_color ) . ';';
			}

			// Header Background Color
			$header_bg_color = get_theme_mod( 'boots2025_header_bg_color', '#f8f9fa' );
			if ( ! empty( $header_bg_color ) && $header_bg_color !== '#f8f9fa' ) {
				// No hay una variable CSS directa de Bootstrap para el fondo de la navbar que no sea por clase (bg-light, etc)
				// Así que aplicaremos directamente, pero también podemos intentar setear la variable si la navbar es oscura o clara
				// Para simplificar, aplicaremos directamente por ahora.
			}

			// Header Text Color (Navbar links and brand)
			// $header_text_color = get_theme_mod( 'boots2025_header_nav_text_color_debug', '#212529' ); // ID CAMBIADO
			// if ( ! empty( $header_text_color ) && $header_text_color !== '#212529' ) {
			// echo '--bs-navbar-color: ' . esc_attr( $header_text_color ) . ';'; // Se intentará con CSS directo abajo
			// echo '--bs-navbar-brand-color: ' . esc_attr( $header_text_color ) . ';'; // Se intentará con CSS directo abajo
			// }

			// Footer Background Color
			$footer_bg_color = get_theme_mod( 'boots2025_footer_bg_color', '#f8f9fa' );
			if ( ! empty( $footer_bg_color ) && $footer_bg_color !== '#f8f9fa' ) {
				// Similar al header, aplicaremos directamente.
			}

			// Footer Text Color
			$footer_text_color = get_theme_mod( 'boots2025_footer_text_color', '#212529' );
			if ( ! empty( $footer_text_color ) && $footer_text_color !== '#212529' ) {
				// Se aplicará directamente al footer.
			}

			// --- Variables de Tipografía ---
			$font_map = array(
				'system-sans-serif' => 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
				'georgia'           => 'Georgia, serif',
				'verdana'           => 'Verdana, Geneva, sans-serif',
				'courier-new'       => 'monospace', // CAMBIADO para prueba
				'times-new-roman'   => '"Times New Roman", Times, serif',
				'arial'             => 'Arial, Helvetica, sans-serif',
			);

			// Body Font Family
			// $body_font_key = get_theme_mod( 'boots2025_body_font_family', 'system-sans-serif' ); // Eliminado
			// $body_font_family = isset( $font_map[ $body_font_key ] ) ? $font_map[ $body_font_key ] : $font_map['system-sans-serif']; // Eliminado
			// if ( $body_font_key !== 'system-sans-serif' ) { // Eliminado
				// echo '--bs-body-font-family: ' . esc_attr( $body_font_family ) . ';'; // Eliminado
			// }
			
			// Headings Font Family // Eliminado
			// $headings_font_key = get_theme_mod( 'boots2025_headings_font_family', 'system-sans-serif' ); // Eliminado
			// $headings_font_family = isset( $font_map[ $headings_font_key ] ) ? $font_map[ $headings_font_key ] : $font_map['system-sans-serif']; // Eliminado
			
			// Global Font Family
			$global_font_key = get_theme_mod( 'boots2025_global_font_family', 'system-sans-serif' );
			$global_font_family = isset( $font_map[ $global_font_key ] ) ? $font_map[ $global_font_key ] : $font_map['system-sans-serif'];
			if ( $global_font_key !== 'system-sans-serif' ) {
				echo '--bs-body-font-family: ' . esc_attr( $global_font_family ) . ' !important;'; // Aplicar a variable de Bootstrap con !important
			}
			?>
		}

		<?php
		// Aplicar fuente global directamente a body y encabezados.
		// $global_font_family ya tiene la pila de fuentes correcta (o la de sistema por defecto).
		echo 'body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: ' . esc_attr( $global_font_family ) . ' !important; }';
		
		// --- Tamaños de Fuente ---
		// Tamaño de Fuente del Cuerpo
		$body_font_size = get_theme_mod( 'boots2025_body_font_size', '16' );
		if ( $body_font_size !== '16' ) { // Solo si es diferente al default
			// Bootstrap usa --bs-body-font-size (default 1rem). Podemos intentar setear esto o aplicar a body.
			// Para consistencia con px, aplicaremos a body directamente.
			// echo ':root { --bs-body-font-size: ' . esc_attr( $body_font_size ) . 'px; }'; // Si quisiéramos usar rem, necesitaríamos convertir.
		}

		// Tamaño de Fuente H1
		$h1_font_size = get_theme_mod( 'boots2025_h1_font_size', '40' );
		if ( $h1_font_size !== '40' ) { // Solo si es diferente al default
			// Bootstrap usa --bs-heading-font-size (o variables específicas como --bs-h1-font-size).
			// echo ':root { --bs-h1-font-size: ' . esc_attr( $h1_font_size ) . 'px; }';
		}
		?>

		<?php
		// Aplicar estilos directos si es necesario (especialmente para fondos)
		$header_bg_color_val = get_theme_mod( 'boots2025_header_bg_color', '#f8f9fa' );
		if ( ! empty( $header_bg_color_val ) && $header_bg_color_val !== '#f8f9fa' ) {
			echo 'nav.navbar.fixed-top { background-color: ' . esc_attr( $header_bg_color_val ) . ' !important; }';
		}

		// Aplicar CSS directo para el color del texto del header
		$header_text_color_val_debug = get_theme_mod( 'boots2025_header_nav_text_color_debug', '#212529' );
		if ( ! empty( $header_text_color_val_debug ) && $header_text_color_val_debug !== '#212529' ) {
			echo 'nav.navbar.fixed-top .navbar-nav .nav-link,';
			echo 'nav.navbar.fixed-top .navbar-brand,';
			echo 'nav.navbar.fixed-top .navbar-nav .nav-link i,';
			echo 'nav.navbar.fixed-top .offcanvas-title {';
			echo 'color: ' . esc_attr( $header_text_color_val_debug ) . ' !important; }';
		}

		$footer_bg_color_val = get_theme_mod( 'boots2025_footer_bg_color', '#f8f9fa' );
		if ( ! empty( $footer_bg_color_val ) && $footer_bg_color_val !== '#f8f9fa' ) {
			echo 'footer.footer.fixed-bottom { background-color: ' . esc_attr( $footer_bg_color_val ) . ' !important; }';
		}
		
		$footer_text_color_val = get_theme_mod( 'boots2025_footer_text_color', '#212529' );
		if ( ! empty( $footer_text_color_val ) && $footer_text_color_val !== '#212529' ) {
			echo 'footer.footer.fixed-bottom, footer.footer.fixed-bottom p { color: ' . esc_attr( $footer_text_color_val ) . ' !important; }';
		}

		// Aplicar Tamaños de Fuente
		$body_font_size_val = get_theme_mod( 'boots2025_body_font_size', '16' );
		if ( $body_font_size_val !== '16' ) {
			echo 'body { font-size: ' . esc_attr( $body_font_size_val ) . 'px !important; }';
			// Considerar también actualizar --bs-body-font-size si se usa rem en otros lados.
			// echo ':root { --bs-body-font-size: ' . esc_attr( $body_font_size_val / 16 ) . 'rem !important; }'; // Ejemplo si base es 16px = 1rem
		}

		$h1_font_size_val = get_theme_mod( 'boots2025_h1_font_size', '40' );
		if ( $h1_font_size_val !== '40' ) {
			echo 'h1, .h1 { font-size: ' . esc_attr( $h1_font_size_val ) . 'px !important; }';
		}
		?>

		<?php
		// Ejemplo si no usamos variables CSS de Bootstrap, sino selectores directos:
		// (Descomentar y adaptar si es necesario, pero preferimos variables CSS)
		/*
		if ( ! empty( $body_bg_color ) && $body_bg_color !== '#FFFFFF' ) {
			echo 'body { background-color: ' . esc_attr( $body_bg_color ) . ' !important; }'; // !important puede ser necesario para sobrescribir Bootstrap
		}
		if ( ! empty( $body_text_color ) && $body_text_color !== '#212529' ) {
			echo 'body { color: ' . esc_attr( $body_text_color ) . ' !important; }';
		}
		*/
		?>
	</style>
	<?php
}
add_action( 'wp_head', 'boots2025_customizer_dynamic_css', 999 ); // Añadida prioridad alta
