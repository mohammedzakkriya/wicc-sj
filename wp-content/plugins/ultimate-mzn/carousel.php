<?php
/**
 * Load plugin textdomain.
 */
function sis_carousel_load_textdomain() {
  load_plugin_textdomain( 'carouselslider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'sis_carousel_load_textdomain' );

//register settings
function sis_carousel_settings_init(){
    register_setting( 'sis_carousel_settings', 'sis_carousel_settings' );
}
add_action( 'admin_init', 'sis_carousel_settings_init' );

/* Adding coolor picker from Wordpress admin page */
function sis_carousel_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'sis-carousel-color-handle', plugins_url('/js/carousel-color-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'sis_carousel_color_picker' );

/* Adding Latest jQuery from Wordpress */
function sis_carousel_plugin_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('sis_carousel_main_script',plugins_url( '/js/owl.carousel.js' , __FILE__ ),array( 'jquery' ));

	wp_enqueue_style('sis_carousel_main_style',plugins_url( '/css/owl.carousel.css' , __FILE__ ));
	wp_enqueue_style('sis_carousel_theme_style',plugins_url( '/css/owl.theme.css' , __FILE__ ));
	wp_enqueue_style('sis_carousel_transitions_style',plugins_url( '/css/owl.transitions.css' , __FILE__ ));
}
add_action('init', 'sis_carousel_plugin_scripts');

/*Plugin options page */

function sis_carousel_custom_menu_page(){
    add_options_page( __('Carousel Settings', 'carouselslider'), __('Carousels', 'carouselslider'), 'manage_options', 'carousel-slider/carousel-options.php');
}
add_action( 'admin_menu', 'sis_carousel_custom_menu_page' );


/* Carousel activation hook*/
function sis_carousel_activation_hook(){
$options = get_option( 'sis_carousel_settings' );
?><!-- <script type="text/javascript">
    jQuery(document).ready(function() {
    	jQuery("#owl-carousel").owlCarousel({
	 
			// Most important owl features
			loop : true,
			items : <?php echo $options['max_items']; ?>,
			itemsDesktop : [1199,<?php echo $options['items_desktop']; ?>],
			itemsDesktopSmall : [980,<?php echo $options['items_desktop_small']; ?>],
			itemsTablet: [768,<?php echo $options['items_tablet']; ?>],
			itemsMobile : [479,<?php echo $options['items_mobile']; ?>],
			singleItem : <?php echo $options['items_single']; ?>,
			 
			//Basic Speeds
			slideSpeed : <?php echo $options['slide_speed']; ?>,
			paginationSpeed : <?php echo $options['pagination_speed']; ?>,
			rewindSpeed : <?php echo $options['rewind_speed']; ?>,
			 
			//Autoplay
			autoPlay : <?php echo $options['autoplay']; ?>,
			stopOnHover : <?php echo $options['stoponhover']; ?>,
			 
			// Navigation
			navigation : <?php echo $options['navigation']; ?>,
			navigationText : ["&lt;","&gt;"],
			rewindNav : true,
			scrollPerPage : <?php echo $options['scrollperpage']; ?>,
			 
			//Pagination
			pagination : <?php echo $options['pagination']; ?>,
			paginationNumbers: <?php echo $options['paginationnumbers']; ?>,
			 
			//Transitions
			transitionStyle : '<?php echo $options['transitionstyle']; ?>',
		});
    });
</script> -->
<script type="text/javascript">
	
	jQuery.noConflict();
	(function ($) {
	    $(function () {
	        // More code using $ as alias to jQuery
	        $("#owl-carousel").owlCarousel({
	 
				// Most important owl features
				items : <?php echo $options['max_items']; ?>,
				itemsDesktop : [1199,<?php echo $options['items_desktop']; ?>],
				itemsDesktopSmall : [980,<?php echo $options['items_desktop_small']; ?>],
				itemsTablet: [768,<?php echo $options['items_tablet']; ?>],
				itemsMobile : [479,<?php echo $options['items_mobile']; ?>],
				singleItem : <?php echo $options['items_single']; ?>,
				 
				//Basic Speeds
				slideSpeed : <?php echo $options['slide_speed']; ?>,
				paginationSpeed : <?php echo $options['pagination_speed']; ?>,
				rewindSpeed : <?php echo $options['rewind_speed']; ?>,
				 
				//Autoplay
				autoPlay : <?php echo $options['autoplay']; ?>,
				stopOnHover : <?php echo $options['stoponhover']; ?>,
				 
				// Navigation
				navigation : <?php echo $options['navigation']; ?>,
				navigationText : ["&lt;","&gt;"],
				rewindNav : true,
				scrollPerPage : <?php echo $options['scrollperpage']; ?>,
				 
				//Pagination
				pagination : <?php echo $options['pagination']; ?>,
				paginationNumbers: <?php echo $options['paginationnumbers']; ?>,
				 
				//Transitions
				transitionStyle : '<?php echo $options['transitionstyle']; ?>',
			});
			$('.owl-item img').each(function(){
				var _this = $(this);
				
				var margin_top = ( 229 - _this.height() ) / 2;
				console.log( _this.height() +' -- '+ margin_top );
				if( margin_top >= 0 ) {	_this.css('margin-top', margin_top ); }
				else { _this.css('margin-top', '0px' ); }
			});
	    });
	})(jQuery);
</script>
<?php }
add_action('wp_footer','sis_carousel_activation_hook');

function sis_carousel_custom_inline_style(){
$options = get_option( 'sis_carousel_settings' );
?><style>
/* Navigation */
.owl-theme .owl-controls .owl-buttons div{
	color: <?php echo $options['navigation_arrow_color']; ?>;
	background: <?php echo $options['navigation_bg_color']; ?>;
}
/* Styling Pagination*/
.owl-theme .owl-controls .owl-page span{
	background: <?php echo $options['pagination_bg_color']; ?>;
}
.owl-theme .owl-controls .owl-page span.owl-numbers{
	color: <?php echo $options['pagination_num_color']; ?>;
}
</style><?php
}
add_action('wp_head','sis_carousel_custom_inline_style');

/*Shortcode for carousel by custom button*/
function sis_carousel_wrapper_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
                'id' =>'carouselsc',
                'items' =>'4',
                'itemsdesktop' =>'4',
                'itemsdesktopsmall' =>'4',
                'itemstablet' =>'3',
                'itemsmobile' =>'2',
                'singleitem' =>'false',
                'slidespeed' =>'200',
                'paginationspeed' =>'800',
                'rewindspeed' =>'1000',
                'autoplay' =>'true',
                'stoponhover' =>'true',
                'navigation' =>'false',
                'scrollperpage' =>'false',
                'pagination' =>'false',
                'paginationnumbers' =>'false',
                'transitionstyle' =>'fade',
            ), $atts));   
    return '<div id="'.$id.'" class="owl-carousel">'.do_shortcode($content).'</div>
		<script type="text/javascript">
    		
    		jQuery.noConflict();
			(function ($) {
			    $(function () {
			        // More code using $ as alias to jQuery
			        $("#'.$id.'").owlCarousel({
			            items : '.$items.',
						itemsDesktop : [1199,'.$itemsdesktop.'],
						itemsDesktopSmall : [980,'.$itemsdesktopsmall.'],
						itemsTablet: [768,'.$itemstablet.'],
						itemsMobile : [479,'.$itemsmobile.'],
						singleItem : '.$singleitem.',
						slideSpeed : '.$slidespeed.',
						paginationSpeed : '.$paginationspeed.',
						rewindSpeed : '.$rewindspeed.',
						autoPlay : '.$autoplay.',
						stopOnHover : '.$stoponhover.',
						navigation : '.$navigation.',
						navigationText : ["&lt;","&gt;"],
						rewindNav : true,
						scrollPerPage : '.$scrollperpage.',
						pagination : '.$pagination.',
						paginationNumbers: '.$paginationnumbers.',
						transitionStyle : "'.$transitionstyle.'",
			        });
			    });
			})(jQuery);
		</script>
    		<!-- <script type="text/javascript">
    			jQuery(document).ready(function() {
    				jQuery("#'.$id.'").owlCarousel({
						items : '.$items.',
						itemsDesktop : [1199,'.$itemsdesktop.'],
						itemsDesktopSmall : [980,'.$itemsdesktopsmall.'],
						itemsTablet: [768,'.$itemstablet.'],
						itemsMobile : [479,'.$itemsmobile.'],
						singleItem : '.$singleitem.',
						slideSpeed : '.$slidespeed.',
						paginationSpeed : '.$paginationspeed.',
						rewindSpeed : '.$rewindspeed.',
						autoPlay : '.$autoplay.',
						stopOnHover : '.$stoponhover.',
						navigation : '.$navigation.',
						navigationText : ["&lt;","&gt;"],
						rewindNav : true,
						scrollPerPage : '.$scrollperpage.',
						pagination : '.$pagination.',
						paginationNumbers: '.$paginationnumbers.',
						transitionStyle : "'.$transitionstyle.'",
    				});
    			});
    		</script> -->';
}
add_shortcode( 'carousel', 'sis_carousel_wrapper_shortcode' );

function sis_carousel_shortcode( $atts, $content = null ) {
        extract(shortcode_atts(array(
                        'img_link' =>'',
                        'href' =>'#',
                ), $atts));    
        return '<div class=""><a href="'.$href.'"><img src="'.$img_link.'"></a></div>';
}
add_shortcode( 'item', 'sis_carousel_shortcode' );

/* Add Accordion Shortcode Button on Post Visual Editor */

function siscarousel_button() {
	add_filter ("mce_external_plugins", "siscarousel_button_js");
	add_filter ("mce_buttons", "siscarouselb");
}

function siscarousel_button_js($plugin_array) {
	$plugin_array['siscours'] = plugins_url('js/carousel-button.js', __FILE__);
	return $plugin_array;
}

function siscarouselb($buttons) {
	array_push ($buttons, 'siscarouseltriger');
	return $buttons;
}
add_action ('init', 'siscarousel_button');


/*Files to Include */
require_once('carousel-img-type.php');