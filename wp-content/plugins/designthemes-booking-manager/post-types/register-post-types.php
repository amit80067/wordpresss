<?php
if (! class_exists ( 'DTBookingManagerCustomPostTypes' )) {

	class DTBookingManagerCustomPostTypes {

		function __construct() {

			// Required From Plugin
			define( 'CS_ACTIVE_FRAMEWORK', true );
			define( 'CS_ACTIVE_METABOX', true );
			define( 'CS_ACTIVE_TAXONOMY', true );
			define( 'CS_ACTIVE_SHORTCODE', true );

			// Can changeable in theme or other plugin uses Codestar
			define( 'CS_ACTIVE_CUSTOMIZE', false );
			define( 'CS_ACTIVE_LIGHT_THEME', false );

			add_filter ( 'cs_shortcode_options', array (
				$this,
				'dt_booking_cs_shortcode_options'
			) );

			add_filter ( 'cs_framework_options', array (
				$this,
				'dt_booking_cs_framework_options'
			) );
			
			add_filter ( 'cs_framework_settings', array (
				$this,
				'dt_booking_cs_framework_settings'
			) );

			// Service custom post type
			require_once plugin_dir_path ( __FILE__ ) . '/dt-service-post-type.php';
			if (class_exists ( 'DTServicePostType' )) {
				new DTServicePostType();
			}

			// Person custom post type
			require_once plugin_dir_path ( __FILE__ ) . '/dt-person-post-type.php';
			if (class_exists ( 'DTPersonPostType' )) {
				new DTPersonPostType();
			}
		}

		function dt_booking_cs_shortcode_options( $options ) {

			$codestar = dt_booking_theme_has_codestar();
			$options  =  ( $codestar ) ? $options : array();

			require_once plugin_dir_path( __DIR__ ) . 'cs-framework-override/config/shortcodes/base.php';
			$obj = new DTBooking_Cs_Sc_Base;
			$options = $obj->DTBooking_cs_sc_Combined();

			return $options;
		}

		/**
		 * Service framework options
		 */
		function dt_booking_cs_framework_options( $options ) {

			global $timearray;
			$timearray = array( '' => 'OFF', '00:00' => '12:00 am', '00:15' => '12:15 am', '00:30' => '12:30 am', '00:45' => '12:45 am', '01:00' => '1:00 am', '01:15' => '1:15 am',
						   '01:30' => '1:30 am', '01:45' => '1:45 am', '02:00' => '2:00 am', '02:15' => '2:15 am', '02:30' => '2:30 am', '02:45' => '2:45 am', '03:00' => '3:00 am',
						   '03:15' => '3:15 am', '03:30' => '3:30 am', '03:45' => '3:45 am', '04:00' => '4:00 am', '04:15' => '4:15 am', '04:30' => '4:30 am', '04:45' => '4:45 am',
						   '05:00' => '5:00 am', '05:15' => '5:15 am', '05:30' => '5:30 am', '05:45' => '5:45 am', '06:00' => '6:00 am', '06:15' => '6:15 am', '06:30' => '6:30 am',
						   '06:45' => '6:45 am', '07:00' => '7:00 am', '07:15' => '7:15 am', '07:30' => '7:30 am', '07:45' => '7:45 am', '08:00' => '8:00 am', '08:15' => '8:15 am',
						   '08:30' => '8:30 am', '08:45' => '8:45 am', '09:00' => '9:00 am', '09:15' => '9:15 am', '09:30' => '9:30 am', '09:45' => '9:45 am', '10:00' => '10:00 am',
						   '10:15' => '10:15 am', '10:30' => '10:30 am', '10:45' => '10:45 am', '11:00' => '11:00 am', '11:15' => '11:15 am', '11:30' => '11:30 am', '11:45' => '11:45 am',
						   '12:00' => '12:00 pm', '12:15' => '12:15 pm', '12:30' => '12:30 pm', '12:45' => '12:45 pm', '13:00' => '1:00 pm', '13:15' => '1:15 pm', '13:30' => '1:30 pm',
						   '13:45' => '1:45 pm', '14:00' => '2:00 pm', '14:15' => '2:15 pm', '14:30' => '2:30 pm', '14:45' => '2:45 pm', '15:00' => '3:00 pm', '15:15' => '3:15 pm',
						   '15:30' => '3:30 pm', '15:45' => '3:45 pm', '16:00' => '4:00 pm', '16:15' => '4:15 pm', '16:30' => '4:30 pm', '16:45' => '4:45 pm', '17:00' => '5:00 pm',
						   '17:15' => '5:15 pm', '17:30' => '5:30 pm', '17:45' => '5:45 pm', '18:00' => '6:00 pm', '18:15' => '6:15 pm', '18:30' => '6:30 pm', '18:45' => '6:45 pm',
						   '19:00' => '7:00 pm', '19:15' => '7:15 pm', '19:30' => '7:30 pm', '19:45' => '7:45 pm', '20:00' => '8:00 pm', '20:15' => '8:15 pm', '20:30' => '8:30 pm',
						   '20:45' => '8:45 pm', '21:00' => '9:00 pm', '21:15' => '9:15 pm', '21:30' => '9:30 pm', '21:45' => '9:45 pm', '22:00' => '10:00 pm', '22:15' => '10:15 pm',
						   '22:30' => '10:30 pm', '22:45' => '10:45 pm', '23:00' => '11:00 pm', '23:15' => '11:15 pm', '23:30' => '11:30 pm', '23:45' => '11:45 pm' );

			$currencies = array();
			$currency_codes = dt_booking_get_currencies();
			foreach( $currency_codes as $code => $value ){
				$currencies[$code] = $value . ' ('. dt_booking_get_currency_symbol( $code ) .')';
			}

			$codestar = dt_booking_theme_has_codestar();
			$options  =  ( $codestar ) ? $options : array();

			$options['booking-manager'] = array(
			  'name'        => 'dt-booking-manager',
			  'title'       => esc_html__('Booking Options', 'dt-booking-manager'),
			  'icon'        => 'fa fa-calendar',
			  'sections'	=> array(

				  // -----------------------------------------
				  // General Options
				  // -----------------------------------------
				  array(
					'name'	=> 'general_options',
					'title' => esc_html__('General Options', 'dt-booking-manager'),
					'icon'  => 'fa fa-gear',

					  'fields'	=> array(

						array(
						  'type'    => 'subheading',
						  'content' => esc_html__( 'General Options', 'dt-booking-manager' ),
						),

						array(
						  'id'  	=> 'enable-service-taxonomy',
						  'type'  	=> 'switcher',
						  'title' 	=> esc_html__("Enable Service's Categories", "dt-booking-manager"),
						  'label'	=> esc_html__("YES! to enable service's taxonomy", "dt-booking-manager")
						),

						array(
						  'id'  	=> 'enable-person-taxonomy',
						  'type'  	=> 'switcher',
						  'title' 	=> esc_html__("Enable Person's Departments", "dt-booking-manager"),
						  'label'	=> esc_html__("YES! to enable person's taxonomy", "dt-booking-manager")
						),

						array(
						  'id'           => 'appointment-pageid',
						  'type'         => 'select',
						  'title'        => esc_html__('Appointment Page', 'dt-booking-manager'),
						  'options'      => 'pages',
						  'class'        => 'chosen',
						  'default_option' => esc_html__('Choose the page', 'dt-booking-manager'),
						  'info'       	 => esc_html__('Choose the page for reserve appointment.', 'dt-booking-manager')
						)
					  ),
				  ),

				  // -----------------------------
				  // Time Schedule
				  // -----------------------------
				  array(
					'name'      => 'appointment_options',
					'title'     => esc_html__('Time Schedule', 'dt-booking-manager'),
					'icon'      => 'fa fa-clock-o',

					  'fields'      => array(

						array(
						  'type'    => 'subheading',
						  'content' => esc_html__( "Business Hour's Settings", 'dt-booking-manager' ),
						),

						array(
						  'id'        => 'appointment_fs1',
						  'type'      => 'fieldset',
						  'title'     => esc_html__('Monday', 'dt-booking-manager'),
						  'fields'    => array(
			  
							array(
							  'id'    => 'dt_booking_monday_start',
							  'type'  => 'select',
							  'title'        => esc_html__('From:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
							array(
							  'id'    => 'dt_booking_monday_end',
							  'type'  => 'select',
							  'title'        => esc_html__('To:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
						  ),
						  'default'   => array(
							'dt_booking_monday_start'  => '08:00',
							'dt_booking_monday_end' 	 => '17:00',
						  )
						),
						
						array(
						  'id'        => 'appointment_fs2',
						  'type'      => 'fieldset',
						  'title'     => esc_html__('Tuesday', 'dt-booking-manager'),
						  'fields'    => array(
			  
							array(
							  'id'    => 'dt_booking_tuesday_start',
							  'type'  => 'select',
							  'title'        => esc_html__('From:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
							array(
							  'id'    => 'dt_booking_tuesday_end',
							  'type'  => 'select',
							  'title'        => esc_html__('To:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
						  ),
						  'default'   => array(
							'dt_booking_tuesday_start'  => '08:00',
							'dt_booking_tuesday_end'    => '17:00',
						  )
						),		
			  
						array(
						  'id'        => 'appointment_fs3',
						  'type'      => 'fieldset',
						  'title'     => esc_html__('Wednesday', 'dt-booking-manager'),
						  'fields'    => array(
			  
							array(
							  'id'    => 'dt_booking_wednesday_start',
							  'type'  => 'select',
							  'title'        => esc_html__('From:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
							array(
							  'id'    => 'dt_booking_wednesday_end',
							  'type'  => 'select',
							  'title'        => esc_html__('To:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
						  ),
						  'default'   => array(
							'dt_booking_wednesday_start'  => '08:00',
							'dt_booking_wednesday_end'    => '17:00',
						  )
						),
			  
						array(
						  'id'        => 'appointment_fs4',
						  'type'      => 'fieldset',
						  'title'     => esc_html__('Thursday', 'dt-booking-manager'),
						  'fields'    => array(
			  
							array(
							  'id'    => 'dt_booking_thursday_start',
							  'type'  => 'select',
							  'title'        => esc_html__('From:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
							array(
							  'id'    => 'dt_booking_thursday_end',
							  'type'  => 'select',
							  'title'        => esc_html__('To:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
						  ),
						  'default'   => array(
							'dt_booking_thursday_start'  => '08:00',
							'dt_booking_thursday_end'    => '17:00',
						  )
						),
			  
						array(
						  'id'        => 'appointment_fs5',
						  'type'      => 'fieldset',
						  'title'     => esc_html__('Friday', 'dt-booking-manager'),
						  'fields'    => array(
			  
							array(
							  'id'    => 'dt_booking_friday_start',
							  'type'  => 'select',
							  'title'        => esc_html__('From:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
							array(
							  'id'    => 'dt_booking_friday_end',
							  'type'  => 'select',
							  'title'        => esc_html__('To:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
						  ),
						  'default'   => array(
							'dt_booking_friday_start'  => '08:00',
							'dt_booking_friday_end'    => '17:00',
						  )
						),
			  
						array(
						  'id'        => 'appointment_fs6',
						  'type'      => 'fieldset',
						  'title'     => esc_html__('Saturday', 'dt-booking-manager'),
						  'fields'    => array(
			  
							array(
							  'id'    => 'dt_booking_saturday_start',
							  'type'  => 'select',
							  'title'        => esc_html__('From:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
							array(
							  'id'    => 'dt_booking_saturday_end',
							  'type'  => 'select',
							  'title'        => esc_html__('To:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
			  
						  ),
						),
			  
						array(
						  'id'        => 'appointment_fs7',
						  'type'      => 'fieldset',
						  'title'     => esc_html__('Sunday', 'dt-booking-manager'),
						  'fields'    => array(
			  
							array(
							  'id'    => 'dt_booking_sunday_start',
							  'type'  => 'select',
							  'title'        => esc_html__('From:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
							array(
							  'id'    => 'dt_booking_sunday_end',
							  'type'  => 'select',
							  'title'        => esc_html__('To:', 'dt-booking-manager'),
							  'options'      => $timearray,
							  'class'        => 'chosen',
							),
			  
						  ),
						),
			  
					  ),
				  ),

				  // -----------------------------
				  // Appointment Payment
				  // -----------------------------
				  array(
					'name'      => 'appointment_payments',
					'title'     => esc_html__('Payments', 'dt-booking-manager'),
					'icon'      => 'fa fa-money',

					  'fields'      => array(
			  
						array(
						  'type'    => 'subheading',
						  'content' => esc_html__( "Payment Settings", 'dt-booking-manager' ),
						),
			  
						array(
						  'id'         => 'book-currency',
						  'type'       => 'select',
						  'title'      => esc_html__('Currency', 'dt-booking-manager'),
						  'options'    => $currencies,
						  'class'      => 'chosen',
						  'default'    => 'USD',
						),

						array(
						  'id'           => 'currency-pos',
						  'type'         => 'select',
						  'title'        => esc_html__('Currency Position', 'dt-booking-manager'),
						  'options'      => array(
							'left' 			   => esc_html__('Left ( $36.55 )', 'dt-booking-manager'),
							'right'      	   => esc_html__('Right ( 36.55$ )', 'dt-booking-manager'),
							'left-with-space'  => esc_html__('Left with space ( $ 36.55 )', 'dt-booking-manager'),
							'right-with-space' => esc_html__('Right with space ( 36.55 $ )', 'dt-booking-manager'),
						  ),
						  'class'        => 'chosen',
						),
  
						array(
						  'id'  	    => 'price-decimal',
						  'type'  	    => 'number',
						  'title' 	    => esc_html__('Number of decimal', 'dt-booking-manager'),
						  'after'		=> '<span class="cs-text-desc">&nbsp;'.esc_html__('No.of decimals in price', 'dt-booking-manager').'</span>',
						  'default' 	=> 1,
						),

						array(
						  'id'  	   => 'enable-pay-at-arrival',
						  'type'  	   => 'switcher',
						  'title' 	   => esc_html__('Enable Pay at Arrival', 'dt-booking-manager'),
						  'info'	   => esc_html__('You can enable pay at arrival option to pay locally', 'dt-booking-manager'),
						),
			  
						array(
						  'id'  	   => 'enable-paypal',
						  'type'  	   => 'switcher',
						  'title' 	   => esc_html__('Enable PayPal', 'dt-booking-manager'),
						  'info'	   => esc_html__('You can enable paypal express checkout', 'dt-booking-manager'),
						),

						array(
						  'id'  	   => 'paypal-username',
						  'type'  	   => 'text',
						  'title' 	   => esc_html__('Business Account Username', 'dt-booking-manager'),
						  'info'	   => esc_html__('Enter a valid Merchant account ID or PayPal account email address. All payments will go to this account.', 'dt-booking-manager'),
						  'dependency' => array( 'enable-paypal', '==', 'true' ),
						),

						array(
						  'id'  	   => 'enable-paypal-live',
						  'type'  	   => 'switcher',
						  'title' 	   => esc_html__('Enable Live', 'dt-booking-manager'),
						  'info'	   => esc_html__('You can enable live paypal express checkout.', 'dt-booking-manager'),
						  'dependency' => array( 'enable-paypal', '==', 'true' ),
						),
			  
					  ),
				  ),
				  
				  // ----------------------------------
				  // begin: appointment notifications -
				  // ----------------------------------
				  array(
					'name'      => 'appointment_notifications',
					'title'     => esc_html__('Notifications', 'dt-booking-manager'),
					'icon'      => 'fa fa-envelope-o',
			  
					  'fields'      => array(
			  
						array(
						  'type'    => 'subheading',
						  'content' => esc_html__( "Notification Settings", 'dt-booking-manager' ),
						),
			  
						array(
						  'id'  	 => 'notification_sender_name',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Sender Name', 'dt-booking-manager'),
						  'default'	 => get_option( 'blogname' ),
						),
			  
						array(
						  'id'  	 => 'notification_sender_email',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Sender Email ID', 'dt-booking-manager'),
						  'default'	 => get_option( 'admin_email' ),
						),
			  
						array(
						  'type'    => 'notice',
						  'class'   => 'info',
						  'content' => esc_html__('To send scheduled agenda please execute following script with your cron,', 'dt-booking-manager').' <b>'.WP_PLUGIN_DIR.'/dt-booking-manager/reservation/cron/send_agenda_cron.sh'.'</b>',
						),
			  
						// ------------------------------------------
						// a option sub section for admin template  -
						// ------------------------------------------
						array(
						  'type'    => 'subheading',
						  'content' => esc_html__( "Admin Email Template", 'dt-booking-manager' ),
						),
			  
						array(
						  'type'    => 'content',
						  'content' => '<b>'.esc_html__('Notification to the admin about new Appointment:', 'dt-booking-manager').'</b>',
						),
			  
						array(
						  'id'  	 => 'appointment_notification_to_admin_subject',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Subject', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => 'Hi [ADMIN_NAME] , New booking information ( Booking id: [APPOINTMENT_ID] )',
						),
			  
						array(
						  'id'  	 => 'appointment_notification_to_admin_message',
						  'type'  	 => 'wysiwyg',
						  'title' 	 => esc_html__('Message', 'dt-booking-manager'),
						  'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						  ),
						  'default'	 => '<p> Hello [ADMIN_NAME], </p>
			  <p> New Booking id : [APPOINTMENT_ID] </p>
			  <p> Service: [SERVICE]</p>
			  <p> Date & Time: [APPOINTMENT_DATE] - [APPOINTMENT_TIME] </p>
			  <p>Client Name: [CLIENT_NAME]</p>
			  <p>Client Phone: [CLIENT_PHONE]</p>
			  <p>Client Email: [CLIENT_EMAIL]</p>
			  <p>Client Amount to pay : [AMOUNT]</p>
			  <p>Staff Name: [STAFF_NAME]</p>
			  <p>[APPOINTMENT_BODY]</p>',
						),
			  
						array(
						  'type'    => 'content',
						  'content' => '<b>'.esc_html__('Notification to the admin regarding modified Appointment:', 'dt-booking-manager').'</b>',
						),
			  
						array(
						  'id'  	 => 'modified_appointment_notification_to_admin_subject',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Subject', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => 'Hi [ADMIN_NAME] , ( Booking id: [APPOINTMENT_ID] ) - Modified',
						),
			  
						array(
						  'id'  	 => 'modified_appointment_notification_to_admin_message',
						  'type'  	 => 'wysiwyg',
						  'title' 	 => esc_html__('Message', 'dt-booking-manager'),
						  'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						  ),
						  'default'	 => '<p> Hello [ADMIN_NAME], </p>
			  <p> New Booking id : [APPOINTMENT_ID] </p>
			  <p> Service: [SERVICE]</p>
			  <p> Date & Time: [APPOINTMENT_DATE] - [APPOINTMENT_TIME] </p>
			  <p>Client Name: [CLIENT_NAME]</p>
			  <p>Client Phone: [CLIENT_PHONE]</p>
			  <p>Client Email: [CLIENT_EMAIL]</p>
			  <p>Client Amount to pay : [AMOUNT]</p>
			  <p>Staff Name: [STAFF_NAME]</p>
			  <p>[APPOINTMENT_BODY]</p>',
						),
						
						array(
						  'type'    => 'content',
						  'content' => '<b>'.esc_html__('Notification to the admin regarding Deleted / Declined Appointment:', 'dt-booking-manager').'</b>',
						),
			  
						array(
						  'id'  	 => 'deleted_appointment_notification_to_admin_subject',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Subject', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => 'Hi [ADMIN_NAME] , ( Booking id: [APPOINTMENT_ID] ) - Deleted / Declined',
						),
			  
						array(
						  'id'  	 => 'deleted_appointment_notification_to_admin_message',
						  'type'  	 => 'wysiwyg',
						  'title' 	 => esc_html__('Message', 'dt-booking-manager'),
						  'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						  ),
						  'default'	 => '<p> Hello [ADMIN_NAME], </p>
			  <p> New Booking id : [APPOINTMENT_ID] </p>
			  <p> Service: [SERVICE]</p>
			  <p> Date & Time: [APPOINTMENT_DATE] - [APPOINTMENT_TIME] </p>
			  <p>Client Name: [CLIENT_NAME]</p>
			  <p>Client Phone: [CLIENT_PHONE]</p>
			  <p>Client Email: [CLIENT_EMAIL]</p>
			  <p>Client Amount to pay : [AMOUNT]</p>
			  <p>Staff Name: [STAFF_NAME]</p>
			  <p>[APPOINTMENT_BODY]</p>',
						),
			  
						// ------------------------------------------
						// a option sub section for staff template  -
						// ------------------------------------------
						array(
						  'type'    => 'subheading',
						  'content' => esc_html__( "Staff Email Template", 'dt-booking-manager' ),
						),
			  
						array(
						  'type'    => 'content',
						  'content' => '<b>'.esc_html__('New Appoinment Notification:', 'dt-booking-manager').'</b>',
						),
			  
						array(
						  'id'  	 => 'appointment_notification_to_staff_subject',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Subject', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => 'Hi [STAFF_NAME] , New booking information ( Booking id: [APPOINTMENT_ID] )',
						),
			  
						array(
						  'id'  	 => 'appointment_notification_to_staff_message',
						  'type'  	 => 'wysiwyg',
						  'title' 	 => esc_html__('Message', 'dt-booking-manager'),
						  'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						  ),
						  'default'	 => '<p> Hello [STAFF_NAME], </p>
			  <p> Your new Booking id : [APPOINTMENT_ID] </p>
			  <p> Service: [SERVICE]</p>
			  <p> Date & Time: [APPOINTMENT_DATE] - [APPOINTMENT_TIME] </p>
			  <p>Client Name: [CLIENT_NAME]</p>
			  <p>Client Phone: [CLIENT_PHONE]</p>
			  <p>Client Email: [CLIENT_EMAIL]</p>
			  <p>[APPOINTMENT_BODY]</p>',
						),
						
						array(
						  'type'    => 'content',
						  'content' => '<b>'.esc_html__('Notification to the staff regarding modified Appointment:', 'dt-booking-manager').'</b>',
						),
			  
						array(
						  'id'  	 => 'modified_appointment_notification_to_staff_subject',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Subject', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => 'Hi [STAFF_NAME] , ( Booking id: [APPOINTMENT_ID] ) - Modified',
						),
			  
						array(
						  'id'  	 => 'modified_appointment_notification_to_staff_message',
						  'type'  	 => 'wysiwyg',
						  'title' 	 => esc_html__('Message', 'dt-booking-manager'),
						  'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						  ),
						  'default'	 => '<p> Hello [STAFF_NAME], </p>
			  <p> Your Booking id : [APPOINTMENT_ID]  was modified </p>
			  <p> Service: [SERVICE]</p>
			  <p> Date & Time: [APPOINTMENT_DATE] - [APPOINTMENT_TIME] </p>
			  <p>Client Name: [CLIENT_NAME]</p>
			  <p>Client Phone: [CLIENT_PHONE]</p>
			  <p>Client Email: [CLIENT_EMAIL]</p>
			  <p>[APPOINTMENT_BODY]</p>',
						),
			  
						array(
						  'type'    => 'content',
						  'content' => '<b>'.esc_html__('Notification to the staff regarding Deleted / Declined Appointment:', 'dt-booking-manager').'</b>',
						),
			  
						array(
						  'id'  	 => 'deleted_appointment_notification_to_staff_subject',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Subject', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => 'Hi [STAFF_NAME] , ( Booking id: [APPOINTMENT_ID] ) - Deleted / Declined',
						),
			  
						array(
						  'id'  	 => 'deleted_appointment_notification_to_staff_message',
						  'type'  	 => 'wysiwyg',
						  'title' 	 => esc_html__('Message', 'dt-booking-manager'),
						  'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						  ),
						  'default'	 => '<p> Hello [STAFF_NAME], </p>
			  <p> Booking id : [APPOINTMENT_ID]  was Deleted / Declined </p>
			  <p> Service: [SERVICE]</p>
			  <p> Date & Time: [APPOINTMENT_DATE] - [APPOINTMENT_TIME] </p>
			  <p>Client Name: [CLIENT_NAME]</p>
			  <p>Client Phone: [CLIENT_PHONE]</p>
			  <p>Client Email: [CLIENT_EMAIL]</p>
			  <p>[APPOINTMENT_BODY]</p>',
						),
			  
						array(
						  'type'    => 'content',
						  'content' => '<b>'.esc_html__('Evening notification with the next day agenda to Staff Member:', 'dt-booking-manager').'</b>',
						),
			  
						array(
						  'id'  	 => 'agenda_to_staff_subject',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Subject', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => 'Hi [STAFF_NAME] , Your Agenda for [TOMORROW]',
						),
			  
						array(
						  'id'  	 => 'agenda_to_staff_message',
						  'type'  	 => 'wysiwyg',
						  'title' 	 => esc_html__('Message', 'dt-booking-manager'),
						  'settings' => array(
							'textarea_rows' => 2,
							'tinymce'       => false,
							'media_buttons' => false,
						  ),
						  'default'	 => '<p> Hello [STAFF_NAME], </p><p>Your agenda for tomorrow is </p><p>[TOMORROW_AGENDA]</p>',
						),
			  
						// --------------------------------------------
						// a option sub section for cusomer template  -
						// --------------------------------------------
						array(
						  'type'    => 'subheading',
						  'content' => esc_html__( "Customer Email Template", 'dt-booking-manager' ),
						),
			  
						array(
						  'type'    => 'content',
						  'content' => '<b>'.esc_html__('Notification to the client about new Appointment:', 'dt-booking-manager').'</b>',
						),
			  
						array(
						  'id'  	 => 'appointment_notification_to_client_subject',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Subject', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => 'Hi [CLIENT_NAME] , New booking information ( Booking id: [APPOINTMENT_ID] )',
						),
			  
						array(
						  'id'  	 => 'appointment_notification_to_client_message',
						  'type'  	 => 'wysiwyg',
						  'title' 	 => esc_html__('Message', 'dt-booking-manager'),
						  'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						  ),
						  'default'	 => '<p> Hello [CLIENT_NAME], </p>
			  <p> Your new Booking id : [APPOINTMENT_ID] </p>
			  <p> Service: [SERVICE]</p>
			  <p> Date & Time: [APPOINTMENT_DATE] - [APPOINTMENT_TIME] </p>
			  <p> Amount to pay : [AMOUNT]</p>
			  <p>[APPOINTMENT_BODY]</p>
			  <p>Thank you for choosing our company.</p>',
						),
			  
						array(
						  'type'    => 'content',
						  'content' => '<b>'.esc_html__('Notification to the client regarding modified Appointment:', 'dt-booking-manager').'</b>',
						),
			  
						array(
						  'id'  	 => 'modified_appointment_notification_to_client_subject',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Subject', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => 'Hi [CLIENT_NAME] , ( Booking id: [APPOINTMENT_ID] ) - Modified',
						),
			  
						array(
						  'id'  	 => 'modified_appointment_notification_to_client_message',
						  'type'  	 => 'wysiwyg',
						  'title' 	 => esc_html__('Message', 'dt-booking-manager'),
						  'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						  ),
						  'default'	 => '<p> Hello [CLIENT_NAME], </p>
			  <p> Your Booking id : [APPOINTMENT_ID]  was modified </p>
			  <p> Service: [SERVICE]</p>
			  <p> Date & Time: [APPOINTMENT_DATE] - [APPOINTMENT_TIME] </p>
			  <p> Amount to pay : [AMOUNT]</p>
			  <p>[APPOINTMENT_BODY]</p>
			  <p>Thank you for choosing our company.</p>',
						),
						
						array(
						  'type'    => 'content',
						  'content' => '<b>'.esc_html__('Notification to the client regarding Deleted / Declined Appointment:', 'dt-booking-manager').'</b>',
						),
			  
						array(
						  'id'  	 => 'deleted_appointment_notification_to_client_subject',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Subject', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => 'Hi [CLIENT_NAME] , ( Booking id: [APPOINTMENT_ID] ) - Deleted / Declined',
						),
			  
						array(
						  'id'  	 => 'deleted_appointment_notification_to_client_message',
						  'type'  	 => 'wysiwyg',
						  'title' 	 => esc_html__('Message', 'dt-booking-manager'),
						  'settings' => array(
							'textarea_rows' => 5,
							'tinymce'       => false,
							'media_buttons' => false,
						  ),
						  'default'	 => '<p> Hello [CLIENT_NAME], </p>
			  <p> Your Booking id : [APPOINTMENT_ID]  was Deleted / Declined </p>
			  <p> Service: [SERVICE]</p>
			  <p> Date & Time: [APPOINTMENT_DATE] - [APPOINTMENT_TIME] </p>
			  <p>[APPOINTMENT_BODY]</p>',
						),
			  
						array(
						  'id'  	 => 'success_message',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Success Message', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => esc_html__('Success. You got a appointment to experience our excellent service.', 'dt-booking-manager'),
						),
			  
						array(
						  'id'  	 => 'error_message',
						  'type'  	 => 'text',
						  'title' 	 => esc_html__('Error Message', 'dt-booking-manager'),
						  'attributes' => array(
							'style'    => 'width: 100%;'
						  ),
						  'default'	 => esc_html__('Oops! You have cancelled the payment process :', 'dt-booking-manager')
						),
			  
					  ),
				  ),
			  ),
			);

			$options['booking-backup']   = array(
			  'name'     => 'backup_section',
			  'title'    => esc_html__('Backup', 'dt-booking-manager'),
			  'icon'     => 'fa fa-shield',
			  'fields'   => array(
			
				array(
				  'type'    => 'notice',
				  'class'   => 'warning',
				  'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'dt-booking-manager')
				),
			
				array(
				  'type'    => 'backup',
				),
			
			  )
			);

			return $options;
		}

		function dt_booking_cs_framework_settings($settings){

			$codestar = dt_booking_theme_has_codestar();
			if( !$codestar ) {

				$settings           = array(
				  'menu_title'      => esc_html__('Settings', 'dt-booking-manager'),
				  'menu_type'       => 'submenu',
				  'menu_parent'     => 'edit.php?post_type=dt_service',
				  'menu_slug'       => 'dt-booking-settings',
				  'ajax_save'       => true,
				  'show_reset_all'  => false,
				  'framework_title' => __('Booking Settings <small>by Designthemes</small>', 'dt-booking-manager'),
				);
			}

			return $settings;
		}
	}
}