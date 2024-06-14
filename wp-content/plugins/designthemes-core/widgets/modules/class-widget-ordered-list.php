<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elementor_OrderedList extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-ordered-list';
    }

    public function get_title() {
        return __('Ordered List', 'dt-elementor');
    }

    public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_style_depends() {
		return array( 'dt-ordered-list' );		
	}

    protected function register_controls() {

		$this->start_controls_section( 'section_icon', array(
			'label' => __( 'Ordered List', 'dt-elementor' ),
		) );

			$this->add_control( 'view', array(
				'label'          => __( 'Layout', 'dt-elementor' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'traditional',
				'render_type'    => 'template',
				'classes'        => 'elementor-control-start-end',
				'label_block'    => false,
				'style_transfer' => true,
				'prefix_class'   => 'elementor-icon-list--layout-',
				'options'        => array(
					'traditional' => array( 'title' => __( 'Default', 'dt-elementor' ), 'icon' => 'eicon-editor-list-ul' ),
					'inline'      => array( 'title' => __( 'Inline', 'dt-elementor' ), 'icon' => 'eicon-ellipsis-h' ),
				),
			) );


			$this->add_control( 'style', array(
				'label'        => __( 'Ordered Style', 'dt-elementor' ),
				'type'         => Controls_Manager::SELECT2,
				'default'      => 'decimal-leading-zero',
				'label_block'  => true,
				'options'      => array(
					'decimal'              => __( 'Decimal', 'dt-elementor' ),
					'decimal-leading-zero' => __( 'Decimal With Leading Zero', 'dt-elementor' ),
					'lower-alpha'          => __( 'Lower Alpha', 'dt-elementor' ),
					'lower-roman'          => __( 'Lower Roman', 'dt-elementor' ),
					'upper-alpha'          => __( 'Upper Alpha', 'dt-elementor' ),
					'upper-roman'          => __( 'Upper Roman', 'dt-elementor' ),
				),
			) );


			$repeater = new Repeater();

			$repeater->add_control( 'text', array(
				'label'       => __( 'Text', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'List Item', 'dt-elementor' ),
				'default'     => __( 'List Item', 'dt-elementor' ),
			) );

			$repeater->add_control( 'link', array(
				'label'       => __( 'Link', 'dt-elementor' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com', 'dt-elementor' ),
			) );

			$this->add_control( 'list', array(
				'label'   => '',
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array( 'text' => __( 'List Item #1', 'dt-elementor' ) ),
					array( 'text' => __( 'List Item #2', 'dt-elementor' ) ),
					array( 'text' => __( 'List Item #3', 'dt-elementor' ) ),
					array( 'text' => __( 'List Item #4', 'dt-elementor' ) ),
					array( 'text' => __( 'List Item #5', 'dt-elementor' ) ),
				)
			) );

		$this->end_controls_section();

		$this->start_controls_section( 'section_icon_list', array(
			'label' => __( 'List', 'dt-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		) );

			$this->add_responsive_control( 'space_between', array(
				'label'     => __( 'Space Between', 'dt-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'max' => 50 ) ),
				'selectors' => array(
					'{{WRAPPER}} .dt-elementor-ordered-list-items:not(.elementor-inline-items) .dt-elementor-ordered-list-item:not(:last-child)'  => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .dt-elementor-ordered-list-items:not(.elementor-inline-items) .dt-elementor-ordered-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .dt-elementor-ordered-list-items.elementor-inline-items .dt-elementor-ordered-list-item'                         => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .dt-elementor-ordered-list-items.elementor-inline-items'                                                         => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .dt-elementor-ordered-list-items.elementor-inline-items .elementor-ordered-list-item:after'             => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .dt-elementor-ordered-list-items.elementor-inline-items .dt-elementor-ordered-list-item:after'    => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				)
			) );

			$this->add_responsive_control( 'align', array(
				'label'        => __( 'Alignment', 'dt-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'prefix_class' => 'elementor%s-align-',
				'options'      => array(
					'left'   => array( 'title' => __('Left','dt-elementor'), 'icon' => 'eicon-h-align-left' ),
					'center' => array( 'title' => __('Center','dt-elementor'), 'icon' => 'eicon-h-align-center' ),
					'right'  => array( 'title' => __('Right','dt-elementor'), 'icon' => 'eicon-h-align-right' ),
				)
			) );

		$this->end_controls_section();


		$this->start_controls_section( 'section_text_style', array(
			'label' => __( 'Text', 'dt-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		) );

			$this->add_control( 'color', array(
				'label'     => __( 'Color', 'dt-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array( '{{WRAPPER}} .dt-elementor-ordered-list-item span' => 'color: {{VALUE}};' ),
			) );

			$this->add_control( 'hover_color', array(
				'label'     => __( 'Hover Color', 'dt-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array( '{{WRAPPER}} .dt-elementor-ordered-list-item:hover span' => 'color: {{VALUE}};' ),
			) );

			$this->add_group_control( Group_Control_Typography::get_type(), array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .dt-elementor-ordered-list-item',
			) );

		$this->end_controls_section();

	}

    protected function render() {

    	$output = '';

		$settings = $this->get_settings_for_display();
		extract($settings);

		$this->add_render_attribute( 'list', 'class', 'dt-elementor-ordered-list-items dt-sc-fancy-list' );
		$this->add_render_attribute( 'list', 'class', $style );

		$this->add_render_attribute( 'items', 'class', 'dt-elementor-ordered-list-item' );
		if ( 'inline' === $settings['view'] ) {
			$this->add_render_attribute( 'list', 'class', 'elementor-inline-items' );
			$this->add_render_attribute( 'items', 'class', 'elementor-inline-item' );
		}

		$output .= '<ol '.$this->get_render_attribute_string( 'list' ).'>';
			foreach( $list as $index => $item ) {
				$output .= '<li '.$this->get_render_attribute_string( 'items' ).'>';
					$output .= '<span>';
						if ( ! empty( $item['link']['url'] ) ) {
							$link_key = 'link_' . $index;

							$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

							if ( $item['link']['is_external'] ) {
								$this->add_render_attribute( $link_key, 'target', '_blank' );
							}

							if ( $item['link']['nofollow'] ) {
								$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
							}

							$output .= '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
						}

						$output .= $item['text'];

						if ( ! empty( $item['link']['url'] ) ) {
							$output .= '</a>';
						}
					$output .= '</span>';
				$output .= '</li>';
			}
		$output .= '</ol>';

		echo $output;
	}
}