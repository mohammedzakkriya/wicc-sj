<?php /* Home Template */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


/**
 * Author Template
 *
 * Hook: webpoint_content_author
 *
 * @see webpoint_content_author_wrap - 10
 * @see webpoint_content_author_title - 20
 * @see webpoint_edit_author_link - 30
 * @see webpoint_content_author_posts_wrap - 40
 * @see webpoint_content_author_posts - 50
 * @see webpoint_content_author_posts_wrap_end - 60
 * @see webpoint_content_author_wrap_end - 70
 */


if ( ! function_exists( 'webpoint_content_author_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_author', 'webpoint_content_author_wrap', 10 );

	/**
	 * Outputs opening tags for the author page content.
	 */
	function webpoint_content_author_wrap() { ?>

        <div class="hentry">

            <div class="wrap">

	<?php } // webpoint_content_author_wrap();

}


if ( ! function_exists( 'webpoint_content_author_title' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_author', 'webpoint_content_author_title', 20 );

	/**
	 * Display the author page title.
	 */
	function webpoint_content_author_title() {

	    /* Get author ID */
	    $author_id = webpoint_get_archive_author_id();

	    /* Set the title */
	    if ( $author_id ) {
		    $title = sprintf(
			    __( 'Author: %s', 'webpoint' ),
			    get_the_author_meta( 'display_name', $author_id )
		    );
        } else {
		    $title = __( 'Archives', 'webpoint' );
        } ?>

        <h1 class="entry-title"><?php echo $title; ?></h1>

	<?php } // webpoint_content_author_title();

}


if ( ! function_exists( 'webpoint_edit_author_link' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_author', 'webpoint_edit_author_link', 30 );

	/**
	 * Display the edit author link.
	 */
	function webpoint_edit_author_link() {

		/* Check page */
		if ( ! is_author() ) {
			return;
		}

		/* Get author ID */
		$author_id = webpoint_get_archive_author_id();
		if ( ! $author_id ) {
			return;
		}

		/* Get author edit link */
		$edit_link = get_edit_user_link( $author_id );
		if ( empty( $edit_link ) ) {
			return;
		}

		/* Display author edit link */
		printf(
			'<p class="edit-link"><a class="user-edit-link" href="%1$s">%2$s</a></p>',
			esc_url( $edit_link ),
			esc_attr__( 'Edit', 'webpoint' )
		);

	} // webpoint_edit_author_link();

}


if ( ! function_exists( 'webpoint_content_author_posts_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_author', 'webpoint_content_author_posts_wrap', 40 );

	/**
	 * Outputs opening tags for the author posts.
	 */
    function webpoint_content_author_posts_wrap() { ?>

        <div class="entry-content">

    <?php } // webpoint_content_author_posts_wrap();

}


if ( ! function_exists( 'webpoint_content_author_posts' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_author', 'webpoint_content_author_posts', 50 );

	/**
	 * Author Template: Display List Posts.
	 */
	function webpoint_content_author_posts() { ?>

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

	<?php } // webpoint_content_author_posts();

}


if ( ! function_exists( 'webpoint_content_author_posts_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_author', 'webpoint_content_author_posts_wrap_end', 60 );

	/**
	 * Outputs closing tags for the author posts.
	 */
    function webpoint_content_author_posts_wrap_end() { ?>

        </div><!-- .entry-content -->

    <?php } // webpoint_content_author_posts_wrap_end();

}


if ( ! function_exists( 'webpoint_content_author_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_author', 'webpoint_content_author_wrap_end', 70 );

	/**
	 * Outputs closing tags for the author page content.
	 */
	function webpoint_content_author_wrap_end() { ?>

            </div><!-- .wrap -->

        </div><!-- .hentry -->

	<?php } // webpoint_content_author_wrap_end();

}


if ( ! function_exists( 'webpoint_get_archive_author_id' ) ) {

	/**
	 * Get the current archive page author ID.
	 *
	 * @return int
	 */
	function webpoint_get_archive_author_id() {

		/* Check page */
		if ( ! is_author() ) {
			return 0;
		}

		/* Get author ID */
		$author_id = get_query_var( 'author' );
		if ( ! $author_id ) {
			$author_name = get_query_var( 'author_name' );
			if ( $author_name ) {
				$author = get_user_by( 'slug', $author_name );
				$author_id = isset( $author->ID ) ? $author->ID : 0;
			}
		}

		/* Return sanitized author ID */
		return webpoint_sanitize_var( $author_id, 'absint', 0 );

	} // webpoint_get_archive_author_id();

}
