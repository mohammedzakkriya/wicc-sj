<?php /* Comment Form */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_comment_form_defaults' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'comment_form_defaults', 'webpoint_comment_form_defaults' );

	/**
	 * Filter the comment form arguments.
	 *
	 * @param array $args
	 * @return array
	 */
	function webpoint_comment_form_defaults( $args = array() ) {

		/* Set the comment form heading */
		$args['title_reply'] = __( 'Leave a comment', 'webpoint' );

		/* Set the comment form heading wrapper */
		$args['title_reply_before'] = '<h2 id="reply-title" class="comment-reply-title">';
		$args['title_reply_after']  = '</h2>';

		/* Reset cancel reply wrapper */
		$args['cancel_reply_before'] = '';
		$args['cancel_reply_after'] = '';

		/* Get current user */
		$user = wp_get_current_user();

		/* Get user ID */
		$user_id = ( isset( $user->ID ) ? (int) $user->ID : 0 );

		/* Get format */
		$format = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

		/* Get HTML5 status */
		$html5 = 'html5' === $format;

		/* Check if the email is required */
		$req = get_option( 'require_name_email' );

		/* Set required attribute HTML */
		$html_req = ( $req ? " required='required'" : '' );

		/* Set readonly attribute HTML */
		$html_readonly = ( $user_id ? " readonly='readonly'" : '' );

		/* Init author name and email */
		$comment_author = '';
		$comment_author_email = '';
		$comment_author_url = '';

		/* Set comment author name and email */
		if ( $user_id ) {

			/* Set author name */
			if ( isset( $user->display_name ) ) {
				$comment_author = $user->display_name;
			}

			/* Set author email */
			if ( isset( $user->user_email ) ) {
				$comment_author_email = $user->user_email;
			}

            /* Set author URL */
            if ( isset( $user->user_url ) ) {
                $comment_author_url = $user->user_url;
            }

		} else {

			/* Get current commenter */
			$commenter = wp_get_current_commenter();

			/* Set author name */
			if ( isset( $commenter['comment_author'] ) ) {
				$comment_author = $commenter['comment_author'];
			}

			/* Set author email */
			if ( isset( $commenter['comment_author_email'] ) ) {
				$comment_author_email = $commenter['comment_author_email'];
			}

            /* Set comment author URL */
            if ( isset( $commenter['comment_author_url'] ) ) {
                $comment_author_url = $commenter['comment_author_url'];
            }

		}

		/* Set comment max length */
		$comment_max_length = (int) apply_filters( 'webpoint_comment_length', 65525 );

		/* Set comment author */
		$args['fields']['author'] = '<div class="form-items-wrap clearfix"><div class="form-item comment-form-author">' . '<label for="author">' . __( 'Name', 'webpoint' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr( $comment_author ) . '" size="32" maxlength="245"' . $html_req . ' /></div><!-- .comment-form-author -->';

		/* Set comment author email */
		$args['fields']['email'] = '<div class="form-item comment-form-email"><label for="email">' . __( 'Email', 'webpoint' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $comment_author_email ) . '" size="32" maxlength="100" aria-describedby="email-notes"' . $html_req . $html_readonly . ' /></div><!-- .comment-form-email --></div><!-- .form-items-wrap -->';

        /* Set comment author url */
        $args['fields']['url'] = '<div class="form-item comment-form-url"><label for="url">' . __( 'Website', 'webpoint' ) . '</label> ' . '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_url( $comment_author_url ) . '" size="32" maxlength="200"' . $html_req . ' /></div><!-- .comment-form-url -->';

		/* Set comment field */
		$args['comment_field'] = '<div class="form-item comment-form-comment"><label for="comment">' . __( 'Comment', 'webpoint' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="' . esc_attr( $comment_max_length ) . '" required="required"></textarea></div><!-- .comment-form-comment -->';

		/* Set comment note */
		$args['comment_notes_after'] = sprintf(
			'<div class="form-item form-info"><span class="req">*</span> - %s</div><!-- .comment-form-info -->',
			__( 'Required fields', 'webpoint' )
		);

		/* Set submit field */
		$args['submit_field'] = '<div class="form-item comment-form-submit">%1$s %2$s</div><!-- .comment-form-submit -->';

		/* Set submit button class */
		$args['class_submit'] = 'button';

		/* Set submit button text */
		$args['label_submit'] = __( 'Submit', 'webpoint' );

		/* Must log in notice */
		$args['must_log_in'] = '<p class="notice must-log-in">' . sprintf( __( 'Please %1$slogin%2$s to post a comment.', 'webpoint' ), '<a href="' . esc_url( wp_login_url( esc_url ( webpoint_get_current_url() ) ) ) . '">', '</a>' ) . '</p>';

		/* Logged in user notice */
		$args['logged_in_as'] = sprintf(
			'<p class="success logged-in-as">%1$s <a href="%2$s">%3$s</a>.</p>',
			__( 'You are logged in as', 'webpoint' ),
			esc_url( get_edit_user_link() ),
			$comment_author
		);

		/* Reset comment note before */
		$args['comment_notes_before'] = '';

		/* Return args */
		return $args;

	} // webpoint_comment_form_defaults();

}


if ( ! function_exists( 'webpoint_filter_comment_form_fields' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'comment_form_fields', 'webpoint_filter_comment_form_fields' );

	/**
	 * Filter the comment form fields.
	 *
	 * @param array $fields
	 * @return array
	 */
	function webpoint_filter_comment_form_fields( $fields = array() ) {

        /* Check user logged in */
        if ( is_user_logged_in() ) {
            return $fields;
        }

		/* Init comment fields */
		$comment_fields['comment'] = '';

        /* Set author name */
        if ( isset( $fields['author'] ) ) {
            $comment_fields['comment'] .= $fields['author'];
        }

        /* Set author email */
        if ( isset( $fields['email'] ) ) {
            $comment_fields['comment'] .= $fields['email'];
        }

        /* Set author URL */
        if ( isset( $fields['url'] ) ) {
            $comment_fields['comment'] .= $fields['url'];
        }

		/* Set author comment */
		if ( isset( $fields['comment'] ) ) {
			$comment_fields['comment'] .= $fields['comment'];
		}

        /* Set cookies field */
        if ( isset( $fields['cookies'] ) ) {
            $comment_fields['comment'] .= sprintf(
                '<div class="form-item comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" %1$s/><label for="wp-comment-cookies-consent">%2$s</label></div><!-- .comment-form-comment -->',
                isset( $fields['email'] ) && ! empty( $fields['email'] ) ? ' checked="checked"' : '',
                __( 'Save my data in this browser for the next time I comment.', 'webpoint' )
            );
        }

		/* Return args */
		return $comment_fields;

	} // webpoint_filter_comment_form_fields();

}


if ( ! function_exists( 'webpoint_filter_cancel_comment_reply_link' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'cancel_comment_reply_link', 'webpoint_filter_cancel_comment_reply_link' );

	/**
	 * Filter the cancel comment reply link.
	 *
	 * @return string
	 */
	function webpoint_filter_cancel_comment_reply_link() {

		return '';

	} // webpoint_filter_cancel_comment_reply_link();

}


if ( ! function_exists( 'webpoint_comment_form_comments_closed' ) ) {

	/* Hook the function to an action. */
	add_action( 'comment_form_comments_closed', 'webpoint_comment_form_comments_closed' );

	/**
	 * Output the comment form open tag.
	 */
	function webpoint_comment_form_comments_closed() {

		/* Check comments exist */
		if ( ! have_comments() ) {
			return;
		}

		/* Display notice */
		printf(
			'<p class="notice comments-closed">%s</p>',
			__( 'Comments are closed.', 'webpoint' )
		);

	} // webpoint_comment_form_comments_closed();

}
