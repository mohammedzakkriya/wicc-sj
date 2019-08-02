<?php
/**
 * grovza Theme Customizer
 *
 * @package grovza
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function grovza_customize_register( $wp_customize ) {

	global $grovzaPostsPagesArray, $grovzaYesNo, $grovzaSliderType, $grovzaServiceLayouts, $grovzaAvailableCats, $grovzaBusinessLayoutType;

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'grovza_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'grovza_customize_partial_blogdescription',
		) );
	}
	
	$wp_customize->add_panel( 'grovza_general', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'title'      => __('General Settings', 'grovza'),
		'active_callback' => '',
	) );

	$wp_customize->get_section( 'title_tagline' )->panel = 'grovza_general';
	$wp_customize->get_section( 'background_image' )->panel = 'grovza_general';
	$wp_customize->get_section( 'background_image' )->title = __('Site background', 'grovza');
	$wp_customize->get_section( 'header_image' )->panel = 'grovza_general';
	$wp_customize->get_section( 'header_image' )->title = __('Header Settings', 'grovza');
	$wp_customize->get_control( 'header_image' )->priority = 20;
	$wp_customize->get_control( 'header_image' )->active_callback = 'grovza_show_wp_header_control';	
	$wp_customize->get_section( 'static_front_page' )->panel = 'business_page';
	$wp_customize->get_section( 'static_front_page' )->title = __('Select frontpage type', 'grovza');
	$wp_customize->get_section( 'static_front_page' )->priority = 9;
	$wp_customize->remove_section('colors');
	$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'background_color', 
			array(
				'label'      => __( 'Background Color', 'grovza' ),
				'section'    => 'background_image',
				'priority'   => 9
			) ) 
	);
	//$wp_customize->remove_section('static_front_page');	
	//$wp_customize->remove_section('header_image');	

	/* Upgrade */	
	$wp_customize->add_section( 'business_upgrade', array(
		'priority'       => 8,
		'capability'     => 'edit_theme_options',
		'title'      => __('Upgrade to PRO', 'grovza'),
		'active_callback' => '',
	) );		
	$wp_customize->add_setting( 'grovza_show_sliderr',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new grovza_Customize_Control_Upgrade(
		$wp_customize,
		'grovza_show_sliderr',
		array(
			'label'      => __( 'Show headerr?', 'grovza' ),
			'settings'   => 'grovza_show_sliderr',
			'priority'   => 10,
			'section'    => 'business_upgrade',
			'choices' => '',
			'input_attrs'  => 'yes',
			'active_callback' => ''			
		)
	) );
	
	/* Usage guide */	
	$wp_customize->add_section( 'business_usage', array(
		'priority'       => 9,
		'capability'     => 'edit_theme_options',
		'title'      => __('Theme Usage Guide', 'grovza'),
		'active_callback' => '',
	) );		
	$wp_customize->add_setting( 'grovza_show_sliderrr',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new grovza_Customize_Control_Guide(
		$wp_customize,
		'grovza_show_sliderrr',
		array(

			'label'      => __( 'Show headerr?', 'grovza' ),
			'settings'   => 'grovza_show_sliderrr',
			'priority'   => 10,
			'section'    => 'business_usage',
			'choices' => '',
			'input_attrs'  => 'yes',
			'active_callback' => ''				
		)
	) );
	
	/* Header Section */
	$wp_customize->add_setting( 'grovza_show_slider',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_show_slider',
		array(
			'label'      => __( 'Show header?', 'grovza' ),
			'settings'   => 'grovza_show_slider',
			'priority'   => 10,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $grovzaYesNo,
		)
	) );	
	$wp_customize->add_setting( 'header_type',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_slider_type_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'header_type',
		array(
			'label'      => __( 'Header type :', 'grovza' ),
			'settings'   => 'header_type',
			'priority'   => 10,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $grovzaSliderType,
		)
	) );
	
	$wp_customize->add_setting( 'grovza_header_one_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_header_one_post',
		array(
			'label'      => __( 'Header post :', 'grovza' ),
			'settings'   => 'grovza_header_one_post',
			'priority'   => 30,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
			'active_callback' => 'grovza_show_header_one_control'
		)
	) );	
	
	
	/* Business page panel */
	$wp_customize->add_panel( 'business_page', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'title'      => __('Home/Front Page Settings', 'grovza'),
		'active_callback' => '',
	) );
	$wp_customize->add_section( 'business_page_layout', array(
		'priority'       => 13,
		'capability'     => 'edit_theme_options',
		'title'      => __('Select layout', 'grovza'),
		'active_callback' => 'grovza_front_page_sections',
		'panel'  => 'business_page',
	) );
	$wp_customize->add_setting( 'business_page_layout_type',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_layout_type',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_page_layout_type',
		array(
			'label'      => __( 'Layout type :', 'grovza' ),
			'settings'   => 'business_page_layout_type',
			'priority'   => 10,
			'section'    => 'business_page_layout',
			'type'    => 'select',
			'choices' => $grovzaBusinessLayoutType,
		)
	) );
	
	$wp_customize->add_section( 'business_page_layout_one', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'title'      => __('Layout One settings', 'grovza'),
		'active_callback' => 'grovza_front_page_sections',
		'panel'  => 'business_page',
	) );


	$wp_customize->add_setting( 'grovza_welcome_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_welcome_post',
		array(
			'label'      => __( 'Welcome post :', 'grovza' ),
			'settings'   => 'grovza_welcome_post',
			'priority'   => 11,
			'section'    => 'business_page_layout_one',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	
	$wp_customize->add_setting( 'grovza_services_cat',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_cat_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_services_cat',
		array(
			'label'      => __( 'Select category for services :', 'grovza' ),
			'settings'   => 'grovza_services_cat',
			'priority'   => 21,
			'section'    => 'business_page_layout_one',
			'type'    => 'select',
			'choices' => $grovzaAvailableCats,
		)
	) );
	
	

	$wp_customize->add_setting( 'grovza_portfolio_cat',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_cat_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_portfolio_cat',
		array(
			'label'      => __( 'Select category for portfolio :', 'grovza' ),
			'settings'   => 'grovza_portfolio_cat',
			'priority'   => 21,
			'section'    => 'business_page_layout_one',
			'type'    => 'select',
			'choices' => $grovzaAvailableCats,
		)
	) );
	

	$wp_customize->add_setting( 'grovza_news_cat',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_cat_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_news_cat',
		array(
			'label'      => __( 'Select category for news :', 'grovza' ),
			'settings'   => 'grovza_news_cat',
			'priority'   => 31,
			'section'    => 'business_page_layout_one',
			'type'    => 'select',
			'choices' => $grovzaAvailableCats,
		)
	) );	
	
	
	
	
	$wp_customize->add_section( 'business_page_layout_two', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'title'      => __('Layout Two settings', 'grovza'),
		'active_callback' => 'grovza_front_page_sections',
		'panel'  => 'business_page',
	) );
	/*
	$wp_customize->add_setting( 'grovza_show_slider_two',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_show_slider_two',
		array(
			'label'      => __( 'Show header?', 'grovza' ),
			'settings'   => 'grovza_show_slider_two',
			'priority'   => 10,
			'section'    => 'business_page_layout_two',
			'type'    => 'select',
			'choices' => $grovzaYesNo,
		)
	) );
	*/
	$wp_customize->add_setting( 'grovza_two_welcome_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_two_welcome_post',
		array(
			'label'      => __( 'Welcome post :', 'grovza' ),
			'settings'   => 'grovza_two_welcome_post',
			'priority'   => 20,
			'section'    => 'business_page_layout_two',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );	
	
	$wp_customize->add_setting( 'grovza_two_product_post_one',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_two_product_post_one',
		array(
			'label'      => __( 'Product One :', 'grovza' ),
			'settings'   => 'grovza_two_product_post_one',
			'priority'   => 30,
			'section'    => 'business_page_layout_two',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_two_product_post_two',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_two_product_post_two',
		array(
			'label'      => __( 'Product Two :', 'grovza' ),
			'settings'   => 'grovza_two_product_post_two',
			'priority'   => 30,
			'section'    => 'business_page_layout_two',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_two_product_post_three',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_two_product_post_three',
		array(
			'label'      => __( 'Product Three :', 'grovza' ),
			'settings'   => 'grovza_two_product_post_three',
			'priority'   => 30,
			'section'    => 'business_page_layout_two',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	
	$wp_customize->add_section( 'business_page_layout_three', array(
		'priority'       => 40,
		'capability'     => 'edit_theme_options',
		'title'      => __('Layout Three settings', 'grovza'),
		'active_callback' => 'grovza_front_page_sections',
		'panel'  => 'business_page',
	) );
	$wp_customize->add_setting( 'grovza_three_welcome_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_three_welcome_post',
		array(
			'label'      => __( 'Welcome post :', 'grovza' ),
			'settings'   => 'grovza_three_welcome_post',
			'priority'   => 10,
			'section'    => 'business_page_layout_three',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	
	$wp_customize->add_setting( 'grovza_three_products_one',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_three_products_one',
		array(
			'label'      => __( 'Product One :', 'grovza' ),
			'settings'   => 'grovza_three_products_one',
			'priority'   => 20,
			'section'    => 'business_page_layout_three',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_three_products_two',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_three_products_two',
		array(
			'label'      => __( 'Product Two :', 'grovza' ),
			'settings'   => 'grovza_three_products_two',
			'priority'   => 30,
			'section'    => 'business_page_layout_three',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );	
	$wp_customize->add_setting( 'grovza_three_products_three',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_three_products_three',
		array(
			'label'      => __( 'Product Three :', 'grovza' ),
			'settings'   => 'grovza_three_products_three',
			'priority'   => 40,
			'section'    => 'business_page_layout_three',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_three_portfolio_one',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_three_portfolio_one',
		array(
			'label'      => __( 'Portfolio item one :', 'grovza' ),
			'settings'   => 'grovza_three_portfolio_one',
			'priority'   => 50,
			'section'    => 'business_page_layout_three',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_three_portfolio_two',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_three_portfolio_two',
		array(
			'label'      => __( 'Portfolio item two :', 'grovza' ),
			'settings'   => 'grovza_three_portfolio_two',
			'priority'   => 60,
			'section'    => 'business_page_layout_three',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_three_portfolio_three',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_three_portfolio_three',
		array(
			'label'      => __( 'Portfolio item three :', 'grovza' ),
			'settings'   => 'grovza_three_portfolio_three',
			'priority'   => 70,
			'section'    => 'business_page_layout_three',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	
	$wp_customize->add_section( 'business_page_layout_four', array(
		'priority'       => 50,
		'capability'     => 'edit_theme_options',
		'title'      => __('Layout Four settings', 'grovza'),
		'active_callback' => 'grovza_front_page_sections',
		'panel'  => 'business_page',
	) );

	$wp_customize->add_setting( 'grovza_four_welcome_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_four_welcome_post',
		array(
			'label'      => __( 'Welcome post :', 'grovza' ),
			'settings'   => 'grovza_four_welcome_post',
			'priority'   => 20,
			'section'    => 'business_page_layout_four',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );	
	
	$wp_customize->add_setting( 'grovza_four_product_post_one',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_four_product_post_one',
		array(
			'label'      => __( 'Product One :', 'grovza' ),
			'settings'   => 'grovza_four_product_post_one',
			'priority'   => 30,
			'section'    => 'business_page_layout_four',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_four_product_post_two',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_four_product_post_two',
		array(
			'label'      => __( 'Product Two :', 'grovza' ),
			'settings'   => 'grovza_four_product_post_two',
			'priority'   => 30,
			'section'    => 'business_page_layout_four',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_four_product_post_three',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_four_product_post_three',
		array(
			'label'      => __( 'Product Three :', 'grovza' ),
			'settings'   => 'grovza_four_product_post_three',
			'priority'   => 30,
			'section'    => 'business_page_layout_four',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_four_product_post_four',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_four_product_post_four',
		array(
			'label'      => __( 'Product Four :', 'grovza' ),
			'settings'   => 'grovza_four_product_post_four',
			'priority'   => 40,
			'section'    => 'business_page_layout_four',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_four_product_post_five',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_four_product_post_five',
		array(
			'label'      => __( 'Product Five :', 'grovza' ),
			'settings'   => 'grovza_four_product_post_five',
			'priority'   => 50,
			'section'    => 'business_page_layout_four',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'grovza_four_product_post_six',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_four_product_post_six',
		array(
			'label'      => __( 'Product Six :', 'grovza' ),
			'settings'   => 'grovza_four_product_post_six',
			'priority'   => 60,
			'section'    => 'business_page_layout_four',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );

	$wp_customize->add_section( 'business_page_quote', array(
		'priority'       => 110,
		'capability'     => 'edit_theme_options',
		'title'      => __('Quote Settings', 'grovza'),
		'active_callback' => '',
		'panel'  => 'grovza_general',
	) );
	$wp_customize->add_setting( 'grovza_show_quote',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_show_quote',
		array(
			'label'      => __( 'Show quote?', 'grovza' ),
			'settings'   => 'grovza_show_quote',
			'priority'   => 10,
			'section'    => 'business_page_quote',
			'type'    => 'select',
			'choices' => $grovzaYesNo,
		)
	) );
	$wp_customize->add_setting( 'grovza_quote_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_quote_post',
		array(
			'label'      => __( 'Select post', 'grovza' ),
			'description' => __( 'Select a post/page you want to show in quote section', 'grovza' ),
			'settings'   => 'grovza_quote_post',
			'priority'   => 11,
			'section'    => 'business_page_quote',
			'type'    => 'select',
			'choices' => $grovzaPostsPagesArray,
		)
	) );	
	
	$wp_customize->add_section( 'business_page_social', array(
		'priority'       => 120,
		'capability'     => 'edit_theme_options',
		'title'      => __('Social Settings', 'grovza'),
		'active_callback' => '',
		'panel'  => 'grovza_general',
	) );	
	$wp_customize->add_setting( 'grovza_show_social',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grovza_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'grovza_show_social',
		array(
			'label'      => __( 'Show social?', 'grovza' ),
			'settings'   => 'grovza_show_social',
			'priority'   => 10,
			'section'    => 'business_page_social',
			'type'    => 'select',
			'choices' => $grovzaYesNo,
		)
	) );
	$wp_customize->add_setting( 'business_page_facebook',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_facebook', array(
	  'type' => 'text',
	  'section' => 'business_page_social', // Add a default or your own section
	  'label' => __( 'Facebook', 'grovza' ),
	  'description' => __( 'Enter your facebook url.', 'grovza' ),
	) );
	$wp_customize->add_setting( 'business_page_flickr',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_flickr', array(
	  'type' => 'text',
	  'section' => 'business_page_social', // Add a default or your own section
	  'label' => __( 'Flickr', 'grovza' ),
	  'description' => __( 'Enter your flickr url.', 'grovza' ),
	) );
	$wp_customize->add_setting( 'business_page_gplus',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_gplus', array(
	  'type' => 'text',
	  'section' => 'business_page_social', // Add a default or your own section
	  'label' => __( 'Gplus', 'grovza' ),
	  'description' => __( 'Enter your gplus url.', 'grovza' ),
	) );
	$wp_customize->add_setting( 'business_page_linkedin',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_linkedin', array(
	  'type' => 'text',
	  'section' => 'business_page_social', // Add a default or your own section
	  'label' => __( 'Linkedin', 'grovza' ),
	  'description' => __( 'Enter your linkedin url.', 'grovza' ),
	) );
	$wp_customize->add_setting( 'business_page_reddit',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_reddit', array(
	  'type' => 'text',
	  'section' => 'business_page_social', // Add a default or your own section
	  'label' => __( 'Reddit', 'grovza' ),
	  'description' => __( 'Enter your reddit url.', 'grovza' ),
	) );
	$wp_customize->add_setting( 'business_page_stumble',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_stumble', array(
	  'type' => 'text',
	  'section' => 'business_page_social', // Add a default or your own section
	  'label' => __( 'Stumble', 'grovza' ),
	  'description' => __( 'Enter your stumble url.', 'grovza' ),
	) );
	$wp_customize->add_setting( 'business_page_twitter',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_twitter', array(
	  'type' => 'text',
	  'section' => 'business_page_social', // Add a default or your own section
	  'label' => __( 'Twitter', 'grovza' ),
	  'description' => __( 'Enter your twitter url.', 'grovza' ),
	) );	
	
}
add_action( 'customize_register', 'grovza_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function grovza_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function grovza_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function grovza_customize_preview_js() {
	wp_enqueue_script( 'grovza-customizer', esc_url( get_template_directory_uri() ) . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'grovza_customize_preview_js' );

require get_template_directory() . '/inc/variables.php';

function grovza_sanitize_yes_no_setting( $value ){
	global $grovzaYesNo;
    if ( ! array_key_exists( $value, $grovzaYesNo ) ){
        $value = 'select';
	}
    return $value;	
}

function grovza_sanitize_post_selection( $value ){
	global $grovzaPostsPagesArray;
    if ( ! array_key_exists( $value, $grovzaPostsPagesArray ) ){
        $value = 'select';
	}
    return $value;	
}

function grovza_front_page_sections(){
	
	$value = false;
	
	if( 'page' == get_option( 'show_on_front' ) ){
		$value = true;
	}
	
	return $value;
	
}

function grovza_show_wp_header_control(){
	
	$value = false;
	
	if( 'header' == get_theme_mod( 'header_type' ) ){
		$value = true;
	}
	
	return $value;
	
}

function grovza_show_header_one_control(){
	
	$value = false;
	
	if( 'header-one' == get_theme_mod( 'header_type' ) ){
		$value = true;
	}
	
	return $value;
	
}

function grovza_sanitize_slider_type_setting( $value ){

	global $grovzaSliderType;
    if ( ! array_key_exists( $value, $grovzaSliderType ) ){
        $value = 'select';
	}
    return $value;	
	
}

function grovza_sanitize_cat_setting( $value ){
	
	global $grovzaAvailableCats;
	
	if( ! array_key_exists( $value, $grovzaAvailableCats ) ){
		
		$value = 'select';
		
	}
	return $value;
	
}

function grovza_sanitize_layout_type( $value ){
	
	global $grovzaBusinessLayoutType;
	
	if( ! array_key_exists( $value, $grovzaBusinessLayoutType ) ){
		
		$value = 'select';
		
	}
	return $value;
	
}

add_action( 'customize_register', 'grovza_load_customize_classes', 0 );
function grovza_load_customize_classes( $wp_customize ) {
	
	class grovza_Customize_Control_Upgrade extends WP_Customize_Control {

		public $type = 'grovza-upgrade';
		
		public function enqueue() {

		}

		public function to_json() {
			
			parent::to_json();

			$this->json['link']    = $this->get_link();
			$this->json['value']   = $this->value();
			$this->json['id']      = $this->id;
			$this->json['default'] = $this->default;
			
		}	
		
		public function render_content() {}
		
		public function content_template() { ?>

			<div id="grovza-upgrade-container" class="grovza-upgrade-container">

				<ul>
					<li>More sliders</li>
					<li>More layouts</li>
					<li>Color customization</li>
					<li>Font customization</li>
				</ul>

				<p>
					<a href="https://www.themealley.com/business/">Upgrade</a>
				</p>
									
			</div><!-- .grovza-upgrade-container -->
			
		<?php }	
		
	}
	
	class grovza_Customize_Control_Guide extends WP_Customize_Control {

		public $type = 'grovza-guide';
		
		public function enqueue() {

		}

		public function to_json() {
			
			parent::to_json();

			$this->json['link']    = $this->get_link();
			$this->json['value']   = $this->value();
			$this->json['id']      = $this->id;
			$this->json['default'] = $this->default;
			
		}	
		
		public function render_content() {}
		
		public function content_template() { ?>

			<div id="grovza-upgrade-container" class="grovza-upgrade-container">

				<ol>
					<li>Select 'A static page' for "your homepage displays" in 'select frontpage type' section of 'Home/Front Page settings' tab.</li>
					<li>Enter details for various section like header, welcome, services, quote, social sections.</li>
				</ol>
									
			</div><!-- .grovza-upgrade-container -->
			
		<?php }	
		
	}	

	$wp_customize->register_control_type( 'grovza_Customize_Control_Upgrade' );
	$wp_customize->register_control_type( 'grovza_Customize_Control_Guide' );
	
	
}