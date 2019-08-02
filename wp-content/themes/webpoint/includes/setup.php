<?php /* Theme setup functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}


if ( ! function_exists( 'webpoint_theme_setup' ) ) {

	/* Hook the function to an action. */
	add_action( 'after_setup_theme', 'webpoint_theme_setup' );

	/**
	 * Init WebPoint Theme.
	 */
	function webpoint_theme_setup() {

		/* Check WordPress version */
		webpoint_check_wp_version();

		/* Load translations */
		load_theme_textdomain( 'webpoint', get_template_directory() . '/languages' );

		/* Set nav menus */
		$nav_menus = array(
			'top_menu'    => __( 'Top Menu', 'webpoint' ),
			'user_menu'   => __( 'User Menu', 'webpoint' ),
			'main_menu'   => __( 'Main Menu', 'webpoint' ),
			'footer_menu' => __( 'Footer Menu', 'webpoint' )
		);

		/* Register nav menus */
		register_nav_menus( apply_filters( 'webpoint_nav_menus', $nav_menus ) );

		/* Add title tag support */
		add_theme_support( 'title-tag' );

		/* Add HTML5 support  */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'widgets'
		) );

		/* Add post thumbnail support */
		add_theme_support( 'post-thumbnails' );

		/* Default Media Resolutions:
		 * 1280x800 - large
		 * 640x400 - medium
		 * 240x150 true - thumbnail
		 * */

		/* thumb-name, width, height, crop true */
		// add_image_size( 'image_small', 128, 128, true );

		/* Add post format support */
		/* add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		) ); */

		/* Automatic Feed Links */
		add_theme_support( 'automatic-feed-links' );

		/* Add theme support for Custom Logo */
		add_theme_support( 'custom-logo', array(
			'width'       => 240,
			'height'      => 80,
			'flex-width'  => true,
		) );

	} // webpoint_theme_setup();

}


if ( ! function_exists( 'webpoint_check_wp_version' ) ) {

	/**
	 * Prevent switching to WebPoint on old versions of WordPress.
	 */
	function webpoint_check_wp_version() {

		/* WebPoint works in WordPress 4.7 or later. */
		if ( version_compare( $GLOBALS['wp_version'], '4.7', '>=' ) ) {
			return;
		}

		/* Switch to default theme */
		switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

		/* Unset GET variable */
		unset( $_GET['activated'] );

		/* Print admin notice */
		add_action( 'admin_notices', 'webpoint_wp_version_notice' );

	} // webpoint_check_wp_version();

}


