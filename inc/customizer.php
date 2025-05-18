<?php
/**
 * Boots2025 Theme Customizer.
 *
 * @package Boots2025
 */

// Clase para un control de separador simple
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Boots2025_Separator_Control extends WP_Customize_Control {
		public $type = 'boots2025_separator';
		public function render_content() {
			echo '<hr style="margin-top: 1em; margin-bottom: 1em;" />';
		}
	}
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function boots2025_customize_register( $wp_customize ) {
	// Ejemplo: Cambiar el transport del título y descripción del sitio a postMessage para previsualización en vivo.
	// $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	// $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	// $wp_customize->get_section( 'title_tagline' )->priority     = 1;


	// 1. DEFINIR UNA NUEVA SECCIÓN PARA ESTILOS DEL TEMA
	// --------------------------------------------------
	$wp_customize->add_section( 'boots2025_theme_styles_section', array(
		'title'      => __( 'Estilos del Tema Boots2025', 'boots2025' ),
		'priority'   => 30, // Ajusta la prioridad para cambiar el orden en el Personalizador
		'description' => __( 'Personaliza los colores y fuentes de tu tema.', 'boots2025' ),
	) );

	// 2. OPCIONES DE COLOR DEL BODY
	// --------------------------------------------------

	// Setting: Color de Fondo del Body
	$wp_customize->add_setting( 'boots2025_body_bg_color', array(
		'default'           => '#FFFFFF', // Valor por defecto: blanco
		'sanitize_callback' => 'sanitize_hex_color', // Función para limpiar el valor
		'transport'         => 'postMessage', // Para previsualización en vivo (requiere JS)
	) );

	// Control: Color de Fondo del Body
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boots2025_body_bg_color_control', array(
		'label'      => __( 'Color de Fondo del Cuerpo', 'boots2025' ),
		'section'    => 'boots2025_theme_styles_section',
		'settings'   => 'boots2025_body_bg_color',
	) ) );

	// Setting: Color de Texto Principal del Body
	$wp_customize->add_setting( 'boots2025_body_text_color', array(
		'default'           => '#212529', // Valor por defecto: Bootstrap body color
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	// Control: Color de Texto Principal del Body
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boots2025_body_text_color_control', array(
		'label'      => __( 'Color de Texto Principal del Cuerpo', 'boots2025' ),
		'section'    => 'boots2025_theme_styles_section',
		'settings'   => 'boots2025_body_text_color',
	) ) );

	// 3. OPCIONES DE COLOR DEL HEADER
	// --------------------------------------------------

	// Setting: Color de Fondo del Header
	$wp_customize->add_setting( 'boots2025_header_bg_color', array(
		'default'           => '#f8f9fa', // Valor por defecto: bg-light de Bootstrap
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	// Control: Color de Fondo del Header
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boots2025_header_bg_color_control', array(
		'label'      => __( 'Color de Fondo del Header', 'boots2025' ),
		'section'    => 'boots2025_theme_styles_section',
		'settings'   => 'boots2025_header_bg_color',
	) ) );

	// Setting: Color de Texto del Header
	$wp_customize->add_setting( 'boots2025_header_nav_text_color_debug', array( // ID CAMBIADO
		'default'           => '#212529', // Similar al texto oscuro de Bootstrap
		'sanitize_callback' => 'sanitize_hex_color', // RESTAURADO
		'transport'         => 'postMessage',
	) );

	// Control: Color de Texto del Header
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boots2025_header_text_color_control', array( // El ID del control puede quedar igual o cambiar, no es crítico para el guardado del setting
		'label'      => __( 'Color de Texto del Header (Enlaces Navbar)', 'boots2025' ),
		'section'    => 'boots2025_theme_styles_section',
		'settings'   => 'boots2025_header_nav_text_color_debug', // ID CAMBIADO
	) ) );

	// 4. OPCIONES DE COLOR DEL FOOTER
	// --------------------------------------------------

	// Setting: Color de Fondo del Footer
	$wp_customize->add_setting( 'boots2025_footer_bg_color', array(
		'default'           => '#f8f9fa', // Valor por defecto: bg-light de Bootstrap
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	// Control: Color de Fondo del Footer
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boots2025_footer_bg_color_control', array(
		'label'      => __( 'Color de Fondo del Footer', 'boots2025' ),
		'section'    => 'boots2025_theme_styles_section',
		'settings'   => 'boots2025_footer_bg_color',
	) ) );

	// Setting: Color de Texto del Footer
	$wp_customize->add_setting( 'boots2025_footer_text_color', array(
		'default'           => '#212529', // Similar al texto oscuro de Bootstrap
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	// Control: Color de Texto del Footer
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boots2025_footer_text_color_control', array(
		'label'      => __( 'Color de Texto del Footer', 'boots2025' ),
		'section'    => 'boots2025_theme_styles_section',
		'settings'   => 'boots2025_footer_text_color',
	) ) );

	// Separador antes de Tipografía
	// --------------------------------------------------
	$wp_customize->add_setting( 'boots2025_separator_colors_typography', array(
		'sanitize_callback' => '__return_true', // Setting ficticio, no guarda nada
	));
	$wp_customize->add_control( new Boots2025_Separator_Control( $wp_customize, 'boots2025_separator_colors_typography_control', array(
		'section'  => 'boots2025_theme_styles_section',
		'settings' => 'boots2025_separator_colors_typography',
	)));

	// 5. OPCIONES DE TIPOGRAFÍA
	// --------------------------------------------------
	$font_choices = array(
		'system-sans-serif' => __( 'Sistema Sans-serif (Defecto)', 'boots2025' ),
		'georgia'           => __( 'Georgia (Serif)', 'boots2025' ),
		'verdana'           => __( 'Verdana (Sans-serif)', 'boots2025' ),
		'courier-new'       => __( 'Courier New (Monospace)', 'boots2025' ),
		'times-new-roman'   => __( 'Times New Roman (Serif)', 'boots2025' ),
		'arial'             => __( 'Arial (Sans-serif)', 'boots2025' ),
	);

	// Setting: Fuente Principal del Sitio (Global)
	$wp_customize->add_setting( 'boots2025_global_font_family', array(
		'default'           => 'system-sans-serif',
		'sanitize_callback' => 'boots2025_sanitize_font_choice', // RESTAURADO
		'transport'         => 'postMessage',
	) );

	// Control: Fuente Principal del Sitio (Global)
	$wp_customize->add_control( 'boots2025_global_font_family_control', array(
		'label'       => __( 'Fuente Principal del Sitio (Defecto: Sistema Sans-serif)', 'boots2025' ),
		'section'     => 'boots2025_theme_styles_section',
		'settings'    => 'boots2025_global_font_family',
		'type'        => 'select',
		'choices'     => $font_choices,
	) );

	// Separador antes de Tamaños de Fuente
	// --------------------------------------------------
	$wp_customize->add_setting( 'boots2025_separator_typography_fontsize', array(
		'sanitize_callback' => '__return_true',
	));
	$wp_customize->add_control( new Boots2025_Separator_Control( $wp_customize, 'boots2025_separator_typography_fontsize_control', array(
		'section'  => 'boots2025_theme_styles_section',
		'settings' => 'boots2025_separator_typography_fontsize',
	)));

	// 6. OPCIONES DE TAMAÑO DE FUENTE
	// --------------------------------------------------

	// Setting: Tamaño de Fuente del Cuerpo
	$wp_customize->add_setting( 'boots2025_body_font_size', array(
		'default'           => '16', // px
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );

	// Control: Tamaño de Fuente del Cuerpo
	$wp_customize->add_control( 'boots2025_body_font_size_control', array(
		'label'       => __( 'Tamaño de Fuente del Cuerpo (px) (Defecto: 16)', 'boots2025' ),
		'section'     => 'boots2025_theme_styles_section',
		'settings'    => 'boots2025_body_font_size',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 10,
			'max'  => 30,
			'step' => 1,
		),
	) );

	// Setting: Tamaño de Fuente H1
	$wp_customize->add_setting( 'boots2025_h1_font_size', array(
		'default'           => '40', // px (Bootstrap 5 default es 2.5rem, que suele ser 40px)
		'sanitize_callback' => 'absint',
		'transport'         => 'postMessage',
	) );

	// Control: Tamaño de Fuente H1
	$wp_customize->add_control( 'boots2025_h1_font_size_control', array(
		'label'       => __( 'Tamaño de Fuente H1 (px) (Defecto: 40)', 'boots2025' ),
		'section'     => 'boots2025_theme_styles_section',
		'settings'    => 'boots2025_h1_font_size',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 20,
			'max'  => 80,
			'step' => 1,
		),
	) );

}
add_action( 'customize_register', 'boots2025_customize_register' );

