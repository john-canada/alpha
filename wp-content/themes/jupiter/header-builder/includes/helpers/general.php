<?php
/**
 * General helper functions.
 *
 * @package Header_Builder
 * @subpackage Helpers
 * @since 5.9.1
 * @since 5.9.3 Add checkong function for WooCommerce.
 */

if ( ! function_exists( 'hb_is_frontend_active' ) ) :
	/**
	 * Check if HB front end is active outside the preview page.
	 *
	 * @since 5.9.1
	 *
	 * @return boolean True if active. Default is false.
	 */
	function hb_is_frontend_active() {
		$hb_options = json_decode( get_option( 'artbees_header_builder' ) );

		return isset( $hb_options->model ) && isset( $hb_options->model->activeOnFrontEnd ) && $hb_options->model->activeOnFrontEnd;
	}
endif;

if ( ! function_exists( 'hb_active_current_menu_item' ) ) :
	/**
	 * Add current-menu-item class in preview navigation.
	 *
	 * @since 5.9.1
	 *
	 * @param  string $output Navigation HTML output.
	 * @return boolean        True if active. Default is false.
	 */
	function hb_active_current_menu_item( $output ) {
		$output = preg_replace( '/class="menu-item/', 'class="current-menu-item menu-item', $output, 1 );
		return $output;
	}
endif;

if ( ! function_exists( 'hb_woocommerce_is_active' ) ) :
	/**
	 * Check if WooCommerce is active or not by checking if WooCommerce is exist or not.
	 *
	 * @since 5.9.3
	 *
	 * @return boolean WooCommerce activation status.
	 */
	function hb_woocommerce_is_active() {
		if ( class_exists( 'WooCommerce' ) ) {
			return true;
		}
		return false;
	}
endif;
