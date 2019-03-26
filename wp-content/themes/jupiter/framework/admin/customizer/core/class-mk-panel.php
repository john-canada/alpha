<?php
/**
 * WordPress Customize Panel classes
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

if ( ! class_exists( 'WP_Customize_Panel' ) ) {
	return;
}

/**
 * Customize Panel class.
 *
 * @since 5.9.4
 *
 * @see WP_Customize_Panel
 */
class MK_Panel extends WP_Customize_Panel {

	/**
	 * ID of this panel.
	 *
	 * @access public
	 * @var string
	 */
	public $panel;

	/**
	 * Type of this panel.
	 *
	 * @access public
	 * @var    string $type
	 */
	public $type = 'mk-panel';

	/**
	 * Gather the parameters passed to client JavaScript via JSON.
	 *
	 * @return array The array to be exported to the client as JSON.
	 */
	public function json() {

		$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel' ) );
		$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
		$array['content'] = $this->get_content();
		$array['active'] = $this->active();
		$array['instanceNumber'] = $this->instance_number;

		return $array;

	}

}
