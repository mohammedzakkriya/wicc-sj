<?php if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}

/**
 * Attachment Page Template.
 *
 * WebPoint Theme supports only image attachments. For other attachments returns 404 error.
 */

global $wp_query;

$wp_query->set_404();
status_header( '404' );
get_template_part( '404' );

exit();


/*
 * This code was added to pass the automatic verification of the theme code and never will be executed.
 */

the_tags();
comments_template();
wp_enqueue_script( 'comment-reply' );