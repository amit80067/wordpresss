<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Upsell Settings
 */
$wp_customize->add_section( 
	new Augury_WP_Customize_Section(
		$wp_customize,
		'woocommerce-product-single-page-upsell-section',
		array(
			'title'    => esc_html__('Upsell Settings', 'augury'),
			'panel'    => 'woocommerce-product-single-page-section',
			'priority' => 30,
		)
	)
);
	

	/**
	* Option : Show Upsell Products
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-default-show-upsell]', array(
			'default'           => augury_get_option( 'dt-single-product-default-show-upsell' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-default-show-upsell]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Upsell Products', 'augury'),
				'section' => 'woocommerce-product-single-page-upsell-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

	/**
	 * Option : Upsell Title
	 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-upsell-title]', array(
			'default'           => augury_get_option( 'dt-single-product-upsell-title' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[dt-single-product-upsell-title]', array(
			'type'       => 'text',
			'section'    => 'woocommerce-product-single-page-upsell-section',
			'label'      => esc_html__( 'Upsell Title', 'augury' )
		)
	);

	/**
	 * Option : Upsell Column
	 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-upsell-column]', array(
			'default'           => augury_get_option( 'dt-single-product-upsell-column' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Radio_Image(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-upsell-column]', array(
				'type'     => 'dt-radio-image',
				'label'    => esc_html__( 'Upsell Column', 'augury'),
				'section'  => 'woocommerce-product-single-page-upsell-section',
				'choices'  => apply_filters( 'augury_single_product_upsell_column_options', array(
					1  => array( 'label' => esc_html__( 'One Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-column.png' ),
					2 => array( 'label' => esc_html__( 'One Half Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-half-column.png' ),
					3 => array( 'label' => esc_html__( 'One Third Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-third-column.png' ),
					4 => array( 'label' => esc_html__( 'One Fourth Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-fourth-column.png' ),
				) )
			)
		)
	);

	/**
	* Option : Upsell Limit
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-upsell-limit]', array(
			'default'           => augury_get_option( 'dt-single-product-upsell-limit' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-upsell-limit]', array(
				'type'     => 'select',
				'label'    => esc_html__( 'Upsell Limit', 'augury'),
				'section'  => 'woocommerce-product-single-page-upsell-section',
				'choices'  => array (
					1 => esc_html__( '1', 'augury' ),
					2 => esc_html__( '2', 'augury' ),
					3 => esc_html__( '3', 'augury' ),
					4 => esc_html__( '4', 'augury' ),
					5 => esc_html__( '5', 'augury' ),
					6 => esc_html__( '6', 'augury' ),
					7 => esc_html__( '7', 'augury' ),
					8 => esc_html__( '8', 'augury' ),	
					9 => esc_html__( '9', 'augury' ),
					10 => esc_html__( '10', 'augury' ),	
				)
			)
		)
	);

	/**
	 * Option : Product Style Template
	 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-upsell-style-template]', array(
			'default'           => augury_get_option( 'dt-single-product-upsell-style-template' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-upsell-style-template]', array(
				'type'     => 'select',
				'label'    => esc_html__( 'Product Style Template', 'augury'),
				'section'  => 'woocommerce-product-single-page-upsell-section',
				'choices'  => apply_filters( 'augury_shop_product_templates', augury_customizer_shop_product_templates() )
			)
		)
	);