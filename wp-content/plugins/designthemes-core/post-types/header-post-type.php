<?php
if (! class_exists ( 'DTHeaderPostType' ) ) {

	class DTHeaderPostType {

		function __construct() {

			add_action ( 'init', array( $this, 'dt_register_cpt' ), 5 );
			add_filter ( 'template_include', array ( $this, 'dt_template_include' ) );
		}

		function dt_register_cpt() {

			$labels = array (
				'name'				 => __( 'Headers', 'dt-elementor' ),
				'singular_name'		 => __( 'Header', 'dt-elementor' ),
				'menu_name'			 => __( 'Headers', 'dt-elementor' ),
				'add_new'			 => __( 'Add Header', 'dt-elementor' ),
				'add_new_item'		 => __( 'Add New Header', 'dt-elementor' ),
				'edit'				 => __( 'Edit Header', 'dt-elementor' ),
				'edit_item'			 => __( 'Edit Header', 'dt-elementor' ),
				'new_item'			 => __( 'New Header', 'dt-elementor' ),
				'view'				 => __( 'View Header', 'dt-elementor' ),
				'view_item' 		 => __( 'View Header', 'dt-elementor' ),
				'search_items' 		 => __( 'Search Headers', 'dt-elementor' ),
				'not_found' 		 => __( 'No Headers found', 'dt-elementor' ),
				'not_found_in_trash' => __( 'No Headers found in Trash', 'dt-elementor' ),
			);

			$args = array (
				'labels' 				=> $labels,
				'public' 				=> true,
				'exclude_from_search'	=> true,
				'show_in_nav_menus' 	=> false,
				'show_in_rest' 			=> true,
				'menu_position'			=> 25,
				'menu_icon' 			=> 'dashicons-screenoptions',
				'hierarchical' 			=> false,
				'supports' 				=> array ( 'title', 'editor', 'revisions' ),
			);

			register_post_type ( 'dt_headers', $args );
		}

		function dt_template_include($template) {
			if ( is_singular( 'dt_headers' ) ) {
				if ( ! file_exists ( get_stylesheet_directory () . '/single-dt_headers.php' ) ) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_headers.php';
				}
			}

			return $template;
		}
	}
}