<?php
use DTBookingManager\Widgets\DTBookingManagerWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Service_List extends DTBookingManagerWidgetBase {

    public function get_name() {
        return 'dt-service-list';
    }

    public function get_title() {
        return $this->get_singular_name().esc_html__(' List', 'dt-booking-manager');
    }

    public function get_icon() {
		return 'fas fa-clipboard-list';
	}

    public function get_singular_name() {

        $singular_name = esc_html__('Service', 'dt-booking-manager');

        if( function_exists( 'dt_booking_cs_get_option' ) ) :
            $singular_name = dt_booking_cs_get_option( 'singular-service-text', esc_html__('Service', 'dt-booking-manager') );
        endif;

        return $singular_name;
    }

    protected function register_controls() {

        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'General', 'dt-booking-manager'),
        ) );

            $this->add_control( 'terms', array(
                'label' => esc_html__( 'Terms', 'dt-booking-manager' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->dt_service_categories()
            ) );

            $this->add_control( 'posts_per_page', array(
                'label' => esc_html__( 'Products Per Page', 'dt-booking-manager' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
            ));

            $this->add_control( 'orderby', array(
                'label' => esc_html__( 'Order by', 'dt-booking-manager' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ID',
                'options' => array(
                    'ID' => esc_html__( 'ID', 'dt-booking-manager' ),
                    'title' => esc_html__( 'Title', 'dt-booking-manager' ),
                    'name' => esc_html__( 'Name', 'dt-booking-manager' ),
                    'type' => esc_html__( 'Type', 'dt-booking-manager' ),
                    'date' => esc_html__( 'Date', 'dt-booking-manager' ),
                    'rand' => esc_html__( 'Random', 'dt-booking-manager' ),
                )
            ));

            $this->add_control( 'order', array(
                'label' => esc_html__( 'Sort order', 'dt-booking-manager' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => array(
                    'desc' => esc_html__( 'Descending', 'dt-booking-manager' ),
                    'asc' => esc_html__( 'Ascending', 'dt-booking-manager' ),
                )
            ));

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

		$categories = !empty($terms) ? $terms : array();

		$query_args = array();
		if( empty($categories) ):
			$query_args = array( 'posts_per_page' => $posts_per_page, 'orderby' => $orderby, 'order' => $order, 'post_status' => 'publish', 'post_type' => 'dt_service');
		else:
			$query_args = array(
				'post_type'           => 'dt_service',
				'post_status'         => 'publish',
				'posts_per_page'      => $posts_per_page,
				'orderby'             => $orderby,
				'order'               => $order,
				'tax_query' => array(
					array(
						'taxonomy' => 'dt_service_category',
						'field' => 'term_id',
						'operator' => 'IN',
						'terms' => $categories
					)
				)
			);
		endif;

		$the_query = new WP_Query($query_args);
		if ( $the_query->have_posts() ) :

			$out .= '<div class="dt-services-list '.esc_attr($el_class).'">';

				while ( $the_query->have_posts() ) : $the_query->the_post();
					$PID = get_the_ID();

					#Meta...
					$service_settings = get_post_meta($PID, '_custom_settings', true);
					$service_settings = is_array ( $service_settings ) ? $service_settings : array ();

					$out .= '<div class="dt-sc-service-item dt-sc-one-column column">';
						$out .= '<div class="image">';
							if(has_post_thumbnail()):
								$attr = array('title' => get_the_title(), 'alt' => get_the_title());
								$out .= get_the_post_thumbnail($PID, 'dt-bm-service-type2', $attr);
							else:
								$out .= '<img src="https://place-hold.it/205x205&text='.get_the_title().'" alt="'.get_the_title().'" />';
							endif;
						$out .= '</div>';

						$out .= '<div class="service-details">';
							$out .= '<h3><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';

							if( array_key_exists('service_opt_flds', $service_settings) ):
								$out .= '<div class="dt-sc-service-meta">';
									$out .= '<ul>';
										for($i = 1; $i <= (sizeof($service_settings['service_opt_flds']) / 2); $i++):

											$title = $service_settings['service_opt_flds']['service_opt_flds_title_'.$i];
											$value = $service_settings['service_opt_flds']['service_opt_flds_value_'.$i];

											if( !empty($value) ):
												$out .= '<li>'.esc_html($value).' '.esc_html($title).'</li>';
											endif;
										endfor;
									$out .= '</ul>';
								$out .= '</div>';
							endif;

							if( array_key_exists('service-price', $service_settings) && $service_settings['service-price'] != '' ):
								$out .= '<h4>'.dt_booking_get_currency_symbol().$service_settings['service-price'].'</h4>';
							endif;
						$out .= '</div>';

					$out .= '</div>';
				endwhile;

			$out .= '</div>';

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