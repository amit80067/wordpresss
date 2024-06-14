<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Option : Enable Cookie Consent
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-cookie-consent]', array (
			'default'           => augury_get_option( 'enable-cookie-consent' ),
			'type'              => 'option',
			'sanitize_callback' => array ( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-cookie-consent]', array (
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Cookie Message Bar', 'augury'),
				'description'   => esc_html__('Enable cookie consent message bar', 'augury'),
				'section' => 'cookie-consent-section',
				'choices' => array (
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
* Option : Cookie Consent Message
*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[cookie-consent-msg]', array (
			'default'           => augury_get_option( 'cookie-consent-msg' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[cookie-consent-msg]', array (
				'type'    => 'textarea',
				'label'   => esc_html__( 'Message', 'augury'),
				'description'   => esc_html__('Provide a message which indicates that your site uses cookies.', 'augury'),
				'section' => 'cookie-consent-section',
				'dependency' => array ( 'enable-cookie-consent', '==', '1' )
			)
		)
	);

/**
 * Option : Message Bar Position
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[cookie-bar-position]', array(
			'default'           => augury_get_option( 'cookie-bar-position' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[cookie-bar-position]', array(
				'type'     => 'select',
				'label'    => esc_html__( 'Message Bar Position', 'augury'),
				'section'  => 'cookie-consent-section',
				'choices'  => apply_filters( 'augury_others_addtocart_custom_action', 
					array(
						'top' 	        => esc_html__('Top', 'augury'),
						'bottom'       => esc_html__('Bottom', 'augury'),
						'top-left' 	   => esc_html__('Top Left Corner', 'augury'),
						'top-right' 	  => esc_html__('Top Right Corner', 'augury'),
						'bottom-left'	 => esc_html__('Bottom Left Corner', 'augury'),
						'bottom-right' => esc_html__('Bottom Right Corner', 'augury'),
					)
				),
				'dependency' => array ( 'enable-cookie-consent', '==', '1' )
			)
		)
	);

/**
 * Option : Enable Dismiss the notification
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-dismiss-the-notification]', array (
			'default'           => augury_get_option( 'enable-dismiss-the-notification' ),
			'type'              => 'option',
			'sanitize_callback' => array ( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-dismiss-the-notification]', array (
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Dismiss the notification', 'augury'),
				'section' => 'cookie-consent-section',
				'choices' => array (
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array ( 'enable-cookie-consent', '==', '1' )
			)
		)
	);

/**
 * Option : Dismiss the notification label
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dismiss-the-notification-label]', array(
			'default'           => augury_get_option( 'dismiss-the-notification-label' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[dismiss-the-notification-label]', array(
				'type'       => 'text',
				'section' 	 => 'cookie-consent-section',
				'label'      => esc_html__( 'Dismiss the notification label', 'augury' ),
				'dependency' => array ( 'enable-cookie-consent|enable-dismiss-the-notification', '==|==', '1|1' )
			)
		)
	);

/**
 * Option : Enable Link to another page
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-link-to-another-page]', array (
			'default'           => augury_get_option( 'enable-link-to-another-page' ),
			'type'              => 'option',
			'sanitize_callback' => array ( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-link-to-another-page]', array (
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Link to another page', 'augury'),
				'section' => 'cookie-consent-section',
				'choices' => array (
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array ( 'enable-cookie-consent', '==', '1' )
			)
		)
	);

/**
 * Option : Link to another page label
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[link-to-another-page-label]', array(
			'default'           => augury_get_option( 'link-to-another-page-label' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[link-to-another-page-label]', array(
				'type'       => 'text',
				'section' 	 => 'cookie-consent-section',
				'label'      => esc_html__( 'Link to another page label', 'augury' ),
				'dependency' => array ( 'enable-cookie-consent|enable-link-to-another-page', '==|==', '1|1' )
			)
		)
	);

/**
 * Option : Link to another page link
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[link-to-another-page-link]', array(
			'default'           => augury_get_option( 'link-to-another-page-link' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[link-to-another-page-link]', array(
				'type'       => 'text',
				'section' 	 => 'cookie-consent-section',
				'label'      => esc_html__( 'Link to another page link', 'augury' ),
				'dependency' => array ( 'enable-cookie-consent|enable-link-to-another-page', '==|==', '1|1' )
			)
		)
	);

/**
 * Option : Enable Open info modal on privacy and cookies
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-open-infomodal-on-privacy-and-cookies]', array (
			'default'           => augury_get_option( 'enable-dismiss-the-notification' ),
			'type'              => 'option',
			'sanitize_callback' => array ( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-open-infomodal-on-privacy-and-cookies]', array (
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Open info modal on privacy and cookies', 'augury'),
				'section' => 'cookie-consent-section',
				'choices' => array (
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array ( 'enable-cookie-consent', '==', '1' )
			)
		)
	);

/**
* Option : Open info modal on privacy and cookies label
*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[open-infomodal-on-privacy-and-cookies-label]', array(
			'default'           => augury_get_option( 'open-infomodal-on-privacy-and-cookies-label' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[open-infomodal-on-privacy-and-cookies-label]', array(
				'type'       => 'text',
				'section' 	 => 'cookie-consent-section',
				'label'      => esc_html__( 'Open info modal on privacy and cookies label', 'augury' ),
				'dependency' => array ( 'enable-cookie-consent|enable-open-infomodal-on-privacy-and-cookies', '==|==', '1|1' )
			)
		)
	);


/**
 * Option : Model Window Custom Content
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-custom-model-content]', array (
			'default'           => augury_get_option( 'enable-custom-model-content' ),
			'type'              => 'option',
			'sanitize_callback' => array ( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-custom-model-content]', array (
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Model Window Custom Content', 'augury'),
				'description'   => esc_html__('Instead of displaying the default content set custom content yourself', 'augury'),
				'section' => 'cookie-consent-section',
				'choices' => array (
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array ( 'enable-cookie-consent', '==', '1' )
			)
		)
	);

/**
 * Option : Main Heading
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[custom-model-heading]', array(
			'default'           => augury_get_option( 'custom-model-heading' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[custom-model-heading]', array(
				'type'        => 'text',
				'section'     => 'cookie-consent-section',
				'label'       => esc_html__( 'Main Heading', 'augury' ),
				'description' => esc_html__('Cookie and Privacy Settings', 'augury'),
				'dependency'  => array ( 'enable-cookie-consent|enable-custom-model-content', '==|==', '1|1' )
			)
		)
	);

/**
* Option : Model Window Custom Content
*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[custom-model-content]', array (
			'default'           => augury_get_option( 'custom-model-content' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[custom-model-content]', array (
				'type'    => 'textarea',
				'label'   => esc_html__( 'Model Window Custom Content', 'augury'),
				'section' => 'cookie-consent-section',
				'dependency'  => array ( 'enable-cookie-consent|enable-custom-model-content', '==|==', '1|1' )
			)
		)
	);