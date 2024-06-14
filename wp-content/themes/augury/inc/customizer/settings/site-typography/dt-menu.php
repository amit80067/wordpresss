<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option :Menu Typo
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[menu-typo]', array(
			'default'           =>  augury_get_option( 'menu-typo' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Typography(
			$wp_customize, AUGURY_SETTINGS . '[menu-typo]', array(
				'type'    => 'dt-typography',
				'section' => 'site-menu-section',
				'label'   => esc_html__( 'Menu', 'augury'),
			)
		)
	);

/**
 * Option : Menu Color
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[menu-color]', array(
			'default'           => augury_get_option( 'menu-color' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, AUGURY_SETTINGS . '[menu-color]', array(
				'label'   => esc_html__( 'Color', 'augury' ),
				'section' => 'site-menu-section',
			)
		)
	);