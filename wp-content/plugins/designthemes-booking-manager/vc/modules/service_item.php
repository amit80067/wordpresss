<?php
	$plural_name = '';
	if( function_exists( 'dt_booking_cs_get_option' ) ) :
		$plural_name	=	dt_booking_cs_get_option( 'singular-service-text', esc_html__('Service', 'dt-booking-manager') );
	endif;

	vc_map( array(
		"name" => $plural_name,
		"base" => "dt_sc_service_item",
		"icon" => "dt_sc_service_item",
		"category" => esc_html__( 'Booking Manager', 'dt-booking-manager' ),
		"params" => array(

			# ID
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Enter Service ID", "dt-booking-manager" ),
				"param_name" => "service_id",
				"value" => '',
				"description" => esc_html__( 'Enter IDs of services to display. More than one ids with comma(,) seperated.', 'dt-booking-manager' ),
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

			# Excerpt?
			array(
				'type' => 'dropdown',
				'param_name' => 'excerpt',
				'value' => array(
					esc_html__('Yes','dt-booking-manager') => 'yes',
					esc_html__('No','dt-booking-manager') => 'no'
				),
				'heading' => esc_html__( 'Show Excerpt?', 'dt-booking-manager' ),
				'std' => 'no'
			),

			# Excerpt Length
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Excerpt Length', 'dt-booking-manager' ),
				'param_name' => 'excerpt_length',
				'value' => 12
			),

			# Meta?
			array(
				'type' => 'dropdown',
				'param_name' => 'meta',
				'value' => array(
					esc_html__('Yes','dt-booking-manager') => 'yes',
					esc_html__('No','dt-booking-manager') => 'no'
				),
				'heading' => esc_html__( 'Show Meta?', 'dt-booking-manager' ),
				'std' => 'no'
			),

			# Button Text
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Button Text", "dt-booking-manager" ),
				"param_name" => "button_text",
				"value" => esc_html__('View procedure details', 'dt-booking-manager'),
				"description" => esc_html__( 'Enter button text.', 'dt-booking-manager' ),
			)
	     )
	) );