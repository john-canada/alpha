<?php
/**
 * Customizer Dynamic Styles: Section Add to Cart Button Style.
 *
 * Prefix: pl -> product list, s -> styles.
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

$css = '';

// Control: cs_pl_s_add_to_cart_style_show_icon.
$show_icon = ( 'true' === get_theme_mod( 'cs_pl_s_add_to_cart_style_show_icon', 'true' ) ) ? 'inline-block' : 'none';
$css .= ".woocommerce-page .mk-product-loop.compact-layout .product_loop_button svg {
	display: {$show_icon};
}";

$css .= '.woocommerce-page .mk-product-loop.compact-layout .product_loop_button {';

// Control: cs_pl_s_add_to_cart_style_typography.
$typography = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_add_to_cart_style_typography' ) );
if ( $typography ) {
	$css .= "font-family: {$typography->family};
		font-size: {$typography->size}px;
		font-style: {$typography->style};
		font-weight: {$typography->weight};
		color: {$typography->color};";

	// Check and add google fonts to filter.
	if ( ! empty( $typography->source ) && 'google-font' === $typography->source ) {
		add_filter( 'mk_google_fonts', function( $google_fonts ) use ( $typography ) {
			if ( ! in_array( $typography->family, $google_fonts, true ) ) {
				$google_fonts[] = $typography->family;
			}

			return $google_fonts;
		} );
	}
}

// Control: cs_pl_s_add_to_cart_style_bg_color.
$bg_color = get_theme_mod( 'cs_pl_s_add_to_cart_style_bg_color', 'rgba(0, 0, 0, 0.8)' );
$css .= "background-color: {$bg_color};";

// Control: cs_pl_s_add_to_cart_style_corner_radius.
$corner_radius = get_theme_mod( 'cs_pl_s_add_to_cart_style_corner_radius' );
if ( $corner_radius ) {
	$css .= "border-radius: {$corner_radius}px;";
}

// Control: cs_pl_s_add_to_cart_style_border.
$border_width = get_theme_mod( 'cs_pl_s_add_to_cart_style_border' );
if ( $border_width ) {
	$css .= "border-width: {$border_width}px;";
}

// Control: cs_pl_s_add_to_cart_style_border_color.
$border_color = get_theme_mod( 'cs_pl_s_add_to_cart_style_border_color' );
if ( $border_color ) {
	$css .= "border-color: {$border_color};";
}

$box_model = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_add_to_cart_style_box_model' ) );
if ( $box_model ) {
	$css .= "margin-top: {$box_model->margin_top}px;
		margin-right: {$box_model->margin_right}px;
		margin-bottom: {$box_model->margin_bottom}px;
		margin-left: {$box_model->margin_left}px;
		padding-top: {$box_model->padding_top}px;
		padding-right: {$box_model->padding_right}px;
		padding-bottom: {$box_model->padding_bottom}px;
		padding-left: {$box_model->padding_left}px;";
}

$css .= '}';


// Hover state styling.
$css .= '.woocommerce-page .mk-product-loop.compact-layout .product_loop_button:hover {';

// Control: cs_pl_s_add_to_cart_style_color_hover.
$color_hover = get_theme_mod( 'cs_pl_s_add_to_cart_style_color_hover' );
if ( $color_hover ) {
	$css .= "color: {$color_hover};";
}

// Control: cs_pl_s_add_to_cart_style_bg_color_hover.
$bg_color_hover = get_theme_mod( 'cs_pl_s_add_to_cart_style_bg_color_hover', 'rgba(0, 0, 0, 0.8)' );
$css .= "background-color: {$bg_color_hover};";

// Control: cs_pl_s_add_to_cart_style_border_color_hover.
$border_color_hover = get_theme_mod( 'cs_pl_s_add_to_cart_style_border_color_hover' );
if ( $border_color_hover ) {
	$css .= "border-color: {$border_color_hover};";
}

$css .= '}';

return $css;
