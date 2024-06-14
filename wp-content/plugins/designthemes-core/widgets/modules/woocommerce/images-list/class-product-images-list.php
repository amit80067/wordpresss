<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;

class DTElementor_Woo_Product_Images_List extends DTElementorWidgetBase {

	public function get_name() {
		return 'dt-shop-product-single-images-list';
	}

	public function get_title() {
		return __( 'Product Single - Images List', 'dt-elementor' );
	}

	public function get_style_depends() {
		return array( 'dtel-product-single-images-list' );
	}

	public function get_script_depends() {
		return array( 'dtel-product-single-images-list' );
	}

	protected function register_controls() {

		$this->start_controls_section( 'product_images_list_section', array(
			'label' => esc_html__( 'General', 'dt-elementor' ),
		) );

			$this->add_control( 'product_id', array(
				'label'       => esc_html__( 'Product Id', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('Provide product id for which you have to display woocommerce default product images gallery. No need to provide ID if it is used in Product single page.', 'dt-elementor'),				
			) );

			$this->add_control( 'include_featured_image', array(
				'label'        => esc_html__( 'Include Feature Image', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('If you wish, you can include featured image in this gallery.', 'dt-elementor'),
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
			) );

			$this->add_control( 'include_product_labels', array(
				'label'        => esc_html__( 'Include Product Labels', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('If you wish, you can include product labels in this gallery.', 'dt-elementor'),
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
			) );

			$this->add_control( 'enable_thumb_enlarger', array(
				'label'        => esc_html__( 'Enable Thumb Enlarger', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('If you wish, you can enable thumbnail enlarger in this gallery.', 'dt-elementor'),
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
			) );

			$this->add_control( 'columns', array(
				'label'       => __( 'Columns', 'dt-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'Number columns to show images in.', 'dt-elementor' ),
				'options'     => array( 1 => 1, 2 => 2 ),
				'default'     => 2,
	        ) );

			$this->add_control( 'enable_grid_space', array(
				'label'        => esc_html__( 'Enable Grid Space', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('If you wish, you can enable grid space in this gallery.', 'dt-elementor'),
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

			$product = wc_get_product( $settings['product_id'] );	

			$output .= '<div class="dt-sc-product-image-gallery-holder '.$settings['class'].'">';

				// Gallery Images
				$output .= '<div class="dt-sc-product-image-gallery-container">';

					if($settings['columns'] == 2) {
						$column_class = 'column dt-sc-one-half';
					} else if($settings['columns'] == 1) {
						$column_class = 'column dt-sc-one-column';
					}

					if($settings['enable_grid_space'] == 'false') {
						$column_class .= ' no-space';
					}

			    	if($settings['enable_thumb_enlarger'] == 'true') {
						$output .= '<div class="dt-sc-product-image-gallery-thumb-enlarger"></div>';
					}

			    	if($settings['include_product_labels'] == 'true') {

						ob_start();
						augury_woo_show_product_additional_labels();
						$product_sale_flash = ob_get_clean();

						$output .= $product_sale_flash;

					}
						
				    $output .= '<div class="dt-sc-product-image-gallery">';

				    	$i = 1;

	    				if($settings['include_featured_image'] == 'true') {

							$featured_image_id = get_post_thumbnail_id($settings['product_id']);
						
							$output .= '<div class="dt-sc-product-image '.$column_class.' first">';

								$attachment_id = $product->get_image_id();

								$image_size               = apply_filters( 'woocommerce_gallery_image_size', 'full' );
								$full_size                = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
								$full_src                 = wp_get_attachment_image_src( $attachment_id, $full_size );
								$image                    = wp_get_attachment_image( $attachment_id, $image_size, false, array(
									'title'                   => get_post_field( 'post_title', $attachment_id ),
									'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
									'data-src'                => $full_src[0],
									'data-large_image'        => $full_src[0],
									'data-large_image_width'  => $full_src[1],
									'data-large_image_height' => $full_src[2],
									'class'                   => 'wp-post-image',
								) );

								$output .= $image;

							$output .= '</div>';

							$i = 2;

						}

						$attachment_ids = $product->get_gallery_image_ids();

	                    if(is_array($attachment_ids) && !empty($attachment_ids)) {
	                        foreach($attachment_ids as $attachment_id) {

								if($i == 1) { $first_class = 'first';  } else { $first_class = ''; }
								if($i == $settings['columns']) { $i = 1; } else { $i = $i + 1; }	

                               	$output .= '<div class="dt-sc-product-image '.$column_class.' '.$first_class.'">';

									$image_size               = apply_filters( 'woocommerce_gallery_image_size', 'full' );
									$full_size                = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
									$full_src                 = wp_get_attachment_image_src( $attachment_id, $full_size );
									$image                    = wp_get_attachment_image( $attachment_id, $image_size, false, array(
										'title'                   => get_post_field( 'post_title', $attachment_id ),
										'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
										'data-src'                => $full_src[0],
										'data-large_image'        => $full_src[0],
										'data-large_image_width'  => $full_src[1],
										'data-large_image_height' => $full_src[2],
										'class'                   => '',
									) );

									$output .= $image;

                               	$output .= '</div>';

	                        }
	                    }

		    		$output .= '</div>';


		   		$output .= '</div>';

		   	$output .= '</div>';
			
		} else {
		
			$output .= esc_html__('Please provide product id to display corresponding data!', 'dt-elementor');
			
		}

		echo $output;

	}

}