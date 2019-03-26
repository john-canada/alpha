(function ($) {
	$(document).ready(function () {
		window.wp.customize.bind('ready', function () {
			$( '.mk-color-picker-holder' ).find( 'input' ).alphaColorPicker()
			.on('click.wpcolorpicker', function (e) {
				var $customizePane = $(e.currentTarget).closest('.customize-pane-child');
				var $colorResult = $(e.currentTarget).closest('.mk-color-picker-holder').find('.wp-color-result');
				var $colorHolder = $(e.currentTarget).closest('.mk-color-picker-holder').find('.wp-picker-holder');
				var rightPadding = 5;
				if( ( $colorResult.offset().left + $colorHolder.width() + rightPadding ) >  $customizePane.width() ){
					var marginLeft = $colorHolder.width() - ( $customizePane.width() - $colorResult.offset().left ) + rightPadding;
					$colorHolder.css({
						marginLeft: '-' + marginLeft + 'px',
					});
				}
			})
			.on('irischange', function (e, ui) {
				$(e.currentTarget).val(ui.color.toString()).trigger('change');
			});
		});
	});
})(jQuery);