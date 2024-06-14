<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option :H4 Typo
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[h4-typo]', array(
			'default'           =>  augury_get_option( 'h4-typo' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),			
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Typography(
			$wp_customize, AUGURY_SETTINGS . '[h4-typo]', array(
				'type'    => 'dt-typography',
				'section' => 'site-h4-section',
				'label'   => esc_html__( 'H4 Tag', 'augury'),
			)
		)
	);

/**
 * Option : H4 Color
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[h4-color]', array(
			'default'           => augury_get_option( 'h4-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, AUGURY_SETTINGS . '[h4-color]', array(
				'label'   => esc_html__( 'Color', 'augury' ),
				'section' => 'site-h4-section',
			)
		)
	);	