<?php
if (! class_exists ( 'DTFooterPostType' ) ) {

	class DTFooterPostType {

		function __construct() {

			add_action ( 'init', array( $this, 'dt_register_cpt' ) );
			add_filter ( 'template_include', array ( $this, 'dt_template_include' ) );
		}

		function dt_register_cpt() {

			$labels = array (
				'name'				 => __( 'Footers', 'dt-elementor' ),
				'singular_name'		 => __( 'Footer', 'dt-elementor' ),
				'menu_name'			 => __( 'Footers', 'dt-elementor' ),
				'add_new'			 => __( 'Add Footer', 'dt-elementor' ),
				'add_new_item'		 => __( 'Add New Footer', 'dt-elementor' ),
				'edit'				 => __( 'Edit Footer', 'dt-elementor' ),
				'edit_item'			 => __( 'Edit Footer', 'dt-elementor' ),
				'new_item'			 => __( 'New Footer', 'dt-elementor' ),
				'view'				 => __( 'View Footer', 'dt-elementor' ),
				'view_item' 		 => __( 'View Footer', 'dt-elementor' ),
				'search_items' 		 => __( 'Search Footers', 'dt-elementor' ),
				'not_found' 		 => __( 'No Footers found', 'dt-elementor' ),
				'not_found_in_trash' => __( 'No Footers found in Trash', 'dt-elementor' ),
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
				'supports' 				=> array ( 'title', 'editor', 'revisions' ),
			);

			register_post_type ( 'dt_footers', $args );			
		}

		function dt_template_include($template) {
			if ( is_singular( 'dt_footers' ) ) {
				if ( ! file_exists ( get_stylesheet_directory () . '/single-dt_footers.php' ) ) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_footers.php';
				}
			}

			return $template;
		}
	}
}