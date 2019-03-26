jQuery(document).ready(function ($) {

	// Method for Control's event handlers: cs_pl_s_name_style_typography.
	wp.customize('cs_pl_s_name_style_typography', function (value) {
		value.bind(function (to) {
			try {
				var typography = $.parseJSON(to);
				$('.mk-product-loop.compact-layout .product-title a').css({
					'font-family': typography.family,
					'font-size': typography.size + 'px',
					'font-style': typography.style,
					'font-weight': typography.weight,
					'color': typography.color,
				});
				MK.utils.eventManager.publish('item-expanded');
			} catch (e) {
				console.log(e); // pass exception object to error handler
			}
		});
	});

	// Method for Control's event handlers: cs_pl_s_name_style_box_model.
	wp.customize('cs_pl_s_name_style_box_model', function (value) {
		value.bind(function (to) {
			try {
				var box_model = $.parseJSON(to);
				$('.mk-product-loop.compact-layout .product-title').css({
					'margin-top': box_model.margin_top + 'px',
					'margin-right': box_model.margin_right + 'px',
					'margin-bottom': box_model.margin_bottom + 'px',
					'margin-left': box_model.margin_left + 'px',
					'padding-top': box_model.padding_top + 'px',
					'padding-right': box_model.padding_right + 'px',
					'padding-bottom': box_model.padding_bottom + 'px',
					'padding-left': box_model.padding_left + 'px',
				});
				MK.utils.eventManager.publish('item-expanded');
			} catch (e) {
				console.log(e); // pass exception object to error handler
			}
		});
	});
	
});