<?php
/**
 * AllinGrid functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 */

if ( ! function_exists( 'allingrid_setup' ) ) :
	/**
	 * AllinGrid setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 *
	 */
	function allingrid_setup() {

		/*
		 * Make theme available for translation.
		 *
		 * Translations can be filed in the /languages/ directory
		 *
		 * If you're building a theme based on AllinGrid, use a find and replace
		 * to change 'allingrid' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'allingrid', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'allingrid-thumbnail-avatar', 100, 100, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
	 	 */
		add_editor_style( array( 'css/editor-style.css', 
								 get_template_directory_uri() . '/css/font-awesome.css',
								 allingrid_fonts_url()
						  ) );

		/*
		 * Set Custom Background
		 */				 
		add_theme_support( 'custom-background', array ('default-color'  => '#ffffff') );

		// Set the default content width.
		$GLOBALS['content_width'] = 900;

		// This theme uses wp_nav_menu() in header menu
		register_nav_menus( array(
			'top'   => __( 'top menu', 'allingrid' ),
			'primary'   => __( 'Primary Menu', 'allingrid' ),
			'footer'    => __( 'Footer Menu', 'allingrid' ),
		) );

		$defaults = array(
	        'flex-height' => false,
	        'flex-width'  => false,
	        'header-text' => array( 'site-title', 'site-description' ),
	    );
	    add_theme_support( 'custom-logo', $defaults );
	}
endif; // allingrid_setup
add_action( 'after_setup_theme', 'allingrid_setup' );

if ( ! function_exists( 'allingrid_fonts_url' ) ) :
	/**
	 *	Load google font url used in the AllinGrid theme
	 */
	function allingrid_fonts_url() {

	    $fonts_url = '';
	 
	    /* Translators: If there are characters in your language that are not
	    * supported by PT Sans, translate this to 'off'. Do not translate
	    * into your own language.
	    */
	    $questrial = _x( 'on', 'PT Sans font: on or off', 'allingrid' );

	    if ( 'off' !== $questrial ) {
	        $font_families = array();
	 
	        $font_families[] = 'PT Sans';
	 
	        $query_args = array(
	            'family' => urlencode( implode( '|', $font_families ) ),
	            'subset' => urlencode( 'latin,latin-ext' ),
	        );
	 
	        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	    }
	 
	    return $fonts_url;
	}
endif; // allingrid_fonts_url

if ( ! function_exists( 'allingrid_load_scripts' ) ) :
	/**
	 * the main function to load scripts in the AllinGrid theme
	 * if you add a new load of script, style, etc. you can use that function
	 * instead of adding a new wp_enqueue_scripts action for it.
	 */
	function allingrid_load_scripts() {

		// load main stylesheet.
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( ) );
		wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/css/animate.css', array( ) );
		wp_enqueue_style( 'allingrid-style', get_stylesheet_uri(), array() );
		
		wp_enqueue_style( 'allingrid-fonts', allingrid_fonts_url(), array(), null );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'viewportchecker',
			get_template_directory_uri() . '/js/viewportchecker.js',
			array( 'jquery' ) );
		
		// Load Utilities JS Script
		wp_enqueue_script( 'allingrid-utilities-js',
			get_template_directory_uri() . '/js/utilities.js',
			array( 'jquery', 'viewportchecker', 'masonry' ) );

		$data = array(
			'loading_effect' => ( get_theme_mod('allingrid_animations_display', 1) == 1 ),
		);
		wp_localize_script('allingrid-utilities-js', 'allingrid_options', $data);
	}
endif; // allingrid_load_scripts
add_action( 'wp_enqueue_scripts', 'allingrid_load_scripts' );

