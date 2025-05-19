<?php
/**
 * Boots2025 Theme Customizer Section Manager
 *
 * @package Boots2025
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Aquí irá la lógica del gestor de secciones.

if ( ! function_exists( 'get_file_data' ) ) {
	require_once ABSPATH . 'wp-admin/includes/file.php';
}

/**
 * Obtiene las secciones disponibles del directorio template-parts/sections.
 *
 * @return array Array de secciones, cada una con 'slug' y 'name'.
 */
function boots2025_get_available_sections() {
	$sections_dir = get_template_directory() . '/template-parts/sections/';
	$section_files = glob( $sections_dir . 'section-*.php' );
	$available_sections = array();

	if ( $section_files ) {
		foreach ( $section_files as $file ) {
			$filename = basename( $file, '.php' );
			// Extraer el slug de 'section-SLUG'
			$slug = str_replace( 'section-', '', $filename );

			// Intentar obtener un nombre legible del comentario del archivo
			$file_data = get_file_data( $file, array( 'name' => 'Nombre Sección' ) );
			$name = ! empty( $file_data['name'] ) ? $file_data['name'] : ucfirst( str_replace( '-', ' ', $slug ) );

			$available_sections[ $slug ] = array(
				'slug' => $slug,
				'name' => $name,
				'path' => $file, // Guardar path para referencia si es necesario
			);
		}
	}
	// Ordenar alfabéticamente por nombre para un default consistente si no hay orden guardado
	uasort( $available_sections, function( $a, $b ) {
		return strcmp( $a['name'], $b['name'] );
	});
	return $available_sections;
}

/**
 * Registra la sección, settings y control para el gestor de secciones en el Personalizador.
 *
 * @param WP_Customize_Manager $wp_customize Instancia de WP_Customize_Manager.
 */
function boots2025_register_section_manager_customizer_settings( $wp_customize ) {

	// 1. Obtener las secciones disponibles
	$available_sections = boots2025_get_available_sections();
	$default_section_slugs = array_keys( $available_sections );
	$default_visibility = array_fill_keys( $default_section_slugs, true );

	// 2. Nueva Sección en el Personalizador
	$wp_customize->add_section(
		'boots2025_section_manager_section',
		array(
			'title'    => __( 'Gestión de Secciones del Inicio', 'boots2025' ),
			'priority' => 35, // Ajustar según sea necesario
		)
	);

	// 3. Setting para el Orden de Secciones
	$wp_customize->add_setting(
		'boots2025_home_sections_order',
		array(
			'default'           => $default_section_slugs,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh', // 'postMessage' puede ser complejo con reordenamiento y visibilidad
			'sanitize_callback' => 'boots2025_sanitize_sections_order',
		)
	);

	// 4. Setting para la Visibilidad de Secciones
	$wp_customize->add_setting(
		'boots2025_home_sections_visibility',
		array(
			'default'           => $default_visibility,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'boots2025_sanitize_sections_visibility',
		)
	);

	// 5. Control Personalizado para gestionar las secciones
	require_once get_template_directory() . '/inc/class-boots2025-customize-section-manager-control.php'; // Asegúrate que la clase esté en un archivo separado o defínela aquí.
	
	$wp_customize->add_control(
		new Boots2025_Customize_Section_Manager_Control(
			$wp_customize,
			'boots2025_home_sections_control', // ID del control
			array(
				'label'             => __( 'Ordenar y Ocultar Secciones', 'boots2025' ),
				'section'           => 'boots2025_section_manager_section', // ID de la sección donde se mostrará
				'settings'          => 'boots2025_home_sections_order',    // Vinculado principalmente al orden
				'available_sections' => $available_sections, // Pasar las secciones detectadas al control
			)
		)
	);
}
add_action( 'customize_register', 'boots2025_register_section_manager_customizer_settings' );

/**
 * Sanitiza el array de orden de secciones.
 *
 * @param array $input Array de slugs de sección.
 * @return array Array sanitizado de slugs.
 */
function boots2025_sanitize_sections_order( $input ) {
	if ( ! is_array( $input ) ) {
		return array();
	}
	return array_map( 'sanitize_key', $input );
}

/**
 * Sanitiza el array de visibilidad de secciones.
 *
 * @param array $input Array asociativo [slug => bool].
 * @return array Array sanitizado.
 */
function boots2025_sanitize_sections_visibility( $input ) {
	if ( ! is_array( $input ) ) {
		return array();
	}
	$sanitized_array = array();
	foreach ( $input as $key => $value ) {
		$sanitized_array[ sanitize_key( $key ) ] = rest_sanitize_boolean( $value );
	}
	return $sanitized_array;
}

// La clase Boots2025_Customize_Section_Manager_Control se definirá en un archivo separado
// o más abajo si se prefiere mantener todo en uno. Por ahora, asumimos que estará en:
// require_once get_template_directory() . '/inc/class-boots2025-customize-section-manager-control.php';
// Esta línea ya está arriba en la función de registro.
