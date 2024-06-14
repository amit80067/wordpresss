<?php
if (! class_exists ( 'DTShopProductTemplatePostType' ) ) {

	class DTShopProductTemplatePostType {

		function __construct() {

			add_action ( 'init', array( $this, 'dt_register_cpt' ) );
		}

		function dt_register_cpt() {

			if( function_exists( 'is_woocommerce' ) ) {

				$labels = array (
					'name'				 => esc_html__( 'Product Templates', 'dt-elementor' ),
					'singular_name'		 => esc_html__( 'Product Template', 'dt-elementor' ),
					'menu_name'			 => esc_html__( 'Product Templates', 'dt-elementor' ),
					'add_new'			 => esc_html__( 'Add Product Template', 'dt-elementor' ),
					'add_new_item'		 => esc_html__( 'Add New Product Template', 'dt-elementor' ),
					'edit'				 => esc_html__( 'Edit Product Template', 'dt-elementor' ),
					'edit_item'			 => esc_html__( 'Edit Product Template', 'dt-elementor' ),
					'new_item'			 => esc_html__( 'New Product Template', 'dt-elementor' ),
					'view'				 => esc_html__( 'View Product Template', 'dt-elementor' ),
					'view_item' 		 => esc_html__( 'View Product Template', 'dt-elementor' ),
					'search_items' 		 => esc_html__( 'Search Product Templates', 'dt-elementor' ),
					'not_found' 		 => esc_html__( 'No Product Templates found', 'dt-elementor' ),
					'not_found_in_trash' => esc_html__( 'No Product Templates found in Trash', 'dt-elementor' ),
				);

				$args = array (
					'labels' 				=> $labels,
					'public' 				=> true,
					'exclude_from_search'	=> true,
					'show_in_nav_menus' 	=> false,
					'show_in_rest' 			=> true,
					'menu_position'			=> 26,
					'menu_icon' 			=> 'dashicons-screenoptions',
					'hierarchical' 			=> false,
					'supports' 				=> array ( 'title', 'revisions' ),
				);

				register_post_type ( 'dt_product_template', $args );
				
			}

		}

	}
}