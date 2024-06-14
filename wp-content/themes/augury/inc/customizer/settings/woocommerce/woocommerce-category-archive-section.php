<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Page Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-category-archive-layout]', array(
			'default'           => augury_get_option( 'dt-woo-category-archive-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Radio_Image(
			$wp_customize, AUGURY_SETTINGS . '[dt-woo-category-archive-layout]', array(
				'type'     => 'dt-radio-image',
				'label'    => esc_html__( 'Layout', 'augury'),
				'section'  => 'woocommerce-category-archive-section',
				'choices'  => apply_filters( 'augury_category_archive_layout_options', array(
					'content-full-width'  => array( 'label' => esc_html__( 'Without Sidebar', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/without-sidebar.png' ),
					'with-left-sidebar' => array( 'label' => esc_html__( 'Left Sidebar', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/left-sidebar.png' ),
					'with-right-sidebar' => array( 'label' => esc_html__( 'Right Sidebar', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/right-sidebar.png' ),
				) )
			)
		)
	);

/**
 * Option : Show Standard Sidebar
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-category-archive-show-standard-sidebar]', array(
			'default'           => augury_get_option( 'dt-woo-category-archive-show-standard-sidebar' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-woo-category-archive-show-standard-sidebar]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Standard Sidebar', 'augury'),
				'section' => 'woocommerce-category-archive-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array( 'dt-woo-category-archive-layout', 'any', 'with-left-sidebar,with-right-sidebar' )
			)
		)
	);

/**
 * Option : Widget Areas
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-category-archive-widgetareas]', array(
			'default'           => augury_get_option( 'dt-woo-category-archive-widgetareas' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[dt-woo-category-archive-widgetareas]', array(
			'type'     => 'select',
			'label'    => esc_html__( 'Choose Custom Widget Area', 'augury'),
			'section'  => 'woocommerce-category-archive-section',
			'choices'  => apply_filters( 'augury_category_archive_widgetareas', augury_customizer_custom_widgets() ),
			'dependency' => array( 'dt-woo-category-archive-layout', 'any', 'with-left-sidebar,with-right-sidebar' )
		)
	);

/**
 * Option : Products Per Page
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-category-archive-product-per-page]', array(
			'default'           => augury_get_option( 'dt-woo-category-archive-product-per-page' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[dt-woo-category-archive-product-per-page]', array(
			'type'       => 'number',
			'section'    => 'woocommerce-category-archive-section',
			'label'      => esc_html__( 'Products Per Page', 'augury' )
		)
	);


/**
 * Option : Product Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-category-archive-product-layout]', array(
			'default'           => augury_get_option( 'dt-woo-category-archive-product-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Radio_Image(
			$wp_customize, AUGURY_SETTINGS . '[dt-woo-category-archive-product-layout]', array(
				'type'     => 'dt-radio-image',
				'label'    => esc_html__( 'Product Layout', 'augury'),
				'section'  => 'woocommerce-category-archive-section',
				'choices'  => apply_filters( 'augury_category_archive_product_layout_options', array(
					1  => array( 'label' => esc_html__( 'One Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-column.png' ),
					2 => array( 'label' => esc_html__( 'One Half Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-half-column.png' ),
					3 => array( 'label' => esc_html__( 'One Third Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-third-column.png' ),
					4 => array( 'label' => esc_html__( 'One Fourth Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/woocommerce/one-fourth-column.png' ),
				) )
			)
		)
	);

/**
 * Option : Product Style Template
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-category-product-style-template]', array(
			'default'           => augury_get_option( 'dt-woo-category-product-style-template' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[dt-woo-category-product-style-template]', array(
				'type'     => 'select',
				'label'    => esc_html__( 'Product Style Template', 'augury'),
				'section'  => 'woocommerce-category-archive-section',
				'choices'  => apply_filters( 'augury_shop_product_templates', augury_customizer_shop_product_templates() )
			)
		)
	);

/**
 * Option : Enable Breadcrumb
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-woo-category-archive-enable-breadcrumb]', array(
			'default'           => augury_get_option( 'dt-woo-category-archive-enable-breadcrumb' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-woo-category-archive-enable-breadcrumb]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Breadcrumb', 'augury'),
				'section' => 'woocommerce-category-archive-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);