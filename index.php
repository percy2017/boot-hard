<?php
get_header();
?>

<div id="home-sections-container">
	<?php
	// Obtener el orden y la visibilidad de las secciones desde el Personalizador.
	$available_sections_data = boots2025_get_available_sections(); // Asegúrate que esta función esté disponible o duplícala aquí si es necesario.
	
	$default_order = array_keys( $available_sections_data );
	$default_visibility = array_fill_keys( $default_order, true );

	$sections_order = get_theme_mod( 'boots2025_home_sections_order', $default_order );
	$sections_visibility = get_theme_mod( 'boots2025_home_sections_visibility', $default_visibility );

	if ( ! empty( $sections_order ) ) {
		foreach ( $sections_order as $section_slug ) {
			// Verificar si la sección está marcada como visible
			// Si el slug no existe en el array de visibilidad (ej. nueva sección), asumimos visible por defecto.
			$is_visible = isset( $sections_visibility[ $section_slug ] ) ? $sections_visibility[ $section_slug ] : true;

			if ( $is_visible ) {
				// Verificar si la plantilla de la sección existe antes de intentar cargarla
				if ( isset( $available_sections_data[ $section_slug ] ) ) {
					get_template_part( 'template-parts/sections/section', $section_slug );
				}
			}
		}
	} else {
		// Fallback si no hay orden definido (aunque el default del setting debería prevenir esto)
		// Podrías cargar todas las secciones disponibles en orden alfabético o no cargar nada.
		// Por ahora, si no hay orden, no se carga nada explícitamente aquí,
		// pero el default_order en get_theme_mod debería manejarlo.
	}
	?>
</div>

<?php
get_footer();
?>
