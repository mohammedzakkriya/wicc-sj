<?php /* Footer Functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_footer_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_footer', 'webpoint_footer_wrap', 10 );

	/**
	 * Outputs opening tags for the footer.
	 */
    function webpoint_footer_wrap() { ?>

        <footer id="footer" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">

    <?php } // webpoint_footer_wrap();

}


if ( ! function_exists( 'webpoint_footer_widgets' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_footer', 'webpoint_footer_widgets', 20 );

	/**
	 * Output footer widgets.
	 */
	function webpoint_footer_widgets() {

		/* Check footer widgets exists */
		if ( ! is_active_sidebar( 'footer' ) ) {
			return;
		} ?>

        <div class="widgets clearfix">

            <div class="sw">

                <div class="inner clearfix">

                    <?php dynamic_sidebar( 'footer' ); ?>

                </div><!-- .inner -->

            </div><!-- .sw -->

        </div><!-- .widgets -->

	<?php } // webpoint_footer_widgets();

}


if ( ! function_exists( 'webpoint_footer_menu' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_footer', 'webpoint_footer_menu', 30 );

	/**
	 * Output the footer menu.
	 */
	function webpoint_footer_menu() {

		/* Check footer menu exists */
		if ( ! has_nav_menu( 'footer_menu' ) ) {
			return;
		} ?>

        <div class="fbar">

            <div class="sw">

                <div class="inner clearfix">

                    <div id="footer-menu">

                        <?php wp_nav_menu( array(
							'theme_location' => 'footer_menu',
							'menu' => '',
							'container' => '',
							'container_class' => '',
							'container_id' => '',
							'menu_class' => 'menu clearfix',
							'menu_id' => 'footermenu',
							'echo' => true,
							'before' => '',
							'after' => '',
							'link_before' => '',
							'link_after' => '',
							'depth' => 1
						) ); ?>

                    </div><!-- #footer-menu -->

                </div><!-- .inner -->

            </div><!-- .sw -->

        </div><!-- .fbar -->

	<?php } // webpoint_footer_menu();

}


if ( ! function_exists( 'webpoint_footer_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_footer', 'webpoint_footer_wrap_end', 40 );

	/**
	 * Outputs closing tags for the footer.
	 */
	function webpoint_footer_wrap_end() { ?>

        </footer><!-- #footer -->

	<?php } // webpoint_footer_wrap_end();

}
