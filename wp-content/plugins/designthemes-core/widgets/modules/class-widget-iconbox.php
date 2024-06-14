<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color as Scheme_Color;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_IconBox extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-iconbox';
    }

    public function get_title() {
        return __('Iconbox', 'dt-elementor');
    }

    public function get_icon() {
		return 'fas fa-icons';
	}

	public function get_style_depends() {
		return array( 'dt-iconbox' );
	}

	protected function register_controls() {

        $this->start_controls_section( 'dt_section_general', array(
            'label' => esc_html__( 'General', 'dt-elementor'),
        ) );

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'dt-elementor' ),
					'type' => Controls_Manager::TEXT
				]
			);

			$this->add_control(
				'subtitle',
				[
					'label' => esc_html__( 'Sub Title', 'dt-elementor' ),
					'type' => Controls_Manager::TEXT
				]
			);

			$this->add_control(
				'icon_image',
				[
					'label' => esc_html__( 'Icon / Image', 'dt-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'icon',
					'options' => array(
						'icon' => esc_html__( 'Icon', 'dt-elementor' ),
						'image' => esc_html__( 'Image', 'dt-elementor' )
					),
				]
			);

			$this->add_control(
				'selected_icon',
				[
					'label' => esc_html__( 'Icon', 'dt-elementor' ),
					'type' => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'default' => array(
						'value' => 'fas fa-star',
						'library' => 'fa-solid',
					),
					'condition' => array( 'icon_image' => 'icon' )
				]
			);

			$this->add_control(
				'selected_image',
				[
					'label' => esc_html__( 'Image', 'dt-elementor' ),
					'type'  => Controls_Manager::MEDIA,
					'default' => array( 'url' => Utils::get_placeholder_image_src(), ),
					'condition' => array( 'icon_image' => 'image' )
				]
			);

			$this->add_control(
				'background_image',
				[
					'label' => esc_html__( 'Background Image', 'dt-elementor' ),
					'type'  => Controls_Manager::MEDIA,
					'default' => array( 'url' => Utils::get_placeholder_image_src(), )
				]
			);

			$this->add_control(
				'hover_image',
				[
					'label' => esc_html__( 'Hover Image', 'dt-elementor' ),
					'type'  => Controls_Manager::MEDIA,
					'default' => array( 'url' => Utils::get_placeholder_image_src(), )
				]
			);

			$this->add_control(
				'link',
				[
					'label'       => __( 'Link', 'dt-elementor' ),
					'type'        => Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'dt-elementor' )
				]
			);

			$this->add_control(
				'el_class',
				[
					'type' => Controls_Manager::TEXT,
					'label'       => __('Extra class name', 'dt-elementor'),
					'description' => __('Style particular element differently - add a class name and refer to it in custom CSS', 'dt-elementor')
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'dt-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Text Color', 'dt-elementor' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .dt-sc-iconbox-wrapper .dt-sc-iconbox-description h3' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography_title',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .dt-sc-iconbox-wrapper .dt-sc-iconbox-description h3',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_subtitle',
			[
				'label' => esc_html__( 'Sub Title', 'dt-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'subtitle_color',
				[
					'label' => esc_html__( 'Text Color', 'dt-elementor' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .dt-sc-iconbox-wrapper .dt-sc-iconbox-description h4' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography_subtitle',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .dt-sc-iconbox-wrapper .dt-sc-iconbox-description h4',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'dt-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'dt-elementor' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .dt-sc-iconbox-wrapper .dt-sc-iconbox-container span' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography_icon',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .dt-sc-iconbox-wrapper .dt-sc-iconbox-container',
				]
			);

		$this->end_controls_section();
	}

    protected function render() {

		$settings = $this->get_settings();
		extract( $settings );

		$output = '<div class="dt-sc-iconbox-wrapper '.esc_attr($el_class).'">';
			
			$output .= '<div class="dt-sc-iconbox-container">';

				if( !empty( $background_image['id'] ) ):
					$output .= '<div class="iconbox-bg">';
						$output .= '<img src="'.esc_url( $background_image['url'] ).'" alt="'.esc_attr( $background_image['id'] ).'"/>';
					$output .= '</div>';
				endif;

				if( $icon_image == 'icon' ):

					if( $selected_icon['library'] == 'svg' ) {
						$output .= '<img src="'.esc_url( $selected_icon['value']['url'] ).'" alt="'.esc_attr( $selected_icon['value']['id'] ).'" />';
					} else {
						$output .= '<span class="'.esc_attr( $selected_icon['value'] ).'"></span>';
					}

				elseif( $icon_image == 'image' && !empty( $selected_image['id'] ) ):
					$output .= '<img src="'.esc_url( $selected_image['url'] ).'" alt="'.esc_attr( $selected_image['id'] ).'" />';
				endif;

				if( !empty( $hover_image['id'] ) ):
					$output .= '<div class="iconbox-hover">';
						$output .= '<img src="'.esc_url( $hover_image['url'] ).'" alt="'.esc_attr( $hover_image['id'] ).'" />';
					$output .= '</div>';
				endif;
			$output .= '</div>';

			$output .= '<div class="dt-sc-iconbox-description">';
				if ( ! empty( $settings['link']['url'] ) ) {
					$output .= '<h3><a href="'.$settings['link']['url'].'" title="'.$title.'">'.$title.'</a></h3>';
				} else {
					$output .= '<h3>'.$title.'</h3>';
				}
				$output .= '<h4>'.$subtitle.'</h4>';
			$output.= '</div>';

		$output .= '</div>';

		echo $output;
	}

	protected function content_template() {
    }
}