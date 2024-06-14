<?php

/**
 * archive-product.php hooks
 *
 * woocommerce_before_shop_loop, woocommerce_after_shop_loop
 */


remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );


/* Call Product Style Variables Setup - Shop Page Listing */

if( ! function_exists( 'augury_product_style_setup_template_prop_action' ) ) {
	
	function augury_product_style_setup_template_prop_action() {

		if( is_shop() ) {
			$product_style_template = augury_get_option( 'shop-page-product-style-template' );
		} elseif( is_product_category() ) {
			$product_style_template = augury_get_option( 'dt-woo-category-product-style-template' );
		} elseif( is_product_tag() ) {
			$product_style_template = augury_get_option( 'dt-woo-tag-product-style-template' );
		}

		augury_product_style_setup_template_prop($product_style_template);

	}

	add_action( 'woocommerce_before_shop_loop', 'augury_product_style_setup_template_prop_action', 5 );

}



/* Header Sorter  */

$show_sorter_on_header = augury_get_option( 'shop-page-show-sorter-on-header' );
$show_sorter_on_header = (isset($show_sorter_on_header) && !empty($show_sorter_on_header)) ? true : false;

if($show_sorter_on_header) {

	$sorter_header_elements = augury_get_option( 'shop-page-sorter-header-elements' );
	$sorter_header_elements = (isset($sorter_header_elements) && !empty($sorter_header_elements)) ? $sorter_header_elements : array ();

	if(!empty($sorter_header_elements)) {

		add_action( 'woocommerce_before_shop_loop', 'augury_woo_sorting_wrapper', 9 );

		$total_items = count($sorter_header_elements);
		$i = 10; $j = 1;
		foreach($sorter_header_elements as $sorter_header_element_key) {

			$sorter_function_name = '';
			if($sorter_header_element_key == 'filter') {
				$sorter_function_name = 'woocommerce_catalog_ordering';
			} else if($sorter_header_element_key == 'result_count') {
				$sorter_function_name = 'woocommerce_result_count';
			} else if($sorter_header_element_key == 'pagination') {
				$sorter_function_name = 'woocommerce_pagination';
			} else if($sorter_header_element_key == 'display_mode_options') {
				$sorter_function_name = 'augury_woo_display_mode_options';
			} else if($sorter_header_element_key == 'display_mode') {
				$sorter_function_name = 'augury_woo_display_mode';				
			}

			$cnt = 0;
			if($total_items > 2 && $j == 2) {
				add_action('woocommerce_before_shop_loop', 'augury_woo_sorter_center_item_start_div', $i);
				$i = $i+1;
			}

			add_action('woocommerce_before_shop_loop', 'augury_woo_sorter_item_start_div', ($i));
			add_action('woocommerce_before_shop_loop', $sorter_function_name, ($i+1));
			add_action('woocommerce_before_shop_loop', 'augury_woo_sorter_item_end_div', ($i+2));

			if($total_items > 2 && $j == ($total_items-1)) {
				add_action('woocommerce_before_shop_loop', 'augury_woo_sorter_center_item_end_div', ($i+3));
				$i = $i+1;
			}			

			$i = $i+3;
			$j++;

		}		

		add_action( 'woocommerce_before_shop_loop', 'augury_woo_sorting_wrapper_close', 51 );

	}

}


/* Footer Sorter */

$show_sorter_on_footer = augury_get_option( 'shop-page-show-sorter-on-footer' );
$show_sorter_on_footer = (isset($show_sorter_on_footer) && !empty($show_sorter_on_footer)) ? true : false;

if($show_sorter_on_footer) {

	$sorter_footer_elements = augury_get_option( 'shop-page-sorter-footer-elements' );
	$sorter_footer_elements = (isset($sorter_footer_elements) && !empty($sorter_footer_elements)) ? $sorter_footer_elements : array ();

	if(!empty($sorter_footer_elements)) {

		add_action( 'woocommerce_after_shop_loop', 'augury_woo_sorting_wrapper', 9 );

		$total_items = count($sorter_footer_elements);
		$i = 10; $j = 1;
		foreach($sorter_footer_elements as $sorter_footer_element_key) {

			$sorter_function_name = '';
			if($sorter_footer_element_key == 'filter') {
				$sorter_function_name = 'woocommerce_catalog_ordering';
			} else if($sorter_footer_element_key == 'result_count') {
				$sorter_function_name = 'woocommerce_result_count';
			} else if($sorter_footer_element_key == 'pagination') {
				$sorter_function_name = 'woocommerce_pagination';
			} else if($sorter_footer_element_key == 'display_mode_options') {
				$sorter_function_name = 'augury_woo_display_mode_options';
			} else if($sorter_footer_element_key == 'display_mode') {
				$sorter_function_name = 'augury_woo_display_mode';				
			}

			$cnt = 0;
			if($total_items > 2 && $j == 2) {
				add_action('woocommerce_after_shop_loop', 'augury_woo_sorter_center_item_start_div', $i);
				$i = $i+1;
			}
			
			add_action('woocommerce_after_shop_loop', 'augury_woo_sorter_item_start_div', $i);
			add_action('woocommerce_after_shop_loop', $sorter_function_name, ($i+1));
			add_action('woocommerce_after_shop_loop', 'augury_woo_sorter_item_end_div', ($i+2));

			if($total_items > 2 && $j == ($total_items-1)) {
				add_action('woocommerce_after_shop_loop', 'augury_woo_sorter_center_item_end_div', ($i+3));
				$i = $i+1;
			}			

			$i = $i+3;
			$j++;

		}		

		add_action( 'woocommerce_after_shop_loop', 'augury_woo_sorting_wrapper_close', 51 );

	}

}


/* Sorter Elements */

