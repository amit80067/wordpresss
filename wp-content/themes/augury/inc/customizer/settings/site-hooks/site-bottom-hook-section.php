<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Enable Bottom Hook
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-bottom-hook]', array(
			'default'           => augury_get_option( 'enable-bottom-hook' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-bottom-hook]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Bottom Hook', 'augury'),
				'section' => 'site-bottom-hook-section',
				'description' => esc_html__('YES! to enable bottom hook.', 'augury'),
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Bottom Hook
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[bottom-hook]', array(
			'default'           => augury_get_option( 'bottom-hook' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[bottom-hook]', array(
				'type'    	  => 'textarea',
				'section'     => 'site-bottom-hook-section',
				'label'       => esc_html__( 'Bottom Hook', 'augury' ),
				'description' => esc_html__('Paste your bottom hook, Executes after the closing &lt;/body&gt; tag.', 'augury'),
			)
		)
	);