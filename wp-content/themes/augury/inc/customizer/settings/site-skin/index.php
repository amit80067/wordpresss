<?php
/**
 * Site Skin Main Section
 */
$wp_customize->add_section( 
	new Augury_WP_Customize_Section(
		$wp_customize,
		'site-skin-main-section',
		array(
			'title'    => esc_html__('Site Skin', 'augury'),
			'priority' => 10
		)
	)
);


/**
 * Option : Primary Color
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[primary-color]', array(
			'default'           => augury_get_option( 'primary-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control_Color(
		$wp_customize, AUGURY_SETTINGS . '[primary-color]', array(
			'label'   => esc_html__( 'Primary Color', 'augury' ),
			'section' => 'site-skin-main-section',
		)
	));

/**
 * Option : Secondary Color
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[secondary-color]', array(
			'default'           => augury_get_option( 'secondary-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control_Color(
		$wp_customize, AUGURY_SETTINGS . '[secondary-color]', array(
			'label'   => esc_html__( 'Secondary Color', 'augury' ),
			'section' => 'site-skin-main-section',
		)
	));

/**
 * Option : Tertiary Color
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[tertiary-color]', array(
			'default'           => augury_get_option( 'tertiary-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control_Color(
		$wp_customize, AUGURY_SETTINGS . '[tertiary-color]', array(
			'label'   => esc_html__( 'Tertiary Color', 'augury' ),
			'section' => 'site-skin-main-section',
		)
	));
	
/**
 * Option :  Body BG Color
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[body-bg-color]', array(
			'default'           => augury_get_option( 'body-bg-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control_Color(
		$wp_customize, AUGURY_SETTINGS . '[body-bg-color]', array(
			'label'   => esc_html__( 'Site BG Color', 'augury' ),
			'section' => 'site-skin-main-section',
		)
	));