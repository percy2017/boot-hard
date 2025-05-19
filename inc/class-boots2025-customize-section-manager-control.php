<?php
/**
 * Boots2025 Theme Customizer Section Manager Control Class
 *
 * @package Boots2025
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Class Boots2025_Customize_Section_Manager_Control
	 *
	 * Custom Customize Control for managing home page sections.
	 */
	class Boots2025_Customize_Section_Manager_Control extends WP_Customize_Control {

		/**
		 * The type of customize control being rendered.
		 *
		 * @var string
		 */
		public $type = 'boots2025_section_manager';

		/**
		 * Array of available sections.
		 * Passed from the add_control arguments.
		 *
		 * @var array
		 */
		public $available_sections = array();


		/**
		 * Enqueue control related scripts/styles.
		 */
		public function enqueue() {
			// JS
			wp_enqueue_script(
				'boots2025-customizer-section-manager-js',
				get_template_directory_uri() . '/assets/js/customizer-section-manager.js',
				array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ),
				wp_get_theme()->get( 'Version' ), // Use theme version for cache busting
				true
			);

			// CSS
			wp_enqueue_style(
				'boots2025-customizer-section-manager-css',
				get_template_directory_uri() . '/assets/css/customizer-section-manager-control.css',
				array(),
				wp_get_theme()->get( 'Version' )
			);

			// Pass data to JS
			$settings_data = array(
				'orderSettingId'     => 'boots2025_home_sections_order',
				'visibilitySettingId' => 'boots2025_home_sections_visibility',
				'sections'           => $this->available_sections, // Pass all available sections
				'initialOrder'       => $this->value(), // Current order from the setting
				'initialVisibility'  => get_theme_mod( 'boots2025_home_sections_visibility', array_fill_keys( array_keys( $this->available_sections ), true ) ),
			);
			wp_localize_script( 'boots2025-customizer-section-manager-js', 'boots2025SectionManagerData', $settings_data );
		}

		/**
		 * Render the control's content.
		 *
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 */
		protected function render_content() {
			$current_order_slugs = $this->value(); // This is an array of slugs from boots2025_home_sections_order
			$current_visibility = get_theme_mod( 'boots2025_home_sections_visibility', array_fill_keys( array_keys( $this->available_sections ), true ) );

			// Create a list of sections based on the current order, including any new sections not yet in the order.
			$ordered_sections_to_display = array();
			if ( ! empty( $current_order_slugs ) ) {
				foreach ( $current_order_slugs as $slug ) {
					if ( isset( $this->available_sections[ $slug ] ) ) {
						$ordered_sections_to_display[ $slug ] = $this->available_sections[ $slug ];
					}
				}
			}
			// Add any new sections that are not yet in the order (e.g., newly added section files)
			foreach ( $this->available_sections as $slug => $section_data ) {
				if ( ! isset( $ordered_sections_to_display[ $slug ] ) ) {
					$ordered_sections_to_display[ $slug ] = $section_data;
				}
			}

			?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php endif; ?>
			</label>

			<ul id="boots2025-section-manager-list" class="section-manager-list">
				<?php
				if ( ! empty( $ordered_sections_to_display ) ) :
					foreach ( $ordered_sections_to_display as $slug => $section_data ) :
						$is_visible = isset( $current_visibility[ $slug ] ) ? $current_visibility[ $slug ] : true;
						$eye_icon_class = $is_visible ? 'dashicons-visibility' : 'dashicons-hidden';
						?>
						<li class="section-item" data-section-slug="<?php echo esc_attr( $slug ); ?>">
							<span class="dashicons dashicons-sort"></span>
							<span class="section-name"><?php echo esc_html( $section_data['name'] ); ?></span>
							<label class="visibility-toggle-label">
								<input type="checkbox" class="visibility-checkbox" <?php checked( $is_visible ); ?> />
								<span class="dashicons visibility-toggle <?php echo esc_attr( $eye_icon_class ); ?>" title="<?php esc_attr_e( 'Toggle visibility', 'boots2025' ); ?>"></span>
							</label>
						</li>
						<?php
					endforeach;
				else :
					?>
					<li><?php esc_html_e( 'No sections found. Add files like "section-yourname.php" to template-parts/sections/', 'boots2025' ); ?></li>
					<?php
				endif;
				?>
			</ul>
			
			<!-- Hidden input linked to the 'boots2025_home_sections_order' setting -->
			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', (array) $this->value() ) ); ?>" />
			<?php
		}
	}
endif;
