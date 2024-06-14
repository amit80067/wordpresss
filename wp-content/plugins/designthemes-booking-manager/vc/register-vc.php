<?php
if (! class_exists ( 'DTBookingManagerVcModules' )) {

	class DTBookingManagerVcModules {

		function __construct() {

			add_action( 'admin_enqueue_scripts', array ( $this, 'dt_booking_vc_admin_scripts') );
			add_action( 'wp_enqueue_scripts', array ( $this, 'dt_booking_wp_enqueue_scripts' ) );

			add_action( 'admin_init', array ( $this, 'dt_booking_load_modules' ) , 1000 );
			add_action( 'init', array( $this, 'dt_booking_load_shortcodes' ) );
		}

		function dt_booking_vc_admin_scripts( $hook ) {

			if( $hook == "post.php" || $hook == "post-new.php" ) {
				wp_enqueue_style( 'dt-booking-vc-admin', plugins_url ('designthemes-booking-manager') . '/vc/style.css', array(), false, 'all' );
			}
		}

		function dt_booking_wp_enqueue_scripts() {

			$themeData = wp_get_theme();
			$version = $themeData->get('Version');

			wp_enqueue_style ( 'fontawesome-all', plugins_url ('designthemes-booking-manager') . '/vc/css/fontawesome-all.min.css' );
			wp_enqueue_style ( 'dt-booking-manager', plugins_url ('designthemes-booking-manager') . '/vc/css/booking.css', false, $version, 'all' );
			wp_enqueue_script ( 'dt-booking-manager', plugins_url ('designthemes-booking-manager') . '/vc/js/booking.js', array ('jquery'), false, true );

			wp_enqueue_script ( 'jquery-ui-datepicker' );
			wp_enqueue_style ( 'jquery-ui-datepicker','https://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css' );
			wp_enqueue_script( 'dt-reservation', plugins_url ('designthemes-booking-manager') . '/vc/js/reservation.js', array(), false, true );
			wp_enqueue_script( 'jquery-validate', plugins_url ('designthemes-booking-manager') . '/vc/js/jquery.validate.min.js', array(), false, true );
			wp_localize_script( 'dt-reservation', 'dtBookingManager', array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'plugin_url' => plugin_dir_url ( __FILE__ ),
				'eraptdatepicker' => esc_html__('Please Select Service and Date', 'dt-booking-manager'),
			));
		}

		function dt_booking_load_modules() {

			if( ! function_exists( 'vc_map' ) ) {
				return;
			}

			require_once 'modules/reservation_form.php';
			require_once 'modules/reserve_appointment.php';
			require_once 'modules/person_item.php';
			require_once 'modules/service_item.php';
			require_once 'modules/service_list.php';
		}

		function dt_booking_load_shortcodes() {

			require_once 'shortcodes/base.php';

			require_once 'shortcodes/reservation_form.php';
			require_once 'shortcodes/reserve_appointment.php';
			require_once 'shortcodes/person_item.php';
			require_once 'shortcodes/service_item.php';
			require_once 'shortcodes/service_list.php';
		}
	}
}