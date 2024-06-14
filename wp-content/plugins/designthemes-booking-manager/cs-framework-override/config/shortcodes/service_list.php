<?php
if (! class_exists ( 'DTBooking_Cs_Sc_ServiceList' ) ) {

    class DTBooking_Cs_Sc_ServiceList {

        function DTBooking_sc_ServiceList() {

			$plural_name = '';
			if( function_exists( 'dt_booking_cs_get_option' ) ) :
				$plural_name	=	dt_booking_cs_get_option( 'singular-service-text', esc_html__('Service', 'dt-booking-manager') );
			endif;

			$options = array(
			  'name'      => 'dt_sc_service_list',
			  'title'     => $plural_name.esc_html__(' List', 'dt-booking-manager'),
			  'fields'    => array(

				array(
				  'id'          => 'terms',
				  'type'        => 'select',
				  'title'       => esc_html__('Terms', 'dt-booking-manager'),
				  'options'     => 'categories',
				  'query_args'  => array(
					'type'      => 'dt_service',
					'taxonomy'  => 'dt_service_category'
				  ),
				  'attributes' => array(
					'multiple' 		   => 'only-key',
					'data-placeholder' => esc_html__('Select service category', 'dt-booking-manager'),
					'style'            => 'width: 200px;'
				  ),
				  'class' 	   => 'chosen',
				  'desc'       => '<div class="cs-text-muted">'.esc_html__('Choose service as you want.', 'dt-booking-manager').'</div>',
				),
				array(
				  'id'    => 'posts_per_page',
				  'type'  => 'text',
				  'title' => esc_html__( 'Products Per Page', 'dt-booking-manager' ),
				  'default' => 3
				),
				array(
				  'id'        => 'orderby',
				  'type'      => 'select',
				  'title'     => esc_html__('Order by', 'dt-booking-manager'),
				  'options'   => array(
					'ID'       => esc_html__('ID', 'dt-booking-manager'),
					'title'    => esc_html__('Title', 'dt-booking-manager'),
					'name'     => esc_html__('Name', 'dt-booking-manager'),
					'type' 	   => esc_html__('Type', 'dt-booking-manager'),
					'date'     => esc_html__('Date', 'dt-booking-manager'),
					'rand'     => esc_html__('Random', 'dt-booking-manager')
				  ),
				  'class'     => 'chosen',
				  'default'   => 'ID',
				  'info'      => esc_html__('Choose orderby of services to display.', 'dt-booking-manager')
				),
				array(
				  'id'        => 'order',
				  'type'      => 'select',
				  'title'     => esc_html__('Sort order', 'dt-booking-manager'),
				  'options'   => array(
					'desc'    => esc_html__('Descending', 'dt-booking-manager'),
					'asc'     => esc_html__('Ascending', 'dt-booking-manager')
				  ),
				  'class'     => 'chosen',
				  'default'   => 'desc',
				  'info'      => esc_html__('Choose order of services to display.', 'dt-booking-manager')
				),
				array(
				  'id'    => 'el_class',
				  'type'  => 'text',
				  'title' => esc_html__( 'Extra class name', 'dt-booking-manager' ),
				  'after' => '<div class="cs-text-muted">'.esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dt-booking-manager').'</div>',
				),
			  ),
			);

			return $options;
		}
	}				
}