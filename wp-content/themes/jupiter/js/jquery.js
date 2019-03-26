
$(document).ready(function(){
	
	var windowheight=$(window).height();
	var windowscrollpostop=$(window).scrolltop();
	var windowpostbottom=windowscrollpostop + windowheight;
	
	
	$.fr.revealonScroll=function(){
		
		return this.each(function(){
			
		var objectoffset=$(this).offset();
		var objectoffsettop=objectoffset.top;
		
		if(!$(this).hasClass("hidden")){
		juery(this).css("opacity",0).addclass("hidden");
		}
		
		if(!$(this).hasClass("animation-complete")){
			if(windowpostbottom>objectoffsettop){
				$(this).animate({"opacity": 1},300).addClass("animation-complete");
			}
			
			
		}
			
		});
	}// end of function
});

$(window).scroll(function(){

	windowheight=$(window).heigth();
	windowscrollpostop=$(window).scrolltop();
	windowpostbottom=windowheight+windowpostop;

	$('.sidebar').revealonScroll();
	$('.sample-photo').revealonScroll();

});


////////////////////

$(function() {

  var $window           = $(window),
      win_height_padded = $window.height() * 1.1,
      isTouch           = Modernizr.touch;

  if (isTouch) { $('.revealOnScroll').addClass('animated'); }

  $window.on('scroll', revealOnScroll);

  function revealOnScroll() {
    var scrolled = $window.scrollTop(),
        win_height_padded = $window.height() * 1.1;

    // Showed...
    $(".revealOnScroll:not(.animated)").each(function () {
      var $this     = $(this),
          offsetTop = $this.offset().top;

      if (scrolled + win_height_padded > offsetTop) {
        if ($this.data('timeout')) {
          window.setTimeout(function(){
            $this.addClass('animated ' + $this.data('animation'));
          }, parseInt($this.data('timeout'),10));
        } else {
          $this.addClass('animated ' + $this.data('animation'));
        }
      }
    });
    // Hidden...
   $(".revealOnScroll.animated").each(function (index) {
      var $this     = $(this),
          offsetTop = $this.offset().top;
      if (scrolled + win_height_padded < offsetTop) {
        $(this).removeClass('animated fadeInUp flipInX lightSpeedIn')
      }
    });
  }

  revealOnScroll();
});