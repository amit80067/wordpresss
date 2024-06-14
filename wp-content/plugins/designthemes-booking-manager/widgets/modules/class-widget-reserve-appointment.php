<?php
use DTBookingManager\Widgets\DTBookingManagerWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Reserve_Appointment extends DTBookingManagerWidgetBase {

    public function get_name() {
        return 'dt-reserve-appointment';
    }

    public function get_title() {
        return __('Reserve Appointment', 'dt-booking-manager');
    }

    public function get_icon() {
		return 'far fa-calendar-check';
	}

    protected function register_controls() {

        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'General', 'dt-booking-manager'),
        ) );

            $this->add_control( 'title', array(
                'label' => esc_html__( 'Title', 'dt-booking-manager' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Make an Appointment', 'dt-booking-manager')
            ) );

            $this->add_control( 'type', array(
                'label' => esc_html__( 'Type', 'dt-booking-manager' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'type1',
                'options' => array(
                    'type1' => esc_html__( 'Type - I', 'dt-booking-manager' ),
                    'type2' => esc_html__( 'Type - II', 'dt-booking-manager' ),
                )
            ));

            $this->add_control( 'el_class', array(
                'type' => Controls_Manager::TEXT,
                'label'       => __('Extra class name', 'dt-booking-manager'),
                'description' => __('Style particular element differently - add a class name and refer to it in custom CSS', 'dt-booking-manager')
            ) );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        extract( $settings );

        $template = apply_filters( 'booking_appointment_template', "reservation/{$type}.php" );
        $template_args['title'] = $title;
        $template_args['class'] = $el_class;

        ob_start();
        dt_booking_get_template( $template, $template_args );

        echo ob_get_clean();
    }

    protected function content_template() {
    }
}