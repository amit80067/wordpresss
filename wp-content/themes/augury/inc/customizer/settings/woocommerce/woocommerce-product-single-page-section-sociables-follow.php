<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sociable Follow Settings
 */
$wp_customize->add_section( 
	new Augury_WP_Customize_Section(
		$wp_customize,
		'woocommerce-product-single-page-sociables-follow-section',
		array(
			'title'    => esc_html__('Sociable Follow Settings', 'augury'),
			'panel'    => 'woocommerce-product-single-page-section',
			'priority' => 45,
		)
	)
);
	
	/**
	* Option : Follow Description
	*/
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-follow-description]', array(
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-follow-description]', array(
				'type'    => 'dt-description',
				'label'   => esc_html__( 'Note :', 'augury'),
				'section' => 'woocommerce-product-single-page-sociables-follow-section',
				'description'   => esc_html__( 'This option is applicable only for WooCommerce "Custom Template".', 'augury'),
			)
		)
	);

$social_follow = array (
	'delicious' 	 => esc_html__('Delicious', 'augury'),
	'deviantart'  => esc_html__('Deviantart', 'augury'),
	'digg' 	  	   => esc_html__('Digg', 'augury'),
	'dribbble' 	  => esc_html__('Dribbble', 'augury'),
	'envelope' 	  => esc_html__('Envelope', 'augury'),
	'facebook' 	  => esc_html__('Facebook', 'augury'),
	'flickr' 		   => esc_html__('Flickr', 'augury'),
	'google-plus' => esc_html__('Google Plus', 'augury'),
	'gtalk'  		   => esc_html__('GTalk', 'augury'),
	'instagram'	  => esc_html__('Instagram', 'augury'),
	'lastfm'	 	   => esc_html__('Lastfm', 'augury'),
	'linkedin'	   => esc_html__('Linkedin', 'augury'),
	'pinterest'	  => esc_html__('Pinterest', 'augury'),
	'reddit'		    => esc_html__('Reddit', 'augury'),
	'rss'		 	     => esc_html__('RSS', 'augury'),
	'skype'		     => esc_html__('Skype', 'augury'),
	'stumbleupon' => esc_html__('Stumbleupon', 'augury'),
	'tumblr'		    => esc_html__('Tumblr', 'augury'),
	'twitter'		   => esc_html__('Twitter', 'augury'),
	'viadeo'		    => esc_html__('Viadeo', 'augury'),
	'vimeo'		     => esc_html__('Vimeo', 'augury'),
	'yahoo'		     => esc_html__('Yahoo', 'augury'),
	'youtube'		   => esc_html__('Youtube', 'augury')
);

foreach($social_follow as $socialfollow_key => $socialfollow) {

	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[dt-single-product-show-follow-'.$socialfollow_key.']', array(
			'default'           => augury_get_option( 'dt-single-product-show-follow-'.$socialfollow_key ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[dt-single-product-show-follow-'.$socialfollow_key.']', array(
				'type'    => 'dt-switch',
				'label'   => sprintf(esc_html__('Show %1$s Follow', 'augury'), $socialfollow),
				'section' => 'woocommerce-product-single-page-sociables-follow-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

}