if ( ! function_exists( 'allingrid_widgets_init' ) ) :
	/**
	 *	widgets-init action handler. Used to register widgets and register widget areas
	 */
	function allingrid_widgets_init() {

		/**
		 * Add Homepage Widget areas
		 */
		register_sidebar( array (
								'name'			 =>  __( 'Homepage Widget', 'allingrid' ),
								'id' 			 =>  'homepage-widget-area',
								'description'	 =>  __( 'The Homepage widget area', 'allingrid' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="sidebar-title">',
								'after_title'	 =>  '</h2><div class="sidebar-after-title"></div>',
							) );

		// Register Footer Column #1
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #1', 'allingrid' ),
								'id' 			 =>  'footer-column-1-widget-area',
								'description'	 =>  __( 'The Footer Column #1 widget area', 'allingrid' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
		
		// Register Footer Column #2
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #2', 'allingrid' ),
								'id' 			 =>  'footer-column-2-widget-area',
								'description'	 =>  __( 'The Footer Column #2 widget area', 'allingrid' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
		
		// Register Footer Column #3
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #3', 'allingrid' ),
								'id' 			 =>  'footer-column-3-widget-area',
								'description'	 =>  __( 'The Footer Column #3 widget area', 'allingrid' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
	}
endif; // allingrid_widgets_init
add_action( 'widgets_init', 'allingrid_widgets_init' );

if ( ! function_exists( 'allingrid_custom_header_setup' ) ) :
  /**
   * Set up the WordPress core custom header feature.
   *
   * @uses allingrid_header_style()
   */
  function allingrid_custom_header_setup() {

  	add_theme_support( 'custom-header', array (
                         'default-image'          => '',
                         'flex-height'            => true,
                         'flex-width'             => true,
                         'uploads'                => true,
                         'width'                  => 900,
                         'height'                 => 100,
                         'default-text-color'     => '#222222',
                         'wp-head-callback'       => 'allingrid_header_style',
                      ) );
  }
endif; // allingrid_custom_header_setup
add_action( 'after_setup_theme', 'allingrid_custom_header_setup' );

if ( ! function_exists( 'allingrid_show_header_phone' ) ) :
	/**
	 *	Displays the header phone.
	 */
	function allingrid_show_header_phone() {

		$phone = get_theme_mod('allingrid_header_phone', '');

		if ( !empty( $phone ) ) {

			echo '<span id="header-phone">' . esc_html($phone) . '</span>';
		}
	}
endif; // allingrid_show_header_phone

if ( ! function_exists( 'allingrid_show_header_email' ) ) :
	/**
	 *	Displays the header email.
	 */
	function allingrid_show_header_email() {

		$email = get_theme_mod('allingrid_header_email', '');

		if ( !empty( $email ) ) {

			echo '<span id="header-email"><a href="mailto:' . antispambot($email, 1) . '" title="' . esc_attr($email) . '">'
					. esc_html($email) . '</a></span>';
		}
	}
endif; // allingrid_show_header_email

if ( ! function_exists( 'allingrid_display_social_sites' ) ) :
	function allingrid_display_social_sites() {

		echo '<ul class="header-social-widget">';

		$socialURL = get_theme_mod('allingrid_social_facebook');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Facebook', 'allingrid') . '" class="facebook16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_google');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Google+', 'allingrid') . '" class="google16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_twitter');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Twitter', 'allingrid') . '" class="twitter16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_linkedin');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on LinkedIn', 'allingrid') . '" class="linkedin16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_instagram');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Instagram', 'allingrid') . '" class="instagram16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_rss');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow our RSS Feeds', 'allingrid') . '" class="rss16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_tumblr');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Tumblr', 'allingrid') . '" class="tumblr16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_youtube');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Youtube', 'allingrid') . '" class="youtube16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_pinterest');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Pinterest', 'allingrid') . '" class="pinterest16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_vk');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on VK', 'allingrid') . '" class="vk16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_flickr');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Flickr', 'allingrid') . '" class="flickr16"></a>';
		}

		$socialURL = get_theme_mod('allingrid_social_vine');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Vine', 'allingrid') . '" class="vine16"></a>';
		}

		echo '</ul>';
	}
endif; // allingrid_display_social_sites

if ( ! function_exists( 'allingrid_header_style' ) ) :

  /**
   * Styles the header image and text displayed on the blog.
   *
   * @see allingrid_custom_header_setup().
   */
  function allingrid_header_style() {

  	$header_text_color = get_header_textcolor();

      if ( ! has_header_image()
          && ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color
               || 'blank' === $header_text_color ) ) {

          return;
      }

      $headerImage = get_header_image();
  ?>
      <style id="allingrid-custom-header-styles" type="text/css">

          <?php if ( has_header_image() ) : ?>

                  #header-main-fixed {background-image: url("<?php echo esc_url( $headerImage ); ?>");}

          <?php endif; ?>

          <?php if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color
                      && 'blank' !== $header_text_color ) : ?>

                  #header-main-fixed, #header-main-fixed h1.entry-title {color: #<?php echo sanitize_hex_color_no_hash( $header_text_color ); ?>;}

          <?php endif; ?>
      </style>
  <?php
  }
endif; // End of allingrid_header_style.

