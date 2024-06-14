<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Custom Font name:1
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[custom-font1-name]', array(
			'default'           => augury_get_option( 'custom-font1-name' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[custom-font1-name]', array(
				'type'    	  => 'text',
				'default' => ' ',
				'section'     => 'site-custom-font-main-panel',
				'label'       => esc_html__( 'Font Name', 'augury' ),
			)
		)
	);

/**
 * Option : Custom Font .woff
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[custom-font1-woff]', array(
			'default'           => augury_get_option( 'custom-font1-woff' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Upload(
			$wp_customize, AUGURY_SETTINGS . '[custom-font1-woff]', array(
				'type'    => 'dt-upload',
				'label'   => esc_html__( 'Upload File (*.woff)', 'augury'),
				'description' => esc_html__('You can upload custom font family (*.woff) file here.', 'augury'),
				'section' => 'site-custom-font-main-panel',
				'dependency' => array( 'custom-font1-name', '!=', '' ),
			)
		)
	);

/**
 * Option : Custom Font .woff2
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[custom-font1-woff2]', array(
			'default'           => augury_get_option( 'custom-font1-woff2' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Upload(
			$wp_customize, AUGURY_SETTINGS . '[custom-font1-woff2]', array(
				'type'    => 'dt-upload',
				'label'   => esc_html__( 'Upload File (*.woff2)', 'augury'),
				'description' => esc_html__('You can upload custom font family (*.woff2) file here.', 'augury'),
				'section' => 'site-custom-font-main-panel',
				'dependency' => array( 'custom-font1-name', '!=', '' ),
			)
		)
	);

/**
 * Divider : Custom Font:1 Bottom
 */
	$wp_customize->add_control(
		new Augury_Customize_Control_Separator(
			$wp_customize, AUGURY_SETTINGS . '[custom-font1-woff2-bottom-separator]', array(
				'type'     => 'dt-separator',
				'section'  => 'site-custom-font-main-panel',
				'settings' => array(),
			)
		)
	);

/**
 * Option : Custom Font name
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[custom-font2-name]', array(
			'default'           => augury_get_option( 'custom-font2-name' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[custom-font2-name]', array(
				'type'    	  => 'text',
				'section'     => 'site-custom-font-main-panel',
				'label'       => esc_html__( 'Font Name', 'augury' ),
			)
		)
	);

/**
 * Option : Custom Font .woff
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[custom-font2-woff]', array(
			'default'           => augury_get_option( 'custom-font2-woff' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Upload(
			$wp_customize, AUGURY_SETTINGS . '[custom-font2-woff]', array(
				'type'    => 'dt-upload',
				'label'   => esc_html__( 'Upload File (*.woff)', 'augury'),
				'description' => esc_html__('You can upload custom font family (*.woff) file here.', 'augury'),
				'section' => 'site-custom-font-main-panel',
				'dependency' => array( 'custom-font2-name', '!=', '' ),
			)
		)
	);

/**
 * Option : Custom Font .woff2
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[custom-font2-woff2]', array(
			'default'           => augury_get_option( 'custom-font2-woff2' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Upload(
			$wp_customize, AUGURY_SETTINGS . '[custom-font2-woff2]', array(
				'type'    => 'dt-upload',
				'label'   => esc_html__( 'Upload File (*.woff2)', 'augury'),
				'description' => esc_html__('You can upload custom font family (*.woff2) file here.', 'augury'),
				'section' => 'site-custom-font-main-panel',
				'dependency' => array( 'custom-font2-name', '!=', '' ),
			)
		)
	);