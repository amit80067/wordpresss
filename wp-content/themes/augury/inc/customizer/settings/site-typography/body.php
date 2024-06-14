<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Body Content Typo
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[body-typo]', array(
			'default'           =>  augury_get_option( 'body-typo' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Typography(
			$wp_customize, AUGURY_SETTINGS . '[body-typo]', array(
				'type'    => 'dt-typography',
				'section' => 'site-body-section',
				'label'   => esc_html__( 'Body & Content', 'augury'),
			)
		)
	);

/**
 * Option :  Body Content Color
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[body-content-color]', array(
			'default'           => augury_get_option( 'body-content-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, AUGURY_SETTINGS . '[body-content-color]', array(
				'label'   => esc_html__( 'Site Content Color', 'augury' ),
				'section' => 'site-body-section',
			)
		)
	);

/**
 * Option :  Body Content Link Color
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[body-content-link-color]', array(
			'default'           => augury_get_option( 'body-content-link-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, AUGURY_SETTINGS . '[body-content-link-color]', array(
				'label'   => esc_html__( 'Site Link Color', 'augury' ),
				'section' => 'site-body-section',
			)
		)
	);

/**
 * Option :  Body Content Link Hover Color
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[body-content-link-hover-color]', array(
			'default'           => augury_get_option( 'body-content-link-hover-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, AUGURY_SETTINGS . '[body-content-link-hover-color]', array(
				'label'   => esc_html__( 'Site Link Hover Color', 'augury' ),
				'section' => 'site-body-section',
			)
		)
	);		