<?php
/**
 * Dynamic styles for Regular Price Style section in Product List > Styles.
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

$css = '.woocommerce-page .mk-product-loop.compact-layout .price > .amount,';
$css .= '.woocommerce-page .mk-product-loop.compact-layout .price del .amount,';
$css .= '.woocommerce-page .mk-product-loop.compact-layout .price > .mk-price-variation-seprator,';
$css .= '.woocommerce-page .mk-product-loop.compact-layout .price del .mk-price-variation-seprator {';
$css .= 'display: inline-block;';
$css .= 'vertical-align: top;';
$css .= 'text-decoration:inherit;';
$box_model = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_price_style_box_model' ) );
if ( $box_model ) {
	$css .= "
		margin: {$box_model->margin_top}px {$box_model->margin_right}px {$box_model->margin_bottom}px {$box_model->margin_left}px;
		padding: {$box_model->padding_top}px {$box_model->padding_right}px {$box_model->padding_bottom}px {$box_model->padding_left}px;
";
}

$css .= '}';
$css .= '.woocommerce-page .mk-product-loop.compact-layout .price,';
$css .= '.woocommerce-page .mk-product-loop.compact-layout .price del .amount {';

$typography = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_price_style_typography' ) );
if ( $typography ) {
	$css .= "
		font-family: {$typography->family};
		font-style: {$typography->style};
		font-weight: {$typography->weight};
		font-size: {$typography->size}px;
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