if ( ! function_exists( 'webpoint_wp_version_notice' ) ) {

	/**
	 * Add message for unsuccessful theme switch.
	 */
	function webpoint_wp_version_notice() {

		/* Set notice */
		$message = sprintf( __( 'WebPoint Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'webpoint' ), $GLOBALS['wp_version'] );

		/* Print notice */
		printf( '<div class="error"><p>%s</p></div>', $message );

	} // webpoint_wp_version_notice();

}


if ( ! function_exists( 'webpoint_widgets_init' ) ) {

	/* Hook the function to an action. */
	add_action( 'widgets_init', 'webpoint_widgets_init' );

	/**
	 * Init Theme Widgets.
	 */
	function webpoint_widgets_init() {

		/* Header Widget */
		register_sidebar( array(
			'name' => _x( 'Header', 'sidebar', 'webpoint' ),
			'id' => 'header',
			'description' => __( 'Add widgets here to appear in your header.', 'webpoint' ),
			'class' => '',
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div><!-- .widget -->',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2><!-- .widget-title -->',
		) );

		/* Sidebar Widgets */
		register_sidebar( array(
			'name' => _x( 'Sidebar', 'sidebar', 'webpoint' ),
			'id' => 'sidebar',
			'description' => __( 'Add widgets here to appear in your sidebar.', 'webpoint' ),
			'class' => '',
			'before_widget' => '<section class="widget">',
			'after_widget' => '</section><!-- .widget -->',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2><!-- .widget-title -->',
		) );

		/* Footer Widgets */
		register_sidebar( array(
			'name' => _x( 'Footer', 'sidebar', 'webpoint' ),
			'id' => 'footer',
			'description' => __( 'Add widgets here to appear in your footer.', 'webpoint' ),
			'class' => '',
			'before_widget' => '<div class="widget-wrap"><div class="widget">',
			'after_widget' => '</div><!-- .widget --></div><!-- .widget-wrap -->',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div><!-- .widget-title -->',
		) );

	} // webpoint_widgets_init();

}


if ( ! function_exists( 'webpoint_scripts' ) ) {

	/* Hook the function to an action. */
	add_action( 'wp_enqueue_scripts', 'webpoint_scripts', 5, 1 );

	/**
	 * Register and enqueue theme scripts.
	 */
	function webpoint_scripts() {

		/**
		 * Register the CSS stylesheet.
		 *
		 * Name: roboto-fonts-css
		 * Path: '/assets/fonts/roboto/roboto-fonts.min.css'
		 * Depends: none
		 * Version: null
		 * Media: all
		 */
		wp_register_style(
			'roboto-fonts-css',
			get_parent_theme_file_uri( 'assets/fonts/roboto/roboto-fonts.min.css' ),
			array(),
			null,
			'all'
		);

		/* Enqueue the Theme CSS stylesheet */
		wp_enqueue_style( 'roboto-fonts-css' );

		/**
		 * Register the Font Awesome CSS stylesheet.
		 *
		 * Name: font-awesome-css
		 * Path: '/assets/fonts/font-awesome/css/font-awesome.min.css'
		 * Depends: none
		 * Version: null
		 * Media: all
		 */
		wp_register_style(
			'font-awesome-css',
			get_parent_theme_file_uri( 'assets/fonts/font-awesome/css/font-awesome.min.css' ),
			array(),
			null,
			'all'
		);

		/* Enqueue the Font Awesome CSS stylesheet */
		wp_enqueue_style( 'font-awesome-css' );

		/**
		 * Register the Theme CSS stylesheet.
		 *
		 * Name: webpoint-css
		 * Path: '/style.min.css'
		 * Depends: none
		 * Version: null
		 * Media: all
		 */
		wp_register_style(
			'webpoint-css',
			get_parent_theme_file_uri( 'style.min.css' ),
			array(),
			null,
			'all'
		);

		/* Enqueue the Theme CSS stylesheet */
		wp_enqueue_style( 'webpoint-css' );

		/**
		 * Register the Theme Responsive CSS stylesheet.
		 *
		 * Name: webpoint-responsive-css
		 * Path: '/assets/css/responsive.min.css'
		 * Depends: webpoint-css
		 * Version: null
		 * Media: all
		 */
		wp_register_style(
			'webpoint-responsive-css',
			get_parent_theme_file_uri( 'assets/css/responsive.min.css' ),
			array( 'webpoint-css' ),
			null,
			'all'
		);

		/* Enqueue the Theme Responsive CSS stylesheet */
		wp_enqueue_style( 'webpoint-responsive-css' );

		/**
		 * Register the Theme Script.
		 *
		 * Name: webpoint-js
		 * Path: '/assets/js/webpoint.min.js'
		 * Depends: jquery
		 * Version: null
		 * In footer: true
		 */
		wp_register_script(
			'webpoint-js',
			get_parent_theme_file_uri( 'assets/js/webpoint.min.js' ),
			array( 'jquery' ),
			null,
			true
		);

		/* Enqueue the Theme Script */
		wp_enqueue_script( 'webpoint-js' );

		/* Add extra CSS styles to a registered stylesheet */
		wp_add_inline_style(
			'webpoint-css',
			apply_filters( 'webpoint_inline_style', '' )
		);

		/* Localize Script */
		wp_localize_script(
			'webpoint-js',
			'webpoint',
			apply_filters( 'webpoint_javascript_globals', array() )
		);

		/* Localize js i18n */
		wp_localize_script(
			'webpoint-js',
			'webpoint_i18n',
			apply_filters( 'webpoint_javascript_i18n', array() )
		);

	} // webpoint_scripts();

}


if ( ! function_exists( 'webpoint_set_inline_style' ) ) {

	/* Hook the function to an action. */
	// add_filter( 'webpoint_inline_style', 'webpoint_set_inline_style' );

	/**
	 * Set the custom inline styles.
	 *
	 * @param string $css
	 * @return string
	 */
	function webpoint_set_inline_style( $css = '' ) {

		/* Set custom site width */
		$sw = 75;

		/* Add custom css */
		$css .= "
			.sw {
                max-width: {$sw}rem;
            }
        ";

		/* Return custom css */
		return $css;

	} // webpoint_set_inline_style();

}


if ( ! function_exists( 'webpoint_set_javascript_globals' ) ) {

	/* Hook the function to an action. */
	add_filter( 'webpoint_javascript_globals', 'webpoint_set_javascript_globals' );

	/**
	 * Set JavaScript Globals.
	 *
	 * @param array $args
	 * @return array
	 */
	function webpoint_set_javascript_globals( $args = array() ) {

		/* Set ajax url */
		$args['ajax_url'] = admin_url( 'admin-ajax.php' );

		/* Set template directory uri */
		$args['template_directory_uri'] = get_template_directory_uri();

		/* Set comment depth */
		$args['thread_comments_depth'] = (int) get_option( 'thread_comments_depth' );

		/* Set current page type */
		if ( $page_type = webpoint_get_page_type() ) {
			$args['page_type'] = $page_type;
			if ( $page_type == 'term' && $taxonomy = webpoint_get_term_taxonomy() ) {
                $args['taxonomy'] = $taxonomy;
			}
		}

		/* Set global post object */
		if ( is_singular() && $post = webpoint_get_post_object() ) {
			$args['post_id'] = webpoint_get_post_id( $post );
			$args['post_type'] = get_post_type( $post );
		}

		/* Add mobile menu title */
		$args['mobile_menu_title'] = __( 'Main menu', 'webpoint' );

		/* Add mobile sidebar menus status */
		$args['mobile_sidebar_menus'] = webpoint_get_theme_mod( 'mobile_sidebar_menus', 'absint', 0 );

		/* Add fixed widget status */
		$args['fixed_widget'] = webpoint_get_theme_mod( 'fixed_widget', 'absint', 0 );

		/* Return args */
		return $args;

	} // webpoint_set_javascript_globals();

}


if ( ! function_exists( 'webpoint_set_javascript_i18n' ) ) {

	/* Hook the function to an action. */
	add_filter( 'webpoint_javascript_i18n', 'webpoint_set_javascript_i18n' );

	/**
	 * Set JavaScript Translations.
	 *
	 * @param array $args
	 * @return array
	 */
	function webpoint_set_javascript_i18n( $args = array() ) {

		/* Set Translations */
		$i18n = array(
			'more' => __( 'more', 'webpoint' ),
			'Show images' => __( 'Show images', 'webpoint' ),
			'Hide images' => __( 'Hide images', 'webpoint' ),
			'Hide' => __( 'Hide', 'webpoint' ),
			'Sort by' => __( 'Sort by', 'webpoint' ),
			'out of' => _x( 'out of', 'number', 'webpoint' ),
			'Cancel reply' => __( 'Cancel reply', 'webpoint' ),
			'Read more' => __( 'Read more', 'webpoint' )
		);

		/* Merge arrays */
		$args = wp_parse_args( $i18n, $args );

		/* Return translation */
		return $args;

	} // webpoint_set_javascript_i18n();

}


if ( ! function_exists( 'webpoint_filter_taxonomy_args' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'register_taxonomy_args', 'webpoint_filter_taxonomy_args', 99, 2 );

	/**
	 * Filter taxonomy args.
	 *
	 * @param array $args
	 * @param string $taxonomy
	 * @return array
	 */
	function webpoint_filter_taxonomy_args( $args, $taxonomy ) {

		/* Update taxonomy args */
		if ( ( $taxonomy === 'category' || $taxonomy === 'post_tag' ) && is_array( $args ) ) {
			$args['rewrite']['with_front'] = false;
		}

		/* Return args */
		return $args;

	} // webpoint_filter_taxonomy_args();

}


if ( ! function_exists( 'webpoint_add_page_support_excerpt' ) ) {

	/* Hook the function to an action. */
	add_action( 'init', 'webpoint_add_page_support_excerpt' );

	/**
	 * Excerpt support for pages.
	 */
	function webpoint_add_page_support_excerpt() {

		add_post_type_support( 'page', 'excerpt' );

	} // webpoint_add_page_support_excerpt();

}


if ( ! function_exists( 'webpoint_template_globals_init' ) ) {

	/* Hook the function to an action. */
	add_action( 'wp', 'webpoint_template_globals_init' );

	/**
	 * Init template global variable.
	 */
	function webpoint_template_globals_init() {

		global $webpoint;

		/* Set current page sidebar position */
		$webpoint['sidebar_position'] = webpoint_get_sidebar_position();

		/* Use this hook to change globals. */
		do_action( 'webpoint_globals_init' );

	} // webpoint_template_globals_init();

}


if ( ! function_exists( 'webpoint_get_template_globals' ) ) {

	/**
	 * Get template global variable.
	 *
	 * @param string $key
	 * @return mixed|false
	 */
	function webpoint_get_template_globals( $key = null ) {

		global $webpoint;

		/* Check key */
		if ( is_null( $key ) ) {
			return $webpoint;
		}

		/* Sanitize key */
		$key = webpoint_sanitize_var( $key, 'term' );
		if ( $key === false ) {
			return false;
		}

		/* Return global var */
		return isset( $webpoint[ $key ] ) ? $webpoint[ $key ] : false;

	} // webpoint_get_template_globals();

}


if ( ! function_exists( 'webpoint_set_template_globals' ) ) {

	/**
	 * Set template global variables.
	 *
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	function webpoint_set_template_globals( $name = null, $value = null ) {

		global $webpoint;

		/* Check data type */
		if ( ! is_array( $webpoint ) ) {
			$webpoint = array();
		}

		/* Set variable */
		if ( $name && $value ) {
			$webpoint[ $name ] = $value;
		}

	} // webpoint_set_template_globals();

}


if ( ! function_exists( 'webpoint_body_class_filter' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'body_class' , 'webpoint_body_class_filter' );

	/**
	 * Modify body classes.
	 *
	 * @param array $classes
	 * @return array
	 */
	function webpoint_body_class_filter( $classes ) {

		/* Get sidebar position */
		$sidebar_position = webpoint_get_template_globals( 'sidebar_position' );

		/* Sanitize sidebar position */
		$sidebar_position = webpoint_sanitize_var( $sidebar_position, 'slug', 'none' );

		/* Add sidebar position to body classes */
		$classes[] = 'sidebar-' . $sidebar_position;

		/* Return body classes */
		return $classes;

	} // webpoint_body_class_filter();

}
