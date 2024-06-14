<?php
/**
 * Site Page Settings Main Panel
 */
$wp_customize->add_panel( 
	new Augury_WP_Customize_Panel(
		$wp_customize,
		'site-page-settings-main-panel',
		array(
			'title'    => esc_html__('All Page Settings', 'augury'),
			'priority' => 10
		)
	)
);

	/**
	 * Global Sidebar Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-global-sidebar-section',
			array(
				'title'    => esc_html__('Global Sidebar', 'augury'),
				'panel'    => 'site-page-settings-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'site-global-sidebar-section.php';

	/**
	 * Post Archives Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-post-archives-section',
			array(
				'title'    => esc_html__('Post Archives', 'augury'),
				'panel'    => 'site-page-settings-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'site-post-archives-section.php';

	/**
	 * Post Single Section
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-post-single-section',
			array(
				'title'    => esc_html__('Post Single', 'augury'),
				'panel'    => 'site-page-settings-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'site-post-single-section.php';

	/**
	 * 404 Page Section
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-404-page-section',
			array(
				'title'    => esc_html__('404 Page', 'augury'),
				'panel'    => 'site-page-settings-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'site-404-page-section.php';

	/**
	 * Coming Soon Section
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-comingsoon-page-section',
			array(
				'title'    => esc_html__('Under Construction Page', 'augury'),
				'panel'    => 'site-page-settings-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'site-comingsoon-page-section.php';