<?php
// Add required files
require_once( AUGURY_DIR .'/framework/woocommerce/woocommerce-utils.php' ); // Utils
require_once( AUGURY_DIR .'/framework/woocommerce/cart-utils.php' ); // Cart Utils
require_once( AUGURY_DIR .'/framework/woocommerce/checkout-utils.php' ); // Checkout Utils
require_once( AUGURY_DIR .'/framework/woocommerce/content-product.php' ); // Content Product
require_once( AUGURY_DIR .'/framework/woocommerce/content-product_cat.php' ); // Content Product Category
require_once( AUGURY_DIR .'/framework/woocommerce/content-single-product.php' ); // Content Single Product

// After theme setup
if( ! function_exists( 'augury_woo_support' ) ) {

	function augury_woo_support() {

		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// To Remove Page Title
		add_filter( 'woocommerce_show_page_title', '__return_false' );

		// Disable WooCommerce Styles & Sidebar --------------------------------------
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

		// Defining Default Values
	    add_theme_support( 'woocommerce', array(

			'thumbnail_image_width'         => 1000,
			'gallery_thumbnail_image_width' => 100,
			'single_image_width'            => 1000,

		) );
	}

	add_action( 'after_setup_theme', 'augury_woo_support' );
}

//	Products Per Row - Need to override "Products per row" option in "Product Catalog" customizer settings
if( ! function_exists( 'augury_woo_loop_columns' ) ) {
	
	function augury_woo_loop_columns( $columns ) {

		return $columns;

	}

	add_filter( 'loop_shop_columns', 'augury_woo_loop_columns' );
}

//	Post Per Page 
if( ! function_exists( 'augury_woo_posts_per_page' ) ) {
	
	function augury_woo_posts_per_page( $count ) {

		if( is_shop() ) {
			$count = augury_get_option( 'shop-page-product-per-page', $count );
		} elseif( is_product_category() ) {
			$count = augury_get_option( 'dt-woo-category-archive-product-per-page' );
		} elseif( is_product_tag() ) {
			$count = augury_get_option( 'dt-woo-tag-archive-product-per-page' );
		}

		return $count;
	}

	add_filter( 'loop_shop_per_page', 'augury_woo_posts_per_page' );
}


/**
 * ------------------------------------------------------------------------------------------------
 * Main Content Wrapper
 * ------------------------------------------------------------------------------------------------
 */

// To Update Page Wrapper Start
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

