<?php
/**
 * Site Hooks Main Panel
 */
$wp_customize->add_panel( 
	new Augury_WP_Customize_Panel(
		$wp_customize,
		'site-hooks-main-panel',
		array(
			'title'    => esc_html__('Hooks', 'augury'),
			'priority' => 10
		)
	)
);

	/**
	 * Top Hook Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-top-hook-section',
			array(
				'title'    => esc_html__('Top Hook', 'augury'),
				'panel'    => 'site-hooks-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'site-top-hook-section.php';

	/**
	 * Content Before Hook Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-content-before-hook-section',
			array(
				'title'    => esc_html__('Content Before Hook', 'augury'),
				'panel'    => 'site-hooks-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'site-content-before-hook-section.php';

	/**
	 * Content After Hook Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-content-after-hook-section',
			array(
				'title'    => esc_html__('Content After Hook', 'augury'),
				'panel'    => 'site-hooks-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'site-content-after-hook-section.php';

	/**
	 * Bottom Hook Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-bottom-hook-section',
			array(
				'title'    => esc_html__('Bottom Hook', 'augury'),
				'panel'    => 'site-hooks-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'site-bottom-hook-section.php';

	/**
	 * Tracking Code Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-tracking-code-section',
			array(
				'title'    => esc_html__('Tracking Code', 'augury'),
				'panel'    => 'site-hooks-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'site-tracking-code-section.php';