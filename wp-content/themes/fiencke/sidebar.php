<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Florence IT
 */
?>
<?php if ( is_active_sidebar( 'sidebar-2' )  ) : ?>
	<div id="sidebar">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- .sidebar .widget-area -->
<?php endif; ?>