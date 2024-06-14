<?php
if( !class_exists('DTCoreShortcodes') ){

	class DTCoreShortcodes {
		
		function __construct() {
	
			add_action("init", array(
				$this,
				'dt_init'
			));

			add_shortcode("dt_sc_post_view_count", array(
				$this,
				'dt_sc_post_view_count'
			) );
	
			add_shortcode("dt_sc_post_like_count", array(
				$this,
				'dt_sc_post_like_count'
			) );
	
			add_shortcode("dt_sc_post_social_share", array(
				$this,
				'dt_sc_post_social_share'
			) );
	
			add_action( 'wp_ajax_dt_wp_post_rating_like', array(
				$this,
				'dt_wp_post_rating_like'
			) );
	
			add_action( 'wp_ajax_nopriv_dt_wp_post_rating_like', array(
				$this,
				'dt_wp_post_rating_like'
			) );
		}
	
		/**
		 * view count
		 * @return string
		 */
		function dt_sc_post_view_count($attrs, $content = null) {
			extract ( shortcode_atts ( array (
				'post_id' => ''
			), $attrs ) );
	
			$post_meta = get_post_meta ( $post_id, '_dt_post_settings', TRUE );
			$post_meta = is_array ( $post_meta ) ? $post_meta : array ();
	
			$v = array_key_exists("view_count", $post_meta) && !empty( $post_meta['view_count'] ) ?  $post_meta['view_count'] : 0;
			$v = $v + 1;
			$post_meta['view_count'] = $v;
	
			update_post_meta( $post_id, '_dt_post_settings', $post_meta );
	
			return $v;
		}
	
		/**
		 * like count
		 * @return string
		 */
		function dt_sc_post_like_count($attrs, $content = null) {
			extract ( shortcode_atts ( array (
				'post_id' => ''
			), $attrs ) );
	
			$post_meta = get_post_meta ( $post_id, '_dt_post_settings', TRUE );
			$post_meta = is_array ( $post_meta ) ? $post_meta : array ();
	
			$v = array_key_exists("like_count",$post_meta) && !empty( $post_meta['like_count'] ) ?  $post_meta['like_count'] : '0';
	
			return $v;
		}
	
		/**
		 * post social share
		 * @return string
		 */
		function dt_sc_post_social_share($attrs, $content = null) {
			extract ( shortcode_atts ( array (
				'post_id' => ''
			), $attrs ) );
	
			$out = '<div class="share">';
				$out .= '<span>'.esc_html__('Share', 'dt-elementor').'</span>';
				$link = get_permalink( $post_id );
				$link = rawurlencode( $link );
	  
				$title = get_the_title( $post_id );
				$title = urlencode($title);
	
				$out .= '<ul class="dt-share-list">';
					$out .= '<li><a href="https://www.facebook.com/sharer.php?u='.$link.'&amp;t='.$title.'" class="fab fa-facebook-f" target="_blank"></a></li>';
					$out .= '<li><a href="https://twitter.com/share?text='.$title.'&amp;url='.$link.'" class="fab fa-twitter" target="_blank"></a></li>';
					$out .= '<li><a href="https://plus.google.com/share?url='.$link.'" class="fab fa-google-plus-g" target="_blank"></a></li>';
					$out .= '<li><a href="https://pinterest.com/pin/create/button/?url='.$link.'&media='.get_the_post_thumbnail_url($post_id, 'full').'" class="fab fa-pinterest" target="_blank"></a></li>';
				$out .= '</ul>';
			$out .= '</div>';
	
			return $out;
		}
	
		function dt_wp_post_rating_like() {
	
			$out = '';
			$postid = $_REQUEST['post_id'];
			$nonce = $_REQUEST['nonce'];
			$action = $_REQUEST['doaction'];
			$arr_pids = array();
	
			if ( wp_verify_nonce( $nonce, 'rating-nonce' ) && $postid > 0 ) {
	
				$post_meta = get_post_meta ( $postid, '_dt_post_settings', TRUE );
				$post_meta = is_array ( $post_meta ) ? $post_meta : array ();
				$var_count = ($action == 'like') ? 'like_count' : 'unlike_count';
	
				if( isset( $_COOKIE['arr_pids'] ) ) {
	
					// article voted already...
					if( in_array( $postid, explode(',', $_COOKIE['arr_pids']) ) ) {
	
						$out = esc_html__('Already', 'dt-elementor');
	
					} else {
						// article first vote...
						$v = array_key_exists($var_count, $post_meta) ?  $post_meta[$var_count] : 0;
						$v = $v + 1;
						$post_meta[$var_count] = $v;
						update_post_meta( $postid, '_dt_post_settings', $post_meta );
	
						$out = $v;
	
						$arr_pids = explode(',', $_COOKIE['arr_pids']);
						array_push( $arr_pids, $postid);
						setcookie( "arr_pids", implode(',', $arr_pids ), time()+1314000, "/" );
					}
				} else {
	
					// site first vote...
					$v = array_key_exists($var_count, $post_meta) ?  $post_meta[$var_count] : 0;
					$v = $v + 1;
					$post_meta[$var_count] = $v;
					update_post_meta( $postid, '_dt_post_settings', $post_meta );
	
					$out = $v;
	
					array_push( $arr_pids, $postid);
					setcookie( "arr_pids", implode(',', $arr_pids ), time()+1314000, "/" );
				}
			} else {
				$out = esc_html__('Security check', 'dt-elementor');
			}
	
			echo do_shortcode($out);
	
			die();
		}

		function dt_init() {
			/* ---------------------------------------------------------------------------
			 *	Under Construction
			 * --------------------------------------------------------------------------- */
			if( ! function_exists('augury_under_construction') ){
				function augury_under_construction(){
					if( ! is_user_logged_in() && ! is_admin() && ! is_404() ) {
						$obj = new DTElementorCore;
						require_once $obj->plugin_path( 'templates/tpl-comingsoon.php' );
						exit();
					}
				}
			}

			if( augury_get_option( 'enable-comingsoon' ) ):
				add_action('template_redirect', 'augury_under_construction', 30);
			endif;
		}		
	}
	new DTCoreShortcodes();
}

