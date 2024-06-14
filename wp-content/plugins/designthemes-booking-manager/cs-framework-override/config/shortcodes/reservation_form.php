<?php
if (! class_exists ( 'DTBooking_Cs_Sc_ReservationForm' ) ) {

    class DTBooking_Cs_Sc_ReservationForm {

        function DTBooking_sc_ReservationForm() {

			$options = array(
			  'name'      => 'dt_sc_reservation_form',
			  'title'     => esc_html__('Reservaton Form', 'dt-booking-manager'),
			  'fields'    => array(

				array(
				  'id'    => 'title',
				  'type'  => 'text',
				  'title' => esc_html__( 'Title', 'dt-booking-manager' )
				),
				array(
				  'id'          => 'serviceids',
				  'type'        => 'select',
				  'title'       => esc_html__('Service IDs', 'dt-booking-manager'),
				  'options'     => 'posts',
				  'query_args'  => array(
					'post_type'	=> 'dt_service'
				  ),
				  'attributes' => array(
					'multiple' 		   => 'only-key',
					'data-placeholder' => esc_html__('Select Some Services', 'dt-booking-manager'),
					'style'            => 'width: 200px;'
				  ),
				  'class' 		=> 'chosen',
				  'desc'       => '<div class="cs-text-muted">'.esc_html__('Enter service name & pick.', 'dt-booking-manager').'</div>',
				),
				array(
				  'id'          => 'staffids',
				  'type'        => 'select',
				  'title'       => esc_html__('Staff IDs', 'dt-booking-manager'),
				  'options'     => 'posts',
				  'query_args'  => array(
					'post_type'	=> 'dt_person'
				  ),
				  'attributes' => array(
					'multiple' 		   => 'only-key',
					'data-placeholder' => esc_html__('Select Some Staffs', 'dt-booking-manager'),
					'style'            => 'width: 200px;'
				  ),
				  'class' 		=> 'chosen',
				  'desc'       => '<div class="cs-text-muted">'.esc_html__('Enter staff name & pick.', 'dt-booking-manager').'</div>',
				),
			  ),
			);

			return $options;
		}
	}				
}