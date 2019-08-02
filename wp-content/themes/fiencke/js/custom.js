// NAVIGATION CALLBACK
var ww = jQuery(window).width();
jQuery(document).ready(function() { 
	jQuery(".hdrmenu li a").each(function() {
		if (jQuery(this).next().length > 0) {
			jQuery(this).addClass("parent");
		};
	})
	jQuery(".toggleMenu").click(function(e) { 
		e.preventDefault();
		jQuery(this).toggleClass("active");
		jQuery(".hdrmenu").slideToggle('fast');
	});
	adjustMenu();
})

// navigation orientation resize callbak
jQuery(window).bind('resize orientationchange', function() {
	ww = jQuery(window).width();
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 981) {
		jQuery(".toggleMenu").css("display", "block");
		if (!jQuery(".toggleMenu").hasClass("active")) {
			jQuery(".hdrmenu").hide();
		} else {
			jQuery(".hdrmenu").show();
		}
		jQuery(".hdrmenu li").unbind('mouseenter mouseleave');
	} else {
		jQuery(".toggleMenu").css("display", "none");
		jQuery(".hdrmenu").show();
		jQuery(".hdrmenu li").removeClass("hover");
		jQuery(".hdrmenu li a").unbind('click');
		jQuery(".hdrmenu li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
			jQuery(this).toggleClass('hover');
		});
	}
}

jQuery(document).ready(function() { 
   jQuery('.owl-carousel').owlCarousel({
    loop:true,	
    margin:10,
    autoplay:true,   
	nav:true,
	smartSpeed:250,   
    responsive:{
        0:{
            items:1
        },

        600:{
            items:1
        },

        1000:{
            items:1
        }
    }
})
});