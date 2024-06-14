<?php
if ( ! class_exists( 'Augury_Theme_Dynamic_CSS' ) ) {

	class Augury_Theme_Dynamic_CSS {

		private static $instance;

		public $tablet_portrait_breakpoint = "@media only screen and (min-width:1025px) and (max-width:1280px)";
		public $tablet_ls_breakpoint = "@media only screen and (min-width:768px) and (max-width:1024px)";
		public $mobile_breakpoint = "@media (max-width: 767px)";

		public $google_fonts = array();

		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		public function __construct() {

			// Add our CSS
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 1000 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_google_fonts' ),1000 );
		}

		public function enqueue_styles() {

			$css = '';

			$css .= $this->body_style();
			$css .= $this->body_typo();

			$css .= $this->menu_style();
			$css .= $this->heading_style();

			$css .= $this->menu_typo();
			$css .= $this->heading_typo();

			$css .= $this->extra_typo_section_typo();

			$css .= $this->widget_style();
			$css .= $this->widget_typo();

			$css .= $this->footer_section_style();
			$css .= $this->footer_section_typo();			

			$css .= $this->site_identity_style();
			$css .= $this->site_identity_typo();

			$css .= $this->breadcrumb_style();	
			$css .= $this->breadcrumb_typo();			

			$css .= $this->enqueue_custom_fonts();

            if( !empty( $css ) ) {

				wp_register_style( 'augury-customiser-inline', '', array(), AUGURY_VERSION, 'all' );
				wp_enqueue_style( 'augury-customiser-inline' );

                wp_add_inline_style( 'augury-customiser-inline', $css );
            }
		}

		public function font_family_callback( $option ) {

			$css = '';

			if( isset( $option['font-family'] ) && !empty( $option['font-family'] ) ) {

				$css .= 'font-family:'.$option['font-family'];

				if( isset( $option['font-fallback'] ) && !empty( $option['font-fallback'] ) ) {
					$css .= ','.$option['font-fallback'].';';
				}	
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
				$css .= 'line-height:'.$option['lh-desktop'].$option['lh-desktop-unit'].';';
			}

			if( isset( $option['ls-desktop'] ) && !empty( $option['ls-desktop'] ) ) {
				$css .= 'letter-spacing:'.$option['ls-desktop'].$option['ls-desktop-unit'].';';
			}			

			return $css;
		}

		public function text_decoration_callback( $option ) {
			$css = '';

			if( isset( $option['text-decoration'] ) && !empty( $option['text-decoration'] ) ) {
				$css .= 'text-decoration:'.$option['text-decoration'].';';
			}		

			return $css;
		}

		public function font_family_responsive_callback( $option, $selector ) {

			$css = $tablet_portrait_css = $tablet_ls_css =  $mobile_css = '';

			# Font Size
				# Tablet Portrait  
				if( isset( $option['fs-tablet'] ) && !empty( $option['fs-tablet'] ) ) {
					$tablet_portrait_css .= 'font-size:'.$option['fs-tablet'].$option['fs-tablet-unit'].';';
				}

				# Tablet landscape  
				if( isset( $option['fs-tablet-landscape'] ) && !empty( $option['fs-tablet-landscape'] ) ) {
					$tablet_ls_css .= 'font-size:'.$option['fs-tablet-landscape'].$option['fs-tablet-ls-unit'].';';
				}

				# Mobile  
				if( isset( $option['fs-mobile'] ) && !empty( $option['fs-mobile'] ) ) {
					$mobile_css .= 'font-size:'.$option['fs-mobile'].$option['fs-mobile-unit'].';';
				}

			# Line Height
				# Tablet Portrait  
				if( isset( $option['lh-tablet'] ) && !empty( $option['lh-tablet'] ) ) {
					$tablet_portrait_css .= 'line-height:'.$option['lh-tablet'].$option['lh-tablet-unit'].';';
				}

				# Tablet landscape  
				if( isset( $option['lh-tablet-landscape'] ) && !empty( $option['lh-tablet-landscape'] ) ) {
					$tablet_ls_css .= 'line-height:'.$option['lh-tablet-landscape'].$option['lh-tablet-ls-unit'].';';
				}

				# Mobile  
				if( isset( $option['lh-mobile'] ) && !empty( $option['lh-mobile'] ) ) {
					$mobile_css .= 'line-height:'.$option['lh-mobile'].$option['lh-mobile-unit'].';';
				}

			# Line Spacing
				# Tablet Portrait  
				if( isset( $option['ls-tablet'] ) && !empty( $option['ls-tablet'] ) ) {
					$tablet_portrait_css .= 'letter-spacing:'.$option['ls-tablet'].$option['ls-tablet-unit'].';';
				}

				# Tablet landscape  
				if( isset( $option['ls-tablet-landscape'] ) && !empty( $option['ls-tablet-landscape'] ) ) {
					$tablet_ls_css .= 'letter-spacing:'.$option['ls-tablet-landscape'].$option['ls-tablet-ls-unit'].';';
				}

				# Mobile  
				if( isset( $option['ls-mobile'] ) && !empty( $option['ls-mobile'] ) ) {
					$mobile_css .= 'letter-spacing:'.$option['ls-mobile'].$option['ls-mobile-unit'].';';
				}				
		
			if( !empty( $tablet_portrait_css ) ) {
				$css .= $this->tablet_portrait_breakpoint .'{'. $selector .'{'. $tablet_portrait_css.'} }'."\n";
			}

			if( !empty( $tablet_ls_css ) ) {
				$css .= $this->tablet_ls_breakpoint .'{'. $selector .'{'. $tablet_ls_css.'} }'."\n";
			}

			if( !empty( $mobile_css ) ) {
				$css .= $this->mobile_breakpoint .'{'. $selector .'{'. $mobile_css.'} }'."\n";
			}

			return $css;						
		}

		public function enqueue_google_fonts() {
			$subset = apply_filters( 'dt_theme_google_font_supsets', 'latin-ext' );
			$fonts = array_filter( $this->google_fonts );

			foreach( $fonts as $font ) {
				$url = '//fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $font );
				$url .= !empty( $subset ) ? '&subset=' . $subset : '';

				$key = md5( $font . $subset );

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

		public function enqueue_custom_fonts() {

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

		public function background_callback( $option ) {

			$css = '';

			if( isset( $option['background-color'] ) && !empty( $option['background-color'] ) ) {
				$css .= 'background-color:'. $option['background-color'].';';
			}

			if( isset( $option['background-image'] ) && !empty( $option['background-image'] ) ) {
				$css .= 'background-image: url('.esc_url( $option['background-image'] ).');';

				if( isset( $option['background-position'] ) && !empty( $option['background-position'] ) ) {
					$css .= 'background-position:'.esc_attr( $option['background-position'] ).';';
				}

				if( isset( $option['background-size'] ) && !empty( $option['background-size'] ) ) {
					$css .= 'background-size:'.esc_attr( $option['background-size'] ).';';
				}

				if( isset( $option['background-repeat'] ) && !empty( $option['background-repeat'] ) ) {
					$css .= 'background-repeat:'.esc_attr( $option['background-repeat'] ).';';
				}

				if( isset( $option['background-attachment'] ) && !empty( $option['background-attachment'] ) ) {
					$css .= 'background-attachment:'.esc_attr( $option['background-attachment'] ).';';
				}
			}

			return $css;			
		}

		public function debug( $result ) {

			echo '<pre>';
			var_dump( $result );
			echo '</pre>';
		}

		public function body_style() {
			$css = '';

			$layout = augury_get_option( 'site-layout' );
			$customize = augury_get_option( 'site-boxed-layout', true );

			if( $layout && $customize ) {

				$css .= $this->background_callback( augury_get_option('site-bg') );
				if( !empty( $css ) ) {

					$css = 'body.layout-boxed {'.$css.'}'. "\n";
				}
			}

			#Body BG Color
			$body_bg_color = augury_get_option( 'body-bg-color' );
			if( !empty( $body_bg_color ) ) {

				$layout = augury_get_option( 'site-layout', 'wide' );

				if( $layout == 'wide' ) {
					$css .= 'body, .woocommerce ul.products li .product-wrapper, .woocommerce-tabs .panel, .select2-results, .woocommerce table .quantity .qty, .select2-dropdown .select2-search .select2-search__field, .dt-sc-schedule-progress .dt-sc-progress-step span, .dt-sc-goback-box .appointment-goback { background-color:'.$body_bg_color.';}'. "\n";
				} else {
					$css .= '.layout-boxed .inner-wrapper { background-color:'.$body_bg_color.';}'. "\n";
				}
			}

			# Body Content Color
			$body_content_color = augury_get_option( 'body-content-color' );
			if( !empty( $body_content_color ) ) {
				$css .= 'body { color:'.$body_content_color.';}'. "\n";
			}

			# Body Content Anchor Color
			$body_content_a_color = augury_get_option( 'body-content-link-color' );
			if( !empty( $body_content_a_color ) ) {
				$css .= 'a { color:'.$body_content_a_color.';}'. "\n";
			}

			# Body Content Anchor hover Color
			$body_content_a_hover_color = augury_get_option( 'body-content-link-hover-color' );
			if( !empty( $body_content_a_hover_color ) ) {
				$css .= 'a:hover { color:'.$body_content_a_hover_color.';}'. "\n";
			}

			return $css;			
		}

		public function body_typo() {
			$css = '';

			# Body
				$body_typo =  augury_get_option( 'body-typo' );

				# Loading Google Font
					if( isset( $body_typo['font-type'] ) && $body_typo['font-type'] == 'google' ) {
						$weight = isset( $body_typo['font-weight'] ) ? ':'. $body_typo['font-weight'] : '';
						$this->google_fonts[] = $body_typo['font-family'] . $weight;
					}

				# Generating CSS
					$body_css =  $this->font_family_callback( $body_typo );
					if( !empty( $body_css ) ) {
						$css .= 'body {'.$body_css.'}'."\n";
					}

					// Filter text decoration, becoz it need to applied for p tag
					$body_css =  $this->text_decoration_callback( $body_typo );
					if( !empty( $body_css ) ) {
						$css .= 'body p {'.$body_css.'}'."\n";
					}

				# Generating Responsive CSS
					$body_responsive_css = $this->font_family_responsive_callback(  $body_typo, 'body' );
					if( !empty( $body_responsive_css ) ) {
						$css .= $body_responsive_css;
					}

			return $css;
		}

		public function menu_style() {
			$css = '';

			# Menu Color
			$menu_color = augury_get_option( 'menu-color' );
			if( !empty( $menu_color ) ) {
				$css .= '.no-header-menu ul li a, .dt-header-menu .dt-primary-nav li a { color:'.$menu_color.';}'. "\n";
			}

			return $css;
		}

		public function heading_style() {
			$css = '';

			# H1 Color
			$h1_color = augury_get_option( 'h1-color' );
			if( !empty( $h1_color ) ) {
				$css .= 'h1 { color:'.$h1_color.';}'. "\n";
			}

			# H2 Color
			$h2_color = augury_get_option( 'h2-color' );
			if( !empty( $h2_color ) ) {
				$css .= 'h2 { color:'.$h2_color.';}'. "\n";
			}

			# H3 Color
			$h3_color = augury_get_option( 'h3-color' );
			if( !empty( $h3_color ) ) {
				$css .= 'h3 { color:'.$h3_color.';}'. "\n";
			}

			# H4 Color
			$h4_color = augury_get_option( 'h4-color' );
			if( !empty( $h4_color ) ) {
				$css .= 'h4 { color:'.$h4_color.';}'. "\n";
			}

			# H5 Color
			$h5_color = augury_get_option( 'h5-color' );
			if( !empty( $h5_color ) ) {
				$css .= 'h5 { color:'.$h5_color.';}'. "\n";
			}

			# H6 Color
			$h6_color = augury_get_option( 'h6-color' );
			if( !empty( $h6_color ) ) {
				$css .= 'h6 { color:'.$h6_color.';}'. "\n";
			}															

			return $css;
		}

		public function menu_typo() {
			$css = '';

			# Menu
				$menu_typo =  augury_get_option( 'menu-typo' );

				# Loading Google Font
					if( isset( $menu_typo['font-type'] ) && $menu_typo['font-type'] == 'google' ) {
						$weight = isset( $menu_typo['font-weight'] ) ? ':'. $menu_typo['font-weight'] : '';
						$this->google_fonts[] = $menu_typo['font-family'] . $weight;
					}

				# Generating CSS
					$menu_css =  $this->font_family_callback( $menu_typo );
					if( !empty( $menu_css ) ) {
						$css .= '.no-header-menu ul li a, .dt-header-menu .dt-primary-nav li a {'.$menu_css.'}'."\n";
					}

				# Generating Responsive CSS
					$menu_responsive_css = $this->font_family_responsive_callback(  $menu_typo, 'h1' );
					if( !empty( $menu_responsive_css ) ) {
						$css .= $menu_responsive_css;
					}

			return $css;
		}

		public function heading_typo() {
			$css = '';

			# H1
				$h1_typo =  augury_get_option( 'h1-typo' );

				# Loading Google Font
					if( isset( $h1_typo['font-type'] ) && $h1_typo['font-type'] == 'google' ) {
						$weight = isset( $h1_typo['font-weight'] ) ? ':'. $h1_typo['font-weight'] : '';
						$this->google_fonts[] = $h1_typo['font-family'] . $weight;
					}

				# Generating CSS
					$h1_css =  $this->font_family_callback( $h1_typo );
					if( !empty( $h1_css ) ) {
						$css .= 'h1 {'.$h1_css.'}'."\n";
					}

				# Generating Responsive CSS
					$h1_responsive_css = $this->font_family_responsive_callback(  $h1_typo, 'h1' );
					if( !empty( $h1_responsive_css ) ) {
						$css .= $h1_responsive_css;
					}

			# H2
				$h2_typo =  augury_get_option( 'h2-typo' );

				# Loading Google Font
					if( isset( $h2_typo['font-type'] ) && $h2_typo['font-type'] == 'google' ) {
						$weight = isset( $h2_typo['font-weight'] ) ? ':'. $h2_typo['font-weight'] : '';
						$this->google_fonts[] = $h2_typo['font-family'] . $weight;
					}

				# Generating CSS
					$h2_css =  $this->font_family_callback( $h2_typo );
					if( !empty( $h2_css ) ) {
						$css .= 'h2 {'.$h2_css.'}'."\n";
					}

				# Generating Responsive CSS
					$h2_responsive_css = $this->font_family_responsive_callback(  $h2_typo, 'h2' );
					if( !empty( $h2_responsive_css ) ) {
						$css .= $h2_responsive_css;
					}

			# H3
				$h3_typo =  augury_get_option( 'h3-typo' );

				# Loading Google Font
					if( isset( $h3_typo['font-type'] ) && $h3_typo['font-type'] == 'google' ) {
						$weight = isset( $h3_typo['font-weight'] ) ? ':'.$h3_typo['font-weight'] : '';
						$this->google_fonts[] = $h3_typo['font-family'] . $weight;
					}

				# Generating CSS
					$h3_css =  $this->font_family_callback( $h3_typo );
					if( !empty( $h3_css ) ) {
						$css .= 'h3 {'.$h3_css.'}'."\n";
					}

				# Generating Responsive CSS
					$h3_responsive_css = $this->font_family_responsive_callback(  $h3_typo, 'h3' );
					if( !empty( $h3_responsive_css ) ) {
						$css .= $h3_responsive_css;
					}

			# H4
				$h4_typo =  augury_get_option( 'h4-typo' );

				# Loading Google Font
					if( isset( $h4_typo['font-type'] ) && $h4_typo['font-type'] == 'google' ) {
						$weight = isset( $h4_typo['font-weight'] ) ? ':'.$h4_typo['font-weight'] : '';
						$this->google_fonts[] = $h4_typo['font-family'] . $weight;
					}

				# Generating CSS
					$h4_css =  $this->font_family_callback( $h4_typo );
					if( !empty( $h4_css ) ) {
						$css .= 'h4 {'.$h4_css.'}'."\n";
					}

				# Generating Responsive CSS
					$h4_responsive_css = $this->font_family_responsive_callback(  $h4_typo, 'h4' );
					if( !empty( $h4_responsive_css ) ) {
						$css .= $h4_responsive_css;
					}

			# H5
				$h5_typo =  augury_get_option( 'h5-typo' );

				# Loading Google Font
					if( isset( $h5_typo['font-type'] ) && $h5_typo['font-type'] == 'google' ) {
						$weight = isset( $h5_typo['font-weight'] ) ? ':'.$h5_typo['font-weight'] : '';
						$this->google_fonts[] = $h5_typo['font-family'] . $weight;
					}

				# Generating CSS
					$h5_css =  $this->font_family_callback( $h5_typo );
					if( !empty( $h5_typo ) ) {
						$css .= 'h5 {'.$h5_css.'}'."\n";
					}

				# Generating Responsive CSS
					$h5_responsive_css = $this->font_family_responsive_callback(  $h5_typo, 'h5' );
					if( !empty( $h5_responsive_css ) ) {
						$css .= $h5_responsive_css;
					}

			# H6
				$h6_typo =  augury_get_option( 'h6-typo' );

				# Loading Google Font
					if( isset( $h6_typo['font-type'] ) && $h6_typo['font-type'] == 'google' ) {
						$weight = isset( $h6_typo['font-weight'] ) ? ':'.$h6_typo['font-weight'] : '';
						$this->google_fonts[] = $h6_typo['font-family'] . $weight;
					}

				# Generating CSS
					$h6_css =  $this->font_family_callback( $h6_typo );
					if( !empty( $h6_css ) ) {
						$css .= 'h6 {'.$h6_css.'}'."\n";
					}

				# Generating Responsive CSS
					$h6_responsive_css = $this->font_family_responsive_callback(  $h6_typo, 'h6' );
					if( !empty( $h6_responsive_css ) ) {
						$css .= $h6_responsive_css;
					}

			return $css;
		}

		public function breadcrumb_style() {
			$css = $overlay_css = '';

			$global_breadcrumb = true;

			if(is_page() || is_singular('post') || is_singular('dt_portfolios') || is_singular('tribe_events')) {

				global $post;

				if(is_page()) {
					$settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
					$settings = is_array( $settings ) ? array_filter( $settings ) : array ();
				} else if(is_singular('post')) {
					$settings = get_post_meta($post->ID,'_dt_post_settings',TRUE);
					$settings = is_array( $settings ) ? array_filter( $settings ) : array ();
				} else if(is_singular('dt_portfolios')) {
					$settings = get_post_meta($post->ID,'_portfolio_settings',TRUE);
					$settings = is_array( $settings ) ? array_filter( $settings ) : array ();
				} else if(is_singular('tribe_events')) {
					$settings = get_post_meta($post->ID,'_custom_settings',TRUE);
					$settings = is_array( $settings ) ? array_filter( $settings ) : array ();
				}

				if( !isset($settings['breadcrumb-option']) ) { 
					$settings['breadcrumb-option'] = 'global-option';
				}

				if( $settings['breadcrumb-option'] == 'individual-option' ) {
					if( isset( $settings['enable-sub-title'] ) && $settings['enable-sub-title'] ) {
						$global_breadcrumb = false;
					}
				}

			}

			$global_style = augury_get_option( 'breadcrumb-bg' );
			$overlay = augury_get_option( 'breadcrumb-overlay-bg-color' );

			if($global_breadcrumb) {

				if( !$overlay ) {
					if( isset( $global_style['background-color'] ) && !empty( $global_style['background-color'] ) ) {
						$css .= 'background-color:'. $global_style['background-color'].';';
					}					
				}

				if( isset( $global_style['background-image'] ) && !empty( $global_style['background-image'] ) ) {
					$css .= 'background-image: url('.esc_url( $global_style['background-image'] ).');';

					if( isset( $global_style['background-position'] ) && !empty( $global_style['background-position'] ) ) {
						$css .= 'background-position:'.esc_attr( $global_style['background-position'] ).';';
					}

					if( isset( $global_style['background-size'] ) && !empty( $global_style['background-size'] ) ) {
						$css .= 'background-size:'.esc_attr( $global_style['background-size'] ).';';
					}

					if( isset( $global_style['background-repeat'] ) && !empty( $global_style['background-repeat'] ) ) {
						$css .= 'background-repeat:'.esc_attr( $global_style['background-repeat'] ).';';
					}

					if( isset( $global_style['background-attachment'] ) && !empty( $global_style['background-attachment'] ) ) {
						$css .= 'background-attachment:'.esc_attr( $global_style['background-attachment'] ).';';
					}
				}

				if( $overlay && isset( $global_style['background-color'] ) && !empty( $global_style['background-color'] ) ) {
					$overlay_css .= '.main-title-section-wrapper .main-title-section-bg:after { background-color:'.$global_style['background-color'].'}';
				}

			} else {

				$bcsettings = isset( $settings['breadcrumb_background'] ) ? $settings['breadcrumb_background'] : array ();

				if( isset( $bcsettings['color'] ) && !empty( $bcsettings['color'] ) ) {
					$css .= 'background-color:'. $bcsettings['color'].';';
				}					

				if( isset( $bcsettings['image'] ) && !empty( $bcsettings['image'] ) ) {
					$css .= 'background-image: url('.esc_url( $bcsettings['image'] ).');';

					if( isset( $bcsettings['position'] ) && !empty( $bcsettings['position'] ) ) {
						$css .= 'background-position:'.esc_attr( $bcsettings['position'] ).';';
					}

					if( isset( $bcsettings['size'] ) && !empty( $bcsettings['size'] ) ) {
						$css .= 'background-size:'.esc_attr( $bcsettings['size'] ).';';
					}

					if( isset( $bcsettings['repeat'] ) && !empty( $bcsettings['repeat'] ) ) {
						$css .= 'background-repeat:'.esc_attr( $bcsettings['repeat'] ).';';
					}

					if( isset( $bcsettings['attachment'] ) && !empty( $bcsettings['attachment'] ) ) {
						$css .= 'background-attachment:'.esc_attr( $bcsettings['attachment'] ).';';
					}
				}

			}

			if( !empty( $css ) ) {
				$css = '.main-title-section-wrapper .main-title-section-bg {'.$css.'}';
			}

			$css .= $overlay_css;


			$css .= "\n";

			# Title Color
				$title_color = augury_get_option( 'breadcrumb-title-color' );
				if( !empty( $title_color ) ) {
					$css .= '.main-title-section h1, .dark-bg-breadcrumb .main-title-section h1 { color:'.$title_color.';}';
				}

			# Text Color
				$text_color = augury_get_option( 'breadcrumb-text-color' );
				if( !empty( $text_color ) ) {
					$css .= '.breadcrumb span.current, .dark-bg-breadcrumb .breadcrumb span.current { color:'.$text_color.';}';
				}

			# Link Color
				$link_color = augury_get_option( 'breadcrumb-link-color' );
				if( !empty( $link_color ) ) {
					$css .= '.breadcrumb a, .dark-bg-breadcrumb .breadcrumb a, .dark-bg-breadcrumb .breadcrumb span:not(.current) { color:'.$link_color.';}';
				}

			# Link Hover Color
				$link_h_color = augury_get_option( 'breadcrumb-link-h-color' );
				if( !empty( $link_h_color ) ) {
					$css .= '.breadcrumb a:hover, .dark-bg-breadcrumb .breadcrumb a:hover { color:'.$link_h_color.';}';
				}

			$css .= "\n";

			return $css;
		}

		public function breadcrumb_typo() {

			$css = '';

			# Title
				$title_typo =  augury_get_option( 'breadcrumb-title-typo' );

				# Loading Google Font
					if( isset( $title_typo['font-type'] ) && $title_typo['font-type'] == 'google' ) {
						$weight = isset( $title_typo['font-weight'] ) ? ':'.$title_typo['font-weight'] : '';
						$this->google_fonts[] = $title_typo['font-family'] . $weight;
					}

				# Generating CSS
					$title_css =  $this->font_family_callback( $title_typo );
					if( !empty( $title_css ) ) {
						$css .= '.main-title-section h1 {'.$title_css.'}'."\n";
					}

				# Generating Responsive CSS
					$title_responsive_css = $this->font_family_responsive_callback(  augury_get_option( 'breadcrumb-title-typo' ), '.main-title-section h1' );
					if( !empty( $title_responsive_css ) ) {
						$css .= $title_responsive_css;
					}

			# Breadcrumb
				$breadcrumb_typo =  augury_get_option( 'breadcrumb-typo' );

				# Loading Google Font
					if( isset( $breadcrumb_typo['font-type'] ) && $breadcrumb_typo['font-type'] == 'google' ) {
						$weight = isset( $breadcrumb_typo['font-weight'] ) ? ':'.$breadcrumb_typo['font-weight'] : '';
						$this->google_fonts[] = $breadcrumb_typo['font-family'] .$weight;
					}

				# Generating CSS
					$breadcrumb_css =  $this->font_family_callback( $breadcrumb_typo );
					if( !empty( $title_css ) ) {
						$css .= '.breadcrumb {'.$breadcrumb_css.'}'."\n";
					}

				# Generating Responsive CSS
					$breadcrumb_responsive_css = $this->font_family_responsive_callback(  augury_get_option( 'breadcrumb-typo' ), '.breadcrumb' );
					if( !empty( $breadcrumb_responsive_css ) ) {
						$css .= $breadcrumb_responsive_css;
					}
			return $css;
		}

		public function footer_section_style() {
			$css = '';

			# Footer Title
			$footer_title_color = augury_get_option( 'footer-title-color' );
			if( !empty( $footer_title_color ) ) {
				$css .= 'div.footer-widgets .widgettitle, #footer .widgettitle { color:'.$footer_title_color.';}'. "\n";
			}

			# Footer Content
			$footer_content_color = augury_get_option( 'footer-content-color' );
			if( !empty( $footer_content_color ) ) {
				$css .= '#footer, .footer-copyright, div.footer-widgets .widget { color:'.$footer_content_color.';}'. "\n";
			}

			# Footer Content Anchor
			$footer_content_a_color = augury_get_option( 'footer-content-a-color' );
			if( !empty( $footer_content_a_color ) ) {
				$css .= '.footer-widgets a, #footer a { color:'.$footer_content_a_color.';}'. "\n";				
			}

			# Footer Content Anchor Hover
			$footer_content_a_hover_color = augury_get_option( 'footer-content-a-hover-color' );
			if( !empty( $footer_content_a_hover_color ) ) {
				$css .= '.footer-widgets a:hover, #footer a:hover { color:'.$footer_content_a_hover_color.';}'. "\n";				
			}

			return $css;
		}

		public function footer_section_typo() {
			$css = '';

			# Footer Title
				$footer_title_typo =  augury_get_option( 'footer-title-typo' );

				# Loading Google Font
					if( isset( $footer_title_typo['font-type'] ) && $footer_title_typo['font-type'] == 'google' ) {
						$weight = isset( $footer_title_typo['font-weight'] ) ? ':'.$footer_title_typo['font-weight'] : '';
						$this->google_fonts[] = $footer_title_typo['font-family'] .$weight;
					}

				# Generating CSS
					$footer_title_css =  $this->font_family_callback( $footer_title_typo );
					if( !empty( $footer_title_css ) ) {
						$css .= 'div.footer-widgets .widgettitle, #footer .widgettitle {'.$footer_title_css.'}'."\n";
					}

				# Generating Responsive CSS
					$footer_title_responsive_css = $this->font_family_responsive_callback(  $footer_title_typo, 'div.footer-widgets .widgettitle, #footer .widgettitle' );
					if( !empty( $footer_title_responsive_css ) ) {
						$css .= $footer_title_responsive_css;
					}

			# Footer Content 
				$footer_content_typo =  augury_get_option( 'footer-content-typo' );

				# Loading Google Font
					if( isset( $footer_content_typo['font-type'] ) && $footer_content_typo['font-type'] == 'google' ) {
						$weight = isset( $footer_content_typo['font-weight'] ) ? ':'.$footer_content_typo['font-weight'] : '';
						$this->google_fonts[] = $footer_content_typo['font-family'] . $weight;
					}

				# Generating CSS
					$footer_content_css =  $this->font_family_callback( $footer_content_typo );
					if( !empty( $footer_content_css ) ) {
						$css .= '#footer, .footer-copyright, div.footer-widgets .widget {'.$footer_content_css.'}'."\n";
					}

				# Generating Responsive CSS
					$footer_content_responsive_css = $this->font_family_responsive_callback(  $footer_content_typo, '#footer, .footer-copyright, div.footer-widgets .widget' );
					if( !empty( $footer_content_responsive_css ) ) {
						$css .= $footer_content_responsive_css;
					}

			return $css;
		}

		public function extra_typo_section_typo() {
			$css = '';

			# Extra 1
				$extra1 =  augury_get_option( 'extra-1-typo' );
				$extra1_selector = 'input[type="text"], input[type="password"], input[type="email"], input[type="url"], input[type="tel"], input[type="number"], input[type="range"], input[type="date"], textarea, input.text, input[type="search"], select, textarea, .form-calender-icon input[type="text"], .select2-container--default .select2-selection--single .select2-selection__rendered, .select2-container--default .select2-selection--single .select2-selection__placeholder';

				# Loading Google Font
					if( isset( $extra1['font-type'] ) && $extra1['font-type'] == 'google' ) {
						$this->google_fonts[] = $extra1['font-family'];
					}


				# Generating CSS
					$footer_title_css =  $this->font_family_callback( $extra1 );
					if( !empty( $footer_title_css ) ) {
						$css .= $extra1_selector .'{'.$footer_title_css.'}'."\n";
					}

				# Generating Responsive CSS
					$extra1 = $this->font_family_responsive_callback(  $extra1, $extra1_selector );
					if( !empty( $extra1 ) ) {
						$css .= $extra1;
					}

			# Extra 2
				$extra2 =  augury_get_option( 'extra-2-typo' );
				$extra2_selector = '#main-menu ul.menu > li > a, .dt-sc-portfolio-sorting a, .minimal .dt-sc-price p, .dt-sc-bar-text, .pagination, .dt-sc-any-carousel-wrapper .swiper-slide .dt-swiper-content-title, .dt-sc-any-carousel-wrapper .slick-slide .dt-slick-content-title, .woocommerce div.product .dt-sc-product-tabs .woocommerce-tabs ul.tabs li a, .woocommerce #review_form #respond .comment-reply-title';

				# Loading Google Font
					if( isset( $extra2['font-type'] ) && $extra2['font-type'] == 'google' ) {
						$this->google_fonts[] = $extra2['font-family'];
					}

				# Generating CSS
					$footer_title_css =  $this->font_family_callback( $extra2 );
					if( !empty( $footer_title_css ) ) {
						$css .= $extra2_selector . '{'.$footer_title_css.'}'."\n";
					}

				# Generating Responsive CSS
					$extra2 = $this->font_family_responsive_callback(  $extra2, $extra2_selector );
					if( !empty( $extra2 ) ) {
						$css .= $extra2;
					}					

			return $css;			
		}

		public function widget_style() {
			$css = '';

			# Widget Title
				$widget_title_color = augury_get_option( 'widget-title-color' );

				if( !empty( $widget_title_color ) ) {
					$css .= '.secondary-sidebar .widgettitle, .secondary-sidebar .widgettitle > a, .secondary-sidebar .type2 .widgettitle, .secondary-sidebar .type10 .widgettitle, .secondary-sidebar .type10 .widgettitle > a, .secondary-sidebar .type17 .widget-title-wrapper .widget-title-content h2, .secondary-sidebar .type17 .widget-title-content h3.widgettitle, .secondary-sidebar .type17 .widget-title-content h3.widgettitle > a, .secondary-sidebar .type14 .widgettitle, .secondary-sidebar .type15 .widgettitle, .mz-stripe-title .mz-stripe-title-content h3.widgettitle { color:'.$widget_title_color.' }'. "\n";
				}

			# Wdiget Title Border and Background Color
				$widget_title_style = augury_get_option( 'widget-title-style' );
				$widget_title_border_color = augury_get_option( 'widget-title-border-color' );
				$widget_title_bg_color = augury_get_option( 'widget-title-bg-color' );

				if( $widget_title_style == 'type1' || $widget_title_style == 'type3' || $widget_title_style == 'type4' || $widget_title_style == 'type5' || $widget_title_style == 'type6' || $widget_title_style == 'type7' || $widget_title_style == 'type8' || $widget_title_style == 'type9' || $widget_title_style == 'type10' || $widget_title_style == 'type13' || $widget_title_style == 'type14' || $widget_title_style == 'type16') {

					if( !empty( $widget_title_border_color ) ) {
						$css .= '.secondary-sidebar .type1 .widgettitle:before, .secondary-sidebar .type1 .widgettitle:after, .secondary-sidebar .type7 .widgettitle:before, .secondary-sidebar .type9 .widgettitle:before { background-color:'.$widget_title_border_color.' }'. "\n";
						$css .= '.secondary-sidebar .type3 .widgettitle, .secondary-sidebar .type4 .widgettitle, .secondary-sidebar .type5 .widgettitle, .secondary-sidebar .type6 .widgettitle, .secondary-sidebar .type7 .widgettitle, .secondary-sidebar .type8 .widget:before, .secondary-sidebar .type13 .widgettitle:before, .secondary-sidebar .type14 .widgettitle, .secondary-sidebar .type16 .widgettitle { border-color:'.$widget_title_border_color.' }'. "\n";
					}
				}

				if( $widget_title_style == 'type2' || $widget_title_style == 'type10' || $widget_title_style == 'type12' || $widget_title_style == 'type14' || $widget_title_style == 'type15' || $widget_title_style == 'type17') {

					if( !empty( $widget_title_bg_color ) ) {
						$css .= '.secondary-sidebar .type2 .widgettitle, .secondary-sidebar .type10 .widgettitle:before, .secondary-sidebar .type14 .widgettitle, .secondary-sidebar .type15 .widgettitle, .mz-title .mz-title-content h2, .mz-stripe-title .mz-stripe-title-content .dt-sc-main-heading, .mz-stripe-title .mz-stripe-title-content h3.widgettitle, .secondary-sidebar .type12 .widgettitle { background-color:'.$widget_title_bg_color.' }'. "\n";
						$css .= '.secondary-sidebar .type2 .widgettitle:before { border-top-color:'.$widget_title_bg_color.' }'. "\n";
						$css .= '.secondary-sidebar .type10 .widgettitle:after { background:'.$widget_title_bg_color.' }'. "\n";
					}
				}

			# Widget Background Color
				$widget_bg_color = augury_get_option( 'widget-bg-color' );

				if( !empty( $widget_bg_color ) ) {
						$css .= '.secondary-sidebar .type11 .widget, .secondary-sidebar .type12 .widget { background-color:'.$widget_bg_color.' }'. "\n";
				}

			# Widget Content
				$widget_content_color = augury_get_option( 'widget-content-color' );

				if( !empty( $widget_content_color ) ) {
						$css .= '.secondary-sidebar .widget { color:'.$widget_content_color.';}'. "\n";
				}

			# Widget Content Anchor
				$widget_content_a_color = augury_get_option( 'widget-content-link-color' );

				if( !empty( $widget_content_a_color ) ) {
					$css .= '.secondary-sidebar .widget ul li > a, .secondary-sidebar .widget ul li > span > a, .secondary-sidebar .widget .recent-posts-widget li .entry-title h4 a, .secondary-sidebar .widget .recent-posts-widget li .entry-meta a { color:'.$widget_content_a_color.';}'. "\n";
				}

			# Widget Content Anchor Hover
				$widget_content_a_h_color = augury_get_option( 'widget-content-link-h-color' );

				if( !empty( $widget_content_a_h_color ) ) {
					$css .= '.secondary-sidebar .widget ul li > a:hover, .secondary-sidebar .widget ul li > span > a:hover, .secondary-sidebar .widget .recent-posts-widget li .entry-title h4 a:hover, .secondary-sidebar .widget .recent-posts-widget li .entry-meta a:hover { color:'.$widget_content_a_h_color.';}'. "\n";
				}

			return $css;
		}

		public function widget_typo() {

			$css = '';

			# Widget Title
				$widget_title_typo =  augury_get_option( 'widget-title-typo' );

				# Loading Google Font
					if( isset( $widget_title_typo['font-type'] ) && $widget_title_typo['font-type'] == 'google' ) {
						$weight = isset( $widget_title_typo['font-weight'] ) ? ':'.$widget_title_typo['font-weight'] : '';
						$this->google_fonts[] = $widget_title_typo['font-family'] .$weight;
					}
					
				# Generating CSS
					$widget_title_css =  $this->font_family_callback( $widget_title_typo );
					if( !empty( $widget_title_css ) ) {
						$css .= '.secondary-sidebar .widgettitle {'.$widget_title_css.'}'."\n";
					}

				# Generating Responsive CSS
					$widget_title_responsive_css = $this->font_family_responsive_callback(  $widget_title_typo, '.secondary-sidebar .widgettitle' );
					if( !empty( $widget_title_responsive_css ) ) {
						$css .= $widget_title_responsive_css;
					}

			# Widget Content
				$widget_content_typo =  augury_get_option( 'widget-content-typo' );

				# Loading Google Font
					if( isset( $widget_content_typo['font-type'] ) && $widget_content_typo['font-type'] == 'google' ) {
						$weight = isset( $widget_content_typo['font-weight'] ) ? ':'.$widget_content_typo['font-weight'] : '';
						$this->google_fonts[] = $widget_content_typo['font-family'] .$weight;
					}

				# Generating CSS
					$widget_content_css =  $this->font_family_callback( $widget_content_typo );
					if( !empty( $widget_content_css ) ) {
						$css .= '.secondary-sidebar .widget{'.$widget_content_css.'}'."\n";
					}

				# Generating Responsive CSS
					$widget_content_responsive_css = $this->font_family_responsive_callback(  $widget_content_typo, '' );
					if( !empty( $widget_content_responsive_css ) ) {
						$css .= '.secondary-sidebar .widget {'.$widget_content_responsive_css.'}'."\n";
					}					

			return $css;
		}

		public function site_identity_style() {
			$css = '';

			# Site Title Color
			$site_title_color = augury_get_option( 'site-title-color' );
			if( !empty( $site_title_color ) ) {
				$css .= '.site-title a { color:'.$site_title_color.'; }'. "\n";
			}

			# Site Title Color
			$site_title_hcolor = augury_get_option( 'site-title-h-color' );
			if( !empty( $site_title_hcolor ) ) {
				$css .= '.site-title a:hover { color:'.$site_title_hcolor.'; }'. "\n";
			}

			# Site Tagline Color
			$site_tagline_color = augury_get_option( 'site-tagline-color' );
			if( !empty( $site_tagline_color ) ) {
				$css .= '.site-tag-line { color:'.$site_tagline_color.'; }'. "\n";
			}			

			return $css;
		}

		public function site_identity_typo() {

			$css = '';

			# Site Title
				$site_title_typo =  augury_get_option( 'site-title-typo' );

				# Loading Google Font
					if( isset( $site_title_typo['font-type'] ) && $site_title_typo['font-type'] == 'google' ) {
						$weight = isset( $site_title_typo['font-weight'] ) ? ':'.$site_title_typo['font-weight'] : '';
						$this->google_fonts[] = $site_title_typo['font-family'] . $weight;
					}

				# Generating CSS
					$site_title_css =  $this->font_family_callback( $site_title_typo );
					if( !empty( $site_title_css ) ) {
						$css .= '.site-title {'.$site_title_css.'}'."\n";
					}

				# Generating Responsive CSS
					$site_title_responsive_css = $this->font_family_responsive_callback(  $site_title_typo, '.site-title' );
					if( !empty( $site_title_responsive_css ) ) {
						$css .= $site_title_responsive_css;
					}

			# Site Tagline
				$site_tagline_typo =  augury_get_option( 'site-tagline-typo' );

				# Loading Google Font
					if( isset( $site_tagline_typo['font-type'] ) && $site_tagline_typo['font-type'] == 'google' ) {
						$weight = isset( $site_tagline_typo['font-weight'] ) ? ':'.$site_tagline_typo['font-weight'] : '';
						$this->google_fonts[] = $site_tagline_typo['font-family'] . $weight;
					}

				# Generating CSS
					$site_tagline_css =  $this->font_family_callback( $site_tagline_typo );
					if( !empty( $site_tagline_css ) ) {
						$css .= '.site-tag-line {'.$site_tagline_css.'}'."\n";
					}

				# Generating Responsive CSS
					$site_tagline_responsive_css = $this->font_family_responsive_callback(  $site_tagline_typo, '.site-tag-line' );
					if( !empty( $site_tagline_responsive_css ) ) {
						$css .= $site_tagline_responsive_css;
					}					

			return $css;			
		}
	}
}

Augury_Theme_Dynamic_CSS::get_instance();