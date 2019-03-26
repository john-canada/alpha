<?php
/**
 * Dynamic styles for Sale Badge Style section in Product List > Styles.
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

$css = '.woocommerce-page .mk-product-loop.compact-layout .onsale {';

$background_color = get_theme_mod( 'cs_pl_s_sale_badge_style_background_color' );
if ( $background_color ) {
	$css .= "background-color: {$background_color};";
}

$border_radius = get_theme_mod( 'cs_pl_s_sale_badge_style_border_radius' );
if ( $border_radius ) {
	$css .= "border-radius: {$border_radius}px;";
}

$border_width = get_theme_mod( 'cs_pl_s_sale_badge_style_border_width' );
if ( $border_width ) {
	$css .= "border: {$border_width}px solid;";
}

$border_color = get_theme_mod( 'cs_pl_s_sale_badge_style_border_color' );
if ( $border_color ) {
	$css .= "border-color: {$border_color};";
}

$box_model = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_sale_badge_style_box_model' ) );
if ( $box_model ) {
	$css .= "
		margin: {$box_model->margin_top}px {$box_model->margin_right}px {$box_model->margin_bottom}px {$box_model->margin_left}px;
		padding: {$box_model->padding_top}px {$box_model->padding_right}px {$box_model->padding_bottom}px {$box_model->padding_left}px;
	";
}

$typography = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_sale_badge_style_typography' ) );
if ( $typography ) {
	$css .= "
		font-family: {$typography->family};
		font-size: {$typography->size}px;
		font-style: {$typography->style};
		font-weight: {$typography->weight};
		color: {$typography->color};
	";

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

$css .= '}';

return $css;
