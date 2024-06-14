<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Related Settings
 */
$wp_customize->add_section( 
	new Augury_WP_Customize_Section(
		$wp_customize,
		'woocommerce-product-single-page-related-section',
		array(
			'title'    => esc_html__('Related Settings', 'augury'),
			'panel'    => 'woocommerce-product-single-page-section',
			'priority' => 35,
		)
	)
);
	

	/**
	* Option : Show Related Products
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-default-show-related]', array(
			'default'           => augury_get_option( 'dt-single-product-default-show-related' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-default-show-related]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Related Products', 'augury'),
				'section' => 'woocommerce-product-single-page-related-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

	/**
	 * Option : Related Title
	 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-related-title]', array(
			'default'           => augury_get_option( 'dt-single-product-related-title' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[dt-single-product-related-title]', array(
			'type'       => 'text',
			'section'    => 'woocommerce-product-single-page-related-section',
			'label'      => esc_html__( 'Related Title', 'augury' )
		)
	);

	/**
	 * Option : Related Column
	 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-related-column]', array(
			'default'           => augury_get_option( 'dt-single-product-related-column' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Radio_Image(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-related-column]', array(
				'type'     => 'dt-radio-image',
				'label'    => esc_html__( 'Related Column', 'augury'),
				'section'  => 'woocommerce-product-single-page-related-section',
				'choices'  => apply_filters( 'augury_single_product_related_column_options', array(
					1  => array( 'label' => esc_html__( 'One Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-column.png' ),
					2 => array( 'label' => esc_html__( 'One Half Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-half-column.png' ),
					3 => array( 'label' => esc_html__( 'One Third Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-third-column.png' ),
					4 => array( 'label' => esc_html__( 'One Fourth Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-fourth-column.png' ),
				) )
			)
		)
	);

	/**
	* Option : Related Limit
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-related-limit]', array(
			'default'           => augury_get_option( 'dt-single-product-related-limit' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-related-limit]', array(
				'type'     => 'select',
				'label'    => esc_html__( 'Related Limit', 'augury'),
				'section'  => 'woocommerce-product-single-page-related-section',
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
		AUGURY_SETTINGS . '[dt-single-product-related-style-template]', array(
			'default'           => augury_get_option( 'dt-single-product-related-style-template' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-related-style-template]', array(
				'type'     => 'select',
				'label'    => esc_html__( 'Product Style Template', 'augury'),
				'section'  => 'woocommerce-product-single-page-related-section',
				'choices'  => apply_filters( 'augury_shop_product_templates', augury_customizer_shop_product_templates() )
			)
		)
	);