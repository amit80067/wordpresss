<?php
// Filter HTML Output

if ( ! function_exists( 'augury_html_output' ) ) {

	function augury_html_output( $html ) {

		return apply_filters( 'augury_html_output', $html );

	}

}

// Filter to modify default pagination
if( !function_exists('augury_woocommerce_pagination_args') ){

	function augury_woocommerce_pagination_args( $output ){

		$output = array(
			'prev_text' => '<i class="fas fa-angle-double-left"></i>',
			'next_text' => '<i class="fas fa-angle-double-right"></i>',
			'type'      => 'list',
		);

		return $output;
	}

	add_filter('woocommerce_pagination_args', 'augury_woocommerce_pagination_args');
}

// Shop Layout & Widgets

if( ! function_exists( 'augury_shop_archive_page' ) ) {

	function augury_shop_archive_page() {

		$widgets = $shop_archive_page_widgetareas = array ();
		$shop_archive_page_layout = '';

		if( is_shop() ) {

			$shop_archive_page_layout = augury_get_option( 'shop-page-layout' );
			$shop_archive_page_layout = isset($shop_archive_page_layout) ? $shop_archive_page_layout : '';

			$show_archive_standard_sidebar = augury_get_option( 'shop-page-show-standard-sidebar' );

			$shop_archive_page_widgetareas = augury_get_option( 'shop-page-widgetareas' );
			$shop_archive_page_widgetareas = isset( $shop_archive_page_widgetareas ) ? array ($shop_archive_page_widgetareas) : array ();

		} elseif( is_product_category() ) {

			$shop_archive_page_layout = augury_get_option( 'dt-woo-category-archive-layout' );
			$shop_archive_page_layout = isset($shop_archive_page_layout) ? $shop_archive_page_layout : '';

			$show_archive_standard_sidebar = augury_get_option( 'dt-woo-category-archive-show-standard-sidebar' );

			$shop_archive_page_widgetareas = augury_get_option( 'dt-woo-category-archive-widgetareas' );
			$shop_archive_page_widgetareas = isset( $shop_archive_page_widgetareas ) ? array ($shop_archive_page_widgetareas) : array ();

		} elseif( is_product_tag() ) {

			$shop_archive_page_layout = augury_get_option( 'dt-woo-tag-archive-layout' );
			$shop_archive_page_layout = isset($shop_archive_page_layout) ? $shop_archive_page_layout : '';

			$show_archive_standard_sidebar = augury_get_option( 'dt-woo-tag-archive-show-standard-sidebar' );

			$shop_archive_page_widgetareas = augury_get_option( 'dt-woo-tag-archive-widgetareas' );
			$shop_archive_page_widgetareas = isset( $shop_archive_page_widgetareas ) ? array ($shop_archive_page_widgetareas) : array ();

		}

		if( isset( $show_archive_standard_sidebar ) && !empty( $show_archive_standard_sidebar ) ) {

			if( $shop_archive_page_layout == 'with-left-sidebar' ) {
				$widgets[] = 'standard-sidebar-left';
			} else if( $shop_archive_page_layout == 'with-right-sidebar' ) {
				$widgets[] = 'standard-sidebar-right';
			}

		}		

		if( is_array( $shop_archive_page_widgetareas ) ) {
			$widgets = array_merge( $widgets, $shop_archive_page_widgetareas );
		}

		return array( 
			'page-layout' => $shop_archive_page_layout,
			'widgets'     => $widgets 
		);

	}

}


// Single Product Layout & Widgets

