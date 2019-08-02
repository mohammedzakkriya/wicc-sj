<?php
/**
 * @package Florence IT
 * Setup the WordPress core custom header feature.
 *
 * @uses florence_it_header_style()

 */
function florence_it_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'florence_it_custom_header_args', array(		
		'default-text-color'     => 'ffffff',
		'width'                  => 1400,
		'height'                 => 280,
		'wp-head-callback'       => 'florence_it_header_style',		
	) ) );
}
add_action( 'after_setup_theme', 'florence_it_custom_header_setup' );

if ( ! function_exists( 'florence_it_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see florence_it_custom_header_setup().
 */
function florence_it_header_style() {
	$header_text_color = get_header_textcolor();	
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.header {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat;
			background-position: center top;
		}
	<?php endif; ?>	
	
	<?php // Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
		
	<?php  else : ?>		
	<?php endif; ?>	
	</style>
	<?php 
}
endif;    