<?php
/* ---------------------------------------------------------------------------
 * Theme support
 * --------------------------------------------------------------------------- */
if (!function_exists('augury_features')) {

	function augury_features() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'post-formats', array('status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat'));
		add_theme_support( 'buddypress-use-legacy' );

		# post thumbnails
		if ( function_exists( 'add_theme_support' ) ) {

			add_theme_support( 'post-thumbnails' );
			add_image_size( 'augury-blog-thumb', 380, 200, true  ); 		// blog - thumb
			add_image_size( 'augury-blog-ii-column', 750, 630, true  ); 	// blog - ii column
			add_image_size( 'augury-blog-iii-column', 570, 370, true  ); 	// blog - iii column
			add_image_size( 'augury-blog-list', 600, 400, true  ); 	// blog - list
			add_image_size( 'augury-blog-ii-column-masonry', 750 ); 	// blog - ii column masonry
			add_image_size( 'augury-blog-iii-column-masonry', 540 ); 	// blog - iii column masonry

			add_image_size( 'augury-event-list', 420, 336, true  ); 	// event-calendar - list
			add_image_size( 'augury-event-single-type1', 773, 520, true  ); // event-calendar - single
			add_image_size( 'augury-event-single-type4', 570, 460, true  ); // event-calendar - single
			add_image_size( 'augury-event-single-type5', 746, 770, true  ); // event-calendar - single
			add_image_size( 'augury-event-list2', 420, 275, true  ); 	// event-calendar - shortcode list
		}
		
		register_nav_menus( array(
			'main-menu' => esc_html__('Main Menu', 'augury'),
		) );

	}
	add_action('after_setup_theme', 'augury_features');
}

/* ---------------------------------------------------------------------------
 *	Set Max Content Width
 * --------------------------------------------------------------------------- */
if ( ! isset( $content_width ) ) $content_width = 1230;

/* ---------------------------------------------------------------------------
 * Filter to modify default category widget view
 * --------------------------------------------------------------------------- */
if( !function_exists('augury_wp_list_categories') ){
	function augury_wp_list_categories( $output ){
		if (strpos($output, "</span>") <= 0) {
			$output = str_replace('</a> (', ' <span>(', $output);
			$output = str_replace(')', ')</span></a> ', $output);
		}
		
		return $output;
	}
	
	add_filter('wp_list_categories', 'augury_wp_list_categories');
}

/* ---------------------------------------------------------------------------
 * Filter to modify default list archive widget view
 * --------------------------------------------------------------------------- */
if( !function_exists('augury_wp_list_archive') ){
	function augury_wp_list_archive( $link_html,$url, $text, $format, $before, $after ) {
		
		if( $format == 'html' ) {
			$link_html = "\t<li>$before<a href='$url'>$text <span>$after</span></a></li>\n";
		}
		
		return $link_html;
	}
	add_filter('get_archives_link', 'augury_wp_list_archive', 10, 6);	
}

/* ---------------------------------------------------------------------------
 * Filter to execute shortcode inside contact form7
 * --------------------------------------------------------------------------- */
if( !function_exists('augury_wpcf7_form_elements') ){
	function augury_wpcf7_form_elements($form) {
		$form = do_shortcode( $form );
		return $form;
	}
	add_filter('wpcf7_form_elements', 'augury_wpcf7_form_elements');
}

/* ---------------------------------------------------------------------------
 * Pagination for Blog and Portfolio
 * --------------------------------------------------------------------------- */
