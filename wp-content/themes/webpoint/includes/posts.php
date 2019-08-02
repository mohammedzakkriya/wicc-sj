<?php /* Post Loop */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_posts' ) ) {

	/**
	 * Template: Display List Posts.
	 */
	function webpoint_posts() { ?>

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

	<?php } // webpoint_posts();

}


if ( ! function_exists( 'webpoint_posts_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_posts', 'webpoint_posts_wrap', 10 );

	/**
	 * Outputs opening divs for the list posts.
	 */
	function webpoint_posts_wrap() { ?>

        <div class="posts list clearfix">

	<?php } // webpoint_posts_wrap();

}


if ( ! function_exists( 'webpoint_posts_header_wrap' ) ) {

	/* Hook the function to an action. */
	// add_action( 'webpoint_posts', 'webpoint_posts_header_wrap', 20 );

	/**
	 * Outputs opening divs for the posts header.
	 */
    function webpoint_posts_header_wrap() { ?>

        <div class="posts-header clearfix">

    <?php } // webpoint_posts_header_wrap();

}


if ( ! function_exists( 'webpoint_posts_order' ) ) {

	/* Hook the function to an action. */
	// add_action( 'webpoint_posts', 'webpoint_posts_order', 30 );

	/**
	 * Display the posts order switcher.
	 */
	function webpoint_posts_order() {

		/* Get orderby */
		$orderby = isset( $_GET['orderby'] ) ? $_GET['orderby'] : false;

		/* Sanitize orderby */
		$orderby = webpoint_sanitize_var( $orderby, 'term', false );

		/* Set default orderby */
		if ( ! $orderby ) {
			if ( is_search() ) {
				$orderby = 'relevance';
			} else {
				$orderby = 'date';
			}
		}

		/* Set orderby options */
		$orderby_options = array(
			'date'          => __( 'Sort by newness', 'webpoint' ),
			'comment_count' => __( 'Sort by popularity', 'webpoint' )
		);

		/* Add relevance option for search */
		if ( is_search() ) {
			$orderby_options = array_merge(
				array( 'relevance' => __( 'Sort by relevance', 'webpoint' ) ),
				$orderby_options
			);
		}

		/* Filter order options */
		$orderby_options = apply_filters( 'webpoint_posts_order', $orderby_options ); ?>

        <div class="posts-order">

            <form class="posts-ordering" method="get">

				<?php if ( is_search() ) : ?>

					<?php /* Output hidden search input */
					printf(
						'<input type="hidden" value="%s" name="s" />',
						esc_attr( get_search_query() )
					); ?>

					<?php /* Output hidden post type input */
					if ( isset( $_GET['post_type'] ) && ! empty( $_GET['post_type'] ) ) {
						$post_type = webpoint_sanitize_var( $_GET['post_type'], 'text', false );
						if ( $post_type ) {
							printf(
								'<input type="hidden" value="%s" name="post_type" />',
								esc_attr( $post_type )
							);
						}
					} ?>

				<?php endif; ?>

                <select title="<?php esc_attr_e( 'Sort by', 'webpoint' ); ?>" name="orderby" class="orderby">
					<?php foreach ( $orderby_options as $slug => $name ) : ?>
                        <option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $orderby, $slug ); ?>><?php echo esc_html( $name ); ?></option>
					<?php endforeach; ?>
                </select><!-- .orderby -->

            </form><!-- .posts-ordering -->

        </div><!-- .posts-order -->

	<?php } // webpoint_posts_order();

}


if ( ! function_exists( 'webpoint_posts_view' ) ) {

	/* Hook the function to an action. */
	// add_action( 'webpoint_posts', 'webpoint_posts_view', 40 );

	/**
	 * Display posts view switcher.
	 */
	function webpoint_posts_view() { ?>

        <div class="posts-view">

            <span class="label"><?php _e( 'View', 'webpoint' ); ?></span>

            <div class="btn-group">

                <span class="grid-btn btn"><i class="fa fa-th" aria-hidden="true"></i></span>

                <span class="list-btn btn"><i class="fa fa-th-list" aria-hidden="true"></i></span>

            </div><!-- .btn-group -->

        </div><!-- .posts-view -->

	<?php } // webpoint_posts_view();

}


