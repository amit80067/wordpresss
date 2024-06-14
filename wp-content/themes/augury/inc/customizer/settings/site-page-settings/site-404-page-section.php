<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : 404 Meaage
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-404message]', array(
			'default'           => augury_get_option( 'enable-404message' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-404message]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Message', 'augury'),
				'description' => esc_html__('YES! to enable not-found page message.', 'augury'),
				'section' => 'site-404-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Template Style
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[notfound-style]', array(
			'default'           => augury_get_option( 'notfound-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[notfound-style]', array(
			'type'    => 'select',
			'section' => 'site-404-page-section',
			'label'   => esc_html__( 'Template Style', 'augury' ),
			'choices' => array(
				'type1'  => esc_html__('Modern', 'augury'),
				'type2'  => esc_html__('Classic', 'augury'),
				'type4'  => esc_html__('Diamond', 'augury'),
				'type5'  => esc_html__('Shadow', 'augury'),
				'type6'  => esc_html__('Diamond Alt', 'augury'),
				'type7'  => esc_html__('Stack', 'augury'),
				'type8'  => esc_html__('Minimal', 'augury'),
			),
			'description' => esc_html__('Choose the style of not-found template page.', 'augury'),
		)
	));

/**
 * Option : Notfound Dark BG
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[notfound-darkbg]', array(
			'default'           => augury_get_option( 'notfound-darkbg' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[notfound-darkbg]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( '404 Dark BG', 'augury'),
				'description' => esc_html__('YES! to use dark bg notfound page for this site.', 'augury'),
				'section' => 'site-404-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Custom Page
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[notfound-pageid]', array(
			'default'           => augury_get_option( 'notfound-pageid' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[notfound-pageid]', array(
			'type'    => 'select',
			'section' => 'site-404-page-section',
			'label'   => esc_html__( 'Custom Page', 'augury' ),
			'choices' => augury_get_customizer_pages(),
			'description' => esc_html__('Choose the page for not-found content.', 'augury'),
		)
	));

/**
 * Option : 404 Background
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[notfound_background]', array(
			'default'           =>  '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_background_obj' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Background(
			$wp_customize, AUGURY_SETTINGS . '[notfound_background]', array(
				'type'    => 'dt-background',
				'section' => 'site-404-page-section',
				'label'   => esc_html__( 'Background', 'augury' ),
			)
		)		
	);

/**
 * Option : Custom Styles
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[notfound-bg-style]', array(
			'default'           => augury_get_option( 'notfound-bg-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[notfound-bg-style]', array(
				'type'    	  => 'textarea',
				'section'     => 'site-404-page-section',
				'label'       => esc_html__( 'Custom Inline Styles', 'augury' ),
				'description' => esc_html__('Paste custom CSS styles for not found page.', 'augury'),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'color:#ff00bb; text-align:left;', 'augury' ),
				),
			)
		)
	);