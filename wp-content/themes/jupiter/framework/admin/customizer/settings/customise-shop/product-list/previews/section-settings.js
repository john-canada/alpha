jQuery(document).ready(function ($) {
	
	// Method for Control's event handlers: cs_pl_settings_horizontal_space.
	wp.customize('cs_pl_settings_horizontal_space', function (value) {
		value.bind(function (to) {
			$('.woocommerce-page .mk-product-loop.compact-layout').css({
				marginLeft: ((to / 2) - to) + 'px',
				marginRight: ((to / 2) - to) + 'px',
			});
			$('.woocommerce-page .mk-product-loop.compact-layout .item').css({
				paddingLeft: (to / 2) + 'px',
				paddingRight: (to / 2) + 'px',
			});
			MK.utils.eventManager.publish('item-expanded');
		});
	});

	// Method for Control's event handlers: cs_pl_settings_vertical_space.
	wp.customize('cs_pl_settings_vertical_space', function (value) {
		value.bind(function (to) {
			$('.woocommerce-page .mk-product-loop.compact-layout .item').css({
				paddingBottom: to + 'px',
			});
			MK.utils.eventManager.publish('item-expanded');
		});
	});

	// Method for selectiveRefresh event handlers: partial-content-rendered.
	wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {

		var horizontal_space = wp.customize._value.cs_pl_settings_horizontal_space();
		$('.woocommerce-page .mk-product-loop.compact-layout').css({
			marginLeft: ((horizontal_space / 2) - horizontal_space) + 'px',
			marginRight: ((horizontal_space / 2) - horizontal_space) + 'px',
		});
		$('.woocommerce-page .mk-product-loop.compact-layout .item').css({
			paddingLeft: (horizontal_space / 2) + 'px',
			paddingRight: (horizontal_space / 2) + 'px',
		});

		var vertical_space = wp.customize._value.cs_pl_settings_vertical_space();
		$('.woocommerce-page .mk-product-loop.compact-layout .item').css({
			paddingBottom: vertical_space + 'px',
		});

		// Control's selectiveRefresh event handlers: cs_pl_settings_columns.
		if (typeof placement.partial.id !== 'undefined' && placement.partial.id === 'cs_pl_settings_columns') {
			MK.component.ResponsiveImageSetter.handleAjax();
			setTimeout(function () {
				MK.component.Grid('.products.mk--row').init();
				MK.utils.eventManager.publish('ajaxLoaded');
			}, 101);
		}

	});

});