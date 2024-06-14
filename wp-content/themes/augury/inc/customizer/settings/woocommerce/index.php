<?php
/**
 * WooCommerce Main Panel
 */
$wp_customize->add_panel( 
	new Augury_WP_Customize_Panel(
		$wp_customize,
		'woocommerce-main-panel',
		array(
			'title'    => sprintf(esc_html__('%1$s WooCommerce', 'augury'), AUGURY_NAME),
			'priority' => 120
		)
	)
);



	/**
	 * WooCommerce Shop Page Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'woocommerce-shop-page-section',
			array(
				'title'    => esc_html__('Shop Page', 'augury'),
				'panel'    => 'woocommerce-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'woocommerce-shop-page-section.php';

	/**
	 * WooCommerce Category Archive Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'woocommerce-category-archive-section',
			array(
				'title'    => esc_html__('Category Archive', 'augury'),
				'panel'    => 'woocommerce-main-panel',
				'priority' => 10,
			)
		)
	);

	require_once 'woocommerce-category-archive-section.php';

	/**
	 * WooCommerce Tag Archive Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'woocommerce-tag-archive-section',
			array(
				'title'    => esc_html__('Tag Archive', 'augury'),
				'panel'    => 'woocommerce-main-panel',
				'priority' => 15,
			)
		)
	);

	require_once 'woocommerce-tag-archive-section.php';

	/**
	 * WooCommerce Product Single Page
	 */
	$wp_customize->add_panel( 
		new Augury_WP_Customize_Panel(
			$wp_customize,
			'woocommerce-product-single-page-section',
			array(
				'title'    => esc_html__('Product Single Page', 'augury'),
				'panel'    => 'woocommerce-main-panel',
				'priority' => 20
			)
		)
	);

	require_once 'woocommerce-product-single-page-section-default.php';
	require_once 'woocommerce-product-single-page-section-upsell.php';
	require_once 'woocommerce-product-single-page-section-related.php';
	require_once 'woocommerce-product-single-page-section-sociables-share.php';
	require_once 'woocommerce-product-single-page-section-sociables-follow.php';


	/**
	 * WooCommerce Others
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'woocommerce-others-section',
			array(
				'title'    => esc_html__('Others', 'augury'),
				'panel'    => 'woocommerce-main-panel',
				'priority' => 25,
			)
		)
	);

	require_once 'woocommerce-others-section.php';	


	/**
	 * WooCommerce Size Guide
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'woocommerce-size-guide-section',
			array(
				'title'    => esc_html__('Size Guide', 'augury'),
				'panel'    => 'woocommerce-main-panel',
				'priority' => 30,
			)
		)
	);

	require_once 'woocommerce-size-guide-section.php';	