<?php /* Template Functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_template_header' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_template', 'webpoint_template_header', 10 );

	/**
	 * Output the site header.
	 *
	 * @param string $template Template name.
	 */
	function webpoint_template_header( $template = '' ) { ?>

		<?php
            /**
             * Hook: webpoint_header.
             *
             * @hooked webpoint_noscript_notice - 5
             * @hooked webpoint_header_wrap - 10
             * @hooked webpoint_header_top_row_wrap - 20
             * @hooked webpoint_header_top_row_left_col_wrap - 30
             * @hooked webpoint_top_menu - 40
             * @hooked webpoint_header_top_row_left_col_wrap_end - 50
             * @hooked webpoint_header_top_row_right_col_wrap - 60
             * @hooked webpoint_user_menu - 70
             * @hooked webpoint_header_top_row_right_col_wrap_end - 80
             * @hooked webpoint_header_top_row_wrap_end - 90
             * @hooked webpoint_header_middle_row_wrap - 100
             * @hooked webpoint_header_middle_row_left_col_wrap - 110
             * @hooked webpoint_logo - 120
             * @hooked webpoint_header_middle_row_left_col_wrap_end - 130
             * @hooked webpoint_header_middle_row_center_col_wrap - 140
             * @hooked webpoint_main_search - 150
             * @hooked webpoint_header_middle_row_center_col_wrap_end - 160
             * @hooked webpoint_header_middle_row_right_col_wrap - 170
             * @hooked webpoint_header_widget - 180
             * @hooked webpoint_header_middle_row_right_col_wrap_end - 190
             * @hooked webpoint_header_middle_row_wrap_end - 200
             * @hooked webpoint_header_bottom_row_wrap - 210
             * @hooked webpoint_header_bottom_row_center_col_wrap - 220
             * @hooked webpoint_header_main_menu - 230
             * @hooked webpoint_header_bottom_row_center_col_wrap_end - 240
             * @hooked webpoint_header_bottom_row_wrap_end - 250
             * @hooked webpoint_header_wrap_end - 260
             */
            do_action( 'webpoint_header', $template );
		?>

	<?php } // webpoint_template_header();

}


