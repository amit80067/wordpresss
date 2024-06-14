<?php
if ( !class_exists( 'DTCustomerPostType' ) ) {

	class DTCustomerPostType {

		function __construct() {
			add_action ( 'init', array (
				$this,
				'dt_init'
			) );
			
			add_filter ( "cs_metabox_options", array(
				$this,
				"dt_customers_cs_metabox_options"
			) );
		}

		function dt_init() {
			$labels = array(
				'name' => __('Customers', 'dt-booking-manager' ),
				'singular_name' => __('Customer', 'dt-booking-manager' ),
				'menu_name' => __('Calendar', 'dt-booking-manager' ),
				'add_new' => __('Add Customer', 'dt-booking-manager' ),
				'add_new_item' => __('Add New Customer', 'dt-booking-manager' ),
				'edit' => __('Edit Customer', 'dt-booking-manager' ),
				'edit_item' => __('Edit Customer', 'dt-booking-manager' ),
				'new_item' => __('New Customer', 'dt-booking-manager' ),
				'view' => __('View Customer', 'dt-booking-manager' ),
				'view_item' => __('View Customer', 'dt-booking-manager' ),
				'search_items' => __('Search Customers', 'dt-booking-manager' ),
				'not_found' => __('No Customers found', 'dt-booking-manager' ),
				'not_found_in_trash' => __('No Customers found in Trash', 'dt-booking-manager' ),
				'parent_item_colon' => __('Parent Customer:', 'dt-booking-manager' ),
			);

			$args = array(
				'labels' => $labels,
				'hierarchical' => false,
				'description' => __('This is Custom Post type named as Customers','dt-booking-manager'),
				'supports' => array('title'),
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 5,
				'menu_icon' => 'dashicons-clipboard',
			);

			register_post_type('dt_customers', $args );
		}

		function dt_customers_cs_metabox_options( $options ) {

			$options[]    = array(
			  'id'        => '_info',
			  'title'     => esc_html__('Customer Options', 'dt-booking-manager'),
			  'post_type' => 'dt_customers',
			  'context'   => 'normal',
			  'priority'  => 'default',
			  'sections'  => array(
			
				array(
				  'name'  => 'general_section',
			
				  'fields' => array(
			
					array(
					  'id'    => 'emailid',
					  'type'  => 'text',
					  'title' => esc_html__('Email Id', 'dt-booking-manager'),
					  'attributes' => array( 
						'placeholder' => 'testmail@domain.com'
					  )
					),

					array(
					  'id'    => 'phone',
					  'type'  => 'text',
					  'title' => esc_html__('Phone', 'dt-booking-manager'),
					  'attributes' => array( 
						'placeholder' => '022-65265'
					  )
					),

				  ), // end: fields
				), // end: a section

			  ),
			);

			return $options;
		}
	}
}