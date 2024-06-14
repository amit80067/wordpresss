<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Privacy Comment Form
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[privacy-commentform]', array (
			'default'           => augury_get_option( 'privacy-commentform' ),
			'type'              => 'option',
			'sanitize_callback' => array ( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[privacy-commentform]', array (
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Append a privacy policy message to your comment form?', 'augury'),
				'description'   => esc_html__( 'Check to append a message to the comment form for unregistered users. Commenting without consent is no longer possible', 'augury'),
				'section' => 'privacy-policy-section',
				'choices' => array (
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Message below comment form
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[privacy-commentform-msg]', array (
			'default'           => augury_get_option( 'privacy-commentform-msg' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[privacy-commentform-msg]', array (
				'type'    => 'textarea',
				'label'   => esc_html__( 'Message below comment form', 'augury'),
				'description'   => esc_html__( 'A short message that can be displayed below forms, along with a checkbox, that lets the user know that he has to agree to your privacy policy in order to send the form.', 'augury'),
				'section' => 'privacy-policy-section',
				'dependency' => array ( 'privacy-commentform', '==', '1' )
			)
		)
	);	


/**
 * Option : Privacy Subscribe Form
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[privacy-subscribeform]', array (
			'default'           => augury_get_option( 'privacy-subscribeform' ),
			'type'              => 'option',
			'sanitize_callback' => array ( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[privacy-subscribeform]', array (
				'type'    => 'dt-switch',
				'label'   => esc_html__('Append a privacy policy message to mailchimp contact forms?', 'augury'),
				'description'   => esc_html__('Check to append a message to all of your mailchimp forms.', 'augury'),
				'section' => 'privacy-policy-section',
				'choices' => array (
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
* Option : Privacy Subscribe Form Message
*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[privacy-subscribeform-msg]', array (
			'default'           => augury_get_option( 'privacy-subscribeform-msg' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[privacy-subscribeform-msg]', array (
				'type'    => 'textarea',
				'label'   => esc_html__('Message below mailchimp subscription forms', 'augury'),
				'description'   => esc_html__('A short message that can be displayed below forms, along with a checkbox, that lets the user know that he has to agree to your privacy policy in order to send the form.', 'augury'),
				'section' => 'privacy-policy-section',
				'dependency' => array ( 'privacy-subscribeform', '==', '1' )
			)
		)
	);


/**
 * Option : Privacy Login Form
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[privacy-loginform]', array (
			'default'           => augury_get_option( 'privacy-loginform' ),
			'type'              => 'option',
			'sanitize_callback' => array ( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[privacy-loginform]', array (
				'type'    => 'dt-switch',
				'label'   => esc_html__('Append a privacy policy message to your login forms?', 'augury'),
				'description'   => esc_html__('Check to append a message to the default login and registrations forms.', 'augury'),
				'section' => 'privacy-policy-section',
				'choices' => array (
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
* Option : Privacy Login Form Message
*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[privacy-loginform-msg]', array (
			'default'           => augury_get_option( 'privacy-loginform-msg' ),
			'type'              => 'option',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[privacy-loginform-msg]', array (
				'type'    => 'textarea',
				'label'   => esc_html__('Message below login forms', 'augury'),
				'description'   => esc_html__('A short message that can be displayed below forms, along with a checkbox, that lets the user know that he has to agree to your privacy policy in order to send the form.', 'augury'),
				'section' => 'privacy-policy-section',
				'dependency' => array ( 'privacy-loginform', '==', '1' )
			)
		)
	);