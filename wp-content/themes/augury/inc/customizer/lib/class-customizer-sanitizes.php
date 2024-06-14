<?php
/**
 * Augury Theme Customizer Sanitizes
 * 
 * @link  https://divpusher.com/blog/wordpress-customizer-sanitization-examples
 */

if( !class_exists('Augury_Customizer_Sanitizes') ) {

	class Augury_Customizer_Sanitizes {

		private static $instance;

		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {

				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() { }

		/**
		 * Sanitize Select choices
		 *
		 * @param  string $input    setting input.
		 * @param  object $setting  setting object.
		 * @return mixed            setting input value.
		 */
		static public function sanitize_choices( $input, $setting ) {
			// Ensure input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
			$input = sanitize_key( $input );

			// Get list of choices from the control
			// associated with the setting.
			$choices = $setting->manager->get_control( $setting->id )->choices;

			// If the input is a valid key, return it;
			// otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
		}

		/**
		 * Sanitize Checkbox
		 *
		 * @param  string $input    setting input.
		 * @return mixed            setting input value.
		 */
		static public function sanitize_checkbox( $input ) {
			$output = false;

			if ( $input ) {
				$output = '1';
			}
			
			return $output;
		}

		/**
		 * Sanitize Multiple Select choices
		 *
		 * @param  string $input    setting input.
		 * @param  object $setting  setting object.
		 * @return mixed            setting input value.
		 */
		static public function sanitize_multi_choices( $input, $setting ) {
			// Get list of choices from the control
			// associated with the setting.
			$choices    = $setting->manager->get_control( $setting->id )->choices;
			
			$input_keys = $input;

			foreach ( $input_keys as $key => $value ) {
				if ( ! array_key_exists( $value, $choices ) ) {
					unset( $input[ $key ] );
				}
			}

			// If the input is a valid key, return it;
			// otherwise, return the default.
			return ( is_array( $input ) ? $input : $setting->default );			
		}

		/**
		 * Sanitize html
		 *
		 * @param  string $input    setting input.
		 * @return mixed            setting input value.
		 */
		static public function sanitize_html( $input ) {
			return wp_kses_post( $input );
		}

		/**
		 * Sanitize Integer
		 *
		 * @param  number $val Customizer setting input number.
		 * @return number        Return number.
		 */
		static public function sanitize_number_n_blank( $val ) {
			return is_numeric( $val ) ? $val : '';
		}

		/**
		 * Sanitize Integer
		 *
		 * @param  number $val      Customizer setting input number.
		 * @param  object $setting  Setting object.
		 * @return number           Return number.
		 */
		static public function sanitize_number( $val, $setting ) {
			$input_attrs = $setting->manager->get_control( $setting->id )->input_attrs;

			if ( isset( $input_attrs ) ) {

				$input_attrs['min']  = isset( $input_attrs['min'] ) ? $input_attrs['min'] : 0;
				$input_attrs['step'] = isset( $input_attrs['step'] ) ? $input_attrs['step'] : 1;

				if ( isset( $input_attrs['max'] ) && $val > $input_attrs['max'] ) {
					$val = $input_attrs['max'];
				} elseif ( $val < $input_attrs['min'] ) {
					$val = $input_attrs['min'];
				}

						$dv = $val / $input_attrs['step'];

						$dv = round( $dv );

						$val = $dv * $input_attrs['step'];

					$val = number_format( (float) $val, 2, '.', '' );
				if ( $val == (int) $val ) {
					$val = (int) $val;
				}
			}

			return is_numeric( $val ) ? $val : 0;
		}		

		/**
		 * Sanitize Responsive Slider
		 *
		 * @param  array|number $val Customizer setting input number.
		 * @param  object       $setting Setting Object.
		 * @return array        Return number.
		 */
		static public function sanitize_responsive_slider( $val, $setting ) {
			$input_attrs = array();
			if ( isset( $setting->manager->get_control( $setting->id )->input_attrs ) ) {
				$input_attrs = $setting->manager->get_control( $setting->id )->input_attrs;
			}

			$responsive = array(
				'desktop'          => '',
				'tablet'           => '',
				'tablet-landscape' => '',
				'mobile'           => '',
			);
			if ( is_array( $val ) ) {
				$responsive['desktop']          = is_numeric( $val['desktop'] ) ? $val['desktop'] : '';
				$responsive['tablet']           = is_numeric( $val['tablet'] ) ? $val['tablet'] : '';
				$responsive['tablet-landscape'] = is_numeric( $val['tablet-landscape'] ) ? $val['tablet-landscape'] : '';
				$responsive['mobile']           = is_numeric( $val['mobile'] ) ? $val['mobile'] : '';
			} else {
				$responsive['desktop'] = is_numeric( $val ) ? $val : '';
			}

			foreach ( $responsive as $key => $value ) {
					$value              = isset( $input_attrs['min'] ) && ( ! empty( $value ) ) && ( $input_attrs['min'] > $value ) ? $input_attrs['min'] : $value;
					$value              = isset( $input_attrs['max'] ) && ( ! empty( $value ) ) && ( $input_attrs['max'] < $value ) ? $input_attrs['max'] : $value;
					$responsive[ $key ] = $value;
			}

			return $responsive;
		}		

		/**
		 * Sanitize Responsive Number
		 *
		 * @param  array|number $val Customizer setting input number.
		 * @return array        Return number.
		 */
		static public function sanitize_responsive_number( $val ) {
			$responsive = array(
				'desktop'          => '',
				'tablet'           => '',
				'tablet-landscape' => '',
				'mobile'           => '',
				'desktop-unit'     => '',
				'tablet-unit'      => '',
				'tablet-ls-unit'   => '',
				'mobile-unit'      => '',
			);

			if ( is_array( $val ) ) {
				$responsive['desktop']          = is_numeric( $val['desktop'] ) ? $val['desktop'] : '';
				$responsive['tablet']           = is_numeric( $val['tablet'] ) ? $val['tablet'] : '';
				$responsive['tablet-landscape'] = is_numeric( $val['tablet-landscape'] ) ? $val['tablet-landscape'] : '';
				$responsive['mobile']           = is_numeric( $val['mobile'] ) ? $val['mobile'] : '';
				$responsive['desktop-unit']     = in_array( $val['desktop-unit'], array( '', 'px', 'em', 'rem', '%' ) ) ? $val['desktop-unit'] : 'px';
				$responsive['tablet-unit']      = in_array( $val['tablet-unit'], array( '', 'px', 'em', 'rem', '%' ) ) ? $val['tablet-unit'] : 'px';
				$responsive['tablet-ls-unit']   = in_array( $val['tablet-ls-unit'], array( '', 'px', 'em', 'rem', '%' ) ) ? $val['tablet-ls-unit'] : 'px';
				$responsive['mobile-unit']      = in_array( $val['mobile-unit'], array( '', 'px', 'em', 'rem', '%' ) ) ? $val['mobile-unit'] : 'px';
			} else {
				$responsive['desktop'] = is_numeric( $val ) ? $val : '';
			}

			return $responsive;			
		}

		/**
		 * Sanitize responsive Spacing
		 *
		 * @param  number $val Customizer setting input number.
		 * @return number        Return number.
		 */
		static public function sanitize_responsive_spacing( $val ) {
			$spacing = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet-landscape' => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),				
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit'   => 'px',
				'tablet-unit'    => 'px',
				'tablet-ls-unit' => 'px',
				'mobile-unit'    => 'px',
			);

			if ( isset( $val['desktop'] ) ) {
				$spacing['desktop'] = array_map(
					function ( $value ) {
							return ( is_numeric( $value ) && $value >= 0 ) ? $value : '';
					}, $val['desktop']
				);

				$spacing['tablet'] = array_map(
					function ( $value ) {
							return ( is_numeric( $value ) && $value >= 0 ) ? $value : '';
					}, $val['tablet']
				);

				$spacing['tablet-landscape'] = array_map(
					function ( $value ) {
							return ( is_numeric( $value ) && $value >= 0 ) ? $value : '';
					}, $val['tablet-landscape']
				);				

				$spacing['mobile'] = array_map(
					function ( $value ) {
							return ( is_numeric( $value ) && $value >= 0 ) ? $value : '';
					}, $val['mobile']
				);

				if ( isset( $val['desktop-unit'] ) ) {
					$spacing['desktop-unit'] = $val['desktop-unit'];
				}

				if ( isset( $val['tablet-unit'] ) ) {
					$spacing['tablet-unit'] = $val['tablet-unit'];
				}

				if ( isset( $val['tablet-ls-unit'] ) ) {
					$spacing['tablet-ls-unit'] = $val['tablet-ls-unit'];
				}				

				if ( isset( $val['mobile-unit'] ) ) {
					$spacing['mobile-unit'] = $val['mobile-unit'];
				}

				return $spacing;
			} else {
				foreach ( $val as $key => $value ) {
					$val[ $key ] = is_numeric( $val[ $key ] ) ? $val[ $key ] : '';
				}

				return $val;
			}
		}

		/**
		 * Sanitize Spacing
		 *
		 * @param  number $val Customizer setting input number.
		 * @return number        Return number.
		 */
		static public function sanitize_spacing( $val ) {
			$spacing = array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
				'unit'   => 'px',
			);

			if( isset( $val['top'] ) ) {
				$top            = $val['top'];
				$spacing['top'] =  ( is_numeric( $top ) && $top >= 0 ) ? $top : '';
			}

			if( isset( $val['right'] ) ) {
				$right            = $val['right'];
				$spacing['right'] =  ( is_numeric( $right ) && $right >= 0 ) ? $right : '';
			}

			if( isset( $val['bottom'] ) ) {
				$bottom            = $val['bottom'];
				$spacing['bottom'] =  ( is_numeric( $bottom ) && $bottom >= 0 ) ? $bottom : '';
			}

			if( isset( $val['left'] ) ) {
				$left            = $val['left'];
				$spacing['left'] =  ( is_numeric( $left ) && $left >= 0 ) ? $left : '';
			}									

			if ( isset( $val['unit'] ) ) {
				$spacing['unit'] = $val['unit'];
			}

			return $spacing;
		}

		/**
		 * Sanitize Spacing
		 *
		 * @param  number $val Customizer setting input number.
		 * @return number        Return number.
		 */
		static public function sanitize_border_radius( $val ) {
			$border_radius = array(
				'tl'    => '',
				'tr'  => '',
				'br' => '',
				'bl'   => '',
				'unit'   => 'px',
			);

			if( isset( $val['tl'] ) ) {
				$tl            = $val['tl'];
				$border_radius['tl'] =  ( is_numeric( $tl ) && $tl >= 0 ) ? $tl : '';
			}

			if( isset( $val['tr'] ) ) {
				$tr            = $val['tr'];
				$border_radius['tr'] =  ( is_numeric( $tr ) && $tr >= 0 ) ? $tr : '';
			}

			if( isset( $val['br'] ) ) {
				$br            = $val['br'];
				$border_radius['br'] =  ( is_numeric( $br ) && $br >= 0 ) ? $br : '';
			}

			if( isset( $val['bl'] ) ) {
				$bl            = $val['bl'];
				$border_radius['bl'] =  ( is_numeric( $bl ) && $bl >= 0 ) ? $bl : '';
			}									

			if ( isset( $val['unit'] ) ) {
				$border_radius['unit'] = $val['unit'];
			}

			return $border_radius;
		}		

		/**
		 * Sanitize HEX color
		 *
		 * @param  string $color setting input.
		 * @return string        setting input value.
		 */
		static public function sanitize_hex_color( $color ) {
			if ( '' === $color ) {
				return '';
			}

			// 3 or 6 hex digits, or the empty string.
			if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
				return $color;
			}

			return '';
		}

		/**
		 * Sanitize Alpha color
		 *
		 * @param  string $color setting input.
		 * @return string        setting input value.
		 */
		static public function sanitize_alpha_color( $color ) {
			if ( '' === $color ) {
				return '';
			}

			if ( false === strpos( $color, 'rgba' ) ) {
				/* Hex sanitize */
				return self::sanitize_hex_color( $color );
			}

			/* rgba sanitize */
			$color = str_replace( ' ', '', $color );
			sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
			return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
		}

		/**
		 * Sanitize Background Obj
		 *
		 * @param  mixed $bg_obj setting input.
		 * @return array        setting input value.
		 */
		static public function sanitize_background_obj( $bg_obj ) {
			$out_bg_obj = array(
				'background-color'      => '',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
			);

			if ( is_array( $bg_obj ) ) {

				foreach ( $out_bg_obj as $key => $value ) {

					if ( isset( $bg_obj[ $key ] ) ) {

						if ( 'background-image' === $key ) {
							$out_bg_obj[ $key ] = esc_url_raw( $bg_obj[ $key ] );
						} else {
							$out_bg_obj[ $key ] = esc_attr( $bg_obj[ $key ] );
						}
					}
				}
			}

			return $out_bg_obj;
		}

		/**
		 * Sanitize Tweek
		 *
		 * @param  string $color setting input.
		 * @return string        setting input value.
		 */
		static public function sanitize_tweek( $value ) {

			return $value;
		}												
	}
}

Augury_Customizer_Sanitizes::get_instance();