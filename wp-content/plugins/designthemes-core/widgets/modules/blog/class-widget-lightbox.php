<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Elementor_Lightbox extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-lightbox';
    }

    public function get_title() {
        return __('Lightbox Image', 'dt-elementor');
    }

    public function get_icon() {
		return 'fa fa-picture-o';
	}

    protected function register_controls() {

        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'General', 'dt-elementor'),
        ) );

            $this->add_control( 'url', array(
                'type'        => Controls_Manager::MEDIA,
                'label'       => __('Choose Image', 'dt-elementor'),
				'default'	  => array( 'url' => \Elementor\Utils::get_placeholder_image_src(), ),
                'description' => __( 'Choose any one image from media.', 'dt-elementor' ),
            ) );

            $this->add_control( 'title', array(
                'type'        => Controls_Manager::TEXT,
                'label'       => __('Title', 'dt-elementor'),
                'default'     => '',
				'description' => __('Put the image title on preview.', 'dt-elementor'),
            ) );

            $this->add_control( 'align', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Alignment', 'dt-elementor'),
                'default' => 'alignnone',
                'options' => array(
                    'alignnone'   => __('None', 'dt-elementor'),
                    'alignleft'	  => __('Left', 'dt-elementor'),
                    'aligncenter' => __('Center', 'dt-elementor'),
                    'alignright'  => __('Right', 'dt-elementor'),
                ),
            ) );

            $this->add_control( 'class', array(
                'type'        => Controls_Manager::TEXT,
                'label'       => __('Extra class name', 'dt-elementor'),
                'description' => __('Style particular element differently - add a class name and refer to it in custom CSS', 'dt-elementor')
            ) );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        extract($settings);

        $image = wp_get_attachment_image( $url['id'], 'full' );
        $lurl = wp_get_attachment_image_url( $url['id'], 'full' );
        $url = $image;

		if( !empty( $url ) ):
			if( !empty($class) ):
				$url = str_replace(' class="', ' class="'.$class.' ', $url);
			endif;

			if( !empty($align) ):
				$url = str_replace(' class="', ' class="'.$align.' ', $url);
			endif;

			echo '<a href="'.$lurl.'" title="'.$title.'" class="lightbox-preview-img">'.$url.'</a>';
		endif;
	}

    protected function content_template() {
    }
}