function augury_pagination( $query = false, $load_more = false ){
	global $wp_query;
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

	// default $wp_query
	if( $query ) {
		$custom_query = $query;
	} else {
		$custom_query = $wp_query;
	}

	$custom_query->query_vars['paged'] > 1 ? $current = $custom_query->query_vars['paged'] : $current = 1;

	if( empty( $paged ) ) $paged = 1;
	$prev = $paged - 1;
	$next = $paged + 1;

	$end_size = 1;
	$mid_size = 2;
	$show_all = augury_get_option( 'showall-pagination' );
	$dots = false;

	if( ! $total = $custom_query->max_num_pages ) $total = 1;

	$output = '';
	if( $total > 1 )
	{
		if( $load_more ){
			// ajax load more -------------------------------------------------
			if( $paged < $total ){
				$output .= '<div class="column one pager_wrapper pager_lm">';
					$output .= '<a class="pager_load_more button button_js" href="'. get_pagenum_link( $next ) .'">';
						$output .= '<span class="button_icon"><i class="icon-layout"></i></span>';
						$output .= '<span class="button_label">'. esc_html__('Load more', 'augury') .'</span>';
					$output .= '</a>';
				$output .= '</div>';
			}

		} else {
			// default --------------------------------------------------------	
			$output .= '<div class="column one pager_wrapper">';

				$big = 999999999; // need an unlikely integer
				$args = array(
					'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'total'              => $custom_query->max_num_pages,
					'current'            => max( 1, get_query_var('paged') ),
					'show_all'           => $show_all,
					'end_size'           => $end_size,
					'mid_size'           => $mid_size,
					'prev_next'          => true,
					'prev_text'          => '<i class="fas fa-angle-double-left"></i>',
					'next_text'          => '<i class="fas fa-angle-double-right"></i>',
					'type'               => 'list'
				);
				$output .= paginate_links( $args );

			$output .= '</div>'."\n";
		}
	}
	return $output;
}

function augury_events_title() {
	
	global $wp_query;
	
	$title = '';
	$date_format = apply_filters( 'tribe_events_pro_page_title_date_format', 'l, F jS Y' );
	
	if( tribe_is_month() && !is_tax() ) { 
		$title = sprintf( esc_html__( 'Events for %s', 'augury' ), date_i18n( 'F Y', strtotime( tribe_get_month_view_date() ) ) );
	} elseif( class_exists('Tribe__Events__Pro__Main') && tribe_is_week() )  {
		$title = sprintf( esc_html__('Events for week of %s', 'augury'), date_i18n( $date_format, strtotime( tribe_get_first_week_day($wp_query->get('start_date') ) ) ) );
	} elseif( class_exists('Tribe__Events__Pro__Main') && tribe_is_day() ) {
		$title = esc_html__( 'Events for', 'augury' ) . ' ' . date_i18n( $date_format, strtotime( $wp_query->get('start_date') ) );
	} elseif( class_exists('Tribe__Events__Pro__Main') && (tribe_is_map() || tribe_is_photo()) ) {
		if( tribe_is_past() ) {
			$title = esc_html__( 'Past Events', 'augury' );
		} else {
			$title = esc_html__( 'Upcoming Events', 'augury' );
		}
	
	} elseif( tribe_is_list_view() )  {
		$title = esc_html__('Upcoming Events', 'augury');
	} elseif (is_single())  {
		$title = $wp_query->post->post_title;
	} elseif( tribe_is_month() && is_tax() ) {
		$term_slug = $wp_query->query_vars['tribe_events_cat'];
		$term = get_term_by('slug', $term_slug, 'tribe_events_cat');
		$name = $term->name;
		$title = $name;
	} elseif( is_tag() )  {
		$title = esc_html__('Tag Archives','augury');
	}
	return $title;
}

/* ---------------------------------------------------------------------------
 * Excerpt
 * --------------------------------------------------------------------------- */
function augury_excerpt($limit = NULL) {
	$limit = !empty($limit) ? $limit : 10;

	$excerpt = explode(' ', get_the_excerpt(), $limit);
	$excerpt = array_filter($excerpt);

	if (!empty($excerpt)) {
		if (count($excerpt) >= $limit) {
			array_pop($excerpt);
			$excerpt = implode(" ", $excerpt).'...';
		} else {
			$excerpt = implode(" ", $excerpt);
		}
		$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
		$excerpt = str_replace('&nbsp;', '', $excerpt);
		if(!empty ($excerpt))
			return "<p>{$excerpt}</p>";
	}
}