if( ! function_exists( 'augury_single_product' ) ) {

	function augury_single_product( $id , $position ) {

		$widgets  = array();
		$settings = get_post_meta( $id, '_custom_settings', true );

		if( is_array( $settings ) ) {
			$settings = array_filter( $settings );
		} else {
			$settings = array( 
				'page-layout'  => 'admin-option',
				'show-upsell'  => 'admin-option',
				'show-related' => 'admin-option'
				);
		}

		$prodcut_page_layout = $settings['page-layout'];

		if( $prodcut_page_layout == 'admin-option' ) {

			$prodcut_page_layout = augury_get_option( 'site-global-sidebar-layout' );
			$standard_sidebar = true;

			if( $standard_sidebar ) {
				$widgets[] = ( $position == "left" ) ? 'standard-sidebar-left' : 'standard-sidebar-right';
			}

		} elseif( $prodcut_page_layout == 'with-left-sidebar' || $prodcut_page_layout == 'with-right-sidebar' ) {

			if( isset( $settings['show-standard-sidebar'] ) && $settings['show-standard-sidebar'] ) {
				$widgets[] = ( $position == "left" ) ? 'standard-sidebar-left' : 'standard-sidebar-right';
			}

 			$custom_widgets = isset( $settings['product-widgetareas'] ) ? $settings['product-widgetareas'] : array();
			$custom_widgets = isset( $custom_widgets ) ? $custom_widgets : array ();

			if( is_array( $custom_widgets ) ) {
				$widgets = array_merge( $widgets, $custom_widgets );
			}

		}

		return array( 
			'page-layout' => $prodcut_page_layout,
			'widgets'     => $widgets 
		);
	}

}


// Single Product Settings

if( ! function_exists( 'augury_single_product_settings' ) ) {

	function augury_single_product_settings ( $id ) {

		$settings = get_post_meta( $id, '_custom_settings', true );

		if( is_array( $settings ) ) {
			$settings = array_filter( $settings );
		} else {
			$settings = array( 
				'page-layout'    => 'admin-option',
				'show-upsell'    => 'admin-option',
				'upsell-column'  => 'admin-option',
				'upsell-limit'  => 'admin-option',
				'show-related'   => 'admin-option',
				'related-column' => 'admin-option',
				'related-limit' => 'admin-option'
			);
		}

		if( isset( $settings['show-upsell'] ) && $settings['show-upsell'] == 'admin-option' ) {
			$settings['show-upsell']   = augury_get_option( 'dt-single-product-default-show-upsell' );
			$settings['upsell-column'] = augury_get_option( 'dt-single-product-upsell-column' );
			$settings['upsell-limit']  = augury_get_option( 'dt-single-product-upsell-limit' );
		}

		if( $settings['upsell-column'] == 'admin-option' ) {
			$settings['upsell-column'] = augury_get_option( 'dt-single-product-upsell-column' );
		}			

		if( $settings['upsell-limit'] == 'admin-option' ) {
			$settings['upsell-limit'] = augury_get_option( 'dt-single-product-upsell-limit' );
		}

		if( isset( $settings['show-related'] ) && $settings['show-related'] == 'admin-option' ) {
			$settings['show-related']   = augury_get_option( 'dt-single-product-default-show-related' );
			$settings['related-column'] = augury_get_option( 'dt-single-product-related-column' );
			$settings['related-limit']  = augury_get_option( 'dt-single-product-related-limit' );
		}

		if( $settings['related-column'] == 'admin-option' ) {
			$settings['related-column'] = augury_get_option( 'dt-single-product-related-column' );
		}

		if( $settings['related-limit'] == 'admin-option' ) {
			$settings['related-limit'] = augury_get_option( 'dt-single-product-related-limit' );
		}
		
		return $settings;	
	}

}


// Remove Anonymous action

if( ! function_exists( 'augury_woo_remove_anonymous_object_action' ) ) {

	function augury_woo_remove_anonymous_object_action( $tag, $class, $method, $priority = null ){

		if( empty($GLOBALS['wp_filter'][ $tag ]) ){
			return;
		}

		foreach ( $GLOBALS['wp_filter'][ $tag ] as $filterPriority => $filter ){
			if( !($priority===null || $priority==$filterPriority) )
				continue;

			foreach ( $filter as $identifier => $function ){
				if( is_array( $function)
					and is_a( $function['function'][0], $class )
					and $method === $function['function'][1]
				){
					remove_action(
						$tag,
						array ( $function['function'][0], $method ),
						$filterPriority
					);
				}
			}
		}
	}

}


