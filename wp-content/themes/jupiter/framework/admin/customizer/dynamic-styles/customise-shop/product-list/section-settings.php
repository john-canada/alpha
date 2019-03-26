<?php
/**
 * Dynamic styles for Setting section in Product List Page.
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

$css = '';

$horizontal_space = get_theme_mod( 'cs_pl_settings_horizontal_space' );
if ( $horizontal_space ) {
	$wrap_margin = (($horizontal_space / 2) - $horizontal_space);
	$css .= ".woocommerce-page .mk-product-loop.compact-layout {
		margin-left: {$wrap_margin}px;
		margin-right: {$wrap_margin}px;
	}";
	$item_padding = $horizontal_space / 2;
	$css .= ".woocommerce-page .mk-product-loop.compact-layout .item {
		padding-left: {$item_padding}px;
		padding-right: {$item_padding}px;
	}";
}

$vertical_space = get_theme_mod( 'cs_pl_settings_vertical_space' );
if ( $vertical_space ) {
	$css .= ".post-type-archive-product .mk-product-loop.compact-layout .item {
		padding-bottom: {$vertical_space}px;
	}";
}

return $css;
