<?php
if ( !class_exists( 'DTBookingManagerReservationSystem' ) ) {

	class DTBookingManagerReservationSystem {

		function __construct() {

			//Register Calender Menu
			require_once plugin_dir_path ( __FILE__ ) . '/dt-calender-menu.php';
			if( class_exists('DTCalenderMenu')) {
				new DTCalenderMenu();
			}

			// Register Customers Custom Post
			require_once plugin_dir_path ( __FILE__ ) . '/dt-customer-post-type.php';
			if( class_exists('DTCustomerPostType') ){
				new DTCustomerPostType();
			}
			
			//Register Payments Menu
			require_once plugin_dir_path ( __FILE__ ) . '/dt-payments-menu.php';
			if( class_exists('DTPaymentsMenu')) {
				new DTPaymentsMenu();
			}
		}
	}
}