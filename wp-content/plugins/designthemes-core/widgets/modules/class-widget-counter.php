<?php

use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Core\Schemes\Color as Scheme_Color;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Group_Control_Typography;

class Elementor_Counter extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-counter';
    }

    public function get_title() {
        return esc_html__('Counter', 'dt-elementor');
    }

    public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_style_depends() {
		return array( 'dt-counter' );
	}

	public function get_script_depends() {
		return array( 'jquery-animateNumber', 'dt-counter' );
	}

    protected function register_controls() {

        $this->start_controls_section( 'dt_section_general', array(
            'label' => esc_html__( 'General', 'dt-elementor'),
        ) );

			$this->add_control(
				'type',
				[
					'label' => esc_html__( 'Type', 'dt-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'type1',
					'options' => array(
						'type1' => esc_html__( 'Default', 'dt-elementor' ),
						'type2' => esc_html__( 'Type 2', 'dt-elementor' )
					),
				]
			);

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
				'selected_icon',
				[
					'label' => esc_html__( 'Icon', 'dt-elementor' ),
					'type' => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'default' => [
						'value' => 'fas fa-star',
						'library' => 'fa-solid',
					],
				]
			);

			$this->add_control(
				'number',
				[
					'label' => esc_html__( 'Number', 'dt-elementor' ),
					'type' => Controls_Manager::NUMBER
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
						'{{WRAPPER}} h4' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography_title',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} h4',
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
						'{{WRAPPER}} .dt-sc-counter-subtitle' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography_subtitle',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .dt-sc-counter-subtitle',
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
					'label' => esc_html__( 'Text Color', 'dt-elementor' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .dt-sc-counter-icon-wrapper span' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography_icon',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .dt-sc-counter-icon-wrapper',
				]
			);

		$this->end_controls_section();

		
		$this->start_controls_section(
			'section_number',
			[
				'label' => esc_html__( 'Number', 'dt-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'number_color',
				[
					'label' => esc_html__( 'Text Color', 'dt-elementor' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .dt-sc-counter-number' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography_number',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .dt-sc-counter-number',
				]
			);

		$this->end_controls_section();

		
    }

    protected function render() {
		
		$settings = $this->get_settings();
		extract($settings);
		
		$output = '<div class="dt-sc-counter-wrapper '.esc_attr($type).'">';
			$output .= '<div class="dt-sc-counter-inner">';

				$output .= ( $type == 'type1' ) ? '<div class="dt-sc-couter-icon-holder">' : '';

				$output .= '<div class="dt-sc-counter-icon-wrapper">';
					if($selected_icon['library'] == 'svg') {
						$output .= '<img src="'.esc_attr($selected_icon['value']['url']).'"></img>';
					} else {
						$output .= '<span class="'.esc_attr($selected_icon['value']).'"></span>';
					}
				$output .= '</div>';
				$output .= '<div class="dt-sc-counter-number" data-value="'.esc_attr($number).'">'.esc_attr($number).'</div>';

				$output .= ( $type == 'type1' ) ? '</div>' : '';

				$output .= '<div class="dt-sc-counter-content-wrapper">';
					if(!empty($title)) {
						$output .= '<h4 class="dt-sc-counter-title">'.esc_attr($title).'</h4>';
					}
					if(!empty($subtitle)) {
						$output .= '<div class="dt-sc-counter-subtitle">'.esc_attr($subtitle).'</div>';
					}
				$output .= '</div>';				
			$output .= '</div>';
		$output .= '</div>';

		echo $output;

	}

    protected function content_template() {
    }
}