<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Option : Post Elements
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[post-elements-position]', array(
			'default'           => augury_get_option( 'post-elements-position' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		)
	);

    $wp_customize->add_control( new Augury_Customize_Control_Sortable(
		$wp_customize, AUGURY_SETTINGS . '[post-elements-position]', array(
			'type' => 'dt-sortable',
			'label' => esc_html__( 'Post Elements Positioning', 'augury'),
			'section' => 'site-post-single-section',
			'choices' => apply_filters( 'augury_single_post_elements_options', array(
				'feature_image'	=> esc_html__('Feature Image', 'augury'),
				'title'      	=> esc_html__('Title', 'augury'),
				'content'    	=> esc_html__('Content', 'augury'),
				'meta_group' 	=> esc_html__('Meta Group', 'augury'),
				'navigation'    => esc_html__('Navigation', 'augury'),
				'author_bio' 	=> esc_html__('Author Bio', 'augury'),
				'comment_box' 	=> esc_html__('Comment Box', 'augury'),
				'related_posts' => esc_html__('Related Posts', 'augury'),
				'author'		=> esc_html__('Author', 'augury'),
				'date'     		=> esc_html__('Date', 'augury'),
				'comments' 		=> esc_html__('Comments', 'augury'),
				'categories'    => esc_html__('Categories', 'augury'),
				'tags'  		=> esc_html__('Tags', 'augury'),
				'social_share'  => esc_html__('Social Share', 'augury'),
				'likes_views'   => esc_html__('Likes & Views', 'augury'),
				'related_article' 	=> esc_html__('Related Article( Only Fixed )', 'augury'),
			)),
        )
    ));

/**
 * Option : Meta Elements
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[post-meta-position]', array(
			'default'           => augury_get_option( 'post-meta-position' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		)
	);

    $wp_customize->add_control( new Augury_Customize_Control_Sortable(
		$wp_customize, AUGURY_SETTINGS . '[post-meta-position]', array(
			'type' => 'dt-sortable',
			'label' => esc_html__( 'Meta Group Positioning', 'augury'),
			'section' => 'site-post-single-section',
			'choices' => apply_filters( 'augury_single_post_meta_elements_options', array(
				'author'		=> esc_html__('Author', 'augury'),
				'date'     		=> esc_html__('Date', 'augury'),
				'comments' 		=> esc_html__('Comments', 'augury'),
				'categories'    => esc_html__('Categories', 'augury'),
				'tags'  		=> esc_html__('Tags', 'augury'),
				'social_share'  => esc_html__('Social Share', 'augury'),
				'likes_views'   => esc_html__('Likes & Views', 'augury'),
			))
        )
    ));

/**
 * Option : Post Related Title
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[post-related-title]', array(
			'default'           => augury_get_option( 'post-related-title' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[post-related-title]', array(
				'type'    	  => 'text',
				'section'     => 'site-post-single-section',
				'label'       => esc_html__( 'Related Posts Section Title', 'augury' ),
				'description' => esc_html__('Put the related posts section title here', 'augury'),
				'input_attrs' => array(
					'value'	=> esc_html__('Related Posts', 'augury'),
				)
			)
		)
	);

/**
 * Option : Related Columns
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[post-related-columns]', array(
			'default'           => augury_get_option( 'post-related-columns' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

    $wp_customize->add_control( new Augury_Customize_Control_Radio_Image(
		$wp_customize, AUGURY_SETTINGS . '[post-related-columns]', array(
			'type' => 'dt-radio-image',
			'label' => esc_html__( 'Columns', 'augury'),
			'section' => 'site-post-single-section',
			'choices' => apply_filters( 'augury_single_related_columns_options', array(
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
        )
    ));

/**
 * Option : Related Count
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[post-related-count]', array(
			'default'           => augury_get_option( 'post-related-count' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[post-related-count]', array(
				'type'    	  => 'text',
				'section'     => 'site-post-single-section',
				'label'       => esc_html__( 'No.of Posts to Show', 'augury' ),
				'description' => esc_html__('Put the no.of related posts to show', 'augury'),
				'input_attrs' => array(
					'value'	=> 3,
				),
			)
		)
	);

/**
 * Option : Enable Excerpt
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-related-excerpt]', array(
			'default'           => augury_get_option( 'enable-related-excerpt' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-related-excerpt]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Excerpt Text', 'augury'),
				'section' => 'site-post-single-section',
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
		AUGURY_SETTINGS . '[post-related-excerpt]', array(
			'default'           => augury_get_option( 'post-related-excerpt' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_number' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control(
			$wp_customize, AUGURY_SETTINGS . '[post-related-excerpt]', array(
				'type'    	  => 'text',
				'section'     => 'site-post-single-section',
				'label'       => esc_html__( 'Excerpt Length', 'augury' ),
				'description' => esc_html__('Put Excerpt Length', 'augury'),
				'input_attrs' => array(
					'value'	=> 25,
				),
				'dependency' => array( 'enable-related-excerpt', '==', 'true' ),
			)
		)
	);

/**
 * Option : Related Carousel
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-related-carousel]', array(
			'default'           => augury_get_option( 'enable-related-carousel' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-related-carousel]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Enable Carousel', 'augury'),
				'description' => esc_html__('YES! to enable carousel related posts', 'augury'),
				'section' => 'site-post-single-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Related Carousel Nav
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[related-carousel-nav]', array(
			'default'           => augury_get_option( 'related-carousel-nav' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[related-carousel-nav]', array(
			'type'    => 'select',
			'section' => 'site-post-single-section',
			'label'   => esc_html__( 'Navigation Style', 'augury' ),
			'choices' => array(
				'' 			 => esc_html__('None', 'augury'),
				'navigation' => esc_html__('Navigations', 'augury'),
				'pager'   	 => esc_html__('Pager', 'augury'),
			),
			'description' => esc_html__('Choose navigation style to display related post carousel.', 'augury'),
			'dependency' => array( 'enable-related-carousel', '==', 'true' ),
		)
	));

/**
 * Option : Image Lightbox
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[enable-image-lightbox]', array(
			'default'           => augury_get_option( 'enable-image-lightbox' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_tweek' ),
		)
	);

	$wp_customize->add_control(
		new Augury_Customize_Control_Switch(
			$wp_customize, AUGURY_SETTINGS . '[enable-image-lightbox]', array(
				'type'    => 'dt-switch',
				'label'   => esc_html__( 'Feature Image Lightbox', 'augury'),
				'description' => esc_html__('YES! to enable lightbox for feature image. Will not work in "Overlay" style.', 'augury'),
				'section' => 'site-post-single-section',
				'choices' => array(
					'on'  => esc_attr__( 'Yes', 'augury' ),
					'off' => esc_attr__( 'No', 'augury' )
				)
			)
		)
	);

/**
 * Option : Comment List Style
 */
	$wp_customize->add_setting(
		AUGURY_SETTINGS . '[post-comments-list-style]', array(
			'default'           => augury_get_option( 'post-comments-list-style' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Augury_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control( new Augury_Customize_Control(
		$wp_customize, AUGURY_SETTINGS . '[post-comments-list-style]', array(
			'type'    => 'select',
			'section' => 'site-post-single-section',
			'label'   => esc_html__( 'Comments List Style', 'augury' ),
			'choices' => array(
			  'rounded' 	=> esc_html__('Rounded', 'augury'),
			  'square'   	=> esc_html__('Square', 'augury'),
			),
			'description' => esc_html__('Choose comments list style to display single post.', 'augury'),
		)
	));