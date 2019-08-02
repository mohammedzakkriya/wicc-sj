// JavaScript Document
jQuery(document).ready(function() {
	
	var grovzaViewPortWidth = '',
		grovzaViewPortHeight = '';

	function grovzaViewport(){

		grovzaViewPortWidth = jQuery(window).width(),
		grovzaViewPortHeight = jQuery(window).outerHeight(true);	
		
		if( grovzaViewPortWidth > 1200 ){
			
			jQuery('.main-navigation').removeAttr('style');
			
			var grovzaSiteHeaderHeight = jQuery('.site-header').outerHeight();
			var grovzaSiteHeaderWidth = jQuery('.site-header').width();
			var grovzaSiteHeaderPadding = ( grovzaSiteHeaderWidth * 2 )/100;
			var grovzaMenuHeight = jQuery('.menu-container').height();
			
			var grovzaMenuButtonsHeight = jQuery('.site-buttons').height();
			
			var grovzaMenuPadding = ( grovzaSiteHeaderHeight - ( (grovzaSiteHeaderPadding * 2) + grovzaMenuHeight ) )/2;
			var grovzaMenuButtonsPadding = ( grovzaSiteHeaderHeight - ( (grovzaSiteHeaderPadding * 2) + grovzaMenuButtonsHeight ) )/2;
		
			
			jQuery('.menu-container').css({'padding-top':grovzaMenuPadding});
			jQuery('.site-buttons').css({'padding-top':grovzaMenuButtonsPadding});
			
			
		}else{

			jQuery('.menu-container, .site-buttons, .header-container-overlay, .site-header').removeAttr('style');

		}	
	
	}

	jQuery(window).on("resize",function(){
		
		grovzaViewport();
		
	});
	
	grovzaViewport();


	jQuery('.site-branding .menu-button').on('click', function(){
				
		if( grovzaViewPortWidth > 1200 ){

		}else{
			jQuery('.main-navigation').slideToggle();
		}				
		
				
	});	

		
	
});		