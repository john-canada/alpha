/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	var price_style_container = '.woocommerce-page .mk-shop-item-detail > .price';
	var price_style_regular_container = '.woocommerce-page .mk-shop-item-detail .price > .amount';
	var price_style_del_container = '.woocommerce-page .mk-shop-item-detail .price del';
	var price_style_separator = '.woocommerce-page .mk-shop-item-detail .price > .mk-price-variation-seprator';
	var price_style_del_separator = '.woocommerce-page .mk-shop-item-detail .price del .mk-price-variation-seprator';

	wp.customize( 'cs_pl_s_price_style_typography', function( value ) {
		value.bind( function( to ) {

			var typography = jQuery.parseJSON( to );

			$( price_style_container + ', ' + price_style_regular_container + ', ' + price_style_del_container  ).css({
				'color' : typography.color,
				'font-weight' : typography.weight,
				'font-size' : typography.size + 'px',
				'font-style' : typography.style,
				'font-family' : typography.family
			});

		} );
	});

	wp.customize( 'cs_pl_s_price_style_box_model', function( value ) {
		value.bind( function( to ) {
			MK.utils.eventManager.publish('item-expanded');
			var boxModel = jQuery.parseJSON( to );
			$( price_style_regular_container + ', ' + price_style_del_container + ' .amount' + ',' + price_style_separator + ', ' + price_style_del_separator  ).css({
				'margin': boxModel.margin_top + 'px ' + boxModel.margin_right + 'px ' + boxModel.margin_bottom  + 'px ' + boxModel.margin_left + 'px',
				'padding': boxModel.padding_top + 'px ' + boxModel.padding_right + 'px ' + boxModel.padding_bottom  + 'px ' + boxModel.padding_left + 'px'
			});
		} );
	});

} )( jQuery );

