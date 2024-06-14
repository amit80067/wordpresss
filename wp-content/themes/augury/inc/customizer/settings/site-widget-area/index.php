<?php
/**
 * Site Widget Area Main Panel
 */
$wp_customize->add_panel( 
	new Augury_WP_Customize_Panel(
		$wp_customize,
		'site-widget-area-main-panel',
		array(
			'title'    => esc_html__('Site Widgets', 'augury'),
			'priority' => 100
		)
	)
);
	/**
	 * Settings Panel
	 */
	$wp_customize->add_panel( 
		new Augury_WP_Customize_Panel(
			$wp_customize,
			'site-widgets-settings-panel',
			array(
				'title'    => esc_html__('Settings', 'augury'),
				'panel'    => 'site-widget-area-main-panel',
				'priority' => 10,
			)
		)
	);

		/**
		 * Site Widgets Title Section 
		 */
		$wp_customize->add_section( 
			new Augury_WP_Customize_Section(
				$wp_customize,
				'site-widgets-title-section',
				array(
					'title'    => esc_html__('Widget Style', 'augury'),
					'panel'    => 'site-widgets-settings-panel',
					'priority' => 5,
				)
			)
		);

		require_once 'site-widget-title-section.php';

		/**
		 * Site Widgets Content Section 
		 */
		$wp_customize->add_section( 
			new Augury_WP_Customize_Section(
				$wp_customize,
				'site-widgets-content-section',
				array(
					'title'    => esc_html__('Widget Content', 'augury'),
					'panel'    => 'site-widgets-settings-panel',
					'priority' => 10,
				)
			)
		);

		require_once 'site-widget-content-section.php';

	/**
	 * Default Widget Areas
	 */
	$wp_customize->add_panel( 
		new Augury_WP_Customize_Panel(
			$wp_customize,
			'widgets',
			array(
				'title'       => esc_html__('Widget Areas', 'augury'),
				'panel'       => 'site-widget-area-main-panel',
				'description' => esc_html__( 'Widgets are independent sections of content that can be placed into widgetized areas provided by your theme (commonly lled sidebars).', 'augury' ),
				'priority'    => 15,
			)
		)
	);			