// Product Loop Column Class

if( ! function_exists( 'augury_woo_loop_column_class' ) ) {

	function augury_woo_loop_column_class($columns) {

		$columns = intval( $columns );

		$options = augury_shop_archive_page();

		if($options['page-layout'] == 'with-left-sidebar' || $options['page-layout'] == 'with-right-sidebar') {

			switch( $columns ) {
				case 1:
					$class = 'dt-col dt-col-xs-12 dt-col-sm-12 dt-col-md-12 dt-col-lg-12';
				break;

				case 2:
					$class = 'dt-col dt-col-xs-12 dt-col-sm-12 dt-col-md-6 dt-col-qxlg-6 dt-col-qxlg-6 dt-col-lg-6';
				break;

				case 3:
					$class = 'dt-col dt-col-xs-12 dt-col-sm-12 dt-col-md-6 dt-col-qxlg-4 dt-col-hxlg-4 dt-col-lg-4';
				break;

				case 4:
				default:
					$class = 'dt-col dt-col-xs-12 dt-col-sm-12 dt-col-md-6 dt-col-qxlg-4 dt-col-hxlg-4 dt-col-lg-4';
				break;						
			}

		} else {

			switch( $columns ) {
				case 1:
					$class = 'dt-col dt-col-xs-12 dt-col-sm-12 dt-col-md-12 dt-col-lg-12';
				break;

				case 2:
					$class = 'dt-col dt-col-xs-12 dt-col-sm-6 dt-col-md-6 dt-col-qxlg-6 dt-col-hxlg-6 dt-col-lg-6';
				break;

				case 3:
					$class = 'dt-col dt-col-xs-12 dt-col-sm-6 dt-col-md-6 dt-col-qxlg-4 dt-col-hxlg-4 dt-col-lg-4';
				break;

				case 4:
				default:
					$class = 'dt-col dt-col-xs-12 dt-col-sm-6 dt-col-md-6 dt-col-qxlg-4 dt-col-hxlg-3 dt-col-lg-3';
				break;						
			}

		}

		return $class;

	}

}


// Check item is in cart

if(!function_exists('augury_check_item_is_in_cart')) {
	function augury_check_item_is_in_cart( $product_id ){

		if ( $product_id > 0 ) {

			foreach( WC()->cart->get_cart() as $cart_item_key => $values ) {
				$cart_product = $values['data'];
				if( $product_id == $cart_product->get_id() ) {
					return true;
				}
			}
			
		}

		return false;

	}
}


// Single page product navigation