// Aquí podríamos añadir funciones de sanitización personalizadas si las necesitamos.
// Por ahora, usamos las integradas como sanitize_hex_color.

/**
 * Sanitize callback para la selección de fuentes.
 *
 * @param string $input La entrada a sanitizar.
 * @return string La entrada sanitizada (una clave de fuente válida o el default).
 */
function boots2025_sanitize_font_choice( $input ) {
	// Definir las claves válidas (deben coincidir con las claves de $font_choices arriba)
	$font_choices_keys = array( // Asegurarse que este array de claves sea el mismo que las claves de $font_choices
		'system-sans-serif' => __( 'Sistema Sans-serif (Defecto)', 'boots2025' ),
		'georgia'           => __( 'Georgia (Serif)', 'boots2025' ),
		'verdana'           => __( 'Verdana (Sans-serif)', 'boots2025' ),
		'courier-new'       => __( 'Courier New (Monospace)', 'boots2025' ),
		'times-new-roman'   => __( 'Times New Roman (Serif)', 'boots2025' ),
		'arial'             => __( 'Arial (Sans-serif)', 'boots2025' ),
	);
	$valid_keys = array_keys($font_choices_keys);


	if ( in_array( $input, $valid_keys, true ) ) {
		return $input;
	}
	return 'system-sans-serif'; // Default si la entrada no es válida
}


// En el futuro, aquí también encolaremos el JS para la previsualización en vivo.
/**
 * Enqueue script for live preview.
 */
function boots2025_customize_preview_js() {
	wp_enqueue_script( 
		'boots2025-customizer-preview', // Handle
		get_template_directory_uri() . '/assets/js/customizer-preview.js', // Source
		array( 'customize-preview', 'jquery' ), // Dependencies: 'customize-preview' for wp.customize, 'jquery' because the script uses $
		null, // Version (null for no version number)
		true  // In footer
	);
}
add_action( 'customize_preview_init', 'boots2025_customize_preview_js' );