/* ---------------------------------------------------------------------------
 * WordPress wp_kses function for allowed html
 * --------------------------------------------------------------------------- */
function augury_wp_kses($content) {
	$dt_allowed_html_tags = array(
		'a' => array('class' => array(), 'data-product_id' => array(), 'href' => array(), 'title' => array(), 'target' => array(), 'id' => array(), 'data-post-id' => array(), 'data-gal' => array(), 'data-image' => array(), 'rel' => array()),
		'abbr' => array('title' => array()),
		'address' => array(),
		'area' => array('shape' => array(), 'coords' => array(), 'href' => array(), 'alt' => array()),
		'article' => array('id' => array(), 'class' => array()),
		'aside' => array('id' => array(), 'class' => array()),
		'audio' => array('autoplay' => array(), 'controls' => array(), 'loop' => array(), 'muted' => array(), 'preload' => array(), 'src' => array()),
		'b' => array(),
		'base' => array('href' => array(), 'target' => array()),
		'bdi' => array(),
		'bdo' => array('dir' => array()), 
		'blockquote' => array('cite' => array()), 
		'br' => array(),
		'button' => array('autofocus' => array(), 'disabled' => array(), 'form' => array(), 'formaction' => array(), 'formenctype' => array(), 'formmethod' => array(), 'formnovalidate' => array(), 'formtarget' => array(), 'name' => array(), 'type' => array(), 'value' => array()),
		'canvas' => array('height' => array(), 'width' => array()),
		'caption' => array('align' => array()),
		'cite' => array(),
		'code' => array(),
		'col' => array(),
		'colgroup' => array(),
		'datalist' => array('id' => array()),
		'dd' => array(),
		'del' => array('cite' => array(), 'datetime' => array()),
		'details' => array('open' => array()),
		'dfn' => array(),
		'dialog' => array('open' => array()),
		'div' => array('class' => array(), 'id' => array(), 'style' => array(), 'align' => array(), 'data-for' => array(), 'data-date' => array(), 'data-offset' => array()),
		'dl' => array(),
		'dt' => array(),
		'em' => array(),
		'embed' => array('height' => array(), 'src' => array(), 'type' => array(), 'width' => array()),
		'fieldset' => array('disabled' => array(), 'form' => array(), 'name' => array()),
		'figcaption' => array(),
		'figure' => array(),
		'form' => array('accept' => array(), 'accept-charset' => array(), 'action' => array(), 'autocomplete' => array(), 'enctype' => array(), 'method' => array(), 'name' => array(), 'novalidate' => array(), 'target' => array(), 'id' => array(), 'class' => array()),
		'h1' => array('class' => array()), 'h2' => array('class' => array()), 'h3' => array('class' => array()), 'h4' => array('class' => array()), 'h5' => array('class' => array()), 'h6' => array('class' => array()),
		'hr' => array(), 
		'i' => array('class' => array(), 'id' => array()), 
		'iframe' => array('name' => array(), 'seamless' => array(), 'src' => array(), 'srcdoc' => array(), 'width' => array(), 'height' => array(), 'frameborder' => array(), 'allowfullscreen' => array(), 'mozallowfullscreen' => array(), 'webkitallowfullscreen' => array(), 'title' => array()),
		'img' => array('alt' => array(), 'crossorigin' => array(), 'height' => array(), 'ismap' => array(), 'src' => array(), 'usemap' => array(), 'width' => array(), 'title' => array(), 'data-default' => array()),
		'input' => array('align' => array(), 'alt' => array(), 'autocomplete' => array(), 'autofocus' => array(), 'checked' => array(), 'disabled' => array(), 'form' => array(), 'formaction' => array(), 'formenctype' => array(), 'formmethod' => array(), 'formnovalidate' => array(), 'formtarget' => array(), 'height' => array(), 'list' => array(), 'max' => array(), 'maxlength' => array(), 'min' => array(), 'multiple' => array(), 'name' => array(), 'pattern' => array(), 'placeholder' => array(), 'readonly' => array(), 'required' => array(), 'size' => array(), 'src' => array(), 'step' => array(), 'type' => array(), 'value' => array(), 'width' => array(), 'id' => array(), 'class' => array()),
		'ins' => array('cite' => array(), 'datetime' => array()),
		'label' => array('for' => array(), 'form' => array(), 'class' => array()),
		'legend' => array('align' => array()), 
		'li' => array('type' => array(), 'value' => array(), 'class' => array(), 'id' => array()),
		'link' => array('crossorigin' => array(), 'href' => array(), 'hreflang' => array(), 'media' => array(), 'rel' => array(), 'sizes' => array(), 'type' => array()),
		'main' => array(), 
		'map' => array('name' => array()), 
		'mark' => array(), 
		'menu' => array('label' => array(), 'type' => array()),
		'menuitem' => array('checked' => array(), 'command' => array(), 'default' => array(), 'disabled' => array(), 'icon' => array(), 'label' => array(), 'radiogroup' => array(), 'type' => array()),
		'meta' => array('charset' => array(), 'content' => array(), 'http-equiv' => array(), 'name' => array()),
		'object' => array('form' => array(), 'height' => array(), 'name' => array(), 'type' => array(), 'usemap' => array(), 'width' => array()),
		'ol' => array('class' => array(), 'reversed' => array(), 'start' => array(), 'type' => array()),
		'option' => array('value' => array(), 'selected' => array()),
		'p' => array('class' => array()), 
		'q' => array('cite' => array()), 
		'section' => array(), 
		'select' => array('autofocus' => array(), 'disabled' => array(), 'form' => array(), 'multiple' => array(), 'name' => array(), 'required' => array(), 'size' => array(), 'class' => array()),
		'small' => array(), 
		'source' => array('media' => array(), 'src' => array(), 'type' => array()),
		'span' => array('class' => array()), 
		'strong' => array(),
		'style' => array('media' => array(), 'scoped' => array(), 'type' => array()),
		'sub' => array(),
		'sup' => array(),
		'table' => array('sortable' => array()), 
		'tbody' => array(), 
		'td' => array('colspan' => array(), 'headers' => array()),
		'textarea' => array('autofocus' => array(), 'cols' => array(), 'disabled' => array(), 'form' => array(), 'maxlength' => array(), 'name' => array(), 'placeholder' => array(), 'readonly' => array(), 'required' => array(), 'rows' => array(), 'wrap' => array()),
		'tfoot' => array(),
		'th' => array('abbr' => array(), 'colspan' => array(), 'headers' => array(), 'rowspan' => array(), 'scope' => array(), 'sorted' => array()),
		'thead' => array(), 
		'time' => array('datetime' => array()), 
		'title' => array(), 
		'tr' => array(), 
		'track' => array('default' => array(), 'kind' => array(), 'label' => array(), 'src' => array(), 'srclang' => array()), 
		'u' => array(), 
		'ul' => array('class' => array(), 'id' => array()), 
		'var' => array(), 
		'video' => array('autoplay' => array(), 'controls' => array(), 'height' => array(), 'loop' => array(), 'muted' => array(), 'muted' => array(), 'poster' => array(), 'preload' => array(), 'src' => array(), 'width' => array()),
		'wbr' => array(),
	);

	$data = wp_kses($content, $dt_allowed_html_tags);
	return $data;
}