if ( ! function_exists( 'augury_woo_sorting_wrapper' ) ) {

	function augury_woo_sorting_wrapper() {
		echo '<div class="product-loop-sorting">';
	}

}

if ( ! function_exists( 'augury_woo_sorting_wrapper_close' ) ) {

	function augury_woo_sorting_wrapper_close() {
		echo '</div>';
	}

}

if ( ! function_exists( 'augury_woo_sorter_item_start_div' ) ) {

	function augury_woo_sorter_item_start_div() {
		echo '<div class="product-loop-sorting-item">';
	}

}

if ( ! function_exists( 'augury_woo_sorter_item_end_div' ) ) {

	function augury_woo_sorter_item_end_div() {
		echo '</div>';
	}

}

if ( ! function_exists( 'augury_woo_sorter_center_item_start_div' ) ) {

	function augury_woo_sorter_center_item_start_div() {
		echo '<div class="product-loop-sorting-item-group">';
	}

}

if ( ! function_exists( 'augury_woo_sorter_center_item_end_div' ) ) {

	function augury_woo_sorter_center_item_end_div() {
		echo '</div>';
	}

}

if( ! function_exists( 'augury_woo_pagination' ) ) {

	function augury_woo_pagination() {
		echo '<div class="pagination">';
			echo augury_pagination();
		echo '</div>';
	}

}

if( ! function_exists( 'augury_woo_display_mode_options' ) ) {

	function augury_woo_display_mode_options() {

		$shop_page_display = get_option( 'woocommerce_shop_page_display' );

		if( is_shop() && ( $shop_page_display == 'subcategories' ) ) {
			return;
		}

		if( is_shop() || is_product_category() || is_product_tag() ) {

			$grid_controller_class = $list_controller_class = '';

			$display_mode = wc_get_loop_prop( 'display_mode', 'grid' );
			$display_mode = (isset($display_mode) && !empty($display_mode)) ? $display_mode : 'grid';

			if($display_mode == 'list') {
				$grid_controller_class = 'hidden';
			} else {
				$list_controller_class = 'hidden';
			}

			$column = apply_filters( 'loop_shop_columns', 4 );

			$one_column_class = $two_column_class = $three_column_class = $four_column_class = $five_column_class = $six_column_class = '';

            if($column == 1) {
                $one_column_class = 'active';
            } else if($column == 2) {
                $two_column_class = 'active';
            } else if($column == 3) {
                $three_column_class = 'active';
            } else if($column == 4) {
                $four_column_class = 'active';
            } else if($column == 5) {
                $five_column_class = 'active';
            } else if($column == 6) {
                $six_column_class = 'active';
            }

			echo '<div class="product-layout-controller '.esc_attr($grid_controller_class).'">';
				echo '<ul class="product-change-layout">';
					echo '<li class="hidden"><span data-column="1" class="'.esc_attr($one_column_class).'">'.esc_html__('1', 'augury').'</span></li>';
					echo '<li><span data-column="2" class="'.esc_attr($two_column_class).'">'.esc_html__('2', 'augury').'</span></li>';
					echo '<li><span data-column="3" class="'.esc_attr($three_column_class).'">'.esc_html__('3', 'augury').'</span></li>';
					echo '<li><span data-column="4" class="'.esc_attr($four_column_class).'">'.esc_html__('4', 'augury').'</span></li>';
				echo '</ul>';
			echo '</div>';	


			$display_mode_list_options = wc_get_loop_prop( 'display_mode_list_options', 'left-thumb' );
			$display_mode_list_options = (isset($display_mode_list_options) && !empty($display_mode_list_options)) ? $display_mode_list_options : 'left-thumb';	

			$left_thumb_class = $right_thumb_class = '';
			if($display_mode_list_options == 'right-thumb') {
				$right_thumb_class = 'active';
			} else {
				$left_thumb_class = 'active';
			}

			echo '<div class="product-list-options-controller '.esc_attr($list_controller_class).'">';
				echo '<ul class="product-list-options">';
					echo '<li><span data-list-option="left-thumb" class="'.esc_attr($left_thumb_class).'">'.esc_html__('Left Thumb', 'augury').'</span></li>';
					echo '<li><span data-list-option="right-thumb" class="'.esc_attr($right_thumb_class).'">'.esc_html__('Right Thumb', 'augury').'</span></li>';
				echo '</ul>';
			echo '</div>';

		}

	}

}

if( ! function_exists( 'augury_woo_display_mode' ) ) {

	function augury_woo_display_mode() {

		$shop_page_display = get_option( 'woocommerce_shop_page_display' );

		if( is_shop() && ( $shop_page_display == 'subcategories' ) ) {
			return;
		}

		if( is_shop() || is_product_category() || is_product_tag() ) {

			/*$display_mode = augury_get_option( 'product-display-mode' );
			$display_mode = (isset($display_mode) && $display_mode != '') ? $display_mode : 'grid';*/

			$display_mode = wc_get_loop_prop( 'display_mode', 'grid' );
			$display_mode = (isset($display_mode) && !empty($display_mode)) ? $display_mode : 'grid';			

            if($display_mode == 'list') {
            	$grid_display_mode_class = '';
                $list_display_mode_class = 'active';
            } else {
                $grid_display_mode_class = 'active';
                $list_display_mode_class = '';
            }

			echo '<div class="product-display-controller">';
				echo '<ul class="product-change-display">';
					echo '<li><span data-display="grid" class="'.esc_attr($grid_display_mode_class).'">'.esc_html__('Grid', 'augury').'</span></li>';
					echo '<li><span data-display="list" class="'.esc_attr($list_display_mode_class).'">'.esc_html__('List', 'augury').'</span></li>';
				echo '</ul>';
			echo '</div>';	

		}

	}

}

?>