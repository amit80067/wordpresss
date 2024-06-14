<?php
/* ---------------------------------------------------------------------------
 * VC Default Editor
 * --------------------------------------------------------------------------- */
add_action( 'vc_before_init', 'augury_vc_compatible' );
function augury_vc_compatible() {
	
	vc_set_as_theme();

	$posts = apply_filters( 'augury_vc_default_cpt' , array ( 'page' )  );
	vc_set_default_editor_post_types( $posts );
}

/* ---------------------------------------------------------------------------
 * Theme Hooks : To Resolve <style> ... </style> in side body tag
 * --------------------------------------------------------------------------- */
add_action( 'wp_head', 'augury_wp_head',999 );
if ( ! function_exists( 'augury_wp_head' ) ) {
	function augury_wp_head() {
		ob_start();
	}
}

add_action( 'wp_footer', 'augury_wp_footer',1000 );
if ( ! function_exists( 'augury_wp_footer' ) ) {
	function augury_wp_footer() {

		$content = ob_get_clean();
		$regex = "#<style id='augury-custom-inline-inline-css' type='text/css'>([^<]*)</style>#";
		preg_match($regex, $content, $matches);

		$style = isset($matches[0]) ? $matches[0] : '';
		$content = str_replace($style,'',$content);
		$content = str_replace('</head>',$style.'</head>',$content);

		$regex = "#<style id='font-awesome-inline-css' type='text/css'>([^<]*)</style>#";
		preg_match($regex, $content, $matches);

		$style = isset($matches[0]) ? $matches[0] : '';
		$content = str_replace($style,'',$content);
		$content = str_replace('</head>',$style.'</head>',$content);

		$styles = '';
		$regex = '#<style>.elementor-([^<]*)</style>#';
		preg_match_all($regex, $content, $matches);
		if( isset($matches[0]) ) {

			foreach ($matches[0] as $tag) {
				$styles .= "\n".$tag;
				$content = str_replace($tag, '', $content);
			}
		}

		if( !empty( $styles ) ) {
			$content = str_replace('</head>', $styles.'</head>', $content);
		}

		echo "{$content}";
	}
}

/* ---------------------------------------------------------------------------
 * Hook of Top
 * --------------------------------------------------------------------------- */
function augury_hook_top() {
	if( augury_get_option( 'enable-top-hook' ) ) :
		echo '<!-- augury_hook_top -->';
			$hook = augury_get_option( 'top-hook' );
			if (!empty($hook) )
				echo do_shortcode( stripslashes($hook) );
		echo '<!-- augury_hook_top -->';
	endif;	
}
add_action( 'augury_hook_top', 'augury_hook_top', 10 );

/* ---------------------------------------------------------------------------
 * Page Loader
 * --------------------------------------------------------------------------- */
add_action( 'augury_hook_top', 'augury_page_loader', 20 );
function augury_page_loader() {
	$loader = augury_get_option( 'show-loader' );
	if( $loader ) {
		echo '<div class="pre-loader">
			<div class="loading-spinner">
				<div class="spinner-box">
					<div class="solar-system">
						<div class="earth-orbit orbit">
						  <div class="planet earth"></div>
						  <div class="venus-orbit orbit">
						    <div class="planet venus"></div>
						    <div class="mercury-orbit orbit">
						      <div class="planet mercury"></div>
						      <div class="sun"></div>
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>';
	}
}

/* ---------------------------------------------------------------------------
 * Hook of Content before
 * --------------------------------------------------------------------------- */
function augury_hook_content_before() {
	if( augury_get_option( 'enable-content-before-hook' ) ) :
		echo '<!-- augury_hook_content_before -->';
			$hook = augury_get_option( 'content-before-hook' );
			if (!empty($hook))
				echo do_shortcode( stripslashes($hook) );
		echo '<!-- augury_hook_content_before -->';
	endif;
}
add_action( 'augury_hook_content_before', 'augury_hook_content_before' );

/* ---------------------------------------------------------------------------
 * Hook of Content after
 * --------------------------------------------------------------------------- */
