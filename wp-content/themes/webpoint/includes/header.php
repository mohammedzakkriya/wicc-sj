<?php /* Header Functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_unset_header_top_row' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_unset_header_top_row', 5 );

	/**
	 * Remove header top row.
	 */
	function webpoint_unset_header_top_row() {

		/* Check required menus */
		if ( has_nav_menu( 'top_menu' ) || has_nav_menu( 'user_menu' ) ) {
            return;
		}

		/* Remove header top row */
		remove_action( 'webpoint_header', 'webpoint_header_top_row_wrap', 20 );
		remove_action( 'webpoint_header', 'webpoint_header_top_row_left_col_wrap', 30 );
		remove_action( 'webpoint_header', 'webpoint_top_menu', 40 );
		remove_action( 'webpoint_header', 'webpoint_header_top_row_left_col_wrap_end', 50 );
		remove_action( 'webpoint_header', 'webpoint_header_top_row_right_col_wrap', 60 );
		remove_action( 'webpoint_header', 'webpoint_user_menu', 70 );
		remove_action( 'webpoint_header', 'webpoint_header_top_row_right_col_wrap_end', 80 );
		remove_action( 'webpoint_header', 'webpoint_header_top_row_wrap_end', 90 );

	} // webpoint_unset_header_top_row();

}


