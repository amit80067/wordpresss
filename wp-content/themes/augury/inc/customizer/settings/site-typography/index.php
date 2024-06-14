<?php
/**
 * Site Heading Tags Panel
 */
$wp_customize->add_panel( 
	new Augury_WP_Customize_Panel(
		$wp_customize,
		'site-typograpy-main-panel',
		array(
			'title'    => esc_html__('Site Typography', 'augury'),
			'priority' => 50
		)
	)
);

	/**
	 * Body & Content Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-body-section',
			array(
				'title'    => esc_html__('Body & Content', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 2,
			)
		)
	);

	require_once 'body.php';

	/**
	 * Menu Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-menu-section',
			array(
				'title'    => esc_html__('Menu', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 3,
			)
		)
	);

	require_once 'dt-menu.php';
	

	/**
	 * H1 Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-h1-section',
			array(
				'title'    => esc_html__('H1', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 5,
			)
		)
	);

	require_once 'h1.php';

	/**
	 * H2 Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-h2-section',
			array(
				'title'    => esc_html__('H2', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 10,
			)
		)
	);

	require_once 'h2.php';

	/**
	 * H3 Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-h3-section',
			array(
				'title'    => esc_html__('H3', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 15,
			)
		)
	);

	require_once 'h3.php';

	/**
	 * H4 Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-h4-section',
			array(
				'title'    => esc_html__('H4', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 20,
			)
		)
	);

	require_once 'h4.php';

	/**
	 * H5 Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-h5-section',
			array(
				'title'    => esc_html__('H5', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 25,
			)
		)
	);

	require_once 'h5.php';

	/**
	 * H6 Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-h6-section',
			array(
				'title'    => esc_html__('H6', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 30,
			)
		)
	);

	require_once 'h6.php';

	/**
	 * Extra Section 
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-extra-font-section',
			array(
				'title'    => esc_html__('Extra', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 35,
			)
		)
	);

	require_once 'extra.php';

	/**
	 * Footer Panel 
	 */
	$wp_customize->add_panel( 
		new Augury_WP_Customize_Panel(
			$wp_customize,
			'site-footer-main-panel',
			array(
				'title'    => esc_html__('Footer', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 40
			)
		)
	);

	require_once 'footer-title.php';
	require_once 'footer-content.php';

	/**
	 * Custom Fonts
	 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'site-custom-font-main-panel',
			array(
				'title'    => esc_html__('Custom Fonts', 'augury'),
				'panel'    => 'site-typograpy-main-panel',
				'priority' => 45
			)
		)
	);

	require_once 'custom-fonts.php';