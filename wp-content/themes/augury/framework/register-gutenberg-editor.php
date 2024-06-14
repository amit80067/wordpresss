<?php
if ( ! class_exists( 'Gutenberg_Editor_CSS' ) ) :

	class Gutenberg_Editor_CSS {

		private static $instance;

		public $google_fonts = array();
		public static $google_fonts_url;

		public static function get_instance() {

			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}

			return self::$instance;

		}			

		function __construct() {

			add_action('after_setup_theme', array( $this,  'augury_after_setup_theme' ) );

			add_action( 'enqueue_block_editor_assets', array( $this, 'augury_backend_block_styles' ) );
			if ( class_exists( 'Classic_Editor' ) ) {
				add_filter( 'tiny_mce_before_init', array( $this, 'augury_backend_tiny_mce_styles' ) );
			}

			add_action( 'admin_enqueue_scripts', array( $this, 'augury_backend_editor_fonts' ) );
			add_action( 'current_screen', array( $this,  'augury_current_screen_hook' ) );	
			add_action( 'wp_enqueue_scripts', array( $this, 'augury_editor_enqueue_styles'), 110 );

		}

		function augury_after_setup_theme() {

			# Gutenberg Compatible
			add_theme_support( 'align-wide' );
			add_theme_support( 'wp-block-styles' );
			add_theme_support( 'editor-styles' );
				
			# Add support for responsive embedded content.
			add_theme_support( 'responsive-embeds' );

			# Theme Color Palette
			add_theme_support( 'editor-color-palette', array(
				array(
					'name' => esc_html__( 'Primary Color', 'augury' ),
					'slug' => 'primary',
					'color' => augury_get_option( 'primary-color' ),
				),
				array(
					'name' => esc_html__( 'Secondary Color', 'augury' ),
					'slug' => 'secondary',
					'color' => augury_get_option( 'secondary-color' ),
				),
				array(
					'name' => esc_html__( 'Tertiary Color', 'augury' ),
					'slug' => 'tertiary',
					'color' => augury_get_option( 'tertiary-color' ),
				)
			));

		}

		function font_all_items_callback( $option ) {

			$css = '';

			if( isset( $option['font-fallback'] ) && !empty( $option['font-fallback'] ) ) {
				$css .= 'font-family:'.$option['font-fallback'].';';
			}

			if( isset( $option['font-weight'] ) && !empty( $option['font-weight'] ) ) {
				$css .= 'font-weight:'.$option['font-weight'].';';
			}

			if( isset( $option['font-style'] ) && !empty( $option['font-style'] ) ) {
				$css .= 'font-style:'.$option['font-style'].';';
			}

			if( isset( $option['text-transform'] ) && !empty( $option['text-transform'] ) ) {
				$css .= 'text-transform:'.$option['text-transform'].';';
			}

			if( isset( $option['text-align'] ) && !empty( $option['text-align'] ) ) {
				$css .= 'text-align:'.$option['text-align'].';';
			}

			if( isset( $option['text-decoration'] ) && !empty( $option['text-decoration'] ) ) {
				$css .= 'text-decoration:'.$option['text-decoration'].';';
			}

			if( isset( $option['fs-desktop'] ) && !empty( $option['fs-desktop'] ) ) {
				$css .= 'font-size:'.$option['fs-desktop'].$option['fs-desktop-unit'].';';
			}

			if( isset( $option['lh-desktop'] ) && !empty( $option['lh-desktop'] ) ) {
				$css .= 'line-height:'.$option['lh-desktop'].'px;';
			}

			if( isset( $option['ls-desktop'] ) && !empty( $option['ls-desktop'] ) ) {
				$css .= 'letter-spacing:'.$option['ls-desktop'].$option['ls-desktop-unit'].';';
			}			

			return $css;

		}

		function font_text_decoration_callback( $option ) {

			$css = '';

			if( isset( $option['text-decoration'] ) && !empty( $option['text-decoration'] ) ) {
				$css .= 'text-decoration:'.$option['text-decoration'].';';
			}	

			return $css;

		}

		function font_line_height_callback( $option ) {

			$css = '';

			if( isset( $option['lh-desktop'] ) && !empty( $option['lh-desktop'] ) ) {
				$css .= 'line-height:'.$option['lh-desktop'].'px;';
			}

			return $css;

		}

		function augury_generate_editor_styles( $editor_type = 'block' ) {
			
			if($editor_type == 'tinymce') {
				$wrapper_class = 'body#tinymce.wp-editor.content';
				$header_wrapper_class = $wrapper_class;
				$header1_add_class = '';
				$new_line = '';
			} else {
				$wrapper_class = '.editor-styles-wrapper';
				$header_wrapper_class = $wrapper_class.' .wp-block';
				$header1_add_class = '.editor-post-title__block .editor-post-title__input, ';
				$new_line = "\n";
			}


			$styles = '';

			$styles .= $wrapper_class.' pre { font-family:monospace; }'.$new_line;


			$body_typo =  augury_get_option( 'body-typo' );
			
			$body_css  =  $this->font_all_items_callback( $body_typo );
			if( !empty( $body_css ) ) {
				$styles .= $wrapper_class.' > *, '.$wrapper_class.' .wp-block-preformatted pre {'.$body_css.'}'.$new_line;
			}

			$body_td_css  =  $this->font_text_decoration_callback( $body_typo );
			if( !empty( $body_td_css ) ) {
				$styles .= $wrapper_class.' p {'.$body_td_css.'}'.$new_line;
			}

			$body_lh_css  =  $this->font_line_height_callback( $body_typo );
			if( !empty( $body_lh_css ) ) {
				$styles .= $wrapper_class.' .wp-block-pullquote blockquote, '.$wrapper_class.' .wp-block-pullquote blockquote p {'.$body_lh_css.'}'.$new_line;
			}

			$body_bg_color = augury_get_option( 'body-bg-color' );
			if( !empty( $body_bg_color ) ) {
				$styles .= $wrapper_class.' { background-color: '.$body_bg_color.'; } '.$new_line;
			}

			$body_content_color = augury_get_option( 'body-content-color' );
			if( !empty( $body_content_color ) ) {
				$styles .= $wrapper_class.' > *, '.$wrapper_class.' pre { color: '.$body_content_color.'; } '.$new_line;	
			}

			$body_content_a_color = augury_get_option( 'body-content-link-color' );
			if( !empty( $body_content_a_color ) ) {
				$styles .= $wrapper_class.' a { color: '.$body_content_a_color.'; } '.$new_line;
			}

			$body_content_a_hover_color = augury_get_option( 'body-content-link-hover-color' );
			if( !empty( $body_content_a_hover_color ) ) {
				$styles .= $wrapper_class.' a:focus, '.$wrapper_class.' a:hover { color: '.$body_content_a_hover_color.'; } '.$new_line;					
			}


			for( $i = 1; $i <= 6; $i++ ) {

				if($i == 1) {
					$header_wrapper_final_class = $header1_add_class.$header_wrapper_class;
				} else {
					$header_wrapper_final_class = $header_wrapper_class;
				}

				$heading_typo = augury_get_option( 'h'.$i.'-typo' );
				$heading_color = augury_get_option( 'h'.$i.'-color' );

				$heading_tag_css = $this->font_all_items_callback( $heading_typo );
				$heading_tag_css .= !empty( $heading_color ) ? 'color:'.$heading_color.';' : '';

				$styles .= $header_wrapper_final_class.' h'.$i.' { '.$heading_tag_css.' }'.$new_line;

			}

			
			return $styles;

		}

		function augury_backend_block_styles() {

			$css = $this->augury_generate_editor_styles('block');

			# Custom Font
				$css .= $this->enqueue_custom_fonts();

			wp_enqueue_style( 'augury-gutenberg', get_theme_file_uri('/css/admin-gutenberg.css'), false, AUGURY_VERSION, 'all' );

			if( !empty( $css ) ) {
				wp_add_inline_style( 'augury-gutenberg', $css );
			}

		}

		function augury_backend_tiny_mce_styles( $mceInit ) {

			$css = $this->augury_generate_editor_styles('tinymce');

			# Custom Font
				$css .= $this->enqueue_custom_fonts();

			if( !empty( $css ) ) {
				if ( isset( $mceInit['content_style'] ) ) {
					$mceInit['content_style'] .= ' ' . $css . ' ';
				} else {
					$mceInit['content_style'] = $css . ' ';
				}				
			}

			return $mceInit;

		}

		function augury_backend_editor_fonts( $hook ) {

			if( $hook == 'post-new.php' || $hook == 'post.php' ) {

				$this->backend_font_options();
				$this->enqueue_google_fonts();	
							
			}

		}

		function augury_current_screen_hook( $current_screen ) {

			if ( 'post' == $current_screen->base ) {

				$this->backend_font_options();
				$urls = $this->google_fonts_url();

				add_editor_style( $urls );

				$custom_fonts = $this->enqueue_custom_fonts();
				if(!empty($custom_font)) {
					add_editor_style( $custom_fonts );
				}

				add_editor_style( 'css/editor-style.css' );

			}

		}

		function backend_font_options() {

			# Body
				$body_typo =  augury_get_option( 'body-typo' );

				# Loading Google Font
				if( isset( $body_typo['font-type'] ) && $body_typo['font-type'] == 'google' ) {
					$weight = isset( $body_typo['font-weight'] ) ? ':'. $body_typo['font-weight'] : '';
					$this->google_fonts[] = $body_typo['font-family'] . $weight;
				}

			# H1
				$h1_typo =  augury_get_option( 'h1-typo' );

				# Loading Google Font
				if( isset( $h1_typo['font-type'] ) && $h1_typo['font-type'] == 'google' ) {
					$weight = isset( $h1_typo['font-weight'] ) ? ':'. $h1_typo['font-weight'] : '';
					$this->google_fonts[] = $h1_typo['font-family'] . $weight;
				}

			# H2
				$h2_typo =  augury_get_option( 'h2-typo' );
				
				# Loading Google Font
				if( isset( $h2_typo['font-type'] ) && $h2_typo['font-type'] == 'google' ) {
					$weight = isset( $h2_typo['font-weight'] ) ? ':'. $h2_typo['font-weight'] : '';
					$this->google_fonts[] = $h2_typo['font-family'] . $weight;
				}

			# H3
				$h3_typo =  augury_get_option( 'h3-typo' );
				
				# Loading Google Font
				if( isset( $h3_typo['font-type'] ) && $h3_typo['font-type'] == 'google' ) {
					$weight = isset( $h3_typo['font-weight'] ) ? ':'. $h3_typo['font-weight'] : '';
					$this->google_fonts[] = $h3_typo['font-family'] . $weight;
				}

			# H4
				$h4_typo =  augury_get_option( 'h4-typo' );
				
				# Loading Google Font
				if( isset( $h4_typo['font-type'] ) && $h4_typo['font-type'] == 'google' ) {
					$weight = isset( $h4_typo['font-weight'] ) ? ':'. $h4_typo['font-weight'] : '';
					$this->google_fonts[] = $h4_typo['font-family'] . $weight;
				}

			# H5
				$h5_typo =  augury_get_option( 'h5-typo' );
				
				# Loading Google Font
				if( isset( $h5_typo['font-type'] ) && $h5_typo['font-type'] == 'google' ) {
					$weight = isset( $h5_typo['font-weight'] ) ? ':'. $h5_typo['font-weight'] : '';
					$this->google_fonts[] = $h5_typo['font-family'] . $weight;
				}

			# H6
				$h6_typo =  augury_get_option( 'h6-typo' );
				
				# Loading Google Font
				if( isset( $h6_typo['font-type'] ) && $h6_typo['font-type'] == 'google' ) {
					$weight = isset( $h6_typo['font-weight'] ) ? ':'. $h6_typo['font-weight'] : '';
					$this->google_fonts[] = $h6_typo['font-family'] . $weight;
				}	

		}

		function enqueue_google_fonts() {

			$subset = apply_filters( 'dt_theme_google_font_supsets', 'latin-ext' );
			$fonts = array_filter( $this->google_fonts );

			foreach( $fonts as $font ) {

				$font = str_replace( ' ', '+', $font );
				$font = explode( ":", $font );
				
				$url = '//fonts.googleapis.com/css?family=' . $font[0].':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
				$url .= !empty( $subset ) ? '&subset=' . $subset : '';

				$key = md5( $font[0] . $subset );				

				// check that the URL is valid. we're going to use transients to make this faster.
				$url_is_valid = get_transient( $key );

				// transient does not exist				
				if ( false === $url_is_valid ) { 
					$response = wp_remote_get( 'https:' . $url );
					if ( ! is_array( $response ) ) {
						// the url was not properly formatted,
						// cache for 12 hours and continue to the next field
						set_transient( $key, null, 12 * HOUR_IN_SECONDS );
						continue;
					}

					// check the response headers.
					if ( isset( $response['response'] ) && isset( $response['response']['code'] ) ) {
						if ( 200 == $response['response']['code'] ) {
							// URL was ok
							// set transient to true and cache for a week
							set_transient( $key, true, 7 * 24 * HOUR_IN_SECONDS );
							$url_is_valid = true;
						}
					}
				}

				// If the font-link is valid, enqueue it.
				if ( $url_is_valid ) {
					wp_enqueue_style( $key, $url, null, null );
				}
			}

		}

		function google_fonts_url() {

			$subset = apply_filters( 'dt_theme_google_font_supsets', 'latin-ext' );
			$fonts  = array_filter( $this->google_fonts );
			$urls   = array();

			foreach( $fonts as $font ) {

				$font = str_replace( ' ', '+', $font );
				$font = explode( ":", $font );
				
				$url = '//fonts.googleapis.com/css?family=' . $font[0].':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
				$url .= !empty( $subset ) ? '&subset=' . $subset : '';

				$key = md5( $font[0] . $subset );				

				// check that the URL is valid. we're going to use transients to make this faster.
				$url_is_valid = get_transient( $key );

				// transient does not exist				
				if ( false === $url_is_valid ) { 
					$response = wp_remote_get( 'https:' . $url );
					if ( ! is_array( $response ) ) {
						// the url was not properly formatted,
						// cache for 12 hours and continue to the next field
						set_transient( $key, null, 12 * HOUR_IN_SECONDS );
						continue;
					}

					// check the response headers.
					if ( isset( $response['response'] ) && isset( $response['response']['code'] ) ) {
						if ( 200 == $response['response']['code'] ) {
							// URL was ok
							// set transient to true and cache for a week
							set_transient( $key, true, 7 * 24 * HOUR_IN_SECONDS );
							$url_is_valid = true;
						}
					}
				}

				// If the font-link is valid, enqueue it.
				if ( $url_is_valid ) {
					$urls[] = $url;
				}
			}

			return array_unique( $urls );

		}

		function enqueue_custom_fonts() {

			$css = '';

			$font1_name = augury_get_option( 'custom-font1-name' );
			if( !empty ( $font1_name ) ){

				$font1_woff = augury_get_option( 'custom-font1-woff' );
				$font1_woff2 = augury_get_option( 'custom-font1-woff2' );

				$css .= '@font-face {';
					$css .= 'font-family: "'. $font1_name .'";';
					$css .= 'src: url("'. $font1_woff .'") format("woff"),';
						$css .= 'url("'. $font1_woff2 .'") format("woff2");';
					$css .= 'font-weight: normal;';
					$css .= 'font-style: normal;';
				$css .= '}';
			}

			$font2_name = augury_get_option( 'custom-font2-name' );
			if( !empty ( $font2_name ) ){

				$font2_woff = augury_get_option( 'custom-font2-woff' );
				$font2_woff2 = augury_get_option( 'custom-font2-woff2' );

				$css .= '@font-face {';
					$css .= 'font-family: "'. $font2_name .'";';
					$css .= 'src: url("'. $font2_woff .'") format("woff"),';
						$css .= 'url("'. $font2_woff2 .'") format("woff2");';
					$css .= 'font-weight: normal;';
					$css .= 'font-style: normal;';
				$css .= '}';
			}

			return $css;

		}

		function augury_editor_enqueue_styles( ) {

			$styles = '';

			$primary_color 	 = augury_get_option( 'primary-color' );
			$secondary_color = augury_get_option( 'secondary-color' );
			$tertiary_color  = augury_get_option( 'tertiary-color' );

			# Primary Color
			$styles .= '.has-primary-background-color { background-color:'.$primary_color.'; }';
			$styles .= '.has-primary-color { color:'.$primary_color.'; }';
	
			# Secondary Color
			$styles .= '.has-secondary-background-color { background-color:'.$secondary_color.'; }';
			$styles .= '.has-secondary-color { color:'.$secondary_color.'; }';
	
			# Tertiary Color
			$styles .= '.has-tertiary-background-color { background-color:'.$tertiary_color.'; }';
			$styles .= '.has-tertiary-color { color:'.$tertiary_color.'; }';

			wp_add_inline_style('augury-gutenberg', $styles );

		}

	}

endif;

Gutenberg_Editor_CSS::get_instance();