<?php
	vc_map( array(
		"name" => esc_html__( "Reserve Appointment", 'dt-booking-manager' ),
		"base" => "dt_sc_reserve_appointment",
		"icon" => "dt_sc_reserve_appointment",
		"category" => esc_html__( 'Booking Manager', 'dt-booking-manager' ),
		"description" => esc_html__("Show reserve appointment template.",'dt-booking-manager'),
		"params" => array(

			// Title
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'dt-booking-manager' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Enter title here.', 'dt-booking-manager' ),
				'std' => esc_html__('Make an Appointment', 'dt-booking-manager'),
				'admin_label' => true,
				'save_always' => true
			),

			// Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Type','dt-booking-manager'),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Type - I','dt-booking-manager') => 'type1' ,
					esc_html__('Type - II','dt-booking-manager') => 'type2'
				),
				'std' => 'type1',
				'save_always' => true
			)
		)
	) );