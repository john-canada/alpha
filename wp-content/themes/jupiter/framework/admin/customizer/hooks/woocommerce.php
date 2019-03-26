<?php
/**
 * WooCommerce hooks actions and filters.
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

// Filter for shop archive page products per page.
add_filter( 'loop_shop_per_page', function( $per_page ) {

	if ( is_shop() || is_product_category() || is_product_tag() ) {

		$customized = false;

		if ( wp_verify_nonce( ( isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['customized'] ) : false ), 'preview-customize_' . get_stylesheet() ) ) {
			$customized = isset( $_POST['customized'] ) ? json_decode( stripslashes_deep( $_POST['customized'] ) ) : false;
		}

		$row_count = isset( $customized->cs_pl_settings_rows ) ? $customized->cs_pl_settings_rows : get_theme_mod( 'cs_pl_settings_rows' );
		$col_count = isset( $customized->cs_pl_settings_columns ) ? $customized->cs_pl_settings_columns : get_theme_mod( 'cs_pl_settings_columns' );

		if ( $row_count && $col_count ) {
			if ( ! is_numeric( $col_count ) ) {
				$col_count = 4;
			}
			return $row_count * $col_count;
		}
	}

	return $per_page;

}, 10 );

// Filter for shop archive page products per row.
add_filter( 'mk_get_option_shop_archive_columns', function( $columns ) {

	if ( is_shop() || is_product_category() || is_product_tag() ) {

		$customized = false;

		if ( wp_verify_nonce( ( isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['customized'] ) : false ), 'preview-customize_' . get_stylesheet() ) ) {
			$customized = isset( $_POST['customized'] ) ? json_decode( stripslashes_deep( $_POST['customized'] ) ) : false;
		}

		return isset( $customized->cs_pl_settings_columns ) ? $customized->cs_pl_settings_columns : get_theme_mod( 'cs_pl_settings_columns', $columns );
	}

	return $columns;

}, 100 );

// Filter the sale badge on product list.
add_filter( 'woocommerce_sale_flash', function( $html, $post, $product ) {
	if ( ! $product->is_on_sale() ) {
		return $html;
	}

	return  '<span class="onsale">' . esc_html( get_theme_mod( 'cs_pl_s_sale_badge_style_text', 'sale' ) ) . '</span>';
}, 10, 3 );

// Filter the add to cart button text.
add_filter( 'woocommerce_product_add_to_cart_text', function( $text, $product ) {

	if ( is_shop() || is_product_category() || is_product_tag() ) {

		return get_theme_mod( 'cs_pl_s_add_to_cart_style_text', $text );

	}

	return $text;

}, 10, 2 );

// Filter the price variation separator.
add_filter( 'woocommerce_get_price_html', function( $price, $product ) {
	if ( is_shop() || is_product_category() || is_product_tag() ) {
		return str_replace( '&ndash;', '<span class="mk-price-variation-seprator">&ndash;</span>', $price );
	}
}, 100, 2 );

// Filter the outofstock badge on product list.
add_filter( 'woocommerce_stock_html', function( $html, $post, $product ) {
	if ( $product->is_in_stock() ) {
		return $html;
	}

	return '<span class="out-of-stock">' . esc_html( get_theme_mod( 'cs_pl_s_outofstock_badge_style_text', 'Out of Stock' ) ) . '</span>';
}, 10, 3 );
