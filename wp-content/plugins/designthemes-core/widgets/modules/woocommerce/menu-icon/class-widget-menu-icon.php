<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;

class DTElementor_Woo_Menu_Icon extends DTElementorWidgetBase {

	public function get_name() {
		return 'dt-shop-menu-icon';
	}

	public function get_title() {
		return __( 'Menu Icon', 'dt-elementor' );
	}

	public function get_style_depends() {
		return array( 'dtel-shop-menu-icon' );
	}

	public function get_script_depends() {
		return array( 'jquery.nicescroll', 'dtel-shop-menu-icon' );
	}

	protected function register_controls() {

		$this->start_controls_section( 'cart_icon_section', array(
			'label' => esc_html__( 'Cart Icon', 'dt-elementor' ),
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

		$output = '';

		if( function_exists( 'is_woocommerce' ) ) {

			$settings = $this->get_settings();

			$output .= '<div class="dt-sc-shop-menu-icon '.$settings['class'].'">';

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

		}

		echo $output;

	}

}