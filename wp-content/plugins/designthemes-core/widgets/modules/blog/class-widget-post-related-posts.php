<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Post_Related_Posts extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-post-related-posts';
    }

    public function get_title() {
        return __('Post - Related Posts', 'dt-elementor');
    }

    public function get_icon() {
		return 'fa fa-files-o';
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

            $this->add_control( 'related_title', array(
                'type'        => Controls_Manager::TEXT,
                'label'       => __('Title', 'dt-elementor'),
                'default'     => __('Related Posts', 'dt-elementor'),
				'description' => __('Put the related posts section title.', 'dt-elementor'),
            ) );

            $this->add_control( 'related_column', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Column', 'dt-elementor'),
                'default' => 'one-third-column',
                'options' => array(
                    'one-column'  		=> __('I Column', 'dt-elementor'),
                    'one-half-column'  	=> __('II Columns', 'dt-elementor'),
                    'one-third-column'  => __('III Columns', 'dt-elementor'),
                ),
            ) );

            $this->add_control( 'related_count', array(
                'type'        => Controls_Manager::NUMBER,
                'label'       => __('Count', 'dt-elementor'),
                'default'     => '3',
                'placeholder' => __( 'Put no.of related posts to show.', 'dt-elementor' ),
            ) );

            $this->add_control( 'related_excerpt', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __('Enable Excerpt?', 'dt-elementor'),
                'label_on'     => __( 'Yes', 'dt-elementor' ),
                'label_off'    => __( 'No', 'dt-elementor' ),
                'return_value' => 'yes',
                'default'      => '',
            ) );

            $this->add_control( 'related_excerpt_length', array(
                'type'        => Controls_Manager::NUMBER,
                'label'       => __('Excerpt Length', 'dt-elementor'),
                'default'     => '25',
                'condition' => array( 'related_excerpt' => 'yes' )
            ) );

            $this->add_control( 'related_carousel', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __('Enable Carousel?', 'dt-elementor'),
                'label_on'     => __( 'Yes', 'dt-elementor' ),
                'label_off'    => __( 'No', 'dt-elementor' ),
                'return_value' => 'yes',
                'default'      => '',
            ) );

            $this->add_control( 'related_nav_style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Navigation Style', 'dt-elementor'),
                'default' => '',
                'options' => array(
                    ''  		  => __('None', 'dt-elementor'),
                    'navigation'  => __('Navigations', 'dt-elementor'),
                    'pager'  	  => __('Pager', 'dt-elementor'),
                ),
				'condition' => array( 'related_carousel' => 'yes' )
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

		$template = 'framework/templates/single/entry-related-posts.php';
		$template_args['post_ID'] = $post_id;
		$template_args['related_Title'] = $related_title;
		$template_args['related_Column'] = $related_column;
		$template_args['related_Count'] = $related_count;
		$template_args['related_Excerpt'] = $related_excerpt;
		$template_args['related_Excerpt_Length'] = $related_excerpt_length;
		$template_args['related_Carousel'] = $related_carousel;
		$template_args['related_Nav_Style'] = $related_nav_style;

		$out .= '<!-- Entry Related Posts -->';
		$out .= '<div class="entry-related-posts '.$el_class.'">';
			ob_start();
			augury_get_template( $template, $template_args );
			$out .= ob_get_clean();
		$out .= '</div><!-- Entry Related Posts -->';

		echo $out;
	}

    protected function content_template() {
    }
}