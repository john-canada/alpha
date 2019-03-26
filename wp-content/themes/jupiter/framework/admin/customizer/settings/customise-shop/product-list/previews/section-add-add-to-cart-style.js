jQuery(document).ready(function ($) {

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_text.
	wp.customize('cs_pl_s_add_to_cart_style_text', function (value) {
		try {
			$('.mk-product-loop.compact-layout .product_loop_button_text').text(value());
			value.bind(function (to) {
				$('.mk-product-loop.compact-layout .product_loop_button_text').text(to);

			});
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_show_icon.
	wp.customize('cs_pl_s_add_to_cart_style_show_icon', function (value) {
		try {
			if ('true' == value()) {
				$('.mk-product-loop.compact-layout .product_loop_button svg').show();
			} else {
				$('.mk-product-loop.compact-layout .product_loop_button svg').hide();
			}
			value.bind(function (to) {
				if ('true' == to) {
					$('.mk-product-loop.compact-layout .product_loop_button svg').show();
				} else {
					$('.mk-product-loop.compact-layout .product_loop_button svg').hide();
				}
			});
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_typography.
	wp.customize('cs_pl_s_add_to_cart_style_typography', function (value) {
		try {
			var typography;

			if (typeof value() === 'string') {
				typography = $.parseJSON(value());
			} else {
				typography = value();
			}

			$('.mk-product-loop.compact-layout .product_loop_button').css({
				'font-family': typography.family,
				'font-size': typography.size + 'px',
				'font-style': typography.style,
				'font-weight': typography.weight,
				'color': typography.color,
			});

			// Load the selected font in the preview iframe.
			if (typeof typography.family !== 'undefined' && typography.source === 'google-font') {
				var previewFrame = $('#customize-preview').find('iframe').attr('name');
				var weights = ':100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic,100,200,300,400,500,600,700,800,900';
				WebFont.load({
					google: {
						families: [typography.family + weights],
					},
					context: frames[previewFrame],
					timeout: 2000
				});
			}

			value.bind(function (to) {
				typography = $.parseJSON(to);
				$('.mk-product-loop.compact-layout .product_loop_button').css({
					'font-family': typography.family,
					'font-size': typography.size + 'px',
					'font-style': typography.style,
					'font-weight': typography.weight,
					'color': typography.color,
				});
			});
			MK.utils.eventManager.publish('item-expanded');
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_box_model.
	wp.customize('cs_pl_s_add_to_cart_style_box_model', function (value) {
		try {
			var box_model;

			if (typeof value() === 'string') {
				box_model = $.parseJSON(value());
			} else {
				box_model = value();
			}

			$('.mk-product-loop.compact-layout .product_loop_button').css({
				'margin-top': box_model.margin_top + 'px',
				'margin-right': box_model.margin_right + 'px',
				'margin-bottom': box_model.margin_bottom + 'px',
				'margin-left': box_model.margin_left + 'px',
				'padding-top': box_model.padding_top + 'px',
				'padding-right': box_model.padding_right + 'px',
				'padding-bottom': box_model.padding_bottom + 'px',
				'padding-left': box_model.padding_left + 'px',
			});

			value.bind(function (to) {
				box_model = $.parseJSON(to);
				$('.mk-product-loop.compact-layout .product_loop_button').css({
					'margin-top': box_model.margin_top + 'px',
					'margin-right': box_model.margin_right + 'px',
					'margin-bottom': box_model.margin_bottom + 'px',
					'margin-left': box_model.margin_left + 'px',
					'padding-top': box_model.padding_top + 'px',
					'padding-right': box_model.padding_right + 'px',
					'padding-bottom': box_model.padding_bottom + 'px',
					'padding-left': box_model.padding_left + 'px',
				});

			});
			MK.utils.eventManager.publish('item-expanded');
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_bg_color.
	wp.customize('cs_pl_s_add_to_cart_style_bg_color', function (value) {

		try {
			$('.mk-product-loop.compact-layout .product_loop_button').css({
				'background-color': value(),
			});
			value.bind(function (to) {
				$('.mk-product-loop.compact-layout .product_loop_button').css({
					'background-color': to,
				});
			});
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_corner_radius.
	wp.customize('cs_pl_s_add_to_cart_style_corner_radius', function (value) {
		try {
			$('.mk-product-loop.compact-layout .product_loop_button').css({
				'border-radius': value() + 'px',
			});
			value.bind(function (to) {
				$('.mk-product-loop.compact-layout .product_loop_button').css({
					'border-radius': to + 'px',
				});
			});
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_border.
	wp.customize('cs_pl_s_add_to_cart_style_border', function (value) {
		try {
			$('.mk-product-loop.compact-layout .product_loop_button').css({
				'border-width': value() + 'px',
			});
			value.bind(function (to) {
				$('.mk-product-loop.compact-layout .product_loop_button').css({
					'border-width': to + 'px',
				});
			});
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_border_color.
	wp.customize('cs_pl_s_add_to_cart_style_border_color', function (value) {
		try {
			$('.mk-product-loop.compact-layout .product_loop_button').css({
				'border-color': value(),
			});
			value.bind(function (to) {
				$('.mk-product-loop.compact-layout .product_loop_button').css({
					'border-color': to,
				});
			});
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_color_hover.
	wp.customize('cs_pl_s_add_to_cart_style_color_hover', function (value) {
		try {
			var typography = wp.customize('cs_pl_s_add_to_cart_style_typography')();

			if (typeof typography === 'string') {
				typography = $.parseJSON(typography);
			}

			$('.mk-product-loop.compact-layout .product_loop_button').on({
				mouseenter: function () {
					$(this).css({
						'color': value(),
					});
				},
				mouseleave: function () {
					$(this).css({
						'color': typography.color,
					});
				}
			});
			value.bind(function (to) {
				$('.mk-product-loop.compact-layout .product_loop_button').on({
					mouseenter: function () {
						$(this).css({
							'color': to,
						});
					},
					mouseleave: function () {
						$(this).css({
							'color': typography.color,
						});
					}
				});
			});
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_bg_color_hover.
	wp.customize('cs_pl_s_add_to_cart_style_bg_color_hover', function (value) {
		try {
			$('.mk-product-loop.compact-layout .product_loop_button').on({
				mouseenter: function () {
					$(this).css({
						'background-color': value(),
					});
				},
				mouseleave: function () {
					$(this).css({
						'background-color': wp.customize('cs_pl_s_add_to_cart_style_bg_color')(),
					});
				}
			});
			value.bind(function (to) {
				$('.mk-product-loop.compact-layout .product_loop_button').on({
					mouseenter: function () {
						$(this).css({
							'background-color': to,
						});
					},
					mouseleave: function () {
						$(this).css({
							'background-color': wp.customize('cs_pl_s_add_to_cart_style_bg_color')(),
						});
					}
				});
			});
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

	// Method for Control's event handlers: cs_pl_s_add_to_cart_style_border_color_hover.
	wp.customize('cs_pl_s_add_to_cart_style_border_color_hover', function (value) {
		try {
			$('.mk-product-loop.compact-layout .product_loop_button').on({
				mouseenter: function () {
					$(this).css({
						'border-color': value(),
					});
				},
				mouseleave: function () {
					$(this).css({
						'border-color': wp.customize('cs_pl_s_add_to_cart_style_border_color')(),
					});
				}
			});
			value.bind(function (to) {
				$('.mk-product-loop.compact-layout .product_loop_button').on({
					mouseenter: function () {
						$(this).css({
							'border-color': to,
						});
					},
					mouseleave: function () {
						$(this).css({
							'border-color': wp.customize('cs_pl_s_add_to_cart_style_border_color')(),
						});
					}
				});
			});
		} catch (e) {
			console.log(e); // pass exception object to error handler
		}
	});

});