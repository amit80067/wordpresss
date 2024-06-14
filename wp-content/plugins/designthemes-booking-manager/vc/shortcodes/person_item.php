<?php
if (! class_exists ( 'DTBookingPersonItem' ) ) {

    class DTBookingPersonItem extends DTBaseBookingSC {

        function __construct() {

            add_shortcode( 'dt_sc_person_item', array( $this, 'dt_sc_person_item' ) );
        }

		function dt_sc_person_item($attrs, $content = null ){
			extract( shortcode_atts( array(
				'person_id' => '',
				'type'  => 'type1',
				'show_button' => 'no',
				'button_text' => esc_html__('Book an appointment', 'dt-booking-manager')
			), $attrs ) );
	
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
	
			return $out;
		}
    }
}

new DTBookingPersonItem();