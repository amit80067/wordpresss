<?php
// -----------------------------------------
// Header And Footer Options Metabox
// -----------------------------------------

function augury_shop_single_product() {

  $size_guides = array (
                      ''             => esc_html__('None', 'augury'),
                      'size-guide-1' => esc_html__('Size Guide 1', 'augury'), 
                      'size-guide-2' => esc_html__('Size Guide 2', 'augury'), 
                      'size-guide-3' => esc_html__('Size Guide 3', 'augury'), 
                      'size-guide-4' => esc_html__('Size Guide 4', 'augury'), 
                      'size-guide-5' => esc_html__('Size Guide 5', 'augury')
                    );

  $elementor_template_args = array (
    'numberposts' => -1,
    'post_type' => 'elementor_library',
    'fields' =>  'ids'
  );

  $elementor_templates_arr = get_posts ($elementor_template_args);

  $elementor_templates = array ( '' => esc_html__('None', 'augury'), 'custom-description' => esc_html__('Custom Description', 'augury') );
  foreach($elementor_templates_arr as $elementor_template) {
    $elementor_templates[$elementor_template] = get_the_title($elementor_template);
  }
  
  $product_meta_layout_section = array(
    'name'   => 'general_section',
    'title'  => esc_html__('General', 'augury'),
    'icon'   => 'fa fa-angle-double-right',
    'fields' =>  array(
        array(
            'id'         => 'page-layout',
            'type'       => 'image_select',
            'title'      => esc_html__('Page Layout', 'augury'),
            'options'    => array(
                'admin-option'         => DTM_URL . 'images/admin-option.png',
                'content-full-width'   => DTM_URL . 'images/without-sidebar.png',
                'with-left-sidebar'    => DTM_URL . 'images/left-sidebar.png',
                'with-right-sidebar'   => DTM_URL . 'images/right-sidebar.png',
            ),
            'default'    => 'admin-option',
            'attributes' => array( 'data-depend-id' => 'page-layout' )
        ),
        array(
            'id'         => 'show-standard-sidebar',
            'type'       => 'switcher',
            'title'      => esc_html__('Show Standard Sidebar', 'augury'),
            'dependency' => array( 'page-layout', 'any', 'with-left-sidebar,with-right-sidebar' )
        ),
        array(
            'id'         => 'product-widgetareas',
            'type'       => 'select',
            'title'      => esc_html__('Choose Custom Widget Area', 'augury'),
            'class'      => 'chosen',
            'options'    => augury_customizer_custom_widgets(),
            'dependency' => array( 'page-layout', 'any', 'with-left-sidebar,with-right-sidebar' ),
            'attributes' => array(
                'multiple'         => 'multiple',
                'data-placeholder' => esc_attr__('Select Widget Areas', 'augury'),
                'style'            => 'width: 400px;'
            ),
        ),

        # Product Template
        array(
            'id'      => 'product-template',
            'type'    => 'select',
            'title'   => esc_html__('Product Template', 'augury'),
            'class'   => 'chosen',
            'options' => array(
                'admin-option'    => esc_html__( 'Admin Option', 'augury' ),
                'woo-default'     => esc_html__( 'WooCommerce Default', 'augury' ),
                'custom-template' => esc_html__( 'Custom Template', 'augury' )
            ),
            'default'    => 'admin-option',
            'info'       => esc_html__('Don\'t use product shortcodes in content area when "WooCommerce Default" template is chosen.', 'augury')
        ),
               
        array(
            'id'         => 'show-upsell',
            'type'       => 'select',
            'title'      => esc_html__('Show Upsell Products', 'augury'),
            'class'      => 'chosen',
            'default'    => 'admin-option',
            'attributes' => array( 'data-depend-id' => 'show-upsell' ),
            'options'    => array(
                'admin-option' => esc_html__( 'Admin Option', 'augury' ),
                'true'         => esc_html__( 'Show', 'augury'),
                null           => esc_html__( 'Hide', 'augury'),
            ),
            'dependency' => array( 'product-template', '!=', 'custom-template')
        ),
        array(
            'id'         => 'upsell-column',
            'type'       => 'select',
            'title'      => esc_html__('Choose Upsell Column', 'augury'),
            'class'      => 'chosen',
            'default'    => 4,
            'options'    => array(
                'admin-option' => esc_html__( 'Admin Option', 'augury' ),
                1              => esc_html__( 'One Column', 'augury' ),
                2              => esc_html__( 'Two Columns', 'augury' ),
                3              => esc_html__( 'Three Columns', 'augury' ),
                4              => esc_html__( 'Four Columns', 'augury' ),
            ),
            'dependency' => array( 'product-template|show-upsell', '!=|==', 'custom-template|true')
        ),
        array(
            'id'         => 'upsell-limit',
            'type'       => 'select',
            'title'      => esc_html__('Choose Upsell Limit', 'augury'),
            'class'      => 'chosen',
            'default'    => 4,
            'options'    => array(
                'admin-option' => esc_html__( 'Admin Option', 'augury' ),
                1              => esc_html__( 'One', 'augury' ),
                2              => esc_html__( 'Two', 'augury' ),
                3              => esc_html__( 'Three', 'augury' ),
                4              => esc_html__( 'Four', 'augury' ),
                5              => esc_html__( 'Five', 'augury' ),
                6              => esc_html__( 'Six', 'augury' ),
                7              => esc_html__( 'Seven', 'augury' ),
                8              => esc_html__( 'Eight', 'augury' ),
                9              => esc_html__( 'Nine', 'augury' ),
                10              => esc_html__( 'Ten', 'augury' ),                                                
            ),
            'dependency' => array( 'product-template|show-upsell', '!=|==', 'custom-template|true')
        ),        
        array(
            'id'         => 'show-related',
            'type'       => 'select',
            'title'      => esc_html__('Show Related Products', 'augury'),
            'class'      => 'chosen',
            'default'    => 'admin-option',
            'attributes' => array( 'data-depend-id' => 'show-related' ),
            'options'    => array(
                'admin-option' => esc_html__( 'Admin Option', 'augury' ),
                'true'         => esc_html__( 'Show', 'augury'),
                null           => esc_html__( 'Hide', 'augury'),
            ),
            'dependency' => array( 'product-template', '!=', 'custom-template')
        ),
        array(
            'id'         => 'related-column',
            'type'       => 'select',
            'title'      => esc_html__('Choose Related Column', 'augury'),
            'class'      => 'chosen',
            'default'    => 4,
            'options'    => array(
                'admin-option' => esc_html__( 'Admin Option', 'augury' ),
                2              => esc_html__( 'Two Columns', 'augury' ),
                3              => esc_html__( 'Three Columns', 'augury' ),
                4              => esc_html__( 'Four Columns', 'augury' ),
            ),
            'dependency' => array( 'product-template|show-related', '!=|==', 'custom-template|true')
        ),
        array(
            'id'         => 'related-limit',
            'type'       => 'select',
            'title'      => esc_html__('Choose Related Limit', 'augury'),
            'class'      => 'chosen',
            'default'    => 4,
            'options'    => array(
                'admin-option' => esc_html__( 'Admin Option', 'augury' ),
                1              => esc_html__( 'One', 'augury' ),
                2              => esc_html__( 'Two', 'augury' ),
                3              => esc_html__( 'Three', 'augury' ),
                4              => esc_html__( 'Four', 'augury' ),
                5              => esc_html__( 'Five', 'augury' ),
                6              => esc_html__( 'Six', 'augury' ),
                7              => esc_html__( 'Seven', 'augury' ),
                8              => esc_html__( 'Eight', 'augury' ),
                9              => esc_html__( 'Nine', 'augury' ),
                10              => esc_html__( 'Ten', 'augury' ),                                                
            ),
            'dependency' => array( 'product-template|show-related', '!=|==', 'custom-template|true')
        ),

        # Product Additional Tabs
        array(
          'id'              => 'product-additional-tabs',
          'type'            => 'group',
          'title'           => esc_html__('Additional Tabs', 'augury'),
          'info'            => esc_html__('Click button to add title and description.', 'augury'),
          'button_title'    => esc_html__('Add New Tab', 'augury'),
          'accordion_title' => esc_html__('Adding New Tab Field', 'augury'),
          'fields'          => array(
            array(
            'id'          => 'tab_title',
            'type'        => 'text',
            'title'       => esc_html__('Title', 'augury'),
            ),

            array(
              'id'         => 'tab_description',
              'type'       => 'select',
              'title'      => esc_html__('Description', 'augury'),
              'options'    => $elementor_templates,
              'info'       => esc_html__('Choose "Elementor Templates" here to use for "Description", if you choose "Custom Description" option you can provide your own content below.', 'augury'),
              'attributes' => array( 'data-depend-id' => 'tab_description' )
            ),

            array(
              'id'         => 'tab_custom_description',
              'type'       => 'textarea',
              'title'      => esc_html__('Custom Description', 'augury'),
              'dependency' => array( 'tab_description', '==', 'custom-description' )
            ),

          )
        ),

        # Product New Label
         array(
            'id'         => 'product-new-label',
            'type'       => 'switcher',
            'title'      => esc_html__('Add "New" label', 'augury'),
        ), 

        array(
          'id'         => 'dt-single-product-size-guides',
          'type'       => 'select',
          'title'      => esc_html__('Product Size Guides', 'augury'),
          'options'    => $size_guides,
        ),              

        array(
          'id'         => 'description',
          'type'       => 'select',
          'title'      => esc_html__('Description', 'augury'),
          'options'    => $elementor_templates,
          'info'       => esc_html__('Choose "Elementor Templates" here to use for "Description", if you choose "Custom Description" option you can provide your own content below. This content will be used when "Custom Template" is chosen in "Product Template" option.', 'augury'),
          'attributes' => array( 'data-depend-id' => 'description' )
        ),

        array(
          'id'         => 'custom-description',
          'type'       => 'textarea',
          'title'      => esc_html__('Custom Description', 'augury'),
          'dependency' => array( 'description', '==', 'custom-description' )
        ),

    )
  );

  $options[] = array(
    'id'        => '_custom_settings',
    'title'     => esc_html__('Product Settings','augury'),
    'post_type' => 'product',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(
      $product_meta_layout_section
    )
  );

  $options[] = array(
    'id'        => '_360viewer_gallery',
    'title'     => esc_html__('Product 360 View Gallery','augury'),
    'post_type' => 'product',
    'context'   => 'side',
    'priority'  => 'low',
    'sections'  => array(
                    array(
                    'name'   => '360view_section',
                    'fields' =>  array(
                                    array (
                                      'id'          => 'product-360view-gallery',
                                      'type'        => 'gallery',
                                      'title'       => esc_html__('Gallery Images', 'augury'),
                                      'desc'        => esc_html__('Simply add images to gallery items.', 'augury'),
                                      'add_title'   => esc_html__('Add Images', 'augury'),
                                      'edit_title'  => esc_html__('Edit Images', 'augury'),
                                      'clear_title' => esc_html__('Remove Images', 'augury'),
                                    )
                                )
                    )
                  )
    );

  return $options;

}