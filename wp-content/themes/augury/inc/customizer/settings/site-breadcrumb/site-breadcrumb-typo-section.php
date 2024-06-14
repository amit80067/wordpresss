<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Breadcrumb Title Typo
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[breadcrumb-title-typo]', array(
			'default'           =>  augury_get_option( 'breadcrumb-title-typo' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Typography(
			$wp_customize, AUGURY_SETTINGS . '[breadcrumb-title-typo]', array(
				'type'    => 'dt-typography',
				'section' => 'site-breadcrumb-typography-section',
				'label'   => esc_html__( 'Title', 'augury'),
			)
		)
	);

	/**
	 * Divider : Breadcrumb Title Typo Bottom
	 */
	$wp_customize->add_control(
		new Augury_Customize_Control_Separator(
			$wp_customize, AUGURY_SETTINGS . '[breadcrumb-title-typo-bottom-separator]', array(
				'type'     => 'dt-separator',
				'section'  => 'site-breadcrumb-typography-section',
				'settings' => array(),
			)
		)
	);		

/**
 * Option : Breadcrumb Typo
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[breadcrumb-typo]', array(
			'default'   =>  augury_get_option( 'breadcrumb-typo' ),
			'type'      => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),			
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Typography(
			$wp_customize, AUGURY_SETTINGS . '[breadcrumb-typo]', array(
				'type'    => 'dt-typography',
				'section' => 'site-breadcrumb-typography-section',
				'label'   => esc_html__( 'Breadcrumb', 'augury'),
			)
		)
	);