if( ! function_exists( 'augury_single_product_nav' ) ) {
	function augury_single_product_nav() {

	    $next = get_next_post();
	    $prev = get_previous_post();

		$next_id = ( ! empty( $next ) ) ? $next->ID : '';
		$prev_id = ( ! empty( $prev ) ) ? $prev->ID : '';

	    $next = ( ! empty( $next ) ) ? wc_get_product( $next->ID ) : false;
		$prev = ( ! empty( $prev ) ) ? wc_get_product( $prev->ID ) : false;

		if ( ! empty( $next ) ) {
			$next_thumbnail_id = get_post_thumbnail_id($next_id);
			$next_image_src    = wp_get_attachment_image_src($next_thumbnail_id, 'woocommerce_thumbnail', false);
			$next_image_src    = isset($next_image_src[0]) ? $next_image_src[0] : wc_placeholder_img_src( 'woocommerce_thumbnail' );
		}

		if ( ! empty( $prev ) ) {
			$prev_thumbnail_id = get_post_thumbnail_id($prev_id);
			$prev_image_src    = wp_get_attachment_image_src($prev_thumbnail_id, 'woocommerce_thumbnail', false);
			$prev_image_src    = isset($prev_image_src[0]) ? $prev_image_src[0] : wc_placeholder_img_src( 'woocommerce_thumbnail' );
		}
		
	    $output = '';

		$output .= '<div class="dt-sc-single-product-nav">';

			if ( ! empty( $prev ) ) {

				$output .= '<div class="dt-sc-single-product-nav-btn product-nav-prev">';
					$output .= '<a href="'.esc_url( $prev->get_permalink() ).'">'.esc_html__('Previous product', 'augury').'<span class="product-nav-btn-icon"></span></a>';
					$output .= '<div class="dt-sc-single-product-nav-intro-wrapper">';
						$output .= '<div class="product-nav-intro">';
							$output .= '<div class="product-nav-intro-image">';
								$output .= '<a href="'.esc_url( $prev->get_permalink() ).'" class="product-thumb">';
									$output .= '<span class="prev-image" style="background-image:url('.esc_url($prev_image_src).')"></span>';
								$output .= '</a>';
							$output .= '</div>';
							$output .= '<div class="product-nav-intro-description">';
								$output .= '<a href="'.esc_url( $prev->get_permalink() ).'" class="product-title">';
									$output .= esc_html( $prev->get_title() );
								$output .= '</a>';
								$output .= '<span class="price">';
									$output .= $prev->get_price_html();
								$output .= '</span>';
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';

			}

			$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
			$output .= '<a href="'.esc_url($shop_page_url).'" class="dt-sc-single-product-nav-back-btn"><span>'.esc_html__('Back to products', 'augury').'</span></a>';

			if ( ! empty( $next ) ) {

				$output .= '<div class="dt-sc-single-product-nav-btn product-nav-next">';
					$output .= '<a href="'.esc_url( $next->get_permalink() ).'">'.esc_html__('Next product', 'augury').'<span class="product-nav-btn-icon"></span></a>';
					$output .= '<div class="dt-sc-single-product-nav-intro-wrapper">';
						$output .= '<div class="product-nav-intro">';
							$output .= '<div class="product-nav-intro-image">';
								$output .= '<a href="'.esc_url( $next->get_permalink() ).'" class="product-thumb">';
									$output .= '<span class="next-image" style="background-image:url('.esc_url($next_image_src).')"></span>';
								$output .= '</a>';
							$output .= '</div>';
							$output .= '<div class="product-nav-intro-description">';
								$output .= '<a href="'.esc_url( $next->get_permalink() ).'" class="product-title">';
									$output .= esc_html( $next->get_title() );
								$output .= '</a>';
								$output .= '<span class="price">';
									$output .= $next->get_price_html();
								$output .= '</span>';
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';

			}


		$output .= '</div>';

		return $output;

	}
}


// Single page product sociable share / follow

