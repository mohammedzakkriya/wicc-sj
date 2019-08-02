<?php if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}

/**
 * Comments Template.
 */

?>

<?php if ( post_password_required() ) {
    return;
} ?>

<?php if ( have_comments() || comments_open() ) : ?>

    <?php
        /**
         * Hook: webpoint_comments.
         *
         * @hooked webpoint_comments_wrap - 10
         * @hooked webpoint_comments_list - 20
         * @hooked webpoint_comment_form - 30
         * @hooked webpoint_comments_wrap_end - 40
         */
        do_action( 'webpoint_comments' );
    ?>

<?php endif; ?>
