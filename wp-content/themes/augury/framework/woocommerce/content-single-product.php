<?php
/** Product single template option **/

if( ! function_exists( 'augury_woo_product_single_template_option' ) ) {

	function augury_woo_product_single_template_option() {

		global $post;

		$settings = get_post_meta( $post->ID, '_custom_settings', true );
		$product_template = (isset($settings['product-template']) && $settings['product-template'] != '') ? $settings['product-template'] : 'admin-option';

		if($product_template == 'admin-option') {
			$product_template = augury_get_option( 'dt-single-product-default-template' );
			$product_template = (isset($product_template) && $product_template != '') ? $product_template : 'woo-default';
		}

		return $product_template;

	}

}


/** Product single template **/

if( ! function_exists( 'augury_woo_product_single_template' ) ) {

	function augury_woo_product_single_template( $single_template ) {

		if (is_singular( 'product' )) {

			$product_template = augury_woo_product_single_template_option();

			if( $product_template == 'custom-template' ) {
				$single_template = AUGURY_DIR. '/framework/woocommerce/templates/custom-template.php';
			}

		}

		return $single_template;

	}

	add_filter('template_include', 'augury_woo_product_single_template', 100);

}

/** Product additional tabs **/

if( ! function_exists( 'augury_woo_additional_product_tabs' ) ) {

	function augury_woo_additional_product_tabs( $tabs ) {

		global $post;

		$settings = get_post_meta( $post->ID, '_custom_settings', true );
		$product_additional_tabs = (isset($settings['product-additional-tabs']) && !empty($settings['product-additional-tabs'])) ? $settings['product-additional-tabs'] : array ();

		if( is_array( $product_additional_tabs ) && !empty( $product_additional_tabs ) ) {

			$priority = 40;

			foreach( $product_additional_tabs as $product_additional_tab_key => $product_additional_tab ) {

				$tab_title = $product_additional_tab['tab_title'];
				$tab_description = $product_additional_tab['tab_description'];

				$tab_key = str_replace(' ', '', $tab_title);
				$tab_key = preg_replace('/[^A-Za-z0-9\-]/', '', $tab_key);

				$tab_key = 'dt_'.strtolower($tab_key);

				$tabs[$tab_key] = array(
					'title' 	=> $tab_title,
					'priority' 	=> $priority,
					'callback' 	=> 'augury_woo_additional_product_tabs_content'
				);

				$priority = $priority + 10;

			}

		}

		return $tabs;

	}

	function augury_woo_additional_product_tabs_content( $key ) {

		global $post;

		$settings = get_post_meta( $post->ID, '_custom_settings', true );
		$product_additional_tabs = (isset($settings['product-additional-tabs']) && !empty($settings['product-additional-tabs'])) ? $settings['product-additional-tabs'] : array ();

		if( is_array( $product_additional_tabs ) && !empty( $product_additional_tabs ) ) {

			foreach( $product_additional_tabs as $product_additional_tab_key => $product_additional_tab ) {

				$tab_title = $product_additional_tab['tab_title'];
				$tab_description = $product_additional_tab['tab_description'];

				$tab_content = '';
				if(isset($tab_description) && !empty($tab_description)) {

					if($tab_description == 'custom-description' && isset($product_additional_tab['tab_custom_description']) && !empty($product_additional_tab['tab_custom_description'])) {
			
						$tab_content = $product_additional_tab['tab_custom_description'];
			
					} else if($tab_description > 0) {
			
						$frontend = Elementor\Frontend::instance();
						$post_description = $frontend->get_builder_content( $tab_description, true );
						$tab_content = augury_html_output($post_description);
			
					}
					
				}

				$tab_key = str_replace(' ', '', $tab_title);
				$tab_key = preg_replace('/[^A-Za-z0-9\-]/', '', $tab_key);

				$tab_key = 'dt_'.strtolower($tab_key);

				if($tab_key == $key) {

					echo '<h2>'.esc_html($tab_title).'</h2>';
					echo augury_html_output(do_shortcode($tab_content));

				}

			}

		}

	}	

	add_filter( 'woocommerce_product_tabs', 'augury_woo_additional_product_tabs', 10 );

}


/** Product single add to cart section sticky **/

if ( ! function_exists( 'augury_woo_shop_single_addtocart_sticky' ) ) {

	function augury_woo_shop_single_addtocart_sticky() {

		$product_addtocart_sticky = augury_get_option( 'dt-single-product-addtocart-sticky' );
		$product_addtocart_sticky = (isset($product_addtocart_sticky) && $product_addtocart_sticky != '') ? $product_addtocart_sticky : '';

		if ( ! is_product() || $product_addtocart_sticky != 'true' ) {
			return;
		}

		global $product;

		echo '<div class="dt-sc-shop-single-sticky-addtocart-container">';
			echo '<div class="container">';
				echo '<div class="dt-sc-shop-single-sticky-addtocart-content">';
					echo '<div class="dt-sc-shop-single-sticky-addtocart-thumbnail">';
						echo woocommerce_get_product_thumbnail();
					echo '</div>';
					echo '<div class="dt-sc-shop-single-sticky-addtocart-info">';
						echo '<h3>'.augury_html_output($product->get_name()).'</h3>';
						echo wc_get_rating_html( $product->get_average_rating() );
					echo '</div>';				
				echo '</div>';
				echo '<div class="dt-sc-shop-single-sticky-addtocart-section">';
					echo '<span class="dt-sc-shop-single-sticky-addtocart-price">'.augury_html_output($product->get_price_html()).'</span>';	
					if(augury_check_item_is_in_cart( $product->get_id() )) {
						echo '<span class="dt-sc-shop-single-sticky-addtocart-added">'.esc_html__('Product Added To Cart', 'augury').'</span>';	
					} else {
						woocommerce_template_loop_add_to_cart();
					}
				echo '</div>';
			echo '</div>';
		echo '</div>';

	}

	add_action( 'wp_footer', 'augury_woo_shop_single_addtocart_sticky', 11 );

}


