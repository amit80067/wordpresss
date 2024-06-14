<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Page Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[portfolio-archives-page-layout]', array(
			'default'           => augury_get_option( 'portfolio-archives-page-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Radio_Image(
			$wp_customize, AUGURY_SETTINGS . '[portfolio-archives-page-layout]', array(
				'type'     => 'dt-radio-image',
				'label'    => esc_html__( 'Layout', 'augury'),
				'section'  => 'portfolio-archive-page-section',
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
		AUGURY_SETTINGS . '[portfolio-archives-show-standard-sidebar]', array(
			'default'           => augury_get_option( 'portfolio-archives-show-standard-sidebar' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[portfolio-archives-show-standard-sidebar]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Standard Sidebar', 'augury'),
				'section' => 'portfolio-archive-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array( 'portfolio-archives-page-layout', 'any', 'with-left-sidebar,with-right-sidebar' )
			)
		)
	);


/**
 * Option : Product Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[portfolio-archives-post-layout]', array(
			'default'           => augury_get_option( 'portfolio-archives-post-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Radio_Image(
			$wp_customize, AUGURY_SETTINGS . '[portfolio-archives-post-layout]', array(
				'type'     => 'dt-radio-image',
				'label'    => esc_html__( 'Post Layout', 'augury'),
				'section'  => 'portfolio-archive-page-section',
				'choices'  => apply_filters( 'augury_portfolio_archives_post_layout_options', array(
					'dtportfolio-one-column'  => array( 'label' => esc_html__( 'One Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/portfolio/one-column.png' ),
					'dtportfolio-one-half-column' => array( 'label' => esc_html__( 'One Half Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/portfolio/one-half-column.png' ),
					'dtportfolio-one-third-column' => array( 'label' => esc_html__( 'One Third Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/portfolio/one-third-column.png' ),
					'dtportfolio-one-fourth-column' => array( 'label' => esc_html__( 'One Fourth Column', 'augury' ), 'path' => AUGURY_URI . '/inc/customizer/assets/images/portfolio/one-fourth-column.png' ),
				) )
			)
		)
	);

/**
 * Option : Hover Style
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[portfolio-hover-style]', array(
			'default'           => augury_get_option( 'portfolio-hover-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[portfolio-hover-style]', array (
				'type'     => 'select',
				'label'    => esc_html__( 'Hover Style', 'augury'),
				'section'  => 'portfolio-archive-page-section',
				'choices'  => apply_filters( 'augury_portfolio_hover_styles', array (
					''                    => esc_html__('Default','augury'), 
					'modern-title'        => esc_html__('Modern Title','augury'), 
					'title-icons-overlay' => esc_html__('Title & Icons Overlay','augury'), 
					'title-overlay'       => esc_html__('Title Overlay','augury'),
					'icons-only'          => esc_html__('Icons Only','augury'), 
					'classic'             => esc_html__('Classic','augury'), 
					'minimal-icons'       => esc_html__('Minimal Icons','augury'),
					'presentation'        => esc_html__('Presentation','augury'), 
					'girly'               => esc_html__('Girly','augury'), 
					'art'                 => esc_html__('Art','augury'), 
					'extended'            => esc_html__('Extended','augury'), 
					'boxed'               => esc_html__('Boxed','augury'), 
					'centered-box'        => esc_html__('Centered Box','augury'),
					'with-gallery-thumb'  => esc_html__('With Gallery Thumb','augury'), 
					'with-gallery-list'   => esc_html__('With Gallery List','augury'), 
					'grayscale'           => esc_html__('Grayscale','augury'), 
					'highlighter'         => esc_html__('Highlighter','augury'), 
					'with-details'        => esc_html__('With Details','augury'), 
					'bottom-border'       => esc_html__('Bottom Border','augury'),
					'with-intro'          => esc_html__('With Intro','augury')
				) )
			)
		)
	);

/**
 * Option : Cursor Hover Style
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[portfolio-cursor-hover-style]', array(
			'default'           => augury_get_option( 'portfolio-cursor-hover-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[portfolio-cursor-hover-style]', array (
				'type'     => 'select',
				'label'    => esc_html__( 'Cursor Hover Style', 'augury'),
				'section'  => 'portfolio-archive-page-section',
				'choices'  => apply_filters( 'augury_portfolio_cursor_hover_styles', array (
					''                    => esc_html__('Default', 'augury'), 
					'cursor-hover-style1' => esc_html__('Style 1', 'augury'), 
					'cursor-hover-style2' => esc_html__('Style 2', 'augury') ,
					'cursor-hover-style3' => esc_html__('Style 3', 'augury'),
					'cursor-hover-style4' => esc_html__('Style 4', 'augury'),
					'cursor-hover-style5' => esc_html__('Style 5', 'augury'),
					'cursor-hover-style6' => esc_html__('Style 6', 'augury'), 
				) )
			)
		)
	);

/**
 * Option : Allow Grid Space
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[portfolio-grid-space]', array(
			'default'           => augury_get_option( 'portfolio-grid-space' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[portfolio-grid-space]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Allow Grid Space', 'augury'),
				'section' => 'portfolio-archive-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Allow Full Width
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[portfolio-allow-full-width]', array(
			'default'           => augury_get_option( 'portfolio-allow-full-width' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[portfolio-allow-full-width]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Allow Full Width', 'augury'),
				'section' => 'portfolio-archive-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Disable Individual Portfolio Item Options
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[portfolio-disable-item-options]', array(
			'default'           => augury_get_option( 'portfolio-disable-item-options' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[portfolio-disable-item-options]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Disable Individual Portfolio Item Options', 'augury'),
				'section' => 'portfolio-archive-page-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);