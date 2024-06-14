<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Option : Page Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[shop-page-layout]', array(
			'default'           => augury_get_option( 'shop-page-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Radio_Image(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-layout]', array(
				'type'     => 'dt-radio-image',
				'label'    => esc_html__( 'Layout', 'augury'),
				'section'  => 'woocommerce-shop-page-section',
				'choices'  => apply_filters( 'augury_shop_page_layout_options', array(
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
		AUGURY_SETTINGS . '[shop-page-show-standard-sidebar]', array(
			'default'           => augury_get_option( 'shop-page-show-standard-sidebar' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-show-standard-sidebar]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Standard Sidebar', 'augury'),
				'section' => 'woocommerce-shop-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array( 'shop-page-layout', 'any', 'with-left-sidebar,with-right-sidebar' )
			)
		)
	);

/**
 * Option : Widget Areas
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[shop-page-widgetareas]', array(
			'default'           => augury_get_option( 'shop-page-widgetareas' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[shop-page-widgetareas]', array(
			'type'     => 'select',
			'label'    => esc_html__( 'Choose Custom Widget Area', 'augury'),
			'section'  => 'woocommerce-shop-page-section',
			'choices'  => apply_filters( 'augury_shop_page_widgetareas', augury_customizer_custom_widgets() ),
			'dependency' => array( 'shop-page-layout', 'any', 'with-left-sidebar,with-right-sidebar' )
		)
	);

/**
 * Option : Products Per Page
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[shop-page-product-per-page]', array(
			'default'           => augury_get_option( 'shop-page-product-per-page' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[shop-page-product-per-page]', array(
			'type'       => 'number',
			'section'    => 'woocommerce-shop-page-section',
			'label'      => esc_html__( 'Products Per Page', 'augury' )
		)
	);


/**
 * Option : Product Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[shop-page-product-layout]', array(
			'default'           => augury_get_option( 'shop-page-product-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Radio_Image(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-product-layout]', array(
				'type'     => 'dt-radio-image',
				'label'    => esc_html__( 'Product Layout', 'augury'),
				'section'  => 'woocommerce-shop-page-section',
				'choices'  => apply_filters( 'augury_shop_product_layout_options', array(
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
		AUGURY_SETTINGS . '[shop-page-product-style-template]', array(
			'default'           => augury_get_option( 'shop-page-product-style-template' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-product-style-template]', array(
				'type'     => 'select',
				'label'    => esc_html__( 'Product Style Template', 'augury'),
				'section'  => 'woocommerce-shop-page-section',
				'choices'  => apply_filters( 'augury_shop_product_templates', augury_customizer_shop_product_templates() )
			)
		)
	);


/**
 * Option : Enable Breadcrumb
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[shop-page-enable-breadcrumb]', array(
			'default'           => augury_get_option( 'shop-page-enable-breadcrumb' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-enable-breadcrumb]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Breadcrumb', 'augury'),
				'section' => 'woocommerce-shop-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);


/**
 * Option : Bottom Hook
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[shop-page-bottom-hook]', array(
			'default'           => augury_get_option( 'shop-page-bottom-hook' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		AUGURY_SETTINGS . '[shop-page-bottom-hook]', array(
			'type'    => 'textarea',
			'label'   => esc_html__( 'Bottom Hook', 'augury'),
			'section' => 'woocommerce-shop-page-section'
		)
	);


/**
 * Divider : Separator
 */
	$wp_customize->add_control(
		new Augury_Customize_Control_Separator(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-separator1]', array(
				'type'     => 'dt-separator',
				'section'  => 'woocommerce-shop-page-section',
				'settings' => array()
			)
		)
	);


/**
 * Option : Show Sorter On Header
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[shop-page-show-sorter-on-header]', array(
			'default'           => augury_get_option( 'shop-page-show-sorter-on-header' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-show-sorter-on-header]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Sorter On Header', 'augury'),
				'section' => 'woocommerce-shop-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);


/**
 * Option : Sorter Header Elements
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[shop-page-sorter-header-elements]', array(
			'default'           => augury_get_option( 'shop-page-sorter-header-elements' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Sortable(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-sorter-header-elements]', array(
				'type'     => 'dt-sortable',
				'section'  => 'woocommerce-shop-page-section',
				'label'    => esc_html__( 'Sorter Header Elements', 'augury' ),
				'choices'  => array(
					'filter'               => esc_html__( 'Filter', 'augury' ),
					'result_count'         => esc_html__( 'Result Count', 'augury' ),
					'pagination'           => esc_html__( 'Pagination', 'augury' ),
					'display_mode'         => esc_html__( 'Display Mode', 'augury' ),
					'display_mode_options' => esc_html__( 'Display Mode Options', 'augury' ),
				)
			)
		)
	);


/**
 * Option : Show Sorter On Footer
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[shop-page-show-sorter-on-footer]', array(
			'default'           => augury_get_option( 'shop-page-show-sorter-on-footer' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-show-sorter-on-footer]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Sorter On Footer', 'augury'),
				'section' => 'woocommerce-shop-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);


/**
 * Option : Sorter Footer Elements
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[shop-page-sorter-footer-elements]', array(
			'default'           => augury_get_option( 'shop-page-sorter-footer-elements' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Sortable(
			$wp_customize, AUGURY_SETTINGS . '[shop-page-sorter-footer-elements]', array(
				'type'     => 'dt-sortable',
				'section'  => 'woocommerce-shop-page-section',
				'label'    => esc_html__( 'Sorter Footer Elements', 'augury' ),
				'choices'  => array(
					'filter'               => esc_html__( 'Filter', 'augury' ),
					'result_count'         => esc_html__( 'Result Count', 'augury' ),
					'pagination'           => esc_html__( 'Pagination', 'augury' ),
					'display_mode'         => esc_html__( 'Display Mode', 'augury' ),
					'display_mode_options' => esc_html__( 'Display Mode Options', 'augury' ),
				)
			)
		)
	);