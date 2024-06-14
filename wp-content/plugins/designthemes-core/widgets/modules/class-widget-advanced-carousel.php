<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elementor_Advanced_Carousel extends DTElementorWidgetBase {
    public function get_name() {
        return 'dt-advanced-carousel';
    }

    public function get_title() {
        return __('Advanced Carousel', 'dt-elementor');
    }

    public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_style_depends() {
		return array( 'slick','dt-advanced-carousel' );
	}

	public function get_script_depends() {
		return array( 'slick','dt-advanced-carousel' );		
	}

    protected function register_controls() {
        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'General', 'dt-elementor'),
        ) );
			$repeater = new Repeater();
			$repeater->add_control( 'item_type', array(
				'label'   => __( 'Content Type', 'dt-elementor' ),
				'type'    => Controls_Manager::SELECT2,
				'default' => 'default',
				'options' => array(
					'default'  => __( 'Default', 'dt-elementor' ),
					'template' => __( 'Template', 'dt-elementor' ),
				)
			) );
			$repeater->add_control( 'item_image', array(
				'label'     => esc_html__( 'Image', 'dt-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array( 'url' => Utils::get_placeholder_image_src(), ),
				'condition' => array( 'item_type' => 'default' )
			) );
			$repeater->add_control( 'item_title', array(
				'label'       => __( 'Title', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Item Title', 'dt-elementor' ),
				'default'     => __( 'Item Title', 'dt-elementor' ),
				'condition'   => array( 'item_type' => 'default' )
			) );
			$repeater->add_control( 'item_text', array(
				'label'       => __( 'Description', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => __( 'Item Description', 'dt-elementor' ),
				'default'     => 'Sed ut perspiciatis unde omnis iste natus error sit, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.',
				'condition'   => array( 'item_type' => 'default' )
			) );
			$repeater->add_control( 'item_link', array(
				'label'       => __( 'Link', 'dt-elementor' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com', 'dt-elementor' ),
				'condition'   => array( 'item_type' => 'default' )
			) );
			$repeater->add_control( 'item_button_text', array(
				'label'     => esc_html__( 'Item Button Text', 'dt-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'condition' => array( 'item_type' => 'default', ),
			) );			
			$repeater->add_control('item_template', array(
				'label'     => __( 'Select Template', 'dt-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->dt_get_elementor_page_list(),
				'condition' => array( 'item_type' => 'template' )
			) );
			$this->add_control( 'dt_carousel_slider_content', array(
				'type'        => Controls_Manager::REPEATER,
				'label'       => __('Carousel Items', 'dt-elementor'),
				'description' => __('Carousel items is a template which you can choose from Elementor library. Each template will be a carousel content', 'dt-elementor' ),
				'fields'      => array_values( $repeater->get_controls() ),
			) );
        $this->end_controls_section();

		$this->start_controls_section( 'dt_section_additional', array(
			'label' => __( 'Carousel Options', 'dt-elementor'),
		) );
			$this->add_control( 'slider_type', array(
				'label'              => __( 'Slider Type', 'dt-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'horizontal',
				'frontend_available' => true,
				'options'            => array(
					'horizontal' => __( 'Horizontal', 'dt-elementor' ),
					'vertical'   => __( 'Vertical', 'dt-elementor' ),
				),
			) );
			$this->add_control( 'slide_to_scroll', array(
				'label'              => __( 'Slider Type', 'dt-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'single',
				'frontend_available' => true,
				'options'            => array(
					'all'    => __( 'All visible', 'dt-elementor' ),
					'single' => __( 'One at a Time', 'dt-elementor' ),
				),
			) );
			$this->add_responsive_control( 'item_to_show', array(
				'label'           => __( 'Items To Show', 'dt-elementor' ),
				'type'            => Controls_Manager::NUMBER,
				'min'             => 1,
				'max'             => 25,
				'step'            => 1,
				'desktop_default' => 5,
				'tablet_default'  => 2,
				'mobile_default'  => 1,
			) );
			$this->add_control( 'infinite_loop', array(
				'label'              => __( 'Infinite loop', 'dt-elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true
			) );
			$this->add_control( 'speed', array(
				'label'       => __( 'Transition speed', 'dt-elementor' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'max'         => 10000,
				'step'        => 1,
				'default'     => 300,
				'description' => __( "Speed at which next slide comes.(ms)", "dt-elementor" ),
			) );
			$this->add_control( 'autoplay', array(
				'label'              => __( 'Autoplay Slides?', 'dt-elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true
			) );
			$this->add_control( 'autoplay_speed', array(
				'label'       => __( 'Autoplay speed', 'dt-elementor' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'max'         => 10000,
				'step'        => 1,
				'default'     => 5000,
				'condition'   => array( 'autoplay' => 'yes' ),
				'description' => __( "Speed at which next slide comes.(ms)", "dt-elementor" ),
			) );
			$this->add_control( 'centermode', array(
				'label'              => __( 'Center Mode?', 'dt-elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'description'        => __( "Allow slides to be in center mode", "dt-elementor" ),
			) );			
			$this->add_control( 'draggable', array(
				'label'              => __( 'Draggable Effect?', 'dt-elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'description'        => __( "Allow slides to be draggable", "dt-elementor" ),
			) );
			$this->add_control( 'touch_move', array(
				'label'              => __( 'Touch Move Effect?', 'dt-elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'description'        => __( "Enable slide moving with touch", "dt-elementor" ),
				'condition'          => array( 'draggable' => 'yes' ),
			) );
			$this->add_control( 'adaptive_height', array(
				'label'              => __( 'Adaptive Height', 'dt-elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'description'        => __( "Turn on Adaptive Height", "dt-elementor" ),
			) );
			$this->add_control( 'pauseohover', array(
				'label'              => __( 'Pause on hover', 'dt-elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'condition'          => array( 'autoplay' => 'yes' ),
				'description'        => __( "Pause the slider on hover", "dt-elementor" ),
			) );						
		$this->end_controls_section();

		$this->start_controls_section( 'dt_arrow_section', array(
			'label' => esc_html__( 'Arrow', 'dt-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		) );
			$this->add_control( 'arrows', array(
				'label'              => __( 'Navigation Arrows', 'dt-elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'description' => __( "Display next / previous navigation arrows", "dt-elementor" ),				
			) );
			$this->add_control( 'arrow_style', array(
				'label'              => __( 'Arrow Style', 'dt-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'default',
				'frontend_available' => true,
				'condition'          => array( 'arrows' => 'yes' ),
				'options'            => array(
					'default'       => __('Default', 'dt-elementor' ),
					'circle-bg'     => __('Circle Background', 'dt-elementor' ),
					'square-bg'     => __('Square Background','dt-elementor'),
					'circle-border' => __('Circle Border','dt-elementor'),
					'square-border' => __('Square Border','dt-elementor'),
				),
			) );
			$this->add_control( 'prev_arrow', array(
				'label'     => __('Previous Arrow','dt-elementor'),
				'type'      => Controls_Manager::ICON,
				'condition' => array( 'arrows' => 'yes' ),
				'include'   => array(
					'fas fa-angle-double-left',
					'fas fa-arrow-left',
					'fas fa-arrow-alt-circle-left',
					'fas fa-arrow-circle-left',
					'fas fa-long-arrow-alt-left',
					'fas fa-chevron-left',
					'fas fa-caret-left',
					'fas fa-angle-left',
				),
				'default' => ''
			) );	
			$this->add_control( 'next_arrow', array(
				'label'     => __('Next Arrow','dt-elementor'),
				'type'      => Controls_Manager::ICON,
				'condition' => array( 'arrows' => 'yes' ),
				'include'   => array(
					'fas fa-angle-double-right',
					'fas fa-arrow-right',
					'fas fa-arrow-alt-circle-right',
					'fas fa-arrow-circle-right',
					'fas fa-long-arrow-alt-right',
					'fas fa-chevron-right',
					'fas fa-caret-right',
					'fas fa-angle-right',
				),
				'default' => ''
			) );		
		$this->end_controls_section();

		$this->start_controls_section( 'dt_navigation_section', array(
			'label' => esc_html__( 'Navigation', 'dt-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		) );
			$this->add_control( 'navigation', array(
				'label'              => __( 'Dot Navigation', 'dt-elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'description'        => __( "Display dot navigation", "dt-elementor" ),
			) );
			/*$this->add_control( 'dot_color', array(
				'label'     => __( 'Dot Collor', 'dt-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array( 'navigation' => 'yes' ),
				'selectors' => '{{WRAPPER}}'
			) );*/
			$this->add_control( 'dot_style', array(
				'label'              => __( 'Dot Style', 'dt-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'slick-dots style-1',
				'frontend_available' => true,
				'condition'          => array( 'navigation' => 'yes' ),
				'options'            => array(
					'slick-dots style-1' 	=> __('Style 1', 'dt-elementor' ),
					'slick-dots style-2'    => __('Style 2', 'dt-elementor' ),
					'slick-dots style-3'    => __('Style 3', 'dt-elementor' ),
					'slick-dots style-4'    => __('Style 4', 'dt-elementor' ),
					'slick-dots style-5'    => __('Style 5', 'dt-elementor' ),
					'slick-dots style-6'    => __('Style 6', 'dt-elementor' ),
					'slick-dots style-7'    => __('Style 7', 'dt-elementor' ),
					'slick-dots style-8'    => __('Style 8', 'dt-elementor' ),
				),
			) );						
		$this->end_controls_section();				
    }

    protected function render() {
    	$out = '';
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( $slide_to_scroll == 'all' ) {
			$slide_to_scroll = $item_to_show;
			$slide_to_tab    =	$item_to_show_tablet;
			$slide_to_mob    = $item_to_show_mobile;
        } else {
			$slide_to_scroll = 1;
			$slide_to_tab =	1;
			$slide_to_mob = 1;
		}

        $carousel_settings = array(
			'centerMode'        	=> ( $centermode == 'yes' ) ? true : false,
			'adaptiveHeight'        => ( $adaptive_height == 'yes' ) ? true : false,
			'arrows'                => ( $arrows == 'yes' ) ? true : false,
			'arrows'                => ( $arrows == 'yes' ) ? true : false,
			'autoplay'              => ( $autoplay == 'yes' ) ? true : false,
			'dots'                  => ( $navigation == 'yes' ) ? true : false,
			'dotsClass'             => ( $navigation == 'yes' ) ? $dot_style : 'slick-dots',
			'draggable'             => ( $draggable == 'yes' ) ? true : false,
			'swipe'                 => ( $draggable == 'yes' ) ? true : false,
			'infinite'              => ( $infinite_loop == 'yes' ) ? true : false,
			'pauseOnDotsHover'      => true,
			'pauseOnFocus'          => false,
			'pauseOnHover'          => ( $pauseohover == 'yes' ) ? true : false,
			'slidesToScroll'        => $slide_to_scroll,
			'slidesToShow'          => $item_to_show,
			'speed'                 => $speed,
			'touchMove'             => ( $touch_move == 'yes' ) ? true : false,
			'vertical'              => ( $slider_type == 'vertical' ) ? true : false,
			'desktopSlidesToShow'   => $item_to_show,
			'desktopSlidesToScroll' => $slide_to_scroll,
			'tabletSlidesToShow'    => isset($item_to_show_tablet) ? $item_to_show_tablet : 2,
			'tabletSlidesToScroll'  => $slide_to_tab,
			'mobileSlidesToShow'    => isset($item_to_show_mobile) ? $item_to_show_mobile : 1,
			'mobileSlidesToScroll'  => $slide_to_mob,
        );

        if( $arrows == 'yes' ) {
        	$carousel_settings['nextArrow'] = '<button type="button" class="'.esc_attr( $arrow_style ).' slick-next"> <span class="'.esc_attr( $next_arrow ).'"></span> </button>';
        	$carousel_settings['prevArrow'] = '<button type="button" class="'.esc_attr( $arrow_style ).' slick-prev"> <span class="'.esc_attr( $prev_arrow ).'"></span> </button>';
        }

        if(  $autoplay == 'yes' && !empty( $$autoplay_speed ) ) {
        	$carousel_settings['autoplaySpeed'] = $autoplay_speed;
        }

        $out .= "<div class='dt-advanced-carousel-wrapper' data-settings='".wp_json_encode($carousel_settings)."'>";

			if( count( $dt_carousel_slider_content ) > 0 ) {
				foreach( $dt_carousel_slider_content as $key => $item ) {
					$out .= '<div class="dt-advanced-carousel-item-wrapper">';
						if( $item['item_type'] == 'default' ) {

							$link = '';
							if( !empty( $item['item_link']['url'] ) ){

								$target = ( $item['item_link']['is_external'] == 'on' ) ? ' target="_blank" ' : '';
								$target = ( $item['item_link']['nofollow'] == 'on' ) ? 'rel="nofollow" ' : '';

								$link = '<a href="'.esc_url( $item['item_link']['url'] ).'"'. $target . $nofollow.'>';
							}

							$out .= '<div class="dt-slick-content-wrapper">';

								$image_link = false;
								$image      = $item['item_image'];

								if( !empty( $image['id'] ) ) {

									$image_link = true;

									$out .= '<div class="dt-slick-content-image">';
										$out .= $link;
											$out .= '<img src="'.esc_url( $image['url'] ).'" alt="'.esc_attr( $image['id'] ).'"/>';
										$out .= '</a>';
									$out .= '</div>';
								}

								if( !empty( $item['item_title'] ) || !empty( $item['item_text'] ) || !empty( $item['item_button_text'] ) ) {
									$out .= '<div class="dt-slick-content">';
										if( !empty( $item['item_title'] ) ) {
											$out .= '<div class="dt-slick-content-title">';
												$out .= ( !$image_link ) ? $link : '';
												$out .= esc_html( $item['item_title'] );
												$out .= ( !$image_link ) ? '</a>' : '';
											$out .= '</div>';
										}
										$out .= !empty( $item['item_text'] ) ? '<div class="dt-slick-content-text">'. esc_html( $item['item_text'] ) . '</div>' : '';

										if( !empty( $link ) ){
											$out .= !empty( $item['item_button_text'] ) ? '<div class="dt-slick-content-btn">'. $link . $item['item_button_text'] .'</a> </div>' : '';
										}

									$out .= '</div>';
								}



							$out .= '</div>';
						}

						if( $item['item_type'] == 'template' ) {
							$frontend = Elementor\Frontend::instance();
							$template_content = $frontend->get_builder_content( $item['item_template'], true );
							$out .= "{$template_content}";
						}					
					$out .= '</div>';
				}
			}

        $out .= '</div>';

        echo $out;
    }

}