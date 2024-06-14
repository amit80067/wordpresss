<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;

class DTElementor_Woo_Product_Images_Default extends DTElementorWidgetBase {

	public function get_name() {
		return 'dt-shop-product-images-default';
	}

	public function get_title() {
		return __( 'Product Single - Images Default', 'dt-elementor' );
	}

	protected function register_controls() {

		$this->start_controls_section( 'product_images_default_section', array(
			'label' => esc_html__( 'General', 'dt-elementor' ),
		) );

			$this->add_control( 'product_id', array(
				'label'       => esc_html__( 'Product Id', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('Provide product id for which you have to display woocommerce default product images gallery. No need to provide ID if it is used in Product single page.', 'dt-elementor'),				
			) );

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

			ob_start();
			do_action( 'woocommerce_before_single_product_summary' );
			$woocommerce_before_single_product_summary = ob_get_clean();

			$output .= $woocommerce_before_single_product_summary;
			
		} else {
		
			$output .= esc_html__('Please provide product id to display corresponding data!', 'dt-elementor');
			
		}

		echo $output;

	}

}