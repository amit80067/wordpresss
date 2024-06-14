<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;

class Elementor_Header_Icons extends DTElementorWidgetBase {

	public function get_name() {
		return 'dt-header-icons';
	}

	public function get_title() {
		return __( 'Header Icons', 'dt-elementor' );
	}

	public function get_style_depends() {
		return array( 'dt-header-icons' );
	}

	public function get_script_depends() {
		return array( 'dt-header-icons' );
	}

	protected function register_controls() {

		$this->start_controls_section( 'header_icons_general_section', array(
			'label' => esc_html__( 'General', 'dt-elementor' ),
		) );

			$this->add_control( 'show_cart_icon', array(
				'label'        => __( 'Show Cart Icon', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			) );

			$this->add_control( 'cart_action', array(
				'label'       => __( 'Cart Action', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => __( 'Choose how you want to display the cart content.', 'dt-elementor'),
				'default'     => '',
				'options'     => array(
					''                    => __( 'None', 'dt-elementor'),
					'notification_widget' => __( 'Notification Widget', 'dt-elementor' ),
					'sidebar_widget'      => __( 'Sidebar Widget', 'dt-elementor' ),
				),
				'condition' => array( 'show_cart_icon' => 'yes' )
	        ) );

			$this->add_control( 'show_loginlogout_icon', array(
				'label'        => __( 'Show Login / Logout Icon', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			) );

			$this->add_control( 'show_search_icon', array(
				'label'        => __( 'Show Search Icon', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			) );

			$this->add_control( 'search_type', array(
				'label'       => __( 'Search Type', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => __( 'Choose type of search form to use.', 'dt-elementor'),
				'default'     => '',
				'options'     => array(
					''      => __( 'Default', 'dt-elementor'),
					'overlay' => __( 'Overlay', 'dt-elementor' )
				),
				'condition' => array( 'show_search_icon' => 'yes' )
	        ) );

			$this->add_control(
				'class',
				array (
					'label' => __( 'Class', 'dt-elementor' ),
					'type'  => Controls_Manager::TEXT
				)
			);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		$output = '';

		if( ( function_exists( 'is_woocommerce' ) && $settings['show_cart_icon'] == 'yes' ) || $settings['show_loginlogout_icon'] == 'yes' || $settings['show_search_icon'] == 'yes' ) {

			$output .= '<div class="dt-sc-header-icons-list '.$settings['class'].'">';

			if( function_exists( 'is_woocommerce' ) && $settings['show_cart_icon'] == 'yes' ) {

				$output .= '<div class="dt-sc-header-icons-list-item cart-item">';

					$output .= '<div class="dt-sc-shop-menu-icon">';

						$output .= '<a href="'.esc_url( wc_get_cart_url() ).'">';
							$output .= '<span class="dt-sc-shop-menu-icon-wrapper">';
								$output .= '<span class="dt-sc-shop-menu-cart-inner">';
									$output .= '<span class="dt-sc-shop-menu-cart-icon"></span>';
									$output .= '<span class="dt-sc-shop-menu-cart-number">0</span>';
								$output .= '</span>';
								$output .= '<span class="dt-sc-shop-menu-cart-totals"></span>';
							$output .= '</span>';
						$output .= '</a>';

						if($settings['cart_action'] == 'notification_widget') {

							$output .= '<div class="dt-sc-shop-menu-cart-content-wrapper">';
								$output .= '<div class="dt-sc-shop-menu-cart-content">'.esc_html__('No products added!', 'augury').'</div>';
							$output .= '</div>';

							set_site_transient( 'cart_action', 'notification_widget', 12 * HOUR_IN_SECONDS );

						} else if($settings['cart_action'] == 'sidebar_widget') {

							set_site_transient( 'cart_action', 'sidebar_widget', 12 * HOUR_IN_SECONDS );

						} else {
							
							set_site_transient( 'cart_action', 'none', 12 * HOUR_IN_SECONDS );

						}

					$output .= '</div>';

				$output .= '</div>';

			}

			if( $settings['show_loginlogout_icon'] == 'yes' ) {

				$output .= '<div class="dt-sc-header-icons-list-item loginlogout-item">';

					if (is_user_logged_in()) {

						$current_user = wp_get_current_user();
						$user_info = get_userdata($current_user->ID);

						$output .= '<div class="dt-sc-loginlogout-menu-icon">';
							$output .= '<a href="'.wp_logout_url().'"><span>'.get_avatar( $current_user->ID, 150).'<label>'.esc_html__('Log Out', 'dt-elementor').'</label></span></a>';
						$output .= '</div>';

					} else {
						$output .= '<div class="dt-sc-loginlogout-menu-icon">';
							$output .= '<a href="'.wp_login_url(get_permalink()).'"><span><i class="fa fa-unlock-alt"></i><label>'.esc_html__('Log In', 'dt-elementor').'</label></span></a>';
						$output .= '</div>';
					}

				$output .= '</div>';

			}

			if( $settings['show_search_icon'] == 'yes' ) {

				$output .= '<div class="dt-sc-header-icons-list-item search-item">';

					$output .= '<div class="dt-sc-search-menu-icon">';

						$output .= '<a href="javascript:void(0)" class="dt-sc-search-icon"><span class="fas fa-search"></span></a>';

						if( $settings['search_type'] == 'overlay' ) {

							$output .= '<div class="dt-sc-search-form-container search-overlay">';

								ob_start();
								get_search_form();
								$output .= ob_get_clean();

								$output .= '<div class="dt-sc-search-overlay-form-close"></div>';

							$output .= '</div>';

						} else {

							$output .= '<div class="dt-sc-search-form-container">';

								ob_start();
								get_search_form();
								$output .= ob_get_clean();

							$output .= '</div>';

						}

					$output .= '</div>';

				$output .= '</div>';

			}

			$output .= '</div>';

		}

		echo $output;

	}

}