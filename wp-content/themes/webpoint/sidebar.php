<?php if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}

/**
 * Sidebar Template.
 */

?>


<?php
	/**
	 * Hook: webpoint_sidebar.
	 *
	 * @hooked webpoint_sidebar_wrap - 10
	 * @hooked webpoint_sidebar_widgets - 20
	 * @hooked webpoint_sidebar_wrap_end - 30
	 */
	do_action( 'webpoint_sidebar' );
?>