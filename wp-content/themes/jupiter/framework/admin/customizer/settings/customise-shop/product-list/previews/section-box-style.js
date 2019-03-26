/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	var box_style_holder = '.woocommerce-page .mk-product-loop.compact-layout  .mk-product-holder';

	wp.customize( 'cs_pl_s_box_style_background_color', function( value ) {
		value.bind( function( to ) {
			$( box_style_holder ).css( 'background-color', to );
		} );
	});

	wp.customize( 'cs_pl_s_box_style_border_radius', function( value ) {
		value.bind( function( to ) {
			$( box_style_holder ).css( 'border-radius', to + 'px' );
		} );
	});

	wp.customize( 'cs_pl_s_box_style_border_width', function( value ) {
		value.bind( function( to ) {
			$( box_style_holder ).css( 'border-width', to + 'px' );
		} );
	});

	wp.customize( 'cs_pl_s_box_style_border_color', function( value ) {
		value.bind( function( to ) {
			$( box_style_holder ).css( 'border-color', to );
		} );
	});

	wp.customize( 'cs_pl_s_box_style_box_model', function( value ) {
		$( box_style_holder ).css(
			mkPreviewBoxModel( value() )
		);

		value.bind(function (to) {
			$( box_style_holder ).css(
				mkPreviewBoxModel( to )
			);
			MK.utils.eventManager.publish('item-expanded');
		});
	});

} )( jQuery );