// Post Social Share
if(!function_exists('dt_blog_single_social_share')) {
	function dt_blog_single_social_share($post_ID) {

		$output = '<div class="share">';

			$title = get_the_title( $post_ID );
			$title = urlencode($title);

			$link = get_permalink( $post_ID );
			$link = rawurlencode( $link );

			$output .= '<i class="fas fa-share-alt-square">'.esc_html__('Share', 'dt-elementor').'</i>';
			$output .= '<ul class="dt-share-list">';
				$output .= '<li><a href="http://www.facebook.com/sharer.php?u='.esc_attr($link).'&amp;t='.esc_attr($title).'" class="fab fa-facebook-f" target="_blank"></a></li>';
				$output .= '<li><a href="http://twitter.com/share?text='.esc_attr($title).'&amp;url='.esc_attr($link).'" class="fab fa-twitter" target="_blank"></a></li>';
				$output .= '<li><a href="http://plus.google.com/share?url='.esc_attr($link).'" class="fab fa-google-plus-g" target="_blank"></a></li>';
				$output .= '<li><a href="http://pinterest.com/pin/create/button/?url='.esc_attr($link).'&media='.get_the_post_thumbnail_url($post_ID, 'full').'" class="fab fa-pinterest" target="_blank"></a></li>';
			$output .= '</ul>';

		$output .= '</div>';

		return $output;
	}
}