if( ! function_exists( 'augury_woo_output_content_wrapper' ) ) {
	
	function augury_woo_output_content_wrapper() {

		$shop_page_id    = '';
		$settings        = array();
		$page_layout     = '';
		$container_class = '';
		$widgets         = array();

		if( is_shop() || is_product_category() || is_product_tag() ) {

			$options = augury_shop_archive_page();

			$widgets = $options['widgets'];
			$layout  = $options['page-layout'];

			$layout  = augury_page_layout( $layout );
			extract( $layout );	

		} elseif( is_product() ) {

			global $post;

			$options = augury_single_product( $post->ID, "left" );
			$widgets = $options['widgets'];
			$layout  = $options['page-layout'];

			$layout  = augury_page_layout( $layout );
			extract( $layout );	

		}

		$header_class = augury_get_option( 'breadcrumb-position' );

		echo '<!-- ** Header Wrapper ** -->';
		echo '<div id="header-wrapper" class="'.esc_attr($header_class).'">';

			echo '<!-- **Header** -->';
			echo '<header id="header">';

				echo '<div class="container">';
           			do_action( 'augury_header', $shop_page_id );
				echo '</div>';

			echo '</header>';
			echo '<!-- **Header - End ** -->';

			# Shop
				if( is_shop() ) {

					$shop_page_enable_breadcrumb = augury_get_option( 'shop-page-enable-breadcrumb' );
					$shop_page_enable_breadcrumb = (isset($shop_page_enable_breadcrumb) && !empty($shop_page_enable_breadcrumb)) ? true : false;

					if($shop_page_enable_breadcrumb) {

						if( get_option('woocommerce_shop_page_id') == '' ) {
							$breadcrumbs[] = '<span class="current">'.esc_html__('Shop', 'augury').'</span>';
							$bstyle        = augury_get_option( 'breadcrumb-style', 'default' );
							$style         = augury_breadcrumb_css();
	
							augury_breadcrumb_output ( '<h1>'.esc_html__('Shop', 'augury').'</h1>', $breadcrumbs, $bstyle, $style );
						} else {
							$breadcrumbs[] = '<span class="current">'.get_the_title( get_option('woocommerce_shop_page_id') ).'</span>';
							$bstyle        = augury_get_option( 'breadcrumb-style', 'default' );
							$style         = augury_breadcrumb_css();
	
							augury_breadcrumb_output ( '<h1>'.get_the_title( get_option('woocommerce_shop_page_id') ).'</h1>', $breadcrumbs, $bstyle, $style );
						}
					}
				}

			# Product
				if( is_product() ) {

					$dt_single_product_enable_breadcrumb = augury_get_option( 'dt-single-product-enable-breadcrumb' );
					$dt_single_product_enable_breadcrumb = (isset($dt_single_product_enable_breadcrumb) && !empty($dt_single_product_enable_breadcrumb)) ? true : false;

					if($dt_single_product_enable_breadcrumb) {

						global $post;

						$terms = wc_get_product_terms(
							$post->ID,
							'product_cat',
							apply_filters(
								'woocommerce_breadcrumb_product_terms_args',
								array(
									'orderby' => 'parent',
									'order'   => 'DESC',
								)
							)
						);

						$breadcrumbs[] = isset($terms[0]) ? '<a href="'.get_term_link( $terms[0] ).'">'.$terms[0]->name.'</a>': '';
						$breadcrumbs[] = the_title( '<span class="current">', '</span>', false );
						$bstyle        = augury_get_option( 'breadcrumb-style', 'default' );
						$style         = augury_breadcrumb_css();

						augury_breadcrumb_output ( '<h1>'.esc_html__('Shop', 'augury').'</h1>', $breadcrumbs, $bstyle, $style );
					}
				}

			# Product Category
				if( is_product_category() ) {

					$dt_woo_category_archive_enable_breadcrumb = augury_get_option( 'dt-woo-category-archive-enable-breadcrumb' );
					$dt_woo_category_archive_enable_breadcrumb = (isset($dt_woo_category_archive_enable_breadcrumb) && !empty($dt_woo_category_archive_enable_breadcrumb)) ? true : false;

					if($dt_woo_category_archive_enable_breadcrumb) {
						
						$breadcrumbs[] = '<a href="'.get_the_permalink( get_option('woocommerce_shop_page_id') ).'">' . get_the_title( get_option('woocommerce_shop_page_id') ). '</a>';
						$breadcrumbs[] = '<span class="current">'.single_term_title( '', false ).'</span>';
						$bstyle        = augury_get_option( 'breadcrumb-style', 'default' );
						$style         = augury_breadcrumb_css();

						augury_breadcrumb_output ( '<h1>'.single_term_title( '', false ).'</h1>', $breadcrumbs, $bstyle, $style );

					}

				}

			# Product Tag
				if( is_product_tag() ) {

					$dt_woo_tag_archive_enable_breadcrumb = augury_get_option( 'dt-woo-tag-archive-enable-breadcrumb' );
					$dt_woo_tag_archive_enable_breadcrumb = (isset($dt_woo_tag_archive_enable_breadcrumb) && !empty($dt_woo_tag_archive_enable_breadcrumb)) ? true : false;

					if($dt_woo_tag_archive_enable_breadcrumb) {

						$breadcrumbs[] = '<a href="'.get_the_permalink( get_option('woocommerce_shop_page_id') ).'">' . get_the_title( get_option('woocommerce_shop_page_id') ). '</a>';
						$breadcrumbs[] = '<span class="current">'.single_term_title( '', false ).'</span>';
						$bstyle        = augury_get_option( 'breadcrumb-style', 'default' );
						$style         = augury_breadcrumb_css();

						augury_breadcrumb_output ( '<h1>'.single_term_title( '', false ).'</h1>', $breadcrumbs, $bstyle, $style );

					}

				}


		echo '</div>';
		echo '<!-- ** Header Wrapper - End ** -->';

		echo '<!-- **Main** -->';
		echo '<div id="main">';

			echo '<!-- **Main - Container** -->';
			echo '<div class="container">';



				echo '<!-- Primary -->';
				echo '<section id="primary" class="'.esc_attr( $page_layout ).'">';

	}

	add_action( 'woocommerce_before_main_content', 'augury_woo_output_content_wrapper', 11 );

}

