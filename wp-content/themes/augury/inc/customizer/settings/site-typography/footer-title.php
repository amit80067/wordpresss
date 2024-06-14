<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	/**
	 * Footer Title Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-footer-title-section',
			array(
				'title'    => esc_html__('Title', 'augury'),
				'panel'    => 'site-footer-main-panel',
			)
		)
	);
	
	/**
	 * Option :Footer Title Typo
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[footer-title-typo]', array(
				'default'           =>  augury_get_option( 'footer-title-typo' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
			)
		);

		$wp_customize->add_control(
			new Augury_Customize_Control_Typography(
				$wp_customize, AUGURY_SETTINGS . '[footer-title-typo]', array(
					'type'    => 'dt-typography',
					'section' => 'site-footer-title-section',
					'label'   => esc_html__( 'Typography', 'augury'),
				)
			)
		);

	/**
	 * Option : Footer Title Color
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[footer-title-color]', array(
				'default'           => augury_get_option( 'footer-title-color' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, AUGURY_SETTINGS . '[footer-title-color]', array(
					'label'   => esc_html__( 'Color', 'augury' ),
					'section' => 'site-footer-title-section',
				)
			)
		);