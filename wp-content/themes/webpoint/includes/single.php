<?php /* Single Functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


/**
 * Single Template
 *
 * Hook: webpoint_content_single
 *
 * @see webpoint_content_single_wrap - 10
 * @see webpoint_entry_wrap - 20
 * @see webpoint_entry_header_wrap - 30
 * @see webpoint_entry_title - 40
 * @see webpoint_entry_header_meta - 50
 * @see webpoint_post_meta_data - 55
 * @see webpoint_entry_header_wrap_end - 60
 * @see webpoint_entry_content_wrap - 70
 * @see webpoint_entry_excerpt - 80
 * @see webpoint_entry_image - 90
 * @see webpoint_entry_text - 100
 * @see webpoint_entry_edit_link - 110
 * @see webpoint_entry_content_wrap_end - 120
 * @see webpoint_entry_footer_wrap - 130
 * @see webpoint_entry_footer_meta - 140
 * @see webpoint_entry_footer_wrap_end - 150
 * @see webpoint_entry_wrap_end - 160
 * @see webpoint_template_comments - 170
 * @see webpoint_content_single_wrap_end - 180
 */

/**
 * Page Template
 *
 * Hook: webpoint_content_page
 *
 * @see webpoint_content_page_wrap - 10
 * @see webpoint_entry_wrap - 20
 * @see webpoint_entry_header_wrap - 30
 * @see webpoint_entry_title - 40
 * @see webpoint_post_meta_data - 55
 * @see webpoint_entry_header_wrap_end - 60
 * @see webpoint_entry_content_wrap - 70
 * @see webpoint_entry_text - 100
 * @see webpoint_entry_edit_link - 110
 * @see webpoint_entry_content_wrap_end - 120
 * @see webpoint_entry_wrap_end - 160
 * @see webpoint_template_comments - 170
 * @see webpoint_content_single_wrap_end - 180
*/

 /**
 * Image Template
 *
 * Hook: webpoint_content_image
 *
 * @see webpoint_content_single_wrap - 10
 * @see webpoint_entry_wrap - 20
 * @see webpoint_entry_header_wrap - 30
 * @see webpoint_entry_title - 40
 * @see webpoint_entry_header_meta - 50
 * @see webpoint_post_meta_data - 55
 * @see webpoint_entry_header_wrap_end - 60
 * @see webpoint_entry_content_wrap - 70
 * @see webpoint_entry_excerpt - 80
 * @see webpoint_entry_image - 90
 * @see webpoint_entry_text - 100
 * @see webpoint_entry_edit_link - 110
 * @see webpoint_entry_content_wrap_end - 120
 * @see webpoint_entry_wrap_end - 160
 * @see webpoint_template_comments - 170
 * @see webpoint_content_single_wrap_end - 180
 */

