<?php
	$plural_name = '';
	if( function_exists( 'dt_booking_cs_get_option' ) ) :
		$plural_name	=	dt_booking_cs_get_option( 'singular-service-text', esc_html__('Service', 'dt-booking-manager') );
	endif;

	vc_map( array(
		"name" => $plural_name.esc_html__(' List', 'dt-booking-manager'),
		"base" => "dt_sc_service_list",
		"icon" => "dt_sc_service_list",
		"category" => esc_html__( 'Booking Manager', 'dt-booking-manager' ),
		"params" => array(

			# Terms
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Terms', 'dt-booking-manager' ),
				'param_name' => 'terms',
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
				'description' => __( 'Enter service category & pick.', 'dt-booking-manager' )
			),

			# Count
			array (
				"type" => "textfield",
				"heading" => esc_html__( "Products Per Page", 'dt-booking-manager' ),
				"param_name" => "posts_per_page",
				"value" => 3,
				"save_always" => true
			),
			
			# Order By
			array (
				"type" => "dropdown",
				"heading" => esc_html__( "Order by", 'dt-booking-manager' ),
				"param_name" => "orderby",
				'save_always' => true,
				"value" => array (
					esc_html__('ID','dt-booking-manager') => 'ID',
					esc_html__('Title','dt-booking-manager') => 'title',
					esc_html__('Name','dt-booking-manager') => 'name',
					esc_html__('Type','dt-booking-manager') => 'type',
					esc_html__('Date','dt-booking-manager') => 'date',
					esc_html__('Random','dt-booking-manager') => 'rand'
				)
			),

			# Order
			array (
				"type" => "dropdown",
				"heading" => esc_html__( "Sort order", 'dt-booking-manager' ),
				"param_name" => "order",
				'save_always' => true,
				"value" => array (
					esc_html__( 'Descending', 'dt-booking-manager' ) => 'desc',
					esc_html__( 'Ascending', 'dt-booking-manager' ) => 'asc'
				)
			),

			# Class
			array (
				"type" => "textfield",
				"heading" => esc_html__( 'Extra class name', 'dt-booking-manager' ),
				"param_name" => "el_class",
				"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'dt-booking-manager' )
			)
	     )
	) );