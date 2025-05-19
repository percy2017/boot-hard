<?php
// Register Theme Features
function boots2025_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Switch default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	// Add support for custom logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
	) );
}
add_action( 'after_setup_theme', 'boots2025_theme_support' );

function boots2025_scripts() {
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
	wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.3', true );

    // Enqueue Justify Gallery CSS and JS
    wp_enqueue_style( 'justify-gallery-css', 'https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/css/justifiedGallery.min.css', array(), '3.8.1' );
    wp_enqueue_script( 'justify-gallery-js', 'https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/js/jquery.justifiedGallery.min.js', array( 'jquery' ), '3.8.1', true );

    // Enqueue Leaflet CSS and JS
    wp_enqueue_style( 'leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4' );
    wp_enqueue_script( 'leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true );

    // Enqueue Font Awesome CSS
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2' );

    // Enqueue smooth scroll script
    wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/assets/js/smooth-scroll.js', array( 'jquery' ), null, true );

    // Enqueue custom map script
    wp_enqueue_script( 'custom-map', get_template_directory_uri() . '/assets/js/custom-map.js', array( 'jquery', 'leaflet-js' ), null, true );

    // Enqueue custom gallery script
    wp_enqueue_script( 'custom-gallery', get_template_directory_uri() . '/assets/js/custom-gallery.js', array( 'jquery', 'justify-gallery-js' ), null, true );

    // Enqueue back to top script
    wp_enqueue_script( 'back-to-top', get_template_directory_uri() . '/assets/js/back-to-top.js', array( 'jquery' ), null, true );

    // Enqueue theme stylesheet.
    wp_enqueue_style( 'boots2025-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'boots2025_scripts' );

// Register Navigation Menus
function boots2025_menus() {

	$locations = array(
		'primary' => __( 'Primary Menu', 'boots2025' ),
	);

	register_nav_menus( $locations );

}

add_action( 'init', 'boots2025_menus' );

// Custom Walker for Bootstrap 5
class Bootstrap_Nav_Walker extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';
        if ( $args->walker->has_children ) {
            $classes[] = 'dropdown';
        }
        if ( in_array('current-menu-item', $classes) ) {
            $classes[] = 'active';
        }

        // Store icon classes to be used for the <i> tag
        $icon_classes_for_i_tag = array_filter($classes, function($class) {
            return strpos($class, 'fa-') === 0 || strpos($class, 'fab-') === 0 || strpos($class, 'far-') === 0 || strpos($class, 'fas-') === 0;
        });

        // Remove icon classes from the <li> element to prevent duplicate icon by Font Awesome's CSS
        if (!empty($icon_classes_for_i_tag)) {
            $classes = array_diff($classes, $icon_classes_for_i_tag);
        }

        $output .= $indent . '<li class="' . esc_attr( join( ' ', $classes ) ) . '">';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' class="nav-link' . ( $args->walker->has_children ? ' dropdown-toggle' : '' ) . '"' . ( $args->walker->has_children ? ' id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"' : '' ) . '>';

        // Add icon if present in classes (using the stored $icon_classes_for_i_tag)
        if (!empty($icon_classes_for_i_tag)) {
             $item_output .= '<i class="' . esc_attr( join( ' ', $icon_classes_for_i_tag ) ) . ' me-1"></i>'; // Add margin-right
        }

        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// Cargar funcionalidades del Personalizador
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/customizer-dynamic-css.php';
require_once get_template_directory() . '/inc/customizer-section-manager.php'; // Gestor de secciones
