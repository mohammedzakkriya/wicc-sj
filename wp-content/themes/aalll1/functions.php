<?php
/**
 * Function describe for All1 
 * 
 * @package all1
 */

add_action( 'wp_enqueue_scripts', 'all1_enqueue_styles' );
function all1_enqueue_styles() {

  wp_enqueue_style( 'allingrid-stylesheet', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'all1-child-style', get_stylesheet_uri(), array( 'all1-stylesheet' ) );
}

/**
 * Plugin Recommendation
 */
require get_stylesheet_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Homepage Columns Widgets 
 */
if ( ! function_exists( 'all1_widgets_init' ) ) :
	/**
	 *	widgets-init action handler. Used to register widgets and register widget areas
	 */
	function all1_widgets_init() {

		/**
		 * Add Homepage Columns Widget areas
		 */
		register_sidebar( array (
								'name'			 =>  __( 'Homepage Column #1', 'all1' ),
								'id' 			 =>  'homepage-column-1-widget-area',
								'description'	 =>  __( 'The Homepage Column #1 widget area', 'all1' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="sidebar-title">',
								'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
							) );
							
		register_sidebar( array (
								'name'			 =>  __( 'Homepage Column #2', 'all1' ),
								'id' 			 =>  'homepage-column-2-widget-area',
								'description'	 =>  __( 'The Homepage Column #2 widget area', 'all1' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="sidebar-title">',
								'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
							) );

		register_sidebar( array (
								'name'			 =>  __( 'Homepage Column #3', 'all1' ),
								'id' 			 =>  'homepage-column-3-widget-area',
								'description'	 =>  __( 'The Homepage Column #3 widget area', 'all1' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="sidebar-title">',
								'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
							) );
	}
endif; // all1_widgets_init
add_action( 'widgets_init', 'all1_widgets_init' );