function augury_hook_content_after() {
	if( augury_get_option( 'enable-content-after-hook' ) ) :
		echo '<!-- augury_hook_content_after -->';
			$hook = augury_get_option( 'content-after-hook' );
			if (!empty($hook))
				echo do_shortcode( stripslashes($hook) );
		echo '<!-- augury_hook_content_after -->';
	endif;
}
add_action( 'augury_hook_content_after', 'augury_hook_content_after' );

/* ---------------------------------------------------------------------------
 * Main Header Hook
 * --------------------------------------------------------------------------- */
add_action( 'augury_header', 'augury_ele_header_template', 10 );
if( ! function_exists( 'augury_ele_header_template' ) ) {

    function augury_ele_header_template( $page_id ) {

        $id = $elementor_instance = '';

		if( class_exists( '\Elementor\Plugin' ) ) {
			$elementor_instance = Elementor\Plugin::instance();
		}

        if( is_singular() && empty( $page_id ) ) {

            global $post;

            $settings = get_post_meta( $post->ID,'_dt_custom_settings',TRUE );
            $settings = is_array( $settings ) ? $settings  : array();

            if( array_key_exists( 'show-header', $settings ) && !$settings['show-header'] )
                return;

            $id = isset( $settings['header'] ) ? $settings['header'] : '';
            $id = ( $id == '' ) ? augury_get_option( 'site-custom-header' ) : $id;

        } elseif( !empty( $page_id ) ) {

            $settings = get_post_meta( $page_id, '_dt_custom_settings',TRUE );
            $settings = is_array( $settings ) ? $settings  : array();

            if( array_key_exists( 'show-header', $settings ) && !$settings['show-header'] )
                return;

            $id = isset( $settings['header'] ) ? $settings['header'] : '';
            $id = ( $id == '' ) ? augury_get_option( 'site-custom-header' ) : $id;

        } else {

            $id = augury_get_option( 'site-custom-header' );
        }

        $id = apply_filters( 'augury_header_id', $id );

        if( !$id || !class_exists ( 'DTElementorCore' ) ) {
            get_template_part( 'template-parts/content', 'header' );
            return;
        }

        ob_start();

		if( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
			// Load elementor styles.
			$css_file = new \Elementor\Core\Files\CSS\Post( $id );
			$css_file->enqueue();
		}

        echo '<div id="header-'.esc_attr( $id ).'" class="dt-header-tpl header-' .esc_attr( $id ). '">';
            echo "{$elementor_instance->frontend->get_builder_content_for_display( $id )}";
        echo '</div>';

        $content = ob_get_clean();
        echo apply_filters( 'augury_header_content', $content );
    }
}

/* ---------------------------------------------------------------------------
 * Main Footer Hook
 * --------------------------------------------------------------------------- */
add_action( 'augury_footer', 'augury_ele_footer_template', 10 );
if( ! function_exists( 'augury_ele_footer_template' ) ) {

	function augury_ele_footer_template() {

        $id = $elementor_instance = '';

		if( class_exists( '\Elementor\Plugin' ) ) {
			$elementor_instance = Elementor\Plugin::instance();
		}

		if( is_singular() ) {

			global $post;

			$settings = get_post_meta( $post->ID,'_dt_custom_settings',TRUE );
			$settings = is_array( $settings ) ? $settings  : array();

			if( array_key_exists( 'show-footer', $settings ) && !$settings['show-footer'] )
				return;

            $id = isset( $settings['footer'] ) ? $settings['footer'] : '';
            $id = ( $id == '' ) ? augury_get_option( 'site-custom-footer' ) : $id;

        } elseif( function_exists( 'is_woocommerce' ) && is_shop() ) {

            $shop_page_id = get_option('woocommerce_shop_page_id');

            $settings = get_post_meta( $shop_page_id,'_dt_custom_settings',TRUE );
			$settings = is_array( $settings ) ? $settings  : array();

			if( array_key_exists( 'show-footer', $settings ) && !$settings['show-footer'] )
				return;

            $id = isset( $settings['footer'] ) ? $settings['footer'] : '';
            $id = ( $id == '' ) ? augury_get_option( 'site-custom-footer' ) : $id;

		} else {
            $id = augury_get_option( 'site-custom-footer' );
        }

		$id = apply_filters( 'augury_footer_id', $id );

		if( !$id || !class_exists ( 'DTElementorCore' ) ) {

			echo '<div class="dt-no-footer-builder-content footer-copyright aligncenter">
				<span>&copy; '.date( 'Y' ).' '.get_bloginfo( 'name' ).'. '. get_bloginfo( 'description', 'display' ).'</span>
			</div>';
			return;
		}

		ob_start();

		if( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
			// Load elementor styles.
			$css_file = new \Elementor\Core\Files\CSS\Post( $id );
			$css_file->enqueue();
		}

		echo "{$elementor_instance->frontend->get_builder_content_for_display( $id )}";

		$content = ob_get_clean();
        echo apply_filters( 'augury_footer_content', $content );
	}
}