if( ! function_exists( 'augury_single_product_sociable_share_follow' ) ) {
	function augury_single_product_sociable_share_follow($product_id, $share_follow_type, $social_icon_style_cls, $social_icon_radius_cls, $social_icon_inline_alignment_cls) {

		$sstitle = get_the_title($product_id);
		$ssurl = get_permalink($product_id);

	    $output = '';

	    if($share_follow_type == 'share') {

			$output .= '<div class="dt-sc-single-product-share-container '.esc_attr($social_icon_style_cls).' '.esc_attr($social_icon_radius_cls).' '.esc_attr($social_icon_inline_alignment_cls).'">';

				$output .= '<a class="dt-sc-single-product-share-item-icon">'.esc_html__('Share', 'augury').'</a>';

				$output .= '<ul class="dt-sc-single-product-share-list">';

					$show_sharer_facebook    = augury_get_option( 'dt-single-product-show-sharer-facebook' );
					$show_sharer_delicious   = augury_get_option( 'dt-single-product-show-sharer-delicious' );
					$show_sharer_digg        = augury_get_option( 'dt-single-product-show-sharer-digg' );
					$show_sharer_stumbleupon = augury_get_option( 'dt-single-product-show-sharer-stumbleupon' );
					$show_sharer_twitter     = augury_get_option( 'dt-single-product-show-sharer-twitter' );
					$show_sharer_googleplus  = augury_get_option( 'dt-single-product-show-sharer-googleplus' );
					$show_sharer_linkedin    = augury_get_option( 'dt-single-product-show-sharer-linkedin' );
					$show_sharer_pinterest   = augury_get_option( 'dt-single-product-show-sharer-pinterest' );

					if($show_sharer_facebook == 'true') {
						$output .= '<li> <a href="//www.facebook.com/sharer.php?u='.esc_url($ssurl).'&amp;t='.urlencode($sstitle).'" title="facebook" target="_blank"> <span class="fab fa-facebook"></span>  </a> </li>';
					}
					if($show_sharer_delicious == 'true') {
						$output .= '<li> <a href="//del.icio.us/post?url='.esc_url($ssurl).'&amp;title='.urlencode($sstitle).'" title="delicious" target="_blank"> <span class="fab fa-delicious"></span>  </a> </li>';
					}
					if($show_sharer_digg == 'true') {
						$output .= '<li> <a href="//digg.com/submit?phase=2&amp;url='.esc_url($ssurl).'&amp;title='.urlencode($sstitle).'" title="digg" target="_blank"> <span class="fab fa-digg"></span>  </a> </li>';
					}
					if($show_sharer_stumbleupon == 'true') {
						$output .= '<li> <a href="//www.stumbleupon.com/submit?url='.esc_url($ssurl).'&amp;title='.urlencode($sstitle).'" title="stumbleupon" target="_blank"> <span class="fab fa-stumbleupon"></span>  </a> </li>';
					}
					if($show_sharer_twitter == 'true') {
						$output .= '<li> <a href="//twitter.com/home/?status='.esc_url($ssurl).':'.urlencode($sstitle).'" title="twitter" target="_blank"> <span class="fab fa-twitter"></span>  </a> </li>';
					}
					if($show_sharer_googleplus == 'true') {
						$output .= '<li> <a href="//plus.google.com/share?url='.esc_url($ssurl).'" title="googleplus" target="_blank" onclick="javascript:window.open(this.href,\"\",\"menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\");return false;"> <span class="fab fa-google-plus"></span>  </a> </li>';
					}
					if($show_sharer_linkedin == 'true') {
						$output .= '<li> <a href="//www.linkedin.com/shareArticle?mini=true&amp;title='.urlencode($sstitle).'&amp;url='.esc_url($ssurl).'" title="linkedin" target="_blank"> <span class="fab fa-linkedin"></span>  </a> </li>';
					}
					if($show_sharer_pinterest == 'true') {

						$featured_image_id = get_post_thumbnail_id($product_id);
						$image_details = wp_get_attachment_image_src($featured_image_id, 'full');

						$media = $image_details[0]; 

						$output .= '<li> <a href="//pinterest.com/pin/create/button/?url='.esc_url($ssurl).'&amp;media='.esc_url($media).'" title="pinterest" target="_blank"> <span class="fab fa-pinterest"></span>  </a> </li>'; 

					}

				$output .= '</ul>';
					
			$output .= '</div>';

		} else if($share_follow_type == 'follow') {

			$social_follow = array (
			  'delicious' 	 => esc_html__('Delicious', 'augury'),
			  'deviantart' 	 => esc_html__('Deviantart', 'augury'),
			  'digg' 	  	 => esc_html__('Digg', 'augury'),
			  'dribbble' 	 => esc_html__('Dribbble', 'augury'),
			  'envelope' 	 => esc_html__('Envelope', 'augury'),
			  'facebook' 	 => esc_html__('Facebook', 'augury'),
			  'flickr' 		 => esc_html__('Flickr', 'augury'),
			  'google-plus'  => esc_html__('Google Plus', 'augury'),
			  'gtalk'  		 => esc_html__('GTalk', 'augury'),
			  'instagram'	 => esc_html__('Instagram', 'augury'),
			  'lastfm'	 	 => esc_html__('Lastfm', 'augury'),
			  'linkedin'	 => esc_html__('Linkedin', 'augury'),
			  'pinterest'	 => esc_html__('Pinterest', 'augury'),
			  'reddit'		 => esc_html__('Reddit', 'augury'),
			  'rss'		 	 => esc_html__('RSS', 'augury'),
			  'skype'		 => esc_html__('Skype', 'augury'),
			  'stumbleupon'	 => esc_html__('Stumbleupon', 'augury'),
			  'tumblr'		 => esc_html__('Tumblr', 'augury'),
			  'twitter'		 => esc_html__('Twitter', 'augury'),
			  'viadeo'		 => esc_html__('Viadeo', 'augury'),
			  'vimeo'		 => esc_html__('Vimeo', 'augury'),
			  'yahoo'		 => esc_html__('Yahoo', 'augury'),
			  'youtube'		 => esc_html__('Youtube', 'augury')
			);

			$socials_selected = array ();
			foreach($social_follow as $socialfollow_key => $socialfollow) {

				$show_follow_option = augury_get_option( 'dt-single-product-show-follow-'.$socialfollow_key );

				if($show_follow_option == 'true') {
					array_push($socials_selected, $socialfollow_key);
				}
			}

			$sociable_flds = augury_get_sociable_links();
			if( is_array( $sociable_flds ) && !empty( $sociable_flds ) ) {

				$list = '';
				foreach( $sociable_flds as $key => $sf) {

					if(in_array($key, $socials_selected)) {
						$list .= '<li class="'.esc_attr( $key ).'"><a target="_blank" href="'.esc_url( $sf ).'"></a></li>';
					}
				}

				if(!empty( $list )) {

					$output .= '<div class="dt-sc-single-product-follow-container '.esc_attr($social_icon_style_cls).' '.esc_attr($social_icon_radius_cls).' '.esc_attr($social_icon_inline_alignment_cls).'">';
						$output .= '<a class="dt-sc-single-product-follow-item-icon">'.esc_html__('Follow', 'augury').'</a>';
						$output .= '<ul class="dt-sc-single-product-follow-list">'.$list.'</ul>';
					$output .= '</div>';

				}
			}
		}

		return $output;
	}
}


