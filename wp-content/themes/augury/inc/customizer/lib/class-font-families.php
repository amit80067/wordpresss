<?php
/**
 * Augury Font Families
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Augury_Font_Families' ) ) {

	class Augury_Font_Families {

		public static function get_system_fonts() {

			$fonts = array(
				'Helvetica' => array(
					'fallback' => 'Verdana, Arial, sans-serif',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
				'Verdana'   => array(
					'fallback' => 'Helvetica, Arial, sans-serif',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
				'Arial'     => array(
					'fallback' => 'Helvetica, Verdana, sans-serif',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
				'Times'     => array(
					'fallback' => 'Georgia, serif',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
				'Georgia'   => array(
					'fallback' => 'Times, serif',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
				'Courier'   => array(
					'fallback' => 'monospace',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
			);

			return $fonts;
		}

		public static function get_custom_fonts() {

			$font_final = array ();

			$font1 = array ();
			$font1_name = augury_get_option( 'custom-font1-name' );
			if( !empty( $font1_name ) ) {
				$font1 = array(
					$font1_name => array(
						'fallback' => $font1_name,
						'weights'  => array(
							'300',
							'400',
							'700',
						),
					),
				);
				$font_final = array_merge( $font_final, $font1 );
			}

			$font2 = array ();
			$font2_name = augury_get_option( 'custom-font2-name' );
			if( !empty( $font2_name ) ) {
				$font2 = array(
					$font2_name => array(
						'fallback' => $font2_name,
						'weights'  => array(
							'300',
							'400',
							'700',
						),
					),
				);
				$font_final = array_merge( $font_final, $font2 );
			}

			return $font_final;
		}

		public static function get_google_fonts() {
			$fonts = array();

			#$google_fonts_file = AUGURY_DIR . '/inc/customizer/assets/json/google-fonts.json';
			$google_fonts_file = AUGURY_DIR . '/inc/customizer/assets/json/google-fonts-1.json';

			if( !file_exists( $google_fonts_file ) ) {

				return $fonts;
			}

			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once( ABSPATH . '/wp-admin/includes/file.php' );
				WP_Filesystem();
			}

			$file_contants     = $wp_filesystem->get_contents( $google_fonts_file );
			$google_fonts_json = json_decode( $file_contants, 1 );

			foreach ( $google_fonts_json as $key => $font ) {

				$name = key( $font );

				foreach ( $font[ $name ] as $font_key => $single_font ) {

					if ( 'variants' === $font_key ) {

						foreach ( $single_font as $variant_key => $variant ) {

							if ( stristr( $variant, 'italic' ) ) {
								unset( $font[ $name ][ $font_key ][ $variant_key ] );
							}

							if ( 'regular' == $variant ) {
								$font[ $name ][ $font_key ][ $variant_key ] = '400';
							}
						}
					}

					$fonts[ $name ] = array_values( $font[ $name ] );
				}
			}

			return $fonts;
		}

		public static function get_subset( $font_family ) {
			$subset = array();

			$google_fonts_file = AUGURY_DIR . '/inc/customizer/assets/json/google-fonts-1.json';								

			if( !file_exists( $google_fonts_file ) ) {

				return $fonts;
			}

			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once( ABSPATH . '/wp-admin/includes/file.php' );
				WP_Filesystem();
			}

			$file_contants     = $wp_filesystem->get_contents( $google_fonts_file );
			$google_fonts_json = json_decode( $file_contants, 1 );

			foreach ( $google_fonts_json as $key => $font ) {

				$name = key( $font );
				if( $name == $font_family ) {

					$values = array_values( $font[ $name ] );
					$subset = isset( $values[2] ) ? $values[2] : $subset;
				}
			}

			return $subset;
		}
	}
}