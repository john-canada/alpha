WebFontConfig = {
	timeout: 2000
}

if ( mk_typekit_id.length > 0 ) {
	WebFontConfig.typekit = {
		id: mk_typekit_id
	}
}

if ( mk_google_fonts.length > 0 ) {
	WebFontConfig.google = {
		families:  mk_google_fonts
	}
}

WebFont.load( WebFontConfig );