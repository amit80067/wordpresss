<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once AUGURY_DIR . '/framework/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'augury_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function augury_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$url = 'https://api.wordpress.org/plugins/info/1.0/unyson';
    $api_response = wp_remote_get( $url );
    if ( is_array( $api_response ) && ! is_wp_error( $api_response ) ) {
        if( isset($api_response['response']) && !empty($api_response['response']) ) {
            if ( 404 == $api_response['response']['code'] && 'Not Found' == $api_response['response']['message'] ) {
                $unyson_plugin = array(
                    array(
                        'name'               => esc_html__('Unyson', 'augury'),
                        'slug'               => 'unyson',
                        'source'             => AUGURY_DIR . '/plugins/unyson.zip',
                        'required'           => true,
                        'version'            => '2.7.28',
                        'force_activation'   => false,
                        'force_deactivation' => false,
                    )
                );
            } else {
                $unyson_plugin = array(
                    array(
                        'name'     => esc_html__('Unyson', 'augury'),
                        'slug'     => 'unyson',
                        'required' => true,
                    )
                );
            }
        }
    }
	$plugins = array(

		array(
			'name'     				=> esc_html__('Elementor', 'augury'),
			'slug'     				=> 'elementor',
			'required' 				=> true,
		),

		array(
			'name'     				=> esc_html__('DesignThemes Core', 'augury'),
			'slug'     				=> 'designthemes-core',
			'source'   				=> AUGURY_DIR . '/framework/plugins/designthemes-core.zip',
			'required' 				=> true,
			'version' 				=> '1.6',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> esc_html__('DesignThemes Portfolio Addon', 'augury'),
			'slug'     				=> 'designthemes-portfolio-addon',
			'source'   				=> AUGURY_DIR . '/framework/plugins/designthemes-portfolio-addon.zip',
			'required' 				=> false,
			'version' 				=> '1.3',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> esc_html__('DesignThemes Booking Manager', 'augury'),
			'slug'     				=> 'designthemes-booking-manager',
			'source'   				=> AUGURY_DIR . '/framework/plugins/designthemes-booking-manager.zip',
			'required' 				=> false,
			'version' 				=> '1.8',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name' 					=> esc_html__('Contact Form 7', 'augury'),
			'slug' 					=> 'contact-form-7',
			'required' 				=> false,
		),

		array(
			'name' 					=> esc_html__('WooCommerce - excelling eCommerce', 'augury'),
			'slug' 					=> 'woocommerce',
			'required' 				=> false,
		),

		array(
			'name' 					=> esc_html__('YITH WooCommerce Wishlist', 'augury'),
			'slug' 					=> 'yith-woocommerce-wishlist',
			'required' 				=> false,
		),

		array(
			'name' 					=> esc_html__('YITH WooCommerce Quick View', 'augury'),
			'slug' 					=> 'yith-woocommerce-quick-view',
			'required' 				=> false,
		),
		array(
			'name' 					=> esc_html__('YITH WooCommerce Compare', 'augury'),
			'slug' 					=> 'yith-woocommerce-compare',
			'required' 				=> false,
		)
	);
	$plugins = array_merge( $unyson_plugin, $plugins );
	$args = array(
		'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . network_site_url(),
		'timeout'    => 30,
	);

	$response = wp_remote_get( 'http://wedesignthemes.com/plugins/designthemes/version-elementor.php', $args );
	$data = json_decode( wp_remote_retrieve_body( $response ), true );

	if ( is_array( $data ) && ! empty( $data ) ) {
		$updated_plugin_list = array_merge( $data, $plugins );
	} else {
		$updated_plugin_list = $plugins;
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'augury',          // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $updated_plugin_list, $config );
}?>