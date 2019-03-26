<?php
/**
 * Dynamic styles for Setting section in Product List Page.
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

$css = '';

// Dynamic styles for product name typography.
$typography = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_name_style_typography' ) );
if ( $typography ) {
	$css .= ".woocommerce-page .mk-product-loop.compact-layout .product-title a {
		font-family: {$typography->family};
		font-size: {$typography->size}px;
		font-style: {$typography->style};
		font-weight: {$typography->weight};
		color: {$typography->color};
	}";

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

// Dynamic styles for product name box model.
$box_model = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_name_style_box_model' ) );
if ( $box_model ) {
	$css .= ".woocommerce-page .mk-product-loop.compact-layout .product-title {
		margin-top: {$box_model->margin_top}px;
		margin-right: {$box_model->margin_right}px;
		margin-bottom: {$box_model->margin_bottom}px;
		margin-left: {$box_model->margin_left}px;
		padding-top: {$box_model->padding_top}px;
		padding-right: {$box_model->padding_right}px;
		padding-bottom: {$box_model->padding_bottom}px;
		padding-left: {$box_model->padding_left}px;
	}";
}

return $css;
