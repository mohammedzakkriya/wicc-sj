<?php
/**
 * Ajax functions
 *
 * @see webpoint_ajax_nonce_cb()
 * @see webpoint_js_globals_init_cb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


/* Detect AJAX Request */
if ( ! wp_doing_ajax() ) {
	return;
}


if ( ! function_exists( 'webpoint_ajax_nonce_cb' ) ) {

	/* Ajax nonce: actions */
	add_action( 'wp_ajax_webpoint_ajax_nonce', 'webpoint_ajax_nonce_cb' );
	add_action( 'wp_ajax_nopriv_webpoint_ajax_nonce', 'webpoint_ajax_nonce_cb' );

	/**
	 * Create ajax nonce using ajax.
	 */
	function webpoint_ajax_nonce_cb() {

		/* Create and display ajax nonce */
		echo wp_create_nonce( 'webpoint_ajax_nonce' );

		/* Exit */
		wp_die();

	} // webpoint_ajax_nonce_cb();

}


if ( ! function_exists( 'webpoint_js_globals_init_cb' ) ) {

	/* Ajax globals: actions */
	add_action( 'wp_ajax_webpoint_js_globals_init', 'webpoint_js_globals_init_cb' );
	add_action( 'wp_ajax_nopriv_webpoint_js_globals_init', 'webpoint_js_globals_init_cb' );

	/**
	 * Create javascript globals using Ajax.
	 */
	function webpoint_js_globals_init_cb() {

		/* Check AJAX request (ajax nonce) */
		check_ajax_referer( 'webpoint_ajax_nonce', 'webpoint_ajax_nonce' );

		/* Init globals */
		$js_globals = array();

		/* Set current user id */
		$js_globals['user_id'] = (int) get_current_user_id();

		/* Return (display) js globals */
		echo json_encode( $js_globals );

		/* Exit */
		wp_die();

	} // webpoint_js_globals_init_cb();

}
