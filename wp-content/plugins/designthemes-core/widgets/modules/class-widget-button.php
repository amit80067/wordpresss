<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;

class Elementor_Button extends DTElementorWidgetBase {
    public function get_name() {
        return 'dt-button';
    }

    public function get_title() {
        return __('Button', 'dt-elementor');
    }

    public function get_icon() {
		return 'eicon-button';
	}

	public function get_style_depends() {
		return array( 'dt-button' );
	}	

    protected function register_controls() {
        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'Button', 'dt-elementor'),
        ) );
			$this->add_control( 'text', array(
				'label'       => __( 'Text', 'dt-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Click here', 'dt-elementor' ),
				'placeholder' => __( 'Click here', 'dt-elementor' ),
			) );
			$this->add_control( 'link',array(
				'label'       => __( 'Link', 'dt-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'dt-elementor' ),
				'default'     => array( 'url' => '#' ),
			) );
			$this->add_responsive_control( 'align', array(
				'label'   => __( 'Alignment', 'dt-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'    => array( 'title' => __( 'Left', 'dt-elementor' ), 'icon' => 'eicon-text-align-left', ),
					'center'  => array( 'title' => __( 'Center', 'dt-elementor' ), 'icon' => 'eicon-text-align-center', ),
					'right'   => array( 'title' => __( 'Right', 'dt-elementor' ), 'icon' => 'eicon-text-align-right', ),
					'justify' => array( 'title' => __( 'Justified', 'dt-elementor' ), 'icon' => 'eicon-text-align-justify', ),
				),
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
			) );
			$this->add_control( 'size', array(
				'label'          => __( 'Size', 'dt-elementor' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'sm',
				'options'        => array(
					'xs' => __( 'Extra Small', 'dt-elementor' ),
					'sm' => __( 'Small', 'dt-elementor' ),
					'md' => __( 'Medium', 'dt-elementor' ),
					'lg' => __( 'Large', 'dt-elementor' ),
					'xl' => __( 'Extra Large', 'dt-elementor' ),
				),
				'style_transfer' => true,
			) );
			$this->add_control( 'style', array(
				'label'          => __( 'Style', 'dt-elementor' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '',
				'options'        => array(
					''            => __( 'Default', 'dt-elementor' ),
					'dt-bordered' => __( 'Bordered', 'dt-elementor' ),
				),
				'style_transfer' => true,
			) );
			$this->add_control( 'corner', array(
				'label'          => __( 'Corner Style', 'dt-elementor' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '',
				'options'        => array(
					''                  => __( 'Default', 'dt-elementor' ),
					'dt-curve-cornered' => __( 'Curve', 'dt-elementor' ),
					'dt-round-cornered' => __( 'Rounded', 'dt-elementor' ),
				),
				'style_transfer' => true,
			) );			
			$this->add_control( 'selected_icon', array(
				'label'            => __( 'Icon', 'dt-elementor' ),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => true,
				'fa4compatibility' => 'icon',
			) );
			$this->add_control( 'icon_align', array(
				'label'     => __( 'Icon Position', 'dt-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array( 
					'left'  => __( 'Before', 'dt-elementor' ),
					'right' => __( 'After', 'dt-elementor' ),
				),
				'condition' => array(
					'selected_icon[value]!' => '',
				),
			) );
			$this->add_control( 'icon_indent', array(
				'label'     => __( 'Icon Spacing', 'dt-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'max' => 50, ), ),
				'selectors' => array(
					'{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			) );
        $this->end_controls_section();     
    }

    protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper dt-elementor-button-wrapper' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
			$this->add_render_attribute( 'button', 'class', 'elementor-button-link dt-elementor-button-link' );
		}

		$this->add_render_attribute( 'button', 'class', 'elementor-button dt-elementor-button' );
		$this->add_render_attribute( 'button', 'role', 'button' );

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
		}

		if ( ! empty( $settings['style'] ) ) {
			$this->add_render_attribute( 'button', 'class', $settings['style'] );
		}

		if ( ! empty( $settings['corner'] ) ) {
			$this->add_render_attribute( 'button', 'class', $settings['corner'] );
		}				

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}
		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<?php $this->render_text(); ?>
			</a>
		</div><?php
    }

	protected function render_text() {
		$settings = $this->get_settings_for_display();

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		if ( ! $is_new && empty( $settings['icon_align'] ) ) {
			$settings['icon_align'] = $this->get_settings( 'icon_align' );
		}

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'elementor-button-content-wrapper dt-elementor-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'elementor-button-icon',
					'elementor-align-icon-' . $settings['icon_align'],
				],
			],
			'text' => [
				'class' => 'elementor-button-text dt-elementor-button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<?php if ( $is_new || $migrated ) :
					Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
				else : ?>
					<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
				<?php endif; ?>
			</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['text']; ?></span>
		</span>
		<?php
	}

	public function on_import( $element ) {
		return Icons_Manager::on_import_migration( $element, 'icon', 'selected_icon' );
	}	    
}