/**
 * Widget:
 * 	Before, After Widget wp_kses
 */
function augury_before_after_widget ( $content ) {
	$allowed_html = array(
		'aside' => array(
			'id'    => array(),
			'class' => array()
		),
		'div' => array(
			'id'    => array(),
			'class' => array(),
		)
	);

	$data = wp_kses( $content, $allowed_html );

	return $data;
}

/**
 * Widget : Title wp_kses
 */
function augury_widget_title( $content ) {

	$allowed_html = array(
		'div' => array(
			'id'    => array(),
			'class' => array()
		),
		'h2' => array(
			'class' => array()
		),
		'h3' => array(
			'class' => array()
		),				
	);

	$data = wp_kses( $content, $allowed_html );

	return $data;
}

/* ---------------------------------------------------------------------------
 * Hexadecimal to RGB color conversion
 * --------------------------------------------------------------------------- */
if(!function_exists('augury_hex2rgb')) {

	function augury_hex2rgb($hex) {
		
		$pos = strpos($hex, '#');
		
		if( is_int($pos) ):
			$hex = str_replace ( "#", "", $hex );
	
			if (strlen ( $hex ) == 3) :
				$r = hexdec ( substr ( $hex, 0, 1 ) . substr ( $hex, 0, 1 ) );
				$g = hexdec ( substr ( $hex, 1, 1 ) . substr ( $hex, 1, 1 ) );
				$b = hexdec ( substr ( $hex, 2, 1 ) . substr ( $hex, 2, 1 ) );
			 else :
				$r = hexdec ( substr ( $hex, 0, 2 ) );
				$g = hexdec ( substr ( $hex, 2, 2 ) );
				$b = hexdec ( substr ( $hex, 4, 2 ) );
			endif;
		else:
			$spos = strpos($hex, '(');
			$epos = strripos($hex, ',');
			$spos += 1;
			$n = $epos - $spos;

			$c = substr($hex, $spos, $n);
			$c = explode(',', $c);

			$r = isset($c[0]) ? $c[0] : '';
			$g = isset($c[1]) ? $c[1] : '';
			$b = isset($c[2]) ? $c[2] : '';
		endif;

		$rgb = array($r, $g, $b);
		return $rgb;
	}
}

