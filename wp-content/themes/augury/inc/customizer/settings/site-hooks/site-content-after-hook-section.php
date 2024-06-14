<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Enable Content After Hook
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-content-after-hook]', array(
			'default'           => augury_get_option( 'enable-content-after-hook' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-content-after-hook]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Content After Hook', 'augury'),
				'section' => 'site-content-after-hook-section',
				'description' => esc_html__('YES! to enable content after hook.', 'augury'),
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Content After Hook
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[content-after-hook]', array(
			'default'           => augury_get_option( 'content-after-hook' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[content-after-hook]', array(
				'type'    	  => 'textarea',
				'section'     => 'site-content-after-hook-section',
				'label'       => esc_html__( 'Content After Hook', 'augury' ),
				'description' => sprintf( esc_html__('Paste your content after hook, Executes after the closing %s tag.', 'augury'), '&lt;/#main&gt;' ),
			)
		)
	);