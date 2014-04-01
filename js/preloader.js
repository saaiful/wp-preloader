jQuery(window).load(function() {
	jQuery('#wp_status').fadeOut(); 
	jQuery('#wp_preloader').delay(350).fadeOut('slow');
	jQuery('body').delay(350).css({'overflow':'visible'});
});