<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default Settings
 */
$wp_customize->add_section( 
	new Augury_WP_Customize_Section(
		$wp_customize,
		'woocommerce-product-single-page-default-section',
		array(
			'title'    => esc_html__('Default Settings', 'augury'),
			'panel'    => 'woocommerce-product-single-page-section',
			'priority' => 25,
		)
	)
);
	
	/**
	 * Option : Product Template
	 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-default-template]', array(
			'default'           => augury_get_option( 'dt-single-product-default-template' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[dt-single-product-default-template]', array(
			'type'     => 'select',
			'label'    => esc_html__( 'Product Template', 'augury'),
			'section'  => 'woocommerce-product-single-page-default-section',
			'choices'  => apply_filters( 'augury_shop_page_widgetareas', array(
							'woo-default'     => esc_html__( 'WooCommerce Default', 'augury' ),
							'custom-template' => esc_html__( 'Custom Template', 'augury' )
						) )
		)
	);

	/**
	* Option : Enable Sale Countdown Timer
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-sale-countdown-timer]', array(
			'default'           => augury_get_option( 'dt-single-product-sale-countdown-timer' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-sale-countdown-timer]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Sale Countdown Timer', 'augury'),
				'section' => 'woocommerce-product-single-page-default-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

	/**
	* Option : Enable Size Guide Button
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-enable-size-guide]', array(
			'default'           => augury_get_option( 'dt-single-product-enable-size-guide' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-enable-size-guide]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Size Guide Button', 'augury'),
				'section' => 'woocommerce-product-single-page-default-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

	/**
	* Option : Enable Ajax Add To Cart
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-enable-ajax-addtocart]', array(
			'default'           => augury_get_option( 'dt-single-product-enable-ajax-addtocart' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-enable-ajax-addtocart]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Ajax Add To Cart', 'augury'),
				'section' => 'woocommerce-product-single-page-default-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

	/**
	* Option : Enable Breadcrumb
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-enable-breadcrumb]', array(
			'default'           => augury_get_option( 'dt-single-product-enable-breadcrumb' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-enable-breadcrumb]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Breadcrumb', 'augury'),
				'section' => 'woocommerce-product-single-page-default-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

	/**
	* Option : Sticky Add to Cart
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-addtocart-sticky]', array(
			'default'           => augury_get_option( 'dt-single-product-addtocart-sticky' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-addtocart-sticky]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Sticky Add to Cart', 'augury'),
				'section' => 'woocommerce-product-single-page-default-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

	/**
	* Option : Show Product 360 Viewer
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-360-viewer]', array(
			'default'           => augury_get_option( 'dt-single-product-show-360-viewer' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-360-viewer]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Product 360 Viewer', 'augury'),
				'section' => 'woocommerce-product-single-page-default-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'description'   => esc_html__('This option is applicable only for "WooCommerce Default" single page.', 'augury'),
			)
		)
	);