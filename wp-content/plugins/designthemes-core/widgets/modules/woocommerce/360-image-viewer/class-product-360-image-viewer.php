<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;

class DTElementor_Woo_Product_360_Image_Viewer extends DTElementorWidgetBase {

	public function get_name() {
		return 'dt-shop-product-single-images-360-viewer';
	}

	public function get_title() {
		return __( 'Product Single - Images 360 Viewer', 'dt-elementor' );
	}

	public function get_style_depends() {
		return array( 'dtel-product-single-images-360-viewer' );
	}

	public function get_script_depends() {
		return array( 'jquery.360viewer', 'dtel-product-single-images-360-viewer' );
	}

	protected function register_controls() {

		$this->start_controls_section( 'product_images_360viewer_section', array(
			'label' => esc_html__( 'Product', 'dt-elementor' ),
		) );

			$this->add_control( 'product_id', array(
				'label'       => esc_html__( 'Product Id', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('Provide product id for which you have to display product images in list format. No need to provide ID if it is used in Product single page.', 'dt-elementor'),				
			) );

			$this->add_control( 'enable_popup_viewer', array(
				'label'        => esc_html__( 'Enable PopUp Viewer', 'dt-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__('If you wish, you can show 360 viewer in popup.', 'dt-elementor'),
				'label_on'     => __( 'yes', 'dt-elementor' ),
				'label_off'    => __( 'no', 'dt-elementor' ),
				'default'      => '',
				'return_value' => 'true',
			) );

			$this->add_control(
				'source',
				array (
					'label' => __( 'Source', 'dt-elementor' ),
					'type'  => Controls_Manager::TEXT
				)
			);

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

			if($settings['enable_popup_viewer'] == 'true') {

				$viewer360_gallery_ids = get_post_meta ( $settings['product_id'], '_360viewer_gallery', true );
				$viewer360_gallery_ids = (isset($viewer360_gallery_ids['product-360view-gallery']) && $viewer360_gallery_ids['product-360view-gallery'] != '') ? explode(',', $viewer360_gallery_ids['product-360view-gallery']) : array ();

				if(isset($viewer360_gallery_ids[0])) {

					$output .= '<div class="dt-sc-product-image-360-viewer-holder dt-sc-product-image-360-popup-viewer-holder '.$settings['class'].'">';

						$output .= '<div class="dt-sc-product-image-360-viewer-enlarger">A</div>';

						if($settings['source'] != 'single-product') {

							$image = wp_get_attachment_image( $viewer360_gallery_ids[0], 'full', false );
							$output .= $image;

						}

						$output .= '<div class="dt-sc-product-image-360-viewer-container">';

							$output .= '<div class="dt-sc-product-image-360-viewer" data-count="'.count($viewer360_gallery_ids).'">';

			                    if(is_array($viewer360_gallery_ids) && !empty($viewer360_gallery_ids)) {
			                    	$i = 1;
			                        foreach($viewer360_gallery_ids as $viewer360_gallery_id) {

										$image = wp_get_attachment_image( $viewer360_gallery_id, 'full', false, array (
													'data-index' => $i,
												) );

										$output .= $image;

										$i++;

			                        }
			                    }

					   		$output .= '</div>';

					   		$output .= '<div class="dt-sc-product-image-360-viewer-close">'.esc_html__( 'Close', 'dt-elementor' ).'</div>';

					   	$output .= '</div>';

					$output .= '</div>';

				}

			} else {

				$output .= '<div class="dt-sc-product-image-360-viewer-holder '.$settings['class'].'">';

					$output .= '<div class="dt-sc-product-image-360-viewer-container">';

						$viewer360_gallery_ids = get_post_meta ( $settings['product_id'], '_360viewer_gallery', true );
						$viewer360_gallery_ids = (isset($viewer360_gallery_ids['product-360view-gallery']) && $viewer360_gallery_ids['product-360view-gallery'] != '') ? explode(',', $viewer360_gallery_ids['product-360view-gallery']) : array ();

						$output .= '<div class="dt-sc-product-image-360-viewer" id="dt-sc-product-image-360-viewer" data-count="'.count($viewer360_gallery_ids).'">';

		                    if(is_array($viewer360_gallery_ids) && !empty($viewer360_gallery_ids)) {
		                    	$i = 1;
		                        foreach($viewer360_gallery_ids as $viewer360_gallery_id) {

									$image = wp_get_attachment_image( $viewer360_gallery_id, 'full', false, array (
												'data-index' => $i,
											) );

									$output .= $image;

									$i++;

		                        }
		                    }

				   		$output .= '</div>';

				   	$output .= '</div>';

			   	$output .= '</div>';

		   }
			
		} else {
		
			$output .= esc_html__('Please provide product id to display corresponding data!', 'dt-elementor');
			
		}

		echo $output;

	}


}