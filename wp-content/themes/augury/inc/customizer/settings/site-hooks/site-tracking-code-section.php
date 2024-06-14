<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Enable Tracking Code
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-analytics-code]', array(
			'default'           => augury_get_option( 'enable-analytics-code' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-analytics-code]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Tracking Code', 'augury'),
				'section' => 'site-tracking-code-section',
				'description' => esc_html__('YES! to enable site tracking code.', 'augury'),
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Tracking Code
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[analytics-code]', array(
			'default'           => augury_get_option( 'analytics-code' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[analytics-code]', array(
				'type'    	  => 'textarea',
				'section'     => 'site-tracking-code-section',
				'label'       => esc_html__( 'Google Analytics Tracking Code', 'augury' ),
				'description' => esc_html__('Either enter your Google tracking id (UA-XXXXX-X) here. If you want to offer your visitors the option to stop being tracked you can place the shortcode [dt_sc_privacy_google_tracking] somewhere on your site', 'augury'),
			)
		)
	);