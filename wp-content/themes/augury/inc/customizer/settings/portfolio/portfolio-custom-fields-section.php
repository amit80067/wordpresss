<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Option : Custom Field 1
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-portfolio-custom-field-1]', array(
		'default'           => augury_get_option( 'dt-portfolio-custom-field-1' ),
		'type'              => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	)
);

$wp_customize->add_control(
	AUGURY_SETTINGS . '[dt-portfolio-custom-field-1]', array(
		'type'       => 'text',
		'section' 	 => 'portfolio-custom-fields-section',
		'label'      => esc_html__( 'Custom Field 1', 'augury' )
	)
);

/**
 * Divider : Separator 1
 */
$wp_customize->add_control(
	new Augury_Customize_Control_Separator(
		$wp_customize, AUGURY_SETTINGS . '[dt-portfolio-custom-field-separator1]', array(
			'type'     => 'dt-separator',
			'section'  => 'portfolio-custom-fields-section',
			'settings' => array()
		)
	)
);

/**
 * Option : Custom Field 2
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-portfolio-custom-field-2]', array(
		'default'           => augury_get_option( 'dt-portfolio-custom-field-2' ),
		'type'              => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	)
);

$wp_customize->add_control(
	AUGURY_SETTINGS . '[dt-portfolio-custom-field-2]', array(
		'type'       => 'text',
		'section' 	 => 'portfolio-custom-fields-section',
		'label'      => esc_html__( 'Custom Field 2', 'augury' )
	)
);

/**
 * Divider : Separator 2
 */
$wp_customize->add_control(
	new Augury_Customize_Control_Separator(
		$wp_customize, AUGURY_SETTINGS . '[dt-portfolio-custom-field-separator2]', array(
			'type'     => 'dt-separator',
			'section'  => 'portfolio-custom-fields-section',
			'settings' => array()
		)
	)
);

/**
 * Option : Custom Field 3
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-portfolio-custom-field-3]', array(
		'default'           => augury_get_option( 'dt-portfolio-custom-field-3' ),
		'type'              => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	)
);

$wp_customize->add_control(
	AUGURY_SETTINGS . '[dt-portfolio-custom-field-3]', array(
		'type'       => 'text',
		'section' 	 => 'portfolio-custom-fields-section',
		'label'      => esc_html__( 'Custom Field 3', 'augury' )
	)
);

/**
 * Divider : Separator 3
 */
$wp_customize->add_control(
	new Augury_Customize_Control_Separator(
		$wp_customize, AUGURY_SETTINGS . '[dt-portfolio-custom-field-separator3]', array(
			'type'     => 'dt-separator',
			'section'  => 'portfolio-custom-fields-section',
			'settings' => array()
		)
	)
);

/**
 * Option : Custom Field 4
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-portfolio-custom-field-4]', array(
		'default'           => augury_get_option( 'dt-portfolio-custom-field-4' ),
		'type'              => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	)
);

$wp_customize->add_control(
	AUGURY_SETTINGS . '[dt-portfolio-custom-field-4]', array(
		'type'       => 'text',
		'section' 	 => 'portfolio-custom-fields-section',
		'label'      => esc_html__( 'Custom Field 4', 'augury' )
	)
);

/**
 * Divider : Separator 4
 */
$wp_customize->add_control(
	new Augury_Customize_Control_Separator(
		$wp_customize, AUGURY_SETTINGS . '[dt-portfolio-custom-field-separator4]', array(
			'type'     => 'dt-separator',
			'section'  => 'portfolio-custom-fields-section',
			'settings' => array()
		)
	)
);

/**
 * Option : Custom Field 5
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-portfolio-custom-field-5]', array(
		'default'           => augury_get_option( 'dt-portfolio-custom-field-5' ),
		'type'              => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	)
);

$wp_customize->add_control(
	AUGURY_SETTINGS . '[dt-portfolio-custom-field-5]', array(
		'type'       => 'text',
		'section' 	 => 'portfolio-custom-fields-section',
		'label'      => esc_html__( 'Custom Field 5', 'augury' )
	)
);

/**
 * Divider : Separator 5
 */
$wp_customize->add_control(
	new Augury_Customize_Control_Separator(
		$wp_customize, AUGURY_SETTINGS . '[dt-portfolio-custom-field-separator5]', array(
			'type'     => 'dt-separator',
			'section'  => 'portfolio-custom-fields-section',
			'settings' => array()
		)
	)
);