/* ---------------------------------------------------------------------------
 * Custom Function To Get Page Permalink By Its Template
 * --------------------------------------------------------------------------- */
function augury_get_page_permalink_by_its_template( $template ) {
	$permalink = '#';

	$pages = get_posts( array(
			'post_type' => 'page',
			'meta_key' => '_wp_page_template',
			'meta_value' => $template,
			'suppress_filters' => false  ) );

	if ( is_array( $pages ) && count( $pages ) > 0 ) {
		$login_page = $pages[0];
		$permalink = get_permalink( $login_page->ID );
	}
	return $permalink;
}

/* ---------------------------------------------------------------------------
 * Theme show sidebar
 * --------------------------------------------------------------------------- */
function augury_show_sidebar( $type, $id, $position = 'right' ) {
	
	$wtstyle = augury_get_option( 'widget-title-style' );
	$sidebars = $settings = array();

	if( $type == 'page' ){
		$settings = get_post_meta($id,'_tpl_default_settings',TRUE);
		$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

		if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
			$settings['layout'] = augury_get_option( 'site-global-sidebar-layout' );
			$settings['show-standard-sidebar-left'] = true;
			$settings['show-standard-sidebar-right'] = true;
			unset($settings['widget-area-left']);
			unset($settings['widget-area-right']);
		}
	} elseif( $type == 'post' ){
		$settings = get_post_meta($id,'_dt_post_settings',TRUE);
		$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

		if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
			$settings['layout'] = augury_get_option( 'site-global-sidebar-layout' );
			$settings['show-standard-sidebar-left'] = true;
			$settings['show-standard-sidebar-right'] = true;
			unset($settings['widget-area-left']);
			unset($settings['widget-area-right']);
		}
	} elseif( $type == 'dt_portfolios' ){
		$settings = get_post_meta($id,'_portfolio_settings',TRUE);

	} elseif( $type == 'tribe_events' ){
		$settings = get_post_meta($id,'_custom_settings',TRUE);
		$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

		if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
			$settings['layout'] = augury_get_option( 'site-global-sidebar-layout' );
			$settings['show-standard-sidebar-left'] = true;
			$settings['show-standard-sidebar-right'] = true;
			unset($settings['widget-area-left']);
			unset($settings['widget-area-right']);
		}

	} else {
		$settings = get_post_meta($id,'_custom_settings',TRUE);		
	}
	
	$settings = is_array($settings) ? $settings  : array();
	$active_sidebars = array();
	
	$k = 'show-standard-sidebar-'.$position;
	if( array_key_exists( $k, $settings ) && $settings[$k] ){
		$sidebar = 'standard-sidebar-'.$position;
		if( is_active_sidebar( $sidebar ) ){
			array_push($active_sidebars, $sidebar );
		}
	}

	$k = 'widget-area-'.$position;
	if( array_key_exists($k, $settings) ){
		foreach($settings[$k] as $widgetarea ){
			$sidebars[] = mb_convert_case($widgetarea, MB_CASE_LOWER, "UTF-8");
		}	
	}

	if( !empty( $sidebars ) ) {
		foreach( $sidebars as $sidebar ) {
			if( is_active_sidebar( $sidebar ) ) {
				array_push($active_sidebars, $sidebar );
			}
		}
	}

	if( $active_sidebars ) {
		echo !empty( $wtstyle ) ? "<div class='{$wtstyle}'>" : '';
		foreach( $active_sidebars as $sidebar ) {
			dynamic_sidebar( $sidebar );
		}		
		echo !empty( $wtstyle ) ? '</div>' : '';
	}
}

