<?php
if (! class_exists ( 'DTServicePostType' )) {
	class DTServicePostType {

		function __construct() {
			// Add Hook into the 'init()' action
			add_action ( 'init', array (
					$this,
					'dt_init'
			) );

			// Add Hook into the 'admin_init()' action
			add_action ( 'admin_init', array (
					$this,
					'dt_admin_init'
			) );

			// Add Hook into the 'admin_enqueue_scripts' filter
			add_action( 'admin_enqueue_scripts', array (
					$this,
					'dt_service_admin_scripts'
			) );

			// Add Hook into the 'cs_framework_options' filter
			add_filter ( 'cs_framework_options', array (
					$this,
					'dt_service_cs_framework_options'
			) );

			// Add Hook into the 'cs_metabox_options' filter
			add_filter ( 'cs_metabox_options', array (
					$this,
					'dt_service_cs_metabox_options'
			) );
		}

		/**
		 * A function hook that the WordPress core launches at 'init' points
		 */
		function dt_init() {
			$this->createPostType ();
		}

		/**
		 * A function hook that the WordPress core launches at 'admin_init' points
		 */
		function dt_admin_init() {
			add_filter ( "manage_edit-dt_service_columns", array (
					$this,
					"dt_service_edit_columns" 
			) );

			add_action ( "manage_posts_custom_column", array (
					$this,
					"dt_service_columns_display" 
			), 10, 2 );
		}

		/**
		 * custom admin scripts & styles
		 */
		function dt_service_admin_scripts( $hook ) {

			if( $hook == "edit.php" ) {
				wp_enqueue_style ( 'dt-service-admin', plugins_url ('designthemes-booking-manager') . '/post-types/css/admin-styles.css', array (), false, 'all' );
			}
		}

		/**
		 * Creating a post type
		 */
		function createPostType() {

			$serviceslug 			= dt_booking_cs_get_option( 'single-service-slug', 'dt_service' );
			$service_singular		= dt_booking_cs_get_option( 'singular-service-text', esc_html__('Service', 'dt-booking-manager') );
			$service_plural			= dt_booking_cs_get_option( 'plural-service-text', esc_html__('Services', 'dt-booking-manager') );

			$servicecatslug  		= dt_booking_cs_get_option( 'service-cat-slug', 'dt_service_category' );
			$service_cat_singular 	= dt_booking_cs_get_option( 'singular-service-cat-text', esc_html__('Category', 'dt-booking-manager') );
			$service_cat_plural		= dt_booking_cs_get_option( 'plural-service-cat-text', esc_html__('Categories', 'dt-booking-manager') );

			$labels = array (
				'name' 				 => $service_plural,
				'all_items' 		 => esc_html__( 'All', 'dt-booking-manager' ).' '.$service_plural,
				'singular_name' 	 => $service_singular,
				'add_new' 			 => esc_html__( 'Add New', 'dt-booking-manager' ),
				'add_new_item' 		 => esc_html__( 'Add New', 'dt-booking-manager' ).' '.$service_singular,
				'edit_item' 		 => esc_html__( 'Edit', 'dt-booking-manager' ).' '.$service_singular,
				'new_item' 			 => esc_html__( 'New', 'dt-booking-manager' ).' '.$service_singular,
				'view_item' 		 => esc_html__( 'View', 'dt-booking-manager' ).' '.$service_singular,
				'search_items' 		 => esc_html__( 'Search', 'dt-booking-manager' ).' '.$service_plural,
				'not_found' 		 => esc_html__( 'No', 'dt-booking-manager').' '.$service_plural.' '.esc_html__('found', 'dt-booking-manager' ),
				'not_found_in_trash' => esc_html__( 'No', 'dt-booking-manager').' '.$service_plural.' '.esc_html__('found in Trash', 'dt-booking-manager' ),
				'parent_item_colon'  => esc_html__( 'Parent', 'dt-booking-manager' ).' '.$service_singular.':',
				'menu_name' 		 => $service_plural,
			);

			$args = array (
				'labels' 				=> $labels,
				'hierarchical' 			=> false,
				'description' 			=> esc_html__( 'Post type archives of ', 'dt-booking-manager' ).' '.$service_plural,
				'supports' 				=> array (
											'title',
											'comments'
										),
				'public' 				=> true,
				'show_ui' 				=> true,
				'show_in_menu' 			=> true,
				'menu_position' 		=> 5,
				'menu_icon' 			=> 'dashicons-carrot',
				
				'show_in_nav_menus' 	=> true,
				'publicly_queryable' 	=> false,
				'exclude_from_search' 	=> false,
				'has_archive' 			=> true,
				'query_var' 			=> true,
				'can_export' 			=> true,
				'rewrite' 				=> array( 'slug' => $serviceslug ),
				'capability_type' 		=> 'post'
			);

			register_post_type ( 'dt_service', $args );

			if( cs_get_option('enable-service-taxonomy') ):
				// Service Categories
				$labels = array(
					'name'              => $service_cat_plural,
					'singular_name'     => $service_cat_singular,
					'search_items'      => esc_html__( 'Search', 'dt-booking-manager' ).' '.$service_cat_plural,
					'all_items'         => esc_html__( 'All', 'dt-booking-manager' ).' '.$service_cat_plural,
					'parent_item'       => esc_html__( 'Parent', 'dt-booking-manager' ).' '.$service_cat_singular,
					'parent_item_colon' => esc_html__( 'Parent', 'dt-booking-manager' ).' '.$service_cat_singular.':',
					'edit_item'         => esc_html__( 'Edit', 'dt-booking-manager' ).' '.$service_cat_singular,
					'update_item'       => esc_html__( 'Update', 'dt-booking-manager' ).' '.$service_cat_singular,
					'add_new_item'      => esc_html__( 'Add New', 'dt-booking-manager' ).' '.$service_cat_singular,
					'new_item_name'     => esc_html__( 'New', 'dt-booking-manager' ).' '.$service_cat_singular.' '.esc_html__('Name', 'dt-booking-manager'),
					'menu_name'         => $service_cat_plural,
				);
	
				register_taxonomy ( 'dt_service_category', array (
					'dt_service'
				), array (
					'hierarchical' 		=> true,
					'labels' 			=> $labels,
					'show_admin_column' => true,
					'rewrite' 			=> array( 'slug' => $servicecatslug ),
					'query_var' 		=> true
				) );
			endif;
		}

		/**
		 * Service framework options
		 */
		function dt_service_cs_framework_options( $options ) {

			$serviceslug 			= dt_booking_cs_get_option( 'single-service-slug', 'dt_service' );
			$service_singular		= dt_booking_cs_get_option( 'singular-service-text', esc_html__('Service', 'dt-booking-manager') );
			$service_plural			= dt_booking_cs_get_option( 'plural-service-text', esc_html__('Services', 'dt-booking-manager') );

			$servicecatslug  		= dt_booking_cs_get_option( 'service-cat-slug', 'dt_service_category' );
			$service_cat_singular 	= dt_booking_cs_get_option( 'singular-service-cat-text', esc_html__('Category', 'dt-booking-manager') );
			$service_cat_plural		= dt_booking_cs_get_option( 'plural-service-cat-text', esc_html__('Categories', 'dt-booking-manager') );

			$options['booking-manager']['sections'][] = array(

				// -----------------------------------------
				// Service Options
				// -----------------------------------------
				'name'      => 'service_options',
				'title'     => $service_singular.' '.esc_html__('Options', 'dt-booking-manager'),
				'icon'      => 'fa fa-info-circle',

				  'fields'      => array(
					  array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Service Archives Post Layout', 'dt-booking-manager' ),
					  ),

					  array(
						'id'      	 => 'service-archives-post-layout',
						'type'         => 'image_select',
						'title'        => esc_html__('Post Layout', 'dt-booking-manager'),
						'options'      => array(
						  'one-half-column'   => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/one-half-column.png',
						  'one-third-column'  => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/one-third-column.png',
						  'one-fourth-column' => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/one-fourth-column.png',
						),
						'default'      => 'one-half-column',
					  ),

					  array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Bulk Custom Fields', 'dt-booking-manager' ),
					  ),

					  array(
						'id'              => 'service-custom-fields',
						'type'            => 'group',
						'title'           => esc_html__('Custom Fields', 'dt-booking-manager'),
						'info'            => esc_html__('Click button to add custom fields like duration, url and price etc', 'dt-booking-manager'),
						'button_title'    => esc_html__('Add New Field', 'dt-booking-manager'),
						'accordion_title' => esc_html__('Adding New Custom Field', 'dt-booking-manager'),
						'fields'          => array(
						  array(
							'id'          => 'service-custom-fields-text',
							'type'        => 'text',
							'title'       => esc_html__('Enter Text', 'dt-booking-manager')
						  ),
						)
					  ),

					  array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Permalinks', 'dt-booking-manager' ),
					  ),

					  array(
						'id'      => 'singular-service-text',
						'type'    => 'text',
						'title'   => esc_html__('Singular', 'dt-booking-manager').' '.$service_singular.' '.esc_html__('Name', 'dt-booking-manager'),
						'default' => $service_singular,
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Change as you like, save options & reload.', 'dt-booking-manager').'</p>',
					  ),

					  array(
						'id'      => 'plural-service-text',
						'type'    => 'text',
						'title'   => esc_html__('Plural', 'dt-booking-manager').' '.$service_singular.' '.esc_html__('Name', 'dt-booking-manager'),
						'default' => $service_plural,
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Change as you like, save options & reload.', 'dt-booking-manager').'</p>',
					  ),

					  array(
						'id'      => 'singular-service-cat-text',
						'type'    => 'text',
						'title'   => esc_html__('Singular', 'dt-booking-manager').' '.$service_cat_singular.' '.esc_html__('Name', 'dt-booking-manager'),
						'default' => $service_cat_singular,
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Change as you like, save options & reload.', 'dt-booking-manager').'</p>',
					  ),

					  array(
						'id'      => 'plural-service-cat-text',
						'type'    => 'text',
						'title'   => esc_html__('Plural', 'dt-booking-manager').' '.$service_cat_plural.' '.esc_html__('Name', 'dt-booking-manager'),
						'default' => $service_cat_plural,
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Change as you like, save options & reload.', 'dt-booking-manager').'</p>',
					  ),

					  array(
						'id'      => 'single-service-slug',
						'type'    => 'text',
						'title'   => esc_html__('Single', 'dt-booking-manager').' '.$service_singular.' '.esc_html__('Slug', 'dt-booking-manager'),
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Do not use characters not allowed in links. Use, eg. service-item ', 'dt-booking-manager').'<br> <b>'.esc_html__('After made changes save permalinks.', 'dt-booking-manager').'</b></p>',
					  ),

					  array(
						'id'      => 'service-cat-slug',
						'type'    => 'text',
						'title'   => $service_singular.' '.$service_cat_singular.' '.esc_html__('Slug', 'dt-booking-manager'),
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Do not use characters not allowed in links. Use, eg. service-type ', 'dt-booking-manager').'<br> <b>'.esc_html__('After made changes save permalinks.', 'dt-booking-manager').'</b></p>',
					  ),
				  ),
			);

			// Filter to add additional options for themes
			$options = apply_filters( 'dt_booking_template_framework_options', $options );

			return $options;
		}

		/**
		 * Service metabox options
		 */
		function dt_service_cs_metabox_options( $options ) {

			$fields = cs_get_option( 'service-custom-fields');
			$bothfields = $fielddef = $x = array();
			$before = '';

			if(!empty($fields)) :

				$i = 1;
				foreach($fields as $field):
					$x['id'] = 'service_opt_flds_title_'.$i;
					$x['type'] = 'text';
					$x['title'] = 'Title';
					$x['attributes'] = array( 'style' => 'background-color: #f0eff9;' );
					$bothfields[] = $x;
					unset($x);

					$x['id'] = 'service_opt_flds_value_'.$i;
					$x['type'] = 'text';
					$x['title'] = 'Value';
					$bothfields[] = $x;

					$fielddef['service_opt_flds_title_'.$i] = $field['service-custom-fields-text'];

					$i++;
				endforeach;
			else:
				$before = '<span>'.esc_html__('Go to options panel add few custom fields, then return back here.', 'dt-booking-manager').'</span>';
			endif;

			$times = array( '' => esc_html__('Select', 'dt-booking-manager') );
			for ( $i = 0; $i < 12; $i++ ) :
				for ( $j = 15; $j <= 60; $j += 15 ) :
					$duration = ( $i * 3600 ) + ( $j * 60 );
					$duration_output = dt_booking_duration_to_string( $duration );
					$times[$duration] = $duration_output;
				endfor;
			endfor;

			$person_plural = dt_booking_cs_get_option( 'plural-person-text', esc_html__('Persons', 'dt-booking-manager') );
			$service_singular = dt_booking_cs_get_option( 'singular-service-text', esc_html__('Service', 'dt-booking-manager') );

			$symbol = dt_booking_get_currency_symbol();

			$options[]    = array(
			  'id'        => '_custom_settings',
			  'title'     => esc_html__('Custom Service Options', 'dt-booking-manager'),
			  'post_type' => 'dt_service',
			  'context'   => 'normal',
			  'priority'  => 'default',
			  'sections'  => array(


				array(
				  'name'  => 'mand_section',
				  'title' => esc_html__('Mandatory Fields', 'dt-booking-manager'),
				  'icon'  => 'fa fa-clock-o',

				  'fields' => array(

					array(
					  'id'      => 'service-price',
					  'type'    => 'number',
					  'title'   => esc_html__('Cost', 'dt-booking-manager'),
					  'after'	=> '&nbsp;'.$symbol,
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put a valid price here', 'dt-booking-manager').'</p>',
					  'attributes' => array(
						'style'    => 'width: 90px;'
					  )
					),

					array(
					  'id'      => 'service-duration',
					  'type'    => 'select',
					  'title'   => esc_html__('Duration', 'dt-booking-manager'),
					  'after'   => '<p class="cs-text-muted">'.esc_html__('Select time duration here', 'dt-booking-manager').'</p>',
					  'options' => $times,
					  'class'   => 'chosen'
					),

				  ), // end: fields
				), // end: a section

			  ),
			);

			// Filter to add additional options for themes
			$options = apply_filters( 'dt_booking_template_metabox_options', $options );

			return $options;
		}

		/**
		 *
		 * @param unknown $columns
		 * @return multitype:
		 */
		function dt_service_edit_columns($columns) {

			$newcolumns = array (
				"cb" => "<input type=\"checkbox\" />",
				"dt_service_thumb" => esc_html__("Image", 'dt-booking-manager'),
				"title" => esc_html__("Title", 'dt-booking-manager'),
				"author" => esc_html__("Author", 'dt-booking-manager')
			);
			$columns = array_merge ( $newcolumns, $columns );
			return $columns;
		}

		/**
		 *
		 * @param unknown $columns
		 * @param unknown $id
		 */
		function dt_service_columns_display($columns, $id) {
			global $post;

			switch ($columns) {

				case "dt_service_thumb" :
				    $image = wp_get_attachment_image(get_post_thumbnail_id($id), array(75,75));
					if(!empty($image)):
					  	echo ($image);
				    else:
						$service_settings = get_post_meta ( $post->ID, '_custom_settings', TRUE );
						$service_settings = is_array ( $service_settings ) ? $service_settings : array ();

						if( array_key_exists("service-gallery", $service_settings)) {
							$items = explode(',', $service_settings["service-gallery"]);
							echo wp_get_attachment_image( $items[0], array(75, 75) );
						}
					endif;
				break;
			}
		}
	}
}