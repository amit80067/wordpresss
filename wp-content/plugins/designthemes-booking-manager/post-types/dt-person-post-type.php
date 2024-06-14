<?php
if (! class_exists ( 'DTPersonPostType' )) {
	class DTPersonPostType {

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
					'dt_person_admin_scripts'
			) );

			// Add Hook into the 'cs_framework_options' filter
			add_filter ( 'cs_framework_options', array (
					$this,
					'dt_person_cs_framework_options'
			) );

			// Add Hook into the 'cs_metabox_options' filter
			add_filter ( 'cs_metabox_options', array (
					$this,
					'dt_person_cs_metabox_options'
			) );
		}

		/**
		 * A function hook that the WordPress core launches at 'init' points
		 */
		function dt_init() {
			$this->createPostType ();

			add_action ( 'save_post', array (
					$this,
					'dt_person_save_post_meta'
			) );
		}

		/**
		 * A function hook that the WordPress core launches at 'admin_init' points
		 */
		function dt_admin_init() {
			add_filter ( "manage_edit-dt_person_columns", array (
					$this,
					"dt_person_edit_columns" 
			) );

			add_action ( "manage_posts_custom_column", array (
					$this,
					"dt_person_columns_display" 
			), 10, 2 );
		}

		/**
		 * custom admin scripts & styles
		 */
		function dt_person_admin_scripts( $hook ) {

			if( $hook == "edit.php" ) {
				wp_enqueue_style ( 'dt-person-admin', plugins_url ('designthemes-booking-manager') . '/post-types/css/admin-styles.css', array (), false, 'all' );
			}
		}

		/**
		 * Creating a post type
		 */
		function createPostType() {

			$personslug 			= dt_booking_cs_get_option( 'single-person-slug', 'dt_person' );
			$person_singular		= dt_booking_cs_get_option( 'singular-person-text', esc_html__('Person', 'dt-booking-manager') );
			$person_plural			= dt_booking_cs_get_option( 'plural-person-text', esc_html__('Persons', 'dt-booking-manager') );

			$persondepartslug  			= dt_booking_cs_get_option( 'person-department-slug', 'dt_person_department' );
			$person_depart_singular 	= dt_booking_cs_get_option( 'singular-person-department-text', esc_html__('Department', 'dt-booking-manager') );
			$person_depart_plural		= dt_booking_cs_get_option( 'plural-person-department-text', esc_html__('Departments', 'dt-booking-manager') );

			$labels = array (
				'name' 				 => $person_plural,
				'all_items' 		 => esc_html__( 'All', 'dt-booking-manager' ).' '.$person_plural,
				'singular_name' 	 => $person_singular,
				'add_new' 			 => esc_html__( 'Add New', 'dt-booking-manager' ),
				'add_new_item' 		 => esc_html__( 'Add New', 'dt-booking-manager' ).' '.$person_singular,
				'edit_item' 		 => esc_html__( 'Edit', 'dt-booking-manager' ).' '.$person_singular,
				'new_item' 			 => esc_html__( 'New', 'dt-booking-manager' ).' '.$person_singular,
				'view_item' 		 => esc_html__( 'View', 'dt-booking-manager' ).' '.$person_singular,
				'search_items' 		 => esc_html__( 'Search', 'dt-booking-manager' ).' '.$person_singular,
				'not_found' 		 => esc_html__( 'No', 'dt-booking-manager').' '.$person_plural.' '.esc_html__('found', 'dt-booking-manager' ),
				'not_found_in_trash' => esc_html__( 'No', 'dt-booking-manager').' '.$person_plural.' '.esc_html__('found in Trash', 'dt-booking-manager' ),
				'parent_item_colon'  => esc_html__( 'Parent', 'dt-booking-manager' ).' '.$person_singular.':',
				'menu_name' 		 => $person_plural,
			);

			$args = array (
				'labels' 				=> $labels,
				'hierarchical' 			=> false,
				'description' 			=> esc_html__( 'Post type archives of ', 'dt-booking-manager' ).' '.$person_plural,
				'supports' 				=> array (
											'title',
											'comments'
										),
				'public' 				=> true,
				'show_ui' 				=> true,
				'show_in_menu' 			=> true,
				'menu_position' 		=> 5,
				'menu_icon' 			=> 'dashicons-businessman',
				
				'show_in_nav_menus' 	=> true,
				'publicly_queryable' 	=> false,
				'exclude_from_search' 	=> false,
				'has_archive' 			=> true,
				'query_var' 			=> true,
				'can_export' 			=> true,
				'rewrite' 				=> array( 'slug' => $personslug ),
				'capability_type' 		=> 'post'
			);

			register_post_type ( 'dt_person', $args );

			if( cs_get_option('enable-person-taxonomy') ):
				// Person Departments
				$labels = array(
					'name'              => $person_depart_plural,
					'singular_name'     => $person_depart_singular,
					'search_items'      => esc_html__( 'Search', 'dt-booking-manager' ).' '.$person_depart_plural,
					'all_items'         => esc_html__( 'All', 'dt-booking-manager' ).' '.$person_depart_plural,
					'parent_item'       => esc_html__( 'Parent', 'dt-booking-manager' ).' '.$person_depart_singular,
					'parent_item_colon' => esc_html__( 'Parent', 'dt-booking-manager' ).' '.$person_depart_singular.':',
					'edit_item'         => esc_html__( 'Edit', 'dt-booking-manager' ).' '.$person_depart_singular,
					'update_item'       => esc_html__( 'Update', 'dt-booking-manager' ).' '.$person_depart_singular,
					'add_new_item'      => esc_html__( 'Add New', 'dt-booking-manager' ).' '.$person_depart_singular,
					'new_item_name'     => esc_html__( 'New', 'dt-booking-manager' ).' '.$person_depart_singular.' '.esc_html__('Name', 'dt-booking-manager'),
					'menu_name'         => $person_depart_plural,
				);

				register_taxonomy ( 'dt_person_department', array (
					'dt_person'
				), array (
					'hierarchical' 		=> true,
					'labels' 			=> $labels,
					'show_admin_column' => true,
					'rewrite' 			=> array( 'slug' => $persondepartslug ),
					'query_var' 		=> true
				) );
			endif;
		}

		/**
		 * Person framework options
		 */
		function dt_person_cs_framework_options( $options ) {

			$personslug 			= dt_booking_cs_get_option( 'single-person-slug', 'dt_person' );
			$person_singular		= dt_booking_cs_get_option( 'singular-person-text', esc_html__('Person', 'dt-booking-manager') );
			$person_plural			= dt_booking_cs_get_option( 'plural-person-text', esc_html__('Persons', 'dt-booking-manager') );

			$persondepartslug  			= dt_booking_cs_get_option( 'person-department-slug', 'dt_person_department' );
			$person_depart_singular 	= dt_booking_cs_get_option( 'singular-person-department-text', esc_html__('Department', 'dt-booking-manager') );
			$person_depart_plural		= dt_booking_cs_get_option( 'plural-person-department-text', esc_html__('Departments', 'dt-booking-manager') );

			$options['booking-manager']['sections'][] = array(

				// -----------------------------------------
				// Person Options
				// -----------------------------------------
				'name'      => 'person_options',
				'title'     => $person_singular.' '.esc_html__('Options', 'dt-booking-manager'),
				'icon'      => 'fa fa-user',

				  'fields'      => array(
					  array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Person Archives Post Layout', 'dt-booking-manager' ),
					  ),

					  array(
						'id'      	 => 'person-archives-post-layout',
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
						'id'           => 'person-archives-post-style',
						'type'         => 'select',
						'title'        => esc_html__('Style', 'dt-booking-manager'),
						'options'      => array(
						  ''      => esc_html__('Default', 'dt-booking-manager'),
						  'hide-social-show-on-hover'      => esc_html__('Social on hover', 'dt-booking-manager'),
						  'hide-social-role-show-on-hover' => esc_html__('Social and Role on hover', 'dt-booking-manager'),
						  'hide-details-show-on-hover'     => esc_html__('Details on hover', 'dt-booking-manager'),
						  'hide-social-show-on-hover details-on-image'  => esc_html__('Show details & Social on hover', 'dt-booking-manager'),
						  'type2'     					   => esc_html__('Horizontal', 'dt-booking-manager'),
						  'hide-social-show-on-hover rounded'      		=> esc_html__('Rounded', 'dt-booking-manager')
						),
						'class'        => 'chosen',
						'default'      => '',
						'info'         => esc_html__('Choose post style to display archive page.', 'dt-booking-manager')
					  ),

					  array(
						'id'  	=> 'person-archives-excerpt',
						'type'  => 'switcher',
						'title' => esc_html__('Show Excerpt', 'dt-booking-manager'),
						'label'	=> esc_html__("YES! to enable person's excerpt", "dt-booking-manager")
					  ),

					  array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Bulk Custom Fields', 'dt-booking-manager' ),
					  ),

					  array(
						'id'              => 'person-custom-fields',
						'type'            => 'group',
						'title'           => esc_html__('Custom Fields', 'dt-booking-manager'),
						'info'            => esc_html__('Click button to add custom fields like cost, url and available etc', 'dt-booking-manager'),
						'button_title'    => esc_html__('Add New Field', 'dt-booking-manager'),
						'accordion_title' => esc_html__('Adding New Custom Field', 'dt-booking-manager'),
						'fields'          => array(
						  array(
							'id'          => 'person-custom-fields-text',
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
						'id'      => 'singular-person-text',
						'type'    => 'text',
						'title'   => esc_html__('Singular', 'dt-booking-manager').' '.$person_singular.' '.esc_html__('Name', 'dt-booking-manager'),
						'default' => $person_singular,
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Change as you like, save options & reload.', 'dt-booking-manager').'</p>',
					  ),

					  array(
						'id'      => 'plural-person-text',
						'type'    => 'text',
						'title'   => esc_html__('Plural', 'dt-booking-manager').' '.$person_singular.' '.esc_html__('Name', 'dt-booking-manager'),
						'default' => $person_plural,
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Change as you like, save options & reload.', 'dt-booking-manager').'</p>',
					  ),

					  array(
						'id'      => 'singular-person-department-text',
						'type'    => 'text',
						'title'   => esc_html__('Singular', 'dt-booking-manager').' '.$person_depart_singular.' '.esc_html__('Name', 'dt-booking-manager'),
						'default' => $person_depart_singular,
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Change as you like, save options & reload.', 'dt-booking-manager').'</p>',
					  ),

					  array(
						'id'      => 'plural-person-department-text',
						'type'    => 'text',
						'title'   => esc_html__('Plural', 'dt-booking-manager').' '.$person_depart_plural.' '.esc_html__('Name', 'dt-booking-manager'),
						'default' => $person_depart_plural,
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Change as you like, save options & reload.', 'dt-booking-manager').'</p>',
					  ),

					  array(
						'id'      => 'single-person-slug',
						'type'    => 'text',
						'title'   => esc_html__('Single', 'dt-booking-manager').' '.$person_singular.' '.esc_html__('Slug', 'dt-booking-manager'),
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Do not use characters not allowed in links. Use, eg. person-item ', 'dt-booking-manager').'<br> <b>'.esc_html__('After made changes save permalinks.', 'dt-booking-manager').'</b></p>',
					  ),

					  array(
						'id'      => 'person-department-slug',
						'type'    => 'text',
						'title'   => $person_singular.' '.$person_depart_singular.' '.esc_html__('Slug', 'dt-booking-manager'),
						'after' 	=> '<p class="cs-text-info">'.esc_html__('Do not use characters not allowed in links. Use, eg. person-type ', 'dt-booking-manager').'<br> <b>'.esc_html__('After made changes save permalinks.', 'dt-booking-manager').'</b></p>',
					  ),
				  ),
			);

			// Filter to add additional options for themes
			$options = apply_filters( 'dt_booking_template_framework_options', $options );

			return $options;
		}

		/**
		 * Person metabox options
		 */
		function dt_person_cs_metabox_options( $options ) {

			global $timearray;

			$monday = cs_get_option('appointment_fs1');
			$tuesday = cs_get_option('appointment_fs2');
			$wednesday = cs_get_option('appointment_fs3');
			$thursday = cs_get_option('appointment_fs4');
			$friday = cs_get_option('appointment_fs5');
			$saturday = cs_get_option('appointment_fs6');
			$sunday = cs_get_option('appointment_fs7');

			$fields = cs_get_option( 'person-custom-fields');
			$bothfields = $fielddef = $x = array();
			$before = '';

			if(!empty($fields)) :

				$i = 1;
				foreach($fields as $field):
					$x['id'] = 'person_opt_flds_title_'.$i;
					$x['type'] = 'text';
					$x['title'] = 'Title';
					$x['attributes'] = array( 'style' => 'background-color: #f0eff9;' );
					$bothfields[] = $x;
					unset($x);

					$x['id'] = 'person_opt_flds_value_'.$i;
					$x['type'] = 'text';
					$x['title'] = 'Value';
					$bothfields[] = $x;

					$fielddef['person_opt_flds_title_'.$i] = $field['person-custom-fields-text'];

					$i++;
				endforeach;
			else:
				$before = '<span>'.esc_html__('Go to options panel add few custom fields, then return back here.', 'dt-booking-manager').'</span>';
			endif;

			$service_plural = dt_booking_cs_get_option( 'plural-service-text', esc_html__('Services', 'dt-booking-manager') );
			$person_singular = dt_booking_cs_get_option( 'singular-person-text', esc_html__('Person', 'dt-booking-manager') );

			$symbol = dt_booking_get_currency_symbol();

			$options[]    = array(
			  'id'        => '_custom_settings',
			  'title'     => esc_html__('Custom Person Options', 'dt-booking-manager'),
			  'post_type' => 'dt_person',
			  'context'   => 'normal',
			  'priority'  => 'default',
			  'sections'  => array(


				array(
				  'name'  => 'mand_section',
				  'title' => esc_html__('Mandatory Fields', 'dt-booking-manager'),
				  'icon'  => 'fa fa-envelope-o',

				  'fields' => array(

					array(
					  'id'      => 'person-price',
					  'type'    => 'number',
					  'title'   => esc_html__('Cost', 'dt-booking-manager'),
					  'after'	=> '&nbsp;'.$symbol,
					  'desc'    => '<p class="cs-text-muted">'.esc_html__('Put a valid price here', 'dt-booking-manager').'</p>',
					  'attributes' => array(
						'style'    => 'width: 90px;'
					  )
					),

					array(
					  'id'      => 'person-role',
					  'type'    => 'text',
					  'title'   => esc_html__('Role', 'dt-booking-manager'),
					  'after'   => '<p class="cs-text-muted">'.esc_html__('Put designation here', 'dt-booking-manager').'</p>',
					  'attributes' => array(
						'style'    => 'width: 263px;'
					  )
					),

					array(
					  'id'      => 'person-email',
					  'type'    => 'text',
					  'title'   => esc_html__('Email Address', 'dt-booking-manager'),
					  'after'   => '<p class="cs-text-muted">'.esc_html__('Put a valid email here', 'dt-booking-manager').'</p>',
					  'attributes' => array(
						'style'    => 'width: 263px;'
					  )
					),

					array(
					  'id'  	=> 'person-social',
					  'type'  	=> 'textarea',
					  'title' 	=> esc_html__('Social Profile', 'dt-booking-manager'),
					  'info'	=> esc_html__('Add / Edit social link as you like here', 'dt-booking-manager'),
					  'default'	=> '[dt_sc_social facebook="#" twitter="#" google="#" linkedin="#" /]',
					  'attributes' => array(
						'rows'  => 3,
						'style'	=> 'min-height:75px;'
					  )
					),

					array(
					  'id'          => 'person-services',
					  'type'        => 'select',
					  'title'       => $service_plural,
					  'options'     => dt_booking_get_posts_array('service'),
					  'class'       => 'chosen',
					  'attributes'  => array(
						'multiple'  => 'only-key',
						'style'     => 'width: 245px;'
					  ),
					  'info'        => esc_html__('Choose any services for this', 'dt-booking-manager').' '.strtolower($person_singular).'.'
					),

				  ), // end: fields
				), // end: a section

				array(
				  'name'  => 'schedule_section',
				  'title' => esc_html__('Schedule Options', 'dt-booking-manager'),
				  'icon'  => 'fa fa-clock-o',

				  'fields' => array(

					array(
					  'id'        => 'appointment_fs1',
					  'type'      => 'fieldset',
					  'title'     => esc_html__('Monday', 'dt-booking-manager'),
					  'fields'    => array(
			
						array(
						  'id'    => 'dt_booking_monday_start',
						  'type'  => 'select',
						  'title'        => esc_html__('From:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
						array(
						  'id'    => 'dt_booking_monday_end',
						  'type'  => 'select',
						  'title'        => esc_html__('To:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
					  ),
					  'default'   => array(
						'dt_booking_monday_start'  => $monday['dt_booking_monday_start'],
						'dt_booking_monday_end'    => $monday['dt_booking_monday_end'],
					  )
					),
			
					array(
					  'id'        => 'appointment_fs2',
					  'type'      => 'fieldset',
					  'title'     => esc_html__('Tuesday', 'dt-booking-manager'),
					  'fields'    => array(
			
						array(
						  'id'    => 'dt_booking_tuesday_start',
						  'type'  => 'select',
						  'title'        => esc_html__('From:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
						array(
						  'id'    => 'dt_booking_tuesday_end',
						  'type'  => 'select',
						  'title'        => esc_html__('To:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
					  ),
					  'default'   => array(
						'dt_booking_tuesday_start'  => $tuesday['dt_booking_tuesday_start'],
						'dt_booking_tuesday_end'    => $tuesday['dt_booking_tuesday_end'],
					  )
					),		
			
					array(
					  'id'        => 'appointment_fs3',
					  'type'      => 'fieldset',
					  'title'     => esc_html__('Wednesday', 'dt-booking-manager'),
					  'fields'    => array(
			
						array(
						  'id'    => 'dt_booking_wednesday_start',
						  'type'  => 'select',
						  'title'        => esc_html__('From:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
						array(
						  'id'    => 'dt_booking_wednesday_end',
						  'type'  => 'select',
						  'title'        => esc_html__('To:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
					  ),
					  'default'   => array(
						'dt_booking_wednesday_start'  => $wednesday['dt_booking_wednesday_start'],
						'dt_booking_wednesday_end'    => $wednesday['dt_booking_wednesday_end'],
					  )
					),
			
					array(
					  'id'        => 'appointment_fs4',
					  'type'      => 'fieldset',
					  'title'     => esc_html__('Thursday', 'dt-booking-manager'),
					  'fields'    => array(
			
						array(
						  'id'    => 'dt_booking_thursday_start',
						  'type'  => 'select',
						  'title'        => esc_html__('From:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
						array(
						  'id'    => 'dt_booking_thursday_end',
						  'type'  => 'select',
						  'title'        => esc_html__('To:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
					  ),
					  'default'   => array(
						'dt_booking_thursday_start'  => $thursday['dt_booking_thursday_start'],
						'dt_booking_thursday_end'    => $thursday['dt_booking_thursday_end'],
					  )
					),
			
					array(
					  'id'        => 'appointment_fs5',
					  'type'      => 'fieldset',
					  'title'     => esc_html__('Friday', 'dt-booking-manager'),
					  'fields'    => array(
			
						array(
						  'id'    => 'dt_booking_friday_start',
						  'type'  => 'select',
						  'title'        => esc_html__('From:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
						array(
						  'id'    => 'dt_booking_friday_end',
						  'type'  => 'select',
						  'title'        => esc_html__('To:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
					  ),
					  'default'   => array(
						'dt_booking_friday_start'  => $friday['dt_booking_friday_start'],
						'dt_booking_friday_end'    => $friday['dt_booking_friday_end'],
					  )
					),
			
					array(
					  'id'        => 'appointment_fs6',
					  'type'      => 'fieldset',
					  'title'     => esc_html__('Saturday', 'dt-booking-manager'),
					  'fields'    => array(
			
						array(
						  'id'    => 'dt_booking_saturday_start',
						  'type'  => 'select',
						  'title'        => esc_html__('From:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
			
						array(
						  'id'    => 'dt_booking_saturday_end',
						  'type'  => 'select',
						  'title'        => esc_html__('To:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
					  ),
					  'default'   => array(
						'dt_booking_saturday_start'  => $saturday['dt_booking_saturday_start'],
						'dt_booking_saturday_end'    => $saturday['dt_booking_saturday_end'],
					  )
					),
			
					array(
					  'id'        => 'appointment_fs7',
					  'type'      => 'fieldset',
					  'title'     => esc_html__('Sunday', 'dt-booking-manager'),
					  'fields'    => array(
			
						array(
						  'id'    => 'dt_booking_sunday_start',
						  'type'  => 'select',
						  'title'        => esc_html__('From:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),

						array(
						  'id'    => 'dt_booking_sunday_end',
						  'type'  => 'select',
						  'title'        => esc_html__('To:', 'dt-booking-manager'),
						  'options'      => $timearray,
						  'class'        => 'chosen',
						),
					  ),
					  'default'   => array(
						'dt_booking_sunday_start'  => $sunday['dt_booking_sunday_start'],
						'dt_booking_sunday_end'    => $sunday['dt_booking_sunday_end'],
					  )
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
		function dt_person_edit_columns($columns) {

			$newcolumns = array (
				"cb" => "<input type=\"checkbox\" />",
				"dt_person_thumb" => esc_html__("Image", 'dt-booking-manager'),
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
		function dt_person_columns_display($columns, $id) {
			global $post;

			switch ($columns) {

				case "dt_person_thumb" :
				    $image = wp_get_attachment_image(get_post_thumbnail_id($id), array(75,75));
					if(!empty($image)):
					  	echo ($image);
				    else:
						$person_settings = get_post_meta ( $post->ID, '_custom_settings', TRUE );
						$person_settings = is_array ( $person_settings ) ? $person_settings : array ();

						if( array_key_exists("person-gallery", $person_settings)) {
							$items = explode(',', $person_settings["person-gallery"]);
							echo wp_get_attachment_image( $items[0], array(75, 75) );
						}
					endif;
				break;
			}
		}
		
		/**
		 *
		 * @param $post_id
		 * @return none:
		 */
		function dt_person_save_post_meta($post_id) {

			if( key_exists ( '_inline_edit',$_POST )) :
				if ( wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) return;
			endif;

			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

			if (!current_user_can('edit_post', $post_id)) :
				return;
			endif;

			if ( (key_exists('post_type', $_POST)) && ('dt_person' == $_POST['post_type']) ) :

				$services = isset($_POST['_custom_settings']) ? $_POST['_custom_settings']['person-services'] : '';
				if( $services != '' ):
					update_post_meta ( $post_id, '_dt_booking_person_services', array_filter ( $services ) );
				endif;

			endif;
		}		
	}
}