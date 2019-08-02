<?php /* 404 Functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


/**
 * Error Page Template
 *
 * Hook: webpoint_content_404
 *
 * @see webpoint_content_404_wrap - 10
 * @see webpoint_content_404_title - 20
 * @see webpoint_content_404_content - 30
 * @see webpoint_content_404_wrap_end - 40
 */


if ( ! function_exists( 'webpoint_content_404_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_404', 'webpoint_content_404_wrap', 10 );

	/**
	 * Outputs opening tags for the error page content.
	 */
    function webpoint_content_404_wrap() { ?>

        <section class="hentry">

            <div class="wrap">

    <?php } // webpoint_content_404_wrap();

}


if ( ! function_exists( 'webpoint_content_404_title' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_404',  'webpoint_content_404_title', 20 );

	/**
	 * Outputs the error page title.
	 */
    function webpoint_content_404_title() { ?>

        <h1 class="entry-title"><?php _e(
			    'Error 404 &mdash; Page not found',
			    'webpoint'
		    ); ?></h1>

    <?php } // webpoint_content_404_title();

}


if ( ! function_exists( 'webpoint_content_404_content' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_404',  'webpoint_content_404_content', 30 );

	/**
	 * Outputs the error page content.
	 */
	function webpoint_content_404_content() { ?>

        <div class="entry-content">

            <p><?php _e( 'Unfortunately, there is no such page on our website.', 'webpoint' ); ?></p>

            <p><?php _e( 'You may have entered the wrong page address or it was removed from the server.', 'webpoint' ); ?></p>

            <p><?php printf(
					__( 'You can go to the %1$smain page%2$s or use the site search.', 'webpoint' ),
					'<a href="' . esc_url( home_url() ) . '">',
					'</a>'
				); ?></p>

			<?php get_search_form(); ?>

        </div><!-- .entry-content -->

	<?php } // webpoint_content_404_content();

}


if ( ! function_exists( 'webpoint_content_404_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_404', 'webpoint_content_404_wrap_end', 40 );

	/**
	 * Outputs closing tags for the error page content.
	 */
    function webpoint_content_404_wrap_end() { ?>

            </div><!-- .wrap -->

        </section><!-- .not-found -->

    <?php } // webpoint_content_404_wrap_end();

}
