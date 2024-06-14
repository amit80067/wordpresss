<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elementor_Blog_Posts extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-blog-posts';
    }

    public function get_title() {
        return __('Blog Posts', 'dt-elementor');
    }

    public function get_icon() {
		return 'fa fa-thumb-tack';
	}

    protected function register_controls() {

        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'General', 'dt-elementor'),
        ) );

            $this->add_control( '_post_categories', array(
                'label' => esc_html__( 'Categories', 'essential-addons-elementor' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->dt_post_categories()
            ) );

            $this->add_control( 'count', array(
                'type'        => Controls_Manager::NUMBER,
                'label'       => __('Post Counts', 'dt-elementor'),
                'default'     => '5',
                'placeholder' => __( 'Enter post count', 'dt-elementor' ),
            ) );

            $this->add_control( 'blog_post_layout', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Post Layout', 'dt-elementor'),
                'default' => 'entry-grid',
                'options' => array(
                    'entry-grid'  => __('Grid', 'dt-elementor'),
                    'entry-list'  => __('List', 'dt-elementor'),
                    'entry-cover' => __('Cover', 'dt-elementor'),
                )
            ) );

            $this->add_control( 'blog_post_grid_list_style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Post Style', 'dt-elementor'),
                'default' => 'dt-sc-boxed',
                'options' => array(
                    'dt-sc-boxed'  => __('Boxed', 'dt-elementor'),
                    'dt-sc-simple'  => __('Simple', 'dt-elementor'),
                    'dt-sc-overlap' => __('Overlap', 'dt-elementor'),
                    'dt-sc-content-overlay'  => __('Content Overlay', 'dt-elementor'),
                    'dt-sc-simple-withbg'  => __('Simple with Background', 'dt-elementor'),
                    'dt-sc-overlay' => __('Overlay', 'dt-elementor'),
                    'dt-sc-overlay-ii'  => __('Overlay II', 'dt-elementor'),
                    'dt-sc-overlay-iii'  => __('Overlay III', 'dt-elementor'),
                    'dt-sc-alternate' => __('Alternate', 'dt-elementor'),
                    'dt-sc-minimal'  => __('Minimal', 'dt-elementor'),
                    'dt-sc-modern'  => __('Modern', 'dt-elementor'),
                    'dt-sc-classic' => __('Classic', 'dt-elementor'),
                    'dt-sc-classic-ii'  => __('Classic II', 'dt-elementor'),
                    'dt-sc-classic-overlay'  => __('Classic Overlay', 'dt-elementor'),
                    'dt-sc-grungy-boxed' => __('Grungy Boxed', 'dt-elementor'),
                    'dt-sc-title-overlap' => __('Title Overlap', 'dt-elementor'),
                ),
                'condition' => array( 'blog_post_layout' => array( 'entry-grid', 'entry-list' ) )
            ) );

            $this->add_control( 'blog_post_cover_style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Post Style', 'dt-elementor'),
                'default' => 'dt-sc-boxed',
                'options' => array(
                    'dt-sc-boxed'  => __('Boxed', 'dt-elementor'),
                    'dt-sc-canvas'  => __('Canvas', 'dt-elementor'),
                    'dt-sc-content-overlay'  => __('Content Overlay', 'dt-elementor'),
                    'dt-sc-overlay' => __('Overlay', 'dt-elementor'),
                    'dt-sc-overlay-ii'  => __('Overlay II', 'dt-elementor'),
                    'dt-sc-overlay-iii'  => __('Overlay III', 'dt-elementor'),
                    'dt-sc-trendy' => __('Trendy', 'dt-elementor'),
                    'dt-sc-mobilephone' => __('Mobile Phone', 'dt-elementor'),
                ),
                'condition' => array( 'blog_post_layout' => 'entry-cover' )
            ) );

            $this->add_control( 'blog_post_columns', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Columns', 'dt-elementor'),
                'default' => 'one-third-column',
                'options' => array(
                    'one-column'  => __('I Column', 'dt-elementor'),
                    'one-half-column'  => __('II Columns', 'dt-elementor'),
                    'one-third-column'  => __('III Columns', 'dt-elementor'),
                    'one-fourth-column' => __('IV Columns', 'dt-elementor'),
                ),
                'condition' => array( 'blog_post_layout' => array( 'entry-grid', 'entry-cover' ) )
            ) );

            $this->add_control( 'blog_list_thumb', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('List Type', 'dt-elementor'),
                'default' => 'entry-left-thumb',
                'options' => array(
                    'entry-left-thumb'  => __('Left Thumb', 'dt-elementor'),
                    'entry-right-thumb'  => __('Right Thumb', 'dt-elementor'),
                ),
                'condition' => array( 'blog_post_layout' => 'entry-list' )
            ) );

            $this->add_control( 'blog_alignment', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Elements Alignment', 'dt-elementor'),
                'default' => 'alignnone',
                'options' => array(
                    'alignnone'  => __('None', 'dt-elementor'),
                    'alignleft'  => __('Align Left', 'dt-elementor'),
                    'aligncenter'  => __('Align Center', 'dt-elementor'),
                    'alignright'  => __('Align Right', 'dt-elementor'),
                ),
                'condition' => array( 'blog_post_layout' => array( 'entry-grid', 'entry-cover' ) )
            ) );
        
            $this->add_control( 'enable_equal_height', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __('Enable Equal Height?', 'dt-elementor'),
                'label_on'     => __( 'Yes', 'dt-elementor' ),
                'label_off'    => __( 'No', 'dt-elementor' ),
                'return_value' => 'yes',
                'default'      => '',
                'condition' => array( 'blog_post_layout' => array( 'entry-grid', 'entry-cover' ) )
            ) );

            $this->add_control( 'enable_gallery_slider', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __('Display Gallery Slider?', 'dt-elementor'),
                'label_on'     => __( 'Yes', 'dt-elementor' ),
                'label_off'    => __( 'No', 'dt-elementor' ),
                'return_value' => 'yes',
                'default'      => '',
                'condition' => array( 'blog_post_layout' => array( 'entry-grid', 'entry-list' ) ),
            ) );

            $content = new Repeater();
            $content->add_control( 'element_value', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Element', 'dt-elementor'),
                'default' => 'feature_image',
                'options' => array(
                    'feature_image'  => __('Feature Image', 'dt-elementor'),
                    'title'  => __('Title', 'dt-elementor'),
                    'content'  => __('Content', 'dt-elementor'),
                    'read_more'  => __('Read More', 'dt-elementor'),
                    'meta_group'  => __('Meta Group', 'dt-elementor'),
                    'author'  => __('Author', 'dt-elementor'),
                    'date'  => __('Date', 'dt-elementor'),
                    'comments'  => __('Comments', 'dt-elementor'),
                    'categories'  => __('Categories', 'dt-elementor'),
                    'tags'  => __('Tags', 'dt-elementor'),
                    'social_share'  => __('Social Share', 'dt-elementor'),
                    'likes_views'  => __('Likes & Views', 'dt-elementor'),
                ),
            ) );

            $this->add_control( 'blog_elements_position', array(
                'type'        => Controls_Manager::REPEATER,
                'label'       => __('Elements & Positioning', 'dt-elementor'),
                'fields'      => array_values( $content->get_controls() ),
                'default'     => array(
                    array( 'element_value' => 'title' ),
                ),
                'title_field' => '{{{ element_value.replace( \'_\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}'
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

            $this->add_control( 'enable_post_format', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __('Enable Post Format?', 'dt-elementor'),
                'label_on'     => __( 'Yes', 'dt-elementor' ),
                'label_off'    => __( 'No', 'dt-elementor' ),
                'return_value' => 'yes',
                'default'      => '',
            ) );
        
            $this->add_control( 'enable_video_audio', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __('Display Video & Audio for Posts?', 'dt-elementor'),
                'label_on'     => __( 'Yes', 'dt-elementor' ),
                'label_off'    => __( 'No', 'dt-elementor' ),
                'return_value' => 'yes',
                'default'      => '',
                'condition' => array( 'blog_post_layout' => array( 'entry-grid', 'entry-list' ) ),
                'description' => __( 'YES! to display video & audio, instead of feature image for posts', 'dt-elementor' ),
            ) );

            $this->add_control( 'enable_excerpt_text', array(
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __('Enable Excerpt Text?', 'dt-elementor'),
                'label_on'     => __( 'Yes', 'dt-elementor' ),
                'label_off'    => __( 'No', 'dt-elementor' ),
                'return_value' => 'yes',
                'default'      => '',
            ) );

            $this->add_control( 'blog_excerpt_length', array(
                'type'        => Controls_Manager::NUMBER,
                'label'       => __('Excerpt Length', 'dt-elementor'),
                'default'     => '25',
                'condition' => array( 'enable_excerpt_text' => 'yes' )
            ) );

            $this->add_control( 'blog_readmore_text', array(
                'type'        => Controls_Manager::TEXT,
                'label'       => __('Read More Text', 'dt-elementor'),
                'default'     => __('Read More', 'dt-elementor'),
            ) );

            $this->add_control( 'blog_image_hover_style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Image Hover Style', 'dt-elementor'),
                'default' => 'dt-sc-default',
                'options' => array(
                    'dt-sc-default'  => __('Default', 'dt-elementor'),
                    'dt-sc-blur'  => __('Blur', 'dt-elementor'),
                    'dt-sc-bw'  => __('Black and White', 'dt-elementor'),
                    'dt-sc-brightness'  => __('Brightness', 'dt-elementor'),
                    'dt-sc-fadeinleft'  => __('Fade InLeft', 'dt-elementor'),
                    'dt-sc-fadeinright'  => __('Fade InRight', 'dt-elementor'),
                    'dt-sc-hue-rotate'  => __('Hue-Rotate', 'dt-elementor'),
                    'dt-sc-invert'  => __('Invert', 'dt-elementor'),
                    'dt-sc-opacity'  => __('Opacity', 'dt-elementor'),
                    'dt-sc-rotate'  => __('Rotate', 'dt-elementor'),
                    'dt-sc-rotate-alt'  => __('Rotate Alt', 'dt-elementor'),
                    'dt-sc-scalein'  => __('Scale In', 'dt-elementor'),
                    'dt-sc-scaleout'  => __('Scale Out', 'dt-elementor'),
                    'dt-sc-sepia'  => __('Sepia', 'dt-elementor'),
                    'dt-sc-tint'  => __('Tint', 'dt-elementor'),
                ),
                'description' => __('Note: Fade, Rotate & Scale Styles will not work for Gallery Sliders.', 'dt-elementor'),
            ) );

            $this->add_control( 'blog_image_overlay_style', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Image Overlay Style', 'dt-elementor'),
                'default' => 'dt-sc-default',
                'options' => array(
                    'dt-sc-default'  => __('None', 'dt-elementor'),
                    'dt-sc-fixed'  => __('Fixed', 'dt-elementor'),
                    'dt-sc-tb'  => __('Top to Bottom', 'dt-elementor'),
                    'dt-sc-bt'  => __('Bottom to Top', 'dt-elementor'),
                    'dt-sc-rl'  => __('Right to Left', 'dt-elementor'),
                    'dt-sc-lr'  => __('Left to Right', 'dt-elementor'),
                    'dt-sc-middle'  => __('Middle', 'dt-elementor'),
                    'dt-sc-middle-radial'  => __('Middle Radial', 'dt-elementor'),
                    'dt-sc-tb-gradient'  => __('Gradient - Top to Bottom', 'dt-elementor'),
                    'dt-sc-bt-gradient'  => __('Gradient - Bottom to Top', 'dt-elementor'),
                    'dt-sc-rl-gradient'  => __('Gradient - Right to Left', 'dt-elementor'),
                    'dt-sc-lr-gradient'  => __('Gradient - Left to Right', 'dt-elementor'),
                    'dt-sc-radial-gradient'  => __('Gradient - Radial', 'dt-elementor'),
                    'dt-sc-flash'  => __('Flash', 'dt-elementor'),
                    'dt-sc-circle'  => __('Circle', 'dt-elementor'),
                    'dt-sc-hm-elastic'  => __('Horizontal Elastic', 'dt-elementor'),
                    'dt-sc-vm-elastic'  => __('Vertical Elastic', 'dt-elementor'),
                ),
                'condition' => array( 'blog_post_layout' => array( 'entry-grid', 'entry-list' ) )
            ) );

            $this->add_control( 'blog_pagination', array(
                'type'    => Controls_Manager::SELECT,
				'label'   => __('Pagination Style', 'dt-elementor'),
                'default' => 'older_newer',
                'options' => array(
                    ''  => __('None', 'dt-elementor'),
                    'older_newer'  => __('Older & Newer', 'dt-elementor'),
                    'numbered'  => __('Numbered', 'dt-elementor'),
                    'load_more'  => __('Load More', 'dt-elementor'),
                    'infinite_scroll'  => __('Infinite Scroll', 'dt-elementor'),
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

		$out .= '<div class="dt-sc-posts-list-wrapper '.$el_class.'">';

        // Getting options...
		$holder_class = $combine_class = array();
		$post_style = '';

        $post_layout = $blog_post_layout;
		$combine_class[] = $post_layout.'-layout';

        $post_gl_style = $blog_post_grid_list_style;
		$post_cover_style = $blog_post_cover_style;
		$combine_class[] = $post_style = ( $post_layout == 'entry-grid' || $post_layout == 'entry-list' ) ? $post_gl_style.'-style' : $post_cover_style.'-style';

		$post_list_type = $blog_list_thumb;
		$combine_class[] = ( $post_layout == 'entry-list' ) ? $post_list_type : '';

		$post_equal_height = $enable_equal_height;
		if( ( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ) && $post_equal_height == true ):
			$holder_class[] = 'apply-equal-height';
		elseif( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ):
			$holder_class[] = 'apply-isotope';
		elseif( $post_layout == 'entry-list' ):
			$holder_class[] = '';
		endif;

		$post_img_hover_style = $blog_image_hover_style;
		$combine_class[] = ( $post_img_hover_style != '' ) ? $post_img_hover_style.'-hover' : '';

		$post_img_overlay_style = $blog_image_overlay_style;
		$combine_class[] = ( ( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ) && $post_img_overlay_style != '' ) ? $post_img_overlay_style.'-overlay' : '';

		$post_alignment = $blog_alignment;
		$combine_class[] = ( ( $post_layout == 'entry-grid' || $post_layout == 'entry-cover' ) && $post_alignment != '' ) ? $post_alignment : '';

		$post_columns = $blog_post_columns;
		$post_columns = isset( $post_columns ) ? $post_columns : 'one-column';
		$post_columns = ( $post_layout == 'entry-list' ) ? 'one-column' : $post_columns;

        switch( $post_columns ):

            default:
			case 'one-column':
				$post_class = "column dt-sc-one-column dt-sc-post-entry ";
                $columns = 1;
            break;

            case 'one-half-column':
				$post_class = "column dt-sc-one-half dt-sc-post-entry ";
                $columns = 2;
            break;

            case 'one-third-column':
				$post_class = "column dt-sc-one-third dt-sc-post-entry ";
                $columns = 3;
            break;

            case 'one-fourth-column':
				$post_class = "column dt-sc-one-fourth dt-sc-post-entry ";
                $columns = 4;
            break;
        endswitch;

		$post_class .= implode(' ', $combine_class);

		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) { 
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		$args = array( 'paged' => $paged, 'posts_per_page' => $count, 'orderby' => 'date', 'ignore_sticky_posts' => true, 'post_status' => 'publish' );
		$warning = esc_html__('No Posts Found','dt-elementor');

		if( !empty($_post_categories) ){
            $_post_categories = implode( ',', $_post_categories );
			$args = array( 'paged' => $paged, 'posts_per_page' => $count, 'orderby' => 'date', 'cat' => $_post_categories, 'ignore_sticky_posts' => true, 'post_status' => 'publish' );
			$warning = esc_html__('No Posts Found in Category ','dt-elementor').$_post_categories;
		}

		if( !empty($_post_not_in) ){
			$args['post__not_in'] = array( $_post_not_in );
		}

		$rposts = new WP_Query( $args );
		if ( $rposts->have_posts() ) :

            $i = 1;

            $out .= "<div class='tpl-blog-holder ".implode(' ', $holder_class)."'>";
            $out .= "<div class='grid-sizer ".$post_class."'></div>";

			$meta = $newEles = $newMEles = array();

			$element_position = !empty( $blog_elements_position ) ? $blog_elements_position : explode( ',', $blog_elements_position );
			$meta_group_position = !empty( $blog_meta_position ) ? $blog_meta_position : explode( ',', $blog_meta_position );

			$enable_excerpt = $enable_excerpt_text;
			$excerpt_length = $blog_excerpt_length;

			$read_more = $blog_readmore_text;
			$enable_slider = $enable_gallery_slider;

			$enable_video_audio = $enable_video_audio;
			$enable_post_format = $enable_post_format;

			$excerpt_length = !empty( $excerpt_length ) ? $excerpt_length : 25;
			$read_more = !empty( $read_more ) ? $read_more : '';

			if( is_array( $element_position[0] ) ) {
				foreach($element_position as $key => $items) {
					$newEles[$items['element_value']] = $items['element_value'];
				}
			} else {
				foreach($element_position as $item) {
					$newEles[$item] = $item;
				}
			}

			if( is_array( $meta_group_position[0] ) ) {
				foreach($meta_group_position as $key => $items) {
					$newMEles[$items['element_value']] = $items['element_value'];
				}
			} else {
				foreach($meta_group_position as $item) {
					$newMEles[$item] = $item;
				}
			}

			array_push( $meta, $newEles, $newMEles, $enable_excerpt, $excerpt_length, $read_more, $enable_slider, $enable_video_audio, $enable_post_format );

            while( $rposts->have_posts() ):
                $rposts->the_post();

                $temp_class = "";
                $post_ID = get_the_ID();

                if($i == 1) $temp_class = $post_class.' first'; else $temp_class = $post_class;
                if($i == $columns) $i = 1; else $i = $i + 1;

                $post_meta = get_post_meta($post_ID, '_dt_post_settings', TRUE);
                $post_meta = is_array($post_meta) ? $post_meta : array();

                $format = !empty( $post_meta['post-format-type'] ) ? $post_meta['post-format-type'] : 'standard';

                $out .= '<div class="'.esc_attr($temp_class).'">';

					$post_classes = get_post_class('blog-entry '.'format-'.$format, $post_ID);
					if( !array_key_exists( 'feature_image', $newEles ) ) {
						if( ( $key = array_search( 'has-post-thumbnail', $post_classes ) ) !== false ) {
							unset( $post_classes[$key] );
						}
					}
					if( $enable_post_format == true ) {
						$post_classes[] = 'has-post-format';
					}
					if( $enable_video_audio == true && ( $format === 'video' || $format === 'audio' ) ) {
						$post_classes[] = 'has-post-media';
					}
					
					$post_classes = implode( ' ', $post_classes );

                    $out .= '<article id="post-'.$post_ID.'" class="'.esc_attr($post_classes).'">';

						$template = apply_filters( 'augury_blog_archive_template', 'framework/templates/archive-blog-entry.php' );
						$template_args['ID'] = $post_ID;
						$template_args['Post_Style'] = $post_style;
						$template_args['Post_Layout'] = $post_layout;
						$template_args['Post_Column'] = $post_columns;
						$template_args['meta'] = $meta;

						ob_start();
						augury_get_template( $template, $template_args );
						$out .= ob_get_clean();

                    $out .= '</article>';
                $out .= '</div>';
            endwhile;

			wp_reset_postdata($rposts);

            $out .= '</div>';

			if( $blog_pagination == 'numbered' ):

				$out .= '<div class="pagination blog-pagination">'.augury_pagination($rposts).'</div>';

			elseif( $blog_pagination == 'older_newer' ):

				$out .= '<div class="pagination blog-pagination"><div class="newer-posts">'.get_previous_posts_link( '<i class="fa fa-angle-left"></i>'.esc_html__(' Newer Posts', 'dt-elementor') ).'</div>';
				$out .= '<div class="older-posts">'.get_next_posts_link( esc_html__('Older Posts ', 'dt-elementor').'<i class="fa fa-angle-right"></i>', $rposts->max_num_pages ).'</div></div>';

			elseif( $blog_pagination == 'load_more' ):

				$pos = $count % $columns;
				$pos += 1;

                $_post_categories = isset( $_post_categories ) ? $_post_categories : '';

				$out .= '<div class="pagination blog-pagination"><a class="loadmore-btn more-items" data-count="'.$count.'" data-cats="'.$_post_categories.'" data-maxpage="'.esc_attr($rposts->max_num_pages).'" data-pos="'.esc_attr($pos).'" data-eheight="'.esc_attr($post_equal_height).'" data-style="'.esc_attr($post_style).'" data-layout="'.esc_attr($post_layout).'" data-column="'.esc_attr($post_columns).'" data-listtype="'.esc_attr($post_list_type).'" data-hover="'.esc_attr($post_img_hover_style).'" data-overlay="'.esc_attr($post_img_overlay_style).'" data-align="'.esc_attr($post_alignment).'" href="javascript:void(0);" data-meta="'.htmlspecialchars(json_encode($meta), ENT_QUOTES, get_bloginfo( 'charset' )).'" data-blogpostloadmore-nonce="'.wp_create_nonce('blogpostloadmore_nonce').'">'.esc_html__('Load More', 'dt-elementor').'</a></div>';

			elseif( $blog_pagination == 'infinite_scroll' ):

				$pos = $count % $columns;
				$pos += 1;

                $_post_categories = isset( $_post_categories ) ? $_post_categories : '';

				$out .= '<div class="pagination blog-pagination"><div class="infinite-btn more-items" data-count="'.$count.'" data-cats="'.$_post_categories.'" data-maxpage="'.esc_attr($rposts->max_num_pages).'" data-pos="'.esc_attr($pos).'" data-eheight="'.esc_attr($post_equal_height).'" data-style="'.esc_attr($post_style).'" data-layout="'.esc_attr($post_layout).'" data-column="'.esc_attr($post_columns).'" data-listtype="'.esc_attr($post_list_type).'" data-hover="'.esc_attr($post_img_hover_style).'" data-overlay="'.esc_attr($post_img_overlay_style).'" data-align="'.esc_attr($post_alignment).'" data-meta="'.htmlspecialchars(json_encode($meta), ENT_QUOTES, get_bloginfo( 'charset' )).'" data-blogpostloadmore-nonce="'.wp_create_nonce('blogpostloadmore_nonce').'"></div></div>';
			endif;

		else:
			$out = "<div class='dt-sc-warning-box'>{$warning}</div>";
		endif;

		$out .= '</div>';        

        echo $out;
    }
    
    protected function content_template() {
    }
}