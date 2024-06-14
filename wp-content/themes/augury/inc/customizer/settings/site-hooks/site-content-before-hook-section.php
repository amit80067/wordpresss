<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Enable Content Before Hook
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-content-before-hook]', array(
			'default'           => augury_get_option( 'enable-content-before-hook' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-content-before-hook]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Content Before Hook', 'augury'),
				'section' => 'site-content-before-hook-section',
				'description' => esc_html__('YES! to enable content before hook.', 'augury'),
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Content Before Hook
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[content-before-hook]', array(
			'default'           => augury_get_option( 'content-before-hook' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[content-before-hook]', array(
				'type'    	  => 'textarea',
				'section'     => 'site-content-before-hook-section',
				'label'       => esc_html__( 'Content Before Hook', 'augury' ),
				'description' => sprintf( esc_html__('Paste your content before hook, Executes before the opening %s tag.', 'augury'), '&lt;#primary&gt;' )
			)
		)
	);