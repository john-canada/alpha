(function ($) {
	$(document).ready(function () {
		var api = window.wp.customize;
		api.bind('ready', function () {

			// Input value change handler
			function mkTypographyValues(el) {
				var obj_val = {};
				var $wrap = el.closest('.mk-control-typography-inner');
				var $input = $wrap.next('.mk-typography-value');
				var source = $wrap.find( 'select option:selected' ).data( 'source' );

				$wrap.find('input[type="text"], input[type="number"], input[type="hidden"], select')
					.each(function (index, input) {
						var name = $(input).attr('name');
						var value = $(input).val();
						obj_val[name] = value;
					});

				if ( typeof source !== 'undefined' ) {
					obj_val['source'] = source;
				}

				$input.val(JSON.stringify(obj_val));
				$input.trigger('change'); // Magic to remind Custmizer this has changed, So don't forget to save it!
			}

			// Detect value change for input element
			$('.mk-control-typography input').on('keyup change', function () {
				mkTypographyValues($(this));
			});

			// Detect value change for select element
			$('.mk-control-typography select').on('change', function () {
				mkTypographyValues($(this));

				var family = $( this ).val();
				var weights = ':100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic,100,200,300,400,500,600,700,800,900';
				var previewFrame = $( '#customize-preview' ).find( 'iframe' ).attr( 'name' );

				if ( typeof family === 'undefined' || $( 'option:selected', this ).data( 'source' ) !== 'google-font' ) {
					return;
				}

				// Load the selected font in the preview iframe.
				WebFont.load({
					google: {
						families: [family + weights],
					},
					context: frames[previewFrame],
					timeout: 2000
				});
			});
		});
	});
})(jQuery);