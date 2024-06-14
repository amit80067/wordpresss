<?php
/**
 * Privacy & Cookies Main Panel
 */
$wp_customize->add_panel( 
	new Augury_WP_Customize_Panel(
		$wp_customize,
		'privacycookies-main-panel',
		array(
			'title'    => esc_html__('Privacy & Cookies', 'augury'),
			'priority' => 130
		)
	)
);



	/**
	 * Privacy Policy Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'privacy-policy-section',
			array(
				'title'    => esc_html__('Privacy Policy', 'augury'),
				'panel'    => 'privacycookies-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'privacy-policy-section.php';

	/**
	 * Cookie Consent Message Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'cookie-consent-section',
			array(
				'title'    => esc_html__('Cookie Consent Message', 'augury'),
				'panel'    => 'privacycookies-main-panel',
				'priority' => 10,
			)
		)
	);

	require_once 'cookie-consent-section.php';