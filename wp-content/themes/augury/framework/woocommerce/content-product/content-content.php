<?php

/**
 * content-product.php hooks
 *
 * woocommerce_shop_loop_item_title, woocommerce_after_shop_loop_item_title
 */


/** Hook: woocommerce_shop_loop_item_title **/

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );


if( ! function_exists( 'augury_woo_loop_product_content' ) ) {
	
	function augury_woo_loop_product_content() {

		$product_content_enable = wc_get_loop_prop( 'product-content-enable' );

		if($product_content_enable) {

			$product_content_content = wc_get_loop_prop( 'product-content-content' );
			$product_content_content = (isset($product_content_content['enabled']) && !empty($product_content_content['enabled'])) ? $product_content_content['enabled'] : false;

			if($product_content_content) {

				augury_woo_loop_product_content_content_setup($product_content_content);

				echo '<div class="product-details">';
					do_action('dt_woo_loop_product_content_content', 'content');
					remove_all_actions('dt_woo_loop_product_content_content');
				echo '</div>';

			}

		}

	}

	add_action( 'woocommerce_shop_loop_item_title', 'augury_woo_loop_product_content', 10 );

}


/** Hook: woocommerce_after_shop_loop_item_title **/

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

?>