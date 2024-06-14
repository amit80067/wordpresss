<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sociable Share Settings
 */
$wp_customize->add_section( 
	new Augury_WP_Customize_Section(
		$wp_customize,
		'woocommerce-product-single-page-sociables-share-section',
		array(
			'title'    => esc_html__('Sociable Share Settings', 'augury'),
			'panel'    => 'woocommerce-product-single-page-section',
			'priority' => 40,
		)
	)
);
	
	/**
	* Option : Sharer Description
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-sharer-description]', array(
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-sharer-description]', array(
				'type'    => 'dt-description',
				'label'   => esc_html__( 'Note :', 'augury'),
				'section' => 'woocommerce-product-single-page-sociables-share-section',
				'description'   => esc_html__( 'This option is applicable only for WooCommerce "Custom Template".', 'augury'),
			)
		)
	);

	/**
	* Option : Show Facebook Sharer
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-sharer-facebook]', array(
			'default'           => augury_get_option( 'dt-single-product-show-sharer-facebook' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-sharer-facebook]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Facebook Sharer', 'augury'),
				'section' => 'woocommerce-product-single-page-sociables-share-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);
	
	/**
	* Option : Show Delicious Sharer
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-sharer-delicious]', array(
			'default'           => augury_get_option( 'dt-single-product-show-sharer-delicious' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-sharer-delicious]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Delicious Sharer', 'augury'),
				'section' => 'woocommerce-product-single-page-sociables-share-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);
	
	/**
	* Option : Show Digg Sharer
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-sharer-digg]', array(
			'default'           => augury_get_option( 'dt-single-product-show-sharer-digg' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-sharer-digg]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Digg Sharer', 'augury'),
				'section' => 'woocommerce-product-single-page-sociables-share-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);
	
	/**
	* Option : Show Stumble Upon Sharer
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-sharer-stumbleupon]', array(
			'default'           => augury_get_option( 'dt-single-product-show-sharer-stumbleupon' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-sharer-stumbleupon]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Stumble Upon Sharer', 'augury'),
				'section' => 'woocommerce-product-single-page-sociables-share-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);
	
	/**
	* Option : Show Twitter Sharer
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-sharer-twitter]', array(
			'default'           => augury_get_option( 'dt-single-product-show-sharer-twitter' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-sharer-twitter]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Twitter Sharer', 'augury'),
				'section' => 'woocommerce-product-single-page-sociables-share-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);
	
	/**
	* Option : Show Google Plus Sharer
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-sharer-googleplus]', array(
			'default'           => augury_get_option( 'dt-single-product-show-sharer-googleplus' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-sharer-googleplus]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Google Plus Sharer', 'augury'),
				'section' => 'woocommerce-product-single-page-sociables-share-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);
	
	/**
	* Option : Show LinkedIn Sharer
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-sharer-linkedin]', array(
			'default'           => augury_get_option( 'dt-single-product-show-sharer-linkedin' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-sharer-linkedin]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show LinkedIn Sharer', 'augury'),
				'section' => 'woocommerce-product-single-page-sociables-share-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);
	
	/**
	* Option : Show Pinterest Sharer
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-sharer-pinterest]', array(
			'default'           => augury_get_option( 'dt-single-product-show-sharer-pinterest' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-sharer-pinterest]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Pinterest Sharer', 'augury'),
				'section' => 'woocommerce-product-single-page-sociables-share-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);