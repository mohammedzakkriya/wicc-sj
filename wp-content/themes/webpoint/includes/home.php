<?php /* Home Template */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


/**
 * Homepage Template
 *
 * Hook: webpoint_content_home
 *
 * @see webpoint_content_home_wrap - 10
 * @see webpoint_content_home_title - 20
 * @see webpoint_content_home_posts_wrap - 30
 * @see webpoint_content_home_posts - 40
 * @see webpoint_content_home_posts_wrap_end - 50
 * @see webpoint_content_home_wrap_end - 60
 */


if ( ! function_exists( 'webpoint_content_home_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_home', 'webpoint_content_home_wrap', 10 );

	/**
	 * Outputs opening tags for the home page content.
	 */
	function webpoint_content_home_wrap() { ?>

        <div class="hentry">

            <div class="wrap">

	<?php } // webpoint_content_home_wrap();

}


if ( ! function_exists( 'webpoint_content_home_title' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_home', 'webpoint_content_home_title', 20 );

	/**
	 * Display the home page title.
	 */
	function webpoint_content_home_title() { ?>

        <h1 class="entry-title"><?php bloginfo( 'name' ); ?></h1>

	<?php } // webpoint_content_home_title();

}


if ( ! function_exists( 'webpoint_content_home_posts_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_home', 'webpoint_content_home_posts_wrap', 30 );

	/**
	 * Outputs opening tags for the home posts.
	 */
	function webpoint_content_home_posts_wrap() { ?>

        <div class="entry-content">

	<?php } // webpoint_content_home_posts_wrap();

}


if ( ! function_exists( 'webpoint_content_home_posts' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_home', 'webpoint_content_home_posts', 40 );

	/**
	 * Home Template: Display List Posts.
	 */
	function webpoint_content_home_posts() { ?>

		<?php if ( have_posts() ) : ?>

			<?php
                /**
                 * Hook: webpoint_posts.
                 *
                 * @hooked webpoint_posts_wrap - 10
                 * @hooked webpoint_posts_header_wrap - 20
                 * @hooked webpoint_posts_order - 30
                 * @hooked webpoint_posts_view - 40
                 * @hooked webpoint_posts_header_wrap_end - 50
                 * @hooked webpoint_posts_content_wrap - 60
                 * @hooked webpoint_loop - 70
                 * @hooked webpoint_posts_content_wrap_end - 80
                 * @hooked webpoint_posts_footer_wrap - 90
                 * @hooked webpoint_posts_footer_pagination - 100
                 * @hooked webpoint_posts_footer_wrap_end - 110
                 * @hooked webpoint_posts_wrap_end - 120
                 */
                do_action( 'webpoint_posts' );
			?>

		<?php else : ?>

			<?php
                /**
                 * Hook: webpoint_no_posts.
                 *
                 * @hooked webpoint_no_posts_message - 10
                 */
                do_action( 'webpoint_no_posts' );
			?>

		<?php endif; ?>

	<?php } // webpoint_content_home_posts();

}


if ( ! function_exists( 'webpoint_content_home_posts_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_home', 'webpoint_content_home_posts_wrap_end', 50 );

	/**
	 * Outputs closing tags for the home posts.
	 */
	function webpoint_content_home_posts_wrap_end() { ?>

        </div><!-- .entry-content -->

	<?php } // webpoint_content_home_posts_wrap_end();

}


if ( ! function_exists( 'webpoint_content_home_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_home', 'webpoint_content_home_wrap_end', 60 );

	/**
	 * Outputs closing tags for the home page content.
	 */
	function webpoint_content_home_wrap_end() { ?>

            </div><!-- .wrap -->

        </div><!-- .hentry -->

	<?php } // webpoint_content_home_wrap_end();

}
