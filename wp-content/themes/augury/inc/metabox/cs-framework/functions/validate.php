<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Email validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'dtm_validate_email' ) ) {
  function dtm_validate_email( $value, $field ) {

    if ( ! sanitize_email( $value ) ) {
      return esc_html__( 'Please write a valid email address!', 'augury' );
    }

  }
  add_filter( 'dtm_validate_email', 'dtm_validate_email', 10, 2 );
}

/**
 *
 * Numeric validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'dtm_validate_numeric' ) ) {
  function dtm_validate_numeric( $value, $field ) {

    if ( ! is_numeric( $value ) ) {
      return esc_html__( 'Please write a numeric data!', 'augury' );
    }

  }
  add_filter( 'dtm_validate_numeric', 'dtm_validate_numeric', 10, 2 );
}

/**
 *
 * Required validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'dtm_validate_required' ) ) {
  function dtm_validate_required( $value ) {
    if ( empty( $value ) ) {
      return esc_html__( 'Fatal Error! This field is required!', 'augury' );
    }
  }
  add_filter( 'dtm_validate_required', 'dtm_validate_required' );
}