// Product Shortcode - Ajax Call

if ( ! function_exists( 'augury_products_ajax_call' ) ) {

	function augury_products_ajax_call() {

		$productpagination_nonce = sanitize_text_field($_POST['productpagination_nonce']);
		if(isset($productpagination_nonce) && wp_verify_nonce($productpagination_nonce, 'productpagination_nonce')) {

			$shortcodeattrs_settings = json_decode(html_entity_decode(stripslashes($_REQUEST['shortcodeattrs'])), true);

			$current_page = isset($_REQUEST['current_page']) ? $_REQUEST['current_page'] : 1;
			$offset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;

			$shortcodeattrs_settings['current_page'] = $current_page;
			$shortcodeattrs_settings['offset'] = $offset;

			$output = productsWidgetHtml($shortcodeattrs_settings);

			echo "{$output}";

		}

		wp_die();

	}

	add_action( 'wp_ajax_augury_products_ajax_call', 'augury_products_ajax_call' );
	add_action( 'wp_ajax_nopriv_augury_products_ajax_call', 'augury_products_ajax_call' );

}

// Product Shortcode - Ajax Pagination

if ( ! function_exists( 'augury_products_ajax_pagination' ) ) {

	function augury_products_ajax_pagination($max_num_pages, $current_page, $post_per_page, $function_call, $output_div, $shortcode_attrs) {

		$output = '';

		if($max_num_pages > 1) {

			$output .= '<div class="dt-sc-product-pagination dt-sc-product-ajax-pagination" data-postperpage="'.$post_per_page.'" data-functioncall="'.$function_call.'" data-outputdiv="'.$output_div.'"  data-shortcodeattrs="'.esc_js($shortcode_attrs).'" data-productpagination-nonce="'.wp_create_nonce('productpagination_nonce').'">';
					
				if($current_page > 1) {
					$output .= '<div class="prev-post"><a href="#" data-currentpage="'.$current_page.'"><span class="fas fa-angle-double-left"></span></a></div>';
				}

				$output .= paginate_links ( array (
							  'base' 		 => '#',
							  'format' 		 => '',
							  'current' 	 => $current_page,
							  'type'     	 => 'list',
							  'end_size'     => 2,
							  'mid_size'     => 3,
							  'prev_next'    => false,
							  'total' 		 => $max_num_pages 
						  ) );

				if ($current_page < $max_num_pages) {
					$output .= '<div class="next-post"><a href="#" data-currentpage="'.$current_page.'"><span class="fas fa-angle-double-right"></span></a></div>';
				}

			$output .= '</div>';

	    }

	    return $output;

	}

}

