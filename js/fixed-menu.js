/**
 * Fixed menu by Mkhuda
 * Feel free to use !
 */
jQuery(document).ready(function(){
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 136) {
				jQuery('nav#access').addClass("fixed-menu");
			} else {
				jQuery('nav#access').removeClass("fixed-menu");
			}
		});
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 136) {
				jQuery('nav#access-left').addClass("fixed-left-menu");
			} else {
				jQuery('nav#access-left').removeClass("fixed-left-menu");
			}
		});
});
		