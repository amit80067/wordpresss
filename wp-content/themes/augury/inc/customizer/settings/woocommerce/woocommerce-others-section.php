<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
* Option : Enable Plus / Minus Button - Quantity
*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-quantity-plusnminus]', array(
			'default'           => augury_get_option( 'dt-woo-quantity-plusnminus' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-woo-quantity-plusnminus]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Plus / Minus Button - Quantity', 'augury'),
				'section' => 'woocommerce-others-section',
				'choices' => array(
					'on'  => esc_html__( 'Yes', 'augury' ),
					'off' => esc_html__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Divider : Separator
 */
	$wp_customize->add_control(
		new Augury_Customize_Control_Separator(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-separator1]', array(
				'type'     => 'dt-separator',
				'section'  => 'woocommerce-others-section',
				'settings' => array()
			)
		)
	);

/**
 * Option : Add To Cart Custom Action
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-addtocart-custom-action]', array(
			'default'           => augury_get_option( 'dt-woo-addtocart-custom-action' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[dt-woo-addtocart-custom-action]', array(
				'type'     => 'select',
				'label'    => esc_html__( 'Add To Cart Custom Action', 'augury'),
				'section'  => 'woocommerce-others-section',
				'choices'  => apply_filters( 'augury_others_addtocart_custom_action', 
					array(
						''                    => esc_html__('None', 'augury'),
						'sidebar_widget'      => esc_html__('Sidebar Widget', 'augury'),
						'notification_widget' => esc_html__('Notification Widget', 'augury'),
					)
				)
			)
		)
	);

/**
 * Option : Cross Sell Product Column
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-cross-sell-column]', array(
			'default'           => augury_get_option( 'dt-woo-cross-sell-column' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Radio_Image(
			$wp_customize, AUGURY_SETTINGS . '[dt-woo-cross-sell-column]', array(
				'type'     => 'dt-radio-image',
				'label'    => esc_html__( 'Cross Sell Product Column', 'augury'),
				'section'  => 'woocommerce-others-section',
				'choices'  => apply_filters( 'augury_cross_sell_column_options', array(
					2 => array( 'label' => esc_html__( 'One Half Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-half-column.png' ),
					3 => array( 'label' => esc_html__( 'One Third Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-third-column.png' ),
					4 => array( 'label' => esc_html__( 'One Fourth Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-fourth-column.png' ),
				) )
			)
		)
	);

/**
 * Option : Cross Sell Title
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-cross-sell-title]', array(
			'default'           => augury_get_option( 'dt-woo-cross-sell-title' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[dt-woo-cross-sell-title]', array(
			'type'       => 'text',
			'section'    => 'woocommerce-others-section',
			'label'      => esc_html__( 'Cross Sell Title', 'augury' )
		)
	);

/**
 * Option : Product Style Template
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-cross-sell-style-template]', array(
			'default'           => augury_get_option( 'dt-woo-cross-sell-style-template' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[dt-woo-cross-sell-style-template]', array(
				'type'     => 'select',
				'label'    => esc_html__( 'Product Style Template', 'augury'),
				'section'  => 'woocommerce-others-section',
				'choices'  => apply_filters( 'augury_shop_product_templates', augury_customizer_shop_product_templates() )
			)
		)
	);	