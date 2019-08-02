<?php
/**
 * Florence IT Theme Customizer
 *
 * @package Florence IT
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

get_template_part('/inc/select/category-dropdown-custom-control');

function florence_it_customize_register( $wp_customize ) {	
	function florence_it_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	$wp_customize->add_setting('florence_it_color_scheme',array(
			'default'	=> '#c01d06',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));

	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'florence_it_color_scheme',array(
			'label' => __('Color Scheme','florence-it'),			
			'description' => __( 'No More color options in free Version.', 'florence-it' ),			
			'section' => 'colors',
			'settings' => 'florence_it_color_scheme'
		))
	);	
		 
	//Florence Theme Options
	$wp_customize->add_panel( 'florence_it_panel_id', array(
		'priority' => null,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options', 'florence-it' ),		
	) );
	
	// Home Two Coloumn Category Dropdown Section 	
	$wp_customize->add_section('florence_it_two_cols_section',array(
		'title'	=> __('Manage Slider','florence-it'),
		'description'	=> __('Select Categories from the Dropdowns for slider','florence-it'),
		'priority'	=> null,
		'panel' => 'florence_it_panel_id'
	));

	// Add a category dropdown Slider Coloumn
	$wp_customize->add_setting( 'florence_it_slidersection', array(
		'default'	=> '0',	
		'sanitize_callback'	=> 'esc_textarea'
	) );
	$wp_customize->add_control( new florence_it_Category_Dropdown_Custom_Control( $wp_customize, 'florence_it_slidersection', array(          
		'section' => 'florence_it_two_cols_section',
		'settings'   => 'florence_it_slidersection',            
	) ) );		
 
	 //Hide Section		
	$wp_customize->add_setting('florence_it_hide_categorysec',array(
			'default' => true,				
			'sanitize_callback' => 'florence_it_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			
	));	 

	$wp_customize->add_control( 'florence_it_hide_categorysec', array(
		   'settings' => 'florence_it_hide_categorysec',
		   'section'   => 'florence_it_two_cols_section',
		   'label'     => __('Uncheck To Enable This Section','florence-it'),
		   'type'      => 'checkbox'
	 ));//Hide Slider Section	
	
	
 }
add_action( 'customize_register', 'florence_it_customize_register' );

function florence_it_custom_css(){
		?>
        	<style type="text/css"> 
					a,	#sidebar ul li a:hover,
					.lists_cats h5 a:hover,			
					.logo h1 span,
					.copyright-wrapper a:hover	,
					.hdrmenu ul li a:hover, .hdrmenu ul li.current_page_item a,
					.current,
					#sidebar ul li a:hover									
					{ color:<?php echo esc_html(get_theme_mod('florence_it_color_scheme','#c01d06')); ?>;}
					
					.pagination ul li .current, .pagination ul li a:hover, 
					#commentform input#submit:hover,													
					.wpcf7 input[type='submit'],
					.social-icons a:hover
					{ background-color:<?php echo esc_html(get_theme_mod('florence_it_color_scheme','#c01d06')); ?> !important;}
			</style> 
<?php          
}
add_action('wp_head','florence_it_custom_css');	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function florence_it_customize_preview_js() {
	wp_enqueue_script( 'florence_it_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20161204', true );
}
add_action( 'customize_preview_init', 'florence_it_customize_preview_js' );