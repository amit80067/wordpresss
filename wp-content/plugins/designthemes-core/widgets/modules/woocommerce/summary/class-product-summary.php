<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class DTElementor_Woo_Product_Summary extends DTElementorWidgetBase {

	public function get_name() {
		return 'dt-shop-product-single-summary';
	}

	public function get_title() {
		return __( 'Product Single - Summary', 'dt-elementor' );
	}

	public function get_style_depends() {
		return array( 'dtel-product-single-summary' );
	}

	protected function register_controls() {

		$this->start_controls_section( 'product_summary_section', array(
			'label' => esc_html__( 'General', 'dt-elementor' ),
		) );

			$this->add_control( 'product_id', array(
				'label'       => esc_html__( 'Product Id', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('Provide product id for which you have to display product summary items. No need to provide ID if it is used in Product single page.', 'dt-elementor'),				
			) );


			$repeater = new Repeater();

			$repeater->add_control( 'summary_item', array(
				'label'       => __( 'Summary Item', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     =>'title',
				'options'     => array(
					'title'              => esc_html__('Summary Title', 'dt-elementor'),
					'rating'             => esc_html__('Summary Rating', 'dt-elementor'),
					'price'              => esc_html__('Summary Price', 'dt-elementor'),
					'countdown'          => esc_html__('Summary Count Down', 'dt-elementor'),
					'excerpt'            => esc_html__('Summary Excerpt', 'dt-elementor'),
					'addtocart'          => esc_html__('Summary Add To Cart', 'dt-elementor'),
					'buttons'            => esc_html__('Summary Buttons', 'dt-elementor'),
					'meta'               => esc_html__('Summary Meta', 'dt-elementor'),
					'meta_sku'           => esc_html__('Summary Meta SKU', 'dt-elementor'),
					'meta_category'      => esc_html__('Summary Meta Category', 'dt-elementor'),
					'meta_tag'           => esc_html__('Summary Meta Tag', 'dt-elementor'),
					'share_follow'       => esc_html__('Summary Share / Follow', 'dt-elementor'),
					'additional_content' => esc_html__('Summary Additional Content', 'dt-elementor'),
					'separator1'         => esc_html__('Summary Separator 1', 'dt-elementor'),
					'separator2'         => esc_html__('Summary Separator 2', 'dt-elementor')
				)
	        ) );
	
			$this->add_control(
				'items',
				array (
					'label' => __( 'Items', 'dt-elementor' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' =>  array (
						array (
							'summary_item' => 'title'
						),
						array (
							'summary_item' => 'rating'
						),
						array (
							'summary_item' => 'price'
						),
						array (
							'summary_item' => 'excerpt'
						),
						array (
							'summary_item' => 'addtocart'
						),
						array (
							'summary_item' => 'meta'
						),
					),
					'title_field' => '{{{ summary_item }}}',
				)
			);

			$repeater = new Repeater();

			$repeater->add_control( 'button_item', array(
				'label'       => __( 'Button Item', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     =>'',
				'options'     => array(
					''          => esc_html__('None', 'dt-elementor'), 
					'wishlist'  => esc_html__('Button Wishlist', 'dt-elementor'), 
					'compare'   => esc_html__('Button Compare', 'dt-elementor'), 
					'sizeguide' => esc_html__('Button Size Guide', 'dt-elementor')
				)
	        ) );
	
			$this->add_control(
				'button_items',
				array (
					'label' => __( 'Button Items', 'dt-elementor' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' =>  array (),
					'title_field' => '{{{ button_item }}}',
				)
			);

			$this->add_control( 'content', array(
				'label' => __( 'Additional Content', 'dt-elementor' ),
				'type'  => Controls_Manager::WYSIWYG,				
			) );

			$this->add_control( 'share_follow_type', array(
				'label'   => __( 'Share / Follow Type', 'dt-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'share',
				'options' => array(
					'share'  => esc_html__('Share', 'dt-elementor'),
					'follow' => esc_html__('Follow', 'dt-elementor'),
				),
				'description' => esc_html__( 'Choose between Share / Follow you would like to use.', 'dt-elementor' ),
			) );

			$this->add_control( 'alignment', array(
				'label'   => __( 'Alignment', 'dt-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''            => esc_html__('Left', 'dt-elementor'), 
					'aligncenter' => esc_html__('Center', 'dt-elementor'), 
					'alignright'  => esc_html__('Right', 'dt-elementor'), 					
				),
				'description' => esc_html__( 'Choose alignment you would like to use for your product summary.', 'dt-elementor' ),
			) );

			$this->add_control( 'button_style', array(
				'label'   => __( 'Button Style', 'dt-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'simple',
				'options' => array(
					'simple'        => esc_html__( 'Simple', 'dt-elementor' ),
					'bgfill'        => esc_html__( 'BG Fill', 'dt-elementor' ),
					'brdrfill'      => esc_html__( 'Border Fill', 'dt-elementor' ),
					'skin-bgfill'   => esc_html__( 'Skin BG Fill', 'dt-elementor' ),
					'skin-brdrfill' => esc_html__( 'Skin Border Fill', 'dt-elementor' ),					
				),
				'description' => esc_html__( 'This option is applicable for all buttons used in product summary.', 'dt-elementor' ),
			) );

			$this->add_control( 'button_radius', array(
				'label'   => __( 'Button Radius', 'dt-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'square'  => esc_html__( 'Square', 'dt-elementor' ),
					'rounded' => esc_html__( 'Rounded', 'dt-elementor' ),
					'circle'  => esc_html__( 'Circle', 'dt-elementor' ),
				),
				'condition'   => array( 'button_style' => array ('bgfill', 'brdrfill', 'skin-bgfill', 'skin-brdrfill') ),
				'description' => esc_html__( 'This option is applicable for all buttons used in product summary.', 'dt-elementor' ),
			) );

			$this->add_control( 'button_inline_alignment', array(
				'label'        => __( 'Button Inline Alignment', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
				'description'  => esc_html__( 'This option is applicable for all buttons used in product summary.', 'dt-elementor' ),
			) );

			$this->add_control( 'button_hide_text', array(
				'label'        => __( 'Button Hide Text', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => 'false',
				'return_value' => 'true',
				'description'  => esc_html__( 'This option is applicable for all buttons used in product summary.', 'dt-elementor' ),
			) );

			$this->add_control( 'social_icon_style', array(
				'label'   => __( 'Social Icon Style', 'dt-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'simple'        => esc_html__( 'Simple', 'dt-elementor' ),
					'bgfill'        => esc_html__( 'BG Fill', 'dt-elementor' ),
					'brdrfill'      => esc_html__( 'Border Fill', 'dt-elementor' ),
					'skin-bgfill'   => esc_html__( 'Skin BG Fill', 'dt-elementor' ),
					'skin-brdrfill' => esc_html__( 'Skin Border Fill', 'dt-elementor' ),					
				),
				'description' => esc_html__( 'This option is applicable for all buttons used in product summary.', 'dt-elementor' ),
			) );

			$this->add_control( 'social_icon_radius', array(
				'label'   => __( 'Social Icon Radius', 'dt-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'square'  => esc_html__( 'Square', 'dt-elementor' ),
					'rounded' => esc_html__( 'Rounded', 'dt-elementor' ),
					'circle'  => esc_html__( 'Circle', 'dt-elementor' ),
				),
				'condition'   => array( 'social_icon_style' => array ('bgfill', 'brdrfill', 'skin-bgfill', 'skin-brdrfill') ),
			) );

			$this->add_control( 'social_icon_inline_alignment', array(
				'label'        => __( 'Social Icon Inline Alignment', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
				'description'  => esc_html__( 'This option is applicable for all buttons used in product summary.', 'dt-elementor' ),
			) );

			$this->add_control( 'meta_inline_alignment', array(
				'label'        => __( 'Meta Inline Alignment', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
				'description'  => esc_html__( 'This option is applicable for all buttons used in product summary.', 'dt-elementor' ),
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

		if($settings['product_id'] != '' && $settings['items'] != '') {

			global $product;

			$items = array ();
			$summary_items = $settings['items'];
			if(is_array($summary_items) && !empty($summary_items)) {
				foreach($summary_items as $summary_item) {
					array_push($items, $summary_item['summary_item']);
				}
			}

			$button_items = array ();
			$summary_button_items = $settings['button_items'];
			if(is_array($summary_button_items) && !empty($summary_button_items)) {
				foreach($summary_button_items as $summary_button_item) {
					array_push($button_items, $summary_button_item['button_item']);
				}
			}

			$button_style_cls = '';
			if($settings['button_style'] != '') {
				$button_style_cls = 'style-'.$settings['button_style'];
			}

			$button_radius_cls = '';
			if($settings['button_radius'] != '') {
				$button_radius_cls = 'radius-'.$settings['button_radius'];
			}

			$button_inline_alignment_cls = '';
			if($settings['button_inline_alignment'] == 'true') {
				$button_inline_alignment_cls = 'align-inline';
			}

			$button_hide_text_cls = '';
			if($settings['button_hide_text'] == 'true') {
				$button_hide_text_cls = 'hide-button-text';
			}

			$social_icon_style_cls = '';
			if($settings['social_icon_style'] != '') {
				$social_icon_style_cls = 'style-'.$settings['social_icon_style'];
			}

			$social_icon_radius_cls = '';
			if($settings['social_icon_radius'] != '') {
				$social_icon_radius_cls = 'radius-'.$settings['social_icon_radius'];
			}

			$social_icon_inline_alignment_cls = '';
			if($settings['social_icon_inline_alignment'] == 'true') {
				$social_icon_inline_alignment_cls = 'align-inline';
			}	

			$meta_inline_alignment_cls = '';
			if($settings['meta_inline_alignment'] == 'true') {
				$meta_inline_alignment_cls = 'align-inline';
			}	
		

			$output .= '<div class="dt-sc-product-summary summary entry-summary '.esc_attr($settings['class']).' '.esc_attr($settings['alignment']).'">';

				// Title
				$title = '';
				if(in_array('title', $items)) {
					ob_start();
					woocommerce_template_single_title();
					$woocommerce_template_single_title = ob_get_clean();
					$woocommerce_template_single_title = trim($woocommerce_template_single_title);
					$title = '<div class="dt-sc-single-product-title">'.$woocommerce_template_single_title.'</div>';
				}

				// Rating
				$rating = '';
				if(in_array('rating', $items)) {
					ob_start();
					woocommerce_template_single_rating();
					$woocommerce_template_single_rating = ob_get_clean();
					$rating = $woocommerce_template_single_rating;
				}

				// Price
				$price = '';
				if(in_array('price', $items)) {				
					ob_start();
					woocommerce_template_single_price();
					$woocommerce_template_single_price = ob_get_clean();
					$woocommerce_template_single_price = trim($woocommerce_template_single_price);
					$price = '<div class="dt-sc-single-product-price">'.$woocommerce_template_single_price.'</div>';
				}

				// Countdown
				$countdown = '';
				if(in_array('countdown', $items)) {				
					ob_start();
					augury_products_sale_countdown_timer();
					$woocommerce_template_countdown = ob_get_clean();
					$countdown = $woocommerce_template_countdown;
				}

				// Excerpt
				$excerpt = '';
				if(in_array('excerpt', $items)) {				
					ob_start();
					woocommerce_template_single_excerpt();
					$woocommerce_template_single_excerpt = ob_get_clean();
					$excerpt = $woocommerce_template_single_excerpt;
				}

				// Add to cart
				$addtocart = '';
				if(in_array('addtocart', $items)) {				
					ob_start();
					echo '<div class="product-buttons-wrapper product-button product-button-cart '.esc_attr($button_style_cls).' '.esc_attr($button_radius_cls).' '.esc_attr($button_inline_alignment_cls).'">';
						echo '<div class="wc_inline_buttons">';		
							echo '<div class="wcwl_btn_wrapper wc_btn_inline">';	
								woocommerce_template_single_add_to_cart();
							echo '</div>';
						echo '</div>';
					echo '</div>';			
					$woocommerce_template_single_add_to_cart = ob_get_clean();
					$addtocart = $woocommerce_template_single_add_to_cart;
				}	

				// Wishlist, Compare, Quick View, Size Guide
				$buttons = '';
				if(in_array('buttons', $items)) {

					$wishlist = $compare = $quickview = $sizeguide = '';
					if(in_array('wishlist', $button_items)) {
						ob_start();
						do_action( 'dt_woo_loop_product_button_elements_wishlist' );
						$wishlist = ob_get_clean();
						$wishlist = $wishlist;								
					}
					if(in_array('compare', $button_items)) {
						ob_start();
						do_action( 'dt_woo_loop_product_button_elements_compare' );
						$compare = ob_get_clean();
						$compare = $compare;									
					}
					if(in_array('quickview', $button_items)) {
						ob_start();
						do_action( 'dt_woo_loop_product_button_elements_quickview' );
						$quickview = ob_get_clean();
						$quickview = $quickview;							
					}
					if(in_array('sizeguide', $button_items)) {
						ob_start();
						do_action( 'dt_woo_loop_product_button_elements_sizeguide' );
						$sizeguide = ob_get_clean();
						$sizeguide = $sizeguide;							
					}

					ob_start();
					echo '<div class="product-buttons-wrapper product-button '.esc_attr($button_style_cls).' '.esc_attr($button_radius_cls).' '.esc_attr($button_inline_alignment_cls).' '.esc_attr($button_hide_text_cls).'">';
						echo '<div class="wc_inline_buttons">';
							// Build selected items
							foreach ($button_items as $key => $value) {
								echo $$value;
							}	
						echo '</div>';
					echo '</div>';	
							
					$woocommerce_buttons = ob_get_clean();
					$buttons = $woocommerce_buttons;

				}				

				// Meta
				$meta = '';
				if(in_array('meta', $items)) {				
					ob_start();
					echo '<div class="product_meta_wrapper '.esc_attr($meta_inline_alignment_cls).'">';
						woocommerce_template_single_meta();
					echo '</div>';
					$woocommerce_template_single_meta = ob_get_clean();
					$meta = $woocommerce_template_single_meta;
				}							

				// Meta SKU
				$meta_sku = '';
				if(in_array('meta_sku', $items)) {				
					if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) {
						$meta_data_sku = ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'dt-elementor' );
						$meta_sku = '<div class="product_meta_wrapper '.esc_attr($meta_inline_alignment_cls).'"><div class="product_meta"><span class="sku_wrapper"><strong>'.esc_html__( 'SKU:', 'dt-elementor' ).'</strong><span class="sku">'.$meta_data_sku.'</span></span></div></div>';
					}
				}

				// Meta Category
				$meta_category = '';
				if(in_array('meta_category', $items)) {				
					$meta_category = '<div class="product_meta_wrapper '.esc_attr($meta_inline_alignment_cls).'"><div class="product_meta">'.wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in"><strong>' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'dt-elementor' ) . '</strong> ', '</span>' ).'</div></div>';
				}

				// Meta Tag
				$meta_tag = '';
				if(in_array('meta_tag', $items)) {				
					$meta_tag = '<div class="product_meta_wrapper '.esc_attr($meta_inline_alignment_cls).'"><div class="product_meta">'.wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as"><strong>' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'dt-elementor' ) . '</strong> ', '</span>' ).'</div></div>';
				}				

				// Share / Follow
				$share_follow = '';
				if(in_array('share_follow', $items)) {				
					$share_follow = augury_single_product_sociable_share_follow($settings['product_id'], $settings['share_follow_type'], $social_icon_style_cls, $social_icon_radius_cls, $social_icon_inline_alignment_cls);
				}

				// Additional Content
				$additional_content = '';
				if(in_array('additional_content', $items)) {				
					if(isset($settings['content']) && !empty($settings['content'])) {
						$additional_content = '<div class="dt-sc-product-summary-additional-content">';
							$additional_content .= do_shortcode($settings['content']);
						$additional_content .= '</div>';
					}
				}				

				// Separator 1
				$separator1 = '';
				if(in_array('separator1', $items)) {
					$separator1 = '<div class="dt-sc-single-product-separator"></div>';
				}

				// Separator 2
				$separator2 = '';
				if(in_array('separator2', $items)) {
					$separator2 = '<div class="dt-sc-single-product-separator"></div>';
				}


				// Build selected items
				foreach ($items as $key => $value) {
					$output .= $$value;
				}				

		   	$output .= '</div>';
		
		} else {
		
			$output .= esc_html__('Please provide product id to display corresponding data!', 'dt-elementor');
			
		}

		echo $output;

	}

}
