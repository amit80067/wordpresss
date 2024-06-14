<?php
		
function dt_product_tabs_exploded($attrs, $content = null) {

	extract ( shortcode_atts ( array (
		'product_id'    => '',
		'tab'           => '',
		'hide_title'    => '',
		'apply_scroll'  => '',
		'scroll_height' => '',
		'class'         => ''
	), $attrs ) );

	$out = dt_product_tabs_exploded_render_html($attrs);

	return $out;

}
add_shortcode( 'dt_product_tabs_exploded', 'dt_product_tabs_exploded' );


if(!function_exists('dt_product_tabs_exploded_render_html')) {
	function dt_product_tabs_exploded_render_html($settings) {

		$output = '';
	
		if($settings['product_id'] == '' && is_singular('product')) {
			global $post;
			$settings['product_id'] = $post->ID;
		}

		if($settings['product_id'] != '') {

			$hide_title_class = '';
			if($settings['hide_title'] == 'true') {
				$hide_title_class = 'dt-sc-product-hide-tab-title';
			}

			$scroll_class = $scroll_height_style_attr = '';
			if($settings['apply_scroll'] == 'true') {
				$scroll_class             = 'dt-sc-content-scroll';
				$scroll_height            = ($settings['scroll_height'] != '') ? $settings['scroll_height'] : 400;
				$scroll_height_style_attr = 'style = "height:'.esc_attr($scroll_height).'px"';
			}			

			$output .= '<div class="dt-sc-product-tabs dt-sc-product-tabs-exploded '.$settings['class'].' '.$hide_title_class.' '.$scroll_class.'" '.$scroll_height_style_attr.'>';

				if($settings['tab'] == 'description') {

					ob_start();
					woocommerce_product_description_tab();
					$output .= ob_get_clean();

				}

				if($settings['tab'] == 'review') {

					ob_start();
					comments_template();
					$output .= ob_get_clean();

				}

				if($settings['tab'] == 'additional_information') {

					ob_start();
					woocommerce_product_additional_information_tab();
					$output .= ob_get_clean();

				}

				// Custom Tabs

				if($settings['tab'] == 'custom_tab_1' || $settings['tab'] == 'custom_tab_2' || $settings['tab'] == 'custom_tab_3' || $settings['tab'] == 'custom_tab_4') {

					$custom_settings = get_post_meta( $settings['product_id'], '_custom_settings', true );
					$product_additional_tabs = (is_array($custom_settings['product-additional-tabs']) && !empty($custom_settings['product-additional-tabs'])) ? $custom_settings['product-additional-tabs'] : array ();

					// Tab 1
					if($settings['tab'] == 'custom_tab_1' && isset($product_additional_tabs[1])) {

						ob_start();
						$tab_title = $product_additional_tabs[1]['tab_title'];
						$tab_title = preg_replace('/[^A-Za-z0-9\-]/', '', $tab_title);
						$tab_key = 'dt_'.strtolower(str_replace(' ', '', $tab_title));
						augury_woo_additional_product_tabs_content( $tab_key );
						$output .= ob_get_clean();

					}	

					// Tab 2
					if($settings['tab'] == 'custom_tab_2' && isset($product_additional_tabs[2])) {

						ob_start();
						$tab_title = $product_additional_tabs[2]['tab_title'];
						$tab_title = preg_replace('/[^A-Za-z0-9\-]/', '', $tab_title);
						$tab_key = 'dt_'.strtolower(str_replace(' ', '', $tab_title));
						augury_woo_additional_product_tabs_content( $tab_key );
						$output .= ob_get_clean();

					}

					// Tab 3
					if($settings['tab'] == 'custom_tab_3' && isset($product_additional_tabs[3])) {

						ob_start();
						$tab_title = $product_additional_tabs[3]['tab_title'];
						$tab_title = preg_replace('/[^A-Za-z0-9\-]/', '', $tab_title);
						$tab_key = 'dt_'.strtolower(str_replace(' ', '', $tab_title));
						augury_woo_additional_product_tabs_content( $tab_key );
						$output .= ob_get_clean();

					}

					// Tab 4
					if($settings['tab'] == 'custom_tab_4' && isset($product_additional_tabs[4])) {

						ob_start();
						$tab_title = $product_additional_tabs[4]['tab_title'];
						$tab_title = preg_replace('/[^A-Za-z0-9\-]/', '', $tab_title);
						$tab_key = 'dt_'.strtolower(str_replace(' ', '', $tab_title));
						augury_woo_additional_product_tabs_content( $tab_key );
						$output .= ob_get_clean();

					}					

				}

			$output .= '</div>';
			
		} else {
		
			$output .= esc_html__('Please provide product id to display corresponding data!', 'dt-elementor');
			
		}

		return $output;

	}
}