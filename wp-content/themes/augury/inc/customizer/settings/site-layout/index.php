<?php
/**
 * Site Layout Main Section
 */
$wp_customize->add_section( 
	new Augury_WP_Customize_Section(
		$wp_customize,
		'site-layout-main-section',
		array(
			'title'    => esc_html__('Site Layout', 'augury'),
			'priority' => 25,
		)
	)
);

/**
 * Option : Site Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[site-layout]', array(
			'default'           => augury_get_option( 'site-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[site-layout]', array(
				'type'    => 'select',
				'section' => 'site-layout-main-section',
				'label'   => esc_html__( 'Site Layout', 'augury' ),
				'choices' => array(
					'boxed' => esc_html__( 'Boxed', 'augury'),
					'wide'  => esc_html__( 'Wide', 'augury'),
				)
			)
		)
	);

/**
 * Option : Customize Boxed Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[site-boxed-layout]', array(
			'default'           => augury_get_option( 'site-boxed-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[site-boxed-layout]', array(
				'type'       => 'dt-switch',
				'label'      => esc_html__( 'Customize Boxed Layout?', 'augury'),
				'section'    => 'site-layout-main-section',
				'dependency' => array( 'site-layout', '==', 'boxed' ),
				'choices'    => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Customize Boxed Layout
 */	
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[site-bg]', array(
			'default'           =>  '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_background_obj' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Background(
			$wp_customize, AUGURY_SETTINGS . '[site-bg]', array(
				'type'       => 'dt-background',
				'section'    => 'site-layout-main-section',
				'dependency' => array( 'site-layout|site-boxed-layout', '==|==', 'boxed|true' ),
				'label'      => esc_html__( 'Background', 'augury' ),
			)
		)		
	);