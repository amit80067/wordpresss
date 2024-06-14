<?php
	$plural_name = '';
	if( function_exists( 'dt_booking_cs_get_option' ) ) :
		$plural_name	=	dt_booking_cs_get_option( 'singular-person-text', esc_html__('Person', 'dt-booking-manager') );
	endif;

	vc_map( array(
		"name" => $plural_name,
		"base" => "dt_sc_person_item",
		"icon" => "dt_sc_person_item",
		"category" => esc_html__( 'Booking Manager', 'dt-booking-manager' ),
		"params" => array(

			# ID
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Enter Person ID", "dt-booking-manager" ),
				"param_name" => "person_id",
				"value" => '',
				"description" => esc_html__( 'Enter ID of person to display.', 'dt-booking-manager' ),
			),

			# Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Type','dt-booking-manager'),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Type - 1','dt-booking-manager') => 'type1',
					esc_html__('Type - 2','dt-booking-manager') => 'type2'
				)
			),

			# Button?
			array(
				'type' => 'dropdown',
				'param_name' => 'show_button',
				'value' => array(
					esc_html__('Yes','dt-booking-manager') => 'yes',
					esc_html__('No','dt-booking-manager') => 'no'
				),
				'heading' => esc_html__( 'Show button?', 'dt-booking-manager' ),
				'std' => 'no'
			),

			# Button Text
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Button Text", "dt-booking-manager" ),
				"param_name" => "button_text",
				"value" => esc_html__('Book an appointment', 'dt-booking-manager'),
				"description" => esc_html__( 'Enter button text.', 'dt-booking-manager' ),
			)
	     )
	) );