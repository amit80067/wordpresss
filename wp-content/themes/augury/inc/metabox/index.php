<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main DT_Metabox Class
 *
 * @class DT_Metabox
 */
class DT_Metabox {

	/**
	 * DT_Metabox The single instance of DT_Metabox.
	 * @var object
	 */
	private static $_instance = null;

	/**
	 * Constructor function.
	 * @access  public
	 */
	public function __construct() {

		define( 'DTM_URL', AUGURY_URI.'/inc/metabox/' );
		define( 'DTM_PATH', AUGURY_DIR.'/inc/metabox/' );

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Setup all the things
		add_action( 'init', array( $this, 'setup' ) );

		// Include Codestar Framework
		if( ! function_exists( 'dtm_framework_init' ) && ! class_exists( 'DTMFramework_Abstract' ) ) {
			require_once DTM_PATH . 'cs-framework/cs-framework.php';
		}

		// Loads Admin Panel Style
		add_action( 'admin_enqueue_scripts', array( $this, 'dtm_framework_admin_scripts' ) );
	}

	/**
	 * Main DT_Metabox Instance
	 * Ensures only one instance of DT_Metabox is loaded or can be loaded.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 * @access  public
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'augury', false, get_theme_file_path() . '/languages/' );
	}

	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'augury' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'augury' ), '1.0.0' );
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 */
	private function _log_version_number() {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	}

	/**
	 * Load admin panel styles.
	 */
	public function dtm_framework_admin_scripts() {
		wp_enqueue_style('dtm-admin', DTM_URL .'css/admin-style.css');
	}

	/**
	 * Setup all the things.
	 * Only executes if DT_Metabox or a child theme using DT_Metabox as a parent is active and the extension specific filter returns true.
	 */
	public function setup() {
		$theme = wp_get_theme();

		#if ( 'Twenty Seventeen' == $theme->name || 'twentyseventeen' == $theme->template ) {
			#require_once( DTM_PATH .'/includes/demos.php' );
		#}
	}
}

DT_Metabox::instance();