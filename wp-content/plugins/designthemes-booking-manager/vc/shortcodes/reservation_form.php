<?php
if (! class_exists ( 'DTBookingReservationForm' ) ) {

    class DTBookingReservationForm extends DTBaseBookingSC {

        function __construct() {

            add_shortcode( 'dt_sc_reservation_form', array( $this, 'dt_sc_reservation_form' ) );

			add_filter( 'vc_autocomplete_dt_sc_reservation_form_serviceids_callback', array ( $this, 'dt_booking_vc_autocomplete_serviceids_field_search' ), 10, 1 );
			add_filter( 'vc_autocomplete_dt_sc_reservation_form_serviceids_render', array ( $this, 'dt_booking_vc_autocomplete_serviceids_field_render' ), 10, 1 );

			add_filter( 'vc_autocomplete_dt_sc_reservation_form_staffids_callback', array ( $this, 'dt_booking_vc_autocomplete_staffids_field_search' ), 10, 1 );
			add_filter( 'vc_autocomplete_dt_sc_reservation_form_staffids_render', array ( $this, 'dt_booking_vc_autocomplete_staffids_field_render' ), 10, 1 );
        }

		function dt_sc_reservation_form($attrs, $content = null) {
			extract(shortcode_atts(array(
				'title' => esc_html__('Appointment', 'dt-booking-manager'),
				'serviceids' => '',
				'staffids' => '', 
			), $attrs)); 

			$out = '';

			$url = get_page_link( cs_get_option('appointment-pageid') );
			$url = isset($url) ? $url : '';

			if($url != '') {

				$out = '<div class="dt-sc-appointment-wrapper">';
	
					$out .= '<h2>'.$title.'</h2>';
		
					$out .= '<form class="dt-sc-reservation-form dt-appointment-form" name="reservation-schedule-form" method="post" action="'.$url.'">';
		
					$out .= '<div class="dt-sc-one-column column">
								<p><input type="text" id="cli-name" name="cli-name" placeholder="'.__('Name','dt-booking-manager').'"></p>
							</div>';
		
					$out .= '<div class="dt-sc-one-column column">
								<p><input type="text" id="cli-email" name="cli-email"  placeholder="'.__('Email','dt-booking-manager').'"></p>
							</div>';
		
					$out .= '<div class="dt-sc-one-column column">
								<p><select name="services" id="services" class="dt-select-service">
								  <option value="">'. __('Type of Service','dt-booking-manager').'</option>';
									  if($serviceids != '') {
										  $serviceids_arr = explode(',', $serviceids);
										  $cp_services = get_posts( array('post_type'=>'dt_service', 'posts_per_page'=>'-1', 'post__in' => $serviceids_arr, 'suppress_filters' => false ));
									  } else {
										  $cp_services = get_posts( array('post_type'=>'dt_service', 'posts_per_page'=>'-1', 'suppress_filters' => false ) );
									  }

									  if( $cp_services ){
										  foreach( $cp_services as $cp_service ){
											  $id = $cp_service->ID;
											  $title = $cp_service->post_title;

											  $service_settings = get_post_meta($id, '_custom_settings', true);
											  $service_settings = is_array ( $service_settings ) ? $service_settings : array ();

											  $out .= "<option value='{$id}'>{$title}";
												  if( array_key_exists('service-price', $service_settings) ):
												  	  $out .= ' - '.dt_booking_get_formatted_price( $service_settings['service-price'] );
												  endif;
											  $out .= "</option>";
										  }
									  }
					$out .= '</select></p></div>';

					$out .= '<div class="dt-sc-one-column column">
								<p class="dt-appoint-date"><span class="far fa-calendar-alt"></span><input type="text" id="datepicker" name="date" placeholder="'.__('Preferred Date','dt-booking-manager').'" readonly="readonly" /></p>
							 </div>';

					$out .= '<div class="dt-sc-one-column column">
								<p><select name="staff" id="staff" class="dt-select-staff">
									<option value="">'.__('Name of Person','dt-booking-manager').'</option>';
										if($staffids != '') {
											$staffids_arr = explode(',', $staffids);
											$cp_staffs = get_posts( array('post_type'=>'dt_person', 'posts_per_page'=>'-1', 'post__in' => $staffids_arr ) );
										} else {
											$cp_staffs = get_posts( array('post_type'=>'dt_person', 'posts_per_page'=>'-1' ) );
										}
										if( $cp_staffs ){
											foreach( $cp_staffs as $cp_staff ){
												$id = $cp_staff->ID;
												$title = $cp_staff->post_title;

												$person_settings = get_post_meta($id, '_custom_settings', true);
												$person_settings = is_array ( $person_settings ) ? $person_settings : array ();

												$out .= '<option value="'.$id.'">'.$title;
													if( array_key_exists('person-price', $person_settings) ):
														$out .= ' - '.dt_booking_get_formatted_price( $person_settings['person-price'] );
													endif;
												$out .= '</option>';
											}
										}
					$out .= '</select></p></div>';
		
					$out .= '<div class="dt-sc-one-column column">
								<div class="aligncenter">
									<button class="dt-sc-button filled medium show-time-shortcode" value="'.__('Show Time', 'dt-booking-manager').'" type="submit">'.__('Fix an appointment', 'dt-booking-manager').'</button>
								</div>
							</div>';
		
					$out .= '<input type="hidden" id="staffids" name="staffids" value="'.$staffids.'" /><input type="hidden" id="serviceids" name="serviceids" value="'.$serviceids.'" />';
		
					$out .= '</form>';
	
				$out .= '</div>';
			} else {
				$out .= '<div class="dt-sc-info-box">'.__('Please create Reservation template page in order to make this shortcode work properly!', 'dt-booking-manager').'</div>';
			}

			return $out;
		}
    }
}

new DTBookingReservationForm();