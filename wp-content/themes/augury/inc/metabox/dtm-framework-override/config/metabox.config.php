<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// -----------------------------------------
// Detect plugin...
// -----------------------------------------
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// -----------------------------------------
// Layer Sliders
// -----------------------------------------
function dtm_framework_layersliders() {
  $layerslider = array(  esc_html__('Select a slider','augury') );

  if( class_exists('LS_Sliders') ) {

    $sliders = LS_Sliders::find(array('limit' => 50));

    if(!empty($sliders)) {
      foreach($sliders as $key => $item){
        $layerslider[ $item['id'] ] = $item['name'];
      }
    }
  }

  return $layerslider;
}

// -----------------------------------------
// Revolution Sliders
// -----------------------------------------
function dtm_framework_revolutionsliders() {
  $revolutionslider = array( '' => esc_html__('Select a slider','augury') );

  if( class_exists('RevSlider') ) {
    $sld = new RevSlider();
    $sliders = $sld->getArrSliders();
    if(!empty($sliders)){
      foreach($sliders as $key => $item) {
        $revolutionslider[$item->getAlias()] = $item->getTitle();
      }
    }
  }

  return $revolutionslider;  
}

// -----------------------------------------
// Meta Layout Section
// -----------------------------------------

$cart_page_id = get_option('woocommerce_cart_page_id');
$checkout_page_id = get_option('woocommerce_checkout_page_id');
$myaccount_page_id = get_option('woocommerce_myaccount_page_id');
$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );

if( isset( $_GET['post'] ) && ( $_GET['post'] == $cart_page_id || $_GET['post'] == $checkout_page_id || $_GET['post'] == $myaccount_page_id || $_GET['post'] == $wishlist_page_id ) ) {	

  $page_layout_options = array(
      'global-site-layout' 	 => DTM_URL . 'images/admin-option.png',
      'content-full-width'   => DTM_URL . 'images/without-sidebar.png',
      'with-left-sidebar'    => DTM_URL . 'images/left-sidebar.png',
      'with-right-sidebar'   => DTM_URL . 'images/right-sidebar.png',
  );

} else {

  $page_layout_options = array(
    'global-site-layout' 	 => DTM_URL . 'images/admin-option.png',
    'content-full-width'   => DTM_URL . 'images/without-sidebar.png',
    'with-left-sidebar'    => DTM_URL . 'images/left-sidebar.png',
    'with-right-sidebar'   => DTM_URL . 'images/right-sidebar.png',
    'with-both-sidebar'    => DTM_URL . 'images/both-sidebar.png',
  );

}