if(!function_exists('productsWidgetHtml')) {
	function productsWidgetHtml($settings) {

		$output = '';

		$woo_product_style_template = $settings['product_style_template'];

		if($settings['display_mode'] == 'list') {
			$settings['columns'] = 1;
			$settings['carousel_slidesperview'] = 1;
		}


		$media_carousel_attributes_string = $container_class = $wrapper_class = $item_class = '';

		if($settings['enable_carousel'] == 'true') {

			$media_carousel_attributes = array ();

			array_push($media_carousel_attributes, 'data-carouseleffect="'.$settings['carousel_effect'].'"');
			array_push($media_carousel_attributes, 'data-carouselslidesperview="'.$settings['carousel_slidesperview'].'"');
			array_push($media_carousel_attributes, 'data-carouselloopmode="'.$settings['carousel_loopmode'].'"');
			array_push($media_carousel_attributes, 'data-carouselmousewheelcontrol="'.$settings['carousel_mousewheelcontrol'].'"');
			array_push($media_carousel_attributes, 'data-carouselbulletpagination="'.$settings['carousel_bulletpagination'].'"');
			array_push($media_carousel_attributes, 'data-carouselarrowpagination="'.$settings['carousel_arrowpagination'].'"');
			array_push($media_carousel_attributes, 'data-carouselscrollbar="'.$settings['carousel_scrollbar'].'"');
			array_push($media_carousel_attributes, 'data-carouselspacebetween="'.$settings['carousel_spacebetween'].'"');

			if(!empty($media_carousel_attributes)) {
				$media_carousel_attributes_string = implode(' ', $media_carousel_attributes);
			}

			
			$container_class = 'swiper-container';
			$wrapper_class = 'swiper-wrapper';
			$item_class = 'swiper-slide';

			$output .= '<div class="dt-sc-products-carousel-container">';

		}

		// Loop variables setup
		wc_set_loop_prop('is_shortcode', 1);
		wc_set_loop_prop('product_style_template', $settings['product_style_template']);
		wc_set_loop_prop('item_class', $item_class);
		wc_set_loop_prop('columns', $settings['columns']);
		wc_set_loop_prop('display_mode', $settings['display_mode']);
		wc_set_loop_prop('display_mode_list_options', $settings['list_options']);

		augury_product_style_setup_template_prop($woo_product_style_template); // Call Product Style Variables Setup

		$output .= '<div class="dt-sc-products-container woocommerce '.$settings['class'].' '.$container_class.'" '.$media_carousel_attributes_string.'>';

			$output .= '<ul class="products '.$wrapper_class.' '.dt_sc_woo_shop_products_class().'">';		

				ob_start();

					if( empty( $settings['post_per_page'] ) ) {
						$settings['post_per_page'] = -1;
					}

					$args = array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'posts_per_page' => $settings['post_per_page'],
						'meta_query'     => array (), 
						'tax_query'      => array (),	
						'offset'         => $settings['offset'], 
						'paged'          => $settings['current_page'],							    	
					);


					// Exclude hidden products
					$args['tax_query'][] = array(
						'taxonomy'         => 'product_visibility',
						'terms'            => array( 'exclude-from-catalog', 'exclude-from-search' ),
						'field'            => 'name',
						'operator'         => 'NOT IN',
						'include_children' => false,
					);


					// Categories
					$categories = ($settings['categories'] != '') ? explode(', ', $settings['categories']) : array ();
					if(!empty($categories)) {
						$args['tax_query'][] = array ( 
													'taxonomy' => 'product_cat',
													'field'    => 'id',
													'terms'    => $categories,
													'operator' => 'IN'
												);
					}

					// Tags
					$tags = ($settings['tags'] != '') ? explode(', ', $settings['tags']) : array ();
					if(!empty($tags)) {
						$args['tax_query'][] = array ( 
													'taxonomy' => 'product_tag',
													'field'    => 'id',
													'terms'    => $tags,
													'operator' => 'IN'
												);
					}

					// Include
					$include = ($settings['include'] != '') ? explode(', ', $settings['include']) : array ();
					if(!empty($include)) {
						$args['post__in'] = $include;
					}

					// Exclude
					$exclude = ($settings['exclude'] != '') ? explode(', ', $settings['exclude']) : array ();
					if(!empty($exclude)) {
						$args['post__not_in'] = $exclude;
					}

					// Data Source

					# Featured
					if ( $settings['data_source'] == 'featured' ) {
						$args['tax_query'][] = array (
													'taxonomy' => 'product_visibility',
													'field'    => 'name',
													'terms'    => 'featured',
													'operator' => 'IN',
												);
					}

					# Sale
					if ( $settings['data_source'] == 'sale' ) {
						if(!empty($include)) {
							$args['post__in'] = array_merge( $include, wc_get_product_ids_on_sale() );
						} else {
							$args['post__in'] = wc_get_product_ids_on_sale();
						}					
					}

					# Best Seller
					if ( $settings['data_source'] == 'bestseller' ) {
						$args['orderby'] = 'meta_value_num';
						$args['meta_key'] = 'total_sales';
					}

					// Loop

					$products = new WP_Query( $args );

					if ( $products->have_posts() ) :
						while ( $products->have_posts() ) :
							$products->the_post();
							wc_get_template_part( 'content', 'product' );
						endwhile;
					endif;				

					wp_reset_postdata();

				$output .= ob_get_clean();

			$output .= '</ul>';

			$max_num_pages = $products->max_num_pages;

			// For pagination
			if($settings['show_pagination'] == 'true') {
				$shortcode_settings = json_encode($settings);
				$output .= augury_products_ajax_pagination($max_num_pages, $settings['current_page'], $settings['post_per_page'], 'augury_products_ajax_call', 'dt-sc-products-container', $shortcode_settings);
			}

			if($settings['enable_carousel'] == 'true') {

				$output .= '<div class="dt-sc-products-pagination-holder">';

					if($settings['carousel_bulletpagination'] == 'true') {
						$output .= '<div class="dt-sc-products-bullet-pagination"></div>';	
					}

					if($settings['carousel_scrollbar'] == 'true') {
						$output .= '<div class="dt-sc-products-scrollbar"></div>';	
					}											

					if($settings['carousel_arrowpagination'] == 'true') {
						$output .= '<div class="dt-sc-products-arrow-pagination '.$settings['carousel_arrowpagination_type'].'">';
							$output .= '<a href="#" class="dt-sc-products-arrow-prev">'.esc_html__('Prev', 'dt-elementor').'</a>';
							$output .= '<a href="#" class="dt-sc-products-arrow-next">'.esc_html__('Next', 'dt-elementor').'</a>';
						$output .= '</div>';
					}

				$output .= '</div>';

			}

		$output .= '</div>';

		// Reset the loop.
		wc_reset_loop();

		if($settings['enable_carousel'] == 'true') {
			$output .= '</div>';
		}

		return $output;

	}
}