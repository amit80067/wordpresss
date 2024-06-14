<?php
/**
 * Site General Section
 */
$wp_customize->add_section( 
	new Augury_WP_Customize_Section(
		$wp_customize,
		'site-general-section',
		array(
			'title'    => esc_html__('Site General', 'augury'),
			'priority' => 1
		)
	)
);

	/**
	 * Option : Custom Header
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[site-custom-header]', array(
				'default'           => augury_get_option( 'site-custom-header' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
			)
		);

		$wp_customize->add_control( new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[site-custom-header]', array(
				'type'    => 'select',
				'section' => 'site-general-section',
				'label'   => esc_html__( 'Site Header', 'augury' ),
				'choices' => augury_get_customizer_cpt_post_list( 'dt_headers', esc_html__('Select Header', 'augury' ) ),
				'description' => esc_html__('Choose the header for your site.', 'augury'),
			)
		));

	/**
	 * Option : Custom Footer
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[site-custom-footer]', array(
				'default'           => augury_get_option( 'site-custom-footer' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
			)
		);

		$wp_customize->add_control( new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[site-custom-footer]', array(
				'type'    => 'select',
				'section' => 'site-general-section',
				'label'   => esc_html__( 'Site Footer', 'augury' ),
				'choices' => augury_get_customizer_cpt_post_list( 'dt_footers', esc_html__('Select Footer', 'augury' ) ),
				'description' => esc_html__('Choose the footer for your site.', 'augury'),
			)
		));

		/**
		* Option : Enable Light Version
		*/
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[enable-light-version]', array(
				'default'           => augury_get_option( 'enable-light-version' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
			)
		);

		$wp_customize->add_control(
			new Augury_Customize_Control_Switch(
				$wp_customize, AUGURY_SETTINGS . '[enable-light-version]', array(
					'type'    => 'dt-switch',
					'label'   => esc_html__( 'Enable Light Version', 'augury'),
					'section' => 'site-general-section',
					'choices' => array(
						'on'  => esc_attr__( 'Yes', 'augury' ),
						'off' => esc_attr__( 'No', 'augury' )
					)
				)
			)
		);

	/**
	 * Option : Show Loader
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[show-loader]', array(
				'default'           => augury_get_option( 'show-loader' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
			)
		);

		$wp_customize->add_control(
			new Augury_Customize_Control_Switch(
				$wp_customize, AUGURY_SETTINGS . '[show-loader]', array(
					'type'    => 'dt-switch',
					'label'   => esc_html__( 'Site Loader', 'augury'),
					'section' => 'site-general-section',
					'choices' => array(
						'on'  => esc_attr__( 'Yes', 'augury' ),
						'off' => esc_attr__( 'No', 'augury' )
					)
				)
			)
		);

	/**
	 * Option : Show Page Comments
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[show-pagecomments]', array(
				'default'           => augury_get_option( 'show-pagecomments' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
			)
		);

		$wp_customize->add_control(
			new Augury_Customize_Control_Switch(
				$wp_customize, AUGURY_SETTINGS . '[show-pagecomments]', array(
					'type'        => 'dt-switch',
					'label'       => esc_html__( 'Globally Show Page Comments', 'augury'),
					'section'     => 'site-general-section',
					'description' => esc_html__('YES! to show comments on all the pages. This will globally override your "Allow comments" option under your page "Discussion" settings.', 'augury'),
					'choices'     => array(
						'on'  => esc_attr__( 'Yes', 'augury' ),
						'off' => esc_attr__( 'No', 'augury' )
					)
				)
			)
		);

	/**
	 * Option : Show all Pages in Pagination
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[showall-pagination]', array(
				'default'           => augury_get_option( 'showall-pagination' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),				
			)
		);

		$wp_customize->add_control(
			new Augury_Customize_Control_Switch(
				$wp_customize, AUGURY_SETTINGS . '[showall-pagination]', array(
					'type'        => 'dt-switch',
					'label'       => esc_html__( 'Show all pages in Pagination', 'augury'),
					'section'     => 'site-general-section',
					'description' => esc_html__('YES! to show all the pages instead of dots near the current page.', 'augury'),
					'choices'     => array(
						'on'  => esc_attr__( 'Yes', 'augury' ),
						'off' => esc_attr__( 'No', 'augury' )
					)
				)
			)
		);

	/**
	 * Option : Google Map Key
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[google-map-key]', array(
				'default'           => augury_get_option( 'google-map-key' ),
				'type'              => 'option',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);

		$wp_customize->add_control(
			AUGURY_SETTINGS . '[google-map-key]', array(
				'type'    	  => 'text',
				'section'     => 'site-general-section',
				'label'       => esc_html__( 'Google Map Key', 'augury' ),
				'description' => esc_html__('Put a valid google account api key here', 'augury'),
			)
		);

	/**
	 * Option : Mailchimp Key
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[mailchimp-key]', array(
				'default'           => augury_get_option( 'mailchimp-key' ),
				'type'              => 'option',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);

		$wp_customize->add_control(
			AUGURY_SETTINGS . '[mailchimp-key]', array(
				'type'    	  => 'text',
				'section'     => 'site-general-section',
				'label'       => esc_html__( 'Mailchimp Key', 'augury' ),
				'description' => esc_html__('Put a valid mailchimp account api key here', 'augury'),
			)
		);

	/**
	 * Option : Show To Top
	 */
		$wp_customize->add_setting(
			AUGURY_SETTINGS . '[show-to-top]', array(
				'default'           => augury_get_option( 'show-to-top' ),
				'type'              => 'option',
				'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
			)
		);

		$wp_customize->add_control(
			new Augury_Customize_Control_Switch(
				$wp_customize, AUGURY_SETTINGS . '[show-to-top]', array(
					'type'    => 'dt-switch',
					'label'   => esc_html__( 'Show To Top', 'augury'),
					'section' => 'site-general-section',
					'description' => esc_html__('YES! to enable to top for your site.', 'augury'),
					'choices' => array(
						'on'  => esc_attr__( 'Yes', 'augury' ),
						'off' => esc_attr__( 'No', 'augury' )
					)
				)
			)
		);	
		
		/**
	 * Option : Disable mouse animation
	 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[disable-mouse-animation]', array(
			'default'           => augury_get_option( 'disable-mouse-animation' ),
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[disable-mouse-animation]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Disable Mouse Animation', 'augury'),
				'section' => 'site-general-section',
				'description' => esc_html__('YES! to disable mouse animation.', 'augury'),
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);