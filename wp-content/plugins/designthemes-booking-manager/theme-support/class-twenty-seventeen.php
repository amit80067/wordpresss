<?php
if( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'DTBookingManagerTwentySeventeen' ) ) {

	class DTBookingManagerTwentySeventeen {

		function __construct() {

			add_filter( 'body_class', array( $this, 'dt_booking_ts_body_class' ), 20 );

			add_filter( 'dt_booking_template_metabox_options', array( $this, 'dt_booking_ts_template_metabox_options'), 10, 1);

			add_action( 'wp_enqueue_scripts', array( $this, 'dt_booking_ts_enqueue_styles' ), 104 );

			add_action( 'dt_booking_before_main_content', array( $this, 'dt_booking_ts_before_main_content' ), 10 );
			add_action( 'dt_booking_after_main_content', array( $this, 'dt_booking_ts_after_main_content' ), 10 );

			add_action( 'dt_booking_before_content', array( $this, 'dt_booking_ts_before_content' ), 10 );
			add_action( 'dt_booking_after_content', array( $this, 'dt_booking_ts_after_content' ), 10 );
		}

		function dt_booking_ts_body_class( $classes ) {

			if ( is_singular( 'dt_service' ) || is_post_type_archive('dt_service') || is_tax ( 'dt_service_category' ) || is_singular( 'dt_person' ) || is_post_type_archive('dt_person') || is_tax ( 'dt_person_department' ) ) {

				$classes = array_diff( $classes, array( 'has-sidebar', 'page-one-column', 'page-two-column' ) );
				$page_layout = get_theme_mod( 'page_layout' );
				if ( 'one-column' === $page_layout ) {
					$classes[] = 'page page-one-column';
				}
			}

			return $classes;
		}		

		function dt_booking_ts_template_metabox_options( $options ) {

			foreach($options as $option_key => $option) {

				if($option['id'] == '_custom_page_options') {
					unset( $options[0] );
				}

				if($option['id'] == '_custom_page_side_options') {
					unset( $options[1] );
				}

				if($option['id'] == '_custom_post_options') {
					unset( $options[2] );
				}
			}

			return $options;
		}

		function dt_booking_ts_enqueue_styles() {

			wp_enqueue_style ( 'dt_booking-twentyseventeen', plugins_url ('designthemes-booking-manager') . '/css/twenty-seventeen.css' );

		}

		function dt_booking_ts_before_main_content() {	

			echo '<div class="wrap">';
			echo '	<div id="primary" class="content-area twentyseventeen">';
			echo '		<main id="main" class="site-main" role="main">';
		}

		function dt_booking_ts_after_main_content() {

			echo '		</main>';
			echo '	</div>';
			echo '</div>';
		}

		function dt_booking_ts_before_content() { ?>

			<header class="entry-header"><?php
				if ( is_singular( 'dt_service' ) || is_singular( 'dt_person' ) ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
					twentyseventeen_edit_link( get_the_ID() );				
				} else if ( is_tax ( 'dt_service_category' ) || is_tax ( 'dt_person_department' ) || is_post_type_archive('dt_service') || is_post_type_archive('dt_person')  ) {
					the_archive_title( '<h1 class="page-title">', '</h1>' );
				} ?>
			</header><?php

			$additional_cls = '';
			if (is_singular( 'dt_service' )) {
				$additional_cls = 'dt_service-single';
			} elseif (is_singular( 'dt_person' )) {
				$additional_cls = 'dt_person-single';
			}

			global $post;
			echo '<article id="post-'.$post->ID.'" class="'.implode(' ', get_post_class($additional_cls)).'">';
		}

		function dt_booking_ts_after_content() {
			echo '</article>';
		}

	}

	new DTBookingManagerTwentySeventeen();
}