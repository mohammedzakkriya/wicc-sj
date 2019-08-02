<?php /* Archive Template */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


/**
 * Archive Template
 *
 * Hook: webpoint_content_archive
 *
 * @see webpoint_content_archive_wrap - 10
 * @see webpoint_content_archive_title - 20
 * @see webpoint_content_archive_posts_wrap - 30
 * @see webpoint_content_archive_posts - 40
 * @see webpoint_content_archive_posts_wrap_end - 50
 * @see webpoint_content_archive_wrap_end - 60
 */


if ( ! function_exists( 'webpoint_content_archive_wrap' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_archive', 'webpoint_content_archive_wrap', 10 );

	/**
	 * Outputs opening tags for the archive page content.
	 */
	function webpoint_content_archive_wrap() { ?>

        <div class="hentry">

            <div class="wrap">

	<?php } // webpoint_content_archive_wrap();

}


if ( ! function_exists( 'webpoint_content_archive_title' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_archive', 'webpoint_content_archive_title', 20 );

	/**
	 * Display the archive page title.
	 */
	function webpoint_content_archive_title() {

		/* Get archive title */
		$title = is_post_type_archive()
            ? post_type_archive_title( '', false )
            : get_the_archive_title(); ?>

        <h1 class="entry-title"><?php echo $title; ?></h1>

	<?php } // webpoint_content_archive_title();

}


if ( ! function_exists( 'webpoint_content_archive_posts_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_archive', 'webpoint_content_archive_posts_wrap', 30 );

	/**
	 * Outputs opening tags for the taxonomy posts.
	 */
	function webpoint_content_archive_posts_wrap() { ?>

        <div class="entry-content">

	<?php } // webpoint_content_archive_posts_wrap();

}


if ( ! function_exists( 'webpoint_content_archive_posts' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_archive', 'webpoint_content_archive_posts', 40 );

	/**
	 * Archive Template: Display List Posts.
	 */
	function webpoint_content_archive_posts() { ?>

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

	<?php } // webpoint_content_archive_posts();

}


if ( ! function_exists( 'webpoint_content_archive_posts_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_archive', 'webpoint_content_archive_posts_wrap_end', 50 );

	/**
	 * Outputs closing tags for the taxonomy posts.
	 */
    function webpoint_content_archive_posts_wrap_end() { ?>

        </div><!-- .entry-content -->

    <?php } // webpoint_content_archive_posts_wrap_end();

}


if ( ! function_exists( 'webpoint_content_archive_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_archive', 'webpoint_content_archive_wrap_end', 60 );

	/**
	 * Outputs closing tags for the archive page content.
	 */
	function webpoint_content_archive_wrap_end() { ?>

            </div><!-- .wrap -->

        </div><!-- .hentry -->

	<?php } // webpoint_content_archive_wrap_end();

}
