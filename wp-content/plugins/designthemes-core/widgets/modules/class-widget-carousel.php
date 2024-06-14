<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elementor_AnyCarousel extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-anycarousel';
    }

    public function get_title() {
        return __('Any Carousel', 'dt-elementor');
    }

    public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_style_depends() {
		return array( 'swiper','dt-anycarousel' );
	}

	public function get_script_depends() {
		return array( 'swiper', 'dt-anycarousel' );		
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
			$repeater->add_control('dt_carousel_slider_template', array(
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

		$slides_per_view = range( 1, 10 );
		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_responsive_control( 'slides_to_show', array(
			'type' => Controls_Manager::SELECT,
			'label' => __( 'Slides to Show', 'dt-elementor' ),
			'options' => $slides_per_view,
			'default' => 1,
			'frontend_available' => true
		) );

		$this->add_responsive_control( 'slides_to_scroll', array(
			'type' => Controls_Manager::SELECT,
			'label' => __( 'Slides to Scroll', 'dt-elementor' ),
			'options' => $slides_per_view,
			'default' => 1,
			'frontend_available' => true
		) );

		$this->add_control( 'effect', array(
			'label' => __( 'Effect', 'dt-elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'slide',
			'options' => array(
				'slide' => __( 'Slide', 'dt-elementor' ),
				'fade' => __( 'Fade', 'dt-elementor' ),
				'cube' => __( 'Cube', 'dt-elementor' ),
				'coverflow' => __( 'Coverflow', 'dt-elementor' ),
				'flip' => __( 'Flip', 'dt-elementor' ),
			),
			'frontend_available' => true,
		));

		$this->add_control( 'arrows', array(
			'label' => __( 'Arrows', 'dt-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'frontend_available' => true
		) );

		$this->add_control( 'pagination', array(
			'label' => __( 'Pagination', 'dt-elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'bullets',
			'options' => array(
				'' => __( 'None', 'dt-elementor' ),
				'bullets' => __( 'Dots', 'dt-elementor' ),
				'fraction' => __( 'Fraction', 'dt-elementor' ),
				'progressbar' => __( 'Progress', 'dt-elementor' ),
				'scrollbar' => __( 'Scrollbar', 'dt-elementor' ),
			),
			'frontend_available' => true
		));

		$this->add_control( 'speed', array(
			'label' => __( 'Transition Duration', 'dt-elementor' ),
			'type' => Controls_Manager::NUMBER,
			'default' => 2000,
			'frontend_available' => true
		));

		$this->add_control( 'autoplay', array(
			'label' => __( 'Autoplay', 'dt-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'separator' => 'before',
			'frontend_available' => true
		));

		$this->add_control( 'autoplay_speed', array(
			'label' => __( 'Autoplay Speed', 'dt-elementor' ),
			'type' => Controls_Manager::NUMBER,
			'default' => 5000,
			'condition' => array(
				'autoplay' => 'yes',
				'carousel' => 'yes'
			),
			'frontend_available' => true
		));

		$this->add_control( 'loop', array(
			'label' => __( 'Infinite Loop', 'dt-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'default' => 'yes',
			'frontend_available' => true
		));

		$this->add_control( 'pause_on_interaction', array(
			'label' => __( 'Pause on Interaction', 'dt-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'default' => 'yes',
			'condition' => array(
				'autoplay' => 'yes',
				'carousel' => 'yes'
			),
			'frontend_available' => true
		));

		$this->add_control( 'el_class', array(
			'type'        => Controls_Manager::TEXT,
			'label'       => __('Extra class name', 'dt-elementor'),
			'description' => __('Style particular element differently - add a class name and refer to it in custom CSS', 'dt-elementor')
		) );

        $this->end_controls_section();


        $this->start_controls_section( 'section_item_title_style', array(
        	'label'      => esc_html__( 'Item Title', 'dt-elementor' ),
			'tab'        => Controls_Manager::TAB_STYLE,
			'show_label' => false,
		) );

			$this->start_controls_tabs( 'tabs_title_style' );

				$this->start_controls_tab( 'tab_title_normal', array(
					'label' => esc_html__( 'Normal', 'dt-elementor' ),
				) );
					$this->add_control( 'items_title_color', array(
						'label'     => esc_html__( 'Title Color', 'dt-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array( '{{WRAPPER}} .dt-swiper-content-title' => 'color: {{VALUE}}', ),
					) );
				$this->end_controls_tab();

				$this->start_controls_tab( 'tab_title_hover', array(
					'label' => esc_html__( 'Hover', 'dt-elementor' ),
				) );
					$this->add_control( 'items_title_color_hover', array(
						'label'     => esc_html__( 'Title Color', 'dt-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array( '{{WRAPPER}} swiper-slide:hover .dt-swiper-content-title' => 'color: {{VALUE}}', ),
					) );
				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control( Group_Control_Typography::get_type(), array(
				'name'     => 'items_title_typography',
				'selector' => '{{WRAPPER}} .dt-swiper-content-title',
				'separator' => 'before',
			) );

        $this->end_controls_section();

        $this->start_controls_section( 'section_item_description_style', array(
        	'label'      => esc_html__( 'Item Content', 'dt-elementor' ),
			'tab'        => Controls_Manager::TAB_STYLE,
			'show_label' => false,
		) );
			$this->start_controls_tabs( 'tabs_description_style' );

				$this->start_controls_tab( 'tab_description_normal', array(
					'label' => esc_html__( 'Normal', 'dt-elementor' ),
				) );
					$this->add_control( 'items_description_color', array(
						'label'     => esc_html__( 'Content Color', 'dt-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array( '{{WRAPPER}} .dt-swiper-content-text' => 'color: {{VALUE}}', ),
					) );
				$this->end_controls_tab();

				$this->start_controls_tab( 'tab_description_hover', array(
					'label' => esc_html__( 'Hover', 'dt-elementor' ),
				) );
					$this->add_control( 'items_description_color_hover', array(
						'label'     => esc_html__( 'Content Color', 'dt-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array( '{{WRAPPER}} swiper-slide:hover .dt-swiper-content-text' => 'color: {{VALUE}}', ),
					) );
				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control( Group_Control_Typography::get_type(), array(
				'name'     => 'items_description_typography',
				'selector' => '{{WRAPPER}} .dt-swiper-content-text',
				'separator' => 'before',
			) );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        extract($settings);

        $carousel_settings = array(
            'slides_to_show' 			=> !empty( $slides_to_show ) ? $slides_to_show : 3,
            'slides_to_scroll'      	=> !empty( $slides_to_scroll ) ? $slides_to_scroll : 1,
			'effect'					=> $effect,
			'arrows'					=> $arrows,
			'direction'					=> 'horizontal',
			'pagination'				=> $pagination,
			'speed'						=> $speed,
			'autoplay'   				=> $autoplay,
			'autoplay_speed'   			=> !empty( $autoplay_speed ) ? $autoplay_speed : '',
			'loop'						=> $loop,
			'pause_on_interaction'		=> $pause_on_interaction,

            'slides_to_show_tablet'		=> $slides_to_show_tablet,
            'slides_to_scroll_tablet'   => $slides_to_scroll_tablet,

			'slides_to_show_mobile'   	=> $slides_to_show_mobile,
			'slides_to_scroll_mobile'   => $slides_to_scroll_mobile,
        );

		$out = "<div class='dt-sc-any-carousel-wrapper {$el_class} carousel_items' data-settings='".wp_json_encode($carousel_settings)."'>";

			if( count( $dt_carousel_slider_content ) > 0 ):

				$out .= '<div class="dt-sc-any-carousel swiper-wrapper">';

					foreach( $dt_carousel_slider_content as $key => $item ) {

						$out .= '<div class="swiper-slide">';
							if( $item['item_type'] == 'default' ) {

								$link = '';
								if( !empty( $item['item_link']['url'] ) ){

									$target = ( $item['item_link']['is_external'] == 'on' ) ? ' target="_blank" ' : '';
									$target = ( $item['item_link']['nofollow'] == 'on' ) ? 'rel="nofollow" ' : '';

									$link = '<a href="'.esc_url( $item['item_link']['url'] ).'"'. $target . $nofollow.'>';
								}

								$out .= '<div class="dt-swiper-content-wrapper">';

									$image_link = false;
									$image      = $item['item_image'];

									if( !empty( $image['id'] ) ) {

										$image_link = true;

										$out .= '<div class="dt-swiper-content-image">';
											$out .= $link;
												$out .= '<img src="'.esc_url( $image['url'] ).'" alt="'.esc_attr( $image['id'] ).'"/>';
											$out .= '</a>';
										$out .= '</div>';
									}

									if( !empty( $item['item_title'] ) || !empty( $item['item_text'] ) || !empty( $item['item_button_text'] ) ) {
										$out .= '<div class="dt-swiper-content">';
											if( !empty( $item['item_title'] ) ) {
												$out .= '<div class="dt-swiper-content-title">';
													$out .= ( !$image_link ) ? $link : '';
													$out .= esc_html( $item['item_title'] );
													$out .= ( !$image_link ) ? '</a>' : '';
												$out .= '</div>';
											}
											$out .= !empty( $item['item_text'] ) ? '<div class="dt-swiper-content-text">'. esc_html( $item['item_text'] ) . '</div>' : '';

											if( !empty( $link ) ){
												$out .= !empty( $item['item_button_text'] ) ? '<div class="dt-swiper-content-btn">'. $link . $item['item_button_text'] .'</a> </div>' : '';
											}

										$out .= '</div>';
									}



								$out .= '</div>';
							}

							if( $item['item_type'] == 'template' ) {
								$frontend = Elementor\Frontend::instance();
								$template_content = $frontend->get_builder_content( $item['dt_carousel_slider_template'], true );
								$out .= "{$template_content}";
							}
						$out .= '</div>';
					}

				$out .= '</div>';

				if ( count( $dt_carousel_slider_content ) > 1 ) :
					if ( isset( $pagination ) && $pagination == 'scrollbar' ) :
						$out .= '<div class="swiper-scrollbar"></div>';
					elseif ( isset( $pagination ) && $pagination != 'scrollbar' ) :
						$out .= '<div class="swiper-pagination"></div>';
					endif;
					if ( isset( $arrows ) && $arrows == 'yes' ) :
						$out .= '<div class="dt-swiper-button swiper-button-prev">';
							$out .= '<i class="eicon-chevron-left"></i>';
						$out .= '</div>';
						$out .= '<div class="dt-swiper-button swiper-button-next">';
							$out .= '<i class="eicon-chevron-right"></i>';
						$out .= '</div>';
					endif;
				endif;

			endif;

		$out .= '</div>';

		echo $out;
	}

    protected function content_template() {
    }
}