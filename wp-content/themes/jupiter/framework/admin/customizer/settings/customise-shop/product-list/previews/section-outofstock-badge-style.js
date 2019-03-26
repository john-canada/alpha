(function( $ ) {

	// Text.
	wp.customize( 'cs_pl_s_outofstock_badge_style_text', function( value ) {
		value.bind( function( to ) {
			$( '.woocommerce-page .product-loop-thumb .out-of-stock' ).text( to );
		} );
	});

	// Typography.
	wp.customize( 'cs_pl_s_outofstock_badge_style_typography', function( value ) {
		value.bind( function( to ) {

			var typography = $.parseJSON( to );

			$( '.woocommerce-page .product-loop-thumb .out-of-stock' ).css({
				'font-family': typography.family,
				'font-style': typography.style,
				'font-weight': typography.weight,
				'font-size': typography.size + 'px',
				'color': typography.color
			});

		} );
	});

	// Background color.
	wp.customize( 'cs_pl_s_outofstock_badge_style_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.woocommerce-page .product-loop-thumb .out-of-stock' ).css( 'background-color', to );
		} );
	});

	// Border radius.
	wp.customize( 'cs_pl_s_outofstock_badge_style_border_radius', function( value ) {
		value.bind( function( to ) {
			$( '.woocommerce-page .product-loop-thumb .out-of-stock' ).css( 'border-radius', to + 'px' );
		} );
	});

	// Border width.
	wp.customize( 'cs_pl_s_outofstock_badge_style_border_width', function( value ) {
		value.bind( function( to ) {
			var border_color = wp.customize('cs_pl_s_outofstock_badge_style_border_color').get();
			$( '.woocommerce-page .product-loop-thumb .out-of-stock' ).css( 'border', to + 'px' + ' solid ' + border_color );
		} );
	});

	// Border color.
	wp.customize( 'cs_pl_s_outofstock_badge_style_border_color', function( value ) {
		value.bind( function( to ) {
			$( '.product-loop-thumb .out-of-stock' ).css( 'border-color', to );
		} );
	});

	// Box Model.
	wp.customize( 'cs_pl_s_outofstock_badge_style_box_model', function( value ) {
		value.bind( function( to ) {

			var boxModel = $.parseJSON( to );

			$( '.product-loop-thumb .out-of-stock' ).css({
				'margin': boxModel.margin_top + 'px ' + boxModel.margin_right + 'px ' + boxModel.margin_bottom  + 'px ' + boxModel.margin_left + 'px',
				'padding': boxModel.padding_top + 'px ' + boxModel.padding_right + 'px ' + boxModel.padding_bottom  + 'px ' + boxModel.padding_left + 'px'
			});

		} );
	});



} )( jQuery );