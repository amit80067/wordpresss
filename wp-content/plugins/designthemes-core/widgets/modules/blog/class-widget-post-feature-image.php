<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Post_Feature_Image extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-post-feature-image';
    }

    public function get_title() {
        return __('Post - Feature Image', 'dt-elementor');
    }

    public function get_icon() {
		return 'fa fa-picture-o';
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

            $this->add_control( 'enable_lightbox', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __('Enable Lightbox?', 'dt-elementor'),
                'label_on'     => __( 'Yes', 'dt-elementor' ),
                'label_off'    => __( 'No', 'dt-elementor' ),
                'return_value' => 'yes',
                'default'      => '',
				'description' => __('YES! to enable lightbox preview feature.', 'dt-elementor')
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

		$post_meta = get_post_meta($post_id,'_dt_post_settings',TRUE);
		$post_meta = is_array($post_meta) ? $post_meta  : array();

		$format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';

		$post_meta['enable-lightbox'] = !empty( $enable_lightbox ) ? $enable_lightbox : '';

		$template = 'framework/templates/single/entry-image.php';
		$template_args['post_ID'] = $post_id;
		$template_args['meta'] = $post_meta;

		$out .= '<!-- Featured Image -->';
		$out .= '<div class="entry-thumb single-preview-img '.$el_class.'">';
			ob_start();
			augury_get_template( $template, $template_args );
			$out .= ob_get_clean();

			$out .= '<!-- Post Format -->';
			$out .= '<div class="entry-format">';
				$out .= '<a class="ico-format" href="'.esc_url(get_post_format_link( $format )).'"></a>';
			$out .= '</div><!-- Post Format -->';
		$out .= '</div><!-- Featured Image -->';

		echo $out;
	}

    protected function content_template() {
    }
}