/* ---------------------------------------------------------------------------
 * Theme active custom widgetarea
 * --------------------------------------------------------------------------- */
function augury_active_custom_widgetarea( $type, $id, $position = 'left' ) {

	$flag = false;
	$product_widget = false;

	if( $type == 'page' ){
		$settings = get_post_meta($id,'_tpl_default_settings',TRUE);
		$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

		if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
			unset($settings['widget-area-left']);
			unset($settings['widget-area-right']);
		}
	} elseif( $type == 'post' ){
		$settings = get_post_meta($id,'_dt_post_settings',TRUE);
		$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

		if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
			unset($settings['widget-area-left']);
			unset($settings['widget-area-right']);
		}
	} elseif( $type == 'dt_portfolios' ){
		$settings = get_post_meta($id,'_portfolio_settings',TRUE);
	} elseif( $type == 'product' ){
		$settings = get_post_meta($id,'_custom_settings',TRUE);
		$product_widget = true;
	} else {
		$settings = get_post_meta($id,'_custom_settings',TRUE);		
	}

	$settings = is_array($settings) ? $settings  : array();

	if($product_widget) {
		$k = 'product-widgetareas';
	} else {
		$k = 'widget-area-'.$position;
	}

	if( array_key_exists($k, $settings) ){
		foreach($settings[$k] as $widgetarea ){
			$sidebars[] = mb_convert_case($widgetarea, MB_CASE_LOWER, "UTF-8");
		}	
	}

	if( !empty( $sidebars ) ) {
		foreach( $sidebars as $sidebar ) {
			if( is_active_sidebar( $sidebar ) ) {
				$flag = true;
			}
		}
	}

	return $flag;
}

/* ---------------------------------------------------------------------------
 * Check global variables
 * --------------------------------------------------------------------------- */
function augury_global_variables($variable = '') {

	global $woocommerce, $product, $woocommerce_loop, $post, $wp_query, $pagenow;

	switch($variable) {
		
		case 'woocommerce':
			return $woocommerce;
		break;
		case 'product':
			return $product;
		break;
		case 'woocommerce_loop':
			return $woocommerce_loop;
		break;
		case 'post':
			return $post;
		break;
		case 'wp_query':
			return $wp_query;
		break;
		case 'pagenow':
			return $pagenow;
		break;
	}
	return false;
}

/* ---------------------------------------------------------------------------
 * Add new mimes to use custom font upload
 * --------------------------------------------------------------------------- */