if ( ! function_exists( 'webpoint_unset_header_bottom_row' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_unset_header_bottom_row', 5 );

	/**
	 * Remove header bottom row.
	 */
	function webpoint_unset_header_bottom_row() {

		/* Check required menu exists */
		if ( has_nav_menu( 'main_menu' ) ) {
			return;
		}

		/* Remove header bottom row */
		remove_action( 'webpoint_header', 'webpoint_header_bottom_row_wrap', 210 );
		remove_action( 'webpoint_header', 'webpoint_header_bottom_row_center_col_wrap', 220 );
		remove_action( 'webpoint_header', 'webpoint_header_main_menu', 230 );
		remove_action( 'webpoint_header', 'webpoint_header_bottom_row_center_col_wrap_end', 240 );
		remove_action( 'webpoint_header', 'webpoint_header_bottom_row_wrap_end', 250 );

	} // webpoint_unset_header_bottom_row();

}


if ( ! function_exists( 'webpoint_noscript_notice' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_noscript_notice', 5 );

	/**
	 * Display noscript notice.
	 */
	function webpoint_noscript_notice() { ?>

        <noscript><div class="noscript"><?php _e( 'You must enable javascript to view this page properly.', 'webpoint' ); ?></div></noscript>

	<?php } // webpoint_noscript_notice():

}


if ( ! function_exists( 'webpoint_header_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_wrap', 10 );

	/**
	 * Outputs opening tags for the header.
	 */
    function webpoint_header_wrap() { ?>

        <header id="header" class="site-header" itemscope itemtype="http://schema.org/WPHeader">

    <?php } // webpoint_header_wrap();

}


if ( ! function_exists( 'webpoint_header_top_row_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_top_row_wrap', 20 );

	/**
	 * Outputs opening tags for the header top row.
	 */
    function webpoint_header_top_row_wrap() { ?>

        <div class="top-row">

            <div class="sw">

                <div class="inner clearfix">

    <?php } // webpoint_header_top_row_wrap();

}


if ( ! function_exists( 'webpoint_header_top_row_left_col_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_top_row_left_col_wrap', 30 );

	/**
	 * Outputs opening tags for the header top row left col.
	 */
    function webpoint_header_top_row_left_col_wrap() { ?>

        <div class="left-col">

    <?php } // webpoint_header_top_row_left_col_wrap();

}


if ( ! function_exists( 'webpoint_header_top_row_left_col_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_top_row_left_col_wrap_end', 50 );

	/**
	 * Outputs closing tags for the header top row left col.
	 */
    function webpoint_header_top_row_left_col_wrap_end() { ?>

        </div><!-- .left-col -->

    <?php } // webpoint_header_top_row_left_col_wrap_end();

}


if ( ! function_exists( 'webpoint_header_top_row_right_col_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_top_row_right_col_wrap', 60 );

	/**
	 * Outputs opening tags for the header top row right col.
	 */
    function webpoint_header_top_row_right_col_wrap() { ?>

        <div class="right-col">

    <?php } // webpoint_header_top_row_right_col_wrap();

}


if ( ! function_exists( 'webpoint_header_top_row_right_col_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_top_row_right_col_wrap_end', 80 );

	/**
	 * Outputs closing tags for the header top row right col.
	 */
    function webpoint_header_top_row_right_col_wrap_end() { ?>

        </div><!-- .right-col -->

    <?php } // webpoint_header_top_row_right_col_wrap_end();

}


if ( ! function_exists( 'webpoint_header_top_row_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_top_row_wrap_end', 90 );

	/**
	 * Outputs closing tags for the header top row.
	 */
	function webpoint_header_top_row_wrap_end() { ?>

                </div><!-- .inner -->

            </div><!-- .sw -->

        </div><!-- .top-row -->

	<?php } // webpoint_header_top_row_wrap_end();

}


if ( ! function_exists( 'webpoint_header_middle_row_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_middle_row_wrap', 100 );

	/**
	 * Outputs opening tags for the header middle row.
	 */
    function webpoint_header_middle_row_wrap() { ?>

        <div class="middle-row">

            <div class="sw">

                <div class="inner clearfix">

    <?php } // webpoint_header_middle_row_wrap();

}


if ( ! function_exists( 'webpoint_header_middle_row_left_col_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_middle_row_left_col_wrap', 110 );

	/**
	 * Outputs opening tags for the header middle row left col.
	 */
    function webpoint_header_middle_row_left_col_wrap() { ?>

        <div class="left-col">

    <?php } // webpoint_header_middle_row_left_col_wrap();

}


if ( ! function_exists( 'webpoint_logo' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_logo', 120 );

	/**
	 * Display the Header Logo.
	 */
	function webpoint_logo() {

		/* Init logo classes */
		$classes[] = 'logo';

		/* Init logo HTML */
        $logo_html = '';

		/* Check custom logo */
		if ( has_custom_logo() ) {

			/* Set logo css classes */
			$classes[] = 'custom-logo';

			/* Get logo HTML */
            $logo_html .= get_custom_logo();

		} else {

            /* Get site name */
            if ( $site_name = webpoint_get_theme_mod( 'logo_name', 'string', '' ) ) {
                $logo_html .= sprintf(
                    '<span class="site-name clearfix">%s</span>',
                    $site_name
                );
            }

			/* Get site description */
            if ( $site_desc = webpoint_get_theme_mod( 'logo_desc', 'string', '' ) ) {
                $logo_html .= sprintf(
                    '<span class="site-desc">%s</span>',
                    $site_desc
                );
            }

			/* Wrap logo content */
			if ( ! empty( $logo_html ) ) {
                $logo_html = sprintf(
                    '<a class="home" href="%1$s" rel="home">%2$s</a>',
                    esc_url( home_url( '/' ) ),
                    $logo_html
                );
            }

		} ?>

        <div id="logo" class="<?php echo implode( ' ', $classes ); ?>">

            <div class="logo-inner">

				<?php echo $logo_html; ?>

            </div><!-- .logo-inner -->

        </div><!-- .logo -->

	<?php } // webpoint_logo();

}


if ( ! function_exists( 'webpoint_header_middle_row_left_col_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_middle_row_left_col_wrap_end', 130 );

	/**
	 * Outputs closing tags for the header middle row left col.
	 */
    function webpoint_header_middle_row_left_col_wrap_end() { ?>

        </div><!-- .left-col -->

    <?php } // webpoint_header_middle_row_left_col_wrap_end();

}


if ( ! function_exists( 'webpoint_header_middle_row_center_col_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_middle_row_center_col_wrap', 140 );

	/**
	 * Outputs opening tags for the header middle row center col.
	 */
    function webpoint_header_middle_row_center_col_wrap() { ?>

        <div class="center-col">

    <?php } // webpoint_header_middle_row_center_col_wrap();

}


if ( ! function_exists( 'webpoint_main_search' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_main_search', 150 );

	/**
	 * Display the Main Search.
	 */
	function webpoint_main_search() { ?>

        <div id="main-search" class="main-search">

			<?php get_search_form(); ?>

        </div><!-- .main-search -->

	<?php } // webpoint_main_search();

}


if ( ! function_exists( 'webpoint_header_middle_row_center_col_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_middle_row_center_col_wrap_end', 160 );

	/**
	 * Outputs closing tags for the header middle row center col.
	 */
    function webpoint_header_middle_row_center_col_wrap_end() { ?>

        </div><!-- .center-col -->

    <?php } // webpoint_header_middle_row_center_col_wrap_end();

}


if ( ! function_exists( 'webpoint_header_middle_row_right_col_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_middle_row_right_col_wrap', 170 );

	/**
	 * Outputs opening tags for the header middle row right col.
	 */
    function webpoint_header_middle_row_right_col_wrap() { ?>

        <div class="right-col">

    <?php } // webpoint_header_middle_row_right_col_wrap();

}


if ( ! function_exists( 'webpoint_header_widget' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_widget', 180 );

	/**
	 * Display Header Widgets.
	 */
	function webpoint_header_widget() {

		/* Check registered sidebar */
		if ( ! is_active_sidebar( 'header' ) ) {
			return;
		}

		/* Execute header widgets */
		dynamic_sidebar( 'header' );

	} // webpoint_header_widget();

}


if ( ! function_exists( 'webpoint_header_middle_row_right_col_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_middle_row_right_col_wrap_end', 190 );

	/**
	 * Outputs closing tags for the header middle row right col.
	 */
    function webpoint_header_middle_row_right_col_wrap_end() { ?>

        </div><!-- .right-col -->

    <?php } // webpoint_header_middle_row_right_col_wrap_end();

}


if ( ! function_exists( 'webpoint_header_middle_row_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_middle_row_wrap_end', 200 );

	/**
	 * Outputs closing tags for the header middle row.
	 */
    function webpoint_header_middle_row_wrap_end() { ?>

                </div><!-- .inner -->

            </div><!-- .sw -->

        </div><!-- .middle-row -->

    <?php } // webpoint_header_middle_row_wrap_end();

}


if ( ! function_exists( 'webpoint_header_bottom_row_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_bottom_row_wrap', 210 );

	/**
	 * Outputs opening tags for the header bottom row.
	 */
    function webpoint_header_bottom_row_wrap() { ?>

        <div class="bottom-row">

            <div class="sw">

                <div class="inner clearfix">

    <?php } // webpoint_header_bottom_row_wrap();

}


if ( ! function_exists( 'webpoint_header_bottom_row_center_col_wrap' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_bottom_row_center_col_wrap', 220 );

	/**
	 * Outputs opening tags for the header bottom row center col.
	 */
    function webpoint_header_bottom_row_center_col_wrap() { ?>

        <div class="center-col">

    <?php } // webpoint_header_bottom_row_center_col_wrap();

}


if ( ! function_exists( 'webpoint_header_bottom_row_center_col_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_bottom_row_center_col_wrap_end', 240 );

	/**
	 * Outputs closing tags for the header bottom row center col.
	 */
    function webpoint_header_bottom_row_center_col_wrap_end() { ?>

        </div><!-- .center-col -->

    <?php } // webpoint_header_bottom_row_center_col_wrap_end();

}


if ( ! function_exists( 'webpoint_header_bottom_row_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_bottom_row_wrap_end', 250 );

	/**
	 * Outputs closing tags for the header bottom row.
	 */
    function webpoint_header_bottom_row_wrap_end() { ?>

                </div><!-- .inner -->

            </div><!-- .sw -->

        </div><!-- .bottom-row -->

    <?php } // webpoint_header_bottom_row_wrap_end();

}


if ( ! function_exists( 'webpoint_header_wrap_end' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_header_wrap_end', 260 );

	/**
	 * Outputs closing tags for the header.
	 */
	function webpoint_header_wrap_end() { ?>

        </header><!-- #header -->

	<?php } // webpoint_header_wrap_end();

}