/** Upsell Products **/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

if( ! function_exists( 'augury_woo_show_upsell' ) ) {
	
	function augury_woo_show_upsell() {

		global $product;

		$product_id = $product->get_id();
		$settings   = augury_single_product_settings( $product_id );

		if( isset( $settings['show-upsell'] ) && ( $settings['show-upsell'] == 'true' || $settings['show-upsell'] == true ) ) {

			$product_style_template = augury_get_option( 'dt-single-product-upsell-style-template' );

			$display_mode = augury_woo_post_display_mode_from_location($product_style_template);
			if($display_mode == 'list') {
				$settings['upsell-column'] = 1;	
			}

			augury_product_style_setup_template_prop($product_style_template); /* Call Product Style Variables Setup */

			woocommerce_upsell_display( $limit = $settings['upsell-limit'], $columns = $settings['upsell-column'], $orderby = 'rand', $order = 'desc' );

			augury_product_style_reset_template_prop();  /* Reset Product Style Variables Setup */

		}

	}

	add_action( 'woocommerce_after_single_product_summary', 'augury_woo_show_upsell', 15 );

}

/** Related Products **/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

if( ! function_exists( 'augury_woo_show_related_products' ) ) {

	function augury_woo_show_related_products() {

		global $product;

		$product_id = $product->get_id();
		$settings   = augury_single_product_settings( $product_id );

		if( isset( $settings['show-related'] ) && ( $settings['show-related'] == 'true' || $settings['show-related'] == true ) ) {

			$product_style_template = augury_get_option( 'dt-single-product-related-style-template' );

			$display_mode = augury_woo_post_display_mode_from_location($product_style_template);
			if($display_mode == 'list') {
				$settings['related-column'] = 1;	
			}

			augury_product_style_setup_template_prop($product_style_template); /* Call Product Style Variables Setup */

			woocommerce_related_products( array(
				'posts_per_page' => $settings['related-limit'],
				'columns'        => $settings['related-column'],
				'orderby'        => 'rand'
			) );

			augury_product_style_reset_template_prop(); /* Reset Product Style Variables Setup */

		}

	}

	add_action( 'woocommerce_after_single_product_summary', 'augury_woo_show_related_products', 20 );

}

if( ! function_exists( 'dtshop_woo_related_products_heading' ) ) {

	function dtshop_woo_related_products_heading($heading) {

		$product_related_hide_title = wc_get_loop_prop('product_related_hide_title');
		$product_template = augury_woo_product_single_template_option();
		if( ( $product_template == 'custom-template' && $product_related_hide_title != 'true' ) || $product_template == 'woo-default' ) {

			$title = augury_get_option( 'dt-single-product-related-title' );
			$heading = $title;

		}

		return $heading;

	}

	add_filter( 'woocommerce_product_related_products_heading', 'dtshop_woo_related_products_heading', 1 );

}

/** Size Guide **/

$enable_size_guide = augury_get_option( 'dt-single-product-enable-size-guide' );
$enable_size_guide = (isset($enable_size_guide) && $enable_size_guide == 'true') ? true : false;	
if($enable_size_guide) {
	add_action( 'woocommerce_single_product_summary', 'augury_woo_loop_product_button_elements_sizeguide', 35 );
}


/** Product single image - Additional Labels **/

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 ); // Remove sale flash from single product page

if( ! function_exists( 'augury_woo_loop_product_additional_labels' ) ) {

	function augury_woo_loop_product_additional_labels( $single_template ) {

		$product_show_360_viewer = augury_get_option( 'dt-single-product-show-360-viewer' );
		$product_show_360_viewer = (isset($product_show_360_viewer) && $product_show_360_viewer == 'true') ? true : false;

		if($product_show_360_viewer) {
			echo do_shortcode('[dt_sc_product_images_360viewer enable_popup_viewer="true" source="single-product" /]');
		}

		augury_woo_show_product_additional_labels();

	}

	add_action('dt_woo_loop_product_additional_labels', 'augury_woo_loop_product_additional_labels');

}

/* Product Labels - Shortcodes */

if( ! function_exists( 'augury_woo_show_product_additional_labels' ) ) {

	function augury_woo_show_product_additional_labels() {

		global $product;
		$product_id = $product->get_id();

		$settings = get_post_meta( $product_id, '_custom_settings', true );

		if( $product->is_on_sale() && $product->is_in_stock() ) {
			echo '<span class="onsale"><span>'.esc_html__('Sale', 'augury').'</span></span>';
		} else if( !$product->is_in_stock() ) {
			echo '<span class="out-of-stock"><span>'.esc_html__('Sold Out','augury').'</span></span>';
		}

		if( $product->is_featured() ) {
			echo '<div class="featured-tag">
						<div>
							<i class="fas fa-thumbtack"></i>
							<span>'.esc_html__('Featured', 'augury').'</span>
						</div>
					</div>';
		}

		if(isset($settings['product-new-label']) && $settings['product-new-label'] == 'true') {
			echo '<span class="new"><span>'.esc_html__('New', 'augury').'</span></span>';
		}	

	}

}