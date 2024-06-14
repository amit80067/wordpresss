<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Option : Size Guide Title 1
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-woo-size-guide-title-1]', array(
		'default'           => augury_get_option( 'dt-woo-size-guide-title-1' ),
		'type'              => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	)
);

$wp_customize->add_control(
	AUGURY_SETTINGS . '[dt-woo-size-guide-title-1]', array(
		'type'       => 'text',
		'section' 	 => 'woocommerce-size-guide-section',
		'label'      => esc_html__( 'Size Guide Title 1', 'augury' )
	)
);

/**
 * Option : Size Guide Content 1
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-woo-size-guide-content-1]', array(
		'default'           => augury_get_option( 'dt-woo-size-guide-content-1' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
	)
);

$wp_customize->add_control(
	new Augury_Customize_Control_Upload(
		$wp_customize, AUGURY_SETTINGS . '[dt-woo-size-guide-content-1]', array(
			'type'    => 'dt-upload',
			'label'   => esc_html__( 'Size Guide Content 1', 'augury'),
			'section' => 'woocommerce-size-guide-section',
		)
	)
);

/**
 * Divider : Separator 1
 */
$wp_customize->add_control(
	new Augury_Customize_Control_Separator(
		$wp_customize, AUGURY_SETTINGS . '[dt-woo-size-guide-separator1]', array(
			'type'     => 'dt-separator',
			'section'  => 'woocommerce-size-guide-section',
			'settings' => array()
		)
	)
);

/**
 * Option : Size Guide Title 2
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-woo-size-guide-title-2]', array(
		'default'           => augury_get_option( 'dt-woo-size-guide-title-2' ),
		'type'              => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	)
);

$wp_customize->add_control(
	AUGURY_SETTINGS . '[dt-woo-size-guide-title-2]', array(
		'type'       => 'text',
		'section' 	 => 'woocommerce-size-guide-section',
		'label'      => esc_html__( 'Size Guide Title 2', 'augury' )
	)
);

/**
 * Option : Size Guide Content 2
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-woo-size-guide-content-2]', array(
		'default'           => augury_get_option( 'dt-woo-size-guide-content-2' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
	)
);

$wp_customize->add_control(
	new Augury_Customize_Control_Upload(
		$wp_customize, AUGURY_SETTINGS . '[dt-woo-size-guide-content-2]', array(
			'type'    => 'dt-upload',
			'label'   => esc_html__( 'Size Guide Content 2', 'augury'),
			'section' => 'woocommerce-size-guide-section',
		)
	)
);

/**
 * Divider : Separator 2
 */
$wp_customize->add_control(
	new Augury_Customize_Control_Separator(
		$wp_customize, AUGURY_SETTINGS . '[dt-woo-size-guide-separator2]', array(
			'type'     => 'dt-separator',
			'section'  => 'woocommerce-size-guide-section',
			'settings' => array()
		)
	)
);

/**
 * Option : Size Guide Title 3
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-woo-size-guide-title-3]', array(
		'default'           => augury_get_option( 'dt-woo-size-guide-title-3' ),
		'type'              => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	)
);

$wp_customize->add_control(
	AUGURY_SETTINGS . '[dt-woo-size-guide-title-3]', array(
		'type'       => 'text',
		'section' 	 => 'woocommerce-size-guide-section',
		'label'      => esc_html__( 'Size Guide Title 3', 'augury' )
	)
);

/**
 * Option : Size Guide Content 3
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-woo-size-guide-content-3]', array(
		'default'           => augury_get_option( 'dt-woo-size-guide-content-3' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
	)
);

$wp_customize->add_control(
	new Augury_Customize_Control_Upload(
		$wp_customize, AUGURY_SETTINGS . '[dt-woo-size-guide-content-3]', array(
			'type'    => 'dt-upload',
			'label'   => esc_html__( 'Size Guide Content 3', 'augury'),
			'section' => 'woocommerce-size-guide-section',
		)
	)
);


/**
 * Divider : Separator 3
 */
$wp_customize->add_control(
	new Augury_Customize_Control_Separator(
		$wp_customize, AUGURY_SETTINGS . '[dt-woo-size-guide-separator3]', array(
			'type'     => 'dt-separator',
			'section'  => 'woocommerce-size-guide-section',
			'settings' => array()
		)
	)
);

/**
 * Option : Size Guide Title 4
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-woo-size-guide-title-4]', array(
		'default'           => augury_get_option( 'dt-woo-size-guide-title-4' ),
		'type'              => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	)
);

$wp_customize->add_control(
	AUGURY_SETTINGS . '[dt-woo-size-guide-title-4]', array(
		'type'       => 'text',
		'section' 	 => 'woocommerce-size-guide-section',
		'label'      => esc_html__( 'Size Guide Title 4', 'augury' )
	)
);

/**
 * Option : Size Guide Content 4
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-woo-size-guide-content-4]', array(
		'default'           => augury_get_option( 'dt-woo-size-guide-content-4' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
	)
);

$wp_customize->add_control(
	new Augury_Customize_Control_Upload(
		$wp_customize, AUGURY_SETTINGS . '[dt-woo-size-guide-content-4]', array(
			'type'    => 'dt-upload',
			'label'   => esc_html__( 'Size Guide Content 4', 'augury'),
			'section' => 'woocommerce-size-guide-section',
		)
	)
);

/**
 * Divider : Separator 4
 */
$wp_customize->add_control(
	new Augury_Customize_Control_Separator(
		$wp_customize, AUGURY_SETTINGS . '[dt-woo-size-guide-separator4]', array(
			'type'     => 'dt-separator',
			'section'  => 'woocommerce-size-guide-section',
			'settings' => array()
		)
	)
);

/**
 * Option : Size Guide Title 5
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-woo-size-guide-title-5]', array(
		'default'           => augury_get_option( 'dt-woo-size-guide-title-5' ),
		'type'              => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	)
);

$wp_customize->add_control(
	AUGURY_SETTINGS . '[dt-woo-size-guide-title-5]', array(
		'type'       => 'text',
		'section' 	 => 'woocommerce-size-guide-section',
		'label'      => esc_html__( 'Size Guide Title 5', 'augury' )
	)
);

/**
 * Option : Size Guide Content 5
 */
$wp_customize->add_setting(
	AUGURY_SETTINGS . '[dt-woo-size-guide-content-5]', array(
		'default'           => augury_get_option( 'dt-woo-size-guide-content-5' ),
		'type'              => 'option',
		'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
	)
);

$wp_customize->add_control(
	new Augury_Customize_Control_Upload(
		$wp_customize, AUGURY_SETTINGS . '[dt-woo-size-guide-content-5]', array(
			'type'    => 'dt-upload',
			'label'   => esc_html__( 'Size Guide Content 5', 'augury'),
			'section' => 'woocommerce-size-guide-section',
		)
	)
);