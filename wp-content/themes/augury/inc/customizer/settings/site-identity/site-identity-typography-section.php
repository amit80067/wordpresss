<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Site Title Typo
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[site-title-typo]', array(
			'default'           =>  augury_get_option( 'site-title-typo' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),				
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Typography(
			$wp_customize, AUGURY_SETTINGS . '[site-title-typo]', array(
				'type'    => 'dt-typography',
				'section' => 'site-identity-typography-section',
				'label'   => esc_html__( 'Site Title', 'augury'),
			)
		)
	);

	/**
	 * Divider : Site Title Typo
	 */
	$wp_customize->add_control(
		new Augury_Customize_Control_Separator(
			$wp_customize, AUGURY_SETTINGS . '[site-title-typo-separator]', array(
				'type'     => 'dt-separator',
				'section'  => 'site-identity-typography-section',
				'settings' => array(),
			)
		)
	);	

/**
 * Option : Site Tagline Typo
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[site-tagline-typo]', array(
			'default'           =>  augury_get_option( 'site-tagline-typo' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Typography(
			$wp_customize, AUGURY_SETTINGS . '[site-tagline-typo]', array(
				'type'    => 'dt-typography',
				'section' => 'site-identity-typography-section',
				'label'   => esc_html__( 'Site Tagline', 'augury'),
			)
		)
	);