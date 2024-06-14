<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Framework admin enqueue style and scripts
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'dtm_admin_enqueue_scripts' ) ) {
  function dtm_admin_enqueue_scripts() {

    // admin utilities
    wp_enqueue_media();

    // wp core styles
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'wp-jquery-ui-dialog' );

    // framework core styles
    wp_enqueue_style( 'augury', DTM_URI .'/assets/css/cs-framework.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'font-awesome', DTM_URI .'/assets/css/font-awesome.css', array(), '4.7.0', 'all' );

    if ( DTM_ACTIVE_LIGHT_THEME ) {
      wp_enqueue_style( 'dtm-framework-theme', DTM_URI .'/assets/css/cs-framework-light.css', array(), "1.0.0", 'all' );
    }

    if ( is_rtl() ) {
      wp_enqueue_style( 'dtm-framework-rtl', DTM_URI .'/assets/css/cs-framework-rtl.css', array(), '1.0.0', 'all' );
    }

    // wp core scripts
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 'jquery-ui-dialog' );
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'jquery-ui-accordion' );

    // framework core scripts
    wp_enqueue_script( 'dtm-plugins',    DTM_URI .'/assets/js/cs-plugins.js',    array(), '1.0.0', true );
    wp_enqueue_script( 'augury',  DTM_URI .'/assets/js/cs-framework.js',  array( 'dtm-plugins' ), '1.0.0', true );

  }
  add_action( 'admin_enqueue_scripts', 'dtm_admin_enqueue_scripts' );
}
