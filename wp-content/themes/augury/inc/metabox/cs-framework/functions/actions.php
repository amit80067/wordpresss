<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'dtm_get_icons' ) ) {
  function dtm_get_icons() {

    do_action( 'dtm_add_icons_before' );

    $jsons = apply_filters( 'dtm_add_icons_json', glob( DTM_DIR . '/fields/icon/*.json' ) );

    if( ! empty( $jsons ) ) {

      foreach ( $jsons as $path ) {

        $object = dtm_get_icon_fonts( 'fields/icon/'. basename( $path ) );

        if( is_object( $object ) ) {

          echo ( count( $jsons ) >= 2 ) ? '<h4 class="cs-icon-title">'. $object->name .'</h4>' : '';

          foreach ( $object->icons as $icon ) {
            echo '<a class="cs-icon-tooltip" data-cs-icon="'. $icon .'" data-title="'. $icon .'"><span class="cs-icon cs-selector"><i class="'. $icon .'"></i></span></a>';
          }

        } else {
          echo '<h4 class="cs-icon-title">'. esc_html__( 'Error! Can not load json file.', 'augury' ) .'</h4>';
        }

      }

    }

    do_action( 'dtm_add_icons' );
    do_action( 'dtm_add_icons_after' );

    die();
  }
  add_action( 'wp_ajax_cs-get-icons', 'dtm_get_icons' );
}

/**
 *
 * Set icons for wp dialog
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'dtm_set_icons' ) ) {
  function dtm_set_icons() {

    echo '<div id="cs-icon-dialog" class="cs-dialog" title="'. esc_attr__( 'Add Icon', 'augury' ) .'">';
    echo '<div class="cs-dialog-header cs-text-center"><input type="text" placeholder="'. esc_attr__( 'Search a Icon...', 'augury' ) .'" class="cs-icon-search" /></div>';
    echo '<div class="cs-dialog-load"><div class="cs-icon-loading">'. esc_html__( 'Loading...', 'augury' ) .'</div></div>';
    echo '</div>';

  }
  add_action( 'admin_footer', 'dtm_set_icons' );
  add_action( 'customize_controls_print_footer_scripts', 'dtm_set_icons' );
}