/* ---------------------------------------------------------------------------
 * Hook of Bottom
 * --------------------------------------------------------------------------- */
function augury_hook_bottom() {
	if( augury_get_option( 'enable-bottom-hook' ) ) :
		echo '<!-- augury_hook_bottom -->';
			$hook = augury_get_option( 'bottom-hook' );
            if (!empty($hook))
                echo do_shortcode( stripslashes($hook) );
		echo '<!-- augury_hook_bottom -->';
	endif;
}
add_action( 'augury_hook_bottom', 'augury_hook_bottom' );

/* ---------------------------------------------------------------------------
 * Additional JS Hook
 * --------------------------------------------------------------------------- */
function augury_hook_additional_js() {
    $hook = augury_get_option( 'additional-js' );
	if( $hook != '' ) :
		echo '<!-- augury_hook_additional_js -->';
			echo '<script type="text/javascript">'.augury_wp_kses(stripslashes($hook)).'</script>';
		echo '<!-- augury_hook_additional_js -->';
	endif;
}
add_action( 'wp_head', 'augury_hook_additional_js' );

/* ---------------------------------------------------------------------------
 * Call Back For No Header Menu
 * --------------------------------------------------------------------------- */
function augury_new_wp_page_menu() {

    $pages = wp_list_pages( array(
        'depth'         => 0,
        'title_li'      => '',
        'echo'          => 0,
        'post_type'     => 'page',
        'link_before'   => '<span>',
        'link_after'    => '</span>',
        'post_status'   => 'publish',
		'walker'        => new Augury_Walker_Page
    ) );

    echo '<div class="menu-container">';
    echo '  <ul class="dt-primary-nav" data-menu="dummy-menu">';
    echo '  <li class="close-nav"></li>' . $pages;
    echo '  </ul>';
    echo '</div>';
}

/* ---------------------------------------------------------------------------
 * Predefined Skins
 * --------------------------------------------------------------------------- */
function augury_skins( $arg ) {

    $skins = array (
        'blue'    => array( 'primary-color'  => '#B71C1C', 'secondary-color'  => '#880E4F', 'tertiary-color'  => '#4A148C',),
        'brown'   => array( 'primary-color'  => '#B71C1C', 'secondary-color'  => '#880E4F', 'tertiary-color'  => '#4A148C',),
        'color-1' => array( 'primary-color'  => '#B71C1C', 'secondary-color'  => '#880E4F', 'tertiary-color'  => '#4A148C',),
        'color-2' => array( 'primary-color'  => '#311B92', 'secondary-color'  => '#1A237E', 'tertiary-color'  => '#0D47A1', ),
        'color-3' => array( 'primary-color'  => '#01579B', 'secondary-color'  => '#006064', 'tertiary-color'  => '#004D40', )
    );

    $skin = array_key_exists( $arg , $skins ) ? $skins[ $arg ] : array();
    return $skin;    
}

/* ---------------------------------------------------------------------------
 * Page Layout  
 * --------------------------------------------------------------------------- */