add_filter('upload_mimes', 'augury_upload_mimes');
function augury_upload_mimes( $existing_mimes = array() ){
	$existing_mimes['woff'] = 'font/woff';
	$existing_mimes['woff2'] = 'font/woff2';
	$existing_mimes['ttf'] 	= 'font/ttf';
	$existing_mimes['svg'] 	= 'image/svg+xml';

	return $existing_mimes;
}

/* ---------------------------------------------------------------------------
* Whitelist Associate
* --------------------------------------------------------------------------- */
if ( ! function_exists( 'augury_array_whitelist_assoc' ) ) {
	function augury_array_whitelist_assoc( Array $array1, Array $array2 ) {
		if ( func_num_args() > 2 ) {
			$args = func_get_args();
			array_shift( $args );
			$array2 = call_user_func_array( 'array_merge', $args );
		}

		return array_intersect_key( $array1, array_flip( $array2 ) );
	}
}

// -----------------------------------------
// Custom Widgets                    -
// -----------------------------------------
function augury_customizer_custom_widgets() {

	$custom_widgets = array();
	
	$widget_areas = augury_get_option( 'widget-areas', array() );

	if( isset( $widget_areas ) ):
		foreach ( $widget_areas as $widget ) :
		  $id = mb_convert_case($widget, MB_CASE_LOWER, "UTF-8");
		  $id = str_replace(" ", "", $id);
		  $custom_widgets[$id] = $widget;
		endforeach;
	endif;

	return $custom_widgets;
}

// -----------------------------------------
// Product Style Template
// -----------------------------------------
function augury_customizer_shop_product_templates() {

	$shop_product_templates[-1] = esc_html__('Default', 'augury');

	$args = array (
				'post_type'   => 'dt_product_template',
				'post_status' => 'publish'
			);

	$product_template_pages = get_posts( $args );

	foreach($product_template_pages as $product_template_page) {
		$id = $product_template_page->ID;
		$shop_product_templates[$id] = get_the_title($id);
	}

	return $shop_product_templates;
}

// -----------------------------------------
// Retrieves published pages.
// -----------------------------------------
if ( ! function_exists( 'augury_get_customizer_pages' ) ) {

	function augury_get_customizer_pages( $selected = '' ) {

		$choices = array();

		$args = array( 'post_type' => 'page', 'post_status' => 'publish' ); 
		$pages = get_pages($args);

		$choices[''] = esc_html__('Choose the page', 'augury');
		foreach( $pages as $page ):
			$choices[$page->ID]	= $page->post_title;
		endforeach;

		return $choices;
	}
}

// -----------------------------------------
// Retrieves published custom posts.
// -----------------------------------------
if ( ! function_exists( 'augury_get_customizer_cpt_post_list' ) ) {

	function augury_get_customizer_cpt_post_list( $post_type = 'page', $label = '' ) {

		$choices = array();
		$choices[''] = $label;

		$args = array( 'post_type' => $post_type, 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'post_status' => 'publish' ); 
		$pages = get_posts($args);

		if ( ! is_wp_error( $pages ) && ! empty( $pages ) ) {

			foreach( $pages as $page ):
				$choices[$page->ID]	= $page->post_title;
			endforeach;
		}

		return $choices;
	}
}

