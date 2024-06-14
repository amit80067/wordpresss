<?php
if (! class_exists ( 'DTBooking_Cs_Sc_ServiceItem' ) ) {

    class DTBooking_Cs_Sc_ServiceItem {

        function DTBooking_sc_ServiceItem() {

			$plural_name = '';
			if( function_exists( 'dt_booking_cs_get_option' ) ) :
				$plural_name	=	dt_booking_cs_get_option( 'singular-service-text', esc_html__('Service', 'dt-booking-manager') );
			endif;

			$options = array(
			  'name'      => 'dt_sc_service_item',
			  'title'     => $plural_name,
			  'fields'    => array(

				array(
				  'id'    => 'service_id',
				  'type'  => 'text',
				  'title' => esc_html__( 'Enter Service ID', 'dt-booking-manager' ),
				  'after' => '<div class="cs-text-muted">'.esc_html__('Enter IDs of services to display. More than one ids with comma(,) seperated.', 'dt-booking-manager').'</div>',
				),
				array(
				  'id'        => 'type',
				  'type'      => 'select',
				  'title'     => esc_html__('Type', 'dt-booking-manager'),
				  'options'   => array(
					'type1'    => esc_html__('Type - 1', 'dt-booking-manager'),
					'type2'    => esc_html__('Type - 2', 'dt-booking-manager')
				  ),
				  'class'     => 'chosen',
				  'default'   => 'desc',
				  'info'      => esc_html__('Choose type of services to display.', 'dt-booking-manager')
				),
				array(
				  'id'        => 'excerpt',
				  'type'      => 'select',
				  'title'     => esc_html__('Show Excerpt?', 'dt-booking-manager'),
				  'options'   => array(
					'yes'   => esc_html__('Yes', 'dt-booking-manager'),
					'no'    => esc_html__('No', 'dt-booking-manager')
				  ),
				  'class'     => 'chosen',
				  'default'   => 'no',
				  'info'      => esc_html__('Choose "Yes" to show excerpt.', 'dt-booking-manager')
				),
				array(
				  'id'    => 'excerpt_length',
				  'type'  => 'text',
				  'title' => esc_html__( 'Excerpt Length', 'dt-booking-manager' ),
				  'default' => 12
				),
				array(
				  'id'        => 'meta',
				  'type'      => 'select',
				  'title'     => esc_html__('Show Meta?', 'dt-booking-manager'),
				  'options'   => array(
					'yes'   => esc_html__('Yes', 'dt-booking-manager'),
					'no'    => esc_html__('No', 'dt-booking-manager')
				  ),
				  'class'     => 'chosen',
				  'default'   => 'no',
				  'info'      => esc_html__('Choose "Yes" to show meta.', 'dt-booking-manager')
				),
				array(
				  'id'    => 'button_text',
				  'type'  => 'text',
				  'title' => esc_html__( 'Button Text', 'dt-booking-manager' ),
				  'default' => esc_html__('View procedure details', 'dt-booking-manager'),
				  'info'  => esc_html__( 'Enter button text.', 'dt-booking-manager' )
				)
			  ),
			);

			return $options;
		}
	}				
}