if ( ! function_exists( 'webpoint_content_single_wrap' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_content_single_wrap', 10 );
	add_action( 'webpoint_content_image',  'webpoint_content_single_wrap', 10 );

	/**
	 * Outputs opening tags for the single template content.
	 */
	function webpoint_content_single_wrap() { ?>

	    <article itemscope itemtype="http://schema.org/Article" <?php post_class( 'hentry' ); ?>>

    <?php } // webpoint_content_single_wrap();

}


if ( ! function_exists( 'webpoint_content_page_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_page', 'webpoint_content_page_wrap', 10 );

	/**
	 * Outputs opening tags for the single page content.
	 */
	function webpoint_content_page_wrap() { ?>

	    <article <?php post_class( 'hentry' ); ?>>

    <?php } // webpoint_content_page_wrap();

}


if ( ! function_exists( 'webpoint_entry_wrap' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_wrap', 20 );
	add_action( 'webpoint_content_page',   'webpoint_entry_wrap', 20 );
	add_action( 'webpoint_content_image',  'webpoint_entry_wrap', 20 );

	/**
	 * Outputs opening divs for the entry content.
	 */
	function webpoint_entry_wrap() { ?>

        <div class="wrap article">

	<?php } // webpoint_entry_wrap();

}


if ( ! function_exists( 'webpoint_entry_header_wrap' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_header_wrap', 30 );
	add_action( 'webpoint_content_page',   'webpoint_entry_header_wrap', 30 );
	add_action( 'webpoint_content_image',  'webpoint_entry_header_wrap', 30 );

	/**
	 * Outputs opening divs for the entry header.
	 */
	function webpoint_entry_header_wrap() { ?>

        <header class="entry-header">

	<?php } // webpoint_entry_header_wrap();

}


if ( ! function_exists( 'webpoint_entry_title' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_title', 40 );
	add_action( 'webpoint_content_page',   'webpoint_entry_title', 40 );
	add_action( 'webpoint_content_image',  'webpoint_entry_title', 40 );

	/**
	 * Output the entry title.
	 */
	function webpoint_entry_title() { ?>

		<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>

	<?php } // webpoint_entry_title();

}


if ( ! function_exists( 'webpoint_entry_header_meta' ) ) {

    /* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_header_meta', 50 );
	add_action( 'webpoint_content_image',  'webpoint_entry_header_meta', 50 );

	/**
	 * Output the post date and the comments link.
	 */
	function webpoint_entry_header_meta() { ?>

		<div class="entry-meta clearfix">

		    <?php webpoint_entry_date(); ?>

		   	<?php webpoint_entry_comments(); ?>

        </div><!-- .entry-meta -->

	<?php } // webpoint_entry_header_meta();

}


if ( ! function_exists( 'webpoint_post_meta_data' ) ) {

    /* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_post_meta_data', 55 );
	add_action( 'webpoint_content_page',   'webpoint_post_meta_data', 55 );
	add_action( 'webpoint_content_image',  'webpoint_post_meta_data', 55 );


	/**
	 * Output the post meta data.
	 */
	function webpoint_post_meta_data() { ?>

		<meta itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
		<meta itemprop="dateModified" content="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
		<meta itemprop="mainEntityOfPage url" content="<?php echo esc_attr( get_the_permalink() ); ?>">
		<meta itemprop="author" content="<?php echo esc_attr( get_the_author() ); ?>">

	<?php } // webpoint_post_meta_data();

}


if ( ! function_exists( 'webpoint_entry_header_wrap_end' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_header_wrap_end', 60 );
	add_action( 'webpoint_content_page',   'webpoint_entry_header_wrap_end', 60 );
	add_action( 'webpoint_content_image',  'webpoint_entry_header_wrap_end', 60 );

	/**
	 * Outputs closing divs for the entry content.
	 */
	function webpoint_entry_header_wrap_end() { ?>

        </header><!-- .entry-header -->

	<?php } // webpoint_entry_header_wrap_end();

}


if ( ! function_exists( 'webpoint_entry_content_wrap' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_content_wrap', 70 );
	add_action( 'webpoint_content_image',  'webpoint_entry_content_wrap', 70 );

	/**
	 * Outputs opening tags for the entry content.
	 */
	function webpoint_entry_content_wrap() { ?>

	    <div class="entry-content" itemprop="articleBody">

	<?php } // webpoint_entry_content_wrap();

}


if ( ! function_exists( 'webpoint_page_entry_content_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_page', 'webpoint_page_entry_content_wrap', 70 );

	/**
	 * Outputs opening tags for the page template entry content.
	 */
	function webpoint_page_entry_content_wrap() { ?>

	    <div class="entry-content">

	<?php } // webpoint_page_entry_content_wrap();

}


if ( ! function_exists( 'webpoint_entry_excerpt' ) ) {

    /* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_excerpt', 80 );
	add_action( 'webpoint_content_image',  'webpoint_entry_excerpt', 80 );

	/**
	 * Display the post excerpt.
	 */
	function webpoint_entry_excerpt() {

	    /* Get post excerpt */
	    $excerpt = webpoint_get_post_excerpt( null, null, null, true ); ?>

		<?php if ( $excerpt ) : ?>

			<div class="entry-excerpt">

				<?php the_excerpt(); ?>

			</div><!-- .entry-excerpt -->

		<?php endif; ?>

	<?php } // webpoint_entry_excerpt();

}


if ( ! function_exists( 'webpoint_entry_image' ) ) {

    /* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_image', 90 );
	add_action( 'webpoint_content_image',  'webpoint_entry_image', 90 );

	/**
	 * Display the entry image.
	 */
	function webpoint_entry_image() {

		/* Check password required and pag type */
		if ( post_password_required() || ! is_singular() ) {
			return;
		}

		/* Get thumbnail ID */
		$thumb_id = is_attachment() ? webpoint_get_post_id() : get_post_thumbnail_id();
		if ( ! $thumb_id ) {
		    return;
		}

		/* Get image data */
		$image_data = webpoint_get_image_data( $thumb_id, 'full' );
		if ( ! $image_data ) {
			return;
		}

		/* Check if it's a placeholder image */
		if ( $image_data['alt'] == __( 'No image available', 'webpoint' ) ) {
		    return;
        }

        /* Set entry image size through the filter */
        $size = apply_filters( 'webpoint_entry_image_size', 'large' );

		/* Get thumbnail image */
		$output = wp_get_attachment_image( $thumb_id, $size, false, array(
				'class'    => 'entry-thumb',
				'itemprop' => 'thumbnailUrl',
				'data-title'   => $image_data['title'],
				'data-caption' => $image_data['caption']
			)
		);

		/* Check thumbnail image */
		if ( empty ( $output ) ) {
			return;
		}

		/* Add link to thumbnail image */
		$output = sprintf(
            '<a class="post-image" href="%1$s">%2$s</a>',
			$image_data['url'],
			$output
        );

		/* Add schema markup */
		$output .= '<meta itemprop="name" content="' . $image_data['title'] . '">';
		$output .= '<meta itemprop="caption" content="' . $image_data['caption'] . '">';
		$output .= '<meta itemprop="url contentUrl" content="' . $image_data['url'] . '">';
		$output .= '<meta itemprop="width" content="' . $image_data['width'] . '">';
		$output .= '<meta itemprop="height" content="' . $image_data['height'] . '">';

		/* Display single post thumbnail */;
		printf( '<div class="entry-image" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">%s</div><!-- .entry-image -->', $output );

	} // webpoint_entry_image();

}


if ( ! function_exists( 'webpoint_entry_text' ) ) {

    /* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_text', 100 );
	add_action( 'webpoint_content_page',   'webpoint_entry_text', 100 );
	add_action( 'webpoint_content_image',  'webpoint_entry_text', 100 );

	/**
	 * Display the entry text.
	 */
	function webpoint_entry_text() {

		/* Get post object */
		$post = webpoint_get_post_object();
		if ( ! $post ) {
		    return;
        } ?>

		<?php if ( ! empty( $post->post_content ) ) : ?>

			<div class="entry-text clearfix">

				<?php the_content(); ?>

				<?php wp_link_pages( array(
                    'before'      => sprintf(
                        '<div class="page-links"><div class="title">%s</div>',
                        __( 'Pages:', 'webpoint' )
                    ),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ) ); ?>

			</div><!-- .entry-text -->

		<?php endif; ?>

	<?php } // webpoint_entry_text();

}


if ( ! function_exists( 'webpoint_entry_edit_link' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_edit_link', 110 );
	add_action( 'webpoint_content_page',   'webpoint_entry_edit_link', 110 );
	add_action( 'webpoint_content_image',  'webpoint_entry_edit_link', 110 );

	/**
	 * Output the post edit link.
	 */
	function webpoint_entry_edit_link() { ?>

		<?php edit_post_link( __( 'Edit', 'webpoint' ), '<p class="edit-link">', '</p>' ); ?>

	<?php } // webpoint_entry_edit_link();

}


if ( ! function_exists( 'webpoint_entry_content_wrap_end' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_content_wrap_end', 120 );
	add_action( 'webpoint_content_page',   'webpoint_entry_content_wrap_end', 120 );
	add_action( 'webpoint_content_image',  'webpoint_entry_content_wrap_end', 120 );

	/**
	 * Outputs closing tags for the entry content.
	 */
	function webpoint_entry_content_wrap_end() { ?>

        </div><!-- .entry-content -->

	<?php } // webpoint_entry_content_wrap_end();

}


if ( ! function_exists( 'webpoint_entry_footer_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_single', 'webpoint_entry_footer_wrap', 130 );

	/**
	 * Outputs opening tags for the entry footer.
	 */
	function webpoint_entry_footer_wrap() { ?>

        <footer class="entry-footer">

    <?php } // webpoint_entry_footer_wrap();

}


if ( ! function_exists( 'webpoint_entry_footer_meta' ) ) {

    /* Hook the function to an action. */
	add_action( 'webpoint_content_single', 'webpoint_entry_footer_meta', 140 );

	/**
	 * Output post categories.
	 */
	function webpoint_entry_footer_meta() { ?>

		<div class="entry-meta clearfix">

			<?php webpoint_entry_categories(); ?>

        </div><!-- .entry-meta -->

	<?php } // webpoint_entry_footer_meta();

}


if ( ! function_exists( 'webpoint_entry_footer_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_content_single', 'webpoint_entry_footer_wrap_end', 150 );

	/**
	 * Outputs closing tags for the entry footer.
	 */
	function webpoint_entry_footer_wrap_end() { ?>

        </footer><!-- .entry-footer -->

	<?php } // webpoint_entry_footer_wrap_end();

}


if ( ! function_exists( 'webpoint_entry_wrap_end' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_entry_wrap_end', 160 );
	add_action( 'webpoint_content_page',   'webpoint_entry_wrap_end', 160 );
	add_action( 'webpoint_content_image',  'webpoint_entry_wrap_end', 160 );

	/**
	 * Outputs closing divs for the entry content.
	 */
	function webpoint_entry_wrap_end() { ?>

        </div><!-- .wrap -->

	<?php } // webpoint_entry_wrap_end();

}


if ( ! function_exists( 'webpoint_template_comments' ) ) {

    /* Hook the function to actions. */
    add_action( 'webpoint_content_single', 'webpoint_template_comments', 170 );
    add_action( 'webpoint_content_page',   'webpoint_template_comments', 170 );
    add_action( 'webpoint_content_image',  'webpoint_template_comments', 170 );

    /**
     * Load the comments template.
     */
    function webpoint_template_comments() { ?>

        <?php comments_template(); ?>

    <?php } // webpoint_template_comments();

}


if ( ! function_exists( 'webpoint_content_single_wrap_end' ) ) {

	/* Hook the function to actions. */
	add_action( 'webpoint_content_single', 'webpoint_content_single_wrap_end', 180 );
	add_action( 'webpoint_content_page',   'webpoint_content_single_wrap_end', 180 );
	add_action( 'webpoint_content_image',  'webpoint_content_single_wrap_end', 180 );

	/**
	 * Outputs closing tags for the single template content.
	 */
	function webpoint_content_single_wrap_end() { ?>

        </article><!-- .hentry -->

	<?php } // webpoint_content_single_wrap_end();

}


if ( ! function_exists( 'webpoint_entry_date' ) ) {

	/**
	 * Display post date.
	 */
	function webpoint_entry_date() { ?>

		<div class="entry-date">

			<i class="fa fa-calendar" aria-hidden="true"></i>

			<time itemprop="dateCreated datePublished" class="published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_date(); ?></time>

		</div><!-- .entry-date -->

	<?php } // webpoint_entry_date();

}


if ( ! function_exists( 'webpoint_entry_comments' ) ) {

	/**
	 * Display post comments link.
	 */
	function webpoint_entry_comments() { ?>

		<div class="entry-comments">

			<i class="fa fa-comment-o" aria-hidden="true"></i>

			<?php comments_popup_link( _x( 'No Comments', 'comments link', 'webpoint' ) ); ?>

		</div><!-- .entry-comments -->

	<?php } // webpoint_entry_comments();

}


if ( ! function_exists( 'webpoint_entry_categories' ) ) {

	/**
	 * Display post categories.
	 *
	 * @param array $args
	 */
	function webpoint_entry_categories( $args = array( 'microdata' => true, 'term_name' => '_term_name_short' ) ) { ?>

        <div class="entry-categories">

            <i class="fa fa-folder-open-o" aria-hidden="true"></i>

            <span class="label"><?php _e( 'Category', 'webpoint' ); ?>: </span>

			<?php webpoint_post_terms( $args ); ?>

        </div><!-- .entry-categories -->

	<?php } // webpoint_entry_categories();

}
