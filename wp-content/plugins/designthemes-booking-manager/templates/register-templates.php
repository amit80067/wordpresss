<?php
if (! class_exists ( 'DTBookingManagerTemplates' )) {

	class DTBookingManagerTemplates {

		function __construct() {

			add_action( 'init', array(
				$this,
				'dt_booking_add_image_sizes'
			) );

			add_filter ( 'template_include', array (
				$this,
				'dt_booking_template_include'
			) );
		}

		function dt_booking_add_image_sizes() {

			$pwidth = dt_booking_cs_get_option('person-img-width', 205);
			$phight = dt_booking_cs_get_option('person-img-height', 205);

			$swidth = dt_booking_cs_get_option('service-img-width', 205);
			$shight = dt_booking_cs_get_option('service-img-height', 205);

			$apwidth = dt_booking_cs_get_option('archive-person-img-width', 420);
			$aphight = dt_booking_cs_get_option('archive-person-img-height', 420);

			add_image_size( 'dt-bm-person-type2', $pwidth, $phight, array( 'center', 'top' ) );
			add_image_size( 'dt-bm-service-type2', $swidth, $shight, array( 'center', 'top' ) );
			add_image_size( 'dt-bm-archive-person', $apwidth, $aphight, array( 'center', 'top' ) );
		}

		function dt_booking_template_include( $template ) {

			$post_type = get_post_type();

			$file = '';
			$find = array();

			if ( is_post_type_archive( 'dt_service' ) ) {
				$file = 'archive-service.php';
				$find[] = $file;
				$find[] = DTBOOKINGMANAGER_PATH . '/' . $file;
			} else if ( is_post_type_archive( 'dt_person' ) ) {
				$file = 'archive-person.php';
				$find[] = $file;
				$find[] = DTBOOKINGMANAGER_PATH . '/' . $file;
			} else if ( is_singular('dt_service') ) {
				$file = 'single-service.php';
				$find[] = $file;
				$find[] = DTBOOKINGMANAGER_PATH . '/' . $file;
			} else if ( is_singular('dt_person') ) {
				$file = 'single-person.php';
				$find[] = $file;
				$find[] = DTBOOKINGMANAGER_PATH . '/' . $file;
			} else if ( taxonomy_exists('dt_service_category') || taxonomy_exists('dt_person_department') ) {
				if ( is_tax( 'dt_service_category' ) ) {
					$file = 'taxonomy-category.php';
				} else if ( is_tax( 'dt_person_department' ) ) {
					$file = 'taxonomy-department.php';
				}
				$find[] = DTBOOKINGMANAGER_PATH . '/' . $file;
			}

			if ( $file ) {
				$find[] = DTBOOKINGMANAGER_PATH . '/' . $file;
				$dt_template = untrailingslashit( DTBOOKINGMANAGER_PATH ) . '/templates/' . $file;
				$template = locate_template( array_unique( $find ) );
				
				if ( !$template && file_exists( $dt_template ) ) {
					$template = $dt_template;
				}
			}

			return $template;
		}
	}
}