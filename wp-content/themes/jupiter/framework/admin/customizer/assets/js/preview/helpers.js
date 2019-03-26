/**
 * Helper functions for customizer preview.
 */



// Method for Typography.
function mkPreviewTypography( typography, loadFonts ) {
	if (typeof typography === 'string') {
		typography = jQuery.parseJSON( typography );
	}
	
	if (typeof loadFonts !== 'undefined' && true === loadFonts && typeof typography.family !== 'undefined' && typography.source === 'google-font') {
		// Load the selected font in the preview iframe.
		var previewFrame = jQuery('#customize-preview').find('iframe').attr('name');
		var weights = ':100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic,100,200,300,400,500,600,700,800,900';
		WebFont.load({
			google: {
				families: [typography.family + weights],
			},
			context: frames[previewFrame],
			timeout: 2000
		});
	}

	return {
		'color' : typography.color,
		'font-weight' : typography.weight,
		'font-size' : typography.size + 'px',
		'font-style' : typography.style,
		'font-family' : typography.family
	}
}

// Method for BoxModel.
function mkPreviewBoxModel( boxModel ) {
	if (typeof boxModel === 'string') {
		boxModel = jQuery.parseJSON( boxModel );
	}
	
	return {
		'margin': boxModel.margin_top + 'px ' + boxModel.margin_right + 'px ' + boxModel.margin_bottom  + 'px ' + boxModel.margin_left + 'px',
		'padding': boxModel.padding_top + 'px ' + boxModel.padding_right + 'px ' + boxModel.padding_bottom  + 'px ' + boxModel.padding_left + 'px'
	}
}


