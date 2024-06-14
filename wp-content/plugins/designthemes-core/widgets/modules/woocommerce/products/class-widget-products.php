<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;

class DTElementor_Woo_Products extends DTElementorWidgetBase {

	public function get_name() {
		return 'dt-shop-products';
	}

	public function get_title() {
		return __( 'Products', 'dt-elementor' );
	}

	public function get_style_depends() {
		return array( 'dtel-products' );
	}

	public function get_script_depends() {
		return array( 'dtel-products' );
	}

	public function product_cats() {

		$categories = get_categories( array(
			'hide_empty' =>  0,
			'taxonomy'   =>  'product_cat'
		) );

		$categories_array = array ();

		foreach( $categories as $category ){
			$categories_array[ $category->term_id  ] = $category->name;
		}

		return $categories_array;
	}

	public function product_tags() {

		$tags = get_categories( array(
			'hide_empty' =>  0,
			'taxonomy'   =>  'product_tag'
		) );

		$tags_array = array ();

		foreach( $tags as $tag ){

			$tags_array[ $tag->term_id ] = $tag->name;
		}

		return $tags_array;		
	}

	public function product_posts() {

		$product_posts = get_posts( array( 
			'posts_per_page' => -1, 
			'post_type'      => 'product'
		) );

		$product_title_array = array ();

		foreach($product_posts as $product_post){
			$product_title_array[ $product_post->ID ] = $product_post->post_title;
		}

		return $product_title_array;
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

		$this->general_section();
		$this->filter_section();
		$this->carousel_section();
	}

