<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Footer Content Section 
 */
$wp_customize->add_section( 
	new Augury_WP_Customize_Section(
		$wp_customize,
		'site-footer-content-section',
		array(
			'title'    => esc_html__('Content', 'augury'),
			'panel'    => 'site-footer-main-panel',
		)
	)
);

	/**
	 * Option :Footer Content Typo
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[footer-content-typo]', array(
				'default'           =>  augury_get_option( 'footer-content-typo' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),				
			)
		);

		$wp_customize->add_control(
			new Augury_Customize_Control_Typography(
				$wp_customize, AUGURY_SETTINGS . '[footer-content-typo]', array(
					'type'    => 'dt-typography',
					'section' => 'site-footer-content-section',
					'label'   => esc_html__( 'Typography', 'augury'),
				)
			)
		);

	/**
	 * Option : Footer Content Color
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[footer-content-color]', array(
				'default'           => augury_get_option( 'footer-content-color' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, AUGURY_SETTINGS . '[footer-content-color]', array(
					'label'   => esc_html__( 'Color', 'augury' ),
					'section' => 'site-footer-content-section',
				)
			)
		);

	/**
	 * Option : Footer Content Anchor Color
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[footer-content-a-color]', array(
				'default'           => augury_get_option( 'footer-content-a-color' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, AUGURY_SETTINGS . '[footer-content-a-color]', array(
					'label'   => esc_html__( 'Anchor Color', 'augury' ),
					'section' => 'site-footer-content-section',
				)
			)
		);

	/**
	 * Option : Footer Content Anchor hover Color
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[footer-content-a-hover-color]', array(
				'default'           => augury_get_option( 'footer-content-a-hover-color' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_hex_color' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, AUGURY_SETTINGS . '[footer-content-a-hover-color]', array(
					'label'   => esc_html__( 'Anchor Hover Color', 'augury' ),
					'section' => 'site-footer-content-section',
				)
			)
		);