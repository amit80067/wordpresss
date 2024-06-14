<?php
use DTBookingManager\Widgets\DTBookingManagerWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Person_Item extends DTBookingManagerWidgetBase {

    public function get_name() {
        return 'dt-person-item';
    }

    public function get_title() {
        return $this->get_singular_name();
    }

    public function get_icon() {
		return 'fas fa-user-alt';
	}

    public function get_singular_name() {

        $singular_name = esc_html__('Person', 'dt-booking-manager');

        if( function_exists( 'dt_booking_cs_get_option' ) ) :
            $singular_name = dt_booking_cs_get_option( 'singular-person-text', esc_html__('Person', 'dt-booking-manager') );
        endif;

        return $singular_name;
    }

    protected function register_controls() {

        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'General', 'dt-booking-manager'),
        ) );    

            $this->add_control( 'person_id', array(
                'label' => esc_html__( 'Enter Person ID', 'dt-booking-manager' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => $this->dt_get_post_ids('dt_person')
            ));

            $this->add_control( 'type', array(
                'label' => esc_html__( 'Type', 'dt-booking-manager' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'type1',
                'options' => array(
                    'type1' => esc_html__( 'Type - I', 'dt-booking-manager' ),
                    'type2' => esc_html__( 'Type - II', 'dt-booking-manager' ),
                )
            ));

            $this->add_control( 'show_button', array(
                'label' => esc_html__( 'Show button?', 'dt-booking-manager' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => array(
                    'yes' => esc_html__( 'Yes', 'dt-booking-manager' ),
                    'no' => esc_html__( 'No', 'dt-booking-manager' ),
                )
            ));

            $this->add_control( 'button_text', array(
                'label' => esc_html__( 'Button Text', 'dt-booking-manager' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Book an appointment', 'dt-booking-manager'),
            ));

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        extract( $settings );

        $out = '';

        #Performing query...
        $args = array('post_type' => 'dt_person', 'p' => $person_id );

        $the_query = new WP_Query($args);
        if($the_query->have_posts()):

            while($the_query->have_posts()): $the_query->the_post();
                $PID = $person_id;

                #Meta...
                $person_settings = get_post_meta($PID, '_custom_settings', true);
                $person_settings = is_array ( $person_settings ) ? $person_settings : array ();

                $out .= '<div class="dt-sc-person-item '.$type.'">';
                    $out .= '<div class="image">';
                            if(has_post_thumbnail()):
                                $attr = array('title' => get_the_title(), 'alt' => get_the_title());
                                $img_size = 'full';

                                if( $type == 'type2' ) {
                                    $img_size = 'dt-bm-person-type2';
                                }
                                $out .= get_the_post_thumbnail($PID, $img_size, $attr);
                            else:
                                $img_pros = '600x692';

                                if( $type == 'type2' ) {
                                    $img_pros = '205x205';
                                }
                                $out .= '<img src="https://place-hold.it/'.$img_pros.'&text='.get_the_title().'" alt="'.get_the_title().'" />';
                            endif;

                            if( $show_button == 'yes' ):
                                $out .= '<div class="dt-sc-person-overlay">';
                                    $out .= '<a class="dt-sc-button white medium bordered" href="'.get_permalink().'" title="'.get_the_title().'">'.esc_html($button_text).'</a>';
                                $out .= '</div>';
                            endif;
                    $out .= '</div>';

                    $out .= '<div class="person-details">';
                        $out .= '<h3><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
                        if( array_key_exists('person-role', $person_settings) ):
                            $out .= '<h6>'.$person_settings['person-role'].'</h6>';
                        endif;

                        if( array_key_exists('appointment_fs1', $person_settings) && array_key_exists('appointment_fs5', $person_settings) ):
                            $out .= '<p>'.esc_html__('Monday to Friday : ', 'dt-booking-manager').$person_settings['appointment_fs1']['dt_booking_monday_start'].' - '.$person_settings['appointment_fs5']['dt_booking_friday_end'].esc_html__(' hrs', 'dt-booking-manager');
                        endif;
                    $out .= '</div>';
                $out .= '</div>';
            endwhile;

            wp_reset_postdata();
        else:
            $out .= '<h2>'.esc_html__("Nothing Found.", "dt-booking-manager").'</h2>';
            $out .= '<p>'.esc_html__("Apologies, but no results were found for the requested archive.", "dt-booking-manager").'</p>';
        endif;

        echo $out;
    }

    protected function content_template() {
    }
}