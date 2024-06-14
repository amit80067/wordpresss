<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Enable Top Hook
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-top-hook]', array(
			'default'           => augury_get_option( 'enable-top-hook' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-top-hook]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Top Hook', 'augury'),
				'section' => 'site-top-hook-section',
				'description' => esc_html__('YES! to enable top hook.', 'augury'),
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Top Hook
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[top-hook]', array(
			'default'           => augury_get_option( 'top-hook' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[top-hook]', array(
				'type'    	  => 'textarea',
				'section'     => 'site-top-hook-section',
				'label'       => esc_html__( 'Top Hook', 'augury' ),
				'description' => sprintf( esc_html__('Paste your top hook, Executes after the opening %s tag.', 'augury'), '&lt;body&gt;')
			)
		)
	);