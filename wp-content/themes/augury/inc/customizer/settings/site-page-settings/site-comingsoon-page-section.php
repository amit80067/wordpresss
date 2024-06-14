<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Enable Coming Soon
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-comingsoon]', array(
			'default'           => augury_get_option( 'enable-comingsoon' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-comingsoon]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Coming Soon', 'augury'),
				'description' => esc_html__('YES! to check under construction page of your website.', 'augury'),
				'section' => 'site-comingsoon-page-section',
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
		AUGURY_SETTINGS . '[comingsoon-style]', array(
			'default'           => augury_get_option( 'comingsoon-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[comingsoon-style]', array(
			'type'    => 'select',
			'section' => 'site-comingsoon-page-section',
			'label'   => esc_html__( 'Template Style', 'augury' ),
			'choices' => array(
				'type1'  => esc_html__('Diamond', 'augury'),
				'type2'  => esc_html__('Teaser', 'augury'),
				'type3'  => esc_html__('Minimal', 'augury'),
				'type4'  => esc_html__('Counter Only', 'augury'),
				'type5'  => esc_html__('Belt', 'augury'),
				'type6'  => esc_html__('Classic', 'augury'),
				'type7'  => esc_html__('Boxed', 'augury')
			),
			'description' => esc_html__('Choose the style of coming soon template.', 'augury'),
		)
	));

/**
 * Option : Comingsoon Dark BG
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[uc-darkbg]', array(
			'default'           => augury_get_option( 'uc-darkbg' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[uc-darkbg]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Coming Soon Dark BG', 'augury'),
				'description' => esc_html__('YES! to use dark bg coming soon page for this site.', 'augury'),
				'section' => 'site-comingsoon-page-section',
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
		AUGURY_SETTINGS . '[comingsoon-pageid]', array(
			'default'           => augury_get_option( 'comingsoon-pageid' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[comingsoon-pageid]', array(
			'type'    => 'select',
			'section' => 'site-comingsoon-page-section',
			'label'   => esc_html__( 'Custom Page', 'augury' ),
			'choices' => augury_get_customizer_pages(),
			'description' => esc_html__('Choose the page for comingsoon content.', 'augury'),
		)
	));

/**
 * Option : Show Launch Date
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[show-launchdate]', array(
			'default'           => augury_get_option( 'show-launchdate' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[show-launchdate]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Launch Date', 'augury'),
				'description' => esc_html__('YES! to show launch date text.', 'augury'),
				'section' => 'site-comingsoon-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Launch Date
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[comingsoon-launchdate]', array(
			'default'           => augury_get_option( 'comingsoon-launchdate' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[comingsoon-launchdate]', array(
				'type'    	  => 'text',
				'section'     => 'site-comingsoon-page-section',
				'label'       => esc_html__( 'Launch Date', 'augury' ),
				'input_attrs' => array(
					'placeholder' => '10/30/2016 12:00:00',
				),
				'description' => esc_html__('Put Format: 12/30/2016 12:00:00 month/day/year hour:minute:second', 'augury'),
			)
		)
	);

/**
 * Option : Timezone
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[comingsoon-timezone]', array(
			'default'           => augury_get_option( 'comingsoon-timezone' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[comingsoon-timezone]', array(
			'type'    => 'select',
			'section' => 'site-comingsoon-page-section',
			'label'   => esc_html__( 'UTC Timezone', 'augury' ),
			'choices' => array(
				'-12' => '-12', '-11' => '-11', '-10' => '-10', '-9' => '-9', '-8' => '-8', '-7' => '-7', '-6' => '-6', '-5' => '-5', 
				'-4' => '-4', '-3' => '-3', '-2' => '-2', '-1' => '-1', '0' => '0', '+1' => '+1', '+2' => '+2', '+3' => '+3', '+4' => '+4',
				'+5' => '+5', '+6' => '+6', '+7' => '+7', '+8' => '+8', '+9' => '+9', '+10' => '+10', '+11' => '+11', '+12' => '+12'
			),
			'description' => esc_html__('Choose utc timezone, by default UTC:00:00', 'augury'),
		)
	));

/**
 * Option : Comingsoon Background
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[comingsoon_background]', array(
			'default'           =>  '',
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_background_obj' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Background(
			$wp_customize, AUGURY_SETTINGS . '[comingsoon_background]', array(
				'type'    => 'dt-background',
				'section' => 'site-comingsoon-page-section',
				'label'   => esc_html__( 'Background', 'augury' ),
			)
		)		
	);

/**
 * Option : Custom Styles
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[comingsoon-bg-style]', array(
			'default'           => augury_get_option( 'comingsoon-bg-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[comingsoon-bg-style]', array(
				'type'    	  => 'textarea',
				'section'     => 'site-comingsoon-page-section',
				'label'       => esc_html__( 'Custom Inline Styles', 'augury' ),
				'description' => esc_html__('Paste custom CSS styles for under construction page.', 'augury'),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'color:#ff00bb; text-align:left;', 'augury' ),
				),
			)
		)
	);