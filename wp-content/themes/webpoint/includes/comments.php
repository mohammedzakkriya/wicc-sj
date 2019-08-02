<?php /* Comments Functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_comments_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comments', 'webpoint_comments_wrap', 10 );

	/**
	 * Outputs opening tags for the comments section.
	 */
	function webpoint_comments_wrap() { ?>

        <section id="comments" class="wrap">

	<?php } // webpoint_comments_wrap();

}


if ( ! function_exists( 'webpoint_comments_list' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comments', 'webpoint_comments_list', 20 );

	/**
	 * Output the comments list.
	 */
	function webpoint_comments_list() { ?>

		<?php if ( have_comments() ) : ?>

			<?php
                /**
                 * Hook: webpoint_comments_loop.
                 *
                 * @hooked webpoint_comments_loop_title - 10
                 * @hooked webpoint_comments_loop_list_wrap - 20
                 * @hooked webpoint_comments_loop_list_items - 30
                 * @hooked webpoint_comments_pagination - 40
                 * @hooked webpoint_comments_loop_list_wrap_end - 50
                 */
                do_action( 'webpoint_comments_loop' );
			?>

		<?php endif; ?>

	<?php } // webpoint_comments_list();

}


if ( ! function_exists( 'webpoint_comment_form' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comments', 'webpoint_comment_form', 30 );

	/**
	 * Output the comment form.
	 */
	function webpoint_comment_form() { ?>

		<?php comment_form(); ?>

	<?php } // webpoint_comment_form();

}


if ( ! function_exists( 'webpoint_comments_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comments', 'webpoint_comments_wrap_end', 40 );

	/**
	 * Outputs closing tags for the comments section.
	 */
	function webpoint_comments_wrap_end() { ?>

		</section><!-- #comments -->

	<?php } // webpoint_comments_wrap_end();

}


if ( ! function_exists( 'webpoint_comments_loop_title' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comments_loop', 'webpoint_comments_loop_title', 10 );

	/**
	 * Output the comment list title.
	 */
	function webpoint_comments_loop_title() { ?>

		<?php printf(
			'<h2 class="comments-title">%1$s <span class="sup">%2$s</span></h2>',
			__( 'Comments', 'webpoint' ),
			get_comments_number()
		); ?>

	<?php } // webpoint_comments_loop_title();

}


if ( ! function_exists( 'webpoint_comments_loop_list_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comments_loop', 'webpoint_comments_loop_list_wrap', 20 );

	/**
	 * Outputs opening tags for the comments list.
	 */
	function webpoint_comments_loop_list_wrap() { ?>

        <ol id="comment-list" class="comment-list">

	<?php } // webpoint_comments_loop_list_wrap();

}


if ( ! function_exists( 'webpoint_comments_loop_list_items' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comments_loop', 'webpoint_comments_loop_list_items', 30 );

	/**
	 * Output the comment list items.
	 */
	function webpoint_comments_loop_list_items() { ?>

		<?php wp_list_comments( array(
			'type' => 'comment',
			'callback' => 'webpoint_list_comments'
		) ); ?>

	<?php } // webpoint_comments_loop_list_items();

}


if ( ! function_exists( 'webpoint_comments_pagination' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comments_loop', 'webpoint_comments_pagination', 40 );

	/**
	 * Display the comments pagination.
	 */
	function webpoint_comments_pagination() {

		/* Set args */
		$args = array(
			'mid_size' => (int) apply_filters( 'webpoint_comments_pagination_mid_size', 2 ),
			'end_size' => (int) apply_filters( 'webpoint_comments_pagination_end_size', 2 ),
			'prev_text' => '&laquo; ' . _x( 'Prev', 'pagination', 'webpoint' ),
			'next_text' => _x( 'Next', 'pagination', 'webpoint' ) . ' &raquo;',
			'echo' => false
		);

		/* Get comments pagination HTML */
		$pagination = paginate_comments_links( $args );

		/* Display comments pagination */
		echo ! empty( $pagination ) ? '<div class="pagination">' . $pagination . '</div>' : '';

	} // webpoint_comments_pagination();

}


if ( ! function_exists( 'webpoint_comments_loop_list_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comments_loop', 'webpoint_comments_loop_list_wrap_end', 50 );

	/**
	 * Outputs closing tags for the comments list.
	 */
	function webpoint_comments_loop_list_wrap_end() { ?>

        </ol><!-- #comment-list -->

	<?php } // webpoint_comments_loop_list_wrap_end();

}


if ( ! function_exists( 'webpoint_list_comments' ) ) {

	/**
	 * WP list comments callback function.
     *
     * @param object $comment
     */
	function webpoint_list_comments( $comment ) {

		/**
		 * Hook: webpoint_comment.
		 *
		 * @hooked webpoint_comment_wrap - 10
		 * @hooked webpoint_comment_left_col_wrap - 20
		 * @hooked webpoint_comment_avatar - 30
		 * @hooked webpoint_comment_left_col_wrap_end - 40
		 * @hooked webpoint_comment_right_col_wrap - 50
		 * @hooked webpoint_comment_header_wrap - 60
		 * @hooked webpoint_comment_author - 70
		 * @hooked webpoint_comment_date - 80
		 * @hooked webpoint_comment_header_wrap_end - 90
		 * @hooked webpoint_comment_text_wrap - 100
		 * @hooked webpoint_comment_text - 110
		 * @hooked webpoint_comment_approved_notice - 115
		 * @hooked webpoint_comment_text_wrap_end - 120
		 * @hooked webpoint_comment_footer_wrap - 130
		 * @hooked webpoint_comment_edit_link - 140
		 * @hooked webpoint_comment_reply_link - 150
		 * @hooked webpoint_comment_footer_wrap_end - 160
		 * @hooked webpoint_comment_right_col_wrap_end - 170
		 * @hooked webpoint_comment_wrap_end - 180
		 */
		do_action( 'webpoint_comment', $comment );

	} // webpoint_list_comments();

}


if ( ! function_exists( 'webpoint_comment_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_wrap', 10 );

	/**
	 * Outputs opening tags for the comment.
     *
     * @param WP_Comment $comment
	 */
	function webpoint_comment_wrap( $comment ) {

		/* Set approved status */
		$approved = isset( $comment->comment_approved ) && '1' == $comment->comment_approved;

		/* Set comment class */
		$class = ! $approved ? 'not-approved' : ''; ?>

        <li id="li-comment-<?php comment_ID(); ?>" <?php comment_class( $class ); ?> itemprop="comment" itemscope itemtype="http://schema.org/Comment">

        <div id="comment-<?php comment_ID(); ?>" class="separate-comment clearfix" data-comment-id="<?php comment_ID(); ?>">

	<?php } // webpoint_comment_wrap();

}


if ( ! function_exists( 'webpoint_comment_left_col_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_left_col_wrap', 20 );

	/**
	 * Outputs opening tags for the comment left col.
	 */
	function webpoint_comment_left_col_wrap() { ?>

        <div class="left-col">

	<?php } // webpoint_comment_left_col_wrap();

}


if ( ! function_exists( 'webpoint_comment_avatar' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_avatar', 30 );

	/**
	 * Display the comment author avatar.
     *
     * @param WP_Comment $comment
	 */
	function webpoint_comment_avatar( $comment ) { ?>

        <div class="comment-avatar">

			<?php echo get_avatar( $comment, 48 ); ?>

        </div><!-- .comment-avatar -->

	<?php } // webpoint_comment_avatar();

}


if ( ! function_exists( 'webpoint_comment_left_col_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_left_col_wrap_end', 40 );

	/**
	 * Outputs closing tags for the comment left col.
	 */
    function webpoint_comment_left_col_wrap_end() { ?>

        </div><!-- .left-col -->

    <?php } // webpoint_comment_left_col_wrap_end();

}


if ( ! function_exists( 'webpoint_comment_right_col_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_right_col_wrap', 50 );

	/**
	 * Outputs opening tags for the comment right col.
	 */
	function webpoint_comment_right_col_wrap() { ?>

        <div class="right-col">

	<?php } // webpoint_comment_right_col_wrap();

}


if ( ! function_exists( 'webpoint_comment_header_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_header_wrap', 60 );

	/**
	 * Outputs opening tags for the comment header.
	 */
	function webpoint_comment_header_wrap() { ?>

        <div class="comment-header clearfix">

	<?php } // webpoint_comment_header_wrap();

}


if ( ! function_exists( 'webpoint_comment_author' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_author', 70 );

	/**
	 * Display the comment author.
     *
     * @param WP_Comment $comment
	 */
	function webpoint_comment_author( $comment ) { ?>

        <div class="comment-author">

            <span itemprop="author creator"><?php comment_author_link( $comment ); ?></span>

        </div><!-- .comment-author -->

	<?php } // webpoint_comment_author();

}


if ( ! function_exists( 'webpoint_comment_date' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_date', 80 );

	/**
	 * Display the comment date.
	 */
	function webpoint_comment_date() { ?>

        <div class="comment-date">

            <time itemprop="dateCreated datePublished" datetime="<?php echo esc_attr( get_comment_time( 'c' ) ); ?>"><?php printf(
					_x( '%1$s at %2$s', 'date and time format', 'webpoint' ),
					get_comment_date(),
					get_comment_time()
				); ?></time>

        </div><!-- .comment-date -->

	<?php } // webpoint_comment_date();

}


if ( ! function_exists( 'webpoint_comment_header_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_header_wrap_end', 90 );

	/**
	 * Outputs closing tags for the comment header.
	 */
    function webpoint_comment_header_wrap_end() { ?>

        </div><!-- .comment-header -->

    <?php } // webpoint_comment_header_wrap_end();

}


if ( ! function_exists( 'webpoint_comment_text_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_text_wrap', 100 );

	/**
	 * Outputs opening tags for the comment text.
	 */
	function webpoint_comment_text_wrap() { ?>

        <div class="comment-text" itemprop="text">

	<?php } // webpoint_comment_text_wrap();

}


if ( ! function_exists( 'webpoint_comment_text' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_text', 110 );

	/**
	 * Display the comment text.
     *
     * @param WP_Comment $comment
	 */
	function webpoint_comment_text( $comment ) { ?>

		<?php comment_text( $comment ); ?>

	<?php } // webpoint_comment_text();

}


if ( ! function_exists( 'webpoint_comment_approved_notice' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_approved_notice', 115 );

	/**
	 * Display the comment approved notice.
     *
     * @param WP_Comment $comment
	 */
	function webpoint_comment_approved_notice( $comment ) { ?>

	    <?php if ( isset( $comment->comment_approved ) && '0' == $comment->comment_approved ) : ?>

            <p class="approved"><?php _e( 'Your comment will be published after being moderated.', 'webpoint' ); ?></p>

		<?php endif; ?>

	<?php } // webpoint_comment_approved_notice();

}


if ( ! function_exists( 'webpoint_comment_text_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_text_wrap_end', 120 );

	/**
	 * Outputs closing tags for the comment text.
	 */
    function webpoint_comment_text_wrap_end() { ?>

        </div><!-- .comment-text -->

    <?php } // webpoint_comment_text_wrap_end();

}


if ( ! function_exists( 'webpoint_comment_footer_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_footer_wrap', 130 );

	/**
	 * Outputs opening tags for the comment footer.
	 */
	function webpoint_comment_footer_wrap() { ?>

        <div class="comment-footer clearfix">

	<?php } // webpoint_comment_footer_wrap();

}


if ( ! function_exists( 'webpoint_comment_edit_link' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_edit_link', 140 );

	/**
	 * Display the comment edit link.
	 */
	function webpoint_comment_edit_link() { ?>

		<?php edit_comment_link( __( 'Edit comment', 'webpoint' ) ); ?>

	<?php } // webpoint_comment_edit_link();

}


if ( ! function_exists( 'webpoint_comment_reply_link' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_reply_link', 150 );

	/**
	 * Display the comment reply link.
	 */
	function webpoint_comment_reply_link() {

	    global $comment_depth;

	    $max_depth = get_option( 'thread_comments_depth' );

	    /* Check current comment depth */
	    if ( ! $comment_depth || $comment_depth >= $max_depth ) {
	        return;
        } ?>

        <span class="reply" data-comment-id="<?php echo esc_attr( get_comment_ID() ); ?>"><?php _e( 'Reply', 'webpoint' ); ?></span>

	<?php } // webpoint_comment_reply_link();

}


if ( ! function_exists( 'webpoint_comment_footer_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_footer_wrap_end', 160 );

	/**
	 * Outputs closing tags for the comment footer.
	 */
    function webpoint_comment_footer_wrap_end() { ?>

        </div><!-- .comment-footer -->

    <?php } // webpoint_comment_footer_wrap_end();

}


if ( ! function_exists( 'webpoint_comment_right_col_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_right_col_wrap_end', 170 );

	/**
	 * Outputs closing tags for the comment right col.
	 */
    function webpoint_comment_right_col_wrap_end() { ?>

        </div><!-- .right-col -->

    <?php } // webpoint_comment_right_col_wrap_end();

}


if ( ! function_exists( 'webpoint_comment_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_comment', 'webpoint_comment_wrap_end', 180 );

	/**
	 * Outputs closing tags for the comments section.
	 */
	function webpoint_comment_wrap_end() { ?>

        </div><!-- .separate-comment -->

	<?php } // webpoint_comment_wrap_end();

}


if ( ! function_exists( 'webpoint_human_comments_number' ) ) {

    /* Filter comments number text */
	add_filter( 'comments_number', 'webpoint_human_comments_number', 10, 2 );

	/**
	 * Set human comments number text.
     *
     * @param string $output
     * @param number $number
     * @return string
	 */
	function webpoint_human_comments_number( $output, $number ) {

	    /* Sanitize comment number */
	    $number = (int) $number;
	    if ( ! $number ) {
	        return $output;
        }

        /* Set output text */
		$output = sprintf(
			_n( '%s comment', '%s comments', $number, 'webpoint' ),
			number_format_i18n( $number )
		);

		/* Return output text */
		return $output;

	} // webpoint_human_comments_number();

}


if ( ! function_exists( 'webpoint_delete_user_nicename_from_comment_class' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'comment_class', 'webpoint_delete_user_nicename_from_comment_class' );

	/**
	 * Delete user nicename from comment classes.
     *
     * @param array $classes
     * @return array
	 */
	function webpoint_delete_user_nicename_from_comment_class( $classes ) {

		/* Delete comment author class from classes */
		foreach ( $classes as $key => $class ) {
			if ( strstr( $class, "comment-author-" ) ) {
				unset( $classes[$key] );
			}
		}

		/* Return comment classes */
		return $classes;

	} // webpoint_delete_user_nicename_from_comment_class();

}
