<?php
if( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'DTBookingManagerDesignThemes' ) ) {

	class DTBookingManagerDesignThemes {

		function __construct() {

			add_filter( 'body_class', array( $this, 'dt_booking_dt_body_class' ), 20 );

			add_filter( 'dt_booking_template_metabox_options', array( $this, 'dt_booking_dt_template_metabox_options'), 10, 1 );
			add_filter( 'dt_booking_template_framework_options', array( $this, 'dt_booking_dt_template_framework_options'), 10, 1 );

			add_action( 'wp_enqueue_scripts', array( $this, 'dt_booking_dt_enqueue_styles' ), 104 );

			add_action( 'dt_booking_before_main_content', array( $this, 'dt_booking_dt_before_main_content' ), 10 );
			add_action( 'dt_booking_after_main_content', array( $this, 'dt_booking_dt_after_main_content' ), 10 );

			add_action( 'dt_booking_before_content', array( $this, 'dt_booking_dt_before_content' ), 10 );
			add_action( 'dt_booking_after_content', array( $this, 'dt_booking_dt_after_content' ), 10 );
		}

		function dt_booking_dt_body_class( $classes ) {

			return $classes;

		}

		function dt_booking_dt_template_metabox_options($options) {

			foreach($options as $option_key => $option) {

				if( $option['id'] == '_custom_settings' ) :

					$page_layout_options = array(
					    'global-site-layout'   => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/admin-option.png',
    					'content-full-width'   => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/without-sidebar.png',
    					'with-left-sidebar'    => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/left-sidebar.png',
    					'with-right-sidebar'   => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/right-sidebar.png',
    					'with-both-sidebar'    => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/both-sidebar.png',
  					);

					$meta_layout_section =array(
					  'name'  => 'layout_section',
					  'title' => esc_html__('Layout', 'dt-booking-manager'),
					  'icon'  => 'fa fa-columns',
					  'fields' =>  array(
					    array(
					      'id'  => 'layout',
					      'type' => 'image_select',
					      'title' => esc_html__('Page Layout', 'dt-booking-manager' ),
					      'options'      => $page_layout_options,
					      'default'      => 'global-site-layout',
					      'attributes'   => array( 'data-depend-id' => 'page-layout' )
					    ),
					    array(
					      'id'        => 'show-standard-sidebar-left',
					      'type'      => 'switcher',
					      'title'     => esc_html__('Show Standard Left Sidebar', 'dt-booking-manager' ),
					      'dependency'=> array( 'page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
						  'default'	  => true,
					    ),
					    array(
					      'id'        => 'widget-area-left',
					      'type'      => 'select',
					      'title'     => esc_html__('Choose Left Widget Areas', 'dt-booking-manager' ),
					      'class'     => 'chosen',
					      'options'   => augury_customizer_custom_widgets(),
					      'attributes'  => array( 
					        'multiple'  => 'multiple',
					        'data-placeholder' => esc_html__('Select Left Widget Areas','dt-booking-manager'),
					        'style' => 'width: 400px;'
					      ),
					      'dependency'  => array( 'page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
					    ),
					    array(
					      'id'          => 'show-standard-sidebar-right',
					      'type'        => 'switcher',
					      'title'       => esc_html__('Show Standard Right Sidebar', 'dt-booking-manager' ),
					      'dependency'  => array( 'page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
						  'default'	  	=> true,
					    ),
					    array(
					      'id'        => 'widget-area-right',
					      'type'      => 'select',
					      'title'     => esc_html__('Choose Right Widget Areas', 'dt-booking-manager' ),
					      'class'     => 'chosen',
					      'options'   => augury_customizer_custom_widgets(),
					      'attributes'    => array( 
					        'multiple' => 'multiple',
					        'data-placeholder' => esc_html__('Select Right Widget Areas','dt-booking-manager'),
					        'style' => 'width: 400px;'
					      ),
					      'dependency'  => array( 'page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
					    )
					  )
					);					

					$meta_breadcrumb_section = array(
					  'name'  => 'breadcrumb_section',
					  'title' => esc_html__('Breadcrumb', 'dt-booking-manager'),
					  'icon'  => 'fa fa-sitemap',
					  'fields' =>  array(

					    array(
					      'id'  => 'breadcrumb-option',
					      'type' => 'image_select',
					      'title' => esc_html__('Breadcrumb Option', 'dt-booking-manager' ),
					      'options'      => array(
					        'global-option'   	=> DTBOOKINGMANAGER_URL . '/cs-framework-override/images/admin-option.png',
							'individual-option' => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/individual-option.png'
					      ),
					      'default'      => 'global-option',
					      'attributes'   => array( 'data-depend-id' => 'breadcrumb-option' )
					    ),
					    array(
					      'id'         => 'enable-sub-title',
					      'type'       => 'switcher',
					      'title'      => esc_html__('Show Breadcrumb', 'dt-booking-manager' ),
					      'default'    => true,
					      'dependency' => array( 'breadcrumb-option', 'any', 'individual-option' ),
					    ),
					    array(
					      'id'         => 'enable-dark-bg',
					      'type'       => 'switcher',
					      'title'      => esc_html__('Dark BG?', 'dt-booking-manager' ),
					      'default'    => true,
					      'dependency' => array( 'breadcrumb-option', 'any', 'individual-option' ),
					    ),    
					    array(
					    	'id'               => 'breadcrumb_position',
						    'type'             => 'select',
					      'title'              => esc_html__('Position', 'dt-booking-manager' ),
					      'options'            => array(
					        'header-top-absolute' => esc_html__('Behind the Header','dt-booking-manager'),
					        'header-top-relative' => esc_html__('Default','dt-booking-manager'),
						  	),
							  'default'        => 'header-top-relative',	
					      'dependency'         => array( 'enable-sub-title|breadcrumb-option', '==|any', 'true|individual-option' ),
					    ),    
					    array(
					      'id'         => 'breadcrumb_background',
					      'type'       => 'background',
					      'title'      => esc_html__('Background', 'dt-booking-manager' ),
					      'dependency' => array( 'enable-sub-title|breadcrumb-option', '==|any', 'true|individual-option' ),
					    )					    
					  )
					);

					if( $options[$option_key]['sections'][0]['name'] != 'layout_section' ) :
						array_unshift($options[$option_key]['sections'], $meta_layout_section, $meta_breadcrumb_section);
					endif;
				endif;
			}

			return $options;
		}

		function dt_booking_dt_template_framework_options($options) {

			foreach($options as $option_key => $option) {

				if( $option['name'] == 'dt-booking-manager' ) :

					$sarchive_layouts = array(
					  array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Service Archives Page Layout', 'dt-booking-manager' ),
					  ),

					  array(
						'id'      	 => 'service-archives-page-layout',
						'type'       => 'image_select',
						'title'      => esc_html__('Page Layout', 'dt-booking-manager'),
						'options'    => array(
						  'content-full-width'   => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/without-sidebar.png',
						  'with-left-sidebar'    => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/left-sidebar.png',
						  'with-right-sidebar'   => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/right-sidebar.png',
						  'with-both-sidebar'    => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/both-sidebar.png',
						),
						'default'     => 'content-full-width',
						'attributes'  => array(
						  'data-depend-id' => 'service-archives-page-layout',
						),
					  ),

					  array(
						'id'  		 => 'show-standard-left-sidebar-for-service-archives',
						'type'  	 => 'switcher',
						'title' 	 => esc_html__('Show Standard Left Sidebar', 'dt-booking-manager'),
						'dependency' => array( 'service-archives-page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
					  ),

					  array(
						'id'  		 => 'show-standard-right-sidebar-for-service-archives',
						'type'  	 => 'switcher',
						'title' 	 => esc_html__('Show Standard Right Sidebar', 'dt-booking-manager'),
						'dependency' => array( 'service-archives-page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
					  ), // end: fields
				  	); // end: a section

					if( $options[$option_key]['sections'][4]['name'] == 'service_options' && $options[$option_key]['sections'][4]['fields'][1]['id'] != 'service-archives-page-layout' ):
						array_unshift($options[$option_key]['sections'][4]['fields'], $sarchive_layouts[0], $sarchive_layouts[1], $sarchive_layouts[2], $sarchive_layouts[3] );
					endif;

					$parchive_layouts = array(
					  array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Person Archives Page Layout', 'dt-booking-manager' ),
					  ),

					  array(
						'id'      	 => 'person-archives-page-layout',
						'type'       => 'image_select',
						'title'      => esc_html__('Page Layout', 'dt-booking-manager'),
						'options'    => array(
						  'content-full-width'   => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/without-sidebar.png',
						  'with-left-sidebar'    => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/left-sidebar.png',
						  'with-right-sidebar'   => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/right-sidebar.png',
						  'with-both-sidebar'    => DTBOOKINGMANAGER_URL . '/cs-framework-override/images/both-sidebar.png',
						),
						'default'      => 'content-full-width',
						'attributes'   => array(
						  'data-depend-id' => 'person-archives-page-layout',
						),
					  ),

					  array(
						'id'  		 => 'show-standard-left-sidebar-for-person-archives',
						'type'  	 => 'switcher',
						'title' 	 => esc_html__('Show Standard Left Sidebar', 'dt-booking-manager'),
						'dependency' => array( 'person-archives-page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
					  ),

					  array(
						'id'  		 => 'show-standard-right-sidebar-for-person-archives',
						'type'  	 => 'switcher',
						'title' 	 => esc_html__('Show Standard Right Sidebar', 'dt-booking-manager'),
						'dependency' => array( 'person-archives-page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
					  ),
				  	); // end: a section

					if( isset( $options[$option_key]['sections'][5] ) && $options[$option_key]['sections'][5]['name'] == 'person_options' && $options[$option_key]['sections'][5]['fields'][1]['id'] != 'person-archives-page-layout' ) :
						array_unshift($options[$option_key]['sections'][5]['fields'], $parchive_layouts[0], $parchive_layouts[1], $parchive_layouts[2], $parchive_layouts[3] );
					endif;
				endif;
			}

			return $options;
		}

		function dt_booking_dt_enqueue_styles() {

			wp_enqueue_style ( 'dt_booking-designthemes', plugins_url ('designthemes-booking-manager') . '/css/designthemes.css' );

		}

		function dt_booking_dt_before_main_content() {

			if ( is_singular( 'dt_service' ) || is_singular( 'dt_person' ) ) {

				global $post;

			    $settings = get_post_meta($post->ID,'_custom_settings',TRUE);
			    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

				if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
					if( empty($settings) ) { 
			            $settings['breadcrumb-option'] = 'global-option';
			        }
					$settings['layout'] = augury_get_option( 'site-global-sidebar-layout' );
					$settings['show-standard-sidebar-left'] = true;
			        $settings['show-standard-sidebar-right'] = true;
			    }

			    if( !isset($settings['breadcrumb-option']) ) { 
			        $settings['breadcrumb-option'] = 'global-option';
			    }

			    $breadcrumb_disabled = false;
			    if( $settings['breadcrumb-option'] == 'global-option' ) {
			        $global_breadcrumb = augury_get_option( 'show-breadcrumb' );
			        if( !empty( $global_breadcrumb ) ) {
			            $header_class = augury_get_option( 'breadcrumb-position' );
			        } else {
			            $breadcrumb_disabled = true;
			        }
			    } else if( $settings['breadcrumb-option'] == 'individual-option' ) {
			        if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {
			            $header_class = isset( $settings['breadcrumb_position'] ) ? $settings['breadcrumb_position'] : '';
					} else {
			            $breadcrumb_disabled = true;
			        }
			    } ?>

				<!-- ** Header Wrapper ** -->
				<div id="header-wrapper" class="<?php echo esc_attr($header_class); ?>">              
				    
				    <!-- **Header** -->
				    <header id="header">

				        <div class="container"><?php
				            /**
				             * augury_header hook.
				             * 
				             * @hooked augury_ele_header_template - 10
				             *
				             */
				            do_action( 'augury_header' ); ?>
				        </div>
				    </header><!-- **Header - End ** -->

				    <!-- ** Breadcrumb ** -->
				    <?php
				        if(!$breadcrumb_disabled) {

				            $breadcrumbs = array();
				            $bstyle = augury_get_option( 'breadcrumb-style' );

				            $darkbg = '';
				            if( $settings['breadcrumb-option'] == 'global-option' ) {
				                $darkbg = augury_get_option( 'apply-dark-bg-breadcrumb' );
				                $darkbg = $darkbg ? "dark-bg-breadcrumb" : "";
				            }else if( $settings['breadcrumb-option'] == 'individual-option' ) {
				                if( isset( $settings['enable-dark-bg'] ) && $settings['enable-dark-bg'] ) {
				                    $darkbg = "dark-bg-breadcrumb";
				                }
				            }

							$separator = '<span class="'.augury_get_option( 'breadcrumb-delimiter' ).'"></span>';
							$change_delimiter = augury_get_option( 'change-breadcrumb-delimiter' );
							if( !$change_delimiter ) {
								$separator = '<span class="breadcrumb-default-delimiter"></span>';
							}

							$taxonomy = is_single('dt_person') ? 'dt_person_department' : 'dt_service_category';

							$terms = get_the_terms( $post->ID, $taxonomy );
							$breadcrumbs[] = isset($terms[0]) ? '<a href="'.get_term_link( $terms[0] ).'">'.$terms[0]->name.'</a>': '';
							$breadcrumbs[] = the_title( '<span class="current">', '</span>', false );
							$bcsettings = isset( $settings['breadcrumb_background'] ) ? $settings['breadcrumb_background'] : array();

							augury_breadcrumb_output ( the_title( '<h1>', '</h1>',false ), $breadcrumbs, $bstyle .' '.$darkbg, array () );
				        }

				    ?><!-- ** Breadcrumb End ** -->
				</div><!-- ** Header Wrapper - End ** --><?php
			}

			if( is_post_type_archive('dt_service') || is_tax ( 'dt_service_category' ) || is_post_type_archive('dt_person') || is_tax ( 'dt_person_department' ) ) {

				$global_breadcrumb = augury_get_option( 'show-breadcrumb' );
				$header_class	   = augury_get_option( 'breadcrumb-position' ); ?>

				<!-- ** Header Wrapper ** -->
				<div id="header-wrapper" class="<?php echo esc_attr($header_class); ?>">

					<!-- **Header** -->
					<header id="header">
						<div class="container"><?php
					        /**
					         * augury_header hook.
					         * 
					         * @hooked augury_ele_header_template - 10
					         *
					         */
					        do_action( 'augury_header' ); ?>
					    </div>
					</header><!-- **Header - End ** -->

					<!-- ** Breadcrumb ** -->
				    <?php
				        if( !empty( $global_breadcrumb ) ) {

				            $darkbg = augury_get_option( 'apply-dark-bg-breadcrumb' );
				            $darkbg = $darkbg ? "dark-bg-breadcrumb" : "";

				        	$bstyle = augury_get_option( 'breadcrumb-style' );
				        	$style = augury_breadcrumb_css();

				            $title = '<h1>'.get_the_archive_title().'</h1>';
				            $breadcrumbs = array();

				            if ( is_post_type_archive() ) {
				            	global $wp_query;

				                $breadcrumbs[] = '<a href="'. get_post_type_archive_link($wp_query->queried_object->query_var) .'">' . post_type_archive_title('', false) . '</a>';
				            } elseif( is_tax() ){
				            	$breadcrumbs[] = '<a href="'. get_category_link( get_query_var('cat') ) .'">' . single_cat_title('', false) . '</a>';
				            }

				            augury_breadcrumb_output ( $title, $breadcrumbs, $bstyle .' '.$darkbg, $style );
				        }
				    ?><!-- ** Breadcrumb End ** -->                
				</div><!-- ** Header Wrapper - End ** --><?php
			}
		}

		function dt_booking_dt_after_main_content() {

		}

		function dt_booking_dt_before_content() {

			$post_type = '';
			if( is_singular( 'dt_service' ) )
				$post_type = 'dt_service';
			elseif( is_singular( 'dt_person' ) )
				$post_type = 'dt_person';

			if ( $post_type ) { ?>

				<!-- **Main** -->
				<div id="main">

				    <!-- ** Container ** -->
				    <div class="container"><?php
						global $post;

					    $settings = get_post_meta($post->ID,'_custom_settings',TRUE);
					    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

				        $page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";
				        $layout = augury_page_layout( $page_layout );
				        extract( $layout );?>

				        <!-- Primary -->
				        <section id="primary" class="<?php echo esc_attr( $page_layout );?>"><?php
			}

			$archive_type = '';
			if( is_post_type_archive('dt_service') || is_tax ( 'dt_service_category' ) )
				$archive_type = 'service';
			elseif( is_post_type_archive('dt_person') || is_tax ( 'dt_person_department' ) )
				$archive_type = 'person';

			if( $archive_type ) { ?>

				<!-- **Main** -->
				<div id="main">
				    <!-- ** Container ** -->
				    <div class="container"><?php
				    	$page_layout  = cs_get_option( $archive_type.'-archives-page-layout' );
				    	$page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";

				    	$layout = augury_page_layout( $page_layout );
				    	extract( $layout );?>

				    	<!-- Primary -->
				        <section id="primary" class="<?php echo esc_attr( $page_layout );?>"><?php
			}
		}

		function dt_booking_dt_after_content() {

			$post_type = '';
			if( is_singular( 'dt_service' ) )
				$post_type = 'dt_service';
			elseif( is_singular( 'dt_person' ) )
				$post_type = 'dt_person';

			if ( $post_type ) { ?>

				        </section><!-- Primary End --><?php

						global $post;

					    $settings = get_post_meta($post->ID,'_custom_settings',TRUE);
					    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

				        $page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";
				        $layout = augury_page_layout( $page_layout );
				        extract( $layout );

				        if ( $show_sidebar ) {
				            if ( $show_left_sidebar ) { ?>
				                <!-- Secondary Left -->
				                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php
				                    augury_show_sidebar( $post_type, $post->ID, 'left' );
				                ?></section><!-- Secondary Left End --><?php
				            }
				        }

				        if ( $show_sidebar ) {
				            if ( $show_right_sidebar ) { ?>
				                <!-- Secondary Right -->
				                <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php
				                    augury_show_sidebar( $post_type, $post->ID, 'right' );
				                ?></section><!-- Secondary Right End --><?php
				            }
				        }?>
				    </div>
				    <!-- ** Container End ** -->

				</div><!-- **Main - End ** --><?php
			}

			$archive_type = '';
			if( is_post_type_archive('dt_service') || is_tax ( 'dt_service_category' ) )
				$archive_type = 'service';
			elseif( is_post_type_archive('dt_person') || is_tax ( 'dt_person_department' ) )
				$archive_type = 'person';

			if( $archive_type ) { ?>

				        </section><!-- Primary End --><?php

				    	$page_layout  = cs_get_option( $archive_type.'-archives-page-layout' );
				    	$page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";

				    	$layout = augury_page_layout( $page_layout );
				    	extract( $layout );

				        if ( $show_sidebar ) {
				            if ( $show_left_sidebar ) {?>
				                <!-- Secondary Left -->
				                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php
										$wtstyle = augury_get_option( 'widget-title-style' );
										echo !empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';

										if( is_active_sidebar('custom-post-'.$archive_type.'-archives-sidebar-left') ):
											dynamic_sidebar('custom-post-'.$archive_type.'-archives-sidebar-left');
										endif;

										$enable = cs_get_option( 'show-standard-left-sidebar-for-'.$archive_type.'-archives' );
										if( $enable ):
											if( is_active_sidebar('standard-sidebar-left') ):
												dynamic_sidebar('standard-sidebar-left');
											endif;
										endif;

										echo !empty( $wtstyle ) ? '</div>' : ''; ?></section><!-- Secondary Left End --><?php
				            }
				        }        

				    	if ( $show_sidebar ) {
				    		if ( $show_right_sidebar ) {?>
				    		 	<!-- Secondary Right -->
				    			<section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php
									$wtstyle = augury_get_option( 'widget-title-style' );
									echo !empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';

									if( is_active_sidebar('custom-post-'.$archive_type.'-archives-sidebar-right') ):
										dynamic_sidebar('custom-post-'.$archive_type.'-archives-sidebar-right');
									endif;

									$enable = cs_get_option( 'show-standard-right-sidebar-for-'.$archive_type.'-archives' );
									if( $enable ):
										if( is_active_sidebar('standard-sidebar-right') ):
											dynamic_sidebar('standard-sidebar-right');
										endif;
									endif;

									echo !empty( $wtstyle ) ? '</div>' : ''; ?></section><!-- Secondary Right End --><?php
				    		}
				    	}?>
				    </div>
				    <!-- ** Container End ** -->
				</div><!-- **Main - End ** --><?php
		    }
		}
	}

	new DTBookingManagerDesignThemes();
}