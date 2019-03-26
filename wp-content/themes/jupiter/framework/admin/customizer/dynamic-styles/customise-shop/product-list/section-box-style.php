<?php
/**
 * Dynamic styles for Box Style section in Product List > Styles.
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

$css = '.woocommerce-page .mk-product-loop.compact-layout .mk-product-holder {';

$background_color = get_theme_mod( 'cs_pl_s_box_style_background_color' );
if ( $background_color ) {
	$css .= "background-color: {$background_color};";
}

$border_radius = get_theme_mod( 'cs_pl_s_box_style_border_radius' );
if ( $border_radius ) {
	$css .= "border-radius: {$border_radius}px;";
}

$border_width = get_theme_mod( 'cs_pl_s_box_style_border_width' );
if ( $border_width ) {
	$css .= "border: {$border_width}px solid;";
}

$border_color = get_theme_mod( 'cs_pl_s_box_style_border_color' );
if ( $border_color ) {
	$css .= "border-color: {$border_color};";
}

$box_model = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_box_style_box_model' ) );
if ( $box_model ) {
	$css .= "
		margin: {$box_model->margin_top}px {$box_model->margin_right}px {$box_model->margin_bottom}px {$box_model->margin_left}px;
		padding: {$box_model->padding_top}px {$box_model->padding_right}px {$box_model->padding_bottom}px {$box_model->padding_left}px;
	";
}

$css .= '}';

return $css;

