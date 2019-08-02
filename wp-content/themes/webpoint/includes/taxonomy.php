<?php /* Taxonomy Template */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


/**
 * Taxonomy Template
 *
 * Hook: webpoint_content_category
 * Hook: webpoint_content_tag
 * Hook: webpoint_content_taxonomy
 *
 * @see webpoint_content_taxonomy_wrap - 10
 * @see webpoint_content_taxonomy_title - 20
 * @see webpoint_edit_term_link - 30
 * @see webpoint_content_taxonomy_posts_wrap - 40
 * @see webpoint_content_taxonomy_posts - 50
 * @see webpoint_content_taxonomy_posts_wrap_end - 60
 * @see webpoint_content_taxonomy_wrap_end - 70
 */


if ( ! function_exists( 'webpoint_content_taxonomy_wrap' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_category', 'webpoint_content_taxonomy_wrap', 10 );
	add_action( 'webpoint_content_tag',      'webpoint_content_taxonomy_wrap', 10 );
	add_action( 'webpoint_content_taxonomy', 'webpoint_content_taxonomy_wrap', 10 );

	/**
	 * Outputs opening tags for the taxonomy page content.
	 */
	function webpoint_content_taxonomy_wrap() { ?>

        <div class="hentry">

            <div class="wrap">

	<?php } // webpoint_content_taxonomy_wrap();

}


if ( ! function_exists( 'webpoint_content_taxonomy_title' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_category', 'webpoint_content_taxonomy_title', 20 );
	add_action( 'webpoint_content_tag',      'webpoint_content_taxonomy_title', 20 );
	add_action( 'webpoint_content_taxonomy', 'webpoint_content_taxonomy_title', 20 );

	/**
	 * Display the taxonomy page title.
	 */
	function webpoint_content_taxonomy_title() { ?>

        <h1 class="entry-title"><?php single_term_title( '', true ); ?></h1>

	<?php } // webpoint_content_taxonomy_title();

}


if ( ! function_exists( 'webpoint_edit_term_link' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_category', 'webpoint_edit_term_link', 30 );
	add_action( 'webpoint_content_tag',      'webpoint_edit_term_link', 30 );
	add_action( 'webpoint_content_taxonomy', 'webpoint_edit_term_link', 30 );

	/**
	 * Display the edit term link.
	 */
	function webpoint_edit_term_link() { ?>

		<?php edit_term_link(
			__( 'Edit', 'webpoint' ),
			'<p class="edit-link">',
			'</p>'
		); ?>

	<?php } // webpoint_edit_term_link();

}


if ( ! function_exists( 'webpoint_content_taxonomy_posts_wrap' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_category', 'webpoint_content_taxonomy_posts_wrap', 40 );
	add_action( 'webpoint_content_tag',      'webpoint_content_taxonomy_posts_wrap', 40 );
	add_action( 'webpoint_content_taxonomy', 'webpoint_content_taxonomy_posts_wrap', 40 );

	/**
	 * Outputs opening tags for the taxonomy posts.
	 */
	function webpoint_content_taxonomy_posts_wrap() { ?>

        <div class="entry-content">

	<?php } // webpoint_content_taxonomy_posts_wrap();

}


if ( ! function_exists( 'webpoint_content_taxonomy_posts' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_category', 'webpoint_content_taxonomy_posts', 50 );
	add_action( 'webpoint_content_tag',      'webpoint_content_taxonomy_posts', 50 );
	add_action( 'webpoint_content_taxonomy', 'webpoint_content_taxonomy_posts', 50 );

	/**
	 * Taxonomy Template: Display List Posts.
	 */
	function webpoint_content_taxonomy_posts() { ?>

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
                 * Hook: webpoint_taxonomy_no_posts.
                 *
                 * @hooked webpoint_taxonomy_no_posts_message - 10
                 */
                do_action( 'webpoint_taxonomy_no_posts' );
			?>

		<?php endif; ?>

	<?php } // webpoint_content_taxonomy_posts();

}


if ( ! function_exists( 'webpoint_content_taxonomy_posts_wrap_end' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_category', 'webpoint_content_taxonomy_posts_wrap_end', 60 );
	add_action( 'webpoint_content_tag',      'webpoint_content_taxonomy_posts_wrap_end', 60 );
	add_action( 'webpoint_content_taxonomy', 'webpoint_content_taxonomy_posts_wrap_end', 60 );

	/**
	 * Outputs closing tags for the taxonomy posts.
	 */
	function webpoint_content_taxonomy_posts_wrap_end() { ?>

        </div><!-- .entry-content -->

	<?php } // webpoint_content_taxonomy_posts_wrap_end();

}


if ( ! function_exists( 'webpoint_content_taxonomy_wrap_end' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_category', 'webpoint_content_taxonomy_wrap_end', 70 );
	add_action( 'webpoint_content_tag',      'webpoint_content_taxonomy_wrap_end', 70 );
	add_action( 'webpoint_content_taxonomy', 'webpoint_content_taxonomy_wrap_end', 70 );

	/**
	 * Outputs closing tags for the taxonomy page content.
	 */
	function webpoint_content_taxonomy_wrap_end() { ?>

            </div><!-- .wrap -->

        </div><!-- .hentry -->

	<?php } // webpoint_content_taxonomy_wrap_end();

}


if ( ! function_exists( 'webpoint_taxonomy_no_posts_message' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_taxonomy_no_posts', 'webpoint_taxonomy_no_posts_message', 10 );

	/**
	 * Search: no results message.
	 */
	function webpoint_taxonomy_no_posts_message() { ?>

        <p class="notice"><?php _e( 'There are no posts in this category yet.', 'webpoint' ); ?></p>

	<?php } // webpoint_taxonomy_no_posts_message();

}
