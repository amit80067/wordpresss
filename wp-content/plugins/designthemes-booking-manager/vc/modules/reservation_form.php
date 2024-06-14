<?php
	vc_map( array(
		"name" => esc_html__( "Reservation Form", 'dt-booking-manager' ),
		"base" => "dt_sc_reservation_form",
		"icon" => "dt_sc_reservation_form",
		"category" => esc_html__( 'Booking Manager', 'dt-booking-manager' ),
		"description" => esc_html__("Show the reservation form.",'dt-booking-manager'),
		"params" => array(

			// Title
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'dt-booking-manager' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Enter title here.', 'dt-booking-manager' ),
				'std' => esc_html__('Appointment', 'dt-booking-manager'),
				'admin_label' => true,
				'save_always' => true
			),

			// Services
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Service IDs', 'dt-booking-manager' ),
				'param_name' => 'serviceids',
				'settings' => array(
					'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					'unique_values' => true,
					'display_inline' => true,
					'delay' => 500,
					'auto_focus' => true,
				),
				'param_holder_class' => 'vc_not-for-custom',
				'description' => __( 'Enter service name & pick.', 'dt-booking-manager' )
			),
			
			// Staffs
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Staff IDs', 'dt-booking-manager' ),
				'param_name' => 'staffids',
				'settings' => array(
					'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					'unique_values' => true,
					'display_inline' => true,
					'delay' => 500,
					'auto_focus' => true,
				),
				'param_holder_class' => 'vc_not-for-custom',
				'description' => __( 'Enter staff name & pick.', 'dt-booking-manager' )
			)
		)
	) );