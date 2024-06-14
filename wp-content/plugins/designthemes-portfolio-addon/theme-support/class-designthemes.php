<?php

if( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'DTPortfolioDesignThemes' ) ) {

	class DTPortfolioDesignThemes {

		function __construct() {

			add_filter( 'body_class', array( $this, 'dtportfolio_dt_body_class' ), 20 );

			add_filter( 'augury_header_footer_default_cpt', array( $this, 'dtportfolio_header_footer_default_cpt' ) );

			add_filter( 'dtportfolio_template_metabox_options', array( $this, 'dtportfolio_dt_template_metabox_options'), 10, 1);

			add_action( 'wp_enqueue_scripts', array( $this, 'dtportfolio_dt_enqueue_styles' ), 104 );

			add_action( 'dtportfolio_before_main_content', array( $this, 'dtportfolio_dt_before_main_content' ), 10 );
			add_action( 'dtportfolio_after_main_content', array( $this, 'dtportfolio_dt_after_main_content' ), 10 );

			add_action( 'dtportfolio_before_content', array( $this, 'dtportfolio_dt_before_content' ), 10 );
			add_action( 'dtportfolio_after_content', array( $this, 'dtportfolio_dt_after_content' ), 10 );

		}
	
		function dtportfolio_dt_body_class( $classes ) {

			if (is_singular( 'dt_portfolios' )) {

				global $post;

				$portfolio_settings = get_post_meta($post->ID, '_portfolio_settings', true);
				$portfolio_settings = is_array($portfolio_settings) ? $portfolio_settings : array ();


				$dtportfolio_remove_footer = (array_key_exists('dtportfolio-remove-footer', $portfolio_settings) && $portfolio_settings['dtportfolio-remove-footer']) ? true : false;

				if($dtportfolio_remove_footer) {
					$classes[] = 'dtportfolio-remove-footer';
				}

				$dtportfolio_transparent_header = (array_key_exists('dtportfolio-transparent-header', $portfolio_settings) && $portfolio_settings['dtportfolio-transparent-header']) ? true : false;

				if($dtportfolio_transparent_header) {
					$classes[] = 'dtportfolio-transparent-header';
				}

				$portfolio_layout = array_key_exists('portfolio-layout', $portfolio_settings) ? $portfolio_settings['portfolio-layout'] : '';

				if($portfolio_layout == 'fixed-gallery' || $portfolio_layout == 'fixed-feature-image' || $portfolio_layout == 'gallery-list') {
					$classes[] = 'dtportfolio-fixed-items-page';
				}

			}
			return $classes;

		}	

		function dtportfolio_header_footer_default_cpt( $custom_posts ) {

			$custom_posts[] = 'dt_portfolios';

			return $custom_posts;

		}	

		function dtportfolio_dt_template_metabox_options($options) {

			foreach($options as $option_key => $option) {

				if($option['id'] == '_portfolio_settings') {

					$options[$option_key]['sections'][0]['fields'][] = array (
																			'id'      	 => 'layout',
																			'type'         => 'image_select',
																			'title'        => esc_html__('Layout', 'dtportfolio'),
																			'options'      => array (
																				'content-full-width'   => plugins_url('designthemes-portfolio-addon').'/images/without-sidebar.png',
																				'with-left-sidebar'    => plugins_url('designthemes-portfolio-addon').'/images/left-sidebar.png',
																				'with-right-sidebar'   => plugins_url('designthemes-portfolio-addon').'/images/right-sidebar.png',
																			),
																			'default'      => 'content-full-width',
																			'attributes'   => array (
																				'data-depend-id' => 'layout',
																			),
																			'dependency'   => array ( 
																				'portfolio-layout', 
																				'any', 
																				'custom-layout,media-on-top' 
																			),			
																		);

					$options[$option_key]['sections'][0]['fields'][] = array (
																			'id'  		 => 'show-standard-sidebar-left',
																			'type'  		 => 'switcher',
																			'title' 		 => esc_html__('Show Standard Left Sidebar', 'dtportfolio'),
																			'dependency'   => array ( 'portfolio-layout|layout', 'any|any', 'custom-layout,media-on-top|with-left-sidebar' ),
																		);

					$options[$option_key]['sections'][0]['fields'][] = array (
																			'id'  		 => 'widget-area-left',
																			'type'  		 => 'select',
																			'title' 		 => esc_html__('Choose Widget Area - Left Sidebar', 'dtportfolio'),
																			'class'		 => 'chosen',
																			'options'   	 => augury_customizer_custom_widgets(),
																			'attributes'   => array (
																				'multiple'  	   => 'multiple',
																				'data-placeholder' => esc_attr__('Select Widget Areas', 'dtportfolio'),
																				'style' 		   => 'width: 400px;'
																			),
																			'dependency'   => array ( 'portfolio-layout|layout', 'any|any', 'custom-layout,media-on-top|with-left-sidebar' ),
																		);

					$options[$option_key]['sections'][0]['fields'][] = array (
																			'id'  		 => 'show-standard-sidebar-right',
																			'type'  		 => 'switcher',
																			'title' 		 => esc_html__('Show Standard Right Sidebar', 'dtportfolio'),
																			'dependency'   => array ( 'portfolio-layout|layout', 'any|any', 'custom-layout,media-on-top|with-right-sidebar' ),
																		);

					$options[$option_key]['sections'][0]['fields'][] = array (
																			'id'  		 => 'widget-area-right',
																			'type'  		 => 'select',
																			'title' 		 => esc_html__('Choose Widget Area - Right Sidebar', 'dtportfolio'),
																			'class'		 => 'chosen',
																			'options'   	 => augury_customizer_custom_widgets(),
																			'attributes'   => array(
																				'multiple'  	   => 'multiple',
																				'data-placeholder' => esc_attr__('Select Widget Areas', 'dtportfolio'),
																				'style' 		   => 'width: 400px;'
																			),
																			'dependency'   => array ( 'portfolio-layout|layout', 'any|any', 'custom-layout,media-on-top|with-right-sidebar' ),
																		);


					$options[$option_key]['sections'][0]['fields'][] = array (
																			'id'      	 => 'breadcrumb-option',
																			'type'         => 'image_select',
																			'title'        => esc_html__('Breadcrumb Option', 'dtportfolio'),
																			'options'      => array (
																				'global-option'   => plugins_url('designthemes-portfolio-addon').'/images/admin-option.png',
																				'individual-option'    => plugins_url('designthemes-portfolio-addon').'/images/individual-option.png',
																			),
																			'default'      => 'global-option',
																			'attributes'   => array (
																				'data-depend-id' => 'breadcrumb-option',
																			)			
																		);

					$options[$option_key]['sections'][0]['fields'][] = array (
																			'id'      => 'enable-sub-title',
																			'type'    => 'switcher',
																			'title'   => esc_html__('Show Breadcrumb', 'dtportfolio' ),
																			'default' => true,
																			'dependency'   => array( 'breadcrumb-option', 'any', 'individual-option' ),
																		);

					$options[$option_key]['sections'][0]['fields'][] = array (
																			'id'	  => 'breadcrumb_position',
																			'type'    => 'select',
																			'title'   => esc_html__('Position', 'dtportfolio' ),
																			'options' => array (
																				'header-top-absolute'    => esc_html__('Behind the Header','dtportfolio'),
																				'header-top-relative' 	   => esc_html__('Default','dtportfolio'),
																			),
																			'default'    => 'header-top-relative',
																			'dependency'  =>  array( 'enable-sub-title|breadcrumb-option', '==|any', 'true|individual-option' ),
																		);

					$options[$option_key]['sections'][0]['fields'][] = array (
																			'id'    => 'breadcrumb_background',
																			'type'  => 'background',
																			'title' => esc_html__('Background', 'dtportfolio'),
																			'desc'  => esc_html__('Choose background options for breadcrumb title section.', 'dtportfolio'),
																			'dependency'  =>  array( 'enable-sub-title|breadcrumb-option', '==|any', 'true|individual-option' ),
																		);


					$options[$option_key]['sections'][0]['fields'][] = array (
																			'type' => 'switcher',
																			'id' => 'dtportfolio-transparent-header',
																			'title' => esc_html__('Enable Transparent Header', 'dtportfolio'),
																			'desc'  => esc_html__('If you wish you can enable transparent header for your theme.', 'dtportfolio'),
																		);					

				}

			}

			return $options;

		}

		function dtportfolio_dt_enqueue_styles() {

			wp_enqueue_style ( 'dtportfolio-designthemes', plugins_url ('designthemes-portfolio-addon') . '/css/designthemes.css' );

		}

		function dtportfolio_dt_before_main_content() {


			if (is_singular( 'dt_portfolios' )) {	

				global $post;

				$global_breadcrumb = augury_get_option( 'show-breadcrumb' );

			    $settings = get_post_meta($post->ID,'_portfolio_settings',TRUE);
			    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

				$portfolio_layout = array_key_exists("portfolio-layout",$settings) ? $settings['portfolio-layout'] : '';
				
				if( empty($settings) || !isset($settings['breadcrumb-option']) ) { 
					$settings['breadcrumb-option'] = 'global-option';
				}

				$darkbg = '';
				if( $settings['breadcrumb-option'] == 'global-option' ) {
					$darkbg = augury_get_option( 'apply-dark-bg-breadcrumb' );
					$darkbg = $darkbg ? "dark-bg-breadcrumb" : "";
		        }else if( $settings['breadcrumb-option'] == 'individual-option' ) {
		        	if( isset( $settings['enable-dark-bg'] ) && $settings['enable-dark-bg'] ) {
		        		$darkbg = "dark-bg-breadcrumb";
		            }
		        }				

				$header_class = '';
				$breadcrumb_disabled = false;
			    if($portfolio_layout != 'media-on-top' && $portfolio_layout != 'fixed-gallery' && $portfolio_layout != 'fixed-feature-image' && $portfolio_layout != 'gallery-list') {

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
					}
				} ?>

				<div id="header-wrapper" class="<?php echo esc_attr($header_class); ?>">

				    <header id="header">

				        <div class="container">
				        	<?php do_action( 'augury_header' ); ?>
				        </div>
				    </header>

				    <?php
					if($portfolio_layout != 'media-on-top' && $portfolio_layout != 'fixed-gallery' && $portfolio_layout != 'fixed-feature-image' && $portfolio_layout != 'gallery-list') {

						if(!$breadcrumb_disabled) {

							$breadcrumbs = array();
							$bstyle = augury_get_option( 'breadcrumb-style', 'default' );							

							$separator = '<span class="'.augury_get_option( 'breadcrumb-delimiter', 'fa default' ).'"></span>';

							$change_delimiter = augury_get_option( 'change-breadcrumb-delimiter' );
							if( !$change_delimiter ) {
								$separator = '<span class="breadcrumb-default-delimiter"></span>';
							}						

							$cat = get_the_category();
							$cat = isset($cat[0]) ? $cat[0] : '';
							$breadcrumbs[] = get_category_parents( $cat, true, $separator );
							$breadcrumbs[] = the_title( '<span class="current">', '</span>', false );

							augury_breadcrumb_output ( '<h1>'.esc_html__( 'Case Study Detail', 'dtportfolio' ).'</h1>', $breadcrumbs, $bstyle .' '. $darkbg, array () );		
						}

				    }

			    	do_action( 'dtportfolio_mediaontop_hook' );
				    ?>

				</div>

				<?php

			}

			if(is_post_type_archive('dt_portfolios') || is_tax ( 'portfolio_entries' ) || is_tax ( 'portfolio_tags' ) ) {

				$global_breadcrumb = augury_get_option( 'show-breadcrumb' );
				$header_class	   = augury_get_option( 'breadcrumb-position' );

				$darkbg = augury_get_option( 'apply-dark-bg-breadcrumb' );
				$darkbg = $darkbg ? "dark-bg-breadcrumb" : "";?>

				<div id="header-wrapper" class="<?php echo esc_attr($header_class); ?>">

					<header id="header">
						<div class="container">
							<?php do_action( 'augury_header' ); ?>
					    </div>
					</header>

				    <?php
			        if( !empty( $global_breadcrumb ) ) {

			        	$bstyle = augury_get_option( 'breadcrumb-style', 'default' );
			        	$style = augury_breadcrumb_css();

			            $title = '<h1>'.get_the_archive_title().'</h1>';
			            $breadcrumbs = array();

			            if ( is_category() ) {
			                $breadcrumbs[] = '<a href="'. get_category_link( get_query_var('cat') ) .'">' . single_cat_title('', false) . '</a>';
			            } elseif ( is_tag() ) {
			                $breadcrumbs[] = '<a href="'. get_tag_link( get_query_var('tag_id') ) .'">' . single_tag_title('', false) . '</a>';
			            } elseif( is_author() ){
			                $breadcrumbs[] = '<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">' . get_the_author() . '</a>';
			            } elseif( is_day() || is_time() ){
			                $breadcrumbs[] = '<a href="'. get_year_link( get_the_time('Y') ) . '">'. get_the_time('Y') .'</a>';
			                $breadcrumbs[] = '<a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('F') .'</a>';
			                $breadcrumbs[] = '<a href="'. get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) .'">'. get_the_time('d') .'</a>';
			            } elseif( is_month() ){
			                $breadcrumbs[] = '<a href="'. get_year_link( get_the_time('Y') ) . '">' . get_the_time('Y') . '</a>';
			                $breadcrumbs[] = '<a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('F') .'</a>';
			            } elseif( is_year() ){
			                $breadcrumbs[] = '<a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') .'</a>';
			            }

			            augury_breadcrumb_output ( $title, $breadcrumbs, $bstyle .' '. $darkbg, $style );
			        }
				    ?>

				</div>

				<?php

			}


		}

		function dtportfolio_dt_after_main_content() {
			
		}

		function dtportfolio_dt_before_content() {

			if (is_singular( 'dt_portfolios' )) {

				echo '<div id="main">';
 
				    	global $post;

					    $settings = get_post_meta($post->ID,'_portfolio_settings',TRUE);
					    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

					    $portfolio_layout = array_key_exists('portfolio-layout', $settings) ? $settings['portfolio-layout'] : '';

					    if($portfolio_layout != 'fixed-gallery' && $portfolio_layout != 'fixed-feature-image' && $portfolio_layout != 'gallery-list') {

							echo '<div class="container">';

					        $page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";
					        $layout = augury_page_layout( $page_layout );
					        extract( $layout );

					        if ( $show_sidebar ) {
					            if ( $show_left_sidebar ) {
					                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';
					                ?>
					                <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
					                    augury_show_sidebar( 'dt_portfolios', $post->ID, 'left' ); ?>
					                </section>
					                <?php
					            }
					        }

				        } else {
				        	$page_layout = 'content-full-width';
				        }
				        ?>

				        <section id="primary" class="<?php echo esc_attr( $page_layout );?>">

				        <?php	


			}

			if(is_post_type_archive('dt_portfolios') || is_tax ( 'portfolio_entries' ) || is_tax ( 'portfolio_tags' ) ) {

				echo '<div id="main">';
				    echo '<div class="container">';

					$allow_fullwidth = augury_get_option('portfolio-allow-full-width');

					if($allow_fullwidth != 'true') {

				    	$page_layout  = augury_get_option( 'portfolio-archives-page-layout' );
				    	$page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";

				    	if($page_layout != 'fullwidth') {

					    	$layout = augury_page_layout( $page_layout );
					    	extract( $layout );

					    	if ( $show_sidebar ) {
					    		if ( $show_left_sidebar ) {
					    			?>
					    			<section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>">
					    				<?php

					    				$wtstyle = augury_get_option( 'widget-title-style' );

										if(!empty($wtstyle)):
											echo "<div class='{$wtstyle}'>";
										endif;

										if( is_active_sidebar('custom-post-portfolio-archives-sidebar-left') ):
											dynamic_sidebar('custom-post-portfolio-archives-sidebar-left');
										endif;
										
										$enable = augury_get_option( 'portfolio-archives-page-show-standard-sidebar' );
										if( !empty( $enable )):
											if( is_active_sidebar('standard-sidebar-left') ):
												dynamic_sidebar('standard-sidebar-left');
											endif;
										endif;

					    				?>
					    			</section>
					    			<?php
					    		}
					    	}
					    	?>

					        <section id="primary" class="<?php echo esc_attr( $page_layout );?>">
					        <?php

					    }

					}

			}

		}

		function dtportfolio_dt_after_content() {

			if (is_singular( 'dt_portfolios' )) {

					echo '</section>';

			    	global $post;

				    $settings = get_post_meta($post->ID,'_portfolio_settings',TRUE);
				    $settings = is_array( $settings ) ?  array_filter( $settings )  : array();

				    $portfolio_layout = array_key_exists('portfolio-layout', $settings) ? $settings['portfolio-layout'] : '';
				    if($portfolio_layout != 'fixed-gallery' && $portfolio_layout != 'fixed-feature-image' && $portfolio_layout != 'gallery-list') {

				        $page_layout  = array_key_exists( "layout", $settings ) ? $settings['layout'] : "content-full-width";
				        $layout = augury_page_layout( $page_layout );
				        extract( $layout );

				        if ( $show_sidebar ) {
				            if ( $show_right_sidebar ) {
				                $sticky_class = ( array_key_exists('enable-sticky-sidebar', $settings) && $settings['enable-sticky-sidebar'] == 'true' ) ? ' sidebar-as-sticky' : '';
				                ?>
				                <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class.$sticky_class );?>"><?php
				                    augury_show_sidebar( 'dt_portfolios', $post->ID, 'right' ); ?>
				                </section>
				                <?php
				            }
				        }

						echo '</div>';
						
				    }

				echo '</div>';

			}

			if(is_post_type_archive('dt_portfolios') || is_tax ( 'portfolio_entries' ) || is_tax ( 'portfolio_tags' ) ) {

					$allow_fullwidth = augury_get_option('portfolio-allow-full-width');

					if($allow_fullwidth != 'true') {

				    	$page_layout  = augury_get_option( 'portfolio-archives-page-layout' );
				    	$page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";

						if($page_layout != 'fullwidth') {

						    	$layout = augury_page_layout( $page_layout );
						    	extract( $layout );

						        echo '</section>';

						    	if ( $show_sidebar ) {
						    		if ( $show_right_sidebar ) {
						    			?>
						    			<section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>">
						    				<?php

						    				$wtstyle = augury_get_option( 'widget-title-style' );

											if(!empty($wtstyle)):
												echo "<div class='{$wtstyle}'>";
											endif;

											if( is_active_sidebar('custom-post-portfolio-archives-sidebar-right') ):
												dynamic_sidebar('custom-post-portfolio-archives-sidebar-right');
											endif;
											
											$enable = augury_get_option( 'portfolio-archives-page-show-standard-sidebar' );
											if( !empty( $enable )):
												if( is_active_sidebar('standard-sidebar-right') ):
													dynamic_sidebar('standard-sidebar-right');
												endif;
											endif;

						    				?>
						    			</section>
						    			<?php
						    		}
						    	}

						}

					}	    	

				    echo '</div>';
				echo '</div>';

		    }


		}

	}

	new DTPortfolioDesignThemes();

}

?>