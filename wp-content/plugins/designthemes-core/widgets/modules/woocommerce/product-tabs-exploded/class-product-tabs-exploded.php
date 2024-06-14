<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;

class DTElementor_Woo_Product_Tabs_Exploded extends DTElementorWidgetBase {

	public function get_name() {
		return 'dt-shop-product-single-tabs-exploded';
	}

	public function get_title() {
		return __( 'Product Single - Tabs Exploded', 'dt-elementor' );
	}

	public function get_style_depends() {
		return array( 'dtel-product-single-tabs-exploded' );
	}

	public function get_script_depends() {
		return array( 'jquery.nicescroll', 'dtel-product-single-tabs-exploded' );
	}

	protected function register_controls() {
		$this->start_controls_section( 'product_tabs_exploded_section', array(
			'label' => esc_html__( 'General', 'dt-elementor' ),
		) );

			$this->add_control( 'product_id', array(
				'label'       => esc_html__( 'Product Id', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('Provide product id for which you have to display product summary items. No need to provide ID if it is used in Product single page.', 'dt-elementor'),				
			) );

			$this->add_control( 'tab', array(
				'label'       => __( 'Tab', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__('Choose tab that you would like to use.', 'dt-elementor'),
				'default'     => 'description',
				'options'     => array(
					'description'            => esc_html__( 'Description', 'dt-elementor' ),
					'review'                 => esc_html__( 'Review', 'dt-elementor' ),
					'additional_information' => esc_html__( 'Additional Information', 'dt-elementor' ),
					'custom_tab_1'           => esc_html__( 'Custom Tab 1', 'dt-elementor' ),
					'custom_tab_2'           => esc_html__( 'Custom Tab 2', 'dt-elementor' ),
					'custom_tab_3'           => esc_html__( 'Custom Tab 3', 'dt-elementor' ),
					'custom_tab_4'           => esc_html__( 'Custom Tab 4', 'dt-elementor' ),					
				),
			) );			

			$this->add_control( 'hide_title', array(
				'label'        => __( 'Hide Title', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
				'description'  => esc_html__( 'If you wish to hide title you can do it here', 'dt-elementor' ),
			) );			

			$this->add_control( 'apply_scroll', array(
				'label'        => __( 'Apply Content Scroll', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
				'description'  => esc_html__( 'If you wish to apply scroll you can do it here', 'dt-elementor' ),
			) );

			$this->add_control( 'scroll_height', array(
				'label'       => esc_html__( 'Scroll Height (px)', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Specify height for your section here.', 'dt-elementor' ),
				'condition'   => array( 'apply_scroll' => 'true' ),
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

		$output = dt_product_tabs_exploded_render_html($settings);

		echo $output;

	}

}		