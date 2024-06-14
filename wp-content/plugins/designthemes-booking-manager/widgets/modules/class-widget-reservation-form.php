<?php
use DTBookingManager\Widgets\DTBookingManagerWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Reservation_Form extends DTBookingManagerWidgetBase {

    public function get_name() {
        return 'dt-reservation-form';
    }

    public function get_title() {
        return __('Reservation Form', 'dt-booking-manager');
    }

    public function get_icon() {
		return 'fab fa-wpforms';
	}

    protected function register_controls() {

        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'General', 'dt-booking-manager'),
        ) );

			$this->add_control( 'title', array(
				'label' => esc_html__( 'Title', 'dt-booking-manager' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Appointment', 'dt-booking-manager'),
			) );

            $this->add_control( 'serviceids', array(
                'label' => esc_html__( 'Service IDs', 'dt-booking-manager' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->dt_get_post_ids('dt_service')
            ) );

            $this->add_control( 'staffids', array(
                'label' => esc_html__( 'Staff IDs', 'dt-booking-manager' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->dt_get_post_ids('dt_person')
            ) );

			$this->add_control(	'el_class', array(
				'type' => Controls_Manager::TEXT,
				'label'       => __('Extra class name', 'dt-booking-manager'),
				'description' => __('Style particular element differently - add a class name and refer to it in custom CSS', 'dt-booking-manager')
			) );

		$this->end_controls_section();
	}

    protected function render() {

		$settings = $this->get_settings();
		extract( $settings );

		$out = '';

		$url = get_page_link( cs_get_option('appointment-pageid') );
		$url = isset( $url ) ? $url : '';

		if($url != '') {

			$out = '<div class="dt-sc-appointment-wrapper '.esc_attr($el_class).'">';

				$out .= '<h2>'.$title.'</h2>';

				$out .= '<form class="dt-sc-reservation-form dt-appointment-form" name="reservation-schedule-form" method="post" action="'.$url.'">';

				$out .= '<div class="dt-sc-one-column column">
							<p><input type="text" id="cli-name" name="cli-name" placeholder="'.esc_attr__('Name','dt-booking-manager').'"></p>
						</div>';

				$out .= '<div class="dt-sc-one-column column">
							<p><input type="text" id="cli-email" name="cli-email"  placeholder="'.esc_attr__('Email','dt-booking-manager').'"></p>
						</div>';

				$out .= '<div class="dt-sc-one-column column">
							<p><select name="services" id="services" class="dt-select-service">
							  <option value="">'. esc_html__('Type of Service', 'dt-booking-manager').'</option>';
							  if($serviceids != '') {
								  $cp_services = get_posts( array('post_type'=>'dt_service', 'posts_per_page'=>'-1', 'post__in' => $serviceids, 'suppress_filters' => false ));
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
							<p class="dt-appoint-date"><span class="far fa-calendar-alt"></span><input type="text" id="datepicker" name="date" placeholder="'.esc_attr__('Preferred Date','dt-booking-manager').'" readonly="readonly" /></p>
						 </div>';

				$out .= '<div class="dt-sc-one-column column">
							<p><select name="staff" id="staff" class="dt-select-staff">
								<option value="">'. esc_html__('Name of Person','dt-booking-manager').'</option>';
								if($staffids != '') {
									$cp_staffs = get_posts( array('post_type'=>'dt_person', 'posts_per_page'=>'-1', 'post__in' => $staffids ) );
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
								<button class="dt-sc-button filled medium show-time-shortcode" value="'.esc_attr__('Show Time', 'dt-booking-manager').'" type="submit">'.esc_html__('Fix an appointment', 'dt-booking-manager').'</button>
							</div>
						</div>';
				$staffids   = isset( $staffids ) ? implode(',', $staffids) : '';
				$serviceids = isset( $serviceids ) ? implode(',', $serviceids) : '';
				$out .= '<input type="hidden" id="staffids" name="staffids" value="'.$staffids.'" /><input type="hidden" id="serviceids" name="serviceids" value="'.$serviceids.'" />';

				$out .= '</form>';

			$out .= '</div>';
		} else {
			$out .= '<div class="dt-sc-info-box">'.esc_html__('Please create Reservation template page in order to make this shortcode work properly!', 'dt-booking-manager').'</div>';
		}

		echo $out;
	}

	protected function content_template() {
    }
}