function augury_page_layout( $layout = '' ) {

    $page_layout       = $sidebar_class = '';
    $show_sidebar      = $show_left_sidebar = $show_right_sidebar = false;
    $container_class   = "container";
    $image_size_class = '';

	switch ( $layout ) {

		case 'with-left-sidebar':
            $page_layout      = "page-with-sidebar with-left-sidebar";
            $show_sidebar     = $show_left_sidebar = true;
            $sidebar_class    = "secondary-has-left-sidebar";
            $image_size_class = 'default';
    	break;

    	case 'with-right-sidebar':
            $page_layout      = "page-with-sidebar with-right-sidebar";
            $show_sidebar     = $show_right_sidebar	= true;
            $sidebar_class    = "secondary-has-right-sidebar";
            $image_size_class = 'default';
    	break;

    	case 'with-both-sidebar':
            $page_layout      = "page-with-sidebar with-both-sidebar";
            $show_sidebar     = $show_left_sidebar = $show_right_sidebar = true;
            $sidebar_class    = "secondary-has-both-sidebar";
            $image_size_class = 'default';
    	break;

        case 'fullwidth':
            $container_class  = "portfolio-fullwidth-container";
            $page_layout      = "content-full-width";
            $image_size_class = 'fullwidth';
        break;

    	case 'content-full-width':
    	default:
            $page_layout      = "content-full-width";
            $image_size_class = 'default';
    	break;
    }
    
	if( ( is_archive() || is_search() || is_home() ) && $layout != 'content-full-width' ) {

		$left_std = augury_get_option( 'show-standard-left-sidebar-for-post-archives' );
		$right_std = augury_get_option( 'show-standard-right-sidebar-for-post-archives' );

		$left = $right = false;
		if( (isset($layout) && ($layout == 'with-left-sidebar' || $layout == 'with-both-sidebar')) && ( is_active_sidebar('post-archives-sidebar-left') || ( !empty( $left_std ) && is_active_sidebar('standard-sidebar-left') ) ) ) {
			$left = true;
		}

		if( (isset($layout) && ($layout == 'with-right-sidebar' || $layout == 'with-both-sidebar')) && ( is_active_sidebar('post-archives-sidebar-right') || ( !empty( $right_std ) && is_active_sidebar('standard-sidebar-right') ) ) ) {
			$right = true;
		}

		$pageid = get_option('page_for_posts');
		if( $pageid > 0 ) {
			$settings = array();
			$left = $right = false;

			$settings = get_post_meta($pageid,'_tpl_default_settings',TRUE);
			$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

			if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
				$settings['layout'] = augury_get_option( 'site-global-sidebar-layout' );
				$settings['show-standard-sidebar-left'] = true;
				$settings['show-standard-sidebar-right'] = true;
				unset($settings['widget-area-left']);
				unset($settings['widget-area-right']);
			}

			if( (isset($settings['layout']) && ($settings['layout'] == 'with-left-sidebar' || $settings['layout'] == 'with-both-sidebar')) && ( ( isset($settings['show-standard-sidebar-left']) && $settings['show-standard-sidebar-left'] && is_active_sidebar( 'standard-sidebar-left' ) ) || augury_active_custom_widgetarea( 'page', $pageid, 'left' ) ) ) {
				$left = true;
			}
	
			if( (isset($settings['layout']) && ($settings['layout'] == 'with-right-sidebar' || $settings['layout'] == 'with-both-sidebar')) && ( ( isset($settings['show-standard-sidebar-right']) && $settings['show-standard-sidebar-right'] && is_active_sidebar( 'standard-sidebar-right' ) ) || augury_active_custom_widgetarea( 'page', $pageid, 'right' ) ) ) {
				$right = true;
			}
		}
	
		if( $left && $right ) {
            $page_layout      = "page-with-sidebar with-both-sidebar";
            $show_sidebar     = $show_left_sidebar = $show_right_sidebar = true;
            $sidebar_class    = "secondary-has-both-sidebar";
            $image_size_class = 'default';
		} elseif( $left ) {
			$page_layout        = "page-with-sidebar with-left-sidebar";
			$sidebar_class      = "secondary-has-left-sidebar";
			$show_sidebar       = $show_left_sidebar = true;
			$show_right_sidebar = false;
		} elseif( $right ) {
            $page_layout      	= "page-with-sidebar with-right-sidebar";
			$sidebar_class    	= "secondary-has-right-sidebar";
			$show_sidebar     	= $show_right_sidebar	= true;
			$show_left_sidebar = false;
		} else {
            $page_layout      = "content-full-width";
			$show_sidebar     = $show_left_sidebar = $show_right_sidebar = false;
		}
	} elseif( $layout != 'content-full-width' ) {

		global $post;
		$id = $post->ID;
		$type = $post->post_type;
		$settings = array();

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

		} elseif( $type == 'product' ){
			$settings = get_post_meta($id,'_custom_settings',TRUE);

			if( empty($settings) || ( array_key_exists( 'page-layout', $settings ) && $settings['page-layout'] == 'admin-option' ) ) {
				$settings = array();
				$settings['layout'] = augury_get_option( 'site-global-sidebar-layout' );
				$settings['show-standard-sidebar-left'] = true;
				$settings['show-standard-sidebar-right'] = true;
				unset($settings['widget-area-left']);
				unset($settings['widget-area-right']);	
				unset($settings['page-layout']);	
				unset($settings['show-standard-sidebar']);	
				unset($settings['product-widgetareas']);	
			}

		} elseif( $type == 'tribe_events' ){
			$settings = get_post_meta($id,'_custom_settings',TRUE);
			$settings = is_array( $settings ) ?  array_filter( $settings )  : array();

			if( empty($settings) || ( array_key_exists( 'layout', $settings ) && $settings['layout'] == 'global-site-layout' ) ) {
				$settings = array();
				$settings['layout'] = augury_get_option( 'site-global-sidebar-layout' );
				$settings['show-standard-sidebar-left'] = true;
				$settings['show-standard-sidebar-right'] = true;
				unset($settings['widget-area-left']);
				unset($settings['widget-area-right']);
			}

		} else {
			$settings = get_post_meta($id,'_custom_settings',TRUE);
		}

		$left = $right = false;

		if( (isset($settings['layout']) && ($settings['layout'] == 'with-left-sidebar' || $settings['layout'] == 'with-both-sidebar')) && ( ( isset($settings['show-standard-sidebar-left']) && $settings['show-standard-sidebar-left'] && is_active_sidebar( 'standard-sidebar-left' ) ) || augury_active_custom_widgetarea( $type, $id, 'left' ) ) ) {
			$left = true;
		}

		if( (isset($settings['layout']) && ($settings['layout'] == 'with-right-sidebar' || $settings['layout'] == 'with-both-sidebar')) && ( ( isset($settings['show-standard-sidebar-right']) && $settings['show-standard-sidebar-right'] && is_active_sidebar( 'standard-sidebar-right' ) ) || augury_active_custom_widgetarea( $type, $id, 'right' ) ) ) {
			$right = true;
		}

		if( (isset($settings['page-layout']) && ($settings['page-layout'] == 'with-left-sidebar')) && ( ( isset($settings['show-standard-sidebar']) && $settings['show-standard-sidebar'] && is_active_sidebar( 'standard-sidebar-left' ) ) || augury_active_custom_widgetarea( $type, $id, 'left' ) ) && is_singular('product') ) {
            $left = true;
        }

        if( (isset($settings['page-layout']) && ($settings['page-layout'] == 'with-right-sidebar')) && ( ( isset($settings['show-standard-sidebar']) && $settings['show-standard-sidebar'] && is_active_sidebar( 'standard-sidebar-right' ) ) || augury_active_custom_widgetarea( $type, $id, 'right' ) ) && is_singular('product') ) {
            $right = true;
        }

		if( $left && $right ) {
            $page_layout      = "page-with-sidebar with-both-sidebar";
            $show_sidebar     = $show_left_sidebar = $show_right_sidebar = true;
            $sidebar_class    = "secondary-has-both-sidebar";
            $image_size_class = 'default';
		} elseif( $left ) {
			$page_layout        = "page-with-sidebar with-left-sidebar";
			$sidebar_class      = "secondary-has-left-sidebar";
			$show_sidebar       = $show_left_sidebar = true;
			$show_right_sidebar = false;
		} elseif( $right ) {
            $page_layout      	= "page-with-sidebar with-right-sidebar";
			$sidebar_class    	= "secondary-has-right-sidebar";
			$show_sidebar     	= $show_right_sidebar	= true;
			$show_left_sidebar = false;
		} else {
            $page_layout      = "content-full-width";
			$show_sidebar     = $show_left_sidebar = $show_right_sidebar = false;			
		}
    }
    
    return array(
        'page_layout'        => $page_layout,
        'sidebar_class'      => $sidebar_class,
        'show_sidebar'       => $show_sidebar,
        'show_left_sidebar'  => $show_left_sidebar,
        'show_right_sidebar' => $show_right_sidebar,
        'container_class'    => $container_class,
        'image_size_class'   => $image_size_class,
	);
	
}

