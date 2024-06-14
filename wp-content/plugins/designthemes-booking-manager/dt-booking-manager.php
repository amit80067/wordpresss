<?php
/*
Plugin Name: DesignThemes Booking Manager
Plugin URI: http://nichewpthemes.com/bm/
Description: A simple wordpress plugin designed to implements reservation features.
URI: http://wedesignthemes.com/plugins/dt-booking-manager
Version: 1.8
Author: the DesignThemes team
Author URI: http://wedesignthemes.com/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dt-booking-manager
*/
if (! class_exists ( 'DTBookingManager' )) {

	class DTBookingManager {

		/**
		 * Plugin Version
		 */
		const BM_ELEMENTOR_VERSION = '2.8.5';

		/**
		 * Instance variable
		 */
		private static $_instance = null;

		/**
		 * Base Plugin URL
		 */
		private $plugin_url = null;	

		/**
		 * Base Plugin Path
		 */
		private $plugin_path = null;

		/**
		 * Instance
		 * 
		 * Ensures only one instance of the class is loaded or can be loaded.
		 */
		public static function instance() {

			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function __construct() {

			add_action ( 'init', array($this, 'dtBookingManagerTextDomain') );
			add_action ( 'plugins_loaded', array($this, 'dtBookingManagerPluginsLoaded') );

			define( 'DTBOOKINGMANAGER_PATH', dirname( __FILE__ ) );
			define( 'DTBOOKINGMANAGER_URL', untrailingslashit( plugins_url( '/', __FILE__ ) ) );

			register_activation_hook( __FILE__ , array( $this , 'dtBookingManagerActivate' ) );
			register_deactivation_hook( __FILE__ , array( $this , 'dtBookingManagerDeactivate' ) );

			// Include Codestar Framework
			if( ! function_exists( 'cs_framework_init' ) && ! class_exists( 'CSFramework' ) ) {
				require_once plugin_dir_path ( __FILE__ ) . 'cs-framework/cs-framework.php';
			}

			// Include Functions
			require_once plugin_dir_path ( __FILE__ ) . '/functions/core-functions.php';
			require_once plugin_dir_path ( __FILE__ ) . '/functions/reservation-functions.php';
			require_once plugin_dir_path ( __FILE__ ) . '/functions/template-functions.php';

			// Register Custom Post Types
			require_once plugin_dir_path ( __FILE__ ) . '/post-types/register-post-types.php';
			if(class_exists( 'DTBookingManagerCustomPostTypes' )){
				new DTBookingManagerCustomPostTypes();
			}

			// Register Reservation System
			require_once plugin_dir_path( __FILE__ ).'/reservation/register-reservation-system.php';
			if (class_exists ( 'DTBookingManagerReservationSystem' )) {
				new DTBookingManagerReservationSystem();
			}

			// Register Templates
			require_once plugin_dir_path ( __FILE__ ) . '/templates/register-templates.php';
			if(class_exists('DTBookingManagerTemplates')){
				new DTBookingManagerTemplates();
			}

			// Register Visual Composer
			require_once plugin_dir_path ( __FILE__ ) . '/vc/register-vc.php';
			if(class_exists('DTBookingManagerVcModules')){
				new DTBookingManagerVcModules();
			}

			// Theme Support
			$this->dt_booking_theme_support_includes();
		}

		/**
		 * Load Text Domain
		 */
		public function dtBookingManagerTextDomain() {
			load_plugin_textdomain ( 'dt-booking-manager', false, dirname ( plugin_basename ( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Check Plugin Is Active
		 */
		public function dtBookingManagerIsPluginActive( $plugin ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			if( is_plugin_active( $plugin ) || is_plugin_active_for_network( $plugin ) ) return true;
			else return false;
		}

		/**
		 * Include Theme Suports
		 */
		public function dt_booking_theme_support_includes() {

			if( 'twentyseventeen' == get_template() ) {

				include_once plugin_dir_path ( __FILE__ ) . '/theme-support/class-twenty-seventeen.php';

			} elseif( class_exists( 'DTElementorCore' ) ) {

				include_once plugin_dir_path ( __FILE__ ) . '/theme-support/class-designthemes.php';

			} else {

				include_once plugin_dir_path ( __FILE__ ) . '/theme-support/class-default.php';

			}
		}

		public function dtBookingManagerPluginsLoaded() {

			// Check if Elementor installed and activated
			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', array( $this, 'missing_elementor_plugin' ) );
				return;
			}

			// Register Elementor Category
			add_action( 'elementor/elements/categories_registered', array( $this, 'register_category' ) );

			// Register Elementor Widgets
			require $this->plugin_path( 'widgets/class-register-widgets.php' );
		}

		/**
		 * Admin notice
		 * Warning when the site doesn't have Elementor installed or activated.
		 */
		public function missing_elementor_plugin() {

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor */
				esc_html__( '"%1$s" recommended "%2$s" to be installed and activated.', 'dt-booking-manager' ),
				'<strong>' . esc_html__( 'Ultimate Booking Manager', 'dt-booking-manager' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'dt-booking-manager' ) . '</strong>'			
			);

			printf( '<div class="notice notice-info is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Register category
		 * Add Booking Manager category in elementor
		 */
		public function register_category( $elements_manager ) {

			$elements_manager->add_category(
				'dt-widgets',array(
					'title' => esc_html__( 'Booking Manager', 'dt-booking-manager' ),
					'icon'  => 'font'
				)
			);
		}

		/**
		 * Returns path to file or dir inside plugin folder
		 */
		public function plugin_path( $path = null ) {

			if ( ! $this->plugin_path ) {
				$this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
			}

			return $this->plugin_path . $path;
		}

		/**
		 * Returns url to file or dir inside plugin folder
		 */
		public function plugin_url( $path = null ) {

			if ( ! $this->plugin_url ) {
				$this->plugin_url = trailingslashit( plugin_dir_url( __FILE__ ) );
			}

			return $this->plugin_url . $path;
		}

		/**
		 * Custom Manager Activate
		 */
		public static function dtBookingManagerActivate() {
		}

		/**
		 * Custom Manager Deactivate
		 */
		public static function dtBookingManagerDeactivate() {
		}
	}
}

if( !function_exists('dt_booking_manager') ) {

	function dt_booking_manager() {
		return DTBookingManager::instance();
	}
}

dt_booking_manager();