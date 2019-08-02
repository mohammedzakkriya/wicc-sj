<?php /* Index Template */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


/**
 * Index Template
 *
 * Hook: webpoint_content_index
 *
 * @see webpoint_content_index_wrap - 10
 * @see webpoint_content_index_posts_wrap - 20
 * @see webpoint_content_index_posts - 30
 * @see webpoint_content_index_posts_wrap_end - 40
 * @see webpoint_content_index_wrap_end - 50
 */


if ( ! function_exists( 'webpoint_content_index_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_index', 'webpoint_content_index_wrap', 10 );

	/**
	 * Outputs opening tags for the index template content.
	 */
	function webpoint_content_index_wrap() { ?>

        <div class="hentry">

            <div class="wrap">

	<?php } // webpoint_content_index_wrap();

}


if ( ! function_exists( 'webpoint_content_index_posts_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_index', 'webpoint_content_index_posts_wrap', 20 );

	/**
	 * Outputs opening tags for the posts.
	 */
    function webpoint_content_index_posts_wrap() { ?>

        <div class="entry-content">

    <?php } // webpoint_content_index_posts_wrap();

}


if ( ! function_exists( 'webpoint_content_index_posts' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_index', 'webpoint_content_index_posts', 30 );

	/**
	 * Index Template: Display List Posts.
	 */
	function webpoint_content_index_posts() { ?>

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
                 * @hooked webpoint_post_loop - 70
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

	<?php } // webpoint_content_index_posts();

}


if ( ! function_exists( 'webpoint_content_index_posts_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_index', 'webpoint_content_index_posts_wrap_end', 40 );

	/**
	 * Outputs closing tags for the posts.
	 */
    function webpoint_content_index_posts_wrap_end() { ?>

        </div><!-- .entry-content -->

    <?php } // webpoint_content_index_posts_wrap_end();

}


if ( ! function_exists( 'webpoint_content_index_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_index', 'webpoint_content_index_wrap_end', 50 );

	/**
	 * Outputs closing tags for the index page content.
	 */
	function webpoint_content_index_wrap_end() { ?>

            </div><!-- .wrap -->

        </div><!-- .hentry -->

	<?php } // webpoint_content_index_wrap_end();

}
