<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Breadcrumb Show
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[show-breadcrumb]', array(
			'default'           => augury_get_option( 'show-breadcrumb' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[show-breadcrumb]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Breadcrumb', 'augury'),
				'section' => 'site-breadcrumb-container-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Apply Dark Background for Breadcrumb
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[apply-dark-bg-breadcrumb]', array(
			'default'           => augury_get_option( 'apply-dark-bg-breadcrumb' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[apply-dark-bg-breadcrumb]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Dark BG?', 'augury'),
				'description'   => esc_html__( 'Apply dark background class for your bredcrumb.', 'augury'),
				'section' => 'site-breadcrumb-container-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);	

/**
 * Option : Breadcrumb Style
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[breadcrumb-style]', array(
			'default'           => augury_get_option( 'breadcrumb-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[breadcrumb-style]', array(
			'type'    => 'select',
			'section' => 'site-breadcrumb-container-section',
			'label'   => esc_html__( 'Style', 'augury' ),
			'choices' => array(
				'default'                           => esc_html__('Default', 'augury'),
				'aligncenter'                       => esc_html__('Align Center', 'augury'),
				'alignright'                        => esc_html__('Align Right', 'augury'),
				'breadcrumb-left'                   => esc_html__('Left Side Breadcrumb', 'augury'),
				'breadcrumb-right'                  => esc_html__('Right Side Breadcrumb', 'augury'),
				'breadcrumb-top-right-title-center' => esc_html__('Top Right Title Center', 'augury'),
				'breadcrumb-top-left-title-center'  => esc_html__('Top Left Title Center', 'augury'),
			)
		)
	);

/**
 * Option : Breadcrumb Position
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[breadcrumb-position]', array(
			'default'           => augury_get_option( 'breadcrumb-position' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[breadcrumb-position]', array(
			'type'    => 'select',
			'section' => 'site-breadcrumb-container-section',
			'label'   => esc_html__( 'Position', 'augury' ),
			'choices' => array(
				'header-top-absolute' => esc_html__('Behind the Header','augury'),
				'header-top-relative' => esc_html__('Default','augury'),
			)
		)
	);

/**
 *  Option : Change Breadcrumb Delimiter
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[change-breadcrumb-delimiter]', array (
			'default'           => augury_get_option( 'change-breadcrumb-delimiter' ),
			'type'              => 'option',
			'sanitize_callback' => array ( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[change-breadcrumb-delimiter]', array (
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Change Breadcrumb Delimiter', 'augury'),
				'description'   => esc_html__( 'If you wish you can enable to change the delimiter for your bredcrumb.', 'augury'),
				'section' => 'site-breadcrumb-container-section',
				'choices' => array (
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Breadcrumb Delimiter
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[breadcrumb-delimiter]', array(
			'default'   => augury_get_option( 'breadcrumb-delimiter' ),
			'type'      => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),			
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Fontawesome(
			$wp_customize, AUGURY_SETTINGS . '[breadcrumb-delimiter]', array(
				'type'    => 'dt-fontawesome',
				'section' => 'site-breadcrumb-container-section',
				'label'   => esc_html__( 'Breadcrumb Delimiter', 'augury'),
				'dependency' => array ( 'change-breadcrumb-delimiter', '==', '1' )				
			)
		)
	);