/* ---------------------------------------------------------------------------
 * Return Breadcrumb Style
 * --------------------------------------------------------------------------- */
function augury_breadcrumb_css( $settings = array() ) {

    $bg = $co = $repeat = $pos = $attach = $size = $style = '';

    $bg = !empty( $settings['image'] ) ? $settings['image'] : '';
    $co = !empty( $settings['color'] ) ? $settings['color'] : '';
	
    if(!empty($bg) || !empty($co)) :
        $repeat = !empty( $settings['repeat'] ) ? $settings['repeat'] :'repeat';
        $pos    = !empty( $settings['position'] ) ? $settings['position'] :'left top';
        $attach = !empty( $settings['attachment'] ) ? $settings['attachment'] :'scroll';
        $size   = !empty( $settings['size'] ) ? $settings['size'] :'auto';
    endif;

	$style = !empty($bg) ? "background-image: url($bg); " : "";
	$style .= !empty($pos) ? "background-position: $pos; " : "";
	$style .= !empty($size) ? "background-size: $size; " : "";
	$style .= !empty($repeat) ? "background-repeat: $repeat; " : "";
	$style .= !empty($attach) ? "background-attachment: $attach; " : "";
    $style .= !empty($co) ? "background-color:$co;" : "";

    return $style;
}