$meta_layout_section =array(
  'name'  => 'layout_section',
  'title' => esc_html__('Layout', 'augury'),
  'icon'  => 'fa fa-columns',
  'fields' =>  array(
    array(
      'id'  => 'layout',
      'type' => 'image_select',
      'title' => esc_html__('Page Layout', 'augury' ),
      'options'      => $page_layout_options,
      'default'      => 'global-site-layout',
      'attributes'   => array( 'data-depend-id' => 'page-layout' )
    ),
    array(
      'id'        => 'show-standard-sidebar-left',
      'type'      => 'switcher',
      'title'     => esc_html__('Show Standard Left Sidebar', 'augury' ),
      'dependency'=> array( 'page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
	  'default'	  => true,
    ),
    array(
      'id'        => 'widget-area-left',
      'type'      => 'select',
      'title'     => esc_html__('Choose Left Widget Areas', 'augury' ),
      'class'     => 'chosen',
      'options'   => augury_customizer_custom_widgets(),
      'attributes'  => array( 
        'multiple'  => 'multiple',
        'data-placeholder' => esc_html__('Select Left Widget Areas','augury'),
        'style' => 'width: 400px;'
      ),
      'dependency'  => array( 'page-layout', 'any', 'with-left-sidebar,with-both-sidebar' ),
    ),
    array(
      'id'          => 'show-standard-sidebar-right',
      'type'        => 'switcher',
      'title'       => esc_html__('Show Standard Right Sidebar', 'augury' ),
      'dependency'  => array( 'page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
	  'default'	  	=> true,
    ),
    array(
      'id'        => 'widget-area-right',
      'type'      => 'select',
      'title'     => esc_html__('Choose Right Widget Areas', 'augury' ),
      'class'     => 'chosen',
      'options'   => augury_customizer_custom_widgets(),
      'attributes'    => array( 
        'multiple' => 'multiple',
        'data-placeholder' => esc_html__('Select Right Widget Areas','augury'),
        'style' => 'width: 400px;'
      ),
      'dependency'  => array( 'page-layout', 'any', 'with-right-sidebar,with-both-sidebar' ),
    )
  )
);

// -----------------------------------------
// Meta Breadcrumb Section
// -----------------------------------------
$meta_breadcrumb_section = array(
  'name'  => 'breadcrumb_section',
  'title' => esc_html__('Breadcrumb', 'augury'),
  'icon'  => 'fa fa-sitemap',
  'fields' =>  array(

    array(
      'id'  => 'breadcrumb-option',
      'type' => 'image_select',
      'title' => esc_html__('Breadcrumb Option', 'augury' ),
      'options'      => array(
        'global-option'   => DTM_URL . 'images/admin-option.png',
		    'individual-option' => DTM_URL . 'images/individual-option.png',
      ),
      'default'      => 'global-option',
      'attributes'   => array( 'data-depend-id' => 'breadcrumb-option' )
    ),
    array(
      'id'         => 'enable-sub-title',
      'type'       => 'switcher',
      'title'      => esc_html__('Show Breadcrumb', 'augury' ),
      'default'    => true,
      'dependency' => array( 'breadcrumb-option', 'any', 'individual-option' ),
    ),
    array(
      'id'         => 'enable-dark-bg',
      'type'       => 'switcher',
      'title'      => esc_html__('Dark BG?', 'augury' ),
      'default'    => true,
      'dependency' => array( 'breadcrumb-option', 'any', 'individual-option' ),
    ),    
    array(
    	'id'                 => 'breadcrumb_position',
	    'type'               => 'select',
      'title'              => esc_html__('Position', 'augury' ),
      'options'            => array(
        'header-top-absolute' => esc_html__('Behind the Header','augury'),
        'header-top-relative' => esc_html__('Default','augury'),
	  	),
		  'default'            => 'header-top-relative',	
      'dependency'         => array( 'enable-sub-title|breadcrumb-option', '==|any', 'true|individual-option' ),
    ),    
    array(
      'id'         => 'breadcrumb_background',
      'type'       => 'background',
      'title'      => esc_html__('Background', 'augury' ),
      'dependency' => array( 'enable-sub-title|breadcrumb-option', '==|any', 'true|individual-option' ),
    )
    
  )
);

// -----------------------------------------
// Meta Slider Section
// -----------------------------------------
$meta_slider_section = array(
  'name'  => 'slider_section',
  'title' => esc_html__('Slider', 'augury'),
  'icon'  => 'fa fa-slideshare',
  'fields' =>  array(
    array(
      'id'           => 'slider-notice',
      'type'         => 'notice',
      'class'        => 'danger',
      'content'      => esc_html__('Slider tab works only if breadcrumb disabled.','augury'),
      'class'        => 'margin-30 cs-danger'
    ),

    array(
      'id'           => 'show_slider',
      'type'         => 'switcher',
      'title'        => esc_html__('Show Slider', 'augury' ),
    ),
    array(
    	'id'                 => 'slider_position',
      'type'               => 'select',
      'title'              => esc_html__('Position', 'augury' ),
      'options'            => array(
        'header-top-relative'     => esc_html__('Top Header Relative','augury'),
        'header-top-absolute'    => esc_html__('Top Header Absolute','augury'),
        'bottom-header' 	   => esc_html__('Bottom Header','augury'),
      ),
      'default'            => 'bottom-header',
      'dependency'         => array( 'show_slider', '==', 'true' ),
   ),
   array(
      'id'                 => 'slider_type',
      'type'               => 'select',
      'title'              => esc_html__('Slider', 'augury' ),
      'options'            => array(
        ''                 => esc_html__('Select a slider','augury'),
        'layerslider'      => esc_html__('Layer slider','augury'),
        'revolutionslider' => esc_html__('Revolution slider','augury'),
        'customslider'     => esc_html__('Custom Slider Shortcode','augury'),
      ),
      'validate' => 'required',
      'dependency'         => array( 'show_slider', '==', 'true' ),
    ),

    array(
      'id'          => 'layerslider_id',
      'type'        => 'select',
      'title'       => esc_html__('Layer Slider', 'augury' ),
      'options'     => dtm_framework_layersliders(),
      'validate'    => 'required',
      'dependency'         => array( 'show_slider|slider_type', '==|==', 'true|layerslider' ),
    ),

    array(
      'id'          => 'revolutionslider_id',
      'type'        => 'select',
      'title'       => esc_html__('Revolution Slider', 'augury' ),
      'options'     => dtm_framework_revolutionsliders(),
      'validate'    => 'required',
      'dependency'         => array( 'show_slider|slider_type', '==|==', 'true|revolutionslider' ),
    ),

    array(
      'id'          => 'customslider_sc',
      'type'        => 'textarea',
      'title'       => esc_html__('Custom Slider Code', 'augury' ),
      'validate'    => 'required',
      'dependency'         => array( 'show_slider|slider_type', '==|==', 'true|customslider' ),
    ),
  )  
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// -----------------------------------------
// Page Metabox Options                    -
// -----------------------------------------
array_push( $meta_layout_section['fields'], array(
  'id'        => 'enable-sticky-sidebar',
  'type'      => 'switcher',
  'title'     => esc_html__('Enable Sticky Sidebar', 'augury' ),
  'dependency'  => array( 'page-layout', 'any', 'with-left-sidebar,with-right-sidebar,with-both-sidebar' )
) );

$page_settings = array(
  $meta_layout_section,
  $meta_breadcrumb_section,
  $meta_slider_section,
  array(
    'name'   => 'sidenav_template_section',
    'title'  => esc_html__('Side Navigation Template', 'augury'),
    'icon'   => 'fa fa-th-list',
    'fields' =>  array(
      array(
        'id'      => 'sidenav-tpl-notice',
        'type'    => 'notice',
        'class'   => 'success',
        'content' => esc_html__('Side Navigation Tab Works only if page template set to Side Navigation Template in Page Attributes','augury'),
        'class'   => 'margin-30 cs-success',      
      ),
      array(
        'id'      => 'sidenav-style',
        'type'    => 'select',
        'title'   => esc_html__('Side Navigation Style', 'augury' ),
        'options' => array(
          'type1'  => esc_html__('Type1','augury'),
          'type2'  => esc_html__('Type2','augury'),
          'type3'  => esc_html__('Type3','augury'),
          'type4'  => esc_html__('Type4','augury'),
          'type5'  => esc_html__('Type5','augury')
        ),
      ),
      array(
        'id'    => 'sidenav-align',
        'type'  => 'switcher',
        'title' => esc_html__('Align Right', 'augury' ),
        'info'  => esc_html__('YES! to align right of side navigation.','augury')
      ),
      array(
        'id'    => 'sidenav-sticky',
        'type'  => 'switcher',
        'title' => esc_html__('Sticky Side Navigation', 'augury' ),
        'info'  => esc_html__('YES! to sticky side navigation content.','augury')
      ),
      array(
        'id'    => 'enable-sidenav-content',
        'type'  => 'switcher',
        'title' => esc_html__('Show Content', 'augury' ),
        'info'  => esc_html__('YES! to show content in below side navigation.','augury')
      ),
      array(
        'id'      => 'sidenav-content',
        'type'    => 'select',
        'title'   => esc_html__('Side Navigation Content', 'augury' ),
        'info'    => esc_html__('Select any section here.','augury'),
		    'options' => augury_get_elementor_page_list(),
		    'default' => '0'
      ),
      array(
        'id'      => 'sidenav-icon',
        'type'    => 'image',
        'title'   => esc_html__('Side Navigation Icon', 'augury'),
        'desc'    => esc_html__('Icon display before side nav menu.', 'augury')
      ),
      array(
        'id'      => 'sidenav-hover-icon',
        'type'    => 'image',
        'title'   => esc_html__('Side Navigation Hover Icon', 'augury'),
        'desc'    => esc_html__('Icon display before side nav menu on hover.', 'augury')
      ),
    )
  ),
);

$shop_page_id = get_option('woocommerce_shop_page_id');

if( isset( $_GET['post'] ) && ( $_GET['post'] != $shop_page_id ) || !isset( $_GET['post'] )  ) {	
  $options[] = array(
    'id'        => '_tpl_default_settings',
    'title'     => esc_html__('Page Settings','augury'),
    'post_type' => 'page',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => $page_settings
  );

}

// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------
$post_meta_layout_section = $meta_layout_section;
$fields = $post_meta_layout_section['fields'];

	$fields[0]['title'] =  esc_html__('Post Layout', 'augury' );
	unset( $fields[5] );
	unset( $post_meta_layout_section['fields'] );
	$post_meta_layout_section['fields']  = $fields;  

	$post_format_section = array(
		'name'  => 'post_format_data_section',
		'title' => esc_html__('Post Format', 'augury'),
		'icon'  => 'fa fa-cog',
		'fields' =>  array(

			array(
				'id'           => 'single-post-style',
				'type'         => 'select',
				'title'        => esc_html__('Post Style', 'augury'),
				'options'      => array(
          'breadcrumb-fixed'    => esc_html__('Breadcrumb Fixed', 'augury'),
          'breadcrumb-parallax' => esc_html__('Breadcrumb Parallax', 'augury'),
          'overlay'             => esc_html__('Overlay', 'augury'),
          'overlap'             => esc_html__('Overlap', 'augury'),
          #'custom-minimal'      => esc_html__('Minimal', 'augury'),
          'custom-classic'      => esc_html__('Classic', 'augury'),
          'custom-modern'       => esc_html__('Modern', 'augury'),          
				),
				'class'        => 'chosen',
				'default'      => 'overlay',
				'attributes'   => array(
				  'style'    => 'width: 50%;'
				),
				'info'         => esc_html__('Choose post style to display single post. If post style is "Custom", display based on Editor content.', 'augury')
			),

			array(
			    'id'           => 'view_count',
			    'type'         => 'number',
			    'title'        => esc_html__('Views', 'augury' ),
				  'info'         => esc_html__('No.of views of this post.', 'augury'),
          'attributes' => array(
            'style'    => 'width: 15%;'
        	),
			),

			array(
			    'id'           => 'like_count',
			    'type'         => 'number',
			    'title'        => esc_html__('Likes', 'augury' ),
				'info'         => esc_html__('No.of likes of this post.', 'augury'),
	          	'attributes' => array(
		           'style'    => 'width: 15%;'
        	    ),
			),

			array(
				'id' => 'post-format-type',
				'title'   => esc_html__('Type', 'augury' ),
				'type' => 'select',
				'default' => 'standard',
				'options' => array(
					'standard'  => esc_html__('Standard', 'augury'),
					'status'	=> esc_html__('Status','augury'),
					'quote'		=> esc_html__('Quote','augury'),
					'gallery'	=> esc_html__('Gallery','augury'),
					'image'		=> esc_html__('Image','augury'),
					'video'		=> esc_html__('Video','augury'),
					'audio'		=> esc_html__('Audio','augury'),
					'link'		=> esc_html__('Link','augury'),
					'aside'		=> esc_html__('Aside','augury'),
					'chat'		=> esc_html__('Chat','augury')
				),
				'info'         => esc_html__('Post Format & Type should be Same. Check the Post Format from the "Format" Tab, which comes in the Right Side Section', 'augury'),
			),

			array(
				'id' 	  => 'post-gallery-items',
				'type'	  => 'gallery',
				'title'   => esc_html__('Add Images', 'augury' ),
				'add_title'   => esc_html__('Add Images', 'augury' ),
				'edit_title'  => esc_html__('Edit Images', 'augury' ),
				'clear_title' => esc_html__('Remove Images', 'augury' ),
				'dependency' => array( 'post-format-type', '==', 'gallery' ),
			),

			array(
				'id' 	  => 'media-type',
				'type'	  => 'select',
				'title'   => esc_html__('Select Type', 'augury' ),
				'dependency' => array( 'post-format-type', 'any', 'video,audio' ),
		      	'options'	=> array(
					'oembed' => esc_html__('Oembed','augury'),
					'self' => esc_html__('Self Hosted','augury'),
				)
			),

			array(
				'id' 	  => 'media-url',
				'type'	  => 'textarea',
				'title'   => esc_html__('Media URL', 'augury' ),
				'dependency' => array( 'post-format-type', 'any', 'video,audio' ),
			),
		)
	);

	$options[] = array(
		'id'        => '_dt_post_settings',
		'title'     => esc_html__('Post Settings','augury'),
		'post_type' => 'post',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			$post_meta_layout_section,
			$meta_breadcrumb_section,
			$post_format_section			
		)
	);

// -----------------------------------------
// Tribe Events Post Metabox Options
// -----------------------------------------
  array_push( $post_meta_layout_section['fields'], array(
    'id' => 'event-post-style',
    'title'   => esc_html__('Post Style', 'augury' ),
    'type' => 'select',
    'default' => 'type1',
    'options' => array(
      'type1'  => esc_html__('Classic', 'augury'),
      'type2'  => esc_html__('Full Width','augury'),
      'type3'  => esc_html__('Minimal Tab','augury'),
      'type4'  => esc_html__('Clean','augury'),
      'type5'  => esc_html__('Modern','augury'),
    ),
	'class'    => 'chosen',
	'info'     => esc_html__('Your event post page show at most selected style.', 'augury')
  ) );

  $options[] = array(
    'id'        => '_custom_settings',
    'title'     => esc_html__('Settings','augury'),
    'post_type' => 'tribe_events',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(
      $post_meta_layout_section,
      $meta_breadcrumb_section
    )
  );


// -----------------------------------------
// Shop Single Product Options Metabox
// -----------------------------------------

if( function_exists( 'is_woocommerce' ) ) {

  require_once( AUGURY_DIR .'/inc/metabox/dtm-framework-override/config/shop-single-product.php' );

  $shop_single_product_options = augury_shop_single_product();
  $options = array_merge($shop_single_product_options, $options);  

}

// -----------------------------------------
// Shop Product Template Options Metabox
// -----------------------------------------

if( function_exists( 'is_woocommerce' ) ) {

  require_once( AUGURY_DIR .'/inc/metabox/dtm-framework-override/config/shop-product-template.php' );

  $shop_product_template_options = augury_shop_product_template();
  $options = array_merge($shop_product_template_options, $options);

}

// -----------------------------------------
// Header And Footer Options Metabox
// -----------------------------------------
$post_types = apply_filters( 'augury_header_footer_default_cpt' , array ( 'post', 'page', 'product' )  );
$options[] = array(
	'id'	=> '_dt_custom_settings',
	'title'	=> esc_html__('Header & Footer','augury'),
	'post_type' => $post_types,
	'priority'  => 'high',
	'context'   => 'side', 
	'sections'  => array(

		# Header Settings
		array(
			'name'  => 'header_section',
			'title' => esc_html__('Header', 'augury'),
			'icon'  => 'fa fa-angle-double-right',
			'fields' =>  array(

				# Header Show / Hide
				array(
					'id'		=> 'show-header',
					'type'		=> 'switcher',
					'title'		=> esc_html__('Show Header', 'augury'),
					'default'	=>  true,
				),

				# Header
				array(
					'id'  		 => 'header',
					'type'  	 => 'select',
					'title' 	 => esc_html__('Choose Header', 'augury'),
					'class'		 => 'chosen',
					'options'	 => 'posts',
					'query_args' => array(
						'post_type'	 => 'dt_headers',
						'orderby'	 => 'ID',
						'order'		 => 'ASC',
						'posts_per_page' => -1,
					),
					'default_option' => esc_attr__('Select Header', 'augury'),
					'attributes' => array( 'style'	=> 'width:50%' ),
					'info'		 => esc_html__('Select custom header for this page.','augury'),
					'dependency'	=> array( 'show-header', '==', 'true' )
				),							
			)			
		), # Header Settings

		# Footer Settings
		array(
			'name'  => 'footer_settings',
			'title' => esc_html__('Footer', 'augury'),
			'icon'  => 'fa fa-angle-double-right',
			'fields' =>  array(
			
				# Footer Show / Hide
				array(
					'id'		=> 'show-footer',
					'type'		=> 'switcher',
					'title'		=> esc_html__('Show Footer', 'augury'),
					'default'	=>  true,
				),
				
				# Footer
		        array(
					'id'         => 'footer',
					'type'       => 'select',
					'title'      => esc_html__('Choose Footer', 'augury'),
					'class'      => 'chosen',
					'options'    => 'posts',
					'query_args' => array(
						'post_type'  => 'dt_footers',
						'orderby'    => 'ID',
						'order'      => 'ASC',
						'posts_per_page' => -1,
					),
					'default_option' => esc_attr__('Select Footer', 'augury'),
					'attributes' => array( 'style'  => 'width:50%' ),
					'info'       => esc_html__('Select custom footer for this page.','augury'),
					'dependency'    => array( 'show-footer', '==', 'true' )
				),			
			)			
		), # Footer Settings
	)	
);

DTMFramework_Metabox::instance( $options );