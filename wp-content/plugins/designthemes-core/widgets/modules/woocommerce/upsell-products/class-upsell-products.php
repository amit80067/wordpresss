<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;

class DTElementor_Woo_Upsell_Products extends DTElementorWidgetBase {

	public function get_name() {
		return 'dt-shop-upsell-products';
	}

	public function get_title() {
		return __( 'Product Single - Upsell Products', 'dt-elementor' );
	}

	public function get_style_depends() {
		return array( 'dtel-product-single-upsell-products' );
	}

	public function product_style_templates() {

		$shop_product_templates = array();
		$shop_product_templates[-1] = esc_html__('Admin Option', 'dt-elementor');

		$args = array ( 'post_type' => 'dt_product_template', 'post_status' => 'publish' );

		$product_template_pages = get_posts( $args );

		foreach($product_template_pages as $product_template_page) {
			$id = $product_template_page->ID;
			$shop_product_templates[$id] = get_the_title($id);
		}

		return $shop_product_templates;
	}

	protected function register_controls() {
		$this->start_controls_section( 'upsell_products_section', array(
			'label' => esc_html__( 'General', 'dt-elementor' ),
		) );

			$this->add_control( 'product_id', array(
				'label'       => esc_html__( 'Product Id', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('Provide product id for which you have to display product summary items. No need to provide ID if it is used in Product single page.', 'dt-elementor'),				
			) );

			$this->add_control( 'columns', array(
				'label'       => __( 'Columns', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Choose column that you like to display upsell products.', 'dt-elementor' ),
				'options'     => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
				'default'     => 4,
	        ) );

			$this->add_control( 'limit', array(
				'label'       => __( 'Limit', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Choose number of products that you like to display.', 'dt-elementor' ),
				'options'     => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10 ),
				'default'     => 4,
	        ) );

			$this->add_control( 'product_style_template', array(
				'label'       => __( 'Product Style Template', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Choose number of products that you like to display.', 'dt-elementor' ),
				'options'     => $this->product_style_templates(),
				'default'     => '-1',
	        ) );

			$this->add_control( 'hide_title', array(
				'label'        => esc_html__( 'Hide Title', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('If you wish to hide title you can do it here', 'dt-elementor'),
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
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
	
		if($settings['product_id'] == '' && is_singular('product')) {
			global $post;
			$settings['product_id'] = $post->ID;
		}

		if($settings['product_id'] != '') {

			$output .= '<div class="dt-sc-product-upsell-products '.$settings['class'].'">';

				if($settings['product_style_template'] == 'admin-option') {
					$product_style_template = augury_get_option( 'dt-single-product-upsell-style-template' );
				} else {
					$product_style_template = $settings['product_style_template'];
				}

				$display_mode = augury_woo_post_display_mode_from_location($product_style_template);
				if($display_mode == 'list') {
					$settings['columns'] = 1;	
				}
				
				// Hide Title
				wc_set_loop_prop('product_upsell_hide_title', $settings['hide_title']);
				wc_set_loop_prop('is_shortcode', 1);
				wc_set_loop_prop('product_style_template', $product_style_template);

				$output .= augury_product_style_setup_template_prop($product_style_template); /* Call Product Style Variables Setup */

				ob_start();
				woocommerce_upsell_display( $limit =  $settings['limit'], $columns = $settings['columns'], $orderby = 'rand', $order = 'desc' );
				$output .= ob_get_clean();

				augury_product_style_reset_template_prop(); /* Reset Product Style Variables Setup */
				
			$output .= '</div>';
			
		} else {
		
			$output .= esc_html__('Please provide product id to display corresponding data!', 'dt-elementor');
			
		}

		echo $output;

	}

}