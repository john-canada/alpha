<?php
/**
 * Dynamic styles for Sale Price Style section in Product List > Styles.
 *
 * @package Jupiter
 * @subpackage MK_Customizer
 * @since 5.9.4
 */

$css = '.woocommerce-page .mk-product-loop.compact-layout .price ins .amount,';
$css .= '.woocommerce-page .mk-product-loop.compact-layout .price ins .mk-price-variation-seprator {';
$css .= 'display: inline-block;';
$css .= 'vertical-align: top;';
$css .= 'text-decoration:inherit;';
$box_model = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_sale_price_style_box_model' ) );
if ( $box_model ) {
	$css .= "
	margin: {$box_model->margin_top}px {$box_model->margin_right}px {$box_model->margin_bottom}px {$box_model->margin_left}px;
		padding: {$box_model->padding_top}px {$box_model->padding_right}px {$box_model->padding_bottom}px {$box_model->padding_left}px;
";
}

$css .= '}';
$css .= '.woocommerce-page .mk-product-loop.compact-layout .price ins,';
$css .= '.woocommerce-page .mk-product-loop.compact-layout .price ins .amount {';

$typography = mk_maybe_json_decode( get_theme_mod( 'cs_pl_s_sale_price_style_typography' ) );
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
} else {
	$css .= '}';

	// Default style for sale price.
	$css .= '.woocommerce-page .mk-product-loop.compact-layout .price ins,';
	$css .= '.woocommerce-page .mk-product-loop.compact-layout .price ins .amount {';
	$css .= '
		font-family: inherit;
		font-style: normal;
		font-weight: 700;
		font-size: 18px;
		color: #252525;
	';
}

$css .= '}';

return $css;