/* ---------------------------------------------------------------------------
 * Breadcrumb
 * --------------------------------------------------------------------------- */
function augury_new_breadcrumbs( $args ) {

    $breadcrumbs = array();
    $output = '';

    $homeLink = esc_url( home_url('/') );
    $separator = '<span class="'.augury_get_option( 'breadcrumb-delimiter' ).'"></span>';

    $change_delimiter = augury_get_option( 'change-breadcrumb-delimiter' );
    if( !$change_delimiter ) {
	    $separator = '<span class="breadcrumb-default-delimiter"></span>';
    }

    $breadcrumbs[] =  '<a href="'. $homeLink .'">'. esc_html__('Home','augury') .'</a>';
    $breadcrumbs = array_merge( $breadcrumbs, $args );

    $output .=  '<div class="breadcrumb">';
        $count = count( $breadcrumbs );
        $i = 1;

        foreach( $breadcrumbs as $bk => $bc ){
            if( !is_object( $bc ) ) {
                if( strpos( $bc , $separator ) ) {
                    // category parents fix
                    $output .=  ($bc);
                } else {
                    if( $i == $count ) $separator = '';
                    $output .=  ($bc . $separator);
                }
            }
            $i++;
        }
    $output .=  '</div>';

    return $output;
}

function augury_breadcrumb_output( $title, $breadcrumbs, $class, $inline_css ) {

	$parallax = augury_get_option( 'breadcrumb-parallax-bg' );
	if( $parallax ) {
		$class .= ' dt-parallax-bg';
	}	
	
    $inline_css = !empty( $inline_css ) ? "style='".esc_attr($inline_css)."'" : "";

    echo '<section class="main-title-section-wrapper '.esc_attr($class).'">';
    echo '  <div class="main-title-section-bg" '. $inline_css.'></div>';
    echo '  <div class="container">';
    echo '  	<div class="main-title-section">'. $title .'</div>';
    echo        augury_new_breadcrumbs( $breadcrumbs );
    echo '  </div>';
    echo '</section>';
}