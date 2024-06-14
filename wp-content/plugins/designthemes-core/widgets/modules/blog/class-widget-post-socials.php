<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Post_Socials extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-post-socials';
    }

    public function get_title() {
        return __('Post - Socials', 'dt-elementor');
    }

    public function get_icon() {
		return 'fa fa-share-square';
	}

    protected function register_controls() {

        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'General', 'dt-elementor'),
        ) );

            $this->add_control( 'post_id', array(
                'type'        => Controls_Manager::NUMBER,
                'label'       => __('Post ID', 'dt-elementor'),
                'description' => __( 'Enter Post ID (In single post no need to enter).', 'dt-elementor' ),
            ) );

            $this->add_control( 'style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Style', 'dt-elementor'),
                'default' => 'meta-elements-space',
                'options' => array(
                    'meta-elements-space'		 => __('Space', 'dt-elementor'),
                    'meta-elements-boxed'  		 => __('Boxed', 'dt-elementor'),
                    'meta-elements-boxed-curvy'  => __('Curvy', 'dt-elementor'),
                    'meta-elements-boxed-round'  => __('Round', 'dt-elementor'),
					'meta-elements-filled'  	 => __('Filled', 'dt-elementor'),
					'meta-elements-filled-curvy' => __('Filled Curvy', 'dt-elementor'),
					'meta-elements-filled-round' => __('Filled Round', 'dt-elementor'),
                ),
            ) );

            $this->add_control( 'el_class', array(
                'type'        => Controls_Manager::TEXT,
                'label'       => __('Extra class name', 'dt-elementor'),
                'description' => __('Style particular element differently - add a class name and refer to it in custom CSS', 'dt-elementor')
            ) );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        extract($settings);

		$out = '';

		if( empty( $post_id ) ) {
			global $post;
			$post_id =  $post->ID;
		}

		$template = 'framework/templates/single/entry-social.php';
		$template_args['post_ID'] = $post_id;

		$out .= '<!-- Entry Social Share -->';
		$out .= '<div class="entry-social-share '.$style.' '.$el_class.'">';
			ob_start();
			augury_get_template( $template, $template_args );
			$out .= ob_get_clean();
		$out .= '</div><!-- Entry Social Share -->';

		echo $out;
	}

    protected function content_template() {
    }
}