<?php
if (! class_exists ( 'DTBooking_Cs_Sc_PersonItem' ) ) {

    class DTBooking_Cs_Sc_PersonItem {

        function DTBooking_sc_PersonItem() {

			$plural_name = '';
			if( function_exists( 'dt_booking_cs_get_option' ) ) :
				$plural_name	=	dt_booking_cs_get_option( 'singular-person-text', esc_html__('Person', 'dt-booking-manager') );
			endif;

			$options = array(
			  'name'      => 'dt_sc_person_item',
			  'title'     => $plural_name,
			  'fields'    => array(

				array(
				  'id'    => 'person_id',
				  'type'  => 'text',
				  'title' => esc_html__( 'Enter Person ID', 'dt-booking-manager' ),
				  'after' => '<div class="cs-text-muted">'.esc_html__('Enter ID of person to display. More than one ids with comma(,) seperated.', 'dt-booking-manager').'</div>',
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
				  'info'      => esc_html__('Choose type of persons to display.', 'dt-booking-manager')
				),
				array(
				  'id'        => 'show_button',
				  'type'      => 'select',
				  'title'     => esc_html__('Show button?', 'dt-booking-manager'),
				  'options'   => array(
					'yes'   => esc_html__('Yes', 'dt-booking-manager'),
					'no'    => esc_html__('No', 'dt-booking-manager')
				  ),
				  'class'     => 'chosen',
				  'default'   => 'no',
				  'info'      => esc_html__('Choose "Yes" to show button.', 'dt-booking-manager')
				),
				array(
				  'id'    => 'button_text',
				  'type'  => 'text',
				  'title' => esc_html__( 'Button Text', 'dt-booking-manager' ),
				  'default' => esc_html__('Book an appointment', 'dt-booking-manager'),
				  'info'  => esc_html__( 'Enter button text.', 'dt-booking-manager' )
				)
			  ),
			);

			return $options;
		}
	}				
}