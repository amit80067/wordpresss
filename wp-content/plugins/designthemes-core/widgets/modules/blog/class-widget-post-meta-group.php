<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elementor_Post_Meta_Group extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-post-meta-group';
    }

    public function get_title() {
        return __('Post - Meta Group', 'dt-elementor');
    }

    public function get_icon() {
		return 'fa fa-address-card-o';
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

            $content = new Repeater();
            $content->add_control( 'element_value', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Element', 'dt-elementor'),
                'default' => 'author',
                'options' => array(
                    'author'  => __('Author', 'dt-elementor'),
                    'date'  => __('Date', 'dt-elementor'),
                    'comments'  => __('Comments', 'dt-elementor'),
                    'categories'  => __('Categories', 'dt-elementor'),
                    'tags'  => __('Tags', 'dt-elementor'),
                    'social_share'  => __('Social Share', 'dt-elementor'),
                    'likes_views'  => __('Likes & Views', 'dt-elementor'),
                ),
            ) );

            $this->add_control( 'blog_meta_position', array(
                'type'        => Controls_Manager::REPEATER,
                'label'       => __('Meta Group Positioning', 'dt-elementor'),
                'fields'      => array_values( $content->get_controls() ),
                'default'     => array(
                    array( 'element_value' => 'author' ),
                ),
                'title_field' => '{{{ element_value.replace( \'_\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}'
            ) );

            $this->add_control( 'style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Style', 'dt-elementor'),
                'default' => 'metagroup-space-separator',
                'options' => array(
                    'metagroup-space-separator'  => __('Space', 'dt-elementor'),
                    'metagroup-slash-separator'  => __('Slash', 'dt-elementor'),
                    'metagroup-vertical-separator'  => __('Vertical', 'dt-elementor'),
                    'metagroup-horizontal-separator'  => __('Horizontal', 'dt-elementor'),
                    'metagroup-dot-separator'  => __('Dot', 'dt-elementor'),
                    'metagroup-comma-separator'  => __('Comma', 'dt-elementor'),
                    'metagroup-elements-boxed'  => __('Boxed', 'dt-elementor'),
                    'metagroup-elements-boxed-curvy'  => __('Boxed Curvy', 'dt-elementor'),
                    'metagroup-elements-boxed-round'  => __('Boxed Round', 'dt-elementor'),
                    'metagroup-elements-filled'  => __('Filled', 'dt-elementor'),
                    'metagroup-elements-filled-curvy'  => __('Filled Curvy', 'dt-elementor'),
                    'metagroup-elements-filled-round'  => __('Filled Round', 'dt-elementor'),
                ),
                'description' => __('Select any one of meta group styling.', 'dt-elementor'),
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
		
		$newMEles = array();
		$meta_group_position = !empty( $blog_meta_position ) ? $blog_meta_position : explode( ',', $blog_meta_position );

		if( is_array( $meta_group_position[0] ) ) {
			foreach($meta_group_position as $key => $items) {
				$newMEles[$items['element_value']] = $items['element_value'];
			}
		} else {
			foreach($meta_group_position as $item) {
				$newMEles[$item] = $item;
			}
		}

		if( count( $newMEles ) >= 1 ) {

			$out .= '<div class="dt-sc-posts-meta-group '.$style.' '.$el_class.'">';

				$template_args['post_ID'] = $post_id;
				$template_args['post_Style'] = '';

				ob_start();

				foreach( $newMEles as $value ):

					if( $value == 'social_share' ):

						$template = 'framework/templates/single/entry-social.php'; ?><!-- Entry Social Share --><div class="entry-social-share"><?php
                        	augury_get_template( $template, $template_args ); ?></div><!-- Entry Social Share --><?php

					elseif( $value == 'likes_views' ):

						$template = 'framework/templates/single/entry-likes-views.php'; ?><!-- Entry Likes Views --><div class="entry-likes-views"><?php augury_get_template( $template, $template_args ); ?></div><!-- Entry Likes Views --><?php

					elseif( $value == 'comments' ):

						$template = 'framework/templates/single/no-loop/entry-comment.php'; ?><!-- Entry Comment --><div class="entry-comments"><?php augury_get_template( $template, $template_args ); ?></div><!-- Entry Comment --><?php

					else:

						$template = 'framework/templates/single/no-loop/entry-'.$value.'.php'; ?><!-- Entry Start --><div class="entry-<?php echo esc_attr($value); ?>"><?php augury_get_template( $template, $template_args ); ?></div><!-- Entry End --><?php
					endif;

				endforeach;

				$out .= ob_get_clean();

			$out .= '</div>';
		}

		echo $out;
    }

    protected function content_template() {
    }
}