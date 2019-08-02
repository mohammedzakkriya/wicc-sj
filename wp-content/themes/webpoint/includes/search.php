<?php /* Search Functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


/**
 * Search Template
 *
 * Hook: webpoint_content_search
 *
 * @see webpoint_content_search_wrap - 10
 * @see webpoint_content_search_title - 20
 * @see webpoint_content_search_posts_wrap - 30
 * @see webpoint_content_search_posts - 40
 * @see webpoint_content_search_posts_wrap_end - 50
 * @see webpoint_content_search_wrap_end - 60
 */


if ( ! function_exists( 'webpoint_content_search_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_search', 'webpoint_content_search_wrap', 10 );

	/**
	 * Outputs opening tags for the error page content.
	 */
	function webpoint_content_search_wrap() { ?>

		<section class="hentry">

			<div class="wrap">

	<?php } // webpoint_content_search_wrap();

}


if ( ! function_exists( 'webpoint_content_search_title' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_search', 'webpoint_content_search_title', 20 );

	/**
	 * Display the Search Results Title.
	 */
	function webpoint_content_search_title() {

		global $wp_query;

		$found_posts = isset( $wp_query->found_posts ) ? $wp_query->found_posts : 0;

		if ( $found_posts ) {

			$title = sprintf(
				__( 'Results found: %s', 'webpoint' ),
				number_format( (float) $found_posts, 0, '.', ' ' )
			);

        } else {

			$title = __( 'No results found', 'webpoint' );

        } ?>

		<h1 class="entry-title"><?php echo $title; ?></h1>

	<?php } // webpoint_content_search_title();

}


if ( ! function_exists( 'webpoint_content_search_posts_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_search', 'webpoint_content_search_posts_wrap', 30 );

	/**
	 * Outputs opening tags for the search posts.
	 */
	function webpoint_content_search_posts_wrap() { ?>

        <div class="entry-content">

	<?php } // webpoint_content_search_posts_wrap();

}


if ( ! function_exists( 'webpoint_content_search_posts' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_search', 'webpoint_content_search_posts', 40 );

	/**
	 * Search Template: Display List Posts.
	 */
	function webpoint_content_search_posts() { ?>

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
                 * Hook: webpoint_search_no_results.
                 *
                 * @hooked webpoint_search_no_results_message - 10
                 * @hooked get_search_form - 20
                 */
                do_action( 'webpoint_search_no_results' );
			?>

		<?php endif; ?>

	<?php } // webpoint_content_search_posts();

}


if ( ! function_exists( 'webpoint_content_search_posts_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_search', 'webpoint_content_search_posts_wrap_end', 50 );

	/**
	 * Outputs closing tags for the search posts.
	 */
    function webpoint_content_search_posts_wrap_end() { ?>

        </div><!-- .entry-content -->

    <?php } // webpoint_content_search_posts_wrap_end();

}


if ( ! function_exists( 'webpoint_content_search_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_search', 'webpoint_content_search_wrap_end', 60 );

	/**
	 * Outputs closing tags for the error page content.
	 */
	function webpoint_content_search_wrap_end() { ?>

            </div><!-- .wrap -->

        </section><!-- .hentry -->

	<?php } // webpoint_content_search_wrap_end();

}


if ( ! function_exists( 'webpoint_search_no_results_message' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_search_no_results', 'webpoint_search_no_results_message', 10 );

	/**
	 * Search: no results message.
	 */
	function webpoint_search_no_results_message() { ?>

        <p><?php _e( 'Unfortunately, your query returned no results.', 'webpoint' ); ?></p>

        <ul>
            <li><?php _e( 'Make sure all words are spelled correctly.', 'webpoint' ); ?></li>
            <li><?php _e( 'Try different keywords.', 'webpoint' ); ?></li>
            <li><?php _e( 'Change the filtering options for search results.', 'webpoint' ); ?></li>
        </ul>

	<?php } // webpoint_search_no_results_message();

}


if ( ! function_exists( 'webpoint_get_search_form' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_search_no_results', 'webpoint_get_search_form', 20 );

	/**
	 * Display a search form.
	 */
	function webpoint_get_search_form() { ?>

        <?php get_search_form(); ?>

	<?php } // webpoint_get_search_form();

}


if ( ! function_exists( 'webpoint_get_search_query_args' ) ) {

	/**
	 * Get search query args.
	 *
	 * @return array|false
	 */
	function webpoint_get_search_query_args() {

		/* Init query args */
		$query_args = array();

		/* Set allowed post types */
		$post_types = array(
			'post'
		);

		/* Apply filters */
		$post_types = apply_filters( 'webpoint_search_post_types', $post_types );

		/* Set query post types */
		if ( isset( $_GET['post_type'] ) && ! empty( $_GET['post_type'] ) ) {
			if ( is_array( $_GET['post_type'] ) ) {
				foreach ( $_GET['post_type'] as $post_type ) {
					$post_type = webpoint_sanitize_var( $post_type, 'term', false );
					if ( $post_type && in_array( $post_type, $post_types ) ) {
						$query_args['post_type'][] = $post_type;
					}
				}
			} else {
				$post_type = webpoint_sanitize_var( $_GET['post_type'], 'term', false );
				if ( $post_type && in_array( $post_type, $post_types ) ) {
					$query_args['post_type'] = $post_type;
				}
			}
		}

		/* Set default post types if it's necessary */
		if ( ! isset( $query_args['post_type'] ) || empty( $query_args['post_type'] ) ) {
			$query_args['post_type'] = $post_types;
		}

		/* Limit posts per page */
		if ( isset( $_GET['posts_per_page'] ) && ! empty( $_GET['posts_per_page'] ) ) {
			$posts_per_page = webpoint_sanitize_var( $_GET['posts_per_page'], 'absint', 0 );
			if ( $posts_per_page && $posts_per_page <= 100 ) {
				$query_args['posts_per_page'] = $posts_per_page;
			} else {
				$query_args['posts_per_page'] = (int) get_option( 'posts_per_page', 10 );
			}
		}

		/* Set post status */
		$query_args['post_status'] = 'publish';

		/* Set pagination */
		$query_args['paged'] = webpoint_sanitize_var( get_query_var( 'paged' ), 'absint', 1 );

		/* Return search query args */
		return ! empty( $query_args ) ? $query_args : false;

	} // webpoint_get_search_query_args();

}


if ( ! function_exists( 'webpoint_filter_search_query_args' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'pre_get_posts', 'webpoint_filter_search_query_args' );

	/**
	 * Filter search query args.
	 *
	 * @param object $query
	 * @return object
	 */
	function webpoint_filter_search_query_args( $query ) {

		/* Check if it is a frontend, search results and main query */
		if ( is_admin() || ! $query->is_search() || ! $query->is_main_query() ) {
			return $query;
		}

		/* Get search query args */
		$args = webpoint_get_search_query_args();

		/* Set search query args */
		if ( is_array( $args ) ) {
			foreach ( $args as $key => $val ) {
				$query->set( $key, $val );
			}
		}

		/* Return query args */
		return $query;

	} // webpoint_filter_search_query_args();

}
