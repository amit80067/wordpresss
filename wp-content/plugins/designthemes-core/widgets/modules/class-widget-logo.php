<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class Elementor_Logo extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-logo';
    }

    public function get_title() {
        return __('Logo', 'dt-elementor');
    }

    public function get_icon() {
		return 'far fa-image';
	}

    protected function register_controls() {

        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'General', 'dt-elementor'),
        ) );

            $this->add_control( 'logo_type', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Logo Type', 'dt-elementor'),
                'default' => 'theme-logo',
                'options' => array(
                    'theme-logo'  => __('Logo', 'dt-elementor'),
                    'custom-image'  => __('Custom Image', 'dt-elementor'),
                    'text' => __('Title', 'dt-elementor'),
                    'text-desc' => __('Title and Description', 'dt-elementor'),
                )
            ) );

            $this->add_control( 'theme_logo_type', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Logo', 'dt-elementor'),
                'default' => 'logo',
                'options' => array(
                    'logo'  => __('Logo', 'dt-elementor'),
                    'light-logo'  => __('Light Logo', 'dt-elementor'),
                ),
                'condition' => array( 'logo_type' => 'theme-logo' )
            ) );

			$this->add_control( 'image', array(
				'type'      => Controls_Manager::MEDIA,
				'label'     => esc_html__( 'Image', 'dt-elementor' ),
				'default'   => array( 'url' => Utils::get_placeholder_image_src(), ),
				'condition' => array( 'logo_type' => 'custom-image' )
			) );

			$this->add_responsive_control( 'image_width', array(
				'label'           => __( 'Image Width (px)', 'dt-elementor' ),
				'type'            => Controls_Manager::NUMBER,
				'min'             => 10,
				'max'             => 500,
				'step'            => 1,
				'desktop_default' => 150,
				'tablet_default'  => 100,
				'mobile_default'  => 100,
				'condition' => array( 'logo_type' => array( 'theme-logo', 'custom-image' ) )
			) );

			$this->add_control( 'logo_text', array(
				'label'     => esc_html__( 'Site Title', 'dt-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => get_bloginfo ( 'name' ),
				'condition' => array( 'logo_type' => array( 'text', 'text-desc' ) )
			) );

			$this->add_control( 'logo_tagline', array(
				'label'     => esc_html__( 'Site Tagline', 'dt-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => get_bloginfo ( 'description' ),
				'condition' => array( 'logo_type' => array( 'text-desc' ) )
			) );

            $this->add_control( 'item_align', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Alignment?', 'dt-elementor'),
                'default' => 'center',
                'options' => array(
                    'left'   => __('Left', 'dt-elementor'),
                    'center' => __('Center', 'dt-elementor'),
                    'right'  => __('Right', 'dt-elementor')
                )
            ) );

            $this->add_control( 'breakpoint', array(
                'type'        => Controls_Manager::NUMBER,
                'label'       => __('Mobile Breakpoint (px)', 'dt-elementor'),
                'default'     => '767',
                'description' => __( 'Apply different style if resolution less than the input value.', 'dt-elementor' ),
            ) );

            $this->add_control( 'class', array(
                'type'        => Controls_Manager::TEXT,
                'label'       => __('Extra class name', 'dt-elementor'),
                'description' => __('Style particular element differently - add a class name and refer to it in custom CSS', 'dt-elementor')
            ) );

        $this->end_controls_section();

        $this->start_controls_section( 'dt_section_color', array(
            'label' => __( 'Color', 'dt-elementor'),
        	'condition' => array( 'logo_type' => array( 'text', 'text-desc' ) )
        ) );

			$this->add_control( 'site_title_color_info', array(
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'Site Title Color', 'dt-elementor' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			));

            $this->add_control( 'default_item_color', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Item Color', 'dt-elementor'),
                'default' => 'none',
                'options' => array(
                    'primary-color'   => __('Theme Primary', 'dt-elementor'),
                    'secondary-color' => __('Theme Secondary', 'dt-elementor'),
                    'tertiary-color'  => __('Theme Tertiary', 'dt-elementor'),
                    'custom'		  => __('Custom Color', 'dt-elementor'),
                    'none'			  => __('None', 'dt-elementor')
                ),
                'condition' => array( 'logo_type' => array( 'text', 'text-desc' ) )
            ) );

            $this->add_control( 'default_bg_color', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('BG Color', 'dt-elementor'),
                'default' => 'none',
                'options' => array(
                    'primary-color'   => __('Theme Primary', 'dt-elementor'),
                    'secondary-color' => __('Theme Secondary', 'dt-elementor'),
                    'tertiary-color'  => __('Theme Tertiary', 'dt-elementor'),
                    'custom'		  => __('Custom Color', 'dt-elementor'),
                    'none'			  => __('None', 'dt-elementor')
                ),
                'condition' => array( 'logo_type' => array( 'text', 'text-desc' ) )
            ) );

            $this->add_control( 'default_border_color', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Border Color', 'dt-elementor'),
                'default' => 'none',
                'options' => array(
                    'primary-color'   => __('Theme Primary', 'dt-elementor'),
                    'secondary-color' => __('Theme Secondary', 'dt-elementor'),
                    'tertiary-color'  => __('Theme Tertiary', 'dt-elementor'),
                    'custom'		  => __('Custom Color', 'dt-elementor'),
                    'none'			  => __('None', 'dt-elementor')
                ),
                'condition' => array( 'logo_type' => array( 'text', 'text-desc' ) )
            ) );

			$this->add_control( 'default_custom_item_color', array(
				'label'     => esc_html__( 'Item Color', 'dt-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default' 	=> '#da0000',
				'selectors' => array( '{{WRAPPER}} div#'.'dt-'.$this->get_id().' span.site-title' => 'color: {{VALUE}}' ),
				'condition' => array( 'default_item_color' => array( 'custom' ) )
			) );

			$this->add_control( 'default_custom_bg_color', array(
				'label'     => esc_html__( 'BG Color', 'dt-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default' 	=> '#da0000',
				'selectors' => array( '{{WRAPPER}} div#'.'dt-'.$this->get_id().' span.site-title' => 'background-color: {{VALUE}}' ),
				'condition' => array( 'default_bg_color' => array( 'custom' ) )
			) );

			$this->add_control( 'default_custom_border_color', array(
				'label'     => esc_html__( 'Border Color', 'dt-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default' 	=> '#c50000',
				'selectors' => array( '{{WRAPPER}} div#'.'dt-'.$this->get_id().' span.site-title' => 'border-color: {{VALUE}}' ),
				'condition' => array( 'default_border_color' => array( 'custom' ) )
			) );

			$this->add_control( 'site_desc_color_info', array(
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'Site Description Color', 'dt-elementor' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => array( 'logo_type' => array( 'text-desc' ) )
			));

            $this->add_control( 'desc_default_item_color', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Item Color', 'dt-elementor'),
                'default' => 'none',
                'options' => array(
                    'primary-color'   => __('Theme Primary', 'dt-elementor'),
                    'secondary-color' => __('Theme Secondary', 'dt-elementor'),
                    'tertiary-color'  => __('Theme Tertiary', 'dt-elementor'),
                    'custom'		  => __('Custom Color', 'dt-elementor'),
                    'none'			  => __('None', 'dt-elementor')
                ),
                'condition' => array( 'logo_type' => array( 'text-desc' ) )
            ) );

            $this->add_control( 'desc_default_bg_color', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('BG Color', 'dt-elementor'),
                'default' => 'none',
                'options' => array(
                    'primary-color'   => __('Theme Primary', 'dt-elementor'),
                    'secondary-color' => __('Theme Secondary', 'dt-elementor'),
                    'tertiary-color'  => __('Theme Tertiary', 'dt-elementor'),
                    'custom'		  => __('Custom Color', 'dt-elementor'),
                    'none'			  => __('None', 'dt-elementor')
                ),
                'condition' => array( 'logo_type' => array( 'text-desc' ) )
            ) );

            $this->add_control( 'desc_default_border_color', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Border Color', 'dt-elementor'),
                'default' => 'none',
                'options' => array(
                    'primary-color'   => __('Theme Primary', 'dt-elementor'),
                    'secondary-color' => __('Theme Secondary', 'dt-elementor'),
                    'tertiary-color'  => __('Theme Tertiary', 'dt-elementor'),
                    'custom'		  => __('Custom Color', 'dt-elementor'),
                    'none'			  => __('None', 'dt-elementor')
                ),
                'condition' => array( 'logo_type' => array( 'text-desc' ) )
            ) );

			$this->add_control( 'desc_default_custom_item_color', array(
				'label'     => esc_html__( 'Item Color', 'dt-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default' 	=> '#da0000',
				'selectors' => array( '{{WRAPPER}} div#'.'dt-'.$this->get_id().' span.site-description' => 'color: {{VALUE}}' ),
				'condition' => array( 'desc_default_item_color' => array( 'custom' ), 'logo_type' => array( 'text-desc' ) )
			) );

			$this->add_control( 'desc_default_custom_bg_color', array(
				'label'     => esc_html__( 'BG Color', 'dt-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default' 	=> '#da0000',
				'selectors' => array( '{{WRAPPER}} div#'.'dt-'.$this->get_id().' span.site-description' => 'background-color: {{VALUE}}' ),
				'condition' => array( 'desc_default_bg_color' => array( 'custom' ), 'logo_type' => array( 'text-desc' ) )
			) );

			$this->add_control( 'desc_default_custom_border_color', array(
				'label'     => esc_html__( 'Border Color', 'dt-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default' 	=> '#c50000',
				'selectors' => array( '{{WRAPPER}} div#'.'dt-'.$this->get_id().' span.site-description' => 'border-color: {{VALUE}}' ),
				'condition' => array( 'desc_default_border_color' => array( 'custom' ), 'logo_type' => array( 'text-desc' ) )
			) );

        $this->end_controls_section();

        $this->start_controls_section( 'dt_section_typhography', array(
            'label' => __( 'Typography', 'dt-elementor'),
        	'condition' => array( 'logo_type' => array( 'text', 'text-desc' ) )
        ) );

            $this->add_control( 'use_theme_fonts', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __('Use theme default font family?', 'dt-elementor'),
                'label_on'     => __( 'Yes', 'dt-elementor' ),
                'label_off'    => __( 'No', 'dt-elementor' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => array( 'logo_type' => array( 'text', 'text-desc' ) )
            ) );

 			$this->add_group_control( Group_Control_Typography::get_type(), array(
                'label'     => __('Site Title', 'dt-elementor'), 				
				'name'      => 'site_title_typo',
				'selector'  => '{{WRAPPER}} div#'.'dt-'.$this->get_id().' span.site-title',
				'condition' => array( 'use_theme_fonts!' => 'yes' )
			) );

            $this->add_control( 'use_theme_fonts_desc', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __('Use theme default font family?', 'dt-elementor'),
                'label_on'     => __( 'Yes', 'dt-elementor' ),
                'label_off'    => __( 'No', 'dt-elementor' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => array( 'logo_type' => array( 'text-desc' ) )
            ) );

 			$this->add_group_control( Group_Control_Typography::get_type(), array(
                'label'     => __('Site Description', 'dt-elementor'),
				'name'      => 'site_desc_typo',
				'selector'  => '{{WRAPPER}} div#'.'dt-'.$this->get_id().' span.site-description',
				'condition' => array( 'use_theme_fonts_desc!' => 'yes', 'logo_type' => array( 'text-desc' ) )
			) );

		$this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        extract($settings);

		$output = '';

        if($_element_id != '') {
            $el_id = 'dt-'.$_element_id;
        } else {
        	$el_id = 'dt-'.$this->get_id();
        }

        $css_classes = array( 
            'dt-logo-container',
            'logo-align-'.$item_align,
            $class
        );

        $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

        # CUSTOM CSS
        $custom_css = '';
        $custom_css .= $this->dt_generate_css( $settings );

        # OUTPUT
        $logo = '';

        if( ( $logo_type == 'text' || $logo_type == 'text-desc' ) && !empty( $logo_text ) ) {

            $logo .= !empty( $logo_text ) ?  '<span class="site-title">'. $logo_text .'</span>' : '';
        }

        if( $logo_type == 'text-desc' && !empty( $logo_tagline ) ) {

            $logo .= !empty( $logo_tagline ) ?  '<span class="site-description">' . $logo_tagline . '</span>' : '';
        }

        if( $logo_type == 'theme-logo' ) {

            if( $theme_logo_type == 'logo' ) {
                $logo = augury_get_option( 'custom-logo' );
                $url  = wp_get_attachment_image_url( $logo, 'full' );
            } elseif( $theme_logo_type == 'light-logo' ) {
                $alogo = augury_get_option( 'custom-alternate-logo' );
                $url = wp_get_attachment_image_url( $alogo, 'full' );
            }

            $logo = '<img src="'.esc_url( $url ).'" alt="'.esc_attr( get_bloginfo('name') ).'"/>';
        }

        if( $logo_type == 'custom-image' ) {

            $logo = wp_get_attachment_image($image['id'], 'full');
        }

        $output .= '<div id="' . esc_attr($el_id) . '" class="' . esc_attr($css_class) . '">';
        $output .= '  <a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.$logo.'</a>';
        $output .= '</div>';

        if( !empty( $custom_css ) ) {
            $this->dt_print_css( $custom_css ); 
        }

        echo $output;
	}

	function dt_generate_css( $attrs ) {

        $css = $breakpoint_css = '';

        $_element_id = isset($_element_id) ? $_element_id : '';

        if($_element_id != '') {
            $attrs['el_id'] = 'dt-'.$_element_id;
        } else {
        	$attrs['el_id'] = 'dt-'.$this->get_id();
        }

        if( ( $attrs['logo_type'] == 'text' || $attrs['logo_type'] == 'text-desc' ) && !empty( $attrs['logo_text'] ) ) {

            $font_style  = !empty( $attrs['font_size'] ) ? 'font-size:'.$attrs['font_size'].'px;' : '';
            $font_style .= !empty( $attrs['line_height'] ) ? 'line-height:'.$attrs['line_height'].'px;' : '';
            $font_style .= !empty( $attrs['letter_spacing'] ) ? 'letter-spacing:'.$attrs['letter_spacing'].'px;' : '';

            # Color
            $t_color = '';
            if( $attrs['default_item_color'] == 'custom' &&  !empty( $attrs['default_custom_item_color'] ) ) {
                $t_color = $attrs['default_custom_item_color'];
            } else {
                $t_color = $this->dt_current_skin( $attrs['default_item_color'] );
            }
            $font_style .= ( !empty( $t_color ) ) ? 'color:'.$t_color.';' : '';

            # BG Color
            $t_bg_color = '';
            if( $attrs['default_bg_color'] == 'custom' &&  !empty( $attrs['default_custom_bg_color'] ) ) {
                $t_bg_color = $attrs['default_custom_bg_color'];
            } else {
                $t_bg_color = $this->dt_current_skin( $attrs['default_bg_color'] );
            }
            $font_style .= ( !empty( $t_bg_color ) ) ? 'background-color:'.$t_bg_color.'; padding:4px;' : '';

            # Border Color
            $t_border_color = '';
            if( $attrs['default_border_color'] == 'custom' &&  !empty( $attrs['default_custom_border_color'] ) ) {
                $t_border_color = $attrs['default_custom_border_color'];
            } else {
                $t_border_color = $this->dt_current_skin( $attrs['default_border_color'] );
            }
            $font_style .= ( !empty( $t_border_color ) ) ? 'border-style:solid; border-width:1px; border-color:'.$t_border_color.'; padding:4px;' : '';

            $css .= !empty( $font_style ) ? "\n".'div#'.esc_attr( $attrs['el_id'] ).' span.site-title {'.$font_style.'}' : '';
        }

        if( $attrs['logo_type'] == 'text-desc' && !empty( $attrs['logo_tagline'] ) ) {

            $font_style  = !empty( $attrs['desc_font_size'] ) ? 'font-size:'.$attrs['desc_font_size'].'px;' : '';
            $font_style .= !empty( $attrs['desc_line_height'] ) ? 'line-height:'.$attrs['desc_line_height'].'px;' : '';
            $font_style .= !empty( $attrs['desc_letter_spacing'] ) ? 'letter-spacing:'.$attrs['desc_letter_spacing'].'px;' : '';

            # Color
            $t_color = '';
            if( $attrs['desc_default_item_color'] == 'custom' &&  !empty( $attrs['desc_default_custom_item_color'] ) ) {
                $t_color = $attrs['desc_default_custom_item_color'];
            } else {
                $t_color = $this->dt_current_skin( $attrs['desc_default_item_color'] );
            }
            $font_style .= ( !empty( $t_color ) ) ? 'color:'.$t_color.';' : '';

            # BG Color
            $t_bg_color = '';
            if( $attrs['desc_default_bg_color'] == 'custom' &&  !empty( $attrs['desc_default_custom_bg_color'] ) ) {
                $t_bg_color = $attrs['desc_default_custom_bg_color'];
            } else {
                $t_bg_color = $this->dt_current_skin( $attrs['desc_default_bg_color'] );
            }
            $font_style .= ( !empty( $t_bg_color ) ) ? 'background-color:'.$t_bg_color.'; padding:4px;' : '';

            # Border Color
            $t_border_color = '';
            if( $attrs['desc_default_border_color'] == 'custom' &&  !empty( $attrs['desc_default_custom_border_color'] ) ) {
                $t_border_color = $attrs['desc_default_custom_border_color'];
            } else {
                $t_border_color = $this->dt_current_skin( $attrs['desc_default_border_color'] );
            }
            $font_style .= ( !empty( $t_border_color ) ) ? 'border-style:solid; border-width:1px; border-color:'.$t_border_color.'; padding:4px;' : '';

            $css .= !empty( $font_style ) ? "\n".'div#'.esc_attr( $attrs['el_id'] ).' span.site-description {'.$font_style.'}' : '';
        }

        if( $attrs['logo_type'] == 'theme-logo' || $attrs['logo_type'] == 'custom-image' ) {

            $css .= !empty( $attrs['image_width'] ) ? "\n".'div#'.esc_attr( $attrs['el_id'] ).' img { width:'.$attrs['image_width'].'px;}' : '';
            if( !empty( $attrs['breakpoint'] ) && !empty( $attrs['image_width_mobile'] ) ) {
                $breakpoint_css .= "\n".'div#'.esc_attr( $attrs['el_id'] ).' img { width:'.$attrs['image_width_mobile'].'px; }';
            }
        }

        if( !empty( $attrs['breakpoint'] ) && !empty( $breakpoint_css ) ) {
           $css .= "\n".'@media only screen and (max-width: '.$attrs['breakpoint'].'px) {' . $breakpoint_css."\n".'}';
        }

        return $css;
    }

    function dt_print_css( $css ) { 
        if( !empty( $css ) ) {
            wp_enqueue_style( 'augury-custom-inline' );
            wp_add_inline_style( 'augury-custom-inline', $css );
        }
    }

    function dt_current_skin( $code = 'primary-color' ) {

        $color = '';
        $mode  = augury_get_option( 'use-predefined-skin' );

        if( $mode ) {
            $skin  = augury_get_option( 'predefined-skin' );
            $skin  = augury_skins( $skin );
            $color = $skin[$code];
        } else {
            $color = augury_get_option( $code );
        }

        return $color;
    }

    protected function content_template() {
    }
}