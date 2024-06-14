<?php
/**
 * Additional JS Section
 */
	$wp_customize->add_section( 
		new Augury_WP_Customize_Section(
			$wp_customize,
			'additionaljs-section',
			array(
				'title'    => esc_html__('Additional JS', 'augury'),
				'priority' => 135
			)
		)
	);

		/**
		 * Option : Additional JS
		 */
			$wp_customize->add_setting(
				AUGURY_SETTINGS . '[additional-js]', array (
					'default'           => augury_get_option( 'additional-js' ),
					'type'              => 'option',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new Augury_Customize_Control(
					$wp_customize, AUGURY_SETTINGS . '[additional-js]', array (
						'type'    => 'textarea',
						'label'   => esc_html__( 'Additional JS', 'augury'),
						'description'   => esc_html__( 'Add your own JS code here to customize your theme.', 'augury'),
						'section' => 'additionaljs-section',
					)
				)
			);