<?php
if( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'DTBookingManagerDefault' ) ) {

	class DTBookingManagerDefault {

		function __construct() {

			add_filter( 'body_class', array( $this, 'dt_booking_default_body_class' ), 20 );

			add_filter( 'dt_booking_template_metabox_options', array( $this, 'dt_booking_default_template_metabox_options'), 10, 1);

			add_action( 'wp_enqueue_scripts', array( $this, 'dt_booking_default_enqueue_styles' ), 104 );

			add_action( 'dt_booking_before_main_content', array( $this, 'dt_booking_default_before_main_content' ), 10 );
			add_action( 'dt_booking_after_main_content', array( $this, 'dt_booking_default_after_main_content' ), 10 );

			add_action( 'dt_booking_before_content', array( $this, 'dt_booking_default_before_content' ), 10 );
			add_action( 'dt_booking_after_content', array( $this, 'dt_booking_default_after_content' ), 10 );
		}

		function dt_booking_default_body_class( $classes ) {

			return $classes;

		}

		function dt_booking_default_template_metabox_options($options) {

			return $options;

		}

		function dt_booking_default_enqueue_styles() {

			wp_enqueue_style ( 'dt_booking-default', plugins_url ('designthemes-booking-manager') . '/css/default.css' );

		} 

		function dt_booking_default_before_main_content() {	

			echo '';

		}

		function dt_booking_default_after_main_content() {

			echo '';

		}

		function dt_booking_default_before_content() {

			$additional_cls = '';
			if (is_singular( 'dt_service' )) {
				$additional_cls = 'dt_service-single';
			} elseif (is_singular( 'dt_person' )) {
				$additional_cls = 'dt_person-single';
			}

			global $post;
			echo '<article id="post-'.$post->ID.'" class="'.implode(' ', get_post_class($additional_cls)).'">';

		}

		function dt_booking_default_after_content() {
			echo '</article>';
		}

	}

	new DTBookingManagerDefault();
}