// -----------------------------------------
// Retrieves enabled social links.
// -----------------------------------------
if( !function_exists( 'augury_get_sociable_links' ) ) {

	function augury_get_sociable_links() {

		$sociables = array();

		$delicious = augury_get_option( 'sociable-delicious' );
		if( $delicious )
			$sociables['delicious'] = $delicious;

		$deviantart = augury_get_option( 'sociable-deviantart' );
		if( $deviantart )
			$sociables['deviantart'] = $deviantart;

		$digg = augury_get_option( 'sociable-digg' );
		if( $digg )
			$sociables['digg'] = $digg;

		$dribbble = augury_get_option( 'sociable-dribbble' );
		if( $dribbble )
			$sociables['dribbble'] = $dribbble;

		$envelope = augury_get_option( 'sociable-envelope' );
		if( $envelope )
			$sociables['envelope'] = $envelope;

		$facebook = augury_get_option( 'sociable-facebook' );
		if( $facebook )
			$sociables['facebook'] = $facebook;

		$flickr = augury_get_option( 'sociable-flickr' );
		if( $flickr )
			$sociables['flickr'] = $flickr;

		$google_plus = augury_get_option( 'sociable-google-plus' );
		if( $google_plus )
			$sociables['google-plus'] = $google_plus;

		$gtalk = augury_get_option( 'sociable-gtalk' );
		if( $gtalk )
			$sociables['gtalk'] = $gtalk;

		$instagram = augury_get_option( 'sociable-instagram' );
		if( $instagram )
			$sociables['instagram'] = $instagram;

		$lastfm = augury_get_option( 'sociable-lastfm' );
		if( $lastfm )
			$sociables['lastfm'] = $lastfm;

		$linkedin = augury_get_option( 'sociable-linkedin' );
		if( $linkedin )
			$sociables['linkedin'] = $linkedin;

			$pinterest = augury_get_option( 'sociable-pinterest' );
		if( $pinterest )
			$sociables['pinterest'] = $pinterest;

		$reddit = augury_get_option( 'sociable-reddit' );
		if( $reddit )
			$sociables['reddit'] = $reddit;

		$rss = augury_get_option( 'sociable-rss' );
		if( $rss )
			$sociables['rss'] = $rss;

		$skype = augury_get_option( 'sociable-skype' );
		if( $skype )
			$sociables['skype'] = $skype;

		$stumbleupon = augury_get_option( 'sociable-stumbleupon' );
		if( $stumbleupon )
			$sociables['stumbleupon'] = $stumbleupon;

		$tumblr = augury_get_option( 'sociable-tumblr' );
		if( $tumblr )
			$sociables['tumblr'] = $tumblr;

		$twitter = augury_get_option( 'sociable-twitter' );
		if( $twitter )
			$sociables['twitter'] = $twitter;

		$viadeo = augury_get_option( 'sociable-viadeo' );
		if( $viadeo )
			$sociables['viadeo'] = $viadeo;

		$vimeo = augury_get_option( 'sociable-vimeo' );
		if( $vimeo )
			$sociables['vimeo'] = $vimeo;

		$yahoo = augury_get_option( 'sociable-yahoo' );
		if( $yahoo )
			$sociables['yahoo'] = $yahoo;

		$youtube = augury_get_option( 'sociable-youtube' );
		if( $youtube )
			$sociables['youtube'] = $youtube;

		return($sociables);
	}
}


if( !function_exists( 'augury_alter_wp_nav_menu_args' ) ) {
	function augury_alter_wp_nav_menu_args( $args ) {
			$args['menu_class'] = 'dt-primary-nav';
		return $args;

	}
	add_filter( 'wp_nav_menu_args', 'augury_alter_wp_nav_menu_args' );
}

if( !function_exists('augury_nav_menu_class') ) {
	function augury_nav_menu_class( $classes, $item, $args, $depth ) {
		
		$classes[] = 'menu-item-depth-' . $depth;
		return $classes;
	}

	add_filter( 'nav_menu_css_class', 'augury_nav_menu_class', 10, 4 );
}

if( !function_exists( 'augury_get_elementor_page_list' ) ) {
	function augury_get_elementor_page_list() {
		$pagelist = get_posts( array(
			'post_type' => 'elementor_library',
			'showposts' => 999,
		));

		if ( ! empty( $pagelist ) && ! is_wp_error( $pagelist ) ) {

			foreach ( $pagelist as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}

			$options[0] = esc_html__('-- Select Section --', 'augury');
			asort($options);

	        return $options;
		}
	}
}