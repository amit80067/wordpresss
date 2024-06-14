<?php
if (! class_exists ( 'DTBooking_Cs_Sc_Base' ) ) {

    class DTBooking_Cs_Sc_Base {

        function DTBooking_cs_sc_Combined() {

			require_once 'reservation_form.php';
			$obj = new DTBooking_Cs_Sc_ReservationForm;
			$reservation_form = $obj->DTBooking_sc_ReservationForm();
			
			require_once 'reserve_appointment.php';
			$obj = new DTBooking_Cs_Sc_ReserveAppointment;
			$reserve_appointment = $obj->DTBooking_sc_ReserveAppointment();

			require_once 'service_list.php';
			$obj = new DTBooking_Cs_Sc_ServiceList;
			$service_list = $obj->DTBooking_sc_ServiceList();
			
			require_once 'service_item.php';
			$obj = new DTBooking_Cs_Sc_ServiceItem;
			$service_item = $obj->DTBooking_sc_ServiceItem();

			require_once 'person_item.php';
			$obj = new DTBooking_Cs_Sc_PersonItem;
			$person_item = $obj->DTBooking_sc_PersonItem();

			$options[] 	   = array(
			  'title'      => esc_html__('Reservation', 'dt-booking-manager'),
			  'shortcodes' => array(

				// begin: shortcode
				$reservation_form,
				$reserve_appointment,
				$service_list,
				$service_item,
				$person_item

			  ),
			);

			return $options;
		}
	}
}