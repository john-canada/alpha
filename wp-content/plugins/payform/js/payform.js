jQuery(document).ready(function($){
	$('.payform_wp').each(function(){
		$(this).replaceWith('<script type="text/javascript" src="https://app.payform.me/javascript/embed/'+$(this).attr('payform_id')+'?v=2" async></script>');
	})
});