	public function general_section() {

		$this->start_controls_section( 'products_section', array(
			'label' => esc_html__( 'General', 'dt-elementor' ),
		) );

			$this->add_control( 'data_source', array(
				'label'       => __( 'Data Source', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					''           => esc_html__('All Products', 'dt-elementor'),
					'featured'   => esc_html__('Featured Products', 'dt-elementor'),
					'sale'       => esc_html__('Sale Products', 'dt-elementor'),
					'bestseller' => esc_html__('Bestsellers', 'dt-elementor'),
				),
	        ) );

			$this->add_control( 'show_pagination', array(
				'label'        => esc_html__( 'Show Pagination', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'dt-elementor' ),
				'label_off'    => __( 'False', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
			) );

			$this->add_control( 'enable_carousel', array(
				'label'        => esc_html__( 'Enable Carousel', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'dt-elementor' ),
				'label_off'    => __( 'False', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
				'condition'   => array( 'show_pagination' => '' ),				
			) );

			$this->add_control( 'post_per_page', array(
				'label'   => esc_html__( 'Post Per Page', 'dt-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 12
			) );

			$this->add_control( 'display_mode', array(
				'label'       => __( 'Display Mode', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'grid' => __('Grid', 'dt-elementor'),
					'list' => __('List', 'dt-elementor'),
				),
				'default'     => 'grid',
	        ) );

			$this->add_control( 'columns', array(
				'label'       => __( 'Columns', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
				'default'     => 4,
				'condition'   => array( 'display_mode' => 'grid' ),
	        ) );

			$this->add_control( 'list_options', array(
				'label'       => __( 'List Options', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'left-thumb'  => __('Left Thumb', 'dt-elementor'),
					'right-thumb' => __('Right Thumb', 'dt-elementor'),
				),
				'default'     => 'left-thumb',
				'condition'   => array( 'display_mode' => 'list' ),
	        ) );

			$this->add_control( 'product_style_template', array(
				'label'       => __( 'Product Style Template', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Choose number of products that you like to display.', 'dt-elementor' ),
				'options'     => $this->product_style_templates(),
				'default'     => '-1',
	        ) );
			
			$this->add_control(
				'class',
				array (
					'label' => __( 'Class', 'dt-elementor' ),
					'type'  => Controls_Manager::TEXT
				)
			);

			$this->add_control(
				'current_page',
				array (
					'label' => __( 'Current Page', 'dt-elementor' ),
					'type'  => Controls_Manager::HIDDEN,
					'default' => 1
				)
			);

			$this->add_control(
				'offset',
				array (
					'label' => __( 'Offset', 'dt-elementor' ),
					'type'  => Controls_Manager::HIDDEN,
					'default' => 0
				)
			);

		$this->end_controls_section();
	}

	public function filter_section() {

		$this->start_controls_section( 'filter_section', array(
			'label' => esc_html__( 'Filters', 'dt-elementor' ),
		) );

			$this->add_control( 'categories', array(
				'label'       => __( 'Categories', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'description' => esc_html__( 'Choose categories that you want to display.', 'dt-elementor' ),
				'options'     => $this->product_cats(),
	        ) );

			$this->add_control( 'tags', array(
				'label'       => __( 'Tags', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'description' => esc_html__( 'Choose tags that you want to display.', 'dt-elementor' ),
				'options'     => $this->product_tags(),
	        ) );

			$this->add_control( 'include', array(
				'label'       => __( 'Include', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'description' => esc_html__( 'Choose product that you want to display.', 'dt-elementor' ),
				'options'     => $this->product_tags(),
	        ) );

			$this->add_control( 'exclude', array(
				'label'       => __( 'Exclude', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'description' => esc_html__( 'Choose product that you don\'t want to display.', 'dt-elementor' ),
				'options'     => $this->product_tags(),
	        ) );	        

		$this->end_controls_section();
	}

	public function carousel_section() {
		$this->start_controls_section( 'product_carousel_section', array(
			'label'     => esc_html__( 'Carousel Settings', 'dt-elementor' ),
			'condition' => array( 'enable_carousel' => 'true' ),
		) );
			$this->add_control( 'carousel_effect', array(
				'label'       => __( 'Effect', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Choose effect for your carousel. Slides Per View has to be 1 for Fade effect.', 'dt-elementor' ),
				'default'     => '',
				'options'     => array(
					''     => __( 'Default', 'dt-elementor' ),
					'fade' => __( 'Fade', 'dt-elementor' ),
	            ),
	        ) );

			$this->add_control( 'carousel_slidesperview', array(
				'label'       => __( 'Slides Per View', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Number slides of to show in view port.', 'dt-elementor' ),
				'options'     => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
				'default'     => 2,
	        ) );

			$this->add_control( 'carousel_loopmode', array(
				'label'        => esc_html__( 'Enable Loop Mode', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('If you wish, you can enable continuous loop mode for your carousel.', 'dt-elementor'),
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
			) );

			$this->add_control( 'carousel_mousewheelcontrol', array(
				'label'        => esc_html__( 'Enable Mousewheel Control', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('If you wish, you can enable mouse wheel control for your carousel.', 'dt-elementor'),
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
			) );

			$this->add_control( 'carousel_bulletpagination', array(
				'label'        => esc_html__( 'Enable Bullet Pagination', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('To enable bullet pagination.', 'dt-elementor'),
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
			) );

			$this->add_control( 'carousel_arrowpagination', array(
				'label'        => esc_html__( 'Enable Arrow Pagination', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('To enable arrow pagination.', 'dt-elementor'),
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
			) );

			$this->add_control( 'carousel_arrowpagination_type', array(
				'label'       => __( 'Arrow Type', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Choose arrow pagination type for your carousel.', 'dt-elementor' ),
				'options'     => array( 
					''      => esc_html__('Default', 'dt-elementor'), 
					'type2' => esc_html__('Type 2', 'dt-elementor'), 
				),
				'condition'   => array( 'carousel_arrowpagination' => 'true' ),				
				'default'     => '',
	        ) );

			$this->add_control( 'carousel_scrollbar', array(
				'label'        => esc_html__( 'Enable Scrollbar', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('To enable scrollbar for your carousel.', 'dt-elementor'),
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
			) );

			$this->add_control( 'carousel_spacebetween', array(
				'label'       => esc_html__( 'Space Between Sliders', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('Space between sliders can be given here.', 'dt-elementor'),
			) );	        						


		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings();

		$output = productsWidgetHtml($settings);

		echo $output;

	}

}