if ( class_exists('WP_Customize_Section') ) {
	class allingrid_Customize_Section_Pro extends WP_Customize_Section {

		// The type of customize section being rendered.
		public $type = 'allingrid';

		// Custom button text to output.
		public $pro_text = '';

		// Custom pro button URL.
		public $pro_url = '';

		// Add custom parameters to pass to the JS via JSON.
		public function json() {
			$json = parent::json();

			$json['pro_text'] = $this->pro_text;
			$json['pro_url']  = esc_url( $this->pro_url );

			return $json;
		}

		// Outputs the template
		protected function render_template() { ?>

			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

				<h3 class="accordion-section-title">
					{{ data.title }}

					<# if ( data.pro_text && data.pro_url ) { #>
						<a href="{{ data.pro_url }}" class="button button-primary alignright" target="_blank">{{ data.pro_text }}</a>
					<# } #>
				</h3>
			</li>
		<?php }
	}
}

/**
 * Singleton class for handling the theme's customizer integration.
 */
final class allingrid_Customize {

	// Returns the instance.
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	// Constructor method.
	private function __construct() {}

	// Sets up initial actions.
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	// Sets up the customizer sections.
	public function sections( $manager ) {

		// Load custom sections.

		// Register custom section types.
		$manager->register_section_type( 'allingrid_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new allingrid_Customize_Section_Pro(
				$manager,
				'allingrid',
				array(
					'title'    => esc_html__( 'AllinOneTheme', 'allingrid' ),
					'pro_text' => esc_html__( 'Upgrade to Pro', 'allingrid' ),
					'pro_url'  => esc_url( 'https://allinonethemes.com/product/allinonetheme/' )
				)
			)
		);
	}

	// Loads theme customizer CSS.
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'allingrid-customize-controls', trailingslashit( get_template_directory_uri() ) . 'js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'allingrid-customize-controls', trailingslashit( get_template_directory_uri() ) . 'css/customize-controls.css' );
	}
}

// Doing this customizer thang!
allingrid_Customize::get_instance();

if ( ! function_exists( 'allingrid_sanitize_checkbox' ) ) :
	/**
	 * Checkbox sanitization callback example.
	 * 
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function allingrid_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif; // End of allingrid_sanitize_checkbox

if ( ! function_exists( 'allingrid_show_copyright_text' ) ) :
	/**
	 *	Displays the copyright text.
	 */
	function allingrid_show_copyright_text() {
		
		$footerText = get_theme_mod('allingrid_footer_copyright', null);

		if ( !empty( $footerText ) ) {

			echo esc_html( $footerText ) . ' | ';		
		}
	}
endif; // End of allingrid_show_copyright_text

