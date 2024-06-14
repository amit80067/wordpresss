<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Post_Comment_Box extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-post-comment-box';
    }

    public function get_title() {
        return __('Post - Comment Box', 'dt-elementor');
    }

    public function get_icon() {
		return 'fa fa-commenting';
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

            $this->add_control( 'comment_style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Style', 'dt-elementor'),
                'default' => '',
                'options' => array(
                    ''  => __('Default', 'dt-elementor'),
                    'rounded'	=> __('Rounded', 'dt-elementor'),
                    'square'  	=> __('Square', 'dt-elementor'),
                ),
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

		$template = 'framework/templates/single/entry-commentbox.php';
		$template_args['post_ID'] = $post_id;
		$template_args['comment_Style'] = $comment_style;

		ob_start();
		augury_get_template( $template, $template_args );
		$out .= ob_get_clean();

		echo $out;
	}

    protected function content_template() {
    }
}