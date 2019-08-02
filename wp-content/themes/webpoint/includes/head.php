<?php /* Head functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_head_charset' ) ) {

	/* Hook the function to an action. */
	add_action( 'wp_head', 'webpoint_head_charset', 0 );

	/**
	 * Insert meta charset to site HEAD
	 */
	function webpoint_head_charset() {

		printf(
			'<meta charset="%s">',
			esc_attr( get_bloginfo( 'charset' ) )
		);

	} // webpoint_head_charset();

}


if ( ! function_exists( 'webpoint_head_viewport' ) ) {

	/* Hook the function to an action. */
	add_action( 'wp_head', 'webpoint_head_viewport', 0 );

	/**
	 * Insert meta viewport to site HEAD
	 */
	function webpoint_head_viewport() {

		echo '<meta name="viewport" content="width=device-width, initial-scale=1">';

	} // webpoint_head_viewport();

}