if ( ! function_exists( 'allingrid_customize_register' ) ) :
	/**
	 * Register theme settings in the customizer
	 */
	function allingrid_customize_register( $wp_customize ) {

		// Add header phone
		$wp_customize->add_setting(
			'allingrid_header_phone',
			array(
			    'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_header_phone',
	        array(
	            'label'          => __( 'Your phone to appear in the website header', 'allingrid' ),
	            'section'        => 'allingrid_header_and_footer_section',
	            'settings'       => 'allingrid_header_phone',
	            'type'           => 'text',
	            )
	        )
		);

		// Add header email
		$wp_customize->add_setting(
			'allingrid_header_email',
			array(
			    'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_header_email',
	        array(
	            'label'          => __( 'Your e-mail to appear in the website header', 'allingrid' ),
	            'section'        => 'allingrid_header_and_footer_section',
	            'settings'       => 'allingrid_header_email',
	            'type'           => 'text',
	            )
	        )
		);

		/**
		 * Add Animations Section
		 */
		$wp_customize->add_section(
			'allingrid_animations_display',
			array(
				'title'       => __( 'Animations', 'allingrid' ),
				'capability'  => 'edit_theme_options',
			)
		);

		// Add display Animations option
		$wp_customize->add_setting(
				'allingrid_animations_display',
				array(
						'default'           => 1,
						'sanitize_callback' => 'allingrid_sanitize_checkbox',
				)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
							'allingrid_animations_display',
								array(
									'label'          => __( 'Enable Animations', 'allingrid' ),
									'section'        => 'allingrid_animations_display',
									'settings'       => 'allingrid_animations_display',
									'type'           => 'checkbox',
								)
							)
		);

		/**
		 * Add Social Sites Section
		 */
		$wp_customize->add_section(
			'allingrid_social_section',
			array(
				'title'       => __( 'Social Sites', 'allingrid' ),
				'capability'  => 'edit_theme_options',
			)
		);
		
		// Add facebook url
		$wp_customize->add_setting(
			'allingrid_social_facebook',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_facebook',
	        array(
	            'label'          => __( 'Facebook Page URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_facebook',
	            'type'           => 'text',
	            )
	        )
		);

		// Add google+ url
		$wp_customize->add_setting(
			'allingrid_social_google',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_google',
	        array(
	            'label'          => __( 'Google+ Page URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_google',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Twitter url
		$wp_customize->add_setting(
			'allingrid_social_twitter',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_twitter',
	        array(
	            'label'          => __( 'Twitter URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_twitter',
	            'type'           => 'text',
	            )
	        )
		);

		// Add LinkedIn url
		$wp_customize->add_setting(
			'allingrid_social_linkedin',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_linkedin',
	        array(
	            'label'          => __( 'LinkedIn URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_linkedin',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Instagram url
		$wp_customize->add_setting(
			'allingrid_social_instagram',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_instagram',
	        array(
	            'label'          => __( 'LinkedIn URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_instagram',
	            'type'           => 'text',
	            )
	        )
		);

		// Add RSS Feeds url
		$wp_customize->add_setting(
			'allingrid_social_rss',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_rss',
	        array(
	            'label'          => __( 'RSS Feeds URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_rss',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Tumblr url
		$wp_customize->add_setting(
			'allingrid_social_tumblr',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_tumblr',
	        array(
	            'label'          => __( 'Tumblr URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_tumblr',
	            'type'           => 'text',
	            )
	        )
		);

		// Add YouTube channel url
		$wp_customize->add_setting(
			'allingrid_social_youtube',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_youtube',
	        array(
	            'label'          => __( 'YouTube channel URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_youtube',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Pinterest url
		$wp_customize->add_setting(
			'allingrid_social_pinterest',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_pinterest',
	        array(
	            'label'          => __( 'Pinterest URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_pinterest',
	            'type'           => 'text',
	            )
	        )
		);

		// Add VK url
		$wp_customize->add_setting(
			'allingrid_social_vk',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_vk',
	        array(
	            'label'          => __( 'VK URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_vk',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Flickr url
		$wp_customize->add_setting(
			'allingrid_social_flickr',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_flickr',
	        array(
	            'label'          => __( 'Flickr URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_flickr',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Vine url
		$wp_customize->add_setting(
			'allingrid_social_vine',
			array(
			    'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_social_vine',
	        array(
	            'label'          => __( 'Vine URL', 'allingrid' ),
	            'section'        => 'allingrid_social_section',
	            'settings'       => 'allingrid_social_vine',
	            'type'           => 'text',
	            )
	        )
		);

		/**
		 * Add Header and Footer Section
		 */
		$wp_customize->add_section(
			'allingrid_header_and_footer_section',
			array(
				'title'       => __( 'Header and Footer', 'allingrid' ),
				'capability'  => 'edit_theme_options',
			)
		);

		// Add header phone
		$wp_customize->add_setting(
			'allingrid_header_phone',
			array(
			    'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_header_phone',
	        array(
	            'label'          => __( 'Your phone to appear in the website header', 'allingrid' ),
	            'section'        => 'allingrid_header_and_footer_section',
	            'settings'       => 'allingrid_header_phone',
	            'type'           => 'text',
	            )
	        )
		);

		// Add header email
		$wp_customize->add_setting(
			'allingrid_header_email',
			array(
			    'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_header_email',
	        array(
	            'label'          => __( 'Your e-mail to appear in the website header', 'allingrid' ),
	            'section'        => 'allingrid_header_and_footer_section',
	            'settings'       => 'allingrid_header_email',
	            'type'           => 'text',
	            )
	        )
		);
		
		// Add footer copyright text
		$wp_customize->add_setting(
			'allingrid_footer_copyright',
			array(
			    'default'           => '',
			    'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'allingrid_footer_copyright',
	        array(
	            'label'          => __( 'Copyright Text', 'allingrid' ),
	            'section'        => 'allingrid_header_and_footer_section',
	            'settings'       => 'allingrid_footer_copyright',
	            'type'           => 'text',
	            )
	        )
		);

		$wp_customize->add_section(
			'allingrid_footer_section',
			array(
				'title'       => __( 'Footer', 'allingrid' ),
				'capability'  => 'edit_theme_options',
			)
		);
	}
endif; // End of allingrid_customize_register

add_action('customize_register', 'allingrid_customize_register');
