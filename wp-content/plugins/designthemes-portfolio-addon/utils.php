<?php
/* ---------------------------------------------------------------------------
 * Image size support
 * --------------------------------------------------------------------------- */
if (!function_exists('dtportfolio_features')) {

	function dtportfolio_features() {

		if ( function_exists( 'add_theme_support' ) ) {

			add_image_size( 'dtportfolio-635x1100', 635, 1100, true  );
			add_image_size( 'dtportfolio-750x650', 750, 650, true  );
			add_image_size( 'dtportfolio-450x450', 450, 450, true  );
			add_image_size( 'dtportfolio-960x740', 960, 740, true  );
			add_image_size( 'dtportfolio-420x420', 420, 420, true  );
		}		
	}

	add_action('after_setup_theme', 'dtportfolio_features');
}

/* ---------------------------------------------------------------------------
 * Check whether theme has code star framework
 * --------------------------------------------------------------------------- */
function dtportfolio_is_theme_has_codestar() {

	if ( file_exists( get_stylesheet_directory().'/cs-framework/cs-framework.php') ) {
		return true;
	}

	return false;
}

/* ---------------------------------------------------------------------------
 * Function to get addon options
 * --------------------------------------------------------------------------- */
function dtportfolio_get_option($key, $value = '') {

	$v = augury_get_option($key, $value);

	if(!empty($v)) {
		return $v;
	} else {
		return $value;
	}

}

/* ---------------------------------------------------------------------------
 * Function to generate body class for portfolio template shortcode
 * --------------------------------------------------------------------------- */
add_filter( 'body_class', 'dtportfolio_template_body_class' );
function dtportfolio_template_body_class($classes) {

	global $post;

	if(isset($post)) {

		$dtportfolio_template_settings = get_post_meta($post->ID, 'dtportfolio_template_settings', true);
		$dtportfolio_template_settings = is_array($dtportfolio_template_settings) ? $dtportfolio_template_settings : array ();


		$dtportfolio_remove_footer = (array_key_exists('dtportfolio-remove-footer', $dtportfolio_template_settings) && $dtportfolio_template_settings['dtportfolio-remove-footer']) ? true : false;

		if($dtportfolio_remove_footer) {
			$classes[] = 'dtportfolio-remove-footer';
		}

		$dtportfolio_transparent_header = (array_key_exists('dtportfolio-transparent-header', $dtportfolio_template_settings) && $dtportfolio_template_settings['dtportfolio-transparent-header']) ? true : false;

		if($dtportfolio_transparent_header) {
			$classes[] = 'dtportfolio-transparent-header';
		}
					
		$dtportfolio_remove_spaces = (array_key_exists('dtportfolio-remove-spaces', $dtportfolio_template_settings) && $dtportfolio_template_settings['dtportfolio-remove-spaces']) ? true : false;

		if($dtportfolio_remove_spaces) {
			$classes[] = 'dtportfolio-fixed-items-page';
		}

	}
				

	return $classes;

}

/**
 * Widget:
 * 	Before, After Widget wp_kses
 */
function dtportfolio_before_after_widget ( $content ) {
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
function dtportfolio_widget_title( $content ) {

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


/**
 * Configuring Widgets
 */

if( !function_exists('dtportfolio_register_sidebars_array') ) {
	function dtportfolio_register_sidebars_array( $sidebars ) {

		$layout = augury_get_option( 'portfolio-archives-page-layout' );
		$layout = !empty($layout) ? $layout : 'content-full-width';

		$show_archive_standard_sidebar = augury_get_option( 'portfolio-archives-show-standard-sidebar' );

		if( isset( $show_archive_standard_sidebar ) && !empty( $show_archive_standard_sidebar ) ) {

			if($layout == 'with-left-sidebar') {
				$sidebars['custom-post-portfolio-archives-sidebar-left'] = esc_html__('Portfolio Archives | Left Sidebar', 'augury');
			} else if($layout == 'with-right-sidebar') {
				$sidebars['custom-post-portfolio-archives-sidebar-right'] = esc_html__('Portfolio Archives | Right Sidebar', 'augury');
			}

		}
		
		return $sidebars;

	}
	
	add_filter('dttheme_register_sidebars_array', 'dtportfolio_register_sidebars_array');
}

?>