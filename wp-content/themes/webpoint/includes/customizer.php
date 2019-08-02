<?php
/**
 * WebPoint: Customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_customize_register' ) ) {

	/* Hook the function to an action. */
	add_action( 'customize_register', 'webpoint_customize_register' );

	/**
	 * Add Settings to the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function webpoint_customize_register( $wp_customize ) {

		/**
		 * Theme options.
		 */
		$wp_customize->add_section( 'webpoint_settings', array(
			'title'    => __( 'Theme Options', 'webpoint' ),
			'priority' => 20,
		) );

		/* Logo Name Setting */
		$wp_customize->add_setting( 'logo_name', array(
			'default'           => '',
			'sanitize_callback' => 'webpoint_sanitize_html',
			'transport'         => 'refresh',
		) );

		/* Logo Name Control */
		$wp_customize->add_control( 'logo_name', array(
			'label'       => __( 'Logo Text', 'webpoint' ),
			'section'     => 'webpoint_settings',
			'type'        => 'text',
			'description' => __( 'Enter the site logo text (HTML tags allowed).', 'webpoint' )
		) );

		/* Logo Description Setting */
		$wp_customize->add_setting( 'logo_desc', array(
			'default'           => '',
			'sanitize_callback' => 'webpoint_sanitize_html',
			'transport'         => 'refresh',
		) );

		/* Logo Description Control */
		$wp_customize->add_control( 'logo_desc', array(
			'label'       => __( 'Logo Description', 'webpoint' ),
			'section'     => 'webpoint_settings',
			'type'        => 'text',
			'description' => __( 'Enter the site logo description (HTML tags allowed).', 'webpoint' )
		) );

		/* Sidebar Position Setting */
		$wp_customize->add_setting( 'sidebar_position', array(
			'default'           => 'none',
			'sanitize_callback' => 'webpoint_sanitize_sidebar_position',
			'transport'         => 'refresh',
		) );

		/* Sidebar Position Control */
		$wp_customize->add_control( 'sidebar_position', array(
			'label'       => __( 'Sidebar Position', 'webpoint' ),
			'section'     => 'webpoint_settings',
			'type'        => 'select',
			'description' => __( 'Select the sidebar position.', 'webpoint' ),
			'choices'     => array(
				'left'   => _x( 'Left', 'sidebar position', 'webpoint' ),
				'right'  => _x( 'Right', 'sidebar position', 'webpoint' ),
				'bottom' => _x( 'Bottom', 'sidebar position', 'webpoint' ),
				'none'   => _x( 'Disabled', 'sidebar position', 'webpoint' ),
			),
		) );

		/* Sidebar Mobile Menus Setting */
		$wp_customize->add_setting( 'mobile_sidebar_menus', array(
			'default'           => 0,
			'sanitize_callback' => 'webpoint_sanitize_bool_string',
			'transport'         => 'refresh',
		) );

		/* Sidebar Mobile Menus Control */
		$wp_customize->add_control( 'mobile_sidebar_menus', array(
			'label'       => __( 'Mobile Sidebar Menus', 'webpoint' ),
			'section'     => 'webpoint_settings',
			'type'        => 'select',
			'description' => __( 'Use sidebar menus in mobile navigation.', 'webpoint' ),
			'choices'     => array(
				'1' => __( 'Enabled', 'webpoint' ),
				'0' => __( 'Disabled', 'webpoint' ),
			),
		) );

		/* Fixed Widget Setting */
		$wp_customize->add_setting( 'fixed_widget', array(
			'default'           => 0,
			'sanitize_callback' => 'webpoint_sanitize_bool_string',
			'transport'         => 'refresh',
		) );

		/* Fixed Widget Control */
		$wp_customize->add_control( 'fixed_widget', array(
			'label'       => __( 'Fixed Widget', 'webpoint' ),
			'section'     => 'webpoint_settings',
			'type'        => 'select',
			'description' => __( 'Make sticky the last widget in the sidebar.', 'webpoint' ),
			'choices'     => array(
				'1' => __( 'Enabled', 'webpoint' ),
				'0' => __( 'Disabled', 'webpoint' ),
			),
		) );

	} // webpoint_customize_register();

}


if ( ! function_exists( 'webpoint_sanitize_html' ) ) {

	/**
	 * Sanitize the html string.
	 *
	 * @param string $input
	 * @return string
	 */
	function webpoint_sanitize_html( $input = '' ) {

		/* Return sanitized input */
		return webpoint_sanitize_var( $input, 'html', '' );

	} // webpoint_sanitize_html();

}


if ( ! function_exists( 'webpoint_sanitize_bool_string' ) ) {

	/**
	 * Sanitize the bool string.
	 *
	 * @param string $input
	 * @return int
	 */
	function webpoint_sanitize_bool_string( $input = '' ) {

		/* Sanitize input */
		$input = webpoint_sanitize_var( $input, 'absint', '0' );

		/* Return bool string */
		return $input ? '1' : '0';

	} // webpoint_sanitize_bool_string();

}


if ( ! function_exists( 'webpoint_sanitize_sidebar_position' ) ) {

	/**
	 * Sanitize the page sidebar position.
	 *
	 * @param string $input Sidebar Position.
	 * @return string
	 */
	function webpoint_sanitize_sidebar_position( $input = '' ) {

		/* Sanitize input */
		$input = webpoint_sanitize_var( $input, 'term', 'none' );

		/* Set expected values */
		$valid = array( 'left',	'right', 'bottom', 'none' );

		/* Check value */
		if ( ! in_array( $input, $valid ) ) {
			$input = 'none';
		}

		/* Return value */
		return $input;

	} // webpoint_sanitize_sidebar_position();

}