if ( ! function_exists( 'webpoint_posts_header_wrap_end' ) ) {

	/* Hook the function to an action. */
	// add_action( 'webpoint_posts', 'webpoint_posts_header_wrap_end', 50 );

	/**
	 * Outputs closing divs for the posts header.
	 */
    function webpoint_posts_header_wrap_end() { ?>

        </div><!-- .posts-header -->

    <?php } // webpoint_posts_header_wrap_end();

}


if ( ! function_exists( 'webpoint_posts_content_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_posts', 'webpoint_posts_content_wrap', 60 );

	/**
	 * Outputs opening divs for the posts content.
	 */
    function webpoint_posts_content_wrap() { ?>

        <div class="posts-content clearfix">

    <?php } // webpoint_posts_content_wrap();

}


if ( ! function_exists( 'webpoint_post_loop' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_posts', 'webpoint_post_loop', 70 );

	/**
	 * Display the posts loop.
	 */
	function webpoint_post_loop() { ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
                    /**
                     * Hook: webpoint_post_loop_item.
                     *
                     * @hooked webpoint_post_loop_item_wrap - 10
                     * @hooked webpoint_post_loop_item_image - 20
                     * @hooked webpoint_post_loop_item_header - 30
                     * @hooked webpoint_post_loop_item_content - 40
                     * @hooked webpoint_post_loop_item_footer - 50
                     * @hooked webpoint_post_loop_item_wrap_end - 60
                     */
                    do_action( 'webpoint_post_loop_item' );
				?>

			<?php endwhile; ?>

		<?php endif; ?>

	<?php } // webpoint_post_loop();

}


if ( ! function_exists( 'webpoint_posts_content_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_posts', 'webpoint_posts_content_wrap_end', 80 );

	/**
	 * Outputs closing divs for the posts content.
	 */
    function webpoint_posts_content_wrap_end() { ?>

        </div><!-- .posts-content -->

    <?php } // webpoint_posts_content_wrap_end();

}


if ( ! function_exists( 'webpoint_posts_footer_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_posts', 'webpoint_posts_footer_wrap', 90 );

	/**
	 * Outputs opening divs for the posts footer.
	 */
    function webpoint_posts_footer_wrap() { ?>

        <div class="posts-footer">

    <?php } // webpoint_posts_footer_wrap();

}


if ( ! function_exists( 'webpoint_posts_footer_pagination' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_posts', 'webpoint_posts_footer_pagination', 100 );

	/**
	 * Display the posts pagination.
	 */
	function webpoint_posts_footer_pagination() { ?>

		<?php webpoint_posts_pagination(); ?>

	<?php } // webpoint_posts_footer_pagination();

}


if ( ! function_exists( 'webpoint_posts_footer_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_posts', 'webpoint_posts_footer_wrap_end', 110 );

	/**
	 * Outputs closing divs for the posts footer.
	 */
    function webpoint_posts_footer_wrap_end() { ?>

        </div><!-- .posts-footer -->

    <?php } // webpoint_posts_footer_wrap_end();

}


if ( ! function_exists( 'webpoint_posts_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_posts', 'webpoint_posts_wrap_end', 120 );

	/**
	 * Outputs closing divs for the list posts.
	 */
	function webpoint_posts_wrap_end() { ?>

        </div><!-- .posts -->

	<?php } // webpoint_posts_wrap_end();

}


if ( ! function_exists( 'webpoint_post_loop_item_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_post_loop_item', 'webpoint_post_loop_item_wrap', 10 );

	/**
	 * Outputs opening divs for the loop item content.
	 */
	function webpoint_post_loop_item_wrap() { ?>

        <article <?php post_class( 'hentry item clearfix' ); ?>>

            <div class="outer">

                <div class="inner">

                    <div class="wrapper">

                        <div class="content">

	<?php } // webpoint_post_loop_item_wrap();

}


if ( ! function_exists( 'webpoint_post_loop_item_image' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_post_loop_item', 'webpoint_post_loop_item_image', 20 );

	/**
	 * Display the loop item entry image.
	 */
	function webpoint_post_loop_item_image() {

		/* Check post thumbnail exists */
		if ( has_post_thumbnail() ) {

			/* Display post thumbnail */
			printf(
				'<div class="entry-image">%s</div><!-- .entry-image -->',
				get_the_post_thumbnail(
					null,
					'thumbnail',
					array(
						'class' => 'thumbnail',
						'data-href' => esc_url( get_the_permalink() )
					)
				)
			);

		} else {

			/* Get placeholder image data */
			$placeholder_image = webpoint_get_image_data( 0, 'thumbnail' );
			if ( ! $placeholder_image ) {
				return;
			}

			/* Display placeholder image */
			printf(
				'<div class="entry-image no-image"><img src="%1$s" class="thumbnail placeholder" alt="%2$s" data-href="%3$s" width="%4$s" height="%5$s"></div><!-- .entry-image -->',
				$placeholder_image['url'],
				$placeholder_image['alt'],
				esc_url( get_the_permalink() ),
				$placeholder_image['width'],
				$placeholder_image['height']
			);

		}

	} // webpoint_post_loop_item_image();

}


if ( ! function_exists( 'webpoint_post_loop_item_header' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_post_loop_item', 'webpoint_post_loop_item_header', 30 );

	/**
	 * Display the loop item entry header.
	 */
	function webpoint_post_loop_item_header() {

		/* Set heading tag through the filter */
		$title_tag = apply_filters( 'webpoint_post_loop_item_title_tag', 'h2' );

		/* Output the entry header */
		printf(
			'<header class="entry-header"><%1$s class="entry-title"><a href="%2$s" rel="bookmark">%3$s</a></%4$s></header><!-- .entry-header -->',
			$title_tag,
			esc_url( get_permalink() ),
			esc_attr( get_the_title() ),
			$title_tag
		);

	} // webpoint_post_loop_item_header();

}


if ( ! function_exists( 'webpoint_post_loop_item_content' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_post_loop_item', 'webpoint_post_loop_item_content', 40 );

	/**
	 * Display the loop item entry summary.
	 */
	function webpoint_post_loop_item_content() {

		/* Get post excerpt */
		$excerpt = webpoint_get_post_excerpt(
			null,
			apply_filters( 'webpoint_post_loop_item_excerpt_limit', 32 ),
			apply_filters( 'webpoint_post_loop_item_excerpt_more', null ),
			true
		);

		/* Check post excerpt */
		if ( $excerpt === false ) {
			return;
		}

		/* Display loop item entry summary */
		printf( '<div class="entry-summary">%s</div><!-- .entry-summary -->', $excerpt );

	} // webpoint_post_loop_item_content();

}


if ( ! function_exists( 'webpoint_post_loop_item_footer' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_post_loop_item', 'webpoint_post_loop_item_footer', 50 );

	/**
	 * Display loop item entry footer.
	 */
	function webpoint_post_loop_item_footer() { ?>

        <footer class="entry-footer">

            <time class="published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>

            <span class="sep"> | </span>

			<?php comments_popup_link( _x( 'No Comments', 'comments link', 'webpoint' ) ); ?>

        </footer><!-- .entry-footer -->

	<?php } // webpoint_post_loop_item_footer();

}


if ( ! function_exists( 'webpoint_post_loop_item_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_post_loop_item', 'webpoint_post_loop_item_wrap_end', 60 );

	/**
	 * Outputs closing divs for the loop item content.
	 */
	function webpoint_post_loop_item_wrap_end() { ?>

                        </div><!-- .content -->

                    </div><!-- .wrapper -->

                </div><!-- .inner -->

            </div><!-- .outer -->

        </article><!-- .hentry -->

	<?php } // webpoint_post_loop_item_wrap_end();

}


if ( ! function_exists( 'webpoint_post_loop_results_found' ) ) {

	/**
	 * Display loop results found.
	 */
	function webpoint_post_loop_results_found() {

		global $wp_query;

		/* Get posts count */
		$found_posts = isset( $wp_query->found_posts ) ? $wp_query->found_posts : 0;
		if ( ! $found_posts ) {
		    return;
        }

		/* Set the title */
		$title = sprintf(
			__( 'Results found: %s', 'webpoint' ),
			$found_posts
		); ?>

        <h2 class="sh"><?php echo $title ?></h2>

	<?php } // webpoint_post_loop_results_found();

}


if ( ! function_exists( 'webpoint_no_posts_message' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_no_posts', 'webpoint_no_posts_message', 10 );

	/**
	 * Search: no posts message.
	 */
	function webpoint_no_posts_message() { ?>

        <p class="notice no-posts"><?php _e( 'No posts yet.', 'webpoint' ); ?></p>

	<?php } // webpoint_no_posts_message();

}
