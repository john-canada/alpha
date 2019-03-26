jQuery(function ($) {

	var api = wp.customize;

	// When Customizer has finished loading
	api.bind('ready', function () {

		// Save the values into hidden field on each change
		$('.mk-box-model input[type="text"]').on('keyup', function () {
			var obj_val = {};
			var $box_model = $(this).closest('.mk-box-model');
			var $input = $box_model.siblings('.mk-box-model-value');
			$box_model.find('input[type="text"]').each(function () {
				var name = $(this).attr('name');
				obj_val[name] = ($(this).val()) ? $(this).val() : '0';
			});
			$input.val(JSON.stringify(obj_val));
			$input.trigger('change'); // Magic to remind Custmizer this has changed, So don't forget to save it!
		});

	});


});