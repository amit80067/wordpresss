<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Archive Page Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-archives-page-layout]', array(
			'default'           => augury_get_option( 'blog-archives-page-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

    $wp_customize->add_control( new Augury_Customize_Control_Radio_Image(
		$wp_customize, AUGURY_SETTINGS . '[blog-archives-page-layout]', array(
			'type' => 'dt-radio-image',
			'label' => esc_html__( 'Page Layout', 'augury'),
			'section' => 'site-post-archives-section',
			'choices' => apply_filters( 'augury_archive_page_layout_options', array(
				'content-full-width' => array(
					'label' => esc_html__( 'Without Sidebar', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/without-sidebar.png'
				),
				'with-left-sidebar' => array(
					'label' => esc_html__( 'Left Sidebar', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/left-sidebar.png'
				),
				'with-right-sidebar' => array(
					'label' => esc_html__( 'Right Sidebar', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/right-sidebar.png'
				),
				'with-both-sidebar' => array(
					'label' => esc_html__( 'Both Sidebar', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/both-sidebar.png'
				),
			))
        )
    ));

/**
 * Option : Show Standard Left Sidebar
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[show-standard-left-sidebar-for-post-archives]', array(
			'default'           => augury_get_option( 'show-standard-left-sidebar-for-post-archives' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[show-standard-left-sidebar-for-post-archives]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Standard Left Sidebar', 'augury'),
				'section' => 'site-post-archives-section',
				'dependency' => array( 'blog-archives-page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Show Standard Right Sidebar
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[show-standard-right-sidebar-for-post-archives]', array(
			'default'           => augury_get_option( 'show-standard-right-sidebar-for-post-archives' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[show-standard-right-sidebar-for-post-archives]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Show Standard Right Sidebar', 'augury'),
				'section' => 'site-post-archives-section',
				'dependency' => array( 'blog-archives-page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Archive Post Layout
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-post-layout]', array(
			'default'           => augury_get_option( 'blog-post-layout' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

    $wp_customize->add_control( new Augury_Customize_Control_Radio_Image(
		$wp_customize, AUGURY_SETTINGS . '[blog-post-layout]', array(
			'type' => 'dt-radio-image',
			'label' => esc_html__( 'Post Layout', 'augury'),
			'section' => 'site-post-archives-section',
			'choices' => apply_filters( 'augury_archive_post_layout_options', array(
				'entry-grid' => array(
					'label' => esc_html__( 'Grid', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/entry-grid.png'
				),
				'entry-list' => array(
					'label' => esc_html__( 'List', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/entry-list.png'
				),
				'entry-cover' => array(
					'label' => esc_html__( 'Cover', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/entry-cover.png'
				),
			))
        )
    ));

/**
 * Option : Post Grid, List Style
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-post-grid-list-style]', array(
			'default'           => augury_get_option( 'blog-post-grid-list-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[blog-post-grid-list-style]', array(
			'type'    => 'select',
			'section' => 'site-post-archives-section',
			'label'   => esc_html__( 'Post Style', 'augury' ),
			'choices' => array(
				'dt-sc-boxed' 			=> esc_html__('Boxed', 'augury'),
				'dt-sc-simple'      	=> esc_html__('Simple', 'augury'),
				'dt-sc-overlap'      	=> esc_html__('Overlap', 'augury'),
				'dt-sc-content-overlay' => esc_html__('Content Overlay', 'augury'),
				'dt-sc-simple-withbg'	=> esc_html__('Simple with Background', 'augury'),
				'dt-sc-overlay'   	    => esc_html__('Overlay', 'augury'),
				'dt-sc-overlay-ii'      => esc_html__('Overlay II', 'augury'),			  
				'dt-sc-overlay-iii'     => esc_html__('Overlay III', 'augury'),			  
				'dt-sc-alternate'	 	=> esc_html__('Alternate', 'augury'),
				'dt-sc-minimal'       	=> esc_html__('Minimal', 'augury'),
				'dt-sc-modern' 	      	=> esc_html__('Modern', 'augury'),
				'dt-sc-classic'	 		=> esc_html__('Classic', 'augury'),
				'dt-sc-classic-ii'	 	=> esc_html__('Classic II', 'augury'),
				'dt-sc-classic-overlay' => esc_html__('Classic Overlay', 'augury'),
				'dt-sc-grungy-boxed' 	=> esc_html__('Grungy Boxed', 'augury'),
				'dt-sc-title-overlap'	=> esc_html__('Title Overlap', 'augury'),
			),
			'dependency' => array( 'blog-post-layout', 'any', 'entry-grid,entry-list' )
		)
	));

/**
 * Option : Post Cover Style
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-post-cover-style]', array(
			'default'           => augury_get_option( 'blog-post-cover-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[blog-post-cover-style]', array(
			'type'    => 'select',
			'section' => 'site-post-archives-section',
			'label'   => esc_html__( 'Post Style', 'augury' ),
			'choices' => array(
				'dt-sc-boxed' 			=> esc_html__('Boxed', 'augury'),
				'dt-sc-canvas'      	=> esc_html__('Canvas', 'augury'),
				'dt-sc-content-overlay' => esc_html__('Content Overlay', 'augury'),
				'dt-sc-overlay'   	    => esc_html__('Overlay', 'augury'),
				'dt-sc-overlay-ii'      => esc_html__('Overlay II', 'augury'),
				'dt-sc-overlay-iii'     => esc_html__('Overlay III', 'augury'),
				'dt-sc-trendy' 			=> esc_html__('Trendy', 'augury'),
				'dt-sc-mobilephone' 	=> esc_html__('Mobile Phone', 'augury'),
			),
			'dependency'   => array( 'blog-post-layout', '==', 'entry-cover' )
		)
	));

/**
 * Option : Post Columns
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-post-columns]', array(
			'default'           => augury_get_option( 'blog-post-columns' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

    $wp_customize->add_control( new Augury_Customize_Control_Radio_Image(
		$wp_customize, AUGURY_SETTINGS . '[blog-post-columns]', array(
			'type' => 'dt-radio-image',
			'label' => esc_html__( 'Columns', 'augury'),
			'section' => 'site-post-archives-section',
			'choices' => apply_filters( 'augury_archive_post_columns_options', array(
				'one-column' => array(
					'label' => esc_html__( 'One Column', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/one-column.png'
				),
				'one-half-column' => array(
					'label' => esc_html__( 'One Half Column', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/one-half-column.png'
				),
				'one-third-column' => array(
					'label' => esc_html__( 'One Third Column', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/one-third-column.png'
				),
			)),
			'dependency' => array( 'blog-post-layout', 'any', 'entry-grid,entry-cover' ),
        )
    ));

/**
 * Option : List Thumb
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-list-thumb]', array(
			'default'           => augury_get_option( 'blog-list-thumb' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

    $wp_customize->add_control( new Augury_Customize_Control_Radio_Image(
		$wp_customize, AUGURY_SETTINGS . '[blog-list-thumb]', array(
			'type' => 'dt-radio-image',
			'label' => esc_html__( 'List Type', 'augury'),
			'section' => 'site-post-archives-section',
			'choices' => apply_filters( 'augury_archive_list_thumb_options', array(
				'entry-left-thumb' => array(
					'label' => esc_html__( 'Left Thumb', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/entry-left-thumb.png'
				),
				'entry-right-thumb' => array(
					'label' => esc_html__( 'Right Thumb', 'augury' ),
					'path' => AUGURY_URI . '/inc/customizer/assets/images/entry-right-thumb.png'
				),
			)),
			'dependency' => array( 'blog-post-layout', '==', 'entry-list' ),
        )
    ));

/**
 * Option : Post Alignment
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-alignment]', array(
			'default'           => augury_get_option( 'blog-alignment' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[blog-alignment]', array(
			'type'    => 'select',
			'section' => 'site-post-archives-section',
			'label'   => esc_html__( 'Elements Alignment', 'augury' ),
			'choices' => array(
			  'alignnone'	=> esc_html__('None', 'augury'),
			  'alignleft' 	=> esc_html__('Align Left', 'augury'),
			  'aligncenter' => esc_html__('Align Center', 'augury'),
			  'alignright'  => esc_html__('Align Right', 'augury'),
			),
			'dependency'   => array( 'blog-post-layout', 'any', 'entry-grid,entry-cover' ),
		)
	));

/**
 * Option : Equal Height
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-equal-height]', array(
			'default'           => augury_get_option( 'enable-equal-height' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-equal-height]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Equal Height', 'augury'),
				'section' => 'site-post-archives-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array( 'blog-post-layout', 'any', 'entry-grid,entry-cover' ),
			)
		)
	);

/**
 * Option : No Space
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-no-space]', array(
			'default'           => augury_get_option( 'enable-no-space' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-no-space]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable No Space', 'augury'),
				'section' => 'site-post-archives-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array( 'blog-post-layout', 'any', 'entry-grid,entry-cover' ),
			)
		)
	);

/**
 * Option : Gallery Slider
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-gallery-slider]', array(
			'default'           => augury_get_option( 'enable-gallery-slider' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-gallery-slider]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Display Gallery Slider', 'augury'),
				'section' => 'site-post-archives-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array( 'blog-post-layout', 'any', 'entry-grid,entry-list' ),
			)
		)
	);

/**
 * Divider : Blog Gallery Slider Bottom
 */
	$wp_customize->add_control(
		new Augury_Customize_Control_Separator(
			$wp_customize, AUGURY_SETTINGS . '[blog-gallery-slider-bottom-separator]', array(
				'type'     => 'dt-separator',
				'section'  => 'site-post-archives-section',
				'settings' => array(),
			)
		)
	);

/**
 * Option : Blog Elements
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-elements-position]', array(
			'default'           => augury_get_option( 'blog-elements-position' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		)
	);

    $wp_customize->add_control( new Augury_Customize_Control_Sortable(
		$wp_customize, AUGURY_SETTINGS . '[blog-elements-position]', array(
			'type' => 'dt-sortable',
			'label' => esc_html__( 'Elements Positioning', 'augury'),
			'section' => 'site-post-archives-section',
			'choices' => apply_filters( 'augury_archive_post_elements_options', array(
				'feature_image'	=> esc_html__('Feature Image', 'augury'),
				'title'      	=> esc_html__('Title', 'augury'),
				'content'    	=> esc_html__('Content', 'augury'),
				'read_more'  	=> esc_html__('Read More', 'augury'),
				'meta_group' 	=> esc_html__('Meta Group', 'augury'),
				'author'		=> esc_html__('Author', 'augury'),
				'date'     		=> esc_html__('Date', 'augury'),
				'comments' 		=> esc_html__('Comments', 'augury'),
				'categories'    => esc_html__('Categories', 'augury'),
				'tags'  		=> esc_html__('Tags', 'augury'),
				'social_share'  => esc_html__('Social Share', 'augury'),
				'likes_views'   => esc_html__('Likes & Views', 'augury'),
			)),
        )
    ));

/**
 * Option : Blog Meta Elements
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-meta-position]', array(
			'default'           => augury_get_option( 'blog-meta-position' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		)
	);

    $wp_customize->add_control( new Augury_Customize_Control_Sortable(
		$wp_customize, AUGURY_SETTINGS . '[blog-meta-position]', array(
			'type' => 'dt-sortable',
			'label' => esc_html__( 'Meta Group Positioning', 'augury'),
			'section' => 'site-post-archives-section',
			'choices' => apply_filters( 'augury_archive_post_meta_elements_options', array(
				'author'		=> esc_html__('Author', 'augury'),
				'date'     		=> esc_html__('Date', 'augury'),
				'comments' 		=> esc_html__('Comments', 'augury'),
				'categories'    => esc_html__('Categories', 'augury'),
				'tags'  		=> esc_html__('Tags', 'augury'),
				'social_share'  => esc_html__('Social Share', 'augury'),
				'likes_views'   => esc_html__('Likes & Views', 'augury'),
			)),
			'description' => esc_html__('Note: Use max 3 items for better results.', 'augury'),
        )
    ));

/**
 * Divider : Blog Meta Elements Bottom
 */
	$wp_customize->add_control(
		new Augury_Customize_Control_Separator(
			$wp_customize, AUGURY_SETTINGS . '[blog-meta-elements-bottom-separator]', array(
				'type'     => 'dt-separator',
				'section'  => 'site-post-archives-section',
				'settings' => array(),
			)
		)
	);

/**
 * Option : Post Format
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-post-format]', array(
			'default'           => augury_get_option( 'enable-post-format' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-post-format]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Post Format', 'augury'),
				'section' => 'site-post-archives-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Enable Excerpt
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-excerpt-text]', array(
			'default'           => augury_get_option( 'enable-excerpt-text' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-excerpt-text]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Excerpt Text', 'augury'),
				'section' => 'site-post-archives-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Excerpt Text
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-excerpt-length]', array(
			'default'           => augury_get_option( 'blog-excerpt-length' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[blog-excerpt-length]', array(
				'type'    	  => 'text',
				'section'     => 'site-post-archives-section',
				'label'       => esc_html__( 'Excerpt Length', 'augury' ),
				'description' => esc_html__('Put Excerpt Length', 'augury'),
				'input_attrs' => array(
					'value'	=> 25,
				),
				'dependency'  => array( 'enable-excerpt-text', '==', 'true' ),
			)
		)
	);

/**
 * Option : Enable Video Audio
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-video-audio]', array(
			'default'           => augury_get_option( 'enable-video-audio' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-video-audio]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Display Video & Audio for Posts', 'augury'),
				'description' => esc_html__('YES! to display video & audio, instead of feature image for posts', 'augury'),
				'section' => 'site-post-archives-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				),
				'dependency' => array( 'blog-post-layout', 'any', 'entry-grid,entry-list' ),
			)
		)
	);

/**
 * Option : Readmore Text
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-readmore-text]', array(
			'default'           => augury_get_option( 'blog-readmore-text' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[blog-readmore-text]', array(
				'type'    	  => 'text',
				'section'     => 'site-post-archives-section',
				'label'       => esc_html__( 'Read More Text', 'augury' ),
				'description' => esc_html__('Put the read more text here', 'augury'),
				'input_attrs' => array(
					'value'	=> esc_html__('Read More', 'augury'),
				)
			)
		)
	);

/**
 * Option : Image Hover Style
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-image-hover-style]', array(
			'default'           => augury_get_option( 'blog-image-hover-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[blog-image-hover-style]', array(
			'type'    => 'select',
			'section' => 'site-post-archives-section',
			'label'   => esc_html__( 'Image Hover Style', 'augury' ),
			'choices' => array(
			  'dt-sc-default' 	  => esc_html__('Default', 'augury'),
			  'dt-sc-blur'        => esc_html__('Blur', 'augury'),
			  'dt-sc-bw'   		  => esc_html__('Black and White', 'augury'),
			  'dt-sc-brightness'  => esc_html__('Brightness', 'augury'),
			  'dt-sc-fadeinleft'  => esc_html__('Fade InLeft', 'augury'),
			  'dt-sc-fadeinright' => esc_html__('Fade InRight', 'augury'),
			  'dt-sc-hue-rotate'  => esc_html__('Hue-Rotate', 'augury'),
			  'dt-sc-invert'	  => esc_html__('Invert', 'augury'),
			  'dt-sc-opacity'     => esc_html__('Opacity', 'augury'),
			  'dt-sc-rotate'	  => esc_html__('Rotate', 'augury'),
			  'dt-sc-rotate-alt'  => esc_html__('Rotate Alt', 'augury'),
			  'dt-sc-scalein'     => esc_html__('Scale In', 'augury'),
			  'dt-sc-scaleout' 	  => esc_html__('Scale Out', 'augury'),
			  'dt-sc-sepia'	   	  => esc_html__('Sepia', 'augury'),
			  'dt-sc-tint'		  => esc_html__('Tint', 'augury'),
			),
			'description' => esc_html__('Choose image hover style to display archives pages.', 'augury'),
		)
	));

/**
 * Option : Image Hover Style
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-image-overlay-style]', array(
			'default'           => augury_get_option( 'blog-image-overlay-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[blog-image-overlay-style]', array(
			'type'    => 'select',
			'section' => 'site-post-archives-section',
			'label'   => esc_html__( 'Image Overlay Style', 'augury' ),
			'choices' => array(
			  'dt-sc-default' 			=> esc_html__('None', 'augury'),
			  'dt-sc-fixed' 			=> esc_html__('Fixed', 'augury'),
			  'dt-sc-tb' 				=> esc_html__('Top to Bottom', 'augury'),
			  'dt-sc-bt'   				=> esc_html__('Bottom to Top', 'augury'),
			  'dt-sc-rl'   				=> esc_html__('Right to Left', 'augury'),
			  'dt-sc-lr'				=> esc_html__('Left to Right', 'augury'),
			  'dt-sc-middle'			=> esc_html__('Middle', 'augury'),
			  'dt-sc-middle-radial'		=> esc_html__('Middle Radial', 'augury'),
			  'dt-sc-tb-gradient' 		=> esc_html__('Gradient - Top to Bottom', 'augury'),
			  'dt-sc-bt-gradient'   	=> esc_html__('Gradient - Bottom to Top', 'augury'),
			  'dt-sc-rl-gradient'   	=> esc_html__('Gradient - Right to Left', 'augury'),
			  'dt-sc-lr-gradient'		=> esc_html__('Gradient - Left to Right', 'augury'),
			  'dt-sc-radial-gradient'	=> esc_html__('Gradient - Radial', 'augury'),
			  'dt-sc-flash' 			=> esc_html__('Flash', 'augury'),
			  'dt-sc-circle' 			=> esc_html__('Circle', 'augury'),
			  'dt-sc-hm-elastic'		=> esc_html__('Horizontal Elastic', 'augury'),
			  'dt-sc-vm-elastic'		=> esc_html__('Vertical Elastic', 'augury'),
			),
			'description' => esc_html__('Choose image overlay style to display archives pages.', 'augury'),
			'dependency' => array( 'blog-post-layout', 'any', 'entry-grid,entry-list' ),
		)
	));

/**
 * Option : Pagination
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[blog-pagination]', array(
			'default'           => augury_get_option( 'blog-pagination' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[blog-pagination]', array(
			'type'    => 'select',
			'section' => 'site-post-archives-section',
			'label'   => esc_html__( 'Pagination Style', 'augury' ),
			'choices' => array(
			  'older_newer' 	=> esc_html__('Older & Newer', 'augury'),
			  'numbered'      	=> esc_html__('Numbered', 'augury'),
			  'load_more'      	=> esc_html__('Load More', 'augury'),
			  'infinite_scroll'	=> esc_html__('Infinite Scroll', 'augury'),
			),
			'description' => esc_html__('Choose pagination style to display archives pages.', 'augury')
		)
	));