<?php if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}

/**
 * Tag Template.
 */

get_header(); ?>

<?php
    /**
     * Hook: webpoint_template.
     *
     * @hooked webpoint_template_header - 10
     * @hooked webpoint_template_content - 20
     * @hooked webpoint_template_footer - 30
     */
    do_action( 'webpoint_template', 'tag' );
?>

<?php get_footer(); ?>