<?php /* Sidebar Functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_unset_sidebar' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_sidebar', 'webpoint_unset_sidebar', 5 );

	/**
	 * Remove site sidebar.
	 */
	function webpoint_unset_sidebar() {

		/* Check sidebar position */
		if ( webpoint_get_template_globals( 'sidebar_position' ) != 'none' ) {
			return;
		}

		/* Remove all sidebar actions. */
		remove_all_actions( 'webpoint_sidebar' );

	} // webpoint_unset_sidebar();

}


if ( ! function_exists( 'webpoint_sidebar_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_sidebar', 'webpoint_sidebar_wrap', 10 );

	/**
	 * Outputs opening divs for the site sidebar.
	 */
	function webpoint_sidebar_wrap() { ?>

		<aside id="sidebar" class="sidebar" itemscope itemtype="http://schema.org/WPSideBar">

	<?php } // webpoint_sidebar_wrap();

}


if ( ! function_exists( 'webpoint_sidebar_widgets' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_sidebar', 'webpoint_sidebar_widgets', 20 );

	/**
	 * Display sidebar widgets.
	 */
	function webpoint_sidebar_widgets() {

		/* Check registered sidebar exists */
		if ( ! is_active_sidebar( 'sidebar' ) ) {
			return;
		}

		/* Execute sidebar widgets */
		dynamic_sidebar( 'sidebar' );

	} // webpoint_sidebar_widgets();

}


if ( ! function_exists( 'webpoint_sidebar_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_sidebar', 'webpoint_sidebar_wrap_end', 30 );

	/**
	 * Outputs closing tags for the site sidebar.
	 */
	function webpoint_sidebar_wrap_end() { ?>

		</aside><!-- #sidebar -->

	<?php } // webpoint_sidebar_wrap_end();

}
