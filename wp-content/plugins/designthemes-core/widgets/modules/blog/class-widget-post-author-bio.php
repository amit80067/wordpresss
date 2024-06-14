<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Post_Author_Bio extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-post-author-bio';
    }

    public function get_title() {
        return __('Post - Author Bio', 'dt-elementor');
    }

    public function get_icon() {
		return 'fa fa-user-circle';
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

		$template = 'framework/templates/single/no-loop/entry-author-bio.php';
		$template_args['post_ID'] = $post_id;
		$template_args['post_Style'] = '';

		$out .= '<!-- Entry Author Bio -->';
		$out .= '<div class="entry-author-bio '.$el_class.'">';
			ob_start();
			augury_get_template( $template, $template_args );
			$out .= ob_get_clean();
		$out .= '</div><!-- Entry Author Bio -->';

		echo $out;
	}

    protected function content_template() {
    }
}