if ( ! function_exists( 'webpoint_template_content' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_template', 'webpoint_template_content', 20 );

	/**
	 * Create an action based on template name.
	 *
	 * @param string $template Template name.
	 */
	function webpoint_template_content( $template = '' ) { ?>

		<?php
            /**
             * Hook: webpoint_template_content.
             *
             * @hooked webpoint_content_wrap - 10
             * @hooked webpoint_main_content_wrap - 20
             * @hooked webpoint_content - 30
             * @hooked webpoint_main_content_wrap_end - 40
             * @hooked webpoint_template_sidebar - 50
             * @hooked webpoint_content_wrap_end - 60
             */
            do_action( 'webpoint_template_content', $template );
		?>

	<?php } // webpoint_template_content();

}


if ( ! function_exists( 'webpoint_template_footer' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_template', 'webpoint_template_footer', 30 );

	/**
	 * Output the site footer.
	 *
	 * @param string $template Template name.
	 */
	function webpoint_template_footer( $template = '' ) { ?>

		<?php
            /**
             * Hook: webpoint_footer.
             *
             * @hooked webpoint_footer_wrap - 10
             * @hooked webpoint_footer_widgets - 20
             * @hooked webpoint_footer_menu - 30
             * @hooked webpoint_footer_wrap_end - 40
             */
            do_action( 'webpoint_footer', $template );
		?>

	<?php } // webpoint_template_footer();

}


if ( ! function_exists( 'webpoint_content_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_template_content', 'webpoint_content_wrap', 10 );

	/**
	 * Outputs opening tags for the content template.
	 */
	function webpoint_content_wrap() { ?>

	    <div id="content" class="site-content">

            <div class="sw">

                <div class="inner clearfix">

    <?php } // webpoint_content_wrap();

}


if ( ! function_exists( 'webpoint_main_content_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_template_content', 'webpoint_main_content_wrap', 20 );

	/**
	 * Outputs opening tags for the main content.
	 */
	function webpoint_main_content_wrap() { ?>

        <main id="main" class="site-main">

    <?php } // webpoint_main_content_wrap();

}


if ( ! function_exists( 'webpoint_content' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_template_content', 'webpoint_content', 30 );

	/**
	 * Create an action based on template name.
	 *
	 * @param string $template Template name.
	 */
	function webpoint_content( $template = '' ) { ?>

		<?php if ( is_singular() ) : ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_action( "webpoint_content_{$template}" ); ?>

				<?php endwhile; ?>

			<?php endif; ?>

		<?php else: ?>

			<?php do_action( "webpoint_content_{$template}" ); ?>

		<?php endif; ?>

	<?php } // webpoint_content();

}


if ( ! function_exists( 'webpoint_main_content_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_template_content', 'webpoint_main_content_wrap_end', 40 );

	/**
	 * Outputs closing tags for the main content.
	 */
	function webpoint_main_content_wrap_end() { ?>

        </main><!-- #main -->

	<?php } // webpoint_main_content_wrap_end();

}


if ( ! function_exists( 'webpoint_template_sidebar' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_template_content', 'webpoint_template_sidebar', 50 );

	/**
	 * Load the sidebar template.
	 */
	function webpoint_template_sidebar() { ?>

		<?php get_sidebar(); ?>

	<?php } // webpoint_template_sidebar();

}


if ( ! function_exists( 'webpoint_content_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_template_content', 'webpoint_content_wrap_end', 60 );

	/**
	 * Outputs closing tags for the content template.
	 */
	function webpoint_content_wrap_end() { ?>

                </div><!-- .inner -->

            </div><!-- .sw -->

        </div><!-- #content -->

	<?php } // webpoint_content_wrap_end();

}


if ( ! function_exists( 'webpoint_searchform' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_searchform', 'webpoint_searchform', 10 );

	/**
	 * Output the search form.
	 */
	function webpoint_searchform() { ?>

		<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">

			<div class="search-input clearfix">

				<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" class="s" placeholder="<?php esc_attr_e( 'Search for', 'webpoint' ); ?>..." /><!-- .s -->

				<button type="submit" class="button searchsubmit" value="">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button><!-- .searchsubmit -->

			</div><!-- .search-input -->

		</form><!-- .searchform -->

	<?php } // webpoint_searchform();

}


if ( ! function_exists( 'webpoint_get_sidebar_position' ) ) {

	/**
	 * Get the sidebar position.
	 *
	 * @return string
	 */
	function webpoint_get_sidebar_position() {

        /* Get theme settings */
		$position = webpoint_get_theme_mod(
			'sidebar_position',
			'string',
			'none'
		);

		/* Apply filters */
		$position = apply_filters( 'webpoint_sidebar_position', $position );

		/* Sanitize sidebar position */
		$position = webpoint_sanitize_var( $position, 'string', false );

		/* Set valid sidebar positions */
		$valid = array( 'left', 'right', 'bottom', 'none' );

		/* Check sidebar position */
		if ( ! $position || ! in_array( $position, $valid ) ) {
			$position = 'none';
		}

		/* Return sidebar position */
		return (string) $position;

	} // webpoint_get_sidebar_position();

}


if ( ! function_exists( 'webpoint_get_page_type' ) ) {

	/*
	 * Get current page type.
	 *
	 * @return string|false
	 */
	function webpoint_get_page_type() {

		/* Set page type */
		if ( is_404() ) {
			$page_type = '404';
		} elseif ( is_search() ) {
			$page_type = 'search';
		} elseif ( is_home() ) {
			$page_type = 'home';
		} elseif ( is_front_page() ) {
			$page_type = 'front_page';
		} elseif ( is_post_type_archive() ) {
			$page_type = 'post_type_archive';
		} elseif ( is_tax() || is_category() || is_tag() ) {
			$page_type = 'term';
		} elseif ( is_singular() ) {
			if ( is_attachment() ) {
				$page_type = 'attachment';
			} elseif ( is_single() ) {
				$page_type = 'single';
			} elseif ( is_page() ) {
				$page_type = 'page';
			} else {
				$page_type = false;
			}
		} elseif ( is_author() ) {
			$page_type = 'author';
		} elseif ( is_date() ) {
			$page_type = 'date';
		} else {
			$page_type = false;
		}

		/* Return page type */
		return $page_type;

	} // webpoint_get_page_type();

}


if ( ! function_exists( 'webpoint_get_post_terms' ) ) {

	/**
	 * Get post terms html.
	 *
	 * @param array $args
	 * @return string|false
	 */
	function webpoint_get_post_terms( $args = array() ) {

		/* Check args data type */
		if ( ! is_array( $args ) ) {
			return false;
		}

		/* Set defaults */
		$defaults = array(
			'post_id'   => null,
			'taxonomy'  => 'category',
			'separator' => ' <span class="sep"> | </span> ',
			'microdata' => false,
			'term_name' => false,
			'req_name'  => false
		);

		/* Merge args */
		$args = wp_parse_args( $args, $defaults );

		/* Remove not expected elements from args */
		$args = array_intersect_key( $args, $defaults );

		/* Get global post ID */
		if ( is_null( $args['post_id'] ) && webpoint_get_post_id() ) {
			$args['post_id'] = webpoint_get_post_id();
		}

		/* Sanitize post ID */
		$args['post_id'] = webpoint_sanitize_var( $args['post_id'], 'absint' );
		if ( ! $args['post_id'] ) {
			return false;
		}

		/* Sanitize separator */
		if ( ! is_string( $args['separator'] ) ) {
			return false;
		}

		/* Sanitize microdata */
		$args['microdata'] = (bool) $args['microdata'];

		/* Sanitize alt term name */
		$args['term_name'] = webpoint_sanitize_var( $args['term_name'], 'term' );

		/* Sanitize required term name status */
		$args['req_name'] = (bool) $args['req_name'];

		/* Convert string to array */
		if ( is_string( $args['taxonomy'] ) ) {
			$args['taxonomy'] = (array) $args['taxonomy'];
		}

		/* Check taxonomy data type */
		if ( ! is_array( $args['taxonomy'] ) || empty( $args['taxonomy'] ) ) {
			return false;
		}

		/* Init output */
		$output = array();

		/* Get post terms */
		foreach( $args['taxonomy'] as $key => $taxonomy ) {

			/* Sanitize taxonomy */
			$taxonomy = webpoint_sanitize_var( $taxonomy, 'term' );
			if ( ! $taxonomy ) {
				continue;
			}

			/* Check taxonomy exists */
			if ( ! taxonomy_exists( $taxonomy ) ) {
				continue;
			}

			/* Get post terms */
			$terms = get_the_terms( $args['post_id'], $taxonomy );

			/* Check post terms */
			if ( empty( $terms ) || ! is_array( $terms ) || is_wp_error( $terms ) ) {
				continue;
			}

			/* Check microdata status */
			if ( $args['microdata'] === true ) {

				/* Retrieve post terms HTML with microdata */
				foreach( $terms as $term ) {

					/* Get custom term name */
					$term_name = $args['term_name']
						? get_term_meta( $term->term_id, $args['term_name'], true )
						: $term->name;

					/* Check term name and required term name status */
					if ( ! $term_name && $args['req_name'] ) {
						continue;
					}

					/* Retrieve term HTML */
					$output[] = sprintf(
						'<a rel="category tag" href="%1$s"><span itemprop="articleSection">%2$s</span></a>',
						esc_attr( get_term_link( $term, $term->taxonomy ) ),
						$term_name ? $term_name : $term->name
					);

				}

			} else {

				/* Retrieve post terms HTML without microdata */
				foreach( $terms as $term ) {

					/* Get custom term name */
					$term_name = $args['term_name']
						? get_term_meta( $term->term_id, $args['term_name'], true )
						: $term->name;

					/* Check term name and required term name status */
					if ( ! $term_name && $args['req_name'] ) {
						continue;
					}

					/* Retrieve term HTML */
					$output[] = sprintf(
						'<a href="%1$s">%2$s</a>',
						esc_attr( get_term_link( $term, $term->taxonomy ) ),
						$term_name ? $term_name : $term->name
					);

				}

			}

		}

		/* Return post terms HTML */
		return ! empty( $output ) ? implode( $args['separator'], $output ) : false;

	} // webpoint_get_post_terms();

}


if ( ! function_exists( 'webpoint_post_terms' ) ) {

	/**
	 * Display post terms.
	 *
	 * @param array $args
	 */
	function webpoint_post_terms( $args = array() ) {

		/* Get post terms */
		$output = webpoint_get_post_terms( $args );

		/* Check post terms */
		if ( ! $output ) {
			return;
		}

		/* Display post terms */
		echo $output;

	} // webpoint_post_terms();

}


if ( ! function_exists( 'webpoint_get_posts_pagination' ) ) {

	/**
	 * Get the posts pagination.
	 *
	 * @return string|false
	 */
	function webpoint_get_posts_pagination() {

		/* Set pagination args */
		$args = array(
			'mid_size' => 2,
			'end_size' => 1,
			'prev_text' => '&laquo; ' . _x( 'Prev', 'pagination', 'webpoint' ),
			'next_text' => _x( 'Next', 'pagination', 'webpoint' ) . ' &raquo;',
			'screen_reader_text' => _x( 'Pagination', 'posts', 'webpoint' ),
			'echo' => false
		);

		/* Get posts pagination HTML */
		$pagination = get_the_posts_pagination( $args );

		/* Return posts pagination */
		return ! empty( $pagination ) ? $pagination : false;

	} // webpoint_get_posts_pagination();

}


if ( ! function_exists( 'webpoint_posts_pagination' ) ) {

	/**
	 * Display the posts pagination.
	 *
	 * @param string $before
	 * @param string $after
	 */
	function webpoint_posts_pagination( $before = '', $after = '' ) {

		/* Get posts pagination HTML */
		$pagination = webpoint_get_posts_pagination();

		/* Display posts pagination */
		echo ! empty( $pagination ) ? $before . $pagination . $after : '';

	} // webpoint_posts_pagination();

}


if ( ! function_exists( 'webpoint_get_post_excerpt' ) ) {

	/**
	 * Get post excerpt.
	 *
	 * @param int|WP_Post|null $post
	 * @param int $limit
     * @param string $more
	 * @param bool $format
	 * @return string|false
	 */
	function webpoint_get_post_excerpt( $post = null, $limit = null, $more = null, $format = false ) {

		/* Get post object */
		$post = webpoint_get_post_object( $post );
		if ( ! $post ) {
			return false;
		}

		/* Init post excerpt */
		$post_excerpt = null;

		/* Apply pre filter */
		$post_excerpt = apply_filters( 'webpoint_pre_get_post_excerpt', $post_excerpt, $post );

		/* Check post excerpt */
		if ( is_string( $post_excerpt ) ) {
		    return $post_excerpt;
        }

		/* Get post excerpt */
		$post_excerpt = isset( $post->post_excerpt ) ? $post->post_excerpt : false;
		if ( ! $post_excerpt ) {
			return false;
		}

		/* Trim post excerpt */
		if ( $limit = webpoint_sanitize_var( $limit, 'absint', 0 ) ) {

		    /* Sanitize more text */
		    $more = webpoint_sanitize_var( $more, 'string', null );

		    /* Trim words */
			$post_excerpt = wp_trim_words( $post_excerpt, $limit, $more );

		}

		/* Add formatting to post excerpt */
		if ( (bool) $format ) {
			$post_excerpt = wpautop( $post_excerpt );
		}

		/* Apply filters */
		$post_excerpt = apply_filters( 'webpoint_post_excerpt', $post_excerpt, $post );

		/* Return post excerpt */
		return $post_excerpt;

	} // webpoint_get_post_excerpt();

}


if ( ! function_exists( 'webpoint_post_excerpt' ) ) {

	/**
	 * Display post excerpt.
     *
     * @param mixed $post
	 * @param int|null $limit
     * @param string $more
     * @param bool $format
	 */
	function webpoint_post_excerpt( $post = null, $limit = null, $more = null, $format = false ) {

		/* Get post excerpt */
		$excerpt = webpoint_get_post_excerpt( $post, $limit, $more, $format );

		/* Display post excerpt */
		echo $excerpt ? $excerpt : '<p></p>';

	} // webpoint_post_excerpt();

}


if ( ! function_exists( 'webpoint_get_post_description' ) ) {

	/**
	 * Get post description based on post excerpt and content
	 *
	 * @param int|WP_Post|null $post
	 * @param integer $limit
     * @param string $more
	 * @param bool $format
	 * @return string|false
	 */

	function webpoint_get_post_description( $post = null, $limit = null, $more = null, $format = false ) {

		/* Get post description based on post excerpt */
		$post_description = webpoint_get_post_excerpt( $post, $limit, $more, $format );

		/* Get post description based on post content */
		if ( ! $post_description ) {

			/* Get post object */
			$post = webpoint_get_post_object( $post );
			if ( ! $post ) {
				return false;
			}

			/* Get post content */
			$post_description = isset( $post->post_content ) ? $post->post_content : false;
			if ( ! $post_description ) {
				return false;
			}

			/* Trim post content */
			if ( $limit = webpoint_sanitize_var( $limit, 'absint', 0 ) ) {
				$post_description = wp_trim_words( $post_description, $limit );
			}

			/* Add formatting to post description */
			if ( (bool) $format ) {
				$post_description = wpautop( $post_description );
			}

		}

		/* Filter post description */
		$post_description = apply_filters( 'webpoint_post_description', $post_description );

		/* Return post description */
		return $post_description ? $post_description : false;

	} // webpoint_get_post_description();

}


if ( ! function_exists( 'webpoint_body_schema' ) ) {

	/**
	 * Display the body schema HTML.
	 */
	function webpoint_body_schema() {

		/* Set item types array */
		$itemtypes = array(
			'http://schema.org/WebPage',
			'http://schema.org/AboutPage',
			'http://schema.org/CheckoutPage',
			'http://schema.org/CollectionPage',
			'http://schema.org/ImageGallery',
			'http://schema.org/VideoGallery',
			'http://schema.org/ContactPage',
			'http://schema.org/ItemPage',
			'http://schema.org/ProfilePage',
			'http://schema.org/QAPage',
			'http://schema.org/SearchResultsPage'
		);

		/* Check current page */
		if ( is_singular( 'product' ) ) {
			$itemtype = 'http://schema.org/ItemPage';
		} elseif ( is_search() ) {
			$itemtype = 'http://schema.org/SearchResultsPage';
		} else {
			$itemtype = 'http://schema.org/WebPage';
		}

		/* Filter itemtype */
		$itemtype = apply_filters( 'webpoint_body_schema_itemtype', $itemtype );

		/* Sanitize item type */
		$itemtype = esc_url( $itemtype );

		/* Check item type */
		if ( ! in_array( $itemtype, $itemtypes ) ) {
			$itemtype = 'http://schema.org/WebPage';
		}

		/* Display body schema */
		echo 'itemscope itemtype="' . $itemtype . '"';

	} // webpoint_body_schema();

}