// Product Countdown Timer

if ( ! function_exists( 'augury_products_sale_countdown_timer' ) ) {

	function augury_products_sale_countdown_timer() {

		$product_template = augury_woo_product_single_template_option();

		if( $product_template == 'woo-default' ) {

			$sale_countdown_timer = augury_get_option( 'dt-single-product-sale-countdown-timer' );
			$sale_countdown_timer = (isset($sale_countdown_timer) && $sale_countdown_timer == 'true') ? true : false;

			if(!$sale_countdown_timer) {
				return;
			}

		}

		$output = '';

		global $product;
        $sale_date_end = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
		$sale_date_start = get_post_meta( $product->get_id(), '_sale_price_dates_from', true );

		if ( $product->get_type() == 'variable' && $variations = $product->get_available_variations() ) {
			$sale_date_end = get_post_meta( $variations[0]['variation_id'], '_sale_price_dates_to', true );
			$sale_date_start = get_post_meta( $variations[0]['variation_id'], '_sale_price_dates_from', true );
		}

		$curent_date = strtotime( date( 'Y-m-d H:i:s' ) );

		if ( $sale_date_end < $curent_date || $curent_date < $sale_date_start ) {
			return;
		}

		$gmt_offset = get_option('gmt_offset');

		echo '<div class="dt-sc-product-sale-countdown-holder">';
			echo '<div class="downcount" data-date="'.esc_attr( date( 'Y-m-d H:i:s', $sale_date_end ) ).'" data-offset="'.esc_attr($gmt_offset).'">';
				echo '<div class="dt-sc-counter-wrapper">';
					echo '<div class="counter-icon-wrapper">';
						echo '<div class="dt-sc-counter-number days">00</div>';
					echo '</div>';
					echo '<h3 class="title">'.esc_html__('Day(s)', 'augury').'</h3>';
				echo '</div>';
				echo '<div class="dt-sc-counter-wrapper">';
					echo '<div class="counter-icon-wrapper">';
						echo '<div class="dt-sc-counter-number hours">00</div>';
					echo '</div>';
					echo '<h3 class="title">'.esc_html__('Hr(s)', 'augury').'</h3>';
				echo '</div>';
				echo '<div class="dt-sc-counter-wrapper">';
					echo '<div class="counter-icon-wrapper">';
						echo '<div class="dt-sc-counter-number minutes">00</div>';
					echo '</div>';
					echo '<h3 class="title">'.esc_html__('Min(s)', 'augury').'</h3>';
				echo '</div>';
				echo '<div class="dt-sc-counter-wrapper last">';
					echo '<div class="counter-icon-wrapper">';
						echo '<div class="dt-sc-counter-number seconds">00</div>';
					echo '</div>';
					echo '<h3 class="title">'.esc_html__('Sec(s)', 'augury').'</h3>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

	}

	add_action( 'woocommerce_single_product_summary', 'augury_products_sale_countdown_timer', 15 );

}

// Product Shortcode - Ajax Call

