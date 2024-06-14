<?php
if (! class_exists ( 'DTBooking_Cs_Sc_ReserveAppointment' ) ) {

    class DTBooking_Cs_Sc_ReserveAppointment {

        function DTBooking_sc_ReserveAppointment() {

			$options = array(
			  'name'      => 'dt_sc_reserve_appointment',
			  'title'     => esc_html__('Reserve Appointment', 'dt-booking-manager'),
			  'fields'    => array(

				array(
				  'id'    => 'title',
				  'type'  => 'text',
				  'title' => esc_html__( 'Title', 'dt-booking-manager' )
				),
				array(
				  'id'           => 'type',
				  'type'         => 'select',
				  'title'        => esc_html__('Type', 'dt-booking-manager'),
				  'options'      => array(
					'type1'      => esc_html__('Type - I', 'dt-booking-manager'),
					'type2'      => esc_html__('Type - II', 'dt-booking-manager'),
				  ),
				  'class'        => 'chosen',
				  'default'      => 'type1',
				  'info'         => esc_html__('Choose type of reservation to display.', 'dt-booking-manager')
				),
			  ),
			);

			return $options;
		}
	}				
}