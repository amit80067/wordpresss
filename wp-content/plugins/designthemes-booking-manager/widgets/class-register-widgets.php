<?php
namespace DTBookingManager\widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DTBookingManagerWidgets {

	/**
	 * A Reference to an instance of this class
	 */
	private static $_instance = null;

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

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_widget_styles' ) );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_widget_scripts' ) );

		add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_styles') );

		add_filter( 'elementor/editor/localize_settings', array( $this, 'localize_settings' )  );
	}

	/**
	 * Register bookingmanager widgets
	 */
	public function register_widgets( $widgets_manager ) {

		require dt_booking_manager()->plugin_path( 'widgets/class-common-widget-base.php' );

		#Reservation Form
		require dt_booking_manager()->plugin_path( 'widgets/modules/class-widget-reservation-form.php');
		$widgets_manager->register( new \Elementor_Reservation_Form() );

		#Reserve Appointment
		require dt_booking_manager()->plugin_path( 'widgets/modules/class-widget-reserve-appointment.php');
		$widgets_manager->register( new \Elementor_Reserve_Appointment() );

		#Service Item
		require dt_booking_manager()->plugin_path( 'widgets/modules/class-widget-service-item.php');
		$widgets_manager->register( new \Elementor_Service_Item() );

		#Service List
		require dt_booking_manager()->plugin_path( 'widgets/modules/class-widget-service-list.php');
		$widgets_manager->register( new \Elementor_Service_List() );

		#Person Item
		require dt_booking_manager()->plugin_path( 'widgets/modules/class-widget-person-item.php');
		$widgets_manager->register( new \Elementor_Person_Item() );
	}

	/**
	 * Register bookingmanager widgets styles
	 */
	public function register_widget_styles() {}

	/**
	 * Register bookingmanager widgets scripts
	 */
	public function register_widget_scripts() {}

	/**
	 *  Editor Preview Style
	 */
	public function preview_styles() {}

	/**
	 * Enqueue localized texts
	 */
	public function localize_settings( $settings ) { return $settings; }

	/**
	 * Register admin scripts
	 */
	public function register_admin_scripts() {}
}

DTBookingManagerWidgets::instance();