// To Update Page wrapper End
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if( ! function_exists( 'augury_woo_output_content_wrapper_end' ) ) {

	function augury_woo_output_content_wrapper_end() {

		$shop_page_id       = '';
		$settings           = array();
		$sidebar_class      = '';
		$show_sidebar       = '';
		$show_left_sidebar  = '';
		$show_right_sidebar = '';
		$widgets            = array();

				if( is_shop() ) {

					$shop_page_bottom_hook = augury_get_option( 'shop-page-bottom-hook' );
					$shop_page_bottom_hook = (isset($shop_page_bottom_hook) && !empty($shop_page_bottom_hook)) ? $shop_page_bottom_hook : false;
					
					if($shop_page_bottom_hook) {
						echo do_shortcode($shop_page_bottom_hook);
					}

				}

				echo '</section>';
				echo '<!-- ** Primary - End ** -->';


				if( is_shop() || is_product_category() || is_product_tag() ) {

					$options = augury_shop_archive_page();

					$widgets = $options['widgets'];
					$layout  = $options['page-layout'];

					$layout  = augury_page_layout( $layout );
					extract( $layout );	

				} elseif( is_product() ) {

					global $post;

					$options = augury_single_product( $post->ID, "right" );
					
					$widgets = $options['widgets'];
					$layout  = $options['page-layout'];

					$layout  = augury_page_layout( $layout );
					extract( $layout );

				}

				# Left Sidebar
					if ( $show_sidebar ) {
						if ( $show_left_sidebar ) {
							
							$active_widgets = array();
							
							foreach( $widgets as $widget ) {
								if( is_active_sidebar( $widget ) ) {
									array_push( $active_widgets, $widget );
								}
							}
							echo '<section id="secondary-left" class="secondary-sidebar '.esc_attr( $sidebar_class ).'">';
								if( $active_widgets ){
									$wtstyle = augury_get_option( 'widget-title-style' );	
									echo !empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';
									foreach( $widgets as $widget ) {
										dynamic_sidebar($widget);
									}
									echo !empty( $wtstyle ) ? '</div>' : '';
								}
							echo '</section>';
						}
					}
				# Left Sidebar				

				# Right Sidebar
					if ( $show_sidebar ) {
						if ( $show_right_sidebar ) {
							
							$active_widgets = array();
							
							foreach( $widgets as $widget ) {
								if( is_active_sidebar( $widget ) ) {
									array_push( $active_widgets, $widget );
								}
							}
							echo '<section id="secondary-right" class="secondary-sidebar '.esc_attr( $sidebar_class ).'">';
								if( $active_widgets ){
									$wtstyle = augury_get_option( 'widget-title-style' );	
									echo !empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';
									foreach( $widgets as $widget ) {
										dynamic_sidebar($widget);
									}
									echo !empty( $wtstyle ) ? '</div>' : '';
								}
							echo '</section>';
						}
					}				
				# Right Sidebar

			echo '</div>';
			echo '<!-- ** Main - Container - End ** -->';

		echo '</div>';
		echo '<!-- ** Main - End ** -->';

	}

	add_action( 'woocommerce_after_main_content', 'augury_woo_output_content_wrapper_end', 11 );

}