if ( ! function_exists( 'augury_size_guide_popup' ) ) {

	function augury_size_guide_popup() {

		$sizeguide_nonce = sanitize_text_field($_POST['sizeguide_nonce']);
		if(isset($sizeguide_nonce) && wp_verify_nonce($sizeguide_nonce, 'sizeguide_nonce')) {

			$product_id = (isset($_REQUEST['product_id']) && $_REQUEST['product_id'] != '') ? $_REQUEST['product_id'] : -1;

			if($product_id > -1) {

				$settings = get_post_meta( $product_id, '_custom_settings', true );
				$single_product_size_guides = (isset($settings['dt-single-product-size-guides']) && $settings['dt-single-product-size-guides'] != '') ? $settings['dt-single-product-size-guides'] : false;	
				
				if($single_product_size_guides) {
					echo '<div class="dt-sc-size-guide-popup-container">';
						echo '<div class="dt-sc-size-guide-popup-content">';

							if($single_product_size_guides == 'size-guide-1') {

								$woo_size_guide_title = augury_get_option( 'dt-woo-size-guide-title-1' );
								$woo_size_guide_title = (isset($woo_size_guide_title) && $woo_size_guide_title != '') ? $woo_size_guide_title : '';
							
								$woo_size_guide_content = augury_get_option( 'dt-woo-size-guide-content-1' );
								$woo_size_guide_content = (isset($woo_size_guide_content) && $woo_size_guide_content != '') ? $woo_size_guide_content : '';

							} else if($single_product_size_guides == 'size-guide-2') {

								$woo_size_guide_title = augury_get_option( 'dt-woo-size-guide-title-2' );
								$woo_size_guide_title = (isset($woo_size_guide_title) && $woo_size_guide_title != '') ? $woo_size_guide_title : '';
							
								$woo_size_guide_content = augury_get_option( 'dt-woo-size-guide-content-2' );
								$woo_size_guide_content = (isset($woo_size_guide_content) && $woo_size_guide_content != '') ? $woo_size_guide_content : '';

							} else if($single_product_size_guides == 'size-guide-3') {

								$woo_size_guide_title = augury_get_option( 'dt-woo-size-guide-title-3' );
								$woo_size_guide_title = (isset($woo_size_guide_title) && $woo_size_guide_title != '') ? $woo_size_guide_title : '';
							
								$woo_size_guide_content = augury_get_option( 'dt-woo-size-guide-content-3' );
								$woo_size_guide_content = (isset($woo_size_guide_content) && $woo_size_guide_content != '') ? $woo_size_guide_content : '';

							} else if($single_product_size_guides == 'size-guide-4') {

								$woo_size_guide_title = augury_get_option( 'dt-woo-size-guide-title-4' );
								$woo_size_guide_title = (isset($woo_size_guide_title) && $woo_size_guide_title != '') ? $woo_size_guide_title : '';
							
								$woo_size_guide_content = augury_get_option( 'dt-woo-size-guide-content-4' );
								$woo_size_guide_content = (isset($woo_size_guide_content) && $woo_size_guide_content != '') ? $woo_size_guide_content : '';

							} else if($single_product_size_guides == 'size-guide-5') {

								$woo_size_guide_title = augury_get_option( 'dt-woo-size-guide-title-5' );
								$woo_size_guide_title = (isset($woo_size_guide_title) && $woo_size_guide_title != '') ? $woo_size_guide_title : '';
							
								$woo_size_guide_content = augury_get_option( 'dt-woo-size-guide-content-5' );
								$woo_size_guide_content = (isset($woo_size_guide_content) && $woo_size_guide_content != '') ? $woo_size_guide_content : '';

							}

							if(isset($woo_size_guide_content) && $woo_size_guide_content != '') {
								echo '<div class="dt-sc-size-guide-popup-content-title">'.esc_html($woo_size_guide_title).'</div>';
								echo '<div class="dt-sc-size-guide-popup-content-details"><img src="'.esc_url($woo_size_guide_content).'" alt="'.esc_attr($woo_size_guide_title).'" /></div>';
							}
							
						echo '</div>';
						echo '<div class="dt-sc-size-guide-popup-close">'.esc_html__('Close','augury').'</div>';
					echo '</div>';
				}		

			}

		}

		wp_die();

	}

	add_action( 'wp_ajax_augury_size_guide_popup', 'augury_size_guide_popup' );
	add_action( 'wp_ajax_nopriv_augury_size_guide_popup', 'augury_size_guide_popup' );

}