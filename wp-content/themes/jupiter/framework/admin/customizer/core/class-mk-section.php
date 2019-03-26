<?php
/**
 * WordPress Customize Section classes
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 3.4.0
 */

if ( ! class_exists( 'WP_Customize_Section' ) ) {
	return;
}

/**
 * Customize Section class.
 *
 * @since 3.4.0
 *
 * @see WP_Customize_Section
 */
class MK_Section extends WP_Customize_Section {

	/**
	 * ID of this section.
	 *
	 * @access public
	 * @var string
	 */
	public $section;

	/**
	 * Type of this section.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'mk-section';

	/**
	 * Gather the parameters passed to client JavaScript via JSON.
	 *
	 * @return array The array to be exported to the client as JSON.
	 */
	public function json() {

		$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section' ) );
		$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
		$array['content'] = $this->get_content();
		$array['active'] = $this->active();
		$array['instanceNumber'] = $this->instance_number;
		$array['customizeAction'] = __( 'Customizing', 'mk_framework' );
		if ( $this->panel ) {
			$array['customizeAction'] = sprintf( '%s %s' , __( 'Customizing &#9656;', 'mk_framework' ), esc_html( $this->manager->get_panel( $this->panel )->title ) );
		}
		return $array;

	}

	/**
	 * An Underscore (JS) template for rendering this section.
	 *
	 * Class variables for this section class are available in the `data` JS object;
	 * export custom variables by overriding WP_Customize_Section::json().
	 *
	 * @access public
	 *
	 * @see WP_Customize_Section::print_template()
	 */
	public function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}">
			<h3 class="accordion-section-title" tabindex="0">
				{{ data.title }}
				<span class="screen-reader-text"><?php esc_html_e( 'Press return or enter to open this section', 'mk_framework' ); ?></span>
			</h3>
			<ul class="accordion-section-content mk-row">
				<li class="customize-section-description-container section-meta mk-col-12 <# if ( data.description_hidden ) { #>customize-info<# } #>">
					<div class="customize-section-title">
						<button class="customize-section-back" tabindex="-1">
							<span class="screen-reader-text"><?php esc_html_e( 'Back', 'mk_framework' ); ?></span>
						</button>
						<h3>
							<span class="customize-action">
								{{{ data.customizeAction }}}
							</span>
							{{ data.title }}
						</h3>
						<# if ( data.description && data.description_hidden ) { #>
							<button type="button" class="customize-help-toggle dashicons dashicons-editor-help" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Help', 'mk_framework' ); ?></span></button>
							<div class="description customize-section-description">
								{{{ data.description }}}
							</div>
						<# } #>
					</div>

					<# if ( data.description && ! data.description_hidden ) { #>
						<div class="description customize-section-description">
							{{{ data.description }}}
						</div>
					<# } #>
				</li>
			</ul>
		</li>
		<?php
	}

}
