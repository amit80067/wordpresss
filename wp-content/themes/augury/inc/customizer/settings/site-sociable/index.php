<?php
/**
 * Site Sociable Main Section
 */
$wp_customize->add_section( 
	new Augury_WP_Customize_Section(
		$wp_customize,
		'site-sociable-main-section',
		array(
			'title'    => esc_html__('Sociable', 'augury'),
			'priority' => 10
		)
	)
);

/**
 * Option : Delicious
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-delicious]', array(
			'default'           => augury_get_option( 'sociable-delicious' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-delicious]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Delicious', 'augury' ),
				'description' => esc_html__('Put sociable url, wants to show on front-end.', 'augury'),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Delicious', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Deviantart
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-deviantart]', array(
			'default'           => augury_get_option( 'sociable-deviantart' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-deviantart]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Deviantart', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Deviantart', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Digg
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-digg]', array(
			'default'           => augury_get_option( 'sociable-digg' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-digg]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Digg', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Digg', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Dribbble
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-dribbble]', array(
			'default'           => augury_get_option( 'sociable-dribbble' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-dribbble]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Dribbble', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Dribbble', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Envelope
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-envelope]', array(
			'default'           => augury_get_option( 'sociable-envelope' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-envelope]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Envelope', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Envelope', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Facebook
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-facebook]', array(
			'default'           => augury_get_option( 'sociable-facebook' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-facebook]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Facebook', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Facebook', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Flickr
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-flickr]', array(
			'default'           => augury_get_option( 'sociable-flickr' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-flickr]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Flickr', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Flickr', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Google Plus
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-google-plus]', array(
			'default'           => augury_get_option( 'sociable-google-plus' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-google-plus]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Google Plus', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Google Plus', 'augury' ),
				),
			)
		)
	);

/**
 * Option : GTalk
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-gtalk]', array(
			'default'           => augury_get_option( 'sociable-gtalk' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-gtalk]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'GTalk', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'GTalk', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Instagram
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-instagram]', array(
			'default'           => augury_get_option( 'sociable-instagram' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-instagram]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Instagram', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Instagram', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Lastfm
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-lastfm]', array(
			'default'           => augury_get_option( 'sociable-lastfm' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-lastfm]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Lastfm', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Lastfm', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Linkedin
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-linkedin]', array(
			'default'           => augury_get_option( 'sociable-linkedin' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-linkedin]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Linkedin', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Linkedin', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Pinterest
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-pinterest]', array(
			'default'           => augury_get_option( 'sociable-pinterest' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-pinterest]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Pinterest', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Pinterest', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Reddit
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-reddit]', array(
			'default'           => augury_get_option( 'sociable-reddit' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-reddit]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Reddit', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Reddit', 'augury' ),
				),
			)
		)
	);

/**
 * Option : RSS
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-rss]', array(
			'default'           => augury_get_option( 'sociable-rss' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-rss]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'RSS', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'RSS', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Skype
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-skype]', array(
			'default'           => augury_get_option( 'sociable-skype' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-skype]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Skype', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Skype', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Stumbleupon
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-stumbleupon]', array(
			'default'           => augury_get_option( 'sociable-stumbleupon' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-stumbleupon]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Stumbleupon', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Stumbleupon', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Tumblr
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-tumblr]', array(
			'default'           => augury_get_option( 'sociable-tumblr' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-tumblr]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Tumblr', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Tumblr', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Twitter
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-twitter]', array(
			'default'           => augury_get_option( 'sociable-twitter' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-twitter]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Twitter', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Twitter', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Viadeo
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-viadeo]', array(
			'default'           => augury_get_option( 'sociable-viadeo' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-viadeo]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Viadeo', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Viadeo', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Vimeo
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-vimeo]', array(
			'default'           => augury_get_option( 'sociable-vimeo' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-vimeo]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Vimeo', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Vimeo', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Yahoo
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-yahoo]', array(
			'default'           => augury_get_option( 'sociable-yahoo' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-yahoo]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Yahoo', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Yahoo', 'augury' ),
				),
			)
		)
	);

/**
 * Option : Youtube
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[sociable-youtube]', array(
			'default'           => augury_get_option( 'sociable-youtube' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[sociable-youtube]', array(
				'type'    	  => 'text',
				'section'     => 'site-sociable-main-section',
//				'label'       => esc_html__( 'Youtube', 'augury' ),
				'input_attrs' => array(
					'placeholder' => esc_html__( 'Youtube', 'augury' ),
				),
			)
		)
	);