<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Global Sidebar Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[site-global-sidebar-layout]', array(
			'default'           => augury_get_option( 'site-global-sidebar-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

    $wp_customize->add_control( new Augury_Customize_Control_Radio_Image(
		$wp_customize, AUGURY_SETTINGS . '[site-global-sidebar-layout]', array(
			'type' => 'dt-radio-image',
			'label' => esc_html__( 'Global Sidebar Layout', 'augury'),
			'section' => 'site-global-sidebar-section',
			'choices' => apply_filters( 'augury_global_sidebar_layout_options', array(
				'content-full-width' => array(
					'label' => esc_html__( 'Without Sidebar', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/without-sidebar.png'
				),
				'with-left-sidebar' => array(
					'label' => esc_html__( 'Left Sidebar', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/left-sidebar.png'
				),
				'with-right-sidebar' => array(
					'label' => esc_html__( 'Right Sidebar', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/right-sidebar.png'
				),
				'with-both-sidebar' => array(
					'label' => esc_html__( 'Both Sidebar', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/both-sidebar.png'
				),
			)),
			'description' => esc_html__('Choose sidebar layout for site wide.', 'augury')
        )
    ));